<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDireccionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validacion
     */
    public function rules(): array
    {
        return [
            'id_localidad' => 'required|integer|exists:localidades,id',
            'calle' => 'required|string|max:255',
            'numero' => 'required|integer',
            'piso' => 'nullable|string|max:255',
            'codigo_postal' => 'nullable|string|max:255',
        ];
    }

    /** 
     * Mensajes personalizados
     */ 
    public function messages()
    {
        return [
            'id_localidad.required' => ':attribute no fue seleccionada.',
            'calle.required' => ':attribute es obligatoria',
            'numero.required' => ':attribute es obligatorio.',
        ];
    }

    /** 
     * Renombrar atributos
     */ 
    public function attributes()
    {
        return [
            'id_localidad' => 'Localidad',
            'calle' => 'Calle',
            'numero' => 'Altura de calle',
        ];
    }
}
