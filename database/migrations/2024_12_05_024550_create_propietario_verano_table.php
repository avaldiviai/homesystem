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
        Schema::create('propietario_verano', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_propietario');
            $table->foreign('id_propietario')->references('id')->on('propietarios');

            $table->unsignedBigInteger('id_verano');
            $table->foreign('id_verano')->references('id')->on('veranos');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propietario_verano');
    }
};
