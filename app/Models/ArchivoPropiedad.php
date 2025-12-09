<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoPropiedad extends Model
{
    use HasFactory;
    protected $table = 'archivos_propiedads';

    protected $primaryKey = 'id';

    protected $fillable = [
        'archivo',
        'id_propiedad',
    ];

    public function propiedads()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad');
    }
}
