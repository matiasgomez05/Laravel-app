<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use Illuminate\Http\Request;

class PartidosController extends Controller
{
    public function index(Request $request)
    {
        // Si es una petición API con filtro por provincia, devolver arreglo simple
        if ($request->expectsJson()) {

            if ($request->filled('id_provincia')) {
                $query = Partido::where('id_provincia', $request->get('id_provincia'));
            }

            $partidos = $query->orderBy('id')->get();
            return response()->json($partidos);
        }
    }

}
