<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\ProvinciasController;
use App\Http\Controllers\PartidosController;
use App\Http\Controllers\LocalidadesController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::controller(PaisesController::class)->group(function () {
    Route::get('/paises', 'index')->name('paises.index');
    Route::get('/paises/create', 'create')->name('paises.create');
    Route::post('/paises', 'store')->name('paises.store');
    Route::get('/paises/{pais}/edit', 'edit')->name('paises.edit');
    Route::put('/paises/{pais}', 'update')->name('paises.update');
    Route::delete('/paises/{pais}', 'destroy')->name('paises.destroy');
});

Route::controller(ProvinciasController::class)->group(function () {
    Route::get('/provincias', 'index');
    Route::get('/provincias', 'create');
    Route::post('/provincias', 'store');
    Route::get('/provincias/{provincias}/edit', 'edit');
    Route::get('/provincias/{provincias}', 'update');
    Route::post('/provincias/{provincias}', 'destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
