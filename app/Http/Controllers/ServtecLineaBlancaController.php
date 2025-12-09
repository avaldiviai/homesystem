<?php

namespace App\Http\Controllers;

use App\Models\Gasfiteria;
use App\Models\ImgGasfiteria;
use App\Models\ImgOMayores;
use App\Models\ImgOMenores;
use App\Models\ImgServtec;
use App\Models\Materiales_Gasfiteria_Servicio;
use App\Models\Materiales_OMa_Servicio;
use App\Models\Materiales_OMe_Servicio;
use App\Models\Materiales_Servtec_Servicio;
use App\Models\ObrasMayores;
use App\Models\ObrasMenores;
use App\Models\Propiedad;
use App\Models\ServtecLineaBlanca;
use App\Models\User;
use GMP;
use Illuminate\Http\Request;

class ServtecLineaBlancaController extends Controller
{
    //Conseguir todos los servicios disponibles
    public function index()
    {        
        $servtecs = ServtecLineaBlanca::with('propiedad')->get();
        $gasfiterias = Gasfiteria::with('propiedad')->get();
        $obrasmayores = ObrasMayores::with('propiedad')->get();
        $obrasmenores = ObrasMenores::with('propiedad')->get();
        $imgServtec = ImgServtec::all();
        $imgGas = ImgGasfiteria::all();
        $imgOMa = ImgOMayores::all();
        $imgOMe = ImgOMenores::all();
        $propiedades = Propiedad::all();
        $trabajadores = User::all();

        return view('servicios', compact('servtecs','gasfiterias','obrasmayores','obrasmenores','propiedades','trabajadores'));
    }
    public function indexObreroservi()
    {        
        $servtecs = ServtecLineaBlanca::with('propiedad')->get();
        $gasfiterias = Gasfiteria::with('propiedad')->get();
        $obrasmayores = ObrasMayores::with('propiedad')->get();
        $obrasmenores = ObrasMenores::with('propiedad')->get();
        $imgServtec = ImgServtec::all();
        $imgGas = ImgGasfiteria::all();
        $imgOMa = ImgOMayores::all();
        $imgOMe = ImgOMenores::all();
        $propiedades = Propiedad::all();
        $trabajadores = User::all();

        return view('obrero.servicios', compact('servtecs','gasfiterias','obrasmayores','obrasmenores','propiedades','trabajadores'));
    }

    public function conseguirImagenes($id, $tipo)
    {
        switch ($tipo) {
            case 1:
                $imagenes = ImgServtec::where('id_servtec', $id)->get();
                break;
            case 2:
                $imagenes = ImgGasfiteria::where('id_gasfiteria', $id)->get();
                break;
            case 3:
                $imagenes = ImgOMayores::where('id_obramayor', $id)->get();
                break;
            case 4:
                $imagenes = ImgOMenores::where('id_obramenor', $id)->get();
                break;
            default:
                return response()->json([], 400); // Tipo no válido
        }

        return response()->json($imagenes);
    }
    public function conseguirVideos($id, $tipo)
    {
        switch ($tipo) {
            case 1:
                $imagenes = ImgServtec::where('id_servtec', $id)->get();
                break;
            case 2:
                $imagenes = ImgGasfiteria::where('id_gasfiteria', $id)->get();
                break;
            case 3:
                $imagenes = ImgOMayores::where('id_obramayor', $id)->get();
                break;
            case 4:
                $imagenes = ImgOMenores::where('id_obramenor', $id)->get();
                break;
            default:
                return response()->json([], 400); // Tipo no válido
        }

        return response()->json($imagenes);
    }

