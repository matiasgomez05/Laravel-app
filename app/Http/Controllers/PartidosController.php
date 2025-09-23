<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use Illuminate\Http\Request;

class PartidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Si es una petición API con filtro por provincia, devolver arreglo simple
            if ($request->expectsJson()) {
                if ($request->filled('id_provincia')) {
                    $query = Partido::where('id_provincia', $request->get('id_provincia'));
                }
                $partidos = $query->orderBy('nombre')
                    ->get(['id_partido as id', 'nombre']);
                return response()->json($partidos);
            }
        } catch (\Exception $e) {
            return $this->handleGeneralError($e, $request);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Partidos $partidos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partidos $partidos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partidos $partidos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partidos $partidos)
    {
        //
    }
}
