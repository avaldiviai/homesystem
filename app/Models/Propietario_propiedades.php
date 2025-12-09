<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario_propiedades extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_propiedad',
        'id_propietario',
    
    ];
    public function propiedad()
    {
        return $this->belongsTo('App\Models\Propiedad', 'id_propiedad');
    }
    public function propietario()
    {
        return $this->belongsTo('App\Models\Propietario', 'id_propietario');
    }
}
