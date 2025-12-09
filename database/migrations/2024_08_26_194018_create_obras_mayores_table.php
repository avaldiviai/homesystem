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
        Schema::create('obras_mayores', function (Blueprint $table) {
            $table->id();

            $table->date('fecha');            
            $table->string('trabajo_realizado');
            $table->integer('mano_obra_valor')->nullable();            
            $table->integer('garantia')->nullable();
            $table->integer('valor_total')->nullable();            
            
            $table->unsignedBigInteger('id_propiedad')->nullable(false);
            $table->foreign('id_propiedad')->references('id')->on('propiedads');

            $table->unsignedBigInteger('id_trabajador')->nullable();
            $table->foreign('id_trabajador')->references('id')->on('users');

            $table->string('nombre_trabajador');
            $table->string('estado')->default('Pendiente'); // Agrega el campo de estado con valor por defecto 'Pendiente'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obras_mayores');
    }
};
