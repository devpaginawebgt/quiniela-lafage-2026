<?php

namespace App\Http\Resources\Resultado;

use App\Http\Resources\Brand\BrandResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Equipo\EquipoPartidoResource;

class ResultadoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $estado = 'Por jugar';

        switch($this->partido->estado) {
            case 1:
                $estado = 'Partido finalizado';
                break;
            case 2:
                $estado = '¡Partido en curso!';
                break;
            default:
                $estado = 'Por jugar';
                break;
        }

        // Cambiar zona horaria para usuario

        $user_timezone = $request->user()->country->timezone;
        
        $fecha_partido = $this->partido->fecha_partido;
        $fecha_partido->setTimezone($user_timezone);

        return [
            'id' => $this->partido->id,            
            'fechaPartido' => $fecha_partido->format('Y-m-d H:i:s'),
            'jugado' => $this->partido->jugado === 1,
            'idEstado' => $this->partido->estado,
            'estado' => $estado,

            'equipoUno' => new EquipoPartidoResource($this->equipoUno),
            'equipoDos' => new EquipoPartidoResource($this->equipoDos),
            'marca'     => !empty($this->partido->brand) ? new BrandResource($this->partido->brand) : null,

            'prediccionEquipoUno' => $this->prediccion?->goles_equipo_1,
            'prediccionEquipoDos' => $this->prediccion?->goles_equipo_2,

            'resultadoEquipoUno' => $this->resultado->goles_equipo_1,
            'resultadoEquipoDos' => $this->resultado->goles_equipo_2,
            'puntos' => $this->puntos,
            'mensaje' => $this->mensaje,
        ];
    }
}
