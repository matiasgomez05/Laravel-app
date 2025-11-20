<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDireccionRequest;
use App\Mail\DireccionCreateMail;
use App\Models\Direccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Si es una petición web
        $direcciones = Direccion::paginate(20);
        return view('direcciones.index', compact('direcciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Para web, mostrar formulario
        return view('direcciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDireccionRequest $request)
    {
        Direccion::create($request->all());
        //Notificacion por mail utilizando el support de Facades
        //Mail::to('nuevo@destino.com')->send(new DireccionCreateMail);
        return redirect()->route('direcciones.index')->with('success', 'Direccion creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Direccion $direccion)
    {
        return view ('direccion.show', compact($direccion));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Direccion $direccion)
    {
        return view('direcciones.edit', compact('direccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Direccion $direccion)
    {
        $request->validate([
            // Validaciones
            'id_localidad' => 'required|integer|exists:localidades,id',
            'calle' => 'required|string|max:255',
            'numero' => 'required|integer',
            'piso' => 'nullable|string|max:255',
            'codigo_postal' => 'nullable|string|max:255',
        ], [
            // Mensajes personalizados
            'id_localidad.required' => 'Localidad no fue seleccionada.',
            'calle.required' => 'La calle es obligatoria',
            'numero.required' => 'El numero de calle es obligatorio.',
        ]);

        $direccion->update($request->all());
        return redirect()->route('direcciones.index')->with('success', 'Direccion actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direccion $direccion)
    {
        $direccion->delete();
        return redirect()->route('direcciones.index')->with('success', 'Direccion eliminada correctamente');
    }
}
