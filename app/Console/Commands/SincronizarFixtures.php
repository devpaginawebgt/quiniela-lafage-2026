<?php

namespace App\Console\Commands;

use App\Http\Services\ApiFootballService;
use App\Http\Services\MatchService;
use App\Models\ApiFixture;
use App\Models\Jornada;
use Illuminate\Console\Command;

class SincronizarFixtures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sincronizar-fixtures
                            {--jornada= : ID interno de la Jornada local a sincronizar (obligatorio)}
                            {--league=1 : ID de la liga en API-Football (1 = FIFA World Cup)}
                            {--season=2026 : Temporada}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza los fixtures (api_fixtures) de una Jornada local desde API-Football usando su api_round enlazado, y proyecta los partidos al dominio (partidos + equipo_partidos).';

    /**
     * Execute the console command.
     */
    public function handle(ApiFootballService $api, MatchService $matchService)
    {
        $jornadaId = $this->option('jornada');

        if (! $jornadaId) {
            $this->error('Debes especificar --jornada=<id>.');
            return Command::INVALID;
        }

        $jornada = Jornada::find((int) $jornadaId);

        if (! $jornada) {
            $this->error("No existe Jornada con id {$jornadaId}.");
            return Command::FAILURE;
        }

        if (! $jornada->api_round) {
            $this->error("Jornada [{$jornada->id}] '{$jornada->name}' no tiene api_round asignado.");
            $this->line('Corre primero: php artisan app:sincronizar-rondas');
            return Command::FAILURE;
        }

        $league = (int) $this->option('league');
        $season = (int) $this->option('season');

        $this->info("Sincronizando fixtures de Jornada [{$jornada->id}] '{$jornada->name}' → '{$jornada->api_round}'...");

        $apiResult = $api->getFixtures($jornada->api_round, $league, $season);

        if ($apiResult['error'] === true) {
            $this->error('No se pudieron obtener los fixtures del API.');
            return Command::FAILURE;
        }

        $this->info("Fixtures sincronizados desde API: {$apiResult['synced']}");

        $fixtures = ApiFixture::where('round', $jornada->api_round)
            ->where('league_id', $league)
            ->where('season', $season)
            ->get();

        if ($fixtures->isEmpty()) {
            $this->warn('No hay fixtures en api_fixtures para esta ronda. Nada que proyectar a partidos.');
            return Command::SUCCESS;
        }

        $this->newLine();
        $this->info('Proyectando fixtures a partidos locales...');

        $matchResult = $matchService->getMatches($fixtures);

        if ($matchResult['error'] === true) {
            $this->error('Ocurrió una excepción durante la proyección. Revisa logs.');
        }

        $this->newLine();
        $this->line("  Partidos creados:        {$matchResult['created']}");
        $this->line("  Enlazados (backfill):    {$matchResult['linked']}");
        $this->line("  Fechas actualizadas:     {$matchResult['updated']}");
        $this->line("  Omitidos (sin cambios):  {$matchResult['skipped']}");

        return $matchResult['error'] === true ? Command::FAILURE : Command::SUCCESS;
    }
}
