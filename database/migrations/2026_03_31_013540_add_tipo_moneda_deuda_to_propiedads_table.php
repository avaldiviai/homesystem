<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('propiedads', function (Blueprint $table) {
            $table->string('tipo_moneda_deuda', 3)->nullable()->default('CLP')->after('deuda_hipotecaria');
        });
    }

    public function down(): void
    {
        Schema::table('propiedads', function (Blueprint $table) {
            $table->dropColumn('tipo_moneda_deuda');
        });
    }
};