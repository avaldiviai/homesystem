<?php

namespace App\Http\Controllers;

use App\Models\DetallesVerano;
use App\Models\ImgVerano;
use App\Models\VideoVerano;
use Illuminate\Http\Request;
use App\Models\Propietario;
use App\Models\PropietarioVerano;
use App\Models\Verano;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VeranoController extends Controller
{
    
      
        public function index_verano(){
            $propiedadesVerano = Verano::with(['detallesVeranos.imagenes','propietarioverano'])->where('estado', 1)->get();
            $propietarios = Propietario::all();
            // Agregar una propiedad para verificar si debe mostrarse el botón
            foreach ($propiedadesVerano as $propiedad) {
                // Verificar si debe mostrarse el botón
                $propiedad->mostrarBoton = $propiedad->detallesVeranos->isEmpty() || 
                    $propiedad->detallesVeranos->where('status', 1)->isNotEmpty();
            }
            
            $propiedad = $propiedadesVerano->first();
            

            return view("verano", compact('propietarios', 'propiedadesVerano', 'propiedad'));
        }
        public function Guardarverano(Request $request)
        {
            // Guardar los datos en la base de datos
            $propiedad = new Verano();
            // $propiedad->id_propietario = $request->id_propietario;
            $propiedad->direccion = $request->direccion;
            $propiedad->ciudad = $request->ciudad;

            $propiedad->sector =  $request->sector;
            $propiedad->condominio =  $request->condominio;
            $propiedad->torre =  $request->torre;
            $propiedad-> num_apartamento =  $request-> num_apartamento; 
            $propiedad->piso = $request->piso;
            $propiedad->ubicacion = $request->ubicacion;
            $propiedad-> dormitorios =  $request-> dormitorios;
            $propiedad-> Tpiso_dormitorios =  $request-> Tpiso_dormitorios;
            $propiedad-> baños =  $request-> baños;
            $propiedad-> tipo_cocina=  $request-> tipo_cocina;
            // $propiedad->servicios =  $request->servicios; // Guardar como JSON
            $propiedad->personas =  $request->personas;
            $propiedad->precio_min_enero = $request->precio_min_enero;
            $propiedad->precio_max_enero = $request->precio_max_enero;
            $propiedad->precio_min_febrero =  $request->precio_min_febrero;
            $propiedad->precio_max_febrero =  $request->precio_max_febrero;
            // $propiedad->marzo_diciembre = $request->marzo_diciembre;
            // $propiedad->marzo_diciembre_precio = $request->marzo_diciembre_precio;
            $propiedad->equipado =  $request->equipado;
            $propiedad->valor_adicional = $request->valor_adicional;
            $propiedad->estado = 1;
            // $propiedad->id_detalle_verano = 1;
            // dd($propiedad);
            
            // Guardar la propiedad en la base de datos
            $propiedad->save();

            $new_detalles_vera = new DetallesVerano();
            $new_detalles_vera->id_verano = $propiedad->id;
            $new_detalles_vera->status = 1;
            $new_detalles_vera->save();


              // Decodificar la cadena JSON a un array asociativo
        $PropietariosAgregados = json_decode($request->PropietariosAgregados, true);
        // dd($request->all());

        // Verificar si hay iconos agregados en la solicitud y procesarlos
        if (!empty($PropietariosAgregados)) {
            foreach ($PropietariosAgregados as $propietario) {
                // Crear una nueva instancia de CategoriaVenta para cada icono agregado
                $newPropietarioPropiedad = new PropietarioVerano;
                $newPropietarioPropiedad->id_verano = $propiedad->id;
                $newPropietarioPropiedad->id_propietario = $propietario['id']; // Acceder a 'id' del propietario
            
                $newPropietarioPropiedad->save();
            }
        }
    
            return response()->json(['message' => $propiedad]);
        }

    
        

        public function guardarDetalles(Request $request, $id)
        {
            // dd($id);
            $id = $request->id;
            // Validar los datos recibidos
            $request->validate([
                // 'estacionamientos' => 'required|string',
                // 'num_estaciona' => 'nullable|integer',
                // 'wifi' => 'nullable',
                // 'cable' => 'nullable',
                // 'lavadora' => 'nullable',
                // 'sabanas' => 'nullable',
                // 'servicios' => 'array|nullable',
                // 'servicios.*' => 'in:cable,wifi,lavadora,sabanas',
                'piscina' => 'required|string',
                // 'Consergeria' => 'required|string',
                'ascensor' => 'required|string',
                // 'gym' => 'required|string',
                'juegos_infantiles' => 'required|string',
                'servi_lavanderia' => 'required|string',
                'quinchos' => 'required|string',
                'sala_multiuso' => 'required|string',
                'terraza' => 'required|string',
                // 'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de imágenes
                // 'videos.*' => 'mimes:mp4,mov,avi,wmv|max:20480', // Validación de videos

            ]);


            
        
            // Encontrar la propiedad por ID
            $new_detalles_vera =  DetallesVerano::where('id_verano',$id)->first();
            $servicios = json_decode($request->input('servicios'), true);
            // Asignar valores a la nueva instancia
            $new_detalles_vera->wifi = $request->input('wifi', 0); // Por defecto 0 si no se envía
            $new_detalles_vera->cable = $request->input('cable', 0);
            $new_detalles_vera->lavadora = $request->input('lavadora', 0);
            $new_detalles_vera->sabanas = $request->input('sabanas', 0);
            $new_detalles_vera->piscina = $request->piscina;
            $new_detalles_vera->estacionamientos = $request->estacionamientos;
            $new_detalles_vera->num_estaciona = $request->num_estaciona;
            $new_detalles_vera->Consergeria = $request->Consergeria;
            $new_detalles_vera->ascensor = $request->ascensor;
            // $new_detalles_vera->Gimnasio = $request->gym;
            $new_detalles_vera->juegos_infantiles = $request->juegos_infantiles;
            $new_detalles_vera->servi_lavanderia = $request->servi_lavanderia;
            $new_detalles_vera->quinchos = $request->quinchos;
            $new_detalles_vera->sala_multiuso = $request->sala_multiuso;
            $new_detalles_vera->terraza = $request->terraza;
            $new_detalles_vera->status = 0;
            $new_detalles_vera->id_verano = $id; // Asumiendo que el ID de la propiedad se pasa como parámetro
        
            // Guardar los cambios en la base de datos
            $new_detalles_vera->save();
        
            // Manejar imágenes
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $image) {
                    // Almacenar la imagen
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $imagenPath = $image->storeAs('images', $imageName, 'public');
        
                    // Guardar la información de la imagen en la base de datos
                    $imagen = new ImgVerano();
                    $imagen->nombre = $imageName; // Guarda el nombre de la imagen
                    $imagen->link = '/storage/public/' . $imagenPath; // Guarda la ruta de la imagen
                    $imagen->id_detalles_verano = $new_detalles_vera->id; // Asignar el ID de detalles
                    $imagen->save(); // Guardar el modelo
                }
            }
        

            // Responder con éxito
            return response()->json([
                'status' => 'success',
                'message' => 'Datos guardados correctamente',
                'data' => $new_detalles_vera
            ]);
        } 
     
       
      /////////////////// PROPIEDAD DETALLES ///////////////////////////////////////
   

    // public function propiedadesVeraDetalles($id)
    // {
    //     $propiedadVe = Verano::with('detallesVeranos.imagenes')->where('id', $id)->first();
    
    //     if (!$propiedadVe) {
    //         return redirect()->back()->with('error', 'Propiedad no encontrada.');
    //     }
    
    //     $detalle = $propiedadVe->detallesVeranos->where('id')->first();
    
    //     if (!$detalle) {
    //         return redirect()->back()->with('error', 'Detalle no encontrado.');
    //     }
    
    //     $imagenes = $detalle->imagenes;
    
    //     return view("/propiedadesVeranoDetalles", compact('propiedadVe', 'detalle', 'imagenes'));
    // }

    public function propiedadesVeraDetalles($id)
    {
        // Obtén la propiedad junto con los detalles e imágenes asociadas
        $propiedadVe = Verano::with(['detallesVeranos.imagenes', 'detallesVeranos.videos'])->find($id);
        $propietarios = PropietarioVerano::where('id_verano',$id)->get();
        $new_Propietarios = Propietario::whereNotIn('id', function ($query) use ($id) {
            $query->select('id_propietario')
                  ->from('propietario_verano')
                  ->where('id_verano', $id); // Filtrar según la ID específica
        })->get();
        // Verifica si la propiedad existe, de lo contrario, redirige o muestra un error
        if (!$propiedadVe) {
            return redirect()->back()->with('error', 'Detalle no encontrado.');
        }
        // Si existen detalles asociados a la propiedad, obtenemos el primer detalle, si no, se asigna null
        $detalle = $propiedadVe->detallesVeranos->first() ?: null;
        // Si hay detalles, se cargan las imágenes, de lo contrario, asignamos null a las imágenes
        $imagenes = $detalle ? $detalle->imagenes : null;
    
        $videos = $detalle ? $detalle->videos : null;
        
        $proverano = Verano::where('estado',1)->get();

    
        return view('propiedadesVeranoDetalles', compact('propiedadVe','new_Propietarios','propietarios', 'imagenes', 'detalle','videos','proverano'));
    }
    

    public function PropietariosAgregadosVe(Request $request) {
        $propietarioId = $request->input('nombre_pro');
        
        // Buscar el nombre del icono en la base de datos
        $propietario = Propietario::find($propietarioId);
    
        if ($propietario) {
            // Si se encuentra el icono, devolver su nombre en formato JSON
            return response()->json(['nombre' => $propietario->nombre]);
        } else {
            // Si no se encuentra el icono, devolver un mensaje de error
            return response()->json(['error' => 'propietario no encontrado'], 404);
        }
    }

    public function PropietarioVeraDelete($idPropietario){
        $propietarioVeraDelete = PropietarioVerano::findOrFail($idPropietario);
        $propietarioVeraDelete->delete();
    
    }
    public function cambiarImg($id){
        // Encuentra la imagen seleccionada
        $imagenSeleccionada = ImgVerano::find($id);
    
        if (!$imagenSeleccionada) {
            return response()->json(['error' => 'Imagen no encontrada'], 404);
        }
    
        // Encuentra la primera imagen (según el menor id) para el mismo id_venta
        $imagenPortadaNueva = ImgVerano::where('id_detalles_verano', $imagenSeleccionada->id_detalles_verano)
            ->orderBy('id', 'asc')
            ->first();

        if ($imagenPortadaNueva && $imagenPortadaNueva->id != $imagenSeleccionada->id) {
            // Guardar la ruta actual de la imagen seleccionada
            $rutaSeleccionada = $imagenSeleccionada->link;
    
            // Cambiar la ruta de la imagen seleccionada por la de la primera imagen ingresada
            $imagenSeleccionada->link = $imagenPortadaNueva->link;
            $imagenSeleccionada->save();
    
            // Cambiar la ruta de la primera imagen ingresada por la de la imagen seleccionada original
            $imagenPortadaNueva->link = $rutaSeleccionada;
            $imagenPortadaNueva->save();
        }
    
        return response()->json(['success' => 'Imagen portada actualizada']);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////7
    public function update(Request $request)
    {
        
        try {
            DB::beginTransaction();
            $id = $request->Id;

            $propiedadVe = Verano::where('id', $id)->first();

            $propiedadVe->direccion = $request->direccion;
            $propiedadVe->ciudad = $request->ciudad;
            $propiedadVe->sector = $request->sector;
            $propiedadVe->condominio = $request->condominio;
            $propiedadVe->torre = $request->torre;
            $propiedadVe->num_apartamento = $request->num_apartamento;
            $propiedadVe->piso = $request->piso;
            $propiedadVe->personas = $request->personas;
            $propiedadVe->ubicacion = $request->ubicacion;
            $propiedadVe->dormitorios = $request->dormitorios;
            $propiedadVe->Tpiso_dormitorios = $request->Tpiso_dormitorios;
            $propiedadVe->baños = $request->baños;
            $propiedadVe->tipo_cocina = $request->tipo_cocina;
            $propiedadVe->precio_min_enero = $request->precio_min_enero;
            $propiedadVe->precio_max_enero = $request->precio_max_enero;
            $propiedadVe->precio_min_febrero = $request->precio_min_febrero;
            $propiedadVe->precio_max_febrero = $request->precio_max_febrero;
            $propiedadVe->equipado = $request->equipado;
            $propiedadVe->mascotas = $request->mascotas;
            $propiedadVe->valor_adicional = $request->valor_adicional;
            
            $propiedadVe->save();
            // dd($request->all());

            // Actualizar Detalle
            $servicios = json_decode($request->input('servicios'), true);

            $detalle = DetallesVerano::where('id_verano', $id)->first();

            $detalle->num_estaciona = $request->num_estaciona;
            $detalle->wifi = $request->input('wifi', 0);
            $detalle->cable = $request->input('cable', 0);
            $detalle->lavadora = $request->input('lavadora', 0);
            $detalle->sabanas = $request->input('sabanas', 0);

            $detalle->piscina = $request->piscina;
            $detalle->Consergeria = $request->Consergeria;
            $detalle->ascensor = $request->ascensor;
            $detalle->gimnasion = $request->gimnasio;
            $detalle->juegos_infantiles = $request->juegos_infantiles;
            $detalle->servi_lavanderia = $request->servi_lavanderia;
            $detalle->quinchos = $request->quinchos;
            $detalle->sala_multiuso = $request->sala_multiuso;
            $detalle->terraza = $request->terraza;

            $detalle->save();
            // dd($detalle);

            // Decodificar la cadena JSON a un array asociativo
            $PropietariosAgregados = json_decode($request->PropietariosAgregados, true);
            // dd($request->all());

            // Verificar si hay propietario agregados en la solicitud y procesarlos
            if (!empty($PropietariosAgregados)) {
                foreach ($PropietariosAgregados as $propietario) {
                    // Crear una nueva instancia de CategoriaVenta para cada propietario agregado
                    $new_Propietario = new PropietarioVerano();
                    // Asignar los valores del propietario desde la solicitud
                    $new_Propietario->id_verano = $propiedadVe->id;
                    $new_Propietario->id_propietario = $propietario['id']; // Acceder a 'id' del propietario
                    // Guardar el propietario
                    $new_Propietario->save();
                }
            }
            // Manejar las imágenes
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $image) {
                    // Almacenar la imagen
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $imagenPath = $image->storeAs('images', $imageName, 'public');
        
                    // Guardar la información de la imagen en la base de datos
                    $imagen = new ImgVerano();
                    $imagen->nombre = $imageName; // Guarda el nombre de la imagen
                    $imagen->link = '/storage/public/' . $imagenPath; // Guarda la ruta de la imagen
                    $imagen->id_detalles_verano = $detalle->id; // Asignar el ID de detalles
                    $imagen->save(); // Guardar el modelo
                }
            }
            // Buscar si ya existe un registro para esa propiedad
            $archivo = DetallesVerano::where('id_verano', $id)->first();


            // Si existe, no es necesario volver a asignar id_propiedad, pero puedes hacerlo si quieres
            $archivo->id_verano = $id;

            if ($request->hasFile('inventario')) {
                $inventarioFile = $request->file('inventario');
                $inventarioName = time() . '_' . $inventarioFile->getClientOriginalName();
                $inventarioPath = $inventarioFile->storeAs('inventario', $inventarioName, 'public');
                $archivo->inventario = '/storage/public/' . $inventarioPath;
            }

            if ($request->hasFile('acta')) {
                $actaFile = $request->file('acta');
                $actaName = time() . '_' . $actaFile->getClientOriginalName();
                $actaPath = $actaFile->storeAs('acta', $actaName, 'public');
                $archivo->acta_entrega = '/storage/public/' . $actaPath;
            }
            if ($request->hasFile('videos')) {
                $actaFile = $request->file('videos');
                $actaName = time() . '_' . $actaFile->getClientOriginalName();
                $actaPath = $actaFile->storeAs('videos', $actaName, 'public');
                $archivo->video = '/storage/public/' . $actaPath;
            }

            $archivo->save();


            DB::commit();

            return response()->json(['message' => 'Propiedad actualizada con éxito'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al actualizar la propiedad', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function destroy($id)
{
    $imagen = ImgVerano ::findOrFail($id);

    // Opcional: elimina el archivo físico si está almacenado localmente
    if (file_exists(public_path($imagen->link))) {
        unlink(public_path($imagen->link));
    }

    // Elimina el registro de la base de datos
    $imagen->delete();

    return redirect()->back()->with('success', 'Imagen eliminada correctamente.');
}


public function deletePropiedadVera(Request $request, $id)
    {
        $propietario = Verano::where('id', $id)->firstOrFail();
        $propietario->estado = 0; // Cambia el estado a 0
        $propietario->save();
        return response()->json(['success' => 'El estado del propietario se ha Borrado con éxito']);
    }



/////////////OBRERO//////////////////////////////////////////
public function index_verano_obrero(){
    $propiedadesVerano = Verano::with(['detallesVeranos.imagenes'])->where('estado', 1)->get();
    $propietarios = Propietario::all();

    // Agregar una propiedad para verificar si debe mostrarse el botón
    foreach ($propiedadesVerano as $propiedad) {
        $propiedad->mostrarBoton = $propiedad->detallesVeranos->isEmpty();
    }

    $propiedad = $propiedadesVerano->first();
    return view("/obrero.verano", compact('propietarios', 'propiedadesVerano', 'propiedad'));
}
        
}

        
    

