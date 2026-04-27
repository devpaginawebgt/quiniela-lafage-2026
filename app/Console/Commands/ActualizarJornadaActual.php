<?php

namespace App\Console\Commands;

use App\Models\Jornada;
use Illuminate\Console\Command;

class ActualizarJornadaActual extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:actualizar-jornada-actual {jornada}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar la jornada a mostrar por defecto como filtro';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id_jornada = $this->argument('jornada');

        $id_jornada = (int)$id_jornada;

        if (empty($id_jornada)) {

            $this->error('Especifica la jornada a establecer como actual.');
            return Command::INVALID;

        }

        $jornada = Jornada::find($id_jornada);

        if (empty($jornada)) {

            $this->error('No se encontró una jornada con este código.');
            return Command::INVALID;

        }

        if ($jornada->is_current === true) {

            $this->error('Esta jornada ya está establecida como actual.');
            return Command::INVALID;

        }

        $jornada_actual = Jornada::where('is_current', true)->first();

        if (! empty($jornada_actual)) {

            $updated_actual = $jornada_actual->update(['is_current' => false]);

            if (! $updated_actual) {
                $this->error('Ocurrió un error al desactivar la jornada actual.');
                return Command::INVALID;
            }

        }

        $updated = $jornada->update(['is_current' => true]);

        if (! $updated) {

            $this->error('Ocurrió un error al establecer esta jornada como actual.');
            return Command::INVALID;
            
        }

        $this->info('Jornada actual establecida correctamente.');
        return Command::SUCCESS;
        
    }
}
