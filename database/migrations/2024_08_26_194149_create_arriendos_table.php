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
        Schema::create('arriendos', function (Blueprint $table) {
            $table->id();

            $table->date('fecha_devolucion')->nullable(true);
            $table->date('fecha_entrega')->nullable(false);
            $table->string('valor_arriendo')->nullable();
            $table->string('mes_garantia')->nullable();
            $table->string('gastos_comunes')->nullable(false);
            $table->string('valor_real')->nullable(false);
            $table->string('reajuste_ipc')->nullable;
            $table->date('fecha_pago')->nullable(false);
            $table->tinyInteger('estado')->nullable(false);

            $table->unsignedBigInteger('id_propiedad')->nullable(false);
            $table->foreign('id_propiedad')->references('id')->on('propiedads');

            $table->unsignedBigInteger('id_arrendatario')->nullable(false);
            $table->foreign('id_arrendatario')->references('id')->on('arrendatarios');

            $table->unsignedBigInteger('id_comision')->nullable(false);
            $table->foreign('id_comision')->references('id')->on('comisions');

            $table->unsignedBigInteger('id_estadopagos')->nullable(false);
            $table->foreign('id_estadopagos')->references('id')->on('estado_pagos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arriendos');
    }
};
