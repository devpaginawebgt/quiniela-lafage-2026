<?php

namespace App\Http\Services;

use App\Models\ApiFixture;
use App\Models\ApiPlayer;
use App\Models\ApiResponse;
use App\Models\ApiTeam;
use Illuminate\Support\Facades\Http;

class ApiFootballService
{
    private string $base_url;
    private string $api_key;

    /**
     * Inicializa el servicio cargando la URL base y la API key desde la configuración
     * `config/api-football.php`. No recibe parámetros porque las credenciales no deben
     * pasarse manualmente: se resuelven siempre vía config para evitar `env()` en runtime.
     *
     * @return void
     */
    public function __construct()
    {
        $this->base_url = config('api-football.base_url', '');
        $this->api_key  = config('api-football.api_key', '');
    }

    /**
     * Ejecuta una petición GET autenticada contra API-Football y persiste un registro
     * en `api_responses` por cada llamada (éxito o error) para auditoría/diagnóstico.
     * En éxito el `response` crudo se omite (los datos se transforman en tablas de
     * dominio); en error se guarda para depurar. Todo acceso externo a la API debe
     * pasar por aquí para no romper el log.
     *
     * @param  string $endpoint Ruta relativa al `base_url`, incluyendo querystring
     *                          (ej. `'/teams?league=1&season=2026'`).
     * @return array{error: bool, data?: array, message?: string} `error=false` con `data`
     *                          (array `response` de la API) o `error=true` con `message`.
     */
    private function request(string $endpoint): array
    {
        $response = Http::withHeaders([
            'x-apisports-key' => $this->api_key,
        ])->get($this->base_url . $endpoint);

        $body      = $response->json() ?? [];
        $hasErrors = ! empty($body['errors'] ?? []);
        $success   = $response->ok() && ! $hasErrors;

        ApiResponse::create([
            'endpoint'    => $body['get'] ?? trim(parse_url($endpoint, PHP_URL_PATH) ?? '', '/'),
            'parameters'  => $body['parameters'] ?? null,
            'errors'      => $body['errors'] ?? null,
            'results'     => $body['results'] ?? 0,
            'paging'      => $body['paging'] ?? null,
            'response'    => $success ? null : ($body['response'] ?? null),
            'status_code' => $response->status(),
            'success'     => $success,
        ]);

        if (! $success) {
            return [
                'error'   => true,
                'message' => 'No se pudo obtener la información de la API Football.',
            ];
        }

        return [
            'error' => false,
            'data'  => $body['response'] ?? [],
        ];
    }

    /**
     * Sincroniza el catálogo de equipos de una liga/temporada llamando a `/teams`
     * y haciendo `updateOrCreate` en la tabla `api_teams` por `api_team_id`. Es
     * idempotente: cada ejecución refresca nombre, código, país, año de fundación,
     * flag `national` y logo.
     *
     * @param  int $league ID externo de la liga en API-Football (default `1` = Mundial).
     * @param  int $season Año de la temporada (default `2026`).
     * @return array{error: bool, synced: int} `error` indica si la petición falló;
     *                          `synced` es la cantidad de equipos creados/actualizados.
     */
    public function getTeams(int $league = 1, int $season = 2026): array
    {
        $result = $this->request("/teams?league={$league}&season={$season}");

        if ($result['error'] === true) {
            return ['error' => true, 'synced' => 0];
        }

        $synced = 0;

        foreach ($result['data'] as $entry) {
            $team = $entry['team'] ?? null;

            if (! $team || empty($team['id'])) continue;

            ApiTeam::updateOrCreate(
                ['api_team_id' => $team['id']],
                [
                    'name'     => $team['name'] ?? '',
                    'code'     => $team['code'] ?? null,
                    'country'  => $team['country'] ?? null,
                    'founded'  => $team['founded'] ?? null,
                    'national' => $team['national'] ?? false,
                    'logo'     => $team['logo'] ?? null,
                ]
            );

            $synced++;
        }

        return ['error' => false, 'synced' => $synced];
    }

    /**
     * Obtiene el listado de rondas (rounds) de una liga/temporada llamando a
     * `/fixtures/rounds`. La respuesta del API es un array ordenado de strings
     * (ej. `["Group Stage - 1", ..., "Final"]`). Este método **no** persiste
     * nada: solo devuelve el array. El enlace con `jornadas.api_round` lo hace
     * el comando `app:sincronizar-rondas`.
     *
     * @param  int $league ID externo de la liga en API-Football (default `1` = Mundial).
     * @param  int $season Año de la temporada (default `2026`).
     * @return array{error: bool, rounds: string[]} `error` indica si la petición falló;
     *                     `rounds` es el array de nombres en el orden que devolvió la API.
     */
    public function getRounds(int $league = 1, int $season = 2026): array
    {
        $params = http_build_query([
            'league' => $league,
            'season' => $season,
        ]);

        $result = $this->request("/fixtures/rounds?{$params}");

        if ($result['error'] === true) {
            return ['error' => true, 'rounds' => []];
        }

        $rounds = array_values(array_filter(
            $result['data'],
            fn ($r) => is_string($r) && $r !== ''
        ));

        return ['error' => false, 'rounds' => $rounds];
    }

