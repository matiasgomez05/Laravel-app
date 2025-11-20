<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\ProvinciasController;
use App\Http\Controllers\PartidosController;
use App\Http\Controllers\LocalidadesController;

Route::middleware(['db.check'])->group(function () {
    Route::resource('paises', PaisesController::class)->only('index');
    Route::resource('provincias', ProvinciasController::class)->only('index');
    Route::resource('partidos', PartidosController::class)->only('index');
    Route::resource('localidades', LocalidadesController::class)->only('index');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
