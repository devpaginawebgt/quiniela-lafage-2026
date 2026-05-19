<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Premio extends Model
{
    use HasFactory;

    protected $fillable = [
        'posicion',
        'titulo_posicion',
        'nombre',
        'descripcion',
        'imagen',
        'line_id',
        'user_type_id',
    ];

    public function line(): BelongsTo
    {
        return $this->belongsTo(Line::class, 'line_id');
    }

    public function userType(): BelongsTo
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }
}
