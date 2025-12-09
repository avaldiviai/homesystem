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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            
            $table->string('nombre');
            $table->text('descripcion');
            $table->date('fecha_mantencion');
            $table->string('meses');
            $table->date('fecha_prox_man')->nullable();
            $table->date('envio_correo')->nullable();

            $table->unsignedBigInteger('id_propiedad');
            $table->foreign('id_propiedad')->references('id')->on('propiedads');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
