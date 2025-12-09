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
        Schema::create('tipo_agua_calientes', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->nullable(false);
            $table->string('marca')->nullable(false);
            $table->string('modelo')->nullable();
            $table->date('fecha_entrega')->nullable();

            $table->unsignedBigInteger('id_propiedad')->nullable(false);
            $table->foreign('id_propiedad')->references('id')->on('propiedads');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_agua_calientes');
    }
};
