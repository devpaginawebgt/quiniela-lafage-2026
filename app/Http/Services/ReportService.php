<?php

namespace App\Http\Services;

use App\Models\Preccion;
use App\Models\User;

class ReportService
{
    public function getUsuarios()
    {
        return User::with(['country', 'type', 'company', 'pushTokens'])
            ->select('users.*')
            ->orderBy('puntos', 'desc');
    }

    public function getPronosticos()
    {
        return Preccion::with([
            'user',
            'user.country',
            'user.type',
            'user.company',
            'partido.jornada',
            'partido.equipos.equipoUno',
            'partido.equipos.equipoDos',
            'resultado',
        ])
            ->whereHas('user')
            ->select('preccions.*')
            ->orderBy('preccions.created_at', 'desc');
    }
}
