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
        Schema::create('boletas_facturas_servtecs', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('documento');

            $table->unsignedBigInteger('id_servtec')->nullable(false);
            $table->foreign('id_servtec')->references('id')->on('servtec_linea_blancas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boletas_facturas_servtecs');
    }
};
