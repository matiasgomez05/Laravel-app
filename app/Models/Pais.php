<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pais extends Model
{
    protected $table = 'paises';

    protected $fillable = [
        'nombre',
        'codigo',
        'capital',
        'moneda',
        'numero_de_telefono',
    ];

    public $timestamps = false; 
    
    public function provincias(): HasMany
    {
        return $this->hasMany(Provincia::class);
    }

}
