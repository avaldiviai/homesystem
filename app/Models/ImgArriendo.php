<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgArriendo extends Model
{
    use HasFactory;

    protected $table = 'img_arriendos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'imagen',
        'estado',
        'id_arriendo',
    ];
}
