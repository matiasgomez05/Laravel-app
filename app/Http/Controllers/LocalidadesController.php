<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use Illuminate\Http\Request;

class LocalidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Si es una petición API con filtro por provincia, devolver arreglo simple
            if ($request->expectsJson()) {
                if ($request->filled('id_partido')) {
                    $query = Localidad::where('id_partido', $request->get('id_partido'));
                }
                $localidades = $query->orderBy('nombre')
                    ->get(['id_localidad as id', 'nombre']);
                return response()->json($localidades);
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
    public function show(Localidades $localidades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Localidades $localidades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Localidades $localidades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Localidades $localidades)
    {
        //
    }
}
