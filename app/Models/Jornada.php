<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jornada extends Model
{
    protected $fillable = [
        'phase_id',
        'name',
        'api_round',
        'is_current'
    ];

    protected function casts(): array
    {
        return [ 'is_current' => 'boolean' ];
    }

    public function phase(): BelongsTo
    {
        return $this->belongsTo(Phase::class);
    }

    public function partidos(): HasMany
    {
        return $this->hasMany(Partido::class);
    }
}
