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
        $now = now();

        $rows = [
            // [country_id, clerks (1), doctors (2), collaborators (3)]
            [1, 400, 1000, 0],   // Guatemala
            [2, 300, 900,  0],   // El Salvador
            [3, 400, 900,  0],   // Honduras
            [4, 400, 600,  0],   // Nicaragua
            [5, 300, 600,  0],   // Costa Rica
            [6, 200, 350,  0],   // Panamá
            [7, 0,   0,    1],   // Argentina
        ];

        $inserts = [];

        foreach ($rows as [$country_id, $clerks, $doctors, $collaborators]) {
            $inserts[] = [
                'user_type_id' => 1,
                'country_id'   => $country_id,
                'expected'     => $clerks,
                'created_at'   => $now,
                'updated_at'   => $now,
            ];
            $inserts[] = [
                'user_type_id' => 2,
                'country_id'   => $country_id,
                'expected'     => $doctors,
                'created_at'   => $now,
                'updated_at'   => $now,
            ];
            $inserts[] = [
                'user_type_id' => 3,
                'country_id'   => $country_id,
                'expected'     => $collaborators,
                'created_at'   => $now,
                'updated_at'   => $now,
            ];
        }

        DB::table('users_expected')->insert($inserts);
    }
}
