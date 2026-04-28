<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'image',
        'line_id',
    ];

    public function line(): BelongsTo
    {
        return $this->belongsTo(Line::class);
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class);
    }

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class, 'brand_id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope('visibleByCountry', function (Builder $builder) {
            /** @var \App\Models\User|null $user */
            $user = Auth::user();

            if (! $user || ! $user->pais_id) {
                return;
            }

            $builder->whereHas(
                'countries',
                fn (Builder $query) => $query->whereKey($user->pais_id)
            );
        });
    }
}
