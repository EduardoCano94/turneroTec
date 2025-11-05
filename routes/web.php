<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\CiudadanoController;

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

Route::middleware(['auth'])->group(function () {
    Route::resource('turnos', TurnoController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/ciudadanos', [CiudadanoController::class, 'index'])->name('ciudadanos.index');
    Route::get('/ciudadanos/create', [CiudadanoController::class, 'create'])->name('ciudadanos.create');
    Route::post('/ciudadanos', [CiudadanoController::class, 'store'])->name('ciudadanos.store');
    Route::get('/ciudadanos/buscar', [CiudadanoController::class, 'buscarVista'])->name('ciudadanos.buscar');
    Route::post('/ciudadanos/buscar', [CiudadanoController::class, 'buscarCiudadano'])->name('ciudadanos.buscar.post');
    // Editar ciudadano
    Route::get('/ciudadanos/{id}/edit', [CiudadanoController::class, 'edit'])->name('ciudadanos.edit');
    Route::put('/ciudadanos/{id}', [CiudadanoController::class, 'update'])->name('ciudadanos.update');
   // Muestra la vista de eliminación
    Route::get('/ciudadanos/borrar', [CiudadanoController::class, 'deleteView'])->name('ciudadanos.deleteView');
    // Elimina un ciudadano específico
    Route::delete('/ciudadanos/{id}', [CiudadanoController::class, 'destroy'])->name('ciudadanos.destroy');

});

