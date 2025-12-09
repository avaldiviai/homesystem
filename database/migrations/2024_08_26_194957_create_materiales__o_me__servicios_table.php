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
        Schema::create('materiales__o_me__servicios', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->integer('precio');

            $table->unsignedBigInteger('id_ome')->nullable();
            $table->foreign('id_ome')->references('id')->on('obras_menores');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales__o_me__servicios');
    }
};
