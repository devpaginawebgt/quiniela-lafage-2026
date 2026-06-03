# Integración con API-Football — Guía de implementación

Guía paso a paso para integrar [API-Football (api-sports.io)](https://www.api-football.com/) en un proyecto Laravel: persistencia de catálogo de equipos, enlace con equipos locales y sincronización de plantillas de jugadores.

> Replicable en cualquier proyecto Laravel 10+. Asume que ya existe un modelo `Equipo` (o equivalente) con `nombre` y algún identificador local para hacer el match.

---

## Tabla de contenido

1. [Configuración base (`.env` + config)](#paso-1--configuración-base-env--config)
2. [Migraciones del espejo de la API](#paso-2--migraciones-del-espejo-de-la-api)
3. [Modelos espejo](#paso-3--modelos-espejo)
4. [Servicio `ApiFootballService`](#paso-4--servicio-apifootballservice)
5. [Enlace `Equipo ↔ ApiTeam`](#paso-5--enlace-equipo--apiteam-columnas-code-y-api_team_id)
6. [Comando `app:sincronizar-equipos`](#paso-6--comando-appsincronizar-equipos)
7. [Comando `app:sincronizar-plantillas`](#paso-7--comando-appsincronizar-plantillas)
8. [Flujo completo de uso](#flujo-completo-de-uso)
9. [Estructura final de archivos](#estructura-final-de-archivos)

---

## Paso 1 — Configuración base (`.env` + config)

### 1.1 Variables de entorno

Añadir al `.env`:

```env
API_FOOTBALL_BASE_URL=https://v3.football.api-sports.io
API_FOOTBALL_API_KEY=tu_api_key
```

> La API key se obtiene registrándose en [api-sports.io](https://dashboard.api-football.com/). Plan free: 100 requests/día.

### 1.2 Archivo de config

Crear `config/api-football.php`:

```php
<?php

return [

    'base_url' => env('API_FOOTBALL_BASE_URL'),

    'api_key' => env('API_FOOTBALL_API_KEY'),

];
```

> **Convención Laravel**: nunca llamar `env()` fuera de un archivo `config/`. Usar `config('api-football.base_url')` y `config('api-football.api_key')`.

Después de añadir el `.env`: `php artisan config:clear`.

---

## Paso 2 — Migraciones del espejo de la API

La filosofía es mantener un **espejo** de lo que devuelve la API, separado del dominio del negocio. Tres tablas:

| Tabla | Propósito |
|---|---|
| `api_responses` | Log de **todas** las requests (éxito y error). Trazabilidad y debugging. |
| `api_teams` | Catálogo de equipos desde `/teams`. |
| `api_players` | Plantillas desde `/players/squads`, con `is_active` para soft-tracking de bajas. |

### 2.1 Migración `api_teams`

`database/migrations/YYYY_MM_DD_HHMMSS_create_api_teams_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_team_id')->unique();
            $table->string('name');
            $table->string('code', 10)->nullable();
            $table->string('country')->nullable();
            $table->unsignedSmallInteger('founded')->nullable();
            $table->boolean('national')->default(false);
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_teams');
    }
};
```

### 2.2 Migración `api_responses`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_responses', function (Blueprint $table) {
            $table->id();
            $table->string('endpoint')->index();
            $table->json('parameters')->nullable();
            $table->json('errors')->nullable();
            $table->integer('results')->default(0);
            $table->json('paging')->nullable();
            $table->json('response')->nullable();
            $table->unsignedSmallInteger('status_code')->nullable();
            $table->boolean('success')->default(false)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_responses');
    }
};
```

> En éxito, `response` se guarda `null` (los datos ya se transformaron en tablas de dominio); en error se guarda el `response` crudo para diagnóstico.

### 2.3 Migración `api_players`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_player_id')->unique();
            $table->unsignedBigInteger('api_team_id')->index();
            $table->string('name');
            $table->unsignedSmallInteger('age')->nullable();
            $table->unsignedSmallInteger('number')->nullable();
            $table->string('position')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_players');
    }
};
```

---

## Paso 3 — Modelos espejo

### 3.1 `App\Models\ApiTeam`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiTeam extends Model
{
    protected $fillable = [
        'api_team_id',
        'name',
        'code',
        'country',
        'founded',
        'national',
        'logo',
    ];

    protected $casts = [
        'founded'  => 'integer',
        'national' => 'boolean',
    ];
}
```

### 3.2 `App\Models\ApiResponse`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiResponse extends Model
{
    protected $fillable = [
        'endpoint',
        'parameters',
        'errors',
        'results',
        'paging',
        'response',
        'status_code',
        'success',
    ];

    protected $casts = [
        'parameters' => 'array',
        'errors'     => 'array',
        'paging'     => 'array',
        'response'   => 'array',
        'success'    => 'boolean',
    ];
}
```

### 3.3 `App\Models\ApiPlayer`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiPlayer extends Model
{
    protected $fillable = [
        'api_player_id',
        'api_team_id',
        'name',
        'age',
        'number',
        'position',
        'photo',
        'is_active',
        'last_synced_at',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'last_synced_at' => 'datetime',
    ];

    public function getPositionLabelAttribute(): string
    {
        if (! $this->position) {
            return 'Desconocido';
        }

        return trans('positions')[$this->position] ?? 'Desconocido';
    }
}
```

### 3.4 (Opcional) Traducción de posiciones

`lang/es/positions.php`:

```php
<?php

return [
    'Goalkeeper' => 'Portero',
    'Defender'   => 'Defensa',
    'Midfielder' => 'Mediocampista',
    'Attacker'   => 'Delantero',
];
```

> Usado por el accessor `position_label` del modelo `ApiPlayer`. Omitir si no se va a mostrar la posición traducida.

---

## Paso 4 — Servicio `ApiFootballService`

Centraliza toda comunicación con la API. **Cualquier request** pasa por el método privado `request()`, que:

1. Envía headers de autenticación.
2. Determina éxito (`HTTP 200` **y** `errors` vacío).
3. Persiste un registro en `api_responses` siempre.
4. Devuelve una estructura uniforme `['error' => bool, 'data' => array]`.

`app/Http/Services/ApiFootballService.php`:

```php
<?php

namespace App\Http\Services;

use App\Models\ApiPlayer;
use App\Models\ApiResponse;
use App\Models\ApiTeam;
use Illuminate\Support\Facades\Http;

class ApiFootballService
{
    private string $base_url;
    private string $api_key;

    public function __construct()
    {
        $this->base_url = config('api-football.base_url', '');
        $this->api_key  = config('api-football.api_key', '');
    }

    private function request(string $endpoint): array
    {
        $response = Http::withHeaders([
            'x-apisports-key' => $this->api_key,
        ])->get($this->base_url . $endpoint);

        $body      = $response->json() ?? [];
        $hasErrors = ! empty($body['errors'] ?? []);
        $success   = $response->ok() && ! $hasErrors;

        ApiResponse::create([
            'endpoint'    => $body['get'] ?? trim(parse_url($endpoint, PHP_URL_PATH) ?? '', '/'),
            'parameters'  => $body['parameters'] ?? null,
            'errors'      => $body['errors'] ?? null,
            'results'     => $body['results'] ?? 0,
            'paging'      => $body['paging'] ?? null,
            'response'    => $success ? null : ($body['response'] ?? null),
            'status_code' => $response->status(),
            'success'     => $success,
        ]);

        if (! $success) {
            return [
                'error'   => true,
                'message' => 'No se pudo obtener la información de la API Football.',
            ];
        }

        return [
            'error' => false,
            'data'  => $body['response'] ?? [],
        ];
    }

    public function getTeams(int $league = 1, int $season = 2026): array
    {
        $result = $this->request("/teams?league={$league}&season={$season}");

        if ($result['error'] === true) {
            return ['error' => true, 'synced' => 0];
        }

        $synced = 0;

        foreach ($result['data'] as $entry) {
            $team = $entry['team'] ?? null;

            if (! $team || empty($team['id'])) continue;

            ApiTeam::updateOrCreate(
                ['api_team_id' => $team['id']],
                [
                    'name'     => $team['name'] ?? '',
                    'code'     => $team['code'] ?? null,
                    'country'  => $team['country'] ?? null,
                    'founded'  => $team['founded'] ?? null,
                    'national' => $team['national'] ?? false,
                    'logo'     => $team['logo'] ?? null,
                ]
            );

            $synced++;
        }

        return ['error' => false, 'synced' => $synced];
    }

    public function getTeamSquad(int $teamExternalId)
    {
        $result = $this->request("/players/squads?team={$teamExternalId}");

        if ($result['error'] === true) return;

        $entry   = $result['data'][0] ?? null;
        $players = $entry['players'] ?? [];

        if (empty($players)) return;

        $now          = now();
        $apiPlayerIds = [];

        foreach ($players as $player) {
            ApiPlayer::updateOrCreate(
                ['api_player_id' => $player['id']],
                [
                    'api_team_id'    => $teamExternalId,
                    'name'           => $player['name'],
                    'age'            => $player['age'] ?? null,
                    'number'         => $player['number'] ?? null,
                    'position'       => $player['position'] ?? null,
                    'photo'          => $player['photo'] ?? null,
                    'is_active'      => true,
                    'last_synced_at' => $now,
                ]
            );

            $apiPlayerIds[] = $player['id'];
        }

        ApiPlayer::where('api_team_id', $teamExternalId)
            ->whereNotIn('api_player_id', $apiPlayerIds)
            ->update(['is_active' => false]);
    }
}
```

### Patrón al añadir un nuevo endpoint

Para extender el servicio (ej. `/fixtures`, `/standings`):

1. Añadir método público `getXxx(...)` que llame `$this->request("/endpoint?...")`.
2. Salir temprano si `$result['error'] === true`.
3. Iterar `$result['data']` y persistir en la tabla de dominio que corresponda (`partidos`, etc.).
4. **No** crear una nueva tabla `api_*` salvo que se necesite mantener el shape crudo de la API.

> **Regla**: nunca usar `Http::...` fuera de `request()`. Romper esto rompe el log centralizado en `api_responses`.

---

## Paso 5 — Enlace `Equipo ↔ ApiTeam` (columnas `code` y `api_team_id`)

El `id` interno de `equipos` no tiene relación con el `id` externo de API-Football. Necesitamos dos columnas en `equipos`:

| Columna | Tipo | Propósito |
|---|---|---|
| `code` | `string(10)` nullable | Código **alpha-3 estilo FIFA** (ej. `MEX`, `CRO`, `BRA`). Se popula a mano una sola vez. Es la **clave de match** con `api_teams.code`. |
| `api_team_id` | `unsignedBigInteger` nullable, FK a `api_teams.api_team_id` | ID externo enlazado por el comando `app:sincronizar-equipos`. |

> Si el proyecto ya usa una columna `codigo_iso` (alpha-2, ej. `MX`) para banderas, **no mezclar** con `code`. Son cosas distintas: alpha-2 para UI, alpha-3 para API.

### 5.1 Migración: añadir `api_team_id` a `equipos`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->unsignedBigInteger('api_team_id')->nullable()->after('grupo');

            $table->foreign('api_team_id')
                ->references('api_team_id')
                ->on('api_teams')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->dropForeign(['api_team_id']);
            $table->dropColumn('api_team_id');
        });
    }
};
```

### 5.2 Migración: añadir `code` a `equipos`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->string('code', 10)->nullable()->after('codigo_iso');
        });
    }

    public function down(): void
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
};
```

### 5.3 Actualizar el modelo `Equipo`

Añadir `code` y `api_team_id` al `$fillable`, y las relaciones:

```php
protected $fillable = [
    // ...campos existentes...
    'code',
    'api_team_id',
];

public function apiTeam()
{
    return $this->belongsTo(ApiTeam::class, 'api_team_id', 'api_team_id');
}

public function players()
{
    return $this->hasMany(ApiPlayer::class, 'api_team_id', 'api_team_id');
}
```

### 5.4 Popular `code` en el seeder

Hay dos escenarios:

#### A) Proyecto nuevo (insertando equipos por primera vez)

Incluye el `code` dentro del array de `insert`:

```php
['nombre' => 'México',   'codigo_iso' => 'MX', 'code' => 'MEX', /* ... */],
['nombre' => 'Croacia',  'codigo_iso' => 'HR', 'code' => 'CRO', /* ... */],
['nombre' => 'Brasil',   'codigo_iso' => 'BR', 'code' => 'BRA', /* ... */],
```

#### B) Proyecto existente (equipos ya en BD, solo añadir `code`)

Usar un seeder de **actualización** con array `id => code` y `UPDATE` por fila. Esto es lo que se hizo en lafage:

```php
public function run()
{
    // Mapeo equipo_id => code (FIFA alpha-3) para enlace con api_teams.code.
    // El orden sigue la inserción original: Grupo A = ids 1-4, Grupo B = 5-8, etc.
    $codes = [
        // Grupo A
        1  => 'MEX', // México
        2  => 'RSA', // Sudáfrica
        3  => 'KOR', // Corea (del Sur)
        4  => 'CZE', // R. Checa
        // Grupo B
        5  => 'CAN', // Canadá
        6  => 'BIH', // Bosnia
        7  => 'QAT', // Catar
        8  => 'SUI', // Suiza
        // ... resto de grupos ...
        45 => 'ENG', // Inglaterra
        46 => 'CRO', // Croacia
        47 => 'GHA', // Ghana
        48 => 'PAN', // Panamá
    ];

    foreach ($codes as $id => $code) {
        DB::table('equipos')
            ->where('id', $id)
            ->update(['code' => $code]);
    }
}
```

Correr con:
```bash
php artisan db:seed --class=EquipoSeeder
```

> **Importante sobre los códigos**: son **FIFA alpha-3**, no ISO 3166-1 alpha-3. Diferencias notables: Alemania=`GER` (no DEU), Países Bajos=`NED` (no NLD), Argelia=`ALG` (no DZA), Bosnia=`BIH`, Curazao=`CUW`, Costa de Marfil=`CIV`, Cabo Verde=`CPV`, Arabia Saudí=`KSA`, Haití=`HAI`.

#### Verificación post-seeder

Después de correr `db:seed` y `app:sincronizar-equipos`, compara con esta query:

```sql
SELECT
    e.id,
    e.nombre        AS equipo_nombre,
    at.name         AS api_nombre,
    e.code          AS equipo_code,
    at.code         AS api_code,
    CASE
        WHEN at.api_team_id IS NULL THEN 'SIN ENLACE'
        WHEN e.code <> at.code      THEN 'CODE DIFIERE'
        ELSE 'OK'
    END             AS estado
FROM equipos e
LEFT JOIN api_teams at ON at.api_team_id = e.api_team_id
ORDER BY e.id;
```

Los estados `SIN ENLACE` o `CODE DIFIERE` indican equipos a ajustar (cambiar el `code` en el array y volver a correr el seeder + comando).

---

## Paso 6 — Comando `app:sincronizar-equipos`

Hace dos cosas en una corrida:

1. Llama a `/teams?league=X&season=Y` → `updateOrCreate` en `api_teams`.
2. Por cada `Equipo`, busca `ApiTeam` por `code` y actualiza `equipos.api_team_id`.

**Reusable**: ejecutar en cualquier momento refresca info de `api_teams` y corrige enlaces si la API cambió IDs.

`app/Console/Commands/SincronizarEquipos.php`:

```php
<?php

namespace App\Console\Commands;

use App\Http\Services\ApiFootballService;
use App\Models\ApiTeam;
use App\Models\Equipo;
use Illuminate\Console\Command;

class SincronizarEquipos extends Command
{
    protected $signature = 'app:sincronizar-equipos
                            {--league=1 : ID de la liga en API-Football (1 = FIFA World Cup)}
                            {--season=2026 : Temporada}
                            {--force : Re-enlaza equipos aunque ya tengan api_team_id}';

    protected $description = 'Sincroniza ApiTeams desde API-Football y enlaza Equipo.api_team_id por code (FIFA alpha-3)';

    public function handle(ApiFootballService $api)
    {
        $league = (int) $this->option('league');
        $season = (int) $this->option('season');
        $force  = (bool) $this->option('force');

        $this->info("Pidiendo /teams?league={$league}&season={$season}...");

        $result = $api->getTeams($league, $season);

        if ($result['error']) {
            $this->error('No se pudo obtener equipos de API-Football. Revisa api_responses para más detalle.');
            return Command::FAILURE;
        }

        $this->info("ApiTeams sincronizados (updateOrCreate): {$result['synced']}");

        $query = Equipo::query();

        if (! $force) {
            $query->whereNull('api_team_id');
        }

        $equipos = $query->get();

        if ($equipos->isEmpty()) {
            $this->info($force
                ? 'No hay equipos en la base.'
                : 'Todos los equipos ya tienen api_team_id. Usa --force para re-enlazar.');
            return Command::SUCCESS;
        }

        $this->info("Enlazando {$equipos->count()} equipos...");

        $linked    = 0;
        $unchanged = 0;
        $unmatched = [];

        foreach ($equipos as $equipo) {
            if (! $equipo->code) {
                $unmatched[] = "{$equipo->nombre} (code vacío)";
                continue;
            }

            $apiTeam = ApiTeam::where('code', strtoupper($equipo->code))->first();

            if (! $apiTeam) {
                $unmatched[] = "{$equipo->nombre} (code={$equipo->code}) sin ApiTeam coincidente";
                continue;
            }

            if ((int) $equipo->api_team_id === (int) $apiTeam->api_team_id) {
                $unchanged++;
                continue;
            }

            $equipo->update(['api_team_id' => $apiTeam->api_team_id]);
            $linked++;
        }

        $this->newLine();
        $this->info("Enlazados/actualizados: {$linked}");
        $this->info("Sin cambios (ya enlazados correctamente): {$unchanged}");

        if (! empty($unmatched)) {
            $this->warn('Equipos sin coincidencia (revisa el campo code o que API devuelva ese equipo):');
            foreach ($unmatched as $u) {
                $this->line(" - {$u}");
            }
        }

        return Command::SUCCESS;
    }
}
```

### Uso

```bash
# Comportamiento por defecto: solo enlaza equipos sin api_team_id
php artisan app:sincronizar-equipos

# Re-enlaza todos (útil si cambiaron codes o la API cambió IDs)
php artisan app:sincronizar-equipos --force

# Otra liga/temporada
php artisan app:sincronizar-equipos --league=39 --season=2025
```

---

## Paso 7 — Comando `app:sincronizar-plantillas`

Recorre los `Equipo` que ya tienen `api_team_id` y llama `getTeamSquad()` para cada uno. Muestra barra de progreso y reporta fallidos al final.

`app/Console/Commands/SincronizarPlantillas.php`:

```php
<?php

namespace App\Console\Commands;

use App\Http\Services\ApiFootballService;
use App\Models\Equipo;
use Illuminate\Console\Command;
use Throwable;

class SincronizarPlantillas extends Command
{
    protected $signature = 'app:sincronizar-plantillas {--equipo= : ID interno de Equipo a sincronizar (opcional)}';

    protected $description = 'Sincroniza las plantillas (jugadores) de cada Equipo desde API-Football';

    public function handle(ApiFootballService $api)
    {
        $query = Equipo::whereNotNull('api_team_id');

        if ($equipoId = $this->option('equipo')) {
            $query->where('id', (int) $equipoId);
        }

        $equipos = $query->get();

        if ($equipos->isEmpty()) {
            $this->warn('No se encontraron equipos con api_team_id asignado.');
            return Command::INVALID;
        }

        $this->info("Sincronizando plantillas de {$equipos->count()} equipos...");

        $ok = 0;
        $fallidos = [];

        $bar = $this->output->createProgressBar($equipos->count());
        $bar->start();

        foreach ($equipos as $equipo) {
            try {
                $api->getTeamSquad((int) $equipo->api_team_id);
                $ok++;
            } catch (Throwable $e) {
                $fallidos[] = "{$equipo->nombre} (api_team_id={$equipo->api_team_id}): {$e->getMessage()}";
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Sincronizados: {$ok}/{$equipos->count()}");

        if (! empty($fallidos)) {
            $this->error('Equipos con error:');
            foreach ($fallidos as $f) {
                $this->line(" - {$f}");
            }
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
```

### Uso

```bash
# Todas las plantillas
php artisan app:sincronizar-plantillas

# Solo una (por ID interno de Equipo)
php artisan app:sincronizar-plantillas --equipo=5
```

> Cada equipo = 1 request. Con ~32 equipos del Mundial = 32 requests. Cuidado con el rate-limit del plan free (100/día).

---

## Flujo completo de uso

Secuencia recomendada en un proyecto nuevo:

```bash
# 1. Configuración inicial
# - Añadir API_FOOTBALL_* al .env
# - Crear config/api-football.php
php artisan config:clear

# 2. Migraciones (en orden: tablas espejo primero, luego columnas de equipos)
php artisan migrate

# 3. Popular equipos.code manualmente (vía seeder o admin) con códigos alpha-3 FIFA

# 4. Sincronizar catálogo de equipos y enlazar
php artisan app:sincronizar-equipos
# Revisar la lista de "sin coincidencia" al final y corregir codes si hace falta

# 5. Sincronizar plantillas
php artisan app:sincronizar-plantillas
```

### Mantenimiento

- **Refrescar info de equipos** (logo, fundación, etc.): `php artisan app:sincronizar-equipos` (en cualquier momento).
- **Refrescar plantillas** (altas, bajas, cambios de dorsal): `php artisan app:sincronizar-plantillas` (semanal o cuando lo necesites).
- **Debugging de fallos de API**: consultar tabla `api_responses` filtrando por `success = 0`. El campo `response` tiene el cuerpo crudo de la respuesta fallida.

---

## Estructura final de archivos

```
config/
  api-football.php                    # base_url + api_key

database/migrations/
  YYYY_MM_DD_HHMMSS_create_api_teams_table.php
  YYYY_MM_DD_HHMMSS_create_api_responses_table.php
  YYYY_MM_DD_HHMMSS_create_api_players_table.php
  YYYY_MM_DD_HHMMSS_add_api_team_id_to_equipos_table.php
  YYYY_MM_DD_HHMMSS_add_code_to_equipos_table.php

app/Models/
  ApiTeam.php
  ApiResponse.php
  ApiPlayer.php
  Equipo.php                          # modificado: +code, +api_team_id, +relaciones

app/Http/Services/
  ApiFootballService.php              # request() + getTeams() + getTeamSquad()

app/Console/Commands/
  SincronizarEquipos.php
  SincronizarPlantillas.php

lang/es/
  positions.php                       # (opcional)
```

---

## Notas finales

- **`api_responses` es tu mejor amigo en producción**: cualquier fallo de la API queda registrado con `endpoint`, `parameters`, `errors`, `status_code` y `response`. Suele bastar para diagnosticar sin recurrir a logs externos.
- **Idempotencia**: todos los comandos usan `updateOrCreate`. Correrlos N veces produce el mismo resultado que correrlos 1 vez.
- **Separación dominio ↔ espejo**: los modelos `Api*` reflejan literalmente la API. El dominio del negocio (predicciones, puntuaciones, bracket) vive en sus propios modelos. La intersección es el FK `equipos.api_team_id`.
- **Rate-limit**: en el plan free de API-Football son 100 requests/día. Cada `app:sincronizar-equipos` = 1 request. Cada `app:sincronizar-plantillas` con 32 equipos = 32 requests. Diseña los cron jobs en consecuencia.
