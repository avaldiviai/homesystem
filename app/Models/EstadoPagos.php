<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPagos extends Model
{
    use HasFactory;
    protected $fillable = [
        'estado',
    ];
}
