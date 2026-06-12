<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Country;
use App\Models\Partido;
use App\Models\PartidoBrandAssignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Country::create([
        //     'name'                   => 'Guatemala',
        //     'image'                  => '/images/countries/flag-gt.png',
        //     'country_code'           => 'GT',
        //     'area_code'              => '502',
        //     'document_name'          => 'DPI',
        //     'document_regex'         => '^[0-9]{13}$',
        //     'document_regex_message' => 'El número de DPI debe contener 13 dígitos.',
        //     'timezone'               => 'America/Guatemala',
        //     'is_active'              => true
        // ]);

        // Country::create([
        //     'name'                   => 'El Salvador',
        //     'image'                  => '/images/countries/flag-sv.png',
        //     'country_code'           => 'SV',
        //     'area_code'              => '503',
        //     'document_name'          => 'DUI',
        //     'document_regex'         => '^[0-9]{9}$',
        //     'document_regex_message' => 'El DUI debe tener 9 dígitos numéricos.',
        //     'timezone'               => 'America/El_Salvador',
        //     'is_active'              => true
        // ]);

        // Country::create([
        //     'name'                   => 'Honduras',
        //     'image'                  => '/images/countries/flag-hn.png',
        //     'country_code'           => 'HN',
        //     'area_code'              => '504',
        //     'document_name'          => 'Cédula',
        //     'document_regex'         => '^[0-9]{13}$',
        //     'document_regex_message' => 'El número de cédula debe contener 13 dígitos.',
        //     'timezone'               => 'America/Tegucigalpa',
        //     'is_active'              => true
        // ]);

        // Country::create([
        //     'name'                   => 'Nicaragua',
        //     'image'                  => '/images/countries/flag-ni.png',
        //     'country_code'           => 'NI',
        //     'area_code'              => '505',
        //     'document_name'          => 'Cédula',
        //     'document_regex'         => '^[0-9]{13}[A-Z]$',
        //     'document_regex_message' => 'La cédula debe contener 13 dígitos y una letra mayúscula al final.',
        //     'timezone'               => 'America/Managua',
        //     'is_active'              => true
        // ]);

        // Country::create([
        //     'name'                   => 'Costa Rica',
        //     'image'                  => '/images/countries/flag-cr.png',
        //     'country_code'           => 'CR',
        //     'area_code'              => '506',
        //     'document_name'          => 'Cédula',
        //     'document_regex'         => '^[0-9]{9}$',
        //     'document_regex_message' => 'El número de cédula debe contener 9 dígitos.',
        //     'timezone'               => 'America/Costa_Rica',
        //     'is_active'              => true
        // ]);

        // Country::create([
        //     'name'                   => 'Panamá',
        //     'image'                  => '/images/countries/flag-pa.png',
        //     'country_code'           => 'PA',
        //     'area_code'              => '507',
        //     'document_name'          => 'CIP',
        //     'document_regex'         => '^[A-Z0-9]{6,11}$',
        //     'document_regex_message' => 'El CIP debe contener entre 6 y 11 caracteres alfanuméricos.',
        //     'timezone'               => 'America/Panama',
        //     'is_active'              => true
        // ]);

        // Country::create([
        //     'name'                   => 'República Dominicana',
        //     'image'                  => '/images/countries/flag-do.png',
        //     'country_code'           => 'DO',
        //     'area_code'              => '1',
        //     'document_name'          => 'Cédula',
        //     'document_regex'         => '^[0-9]{11}$',
        //     'document_regex_message' => 'El número de cédula debe contener 11 dígitos.',
        //     'timezone'               => 'America/Santo_Domingo',
        //     'is_active'              => false
        // ]);

        // $argentina = Country::create([
        //     'name'                   => 'Argentina',
        //     'image'                  => '/images/countries/flag-ar.png',
        //     'country_code'           => 'AR',
        //     'area_code'              => '54',
        //     'document_name'          => 'DNI',
        //     'document_regex'         => '^[0-9]{7,8}$',
        //     'document_regex_message' => 'El DNI debe contener entre 7 y 8 dígitos numéricos.',
        //     'timezone'               => 'America/Argentina/Buenos_Aires',
        //     'is_active'              => true
        // ]);

        // 1) Asignar TODAS las marcas (todas las líneas, incluida la línea de
        //    Dependientes que agrupa medicamentos) al país Argentina.
        // $brands = Brand::withoutGlobalScopes()->get(['id', 'line_id']);

        // $now = now();

        // $brand_country_rows = $brands
        //     ->map(fn (Brand $brand) => [
        //         'country_id' => $argentina->id,
        //         'brand_id'   => $brand->id,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ])
        //     ->all();

        // if (! empty($brand_country_rows)) {
        //     DB::table('brand_country')->insert($brand_country_rows);
        // }

        // 2) Por cada partido existente, generar la asignación marca/línea
        //    para Argentina (una marca aleatoria por línea), replicando la
        //    lógica de PartidoService::addPartidoBrands pero acotada a este país.
        // $brands_by_line = $brands->groupBy('line_id');

        // $assignments = [];

        // Partido::select('id')->orderBy('id')->each(function (Partido $partido) use ($brands_by_line, $argentina, $now, &$assignments) {
        //     $brands_by_line->each(function (Collection $group, $line_id) use ($partido, $argentina, $now, &$assignments) {
        //         $assignments[] = [
        //             'partido_id' => $partido->id,
        //             'country_id' => $argentina->id,
        //             'line_id'    => $line_id,
        //             'brand_id'   => $group->random()->id,
        //             'created_at' => $now,
        //             'updated_at' => $now,
        //         ];
        //     });
        // });

        // if (! empty($assignments)) {
        //     foreach (array_chunk($assignments, 500) as $chunk) {
        //         PartidoBrandAssignment::insert($chunk);
        //     }
        // }

        $sv = Country::find(2);

        if (!$sv) return;

        $sv->update([
            'document_regex' => '^[0-9]{8}-[0-9]$',
            'document_regex_message' => 'El número de DUI debe tener 8 dígitos numéricos seguido de un guión y otro dígito numérico.',
        ]);
    }
}
