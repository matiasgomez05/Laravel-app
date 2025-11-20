<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciasController extends Controller
{
    public function index(Request $request)
    {
        // Si es una petición API con filtro por país, devolver arreglo simple
        if ($request->expectsJson()) {

            if ($request->filled('id_pais')) {
                $query = Provincia::where('id_pais', $request->get('id_pais'));
            }

            $provincias = $query->orderBy('id')->get();
            return response()->json($provincias);
        }
    }
    
}
