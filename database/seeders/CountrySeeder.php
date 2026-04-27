<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create([
            'name'                   => 'Guatemala',
            'image'                  => '/images/countries/flag-gt.png',
            'country_code'           => 'GT',
            'area_code'              => '502',
            'document_name'          => 'DPI',
            'document_regex'         => '^[0-9]{13}$',
            'document_regex_message' => 'El número de DPI debe contener 13 dígitos.',
            'timezone'               => 'GMT-6',
            'is_active'              => true
        ]);

        Country::create([
            'name'                   => 'Honduras',
            'image'                  => '/images/countries/flag-hn.png',
            'country_code'           => 'HN',
            'area_code'              => '504',
            'document_name'          => 'Cédula',
            'document_regex'         => '^[0-9]{13}$',
            'document_regex_message' => 'El número de cédula debe contener 13 dígitos.',
            'timezone'               => 'GMT-6',
            'is_active'              => true
        ]);

        Country::create([
            'name'                   => 'Panamá',
            'image'                  => '/images/countries/flag-pa.png',
            'country_code'           => 'PA',
            'area_code'              => '507',
            'document_name'          => 'CIP',
            'document_regex'         => '^[A-Z0-9]{6,11}$',
            'document_regex_message' => 'El CIP debe contener entre 6 y 11 caracteres alfanuméricos.',
            'timezone'               => 'GMT-5',
            'is_active'              => false
        ]);

        Country::create([
            'name'                   => 'Nicaragua',
            'image'                  => '/images/countries/flag-ni.png',
            'country_code'           => 'NI',
            'area_code'              => '505',
            'document_name'          => 'Cédula',
            'document_regex'         => '^[0-9]{13}[A-Z]$',
            'document_regex_message' => 'La cédula debe contener 13 dígitos y una letra mayúscula al final.',
            'timezone'               => 'GMT-6',
            'is_active'              => false
        ]);

        Country::create([
            'name'                   => 'Costa Rica',
            'image'                  => '/images/countries/flag-cr.png',
            'country_code'           => 'CR',
            'area_code'              => '506',
            'document_name'          => 'Cédula',
            'document_regex'         => '^[0-9]{9}$',
            'document_regex_message' => 'El número de cédula debe contener 9 dígitos.',
            'timezone'               => 'GMT-6',
            'is_active'              => false
        ]);

        Country::create([
            'name'                   => 'República Dominicana',
            'image'                  => '/images/countries/flag-do.png',
            'country_code'           => 'DO',
            'area_code'              => '1',
            'document_name'          => 'Cédula',
            'document_regex'         => '^[0-9]{11}$',
            'document_regex_message' => 'El número de cédula debe contener 11 dígitos.',
            'timezone'               => 'GMT-4',
            'is_active'              => false
        ]);
    }
}
