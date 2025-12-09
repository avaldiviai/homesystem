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
        Schema::create('img_arriendos', function (Blueprint $table) {
            $table->id();

            $table->string('imagen');
            $table->string('estado');

            $table->unsignedBigInteger('id_arriendo')->nullable(false);
            $table->foreign('id_arriendo')->references('id')->on('arriendos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('img_arriendos');
    }
};
