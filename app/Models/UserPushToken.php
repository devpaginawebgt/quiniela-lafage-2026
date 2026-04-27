<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPushToken extends Model
{
    protected $fillable = [
        'user_id',
        'device_token',
        'device_platform',
        'is_active',
    ];

    protected function casts(): array
    {
        return [ 'is_active' => 'boolean' ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
