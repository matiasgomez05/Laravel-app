<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\ProvinciasController;
use App\Http\Controllers\PartidosController;
use App\Http\Controllers\LocalidadesController;

Route::controller(PaisesController::class)->group(function () {
    Route::get('/paises', 'index');
    Route::post('/paises', 'store');
    Route::post('/paises', 'store');
    Route::get('/paises/{pais}/edit', 'edit');
    Route::get('/paises/{pais}', 'update');
    Route::post('/paises/{pais}', 'destroy');
});

Route::controller(ProvinciasController::class)->group(function () {
    Route::get('/provincias', 'index');
    Route::post('/provincias', 'store');
    Route::post('/provincias', 'store');
    Route::get('/provincias/{provincias}/edit', 'edit');
    Route::get('/provincias/{provincias}', 'update');
    Route::post('/provincias/{provincias}', 'destroy');
});

Route::controller(PartidosController::class)->group(function () {
    Route::get('/partidos', 'index');
});

Route::controller(LocalidadesController::class)->group(function () {
    Route::get('/localidades', 'index');
});

route::resource('paises', PaisesController::class);
route::resource('provincias', ProvinciasController::class);
route::resource('partidos', PartidosController::class);
route::resource('localidades', LocalidadesController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
