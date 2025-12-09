<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgOMayores extends Model
{
    use HasFactory;

    protected $table = 'img_o_mayores';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'link',
        'tipo',
        'id_obramayor',
    ];

    public function obramayor()
    {
        return $this->belongsTo(ObrasMayores::class, 'id_obramayor');
    }

    public function materiales()
    {
        return $this->hasMany(Materiales_OMa_Servicio::class,'id_oma');
    }
}
