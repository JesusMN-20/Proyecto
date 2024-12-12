<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\DatoExamenController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\DetalleSolicitudController;
use App\Http\Controllers\ResultadoExamenController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// FALTA
/*
    +Agrupacion de rutas por acceso
    +Cambiar nombre de rutas
    +Cambios en desarrolllo
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas para el módulo de pacientes
Route::resource('pacientes', PacienteController::class);

// Rutas para el módulo de exámenes
Route::resource('examenes', ExamenController::class);
Route::resource('datos-examenes', DatoExamenController::class);

// Rutas para el módulo de solicitudes
Route::resource('solicitudes', SolicitudController::class);
Route::resource('detalle-solicitudes', DetalleSolicitudController::class);

// Rutas para el módulo de resultados de exámenes
Route::resource('resultados-examenes', ResultadoExamenController::class);

// Rutas para el módulo de usuarios
Route::resource('usuarios', UsuarioController::class);
