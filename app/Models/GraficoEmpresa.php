<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraficoEmpresa extends Model
{
    use HasFactory;

    protected $table = 'graficos_empresa';

    protected $fillable = [
        'año', 'mes',
        // Ingresos
        'adm_total', 'arriendos_cantidad', 'arriendos_pesos',
        'ventas_cantidad', 'ventas_pesos', 'obras_menores_pesos',
        'arriendo_temp_pesos', 'arriendo_temp_aseo',
        // Egresos
        'egr_sii', 'egr_kutt', 'egr_sueldos',
        'egr_cotizaciones', 'egr_contador', 'egr_otros',
    ];

    protected $casts = [
        'año'                  => 'integer',
        'mes'                  => 'integer',
        'adm_total'            => 'float',
        'arriendos_cantidad'   => 'integer',
        'arriendos_pesos'      => 'float',
        'ventas_cantidad'      => 'integer',
        'ventas_pesos'         => 'float',
        'obras_menores_pesos'  => 'float',
        'arriendo_temp_pesos'  => 'float',
        'arriendo_temp_aseo'   => 'float',
        'egr_sii'              => 'float',
        'egr_kutt'             => 'float',
        'egr_sueldos'          => 'float',
        'egr_cotizaciones'     => 'float',
        'egr_contador'         => 'float',
        'egr_otros'            => 'float',
    ];

    // ── Helpers ────────────────────────────────────────────────────────────────

    /** 10% de adm_total (valor que va al gráfico) */
    public function getAdmGraficoAttribute(): float
    {
        return $this->adm_total * 0.10;
    }

    /** Suma total de ingresos para el gráfico */
    public function getTotalIngresosAttribute(): float
    {
        return $this->adm_grafico
            + $this->arriendos_pesos
            + $this->ventas_pesos
            + $this->obras_menores_pesos
            + $this->arriendo_temp_pesos
            + $this->arriendo_temp_aseo;
    }

    /** Suma total de egresos */
    public function getTotalEgresosAttribute(): float
    {
        return $this->egr_sii
            + $this->egr_kutt
            + $this->egr_sueldos
            + $this->egr_cotizaciones
            + $this->egr_contador
            + $this->egr_otros;
    }

    /** Nombres de meses en español */
    public static function nombreMes(int $mes): string
    {
        return [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo',
            4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
            7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre',
            10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
        ][$mes] ?? 'Desconocido';
    }
}