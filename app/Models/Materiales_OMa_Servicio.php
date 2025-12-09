<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiales_OMa_Servicio extends Model
{
    use HasFactory;

    protected $table = 'materiales__o_ma__servicios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'precio',
        'id_oma',          
    ];    

    public function servicio()
    {
        return $this->belongsTo(ObrasMayores::class, 'id_oma');
    }
    
}
