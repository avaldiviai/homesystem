<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropietarioVerano extends Model
{
    use HasFactory;
    protected $table = 'propietario_verano';
    protected $fillable = [
        
        'id_propietario',
        'id_verano',
    ];
    public function verano()
    {
        return $this->belongsTo('App\Models\Verano', 'id_verano');
    }
    public function propietario()
    {
        return $this->belongsTo('App\Models\Propietario', 'id_propietario');
    }
}
