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
        Schema::create('propiedads', function (Blueprint $table) {
            $table->id();

            $table->string('direccion');
            $table->text('maps');
            $table->string('condominio');
            // $table->integer('num_estacionamiento');
            $table->integer('num_torre');
            $table->string('torre');
            $table->text('descripcion')->nullable();
            $table->string('rol');
            $table->integer('numero_luz');
            $table->text('numero_agua');
            $table->integer('numero_gas');
            $table->string('empresa_luz');
            $table->string('empresa_agua');
            $table->string('empresa_gas');
            $table->string('tipo_vivienda')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('estado_venta')->nullable();



            // Datos Arriendo
            $table->date('inicio_contrato')->nullable();
            $table->date('mantenimiento')->nullable();
            $table->date('reajuste_anual')->nullable();

            // Datos de Venta
            $table->string('deuda_hipotecaria')->nullable();
            $table->string('contribuciones')->nullable();
            $table->string('derechos_aseo')->nullable();
            $table->string('exclusividad')->nullable();
            $table->string('sello_verde')->nullable();

            $table->integer('tipo_propiedad');

            $table->integer('estado');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedads');
    }
};
