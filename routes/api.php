<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Auth\ApiPasswordResetController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EstadioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultadoPartidoController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPushTokenController;
use App\Http\Controllers\VisitorController;
use App\Models\Visitor;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth

Route::middleware('api.key')->group(function() {

    Route::controller(ApiAuthController::class)->group(function() {
        Route::post('login', 'login');

        Route::post('registro', 'register');
    });

    Route::controller(ApiPasswordResetController::class)->prefix('password')->group(function() {
        Route::post('forgot', 'forgot');
        Route::post('verify-code', 'verifyCode');
        Route::post('reset', 'reset');
    });

    Route::controller(CountryController::class)->prefix('paises')->group(function() {
        Route::get('', 'index');
    });
    
    Route::controller(LineController::class)->prefix('lineas')->group(function() {
        Route::get('', 'index');
    });

    Route::controller(CompanyController::class)->prefix('cadenas')->group(function() {
        Route::get('', 'index');
    });

    Route::controller(TermsController::class)->prefix('terminos-y-condiciones')->group(function() {
        Route::get('', 'index');
    });

    Route::controller(PrivacyPolicyController::class)->prefix('politica-de-privacidad')->group(function() {
        Route::get('', 'index');
    });

});

// Rutas protegidas

Route::middleware(['auth:sanctum'])->group(function() {

    Route::controller(ApiAuthController::class)->group(function() {
        Route::delete('logout', 'logout');
        Route::delete('logout-all', 'logoutAll');
    });

    Route::controller(AvatarController::class)->prefix('avatars')->group(function() {
        Route::get('', 'index');
    });

    Route::controller(ModuleController::class)->prefix('modulos')->group(function() {
        Route::get('{module_code}/banners', 'banners');
    });

    Route::controller(BrandController::class)->prefix('marcas')->group(function() {
        Route::get('', 'index');
    });

    // Equipos

    Route::controller(EquipoController::class)->group(function() {
        Route::get('equipos', 'index');
    });

    // Grupos

    Route::controller(GrupoController::class)->prefix('grupos')->group(function() {
        Route::get('', 'getGrupos');
        Route::get('/{grupo}/equipos', 'getEquiposGrupo');
        Route::get('/{grupo}/jornadas', 'getJornadasGrupo');
    });

    // Partidos

    Route::controller(JornadaController::class)->prefix('jornadas')->group(function() {
        Route::get('', 'getJornadas');
        Route::get('/{jornada}/partidos', 'getPartidosJornada');
    });

    // Estadios

    Route::controller(EstadioController::class)->group(function() {
        Route::get('estadios', 'getEstadios');
    });

    // Users

    Route::controller(UserController::class)->group(function() {
        Route::get('user', 'getUser');
        Route::patch('user', 'update');
        Route::patch('user/avatar', 'updateAvatar');
        Route::get('user/rank', 'getUserRank');
        Route::get('ranking', 'getRanking');
        Route::delete('user/delete', 'delete');
    });

    Route::controller(UserPushTokenController::class)->group(function() {
        Route::post('users/push-tokens', 'store');
    });

    // Premios

    Route::controller(PremioController::class)->group(function() {
        Route::get('premios', 'getPremios');
    });

    // Predicciones

    Route::controller(ResultadoPartidoController::class)->prefix('predicciones')->group(function() {
        Route::post('', 'savePredicciones');
        Route::get('/{jornada}', 'getPredicciones');
        Route::get('/{jornada}/resultados', 'getResultados');
    });

});

