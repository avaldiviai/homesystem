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
        Schema::table('propiedads', function (Blueprint $table) {
            $table->string('monto_contribuciones')->nullable()->after('contribuciones');
            $table->string('monto_derechos_aseo')->nullable()->after('derechos_aseo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('propiedads', function (Blueprint $table) {
            $table->dropColumn(['monto_contribuciones', 'monto_derechos_aseo']);
        });
    }
};