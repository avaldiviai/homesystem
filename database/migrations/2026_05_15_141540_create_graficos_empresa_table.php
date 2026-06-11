<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * INGRESOS mensuales de la empresa.
     *
     * Columnas de ingresos:
     *  - adm_total        : Total ingresado en planilla administración (el 10% va al gráfico)
     *  - arriendos_cantidad: Número de arriendos activos en el mes
     *  - arriendos_pesos   : Suma de valor_real de arriendos del mes
     *  - ventas_cantidad   : Número de ventas concretadas en el mes
     *  - ventas_pesos      : Suma de precios de propiedades vendidas en el mes
     *  - obras_menores_pesos: Suma de valor_total de obras menores del mes
     *  - arriendo_temp_pesos: Suma de ingresos por arriendo temporal (Events.total)
     *  - arriendo_temp_aseo : Suma de gastos comunes cobrados en arriendo temporal
     *
     * Columnas de egresos (para implementación futura):
     *  - egr_sii           : Impuestos SII pagados
     *  - egr_kutt          : Gastos KUTT
     *  - egr_sueldos       : Sueldos pagados
     *  - egr_cotizaciones  : Cotizaciones previsionales
     *  - egr_contador      : Honorarios contador
     *  - egr_otros         : Otros egresos
     */
    public function up(): void
    {
        Schema::create('graficos_empresa', function (Blueprint $table) {
            $table->id();

            $table->smallInteger('año');
            $table->tinyInteger('mes'); // 1-12

            // ── INGRESOS ──────────────────────────────────────────────────────
            $table->decimal('adm_total',        15, 2)->default(0); // total bruto (se graficará el 10%)
            $table->integer('arriendos_cantidad')->default(0);
            $table->decimal('arriendos_pesos',   15, 2)->default(0);
            $table->integer('ventas_cantidad')   ->default(0);
            $table->decimal('ventas_pesos',      15, 2)->default(0);
            $table->decimal('obras_menores_pesos',15, 2)->default(0);
            $table->decimal('arriendo_temp_pesos',15, 2)->default(0);
            $table->decimal('arriendo_temp_aseo', 15, 2)->default(0);

            // ── EGRESOS (futuro) ──────────────────────────────────────────────
            $table->decimal('egr_sii',          15, 2)->default(0);
            $table->decimal('egr_kutt',         15, 2)->default(0);
            $table->decimal('egr_sueldos',      15, 2)->default(0);
            $table->decimal('egr_cotizaciones', 15, 2)->default(0);
            $table->decimal('egr_contador',     15, 2)->default(0);
            $table->decimal('egr_otros',        15, 2)->default(0);

            $table->timestamps();

            $table->unique(['año', 'mes']); // un registro por mes/año
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('graficos_empresa');
    }
};