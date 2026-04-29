<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class);
    }
}
