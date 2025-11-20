<?php

namespace App\Http\Controllers;
use App\Models\Pais;
use Illuminate\Http\Request;

class PaisesController extends Controller
{
    public function index(Request $request)
    {
        // Si es una petición API
        if ($request->expectsJson()) {
            $paises = Pais::all();
            return response()->json($paises);
        }
    }
}