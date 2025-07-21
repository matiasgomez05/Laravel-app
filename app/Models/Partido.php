<?php

namespace App\Models;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partido extends Model
{
    protected $table = 'Partidos';
    protected $primaryKey = 'id_partido';
    
    protected $fillable = [
        'id_partido',
        'id_provincia',
        'nombre',
    ];

    public function provincia(): BelongsTo
    {
        return $this->BelongsTo(Provincia::class, "id_provincia" ,"id_provincia");
    }
}
