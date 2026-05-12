<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanillaEmpresa extends Model
{
    use HasFactory;

    protected $table = 'planillas_empresa';

    protected $fillable = [
        'fecha',
        'documento',
        'nombre_archivo',
        'total_mes',
        'tipo',
    ];

    protected $casts = [
        'fecha'     => 'date',
        'total_mes' => 'decimal:2',
        'tipo'      => 'integer',
    ];

    /**
     * Nombres descriptivos por tipo.
     */
    public static function nombreTipo(int $tipo): string
    {
        return match ($tipo) {
            1 => 'Planilla 10% Administración',
            2 => 'Planilla Arriendos Mensuales',
            3 => 'Planilla Ventas',
            4 => 'Planilla Obras',
            5 => 'Sueldos',
            6 => 'Planilla Arqueo',
            default => 'Desconocido',
        };
    }

    /**
     * Valor real para el gráfico (aplica 10% si tipo === 1, 0 si tipo === 6).
     */
    public function getValorGraficoAttribute(): float
    {
        if ($this->tipo === 6) return 0;
        if ($this->tipo === 1) return (float) $this->total_mes * 0.10;
        return (float) $this->total_mes;
    }
}