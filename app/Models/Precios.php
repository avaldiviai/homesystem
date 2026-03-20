<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precios extends Model
{
    use HasFactory;

    protected $fillable = [
        'enero',
        'febrero',
        'marzo_dic',
        'año_corrido',
        'dia',
        'venta',
        'tipo_propiedad',
        'tipo_moneda',
        'estado',
        'id_propiedad',
    ];

    /**
     * Relación con la propiedad a la que pertenece este precio.
     */
    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad');
    }
}