<?php

namespace App\Http\Controllers;

use App\Models\Arrendatario;
use Illuminate\Http\Request;
use App\Models\Arriendo;
use App\Models\Comision;
use App\Models\Propiedad;
use App\Models\Precios;
use App\Models\ArchivoPropiedad;
use App\Models\Contrato;
use App\Models\EstadoPagos;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class ArriendoController extends Controller
{
    public function index()
    {
        $arriendos = Arriendo::where('estado', 1)->get();
        $propiedades = Propiedad::where('tipo_propiedad', '!=', 2)
            ->where('estado', 1)
            ->with('propietario')
            ->get();        
        $arrendatario = Arrendatario::where('estado', 1)->get();
        $comision = Comision::all();
        $contratos = Contrato::all();
        $estados = EstadoPagos::all();

        return view('arriendos', compact('estados','arriendos', 'propiedades', 'arrendatario', 'comision', 'contratos'));
    }

  
    public function addArriendo(Request $request)
    {
       $request->validate([
        'fecha_pago' => 'required|numeric|min:1|max:31',
        'id_propiedad' => 'required',
        // ... otras validaciones
        ]);
        // Crear un nuevo registro de arriendo
        $new_arriendo = new Arriendo();
        // $new_arriendo->fecha_devolucion = $request->fecha_devolucion;
        $new_arriendo->fecha_entrega = $request->fecha_entrega;
        $new_arriendo->valor_arriendo = $request->valor_arriendo;
        $new_arriendo->mes_garantia = $request->input('mes_garantia', 0); // Si no viene, se asume 0
        $new_arriendo->gastos_comunes = $request->gastos_comunes;
        $new_arriendo->fecha_pago = $request->fecha_pago;
        $new_arriendo->id_propiedad = $request->id_propiedad;
        $new_arriendo->id_arrendatario = $request->arrendatario;
        $new_arriendo->id_comision = $request->comisiones;
        $new_arriendo->valor_real = $request->valor_real;
        $new_arriendo->estado = 1;
        $new_arriendo->id_estadopagos = $request->estado;
        $new_arriendo->reajuste_ipc = $request->reajuste_ipc;

        $new_arriendo->save();

        $estado = $request->id_propiedad;
        $new_estadoarriendo = Propiedad::where('id',$estado)->first();
        $new_estadoarriendo->estado_venta = 2;
        $new_estadoarriendo->save();
        // dd($new_arriendo);
     
        // Crear un nuevo contrato
        // $nuevoContrato = new Contrato();
        // $nuevoContrato->id_arriendo = $new_arriendo->id; // Asumimos que tienes una columna id_arriendo en contratos
    
        // Manejar la carga de archivos
        if ($request->hasFile('Archivo')) {
            foreach ($request->file('Archivo') as $docFile) {
                if ($docFile->isValid()) {
                  // Obtener el nombre original del archivo
                  $docName = time() . '_' . $docFile->getClientOriginalName();
                  // Guardar el archivo en el sistema de archivos
                  $ruta = $docFile->storeAs('contratos', $docName, 'public');
                  $nuevoContrato = new Contrato();
                  $nuevoContrato->id_arriendo = $new_arriendo->id;
                  // Guardar la ruta del archivo en el contrato
                  // Aquí asumimos que deseas almacenar múltiples rutas en la columna 'contrato'
                  $nuevoContrato->contrato ='/storage/public/'.$ruta; // Agregar la ruta al array
                  $nuevoContrato->save();
                } else {
                    Log::error('El archivo no es válido: ' . $docFile->getClientOriginalName());
                }
            }
        } else {
            Log::warning('No se recibió ningún archivo en la solicitud.');
        }
        // $nuevoContrato->save(); // Guardar el contrato después de agregar las rutas de los archivos
    
        // Retornar una respuesta JSON sin incluir los archivos
        return response()->json([
            'nueva_arriendo' => $new_arriendo->load('arrendatario', 'comision')
        ]);
    }

    
    public function datosArriendo($idArriendo){
        $arriendos = Arriendo::where('id', $idArriendo)->first();

        return response()->json([
            'arriendos' => $arriendos,
        ]);
    }

    public function mostrarArchivos($idArriendo)
    {
        $archivosver = Contrato::where('id_arriendo', $idArriendo)->get();

        $datosArchivos = [];
        foreach ($archivosver as $archivos) {
            $datosArchivos[] = [
                'id' => $archivos->id,
                'archivo' => $archivos->contrato,
                'id_arriendo' => $archivos->id_arriendo,

            ];
        }

        return response()->json(['datosarchivos' => $datosArchivos]);
    }

    public function destroy($idcontrato) {
        // Buscar el registro
        $contrato = Contrato::find($idcontrato);
    
        if(!$contrato) {
            return response()->json(['error' => 'Archivo no encontrado'], 404);
        }
    
        // Eliminar el registro
        $contrato->delete();
    
        return response()->json(['success' => 'Archivo ha sido eliminado correctamente']);
    }


    public function addArchivo_arriendo(Request $request, $idArriendo )
{
    {
        $request->validate([
            'contratos2' => 'required|array',
        ]);

        if ($request->hasFile('contratos2')) {
            foreach ($request->file('contratos2') as $archivo) {
                $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                $rutaArchivo = $archivo->storeAs('contratos', $nombreArchivo, 'public');

                // Guardar la ruta del archivo en la base de datos
                $nuevoContrato = new Contrato();
                $nuevoContrato->id_arriendo = $idArriendo ;
                $nuevoContrato->contrato = '/storage/public/' . $rutaArchivo;
                $nuevoContrato->save();
                  // dd(session()->all()); //
            }

            return response()->json([
                'mensaje' => 'Archivos guardados exitosamente',
                'archivos' => Contrato::where('id_arriendo', $idArriendo )->get() // Retorna la lista actualizada de archivos
            ]);
        }

        return response()->json([
            'mensaje' => 'No se encontraron archivos para guardar'
        ], 400);
    }
}
public function getValorArriendo($id)
{
    // Buscar la propiedad según el ID
    $propiedad = Precios::where('id_propiedad', $id)->first(); // Ajusta según tu modelo y tabla

    if ($propiedad) {
        // Obtener el mes actual
        $mesActual = Carbon::now()->month;

        // Crear la respuesta con ambos valores
        $respuesta = [
            'ano_corrido' => $propiedad->ano_corrido,
            'diciembre' => $propiedad->diciembre
        ];

        // Verificar si el mes actual es diciembre
        if ($mesActual) {
            $respuesta['valor_actual'] = $propiedad->diciembre;
        } else {
            $respuesta['valor_actual'] = $propiedad->ano_corrido;
        }

        // Retornar la respuesta en JSON
        return response()->json($respuesta);
    }

    // Retornar error si no se encuentra la propiedad
    return response()->json(['error' => 'Propiedad no encontrada'], 404);
}



    
    public function addEditArriendo(Request $request){

        $idArriendo = $request->idArriendo;
        // dd($request->all());
        $arriendo_edit = Arriendo::where('id', $idArriendo)->first();
        $arriendo_edit->fecha_devolucion = $request->fecha_devolucion;
        $arriendo_edit->fecha_entrega = $request->fecha_entrega;
        $arriendo_edit->valor_real = $request->valor_arriendo;
        $arriendo_edit->mes_garantia = $request->mes_garantia;
        $arriendo_edit->gastos_comunes = $request->gastos_comunes;
        $arriendo_edit->fecha_pago = $request->fecha_pago;
        // $arriendo_edit->id_propiedad = $request->propiedad;
        $arriendo_edit->id_arrendatario = $request->arrendatario;
        $arriendo_edit->id_comision = $request->comisiones;
        $arriendo_edit->estado = 1;
        $arriendo_edit->id_estadopagos = $request->estadoedit;
        $arriendo_edit->reajuste_ipc = $request->reajusteedit;
        $arriendo_edit->save();

        return Response()->json([
            'arriendo_editado' => $arriendo_edit,
        ]);
    }

    public function eliminarArriendo(Request $request)
    {
        $idArriendo = $request->idArriendo;
        $idpropiedad;
        $arriendo_del = Arriendo::where('id', $idArriendo)->first();
        $arriendo_del->estado = 0;

        $idpropiedad = $arriendo_del->id_propiedad ;
        
        $estadopropiedad = propiedad::where('id',$idpropiedad)->first();
        $estadopropiedad->estado_venta = 1;
        
        $arriendo_del->save();
        $estadopropiedad->save();

        return Response()->json(['arriendo_delete' => $arriendo_del, 'propiedad_disponible' => $estadopropiedad]);
    }



    ///////////// TRABAJADOR ///////////
    public function indextrabajador()
    {
        $arriendos = Arriendo::where('estado', 1)->get();
        $propiedades = Propiedad::where('tipo_propiedad',"!=",2)->where('estado',1)->get();
        $arrendatario = Arrendatario::where('estado', 1)->get();
        $comision = Comision::all();
        $contratos = Contrato::all();
        $estados = EstadoPagos::all();

        return view('trabajador.arriendos', compact('contratos','estados','arriendos', 'propiedades', 'arrendatario', 'comision'));
    }
}