    /**
     * Sincroniza los partidos (fixtures) de una ronda específica llamando a
     * `/fixtures?league={league}&season={season}&round={round}` y haciendo
     * `updateOrCreate` en `api_fixtures` por `api_fixture_id`. Es idempotente:
     * cada ejecución refresca fecha, estado y marcador, y actualiza
     * `last_synced_at`. Esta tabla es un espejo puro de la API; el enlace con
     * `partidos` se hace en un paso posterior vía `partidos.api_fixture_id`.
     *
     * @param  string $round  Nombre exacto de la ronda según API-Football
     *                        (ej. `'Group Stage - 1'`, `'Round of 16'`, `'Final'`).
     * @param  int    $league ID externo de la liga en API-Football (default `1` = Mundial).
     * @param  int    $season Año de la temporada (default `2026`).
     * @return array{error: bool, synced: int} `error` indica si la petición falló;
     *                        `synced` es la cantidad de fixtures creados/actualizados.
     */
    public function getFixtures(string $round, int $league = 1, int $season = 2026): array
    {
        $params = http_build_query([
            'league' => $league,
            'season' => $season,
            'round'  => $round,
        ]);

        $result = $this->request("/fixtures?{$params}");

        if ($result['error'] === true) {
            return ['error' => true, 'synced' => 0];
        }

        $now    = now();
        $synced = 0;

        foreach ($result['data'] as $entry) {
            if ($this->persistFixturePayload($entry, $league, $season, $round, $now)) {
                $synced++;
            }
        }

        return ['error' => false, 'synced' => $synced];
    }

    /**
     * Refresca un único fixture llamando a `/fixtures?id={apiFixtureId}` y
     * persistiendo el resultado en `api_fixtures` (misma transformación que
     * `getFixtures`). Pensado para el worker que polea el estado de un partido
     * vivo cada N minutos.
     *
     * @param  int $apiFixtureId ID externo del fixture en API-Football.
     * @return array{error: bool, fixture: ?ApiFixture}
     */
    public function getFixture(int $apiFixtureId): array
    {
        $result = $this->request("/fixtures?id={$apiFixtureId}");

        if ($result['error'] === true) {
            return ['error' => true, 'fixture' => null];
        }

        $entry = $result['data'][0] ?? null;

        if (! $entry) {
            return ['error' => true, 'fixture' => null];
        }

        $fixture = $this->persistFixturePayload($entry, 0, 0, '', now());

        return ['error' => false, 'fixture' => $fixture];
    }

    /**
     * Mapea un `entry` del response de `/fixtures` a un `updateOrCreate` en
     * `api_fixtures`. Los parámetros `$league`, `$season` y `$round` solo se
     * usan como fallback cuando la API no los devuelve en el payload
     * (poco común; existen para el caso bulk-por-ronda).
     */
    private function persistFixturePayload(array $entry, int $league, int $season, string $round, $now): ?ApiFixture
    {
        $fixture = $entry['fixture'] ?? null;

        if (! $fixture || empty($fixture['id'])) return null;

        return ApiFixture::updateOrCreate(
            ['api_fixture_id' => $fixture['id']],
            [
                'league_id'        => $entry['league']['id']     ?? $league,
                'season'           => $entry['league']['season'] ?? $season,
                'round'            => $entry['league']['round']  ?? $round,
                'api_home_team_id' => $entry['teams']['home']['id'] ?? null,
                'api_away_team_id' => $entry['teams']['away']['id'] ?? null,
                'date'             => $fixture['date']             ?? null,
                'timezone'         => $fixture['timezone']         ?? null,
                'status_short'     => $fixture['status']['short']  ?? null,
                'status_long'      => $fixture['status']['long']   ?? null,
                'goals_home'       => $entry['goals']['home']      ?? null,
                'goals_away'       => $entry['goals']['away']      ?? null,
                'ft_goals_home'    => $entry['score']['fulltime']['home']  ?? null,
                'ft_goals_away'    => $entry['score']['fulltime']['away']  ?? null,
                'et_goals_home'    => $entry['score']['extratime']['home'] ?? null,
                'et_goals_away'    => $entry['score']['extratime']['away'] ?? null,
                'pt_goals_home'    => $entry['score']['penalty']['home']   ?? null,
                'pt_goals_away'    => $entry['score']['penalty']['away']   ?? null,
                'last_synced_at'   => $now,
            ]
        );
    }

    /**
     * Sincroniza la plantilla de un equipo llamando a `/players/squads?team={id}` y
     * haciendo `updateOrCreate` en `api_players` por `api_player_id`. Marca como
     * `is_active=false` a los jugadores previamente registrados del mismo equipo que
     * ya no aparecen en la respuesta (soft-tracking de bajas, sin borrar histórico).
     * Sale silenciosamente si la API falla o el equipo no tiene plantilla.
     *
     * @param  int  $teamExternalId ID externo del equipo en API-Football (corresponde
     *                              a `api_teams.api_team_id`).
     * @return void No retorna nada; los efectos quedan persistidos en `api_players`.
     */
    public function getTeamSquad(int $teamExternalId)
    {
        $result = $this->request("/players/squads?team={$teamExternalId}");

        if ($result['error'] === true) return;

        $entry   = $result['data'][0] ?? null;
        $players = $entry['players'] ?? [];

        if (empty($players)) return;

        $now          = now();
        $apiPlayerIds = [];

        foreach ($players as $player) {
            ApiPlayer::updateOrCreate(
                ['api_player_id' => $player['id']],
                [
                    'api_team_id'    => $teamExternalId,
                    'name'           => $player['name'],
                    'age'            => $player['age'] ?? null,
                    'number'         => $player['number'] ?? null,
                    'position'       => $player['position'] ?? null,
                    'photo'          => $player['photo'] ?? null,
                    'is_active'      => true,
                    'last_synced_at' => $now,
                ]
            );

            $apiPlayerIds[] = $player['id'];
        }

        ApiPlayer::where('api_team_id', $teamExternalId)
            ->whereNotIn('api_player_id', $apiPlayerIds)
            ->update(['is_active' => false]);
    }
}
