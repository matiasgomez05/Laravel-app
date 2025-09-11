<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pais extends Model
{
    protected $table = 'Paises';
    protected $primaryKey = 'id_pais';
    public $timestamps = false; 

    protected $fillable = [
        'id_pais',
        'nombre',
        'codigo',
        'capital',
        'moneda',
        'numero_de_telefono',
    ];

    public function provincias(): HasMany
    {
        return $this->hasMany(Provincia::class);
    }

}
