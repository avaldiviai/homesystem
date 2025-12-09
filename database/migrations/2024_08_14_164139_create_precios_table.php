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
        Schema::create('precios', function (Blueprint $table) {
            $table->id();

            $table->string('enero')->nullable();
            $table->string('febrero')->nullable();
            $table->string('marzo_dic')->nullable();

            $table->string('ano_corrido')->nullable();
            $table->string('diciembre')->nullable();
            $table->string('dia')->nullable();

            $table->string('venta')->nullable();

            $table->string('tipo_propiedad');
            $table->string('estado');


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
        Schema::dropIfExists('precios');
    }
};
