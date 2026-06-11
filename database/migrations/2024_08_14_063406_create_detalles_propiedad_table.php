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
        Schema::create('detalles_propiedad', function (Blueprint $table) {
            $table->id();

            $table->year('ano_construccion')->nullable();
            $table->integer('piso')->nullable();
            $table->integer('dormitorios')->nullable();
            $table->integer('banos')->nullable();
            $table->string('orientacion')->nullable();
            $table->string('cocina')->nullable();
            $table->string('logia')->nullable();
            $table->string('agua_caliente')->nullable();
            $table->string('espacio_lavadora')->nullable();
            $table->string('lavadora')->nullable();
            $table->text('inventario')->nullable();
            $table->integer('mt2_total')->nullable();
            $table->integer('mt2_construido')->nullable();
            $table->integer('mt2_terraza')->nullable();
            $table->string('estacionamiento_visitas')->nullable();
            $table->string('ascensor')->nullable();
            $table->string('juegos_infantiles')->nullable();
            $table->string('lavanderia')->nullable();
            $table->string('quinchos')->nullable();
            $table->string('sala_multiuso')->nullable();
            $table->string('gimnasio')->nullable();
            $table->string('ciclovia')->nullable();
            $table->string('area_verde')->nullable();
            $table->string('piscina')->nullable();
            $table->integer('gasto_comun')->nullable();
            $table->string('descripcion')->nullable();
            // identificar el tipo de propiedad
            $table->integer('tipo_propiedad');
            
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
        Schema::dropIfExists('detalles_propiedad');
    }
};
