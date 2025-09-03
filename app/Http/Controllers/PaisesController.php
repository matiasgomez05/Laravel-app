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
        try {
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
            
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleDatabaseError($e, $request);
        } catch (\Exception $e) {
            return $this->handleGeneralError($e, $request);
        }
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
        try {
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
            
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleDatabaseError($e, $request);
        } catch (\Exception $e) {
            return $this->handleGeneralError($e, $request);
        }
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

    /**
     * Handle database connection errors
     */
    private function handleDatabaseError(\Exception $e, Request $request)
    {
        $errorMessage = 'Error de conexión a la base de datos. Por favor, intente nuevamente más tarde.';
        
        // Log the actual error for debugging
        \Log::error('Database connection error: ' . $e->getMessage());
        
        if ($request->expectsJson()) {
            return $this->errorResponse(
                ['database' => [$errorMessage]], 
                'Error de conexión a la base de datos', 
                503
            );
        }
        
        return redirect()->back()
            ->with('error', $errorMessage)
            ->with('error_type', 'database_connection');
    }

    /**
     * Handle general errors
     */
    private function handleGeneralError(\Exception $e, Request $request)
    {
        $errorMessage = 'Ha ocurrido un error inesperado. Por favor, intente nuevamente.';
        
        // Log the actual error for debugging
        \Log::error('General error: ' . $e->getMessage());
        
        if ($request->expectsJson()) {
            return $this->errorResponse(
                ['general' => [$errorMessage]], 
                'Error interno del servidor', 
                500
            );
        }
        
        return redirect()->back()
            ->with('error', $errorMessage)
            ->with('error_type', 'general');
    }
}
