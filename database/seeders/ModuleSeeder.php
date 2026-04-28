<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [ 'name' => 'App - Próximos Partidos', 'code' => 'app-proximos-partidos' ],
            [ 'name' => 'App - Mis Pronósticos',   'code' => 'app-mis-pronosticos' ],
            [ 'name' => 'App - Calendario',        'code' => 'app-calendario' ],
            [ 'name' => 'App - Grupos',            'code' => 'app-grupos' ],
            [ 'name' => 'App - Jornadas',          'code' => 'app-jornadas' ],

            [ 'name' => 'Web - Próximos Partidos', 'code' => 'web-proximos-partidos' ],
            [ 'name' => 'Web - Mis Pronósticos',   'code' => 'web-mis-pronosticos' ],
            [ 'name' => 'Web - Calendario',        'code' => 'web-calendario' ],
            [ 'name' => 'Web - Grupos',            'code' => 'web-grupos' ],
            [ 'name' => 'Web - Jornadas',          'code' => 'web-jornadas' ],
        ]; 

        foreach($modules as $module) {
            Module::create($module);
        }
    }
}
