<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'image',
        'country_code',
        'area_code',
        'document_name',
        'document_regex',
        'document_regex_message',
        'timezone',
        'is_active'
    ];

    protected function casts(): array
    {
        return [ 'is_active' => 'boolean' ];
    }
}
