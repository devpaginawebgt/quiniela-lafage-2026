<?php

namespace App\Console\Commands;

use App\Http\Services\MatchService;
use App\Models\MatchResultRequest;
use App\Models\Partido;
use App\Models\ResultadoPartido;
use Illuminate\Console\Command;

class AgendarResultadosPartidos extends Command
{
    protected $signature = 'app:agendar-resultados-partidos
                            {--jornada= : Filtrar por ID de Jornada local}
                            {--partido= : Filtrar por ID de un Partido específico}';

    protected $description = 'Sincroniza MatchResultRequest contra los Partidos: crea las que faltan y actualiza `scheduled_at` cuando la fecha del partido cambió.';

    public function handle(MatchService $matchService): int
    {
        $jornadaId = $this->option('jornada');
        $partidoId = $this->option('partido');

        $finishedIds = ResultadoPartido::query()->pluck('partido_id');

        $query = Partido::query()
            ->whereNotNull('api_fixture_id')
            ->whereNotNull('fecha_partido')
            ->whereNotIn('id', $finishedIds);

        if ($jornadaId) {
            $query->where('jornada_id', (int) $jornadaId);
        }

        if ($partidoId) {
            $query->where('id', (int) $partidoId);
        }

        $partidos = $query->orderBy('fecha_partido')->get();

        if ($partidos->isEmpty()) {
            $this->warn('No hay partidos elegibles para agendar.');
            return Command::SUCCESS;
        }

        $this->info("Partidos elegibles: {$partidos->count()}.");

        $created     = 0;
        $rescheduled = 0;
        $unchanged   = 0;
        $skipped     = 0;

        $bar = $this->output->createProgressBar($partidos->count());
        $bar->start();

        foreach ($partidos as $partido) {
            $expectedSchedule = $partido->fecha_partido->copy()->addMinutes(MatchResultRequest::OFFSET_MINUTES);
            $current = MatchResultRequest::where('partido_id', $partido->id)->first();

            if ($current) {
                if (! $current->scheduled_at || ! $current->scheduled_at->equalTo($expectedSchedule)) {
                    $matchService->rescheduleResultRequest($partido);
                    $rescheduled++;
                } else {
                    $unchanged++;
                }

                $bar->advance();
                continue;
            }

            $result = $matchService->scheduleResultRequest($partido);

            if ($result === null) {
                $skipped++;
            } else {
                $created++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->line("  Agendadas (nuevas):     {$created}");
        $this->line("  Reagendadas (fecha):    {$rescheduled}");
        $this->line("  Sin cambios:            {$unchanged}");
        $this->line("  Omitidas (sin datos):   {$skipped}");

        return Command::SUCCESS;
    }
}
