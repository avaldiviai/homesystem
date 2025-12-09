<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDetalles extends Model
{
    use HasFactory;
    protected $table = 'sub_detalles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'monto',
        'rol',
        'estacionamiento',
        'bodega',
        'techado',
        'tipo_propiedad',
        'id_propiedad',
    ];
}
