<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Propietario;
use App\Models\Propiedad;
use App\Models\DatosBancario;
use App\Models\Banco;

class PropietarioController extends Controller
{
    public function index()
    {
        $propietarios = Propietario::where('estado', 1)->get();
        $propietario = Propietario::where('estado', 1)->first();


        return view('propietario', compact('propietarios', 'propietario'));
    }
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'rut' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verificar si ya existe un propietario con el mismo RUT o correo
        $existe = Propietario::where('rut', $request->rut)
            ->orWhere('correo', $request->correo)
            ->first();

        if ($existe) {
            return response()->json([
                'exists' => true,
                'message' => 'El propietario ya existe con este RUT o correo.'
            ], 409);
        }

        $new_propietario = new Propietario();
        $new_propietario->nombre = $request->input('nombre');
        $new_propietario->rut = $request->input('rut');
        $new_propietario->telefono = $request->input('telefono');
        $new_propietario->correo = $request->input('correo');
        $new_propietario->direccion = $request->input('direccion');
        $new_propietario->ciudad = $request->input('ciudad');
        $new_propietario->estado = 1;
        $new_propietario->save();

        // Guardar datos bancarios si existen
        $DatosAgregados = json_decode($request->DatosAgregados, true);

        if (!empty($DatosAgregados)) {
            foreach ($DatosAgregados as $datosbancarios) {
                $new_Datos = new DatosBancario;
                $new_Datos->id_propietario = $new_propietario->id;
                $new_Datos->nombre_banco = $datosbancarios['nombre_banco'];
                $new_Datos->numero_cuenta = $datosbancarios['numero_cuenta'];
                $new_Datos->tipo_cuenta = $datosbancarios['tipo_cuenta'];
                $new_Datos->save();
            }
        }

