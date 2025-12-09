<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'mes',
        'año',
        'documento_pago',
        'estado',
        'id_arriendo',
    ];
    public function arriendo() {
        return $this->belongsTo('App\Models\Arriendo', 'id_arriendo');  
    }
}
