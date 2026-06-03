<?php

namespace Database\Seeders;

use App\Models\Jornada;
use App\Models\Phase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JornadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $grupos = Phase::where('name', 'Fase de Grupos')->firstOrFail();
        // $eliminatorias = Phase::where('name', 'Fase de Eliminatorias')->firstOrFail();

        // $jornadas = [
        //     [
        //         'phase_id' => $grupos->id,
        //         'name' => '1',
        //         'is_current' => true
        //     ],
        //     [
        //         'phase_id' => $grupos->id,
        //         'name' => '2',
        //         'is_current' => false
        //     ],
        //     [
        //         'phase_id' => $grupos->id,
        //         'name' => '3',
        //         'is_current' => false
        //     ],
        //     [
        //         'phase_id' => $eliminatorias->id,
        //         'name' => 'Dieciseisavos de final',
        //         'is_current' => false
        //     ],
        //     [
        //         'phase_id' => $eliminatorias->id,
        //         'name' => 'Octavos de final',
        //         'is_current' => false
        //     ],
        //     [
        //         'phase_id' => $eliminatorias->id,
        //         'name' => 'Cuartos de final',
        //         'is_current' => false
        //     ],
        //     [
        //         'phase_id' => $eliminatorias->id,
        //         'name' => 'Semifinales',
        //         'is_current' => false
        //     ],
        //     [
        //         'phase_id' => $eliminatorias->id,
        //         'name' => 'Partido por tercer lugar',
        //         'is_current' => false
        //     ],
        //     [
        //         'phase_id' => $eliminatorias->id,
        //         'name' => 'Final',
        //         'is_current' => false
        //     ],
        // ];

        // foreach($jornadas as $jornada) {
        //     Jornada::create($jornada);
        // }

        
    }
}
