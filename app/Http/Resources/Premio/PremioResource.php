<?php

namespace App\Http\Resources\Premio;

use App\Http\Services\HelperService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PremioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $color = '';

        switch($this->posicion) {
            case 1:
                $color = '#FFBF00';
                break;

            case 2:
                $color = '#BEBEBE';
                break;

            case 3:
                $color = '#A0522D';
                break;
                
            default:
                $color = '#FFFFFF';
                break;
        }

        return [
            'id' => $this->id,
            'posicion' => $this->posicion,
            'tituloPosicion' => $this->titulo_posicion,
            'color' => $color,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'imagen' => HelperService::ImagePath($this->imagen),
        ];
    }
}
