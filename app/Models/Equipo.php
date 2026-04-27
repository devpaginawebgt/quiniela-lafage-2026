<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'imagen',
        'codigo_iso',
        'descripcion',
        'grupo',
        'goles_favor',
        'goles_contra',
        'partidos_jugados',
        'partidos_ganados',
        'partidos_perdidos',
        'partidos_empatados',
        'puntos',
    ];

    public function partidos($jornada)
    {
        return $this->belongsToMany(Partido::class,'equipo_partidos');
    }
}
