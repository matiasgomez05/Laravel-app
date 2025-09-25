<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\ProvinciasController;
use App\Http\Controllers\PartidosController;
use App\Http\Controllers\LocalidadesController;

/* Control interno para manejar recursos de direcciones */
Route::middleware(['db.check'])->group(function () {
    Route::get('/paises', [PaisesController::class, 'index']);
    Route::get('/provincias', [ProvinciasController::class, 'index']);
    Route::get('/partidos', [PartidosController::class, 'index']);
    Route::get('/localidades', [LocalidadesController::class, 'index']);

    route::resource('paises', PaisesController::class);
    route::resource('provincias', ProvinciasController::class);
    route::resource('partidos', PartidosController::class);
    route::resource('localidades', LocalidadesController::class);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
