<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Pais;

class Provincia extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_provincia' => $this->id_provincia,
            'nombre' => $this->nombre,
            'pais' => $this->pais,
        ];
    }
}
