<?php

namespace App\Http\Resources\Prediccion;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\Equipo\EquipoPartidoResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrediccionResource extends JsonResource
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

        $pronosticado = boolval(!empty($this->prediccion?->goles_equipo_1) && !empty($this->prediccion?->goles_equipo_2));

        $message = $pronosticado
                ? 'Pronóstico registrado.'
                : 'Aún no has ingresado un pronóstico.';

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
            'prediccionHecha'     => $pronosticado,
            'message'             => $message,
        ];
    }
}
