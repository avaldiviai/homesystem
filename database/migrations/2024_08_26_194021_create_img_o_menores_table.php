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
        Schema::create('img_o_menores', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('link');
            $table->string('tipo');

            $table->unsignedBigInteger('id_obramenor')->nullable(false);
            $table->foreign('id_obramenor')->references('id')->on('obras_menores');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('img_o_menores');
    }
};
