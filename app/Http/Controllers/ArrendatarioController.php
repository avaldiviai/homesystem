<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arrendatario;
use App\Models\Arriendo;


class ArrendatarioController extends Controller
{
    public function index()
    {
        $arrendatarios = Arrendatario::where('estado', 1)->get();

        return view('arrendatarios', compact('arrendatarios'));
    }

    public function addArrendatario(Request $request)
    {
        // dd($request->all());
        // Verificar si ya existe un arrendatario con el mismo RUT
        $existe = Arrendatario::where('rut', $request->rut)
                    ->orWhere('correo', $request->correo)
                    ->first();

        if ($existe) {
            return response()->json([
                'mensaje' => 'Ya existe un arrendatario registrado con este RUT o EMAIL.',
                'existe' => true
            ], 409); // C��digo 409: Conflicto
        }

        // Crear nuevo arrendatario
        $new_arrendatario = new Arrendatario();
        $new_arrendatario->nombre = $request->nombre;
        $new_arrendatario->rut = $request->rut;
        $new_arrendatario->telefono = $request->telefono;
        $new_arrendatario->correo = $request->correo;
        $new_arrendatario->direccion = $request->direccion;
        $new_arrendatario->ciudad = $request->ciudad;
        //$new_arrendatario->profesion = $request->profesion;
        $new_arrendatario->estado = 1;
        $new_arrendatario->save();

        return response()->json($new_arrendatario);
    }

    public function addArrendatariodetalles(Request $request){

        $new_arrendatario = new Arrendatario();
        $new_arrendatario->nombre = $request->nombre;
        $new_arrendatario->rut = $request->rut;
        $new_arrendatario->telefono = $request->telefono;
        $new_arrendatario->correo = $request->correo;
        $new_arrendatario->direccion = $request->direccion;
        $new_arrendatario->ciudad = $request->ciudad;
        $new_arrendatario->profesion = $request->profesion;
        $new_arrendatario->estado = 1;
        $new_arrendatario->save();

        $new_arriendo = new Arriendo;
        $new_arriendo->id_propiedad = $request->id;
        $new_arriendo->id_arrendatario = $new_arrendatario->id;
        $new_arriendo->id_comision = $request->id_comision;
        $new_arriendo->id_estadopagos = $request->id_estadopago;
        $new_arriendo->estado = 1;
        $new_arriendo->save();


        return Response()->json(['nuevo_arrendatario'=>$new_arrendatario]);

    }
    public function datosArrendatario($idArrendatario){
        $arrendatario = Arrendatario::where('id', $idArrendatario)->first();

        return response()->json([
            'arrendatario' => $arrendatario,
        ]);
    }

    public function addEditArrendatario(Request $request){

        $idArrendatario = $request->idArrendatario;

        $arrendatario_edit = Arrendatario::where('id', $idArrendatario)->first();
        $arrendatario_edit->nombre = $request->nombre;
        $arrendatario_edit->rut = $request->rut;
        $arrendatario_edit->telefono = $request->telefono;
        $arrendatario_edit->correo = $request->correo;
        $arrendatario_edit->direccion = $request->direccion;
        $arrendatario_edit->ciudad = $request->ciudad;
        $arrendatario_edit->estado = 1;
        $arrendatario_edit->save();

        return Response()->json([
            'arrendatario_editado' => $arrendatario_edit,
        ]);
    }

    public function eliminarArrendatario(Request $request)
    {
        $idArrendatario = $request->idArrendatario;

        $arrendatario_del = Arrendatario::where('id', $idArrendatario)->first();
        $arrendatario_del->estado = $request->estado;
        $arrendatario_del->save();

        return Response()->json(['arrendatario_delete' => $arrendatario_del]);
    }
}
