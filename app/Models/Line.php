<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Line extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'line_id');
    }

    public function premios(): HasMany
    {
        return $this->hasMany(Premio::class, 'line_id');
    }

}
