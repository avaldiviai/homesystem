<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesVerano extends Model
{
    
    use HasFactory;
    protected $table = 'detalles_veranos';
    protected $fillable = [
        'wifi',
        'cable',
        'lavadora',
        'piscina',
        'estacionamientos',
        'num_estaciona',
        'Consergeria',
        'ascensor',
        'juegos_infantiles',
        'servi_lavanderia',
        'quinchos',
        'sala_multiuso',
        'terraza',
        'id_verano',
        'status',
      
    ];// Relación con Verano


    public function verano()
    {
        return $this->belongsTo(Verano::class, 'id_verano');
    }
    // Definir la relación con ImgVerano
    public function imagenes()
    {
        return $this->hasMany(ImgVerano::class, 'id_detalles_verano');
    }

    public function videos()
    {
        return $this->hasMany(VideoVerano::class,'id_detalles_verano');
    }

    

}
