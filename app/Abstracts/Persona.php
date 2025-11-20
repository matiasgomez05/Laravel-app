<?php

namespace App\Abstracts;

use Illuminate\Database\Eloquent\Model;

abstract class Persona extends Model
{
    protected $table;
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'ultima_actualizacion';

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
        'id_direccion',
        'fecha_registro',
        'ultima_actualzacion',
        'activo'
    ];
}