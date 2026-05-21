<?php

namespace Database\Seeders;

use App\Models\Codigo;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CodigoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Codigo::factory(4)->state(['estado' => 1])->create();

        $codigosPorPais = require __DIR__ . '/data/codigos.php';

        foreach ($codigosPorPais as $countryCode => $codigos) {
            $country = Country::where('country_code', $countryCode)->first();

            if (! $country) {
                continue;
            }

            foreach ($codigos as $codigo) {
                Codigo::create([
                    'codigo'     => $codigo,
                    'country_id' => $country->id,
                    'estado'     => 0,
                ]);
            }
        }
    }
}
