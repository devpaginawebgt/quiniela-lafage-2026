<?php

namespace App\Console\Commands;

use App\Http\Services\ApiFootballService;
use App\Models\Equipo;
use Illuminate\Console\Command;
use Throwable;

class SincronizarPlantillas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sincronizar-plantillas {--equipo= : ID interno de Equipo a sincronizar (opcional)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza las plantillas (jugadores) de cada Equipo desde API-Football';

    /**
     * Execute the console command.
     */
    public function handle(ApiFootballService $api)
    {
        $query = Equipo::whereNotNull('api_team_id');

        if ($equipoId = $this->option('equipo')) {
            $query->where('id', (int) $equipoId);
        }

        $equipos = $query->get();

        if ($equipos->isEmpty()) {
            $this->warn('No se encontraron equipos con api_team_id asignado.');
            return Command::INVALID;
        }

        $this->info("Sincronizando plantillas de {$equipos->count()} equipos...");

        $ok = 0;
        $fallidos = [];

        $bar = $this->output->createProgressBar($equipos->count());
        $bar->start();

        foreach ($equipos as $equipo) {
            try {
                $api->getTeamSquad((int) $equipo->api_team_id);
                $ok++;
            } catch (Throwable $e) {
                $fallidos[] = "{$equipo->nombre} (api_team_id={$equipo->api_team_id}): {$e->getMessage()}";
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Sincronizados: {$ok}/{$equipos->count()}");

        if (! empty($fallidos)) {
            $this->error('Equipos con error:');
            foreach ($fallidos as $f) {
                $this->line(" - {$f}");
            }
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