    public function guardarImagen(Request $request)
    {
        $request->validate([
            'imagen' => 'required|file|max:20480',
            'idServicio' => 'required|integer',
            'tipoServicio' => 'required|integer',
            'tipo' => 'required|string|in:imagen,video,documento', // Recordatorio de mantener consistencia en los nombres
        ], [
            'imagen.required' => 'El archivo es obligatorio.',
            'imagen.file' => 'Debe ser un archivo válido.',
            'imagen.max' => 'El archivo no debe exceder los 20 MB.',
            'idServicio.required' => 'El ID del servicio es obligatorio.',
            'tipoServicio.required' => 'El tipo de servicio es obligatorio.',
            'tipo.required' => 'El tipo de archivo es obligatorio.',
            'tipo.in' => 'El tipo de archivo debe ser una imagen, video o documento.',
        ]);        

        $nombreImagen = time().'.'.$request->imagen->extension();  
        $request->imagen->move(public_path('uploads'), $nombreImagen);

        $rutaArchivo = 'uploads/' . $nombreImagen;

        // Crea una nueva instancia del modelo correspondiente según el tipo de servicio
        switch ($request->tipoServicio) {
            case 1:

                $image = new ImgServtec;                
                
                $image->id_servtec = $request->idServicio;
                
                break;
                
            case 2:

                $image = new ImgGasfiteria;
                
                $image->id_gasfiteria = $request->idServicio;

                break;

            case 3:

                $image = new ImgOMayores;
                
                $image->id_obramayor = $request->idServicio;

                break;

            case 4:

                $image = new ImgOMenores;
                
                $image->id_obramenor = $request->idServicio;

                break;

            default:
                return response()->json(['error' => 'Tipo de servicio no válido.'], 400);

        }

        $image->nombre = $nombreImagen;
        $image->link = $rutaArchivo;
        $image->tipo = $request->tipo;
        $image->save();
        
        return response()->json(['message' => 'Archivo guardado correctamente']);     
    }


    public function guardarDocume(Request $request)
    {
        $request->validate([
            'imagen' => 'required|file|max:20480',
            'idServicio' => 'required|integer',
            'tipoServicio' => 'required|integer',
            'tipo' => 'required|string|in:imagen,video,documento', // Recordatorio de mantener consistencia en los nombres
        ], [
            'imagen.required' => 'El archivo es obligatorio.',
            'imagen.file' => 'Debe ser un archivo válido.',
            'imagen.max' => 'El archivo no debe exceder los 20 MB.',
            'idServicio.required' => 'El ID del servicio es obligatorio.',
            'tipoServicio.required' => 'El tipo de servicio es obligatorio.',
            'tipo.required' => 'El tipo de archivo es obligatorio.',
            'tipo.in' => 'El tipo de archivo debe ser una imagen, video o documento.',
        ]);        

        $nombreImagen = time().'.'.$request->imagen->extension();  
        $request->imagen->move(public_path('uploads'), $nombreImagen);

        $rutaArchivo = 'uploads/' . $nombreImagen;

        // Crea una nueva instancia del modelo correspondiente según el tipo de servicio
        switch ($request->tipoServicio) {
            case 1:

                $image = new ImgServtec;                
                
                $image->id_servtec = $request->idServicio;
                
                break;
                
            case 2:

                $image = new ImgGasfiteria;
                
                $image->id_gasfiteria = $request->idServicio;

                break;

            case 3:

                $image = new ImgOMayores;
                
                $image->id_obramayor = $request->idServicio;

                break;

            case 4:

                $image = new ImgOMenores;
                
                $image->id_obramenor = $request->idServicio;

                break;

            default:
                return response()->json(['error' => 'Tipo de servicio no válido.'], 400);

        }

        $image->nombre = $nombreImagen;
        $image->link = $rutaArchivo;
        $image->tipo = $request->tipo;
        $image->save();
        
        return response()->json(['message' => 'Archivo guardado correctamente']);     
    }

    // Crear Nuevos Casos de Servicio de Linea Blanca
    public function agregarLN(Request $request)
    {     
        $servtecln = new ServtecLineaBlanca();      
        
        $servtecln->id_propiedad = $request->id_propiedad;
        $servtecln->id_trabajador = $request->id_trabajador;     
        $servtecln->nombre_trabajador = $request->nombre_trabajador;  
        $servtecln->fecha = $request->fecha;
        $servtecln->trabajo_realizado = $request->trabajo_realizado;
        $servtecln->mano_obra_valor = $request->mano_obra_valor;
        $servtecln->garantia = $request->garantia;
        $servtecln->valor_total = $request->valor_total;                      

        $servtecln->save();

        return response()->json(['message' => 'Servicio de Linea Blanca creado correctamente']);             
    }

