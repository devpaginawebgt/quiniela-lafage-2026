<?php

namespace Database\Seeders;

use App\Models\Grupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupos = [
            [ 'name' => 'A', 'is_current' => true ],
            [ 'name' => 'B', 'is_current' => false ],
            [ 'name' => 'C', 'is_current' => false ],
            [ 'name' => 'D', 'is_current' => false ],
            [ 'name' => 'E', 'is_current' => false ],
            [ 'name' => 'F', 'is_current' => false ],
            [ 'name' => 'G', 'is_current' => false ],
            [ 'name' => 'H', 'is_current' => false ],
            [ 'name' => 'I', 'is_current' => false ],
            [ 'name' => 'J', 'is_current' => false ],
            [ 'name' => 'K', 'is_current' => false ],
            [ 'name' => 'L', 'is_current' => false ],
        ];

        foreach($grupos as $grupo) {
            Grupo::create($grupo);
        }
    }
}
