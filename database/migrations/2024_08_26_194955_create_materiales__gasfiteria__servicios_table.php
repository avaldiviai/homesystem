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
        Schema::create('materiales__gasfiteria__servicios', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->integer('precio');

            $table->unsignedBigInteger('id_gasfiteria')->nullable();
            $table->foreign('id_gasfiteria')->references('id')->on('gasfiterias');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales__gasfiteria__servicios');
    }
};
