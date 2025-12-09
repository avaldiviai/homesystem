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
        Schema::create('vid_arriendos', function (Blueprint $table) {
            $table->id();

            $table->string('video');
            $table->string('estado');

            $table->unsignedBigInteger('id_propiedad')->nullable(false);
            $table->foreign('id_propiedad')->references('id')->on('propiedads');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vid_arriendos');
    }
};
