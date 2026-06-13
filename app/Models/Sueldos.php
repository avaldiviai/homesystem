<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sueldos extends Model
{
    use HasFactory;

    protected $table = 'sueldos';

    protected $fillable = [
    'total_mes',
    'nombre_archivo',
    'documento',
    'fecha',
    'id_user',
];

    protected $casts = [
        'total_mes' => 'decimal:2',
        'fecha'     => 'date:Y-m-d',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}