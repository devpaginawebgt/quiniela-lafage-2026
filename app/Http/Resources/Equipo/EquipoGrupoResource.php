<?php

namespace App\Http\Resources\Equipo;

use App\Http\Services\HelperService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipoGrupoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $stats = [];

        $stats[] = [ 'name' => 'PJ', 'value' => $this->partidos_jugados];
        $stats[] = [ 'name' => 'PG', 'value' => $this->partidos_ganados];
        $stats[] = [ 'name' => 'PE', 'value' => $this->partidos_empatados];
        $stats[] = [ 'name' => 'PP', 'value' => $this->partidos_perdidos];
        $stats[] = [ 'name' => 'GF', 'value' => $this->goles_favor];
        $stats[] = [ 'name' => 'GC', 'value' => $this->goles_contra];

        return [
            'id' => $this->id,
            'name' => $this->nombre,
            'image' => HelperService::ImagePath($this->imagen),
            'puntos' => $this->puntos,
            'stats' => $stats,
        ];
    }
}
