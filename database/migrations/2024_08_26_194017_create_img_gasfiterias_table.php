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
        Schema::create('img_gasfiterias', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('link');
            $table->string('tipo');

            $table->unsignedBigInteger('id_gasfiteria')->nullable(false);
            $table->foreign('id_gasfiteria')->references('id')->on('gasfiterias');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('img_gasfiterias');
    }
};
