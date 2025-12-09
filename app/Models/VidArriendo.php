<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VidArriendo extends Model
{
    use HasFactory;

    protected $table = 'vid_arriendos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'video',
        'estado',
        'id_arriendo',
    ];
}
