<?php

namespace App\Http\Controllers;

use App\Models\ObrasMenores;
use Illuminate\Http\Request;

class ObrasMenoresController extends Controller
{
    // Crear Nuevos Casos de Servicio de Obras Menores
    public function agregarOMe(Request $request)
    {     
        $obra_menor = new ObrasMenores();      
        
        $obra_menor->id_propiedad = $request->id_propiedad;
        $obra_menor->id_trabajador = $request->id_trabajador;     
        $obra_menor->nombre_trabajador = $request->nombre_trabajador;  
        $obra_menor->fecha = $request->fecha;
        $obra_menor->trabajo_realizado = $request->trabajo_realizado;
        $obra_menor->mano_obra_valor = $request->mano_obra_valor;
        $obra_menor->garantia = $request->garantia;
        $obra_menor->valor_total = $request->valor_total;  

        $obra_menor->save();

        return response()->json(['message' => 'Servicio de Obra Menor creado correctamente']);             
    }

    // Funcion para conseguir un servicio en especifico, usado en modal de editar
    public function conseguirOMe($id)
    {
        $obra_menor = ObrasMenores::find($id);

        if ($obra_menor) {
            return response()->json(['obra_menor' => $obra_menor]);
        }

        return response()->json(['message' => 'Obra menor no encontrada'], 404);
    }

    // Funcion para actualizar los datos de un servicio en especifico
    public function editarOMe(Request $request, $id)
    {
        $obra_menor = ObrasMenores::find($id);      

        if ($obra_menor) {

            $obra_menor->id_propiedad = $request->id_propiedad;
            $obra_menor->id_trabajador = $request->id_trabajador;     
            $obra_menor->nombre_trabajador = $request->nombre_trabajador;  
            $obra_menor->fecha = $request->fecha;
            $obra_menor->trabajo_realizado = $request->trabajo_realizado;
            $obra_menor->mano_obra_valor = $request->mano_obra_valor;
            $obra_menor->garantia = $request->garantia;
            $obra_menor->valor_total = $request->valor_total;  

            $obra_menor->save();

            return response()->json(['message' => 'Obra menor actualizada correctamente']);
        }

        return response()->json(['message' => 'Obra menor no encontrada'], 404);    
    }

    // Borrar un servicio especifico de la tabla con sus imagenes
    public function borrarOMe($id)
    {
        try {

            $obra_menor = ObrasMenores::findOrFail($id);

            // Obtén todas las imágenes asociadas al servicio
            $imagenes = $obra_menor->imagenes;

            // Elimina cada imagen
            foreach ($imagenes as $imagen) {
                $imagen->delete();
            }

            // Elimina el servicio
            $obra_menor->delete();

            return response()->json(['message' => 'Obra Menor y sus imágenes eliminados correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Hubo un error al intentar eliminar la Obra Menor.'], 500);
        }
    }

}
