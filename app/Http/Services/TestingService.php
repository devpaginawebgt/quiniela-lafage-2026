<?php

namespace App\Http\Services;

use App\Models\Partido;
use App\Models\ResultadoPartido;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class TestingService
{

    public static function equipos()
    {

        return [

            [
                'id' => 1,
                'nombre' => 'México',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'México cuenta con una larga tradición futbolística y es uno de los equipos más fuertes de la Concacaf. Ha participado en múltiples Copas del Mundo. Su afición es una de las más apasionadas del mundo.',
                'grupo' => 1
            ],
            [
                'id' => 2,
                'nombre' => 'Egipto',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Egipto es una potencia histórica del fútbol africano. Ha ganado múltiples Copas Africanas de Naciones. Es reconocido por su estilo técnico y competitivo.',
                'grupo' => 1
            ],
            [
                'id' => 3,
                'nombre' => 'Suiza',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Suiza es una selección europea constante y disciplinada. Suele destacar por su orden táctico. Ha tenido participaciones sólidas en torneos internacionales.',
                'grupo' => 1
            ],
            [
                'id' => 4,
                'nombre' => 'Corea del Sur',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Corea del Sur es una de las selecciones más fuertes de Asia. Se caracteriza por su velocidad y resistencia física. Ha sido protagonista frecuente en Copas del Mundo.',
                'grupo' => 1
            ],

            [
                'id' => 5,
                'nombre' => 'Canadá',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Canadá ha crecido notablemente en el fútbol internacional en los últimos años. Destaca por su juventud y dinamismo. Es una selección emergente de la Concacaf.',
                'grupo' => 2
            ],
            [
                'id' => 6,
                'nombre' => 'Senegal',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Senegal es una de las selecciones más fuertes de África. Combina potencia física con talento individual. Ha logrado importantes resultados a nivel mundial.',
                'grupo' => 2
            ],
            [
                'id' => 7,
                'nombre' => 'Francia',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Francia es una potencia mundial del fútbol. Cuenta con una generación constante de grandes talentos. Ha ganado múltiples títulos internacionales.',
                'grupo' => 2
            ],
            [
                'id' => 8,
                'nombre' => 'Arabia Saudita',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Arabia Saudita es una selección habitual en torneos internacionales. Destaca por su disciplina táctica. Es una de las más representativas de Asia.',
                'grupo' => 2
            ],

            [
                'id' => 9,
                'nombre' => 'Estados Unidos',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Estados Unidos ha desarrollado una estructura sólida en el fútbol moderno. Su selección combina juventud y físico. Es un referente de la Concacaf.',
                'grupo' => 3
            ],
            [
                'id' => 10,
                'nombre' => 'Gales',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Gales es una selección europea competitiva. Ha logrado buenos resultados en torneos recientes. Destaca por su juego colectivo.',
                'grupo' => 3
            ],
            [
                'id' => 11,
                'nombre' => 'Uruguay',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Uruguay es una de las selecciones más históricas del fútbol mundial. Se caracteriza por su garra y mentalidad competitiva. Ha ganado múltiples títulos internacionales.',
                'grupo' => 3
            ],
            [
                'id' => 12,
                'nombre' => 'Australia',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Australia es una selección fuerte físicamente y muy ordenada. Compite en la confederación asiática. Ha sido constante en competiciones internacionales.',
                'grupo' => 3
            ],

            [
                'id' => 13,
                'nombre' => 'Brasil',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Brasil es la selección más laureada del fútbol mundial. Es reconocida por su talento y juego ofensivo. Siempre es favorita en cualquier torneo.',
                'grupo' => 4
            ],
            [
                'id' => 14,
                'nombre' => 'Irán',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Irán es una selección competitiva de Asia. Destaca por su orden defensivo. Ha participado en varias Copas del Mundo.',
                'grupo' => 4
            ],
            [
                'id' => 15,
                'nombre' => 'Ucrania',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Ucrania es una selección europea con buen nivel técnico. Ha logrado actuaciones destacadas en torneos internacionales. Su estilo es equilibrado.',
                'grupo' => 4
            ],
            [
                'id' => 16,
                'nombre' => 'Argelia',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Argelia es una selección fuerte del continente africano. Combina talento y velocidad. Ha tenido buenas participaciones mundialistas.',
                'grupo' => 4
            ],

            [
                'id' => 17,
                'nombre' => 'Bélgica',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Bélgica ha sido una de las selecciones más competitivas de Europa. Cuenta con jugadores de alto nivel. Ha estado entre las mejores del ranking mundial.',
                'grupo' => 5
            ],
            [
                'id' => 18,
                'nombre' => 'Costa Rica',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Costa Rica es una selección destacada de Centroamérica. Es conocida por su orden defensivo. Ha sorprendido en torneos internacionales.',
                'grupo' => 5
            ],
            [
                'id' => 19,
                'nombre' => 'Marruecos',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Marruecos es una selección africana en constante crecimiento. Destaca por su técnica y velocidad. Ha logrado actuaciones históricas recientemente.',
                'grupo' => 5
            ],
            [
                'id' => 20,
                'nombre' => 'Japón',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Japón es una de las selecciones más fuertes de Asia. Se caracteriza por su disciplina y juego colectivo. Es habitual en Copas del Mundo.',
                'grupo' => 5
            ],

            [
                'id' => 21,
                'nombre' => 'España',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'España es una potencia histórica del fútbol europeo. Destaca por su estilo de posesión. Ha ganado importantes títulos internacionales.',
                'grupo' => 6
            ],
            [
                'id' => 22,
                'nombre' => 'Nueva Zelanda',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Nueva Zelanda representa a Oceanía en el fútbol internacional. Se caracteriza por su fortaleza física. Compite regularmente en torneos clasificatorios.',
                'grupo' => 6
            ],
            [
                'id' => 23,
                'nombre' => 'Colombia',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Colombia es una selección sudamericana con gran talento ofensivo. Ha tenido generaciones destacadas. Es reconocida por su fútbol vistoso.',
                'grupo' => 6
            ],
            [
                'id' => 24,
                'nombre' => 'Polonia',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Polonia es una selección europea competitiva. Destaca por su fortaleza física. Ha participado en numerosos torneos internacionales.',
                'grupo' => 6
            ],

            [
                'id' => 25,
                'nombre' => 'Inglaterra',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Inglaterra es una de las selecciones más históricas del fútbol. Cuenta con una liga muy competitiva. Siempre es candidata en torneos grandes.',
                'grupo' => 7
            ],
            [
                'id' => 26,
                'nombre' => 'Nigeria',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Nigeria es una potencia del fútbol africano. Destaca por su velocidad y talento físico. Ha sido protagonista en varios mundiales.',
                'grupo' => 7
            ],
            [
                'id' => 27,
                'nombre' => 'Chile',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Chile es una selección sudamericana muy competitiva. Ha ganado títulos continentales importantes. Su juego es intenso y dinámico.',
                'grupo' => 7
            ],
            [
                'id' => 28,
                'nombre' => 'Serbia',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Serbia es una selección europea sólida. Destaca por su juego físico y ordenado. Ha tenido buenas participaciones internacionales.',
                'grupo' => 7
            ],

            [
                'id' => 29,
                'nombre' => 'Argentina',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Argentina es una de las selecciones más exitosas del fútbol mundial. Reconocida por su talento histórico. Siempre es protagonista en torneos internacionales.',
                'grupo' => 8
            ],
            [
                'id' => 30,
                'nombre' => 'Qatar',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Qatar ha desarrollado su fútbol de manera acelerada. Ha sido anfitrión de grandes eventos. Busca consolidarse a nivel internacional.',
                'grupo' => 8
            ],
            [
                'id' => 31,
                'nombre' => 'Croacia',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Croacia es una selección europea muy competitiva. Ha logrado resultados históricos en mundiales. Destaca por su calidad técnica.',
                'grupo' => 8
            ],
            [
                'id' => 32,
                'nombre' => 'Ecuador',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Ecuador es una selección sudamericana fuerte físicamente. Ha tenido participaciones destacadas en mundiales. Su juego es intenso y directo.',
                'grupo' => 8
            ],

            [
                'id' => 33,
                'nombre' => 'Portugal',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Portugal es una selección europea de gran nivel. Ha contado con jugadores históricos. Es habitual candidata en torneos importantes.',
                'grupo' => 9
            ],
            [
                'id' => 34,
                'nombre' => 'Panamá',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Panamá es una selección competitiva de Centroamérica. Ha logrado clasificaciones históricas. Su crecimiento ha sido constante.',
                'grupo' => 9
            ],
            [
                'id' => 35,
                'nombre' => 'Países Bajos',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Países Bajos es una selección histórica del fútbol europeo. Destaca por su estilo ofensivo. Ha sido subcampeona mundial en varias ocasiones.',
                'grupo' => 9
            ],
            [
                'id' => 36,
                'nombre' => 'Ghana',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Ghana es una selección africana muy competitiva. Destaca por su potencia física. Ha tenido actuaciones memorables en mundiales.',
                'grupo' => 9
            ],

            [
                'id' => 37,
                'nombre' => 'Italia',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Italia es una de las selecciones más exitosas del fútbol mundial. Reconocida por su solidez defensiva. Ha ganado múltiples Copas del Mundo.',
                'grupo' => 10
            ],
            [
                'id' => 38,
                'nombre' => 'Irak',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Irak es una selección representativa de Asia. Ha tenido participaciones destacadas a nivel regional. Su fútbol es competitivo.',
                'grupo' => 10
            ],
            [
                'id' => 39,
                'nombre' => 'Dinamarca',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Dinamarca es una selección europea muy ordenada. Destaca por su juego colectivo. Ha logrado buenos resultados internacionales.',
                'grupo' => 10
            ],
            [
                'id' => 40,
                'nombre' => 'Paraguay',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Paraguay es una selección sudamericana fuerte y combativa. Se caracteriza por su solidez defensiva. Ha tenido buenas actuaciones mundialistas.',
                'grupo' => 10
            ],

            [
                'id' => 41,
                'nombre' => 'Alemania',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Alemania es una potencia histórica del fútbol mundial. Destaca por su disciplina y eficacia. Ha ganado múltiples títulos internacionales.',
                'grupo' => 11
            ],
            [
                'id' => 42,
                'nombre' => 'Jamaica',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Jamaica es una selección caribeña competitiva. Destaca por su velocidad. Ha tenido participaciones internacionales destacadas.',
                'grupo' => 11
            ],
            [
                'id' => 43,
                'nombre' => 'Perú',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Perú es una selección sudamericana con tradición futbolística. Destaca por su técnica. Ha tenido buenas participaciones continentales.',
                'grupo' => 11
            ],
            [
                'id' => 44,
                'nombre' => 'Suecia',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Suecia es una selección europea sólida. Se caracteriza por su juego físico. Ha sido constante en torneos internacionales.',
                'grupo' => 11
            ],

            [
                'id' => 45,
                'nombre' => 'Uruguay',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Uruguay es una selección histórica del fútbol mundial. Conocida por su garra y tradición. Siempre compite al máximo nivel.',
                'grupo' => 12
            ],
            [
                'id' => 46,
                'nombre' => 'Túnez',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Túnez es una selección africana competitiva. Destaca por su orden táctico. Ha participado en varios mundiales.',
                'grupo' => 12
            ],
            [
                'id' => 47,
                'nombre' => 'Austria',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Austria es una selección europea con buen nivel competitivo. Destaca por su organización. Ha tenido participaciones internacionales sólidas.',
                'grupo' => 12
            ],
            [
                'id' => 48,
                'nombre' => 'Camerún',
                'imagen' => '/images/selecciones/argentina.jpg',
                'descripcion' => 'Camerún es una de las selecciones más históricas de África. Destaca por su potencia física. Ha sido protagonista en mundiales.',
                'grupo' => 12
            ],

        ];

    }
    
    public static function jornadaUno()
    {
        $fecha_inicial = Carbon::create(2026, 3, 1, 0, 0, 0, 'UTC');

        return [
            // =========================
            // JORNADA 1 (base +0 dias)
            // 24 partidos -> 6 dias (4 por dia)
            // =========================
            [
                'id' => 1,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(0)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 1, 
                'equipo_2' => 2, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 1,
            ],
            [
                'id' => 2,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(0)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 3, 
                'equipo_2' => 4, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],
            [
                'id' => 3,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(0)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 5, 
                'equipo_2' => 6, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 5,
            ],
            [
                'id' => 4,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(0)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 7, 
                'equipo_2' => 8, 
                'goles_equipo_1' => 3,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 7,
            ],

            [
                'id' => 5,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(1)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 9, 
                'equipo_2' => 10, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 9,
            ],
            [
                'id' => 6,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(1)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 11, 
                'equipo_2' => 12, 
                'goles_equipo_1' => 3,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 11,
            ],
            [
                'id' => 7,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(1)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 13, 
                'equipo_2' => 14, 
                'goles_equipo_1' => 4,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 13,
            ],
            [
                'id' => 8,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(1)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 15, 
                'equipo_2' => 16, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 15,
            ],

            [
                'id' => 9,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(2)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 17, 
                'equipo_2' => 18, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 17,
            ],
            [
                'id' => 10,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(2)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 19, 
                'equipo_2' => 20, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 19,
            ],
            [
                'id' => 11,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(2)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 21, 
                'equipo_2' => 22, 
                'goles_equipo_1' => 3,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 21,
            ],
            [
                'id' => 12,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(2)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 23, 
                'equipo_2' => 24, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 23,
            ],

            [
                'id' => 13,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(3)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 25, 
                'equipo_2' => 26, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 25,
            ],
            [
                'id' => 14,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(3)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 27, 
                'equipo_2' => 28, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],
            [
                'id' => 15,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(3)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 29, 
                'equipo_2' => 30, 
                'goles_equipo_1' => 3,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 29,
            ],
            [
                'id' => 16,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(3)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 31, 
                'equipo_2' => 32, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 31,
            ],

            [
                'id' => 17,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(4)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 33, 
                'equipo_2' => 34, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 33,
            ],
            [
                'id' => 18,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(4)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 35, 
                'equipo_2' => 36, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 35,
            ],
            [
                'id' => 19,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(4)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 37, 
                'equipo_2' => 38, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 37,
            ],
            [
                'id' => 20,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(4)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 39, 
                'equipo_2' => 40, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 39,
            ],

            [
                'id' => 21,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(5)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 41, 
                'equipo_2' => 42, 
                'goles_equipo_1' => 3,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 41,
            ],
            [
                'id' => 22,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(5)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 43, 
                'equipo_2' => 44, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],
            [
                'id' => 23,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(5)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 45, 
                'equipo_2' => 46, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 45,
            ],
            [
                'id' => 24,
                'fase' => 'GRUPOS',
                'jornada_id' => 1,
                'fecha_partido' => $fecha_inicial->copy()->addDays(5)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 47, 
                'equipo_2' => 48, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 47,
            ],
        ];
    }

    public static function jornadaDos()
    {
        $fecha_inicial = Carbon::create(2026, 3, 1, 0, 0, 0, 'UTC');

        return [
            // =========================
            // JORNADA 2 (base +14 dias)
            // =========================
            [
                'id' => 25,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(14)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 1, 
                'equipo_2' => 3, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],
            [
                'id' => 26,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(14)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 4, 
                'equipo_2' => 2, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 4,
            ],
            [
                'id' => 27,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(14)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 5, 
                'equipo_2' => 7, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 7,
            ],
            [
                'id' => 28,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(14)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 8, 
                'equipo_2' => 6, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 6,
            ],

            [
                'id' => 29,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(15)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 9, 
                'equipo_2' => 11, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],
            [
                'id' => 30,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(15)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 12, 
                'equipo_2' => 10, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],
            [
                'id' => 31,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(15)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 13, 
                'equipo_2' => 15, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 13,
            ],
            [
                'id' => 32,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(15)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 16, 
                'equipo_2' => 14, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],

            [
                'id' => 33,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(16)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 17, 
                'equipo_2' => 19, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],
            [
                'id' => 34,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(16)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 20, 
                'equipo_2' => 18, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 20,
            ],
            [
                'id' => 35,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(16)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 21, 
                'equipo_2' => 23, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 21,
            ],
            [
                'id' => 36,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(16)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 24, 
                'equipo_2' => 22, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 24,
            ],

            [
                'id' => 37,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(17)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 25, 
                'equipo_2' => 27, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 25,
            ],
            [
                'id' => 38,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(17)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 28, 
                'equipo_2' => 26, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 28,
            ],
            [
                'id' => 39,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(17)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 29, 
                'equipo_2' => 31, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],
            [
                'id' => 40,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(17)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 32, 
                'equipo_2' => 30, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 32,
            ],

            [
                'id' => 41,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(18)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 33, 
                'equipo_2' => 35, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],
            [
                'id' => 42,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(18)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 36, 
                'equipo_2' => 34, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 36,
            ],
            [
                'id' => 43,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(18)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 37, 
                'equipo_2' => 39, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 37,
            ],
            [
                'id' => 44,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(18)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 40, 
                'equipo_2' => 38, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 40,
            ],

            [
                'id' => 45,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(19)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 41, 
                'equipo_2' => 43, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 41,
            ],
            [
                'id' => 46,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(19)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 44, 
                'equipo_2' => 42, 
                'goles_equipo_1' => 2,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 44,
            ],
            [
                'id' => 47,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(19)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 45, 
                'equipo_2' => 47, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 45,
            ],
            [
                'id' => 48,
                'fase' => 'GRUPOS',
                'jornada_id' => 2,
                'fecha_partido' => $fecha_inicial->copy()->addDays(19)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 48, 
                'equipo_2' => 46, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],
        ];
    }

    public static function jornadaTres()
    {
        $fecha_inicial = Carbon::create(2026, 3, 1, 0, 0, 0, 'UTC');

        return [
            // =========================
            // JORNADA 3 (base +28 dias)
            // =========================
            [
                'id' => 49,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(28)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 4, 
                'equipo_2' => 1, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 1,
            ],
            [
                'id' => 50,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(28)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 2, 
                'equipo_2' => 3, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 3,
            ],
            [
                'id' => 51,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(28)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 8, 
                'equipo_2' => 5, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 5,
            ],
            [
                'id' => 52,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(28)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 6, 
                'equipo_2' => 7, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],

            [
                'id' => 53,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(29)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 12, 
                'equipo_2' => 9, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 9,
            ],
            [
                'id' => 54,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(29)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 10, 
                'equipo_2' => 11, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 11,
            ],
            [
                'id' => 55,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(29)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 16, 
                'equipo_2' => 13, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 3,
                'equipo_ganador_id' => 13,
            ],
            [
                'id' => 56,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(29)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 14, 
                'equipo_2' => 15, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 15,
            ],

            [
                'id' => 57,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(30)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 20, 
                'equipo_2' => 17, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 17,
            ],
            [
                'id' => 58,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(30)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 18, 
                'equipo_2' => 19, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 19,
            ],
            [
                'id' => 59,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(30)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 24, 
                'equipo_2' => 21, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 21,
            ],
            [
                'id' => 60,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(30)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 22, 
                'equipo_2' => 23, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 3,
                'equipo_ganador_id' => 23,
            ],

            [
                'id' => 61,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(31)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 28, 
                'equipo_2' => 25, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 25,
            ],
            [
                'id' => 62,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(31)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 26, 
                'equipo_2' => 27, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 27,
            ],
            [
                'id' => 63,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(31)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 32, 
                'equipo_2' => 29, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 29,
            ],
            [
                'id' => 64,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(31)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 30, 
                'equipo_2' => 31, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 3,
                'equipo_ganador_id' => 31,
            ],

            [
                'id' => 65,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(32)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 36, 
                'equipo_2' => 33, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 33,
            ],
            [
                'id' => 66,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(32)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 34, 
                'equipo_2' => 35, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 4,
                'equipo_ganador_id' => 35,
            ],
            [
                'id' => 67,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(32)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 40, 
                'equipo_2' => 37, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 37,
            ],
            [
                'id' => 68,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(32)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 38, 
                'equipo_2' => 39, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 39,
            ],

            [
                'id' => 69,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(33)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 44, 
                'equipo_2' => 41, 
                'goles_equipo_1' => 1,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => null,
            ],
            [
                'id' => 70,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(33)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 42, 
                'equipo_2' => 43, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 43,
            ],
            [
                'id' => 71,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(33)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 48, 
                'equipo_2' => 45, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 45,
            ],
            [
                'id' => 72,
                'fase' => 'GRUPOS',
                'jornada_id' => 3,
                'fecha_partido' => $fecha_inicial->copy()->addDays(33)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 46, 
                'equipo_2' => 47, 
                'goles_equipo_1' => 0,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 47,
            ],
        ];
    }

    public static function dieciseisavos()
    {
        $fecha_inicial = Carbon::create(2026, 3, 1, 0, 0, 0, 'UTC');

        return [
            // DECISEISAVOS
            [
                'id' => 73,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(36)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 35, 
                'goles_equipo_1' => 3,
                'equipo_2' => 9,  
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 35,
            ],
            [
                'id' => 74,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(36)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 29, 
                'goles_equipo_1' => 2,
                'equipo_2' => 27, 
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 29,
            ],
            [
                'id' => 75,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(36)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 25, 
                'goles_equipo_1' => 3,
                'equipo_2' => 32, 
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 25,
            ],
            [
                'id' => 76,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(36)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 7, 
                'goles_equipo_1' => 2,
                'equipo_2' => 24,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 7,
            ],

            [
                'id' => 77,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(37)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 21,
                'goles_equipo_1' => 4,
                'equipo_2' => 6, 
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 21,
            ],
            [
                'id' => 78,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(37)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 13,
                'goles_equipo_1' => 3,
                'equipo_2' => 20,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 13,
            ],
            [
                'id' => 79,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(37)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 41,
                'goles_equipo_1' => 2,
                'equipo_2' => 15,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 41,
            ],
            [
                'id' => 80,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(37)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 33,
                'goles_equipo_1' => 2,
                'equipo_2' => 3, 
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 33,
            ],

            [
                'id' => 81,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(38)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 37,
                'goles_equipo_1' => 1,
                'equipo_2' => 44,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 37,
            ],
            [
                'id' => 82,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(38)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 17,
                'goles_equipo_1' => 2,
                'equipo_2' => 28,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 17,
            ],
            [
                'id' => 83,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(38)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 45,
                'goles_equipo_1' => 2,
                'equipo_2' => 40,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 45,
            ],
            [
                'id' => 84,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(38)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 31,
                'goles_equipo_1' => 1,
                'equipo_2' => 47,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 31,
            ],

            [
                'id' => 85,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(39)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 1,
                'goles_equipo_1' => 2,
                'equipo_2' => 43,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 1,
            ],
            [
                'id' => 86,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(39)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 23,
                'goles_equipo_1' => 3,
                'equipo_2' => 39,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 23,
            ],
            [
                'id' => 87,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(39)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 19,
                'goles_equipo_1' => 1,
                'equipo_2' => 4, 
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 19,
            ],
            [
                'id' => 88,
                'fase' => 'DIECISEISAVOS',
                'jornada_id' => 4,
                'fecha_partido' => $fecha_inicial->copy()->addDays(39)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 5, 
                'goles_equipo_1' => 1,
                'equipo_2' => 39,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 39,
            ],
        ];
    }

    public static function octavos()
    {
        $fecha_inicial = Carbon::create(2026, 3, 1, 0, 0, 0, 'UTC');

        return [
            // OCTAVOS DE FINAL
            [
                'id' => 89, 
                'fase' => 'OCTAVOS',
                'jornada_id' => 5,
                'fecha_partido' => $fecha_inicial->copy()->addDays(42)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 35,
                'goles_equipo_1' => 1,
                'equipo_2' => 29,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 29,
            ],
            [
                'id' => 90,
                'fase' => 'OCTAVOS',
                'jornada_id' => 5,
                'fecha_partido' => $fecha_inicial->copy()->addDays(42)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 25,
                'goles_equipo_1' => 1,
                'equipo_2' => 7,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 7,
            ],
            [
                'id' => 91,
                'fase' => 'OCTAVOS',
                'jornada_id' => 5,
                'fecha_partido' => $fecha_inicial->copy()->addDays(42)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 21,
                'goles_equipo_1' => 2,
                'equipo_2' => 13,
                'goles_equipo_2' => 3,
                'equipo_ganador_id' => 13,
            ],
            [
                'id' => 92,
                'fase' => 'OCTAVOS',
                'jornada_id' => 5,
                'fecha_partido' => $fecha_inicial->copy()->addDays(42)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 41,
                'goles_equipo_1' => 1,
                'equipo_2' => 33,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 33,
            ],

            [
                'id' => 93,
                'fase' => 'OCTAVOS',
                'jornada_id' => 5,
                'fecha_partido' => $fecha_inicial->copy()->addDays(43)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 37,
                'goles_equipo_1' => 1,
                'equipo_2' => 17,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 37,
            ],
            [
                'id' => 94,
                'fase' => 'OCTAVOS',
                'jornada_id' => 5,
                'fecha_partido' => $fecha_inicial->copy()->addDays(43)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 45,
                'goles_equipo_1' => 2,
                'equipo_2' => 31,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 45,
            ],
            [
                'id' => 95,
                'fase' => 'OCTAVOS',
                'jornada_id' => 5,
                'fecha_partido' => $fecha_inicial->copy()->addDays(43)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 1,
                'goles_equipo_1' => 1,
                'equipo_2' => 23,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 23,
            ],
            [
                'id' => 96,
                'fase' => 'OCTAVOS',
                'jornada_id' => 5,
                'fecha_partido' => $fecha_inicial->copy()->addDays(43)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 19,
                'goles_equipo_1' => 0,
                'equipo_2' => 39,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 39,
            ],
        ];
    }

    public static function cuartos()
    {
        $fecha_inicial = Carbon::create(2026, 3, 1, 0, 0, 0, 'UTC');

        return [
            // CUARTOS

            [
                'id' => 97,
                'fase' => 'CUARTOS',
                'jornada_id' => 6,
                'fecha_partido' => $fecha_inicial->copy()->addDays(46)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 29,
                'goles_equipo_1' => 2,
                'equipo_2' => 7,
                'goles_equipo_2' => 2,
                'equipo_ganador_id' => 29,
            ],
            [
                'id' => 98,
                'fase' => 'CUARTOS',
                'jornada_id' => 6,
                'fecha_partido' => $fecha_inicial->copy()->addDays(47)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 13,
                'goles_equipo_1' => 2,
                'equipo_2' => 33,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 13,
            ],
            [
                'id' => 99,
                'fase' => 'CUARTOS',
                'jornada_id' => 6,
                'fecha_partido' => $fecha_inicial->copy()->addDays(48)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 37,
                'goles_equipo_1' => 1,
                'equipo_2' => 45,
                'goles_equipo_2' => 0,
                'equipo_ganador_id' => 37,
            ],
            [
                'id' => 100,
                'fase' => 'CUARTOS',
                'jornada_id' => 6,
                'fecha_partido' => $fecha_inicial->copy()->addDays(49)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),
                'equipo_1' => 23,
                'goles_equipo_1' => 0,
                'equipo_2' => 39,
                'goles_equipo_2' => 1,
                'equipo_ganador_id' => 39,
            ],
        ];
    }

    public static function semifinales()
    {
        $fecha_inicial = Carbon::create(2026, 3, 1, 0, 0, 0, 'UTC');

        return [
            // SEMIFINALES
            [
                'id' => 101,
                'fase' => 'SEMIFINALES',
                'jornada_id' => 7,
                'fecha_partido' => $fecha_inicial->copy()->addDays(52)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),

                'equipo_1' => 29, // Argentina
                'goles_equipo_1' => 1,

                'equipo_2' => 13, // Brasil
                'goles_equipo_2' => 2,

                'equipo_ganador_id' => 13,
            ],
            [
                'id' => 102,
                'fase' => 'SEMIFINALES',
                'jornada_id' => 7,
                'fecha_partido' => $fecha_inicial->copy()->addDays(53)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),

                'equipo_1' => 37, // Italia
                'goles_equipo_1' => 2,

                'equipo_2' => 39, // Dinamarca
                'goles_equipo_2' => 0,

                'equipo_ganador_id' => 37,
            ],
        ];
    }

    public static function tercerLugar()
    {
        $fecha_inicial = Carbon::create(2026, 3, 1, 0, 0, 0, 'UTC');

        return [
            [
                'id' => 103,
                'fase' => 'TERCER LUGAR',
                'jornada_id' => 8,
                'fecha_partido' => $fecha_inicial->copy()->addDays(56)->addHours(8)->toDateTimeString(),
                'estadio_id' => rand(1,16),

                'equipo_1' => 29, // Argentina
                'goles_equipo_1' => 3,

                'equipo_2' => 39, // Dinamarca
                'goles_equipo_2' => 1,

                'equipo_ganador_id' => 29,
            ],
        ];
    }
    
    public static function finales()
    {
        $fecha_inicial = Carbon::create(2026, 3, 1, 0, 0, 0, 'UTC');

        return [
            [
                'id' => 104,
                'fase' => 'FINALES',
                'jornada_id' => 9,
                'fecha_partido' => $fecha_inicial->copy()->addDays(56)->addHours(16)->toDateTimeString(),
                'estadio_id' => rand(1,16),

                'equipo_1' => 13, // Brasil
                'goles_equipo_1' => 2,

                'equipo_2' => 37, // Italia
                'goles_equipo_2' => 1,

                'equipo_ganador_id' => 13,
            ],
        ];
    }

    public static function guardarResultadoPartido(int $id_partido)
    {
        $partido_db = Partido::find($id_partido);

        if (empty($partido_db)) return ['error' => 'Error al encontrar el partido en base de datos.'];

        $partido_test = null;

        $jornada_test = [];

        switch($partido_db->jornada) {
            case 1:
                $jornada_test = TestingService::jornadaUno();
                break;
            case 2:
                $jornada_test = TestingService::jornadaDos();
                break;
            case 3: 
                $jornada_test = TestingService::jornadaTres();
                break;
            case 4: 
                $jornada_test = TestingService::dieciseisavos();
                break;
            case 5: 
                $jornada_test = TestingService::octavos();
                break;
            case 6: 
                $jornada_test = TestingService::cuartos();
                break;
            case 7: 
                $jornada_test = TestingService::semifinales();
                break;
            case 8: 
                $jornada_test = TestingService::tercerLugar();
                break;
            case 9: 
                $jornada_test = TestingService::finales();
                break;
            default:
                $jornada_test = [];
        }

        if (empty($jornada_test)) return ['error' => 'Error al encontrar la jornada del partido.'];

        $partido_test = array_find($jornada_test, function($partido) use($id_partido) {
            return (int)$partido['id'] === (int)$id_partido;
        });

        if (empty($partido_test)) return ['error' => 'Error al encontrar el partido en listado.'];

        $resultado_db = ResultadoPartido::find($id_partido);

        if (! empty($resultado_db)) return ['error' => 'Este partido ya tiene un resultado ingresado.'];

        $resultado = ResultadoPartido::create([
            'partido_id' => $id_partido,
            'goles_equipo_1' => $partido_test['goles_equipo_1'],
            'goles_equipo_2' => $partido_test['goles_equipo_2'],
            'equipo_ganador_id' => $partido_test['equipo_ganador_id'],
        ]);

        if (empty($resultado)) return ['error' => 'Error al guardar resultado del partido.'];

        return [
            'message' => 'Se ha procesado el partido con éxito.',
            'resultado' => $resultado
        ];
    }
}
