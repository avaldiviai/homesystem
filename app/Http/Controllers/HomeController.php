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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $propiedades = Propiedad::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('tipo_propiedad',1)
            ->where('estado_venta',1)
            ->get();
        $propiedadesC = Propiedad::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('tipo_propiedad',3)
            ->where('estado_venta',1)
            ->get();
        //Propiedades mes de marzo a diciembre
        $propiedadesPorMes = Arriendo::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            // ->where('tipo_propiedad',1)
            ->where('estado',1)
            ->get();
            // dd($propiedadesPorMes);

        //propiedades a�0�9o corrido
        $propiedadescorridoPorMes = Arriendo::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            // ->where('tipo_propiedad',3)
            ->where('estado',1)
            ->get();
            // dd($propiedadesPorMes);

        $arriendosPorMes = Arriendo::select(
            DB::raw("MONTH(created_at) as mes"), 
            DB::raw("COUNT(*) as total"), 
            DB::raw("SUM(CAST(REPLACE(valor_real, '.', '') AS UNSIGNED)) as total_retirado") // Ignorar el punto
        )
        ->where('estado', 1) // Estado disponible
        ->groupBy(DB::raw("MONTH(created_at)")) // Asegura la agrupaci��n por mes
        ->orderBy('mes')
        ->get();
        
        $retiradosPorMes = Arriendo::select(
            DB::raw("MONTH(created_at) as mes"), 
            DB::raw("COUNT(*) as total"), 
            DB::raw("SUM(CAST(REPLACE(valor_arriendo, '.', '') AS UNSIGNED)) as total_retirado")) // Ignorar el punto
            ->where('estado', 0) // Estado retirado
        ->groupBy(DB::raw("MONTH(created_at)")) // Asegura la agrupaci��n correcta
        ->orderBy('mes')
        ->get();
    
        //propiedades en venta disponible
        $ventaPorMes = Propiedad::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('tipo_propiedad',2)
            ->where('estado_venta',1)
            ->get();
        //propiedades ventas realizadas
        $ventaretiradaPorMes = Propiedad::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('tipo_propiedad',2)
            ->where('estado_venta',0)
            ->get();

     
        $precioventa = Precios::select(DB::raw("MONTH(created_at) as mes"),DB::raw("COUNT(*) as total"),DB::raw("SUM(CAST(REPLACE(venta, '.', '') AS UNSIGNED)) as totalventa"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('tipo_propiedad',2)
            ->where('estado',1)
            ->get();
            
        $precioventaretirada = Precios::select(DB::raw("MONTH(created_at) as mes"),DB::raw("COUNT(*) as total"),DB::raw("SUM(CAST(REPLACE(venta, '.', '') AS UNSIGNED)) as totalventa"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('tipo_propiedad',2)
            ->where('estado',0)
            ->get();
        
        //propiedades verano disponible
        $veranoPropiedad = Verano::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('estado',1)
            ->get();
        //propiedades verano disponible
        $verano = Event::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total_verano"),DB::raw("SUM(CAST(REPLACE(total, '.', '') AS UNSIGNED)) as totalverano"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('estado',1)
            ->get();
    
        //propiedades verano disponible
        $veranoretirado = Event::select(DB::raw("MONTH(created_at) as mes"), DB::raw("COUNT(*) as total_verano"),DB::raw("SUM(CAST(REPLACE(total, '.', '') AS UNSIGNED)) as totalverano"))
            ->groupBy('mes')
            ->orderBy('mes')
            ->where('estado',0)
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

        //no se ocupa
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
        ->groupBy(DB::raw("YEAR(created_at)"))
        ->orderBy('anio')
        ->get();
            
        $labelsArriendosAnio = $arriendosPorAnio->pluck('anio');
        $dataArriendosAnio   = $arriendosPorAnio->pluck('total_arriendo');
        $labelsVentasAnio = $propiedadesVentas->pluck('anio');
        $dataVentasAnio = $propiedadesVentas->pluck('total');
     



        return view('home', compact('labelsVentasAnio','dataVentasAnio','dataArriendosAnio','labelsArriendosAnio','veranoPropiedad','propiedadesC','propiedades','veranoretirado','precioventaretirada','precioventa','propiedadescorridoPorMes','ventaretiradaPorMes','propiedadesPorMes', 'arriendosPorMes','ventaPorMes','verano','retiradosPorMes'));
    }
}
