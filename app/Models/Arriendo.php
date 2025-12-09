<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arriendo extends Model
{
    use HasFactory;

    protected $table = 'arriendos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha_devolucion',
        'fecha_entrega',
        'valor_arriendo',
        'mes_garantia',
        'gastos_comunes',
        'fecha_pago',
        'id_propiedad',
        'id_arrendatario',
        'id_comision',
    ];

    public function propiedad() {
        return $this->belongsTo('App\Models\Propiedad', 'id_propiedad');
    }
    public function arrendatario() {
        return $this->belongsTo('App\Models\Arrendatario', 'id_arrendatario');
    }
    public function comision() {
        return $this->belongsTo('App\Models\Comision', 'id_comision');  
    }
    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'id_arriendo'); // Define la relación con Contrato
    }
}
