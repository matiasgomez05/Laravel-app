<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

class PaisesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paises = Pais::all();
        
        // Si es una petición API
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $paises
            ]);
        }
        
        // Si es una petición web
        return view('paises.index', compact('paises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Para API, no necesitamos formulario
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Use POST /paises to create a new country'
            ]);
        }
        
        // Para web, mostrar formulario
        return view('paises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255',
            'capital' => 'required|string|max:255',
            'moneda' => 'required|string|max:255',
            'numero_de_telefono' => 'required|integer',
        ]);

        $pais = Pais::create($request->all());
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'País creado correctamente',
                'data' => $pais
            ], 201);
        }
        
        return redirect()->route('paises.index')->with('success', 'País creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $pais = Pais::findOrFail($id);
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $pais
            ]);
        }
        
        return view('paises.show', compact('pais'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Pais $pais)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $pais
            ]);
        }
        
        return view('paises.edit', compact('pais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pais $pais)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255',
            'capital' => 'required|string|max:255',
            'moneda' => 'required|string|max:255',
            'numero_de_telefono' => 'required|integer',
        ]);

        $pais->update($request->all());

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'País actualizado correctamente',
                'data' => $pais
            ]);
        }

        return redirect()->route('paises.index')->with('success', 'País actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Pais $pais)
    {
        $pais->delete();
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'País eliminado correctamente'
            ]);
        }
        
        return redirect()->route('paises.index')->with('success', 'País eliminado correctamente');
    }

    /**
     * Helper method for API success responses
     */
    private function successResponse($data = null, $message = 'Success', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Helper method for API error responses
     */
    private function errorResponse($errors = null, $message = 'Error', $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
