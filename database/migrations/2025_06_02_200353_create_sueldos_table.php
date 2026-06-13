<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sueldos', function (Blueprint $table) {
            $table->id();

            $table->decimal('total_mes', 15, 2)->nullable();   // monto del sueldo
            $table->string('nombre_archivo')->nullable();       // nombre original del archivo
            $table->string('documento')->nullable();            // ruta guardada
            $table->date('fecha');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sueldos');
    }
};