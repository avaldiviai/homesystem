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
        Schema::create('materiales__o_ma__servicios', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->integer('precio');

            $table->unsignedBigInteger('id_oma')->nullable();
            $table->foreign('id_oma')->references('id')->on('obras_mayores');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales__o_ma__servicios');
    }
};
