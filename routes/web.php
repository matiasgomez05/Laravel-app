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

/* ABM Direcciones */ 
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
