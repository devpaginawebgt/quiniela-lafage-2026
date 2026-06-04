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
        'fixtures',
        'fixtures_pending_date',
        'completed',
        'is_current',
    ];

    protected function casts(): array
    {
        return [
            'fixtures'              => 'integer',
            'fixtures_pending_date' => 'integer',
            'completed'             => 'boolean',
            'is_current'            => 'boolean',
        ];
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
