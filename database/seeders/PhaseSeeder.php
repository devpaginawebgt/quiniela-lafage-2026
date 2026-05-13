<?php

namespace Database\Seeders;

use App\Models\Phase;
use Illuminate\Database\Seeder;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phases = [
            ['name' => 'Fase de Grupos'],
            ['name' => 'Fase de Eliminatorias'],
        ];

        foreach ($phases as $phase) {
            Phase::create($phase);
        }
    }
}
