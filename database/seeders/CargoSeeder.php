<?php

namespace Database\Seeders;
use App\Models\Cargo;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cargo = Cargo::create([
            'nombre' => "admin",
        ]);
        $cargo = Cargo::create([
            'nombre' => "trabajador",
        ]);
        $cargo = Cargo::create([
            'nombre' => "obrero",
        ]);
    }
}
