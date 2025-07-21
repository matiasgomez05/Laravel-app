<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'Paises';
    protected $primaryKey = 'id_pais';

    protected $fillable = [
        'id_pais',
        'nombre',
        'codigo',
        'capital',
        'moneda',
        'numero_de_telefono',
    ];

}
