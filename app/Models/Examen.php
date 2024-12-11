<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Relación: Un examen tiene muchos datos de examen
    public function datosExamenes()
    {
        return $this->hasMany(DatoExamen::class);
    }

    // Relación: Un examen puede estar en múltiples detalles de solicitudes
    public function detalleSolicitudes()
    {
        return $this->hasMany(DetalleSolicitud::class);
    }
}