    // Funcion para conseguir un servicio en especifico, usado en modal de editar
    public function conseguirLN($id)
    {
        $servtecln = ServtecLineaBlanca::find($id);

        if ($servtecln) {
            return response()->json(['servtecln' => $servtecln]);
        }

        return response()->json(['message' => 'SLN no encontrado'], 404);
    }

    // Funcion para actualizar los datos de un servicio en especifico
    public function editarLN(Request $request, $id)
    {
        $servtecln = ServtecLineaBlanca::find($id);      

        if ($servtecln) {

            $servtecln->id_propiedad = $request->id_propiedad;
            $servtecln->id_trabajador = $request->id_trabajador;     
            $servtecln->nombre_trabajador = $request->nombre_trabajador;  
            $servtecln->fecha = $request->fecha;
            $servtecln->trabajo_realizado = $request->trabajo_realizado;
            $servtecln->mano_obra_valor = $request->mano_obra_valor;
            $servtecln->garantia = $request->garantia;
            $servtecln->valor_total = $request->valor_total;           

            $servtecln->save();

            return response()->json(['message' => 'LN actualizado correctamente']);
        }

        return response()->json(['message' => 'LN no encontrado'], 404);    
    }

    // Borrar un servicio especifico de la tabla con sus imagenes
    public function borrarLN($id)
    {
        try {

            $servtecln = ServtecLineaBlanca::findOrFail($id);

            // Obtén todas las imágenes asociadas al servicio
            $imagenes = $servtecln->imagenes;

            // Elimina cada imagen
            foreach ($imagenes as $imagen) {
                $imagen->delete();
            }

            // Elimina el servicio
            $servtecln->delete();

            return response()->json(['message' => 'Linea Blanca y sus imágenes eliminados correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Hubo un error al intentar eliminar la linea blanca.'], 500);
        }
    }

    public function verImagenEdit(Request $request)
    {

        $request->validate([
            
            'idImagen' => 'required|integer',            
            'tipoServicio' => 'required|integer',            

        ]);

        // Obtener la imagen antigua según el tipo de servicio
        switch ($request->tipoServicio) {
            case 1:
                $image = ImgServtec::find($request->idImagen);
                return response()->json(['image' => $image]);
            case 2:
                $image = ImgGasfiteria::find($request->idImagen);
                return response()->json(['image' => $image]);
            case 3:
                $image = ImgOMayores::find($request->idImagen);
                return response()->json(['image' => $image]);
            case 4:
                $image = ImgOMenores::find($request->idImagen);
                return response()->json(['image' => $image]);
            default:
                return response()->json(['error' => 'Tipo de servicio no válido.'], 400);
        }

    }

