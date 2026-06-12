<?php

namespace App\Http\Services;

use App\Models\Preccion;
use App\Models\User;

class ReportService
{
    public function getUsuarios()
    {
        return User::with(['country', 'type', 'line', 'company', 'pushTokens'])
            ->select('users.*')
            ->orderBy('puntos', 'desc')
            ->orderBy('created_at', 'asc')
            ->orderBy('id');
    }

    public function getPronosticos()
    {
        return Preccion::with([
            'user',
            'user.country',
            'user.type',
            'user.line',
            'user.company',
            'partido.jornada',
            'partido.equipos.equipoUno',
            'partido.equipos.equipoDos',
            'resultado',
        ])
            ->whereHas('user')
            ->select('preccions.*')
            ->orderBy('preccions.created_at', 'desc')
            ->orderBy('id');
    }
}
