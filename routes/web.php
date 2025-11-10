<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\CiudadanoController;
use App\Http\Controllers\TramiteController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ========== RUTAS PROTEGIDAS ==========
Route::middleware(['auth'])->group(function () {
    
    // ========== CIUDADANOS ==========
    Route::get('/ciudadanos', [CiudadanoController::class, 'index'])->name('ciudadanos.index');
    Route::get('/ciudadanos/create', [CiudadanoController::class, 'create'])->name('ciudadanos.create');
    Route::post('/ciudadanos', [CiudadanoController::class, 'store'])->name('ciudadanos.store');
    Route::get('/ciudadanos/buscar', [CiudadanoController::class, 'buscarVista'])->name('ciudadanos.buscar');
    Route::post('/ciudadanos/buscar', [CiudadanoController::class, 'buscarCiudadano'])->name('ciudadanos.buscar.post');
    Route::get('/ciudadanos/borrar', [CiudadanoController::class, 'deleteView'])->name('ciudadanos.deleteView');
    Route::get('/ciudadanos/{id}/edit', [CiudadanoController::class, 'edit'])->name('ciudadanos.edit');
    Route::put('/ciudadanos/{id}', [CiudadanoController::class, 'update'])->name('ciudadanos.update');
    Route::delete('/ciudadanos/{id}', [CiudadanoController::class, 'destroy'])->name('ciudadanos.destroy');

    // ========== TURNOS ==========
    // Rutas específicas primero (antes de las rutas con {id})
    Route::get('/turnos/crear', [TurnoController::class, 'create'])->name('turnos.create');
    Route::get('/turnos/en-espera', [TurnoController::class, 'enEspera'])->name('turnos.enEspera');
    Route::get('/turnos/atendidos', [TurnoController::class, 'atendidos'])->name('turnos.atendidos');
    
    // Lista y store
    Route::get('/turnos', [TurnoController::class, 'index'])->name('turnos.index');
    Route::post('/turnos', [TurnoController::class, 'store'])->name('turnos.store');
    
    // Rutas con parámetros {id} al final
    Route::post('/turnos/{id}/cambiar-estado', [TurnoController::class, 'cambiarEstado'])->name('turnos.cambiarEstado');
    Route::get('/turnos/{id}', [TurnoController::class, 'show'])->name('turnos.show');
    Route::get('/turnos/{id}/edit', [TurnoController::class, 'edit'])->name('turnos.edit');
    Route::put('/turnos/{id}', [TurnoController::class, 'update'])->name('turnos.update');
    Route::delete('/turnos/{id}', [TurnoController::class, 'destroy'])->name('turnos.destroy');

    // ========== TRÁMITES ==========
    Route::get('/tramites', [TramiteController::class, 'index'])->name('tramites.index');
    Route::get('/tramites/create', [TramiteController::class, 'create'])->name('tramites.create');
    Route::post('/tramites', [TramiteController::class, 'store'])->name('tramites.store');
    Route::get('/tramites/buscar', [TramiteController::class, 'buscarVista'])->name('tramites.buscar');
    Route::post('/tramites/buscar', [TramiteController::class, 'buscarTramite'])->name('tramites.buscar.post');
    Route::get('/tramites/borrar', [TramiteController::class, 'deleteView'])->name('tramites.deleteView');
    Route::get('/tramites/{id}', [TramiteController::class, 'show'])->name('tramites.show');
    Route::get('/tramites/{id}/edit', [TramiteController::class, 'edit'])->name('tramites.edit');
    Route::put('/tramites/{id}', [TramiteController::class, 'update'])->name('tramites.update');
    Route::delete('/tramites/{id}', [TramiteController::class, 'destroy'])->name('tramites.destroy');
    
        // ========== USUARIOS ==========
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/buscar', [UsuarioController::class, 'buscarVista'])->name('usuarios.buscar');
    Route::post('/usuarios/buscar', [UsuarioController::class, 'buscarUsuario'])->name('usuarios.buscar.post');
    Route::get('/usuarios/borrar', [UsuarioController::class, 'deleteView'])->name('usuarios.deleteView');
    Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

});