<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_verano',
        'inicio',
        'fin',
        'total',
        'color',
        'dia',       
        'monto',       



    ];

    public function verano()
{
    return $this->belongsTo(Verano::class, 'id_verano');
}

    protected $dates = ['id_verano', 'fin', 'cobro', 'color','dia', 'monto']; // Esto asegurará que las fechas sean gestionadas correctamente
}