    public function reemplazarImagen(Request $request)
    {
        // $request->validate([
        //     'imagen' => 'required|file|max:20480', // Aumentar tamaño??
        //     'idImagen' => 'required|integer',
        //     'tipo' => 'required|string',
        //     'tipoServicio' => 'required|integer',
        // ]);

        // Obtener la imagen antigua según el tipo de servicio
        switch ($request->tipoServicio) {
            case 1:
                $image = ImgServtec::find($request->idImagen);
                break;
            case 2:
                $image = ImgGasfiteria::find($request->idImagen);
                break;
            case 3:
                $image = ImgOMayores::find($request->idImagen);
                break;
            case 4:
                $image = ImgOMenores::find($request->idImagen);
                break;
            default:
                return response()->json(['error' => 'Tipo de servicio no válido.'], 400);
        }

        if ($image) {
            // Borrar el archivo antiguo físicamente
            $oldFilePath = public_path($image->link);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            // Guardar el nuevo archivo
            $imageName = time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('uploads'), $imageName);

            // Actualizar los datos de la imagen en la base de datos
            $image->nombre = $imageName;
            $image->tipo = $request->tipo;
            $image->link = 'uploads/' . $imageName;
            $image->save();

            return response()->json($image);
        } else {
            return response()->json(['error' => 'Archivo no encontrado.'], 404);
        }

    }

    public function eliminarImagen(Request $request)
    {
        $request->validate([
            'idImagen' => 'required|integer',
            'tipoServicio' => 'required|integer',
        ]);

        // Obtener el archivo según el tipo de servicio
        switch ($request->tipoServicio) {
            case 1:
                $image = ImgServtec::find($request->idImagen);
                break;
            case 2:
                $image = ImgGasfiteria::find($request->idImagen);
                break;
            case 3:
                $image = ImgOMayores::find($request->idImagen);
                break;
            case 4:
                $image = ImgOMenores::find($request->idImagen);
                break;
            default:
                return response()->json(['error' => 'Tipo de servicio no válido.'], 400);
        }

        if ($image) {
            // Borrar la imagen físicamente
            $imagePath = public_path($image->link);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Eliminar la entrada de la base de datos
            $image->delete();

            return response()->json(['success' => 'Imagen eliminada con éxito.']);
        } else {
            return response()->json(['error' => 'Imagen no encontrada.'], 404);
        }
    }

    // Conseguir los materiales de un servicio en especifico
    public function conseguirMateriales($id, $tipo)
    {
        switch ($tipo) {
            case 1:
                $materiales = Materiales_ServTec_Servicio::where('id_servtec', $id)->get();
                break;
            case 2:
                $materiales = Materiales_Gasfiteria_Servicio::where('id_gasfiteria', $id)->get();
                break;
            case 3:
                $materiales = Materiales_OMa_Servicio::where('id_oma', $id)->get();
                break;
            case 4:
                $materiales = Materiales_OMe_Servicio::where('id_ome', $id)->get();
                break;
            default:
                return response()->json([], 400); // Tipo no válido
        }

        return response()->json($materiales);
    }

    // Guardar un material nuevo
    public function guardarMaterial(Request $request)
    {
        $request->validate([

            'idServicio' => 'required|integer',
            'tipoServicio' => 'required|integer',
            'nombre' => 'required|string',
            'precio' => 'required|string',
            
        ]);        

        // Crea una nueva instancia del modelo correspondiente según el tipo de servicio
        switch ($request->tipoServicio) {
            case 1:

                $material = new Materiales_ServTec_Servicio();         
                
                $material->id_servtec = $request->idServicio;
                
                break;
                
            case 2:

                $material = new Materiales_Gasfiteria_Servicio();
                
                $material->id_gasfiteria = $request->idServicio;

                break;

            case 3:

                $material = new Materiales_OMa_Servicio();
                
                $material->id_oma = $request->idServicio;

                break;

            case 4:

                $material = new Materiales_OMe_Servicio();
                
                $material->id_ome = $request->idServicio;

                break;

            default:
                return response()->json(['error' => 'Tipo de servicio no válido.'], 400);

        }

        $material->nombre = $request->nombre;
        $material->precio = $request->precio;
        $material->save();
        
        return response()->json(['message' => 'Material guardado correctamente']);     
    }

    // Conseguir los datos de un material
    public function verMaterial(Request $request)
    {
        $request->validate([

            'idMaterial' => 'required|integer',
            'tipoServicio' => 'required|integer',            
            
        ]);     

        // Consigue la instancia del modelo correspondiente según el tipo de servicio
        switch ($request->tipoServicio) {
            case 1:

                $material = Materiales_ServTec_Servicio::find($request->idMaterial);

                if ($material) {
                    return response()->json(['material' => $material]);
                }

                return response()->json(['message' => 'Material no encontrado'], 404);
                
            case 2:

                $material = Materiales_Gasfiteria_Servicio::find($request->idMaterial);

                if ($material) {
                    return response()->json(['material' => $material]);
                }

                return response()->json(['message' => 'Material no encontrado'], 404);

            case 3:

                $material = Materiales_OMa_Servicio::find($request->idMaterial);

                if ($material) {
                    return response()->json(['material' => $material]);
                }

                return response()->json(['message' => 'Material no encontrado'], 404);

            case 4:

                $material = Materiales_OMe_Servicio::find($request->idMaterial);

                if ($material) {
                    return response()->json(['material' => $material]);
                }

                return response()->json(['message' => 'Material no encontrado'], 404);

            default:
                return response()->json(['error' => 'Tipo de servicio no válido.'], 400);

        }

    }

    // Reemplaza los datos de un material con los datos nuevos
    public function reemplazarMaterial(Request $request)
    {
        $request->validate([

            'idMaterial' => 'required|integer',
            'tipoServicio' => 'required|integer',    
            'nombre' => 'required|string',
            'precio' => 'required|string',
            
        ]);     

        // Consigue la instancia del modelo correspondiente según el tipo de servicio
        switch ($request->tipoServicio) {
            case 1:

                $material = Materiales_ServTec_Servicio::find($request->idMaterial);      

                if ($material) {

                    $material->nombre = $request->nombre;  
                    $material->precio = $request->precio;             

                    $material->save();

                    return response()->json(['message' => 'Material actualizado correctamente']);
                }

                return response()->json(['message' => 'Material no encontrado'], 404);    
                
            case 2:

                $material = Materiales_Gasfiteria_Servicio::find($request->idMaterial);      

                if ($material) {

                    $material->nombre = $request->nombre;  
                    $material->precio = $request->precio;             

                    $material->save();

                    return response()->json(['message' => 'Material actualizado correctamente']);
                }

                return response()->json(['message' => 'Material no encontrado'], 404);

            case 3:

                $material = Materiales_OMa_Servicio::find($request->idMaterial);      

                if ($material) {

                    $material->nombre = $request->nombre;  
                    $material->precio = $request->precio;             

                    $material->save();

                    return response()->json(['message' => 'Material actualizado correctamente']);
                }

                return response()->json(['message' => 'Material no encontrado'], 404);

            case 4:

                $material = Materiales_OMe_Servicio::find($request->idMaterial);      

                if ($material) {

                    $material->nombre = $request->nombre;  
                    $material->precio = $request->precio;             

                    $material->save();

                    return response()->json(['message' => 'Material actualizado correctamente']);
                }

                return response()->json(['message' => 'Material no encontrado'], 404);

            default:
                return response()->json(['error' => 'Tipo de servicio no válido.'], 400);

        }

    }

    // Elimina un material especifico
    public function eliminarMaterial(Request $request)
    {
        $request->validate([

            'idMaterial' => 'required|integer',
            'tipoServicio' => 'required|integer',               
            
        ]);     

        // Consigue la instancia del modelo correspondiente según el tipo de servicio
        switch ($request->tipoServicio) {
            case 1:

                $material = Materiales_Servtec_Servicio::find($request->idMaterial);

                if ($material) {
                    try {                
                    $material->delete();
                    return response()->json(['message' => 'Material eliminado correctamente']);
                    } catch (\Illuminate\Database\QueryException $e) {                
                    if ($e->getCode() == 23000) {
                        // Si el código de error es 23000, entonces es un error de violación de restricción de integridad
                        return response()->json(['message' => 'No se puede eliminar este material porque está siendo referenciado por otra instancia.'], 409);
                    }
                    }
                }

                return response()->json(['message' => 'Material no encontrado'], 404);    
                
            case 2:

                $material = Materiales_Gasfiteria_Servicio::find($request->idMaterial);

                if ($material) {
                    try {                
                    $material->delete();
                    return response()->json(['message' => 'Material eliminado correctamente']);
                    } catch (\Illuminate\Database\QueryException $e) {                
                    if ($e->getCode() == 23000) {
                        // Si el código de error es 23000, entonces es un error de violación de restricción de integridad
                        return response()->json(['message' => 'No se puede eliminar este material porque está siendo referenciado por otra instancia.'], 409);
                    }
                    }
                }

                return response()->json(['message' => 'Material no encontrado'], 404);

            case 3:

                $material = Materiales_OMa_Servicio::find($request->idMaterial);

                if ($material) {
                    try {                
                    $material->delete();
                    return response()->json(['message' => 'Material eliminado correctamente']);
                    } catch (\Illuminate\Database\QueryException $e) {                
                    if ($e->getCode() == 23000) {
                        // Si el código de error es 23000, entonces es un error de violación de restricción de integridad
                        return response()->json(['message' => 'No se puede eliminar este material porque está siendo referenciado por otra instancia.'], 409);
                    }
                    }
                }

                return response()->json(['message' => 'Material no encontrado'], 404);

            case 4:

                $material = Materiales_OMe_Servicio::find($request->idMaterial);

                if ($material) {
                    try {                
                    $material->delete();
                    return response()->json(['message' => 'Material eliminado correctamente']);
                    } catch (\Illuminate\Database\QueryException $e) {                
                    if ($e->getCode() == 23000) {
                        // Si el código de error es 23000, entonces es un error de violación de restricción de integridad
                        return response()->json(['message' => 'No se puede eliminar este material porque está siendo referenciado por otra instancia.'], 409);
                    }
                    }
                }

                return response()->json(['message' => 'Material no encontrado'], 404);

            default:
                return response()->json(['error' => 'Tipo de servicio no válido.'], 400);

        }

    }    


    // En el controlador ServicioController.php
