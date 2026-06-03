<?php

namespace App\Console\Commands;

use App\Http\Services\ApiFootballService;
use App\Models\Jornada;
use Illuminate\Console\Command;

class SincronizarRondas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sincronizar-rondas
                            {--league=1 : ID de la liga en API-Football (1 = FIFA World Cup)}
                            {--season=2026 : Temporada}
                            {--force : Re-enlaza jornadas aunque ya tengan api_round asignado}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obtiene las rondas desde API-Football y las escribe en jornadas.api_round por orden de id ascendente';

    /**
     * Execute the console command.
     */
    public function handle(ApiFootballService $api)
    {
        $league = (int) $this->option('league');
        $season = (int) $this->option('season');
        $force  = (bool) $this->option('force');

        $this->info("Pidiendo /fixtures/rounds?league={$league}&season={$season}...");

        $result = $api->getRounds($league, $season);

        if ($result['error'] === true) {
            $this->error('No se pudieron obtener las rondas del API.');
            return Command::FAILURE;
        }

        $rounds   = $result['rounds'];
        $jornadas = Jornada::orderBy('id')->get();

        $this->info("Rondas del API: " . count($rounds));
        $this->info("Jornadas locales: {$jornadas->count()}");
        $this->newLine();

        $linked    = 0;
        $unchanged = 0;
        $sinRonda  = 0;

        foreach ($jornadas->values() as $i => $jornada) {
            if (! array_key_exists($i, $rounds)) {
                $sinRonda++;
                $this->line("· Jornada [{$jornada->id}] '{$jornada->name}' sin ronda en API (índice {$i}), skip.");
                continue;
            }

            $roundName = $rounds[$i];

            if ($jornada->api_round === $roundName) {
                $unchanged++;
                continue;
            }

            if ($jornada->api_round && ! $force) {
                $this->line("→ Jornada [{$jornada->id}] '{$jornada->name}' ya tiene api_round '{$jornada->api_round}', skip (usa --force para sobrescribir con '{$roundName}').");
                continue;
            }

            $jornada->update(['api_round' => $roundName]);
            $linked++;
            $this->line("✓ Jornada [{$jornada->id}] '{$jornada->name}' → '{$roundName}'");
        }

        $this->newLine();
        $this->info("Enlazadas/actualizadas: {$linked}");
        $this->info("Sin cambios (ya enlazadas correctamente): {$unchanged}");

        if ($sinRonda > 0) {
            $this->warn("Jornadas sin ronda en API (no actualizadas): {$sinRonda}");
        }

        return Command::SUCCESS;
    }
}
