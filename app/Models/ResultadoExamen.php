<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadoExamen extends Model
{
    use HasFactory;

    protected $fillable = [
        'detalle_solicitud_id',
        'dato_examen_id',
        'valor',
    ];

    // Relación: Un resultado pertenece a un detalle de solicitud
    public function detalleSolicitud()
    {
        return $this->belongsTo(DetalleSolicitud::class);
    }

    // Relación: Un resultado pertenece a un dato de examen
    public function datoExamen()
    {
        return $this->belongsTo(DatoExamen::class);
    }
}
