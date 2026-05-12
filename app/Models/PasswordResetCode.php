<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetCode extends Model
{
    protected $fillable = [
        'email',
        'code_hash',
        'reset_token_hash',
        'attempts',
        'expires_at',
        'reset_token_expires_at',
        'verified_at',
        'used_at',
        'ip',
        'user_agent',
    ];

    protected $hidden = [
        'code_hash',
        'reset_token_hash',
    ];

    protected function casts(): array
    {
        return [
            'attempts'               => 'integer',
            'expires_at'             => 'datetime',
            'reset_token_expires_at' => 'datetime',
            'verified_at'            => 'datetime',
            'used_at'                => 'datetime',
        ];
    }

    public function isExpired(): bool
    {
        return $this->expires_at?->isPast() ?? true;
    }

    public function isUsed(): bool
    {
        return !is_null($this->used_at);
    }

    public function isVerified(): bool
    {
        return !is_null($this->verified_at);
    }

    public function resetTokenIsExpired(): bool
    {
        return $this->reset_token_expires_at?->isPast() ?? true;
    }
}
