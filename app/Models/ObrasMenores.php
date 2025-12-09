<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObrasMenores extends Model
{
    use HasFactory;

    protected $table = 'obras_menores';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha',
        'lugar_prop',
        'motivo',
        'trabajo_realizado',
        'mano_obra_valor',
        'materiales_repuestos',        
        'garantia',
        'valor_total',
        'trabajador',
        'id_propiedad',
        'estado',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad');
    }

    public function imagenes()
    {
        return $this->hasMany(ImgOMenores::class, 'id_obramenor');
    }
}
