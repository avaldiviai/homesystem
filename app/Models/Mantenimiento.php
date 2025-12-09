<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_mantencion',   
        'meses',          
        'fecha_prox_man',     
        'envio_correo',   
        'doc',          
        'id_propiedad',          
    ];    
    // En el modelo Mantenimiento
    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad'); // Ajusta 'id_propiedad' según tu base de datos
    }

}
