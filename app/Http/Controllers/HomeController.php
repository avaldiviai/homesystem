<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Propiedad;
use App\Models\Verano;
use App\Models\Precios;
use App\Models\Arriendo;
use App\Models\Event;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $propiedades = Propiedad::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('tipo_propiedad', 1)
            ->where('estado', 1)          // ← solo activas
            ->where('estado_venta', 1)
            ->get();

        $propiedadesC = Propiedad::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('tipo_propiedad', 3)
            ->where('estado', 1)          // ← solo activas
            ->where('estado_venta', 1)
            ->get();

        $propiedadesPorMes = Arriendo::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('estado', 1)
            ->get();

        $propiedadescorridoPorMes = Arriendo::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('estado', 1)
            ->get();

        $arriendosPorMes = Arriendo::select(
            DB::raw("MONTH(created_at) as mes"),
            DB::raw("COUNT(*) as total"),
            DB::raw("SUM(CAST(REPLACE(valor_real, '.', '') AS UNSIGNED)) as total_retirado")
        )
            ->where('estado', 1)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->orderBy('mes')
            ->get();

        $retiradosPorMes = Arriendo::select(
            DB::raw("MONTH(created_at) as mes"),
            DB::raw("COUNT(*) as total"),
            DB::raw("SUM(CAST(REPLACE(valor_arriendo, '.', '') AS UNSIGNED)) as total_retirado")
        )
            ->where('estado', 0)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->orderBy('mes')
            ->get();

        // ─── VENTAS ────────────────────────────────────────────────────────────
        // Propiedades disponibles para la venta (activas Y aún no vendidas)
        $ventaPorMes = Propiedad::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('tipo_propiedad', 2)
            ->where('estado', 1)          // ← solo propiedades NO eliminadas
            ->where('estado_venta', 1)    // ← disponibles
            ->get();

        // Propiedades vendidas (estado_venta=0) que siguen en el sistema (estado=1)
        // O bien propiedades que fueron eliminadas del sistema (estado=0) — ambas
        // se consideran "retiradas". Para ser consistente con el modelo de negocio:
        // "retiradas del sistema" = estado=0 (borradas lógicamente, cualquier estado_venta)
        $ventaretiradaPorMes = Propiedad::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('tipo_propiedad', 2)
            ->where(function ($q) {
                $q->where('estado', 0)           // eliminadas del sistema
                  ->orWhere('estado_venta', 0);  // o marcadas como vendidas
            })
            ->get();

        // Precio de propiedades disponibles para la venta
        $precioventa = Precios::select(
            DB::raw("MONTH(created_at) as mes"),
            DB::raw("COUNT(*) as total"),
            DB::raw("SUM(CAST(REPLACE(venta, '.', '') AS UNSIGNED)) as totalventa")
        )
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('tipo_propiedad', 2)
            ->where('estado', 1)
            ->whereHas('propiedad', function ($q) {
                $q->where('estado', 1)->where('estado_venta', 1);
            })
            ->get();

        // Precio de propiedades retiradas/vendidas
        $precioventaretirada = Precios::select(
            DB::raw("MONTH(created_at) as mes"),
            DB::raw("COUNT(*) as total"),
            DB::raw("SUM(CAST(REPLACE(venta, '.', '') AS UNSIGNED)) as totalventa")
        )
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('tipo_propiedad', 2)
            ->whereHas('propiedad', function ($q) {
                $q->where(function ($inner) {
                    $inner->where('estado', 0)
                          ->orWhere('estado_venta', 0);
                });
            })
            ->get();
        // ───────────────────────────────────────────────────────────────────────

        $veranoPropiedad = Verano::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('estado', 1)
            ->get();

        $verano = Event::select(
            DB::raw("MONTH(created_at) as mes"),
            DB::raw("COUNT(*) as total_verano"),
            DB::raw("SUM(CAST(REPLACE(total, '.', '') AS UNSIGNED)) as totalverano")
        )
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('estado', 1)
            ->get();

        $veranoretirado = Event::select(
            DB::raw("MONTH(created_at) as mes"),
            DB::raw("COUNT(*) as total_verano"),
            DB::raw("SUM(CAST(REPLACE(total, '.', '') AS UNSIGNED)) as totalverano")
        )
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('estado', 0)
            ->get();

        $arriendosPorAnio = Arriendo::select(
            DB::raw("YEAR(created_at) as anio"),
            DB::raw("COUNT(*) as total"),
            DB::raw("SUM(CAST(REPLACE(valor_real, '.', '') AS UNSIGNED)) as total_arriendo")
        )
            ->where('estado', 1)
            ->groupBy(DB::raw("YEAR(created_at)"))
            ->orderBy('anio')
            ->get();

        $retiradosPorAnio = Arriendo::select(
            DB::raw("YEAR(created_at) as anio"),
            DB::raw("COUNT(*) as total"),
            DB::raw("SUM(CAST(REPLACE(valor_arriendo, '.', '') AS UNSIGNED)) as total_retirado")
        )
            ->where('estado', 0)
            ->groupBy(DB::raw("YEAR(created_at)"))
            ->orderBy('anio')
            ->get();

        $propiedadesVentas = Propiedad::select(
            DB::raw("YEAR(created_at) as anio"),
            DB::raw("COUNT(*) as total")
        )
            ->where('tipo_propiedad', 2)
            ->where('estado', 1)          // ← solo activas para el gráfico anual
            ->groupBy(DB::raw("YEAR(created_at)"))
            ->orderBy('anio')
            ->get();

        $labelsArriendosAnio = $arriendosPorAnio->pluck('anio');
        $dataArriendosAnio   = $arriendosPorAnio->pluck('total_arriendo');
        $labelsVentasAnio    = $propiedadesVentas->pluck('anio');
        $dataVentasAnio      = $propiedadesVentas->pluck('total');

        return view('home', compact(
            'labelsVentasAnio', 'dataVentasAnio',
            'dataArriendosAnio', 'labelsArriendosAnio',
            'veranoPropiedad', 'propiedadesC', 'propiedades',
            'veranoretirado', 'precioventaretirada', 'precioventa',
            'propiedadescorridoPorMes', 'ventaretiradaPorMes',
            'propiedadesPorMes', 'arriendosPorMes',
            'ventaPorMes', 'verano', 'retiradosPorMes'
        ));
    }
}