// public function cambiarEstado($id)
// {
//     $obramayor = ObrasMayores::find($id);

//     if ($obramayor) {
//         // Cambiar el estado: si está en 0, cambiar a 1 y viceversa
//         $obramayor->estado = $obramayor->estado ? 0 : 1;
//         $obramayor->save();

//         return response()->json(['message' => 'Estado actualizado correctamente.']);
//     }

//     return response()->json(['message' => 'Servicio no encontrado.'], 404);
// }


public function cambiarEstado3($id, Request $request)
{
$obramayor = ObrasMayores::find($id);  // Buscar la obra mayor por ID

if ($obramayor) {
    if ($request->estado === 'Realizado') {
        if (is_null($obramayor->mano_obra_valor) || is_null($obramayor->garantia) || is_null($obramayor->valor_total)) {
            return response()->json(['message' => 'Debe completar los campos de mano de obra, días de garantía y valor total antes de marcar como realizado.'], 400);
        }
    }

    $obramayor->estado = $request->estado;
    $obramayor->save();

    return response()->json(['message' => 'Estado actualizado correctamente.']);
}

return response()->json(['message' => 'Servicio no encontrado.'], 404);
}
public function cambiarEstado4($id, Request $request)
{
$obramenor = ObrasMenores::find($id);  // Buscar la obra mayor por ID

if ($obramenor) {
    if ($request->estado === 'Realizado') {
        if (is_null($obramenor->mano_obra_valor) || is_null($obramenor->garantia) || is_null($obramenor->valor_total)) {
            return response()->json(['message' => 'Debe completar los campos de mano de obra, días de garantía y valor total antes de marcar como realizado.'], 400);
        }
    }

    $obramenor->estado = $request->estado;
    $obramenor->save();

    return response()->json(['message' => 'Estado actualizado correctamente.']);
}

return response()->json(['message' => 'Servicio no encontrado.'], 404);
}

