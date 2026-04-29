<?php

namespace App\Models;

use App\Mail\ResetPasswordMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo_id',
        'nombres',
        'apellidos',
        'image',
        'numero_documento',
        'email',
        'pais_id',
        'puntos',
        'user_type_id',
        'line_id',

        'colegiado',
        'company_id',
        'branch',

        'status_user',
        'accepted_terms_version',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    // public function codigo() : BelongsTo
    // {
    //     return $this->belongsTo(Codigo::class, 'codigo_id');
    // }

    public function pushTokens(): HasMany
    {
        return $this->hasMany(UserPushToken::class);
    }

    // Firebase notifications
    public function routeNotificationForFcm(): array
    {
        return $this->pushTokens()
            ->where('is_active', true)
            ->pluck('device_token')
            ->all();
    }

    public function latestPushToken(): HasOne
    {
        return $this->hasOne(UserPushToken::class)
            ->where('is_active', 1)
            ->latestOfMany();
    }

    public function predictions(): HasMany
    {
        return $this->hasMany(Preccion::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'pais_id');
    }

    public function line(): BelongsTo
    {
        return $this->belongsTo(Line::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function sendPasswordResetNotification($token): void
    {
        Mail::to($this->email)->queue(new ResetPasswordMail($this, $token));
    }
}
