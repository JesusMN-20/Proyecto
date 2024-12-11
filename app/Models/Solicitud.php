<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'paciente_id',
        'estado',
        'tipo',
    ];

    // Relación: Una solicitud pertenece a un paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // Relación: Una solicitud tiene muchos detalles de solicitud
    public function detalleSolicitudes()
    {
        return $this->hasMany(DetalleSolicitud::class);
    }
}
