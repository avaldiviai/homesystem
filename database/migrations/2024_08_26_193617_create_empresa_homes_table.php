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
        Schema::create('empresa_homes', function (Blueprint $table) {
            $table->id();

            $table->string('planilla_adm')->nullable(false);
            $table->string('planilla_arriendo')->nullable(false);
            $table->string('planilla_obras')->nullable(false);
            $table->string('planilla_arqueo')->nullable(false);
            $table->integer('ingresos')->nullable(false);
            $table->integer('devoluciones')->nullable(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_homes');
    }
};
