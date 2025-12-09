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
        Schema::create('veranos', function (Blueprint $table) {
            $table->id();

            $table->string('direccion');
            $table->string('ciudad');

            $table->text('sector');
            $table->string('condominio');
            $table->string('torre');
            $table->string('num_apartamento');
            $table->string('piso');
            $table->string('ubicacion');
            $table->string('dormitorios');
            $table->string('Tpiso_dormitorios');
            $table->string('baños');
            $table->string('tipo_cocina');
            $table->string('personas');
            $table->string('precio_min_enero');
            $table->string('precio_max_enero');
            $table->string('precio_min_febrero');
            $table->string('precio_max_febrero');
            $table->string('equipado');
            $table->string('mascotas')->nullable();
            $table->string('valor_adicional')->nullable();
            $table->integer('estado');
            // $table->unsignedBigInteger('id_propietario')->nullable();
            // $table->foreign('id_propietario')->references('id')->on('propietarios');

            // $table->unsignedBigInteger('id_detalle_verano')->nullable();
            // $table->foreign('id_detalle_verano')->references('id')->on('detalles_veranos');

    

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veranos');
    }
};
