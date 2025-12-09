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
        Schema::create('sub_detalles', function (Blueprint $table) {
            $table->id();
            
            $table->string('monto')->nullable();
            $table->string('rol')->nullable();
            $table->string('estacionamiento')->nullable();
            $table->string('bodega')->nullable();
            $table->string('techado')->nullable();
            // identificar el tipo de propiedad
            $table->integer('tipo_propiedad')->nullable();
            $table->integer('tipo_detalle')->nullable();
            
            $table->unsignedBigInteger('id_propiedad')->nullable();
            $table->foreign('id_propiedad')->references('id')->on('propiedads');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_detalles');
    }
};
