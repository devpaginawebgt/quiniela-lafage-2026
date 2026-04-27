<?php

namespace App\Http\Services;

use App\Models\Equipo;
use Illuminate\Database\Eloquent\Builder;

class EquipoService {

    public function getEquipos()
    {
        return Equipo::select('id', 'nombre', 'imagen', 'descripcion')
            ->orderBy('nombre', 'asc')
            ->get();
    }

}