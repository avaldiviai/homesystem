<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::all();

        return view('cargos', compact('cargos'));
    }
    public function addCargo(Request $request){

        $new_cargo = new Cargo();
        $new_cargo->nombre = $request->nombre;
       
        $new_cargo->save();

        return Response()->json(['nuevo_cargo'=>$new_cargo]);
    }

    public function datosCargo($idCargo){
         // Retrieve the cargo name from the database
         $cargo = Cargo::find($idCargo);

         if ($cargo) {
             return response()->json(['cargos' => ['nombre' => $cargo->nombre]]);
         } else {
             return response()->json(['error' => 'Cargo not found'], 404);
         }
     
    }

    public function addCargoEditar(Request $request){

        $idCargo = $request->idCargo;

        $cargo_edit = Cargo::where('id', $idCargo)->first();
        $cargo_edit->nombre = $request->nombre;
        $cargo_edit->save();

        return Response()->json([
            'cargo_editado' => $cargo_edit,
        ]);
    }

    public function eliminarCargo($idCargo)
    {
        $cargo = Cargo::find($idCargo)->delete();

        return Response()->json(['cargo' => 'Corgo Eliminado Exitosamente']);
    }

}
