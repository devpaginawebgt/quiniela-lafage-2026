<?php

namespace App\Http\Resources\Line;

use App\Http\Resources\Premio\PremioResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinePremiosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'          => $this->name,
            'value'         => $this->id,
            'premios'       => PremioResource::collection($this->premios),
        ];
    }
}
