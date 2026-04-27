<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EquipoPartido extends Model
{
    use HasFactory;

    protected $fillable = [
        'partido_id',
        'equipo_1',
        'equipo_2',
    ];

    public function partido(): BelongsTo
    {
        return $this->belongsTo(Partido::class, 'partido_id');
    }

    public function equipoUno(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'equipo_1', 'id');
    }

    public function equipoDos(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'equipo_2', 'id');
    }

    public function resultado(): BelongsTo
    {
        return $this->belongsTo(ResultadoPartido::class, 'partido_id', 'partido_id');
    }

    public function prediccion(): HasOne
    {
        return $this->hasOne(Preccion::class, 'partido_id', 'partido_id');
    }
}
