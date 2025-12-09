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
        Schema::create('img_o_mayores', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('link');
            $table->string('tipo');

            $table->unsignedBigInteger('id_obramayor')->nullable(false);
            $table->foreign('id_obramayor')->references('id')->on('obras_mayores');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('img_o_mayores');
    }
};
