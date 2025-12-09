<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comision;


class ComisionController extends Controller
{
    public function index()
    {
        $comisiones = Comision::all();

        return view('comision', compact('comisiones'));
    }
    public function addComision(Request $request){

        $new_comision = new Comision();
        $new_comision->porcentaje = $request->porcentaje;
        // $new_comision->estado = 1;
        $new_comision->save();

        return Response()->json(['nueva_comision'=>$new_comision]);
    }

    public function datosComision($idComision){
        $comision = Comision::where('id', $idComision)->first();

        return response()->json([
            'comision' => $comision,
        ]);
    }

    public function addEditComision(Request $request){

        $idComision = $request->idComision;

        $comision_edit = Comision::where('id', $idComision)->first();
        $comision_edit->porcentaje = $request->porcentaje;
        // $comision_edit->estado = 1;
        $comision_edit->save();

        return Response()->json([
            'comision_editada' => $comision_edit,
        ]);
    }

    public function eliminarComision($idComision)
    {
        $comision = Comision::find($idComision)->delete();

        return Response()->json(['comision' => 'Comision Eliminada Exitosamente']);
    }


    ////////////////////////////// TRABAJADOR ///////////////////////////////

    public function indextrabajador()
    {
        $comisiones = Comision::all();

        return view('trabajador.comision', compact('comisiones'));
    }
}
