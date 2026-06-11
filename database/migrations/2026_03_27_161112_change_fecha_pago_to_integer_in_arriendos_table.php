<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('arriendos', function (Blueprint $table) {
            // Cambiamos de DATE a INTEGER para que acepte solo el número del día
            $table->integer('fecha_pago')->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arriendos', function (Blueprint $table) {
            // Por si necesitas revertir, lo devolvemos a DATE
            $table->date('fecha_pago')->change();
        });
    }
};
