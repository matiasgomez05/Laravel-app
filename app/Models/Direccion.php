<?php

namespace App\Models;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Direccion extends Model
{
    protected $table = 'direcciones';
    protected $primaryKey = 'id_direccion';
    public $timestamps = false; 
    
    protected $fillable = [
        'id_direccion',
        'id_localidad',
        'calle',
        'numero',
        'piso',
        'codigo_postal',
    ];

    public function cliente(): BelongsTo
    {
        return $this->BelongsTo(Cliente::class, "id_cliente" ,"id_cliente");
    }
    
    public function localidad(): BelongsTo
    {
        return $this->BelongsTo(Localidad::class, "id_localidad" ,"id_localidad");
    }
}
