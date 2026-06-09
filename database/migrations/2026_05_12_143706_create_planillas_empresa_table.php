<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planillas_empresa', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('documento'); // ruta del archivo excel
            $table->string('nombre_archivo')->nullable();
            $table->decimal('total_mes', 15, 2)->nullable(); // null para arqueo y admin (admin calcula 10%)
            $table->tinyInteger('tipo'); // 1=Admin 2=Arriendos 3=Ventas 4=Obras 5=Sueldos 6=Arqueo
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('planillas_empresa');
    }
};