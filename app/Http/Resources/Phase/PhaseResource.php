<?php

namespace App\Http\Resources\Phase;

use App\Http\Resources\Jornada\JornadaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'rounds' => empty($this->jornadas) ? [] : JornadaResource::collection($this->jornadas),
        ];
    }
}
