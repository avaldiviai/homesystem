<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgOMenores extends Model
{
    use HasFactory;

    protected $table = 'img_o_menores';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'link',
        'tipo',
        'id_obramenor',
    ];

    public function obramenor()
    {
        return $this->belongsTo(ObrasMenores::class, 'id_obramenor');
    }

    public function materiales()
    {
        return $this->hasMany(Materiales_OMe_Servicio::class,'id_ome');
    }
}
