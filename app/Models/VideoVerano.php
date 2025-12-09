<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class videoVerano extends Model
{
    use HasFactory;

    protected $table = 'video_veranos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'link',
        'id_detalle_verano',
    ];
    public function videodetalles()
    {
        return $this->belongsTo(DetallesVerano::class);
    }
    
}
