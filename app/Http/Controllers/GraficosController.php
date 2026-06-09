<?php

namespace App\Http\Controllers;

use App\Models\GraficoEmpresa;
use App\Models\PlanillaEmpresa;
use App\Models\Arriendo;
use App\Models\Propiedad;
use App\Models\Precios;
use App\Models\ObrasMenores;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficosController extends Controller
{
    // ─────────────────────────────────────────────────────────────────────
    // VISTA PRINCIPAL – redirige a mensual
    // GET /graficos
    // ─────────────────────────────────────────────────────────────────────
    public function index()
    {
        return redirect()->route('graficos.mensual');
    }

    // ─────────────────────────────────────────────────────────────────────
    // VISTA MENSUAL – grid de 12 cards
    // GET /graficos/mensual?año=2026
    // ─────────────────────────────────────────────────────────────────────
    public function mensual(Request $request)
    {
        $año = (int) $request->get('año', now()->year);

        // Años disponibles (desde el primer registro hasta el año actual +1)
        $años = $this->añosDisponibles();

        // Obtener / calcular datos para los 12 meses
        $meses = [];
        for ($m = 1; $m <= 12; $m++) {
            $meses[$m] = $this->datosMes($año, $m);
        }

        return view('graficos', compact('año', 'años', 'meses'));
    }

    // ─────────────────────────────────────────────────────────────────────
    // API – datos de un mes concreto (para modal detalle)
    // GET /graficos/mes/{año}/{mes}
    // ─────────────────────────────────────────────────────────────────────
    public function datosMesApi(int $año, int $mes)
    {
        return response()->json($this->datosMes($año, $mes));
    }

    // ─────────────────────────────────────────────────────────────────────
    // API – datos anuales (para vista anual)
    // GET /graficos/anual/{año}
    // ─────────────────────────────────────────────────────────────────────
    public function datosAnualApi(int $año)
    {
        $resultado = [];
        for ($m = 1; $m <= 12; $m++) {
            $resultado[$m] = $this->datosMes($año, $m);
        }

        // Totales anuales para gráficos de torta
        $totalesIngresos = [
            'adm_grafico'          => 0,
            'arriendos_pesos'      => 0,
            'ventas_pesos'         => 0,
            'obras_menores_pesos'  => 0,
            'arriendo_temp_pesos'  => 0,
            'arriendo_temp_aseo'   => 0,
        ];
        $totalesEgresos = [
            'egr_sii'         => 0,
            'egr_kutt'        => 0,
            'egr_sueldos'     => 0,
            'egr_cotizaciones'=> 0,
            'egr_contador'    => 0,
            'egr_otros'       => 0,
        ];

        foreach ($resultado as $d) {
            foreach ($totalesIngresos as $k => &$v) $v += $d['ingresos'][$k] ?? 0;
            foreach ($totalesEgresos  as $k => &$v) $v += $d['egresos'][$k]  ?? 0;
        }

        return response()->json([
            'año'              => $año,
            'meses'            => $resultado,
            'totales_ingresos' => $totalesIngresos,
            'totales_egresos'  => $totalesEgresos,
            'años_disponibles' => $this->añosDisponibles(),
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────
    // GUARDAR / ACTUALIZAR datos manuales de un mes
    // POST /graficos/guardar
    // ─────────────────────────────────────────────────────────────────────
    public function guardar(Request $request)
    {
        $request->validate([
            'año' => 'required|integer|min:2000|max:2100',
            'mes' => 'required|integer|min:1|max:12',
        ]);

        GraficoEmpresa::updateOrCreate(
            ['año' => $request->año, 'mes' => $request->mes],
            $request->only([
                'adm_total', 'arriendos_cantidad', 'arriendos_pesos',
                'ventas_cantidad', 'ventas_pesos', 'obras_menores_pesos',
                'arriendo_temp_pesos', 'arriendo_temp_aseo',
                'egr_sii', 'egr_kutt', 'egr_sueldos',
                'egr_cotizaciones', 'egr_contador', 'egr_otros',
            ])
        );

        return response()->json(['message' => 'Guardado correctamente']);
    }

    // ═════════════════════════════════════════════════════════════════════
    // HELPERS PRIVADOS
    // ═════════════════════════════════════════════════════════════════════

    /**
     * Calcula los datos de un mes combinando:
     *   1. Registro manual en graficos_empresa (si existe)
     *   2. Datos calculados automáticamente desde los otros modelos
     *
     * Los datos automáticos COMPLETAN los campos que el registro manual
     * no tenga (es decir, si ya hay un registro manual, ese prevalece).
     */
    private function datosMes(int $año, int $mes): array
    {
        // ── Datos calculados automáticamente ─────────────────────────────

        // 1. Administración: planilla tipo 1 del mes
        $admTotal = PlanillaEmpresa::where('tipo', 1)
            ->whereYear('fecha', $año)
            ->whereMonth('fecha', $mes)
            ->sum('total_mes');

        // 2. Arriendos activos del mes
        $arriendos = Arriendo::where('estado', 1)
            ->whereYear('fecha_entrega', $año)
            ->whereMonth('fecha_entrega', $mes)
            ->get();

        $arriendosCantidad = $arriendos->count();
        $arriendosPesos    = $arriendos->sum(fn($a) => (float) str_replace('.', '', $a->valor_real ?? 0));

        // 3. Ventas: propiedades tipo 2 vendidas en el mes (estado_venta = 0)
        $ventasCantidad = Propiedad::where('tipo_propiedad', 2)
            ->where('estado_venta', 0)
            ->whereYear('updated_at', $año)
            ->whereMonth('updated_at', $mes)
            ->count();

        $ventasPesos = Precios::where('tipo_propiedad', 2)
            ->whereHas('propiedad', fn($q) => $q
                ->where('estado_venta', 0)
                ->whereYear('updated_at', $año)
                ->whereMonth('updated_at', $mes)
            )
            ->get()
            ->sum(fn($p) => (float) str_replace('.', '', $p->venta ?? 0));

        // 4. Obras menores del mes
        $obrasMenoresPesos = ObrasMenores::whereYear('fecha', $año)
            ->whereMonth('fecha', $mes)
            ->sum('valor_total');

        // 5. Arriendo temporal (Events)
        $eventsDelMes = Event::where('estado', 1)
            ->whereYear('inicio', $año)
            ->whereMonth('inicio', $mes)
            ->get();

        $arriendoTempPesos = $eventsDelMes->sum(fn($e) => (float) str_replace('.', '', $e->total ?? 0));
        $arriendoTempAseo  = $eventsDelMes->sum(fn($e) => (float) str_replace('.', '', $e->monto ?? 0));

        // ── Registro manual (prevalece si existe) ─────────────────────────
        $registro = GraficoEmpresa::where('año', $año)->where('mes', $mes)->first();

        $ingresos = [
            'adm_total'           => $registro?->adm_total           ?? $admTotal,
            'adm_grafico'         => ($registro?->adm_total ?? $admTotal) * 0.10,
            'arriendos_cantidad'  => $registro?->arriendos_cantidad   ?? $arriendosCantidad,
            'arriendos_pesos'     => $registro?->arriendos_pesos      ?? $arriendosPesos,
            'ventas_cantidad'     => $registro?->ventas_cantidad      ?? $ventasCantidad,
            'ventas_pesos'        => $registro?->ventas_pesos         ?? $ventasPesos,
            'obras_menores_pesos' => $registro?->obras_menores_pesos  ?? $obrasMenoresPesos,
            'arriendo_temp_pesos' => $registro?->arriendo_temp_pesos  ?? $arriendoTempPesos,
            'arriendo_temp_aseo'  => $registro?->arriendo_temp_aseo   ?? $arriendoTempAseo,
        ];

        $egresos = [
            'egr_sii'          => $registro?->egr_sii          ?? 0,
            'egr_kutt'         => $registro?->egr_kutt         ?? 0,
            'egr_sueldos'      => $registro?->egr_sueldos      ?? 0,
            'egr_cotizaciones' => $registro?->egr_cotizaciones ?? 0,
            'egr_contador'     => $registro?->egr_contador     ?? 0,
            'egr_otros'        => $registro?->egr_otros        ?? 0,
        ];

        $totalIngresos = $ingresos['adm_grafico']
            + $ingresos['arriendos_pesos']
            + $ingresos['ventas_pesos']
            + $ingresos['obras_menores_pesos']
            + $ingresos['arriendo_temp_pesos']
            + $ingresos['arriendo_temp_aseo'];

        $totalEgresos = array_sum($egresos);

        return [
            'año'            => $año,
            'mes'            => $mes,
            'nombre_mes'     => GraficoEmpresa::nombreMes($mes),
            'tiene_datos'    => $totalIngresos > 0 || $totalEgresos > 0,
            'ingresos'       => $ingresos,
            'egresos'        => $egresos,
            'total_ingresos' => $totalIngresos,
            'total_egresos'  => $totalEgresos,
        ];
    }

    /** Años disponibles: desde 2024 hasta año actual + 1 */
    private function añosDisponibles(): array
    {
        $inicio = 2024;
        $fin    = now()->year + 1;
        return range($inicio, $fin);
    }
}