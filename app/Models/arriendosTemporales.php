<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arriendosTemporales extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'total',
        'archivo',
    ];
}
