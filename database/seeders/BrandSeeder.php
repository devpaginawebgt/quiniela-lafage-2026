<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            /* ============================================================ */
            /* LINEA DOLOR */
            /* ============================================================ */
            [   
                'name' => 'Neuro Tazarol', 
                'image' => '/images/brands/dolor/brand5.png', 
                'line_id' => 1,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],
            [   
                'name' => 'Reversal Flex', 
                'image' => '/images/brands/dolor/brand6.png', 
                'line_id' => 1,
                'countries' => [1, 2, 3, 4, 6],
            ],
            [   
                'name' => 'Movisil Max',
                'image' => '/images/brands/dolor/brand4.png', 
                'line_id' => 1,
                'countries' => [1, 3],
            ],
            [
                'name' => 'Movisil Duo',
                'image' => '/images/brands/dolor/brand2.png', 
                'line_id' => 1,
                'countries' => [2, 4, 5, 6],
            ],
            [   
                'name' => 'Movisil HMB',
                'image' => '/images/brands/dolor/brand3.png', 
                'line_id' => 1,
                'countries' => [1, 2, 3, 4, 5],
            ],
            [   
                'name' => 'Movisil',
                'image' => '/images/brands/dolor/brand1.png', 
                'line_id' => 1,
                'countries' => [6],
            ],

            /* ============================================================ */
            /* LINEA SALUD INTEGRAL */
            /* ============================================================ */
            [   
                'name' => 'Elongal',       
                'image' => '/images/brands/salud_integral/brand1.png', 
                'line_id' => 2,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],
            [   
                'name' => 'Validal',       
                'image' => '/images/brands/salud_integral/brand2.png', 
                'line_id' => 2,
                'countries' => [1, 2, 3, 4],
            ],

            /* ============================================================ */
            /* LINEA SALUD FEMENINA */
            /* ============================================================ */
            [   
                'name' => 'Maximum Fam',       
                'image' => '/images/brands/fem/brand2.png', 
                'line_id' => 3,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],
            [   
                'name' => 'Uroberry Fam',       
                'image' => '/images/brands/fem/brand1.png', 
                'line_id' => 3,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],
            

            /* ============================================================ */
            /* LINEA CARDIOMETABOLICA */
            /* ============================================================ */
            [   
                'name' => 'Fam Empiria',
                'image' => '/images/brands/cardio/brand1.png',
                'line_id' => 4,
                'countries' => [1, 2, 3, 4, 6],
            ],
            [   
                'name' => 'Fam Efimax',
                'image' => '/images/brands/cardio/brand3.png',
                'line_id' => 4,
                'countries' => [5],
            ],
            [   
                'name' => 'Fam Diaglipitin',
                'image' => '/images/brands/cardio/brand2.png',
                'line_id' => 4,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],


            /* ============================================================ */
            /* LINEA UROLOGICA */
            /* ============================================================ */
            [   
                'name' => 'Momentix Familia',       
                'image' => '/images/brands/urologica/brand1.png', 
                'line_id' => 5,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],
            [   
                'name' => 'Serecur Familia',       
                'image' => '/images/brands/urologica/brand2.png', 
                'line_id' => 5,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],


            /* ============================================================ */
            /* LINEA DERMATOLOGICA */
            /* ============================================================ */
            [
                'name' => 'Aminoter',
                'image' => '/images/brands/derma/brand2.png',
                'line_id' => 6,
                'countries' => [1, 2, 3, 4, 5],
            ],
            [
                'name' => 'Onitrac',
                // 'image' => '/images/brands/derma/brand1.png', // TODO: reemplazar con imagen real
                'image' => '/images/brands/brand-placeholder.png',
                'line_id' => 6,
                'countries' => [1, 2, 3, 4, 6],
            ],
            [
                'name' => 'Folcres',
                // 'image' => '/images/brands/derma/brand2.png', // TODO: reemplazar con imagen real
                'image' => '/images/brands/brand-placeholder.png',
                'line_id' => 6,
                'countries' => [5],
            ],
            [
                'name' => 'Combinater',
                'image' => '/images/brands/derma/brand1.png',
                'line_id' => 6,
                'countries' => [6],
            ],
        ];

        foreach($brands as $brand) {
            $country_ids = $brand['countries'];

            unset($brand['countries']);

            $db_brand = Brand::create($brand);

            $brand_countries = array_map(function($country_id) use($db_brand) {
                return [
                    'country_id' => $country_id,
                    'brand_id'   => $db_brand->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $country_ids);

            DB::table('brand_country')->insert($brand_countries);
        }
    }
}
