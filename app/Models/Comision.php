<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    use HasFactory;

    protected $table = 'comisions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'porcentaje',
    ];
}
