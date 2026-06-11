<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('veranos', function (Blueprint $table) {
            $table->string('sector')->nullable()->change();
            $table->string('condominio')->nullable()->change();
            $table->string('torre')->nullable()->change();
            $table->string('num_apartamento')->nullable()->change();
            $table->string('piso')->nullable()->change();
            $table->string('ubicacion')->nullable()->change();
            $table->string('dormitorios')->nullable()->change();
            $table->string('Tpiso_dormitorios')->nullable()->change();
            $table->string('baños')->nullable()->change();
            $table->string('tipo_cocina')->nullable()->change();
            $table->string('personas')->nullable()->change();
            $table->string('precio_min_enero')->nullable()->change();
            $table->string('precio_max_enero')->nullable()->change();
            $table->string('precio_min_febrero')->nullable()->change();
            $table->string('precio_max_febrero')->nullable()->change();
            $table->string('equipado')->nullable()->change();
        });
    }

    public function down(): void
    {
        // reversión opcional
    }
};
