<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgPropiedad extends Model
{
    use HasFactory;

    protected $table = 'img_propiedads';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'link',
        'id_propiedad',
        'seccion',
    ];
}