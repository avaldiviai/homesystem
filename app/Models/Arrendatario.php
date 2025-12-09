<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrendatario extends Model
{
    use HasFactory;

    protected $table = 'arrendatarios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'rut',
        'telefono',
        'correo',
        'direccion',        
        'ciudad',
        'estado',
    ];
}
