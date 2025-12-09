<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgGasfiteria extends Model
{
    use HasFactory;

    protected $table = 'img_gasfiterias';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'link',
        'tipo',
        'id_gasfiteria',
    ];

    public function gasfiteria()
    {
        return $this->belongsTo(Gasfiteria::class, 'id_gasfiteria');
    }
}
