<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoletasFacturasServtec extends Model
{
    use HasFactory;

    protected $table = 'boletas_facturas_servtecs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'documento',
        'id_servtec',
    ];
}
