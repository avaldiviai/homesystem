<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosBancarioUser extends Model
{
    use HasFactory;

    protected $table = 'datos_bancarios_user';

    protected $fillable = [
        'nombre_banco',
        'numero_cuenta',
        'tipo_cuenta',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}