<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServtecLineaBlanca extends Model
{
    use HasFactory;

    protected $table = 'servtec_linea_blancas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha',
        'trabajo_realizado',
        'mano_obra_valor',
        'garantia',
        'valor_total',
        'id_propiedad',        
        'id_trabajador',
        'nombre_trabajador',  
        'estado',      
    ];    

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad');
    }

    public function imagenes()
    {
        return $this->hasMany(ImgServtec::class, 'id_servtec');
    }

    public function materiales()
    {
        return $this->hasMany(Materiales_ServTec_Servicio::class,'id_servtec');
    }
}
