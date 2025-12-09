<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    protected $table = 'propiedads';

    protected $primaryKey = 'id';

    protected $fillable = [
        'direccion',
        'maps',
        'condominio',
        'num_estacionamiento',
        'num_torre',
        'torre',
        'bodega',
        'rol',
        'numero_luz',
        'numero_agua',
        'numero_gas',
        'empresa_luz',
        'empresa_agua',
        'empresa_gas',
        'tipo_vivienda',
        // Datos Arriendo
        'inicio_contrato',
        'mantenimiento',
        'reajuste_anual',
        // Datos de Venta
        'deuda_hipotecaria',
        'contribuciones',
        'derechos_aseo',
        'exclusividad',
        'sello_verde',

        'tipo_propiedad',
        'estado',
        'id_detalle_propiedad',
        'id_propietario',
    ];

    public function imagenes()
    {
        return $this->hasMany(ImgPropiedad::class, 'id_propiedad', 'id');
    }
    public function detallePropiedad()
    {
        return $this->belongsTo(DetallePropiedad::class, 'id_propiedad','id');
    }
    public function subdetalles()
    {
        return $this->belongsTo(SubDetalles::class, 'id_propiedad','id');
    }
    public function propietario()
    {
        return $this->belongsToMany(
            Propietario::class,
            'propietario_propiedades', // tabla pivote
            'id_propiedad',            // columna en pivote que referencia la propiedad
            'id_propietario'           // columna en pivote que referencia el propietario
        );
    }
    
}
