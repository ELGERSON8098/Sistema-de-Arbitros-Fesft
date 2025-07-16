<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArbitroController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\AsignacionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Ruta pública para designaciones arbitrales
Route::get('/designaciones', function () {
    return view('designaciones-publicas');
})->name('designaciones.publicas');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas protegidas por autenticación y verificación
Route::middleware(['auth', 'verified'])->group(function () {
    // Rutas de árbitros
    Route::resource('arbitros', ArbitroController::class);
    
    // Rutas de equipos
    Route::resource('equipos', EquipoController::class);
    
    // Rutas de jornadas
    Route::resource('jornadas', JornadaController::class);
    
    // Rutas de partidos
    Route::resource('partidos', PartidoController::class);
    
    // Rutas de asignaciones arbitrales
    Route::get('/partidos/{partido}/asignaciones/create', [AsignacionController::class, 'create'])->name('asignaciones.create');
    Route::post('/partidos/{partido}/asignaciones', [AsignacionController::class, 'store'])->name('asignaciones.store');
    Route::get('/partidos/{partido}/asignaciones/edit', [AsignacionController::class, 'edit'])->name('asignaciones.edit');
    Route::put('/partidos/{partido}/asignaciones', [AsignacionController::class, 'update'])->name('asignaciones.update');
    Route::delete('/partidos/{partido}/asignaciones', [AsignacionController::class, 'destroy'])->name('asignaciones.destroy');
});

require __DIR__.'/auth.php';

