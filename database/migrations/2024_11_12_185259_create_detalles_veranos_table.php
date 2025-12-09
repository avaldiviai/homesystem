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
        Schema::create('detalles_veranos', function (Blueprint $table) {
            $table->id();
               //servicios //
            $table->string('wifi')->nullable();
            $table->string('cable')->nullable();
            $table->string('lavadora')->nullable(); 
            $table->string('sabanas')->nullable();          
            $table->string('piscina')->nullable();
            $table->string('estacionamientos')->nullable();
            $table->string('num_estaciona')->nullable();
            $table->string('Consergeria')->nullable();
            $table->string('ascensor')->nullable();
            $table->string('juegos_infantiles')->nullable();
            $table->string('servi_lavanderia')->nullable();
            $table->string('quinchos')->nullable();
            $table->string('sala_multiuso')->nullable();
            $table->string('terraza')->nullable();
            $table->integer('status')->nullable();

            $table->string('inventario')->nullable();
            $table->string('acta_entrega')->nullable();
            $table->string('video')->nullable();

            $table->unsignedBigInteger('id_verano')->nullable(); // Llave foránea
            $table->foreign('id_verano') ->references('id')->on('veranos')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_veranos');
    }
};
