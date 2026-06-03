<?php

namespace App\Http\Services;

use App\Events\MatchCreated;
use App\Events\ResultCreated;
use App\Mail\SystemNotification;
use App\Models\ApiFixture;
use App\Models\Equipo;
use App\Models\EquipoPartido;
use App\Models\Jornada;
use App\Models\Partido;
use App\Models\ResultadoPartido;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class MatchService
{
    /**
     * Sincroniza Partidos locales contra una colección de ApiFixtures.
     *
     * Por cada fixture intenta:
     *   1) Match directo por `partidos.api_fixture_id`.
     *   2) Si no, match por jornada + mismos equipos (set-equivalent, sin importar
     *      orden home/away). Este step es backfill para los partidos seedeados de
     *      las jornadas 1–3 (fase de grupos), que no nacieron con `api_fixture_id`.
     *   3) Si tampoco, crea un Partido + EquipoPartido nuevo en la jornada y
     *      dispara `MatchCreated`.
     *
     * Para los partidos existentes (steps 1 y 2), actualiza `api_fixture_id` (si
     * faltaba) y `fecha_partido` (si cambió en la API).
     *
     * @param  Collection<int,ApiFixture> $fixtures Persistidos vía `ApiFootballService::getFixtures`.
     * @return array{error: bool, created: int, linked: int, updated: int, skipped: int}
     *         `linked` = backfilleados con `api_fixture_id` por team-match;
     *         `updated` = `fecha_partido` movida.
     */
    public function getMatches(Collection $fixtures): array
    {
        $created = 0;
        $linked  = 0;
        $updated = 0;
        $skipped = 0;

        try {
            foreach ($fixtures as $fixture) {
                $jornada = Jornada::where('api_round', $fixture->round)->first();

                if (! $jornada) {
                    $this->notify(
                        'MatchService::getMatches — Jornada no encontrada',
                        "No existe Jornada con api_round '{$fixture->round}' (api_fixture_id={$fixture->api_fixture_id})."
                    );
                    $skipped++;
                    continue;
                }

                $equipo_1 = Equipo::where('api_team_id', $fixture->api_home_team_id)->value('id');
                $equipo_2 = Equipo::where('api_team_id', $fixture->api_away_team_id)->value('id');

                if (! $equipo_1 || ! $equipo_2) {
                    $this->notify(
                        'MatchService::getMatches — Equipo no enlazado',
                        "Fixture api_fixture_id={$fixture->api_fixture_id}: home={$fixture->api_home_team_id} away={$fixture->api_away_team_id}. Falta enlace en equipos.api_team_id."
                    );
                    $skipped++;
                    continue;
                }

                $partido = Partido::where('api_fixture_id', $fixture->api_fixture_id)->first();

                $matchedByTeams = false;

                if (! $partido) {
                    $candidates = Partido::where('jornada_id', $jornada->id)
                        ->whereHas('equipos', function ($q) use ($equipo_1, $equipo_2) {
                            $q->where(function ($qq) use ($equipo_1, $equipo_2) {
                                $qq->where('equipo_1', $equipo_1)->where('equipo_2', $equipo_2);
                            })->orWhere(function ($qq) use ($equipo_1, $equipo_2) {
                                $qq->where('equipo_1', $equipo_2)->where('equipo_2', $equipo_1);
                            });
                        })
                        ->orderBy('id')
                        ->get();

                    if ($candidates->count() > 1) {
                        $this->notify(
                            'MatchService::getMatches — Múltiples partidos por teams',
                            "Jornada {$jornada->id} tiene {$candidates->count()} partidos con equipos {$equipo_1} vs {$equipo_2} (api_fixture_id={$fixture->api_fixture_id}). Se toma el de menor id."
                        );
                    }

                    $partido = $candidates->first();

                    if ($partido) {
                        if ($partido->api_fixture_id && $partido->api_fixture_id !== $fixture->api_fixture_id) {
                            $this->notify(
                                'MatchService::getMatches — Conflicto api_fixture_id',
                                "Partido id={$partido->id} ya tiene api_fixture_id={$partido->api_fixture_id}, pero el fixture entrante es {$fixture->api_fixture_id}. Se omite."
                            );
                            $skipped++;
                            continue;
                        }
                        $matchedByTeams = true;
                    }
                }

                if (! $partido) {
                    DB::transaction(function () use ($fixture, $jornada, $equipo_1, $equipo_2) {
                        $partido = Partido::create([
                            'jornada_id'     => $jornada->id,
                            'fecha_partido'  => $fixture->date,
                            'estadio_id'     => 1,
                            'fase'           => null,
                            'brand_id'       => null,
                            'jugado'         => 0,
                            'estado'         => 0,
                            'api_fixture_id' => $fixture->api_fixture_id,
                        ]);

                        EquipoPartido::create([
                            'partido_id' => $partido->id,
                            'equipo_1'   => $equipo_1,
                            'equipo_2'   => $equipo_2,
                        ]);

                        $partido->load('equipos');
                        MatchCreated::dispatch($partido);
                    });

                    $created++;
                    continue;
                }

                $changes = [];

                if ($matchedByTeams && ! $partido->api_fixture_id) {
                    $changes['api_fixture_id'] = $fixture->api_fixture_id;
                }

                if ($fixture->date && (! $partido->fecha_partido || ! $partido->fecha_partido->equalTo($fixture->date))) {
                    $changes['fecha_partido'] = $fixture->date;
                }

                if (empty($changes)) {
                    $skipped++;
                    continue;
                }

                $partido->update($changes);

                if (array_key_exists('api_fixture_id', $changes)) $linked++;
                if (array_key_exists('fecha_partido',  $changes)) $updated++;
            }

            return [
                'error'   => false,
                'created' => $created,
                'linked'  => $linked,
                'updated' => $updated,
                'skipped' => $skipped,
            ];
        } catch (Throwable $e) {
            $this->notify(
                'MatchService::getMatches — Excepción',
                $e->getMessage() . "\n" . $e->getTraceAsString()
            );

            return [
                'error'   => true,
                'created' => $created,
                'linked'  => $linked,
                'updated' => $updated,
                'skipped' => $skipped,
            ];
        }
    }

    /**
     * Crea ResultadoPartido para cada ApiFixture finalizado cuyo Partido local ya
     * exista y aún no tenga resultado. Por cada Resultado nuevo dispara
     * `ResultCreated`. Considera "finalizado" si `status_short` ∈ FT|AET|PEN
     * y ambos marcadores vienen poblados.
     *
     * @param  Collection<int,ApiFixture> $fixtures
     * @return array{error: bool, created: int, skipped: int}
     */
    public function getMatchesResult(Collection $fixtures): array
    {
        $created = 0;
        $skipped = 0;

        try {
            foreach ($fixtures as $fixture) {
                $finished = in_array($fixture->status_short, ['FT', 'AET', 'PEN'], true)
                    && $fixture->goals_home !== null
                    && $fixture->goals_away !== null;

                if (! $finished) {
                    $skipped++;
                    continue;
                }

                $partido = Partido::where('api_fixture_id', $fixture->api_fixture_id)->first();

                if (! $partido) {
                    $this->notify(
                        'MatchService::getMatchesResult — Partido no encontrado',
                        "No existe Partido con api_fixture_id={$fixture->api_fixture_id}. ¿Olvidaste correr getMatches primero?"
                    );
                    $skipped++;
                    continue;
                }

                if (ResultadoPartido::where('partido_id', $partido->id)->exists()) {
                    $skipped++;
                    continue;
                }

                $equipos = EquipoPartido::where('partido_id', $partido->id)->first();

                if (! $equipos) {
                    $this->notify(
                        'MatchService::getMatchesResult — EquipoPartido faltante',
                        "Partido id={$partido->id} (api_fixture_id={$fixture->api_fixture_id}) no tiene registro en equipo_partidos."
                    );
                    $skipped++;
                    continue;
                }

                $ganador_id = null;

                if ($fixture->goals_home > $fixture->goals_away) {
                    $ganador_id = $equipos->equipo_1;
                } elseif ($fixture->goals_home < $fixture->goals_away) {
                    $ganador_id = $equipos->equipo_2;
                }

                $resultado = ResultadoPartido::create([
                    'partido_id'        => $partido->id,
                    'goles_equipo_1'    => $fixture->goals_home,
                    'goles_equipo_2'    => $fixture->goals_away,
                    'equipo_ganador_id' => $ganador_id,
                ]);

                ResultCreated::dispatch($resultado);

                $created++;
            }

            return ['error' => false, 'created' => $created, 'skipped' => $skipped];
        } catch (Throwable $e) {
            $this->notify(
                'MatchService::getMatchesResult — Excepción',
                $e->getMessage() . "\n" . $e->getTraceAsString()
            );

            return ['error' => true, 'created' => $created, 'skipped' => $skipped];
        }
    }

    private function notify(string $subject, string $body): void
    {
        Log::warning($subject . ' :: ' . $body);

        $to = config('quiniela.system_notifications_email');

        if (empty($to)) return;

        Mail::to($to)->send(new SystemNotification($subject, $body));
    }
}