public function cambiarEstado2($id, Request $request)
{
  $gasfiteria = Gasfiteria::find($id);  // Buscar la obra mayor por ID

  if ($gasfiteria) {
    if ($request->estado === 'Realizado') {
        if (is_null($gasfiteria->mano_obra_valor) || is_null($gasfiteria->garantia) || is_null($gasfiteria->valor_total)) {
            return response()->json(['message' => 'Debe completar los campos de mano de obra, días de garantía y valor total antes de marcar como realizado.'], 400);
        }
    }

    $gasfiteria->estado = $request->estado;
    $gasfiteria->save();

    return response()->json(['message' => 'Estado actualizado correctamente.']);
}

return response()->json(['message' => 'Servicio no encontrado.'], 404);
}



// public function cambiarEstado($id, Request $request)
// {
// $servtec = ServtecLineaBlanca::find($id);  // Buscar la obra mayor por ID

// if ($servtec) {
//     // Actualizar el estado con los valores de texto
//     $servtec->estado = $request->estado;  // Usar el estado pasado por la solicitud
   
//     $servtec->save();  // Guardar el cambio

//   // Guardar el cambio

//     // Responder con un mensaje de éxito
//     return response()->json(['message' => 'Estado actualizado correctamente.']);
// }

// // Si no se encuentra la obra mayor, devolver un error 404
// return response()->json(['message' => 'Servicio no encontrado.'], 404);
// }


