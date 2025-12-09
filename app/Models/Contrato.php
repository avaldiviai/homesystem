<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'contratos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'contrato',
        'id_arriendo',
    ];

    public function arriendo()
    {
        return $this->belongsTo(Arriendo::class, 'id_arriendo');
    }
    public function propiedades()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad');
    }
}
