<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosBancario extends Model
{ protected $fillable = ['nombre_banco','numero_cuenta', 'tipo_cuenta', 'id_propietario'];

    public function propietario()
    {
        return $this->belongsTo('App\Models\Propietario', 'id_propietario');
    }

    
    use HasFactory;
}
