<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_completo',
        'cedula',
        'edad',
        'afiliacion',
        'sexo',
    ];

    // Relación: Un paciente tiene muchas solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }
}

