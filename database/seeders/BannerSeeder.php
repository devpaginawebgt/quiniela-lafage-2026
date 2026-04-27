<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'name'      => 'banner-dolor-neurotazarol',
                'url'       => '/images/banners/dolor/Dolor- NeuroTazarol.png',
                'url_web'   => '/images/banners/dolor/Dolor- NeuroTazarol.png',
                'module_id' => 1,
                'line_id'   => 1,
            ],
            [
                'name'      => 'banner-dolor-reversal-flex',
                'url'       => '/images/banners/dolor/Dolor-Reversal Flex.png',
                'url_web'   => '/images/banners/dolor/Dolor-Reversal Flex.png',
                'module_id' => 1,
                'line_id'   => 1,
            ],
            
            // [
            //     'name'      => 'banner-derma-combinater',
            //     'url'       => '/images/banners/Derma_Combinater.png',
            //     'module_id' => 1,
            //     'line_id'   => 6,
            // ],
            // [
            //     'name'      => 'banner-derman-aminoter',
            //     'url'       => '/images/banners/Derman_Aminoter.png',
            //     'module_id' => 1,
            //     'line_id'   => 6,
            // ],
            // [
            //     'name'      => 'banner-salud-femenina-maxiumd3',
            //     'url'       => '/images/banners/Salud Femenina_Maxiumd3.png',
            //     'module_id' => 1,
            //     'line_id'   => 3,
            // ],
            // [
            //     'name'      => 'banner-salud-femenina-uroberry',
            //     'url'       => '/images/banners/Salud Femenina_Uroberry.png',
            //     'module_id' => 1,
            //     'line_id'   => 3,
            // ],
            // [
            //     'name'      => 'banner-salud-integral-elongal',
            //     'url'       => '/images/banners/Salud Integral_Elongal.png',
            //     'module_id' => 1,
            //     'line_id'   => 2,
            // ],
            // [
            //     'name'      => 'banner-salud-integral-validal',
            //     'url'       => '/images/banners/Salud Integral_Validal.png',
            //     'module_id' => 1,
            //     'line_id'   => 2,
            // ],
            // [
            //     'name'      => 'banner-uro-serecur',
            //     'url'       => '/images/banners/Uro_Serecur.png',
            //     'module_id' => 1,
            //     'line_id'   => 5,
            // ],
            // [
            //     'name'      => 'banner-uru-momentix',
            //     'url'       => '/images/banners/Uru_Momentix.png',
            //     'module_id' => 1,
            //     'line_id'   => 5,
            // ],
        ];

        foreach($banners as $banner) {
            Banner::create($banner);
        }
    }
}
