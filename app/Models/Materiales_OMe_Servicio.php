<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiales_OMe_Servicio extends Model
{
    use HasFactory;

    protected $table = 'materiales__o_me__servicios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'precio',
        'id_ome',          
    ];    

    public function servicio()
    {
        return $this->belongsTo(ObrasMenores::class, 'id_ome');
    }
}
