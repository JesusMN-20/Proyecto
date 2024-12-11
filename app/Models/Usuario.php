<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_completo',
        'cedula',
        'cargo',
        'email',
        'password',
    ];

    // Para seguridad, ocultar el campo `password` en serializaciones
    protected $hidden = [
        'password',
    ];
}
