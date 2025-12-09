<?php
// app/Models/Image.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgVerano extends Model
{
    use HasFactory;

    protected $table = 'img_veranos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'link',
        'id_detalle_verano',
    ];
    

    // Definir la relación con DetallesVerano
    public function detallesVerano()
    {
        return $this->belongsTo(DetallesVerano::class, 'id_detalles_verano');
    }

 


}