<?php

namespace App\Http\Controllers;

use App\Models\Arriendo;
use Illuminate\Http\Request;
use App\Models\Pagos;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PagosController extends Controller
{
    public function index()
    {
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
    
        $pagos = Pagos::where('estado', 1)->get()->map(function ($pago) use ($meses) {
            $pago->mes_nombre = $meses[$pago->mes] ?? 'Mes desconocido';
            return $pago;
        });
    
        $arriendos = Arriendo::where('estado', 1)->get();
    
        return view('pagos', compact('pagos', 'arriendos'));
    }
    

    public function addPagos(Request $request){


        if ($request->file('documento_pago') != null) {
            // Guardar las imágenes en la carpeta pública y la información en la base de datos
            foreach ($request->file('documento_pago') as $imagenFile) {
                // Guardar la imagen en la carpeta pública
                $imageName = time() . '_' . $imagenFile->getClientOriginalName();
                $imagenPath = $imagenFile->storeAs('documento_pago', $imageName, 'public');

                // Guardar la información de la imagen en la base de datos
                $new_pago = new Pagos();
                $new_pago->mes = $request->mes;
                $new_pago->año = $request->año;
                $new_pago->documento_pago = $request->documento_pago;
                $new_pago->estado_pago = $request->estado_pago;
                $new_pago->id_arriendo = $request->id_arriendo;
                $new_pago->estado = 1;
                $new_pago->documento_pago = '/storage/' . $imagenPath; // Guardamos solo la ruta de la imagen
                $new_pago->save();
            }
        }


        return Response()->json(['nuevo_pago'=>$new_pago]);
    }

    public function datosPagos($idPago){
        $pagos = Pagos::where('id', $idPago)->first();

        return response()->json([
            'pagos' => $pagos,
        ]);
    }
    public function addEditPago(Request $request)
    {
        $pago_edit = Pagos::where('id', $request->idPago)->first();
    
        // Si existe un nuevo archivo, eliminar el archivo anterior
        if ($request->file('documento_pago') != null) {
            if ($pago_edit->documento_pago && file_exists(public_path($pago_edit->documento_pago))) {
                unlink(public_path($pago_edit->documento_pago)); // Eliminar el archivo anterior
            }
    
            // Guardar el nuevo archivo
            foreach ($request->file('documento_pago') as $imagenFile) {
                $imageName = time() . '_' . $imagenFile->getClientOriginalName();
                $imagenPath = $imagenFile->storeAs('documento_pago', $imageName, 'public');
                $pago_edit->documento_pago = '/storage/' . $imagenPath; // Actualizar la ruta del documento
            }
        }
    
        // Actualizar los demás campos
        $pago_edit->mes = $request->mes;
        $pago_edit->año = $request->año;
        $pago_edit->estado_pago = $request->estado_pago;
        $pago_edit->id_arriendo = $request->id_arriendo;
        $pago_edit->estado = 1;
        $pago_edit->save();
    
        return response()->json([
            'pago_editado' => $pago_edit,
            'message' => 'Pago actualizado con éxito.',
        ]);
    }
    

    public function eliminarPago(Request $request)
    {
        $idPago = $request->idPago;

        $pago_del = Pagos::where('id', $idPago)->first();
        $pago_del->estado = $request->estado;
        $pago_del->save();

        return Response()->json(['pago_delete' => $pago_del]);
    }
}