// public function cambiarEstado($id, Request $request)
// {
//     $servtec = ServtecLineaBlanca::find($id);

//     if ($servtec) {
//         if ($request->estado === 'Realizado') {
//             if (is_null($servtec->mano_obra_valor) || is_null($servtec->garantia) || is_null($servtec->valor_total)) {
//                 return response()->json(['message' => 'Debe completar los campos de mano de obra, días de garantía y valor total antes de marcar como realizado.'], 400);
//             }
//         }

//         $servtec->estado = $request->estado;
//         $servtec->save();

//         return response()->json(['message' => 'Estado actualizado correctamente.']);
//     }

//     return response()->json(['message' => 'Servicio no encontrado.'], 404);
// }


public function cambiarEstado($id, Request $request)
{
    $servtec = ServtecLineaBlanca::find($id);

    if (!$servtec) {
        return response()->json([
            'status' => 'error',
            'message' => 'Servicio no encontrado.'
        ], 404);
    }

    if ($request->estado === 'Realizado') {
        if (is_null($servtec->mano_obra_valor) || is_null($servtec->garantia) || is_null($servtec->valor_total)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Debe completar los campos de mano de obra, días de garantía y valor total antes de marcar como realizado.'
            ], 400);
        }
    }

    $servtec->estado = $request->estado;
    $servtec->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Estado actualizado correctamente.'
    ]);
}






// public function cambiarEstado($id, Request $request)
// {
//     $obramayor = ObrasMayores::find($id);

//     if ($obramayor) {
//         // Actualizar el estado para ObrasMayores
//         $obramayor->estado = $request->estado;
//         $obramayor->save();

//         // Intentar actualizar otras entidades si existen registros para el mismo ID
//         $obramenor = ObrasMenores::find($id);
//         if ($obramenor) {
//             $obramenor->estado = $request->estado;
//             $obramenor->save();
//         }

//         $gasfiterias = Gasfiteria::find($id);
//         if ($gasfiterias) {
//             $gasfiterias->estado = $request->estado;
//             $gasfiterias->save();
//         }

//         $servtec = ServtecLineaBlanca::find($id);
//         if ($servtec) {
//             $servtec->estado = $request->estado;
//             $servtec->save();
//         }

//         // Responder con un mensaje de éxito
//         return response()->json(['message' => 'Estado actualizado correctamente.']);
//     }

//     // Si no se encuentra la obra mayor, devolver un error 404
//     return response()->json(['message' => 'Servicio no encontrado.'], 404);
// }


    ///////////////////////////////OBRERO////////////////////////////////////
    public function obreroindex()
    {        
        $servtecs = ServtecLineaBlanca::with('propiedad')->get();
        $gasfiterias = Gasfiteria::with('propiedad')->get();
        $obrasmayores = ObrasMayores::with('propiedad')->get();
        $obrasmenores = ObrasMenores::with('propiedad')->get();
        $imgServtec = ImgServtec::all();
        $imgGas = ImgGasfiteria::with('propiedad')->get();
        $imgOMa = ImgOMayores::with('propiedad')->get();
        $imgOMe = ImgOMenores::with('propiedad')->get();
        $propiedades = Propiedad::all();
        $trabajadores = User::all();

        return view('/obrero/servicios', compact('servtecs','gasfiterias','obrasmayores','obrasmenores','propiedades','trabajadores'));
    }

   
    
}
