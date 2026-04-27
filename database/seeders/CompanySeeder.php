<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name' => 'Cadena 1', 'country_id' => 1],
            ['name' => 'Cadena 2', 'country_id' => 1],
            ['name' => 'Cadena 3', 'country_id' => 2],
            ['name' => 'Cadena 4', 'country_id' => 2],
        ];

        foreach($companies as $company) {
            Company::create($company);
        }
    }
}
