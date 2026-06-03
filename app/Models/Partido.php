<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Partido extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
       'fase',
       'jornada_id',
       'fecha_partido',
       'estadio_id',
       'brand_id',
       'jugado',
       'estado',
       'api_fixture_id',
    ];

    protected function casts(): array
    {
        return [ 'fecha_partido' => 'datetime' ];
    }

    public function brands(): HasMany
    {
        return $this->hasMany(PartidoBrandAssignment::class, 'partido_id');
    }

    public function brand(): HasOneThrough
    {
        return $this->hasOneThrough(
            Brand::class,
            PartidoBrandAssignment::class,
            'partido_id',
            'id',
            'id',
            'brand_id',
        );
    }

    public function jornada(): BelongsTo
    {
        return $this->belongsTo(Jornada::class);
    }

    public function equipos(): HasOne
    {
        return $this->hasOne(EquipoPartido::class, 'partido_id');
    }

}
