<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('propiedads', function (Blueprint $table) {
            $table->string('institucion')->nullable()->after('tipo_moneda_deuda');
        });
    }

    public function down(): void
    {
        Schema::table('propiedads', function (Blueprint $table) {
            $table->dropColumn('institucion');
        });
    }
};