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
        Schema::create('img_veranos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('link');

            $table->unsignedBigInteger('id_detalles_verano')->nullable(false);
            $table->foreign('id_detalles_verano')->references('id')->on('detalles_veranos')->onDelete('cascade'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('img_veranos');
    }
};
