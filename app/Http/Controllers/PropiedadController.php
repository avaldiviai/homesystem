<?php

namespace App\Http\Controllers;

use App\Models\ArchivoPropiedad;
use App\Models\Comision;
use Illuminate\Http\Request;
use App\Models\Propiedad;
use App\Models\Propietario;
use App\Models\Propietario_propiedades;
use App\Models\Precios;
use App\Models\ImgPropiedad;
use App\Models\Arriendo;
use App\Models\Mantenimiento;
use App\Models\VidArriendo;
use App\Models\SubDetalles;
use App\Models\DetallePropiedad;
use App\Models\EstadoPagos;
use App\Models\Arrendatario;
use App\Mail\MantencionEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;



class PropiedadController extends Controller
{
    //////////////////////////////// ADMINISTRADOR ///////////////////////////
    public function index()
    {
        //  $propiedades = Propiedad::all(); 
        $propietarios = Propietario::all();
        // $propiedades = Propiedad::with('imagenes')->where('estado', 1)->where('tipo_propiedad',1)->get();
        $propiedades = Propiedad::with(['imagenes', 'detallePropiedad','subdetalles','propietario'])
        ->where('estado', 1)
        ->where('tipo_propiedad', 1)
        ->get()
        ->map(function ($propiedad) {
            $propiedad->mostrar_boton = $propiedad->detallePropiedad && $propiedad->detallePropiedad->ano_construccion === null;
            return $propiedad;
        });
        // $propiedades = ImgPropiedad::with('imagen_url')->get();
        // $propiedades = Propiedad::with('imagen_url')->get();
        $propiedad = $propiedades->first(); // Obtiene la primera propiedad
        $propietario = Propietario_propiedades::all();

        // $mostrarBoton = $detalles && $detalles->ano_construccion === null;


        return view('propiedades', compact('propiedades', 'propietarios', 'propiedad','propietario'));
    }


    public function add(Request $request)         
    {
         // Validar los datos del formulario
    // $request->validate([
    //     'direccion' => 'required|string|max:255',
    //     'ruta' => 'nullable|string',
    //     'condominio' => 'required|string',
    //     'torre' => 'required|string',
    //     'num_torre' => 'required|integer',
        // 'estacionamientos' => 'required|integer',
        // 'bodega' => 'required|string',
        // 'tipo' => 'required|string|max:50',
        // 'rol' => 'required|string|max:50',
    //     // 'estado_propiedad' => 'required|string|max:50',
        // 'numeroluz' => 'nullable|string|max:50',
        // 'numeroagua' => 'nullable|string|max:50',
        // 'numerogas' => 'nullable|string|max:50',
        // 'empresaluz' => 'nullable|string|max:50',
        // 'empresaagua' => 'nullable|string|max:50',
        // 'empresagas' => 'nullable|string|max:50',
    //     'propietario' => 'required|integer',
    // ]);
        // Validar los datos del formulario
        $request->validate([
            'direccion' => 'required|string|max:255',
            // 'ruta' => 'nullable|string',
            'condominio' => 'required|string',
            // 'torre' => 'required|string',
            'num_torre' => 'required|integer',
            // 'estacionamientos' => 'required|integer',
            // 'bodega' => 'required|string',
            // 'tipo' => 'required|string|max:50',
            // 'rol' => 'required|string|max:50',
            // 'estado_propiedad' => 'required|string|max:50',
            // 'numeroluz' => 'nullable|string|max:50',
            // 'numeroagua' => 'nullable|string|max:50',
            // 'numerogas' => 'nullable|string|max:50',
            // 'empresaluz' => 'nullable|string|max:50',
            // 'empresaagua' => 'nullable|string|max:50',
            // 'empresagas' => 'nullable|string|max:50',
            // 'videos.*' => 'mimes:mp4,avi,mkv|max:10240', // Validar que los videos sean de tipo mp4, avi, mkv y no superen los 10MB

            // 'propietario' => 'required|integer',

        ]);
        // dd($request->all());
        $new_propiedad = new Propiedad;
        $new_propiedad->direccion = $request->direccion;
        $new_propiedad->maps = $request->ruta;
        $new_propiedad->ciudad = $request->ciudad;
        $new_propiedad->condominio = $request->condominio;
        $new_propiedad->tipo_vivienda = $request->tipo;
        $new_propiedad->rol = $request->rol;
        $new_propiedad->descripcion = $request->descripcion;
        // $new_propiedad->estado_propiedad = $request->estado_propiedad;
        $new_propiedad->numero_luz = $request->numeroluz;
        $new_propiedad->numero_agua = $request->numeroagua;
        $new_propiedad->numero_gas = $request->numerogas;
        $new_propiedad->empresa_luz = $request->empresaluz;
        $new_propiedad->empresa_agua = $request->empresaagua;
        $new_propiedad->empresa_gas = $request->empresagas;

        // $new_propiedad->id_propietario  = $request->propietario;
        $new_propiedad->torre  = $request->torre;
        $new_propiedad->num_torre  = $request->num_torre;
        // $new_propiedad->num_estacionamiento  = $request->estacionamientos;
        // $new_propiedad->bodega  = $request->bodega;
        $new_propiedad->tipo_propiedad  = 1;
        $new_propiedad->estado  = 1;
        $new_propiedad->estado_venta  = 1;


        $new_propiedad->save();

        $new_precios = new Precios;
        $new_precios->tipo_moneda = $request->tipo_moneda;
        $new_precios->diciembre = $request->diciembre;
        $new_precios->ano_corrido = $request->ano_corrido;
        $new_precios->id_propiedad = $new_propiedad->id;
        $new_precios->tipo_propiedad = 1;
        $new_precios->estado = 1;

        $new_precios->save();


        $new_sub_detalles = new SubDetalles;
        $new_sub_detalles->monto = $request->monto;
        $new_sub_detalles->rol = $request->rol_est;
        $new_sub_detalles->estacionamiento = $request->estacionamiento;
        $new_sub_detalles->id_propiedad = $new_propiedad->id;
        $new_sub_detalles->techado = $request->techado;
        $new_sub_detalles->tipo_detalle = 1;
        $new_sub_detalles->tipo_propiedad = 1;

        $new_sub_detalles->save();
        
        $new_sub_detalles_dos = new SubDetalles;
        $new_sub_detalles_dos->monto = $request->monto_b;
        $new_sub_detalles_dos->rol = $request->rol_b;
        $new_sub_detalles_dos->bodega = $request->bodega;
        $new_sub_detalles_dos->id_propiedad = $new_propiedad->id;
        $new_sub_detalles_dos->tipo_detalle = 2;
        $new_sub_detalles_dos->tipo_propiedad = 1;

        $new_sub_detalles_dos->save();

        // $new_propiedad->id_precios  = 1;

        // Guardar el detalle de venta
        $new_detalles_pro = new DetallePropiedad;
        $new_detalles_pro->id_propiedad = $new_propiedad->id;
        $new_detalles_pro->tipo_propiedad = 1;
        $new_detalles_pro->save();

        // $new_propiedad->id_detalle_propiedad = $new_detalles_pro->id;

        $new_propiedad->save();


        // $new_propiedad->id_precios = $new_precio->id;




        if ($request->file('imagenes') != null) {
            // Guardar las imágenes en la carpeta pública y la información en la base de datos
            foreach ($request->file('imagenes') as $imagenFile) {
                // Guardar la imagen en la carpeta pública
                $imageName = time() . '_' . $imagenFile->getClientOriginalName();
                $imagenPath = $imagenFile->storeAs('images', $imageName, 'public');

                // Guardar la información de la imagen en la base de datos
                $imagen = new ImgPropiedad;
                $imagen->nombre = $request->rol;
                $imagen->link = '/storage/public/' . $imagenPath; // Guardamos solo la ruta de la imagen
                $imagen->id_propiedad = $new_propiedad->id; // Asignar el ID del detalle de venta
                $imagen->save();
            }
        }
        if ($request->hasFile('videos')) {
            // Obtener el archivo de video del formulario
            $videoFile = $request->file('videos');

            // Guardar el video en la carpeta pública
            $videoName = time() . '_' . $videoFile->getClientOriginalName();
            $videoPath = $videoFile->storeAs('videos', $videoName, 'public');

            // Guardar la información del video en la base de datos
            $video = new VidArriendo;
            $video->video = '/storage/public/' . $videoPath; // Guardamos solo la ruta del video
            $video->id_propiedad = $new_propiedad->id;
            $video->estado = 1; // Asignar el ID del detalle de venta
            $video->save();
        }

        // // Guardar los archivos adicionales si están presentes
        if ($request->hasFile('Archivo')) {
            foreach ($request->file('Archivo') as $docFile) {
                if ($docFile->isValid()) {
                    $docName = time() . '_' . $docFile->getClientOriginalName();
                    $ruta = $docFile->storeAs('archivospro', $docName, 'public');

                    // Crear y guardar el registro de contrato
                    $nuevoContrato = new ArchivoPropiedad();
                    $nuevoContrato->archivo = '/storage/public/' . $ruta;
                    $nuevoContrato->id_propiedad = $new_propiedad->id; // Cambiado a id_propiedad
                    $nuevoContrato->save();
                } else {
                    Log::error('El archivo no es válido: ' . $docFile->getClientOriginalName());
                }
            }
        } else {
            Log::warning('No se recibió ningún archivo en la solicitud.');
        }

        // Decodificar la cadena JSON a un array asociativo
        $PropietariosAgregados = json_decode($request->PropietariosAgregados, true);
        // dd($request->all());

        // Verificar si hay iconos agregados en la solicitud y procesarlos
        if (!empty($PropietariosAgregados)) {
            foreach ($PropietariosAgregados as $propietario) {
                // Crear una nueva instancia de CategoriaVenta para cada icono agregado
                $new_Propietario = new Propietario_propiedades;
                // Asignar los valores del icono desde la solicitud
                // $new_icono->cantidad = $icono['cantidad']; // Acceder a 'cantidad' del icono
                $new_Propietario->id_propiedad = $new_propiedad->id;
                $new_Propietario->id_propietario = $propietario['id']; // Acceder a 'id' del propietario
                // Guardar el icono
                $new_Propietario->save();
            }
        }


        return Response()->json(['nueva_propiedad' => $new_propiedad]);
    }
    public function addproanocorrido(Request $request)         
    {
        // Validar los datos del formulario
        $request->validate([
            'direccion' => 'required|string|max:255',
            // 'ruta' => 'nullable|string',
            'condominio' => 'required|string',
            // 'torre' => 'required|string',
            'num_torre' => 'required|integer',
            // 'estacionamientos' => 'required|integer',
            // 'bodega' => 'required|string',
            // 'tipo' => 'required|string|max:50',
            // 'rol' => 'required|string|max:50',
            // 'estado_propiedad' => 'required|string|max:50',
            // 'numeroluz' => 'nullable|string|max:50',
            // 'numeroagua' => 'nullable|string|max:50',
            // 'numerogas' => 'nullable|string|max:50',
            // 'empresaluz' => 'nullable|string|max:50',
            // 'empresaagua' => 'nullable|string|max:50',
            // 'empresagas' => 'nullable|string|max:50',
            // 'videos.*' => 'mimes:mp4,avi,mkv|max:10240', // Validar que los videos sean de tipo mp4, avi, mkv y no superen los 10MB

            // 'propietario' => 'required|integer',

        ]);
        // dd($request->all());
        $new_propiedad = new Propiedad;
        $new_propiedad->direccion = $request->direccion;
        $new_propiedad->ciudad = $request->ciudad;
        $new_propiedad->maps = $request->ruta;
        $new_propiedad->condominio = $request->condominio;
        $new_propiedad->condominio = $request->condominio;
        $new_propiedad->tipo_vivienda = $request->tipo;
        $new_propiedad->rol = $request->rol;
        $new_propiedad->descripcion = $request->descripcionpro;
        $new_propiedad->numero_luz = $request->numeroluz;
        $new_propiedad->numero_agua = $request->numeroagua;
        $new_propiedad->numero_gas = $request->numerogas;
        $new_propiedad->empresa_luz = $request->empresaluz;
        $new_propiedad->empresa_agua = $request->empresaagua;
        $new_propiedad->empresa_gas = $request->empresagas;

        // $new_propiedad->mantenimiento = $request->mantenimiento;
        // $new_propiedad->reajuste_anual = $request->reajuste;

        // $new_propiedad->id_propietario  = $request->propietario;
        $new_propiedad->torre  = $request->torre;
        $new_propiedad->num_torre  = $request->num_torre;
        // $new_propiedad->num_estacionamiento  = $request->estacionamientos;
        // $new_propiedad->bodega  = $request->bodega;
        $new_propiedad->tipo_propiedad  = 3;
        $new_propiedad->estado  = 1;
        $new_propiedad->estado_venta  = 1;


        $new_propiedad->save();


        $new_precios = new Precios;
        $new_precios->diciembre = $request->diciembre;
        // $new_precios->tipo_moneda = $request->tipo_moneda;
        $new_precios->ano_corrido = $request->ano_corrido;
        $new_precios->id_propiedad = $new_propiedad->id;
        $new_precios->tipo_propiedad = 3;
        $new_precios->estado = 1;



        $new_precios->save();
        $new_sub_detalles = new SubDetalles;
        $new_sub_detalles->monto = $request->monto;
        $new_sub_detalles->rol = $request->rol_est;
        $new_sub_detalles->estacionamiento = $request->estacionamiento;
        $new_sub_detalles->techado = $request->techado;
        $new_sub_detalles->id_propiedad = $new_propiedad->id;
        $new_sub_detalles->tipo_detalle = 1;
        $new_sub_detalles->tipo_propiedad = 1;

        $new_sub_detalles->save();
        
        $new_sub_detalles_dos = new SubDetalles;
        $new_sub_detalles_dos->monto = $request->monto_b;
        $new_sub_detalles_dos->rol = $request->rol_b;
        $new_sub_detalles_dos->bodega = $request->bodega;
        $new_sub_detalles_dos->id_propiedad = $new_propiedad->id;
        $new_sub_detalles_dos->tipo_detalle = 2;
        $new_sub_detalles_dos->tipo_propiedad = 1;

        $new_sub_detalles_dos->save();





        // $new_propiedad->id_precios  = 1;

        // Guardar el detalle de venta
        $new_detalles_pro = new DetallePropiedad;
        $new_detalles_pro->id_propiedad = $new_propiedad->id;
        $new_detalles_pro->tipo_propiedad = 3;
        $new_detalles_pro->save();

        // $new_propiedad->id_detalle_propiedad = $new_detalles_pro->id;

        $new_propiedad->save();


        // $new_propiedad->id_precios = $new_precio->id;




        if ($request->file('imagenes') != null) {
            // Guardar las imágenes en la carpeta pública y la información en la base de datos
            foreach ($request->file('imagenes') as $imagenFile) {
                // Guardar la imagen en la carpeta pública
                $imageName = time() . '_' . $imagenFile->getClientOriginalName();
                $imagenPath = $imagenFile->storeAs('images', $imageName, 'public');

                // Guardar la información de la imagen en la base de datos
                $imagen = new ImgPropiedad;
                $imagen->nombre = $request->rol;
                $imagen->link = '/storage/public/' . $imagenPath; // Guardamos solo la ruta de la imagen
                $imagen->id_propiedad = $new_propiedad->id; // Asignar el ID del detalle de venta
                $imagen->save();
            }
        }
        if ($request->hasFile('videos')) {
            // Obtener el archivo de video del formulario
            $videoFile = $request->file('videos');

            // Guardar el video en la carpeta pública
            $videoName = time() . '_' . $videoFile->getClientOriginalName();
            $videoPath = $videoFile->storeAs('videos', $videoName, 'public');

            // Guardar la información del video en la base de datos
            $video = new VidArriendo;
            $video->video = '/storage/public/' . $videoPath; // Guardamos solo la ruta del video
            $video->id_propiedad = $new_propiedad->id;
            $video->estado = 1; // Asignar el ID del detalle de venta
            $video->save();
        }

        // // Guardar los archivos adicionales si están presentes
        if ($request->hasFile('Archivo')) {
            foreach ($request->file('Archivo') as $docFile) {
                if ($docFile->isValid()) {
                    $docName = time() . '_' . $docFile->getClientOriginalName();
                    $ruta = $docFile->storeAs('archivospro', $docName, 'public');

                    // Crear y guardar el registro de contrato
                    $nuevoContrato = new ArchivoPropiedad();
                    $nuevoContrato->archivo = '/storage/public/' . $ruta;
                    $nuevoContrato->id_propiedad = $new_propiedad->id; // Cambiado a id_propiedad
                    $nuevoContrato->save();
                } else {
                    Log::error('El archivo no es válido: ' . $docFile->getClientOriginalName());
                }
            }
        } else {
            Log::warning('No se recibió ningún archivo en la solicitud.');
        }

        // Decodificar la cadena JSON a un array asociativo
        $PropietariosAgregados = json_decode($request->PropietariosAgregados, true);
        // dd($request->all());

        // Verificar si hay iconos agregados en la solicitud y procesarlos
        if (!empty($PropietariosAgregados)) {
            foreach ($PropietariosAgregados as $propietario) {
                // Crear una nueva instancia de CategoriaVenta para cada icono agregado
                $new_Propietario = new Propietario_propiedades;
                // Asignar los valores del icono desde la solicitud
                // $new_icono->cantidad = $icono['cantidad']; // Acceder a 'cantidad' del icono
                $new_Propietario->id_propiedad = $new_propiedad->id;
                $new_Propietario->id_propietario = $propietario['id']; // Acceder a 'id' del propietario
                // Guardar el icono
                $new_Propietario->save();
            }
        }


        return Response()->json(['nueva_propiedad' => $new_propiedad]);
    }


    
    public function guardarMantenciones(Request $request)
    {
        $rutaArchivo = null;

        if ($request->hasFile('doc')) {
            $archivo = $request->file('doc');
            $nombreArchivo = time().'_'.$archivo->getClientOriginalName();
            $rutaArchivo = $archivo->storeAs('mantenciones', $nombreArchivo, 'public');
        }

        $proxima = $request->proxima ?? null;
        $envioCorreo = null;
        if ($proxima) {
            try {
                $envioCorreo = Carbon::parse($proxima)->subMonth();
            } catch (\Exception $e) {
                $envioCorreo = null;
            }
        }

        $mantenimiento = Mantenimiento::create([
            'id_propiedad'   => $request->id_propiedad,
            'nombre'         => $request->nombre,
            'descripcion'    => $request->descripcion,
            'fecha_mantencion' => $request->fecha,
            'meses'          => $request->meses,
            'fecha_prox_man' => $proxima,
            'envio_correo'   => $envioCorreo,
            'doc'            => $rutaArchivo,
        ]);

        $mantenimientoGuardado = Mantenimiento::with('propiedad')->find($mantenimiento->id);

        return response()->json([
            'message' => 'Mantenimiento guardado correctamente',
            'data'    => $mantenimientoGuardado
        ]);
    }
    
    
        
    

