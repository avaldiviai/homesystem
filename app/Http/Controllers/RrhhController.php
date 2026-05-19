<?php

namespace App\Http\Controllers;

use App\Models\ArchivoRrhh;
use App\Models\Cargo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RrhhController extends Controller
{
    // ─── Vista principal ──────────────────────────────────────────────────────

    public function index()
    {
        $users   = User::with(['cargo', 'archivosRrhh'])->get();
        $cargos  = Cargo::all();

        return view('rrhh.equipo', compact('users', 'cargos'));
    }

    // ─── Datos de un usuario (para modal editar) ──────────────────────────────

    public function show($id)
    {
        $user = User::with(['cargo', 'archivosRrhh'])->findOrFail($id);

        return response()->json([
            'user'    => $user,
            'archivos' => $user->archivosRrhh,
        ]);
    }

    // ─── Crear usuario ────────────────────────────────────────────────────────

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6',
            'id_cargo'  => 'required|exists:cargos,id',
        ]);

        $user = new User();
        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->password  = Hash::make($request->password);
        $user->id_cargo  = $request->id_cargo;
        $user->rut       = $request->rut;
        $user->direccion = $request->direccion;
        $user->save();

        // Guardar datos bancarios si vienen
        if ($request->filled('nombre_banco') || $request->filled('numero_cuenta')) {
            // guardamos en datos_bancarios usando un propietario ficticio no aplica aquí,
            // los datos de cuenta van directamente en el campo datos_cuenta del usuario
        }

        // Archivos adjuntos
        if ($request->hasFile('archivos')) {
            foreach ($request->file('archivos') as $archivo) {
                $nombre = $archivo->getClientOriginalName();
                $ruta   = $archivo->storeAs('rrhh/' . $user->id, time() . '_' . $nombre, 'public');

                ArchivoRrhh::create([
                    'nombre_archivo' => $nombre,
                    'ruta_archivo'   => $ruta,
                    'tipo_archivo'   => $archivo->getClientOriginalExtension(),
                    'id_user'        => $user->id,
                ]);
            }
        }

        return response()->json(['message' => 'Usuario creado correctamente', 'user' => $user->load('cargo', 'archivosRrhh')]);
    }

    // ─── Actualizar usuario ───────────────────────────────────────────────────

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name      = $request->name      ?? $user->name;
        $user->email     = $request->email     ?? $user->email;
        $user->id_cargo  = $request->id_cargo  ?? $user->id_cargo;
        $user->rut       = $request->rut       ?? $user->rut;
        $user->direccion = $request->direccion ?? $user->direccion;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Nuevos archivos
        if ($request->hasFile('archivos')) {
            foreach ($request->file('archivos') as $archivo) {
                $nombre = $archivo->getClientOriginalName();
                $ruta   = $archivo->storeAs('rrhh/' . $user->id, time() . '_' . $nombre, 'public');

                ArchivoRrhh::create([
                    'nombre_archivo' => $nombre,
                    'ruta_archivo'   => $ruta,
                    'tipo_archivo'   => $archivo->getClientOriginalExtension(),
                    'id_user'        => $user->id,
                ]);
            }
        }

        return response()->json(['message' => 'Usuario actualizado correctamente', 'user' => $user->load('cargo', 'archivosRrhh')]);
    }

    // ─── Eliminar usuario ─────────────────────────────────────────────────────

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Eliminar archivos físicos
        foreach ($user->archivosRrhh as $archivo) {
            Storage::disk('public')->delete($archivo->ruta_archivo);
            $archivo->delete();
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }

    // ─── Eliminar un archivo adjunto ──────────────────────────────────────────

    public function destroyArchivo($id)
    {
        $archivo = ArchivoRrhh::findOrFail($id);
        Storage::disk('public')->delete($archivo->ruta_archivo);
        $archivo->delete();

        return response()->json(['message' => 'Archivo eliminado correctamente']);
    }

    // ─── CARGOS ───────────────────────────────────────────────────────────────

    public function storeCargo(Request $request)
    {
        $request->validate(['nombre' => 'required|string|max:255']);

        $cargo = Cargo::create(['nombre' => $request->nombre]);

        return response()->json(['message' => 'Cargo creado correctamente', 'cargo' => $cargo]);
    }

    public function updateCargo(Request $request, $id)
    {
        $cargo = Cargo::findOrFail($id);
        $cargo->nombre = $request->nombre;
        $cargo->save();

        return response()->json(['message' => 'Cargo actualizado correctamente', 'cargo' => $cargo]);
    }

    public function destroyCargo($id)
    {
        Cargo::findOrFail($id)->delete();

        return response()->json(['message' => 'Cargo eliminado correctamente']);
    }

    public function getCargos()
    {
        return response()->json(Cargo::all());
    }
}