<?php

namespace App\Http\Resources\Jornada;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JornadaResource extends JsonResource
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
        ];
    }
}
