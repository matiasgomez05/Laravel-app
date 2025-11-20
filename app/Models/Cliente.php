<?php

namespace App\Models;

use App\Abstracts\Persona;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cliente extends Persona
{
    protected $table = 'clientes';

    protected function direccion(): HasOne
    {
        return $this->HasOne(Direccion::class, 'id', 'id_direccion');
    }

    protected function casts(): array {
        return [
            'activo' => 'boolean'
        ];
    }
}

