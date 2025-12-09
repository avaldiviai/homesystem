<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sueldos;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $cargos = Cargo::all();

        return view('users', compact('users', 'cargos'));
    }
    
    public function addUsuario(Request $request){
        
        $new_User = new User();
        $new_User->name = $request->nombre;
        $new_User->email = $request->correo;
        $new_User->password = Hash::make($request->contraseña);
        $new_User->id_cargo = $request->cargo;
        // $new_User->estado = 1;
        $new_User->save();
        
        return Response()->json(['nuevo_usuario'=>$new_User]);
        
    }
    
    public function datosUsuario($idUsuario){
        $usuarios = User::where('id', $idUsuario)->first();
        
        return response()->json([
            'usuarios' => $usuarios,
        ]);
    }
    
    public function addEditUsuario(Request $request){
        
        $idUsuario = $request->idUsuario;
        
        $user_edit = User::where('id', $idUsuario)->first();
        $user_edit->name = $request->nombre;
        $user_edit->email = $request->correo;
        $user_edit->id_cargo = $request->cargo;
        // $user_edit->estado = 1;
        $user_edit->save();

        return Response()->json([
            'usuario_editado' => $user_edit,
        ]);
    }

    public function eliminarUsuario($idUsuario)
    {
        $usuario = User::find($idUsuario)->delete();
        
        return Response()->json(['usuario' => 'Usuario Eliminado Exitosamente']);
    }
    ######################################  SUELDOS  ###################################
    
    public function indexSueldos(){

        $sueldos = Sueldos::all();
        $users = User::all();
        $cargos = Cargo::all();

        return view('sueldos', compact('users', 'cargos','sueldos'));
    }
    public function asignarSueldo(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'sueldo' => 'required|numeric|min:0',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        $sueldo = new Sueldos;
        $sueldo->sueldos = $request->sueldo;
        $sueldo->id_user = $request->id_user;
        $sueldo->fecha = $request->fecha;

        // Si viene un archivo, lo guardamos
        if ($request->hasFile('archivo')) {
            $nombreArchivo = time() . '_' . $request->file('archivo')->getClientOriginalName();
            $ruta = $request->file('archivo')->storeAs('documentos_sueldos', $nombreArchivo, 'public');
            $sueldo->documentos = $ruta; // Asegúrate que esta columna exista en tu tabla sueldos
        }

        $sueldo->save();

        return response()->json(['mensaje' => 'Sueldo asignado correctamente']);
    }
    public function sueldosEdit($id){
        $sueldos = Sueldos::where('id', $id)->first();
        
        return response()->json([
            'sueldos' => $sueldos,
        ]);
    }
    public function GuardarSueldosEdit(Request $request){
    
        $idsueldo = $request->id;
        $sueldo_edit = Sueldos::where('id',$idsueldo)->first();
        $sueldo_edit->sueldos = $request->sueldo;
        // $sueldo_edit->id_user = $request->id_user;
        $sueldo_edit->fecha = $request->fecha;


        // Si viene un nuevo archivo
        if ($request->hasFile('documento')) {
            // Eliminar el anterior si existe
            if ($sueldo_edit->documentos && Storage::exists($sueldo_edit->documentos)) {
                Storage::delete($sueldo_edit->documentos);
            }

            // Guardar el nuevo archivo
            $nombreArchivoEdit = time() . '_' . $request->file('documento')->getClientOriginalName();
            $ruta = $request->file('documento')->storeAs('documentos_sueldos', $nombreArchivoEdit ,'public');
            $sueldo_edit->documentos = $ruta;
        }

        $sueldo_edit->save();

        return response()->json(['mensaje' => 'Sueldo editado correctamente', 'sueldo' => $sueldo_edit]);

    }


}
