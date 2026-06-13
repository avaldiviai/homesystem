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
        'fecha_reajuste',    
        'valor_arriendo',
        'mes_garantia',
        'gastos_comunes',
        'valor_real',        
        'reajuste_ipc',      
        'estado',           
        'id_propiedad',
        'id_arrendatario',
        'id_comision',
        'id_estadopagos',    
    ];

    protected $casts = [
        'fecha_entrega'    => 'date',
        'fecha_reajuste'   => 'date',
        'fecha_devolucion' => 'date',
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
    public function contratos() {
        return $this->hasMany(Contrato::class, 'id_arriendo');
    }
}