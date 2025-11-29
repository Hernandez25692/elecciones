<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActaController;
use App\Http\Controllers\MesaController;

Route::get('/publico/dashboard-electoral', [ActaController::class, 'public'])
    ->name('dashboard.electoral.publico');

Route::middleware(['auth'])->group(function () {

    // Digitadores y Admin
    Route::middleware('role:digitador,admin')->group(function () {

        Route::get('/actas', [ActaController::class, 'index'])->name('actas.index');

        Route::get('/actas/crear', [ActaController::class, 'create'])->name('actas.create');
        Route::post('/actas', [ActaController::class, 'store'])->name('actas.store');
        Route::get('/dashboard-electoral', [ActaController::class, 'dashboard'])->name('dashboard.electoral');
    });

    // Solo Admin
    Route::middleware('role:admin')->group(function () {

        // CRUD Mesas
        Route::resource('mesas', MesaController::class)->except(['show']);

        // EDICIÓN DE ACTAS
        Route::get('/actas/{id}/editar', [ActaController::class, 'edit'])->name('actas.edit');
        Route::put('/actas/{id}', [ActaController::class, 'update'])->name('actas.update');
    });
});



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


Route::get('/api/resultados', [App\Http\Controllers\ActaController::class, 'apiResultados']);

require __DIR__ . '/auth.php';
