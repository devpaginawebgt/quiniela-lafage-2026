<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadios = [
            [
                'nombre' => 'Toronto Stadium',
                'descripcion' => 'Estadio de primer nivel ubicado en Toronto, con capacidad para más de 30,000 espectadores y ampliable para grandes torneos internacionales. Es sede habitual de importantes competiciones de fútbol y eventos culturales. Para el Mundial 2026 será uno de los recintos clave en Canadá, ofreciendo instalaciones modernas y excelente conectividad.',
                'imagen' => '/images/estadios/bmo_field.jpg'
            ],
            [
                'nombre' => 'BC Place Vancouver',
                'descripcion' => 'Icónico estadio con techo retráctil situado en el centro de Vancouver, con capacidad superior a los 50,000 asistentes. Destaca por su diseño arquitectónico y su versatilidad para albergar fútbol, fútbol canadiense y grandes conciertos. Durante el Mundial 2026 será una de las principales sedes en la costa oeste de Canadá.',
                'imagen' => '/images/estadios/bc_place.jpg'
            ],
            [
                'nombre' => 'Estadio Ciudad de México',
                'descripcion' => 'Uno de los estadios más emblemáticos del mundo, con capacidad cercana a los 87,000 espectadores. Ha sido sede de finales históricas de la Copa del Mundo y numerosos eventos internacionales. En 2026 volverá a hacer historia al albergar partidos del torneo, consolidando su legado futbolístico.',
                'imagen' => '/images/estadios/estadio_azteca.jpg'
            ],
            [
                'nombre' => 'Estadio Guadalajara',
                'descripcion' => 'Moderno estadio ubicado en Zapopan, con capacidad para más de 45,000 aficionados. Su diseño vanguardista y tecnología de última generación lo convierten en uno de los recintos más innovadores de México. Será una de las sedes oficiales del Mundial 2026.',
                'imagen' => '/images/estadios/estadio_akron.jpg'
            ],
            [
                'nombre' => 'Estadio Monterrey',
                'descripcion' => 'Estadio de última generación situado en Guadalupe, Nuevo León, con capacidad superior a 50,000 espectadores. Reconocido por su diseño arquitectónico y vista panorámica a las montañas, ofrece instalaciones premium y tecnología avanzada. En el Mundial 2026 será una de las sedes mexicanas más modernas.',
                'imagen' => '/images/estadios/estadio_bbva.jpg'
            ],
            [
                'nombre' => 'Atlanta Stadium',
                'descripcion' => 'Innovador estadio con techo retráctil y capacidad para más de 70,000 personas, ampliable para grandes eventos. Es reconocido por su pantalla circular 360° y su diseño arquitectónico futurista. En 2026 será una de las sedes destacadas en Estados Unidos.',
                'imagen' => '/images/estadios/estadio_mercedes_benz.jpg'
            ],
            [
                'nombre' => 'Boston Stadium',
                'descripcion' => 'Estadio histórico modernizado, con capacidad cercana a los 65,000 espectadores. Es sede habitual de importantes eventos deportivos en la región de Nueva Inglaterra. Para el Mundial 2026 será una de las sedes clave en la costa este de Estados Unidos.',
                'imagen' => '/images/estadios/estadio_gillete.jpg'
            ],
            [
                'nombre' => 'Dallas Stadium',
                'descripcion' => 'Imponente estadio con capacidad superior a 80,000 asistentes y techo retráctil. Destaca por su enorme pantalla central y avanzada infraestructura tecnológica. En el Mundial 2026 albergará partidos de alta relevancia.',
                'imagen' => '/images/estadios/estadio_att.jpg'
            ],
            [
                'nombre' => 'Houston Stadium',
                'descripcion' => 'Estadio cubierto con capacidad para más de 70,000 espectadores, diseñado para ofrecer máxima comodidad y visibilidad. Es sede frecuente de eventos deportivos internacionales y espectáculos masivos. Formará parte de las sedes estadounidenses del Mundial 2026.',
                'imagen' => '/images/estadios/estadio_nrg.jpg'
            ],
            [
                'nombre' => 'Kansas City Stadium',
                'descripcion' => 'Reconocido por el ambiente vibrante que genera su afición, cuenta con capacidad superior a 70,000 personas. Es uno de los estadios con mayor tradición deportiva en Estados Unidos. En 2026 será escenario de partidos mundialistas.',
                'imagen' => '/images/estadios/estadio_arrowhead.jpg'
            ],
            [
                'nombre' => 'Los Angeles Stadium',
                'descripcion' => 'Complejo deportivo ultramoderno con capacidad aproximada de 70,000 espectadores, ampliable para grandes eventos. Destaca por su innovadora cubierta y su pantalla panorámica suspendida. Será una de las sedes más espectaculares del Mundial 2026.',
                'imagen' => '/images/estadios/estadio_sofi.jpg'
            ],
            [
                'nombre' => 'Miami Stadium',
                'descripcion' => 'Estadio contemporáneo con capacidad superior a 65,000 asistentes, ubicado en una zona estratégica del sur de Florida. Ha sido sede de importantes eventos deportivos y espectáculos internacionales. En el Mundial 2026 recibirá partidos clave del torneo.',
                'imagen' => '/images/estadios/estadio_hard_rock.jpg'
            ],
            [
                'nombre' => 'New York/New Jersey Stadium',
                'descripcion' => 'Estadio de gran capacidad, superior a los 80,000 espectadores, situado en el área metropolitana de Nueva York. Es uno de los recintos más importantes de la costa este y sede habitual de eventos internacionales. En 2026 albergará partidos de alto perfil.',
                'imagen' => '/images/estadios/estadio_metlife.jpg'
            ],
            [
                'nombre' => 'Philadelphia Stadium',
                'descripcion' => 'Estadio moderno con capacidad cercana a 70,000 aficionados, reconocido por su fuerte identidad deportiva. Ofrece excelentes instalaciones y experiencia para el público. Será una de las sedes estadounidenses del Mundial 2026.',
                'imagen' => '/images/estadios/estadio_lincoln.jpg'
            ],
            [
                'nombre' => 'San Francisco Bay Area Stadium',
                'descripcion' => 'Estadio sostenible y tecnológicamente avanzado, con capacidad para más de 68,000 espectadores. Destaca por su enfoque ecológico y su infraestructura inteligente. En el Mundial 2026 será una de las sedes representativas del área de la bahía.',
                'imagen' => '/images/estadios/estadio_levi.jpg'
            ],
            [
                'nombre' => 'Seattle Stadium',
                'descripcion' => 'Estadio multifuncional con capacidad aproximada de 69,000 asistentes, famoso por la intensidad de su afición. Su diseño funcional y acústica generan un ambiente único en cada partido. Será una de las sedes oficiales del Mundial 2026 en Estados Unidos.',
                'imagen' => '/images/estadios/estadio_lumen.jpg'
            ]
        ];

        DB::table('estadios')->insert($estadios);
    }
}
