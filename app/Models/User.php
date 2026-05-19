<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rut',
        'direccion',
        'id_cargo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relación con cargo
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'id_cargo');
    }

    // Relación con archivos RRHH
    public function archivosRrhh()
    {
        return $this->hasMany(ArchivoRrhh::class, 'id_user');
    }
}