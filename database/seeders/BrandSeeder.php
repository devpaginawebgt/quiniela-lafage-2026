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
                'image' => '/images/brands/tazarol-neuro.png', 
                'line_id' => 1,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],
            [   
                'name' => 'Reversal Flex', 
                'image' => '/images/brands/reversal.png', 
                'line_id' => 1,
                'countries' => [1, 2, 3, 4, 6],
            ],
            [   
                'name' => 'Movisil Max',
                'image' => '/images/brands/dolor/Dolor_osteo_Movisil Max.png', 
                'line_id' => 1,
                'countries' => [1, 3],
            ],
            [
                'name' => 'Movisil Duo',
                'image' => '/images/brands/Dolor_osteo_Movisil Duo.png', 
                'line_id' => 1,
                'countries' => [2, 4, 5, 6],
            ],
            [   
                'name' => 'Movisil HMB',
                'image' => '/images/brands/dolor/Dolor_osteo_Movisil HMB.png', 
                'line_id' => 1,
                'countries' => [1, 2, 3, 4, 5],
            ],
            [   
                'name' => 'Movisil',
                'image' => '/images/brands/Dolor_osteo_Movisil.png', 
                'line_id' => 1,
                'countries' => [6],
            ],

            /* ============================================================ */
            /* LINEA SALUD INTEGRAL */
            /* ============================================================ */
            [   
                'name' => 'Elongal',       
                'image' => '/images/brands/elongal.png', 
                'line_id' => 2,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],
            [   
                'name' => 'Validal',       
                'image' => '/images/brands/validal.png', 
                'line_id' => 2,
                'countries' => [1, 2, 3, 4],
            ],

            /* ============================================================ */
            /* LINEA SALUD FEMENINA */
            /* ============================================================ */
            [   
                'name' => 'Maximum Fam',       
                'image' => '/images/brands/maximum-fam.png', 
                'line_id' => 3,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],
            [   
                'name' => 'Uroberry Fam',       
                'image' => '/images/brands/uroberry-fam.png', 
                'line_id' => 3,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],
            

            /* ============================================================ */
            /* LINEA CARDIOMETABOLICA */
            /* ============================================================ */
            [   
                'name' => 'Fam Empiria',
                'image' => '/images/brands/fam-empiria.png',
                'line_id' => 4,
                'countries' => [1, 2, 3, 4, 6],
            ],
            [   
                'name' => 'Fam Efimax',
                'image' => '/images/brands/fam-efimax.png',
                'line_id' => 4,
                'countries' => [5],
            ],
            [   
                'name' => 'Fam Diaglipitin',
                'image' => '/images/brands/fam-diaglipitin.png', 
                'line_id' => 4,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],


            /* ============================================================ */
            /* LINEA UROLOGICA */
            /* ============================================================ */
            [   
                'name' => 'Momentix Familia',       
                'image' => '/images/brands/momentix-familia.png', 
                'line_id' => 5,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],
            [   
                'name' => 'Serecur Familia',       
                'image' => '/images/brands/serecur-familia.png', 
                'line_id' => 5,
                'countries' => [1, 2, 3, 4, 5, 6],
            ],


            /* ============================================================ */
            /* LINEA DERMATOLOGICA */
            /* ============================================================ */
            [   
                'name' => 'Aminoter',
                'image' => '/images/brands/aminoter.png', 
                'line_id' => 6,
                'countries' => [1, 2, 3, 4, 5],
            ],
            [   
                'name' => 'Onitrac',       
                'image' => '/images/brands/onitrac.png', 
                'line_id' => 6,
                'countries' => [1, 2, 3, 4, 6],
            ],
            [   
                'name' => 'Folcres',       
                'image' => '/images/brands/folcres.png', 
                'line_id' => 6,
                'countries' => [5],
            ],
            [   
                'name' => 'Combinater',       
                'image' => '/images/brands/combinater.png', 
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
