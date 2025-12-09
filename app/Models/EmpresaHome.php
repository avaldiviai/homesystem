<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaHome extends Model
{
    use HasFactory;

    protected $table = 'empresa_homes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'planilla_adm',
        'planilla_arriendo',
        'planilla_obras',
        'planilla_arqueo',
        'ingresos',
        'devoluciones',
    ];
}
