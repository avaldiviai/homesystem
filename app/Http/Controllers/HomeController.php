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

        //propiedades año corrido
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
            ->groupBy(DB::raw("MONTH(created_at)")) // Asegura la agrupación por mes
            ->orderBy('mes')
            ->get();
        
        
        
        $retiradosPorMes = Arriendo::select(
            DB::raw("MONTH(created_at) as mes"), 
            DB::raw("COUNT(*) as total"), 
            DB::raw("SUM(CAST(REPLACE(valor_arriendo, '.', '') AS UNSIGNED)) as total_retirado")) // Ignorar el punto
            ->where('estado', 0) // Estado retirado
        ->groupBy(DB::raw("MONTH(created_at)")) // Asegura la agrupación correcta
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

        return view('home', compact('veranoPropiedad','propiedadesC','propiedades','veranoretirado','precioventaretirada','precioventa','propiedadescorridoPorMes','ventaretiradaPorMes','propiedadesPorMes', 'arriendosPorMes','ventaPorMes','verano','retiradosPorMes'));
    }
}
