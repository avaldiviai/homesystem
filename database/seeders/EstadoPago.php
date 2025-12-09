<?php

namespace Database\Seeders;

use App\Models\EstadoPagos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoPago extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $estado1 = EstadoPagos::create([
            'estado' => "Pagado",
        ]);
        $estado2 = EstadoPagos::create([
            'estado' => "Pendiente",
        ]);
    }
}
