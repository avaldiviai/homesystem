<?php

namespace App\Http\Controllers;

use App\Models\arriendosTemporales;
use App\Models\aseos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArriendosTemporalesController extends Controller
{
    public function index()
    {
        $arriendos = arriendosTemporales::all();
        $aseos = aseos::all();
        $countArriendos = $arriendos->count();
        $countAseos = $aseos->count();
        $totalArriendos = $arriendos->sum('total');
        $totalAseos = $aseos->sum('total');

        return view('arriendostemporales', compact('arriendos', 'aseos', 'countArriendos', 'countAseos', 'totalArriendos', 'totalAseos'));
    }

    public function resumenFinanciero(Request $request)
    {
        $mes = $request->mes;

        $anio = date('Y', strtotime($mes));
        $numeroMes = date('m', strtotime($mes));

        $arriendos = arriendosTemporales::whereYear('fecha', $anio)
            ->whereMonth('fecha', $numeroMes)
            ->sum('total');

        $aseos = aseos::whereYear('fecha', $anio)
            ->whereMonth('fecha', $numeroMes)
            ->sum('total');

        return response()->json([
            'arriendos' => $arriendos,
            'aseos' => $aseos
        ]);
    }

    public function storeArriendo(Request $request)
    {
        $arriendo = new arriendosTemporales();

        $arriendo->fecha = $request->fecha;
        $arriendo->total = $request->total_mes;

        $rutas = [];

        if ($request->hasFile('archivos')) {

            foreach ($request->file('archivos') as $archivo) {

                $nombreOriginal = $archivo->getClientOriginalName();

                $nombreServidor = time() . '_' . $nombreOriginal;

                $ruta = $archivo->storeAs(
                    'arriendos',
                    $nombreServidor,
                    'public'
                );

                $rutas[] = $ruta;
            }
        }

        $arriendo->archivo = json_encode($rutas);

        $arriendo->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function storeAseo(Request $request)
    {
        $aseo = new aseos();

        $aseo->fecha = $request->fecha;
        $aseo->total = $request->total_mes;


        $rutas = [];

        if ($request->hasFile('archivos')) {

            foreach ($request->file('archivos') as $archivo) {

                $nombreOriginal = $archivo->getClientOriginalName();

                $nombreServidor = time() . '_' . $nombreOriginal;

                $ruta = $archivo->storeAs(
                    'aseos',
                    $nombreServidor,
                    'public'
                );

                $rutas[] = $ruta;
            }
        }

        $aseo->archivo = json_encode($rutas);

        $aseo->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function listarArriendos()
    {
        return response()->json(
            arriendosTemporales::latest()->get()
        );
    }
    public function listarAseos()
    {
        return response()->json(
            aseos::latest()->get()
        );
    }
    public function showArriendo($id)
    {
        return response()->json(
            arriendosTemporales::findOrFail($id)
        );
    }

    public function showAseo($id)
    {
        return response()->json(
            aseos::findOrFail($id)
        );
    }

    public function updateArriendosTemporales(Request $request, $id)
    {
        $arriendo = arriendosTemporales::findOrFail($id);

        $arriendo->fecha = $request->fecha;
        $arriendo->total = $request->total;

        // Si suben nuevos archivos
        if ($request->hasFile('archivos')) {

            $rutasActuales = json_decode($arriendo->archivo, true) ?? [];

            foreach ($request->file('archivos') as $archivo) {

                $nombreOriginal = $archivo->getClientOriginalName();

                $nombreServidor = time() . '_' . uniqid() . '_' . $nombreOriginal;

                $ruta = $archivo->storeAs(
                    'arriendos',
                    $nombreServidor,
                    'public'
                );

                $rutasActuales[] = $ruta;
            }

            $arriendo->archivo = json_encode($rutasActuales);
        }

        $arriendo->save();

        return response()->json([
            'success' => true,
            'message' => 'Arriendo actualizado correctamente'
        ]);
    }

    public function updateAseo(Request $request, $id)
    {
        $aseo = aseos::findOrFail($id);

        $aseo->fecha = $request->fecha;
        $aseo->total = $request->total;

        if ($request->hasFile('archivos')) {

            $rutasActuales = json_decode($aseo->archivo, true) ?? [];

            foreach ($request->file('archivos') as $archivo) {

                $nombreOriginal = $archivo->getClientOriginalName();

                $nombreServidor = time() . '_' . uniqid() . '_' . $nombreOriginal;

                $ruta = $archivo->storeAs(
                    'aseos',
                    $nombreServidor,
                    'public'
                );

                $rutasActuales[] = $ruta;
            }

            $aseo->archivo = json_encode($rutasActuales);
        }

        $aseo->save();

        return response()->json([
            'success' => true,
            'message' => 'Aseo actualizado correctamente'
        ]);
    }

    public function eliminarArchivoArriendo(Request $request, $id)
    {
        $arriendo = arriendosTemporales::findOrFail($id);

        $archivoEliminar = $request->archivo;

        $archivos = json_decode($arriendo->archivo, true) ?? [];

        // eliminar archivo físico
        if (Storage::disk('public')->exists($archivoEliminar)) {

            Storage::disk('public')->delete($archivoEliminar);
        }

        // eliminar del json
        $archivos = array_values(
            array_filter($archivos, function ($archivo) use ($archivoEliminar) {
                return $archivo !== $archivoEliminar;
            })
        );

        $arriendo->archivo = json_encode($archivos);

        $arriendo->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function eliminarArchivoAseo(Request $request, $id)
    {
        $aseo = aseos::findOrFail($id);

        $archivoEliminar = $request->archivo;

        $archivos = json_decode($aseo->archivo, true) ?? [];

        if (Storage::disk('public')->exists($archivoEliminar)) {

            Storage::disk('public')->delete($archivoEliminar);
        }

        $archivos = array_values(
            array_filter($archivos, function ($archivo) use ($archivoEliminar) {
                return $archivo !== $archivoEliminar;
            })
        );

        $aseo->archivo = json_encode($archivos);

        $aseo->save();

        return response()->json([
            'success' => true
        ]);
    }

    function eliminarArriendo($id)
    {
        $arriendo = arriendosTemporales::findOrFail($id);

        $archivos = json_decode($arriendo->archivo, true) ?? [];

        foreach ($archivos as $archivo) {

            if (Storage::disk('public')->exists($archivo)) {

                Storage::disk('public')->delete($archivo);
            }
        }

        $arriendo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Arriendo eliminado correctamente'
        ]);
    }

    function eliminarAseo($id)
    {
        $aseo = aseos::findOrFail($id);

        $archivos = json_decode($aseo->archivo, true) ?? [];

        foreach ($archivos as $archivo) {

            if (Storage::disk('public')->exists($archivo)) {

                Storage::disk('public')->delete($archivo);
            }
        }

        $aseo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Aseo eliminado correctamente'
        ]);
    }
}