    public function PropietariosAgregados(Request $request)
    {
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


    public function mostrarArchivos($idPropiedad)
    {
        $archivosver = ArchivoPropiedad::where('id_propiedad', $idPropiedad)->get();

        $datosArchivos = [];
        foreach ($archivosver as $archivos) {
            $datosArchivos[] = [
                'id' => $archivos->id,
                'archivo' => $archivos->archivo,
                'id_propiedad' => $archivos->id_propiedad,

            ];
        }

        return response()->json(['datosarchivos' => $datosArchivos]);
    }
    
    public function mostrarArchivostrabajador($idPropiedad)
    {
        $archivosver = ArchivoPropiedad::where('id_propiedad', $idPropiedad)->get();

        $datosArchivos = [];
        foreach ($archivosver as $archivos) {
            $datosArchivos[] = [
                'id' => $archivos->id,
                'archivo' => $archivos->archivo,
                'id_propiedad' => $archivos->id_propiedad,

            ];
        }

        return response()->json(['datosarchivos' => $datosArchivos]);
    }

    public function addArchivo2(Request $request, $idPropiedad)
    { {


            if ($request->file('contratos2')) {
                foreach ($request->file('contratos2') as $archivo) {
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    $rutaArchivo = $archivo->storeAs('archivospro', $nombreArchivo, 'public');

                    // Guardar la ruta del archivo en la base de datos
                    $nuevoContrato = new ArchivoPropiedad();
                    $nuevoContrato->id_propiedad = $idPropiedad;
                    $nuevoContrato->archivo = '/storage/public/' . $rutaArchivo;
                    $nuevoContrato->save();
                    // dd(session()->all()); //
                }

                return response()->json([
                    'mensaje' => 'Archivos guardados exitosamente',
                    'archivos' => ArchivoPropiedad::where('id_propiedad', $idPropiedad)->get() // Retorna la lista actualizada de archivos
                ]);
            }

            return response()->json([
                'mensaje' => 'No se encontraron archivos para guardar'
            ], 400);
        }
    }
    public function addArchivo2trabajador(Request $request, $idPropiedad)
    { {


            if ($request->file('contratos2')) {
                foreach ($request->file('contratos2') as $archivo) {
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    $rutaArchivo = $archivo->storeAs('archivospro', $nombreArchivo, 'public');

                    // Guardar la ruta del archivo en la base de datos
                    $nuevoContrato = new ArchivoPropiedad();
                    $nuevoContrato->id_propiedad = $idPropiedad;
                    $nuevoContrato->archivo = '/storage/public/' . $rutaArchivo;
                    $nuevoContrato->save();
                    // dd(session()->all()); //
                }

                return response()->json([
                    'mensaje' => 'Archivos guardados exitosamente',
                    'archivos' => ArchivoPropiedad::where('id_propiedad', $idPropiedad)->get() // Retorna la lista actualizada de archivos
                ]);
            }

            return response()->json([
                'mensaje' => 'No se encontraron archivos para guardar'
            ], 400);
        }
    }
    public function destroy($idarchivo)
    {
        $contrato = ArchivoPropiedad::find($idarchivo)->delete();
        return Response()->json(['archivos' => 'Archivo ah sido eliminado correctamente ']);
    }
    public function destroytrabajador($idarchivo)
    {
        $contrato = ArchivoPropiedad::find($idarchivo)->delete();
        return Response()->json(['archivos' => 'Archivo ah sido eliminado correctamente ']);
    }

    public function eliminarpro($idPropiedad)
    {

        try {

            // Eliminamos las imágenes asociadas
            $imagenes = ImgPropiedad::where('id_propiedad', $idPropiedad)->get();
            foreach ($imagenes as $imagen) {
                $imagen->delete();
            }

            $videos = VidArriendo::where('id_propiedad', $idPropiedad)->get();
            foreach ($videos as $video) {
                $video->delete();
            }

            // Finalmente, eliminamos la propiedad
            $propiedades = Propiedad::where('id', $idPropiedad)->first();
            $propiedades->estado = 0;
            $propiedades->save();


            return Response()->json(['success' => 'Propiedad, imágenes y archivos eliminados correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return Response()->json(['error' => 'Error al eliminar: ' . $e->getMessage()], 500);
        }
    }

    public function eliminarprotrabajador($idPropiedad)
    {

        try {

            // Eliminamos las imágenes asociadas
            $imagenes = ImgPropiedad::where('id_propiedad', $idPropiedad)->get();
            foreach ($imagenes as $imagen) {
                $imagen->delete();
            }

            $videos = VidArriendo::where('id_propiedad', $idPropiedad)->get();
            foreach ($videos as $video) {
                $video->delete();
            } 

            // Finalmente, eliminamos la propiedad
            $propiedades = Propiedad::where('id',$idPropiedad)->first();
            $propiedades->estado = 0;
            $propiedades->save();


            return Response()->json(['success' => 'Propiedad, imágenes y archivos eliminados correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return Response()->json(['error' => 'Error al eliminar: ' . $e->getMessage()], 500);
        }
    }
    public function imgDelete($id)
    {
        $imagenes = ImgPropiedad::findOrFail($id);
        $imagenes->delete();
    }
    public function videoDelete($id)
    {
        $video = VidArriendo::findOrFail($id);
        $video->delete();
    }
    public function mantenciondelete($id)
    {
        $mantencion = Mantenimiento::findOrFail($id);
        $mantencion->delete();
    }

    public function addetalles(Request $request)
    {
        $idPropiedad = $request->id_propiedad;

        $detallePropiedad = DetallePropiedad::where('id_propiedad', $idPropiedad)->first();;
        $detallePropiedad->id_propiedad = $request->id_propiedad;
        $detallePropiedad->ano_construccion = $request->ano_construccion;
        $detallePropiedad->piso = $request->piso;
        $detallePropiedad->dormitorios = $request->dormitorios;
        $detallePropiedad->banos = $request->banos;
        $detallePropiedad->orientacion = $request->orientacion;
        $detallePropiedad->cocina = $request->cocina;
        $detallePropiedad->logia = $request->logia;
        $detallePropiedad->agua_caliente = $request->agua_caliente;
        $detallePropiedad->espacio_lavadora = $request->espacio_lavadora;
        $detallePropiedad->lavadora = $request->lavadora;
        $detallePropiedad->inventario = $request->inventario;
        $detallePropiedad->mt2_total = $request->mt2_total;
        $detallePropiedad->mt2_construido = $request->mt2_construido;
        $detallePropiedad->mt2_terraza = $request->mt2_terraza;
        $detallePropiedad->estacionamiento_visitas = $request->estacionamiento_visitas;
        $detallePropiedad->ascensor = $request->ascensor;
        $detallePropiedad->juegos_infantiles = $request->juegos_infantiles;
        $detallePropiedad->lavanderia = $request->lavanderia;
        $detallePropiedad->quinchos = $request->quinchos;
        $detallePropiedad->sala_multiuso = $request->sala_multiuso;
        $detallePropiedad->gimnasio = $request->gimnasio;
        $detallePropiedad->ciclovia = $request->ciclovia;
        $detallePropiedad->piscina = $request->piscina;
        $detallePropiedad->area_verde = $request->verde;

        // $detallePropiedad->tipo_propiedad = 1;
        $detallePropiedad->save();

        
        return response()->json(['success' => 'Detalles de propiedad registrados exitosamente.']);
    }
    public function edicionDetalles(Request $request){
        $id_propiedad = $request->id_propiedad;

        $ciudad = Propiedad::where('id', $id_propiedad)->first();
        $ciudad->direccion = $request->direccion;
        $ciudad->condominio = $request->condominio;
        $ciudad->tipo_vivienda = $request->tipo_vivienda;
        $ciudad->tipo_cocina = $request->tipo_cocina;
        $ciudad->ciudad = $request->ciudad;
        $ciudad->torre = $request->torre;
        $ciudad->num_torre = $request->numero_torre;
        $ciudad->descripcion = $request->descripcionpropiedad;
        $ciudad->rol = $request->rol;
        $ciudad->empresa_luz = $request->empresa_luz;
        $ciudad->empresa_gas = $request->empresa_gas;
        $ciudad->empresa_agua = $request->empresa_agua;
        $ciudad->numero_luz = $request->numero_luz;
        $ciudad->numero_gas = $request->numero_gas;
        $ciudad->numero_agua = $request->numero_agua;
        // $ciudad->mantenimiento = $request->mantenimiento;
        // $ciudad->reajuste_anual = $request->reajuste;
        $ciudad->maps = $request->mapa;

        $ciudad->save();

        $new_sub_detalles_edit = SubDetalles::where('id_propiedad',$id_propiedad)->where('tipo_detalle',1)->first();
        $new_sub_detalles_edit->monto = $request->monto;
        $new_sub_detalles_edit->rol = $request->rol_est;
        $new_sub_detalles_edit->estacionamiento = $request->estacionamiento;
        $new_sub_detalles_edit->techado = $request->techado;
        $new_sub_detalles_edit->id_propiedad = $ciudad->id;
        $new_sub_detalles_edit->tipo_detalle = 1;
        $new_sub_detalles_edit->tipo_propiedad = 1;
        // dd($new_sub_detalles_edit);
        $new_sub_detalles_edit->save();
        
        $new_sub_detalles_dos_edit = SubDetalles::where('id_propiedad',$id_propiedad)->where('tipo_detalle',2)->first();
        $new_sub_detalles_dos_edit->monto = $request->monto_b;
        $new_sub_detalles_dos_edit->rol = $request->rol_b;
        $new_sub_detalles_dos_edit->bodega = $request->bodega;
        $new_sub_detalles_dos_edit->id_propiedad = $ciudad->id;
        $new_sub_detalles_dos_edit->tipo_detalle = 2;
        $new_sub_detalles_dos_edit->tipo_propiedad = 1;

        $new_sub_detalles_dos_edit->save();

        $preciosEdit = Precios::where('id_propiedad',$id_propiedad)->first();
        $preciosEdit->diciembre = $request->diciembre;
        $preciosEdit->ano_corrido = $request->ano_corrido;
        $preciosEdit->tipo_moneda = $request->tipo_moneda;
        // dd($preciosEdit);
        $preciosEdit->save();
        
        $mantenimientoEdit = Mantenimiento::where('id_propiedad', $id_propiedad)->first();

        if ($mantenimientoEdit) {
            $nombre = $request->input('nombre');
            $descripcion = $request->input('descripcion_man');
            $fecha = $request->input('fecha');
            $meses = $request->input('meses');
            $proximaFecha = $request->input('proxima_fecha');
            $envioCorreo = $request->input('envio_correo');

            if ($this->valorValido($nombre)) {
                $mantenimientoEdit->nombre = $nombre;
            }
            if ($this->valorValido($descripcion)) {
                $mantenimientoEdit->descripcion = $descripcion;
            }
            if ($this->valorValido($fecha)) {
                $mantenimientoEdit->fecha_mantencion = $fecha;
            }
            if ($this->valorValido($meses)) {
                $mantenimientoEdit->meses = $meses;
            }
            if ($this->valorValido($proximaFecha)) {
                $mantenimientoEdit->fecha_prox_man = $proximaFecha;
            }
            if ($this->valorValido($envioCorreo)) {
                $mantenimientoEdit->envio_correo = $envioCorreo;
            }
        
            $mantenimientoEdit->save();
        }
        

        $detallesEdit = Detallepropiedad::where('id_propiedad', $id_propiedad)->first();

        if ($detallesEdit) {
            // Actualizamos cada campo verificando si existe en la solicitud
            $detallesEdit->ano_construccion = $request->has('ano_construccion') ? $request->ano_construccion : $detallesEdit->ano_construccion;
            $detallesEdit->piso = $request->has('piso') ? $request->piso : $detallesEdit->piso;
            $detallesEdit->dormitorios = $request->has('dormitorios') ? $request->dormitorios : $detallesEdit->dormitorios;
            $detallesEdit->banos = $request->has('banos') ? $request->banos : $detallesEdit->banos;
            $detallesEdit->orientacion = $request->has('orientacion') ? $request->orientacion : $detallesEdit->orientacion;
            $detallesEdit->cocina = $request->has('cocina') ? $request->cocina : $detallesEdit->cocina;
            $detallesEdit->logia = $request->has('logia') ? $request->logia : $detallesEdit->logia;
            $detallesEdit->agua_caliente = $request->has('agua_caliente') ? $request->agua_caliente : $detallesEdit->agua_caliente;
            $detallesEdit->espacio_lavadora = $request->has('espacio_lavadora') ? $request->espacio_lavadora : $detallesEdit->espacio_lavadora;
            $detallesEdit->lavadora = $request->has('lavadora') ? $request->lavadora : $detallesEdit->lavadora;
            $detallesEdit->inventario = $request->has('inventario') ? $request->inventario : $detallesEdit->inventario;
            $detallesEdit->mt2_construido = $request->has('mt2_construido') ? $request->mt2_construido : $detallesEdit->mt2_construido;
            $detallesEdit->mt2_terraza = $request->has('mt2_terraza') ? $request->mt2_terraza : $detallesEdit->mt2_terraza;
            $detallesEdit->mt2_total = $request->has('mt2_total') ? $request->mt2_total : $detallesEdit->mt2_total;
            $detallesEdit->estacionamiento_visitas = $request->has('estacionamiento_visita') ? $request->estacionamiento_visita : $detallesEdit->estacionamiento_visitas;
            $detallesEdit->ascensor = $request->has('ascensor') ? $request->ascensor : $detallesEdit->ascensor;
            $detallesEdit->juegos_infantiles = $request->has('juegos_infantiles') ? $request->juegos_infantiles : $detallesEdit->juegos_infantiles;
            $detallesEdit->lavanderia = $request->has('lavanderia') ? $request->lavanderia : $detallesEdit->lavanderia;
            $detallesEdit->quinchos = $request->has('quinchos') ? $request->quinchos : $detallesEdit->quinchos;
            $detallesEdit->sala_multiuso = $request->has('sala_multiuso') ? $request->sala_multiuso : $detallesEdit->sala_multiuso;
            $detallesEdit->gimnasio = $request->has('gimnasio') ? $request->gimnasio : $detallesEdit->gimnasio;
            $detallesEdit->ciclovia = $request->has('ciclovia') ? $request->ciclovia : $detallesEdit->ciclovia;
            $detallesEdit->area_verde = $request->has('verde') ? $request->verde : $detallesEdit->area_verde;
            $detallesEdit->piscina = $request->has('piscina') ? $request->piscina : $detallesEdit->piscina;

            // Guardamos los cambios
            $detallesEdit->save();
        }
        


        if ($request->file('imagenes') != null) {
            // Guardar las imágenes en la carpeta pública y la información en la base de datos
            foreach ($request->file('imagenes') as $imagenFile) {
                // Guardar la imagen en la carpeta pública
                $imageName = time() . '_' . $imagenFile->getClientOriginalName();
                $imagenPath = $imagenFile->storeAs('images', $imageName, 'public');

                // Guardar la información de la imagen en la base de datos
                $imagen = new ImgPropiedad();
                $imagen->nombre = $request->rol;
                $imagen->link = '/storage/public/' . $imagenPath; // Guardamos solo la ruta de la imagen
                $imagen->id_propiedad = $ciudad->id; // Asignar el ID del detalle de venta
                $imagen->save();
            }
        }

        if ($request->hasFile('videos')) {
            // Obtener el archivo de video del formulario
            $videoFile = $request->file('videos');

            // Guardar el video en la carpeta pública
            $videoName = time() . '_' . $videoFile->getClientOriginalName();
            $videoPath = $videoFile->storeAs('videos', $videoName, 'public');

            // Guardar la información del video en la base de datos
            $video = new VidArriendo;
            $video->video = '/storage/public/' . $videoPath; // Guardamos solo la ruta del video
            $video->id_propiedad = $ciudad->id;
            $video->estado = 1; // Asignar el ID del detalle de venta
            $video->save();
        }

        // Buscar si ya existe un registro para esa propiedad
        $archivo = ArchivoPropiedad::where('id_propiedad', $ciudad->id)->first();

        // Si no existe, se crea uno nuevo
        if (!$archivo) {
            $archivo = new ArchivoPropiedad();
            $archivo->id_propiedad = $ciudad->id;
        }

        // Si existe, no es necesario volver a asignar id_propiedad, pero puedes hacerlo si quieres
        $archivo->id_propiedad = $ciudad->id;

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

        if ($request->hasFile('contrato')) {
            $contratoFile = $request->file('contrato');
            $contratoName = time() . '_' . $contratoFile->getClientOriginalName();
            $contratoPath = $contratoFile->storeAs('contrato', $contratoName, 'public');
            $archivo->contrato = '/storage/public/' . $contratoPath;
        }

        if ($request->hasFile('poder')) {
            $poderFile = $request->file('poder');
            $poderName = time() . '_' . $poderFile->getClientOriginalName();
            $poderPath = $poderFile->storeAs('poder', $poderName, 'public');
            $archivo->poder_adm = '/storage/public/' . $poderPath;
        }

        $archivo->save();



        // Decodificar la cadena JSON a un array asociativo
        $PropietariosAgregados = json_decode($request->PropietariosAgregados, true);
        // dd($request->all());

        // Verificar si hay propietario agregados en la solicitud y procesarlos
        if (!empty($PropietariosAgregados)) {
            foreach ($PropietariosAgregados as $propietario) {
                // Crear una nueva instancia de CategoriaVenta para cada propietario agregado
                $new_Propietario = new Propietario_propiedades;
                // Asignar los valores del propietario desde la solicitud
                $new_Propietario->id_propiedad = $ciudad->id;
                $new_Propietario->id_propietario = $propietario['id']; // Acceder a 'id' del propietario
                // Guardar el propietario
                $new_Propietario->save();
            }
        }


        return Response()->json([
            'propiedad_editada' => $ciudad,
            'precios_editados' => $preciosEdit,
            'detalles_editados' => $detallesEdit
        ]);
    }

    public function cambiarImg($id)
    {
        // Encuentra la imagen seleccionada
        $imagenSeleccionada = ImgPropiedad::find($id);

        if (!$imagenSeleccionada) {
            return response()->json(['error' => 'Imagen no encontrada'], 404);
        }

        // Encuentra la primera imagen (según el menor id) para el mismo id_venta
        $imagenPortadaNueva = ImgPropiedad::where('id_propiedad', $imagenSeleccionada->id_propiedad)
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
    public function PropietarioDelete($idPropietario)
    {
        $propietarioDelete = Propietario_propiedades::findOrFail($idPropietario);
        $propietarioDelete->delete();
    }
    ////////////////////////// AÑO CORRIDO ////////////////////////////////////
    public function indexanocorrido()
    {
        //  $propiedades = Propiedad::all(); 
        $propietarios = Propietario::all();
        // $propiedades = Propiedad::with('imagenes')->where('estado', 1)->where('tipo_propiedad',1)->get();
        $propiedades = Propiedad::with(['imagenes', 'detallePropiedad','subdetalles','propietario'])
        ->where('estado', 1)
        ->where('tipo_propiedad', 3)
        ->get()
        ->map(function ($propiedad) {
            $propiedad->mostrar_boton = $propiedad->detallePropiedad && $propiedad->detallePropiedad->ano_construccion === null;
            return $propiedad;
        });
        // $propiedades = ImgPropiedad::with('imagen_url')->get();
        // $propiedades = Propiedad::with('imagen_url')->get();
        $propiedad = $propiedades->first(); // Obtiene la primera propiedad

        // $mostrarBoton = $detalles && $detalles->ano_construccion === null;


        return view('proanocorrido', compact('propiedades', 'propietarios', 'propiedad'));
    }


    ///////////////////////// PROPIEDADES EN VENTA ///////////////// 
    public function indexVenta()
    {
        $propietarioVenta = Propietario::all();
        $propiedadesVenta = Propiedad::with(['imagenes', 'detallePropiedad'])
        ->where('estado', 1)
        ->where('tipo_propiedad', 2)
        ->get()
        ->map(function ($propiedad) {
            $propiedad->mostrar_boton = $propiedad->detallePropiedad && $propiedad->detallePropiedad->ano_construccion === null;
            return $propiedad;
        });

        return view('propiedades-venta', compact('propiedadesVenta', 'propietarioVenta'));
    }

    public function addProVenta(Request $request)
    {
        $new_propiedad_venta = new Propiedad();
        $new_propiedad_venta->direccion = $request->direccion;
        $new_propiedad_venta->ciudad = $request->ciudad;
        $new_propiedad_venta->maps = $request->maps;
        $new_propiedad_venta->tipo_vivienda = $request->tipo_vivienda;
        $new_propiedad_venta->condominio = $request->condominio;
        $new_propiedad_venta->torre = $request->torre;
        $new_propiedad_venta->rol = $request->rol;
        $new_propiedad_venta->num_torre = $request->num_departamento;
        $new_propiedad_venta->empresa_luz = $request->empresaluz;
        $new_propiedad_venta->empresa_agua = $request->empresaagua;
        $new_propiedad_venta->empresa_gas = $request->empresagas;
        $new_propiedad_venta->numero_luz = $request->numeroluz;
        $new_propiedad_venta->numero_agua = $request->numeroagua;
        $new_propiedad_venta->numero_gas = $request->numerogas;

        $new_propiedad_venta->deuda_hipotecaria = $request->deuda_hipotecaria;
        $new_propiedad_venta->contribuciones = $request->contribuciones;

        $new_propiedad_venta->derechos_aseo = $request->derechos_aseo;
        $new_propiedad_venta->exclusividad = $request->exclusividad;
        $new_propiedad_venta->sello_verde = $request->sello_verde;

        $new_propiedad_venta->tipo_propiedad = 2;
        $new_propiedad_venta->estado = 1;
        $new_propiedad_venta->estado_venta = 1;

        $new_propiedad_venta->save();

        // subdetalles estacionamiento
        $new_sub_detalles_uno = new SubDetalles;
        $new_sub_detalles_uno->monto = $request->monto;
        $new_sub_detalles_uno->rol = $request->rol_est;
        $new_sub_detalles_uno->estacionamiento = $request->estacionamiento;
        $new_sub_detalles_uno->techado = $request->techado;
        $new_sub_detalles_uno->id_propiedad = $new_propiedad_venta->id;
        $new_sub_detalles_uno->tipo_propiedad = 2;
        $new_sub_detalles_uno->tipo_detalle = 1;
        $new_sub_detalles_uno->save();
        
        // subdetalles bodega
        $new_sub_detalles_dos = new SubDetalles;
        $new_sub_detalles_dos->monto = $request->monto_b;
        $new_sub_detalles_dos->rol = $request->rol_b;
        $new_sub_detalles_dos->bodega = $request->bodega;
        $new_sub_detalles_dos->id_propiedad = $new_propiedad_venta->id;
        $new_sub_detalles_dos->tipo_propiedad = 2;
        $new_sub_detalles_dos->tipo_detalle = 2;

        $new_sub_detalles_dos->save();


        // Guardar el detalle de venta
        $new_detalles_pro = new DetallePropiedad;
        $new_detalles_pro->id_propiedad = $new_propiedad_venta->id;
        $new_detalles_pro->tipo_propiedad = 2;
        $new_detalles_pro->save();
        
        //Guardar precios
        $new_precios = new Precios;
        $new_precios->venta = $request->precio;
        $new_precios->tipo_moneda = $request->tipo_moneda;
        $new_precios->id_propiedad = $new_propiedad_venta->id;
        $new_precios->tipo_propiedad = 2;
        $new_precios->estado = 1;

        $new_precios->save();
        
        if ($request->file('imagenes') != null) {
            // Guardar las imágenes en la carpeta pública y la información en la base de datos
            foreach ($request->file('imagenes') as $imagenFile) {
                // Guardar la imagen en la carpeta pública
                $imageName = time() . '_' . $imagenFile->getClientOriginalName();
                $imagenPath = $imagenFile->storeAs('images', $imageName, 'public');

                // Guardar la información de la imagen en la base de datos
                $imagen = new ImgPropiedad();
                $imagen->nombre = $request->rol;
                $imagen->link = '/storage/public/' . $imagenPath; // Guardamos solo la ruta de la imagen
                $imagen->id_propiedad = $new_propiedad_venta->id; // Asignar el ID del detalle de venta
                $imagen->save();
            }
        }

        // Decodificar la cadena JSON a un array asociativo
        $PropietariosAgregados = json_decode($request->PropietariosAgregados, true);
        // dd($request->all());

        // Verificar si hay iconos agregados en la solicitud y procesarlos
        if (!empty($PropietariosAgregados)) {
            foreach ($PropietariosAgregados as $propietario) {
                // Crear una nueva instancia de CategoriaVenta para cada icono agregado
                $new_Propietario = new Propietario_propiedades;
                // Asignar los valores del icono desde la solicitud
                // $new_icono->cantidad = $icono['cantidad']; // Acceder a 'cantidad' del icono
                $new_Propietario->id_propiedad = $new_propiedad_venta->id;
                $new_Propietario->id_propietario = $propietario['id']; // Acceder a 'id' del propietario
                // Guardar el icono
                $new_Propietario->save();
            }
        }

        return Response()->json(['nueva_propiedad_venta' => $new_propiedad_venta]);
    }

    public function addetallesVenta(Request $request)
    {
        $idPropiedad = $request->idPropiedad;

        $detalle_propiedad = DetallePropiedad::where('id', $idPropiedad)->first();
        $detalle_propiedad->ano_construccion = $request->ano_construccion;
        $detalle_propiedad->piso = $request->piso;
        $detalle_propiedad->dormitorios = $request->dormitorios;
        $detalle_propiedad->banos = $request->banos;
        $detalle_propiedad->orientacion = $request->orientacion;
        $detalle_propiedad->cocina = $request->cocina;
        $detalle_propiedad->logia = $request->logia;
        $detalle_propiedad->agua_caliente = $request->agua_caliente;
        $detalle_propiedad->espacio_lavadora = $request->espacio_lavadora;
        $detalle_propiedad->lavadora = $request->lavadora;
        $detalle_propiedad->inventario = $request->inventario;
        $detalle_propiedad->mt2_total = $request->mt2_total;
        $detalle_propiedad->mt2_construido = $request->mt2_construido;
        $detalle_propiedad->mt2_terraza = $request->mt2_terraza;
        $detalle_propiedad->estacionamiento_visitas = $request->estacionamiento_visitas;
        $detalle_propiedad->ascensor = $request->ascensor;
        $detalle_propiedad->juegos_infantiles = $request->juegos_infantiles;
        $detalle_propiedad->lavanderia = $request->lavanderia;
        $detalle_propiedad->quinchos = $request->quinchos;
        $detalle_propiedad->sala_multiuso = $request->sala_multiuso;
        $detalle_propiedad->gimnasio = $request->gimnasio;
        $detalle_propiedad->ciclovia = $request->ciclovia;
        $detalle_propiedad->piscina = $request->piscina;
        $detalle_propiedad->area_verde = $request->verde;

        $detalle_propiedad->gasto_comun = $request->gasto_comun;
        $detalle_propiedad->descripcion = $request->descripcion;
        $detalle_propiedad->tipo_propiedad = 2;
        $detalle_propiedad->save();

        return Response()->json(['detalle_propiedad' => $detalle_propiedad]);
    }

    public function addArchivoVenta(Request $request)
    { {
            $request->validate([
                'contratos2' => 'required|array',
                'contratos2.*' => 'file|mimes:jpg,png,pdf,docx|max:5120',
            ]);

            if ($request->hasFile('contratos2')) {
                foreach ($request->file('contratos2') as $archivo) {
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    $rutaArchivo = $archivo->storeAs('archivospro', $nombreArchivo, 'public');

                    // Guardar la ruta del archivo en la base de datos
                    $nuevoContrato = new ArchivoPropiedad();
                    $nuevoContrato->id_propiedad = $request->idPropiedad;
                    $nuevoContrato->archivo = '/storage/public/' . $rutaArchivo;
                    $nuevoContrato->save();
                    // dd(session()->all()); //
                }

                return response()->json([
                    'mensaje' => 'Archivos guardados exitosamente',
                    'archivos' => ArchivoPropiedad::where('id_propiedad', $request->idPropiedad)->get() // Retorna la lista actualizada de archivos
                ]);
            }

            return response()->json([
                'mensaje' => 'No se encontraron archivos para guardar'
            ], 400);
        }
    }

    public function eliminarproVenta($idPropiedad)
    {

        try {

            // Eliminamos las imágenes asociadas
            $imagenes = ImgPropiedad::where('id_propiedad', $idPropiedad)->get();
            foreach ($imagenes as $imagen) {
                $imagen->delete();
            }

            // Finalmente, eliminamos la propiedad
            $propiedades = Propiedad::where('id', $idPropiedad)->first();
            $propiedades->estado = 0;
            $propiedades->save();


            return Response()->json(['success' => 'Propiedad, imágenes y archivos eliminados correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return Response()->json(['error' => 'Error al eliminar: ' . $e->getMessage()], 500);
        }
    }

    /////////////////// PROPIEDAD VENTA DETALLES ///////////////////////////////////////
    public function propiedadesVentaDetalles($id)
    {
        $detalles = Propiedad::find($id);
        $imagen = ImgPropiedad::where('id_propiedad', $id)->get();
        $propietarios = Propietario_propiedades::where('id_propiedad', $id)->get();
        $precios = Precios::where('id_propiedad', $id)->first();
        $detallespropiedad = DetallePropiedad::where('id_propiedad', $id)->first();
        $mantenimiento = Mantenimiento::where('id_propiedad', $id)->get();


        $sub_est = SubDetalles::where('id_propiedad', $id)
            ->where('tipo_detalle',1)
            ->first();
        
        $sub_bodega = SubDetalles::where('id_propiedad', $id)
            ->where('tipo_detalle',2)
            ->first();
        

        $new_Propietarios = Propietario::whereNotIn('id', function ($query) use ($id) {
            $query->select('id_propietario')
                ->from('propietario_propiedades')
                ->where('id_propiedad', $id); // Filtrar según la ID específica
        })->get();

        return view('propiedadesVentaDetalles', compact('sub_est','sub_bodega','detalles', 'new_Propietarios' ,'imagen', 'detallespropiedad','propietarios','precios','mantenimiento'));
    }

    // =====================================================================
    // FIX APLICADO: edicionDetallesVenta
    // Cambios:
    //   1. Video: nombre sanitizado (sin caracteres especiales) + ruta corregida
    //   2. Documentos: se procesan inventario_archivo, acta, contrato y poder
    //      usando ArchivoPropiedad (igual que edicionDetalles)
    // =====================================================================
    public function edicionDetallesVenta(Request $request){
        $id_propiedad = $request->id_propiedad;

        $ciudad = Propiedad::where('id', $id_propiedad)->first();
        $ciudad->direccion = $request->direccion;
        $ciudad->ciudad = $request->ciudad;
        $ciudad->condominio = $request->condominio;
        $ciudad->tipo_vivienda = $request->tipo_vivienda;
        $ciudad->tipo_cocina = null;
        $ciudad->torre = $request->torre;
        $ciudad->num_torre = $request->numero_torre;
        $ciudad->rol = $request->rol;
        $ciudad->deuda_hipotecaria = $request->deuda_hipotecaria;
        $ciudad->tipo_moneda_deuda = $request->tipo_moneda_deuda ?? $ciudad->tipo_moneda_deuda;
        $ciudad->institucion = $request->institucion ?? $ciudad->institucion;
        $ciudad->contribuciones = $request->contribuciones ?? $ciudad->contribuciones;
        $ciudad->derechos_aseo = $request->derechos_aseo ?? $ciudad->derechos_aseo;
        $ciudad->exclusividad = $request->exclusividad ?? $ciudad->exclusividad;
        $ciudad->sello_verde = $request->sello_verde ?? $ciudad->sello_verde;
        $ciudad->empresa_luz = $request->empresa_luz;
        $ciudad->empresa_gas = $request->empresa_gas;
        $ciudad->empresa_agua = $request->empresa_agua;
        $ciudad->numero_luz = $request->numero_luz;
        $ciudad->numero_gas = $request->numero_gas;
        $ciudad->numero_agua = $request->numero_agua;
        $ciudad->maps = $request->mapa;
        $ciudad->save();

        $preciosEdit = Precios::where('id_propiedad', $id_propiedad)->first();
        $preciosEdit->venta = $request->precio;
        $preciosEdit->tipo_moneda = $request->tipo_moneda;
        $preciosEdit->save();

        $new_sub_detalles_edit = SubDetalles::where('id_propiedad', $id_propiedad)->where('tipo_detalle', 1)->first();
        $new_sub_detalles_edit->monto = $request->monto;
        $new_sub_detalles_edit->rol = $request->rol_est;
        $new_sub_detalles_edit->estacionamiento = $request->estacionamiento;
        $new_sub_detalles_edit->techado = $request->techado;
        $new_sub_detalles_edit->moneda = $request->moneda_est ?? $new_sub_detalles_edit->moneda;
        $new_sub_detalles_edit->id_propiedad = $ciudad->id;
        $new_sub_detalles_edit->tipo_detalle = 1;
        $new_sub_detalles_edit->tipo_propiedad = 2;
        $new_sub_detalles_edit->save();

        $new_sub_detalles_dos_edit = SubDetalles::where('id_propiedad', $id_propiedad)->where('tipo_detalle', 2)->first();
        $new_sub_detalles_dos_edit->monto = $request->monto_b;
        $new_sub_detalles_dos_edit->rol = $request->rol_b;
        $new_sub_detalles_dos_edit->bodega = $request->bodega;
        $new_sub_detalles_dos_edit->moneda = $request->moneda_bo ?? $new_sub_detalles_dos_edit->moneda;
        $new_sub_detalles_dos_edit->id_propiedad = $ciudad->id;
        $new_sub_detalles_dos_edit->tipo_detalle = 2;
        $new_sub_detalles_dos_edit->tipo_propiedad = 2;
        $new_sub_detalles_dos_edit->save();

        $mantenimientoEdit = Mantenimiento::where('id_propiedad', $id_propiedad)->first();
        if ($mantenimientoEdit) {
            $nombre = $request->input('nombre');
            $descripcion = $request->input('descripcion_man');
            $fecha = $request->input('fecha');
            $meses = $request->input('meses');
            $proximaFecha = $request->input('proxima_fecha');
            $envioCorreo = $request->input('envio_correo');

            if ($this->valorValido($nombre)) {
                $mantenimientoEdit->nombre = $nombre;
            }
            if ($this->valorValido($descripcion)) {
                $mantenimientoEdit->descripcion = $descripcion;
            }
            if ($this->valorValido($fecha)) {
                $mantenimientoEdit->fecha_mantencion = $fecha;
            }
            if ($this->valorValido($meses)) {
                $mantenimientoEdit->meses = $meses;
            }
            if ($this->valorValido($proximaFecha)) {
                $mantenimientoEdit->fecha_prox_man = $proximaFecha;
            }
            if ($this->valorValido($envioCorreo)) {
                $mantenimientoEdit->envio_correo = $envioCorreo;
            }

            $mantenimientoEdit->save();
        }

        $detallesEdit = DetallePropiedad::where('id_propiedad', $id_propiedad)->first();
        if ($detallesEdit) {
            $detallesEdit->ano_construccion = $request->ano_construccion ?? $detallesEdit->ano_construccion;
            $detallesEdit->piso = $request->piso ?? $detallesEdit->piso;
            $detallesEdit->dormitorios = $request->dormitorios ?? $detallesEdit->dormitorios;
            $detallesEdit->banos = $request->banos ?? $detallesEdit->banos;
            $detallesEdit->orientacion = $request->orientacion ?? $detallesEdit->orientacion;
            $detallesEdit->cocina = $request->cocina ?? $detallesEdit->cocina;
            $detallesEdit->logia = $request->logia ?? $detallesEdit->logia;
            $detallesEdit->agua_caliente = $request->agua_caliente ?? $detallesEdit->agua_caliente;
            $detallesEdit->inventario = $request->inventario ?? $detallesEdit->inventario;
            $detallesEdit->mt2_construido = $request->mt2_construido ?? $detallesEdit->mt2_construido;
            $detallesEdit->mt2_terraza = $request->mt2_terraza ?? $detallesEdit->mt2_terraza;
            $detallesEdit->mt2_total = $request->mt2_total ?? $detallesEdit->mt2_total;
            $detallesEdit->gasto_comun = $request->gasto_comun
                ? (int) preg_replace('/[^0-9]/', '', $request->gasto_comun)
                : $detallesEdit->gasto_comun;
            $detallesEdit->descripcion = $request->descripcion ?? $detallesEdit->descripcion;
            $detallesEdit->ascensor = $request->ascensor ?? $detallesEdit->ascensor;
            $detallesEdit->juegos_infantiles = $request->juegos_infantiles ?? $detallesEdit->juegos_infantiles;
            $detallesEdit->lavanderia = $request->lavanderia ?? $detallesEdit->lavanderia;
            $detallesEdit->quinchos = $request->quinchos ?? $detallesEdit->quinchos;
            $detallesEdit->sala_multiuso = $request->sala_multiuso ?? $detallesEdit->sala_multiuso;
            $detallesEdit->gimnasio = $request->gimnasio ?? $detallesEdit->gimnasio;
            $detallesEdit->ciclovia = $request->ciclovia ?? $detallesEdit->ciclovia;
            $detallesEdit->piscina = $request->piscina ?? $detallesEdit->piscina;
            $detallesEdit->area_verde = $request->verde ?? $detallesEdit->area_verde;
            $detallesEdit->conserjeria = $request->conserjeria ?? $detallesEdit->conserjeria;

            $detallesEdit->save();
        }

        // Guardar imágenes
        if ($request->file('imagenes') != null) {
            foreach ($request->file('imagenes') as $imagenFile) {
                $imageName = time() . '_' . $imagenFile->getClientOriginalName();
                $imagenPath = $imagenFile->storeAs('images', $imageName, 'public');

                $imagen = new ImgPropiedad();
                $imagen->nombre = $request->rol;
                $imagen->link = '/storage/public/' . $imagenPath;
                $imagen->id_propiedad = $ciudad->id;
                $imagen->save();
            }
        }

        // FIX 1: Guardar video con nombre sanitizado y ruta correcta (sin /public/ extra)
        if ($request->hasFile('videos')) {
            $videoFile = $request->file('videos');
            $ext = $videoFile->getClientOriginalExtension() ?: 'mp4';
            $videoName = time() . '_video.' . $ext;
            $videoPath = $videoFile->storeAs('videos', $videoName, 'public');

            $video = new VidArriendo;
            $video->video = '/storage/' . $videoPath;
            $video->id_propiedad = $ciudad->id;
            $video->estado = 1;
            $video->save();
        }

        // FIX 2: Guardar documentos (inventario, acta, contrato, poder) en ArchivoPropiedad
        $archivo = ArchivoPropiedad::where('id_propiedad', $ciudad->id)->first();
        if (!$archivo) {
            $archivo = new ArchivoPropiedad();
            $archivo->id_propiedad = $ciudad->id;
        }

        if ($request->hasFile('inventario_archivo')) {
            $invFile = $request->file('inventario_archivo');
            $ext = $invFile->getClientOriginalExtension() ?: 'pdf';
            $invName = time() . '_inventario.' . $ext;
            $invPath = $invFile->storeAs('inventario', $invName, 'public');
            $archivo->inventario = '/storage/' . $invPath;
        }

        if ($request->hasFile('acta')) {
            $actaFile = $request->file('acta');
            $ext = $actaFile->getClientOriginalExtension() ?: 'pdf';
            $actaName = time() . '_acta.' . $ext;
            $actaPath = $actaFile->storeAs('acta', $actaName, 'public');
            $archivo->acta_entrega = '/storage/' . $actaPath;
        }

        if ($request->hasFile('contrato')) {
            $contratoFile = $request->file('contrato');
            $ext = $contratoFile->getClientOriginalExtension() ?: 'pdf';
            $contratoName = time() . '_contrato.' . $ext;
            $contratoPath = $contratoFile->storeAs('contrato', $contratoName, 'public');
            $archivo->contrato = '/storage/' . $contratoPath;
        }

        if ($request->hasFile('poder')) {
            $poderFile = $request->file('poder');
            $ext = $poderFile->getClientOriginalExtension() ?: 'pdf';
            $poderName = time() . '_poder.' . $ext;
            $poderPath = $poderFile->storeAs('poder', $poderName, 'public');
            $archivo->poder_adm = '/storage/' . $poderPath;
        }

        $archivo->save();

        // Guardar propietarios nuevos
        $PropietariosAgregados = json_decode($request->PropietariosAgregados, true);
        if (!empty($PropietariosAgregados)) {
            foreach ($PropietariosAgregados as $propietario) {
                $new_Propietario = new Propietario_propiedades;
                $new_Propietario->id_propiedad = $ciudad->id;
                $new_Propietario->id_propietario = $propietario['id'];
                $new_Propietario->save();
            }
        }

        return Response()->json([
            'propiedad_editada' => $ciudad,
            'precios_editados'  => $preciosEdit,
            'detalles_editados' => $detallesEdit
        ]);
    }


    //////////////////////////////// TRABAJADOR ////////////////////////////////////////
    public function indexTrabajador()
    {
        //  $propiedades = Propiedad::all(); 
        $propietarios = Propietario::all();
        // $propiedades = Propiedad::with('imagenes')->where('estado', 1)->where('tipo_propiedad',1)->get();
        $propiedades = Propiedad::with(['imagenes', 'detallePropiedad'])
        ->where('estado', 1)
        ->where('tipo_propiedad', 1)
        ->get()
        ->map(function ($propiedad) {
            $propiedad->mostrar_boton = $propiedad->detallePropiedad && $propiedad->detallePropiedad->ano_construccion === null;
            return $propiedad;
        });
        // $propiedades = ImgPropiedad::with('imagen_url')->get();
        // $propiedades = Propiedad::with('imagen_url')->get();
        $propiedad = $propiedades->first(); // Obtiene la primera propiedad

        // $mostrarBoton = $detalles && $detalles->ano_construccion === null;


        return view('trabajador.propiedades', compact('propiedades', 'propietarios'));
    }
    public function indexanocorridotrabajador()
    {
        //  $propiedades = Propiedad::all(); 
        $propietarios = Propietario::all();
        // $propiedades = Propiedad::with('imagenes')->where('estado', 1)->where('tipo_propiedad',1)->get();
        $propiedades = Propiedad::with(['imagenes', 'detallePropiedad'])
        ->where('estado', 1)
        ->where('tipo_propiedad', 3)
        ->get()
        ->map(function ($propiedad) {
            $propiedad->mostrar_boton = $propiedad->detallePropiedad && $propiedad->detallePropiedad->ano_construccion === null;
            return $propiedad;
        });
        // $propiedades = ImgPropiedad::with('imagen_url')->get();
        // $propiedades = Propiedad::with('imagen_url')->get();
        $propiedad = $propiedades->first(); // Obtiene la primera propiedad

        // $mostrarBoton = $detalles && $detalles->ano_construccion === null;


        return view('trabajador.proanocorrido', compact('propiedades', 'propietarios', 'propiedad'));
    }
    
    public function indexanocorridoobrero()
    {
        //  $propiedades = Propiedad::all(); 
        $propietarios = Propietario::all();
        // $propiedades = Propiedad::with('imagenes')->where('estado', 1)->where('tipo_propiedad',1)->get();
        $propiedades = Propiedad::with(['imagenes', 'detallePropiedad'])
        ->where('estado', 1)
        ->where('tipo_propiedad', 3)
        ->get()
        ->map(function ($propiedad) {
            $propiedad->mostrar_boton = $propiedad->detallePropiedad && $propiedad->detallePropiedad->ano_construccion === null;
            return $propiedad;
        });
        // $propiedades = ImgPropiedad::with('imagen_url')->get();
        // $propiedades = Propiedad::with('imagen_url')->get();
        $propiedad = $propiedades->first(); // Obtiene la primera propiedad

        // $mostrarBoton = $detalles && $detalles->ano_construccion === null;


        return view('obrero.proanocorrido', compact('propiedades', 'propietarios', 'propiedad'));
    }
    /////////////////// PROPIEDAD DETALLES ///////////////////////////////////////
    public function propiedadesDetalles($id)
    {
        $detalles = Propiedad::find($id);
        $imagen = ImgPropiedad::where('id_propiedad', $id)->get();
        $mantenimiento = Mantenimiento::where('id_propiedad', $id)->get();
        $videos = VidArriendo::where('id_propiedad', $id)->get();
        $propietarios = Propietario_propiedades::where('id_propiedad', $id)->get();

        $sub_est = SubDetalles::where('id_propiedad', $id)
        ->where('tipo_detalle',1)
        ->first();
        $estados = EstadoPagos::all();
    
        $sub_bodega = SubDetalles::where('id_propiedad', $id)
            ->where('tipo_detalle',2)
            ->first();
        
        $sub_techado = SubDetalles::where('id_propiedad', $id)
            ->where('tipo_detalle',3)
            ->first();

        $precios = Precios::where('id_propiedad', $id)->first();
        $doc = ArchivoPropiedad::where('id_propiedad',$id)->first();

        $arriendos = Arriendo::where('id_propiedad', $id)->where('estado',1)->orderBy('fecha_entrega', 'desc')->get();
        $arrendatario = Arrendatario::where('estado', 1)->get();
        $comision = Comision::all();

        $detallespropiedad = DetallePropiedad::where('id_propiedad', $id)->first();

        $new_Propietarios = Propietario::whereNotIn('id', function ($query) use ($id) {
            $query->select('id_propietario')
                ->from('propietario_propiedades')
                ->where('id_propiedad', $id); // Filtrar según la ID específica
        })->get();


        return view('propiedadesDetalles', compact('doc','comision','arrendatario','estados','mantenimiento','arriendos','sub_techado','sub_bodega','sub_est','videos', 'new_Propietarios', 'detalles', 'imagen', 'propietarios', 'detallespropiedad', 'precios'));
    }
        /////////////////// PROPIEDAD DETALLES ///////////////////////////////////////
        public function proanocorridopropiedadesDetalles($id)
        {
            $detalles = Propiedad::find($id);
            $imagen = ImgPropiedad::where('id_propiedad', $id)->get();
            $videos = VidArriendo::where('id_propiedad', $id)->get();
            $mantenimiento = Mantenimiento::where('id_propiedad', $id)->get();
            $propietarios = Propietario_propiedades::where('id_propiedad', $id)->get();
    
            $sub_est = SubDetalles::where('id_propiedad', $id)
            ->where('tipo_detalle',1)
            ->first();
        
            $sub_bodega = SubDetalles::where('id_propiedad', $id)
            ->where('tipo_detalle',2)
            ->first();

            
            $precios = Precios::where('id_propiedad', $id)->first();
            $estados = EstadoPagos::all();
            $comision = Comision::all();

            $doc = ArchivoPropiedad::where('id_propiedad',$id)->first();

            $arriendos = Arriendo::where('id_propiedad', $id)->where('estado',1)->orderBy('fecha_entrega', 'desc')->get();
            $arrendatario = Arrendatario::where('estado', 1)->get();
    
            $detallespropiedad = DetallePropiedad::where('id_propiedad', $id)->first();
    
            $new_Propietarios = Propietario::whereNotIn('id', function ($query) use ($id) {
                $query->select('id_propietario')
                    ->from('propietario_propiedades')
                    ->where('id_propiedad', $id); // Filtrar según la ID específica
            })->get();
    
            return view('detalleano', compact('doc','comision','estados','arrendatario','mantenimiento','arriendos','sub_bodega','sub_est','videos', 'new_Propietarios', 'detalles', 'imagen', 'propietarios', 'detallespropiedad', 'precios'));
        }
        /////////////////// PROPIEDAD DETALLES ///////////////////////////////////////
        public function proanocorridopropiedadesDetallestrabajador($id)
        {
            $detalles = Propiedad::find($id);
            $imagen = ImgPropiedad::where('id_propiedad', $id)->get();
            $videos = VidArriendo::where('id_propiedad', $id)->get();
            $mantenimiento = Mantenimiento::where('id_propiedad', $id)->get();
            $propietarios = Propietario_propiedades::where('id_propiedad', $id)->get();
    
            $sub_est = SubDetalles::where('id_propiedad', $id)
            ->where('tipo_detalle',1)
            ->first();
        
            $sub_bodega = SubDetalles::where('id_propiedad', $id)
            ->where('tipo_detalle',2)
            ->first();
    
            $precios = Precios::where('id_propiedad', $id)->first();
    
            $arrendatario = Arrendatario::where('estado', 1)->get();
            $estados = EstadoPagos::all();
            $comision = Comision::all();

            $doc = ArchivoPropiedad::where('id_propiedad',$id)->first();

            $arriendos = Arriendo::where('id_propiedad', $id)->where('estado',1)->orderBy('fecha_entrega', 'desc')->get();
            
    
            $detallespropiedad = DetallePropiedad::where('id_propiedad', $id)->first();
    
            $new_Propietarios = Propietario::whereNotIn('id', function ($query) use ($id) {
                $query->select('id_propietario')
                    ->from('propietario_propiedades')
                    ->where('id_propiedad', $id); // Filtrar según la ID específica
            })->get();
    
            return view('trabajador.detalleano', compact('arriendos','comision','estados','doc','arrendatario','mantenimiento','sub_bodega','sub_est','videos', 'new_Propietarios', 'detalles', 'imagen', 'propietarios', 'detallespropiedad', 'precios'));
        }
    public function trabajadorpropiedadesDetalles($id)
    {
        $detalles = Propiedad::find($id);
        $imagen = ImgPropiedad::where('id_propiedad', $id)->get();
        $videos = VidArriendo::where('id_propiedad', $id)->get();
        $propietarios = Propietario_propiedades::where('id_propiedad', $id)->get();
        $precios = Precios::where('id_propiedad',$id)->first();
        $mantenimiento = Mantenimiento::where('id_propiedad', $id)->get();

        $detallespropiedad = DetallePropiedad::where('id_propiedad', $id)->first();
        $new_Propietarios = Propietario::whereNotIn('id', function ($query) use ($id) {
            $query->select('id_propietario')
                  ->from('propietario_propiedades')
                  ->where('id_propiedad', $id); // Filtrar según la ID específica
        })->get();
        $arrendatario = Arrendatario::where('estado', 1)->get();
        $estados = EstadoPagos::all();
        $comision = Comision::all();

        $doc = ArchivoPropiedad::where('id_propiedad',$id)->first();

        $arriendos = Arriendo::where('id_propiedad', $id)->where('estado',1)->orderBy('fecha_entrega', 'desc')->get();
        
        $sub_est = SubDetalles::where('id_propiedad', $id)
        ->where('tipo_detalle',1)
        ->first();
    
        $sub_bodega = SubDetalles::where('id_propiedad', $id)
        ->where('tipo_detalle',2)
        ->first();

    
        return view('trabajador/propiedadesDetallestrabajador', compact('arriendos','comision','estados','doc','arrendatario','mantenimiento','sub_bodega','sub_est','videos','new_Propietarios','detalles', 'imagen', 'propietarios', 'detallespropiedad','precios'));
    }


 //////////////////////////////// OBRERO ////////////////////////////////////////
 public function indexObrero()
 {
     //  $propiedades = Propiedad::all(); 
     $propietarios = Propietario::all();
     // $propiedades = Propiedad::with('imagenes')->where('estado', 1)->where('tipo_propiedad',1)->get();
     $propiedades = Propiedad::with(['imagenes', 'detallePropiedad'])
     ->where('estado', 1)
     ->where('tipo_propiedad', 1)
     ->get()
     ->map(function ($propiedad) {
         $propiedad->mostrar_boton = $propiedad->detallePropiedad && $propiedad->detallePropiedad->ano_construccion === null;
         return $propiedad;
     });
     // $propiedades = ImgPropiedad::with('imagen_url')->get();
     // $propiedades = Propiedad::with('imagen_url')->get();
     $propiedad = $propiedades->first(); // Obtiene la primera propiedad

     // $mostrarBoton = $detalles && $detalles->ano_construccion === null;


     return view('obrero.propiedades', compact('propiedades', 'propietarios'));
 }
 
 public function obreropropiedadesDetalles($id)
 {
     $detalles = Propiedad::find($id);
     $imagen = ImgPropiedad::where('id_propiedad', $id)->get();
     $videos = VidArriendo::where('id_propiedad', $id)->get();
     $propietarios = Propietario_propiedades::where('id_propiedad', $id)->get();
     $precios = Precios::where('id_propiedad',$id)->first();
     $mantenimiento = Mantenimiento::where('id_propiedad', $id)->get();

     $detallespropiedad = DetallePropiedad::where('id_propiedad', $id)->first();
     $new_Propietarios = Propietario::whereNotIn('id', function ($query) use ($id) {
         $query->select('id_propietario')
               ->from('propietario_propiedades')
               ->where('id_propiedad', $id); // Filtrar según la ID específica
     })->get();
     
     $sub_est = SubDetalles::where('id_propiedad', $id)
     ->where('tipo_detalle',1)
     ->first();
 
     $sub_bodega = SubDetalles::where('id_propiedad', $id)
     ->where('tipo_detalle',2)
     ->first();

    $arrendatario = Arrendatario::where('estado', 1)->get();
    $estados = EstadoPagos::all();
    $comision = Comision::all();

    $doc = ArchivoPropiedad::where('id_propiedad',$id)->first();

    $arriendos = Arriendo::where('id_propiedad', $id)->where('estado',1)->orderBy('fecha_entrega', 'desc')->get();
    
 
     return view('obrero/propiedadesDetallesObrero', compact('arriendos','comision','estados','doc','arrendatario','mantenimiento','sub_bodega','sub_est','videos','new_Propietarios','detalles', 'imagen', 'propietarios', 'detallespropiedad','precios'));
 }
    /////////////////// PROPIEDAD DETALLES ///////////////////////////////////////
 

            /////////////////// PROPIEDAD DETALLES ///////////////////////////////////////
            public function proanocorridopropiedadesDetallesObrero($id)
            {
                $detalles = Propiedad::find($id);
                $imagen = ImgPropiedad::where('id_propiedad', $id)->get();
                $videos = VidArriendo::where('id_propiedad', $id)->get();
                $mantenimiento = Mantenimiento::where('id_propiedad', $id)->get();
                $propietarios = Propietario_propiedades::where('id_propiedad', $id)->get();
        
                $sub_est = SubDetalles::where('id_propiedad', $id)
                ->where('tipo_detalle',1)
                ->first();
            
                $sub_bodega = SubDetalles::where('id_propiedad', $id)
                ->where('tipo_detalle',2)
                ->first();
        
                $precios = Precios::where('id_propiedad', $id)->first();
        
                $arrendatario = Arrendatario::where('estado', 1)->get();
                $estados = EstadoPagos::all();
                $comision = Comision::all();

                $doc = ArchivoPropiedad::where('id_propiedad',$id)->first();

                $arriendos = Arriendo::where('id_propiedad', $id)->where('estado',1)->orderBy('fecha_entrega', 'desc')->get();
                
        
                $detallespropiedad = DetallePropiedad::where('id_propiedad', $id)->first();
        
                $new_Propietarios = Propietario::whereNotIn('id', function ($query) use ($id) {
                    $query->select('id_propietario')
                        ->from('propietario_propiedades')
                        ->where('id_propiedad', $id); // Filtrar según la ID específica
                })->get();
        
                return view('obrero.detalleano', compact('arriendos','comision','estados','doc','arrendatario','mantenimiento','sub_bodega','sub_est','videos', 'new_Propietarios', 'detalles', 'imagen', 'propietarios', 'detallespropiedad', 'precios'));
            }
    public function edicionDetallesObrero(Request $request){
        $id_propiedad = $request->id_propiedad;

        $ciudad = Propiedad::where('id',$id_propiedad)->first();
        $ciudad->direccion = $request->direccion;
        $ciudad->condominio = $request->condominio;
        $ciudad->tipo_vivienda = $request->tipo_vivienda;
        $ciudad->num_estacionamiento = $request->estacionamiento;
        $ciudad->torre = $request->torre;
        $ciudad->num_torre = $request->numero_torre;
        $ciudad->bodega = $request->bodega;
        $ciudad->rol = $request->rol;
        $ciudad->empresa_luz = $request->empresa_luz;
        $ciudad->empresa_gas = $request->empresa_gas;
        $ciudad->empresa_agua = $request->empresa_agua;
        $ciudad->numero_luz = $request->numero_luz;
        $ciudad->numero_gas = $request->numero_gas;
        $ciudad->numero_agua = $request->numero_agua;
        $ciudad->mantenimiento = $request->mantenimiento;
        $ciudad->reajuste_anual = $request->reajuste;
        $ciudad->maps = $request->mapa;


        $ciudad->save();

        $preciosEdit = Precios::where('id_propiedad',$id_propiedad)->first();
        $preciosEdit->diciembre = $request->diciembre;
        $preciosEdit->ano_corrido = $request->ano_corrido;
        $preciosEdit->save();
        $detallesEdit = Detallepropiedad::where('id_propiedad', $id_propiedad)->first();

        if ($detallesEdit) {
            // Recorremos cada campo a actualizar y verificamos si el valor no es null
            $detallesEdit->ano_construccion = $request->ano_construccion ?? $detallesEdit->ano_construccion;
            $detallesEdit->piso = $request->piso ?? $detallesEdit->piso;
            $detallesEdit->dormitorios = $request->dormitorios ?? $detallesEdit->dormitorios;
            $detallesEdit->banos = $request->banos ?? $detallesEdit->banos;
            $detallesEdit->orientacion = $request->orientacion ?? $detallesEdit->orientacion;
            $detallesEdit->cocina = $request->cocina ?? $detallesEdit->cocina;
            $detallesEdit->logia = $request->logia ?? $detallesEdit->logia;
            $detallesEdit->agua_caliente = $request->agua_caliente ?? $detallesEdit->agua_caliente;
            $detallesEdit->espacio_lavadora = $request->espacio_lavadora ?? $detallesEdit->espacio_lavadora;
            $detallesEdit->lavadora = $request->lavadora ?? $detallesEdit->lavadora;
            $detallesEdit->inventario = $request->inventario ?? $detallesEdit->inventario;
            $detallesEdit->mt2_construido = $request->mt2_construido ?? $detallesEdit->mt2_construido;
            $detallesEdit->mt2_terraza = $request->mt2_terraza ?? $detallesEdit->mt2_terraza;
            $detallesEdit->mt2_total = $request->mt2_total ?? $detallesEdit->mt2_total;
            $detallesEdit->estacionamiento_visitas = $request->estacionamiento_visita ?? $detallesEdit->estacionamiento_visitas;
            $detallesEdit->ascensor = $request->ascensor ?? $detallesEdit->ascensor;
            $detallesEdit->juegos_infantiles = $request->juegos_infantiles ?? $detallesEdit->juegos_infantiles;
            $detallesEdit->lavanderia = $request->lavanderia ?? $detallesEdit->lavanderia;
            $detallesEdit->quinchos = $request->quinchos ?? $detallesEdit->quinchos;
            $detallesEdit->sala_multiuso = $request->sala_multiuso ?? $detallesEdit->sala_multiuso;
            $detallesEdit->gimnasio = $request->gimnasio ?? $detallesEdit->gimnasio;
            $detallesEdit->ciclovia = $request->ciclovia ?? $detallesEdit->ciclovia;
        
            // Guardamos los cambios
            $detallesEdit->save();
        }
        

        if ($request->file('imagenes') != null) {
            // Guardar las imágenes en la carpeta pública y la información en la base de datos
            foreach ($request->file('imagenes') as $imagenFile) {
                // Guardar la imagen en la carpeta pública
                $imageName = time() . '_' . $imagenFile->getClientOriginalName();
                $imagenPath = $imagenFile->storeAs('images', $imageName, 'public');

                // Guardar la información de la imagen en la base de datos
                $imagen = new ImgPropiedad();
                $imagen->nombre = $request->rol;
                $imagen->link = '/storage/public/' . $imagenPath; // Guardamos solo la ruta de la imagen
                $imagen->id_propiedad = $ciudad->id; // Asignar el ID del detalle de venta
                $imagen->save();
            }
        }
        if ($request->hasFile('videos')) {
            // Obtener el archivo de video del formulario
            $videoFile = $request->file('videos');
    
            // Guardar el video en la carpeta pública
            $videoName = time() . '_' . $videoFile->getClientOriginalName();
            $videoPath = $videoFile->storeAs('videos', $videoName, 'public');
    
            // Guardar la información del video en la base de datos
            $video = new VidArriendo;
            $video->video = '/storage/public/' . $videoPath; // Guardamos solo la ruta del video
            $video->id_propiedad = $ciudad->id;
            $video->estado = 1; // Asignar el ID del detalle de venta
            $video->save();
        }

        // Decodificar la cadena JSON a un array asociativo
        $PropietariosAgregados = json_decode($request->PropietariosAgregados, true);
        // dd($request->all());

        // Verificar si hay propietario agregados en la solicitud y procesarlos
        if (!empty($PropietariosAgregados)) {
            foreach ($PropietariosAgregados as $propietario) {
                // Crear una nueva instancia de CategoriaVenta para cada propietario agregado
                $new_Propietario = new Propietario_propiedades;
                // Asignar los valores del propietario desde la solicitud
                $new_Propietario->id_propiedad = $ciudad->id;
                $new_Propietario->id_propietario = $propietario['id']; // Acceder a 'id' del propietario
                // Guardar el propietario
                $new_Propietario->save();
            }
        }
        

        return Response()->json([
            'propiedad_editada' => $ciudad,
            'precios_editados' => $preciosEdit,
            'detalles_editados' => $detallesEdit
        ]);


    }

    public function cambiarImgObrero($id){
    // Encuentra la imagen seleccionada
    $imagenSeleccionada = ImgPropiedad::find($id);

    if (!$imagenSeleccionada) {
        return response()->json(['error' => 'Imagen no encontrada'], 404);
    }

    // Encuentra la primera imagen (según el menor id) para el mismo id_venta
    $imagenPortadaNueva = ImgPropiedad::where('id_propiedad', $imagenSeleccionada->id_propiedad)
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
public function PropietarioDeleteObrero($idPropietario){
    $propietarioDelete = Propietario_propiedades::findOrFail($idPropietario);
    $propietarioDelete->delete();

}

 ///////////////////////// PROPIEDADES EN VENTA OBRERO ///////////////// 
 public function indexVenta_obrero()
 {
     $propiedadesVenta = Propiedad::where('estado', 1)
         ->where('tipo_propiedad', 2)
         ->with('imagenes')
         ->get();
     $propietarioVenta = Propietario::all();
     // $comision = Comision::all();

     return view('/obrero.propiedades-venta', compact('propiedadesVenta', 'propietarioVenta'));
 }
 public function vender($idPropiedad){
    $vendida = Propiedad::where('id',$idPropiedad)->first();
    $vendida->estado_venta = 0;
    $vendida->save();

    return Response()->json(['success' => 'Propiedad vendidad correctamente']);
 }

 // Guardar video de propiedad venta (AJAX inmediato)
    public function guardarVideoVenta(Request $request)
    {
        $videoFile = $request->file('videos');
        $ext       = $videoFile->getClientOriginalExtension() ?: 'mp4';
        $videoName = time() . '_video.' . $ext;
        $videoPath = $videoFile->storeAs('videos', $videoName, 'public');
 
        $video = new VidArriendo();
        $video->video        = '/storage/' . $videoPath;
        $video->id_propiedad = $request->Id;
        $video->estado       = 1;
        $video->save();
 
        return response()->json([
            'success' => true,
            'id'      => $video->id,
            'url'     => asset('storage/' . $videoPath),
            'message' => 'Video guardado correctamente',
        ]);
    }
 
    // Guardar inventario de propiedad venta (AJAX inmediato)
    public function guardarInventarioVenta(Request $request, $idPropiedad)
    {
        if (!$request->hasFile('inventario')) {
            return response()->json(['success' => false, 'message' => 'No se recibió archivo'], 400);
        }
 
        $file     = $request->file('inventario');
        $ext      = $file->getClientOriginalExtension() ?: 'pdf';
        $fileName = time() . '_inventario.' . $ext;
        $filePath = $file->storeAs('inventario', $fileName, 'public');
 
        $archivo = ArchivoPropiedad::firstOrNew(['id_propiedad' => $idPropiedad]);
        $archivo->id_propiedad = $idPropiedad;
        $archivo->inventario   = '/storage/' . $filePath;
        $archivo->save();
 
        return response()->json([
            'success' => true,
            'url'     => asset('storage/' . $filePath),
            'nombre'  => $file->getClientOriginalName(),
            'message' => 'Inventario guardado correctamente',
        ]);
    }
 
    // Guardar documento adicional de propiedad venta (AJAX inmediato)
    public function guardarDocumentoVenta(Request $request, $idPropiedad)
    {
        if (!$request->hasFile('documento')) {
            return response()->json(['success' => false, 'message' => 'No se recibió archivo'], 400);
        }
 
        $file     = $request->file('documento');
        $ext      = $file->getClientOriginalExtension() ?: 'pdf';
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('archivospro', $fileName, 'public');
 
        $nuevo = new ArchivoPropiedad();
        $nuevo->id_propiedad = $idPropiedad;
        $nuevo->archivo      = '/storage/' . $filePath;
        $nuevo->save();
 
        return response()->json([
            'success' => true,
            'id'      => $nuevo->id,
            'url'     => asset('storage/' . $filePath),
            'nombre'  => $file->getClientOriginalName(),
            'message' => 'Documento guardado correctamente',
        ]);
    }
    
private function valorValido($valor): bool
{
    return $valor !== null && $valor !== 'undefined';
}

public function editarMantenimiento(Request $request, $id)
{
    $mante = Mantenimiento::findOrFail($id);
    $mante->nombre = $request->nombre;
    $mante->descripcion = $request->descripcion;
    $mante->fecha_mantencion = $request->fecha;
    $mante->meses = $request->meses;
    $mante->fecha_prox_man = $request->proxima_fecha;

    $docUrl = null;
    if ($request->hasFile('doc')) {
        $archivo = $request->file('doc');
        $nombre = time() . '_' . $archivo->getClientOriginalName();
        $ruta = $archivo->storeAs('mantenciones', $nombre, 'public');
        $mante->doc = $ruta;
        $docUrl = '/storage/' . $ruta;
    }

    $mante->save();

    return response()->json([
        'message' => 'Mantenimiento actualizado',
        'doc_url' => $docUrl
    ]);
}

public function eliminarDocumentoPropiedad(Request $request, $id)
{
    $archivo = ArchivoPropiedad::findOrFail($id);
    $tipo = $request->tipo;

    $campo = match($tipo) {
        'inventario' => 'inventario',
        'acta'       => 'acta_entrega',
        'contrato'   => 'contrato',
        'poder'      => 'poder_adm',
        default      => null,
    };

    if (!$campo) {
        return response()->json(['error' => 'Tipo inválido'], 400);
    }

    // Eliminar archivo físico si existe
    if ($archivo->$campo) {
        $path = str_replace('/storage/public/', '', $archivo->$campo);
        Storage::disk('public')->delete($path);
    }

    $archivo->$campo = null;
    $archivo->save();

    return response()->json(['message' => 'Documento eliminado correctamente']);

}
public function guardarMantencion(Request $request)
{
    $rutaDocumento = null;

    if($request->hasFile('archivo'))
    {
        $archivo = $request->file('archivo');

        $nombre = time().'_'.$archivo->getClientOriginalName();

        $archivo->move(
            public_path('mantenimientos'),
            $nombre
        );

        $rutaDocumento =
            'mantenimientos/'.$nombre;
    }

    Mantenimiento::create([
        'nombre'           => $request->nombre,
        'descripcion'      => $request->descripcion,
        'fecha_mantencion' => $request->fecha_mantencion,
        'fecha_prox_man'   => $request->fecha_proxima,
        'meses'            => 0,
        'envio_correo'     => 0,
        'doc'              => $rutaDocumento,
        'id_propiedad'     => $request->id_propiedad
    ]);

    return response()->json([
        'success' => true
    ]);
}

}