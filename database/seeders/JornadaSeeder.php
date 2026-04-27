<?php

namespace Database\Seeders;

use App\Models\Jornada;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JornadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jornadas = [
            [
                'name' => '1',
                'is_current' => true
            ],
            [
                'name' => '2',
                'is_current' => false 
            ],
            [
                'name' => '3',
                'is_current' => false
            ],
            [
                'name' => 'Dieciseisavos de final',
                'is_current' => false 
            ],
            [
                'name' => 'Octavos de final',
                'is_current' => false 
            ],
            [
                'name' => 'Cuartos de final',
                'is_current' => false 
            ],
            [
                'name' => 'Semifinales',
                'is_current' => false 
            ],
            [
                'name' => 'Partido por tercer lugar',
                'is_current' => false 
            ],
            [
                'name' => 'Final',
                'is_current' => false 
            ],
        ];

        foreach($jornadas as $jornada) {
            Jornada::create($jornada);
        }
    }
}
