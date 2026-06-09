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
        Schema::table('detalles_veranos', function (Blueprint $table) {
            $table->string('gimnasion')->nullable()->after('terraza');
        });
    }

    public function down(): void
    {
        Schema::table('detalles_veranos', function (Blueprint $table) {
            $table->dropColumn('gimnasion');
        });
    }
};
