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
            
            // Si es una petición API
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => $direcciones
                ]);
            }
            
            // Si es una petición web
            $direcciones = Direccion::paginate(20);
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
        try {
            $request->validate([
                'id_localidad' => 'required|integer|exists:localidades,id_localidad',
                'calle' => 'required|string|max:255',
                'numero' => 'required|integer',
                'piso' => 'nullable|string|max:255',
                'codigo_postal' => 'nullable|string|max:255',
            ]);

            $direccion = Direccion::create([
                'id_localidad' => $request->id_localidad,
                'calle' => $request->calle,
                'numero' => $request->numero,
                'piso' => $request->piso,
                'codigo_postal' => $request->codigo_postal,
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Dirección creada correctamente',
                    'data' => $direccion
                ], 201);
            }

            return redirect()->route('direcciones.index')->with('success', 'Dirección creada correctamente');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error interno del servidor'
                ], 500);
            }
            return redirect()->back()->with('error', 'Error al crear la dirección: ' . $e->getMessage())->withInput();
        }
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
