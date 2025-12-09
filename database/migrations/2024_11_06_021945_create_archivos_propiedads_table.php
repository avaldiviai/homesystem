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
        Schema::create('archivos_propiedads', function (Blueprint $table) {
            $table->id();

            $table->string('archivo')->nullable();
            $table->string('inventario')->nullable();
            $table->string('contrato')->nullable();
            $table->string('acta_entrega')->nullable();
            $table->string('poder_adm')->nullable();
            $table->string('tipo')->nullable();

            $table->unsignedBigInteger('id_propiedad')->nullable();
            $table->foreign('id_propiedad')->references('id')->on('propiedads')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos_propiedads');
    }
};
