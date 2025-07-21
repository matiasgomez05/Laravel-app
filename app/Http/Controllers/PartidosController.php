<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use Illuminate\Http\Request;

class PartidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partidos = Partido::with('provincia')->paginate(20);
        return view('partidos.index', compact('partidos'));
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
