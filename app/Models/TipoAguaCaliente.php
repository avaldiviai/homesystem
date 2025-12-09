<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAguaCaliente extends Model
{
    use HasFactory;

    protected $table = 'tipo_agua_calientes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'marca',
        'modelo',
        'fecha_entrega',
        'id_propiedad',
    ];
}
