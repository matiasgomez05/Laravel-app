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

//Paises
Route::controller(PaisesController::class)->group(function () {
    Route::get('/paises', 'index');
});

//Provincias
Route::controller(ProvinciasController::class)->group(function () {
    Route::get('/provincias', 'index');
});

//Partidos
Route::controller(PartidosController::class)->group(function () {
    Route::get('/partidos', 'index');
});

//Localidades
Route::controller(LocalidadesController::class)->group(function () {
    Route::get('/localidades', 'index');
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
