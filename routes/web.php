<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/* 
* Controladores
*/
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\ProvinciasController;
use App\Http\Controllers\PartidosController;
use App\Http\Controllers\LocalidadesController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::middleware(['db.check'])->controller(PaisesController::class)->group(function () {
    Route::get('/paises', 'index')->name('paises.index');
    Route::get('/paises/create', 'create')->name('paises.create');
    Route::post('/paises', 'store')->name('paises.store');
    Route::get('/paises/{pais}/edit', 'edit')->name('paises.edit');
    Route::put('/paises/{pais}', 'update')->name('paises.update');
    Route::delete('/paises/{pais}', 'destroy')->name('paises.destroy');
});

Route::middleware(['db.check'])->controller(ProvinciasController::class)->group(function () {
    Route::get('/provincias', 'index')->name('provincias.index');
    Route::get('/provincias/create', 'create')->name('provincias.create');
    Route::post('/provincias', 'store')->name('provincias.store');
    Route::get('/provincias/{provincias}/edit', 'edit')->name('provincias.edit');
    Route::put('/provincias/{provincias}', 'update')->name('provincias.update');
    Route::delete('/provincias/{provincias}', 'destroy')->name('provincias.destroy');
});

Route::middleware(['db.check'])->controller(PartidoController::class)->group(function () {
    Route::get('/partidos', 'index')->name('provincias.index');
});

Route::middleware(['db.check'])->controller(LocalidadesController::class)->group(function () {
    Route::get('/localidades', 'index')->name('localidades.index');
});

Route::middleware(['db.check'])->controller(DireccionController::class)->group(function () {
    Route::get('/direcciones', 'index')->name('direcciones.index');
    Route::get('/direcciones/create', 'create')->name('direcciones.create');
    Route::post('/direcciones', 'store')->name('direcciones.store');
    Route::get('/direcciones/{direcciones}/edit', 'edit')->name('direcciones.edit');
    Route::put('/direcciones/{direcciones}', 'update')->name('direcciones.update');
    Route::delete('/direcciones/{direcciones}', 'destroy')->name('direcciones.destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
