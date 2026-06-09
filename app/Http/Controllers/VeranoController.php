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
        foreach ($propiedadesVerano as $propiedad) {
            $propiedad->mostrarBoton = $propiedad->detallesVeranos->isEmpty() ||
                $propiedad->detallesVeranos->where('status', 1)->isNotEmpty();
        }
        $propiedad = $propiedadesVerano->first();
        return view("verano", compact('propietarios', 'propiedadesVerano', 'propiedad'));
    }

    public function Guardarverano(Request $request)
    {
        $propiedad = new Verano();
        $propiedad->direccion        = $request->direccion;
        $propiedad->ciudad           = $request->ciudad;
        $propiedad->sector           = $request->sector;
        $propiedad->condominio       = $request->condominio;
        $propiedad->torre            = $request->torre;
        $propiedad->num_apartamento  = $request->num_apartamento;
        $propiedad->piso             = $request->piso;
        $propiedad->ubicacion        = $request->ubicacion;
        $propiedad->dormitorios      = $request->dormitorios;
        $propiedad->Tpiso_dormitorios = $request->Tpiso_dormitorios;
        $propiedad->baños            = $request->baños;
        $propiedad->tipo_cocina      = $request->tipo_cocina;
        $propiedad->personas         = $request->personas;
        $propiedad->precio_min_enero = $request->precio_min_enero;
        $propiedad->precio_max_enero = $request->precio_max_enero;
        $propiedad->precio_min_febrero = $request->precio_min_febrero;
        $propiedad->precio_max_febrero = $request->precio_max_febrero;
        $propiedad->equipado         = $request->equipado;
        $propiedad->valor_adicional  = $request->valor_adicional;
        $propiedad->estado           = 1;
        $propiedad->save();

        $new_detalles_vera = new DetallesVerano();
        $new_detalles_vera->id_verano = $propiedad->id;
        $new_detalles_vera->status    = 1;
        $new_detalles_vera->save();

        $PropietariosAgregados = json_decode($request->PropietariosAgregados, true);
        if (!empty($PropietariosAgregados)) {
            foreach ($PropietariosAgregados as $propietario) {
                $newPropietarioPropiedad = new PropietarioVerano;
                $newPropietarioPropiedad->id_verano     = $propiedad->id;
                $newPropietarioPropiedad->id_propietario = $propietario['id'];
                $newPropietarioPropiedad->save();
            }
        }

        return response()->json(['message' => $propiedad]);
    }

    public function guardarDetalles(Request $request, $id)
    {
        $id = $request->id;
        $request->validate([
            'piscina'          => 'required|string',
            'ascensor'         => 'required|string',
            'juegos_infantiles' => 'required|string',
            'servi_lavanderia' => 'required|string',
            'quinchos'         => 'required|string',
            'sala_multiuso'    => 'required|string',
            'terraza'          => 'required|string',
        ]);

        $new_detalles_vera = DetallesVerano::where('id_verano', $id)->first();
        $new_detalles_vera->wifi              = $request->input('wifi', 0);
        $new_detalles_vera->cable             = $request->input('cable', 0);
        $new_detalles_vera->lavadora          = $request->input('lavadora', 0);
        $new_detalles_vera->sabanas           = $request->input('sabanas', 0);
        $new_detalles_vera->piscina           = $request->piscina;
        $new_detalles_vera->estacionamientos  = $request->estacionamientos;
        $new_detalles_vera->num_estaciona     = $request->num_estaciona;
        $new_detalles_vera->Consergeria       = $request->Consergeria;
        $new_detalles_vera->ascensor          = $request->ascensor;
        $new_detalles_vera->juegos_infantiles = $request->juegos_infantiles;
        $new_detalles_vera->servi_lavanderia  = $request->servi_lavanderia;
        $new_detalles_vera->quinchos          = $request->quinchos;
        $new_detalles_vera->sala_multiuso     = $request->sala_multiuso;
        $new_detalles_vera->terraza           = $request->terraza;
        $new_detalles_vera->status            = 0;
        $new_detalles_vera->id_verano         = $id;
        $new_detalles_vera->save();

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $image) {
                $extension = $image->getClientOriginalExtension() ?: $image->extension();
                $imageName  = time() . '_' . uniqid() . '.' . $extension;
                $imagenPath = $image->storeAs('images', $imageName, 'public');
                $imagen = new ImgVerano();
                $imagen->nombre           = $imageName;
                $imagen->link             = '/storage/' . $imagenPath;
                $imagen->id_detalles_verano = $new_detalles_vera->id;
                $imagen->save();
            }
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Datos guardados correctamente',
            'data'    => $new_detalles_vera
        ]);
    }

    public function propiedadesVeraDetalles($id)
    {
        $propiedadVe     = Verano::with(['detallesVeranos.imagenes', 'detallesVeranos.videos'])->find($id);
        $propietarios    = PropietarioVerano::where('id_verano', $id)->get();
        $new_Propietarios = Propietario::whereNotIn('id', function ($query) use ($id) {
            $query->select('id_propietario')
                  ->from('propietario_verano')
                  ->where('id_verano', $id);
        })->get();

        if (!$propiedadVe) {
            return redirect()->back()->with('error', 'Detalle no encontrado.');
        }

        $detalle  = $propiedadVe->detallesVeranos->first() ?: null;
        $imagenes = $detalle ? $detalle->imagenes : null;
        $videos   = $detalle ? $detalle->videos   : null;
        $proverano = Verano::where('estado', 1)->get();

        return view('propiedadesVeranoDetalles', compact(
            'propiedadVe', 'new_Propietarios', 'propietarios',
            'imagenes', 'detalle', 'videos', 'proverano'
        ));
    }

    public function PropietariosAgregadosVe(Request $request)
    {
        $propietarioId = $request->input('nombre_pro');
        $propietario   = Propietario::find($propietarioId);
        if ($propietario) {
            return response()->json(['nombre' => $propietario->nombre]);
        }
        return response()->json(['error' => 'propietario no encontrado'], 404);
    }

    public function PropietarioVeraDelete($idPropietario)
    {
        $propietarioVeraDelete = PropietarioVerano::findOrFail($idPropietario);
        $propietarioVeraDelete->delete();
    }

    public function cambiarImg($id)
    {
        $imagenSeleccionada = ImgVerano::find($id);
        if (!$imagenSeleccionada) {
            return response()->json(['error' => 'Imagen no encontrada'], 404);
        }

        $imagenPortadaNueva = ImgVerano::where('id_detalles_verano', $imagenSeleccionada->id_detalles_verano)
            ->orderBy('id', 'asc')
            ->first();

        if ($imagenPortadaNueva && $imagenPortadaNueva->id != $imagenSeleccionada->id) {
            $rutaSeleccionada            = $imagenSeleccionada->link;
            $imagenSeleccionada->link    = $imagenPortadaNueva->link;
            $imagenSeleccionada->save();
            $imagenPortadaNueva->link    = $rutaSeleccionada;
            $imagenPortadaNueva->save();
        }

        return response()->json(['success' => 'Imagen portada actualizada']);
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->Id;

            // Reemplaza el bloque de propiedadVe->save() por esto:
            $propiedadVe = Verano::where('id', $id)->first();
            if ($request->has('direccion')) $propiedadVe->direccion = $request->direccion;
            if ($request->has('ciudad'))    $propiedadVe->ciudad    = $request->ciudad;
            if ($request->has('sector'))    $propiedadVe->sector    = $request->sector;
            if ($request->has('condominio')) $propiedadVe->condominio = $request->condominio;
            if ($request->has('torre'))     $propiedadVe->torre     = $request->torre;
            if ($request->has('num_apartamento')) $propiedadVe->num_apartamento = $request->num_apartamento;
            if ($request->has('piso'))      $propiedadVe->piso      = $request->piso;
            if ($request->has('personas'))  $propiedadVe->personas  = $request->personas;
            if ($request->has('ubicacion')) $propiedadVe->ubicacion = $request->ubicacion;
            if ($request->has('dormitorios')) $propiedadVe->dormitorios = $request->dormitorios;
            if ($request->has('Tpiso_dormitorios')) $propiedadVe->Tpiso_dormitorios = $request->Tpiso_dormitorios;
            if ($request->has('baños'))     $propiedadVe->baños     = $request->baños;
            if ($request->has('tipo_cocina')) $propiedadVe->tipo_cocina = $request->tipo_cocina;
            if ($request->has('precio_min_enero')) $propiedadVe->precio_min_enero = $request->precio_min_enero;
            if ($request->has('precio_max_enero')) $propiedadVe->precio_max_enero = $request->precio_max_enero;
            if ($request->has('precio_min_febrero')) $propiedadVe->precio_min_febrero = $request->precio_min_febrero;
            if ($request->has('precio_max_febrero')) $propiedadVe->precio_max_febrero = $request->precio_max_febrero;
            if ($request->has('equipado'))  $propiedadVe->equipado  = $request->equipado;
            if ($request->has('mascotas'))  $propiedadVe->mascotas  = $request->mascotas;
            if ($request->has('valor_adicional')) $propiedadVe->valor_adicional = $request->valor_adicional;
            $propiedadVe->save();

            // Y lo mismo para detalles:
            $detalle = DetallesVerano::where('id_verano', $id)->first();
            if ($request->has('num_estaciona')) $detalle->num_estaciona = $request->num_estaciona;
            if ($request->has('wifi'))     $detalle->wifi     = $request->input('wifi', 0);
            if ($request->has('cable'))    $detalle->cable    = $request->input('cable', 0);
            if ($request->has('lavadora')) $detalle->lavadora = $request->input('lavadora', 0);
            if ($request->has('sabanas'))  $detalle->sabanas  = $request->input('sabanas', 0);
            if ($request->has('piscina'))  $detalle->piscina  = $request->piscina;
            if ($request->has('Consergeria')) $detalle->Consergeria = $request->Consergeria;
            if ($request->has('ascensor')) $detalle->ascensor = $request->ascensor;
            if ($request->has('gimnasio')) $detalle->gimnasion = $request->gimnasio;
            if ($request->has('juegos_infantiles')) $detalle->juegos_infantiles = $request->juegos_infantiles;
            if ($request->has('servi_lavanderia'))  $detalle->servi_lavanderia  = $request->servi_lavanderia;
            if ($request->has('quinchos'))    $detalle->quinchos    = $request->quinchos;
            if ($request->has('sala_multiuso')) $detalle->sala_multiuso = $request->sala_multiuso;
            if ($request->has('terraza'))   $detalle->terraza   = $request->terraza;

            $PropietariosAgregados = json_decode($request->PropietariosAgregados, true);
            if (!empty($PropietariosAgregados)) {
                foreach ($PropietariosAgregados as $propietario) {
                    $new_Propietario                = new PropietarioVerano();
                    $new_Propietario->id_verano     = $propiedadVe->id;
                    $new_Propietario->id_propietario = $propietario['id'];
                    $new_Propietario->save();
                }
            }

            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $index => $image) {
                    $extension = $image->getClientOriginalExtension() ?: $image->extension();
                    $imageName  = time() . '_' . uniqid() . '.' . $extension;
                    $imagenPath = $image->storeAs('images', $imageName, 'public');
                    
                    if (!$imagenPath) {
                        throw new \Exception('No se pudo guardar la imagen: ' . $imageName);
                    }
                    
                    $imagen = new ImgVerano();
                    $imagen->nombre             = $imageName;
                    $imagen->link               = '/storage/' . $imagenPath;
                    $imagen->id_detalles_verano = $detalle->id;
                    $imagen->save();
                }
            }

            // Documentos y video en DetallesVerano
            if ($request->hasFile('inventario')) {
                $f    = $request->file('inventario');
                $name = time() . '_' . $f->getClientOriginalName();
                $path = $f->storeAs('inventario', $name, 'public');
                $detalle->inventario = '/storage/' . $path;
            }
            if ($request->hasFile('acta')) {
                $f    = $request->file('acta');
                $name = time() . '_' . $f->getClientOriginalName();
                $path = $f->storeAs('acta', $name, 'public');
                $detalle->acta_entrega = '/storage/' . $path;
            }
            if ($request->hasFile('videos')) {
                $videoFile = $request->file('videos');
                // Limpiar nombre
                $extension = $videoFile->getClientOriginalExtension();
                $videoName = time() . '_video.' . $extension;
                $videoPath = $videoFile->storeAs('videos', $videoName, 'public');
                $nuevoVideo->link = '/storage/' . $videoPath;
                $nuevoVideo->id_detalles_verano = $detalle->id;
                $nuevoVideo->save();
            }
            $detalle->save();

            DB::commit();
            return response()->json(['message' => 'Propiedad actualizada con éxito'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al actualizar la propiedad', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $imagen = ImgVerano::findOrFail($id);
        if (file_exists(public_path($imagen->link))) {
            unlink(public_path($imagen->link));
        }
        $imagen->delete();
        return redirect()->back()->with('success', 'Imagen eliminada correctamente.');
    }

    public function deletePropiedadVera(Request $request, $id)
    {
        $propietario = Verano::where('id', $id)->firstOrFail();
        $propietario->estado = 0;
        $propietario->save();
        return response()->json(['success' => 'El estado del propietario se ha Borrado con éxito']);
    }

    public function index_verano_obrero()
    {
        $propiedadesVerano = Verano::with(['detallesVeranos.imagenes'])->where('estado', 1)->get();
        $propietarios = Propietario::all();
        foreach ($propiedadesVerano as $propiedad) {
            $propiedad->mostrarBoton = $propiedad->detallesVeranos->isEmpty();
        }
        $propiedad = $propiedadesVerano->first();
        return view("/obrero.verano", compact('propietarios', 'propiedadesVerano', 'propiedad'));
    }

    public function guardarVideoVerano(Request $request)
    {
        $id = $request->Id;
        $detalle = \App\Models\DetallesVerano::where('id_verano', $id)->first();

        if ($request->hasFile('videos')) {
            $videoFile = $request->file('videos');
            
            // Limpiar el nombre del archivo - ESTO ES LO QUE FALTABA
            $extension = $videoFile->getClientOriginalExtension();
            $videoName = time() . '_video.' . $extension;
            
            $videoPath = $videoFile->storeAs('videos', $videoName, 'public');

            $nuevoVideo = new \App\Models\videoVerano();
            $nuevoVideo->nombre = $videoName;
            $nuevoVideo->link = '/storage/' . $videoPath;
            $nuevoVideo->id_detalles_verano = $detalle->id;
            $nuevoVideo->save();
        }

        return response()->json(['success' => true]);
    }
    public function eliminarVideoVerano($id)
    {
        $video = \App\Models\videoVerano::findOrFail($id);
        
        // Eliminar el archivo físico
        $path = public_path($video->link);
        if (file_exists($path)) {
            unlink($path);
        }
        
        $video->delete();
        
        return response()->json(['success' => true]);
    }
}