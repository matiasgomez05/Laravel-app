<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Si es una petición API con filtro por país, devolver arreglo simple
            if ($request->expectsJson()) {
                if ($request->filled('id_pais')) {
                    $query = Provincia::where('id_pais', $request->get('id_pais'));
                }
                $provincias = $query->orderBy('nombre')
                    ->get(['id_provincia as id', 'nombre']);
                return response()->json($provincias);
            }

            // Petición web: paginar para la vista
            $provincias = Provincia::paginate(20);
            return view('provincias.index', compact('provincias'));
            
        } catch (\Exception $e) {
            return $this->handleGeneralError($e, $request);
        }
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //API, no necesitamos formulari
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Use POST /paises to create a new country'
            ]);
        }
        
        // Para web, mostrar formulario
        return view('provincias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Provincia $provincia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provincia $provincia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provincia $provincia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provincia $provincia)
    {
        //
    }
    
}
