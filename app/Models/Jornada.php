<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jornada extends Model
{
    protected $fillable = [
        'name',
        'is_current'
    ];

    protected function casts(): array
    {
        return [ 'is_current' => 'boolean' ];
    }

    public function partidos(): HasMany
    {
        return $this->hasMany(Partido::class);
    }
}
