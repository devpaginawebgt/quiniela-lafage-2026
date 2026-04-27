<?php

namespace App\Http\Resources\Jornada;

use App\Http\Resources\Partido\PartidoResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JornadaGrupoResource extends JsonResource
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
            'partidos' => PartidoResource::collection($this->partidos)
        ];
    }
}
