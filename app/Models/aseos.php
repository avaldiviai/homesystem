<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aseos extends Model
{
    use HasFactory;
    protected $table = 'aseos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fecha',
        'total',
        'archivo',
    ];
}
