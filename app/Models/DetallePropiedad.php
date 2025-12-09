<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePropiedad extends Model
{
    use HasFactory;

    protected $table = 'detalles_propiedad'; // Especifica la tabla

    protected $primaryKey = 'id';

    protected $fillable = [
        'año_construccion',
        'piso',
        'dormitorios',
        'baños',
        'orientacion',
        'cocina',
        'logia',
        'agua_caliente',
        'espacio_lavadora',
        'lavadora',
        'inventario',
        'mt2_total',
        'mt2_construido',
        'mt2_terraza',
        'estacionamiento_visitas',
        'ascensor',
        'juegos_infantiles',
        'lavanderia',
        'quinchos',
        'sala_multiuso',
        'gimnasio',
        'ciclovia',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad', 'id');
    }
}
