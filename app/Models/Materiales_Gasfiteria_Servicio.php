<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiales_Gasfiteria_Servicio extends Model
{
    use HasFactory;

    protected $table = 'materiales__gasfiteria__servicios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'precio',
        'id_gasfiteria',          
    ];    

    public function servicio()
    {
        return $this->belongsTo(Gasfiteria::class, 'id_gasfiteria');
    }
    
}
