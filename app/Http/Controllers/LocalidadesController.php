<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use Illuminate\Http\Request;

class LocalidadesController extends Controller
{
    public function index(Request $request)
    {
        // Si es una petición API con filtro por provincia, devolver arreglo simple
        if ($request->expectsJson()) {

            if ($request->filled('id_partido')) {
                $query = Localidad::where('id_partido', $request->get('id_partido'));
            }
            
            $localidades = $query->orderBy('id')->get();
            return response()->json($localidades);
        }
    }

}
