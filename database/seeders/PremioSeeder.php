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
        // Premios para Médicos (Doctores) → user_type_id = 2
        // Aplica a todas las líneas de doctor (1-6)
        $premios_doctores = [
            [
                'posicion'        => 1,
                'titulo_posicion' => '1er lugar',
                'nombre'          => 'Televisión 60"',
                'descripcion'     => 'Televisor de 60 pulgadas de alta definición.',
                'imagen'          => '/images/premios/doctores/Premio 1.jpeg',
            ],
            [
                'posicion'        => 2,
                'titulo_posicion' => '2do lugar',
                'nombre'          => 'Camisola del equipo ganador',
                'descripcion'     => 'Camisola oficial del equipo campeón del Mundial 2026.',
                'imagen'          => '/images/premios/doctores/Premio 2.jpeg',
            ],
        ];

        $lineas_doctor = [1, 2, 3, 4, 5, 6];

        foreach ($lineas_doctor as $line_id) {
            foreach ($premios_doctores as $premio) {
                Premio::create(array_merge($premio, [
                    'line_id'      => $line_id,
                    'user_type_id' => 2,
                ]));
            }
        }

        // Premios para Dependientes → user_type_id = 1, línea 7
        $premios_dependientes = [
            [
                'posicion'        => 1,
                'titulo_posicion' => '1er lugar',
                'nombre'          => 'Giftcard de $200',
                'descripcion'     => 'Tarjeta de regalo por un valor de $200.',
                'imagen'          => '/images/premios/dependientes/Premio 1.jpeg',
            ],
            [
                'posicion'        => 2,
                'titulo_posicion' => '2do lugar',
                'nombre'          => 'Giftcard de $100',
                'descripcion'     => 'Tarjeta de regalo por un valor de $100.',
                'imagen'          => '/images/premios/dependientes/Premio 2.jpeg',
            ],
        ];

        foreach ($premios_dependientes as $premio) {
            Premio::create(array_merge($premio, [
                'line_id'      => 7,
                'user_type_id' => 1,
            ]));
        }

        // Colaboradores (user_type_id = 3) → sin premios por el momento
    }
}
