<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSolicitud extends Model
{
    use HasFactory;

    protected $fillable = [
        'solicitud_id',
        'examen_id',
    ];

    // Relación: Un detalle pertenece a una solicitud
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }

    // Relación: Un detalle pertenece a un examen
    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }

    // Relación: Un detalle tiene muchos resultados de examen
    public function resultadosExamenes()
    {
        return $this->hasMany(ResultadoExamen::class);
    }
}
