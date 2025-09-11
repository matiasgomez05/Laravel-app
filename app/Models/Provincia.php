<?php

namespace App\Models;
use App\Models\Pais;
use App\Models\Partido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provincia extends Model
{
    protected $table = 'Provincias';
    protected $primaryKey = 'id_provincia';
    public $timestamps = false; 
    
    protected $fillable = [
        'id_provincia',
        'id_pais',
        'nombre',
    ];

    public function pais(): BelongsTo
    {
        return $this->BelongsTo(Pais::class, "id_pais" ,"id_pais");
    }

    public function partidos(): HasMany
    {
        return $this->hasMany(Partido::class);
    }
}
