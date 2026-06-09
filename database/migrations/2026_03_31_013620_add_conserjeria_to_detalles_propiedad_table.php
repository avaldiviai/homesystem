<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detalles_propiedad', function (Blueprint $table) {
            $table->tinyInteger('conserjeria')->nullable()->after('area_verde');
        });
    }

    public function down(): void
    {
        Schema::table('detalles_propiedad', function (Blueprint $table) {
            $table->dropColumn('conserjeria');
        });
    }
};