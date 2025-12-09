<?php

namespace Database\Seeders;
use App\Models\Comision;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $comision1 = Comision::create([
            'porcentaje' => "10%",
        ]);
        $comision2 = Comision::create([
            'porcentaje' => "15%",
        ]);
        $comision3 = Comision::create([
            'porcentaje' => "20%",
        ]);
    }
}
