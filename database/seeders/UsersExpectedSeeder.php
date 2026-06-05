<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersExpectedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users_expected')->truncate();

        $now = now();

        // Dependientes (user_type_id=1, line_id=7).
        // [country_id, expected]
        $dependientes = [
            [1, 400], // Guatemala
            [2, 300], // El Salvador
            [5, 300], // Costa Rica
            [3, 400], // Honduras
            [4, 400], // Nicaragua
            [6, 200], // Panamá
        ];

        // Colaboradores (user_type_id=3, sin línea específica).
        // [country_id, expected]
        $colaboradores = [
            [1, 55], // Guatemala
            [2, 26], // El Salvador
            [5, 16], // Costa Rica
            [3, 25], // Honduras
            [4, 23], // Nicaragua
            [6, 11], // Panamá
        ];

        // Médicos (user_type_id=2), desglosado por línea.
        // [country_id, dolor(1), salud_integral(2), salud_femenina(3), cardiometabolica(4), urologica(5), dermatologica(6)]
        $medicos = [
            [1, 220, 100, 220, 220, 180, 60], // Guatemala
            [2, 198,  90, 198, 198, 162, 54], // El Salvador
            [5, 132,  60, 132, 132, 108, 36], // Costa Rica
            [3, 198,  90, 198, 198, 162, 54], // Honduras
            [4, 132,  60, 132, 132, 108, 36], // Nicaragua
            [6,  77,  35,  77,  77,  63, 21], // Panamá
        ];

        $inserts = [];

        foreach ($dependientes as [$country_id, $expected]) {
            $inserts[] = [
                'user_type_id' => 1,
                'country_id'   => $country_id,
                'line_id'      => 7,
                'expected'     => $expected,
                'created_at'   => $now,
                'updated_at'   => $now,
            ];
        }

        foreach ($colaboradores as [$country_id, $expected]) {
            $inserts[] = [
                'user_type_id' => 3,
                'country_id'   => $country_id,
                'line_id'      => null,
                'expected'     => $expected,
                'created_at'   => $now,
                'updated_at'   => $now,
            ];
        }

        foreach ($medicos as [$country_id, $dolor, $integral, $femenina, $cardio, $urologica, $dermato]) {
            foreach ([1 => $dolor, 2 => $integral, 3 => $femenina, 4 => $cardio, 5 => $urologica, 6 => $dermato] as $line_id => $expected) {
                $inserts[] = [
                    'user_type_id' => 2,
                    'country_id'   => $country_id,
                    'line_id'      => $line_id,
                    'expected'     => $expected,
                    'created_at'   => $now,
                    'updated_at'   => $now,
                ];
            }
        }

        if (!empty($inserts)) {
            DB::table('users_expected')->insert($inserts);
        }
    }
}
