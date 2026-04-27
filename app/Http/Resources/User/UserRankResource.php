<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Country\CountryUserResource;
use App\Http\Resources\Line\LineResource;
use App\Http\Services\HelperService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRankResource extends JsonResource
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

        $user_timezone = $this->country->timezone;
        $fecha_registro = $this->created_at->timezone($user_timezone);

        return [
            'id'            => $this->id,
            'nombres'       => $this->nombres,
            'apellidos'     => $this->apellidos,
            'image'         => empty($this->image) ? HelperService::DefaultUserImagePath() : HelperService::ImagePath($this->image),
            'puntos'        => $this->puntos,
            'posicion'      => $this->posicion,
            'color'         => $color,
            'pais'          => new CountryUserResource($this->country),
            'linea'         => new LineResource($this->line),
            'fechaRegistro' => $fecha_registro->format('Y-m-d H:i:s'),
            // 'partidos'      => $this->partidos,
        ];
    }
}
