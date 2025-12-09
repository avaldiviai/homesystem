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
        Schema::create('elementos_propiedads', function (Blueprint $table) {
            $table->id();

            $table->string('observacion', 255)->nullable();
            
            $table->unsignedBigInteger('id_propiedad')->nullable(false);
            $table->foreign('id_propiedad')->references('id')->on('propiedads');

            $table->unsignedBigInteger('id_elementos')->nullable(false);
            $table->foreign('id_elementos')->references('id')->on('elementos');

          

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementos_propiedads');
    }
};
