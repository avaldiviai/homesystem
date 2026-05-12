<?php

namespace App\Http\Controllers;

use App\Models\PlanillaEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlanillaEmpresaController extends Controller
{
    // Tipos sin total_mes
    private const SIN_TOTAL = [6];

    // Tipo que aplica 10%
    private const ES_ADMIN = [1];

    // ─────────────────────────────────────────────────────────────────────
    // VISTA PRINCIPAL  GET /plantilla
    // ─────────────────────────────────────────────────────────────────────
    public function index()
    {
        return view('plantilla');
    }

    // ─────────────────────────────────────────────────────────────────────
    // LISTAR  GET /planillas/listar
    // ─────────────────────────────────────────────────────────────────────
    public function listar()
    {
        $registros = PlanillaEmpresa::orderByDesc('fecha')->get()->map(function ($p) {
            return [
                'id'             => $p->id,
                'fecha'          => $p->fecha ? $p->fecha->format('Y-m-d') : null,
                'documento'      => $p->documento ? asset('storage/' . $p->documento) : null,
                'nombre_archivo' => $p->nombre_archivo,
                'total_mes'      => $p->total_mes,
                'tipo'           => $p->tipo,
            ];
        });

        return response()->json(['data' => $registros]);
    }

    // ─────────────────────────────────────────────────────────────────────
    // GUARDAR  POST /planillas/guardar
    // ─────────────────────────────────────────────────────────────────────
    public function guardar(Request $request)
    {
        $request->validate([
            'tipo'         => 'required|integer|between:1,6',
            'fecha'        => 'required|date',
            'documentos'   => 'required|array|min:1',
            'documentos.*' => 'file|max:20480',
            'total_mes'    => 'nullable|numeric|min:0',
        ]);

        $tipo     = (int) $request->tipo;
        $sinTotal = in_array($tipo, self::SIN_TOTAL);
        $total    = $sinTotal ? null : (float) $request->total_mes;

        $registros = [];

        foreach ($request->file('documentos') as $archivo) {
            $nombreOriginal = $archivo->getClientOriginalName();
            $ruta = $archivo->storeAs(
                'planillas/' . $tipo,
                time() . '_' . $nombreOriginal,
                'public'
            );

            $reg = PlanillaEmpresa::create([
                'fecha'          => $request->fecha,
                'documento'      => $ruta,
                'nombre_archivo' => $nombreOriginal,
                'total_mes'      => $total,
                'tipo'           => $tipo,
            ]);

            $registros[] = [
                'id'             => $reg->id,
                'fecha'          => $reg->fecha->format('Y-m-d'),
                'documento'      => asset('storage/' . $ruta),
                'nombre_archivo' => $nombreOriginal,
                'total_mes'      => $total,
                'tipo'           => $tipo,
            ];
        }

        return response()->json([
            'message'   => 'Archivos guardados correctamente',
            'registros' => $registros,
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────
    // EDITAR  POST /planillas/editar
    // ─────────────────────────────────────────────────────────────────────
    public function editar(Request $request)
    {
        $request->validate([
            'id'        => 'required|exists:planillas_empresa,id',
            'fecha'     => 'required|date',
            'total_mes' => 'nullable|numeric|min:0',
            'documento' => 'nullable|file|max:20480',
        ]);

        $planilla = PlanillaEmpresa::findOrFail($request->id);
        $sinTotal = in_array($planilla->tipo, self::SIN_TOTAL);

        $planilla->fecha     = $request->fecha;
        $planilla->total_mes = $sinTotal ? null : (float) $request->total_mes;

        if ($request->hasFile('documento')) {
            // Eliminar archivo anterior si existe
            if ($planilla->documento && Storage::disk('public')->exists($planilla->documento)) {
                Storage::disk('public')->delete($planilla->documento);
            }

            $archivo        = $request->file('documento');
            $nombreOriginal = $archivo->getClientOriginalName();
            $ruta = $archivo->storeAs(
                'planillas/' . $planilla->tipo,
                time() . '_' . $nombreOriginal,
                'public'
            );

            $planilla->documento      = $ruta;
            $planilla->nombre_archivo = $nombreOriginal;
        }

        $planilla->save();

        return response()->json([
            'message'  => 'Registro actualizado correctamente',
            'registro' => [
                'id'             => $planilla->id,
                'fecha'          => $planilla->fecha->format('Y-m-d'),
                'documento'      => $planilla->documento ? asset('storage/' . $planilla->documento) : null,
                'nombre_archivo' => $planilla->nombre_archivo,
                'total_mes'      => $planilla->total_mes,
                'tipo'           => $planilla->tipo,
            ],
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────
    // ELIMINAR  DELETE /planillas/eliminar/{id}
    // ─────────────────────────────────────────────────────────────────────
    public function eliminar($id)
    {
        $planilla = PlanillaEmpresa::findOrFail($id);

        if ($planilla->documento && Storage::disk('public')->exists($planilla->documento)) {
            Storage::disk('public')->delete($planilla->documento);
        }

        $planilla->delete();

        return response()->json(['message' => 'Registro eliminado correctamente']);
    }

    // ─────────────────────────────────────────────────────────────────────
    // DATOS GRÁFICO  GET /planillas/grafico
    // ─────────────────────────────────────────────────────────────────────
    public function datosGrafico()
    {
        $tipos = [1, 2, 3, 4, 6];

        $datos = collect($tipos)->map(function ($tipo) {
            $suma = PlanillaEmpresa::where('tipo', $tipo)->sum('total_mes');

            $valorGrafico = match ($tipo) {
                1 => $suma * 0.10,
                6 => 0,
                default => $suma,
            };

            return [
                'tipo'          => $tipo,
                'nombre'        => PlanillaEmpresa::nombreTipo($tipo),
                'total_mes'     => $suma,
                'valor_grafico' => $valorGrafico,
            ];
        });

        return response()->json($datos);
    }
}