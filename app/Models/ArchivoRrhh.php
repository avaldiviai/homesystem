<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoRrhh extends Model
{
    use HasFactory;

    protected $table = 'archivos_rrhh';

    protected $fillable = [
        'nombre_archivo',
        'ruta_archivo',
        'tipo_archivo',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}