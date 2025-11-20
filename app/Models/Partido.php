<?php

namespace App\Models;
use App\Models\Provincia;
use App\Models\Localidad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partido extends Model
{
    protected $table = 'partidos';

    protected $fillable = [
        'id_provincia',
        'nombre',
    ];

    public $timestamps = false; 

    public function provincia(): BelongsTo
    {
        return $this->BelongsTo(Provincia::class, "id_provincia" ,"id");
    }

    public function localidades(): HasMany
    {
        return $this->hasMany(Localidad::class);
    }
}
