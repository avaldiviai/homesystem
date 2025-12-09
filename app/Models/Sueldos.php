<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sueldos extends Model
{
    use HasFactory;
    protected $fillable = [
        'sueldos',
        'id_user',
    ];
    protected $table = 'sueldos';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
}
