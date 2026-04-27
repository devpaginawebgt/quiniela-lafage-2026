<?php

namespace App\Http\Resources\Grupo;

use App\Http\Resources\Equipo\EquipoGrupoResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrupoEquiposResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'value' => $this->id,
            'is_current' => $this->is_current,
            'equipos' => EquipoGrupoResource::collection($this->equipos)
        ];
    }
}
