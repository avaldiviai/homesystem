<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->dateTime('inicio')->nullable();
            $table->dateTime('fin')->nullable();
            $table->string('total')->nullable(); // Cambiado a un entero sin signo
            $table->string('color')->nullable(); // Agregar este campo para el color
            $table->string('dia')->nullable(); // Agregar campo para "Día"
            $table->string('precio_dia')->nullable(); // Agregar campo para "Precio Día"
            $table->string('estado')->nullable(); // Agregar campo para "Estado"

            $table->string('monto')->nullable();

            $table->unsignedBigInteger('id_verano')->nullable();
            $table->foreign('id_verano')->references('id')->on('veranos');
            
            $table->timestamps(); // Para las columnas created_at y updated_at
        });

        
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}

