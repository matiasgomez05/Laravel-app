<?php

namespace App\Models;
use App\Models\Partido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Localidad extends Model
{
    protected $table = 'Localidades';
    protected $primaryKey = 'id_localidad';
    
    protected $fillable = [
        'id_localidad',
        'id_partido',
        'nombre',
    ];

    public function partido(): BelongsTo
    {
        return $this->BelongsTo(Partido::class, "id_partido" ,"id_partido");
    }
}
