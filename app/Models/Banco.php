<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{ protected $fillable = ['nombre_banco', 'codigo_swift', 'pais_banco', 'moneda'];

    public function datosBancarios()
    {
        return $this->hasMany(DatosBancario::class);
    }
    use HasFactory;
}
