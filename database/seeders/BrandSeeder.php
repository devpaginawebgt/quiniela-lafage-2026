<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [   
                'name' => 'Neuro Tazarol', 
                'image' => '/images/brands/tazarol-neuro.png', 
                'line_id' => 1 
            ],
            [   
                'name' => 'Reversal Flex', 
                'image' => '/images/brands/reversal.png', 
                'line_id' => 1 
            ],
            [   
                'name' => 'Movisil Max',
                'image' => '/images/brands/dolor/Dolor_osteo_Movisil Max.png', 
                'line_id' => 1 
            ],
            [   
                'name' => 'Movisil HMB',
                'image' => '/images/brands/dolor/Dolor_osteo_Movisil HMB.png', 
                'line_id' => 1 
            ],
            // [   
            //     'name' => 'Movisil Duo',
            //     'image' => '/images/brands/Dolor_osteo_Movisil Duo.png', 
            //     'line_id' => 1 
            // ],
            // [   
            //     'name' => 'Movisil',
            //     'image' => '/images/brands/Dolor_osteo_Movisil.png', 
            //     'line_id' => 1 
            // ],
            // [   
            //     'name' => 'Elongal',       
            //     'image' => '/images/brands/elongal.png', 
            //     'line_id' => 2 
            // ],
            // [   
            //     'name' => 'Validal',       
            //     'image' => '/images/brands/validal.png', 
            //     'line_id' => 2 
            // ],
            // [   
            //     'name' => 'Maximum Fam',   
            //     'image' => '', 
            //     'line_id' => 3 
            // ],
            // [   
            //     'name' => 'Uroberry Fam',  
            //     'image' => '', 
            //     'line_id' => 3 
            // ],
        ];

        foreach($brands as $brand) {
            Brand::create($brand);
        }
    }
}
