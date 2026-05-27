<?php

namespace App\Models;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Direccion extends Model
{
    /* Campos para base de datos */
    protected $table = 'direcciones';
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'ultima_actualizacion';
    
    /* Campos para formularios que deben enviarse sin falta */
    protected $fillable = [
        'id_localidad',
        'calle',
        'numero',
        'piso',
        'codigo_postal',
    ];

    /* Campos para formularios que deben ignorarse */
    protected $guarded = [
        
    ];

    protected static function booted(): void
    {
        static::creating(function (Direccion $direccion) {
            if (empty($direccion->slug)) {
                $direccion->slug = Str::slug($direccion->calle . '-' . $direccion->numero . '-' . uniqid());
            }
        });
    }

    protected function calle(): Attribute{
        return Attribute::make(
            get: function($valor) { return ucfirst($valor); },
            set: function($valor) { return strtolower($valor); }
        );
    } 

    public function cliente(): BelongsTo
    {
        return $this->BelongsTo(Cliente::class, 'id_direccion', 'id');
    }
    
    public function localidad(): BelongsTo
    {
        return $this->BelongsTo(Localidad::class, "id_localidad" ,"id");
    }
}
