<?php

namespace App\Http\Controllers;

use App\Models\ObrasMayores;
use Illuminate\Http\Request;

class ObrasMayoresController extends Controller
{
    // Crear Nuevos Casos de Servicio de Obras Mayores
    public function agregarOMa(Request $request)
    {     
        $obra_mayor = new ObrasMayores();      
        
        $obra_mayor->id_propiedad = $request->id_propiedad;
        $obra_mayor->id_trabajador = $request->id_trabajador;     
        $obra_mayor->nombre_trabajador = $request->nombre_trabajador;  
        $obra_mayor->fecha = $request->fecha;
        $obra_mayor->trabajo_realizado = $request->trabajo_realizado;
        $obra_mayor->mano_obra_valor = $request->mano_obra_valor;
        $obra_mayor->garantia = $request->garantia;
        $obra_mayor->valor_total = $request->valor_total;  

        $obra_mayor->save();

        return response()->json(['message' => 'Servicio de Obra Mayor creado correctamente']);             
    }

    // Funcion para conseguir un servicio en especifico, usado en modal de editar
    public function conseguirOMa($id)
    {
        $obra_mayor = ObrasMayores::find($id);

        if ($obra_mayor) {
            return response()->json(['obra_mayor' => $obra_mayor]);
        }

        return response()->json(['message' => 'Obra mayor no encontrada'], 404);
    }

    // Funcion para actualizar los datos de un servicio en especifico
    public function editarOMa(Request $request, $id)
    {
        $obra_mayor = ObrasMayores::find($id);      

        if ($obra_mayor) {

            $obra_mayor->id_propiedad = $request->id_propiedad;
            $obra_mayor->id_trabajador = $request->id_trabajador;     
            $obra_mayor->nombre_trabajador = $request->nombre_trabajador;  
            $obra_mayor->fecha = $request->fecha;
            $obra_mayor->trabajo_realizado = $request->trabajo_realizado;
            $obra_mayor->mano_obra_valor = $request->mano_obra_valor;
            $obra_mayor->garantia = $request->garantia;
            $obra_mayor->valor_total = $request->valor_total;     

            $obra_mayor->save();

            return response()->json(['message' => 'Obra mayor actualizada correctamente']);
        }

        return response()->json(['message' => 'Obra mayor no encontrada'], 404);    
    }

    // Borrar un servicio especifico de la tabla con sus imagenes
    public function borrarOMa($id)
    {
        try {

            $obra_mayor = ObrasMayores::findOrFail($id);

            // Obtén todas las imágenes asociadas al servicio
            $imagenes = $obra_mayor->imagenes;

            // Elimina cada imagen
            foreach ($imagenes as $imagen) {
                $imagen->delete();
            }

            // Elimina el servicio
            $obra_mayor->delete();

            return response()->json(['message' => 'Obra Mayor y sus imágenes eliminados correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Hubo un error al intentar eliminar la Obra Mayor.'], 500);
        }
    }

}
