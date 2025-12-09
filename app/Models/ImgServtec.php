<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgServtec extends Model
{
    use HasFactory;

    protected $table = 'img_servtecs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'link',
        'tipo',
        'id_servtec',
    ];

    public function servtec()
    {
        return $this->belongsTo(ServtecLineaBlanca::class, 'id_servtec');
    }
}
