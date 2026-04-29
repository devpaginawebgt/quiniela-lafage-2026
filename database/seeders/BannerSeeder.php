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
            /* ============================================================ */
            /* LINEA DOLOR */
            /* ============================================================ */
            [
                'name'       => 'banner-dolor-neurotazarol',
                'url'        => '/images/banners/mobil/dolor/banner1.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 1,
            ],
            [
                'name'       => 'banner-dolor-reversal',
                'url'        => '/images/banners/mobil/dolor/banner2.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 2,
            ],
            [
                'name'       => 'banner-dolor-movisil-duo',
                'url'        => '/images/banners/mobil/dolor/banner3.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 4,
            ],
            [
                'name'       => 'banner-dolor-movisil-max',
                'url'        => '/images/banners/mobil/dolor/banner4.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 3,
            ],
            [
                'name'       => 'banner-dolor-movisil-hmb',
                'url'        => '/images/banners/mobil/dolor/banner5.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 5,
            ],

            // Web

            [
                'name'       => 'banner-web-dolor-neurotazarol',
                'url'        => '/images/banners/mobil/dolor/banner1.png',
                'url_web'    => '/images/banners/web/dolor/banner1.png',
                'module_id'  => 6,
                'brand_id'   => 1,
            ],
            [
                'name'       => 'banner-web-dolor-reversal',
                'url'        => '/images/banners/mobil/dolor/banner2.png',
                'url_web'    => '/images/banners/web/dolor/banner2.png',
                'module_id'  => 6,
                'brand_id'   => 2,
            ],
            [
                'name'       => 'banner-web-dolor-movisil-duo',
                'url'        => '/images/banners/mobil/dolor/banner3.png',
                'url_web'    => '/images/banners/web/dolor/banner3.png',
                'module_id'  => 6,
                'brand_id'   => 4,
            ],
            [
                'name'       => 'banner-web-dolor-movisil-max',
                'url'        => '/images/banners/mobil/dolor/banner4.png',
                'url_web'    => '/images/banners/web/dolor/banner4.png',
                'module_id'  => 6,
                'brand_id'   => 3,
            ],
            [
                'name'       => 'banner-web-dolor-movisil-hmb',
                'url'        => '/images/banners/mobil/dolor/banner5.png',
                'url_web'    => '/images/banners/web/dolor/banner5.png',
                'module_id'  => 6,
                'brand_id'   => 5,
            ],

            /* ============================================================ */
            /* LINEA SALUD INTEGRAL */
            /* ============================================================ */
            [
                'name'       => 'banner-integral-elongal',
                'url'        => '/images/banners/mobil/salud_integral/banner1.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 7,
            ],
            [
                'name'       => 'banner-integral-validal',
                'url'        => '/images/banners/mobil/salud_integral/banner2.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 8,
            ],

            // Web

            [
                'name'       => 'banner-web-integral-elongal',
                'url'        => '/images/banners/mobil/salud_integral/banner1.png',
                'url_web'    => '/images/banners/web/salud_integral/banner1.png',
                'module_id'  => 6,
                'brand_id'   => 7,
            ],
            [
                'name'       => 'banner-web-integral-validal',
                'url'        => '/images/banners/mobil/salud_integral/banner2.png',
                'url_web'    => '/images/banners/web/salud_integral/banner2.png',
                'module_id'  => 6,
                'brand_id'   => 8,
            ],

            /* ============================================================ */
            /* LINEA SALUD FEMENINA */
            /* ============================================================ */
            [
                'name'       => 'banner-femenina-maximum-fam',
                'url'        => '/images/banners/mobil/fem/banner2.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 9,
            ],
            [
                'name'       => 'banner-femenina-uroberry-fam',
                'url'        => '/images/banners/mobil/fem/banner1.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 10,
            ],

            // Web

            [
                'name'       => 'banner-web-femenina-maximum-fam',
                'url'        => '/images/banners/mobil/fem/banner2.png',
                'url_web'    => '/images/banners/web/fem/banner2.png',
                'module_id'  => 6,
                'brand_id'   => 9,
            ],
            [
                'name'       => 'banner-web-femenina-uroberry-fam',
                'url'        => '/images/banners/mobil/fem/banner1.png',
                'url_web'    => '/images/banners/web/fem/banner1.png',
                'module_id'  => 6,
                'brand_id'   => 10,
            ],

            /* ============================================================ */
            /* LINEA CARDIOMETABOLICA */
            /* ============================================================ */
            [
                'name'       => 'banner-cardio-fam-empiria',
                'url'        => '/images/banners/mobil/cardio/banner2.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 11,
            ],
            [
                'name'       => 'banner-cardio-fam-efimax',
                'url'        => '/images/banners/mobil/cardio/banner3.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 12,
            ],
            [
                'name'       => 'banner-cardio-fam-diaglipitin',
                'url'        => '/images/banners/mobil/cardio/banner1.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 13,
            ],

            // Web

            [
                'name'       => 'banner-web-cardio-fam-empiria',
                'url'        => '/images/banners/mobil/cardio/banner2.png',
                'url_web'    => '/images/banners/web/cardio/banner2.png',
                'module_id'  => 6,
                'brand_id'   => 11,
            ],
            [
                'name'       => 'banner-web-cardio-fam-efimax',
                'url'        => '/images/banners/mobil/cardio/banner3.png',
                'url_web'    => '/images/banners/web/cardio/banner3.png',
                'module_id'  => 6,
                'brand_id'   => 12,
            ],
            [
                'name'       => 'banner-web-cardio-fam-diaglipitin',
                'url'        => '/images/banners/mobil/cardio/banner1.png',
                'url_web'    => '/images/banners/web/cardio/banner1.png',
                'module_id'  => 6,
                'brand_id'   => 13,
            ],

            /* ============================================================ */
            /* LINEA UROLOGICA */
            /* ============================================================ */
            [
                'name'       => 'banner-uro-momentix-fam',
                'url'        => '/images/banners/mobil/uro/banner1.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 14,
            ],
            [
                'name'       => 'banner-uro-serecur-fam',
                'url'        => '/images/banners/mobil/uro/banner2.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 15,
            ],

            // Web

            [
                'name'       => 'banner-web-uro-momentix-fam',
                'url'        => '/images/banners/mobil/uro/banner1.png',
                'url_web'    => '/images/banners/web/uro/banner1.png',
                'module_id'  => 6,
                'brand_id'   => 14,
            ],
            [
                'name'       => 'banner-web-uro-serecur-fam',
                'url'        => '/images/banners/mobil/uro/banner2.png',
                'url_web'    => '/images/banners/web/uro/banner2.png',
                'module_id'  => 6,
                'brand_id'   => 15,
            ],

            /* ============================================================ */
            /* LINEA DERMATOLOGICA */
            /* ============================================================ */
            [
                'name'       => 'banner-derma-aminoter',
                'url'        => '/images/banners/mobil/derma/banner1.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 16,
            ],
            [
                'name'       => 'banner-derma-onitrac',
                'url'        => '/images/banners/mobil/derma/banner3.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 17,
            ],
            [
                'name'       => 'banner-derma-folcres',
                'url'        => '/images/banners/mobil/derma/banner4.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 18,
            ],
            [
                'name'       => 'banner-derma-combinater',
                'url'        => '/images/banners/mobil/derma/banner2.png',
                'url_web'    => null,
                'module_id'  => 1,
                'brand_id'   => 19,
            ],

            // Web
            [
                'name'       => 'banner-web-derma-aminoter',
                'url'        => '/images/banners/mobil/derma/banner1.png',
                'url_web'    => '/images/banners/web/derma/banner1.png',
                'module_id'  => 6,
                'brand_id'   => 16,
            ],
            [
                'name'       => 'banner-web-derma-onitrac',
                'url'        => '/images/banners/mobil/derma/banner3.png',
                'url_web'    => '/images/banners/web/derma/banner3.png',
                'module_id'  => 6,
                'brand_id'   => 17,
            ],
            [
                'name'       => 'banner-web-derma-folcres',
                'url'        => '/images/banners/mobil/derma/banner4.png',
                'url_web'    => '/images/banners/web/derma/banner4.png',
                'module_id'  => 6,
                'brand_id'   => 18,
            ],
            [
                'name'       => 'banner-web-derma-combinater',
                'url'        => '/images/banners/mobil/derma/banner2.png',
                'url_web'    => '/images/banners/web/derma/banner2.png',
                'module_id'  => 6,
                'brand_id'   => 19,
            ],
        ];

        foreach($banners as $banner) {
            Banner::create($banner);
        }
    }
}