        return response()->json(['message' => 'Datos agregados correctamente']);
    }

    // Editar Propietario
    public function show($idpropietario)
    {
        $propietario = Propietario::with('datosBancarios')
            ->find($idpropietario);

        if (!$propietario) {
            return response()->json([
                'message' => 'Propietario no encontrado'
            ], 404);
        }

        return response()->json($propietario);
    }

    public function update(Request $request, $id)
    {
        $propietario = Propietario::findOrFail($id);

        $propietario->nombre = $request->nombre;
        $propietario->rut = $request->rut;
        $propietario->telefono = $request->telefono;
        $propietario->correo = $request->correo;
        $propietario->direccion = $request->direccion;
        $propietario->ciudad = $request->ciudad;

        $propietario->save();

        // Guardar únicamente las cuentas nuevas
        if ($request->has('cuentas_nuevas')) {

            foreach ($request->cuentas_nuevas as $cuenta) {

                if (
                    !empty($cuenta['nombre_banco']) &&
                    !empty($cuenta['numero_cuenta'])
                ) {

                    DatosBancario::create([
                        'id_propietario' => $propietario->id,
                        'nombre_banco'   => $cuenta['nombre_banco'],
                        'tipo_cuenta'    => $cuenta['tipo_cuenta'],
                        'numero_cuenta'  => $cuenta['numero_cuenta']
                    ]);
                }
            }
        }

        return response()->json($propietario, 200);
    }


    public function delete(Request $request, $id)
    {
        $propietario = Propietario::where('id', $id)->firstOrFail();
        $propietario->estado = 0; // Cambia el estado a 0
        $propietario->save();
        return response()->json(['success' => 'El estado del propietario se ha Borrado con éxito']);
    }

    public function destroycuenta($id)
    {
        $cuenta = DatosBancario::findOrFail($id);

        $cuenta->delete();

        return response()->json([
            'success' => true
        ]);
    }


    public function mostrarDatosBancarios($idpropietario)
    {
        $cunta_bancaria = DatosBancario::where('id_propietario', $idpropietario)->get();

        $datosBancarios = [];
        foreach ($cunta_bancaria as $bancario) {
            $datosBancarios[] = [
                'id' => $bancario->id,
                'nombre_banco' => $bancario->nombre_banco,
                'numero_cuenta' => $bancario->numero_cuenta,
                'tipo_cuenta' => $bancario->tipo_cuenta,
            ];
        }

        return response()->json(['datosbancarios' => $datosBancarios]);
    }
    // Muestra en otro modal los datos de la cuenta para editar o agregar una nueva
    public function showcuenta($id_cuenta)
    {
        $cuenta_bancaria = DatosBancario::where('id', $id_cuenta)->first();

        if (!$cuenta_bancaria) {
            return response()->json(['error' => 'Cuenta no encontrada'], 404);
        }

        return response()->json(['cuenta_bancaria' => $cuenta_bancaria]);
    }

    ///Guardar la ediccion////
    public function updateCuenta(Request $request, $id_cuenta)
    {

        $datosBancarios = DatosBancario::find($id_cuenta);

        $datosBancarios->nombre_banco = $request->nombre_banco;
        $datosBancarios->numero_cuenta = $request->numero_cuenta;
        $datosBancarios->tipo_cuenta = $request->tipo_cuenta;
        // $datosBancarios->id_propietario = $request->id_propietario;

        $datosBancarios->save();

        return response()->json($datosBancarios, 200);
    }
    ///Eliminar la Cuenta Bancaria del propietario/////

    public function eliminarcuenta(Request $request, $id)
    {
        $datosBancarios = DatosBancario::find($id)->delete();
        return Response()->json(['cuenta' => 'Cuenta ah sido eliminado correctamente ']);
    }

    /////Nueva CUENTA BANCARIA///////////7

    // public function addNuevaCuenta(Request $request)
    //     {
    //         $validator = DatosBancario::make($request->all(), [
    //             'id_propietario' => 'required|exists:propietarios,id', 
    //             'nombre_banco' => 'required',
    //             'numero_cuenta' => 'required',
    //             'tipo_cuenta' => 'required',


    //         ]);


    //         if ($validator->fails()) {
    //             return response()->json(['errors' => $validator->errors()], 422);
    //         }
    //         $new_cuenta = new DatosBancario();
    //         $new_cuenta->nombre_banco = $request->input('nombre_banco');
    //         $new_cuenta->numero_cuenta = $request->input('numero_cuenta');
    //         $new_cuenta->tipo_cuenta = $request->input('tipo_cuenta');
    //         $new_cuenta->id_propietario = $request->input('id_propietario');

    //         $new_cuenta->save();

    //         return response()->json(['message' => 'Datos agregados correctamente']);



    //     }

    public function addNuevaCuenta(Request $request)
    {
        $new_cuenta = new DatosBancario();
        $new_cuenta->nombre_banco = $request->nombre_banco;
        $new_cuenta->numero_cuenta = $request->numero_cuenta;
        $new_cuenta->tipo_cuenta = $request->tipo_cuenta;
        $new_cuenta->id_propietario = $request->id_propietario;


        $new_cuenta->save();
        return response()->json(['message' => 'Datos agregados correctamente']);
    }


    public function detalles($id)
    {
        $propietario = Propietario::findOrFail($id);

        // 🔹 PROPIEDADES NORMALES
        $propiedadesIds = \App\Models\Propietario_propiedades::where('id_propietario', $id)
            ->pluck('id_propiedad');

        $propiedades = \App\Models\Propiedad::with(['imagenes', 'precios'])
            ->whereIn('id', $propiedadesIds)
            ->where('estado', 1)
            ->get();

        // 🔹 PROPIEDADES VERANO
        $veranoIds = \App\Models\PropietarioVerano::where('id_propietario', $id)
            ->pluck('id_verano');

        $propiedadesVerano = \App\Models\Verano::with(['detallesVeranos.imagenes'])
            ->whereIn('id', $veranoIds)
            ->where('estado', 1)
            ->get();

        // 🔹 IMPORTANTE: marcar como tipo 4 (verano)
        foreach ($propiedadesVerano as $verano) {
            $verano->tipo_propiedad = 4;
        }

        // 🔹 UNIR TODO
        $propiedades = $propiedades->concat($propiedadesVerano);

        return view('propietario_detalles', compact('propietario', 'propiedades'));
    }
}
