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
        $users  = User::all();
        $cargos = Cargo::all();

        return view('users', compact('users', 'cargos'));
    }

    public function addUsuario(Request $request)
    {
        $new_User           = new User();
        $new_User->name     = $request->nombre;
        $new_User->email    = $request->correo;
        $new_User->password = Hash::make($request->contraseña);
        $new_User->id_cargo = $request->cargo;
        $new_User->save();

        return response()->json(['nuevo_usuario' => $new_User]);
    }

    public function datosUsuario($idUsuario)
    {
        $usuarios = User::where('id', $idUsuario)->first();

        return response()->json(['usuarios' => $usuarios]);
    }

    public function addEditUsuario(Request $request)
    {
        $user_edit          = User::where('id', $request->idUsuario)->first();
        $user_edit->name    = $request->nombre;
        $user_edit->email   = $request->correo;
        $user_edit->id_cargo = $request->cargo;
        $user_edit->save();

        return response()->json(['usuario_editado' => $user_edit]);
    }

    public function eliminarUsuario($idUsuario)
    {
        User::find($idUsuario)->delete();

        return response()->json(['usuario' => 'Usuario Eliminado Exitosamente']);
    }

    // ══════════════════════════════════════════════════════════════════════════
    //  SUELDOS
    //  Columnas reales en BD: id | total_mes | nombre_archivo | documento
    //                          | fecha | id_user | created_at | updated_at
    // ══════════════════════════════════════════════════════════════════════════

    public function indexSueldos()
    {
        $usuarios = User::orderBy('name')->get(['id', 'name', 'email']);

        return view('planillas.sueldos', compact('usuarios'));
    }

    // GET /sueldos/listar
    public function listarSueldos()
    {
        $totales = Sueldos::with('user:id,name')
            ->selectRaw('id_user, SUM(total_mes) as suma_total')
            ->groupBy('id_user')
            ->get()
            ->map(fn($r) => [
                'id_user' => $r->id_user,
                'nombre'  => optional($r->user)->name ?? 'Usuario',
                'total'   => (float) $r->suma_total,
            ]);

        return response()->json(['ok' => true, 'totales' => $totales]);
    }

    // POST /sueldos/verificar
    public function verificarSueldo(Request $request)
    {
        $request->validate([
            'id_user'  => 'required|exists:users,id',
            'password' => 'required|string',
        ]);

        $user = User::findOrFail($request->id_user);

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['ok' => false, 'msg' => 'Contraseña incorrecta.'], 401);
        }

        $sueldos = Sueldos::where('id_user', $user->id)
            ->orderByDesc('fecha')
            ->get(['id', 'total_mes', 'nombre_archivo', 'documento', 'fecha', 'id_user']);

        return response()->json(['ok' => true, 'data' => $sueldos]);
    }

    // POST /usuarios/asignar_sueldo
    public function asignarSueldo(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'sueldo'  => 'required|numeric|min:0',
            'fecha'   => 'required|date',
            'archivo' => 'nullable|file|mimes:xlsx,xls,csv,pdf|max:20480',
        ]);

        $sueldo            = new Sueldos();
        $sueldo->total_mes = $request->sueldo;
        $sueldo->id_user   = $request->id_user;
        $sueldo->fecha     = $request->fecha;

        if ($request->hasFile('archivo')) {
            $file                   = $request->file('archivo');
            $nombre                 = time() . '_' . $file->getClientOriginalName();
            $ruta                   = $file->storeAs('documentos_sueldos', $nombre, 'public');
            $sueldo->nombre_archivo = $file->getClientOriginalName();
            $sueldo->documento      = Storage::url($ruta);
        }

        $sueldo->save();

        return response()->json(['ok' => true, 'registro' => $sueldo]);
    }

    // GET /sueldo_editar/{id}
    public function sueldosEdit($id)
    {
        $sueldo = Sueldos::findOrFail($id);

        return response()->json(['sueldos' => $sueldo]);
    }

    // POST /sueldos/editar
    public function GuardarSueldosEdit(Request $request)
    {
        $sueldo            = Sueldos::findOrFail($request->id);
        $sueldo->total_mes = $request->sueldo;
        $sueldo->fecha     = $request->fecha;

        if ($request->hasFile('documento')) {
            // Eliminar archivo anterior si existe
            if ($sueldo->documento) {
                $old = str_replace('/storage/', '', $sueldo->documento);
                Storage::disk('public')->delete($old);
            }

            $file                   = $request->file('documento');
            $nombre                 = time() . '_' . $file->getClientOriginalName();
            $ruta                   = $file->storeAs('documentos_sueldos', $nombre, 'public');
            $sueldo->nombre_archivo = $file->getClientOriginalName();
            $sueldo->documento      = Storage::url($ruta);
        }

        $sueldo->save();

        return response()->json(['ok' => true, 'registro' => $sueldo]);
    }

    // DELETE /sueldos/eliminar/{id}
    public function eliminarSueldo($id)
    {
        $sueldo = Sueldos::findOrFail($id);

        if ($sueldo->documento) {
            $path = str_replace('/storage/', '', $sueldo->documento);
            Storage::disk('public')->delete($path);
        }

        $sueldo->delete();

        return response()->json(['ok' => true]);
    }
}