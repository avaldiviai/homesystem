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
        Schema::create('arriendos_temporales', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('total', 12, 2)->default(0);
            $table->string('archivo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arriendos_temporales');
    }
};
