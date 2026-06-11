<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verano extends Model
{
    use HasFactory;

    protected $table = 'veranos';

    protected $fillable = [
        'direccion',
        'ciudad',
        'sector',
        'condominio',
        'torre',
        'num_apartamento',
        'piso',
        'ubicacion',
        'dormitorios',
        'Tpiso_dormitorios',
        'baños',
        'tipo_cocina',
        'personas',
        'precio_min_enero',
        'precio_max_enero',
        'precio_min_febrero',
        'precio_max_febrero',
        'equipado',
        'mascotas',
        'valor_adicional',
        'estado',
    ];

    public function verano()
    {
        return $this->belongsTo(Propietario::class, 'id_propietario');
    }

    public function detallesVeranos()
    {
        return $this->hasMany(DetallesVerano::class, 'id_verano', 'id');
    }

    public function propietarioverano()
    {
        return $this->belongsTo(PropietarioVerano::class, 'id_verano', 'id');
    }
    public function precios()
    {
        return $this->hasMany(\App\Models\Precios::class, 'id_propiedad');
    }
}