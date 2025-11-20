<?php

namespace App\Models;

use App\Models\Partido;
use App\Models\Direccion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Localidad extends Model
{
    protected $table = 'localidades';

    protected $fillable = [
        'id_partido',
        'nombre',
    ];

    public $timestamps = false; 

    public function partido(): BelongsTo
    {
        return $this->BelongsTo(Partido::class, "id_partido" ,"id");
    }

    public function direcciones(): HasMany
    {
        return $this->hasMany(Direccion::class);
    }
}
