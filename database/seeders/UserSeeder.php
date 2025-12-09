<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => "Administrador",
            'email' => "admin@gg.cl",
            'password' => Hash::make('12345'),
            'id_cargo' => 1,
        ]);
        $user = User::create([
            'name' => "Trabajador",
            'email' => "trabajador@gg.cl",
            'password' => Hash::make('12345'),
            'id_cargo' => 2,
        ]);
        $user = User::create([
            'name' => "obrero",
            'email' => "obrero@gg.cl",
            'password' => Hash::make('12345'),
            'id_cargo' => 3,
        ]);
    }
}
