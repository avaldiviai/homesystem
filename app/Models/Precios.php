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
        'tipo_propiedad'
    ];
}
