<?php

use App\Http\Controllers\GasfiteriaController;
use App\Http\Controllers\ObrasMayoresController;
use App\Http\Controllers\ObrasMenoresController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ComisionController;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\ElementosController;
use App\Http\Controllers\ArrendatarioController;
use App\Http\Controllers\ArriendoController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\PropiedadesVentaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DetallesVeranoController;
use App\Http\Controllers\VeranoController;
use App\Http\Controllers\ServtecLineaBlancaController;
use App\Models\Arriendo;
use App\Models\Comision;
use App\Models\Pagos;
use App\Models\PropiedadesVenta;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PlanillaEmpresaController;
use App\Models\PlanillaEmpresa;
use App\Http\Controllers\GraficosController;
use App\Models\GraficoEmpresa;
use App\Http\Controllers\RrhhController;
use App\Models\ArchivoRrhh;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/plantilla', function () {
    return view('plantilla');
});

Route::middleware(['auth', 'admin'])->group(function () {
        ///////////////////BUSCAR DATOS//////////////////////
    Route::get('/api/arrendatario/{id}', [ContratoController::class, 'getArrendatario']);
    Route::get('/api/propietario/{id}', [ContratoController::class, 'getPropietario']);
    
    ///////////// PROPIEDADES DETALLES /////////
    Route::get('/propiedadesDetalles-{id}',[PropiedadController::class,'propiedadesDetalles'])->name('admin.propiedadesDetalles');

    ////////// RUTAS DASHBOARD //////////
    Route::get('/dashboard', [HomeController::class, 'index']);

    ////////// RUTAS COMISION //////////
    Route::get('/comision', [ComisionController::class, 'index']);
    Route::post('/comision/add_comision', [ComisionController::class, 'addComision']);
    Route::get('/comision/editar/{idComision}', [ComisionController::class, 'datosComision']);
    Route::post('/comision/add_editar_comision', [ComisionController::class, 'addEditComision']);
    Route::delete('/comision/eliminar/{idComision}',[ComisionController::class,'eliminarComision']);

    ////////// RUTAS PROPIETARIOS //////////
    Route::get('/propietarios', [PropietarioController::class, 'index']);
    Route::post('/propietariosadd', [PropietarioController::class, 'add']);
    Route::get('/propietarios/{id}', [PropietarioController::class, 'show']);
    Route::post('/propietarios/{id}', [PropietarioController::class, 'update'])->name('propietario.update');
    Route::patch('/propietarioestado/{id}', [PropietarioController::class,'delete']);
    Route::get('/Mostrar/cuenta/{id_cuenta}', [PropietarioController::class,'mostrarDatosBancarios']);
    Route::get('/cuentas/editar_cuenta/{id_cuenta}', [PropietarioController::class,'showcuenta']);
    Route::post('/cuentaEditar/guardar/{id}', [PropietarioController::class, 'updateCuenta'])->name('DatosBancario.update');
    Route::delete('/cuenta/eliminar/{id_cuenta}',[PropietarioController::class,'eliminarcuenta']);
    Route::post('/Nueva/cuenta2aad', [PropietarioController::class, 'addNuevaCuenta']);

    Route::get('/propietario/{id}/detalles', [PropietarioController::class, 'detalles'])->name('propietario.detalles');
    
    ////////// RUTAS ELEMENTOS //////////
    Route::get('/elementos', [ElementosController::class, 'index']);
    Route::post('/Elementosadd', [ElementosController::class, 'add']);
    Route::get('/elemento/editar/{id_elemento}', [ElementosController::class, 'show']);
    Route::post('/elementos/guadar_elementos', [ElementosController::class, 'addelemento']);
    Route::delete('/elemento/eliminar/{id_elemento}',[ElementosController::class,'deleteElement']);

    ////////// RUTAS ARRENDATARIOS //////////
    Route::get('/arrendatarios', [ArrendatarioController::class, 'index']);
    Route::post('/arrendatarios/add', [ArrendatarioController::class, 'addArrendatario']);
    Route::get('/arrendatarios/editar/{idArrendatario}', [ArrendatarioController::class, 'datosArrendatario']);
    Route::post('/arrendatarios/add_editar_arrendatario', [ArrendatarioController::class, 'addEditArrendatario']);
    Route::post('/arrendatarios/eliminar', [ArrendatarioController::class, 'eliminarArrendatario']);

    ////////// RUTAS PROPIEDADES //////////
    Route::get('/propiedades', [PropiedadController::class, 'index']);
    Route::post('/propiedades', [PropiedadController::class, 'add']);
    Route::get('/mostrar/archivo/{id_propiedad}', [PropiedadController::class,'mostrarArchivos']);
    Route::post('/archivos/guardar/{idPropiedad}', [PropiedadController::class, 'addArchivo2'])->name('archivos.guardar');
    Route::post('/imagen/cambiar/{ImagenId}', [PropiedadController::class, 'cambiarImagen']);
    Route::delete('/elimiarchivo/{archivoId}', [PropiedadController::class, 'destroy']);
    Route::delete('/propiedad/{id}', [PropiedadController::class, 'eliminarpro']);
    Route::post('/detallespropiedad/{id_propiedad}', [PropiedadController::class, 'addetalles'])->name('detallespropiedad.addetalles');
    // Route::get('/propiedadestodo/{id}', [PropiedadController::class, 'edit']);
    // Route::post('/propiedad/update/', [PropiedadController::class, 'Proupdate']);

    Route::get(' /obtener/propietarioNombre', [PropiedadController::class, 'PropietariosAgregados']);

    Route::post('/editarDetalles', [PropiedadController::class, 'edicionDetalles'])->name('propiedadesDetalles');

    Route::delete('/imagen/{idImg}', [PropiedadController::class, 'imgDelete']);
    Route::delete('/video/{idVideo}', [PropiedadController::class, 'videoDelete']);

    Route::post('/portada/cambiar_img/{id}', [PropiedadController::class, 'cambiarImg'])->name('admin.propiedadesDetalles');

    Route::delete('/propietarioDelete/{idPropietario}', [PropiedadController::class, 'PropietarioDelete']);

    Route::post('/arrendatarios/detalles', [ArrendatarioController::class, 'addArrendatariodetalles']);


    ////////// RUTAS GRAFICOS //////////
    Route::get('/graficos', [GraficosController::class, 'index'])
        ->name('graficos.index');

    Route::get('/graficos/mensual', [GraficosController::class, 'mensual'])
        ->name('graficos.mensual');

    Route::get('/graficos/mes/{año}/{mes}', [GraficosController::class, 'datosMesApi'])
        ->name('graficos.mes');

    Route::get('/graficos/anual/{año}', [GraficosController::class, 'datosAnualApi'])
        ->name('graficos.anual');

    Route::post('/graficos/guardar', [GraficosController::class, 'guardar'])
        ->name('graficos.guardar');

    ////////// RUTAS PAGOS //////////
    Route::get('/pagos', [PagosController::class, 'index']);
    Route::post('/pagos/add_pagos', [PagosController::class, 'addPagos']);
    Route::get('/pagos/editar/{idPago}', [PagosController::class, 'datosPagos']);
    Route::post('/pagos/add_editar_pagos', [PagosController::class, 'addEditPago']);
    Route::post('/pagos/eliminar', [PagosController::class, 'eliminarPago']);


    ////////// RUTAS RRHH //////////
    // Vista principal equipo
    Route::get('/rrhh/equipo',                      [RrhhController::class, 'index'])->name('rrhh.equipo');
    
    // CRUD Usuarios RRHH
    Route::get('/rrhh/usuario/{id}',               [RrhhController::class, 'show']);
    Route::post('/rrhh/usuario',                   [RrhhController::class, 'store']);
    Route::post('/rrhh/usuario/{id}',              [RrhhController::class, 'update']);   // POST con _method no es necesario; usamos POST directo para multipart
    Route::delete('/rrhh/usuario/{id}',            [RrhhController::class, 'destroy']);
    
    // Archivos adjuntos
    Route::delete('/rrhh/archivo/{id}',            [RrhhController::class, 'destroyArchivo']);
    
    // CRUD Cargos
    Route::get('/rrhh/cargos',                     [RrhhController::class, 'getCargos']);
    Route::post('/rrhh/cargo',                     [RrhhController::class, 'storeCargo']);
    Route::post('/rrhh/cargo/{id}',                [RrhhController::class, 'updateCargo']);
    Route::delete('/rrhh/cargo/{id}',              [RrhhController::class, 'destroyCargo']);

    ///////////////// RUTAS PROPIEDADES EN VENTA ////////////////
    Route::get('/propiedadesVenta', [PropiedadController::class, 'indexVenta']);
    Route::post('/propiedadesVenta/add_propiedad', [PropiedadController::class, 'addProVenta']);
    Route::post('/detallesVentaPropiedad/{idPropiedad}', [PropiedadController::class, 'addetallesVenta']);
    Route::post('/archivosVenta/guardar/{id_propiedad}', [PropiedadController::class, 'addArchivoVenta']);
    Route::delete('/propiedadVenta/{id}', [PropiedadController::class, 'eliminarproVenta']);
    Route::get('/obtener/propietarioVenta', [PropiedadController::class, 'PropietariosAgregados']);
    // rutas detalles propiedad en venta
    Route::get('/propiedadesVentaDetalles-{id}',[PropiedadController::class,'propiedadesVentaDetalles']);
    Route::post('/editarDetalles/Venta', [PropiedadController::class, 'edicionDetallesVenta']);
    Route::delete('/imagen/Venta/{idImg}', [PropiedadController::class, 'imgDelete']);
    Route::post('/portada/cambiar_img/Venta/{id}', [PropiedadController::class, 'cambiarImg']);
    Route::delete('/propietarioDelete/Venta/{idPropietario}', [PropiedadController::class, 'PropietarioDelete']);
    
    Route::post('/venderpropiedad{idPropiedad}', [PropiedadController::class, 'vender']);


    // Videos y archivos - Propiedades Venta
    Route::post('/propiedad_venta_video',                    [PropiedadController::class, 'guardarVideoVenta']);
    Route::post('/propiedad_venta_inventario/{idPropiedad}', [PropiedadController::class, 'guardarInventarioVenta']);
    Route::post('/propiedad_venta_documento/{idPropiedad}',  [PropiedadController::class, 'guardarDocumentoVenta']);
    Route::delete('/video_venta/{id}',                       [PropiedadController::class, 'videoDelete']);

    ////////// RUTAS CONTRATOS //////////
    Route::get('/contratos', [ContratoController::class, 'index'])->name('contratos.index');
    Route::get('arriendos', [ContratoController::class, 'create'])->name('contratos.create');
    Route::post('contratos', [ContratoController::class, 'store'])->name('contratos.store');
    Route::delete('/elimicontra/{contratoId}', [ContratoController::class, 'destroy']);

    ////////// RUTAS ARRIENDOS //////////
    Route::get('/arriendos', [ArriendoController::class, 'index']);
    Route::post('/arriendos/add_arriendos', [ArriendoController::class, 'addArriendo'])->name('arriendos.addArriendo');
    Route::get('/arriendos/editar/{idArriendo}', [ArriendoController::class, 'datosArriendo']);
    Route::post('/arriendos/add_editar_arriendos', [ArriendoController::class, 'addEditArriendo']);
    Route::post('/arriendos/eliminar', [ArriendoController::class, 'eliminarArriendo']);
    Route::get('/Mostrar/Archivo/{id_contrato}', [ArriendoController::class,'mostrarArchivos']);
    Route::delete('/elimicontra/{contratoId}', [ArriendoController::class, 'destroy']);
    Route::post('/archivos_guardar/{idArriendo}', [ArriendoController::class, 'addArchivo_arriendo'])->name('archivos.guardar');
    Route::get('/propiedades/{id}/valor-arriendo', [ArriendoController::class, 'getValorArriendo']);
    // Route::get('/propiedadesedit/{id}/valor-arriendo', [ArriendoController::class, 'getValorArriendo']);


    ////////////////////////////////CARGO////////////////////////
    Route::get('/cargos', [CargoController::class, 'index']);
    Route::post('/cargos/add_cargo', [CargoController::class, 'addCargo']);
    Route::get('/cargo/editar/{idCargo}', [CargoController::class, 'datoscargo']);
    Route::post('/cargo/add_editar_cargo', [CargoController::class, 'addCargoEditar']);
    Route::delete('/cargo/eliminar/{idCargo}',[CargoController::class,'eliminarCargo']);


    ////////////////////////////////USUARIO////////////////////////
    Route::get('/usuarios', [UserController::class, 'index']);
    Route::post('/usuarios/add_usuarios', [UserController::class, 'addUsuario']);
    Route::get('/usuarios/editar/{idUsuario}', [UserController::class, 'datosUsuario']);
    Route::post('/usuarios/add_editar_usuario', [UserController::class, 'addEditUsuario']);
    Route::delete('/usuarios/eliminar/{idUsuario}',[UserController::class,'eliminarUsuario']);
  
    //////////////////////////////// SUELDOS USUARIOS ////////////////////////
    Route::get('/sueldos', [UserController::class, 'indexSueldos']);
    Route::post('/usuarios/asignar_sueldo', [UserController::class, 'asignarSueldo']);
    Route::get('/sueldo_editar/{id}', [UserController::class, 'sueldosEdit']);
    Route::post('/sueldos/add_editar_sueldos', [UserController::class, 'GuardarSueldosEdit']);


    ////////////////////////////////INVENTARIO/////////////////////////////
    Route::get('inventario', [InventarioController::class, 'index'])->name('inventario.index');
    Route::post('inventario', [InventarioController::class, 'store']);
    Route::delete('inventario/{id}', [InventarioController::class, 'destroy'])->name('inventario.destroy');
    Route::post('/inventario/{id}/update', [InventarioController::class, 'update'])->name('inventario.update');


    ////////////////////////////////Full Calendar/////////////////////////////
    
    Route::get('/calendar', [EventController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [EventController::class, 'getEvents'])->name('calendar.getEvents'); 
    Route::post('/calendar/events', [EventController::class, 'store']); // Crear un nuevo evento
    Route::delete('/calendar/events/{id}', [EventController::class, 'destroy']); // Eliminar un evento

    Route::post('calendar/eventos/actualizar', [EventController::class, 'update'])->name('event.update');
    Route::post('/deleteevento/{idevento}', [EventController::class, 'destroyfecha'])->name('event.destroy');

    
    Route::post('/eventos/validar-fecha', [EventController::class, 'validarFecha']);
    Route::post('/eventos', [EventController::class, 'store']);
    Route::delete('/eventos/{id}', [EventController::class, 'destroy']);

    Route::get('/editevent/{idevento}', [EventController::class, 'editeventos'])->name('editeventos'); 
    Route::post('/eventos/actualizar', [EventController::class, 'guardaredit'])->name('guardaredit'); // Crear un nuevo evento


    ////////////////////////// VENTAS DE VERANO ////////////////////////////////////
    Route::get('/verano', [PropiedadController::class, 'indexVerano'])->name('verano.indexVerano');

    //////////////////////////////// RUTAS INVENTARIO/////////////////////////////
    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
    Route::post('/inventario', [InventarioController::class, 'store']);
    Route::delete('/inventario/{id}', [InventarioController::class, 'destroy'])->name('inventario.destroy');

    // ────────────────────────────────────────────────────────────────────────────
    // RUTAS PLANILLAS EMPRESA
    // ────────────────────────────────────────────────────────────────────────────

 
    // Vista principal
    Route::get('/plantilla', [PlanillaEmpresaController::class, 'index']);
    
    // API JSON usada por el frontend
    Route::get ('/planillas/listar',          [PlanillaEmpresaController::class, 'listar']);
    Route::post('/planillas/guardar',         [PlanillaEmpresaController::class, 'guardar']);
    Route::post('/planillas/editar',          [PlanillaEmpresaController::class, 'editar']);
    Route::delete('/planillas/eliminar/{id}', [PlanillaEmpresaController::class, 'eliminar']);
    Route::get('/planillas/grafico',          [PlanillaEmpresaController::class, 'datosGrafico']);

    ////////////////////////////////// PROPIEDADES DE VERANO ///////////////////////////
    Route::get('/verano', [VeranoController::class, 'index_verano'])->name('verano.verano');
    Route::post('/propiedades_verano', [VeranoController::class, 'Guardarverano'])->name('propiedades_verano.verano');
    Route::post('/propiedades_verano_detalles/{id}', [VeranoController::class, 'guardarDetalles']);
    Route::get('/propiedadesVeranoDetalles-{id}',[VeranoController::class,'propiedadesVeraDetalles'])->name('admin.propiedadesVeranoDetalles');
    Route::post('/property/update/{id}', [VeranoController::class, 'update'])->name('property.update');
    Route::delete('/imagenes/{id}', [VeranoController::class, 'destroy'])->name('imagenes.eliminar');
    Route::patch('/propiedadVeranoestado/{id}', [VeranoController::class,'deletePropiedadVera']);
    Route::get('/obtenerVe/propietarioVeNombre', [VeranoController::class, 'PropietariosAgregadosVe']);
    Route::delete('/propiedadverano/{idPropiedad}',[VeranoController::class,'deletepropiedad'])->name('admin.propiedadverano'); 
    Route::delete('/propietarioVeranoDelete/{idPropietario}', [VeranoController::class, 'PropietarioVeraDelete']);
    Route::post('/portadaVera/cambiar_imgen/{id}', [VeranoController::class, 'cambiarImg'])->name('admin.propiedadesVeranoDetalles');
    
    ////////////////////////////////Videos Verano/////////////////////////////
    Route::post('/propiedades_verano_video', [VeranoController::class, 'guardarVideoVerano']);
    Route::delete('/video-verano/{id}', [VeranoController::class, 'eliminarVideoVerano']);
    Route::get('/stream-video/{path}', function($path) {
        $filePath = storage_path('app/public/' . $path);
        
        if (!file_exists($filePath)) {
            abort(404);
        }
        
        $fileSize = filesize($filePath);
        $mimeType = mime_content_type($filePath);
        
        $start = 0;
        $end = $fileSize - 1;
        
        if (isset($_SERVER['HTTP_RANGE'])) {
            preg_match('/bytes=(\d+)-(\d*)/', $_SERVER['HTTP_RANGE'], $matches);
            $start = intval($matches[1]);
            $end = isset($matches[2]) && $matches[2] !== '' ? intval($matches[2]) : $fileSize - 1;
        }
        
        $length = $end - $start + 1;
        
        $headers = [
            'Content-Type'   => $mimeType,
            'Content-Length' => $length,
            'Accept-Ranges'  => 'bytes',
            'Content-Range'  => "bytes $start-$end/$fileSize",
        ];
        
        $statusCode = isset($_SERVER['HTTP_RANGE']) ? 206 : 200;
        
        return response()->stream(function() use ($filePath, $start, $length) {
            $handle = fopen($filePath, 'rb');
            fseek($handle, $start);
            $remaining = $length;
            while (!feof($handle) && $remaining > 0) {
                $chunk = min(8192, $remaining);
                echo fread($handle, $chunk);
                $remaining -= $chunk;
                flush();
            }
            fclose($handle);
        }, $statusCode, $headers);
    })->where('path', '.*');

    ////////////////////////////////SERVICIOS/////////////////////////////
    Route::get('/servicios', [ServtecLineaBlancaController::class, 'index']);

    Route::post('/agregarLN', [ServtecLineaBlancaController::class, 'agregarLN'])->name('servicios.agregarLN');   
    Route::post('/agregarGas', [GasfiteriaController::class, 'agregarGas'])->name('servicios.agregarGas');    
    Route::post('/agregarOMa', [ObrasMayoresController::class, 'agregarOMa'])->name('servicios.agregarOMa');   
    Route::post('/agregarOMe', [ObrasMenoresController::class, 'agregarOMe'])->name('servicios.agregarOMe'); 

    ////////////////////////////////SERVICIOS/////////////////////////////
    Route::get('/servicios', [ServtecLineaBlancaController::class, 'index']);

    Route::post('/agregarLN', [ServtecLineaBlancaController::class, 'agregarLN'])->name('servicios.agregarLN');   
    Route::post('/agregarGas', [GasfiteriaController::class, 'agregarGas'])->name('servicios.agregarGas');    
    Route::post('/agregarOMa', [ObrasMayoresController::class, 'agregarOMa'])->name('servicios.agregarOMa');   
    Route::post('/agregarOMe', [ObrasMenoresController::class, 'agregarOMe'])->name('servicios.agregarOMe');   


    Route::get('/conseguirLN/{id}', [ServtecLineaBlancaController::class, 'conseguirLN'])->name('servicios.conseguirLN');
    Route::get('/conseguirGas/{id}', [GasfiteriaController::class, 'conseguirGas'])->name('servicios.conseguirGas');
    Route::get('/conseguirOMa/{id}', [ObrasMayoresController::class, 'conseguirOMa'])->name('servicios.conseguirOMa');
    Route::get('/conseguirOMe/{id}', [ObrasMenoresController::class, 'conseguirOMe'])->name('servicios.conseguirOMe');

    Route::put('/editarLN/{id}', [ServtecLineaBlancaController::class, 'editarLN'])->name('servicios.editarLN');
    Route::put('/editarGas/{id}', [GasfiteriaController::class, 'editarGas'])->name('servicios.editarGas');
    Route::put('/editarOMa/{id}', [ObrasMayoresController::class, 'editarOMa'])->name('servicios.editarOMa');
    Route::put('/editarOMe/{id}', [ObrasMenoresController::class, 'editarOMe'])->name('servicios.editarOMe');

    Route::delete('/borrarLN/{id}', [ServtecLineaBlancaController::class, 'borrarLN'])->name('servicios.borrarLN');
    Route::delete('/borrarGas/{id}', [GasfiteriaController::class, 'borrarGas'])->name('servicios.borrarGas');
    Route::delete('/borrarOMa/{id}', [ObrasMayoresController::class, 'borrarOMa'])->name('servicios.borrarOMa');
    Route::delete('/borrarOMe/{id}', [ObrasMenoresController::class, 'borrarOMe'])->name('servicios.borrarOMe');

    Route::get('/conseguirImagenes/{id}/{tipo}', [ServtecLineaBlancaController::class, 'conseguirImagenes'])->name('servicios.conseguirImagenes');

    Route::post('/guardarImagen', [ServtecLineaBlancaController::class, 'guardarImagen'])->name('servicios.guardarImagen');
    Route::get('/verImagenEdit', [ServtecLineaBlancaController::class, 'verImagenEdit'])->name('servicios.verImagenEdit');
    Route::post('/reemplazarImagen', [ServtecLineaBlancaController::class, 'reemplazarImagen'])->name('servicios.reemplazarImagen');
    Route::post('/eliminarImagen', [ServtecLineaBlancaController::class, 'eliminarImagen'])->name('servicios.eliminarImagen');


    Route::get('/conseguirVideos/{id}/{tipo}', [ServtecLineaBlancaController::class, 'conseguirVideos'])->name('servicios.conseguirImagenes');
    Route::post('/guardarVideo', [ServtecLineaBlancaController::class, 'guardarImagen'])->name('servicios.guardarImagen');
    Route::get('/verVideoEdit', [ServtecLineaBlancaController::class, 'verImagenEdit'])->name('servicios.verImagenEdit');
    Route::post('/reemplazarVideo', [ServtecLineaBlancaController::class, 'reemplazarImagen'])->name('servicios.reemplazarImagen');
    Route::post('/eliminarVideo', [ServtecLineaBlancaController::class, 'eliminarImagen'])->name('servicios.eliminarImagen');

    Route::get('/conseguirDocume/{id}/{tipo}', [ServtecLineaBlancaController::class, 'conseguirImagenes'])->name('servicios.conseguirImagenes');
    Route::post('/guardarDocume', [ServtecLineaBlancaController::class, 'guardarDocume'])->name('servicios.guardarImagen');
    Route::get('/verVideoEdit', [ServtecLineaBlancaController::class, 'verImagenEdit'])->name('servicios.verImagenEdit');
    Route::post('/reemplazarDocume', [ServtecLineaBlancaController::class, 'reemplazarImagen'])->name('servicios.reemplazarImagen');
    Route::post('/eliminarVideo', [ServtecLineaBlancaController::class, 'eliminarImagen'])->name('servicios.eliminarImagen');


    Route::get('/conseguirMateriales/{id}/{tipo}', [ServtecLineaBlancaController::class, 'conseguirMateriales'])->name('servicios.conseguirMateriales');
    Route::post('/guardarMaterial', [ServtecLineaBlancaController::class, 'guardarMaterial'])->name('servicios.guardarMaterial');
    Route::get('/verMaterial', [ServtecLineaBlancaController::class, 'verMaterial'])->name('servicios.verMaterial');
    Route::put('/reemplazarMaterial', [ServtecLineaBlancaController::class, 'reemplazarMaterial'])->name('servicios.reemplazarMaterial');
    Route::post('/eliminarMaterial', [ServtecLineaBlancaController::class, 'eliminarMaterial'])->name('servicios.eliminarMaterial');
    
    // rutas de estado de servicios/
    Route::post('/cambiar-estado/{id}', [ServtecLineaBlancaController::class, 'cambiarEstado']);
    Route::post('/cambiar-estado2/{id}', [ServtecLineaBlancaController::class, 'cambiarEstado2']);
    Route::post('/cambiar-estado3/{id}', [ServtecLineaBlancaController::class, 'cambiarEstado3']);
    Route::post('/cambiar-estado4/{id}', [ServtecLineaBlancaController::class, 'cambiarEstado4']);


    //////////////////////////////// RUTAS PROPIEDADES AnO CORRIDO ///////////////////////////////////
    Route::get('/proanocorrido', [PropiedadController::class, 'indexanocorrido']);
    Route::post('/proanocorrido/add', [PropiedadController::class, 'addproanocorrido']);
    Route::get('/proanocorrido/mostrar/archivo/{id_propiedad}', [PropiedadController::class,'mostrarArchivos']);
    Route::post('/proanocorrido/archivos/guardar/{idPropiedad}', [PropiedadController::class, 'addArchivo2'])->name('archivos.guardar');
    Route::post('/proanocorrido/imagen/cambiar/{ImagenId}', [PropiedadController::class, 'cambiarImagen']);
    Route::delete('/proanocorrido/elimiarchivo/{archivoId}', [PropiedadController::class, 'destroy']);
    Route::delete('/proanocorrido/propiedad/{id}', [PropiedadController::class, 'eliminarpro']);
    Route::post('/proanocorrido/detallespropiedad/{id_propiedad}', [PropiedadController::class, 'addetalles'])->name('detallespropiedad.addetalles');
    // Route::get('/propiedadestodo/{id}', [PropiedadController::class, 'edit']);
    // Route::post('/propiedad/update/', [PropiedadController::class, 'Proupdate']);

    Route::get('/proanocorrido/obtener/propietarioNombre', [PropiedadController::class, 'PropietariosAgregados']);

    Route::post('/proanocorrido/editarDetalles', [PropiedadController::class, 'edicionDetalles'])->name('propiedadesDetalles');

    Route::delete('/proanocorrido/imagen/{idImg}', [PropiedadController::class, 'imgDelete']);
    Route::delete('/proanocorrido/video/{idVideo}', [PropiedadController::class, 'videoDelete']);
    
    Route::post('/proanocorrido/portada/cambiar_img/{id}', [PropiedadController::class, 'cambiarImg'])->name('admin.propiedadesDetalles');
    
    Route::delete('/proanocorrido/propietarioDelete/{idPropietario}', [PropiedadController::class, 'PropietarioDelete']);
    Route::get('/proanocorridopropiedadesDetalles-{id}',[PropiedadController::class,'proanocorridopropiedadesDetalles'])->name('admin.proanocorridopropiedadesDetalles');
    
    Route::delete('/mantencion/{idImg}', [PropiedadController::class, 'mantenciondelete']);
    Route::post('/guardar/mantenciones', [PropiedadController::class, 'guardarMantenciones']);

    // Editar mantenimiento
    Route::post('/guardar/mantenimiento-editar/{id}', [PropiedadController::class, 'editarMantenimiento']);

    // Eliminar documento de propiedad
    Route::post('/eliminar-documento-propiedad/{id}', [PropiedadController::class, 'eliminarDocumentoPropiedad']);
});

Route::middleware(['auth', 'trabajador'])->group(function () {

    Route::get('/trabajador/propiedadesDetallestrabajador-{id}',[PropiedadController::class,'trabajadorpropiedadesDetalles'])->name('trabajador.propiedadesDetalles');

    // ////////// RUTAS PROPIEDADES //////////
    Route::get('/trabajador/propiedades', [PropiedadController::class, 'indexTrabajador']);
    Route::post('/trabajador/propiedades', [PropiedadController::class, 'add']);
    Route::get('/trabajador/mostrar/archivo/{id_propiedad}', [PropiedadController::class,'mostrarArchivos']);
    Route::post('/trabajador/archivos/guardar/{idPropiedad}', [PropiedadController::class, 'addArchivo2'])->name('archivos.guardar');
    Route::delete('/trabajador/elimiarchivo/{archivoId}', [PropiedadController::class, 'destroy']);
    Route::delete('/trabajador/propiedad/{id}', [PropiedadController::class, 'eliminarpro']);
    Route::post('/trabajador/detallespropiedad/{id_propiedad}', [PropiedadController::class, 'addetalles'])->name('detallespropiedad.addetalles');
    
    Route::get('/trabajador/obtener/propietarioNombre', [PropiedadController::class, 'PropietariosAgregados']);
    
    Route::post('/trabajador/editarDetalles', [PropiedadController::class, 'edicionDetalles'])->name('propiedadesDetalles');
    
    Route::delete('/trabajador/imagen/{idImg}', [PropiedadController::class, 'imgDelete']);
    Route::delete('/trabajador/video/{idVideo}', [PropiedadController::class, 'videoDelete']);
    
    Route::post('/trabajador/portada/cambiar_img/{id}', [PropiedadController::class, 'cambiarImg'])->name('admin.propiedadesDetalles');
    
    Route::delete('/trabajador/propietarioDelete/{idPropietario}', [PropiedadController::class, 'PropietarioDelete']);
    Route::post('/trabajador/guardar/mantenciones', [PropiedadController::class, 'guardarMantenciones']);
    Route::delete('/trabajador/mantencion/{idImg}', [PropiedadController::class, 'mantenciondelete']);

    // Route::get('/arrendatarios', [ArrendatarioController::class, 'index']);
    // Route::post('/arrendatarios/add', [ArrendatarioController::class, 'addArrendatario']);
    // Route::get('/arrendatarios/editar/{idArrendatario}', [ArrendatarioController::class, 'datosArrendatario']);
    // Route::post('/arrendatarios/add_editar_arrendatario', [ArrendatarioController::class, 'addEditArrendatario']);
    // Route::post('/arrendatarios/eliminar', [ArrendatarioController::class, 'eliminarArrendatario']);
    
    // Route::post('/imagen/cambiar/{ImagenId}', [PropiedadController::class, 'cambiarImagen']);
    // Route::get('/propiedadestodo/{id}', [PropiedadController::class, 'edit']);
    // Route::post('/propiedad/update/', [PropiedadController::class, 'Proupdate']);
    
    // ////////// RUTAS ELEMENTOS //////////
    Route::get('/trabajador/elementos', [ElementosController::class, 'indextrabajador']);
    Route::post('/trabajador/Elementosadd', [ElementosController::class, 'add']);
    Route::get('/trabajador/elemento/editar/{id_elemento}', [ElementosController::class, 'show']);
    Route::post('/trabajador/elementos/guadar_elementos', [ElementosController::class, 'addelemento']);
    Route::delete('/trabajador/elemento/eliminar/{id_elemento}',[ElementosController::class,'deleteElement']);


    
    ////////// RUTAS ARRIENDOS //////////
    Route::get('/trabajador/arriendos', [ArriendoController::class, 'indextrabajador']);
    Route::post('/trabajador/arriendos/add_arriendos', [ArriendoController::class, 'addArriendo'])->name('arriendos.addArriendo');
    Route::get('/trabajador/arriendos/editar/{idArriendo}', [ArriendoController::class, 'datosArriendo']);
    Route::post('/trabajador/arriendos/add_editar_arriendos', [ArriendoController::class, 'addEditArriendo']);
    Route::post('/trabajador/arriendos/eliminar', [ArriendoController::class, 'eliminarArriendo']);

    Route::get('/trabajador/Mostrar/Archivo/{id_contrato}', [ArriendoController::class,'mostrarArchivos']);

    Route::delete('/trabajador/elimicontra/{contratoId}', [ArriendoController::class, 'destroy']);
    Route::post('/trabajador/archivos/guardar/{idArriendo}', [ArriendoController::class, 'addArchivo2'])->name('archivos.guardar');

    
    //////////////////////////////// RUTAS INVENTARIO/////////////////////////////
      
    Route::get('/trabajador/inventario', [InventarioController::class, 'indextrabajador'])->name('inventario.index');
    Route::post('/trabajador/inventario', [InventarioController::class, 'store']);
    Route::post('/trabajador/inventario/{id}/update', [InventarioController::class, 'update'])->name('inventario.update');
    Route::delete('/trabajador/inventario/{id}', [InventarioController::class, 'destroy'])->name('inventario.destroy');

    //////////////////////////////// PROPIEDADES AÑO CORRIDO //////////////////////////
    Route::get('/trabajador/proanocorrido', [PropiedadController::class, 'indexanocorridotrabajador']);
    Route::post('/trabajador/proanocorrido/add', [PropiedadController::class, 'addproanocorrido']);
    Route::get('/trabajador/proanocorrido/mostrar/archivo/{id_propiedad}', [PropiedadController::class,'mostrarArchivos']);
    Route::post('/trabajador/proanocorrido/archivos/guardar/{idPropiedad}', [PropiedadController::class, 'addArchivo2'])->name('archivos.guardar');
    Route::post('/trabajador/proanocorrido/imagen/cambiar/{ImagenId}', [PropiedadController::class, 'cambiarImagen']);
    Route::delete('/trabajador/proanocorrido/elimiarchivo/{archivoId}', [PropiedadController::class, 'destroy']);
    Route::delete('/trabajador/proanocorrido/propiedad/{id}', [PropiedadController::class, 'eliminarpro']);
    Route::post('/trabajador/proanocorrido/detallespropiedad/{id_propiedad}', [PropiedadController::class, 'addetalles'])->name('detallespropiedad.addetalles');
    // Route::get('/propiedadestodo/{id}', [PropiedadController::class, 'edit']);
    // Route::post('/propiedad/update/', [PropiedadController::class, 'Proupdate']);

    Route::get('/trabajador/proanocorrido/obtener/propietarioNombre', [PropiedadController::class, 'PropietariosAgregados']);

    Route::post('/trabajador/proanocorrido/editarDetalles', [PropiedadController::class, 'edicionDetalles'])->name('propiedadesDetalles');

    Route::delete('/trabajador/proanocorrido/imagen/{idImg}', [PropiedadController::class, 'imgDelete']);
    Route::delete('/trabajador/proanocorrido/video/{idVideo}', [PropiedadController::class, 'videoDelete']);
    
    Route::post('/trabajador/proanocorrido/portada/cambiar_img/{id}', [PropiedadController::class, 'cambiarImg'])->name('trabajador.propiedadesDetalles');
    
    Route::delete('/trabajador/proanocorrido/propietarioDelete/{idPropietario}', [PropiedadController::class, 'PropietarioDelete']);
    Route::get('/trabajador/proanocorridopropiedadesDetallestrabajador-{id}',[PropiedadController::class,'proanocorridopropiedadesDetallestrabajador'])->name('trabajador.proanocorridopropiedadesDetallestrabajador');
    
});


//////////////////////////////////OBRERO///////////////////////////////////////////////////////////////
Route::middleware(['auth', 'obrero'])->group(function () {
    Route::get('/obrero/propiedadesDetallesObrero-{id}',[PropiedadController::class,'obreropropiedadesDetalles'])->name('obrero.propiedadesDetalles');


    // ////////// RUTAS PROPIEDADES //////////
    Route::get('/obrero/propiedades', [PropiedadController::class, 'indexObrero']);
    Route::post('/obrero/propiedades', [PropiedadController::class, 'add']);
    Route::get('/obrero/mostrar/archivo/{id_propiedad}', [PropiedadController::class,'mostrarArchivos']);
    Route::post('/obrero/archivos/guardar/{idPropiedad}', [PropiedadController::class, 'addArchivo2'])->name('archivos.guardar');
    Route::delete('/obrero/elimiarchivo/{archivoId}', [PropiedadController::class, 'destroy']);
    Route::delete('/obrero/propiedad/{id}', [PropiedadController::class, 'eliminarpro']);
    Route::post('/obrero/detallespropiedad/{id_propiedad}', [PropiedadController::class, 'addetalles'])->name('detallespropiedad.addetalles');
    
    Route::get('/obrero/obtener/propietarioNombre', [PropiedadController::class, 'PropietariosAgregados']);
    
    Route::post('/obrero/editarDetalles', [PropiedadController::class, 'edicionDetalles'])->name('propiedadesDetalles');
    
    Route::delete('/obrero/imagen/{idImg}', [PropiedadController::class, 'imgDelete']);
    Route::delete('/obrero/video/{idVideo}', [PropiedadController::class, 'videoDelete']);
    
    Route::post('/obrero/portada/cambiar_img/{id}', [PropiedadController::class, 'cambiarImg'])->name('admin.propiedadesDetalles');
    
    Route::delete('/obrero/propietarioDelete/{idPropietario}', [PropiedadController::class, 'PropietarioDelete']);

    Route::delete('/obrero/propietarioDelete/{idPropietario}', [PropiedadController::class, 'PropietarioDelete']);
    Route::post('/obrero/guardar/mantenciones', [PropiedadController::class, 'guardarMantenciones']);
    Route::delete('/obrero/mantencion/{idImg}', [PropiedadController::class, 'mantenciondelete']);

    // Route::get('/arrendatarios', [ArrendatarioController::class, 'index']);
    // Route::post('/arrendatarios/add', [ArrendatarioController::class, 'addArrendatario']);
    // Route::get('/arrendatarios/editar/{idArrendatario}', [ArrendatarioController::class, 'datosArrendatario']);
    // Route::post('/arrendatarios/add_editar_arrendatario', [ArrendatarioController::class, 'addEditArrendatario']);
    // Route::post('/arrendatarios/eliminar', [ArrendatarioController::class, 'eliminarArrendatario']);
    //////////////////////////////// RUTAS INVENTARIO/////////////////////////////

    Route::get('/obrero/inventario', [InventarioController::class, 'obreroIndex'])->name('inventario.index');
    Route::post('/obrero/inventario', [InventarioController::class, 'store']);
    Route::post('/obrero/inventario/{id}/update', [InventarioController::class, 'update'])->name('inventario.update');
    Route::delete('/obrero/inventario/{id}', [InventarioController::class, 'destroy'])->name('inventario.destroy');

   
    ////////////////////////////////SERVICIOS/////////////////////////////
    Route::get('/obrero/servicios', [ServtecLineaBlancaController::class, 'indexObreroservi']);

    Route::post('/obrero/agregarLN', [ServtecLineaBlancaController::class, 'agregarLN'])->name('servicios.agregarLN');   
    Route::post('/obrero/agregarGas', [GasfiteriaController::class, 'agregarGas'])->name('servicios.agregarGas');    
    Route::post('/obrero/agregarOMa', [ObrasMayoresController::class, 'agregarOMa'])->name('servicios.agregarOMa');   
    Route::post('/obrero/agregarOMe', [ObrasMenoresController::class, 'agregarOMe'])->name('servicios.agregarOMe');   


    Route::get('/obrero/conseguirLN/{id}', [ServtecLineaBlancaController::class, 'conseguirLN'])->name('servicios.conseguirLN');
    Route::get('/obrero/conseguirGas/{id}', [GasfiteriaController::class, 'conseguirGas'])->name('servicios.conseguirGas');
    Route::get('/obrero/conseguirOMa/{id}', [ObrasMayoresController::class, 'conseguirOMa'])->name('servicios.conseguirOMa');
    Route::get('/obrero/conseguirOMe/{id}', [ObrasMenoresController::class, 'conseguirOMe'])->name('servicios.conseguirOMe');

    Route::put('/obrero/editarLN/{id}', [ServtecLineaBlancaController::class, 'editarLN'])->name('servicios.editarLN');
    Route::put('/obrero/editarGas/{id}', [GasfiteriaController::class, 'editarGas'])->name('servicios.editarGas');
    Route::put('/obrero/editarOMa/{id}', [ObrasMayoresController::class, 'editarOMa'])->name('servicios.editarOMa');
    Route::put('/obrero/editarOMe/{id}', [ObrasMenoresController::class, 'editarOMe'])->name('servicios.editarOMe');

    Route::delete('/obrero/borrarLN/{id}', [ServtecLineaBlancaController::class, 'borrarLN'])->name('servicios.borrarLN');
    Route::delete('/obrero/borrarGas/{id}', [GasfiteriaController::class, 'borrarGas'])->name('servicios.borrarGas');
    Route::delete('/obrero/borrarOMa/{id}', [ObrasMayoresController::class, 'borrarOMa'])->name('servicios.borrarOMa');
    Route::delete('/obrero/borrarOMe/{id}', [ObrasMenoresController::class, 'borrarOMe'])->name('servicios.borrarOMe');

    Route::get('/obrero/conseguirImagenes/{id}/{tipo}', [ServtecLineaBlancaController::class, 'conseguirImagenes'])->name('servicios.conseguirImagenes');

    Route::post('/obrero/guardarImagen', [ServtecLineaBlancaController::class, 'guardarImagen'])->name('servicios.guardarImagen');
    Route::get('/obrero/verImagenEdit', [ServtecLineaBlancaController::class, 'verImagenEdit'])->name('servicios.verImagenEdit');
    Route::post('/obrero/reemplazarImagen', [ServtecLineaBlancaController::class, 'reemplazarImagen'])->name('servicios.reemplazarImagen');
    Route::post('/obrero/eliminarImagen', [ServtecLineaBlancaController::class, 'eliminarImagen'])->name('servicios.eliminarImagen');


    Route::get('/obrero/conseguirVideos/{id}/{tipo}', [ServtecLineaBlancaController::class, 'conseguirVideos'])->name('servicios.conseguirImagenes');
    Route::post('/obrero/guardarVideo', [ServtecLineaBlancaController::class, 'guardarImagen'])->name('servicios.guardarImagen');
    Route::get('/obrero/verVideoEdit', [ServtecLineaBlancaController::class, 'verImagenEdit'])->name('servicios.verImagenEdit');
    Route::post('/obrero/reemplazarVideo', [ServtecLineaBlancaController::class, 'reemplazarImagen'])->name('servicios.reemplazarImagen');
    Route::post('/obrero/eliminarVideo', [ServtecLineaBlancaController::class, 'eliminarImagen'])->name('servicios.eliminarImagen');

    Route::get('/obrero/conseguirDocume/{id}/{tipo}', [ServtecLineaBlancaController::class, 'conseguirImagenes'])->name('servicios.conseguirImagenes');
    Route::post('/obrero/guardarDocume', [ServtecLineaBlancaController::class, 'guardarDocume'])->name('servicios.guardarImagen');
    Route::get('/obrero/verVideoEdit', [ServtecLineaBlancaController::class, 'verImagenEdit'])->name('servicios.verImagenEdit');
    Route::post('/obrero/reemplazarDocume', [ServtecLineaBlancaController::class, 'reemplazarImagen'])->name('servicios.reemplazarImagen');
    Route::post('/obrero/eliminarVideo', [ServtecLineaBlancaController::class, 'eliminarImagen'])->name('servicios.eliminarImagen');


    Route::get('/obrero/conseguirMateriales/{id}/{tipo}', [ServtecLineaBlancaController::class, 'conseguirMateriales'])->name('servicios.conseguirMateriales');
    Route::post('/obrero/guardarMaterial', [ServtecLineaBlancaController::class, 'guardarMaterial'])->name('servicios.guardarMaterial');
    Route::get('/obrero/verMaterial', [ServtecLineaBlancaController::class, 'verMaterial'])->name('servicios.verMaterial');
    Route::put('/obrero/reemplazarMaterial', [ServtecLineaBlancaController::class, 'reemplazarMaterial'])->name('servicios.reemplazarMaterial');
    Route::post('/obrero/eliminarMaterial', [ServtecLineaBlancaController::class, 'eliminarMaterial'])->name('servicios.eliminarMaterial');
    
    // rutas de estado de servicios/
    Route::post('/obrero/cambiar-estado/{id}', [ServtecLineaBlancaController::class, 'cambiarEstado']);
    Route::post('/obrero/cambiar-estado2/{id}', [ServtecLineaBlancaController::class, 'cambiarEstado2']);
    Route::post('/obrero/cambiar-estado3/{id}', [ServtecLineaBlancaController::class, 'cambiarEstado3']);
    Route::post('/obrero/cambiar-estado4/{id}', [ServtecLineaBlancaController::class, 'cambiarEstado4']);



    ////////////////////////////////// PROPIEDADES DE VERANO ///////////////////////////
    Route::get('/obrero/verano', [VeranoController::class, 'index_verano_obrero'])->name('verano.verano');
    Route::post('/obrero/propiedades_verano', [VeranoController::class, 'Guardarverano'])->name('propiedades_verano.verano');
    Route::post('/obrero/propiedades_verano_detalles/{id}', [VeranoController::class, 'guardarDetalles']);
    Route::get('/obrero/propiedadesVeranoDetalles-{id}',[VeranoController::class,'propiedadesVeraDetalles'])->name('admin.propiedadesVeranoDetalles');
    Route::post('/obrero/property/update/{id}', [VeranoController::class, 'update'])->name('property.update');
    Route::delete('/obrero/imagen/{id}', [VeranoController::class, 'destroy'])->name('imagenes.eliminar');
    Route::patch('/obrero/propiedadVeranoestado/{id}', [VeranoController::class,'deletePropiedadVera']);
    Route::get('/obrero/obtenerVe/propietarioVeNombre', [VeranoController::class, 'PropietariosAgregadosVe']);
    // Route::delete('/propiedadverano/{idPropiedad}',[VeranoController::class,'deletepropiedad'])->name('admin.propiedadverano'); 
    Route::delete('/obrero/propietarioVeranoDelete/{idPropietario}', [VeranoController::class, 'PropietarioVeraDelete']);
    Route::post('/obrero/portadaVera/cambiar_imgen/{id}', [VeranoController::class, 'cambiarImg'])->name('admin.propiedadesVeranoDetalles');

    Route::delete('/obrero/borrarLN/{id}', [ServtecLineaBlancaController::class, 'borrarLN'])->name('servicios.borrarLN');
    Route::delete('/obrero/borrarGas/{id}', [GasfiteriaController::class, 'borrarGas'])->name('servicios.borrarGas');
    Route::delete('/obrero/borrarOMa/{id}', [ObrasMayoresController::class, 'borrarOMa'])->name('servicios.borrarOMa');
    Route::delete('/obrero/borrarOMe/{id}', [ObrasMenoresController::class, 'borrarOMe'])->name('servicios.borrarOMe');

    Route::get('/obrero/conseguirImagenes/{id}/{tipo}', [ServtecLineaBlancaController::class, 'conseguirImagenes'])->name('servicios.conseguirImagenes');

    Route::post('/obrero/guardarImagen', [ServtecLineaBlancaController::class, 'guardarImagen'])->name('servicios.guardarImagen');
    Route::get('/obrero/verImagenEdit', [ServtecLineaBlancaController::class, 'verImagenEdit'])->name('servicios.verImagenEdit');
    Route::post('/obrero/reemplazarImagen', [ServtecLineaBlancaController::class, 'reemplazarImagen'])->name('servicios.reemplazarImagen');
    Route::post('/obrero/eliminarImagen', [ServtecLineaBlancaController::class, 'eliminarImagen'])->name('servicios.eliminarImagen');

    Route::get('/obrero/conseguirMateriales/{id}/{tipo}', [ServtecLineaBlancaController::class, 'conseguirMateriales'])->name('servicios.conseguirMateriales');
    Route::post('/obrero/guardarMaterial', [ServtecLineaBlancaController::class, 'guardarMaterial'])->name('servicios.guardarMaterial');
    Route::get('/obrero/verMaterial', [ServtecLineaBlancaController::class, 'verMaterial'])->name('servicios.verMaterial');
    Route::put('/obrero/reemplazarMaterial', [ServtecLineaBlancaController::class, 'reemplazarMaterial'])->name('servicios.reemplazarMaterial');
    Route::post('/obrero/eliminarMaterial', [ServtecLineaBlancaController::class, 'eliminarMaterial'])->name('servicios.eliminarMaterial');
    
    // ////////////////////////////////// PROPIEDADES DE VERANO ///////////////////////////
    // Route::get('/obrero/verano', [VeranoController::class, 'index_verano_obrero'])->name('verano.verano');
    // Route::post('/obrero/propiedades_verano', [VeranoController::class, 'Guardarverano'])->name('propiedades_verano.verano');
    // Route::post('/obrero/propiedades_verano_detalles/{id}', [VeranoController::class, 'guardarDetalles']);
    // Route::get('/obrero/propiedadesVeranoDetalles-{id}',[VeranoController::class,'propiedadesVeraDetalles'])->name('admin.propiedadesVeranoDetalles');
    // Route::post('/obrero/property/update/{id}', [VeranoController::class, 'update'])->name('property.update');
    // Route::delete('/obrero/imagen/{id}', [VeranoController::class, 'destroy'])->name('imagenes.eliminar');
    // Route::patch('/obrero/propiedadVeranoestado/{id}', [VeranoController::class,'deletePropiedadVera']);
    // Route::get('/obrero/obtenerVe/propietarioVeNombre', [VeranoController::class, 'PropietariosAgregadosVe']);
    // // Route::delete('/propiedadverano/{idPropiedad}',[VeranoController::class,'deletepropiedad'])->name('admin.propiedadverano'); 
    // Route::delete('/obrero/propietarioVeranoDelete/{idPropietario}', [VeranoController::class, 'PropietarioVeraDelete']);
    // Route::post('/obrero/portadaVera/cambiar_imgen/{id}', [VeranoController::class, 'cambiarImg'])->name('admin.propiedadesVeranoDetalles');

    //  ///////////////// RUTAS PROPIEDADES EN VENTA ////////////////
    //  Route::get('/obrero/propiedadesVenta', [PropiedadController::class, 'indexVenta_obrero']);
    //  Route::post('/obrero/propiedadesVenta/add_propiedad', [PropiedadController::class, 'addProVenta']);
    //  Route::post('/obrero/detallesVentaPropiedad/{idPropiedad}', [PropiedadController::class, 'addetallesVenta']);
    //  Route::post('/obrero/archivosVenta/guardar/{id_propiedad}', [PropiedadController::class, 'addArchivoVenta']);
    //  Route::delete('/obrero/propiedadVenta/{id}', [PropiedadController::class, 'eliminarproVenta']);
    //  // rutas detalles propiedad en venta
    //  Route::get('/obrero/propiedadesVentaDetalles-{id}',[PropiedadController::class,'propiedadesVentaDetalles']);
     //////////////////////////////// PROPIEDADES AÑO CORRIDO //////////////////////////
     Route::get('/obrero/proanocorrido', [PropiedadController::class, 'indexanocorridoobrero']);
     Route::post('/obrero/proanocorrido/add', [PropiedadController::class, 'addproanocorrido']);
     Route::get('/obrero/proanocorrido/mostrar/archivo/{id_propiedad}', [PropiedadController::class,'mostrarArchivos']);
     Route::post('/obrero/proanocorrido/archivos/guardar/{idPropiedad}', [PropiedadController::class, 'addArchivo2'])->name('archivos.guardar');
     Route::post('/obrero/proanocorrido/imagen/cambiar/{ImagenId}', [PropiedadController::class, 'cambiarImagen']);
     Route::delete('/obrero/proanocorrido/elimiarchivo/{archivoId}', [PropiedadController::class, 'destroy']);
     Route::delete('/obrero/proanocorrido/propiedad/{id}', [PropiedadController::class, 'eliminarpro']);
     Route::post('/obrero/proanocorrido/detallespropiedad/{id_propiedad}', [PropiedadController::class, 'addetalles'])->name('detallespropiedad.addetalles');
     // Route::get('/propiedadestodo/{id}', [PropiedadController::class, 'edit']);
     // Route::post('/propiedad/update/', [PropiedadController::class, 'Proupdate']);
 
     Route::get('/obrero/proanocorrido/obtener/propietarioNombre', [PropiedadController::class, 'PropietariosAgregados']);
 
     Route::post('/obrero/proanocorrido/editarDetalles', [PropiedadController::class, 'edicionDetalles'])->name('propiedadesDetalles');
 
     Route::delete('/obrero/proanocorrido/imagen/{idImg}', [PropiedadController::class, 'imgDelete']);
     Route::delete('/obrero/proanocorrido/video/{idVideo}', [PropiedadController::class, 'videoDelete']);
     
     Route::post('/obrero/proanocorrido/portada/cambiar_img/{id}', [PropiedadController::class, 'cambiarImg'])->name('obrero.propiedadesDetalles');
     
     Route::delete('/obrero/proanocorrido/propietarioDelete/{idPropietario}', [PropiedadController::class, 'PropietarioDelete']);
     Route::get('/obrero/proanocorridopropiedadesDetallesObrero-{id}',[PropiedadController::class,'proanocorridopropiedadesDetallesObrero'])->name('obrero.proanocorridopropiedadesDetallesObrero');
     

});



Auth::routes();
