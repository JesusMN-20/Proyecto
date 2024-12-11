<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatoExamen extends Model
{
    use HasFactory;

    protected $fillable = [
        'examen_id',
        'nombre',
        'tipo_dato',
        'unidad_medida',
        'rango_min',
        'rango_max',
    ];

    // Relación: Un dato de examen pertenece a un examen
    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
}
