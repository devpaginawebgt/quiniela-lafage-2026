<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = [
        'name',
        'url',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];
}
