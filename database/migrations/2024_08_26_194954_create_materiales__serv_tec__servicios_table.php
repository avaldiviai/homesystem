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
        Schema::create('materiales__serv_tec__servicios', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->integer('precio');

            $table->unsignedBigInteger('id_servtec')->nullable();
            $table->foreign('id_servtec')->references('id')->on('servtec_linea_blancas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales__serv_tec__servicios');
    }
};
