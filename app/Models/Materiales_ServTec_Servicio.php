<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiales_ServTec_Servicio extends Model
{
    use HasFactory;

    protected $table = 'materiales__serv_tec__servicios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'precio',
        'id_servtec',          
    ];    

    public function servicio()
    {
        return $this->belongsTo(ServtecLineaBlanca::class, 'id_servtec');
    }
}
