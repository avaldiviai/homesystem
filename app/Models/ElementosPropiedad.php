<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementosPropiedad extends Model
{
    use HasFactory;

    protected $table = 'elementos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'observacion',
        'id_propiedad',
        'id_elementos',
    ];
}
