<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $direcciones = Direccion::paginate(20);
            
            // Si es una petición API
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => $direcciones
                ]);
            }
            
            // Si es una petición web
            return view('direcciones.index', compact('direcciones'));
            
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
        return view('direcciones.create');
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
    public function show(Direccion $direccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Direccion $direccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Direccion $direccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direccion $direccion)
    {
        //
    }
}
