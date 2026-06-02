<?php

use App\Http\Controllers\ReportsController;
use App\Http\Controllers\BracketController;
use App\Http\Controllers\EstadioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\ResultadoPartidoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/

/****** RUTAS GET PARA OBTENER VISTAS DE MODULOS */


Route::middleware(['auth'])->as('web.')->group(function () {

    Route::controller(ResultadoPartidoController::class)->group(function () {
        Route::get('proximos-partidos', 'proximosPartidosWeb')->name('proximos-partidos');
        Route::get('mis-predicciones', 'misPrediccionesWeb')->name('mis-predicciones');
        Route::post('predicciones', 'savePrediccionesWeb')->name('save-predicciones');
    });

    Route::controller(JornadaController::class)->prefix('partidos')->group(function () {
        Route::get('/{jornada}', 'partidosJornada');
        Route::get('/', 'partidosWeb')->name('partidos');
    });    

    // Grupos

    Route::controller(GrupoController::class)->prefix('grupos')->as('grupos.')->group(function () {
        Route::get('/{grupo_id}/equipos', 'getEquiposWeb')->name('equipos');
        Route::get('/{grupo_id}/jornadas', 'getJornadasWeb')->name('jornadas');
    });

    // Partidos y resultados

    Route::controller(ResultadoPartidoController::class)->group(function () {
        Route::post('/guardar-predicciones-form', 'guardarPrediccionesForm')->name('guardar-predicciones-form');
    });

    Route::controller(UserController::class)->as('users')->group(function () {
        Route::get('ranking', 'indexWeb')->name('.ranking');
        Route::get('ranking/data', 'getRankingData')->name('.ranking.data');
        Route::get('/perfil', 'perfil')->name('.perfil');
        Route::delete('/perfil', 'deleteWeb')->name('.perfil.delete');
        Route::get('/perfil/completar', 'completarPerfil')->name('.perfil.completar');
        Route::post('/perfil/completar', 'completarPerfilStore')->name('.perfil.completar.store');
        Route::post('/perfil/avatar', 'updateAvatarWeb')->name('.perfil.avatar.update');
    });

    Route::view('/reglas', 'modulos.reglas')->name('reglas');

    // Premios

    Route::controller(PremioController::class)->group(function () {
        Route::get('/recompensas', 'recompensas')->name('recompensas');
    });

    // Rutas solo para admins
    Route::middleware('role:admin')->prefix('admin')->as('admin.')->group(function () {

        Route::controller(ReportsController::class)->as('reports.')->group(function () {
            Route::controller(ReportsController::class)->prefix('users')->as('users.')->group(function () {
                Route::get('/', 'report')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/export', 'export')->name('export');
            });

            Route::controller(ReportsController::class)->prefix('predictions')->as('predictions.')->group(function () {
                Route::get('/', 'predictionsReport')->name('index');
                Route::get('/data', 'predictionsData')->name('data');
                Route::get('/export', 'predictionsExport')->name('export');
            });
        });

        Route::controller(PushNotificationController::class)->as('notifications.')->group(function() {
            Route::get('notificaciones', 'index')->name('index');
            Route::get('notificaciones/data', 'data')->name('data');
            Route::get('notificaciones/nueva', 'create')->name('create');
            Route::post('notificaciones', 'store')->name('store');
            Route::get('notificaciones/{notification}', 'show')->name('show');
            Route::get('notificaciones/{notification}/editar', 'edit')->name('edit');
            Route::put('notificaciones/{notification}', 'update')->name('update');
            Route::patch('notificaciones/{notification}/cancelar', 'cancel')->name('cancel');
        });

        Route::view('power-bi', 'modulos.admin.power-bi')
            ->middleware('can:admin.ver-reportes')
            ->name('power-bi');

    });

    Route::get('/', function () {
        return redirect()->route('web.proximos-partidos');
    });

    // Route::controller(EstadioController::class)->group(function () {
    //     Route::get('estadios', 'estadiosWeb')->name('estadios');
    // });

    // Route::controller(GrupoController::class)->group(function () {
    //     Route::get('grupos', 'gruposWeb')->name('grupos');
    // });

    // Route::controller(EquipoController::class)->group(function () {
    //     Route::get('equipos', 'equiposWeb')->name('equipos');
    // });
});

// TEMPORAL: previsualización de emails — eliminar antes de pasar a producción.
// Route::get('/_preview/welcome-email', function () {
//     $user = \App\Models\User::first() ?? new \App\Models\User(['nombres' => 'Dennis']);
//     return view('emails.welcome', compact('user'));
// });
// Route::get('/_preview/reset-password-email', function () {
//     $user = \App\Models\User::first() ?? new \App\Models\User([
//         'nombres' => 'Dennis',
//         'email'   => 'dennis@example.com',
//     ]);
//     $resetUrl = route('password.reset', [
//         'token' => 'preview-token-1234567890',
//         'email' => $user->email,
//     ]);
//     $expiresInMinutes = (int) config('auth.passwords.users.expire', 60);
//     return view('emails.reset-password', compact('user', 'resetUrl', 'expiresInMinutes'));
// });

require __DIR__ . '/auth.php';
