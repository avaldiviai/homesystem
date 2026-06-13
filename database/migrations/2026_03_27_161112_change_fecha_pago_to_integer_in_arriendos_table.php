<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * fecha_pago fue eliminada de la tabla arriendos.
     * Ese campo vive en la tabla arrendatarios.
     * Esta migración se deja vacía para no romper el historial de migraciones.
     */
    public function up(): void
    {
        // No se hace nada: fecha_pago no existe en arriendos.
    }

    public function down(): void
    {
        // No se hace nada.
    }
};