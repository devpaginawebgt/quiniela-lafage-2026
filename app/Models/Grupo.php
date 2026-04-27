<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grupo extends Model
{
    protected $fillable = [
        'name',
        'is_current'
    ];

    protected function casts(): array
    {
        return [ 'is_current' => 'boolean' ];
    }

    public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class, 'grupo');
    }
}
