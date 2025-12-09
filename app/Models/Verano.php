<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verano extends Model
{
    use HasFactory;
    
    protected $table = 'veranos';
    protected $fillable = [
        'id_propietario', 'direccion', 'ciudad', 'sector', 'condominio', 'torre', 'estacionamientos',
        'cantidad_personas', 'ubicacion', 'servicios', 'precio_min_enero','precio_max_enero', 'precio_min_febrero','precio_max_febrero',
        'equipado', 'tipo_piso', 'mascotas','id_propietario'
    ];

     // Define la relación con Propiedad
     public function verano()
     {
         return $this->belongsTo(Propietario::class, 'id_propirtario');
     }
     // Definir la relación con DetallesVerano
     public function detallesVeranos()
     {
         return $this->hasMany(DetallesVerano::class, 'id_verano','id');
     }
     public function propietarioverano()
     {
         return $this->belongsTo(PropietarioVerano::class, 'id_verano','id');
     }
    // public function detalles()
    // {
    //     return $this->hasMany(DetallesVerano::class, 'id_verano');
    // }
//     public function detallesVerano()
// {
//     return $this->hasOne(DetallesVerano::class, 'id_verano', 'id');
// }

    
}
