<?php

namespace Database\Seeders;

use App\Models\Premio;
use Illuminate\Database\Seeder;

class PremioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $base_premios = [
            [
                'posicion'        => 1,
                'titulo_posicion' => 'Primeros 3 lugares',
                'nombre'          => 'Televisión 55" 4K UHD',
                'descripcion'     => 'Televisor de alta definición con conectividad inteligente y control por voz.',
                'imagen'          => '/images/premios/tv.png',
            ],
            [
                'posicion'        => 2,
                'titulo_posicion' => 'Siguientes 3 lugares',
                'nombre'          => 'Teléfono Xiaomi 5G',
                'descripcion'     => 'Smartphone Xiaomi con conectividad 5G, pantalla AMOLED y cámara de alta resolución.',
                'imagen'          => '/images/premios/phone.png',
            ],
            [
                'posicion'        => 3,
                'titulo_posicion' => 'Siguientes 2 lugares',
                'nombre'          => 'Smartwatch deportivo',
                'descripcion'     => 'Reloj inteligente con monitor de ritmo cardíaco y seguimiento de actividad física.',
                'imagen'          => '/images/premios/smartwatch.png',
            ],
        ];

        // Líneas de Doctor (1-6) → user_type_id = 2 (Doctor)
        // Línea de Dependientes (7) → user_type_id = 1 (Dependiente)
        $line_user_type_map = [
            1 => 2,
            2 => 2,
            3 => 2,
            4 => 2,
            5 => 2,
            6 => 2,
            7 => 1,
        ];

        foreach ($line_user_type_map as $line_id => $user_type_id) {
            foreach ($base_premios as $premio) {
                Premio::create(array_merge($premio, [
                    'line_id'      => $line_id,
                    'user_type_id' => $user_type_id,
                ]));
            }
        }

        foreach ($base_premios as $premio) {
            Premio::create(array_merge($premio, [
                'line_id'      => 1,
                'user_type_id' => 3,
            ]));
        }
    }
}
