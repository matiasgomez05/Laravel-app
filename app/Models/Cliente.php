<?php

namespace App\Models;

use App\Models\Direccion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cliente extends Model
{
    protected $table = 'Clientes';
    protected $primaryKey = 'id_cliente';
    
    protected $fillable = [
        'id_cliente',
        'nombre',
        'apellido',
        'telefono',
        'email',
        'id_direccion',
        'fecha_registro',
        'ultima_actualizacion',
    ];

    public function direccion(): HasOne
    {
        return $this->HasOne(Direccion::class, "id_direccion" ,"id_direccion");
    }
}

