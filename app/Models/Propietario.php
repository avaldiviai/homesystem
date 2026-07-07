<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory;

    protected $table = 'propietarios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'rut',
        'telefono',
        'correo',
        'direccion',
        'direccion',
        'estado',
    ];
    public function datosBancarios()
    {
        return $this->hasMany(DatosBancario::class, 'id_propietario');
    }
}
