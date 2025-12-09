<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elementos;
use Illuminate\Support\Facades\Validator;

class ElementosController extends Controller
{
    public function index()
    {
        $elementos = Elementos::all();


        return view('elementos', compact('elementos'));
    }
    public function add(Request $request)
    {
        $new_elemento = new Elementos();
        $new_elemento->nombre = $request->nombre;


        $new_elemento->save();

        return response()->json(['message' => 'Datos agregados correctamente']);
    }

    public function show($id_elemento){
        $elementos = Elementos::where('id', $id_elemento)->first();

        return response()->json([
            'elementos' => $elementos,
        ]);
    }

    public function addelemento(Request $request){

        $id_elemento= $request->id_elemento;

        $elemento_edit = Elementos::where('id', $id_elemento)->first();
        $elemento_edit->nombre = $request->nombre;

        $elemento_edit->save();

        return Response()->json([
            'elemento_editada' => $elemento_edit,
        ]);
    }
    public function deleteElement($id_elemento)
    {
        $elemento = Elementos::find($id_elemento)->delete();

        return Response()->json(['elemento' => 'Elemento Eliminado Exitosamente']);
    }


    /////////////////////////// TRABAJADOR //////////////////////////
    public function indextrabajador()
    {
        $elementos = Elementos::all();


        return view('trabajador.elementos', compact('elementos'));
    }
}
