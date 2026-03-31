<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detalles_propiedad', function (Blueprint $table) {
            $table->string('inventario_doc')->nullable()->after('inventario');
        });
    }

    public function down(): void
    {
        Schema::table('detalles_propiedad', function (Blueprint $table) {
            $table->dropColumn('inventario_doc');
        });
    }
};