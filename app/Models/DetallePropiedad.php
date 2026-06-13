<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePropiedad extends Model
{
    use HasFactory;

    protected $table = 'detalles_propiedad';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ano_construccion',
        'piso',
        'dormitorios',
        'banos',
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
        'area_verde',
        'piscina',
        'gasto_comun',
        'descripcion',
        'tipo_propiedad',
        'id_propiedad',
        'amoblado',
        'elementos_entregados',
        'observaciones',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad', 'id');
    }
}