<?php

namespace App\Http\Controllers;

use App\Models\Gasfiteria;
use Illuminate\Http\Request;

class GasfiteriaController extends Controller
{
    // Crear Nuevos Casos de Servicio de Gasfiteria
    public function agregarGas(Request $request)
    {     
        $gasfiteria = new Gasfiteria();      
        
        $gasfiteria->id_propiedad = $request->id_propiedad;
        $gasfiteria->id_trabajador = $request->id_trabajador;     
        $gasfiteria->nombre_trabajador = $request->nombre_trabajador;  
        $gasfiteria->fecha = $request->fecha;
        $gasfiteria->trabajo_realizado = $request->trabajo_realizado;
        $gasfiteria->mano_obra_valor = $request->mano_obra_valor;
        $gasfiteria->garantia = $request->garantia;
        $gasfiteria->valor_total = $request->valor_total;  

        $gasfiteria->save();

        return response()->json(['message' => 'Servicio de Gasfiteria creado correctamente']);             
    }

    // Funcion para conseguir un servicio en especifico, usado en modal de editar
    public function conseguirGas($id)
    {
        $gasfiteria = Gasfiteria::find($id);

        if ($gasfiteria) {
            return response()->json(['gasfiteria' => $gasfiteria]);
        }

        return response()->json(['message' => 'Gasfiteria no encontrada'], 404);
    }

    public function editarGas(Request $request, $id)
    {
        $gasfiteria = Gasfiteria::find($id);      

        if ($gasfiteria) {

            $gasfiteria->id_propiedad = $request->id_propiedad;
            $gasfiteria->id_trabajador = $request->id_trabajador;     
            $gasfiteria->nombre_trabajador = $request->nombre_trabajador;  
            $gasfiteria->fecha = $request->fecha;
            $gasfiteria->trabajo_realizado = $request->trabajo_realizado;
            $gasfiteria->mano_obra_valor = $request->mano_obra_valor;
            $gasfiteria->garantia = $request->garantia;
            $gasfiteria->valor_total = $request->valor_total; 

            $gasfiteria->save();

            return response()->json(['message' => 'Gasfiteria actualizada correctamente']);
        }

        return response()->json(['message' => 'Gasfiteria no encontrada'], 404);    
    }

    // Borrar un servicio especifico de la tabla con sus imagenes
    public function borrarGas($id)
    {
        try {

            $gasfiteria = Gasfiteria::findOrFail($id);

            // Obtén todas las imágenes asociadas al servicio
            $imagenes = $gasfiteria->imagenes;

            // Elimina cada imagen
            foreach ($imagenes as $imagen) {
                $imagen->delete();
            }

            // Elimina el servicio
            $gasfiteria->delete();

            return response()->json(['message' => 'Gasfiteria y sus imágenes eliminados correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Hubo un error al intentar eliminar la Gasfiteria.'], 500);
        }
    }
}
