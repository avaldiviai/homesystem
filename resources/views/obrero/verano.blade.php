@extends('layouts.app')

@section('content')
<div class="container-fluid overflow-hidden" style="background-color: #FFAB40">
    <div class="row vh-100 overflow-auto">
        @include('layouts.sidebar_obrero')
        <div class="col d-flex flex-column h-100" style="padding: 0; background-color: #FFAB40;">
            <div class="flex-grow-1">
                {{-- Contenido --}}
                <div class="container">
                    <div class="row">
                        <div class="col-6" style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px; color: white;">
                            <h1 class="text-uppercase">Propiedades verano</h1>
                        </div>
                    </div>
                </div>
                   {{-- Card propiedades en venta --}}
                <div class="container ">
                   <div class="row mb-4">
                     <div class="col-md-4">
                        <div class="input-group mx-2" style="max-width: 400px;">
                            <span class="input-group-text bg-primary text-white shadow-sm">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                       <input type="text" id="buscador_cnn" placeholder="Buscar Propiedad" 
                                    class="form-control shadow-sm border-0" 
                                    style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        </div>
                    </div>
                    
                        <div class="col-md-8 text-end">
                      <button type="button" class="btn btn-success p-2" data-bs-toggle="modal" data-bs-target="#formModal">
                        <span>AGREGAR PROPIEDAD</span>
                      </button>
                    </div>
                </div>

                <div class="row">
                    @foreach ($propiedadesVerano as $propiedad)
                        <div class="col-md-3 mb-3">
                            {{-- @if($propiedad->detallesVeranos->isNotEmpty())  <!-- Verifica si la propiedad tiene detalles --> --}}
                                <!-- Envolver toda la tarjeta con el enlace -->
                                {{-- <a href="{{ route('propiedadesVeraDetalles', ['id' => $propiedad->id, 'detalleId' => $propiedad->detallesVeranos->first()->id]) }}" style="text-decoration: none;"> --}}
                                    <a href="/obrero/propiedadesVeranoDetalles-{{$propiedad->id}}" style="text-decoration:none; color: #000;">
                                    <div class="card shadow position-relative" style="border:none; min-height: 200px;">
                                        @php
                                            // Obtener la primera imagen de los detalles de la propiedad
                                            $imagen = $propiedad->detallesVeranos->flatMap(function ($detalle) {
                                                return $detalle->imagenes;
                                            })->first();
                                        @endphp
                                        <div class="card-img-top img-fluid" style="height: 200px; object-fit: cover; background-color: #f5f5f5; display: flex; justify-content: center; align-items: center;">
                                            @if($imagen)
                                                <img src="{{ asset($imagen->link) }}" style="height: 100%; width: 100%; object-fit: cover;" alt="{{ $propiedad->direccion }}" data-imagen-url="{{ asset($imagen->link) }}">
                                            @else
                                                <span style="color: #aaa; font-size: 14px;">Imagen no disponible</span>
                                            @endif
                                        </div>
                            
                                        <!-- Texto extendido dentro de la imagen -->
                                        <div class="position-absolute bottom-0 start-0 w-100 text-white p-2" style="background: rgba(0, 0, 0, 0.6); font-size: 12px; line-height: 1.2;">
                                            <span><strong>Dirección:</strong> {{ $propiedad->direccion }}</span> <br>
                                            <span><strong>Sector:</strong> {{ $propiedad->sector }}</span> <br>
                                            <span><strong>Condominio:</strong> {{ $propiedad->condominio }}</span> <br>
                                            <span><strong>Torre:</strong> {{ $propiedad->torre }} - {{ $propiedad->num_apartamento }}</span>
                                        </div>
                            
                                        <!-- Iconos sobre la imagen -->
                                        <div class="position-absolute top-0 end-0 p-2 d-flex flex-column" style="background: rgba(0, 0, 0, 0.6);">
                                        @if ($propiedad->mostrarBoton)
                                            <a href="#" class="text-primary mb-2 detalle-propiedad-btn" data-id="{{ $propiedad->id }}" title="Agregar Detalles">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </a>
                                          @endif
                                     

                                            {{-- <a href="#" class="text-success mb-2 btn-Contrato" data-id="{{ $propiedad->id }}" title="Archivo">
                                                <i class="fa-regular fa-folder fa-lg"></i>
                                            </a> --}}
                                            <a href="#" class="text-danger borrar-propiedadVera-btn" data-id="{{ $propiedad->id }}" title="Borrar">
                                                <i class="fas fa-trash-alt fa-lg"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </a>
                       
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-tittle">Propiedades de verano</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="container">
                        <div class="row">
                            {{-- <div class="col-md-6 mb-3">
                                <label for="propietario">Propietario</label>
                                <select name="propietario" id="propietario" class="form-select">
                                    <option selected disabled > Selecione un Propietario</option>
                                    @foreach($propietarios as $propi)
                                    <option value="{{ $propi->id }}">{{ $propi->nombre}}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="form-group col-lg-6 ">
                                <label for="propietarioInput"><b>Propietarios</b></label>
                                <div class="d-flex justify-content-between ">
                                    <select id="propietarioInput" class="form-select me-2">
                                        <option disabled selected value="0">Seleccione un propietario</option>
                                        @foreach ($propietarios as $propietario)
                                        <option value="{{ $propietario->id }}">{{ $propietario->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary" id="agregar-propietario">Agregar</button>
                                </div>
                                <ul class="text-uppercase mt-4 m-1 p-1" id="lista-agregados">
                                    <!-- <button class="btn btn-danger"><i class="fas fa-trash-alt fa-lg text-white"></i></button> -->
                                </ul>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="direccion" placeholder="Ingrese la dirección">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sector">Sector</label>
                                <input type="text" class="form-control" id="sector" placeholder="Ingrese el sector">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="condominio">Condominio</label>
                                <input type="text" class="form-control" id="condominio" placeholder="Ingrese el condominio">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="torre">Torre</label>
                                <input type="text" class="form-control" id="torre" placeholder="Ingrese la torre">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="num_apartamento">N° de Apartamento</label>
                                <input type="text" class="form-control" id="num_apartamento" placeholder="Ingrese el numero">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="piso">piso</label>
                                <input type="text" class="form-control" id="piso" placeholder="Ingrese el piso">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cantidad_personas">Cantidad de Personas</label>
                                <input type="number" class="form-control" id="cantidad_personas" placeholder="Ingrese la cantidad de personas">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="ubicacion">Ubicación</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ubicacion" id="playa" value="playa">
                                    <label class="form-check-label" for="playa">Playa</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ubicacion" id="centro" value="centro">
                                    <label class="form-check-label" for="centro">Centro</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ubicacion" id="ambos" value="ambos">
                                    <label class="form-check-label" for="ambos">Ambos</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dormitorios">Dormitorios </label>
                                <input type="text" class="form-control" id="dormitorios" placeholder="Ingrese el numero de dormitorios">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tipo_piso">Tipo de Piso</label>       
                                <select class="form-select" id="tipo_piso"> 
                                <option selected disabled > Selecione un tipo de piso</option> 
                                <option value="cerámico">cerámico</option>
                                <option value=" flotante"> flotante</option>
                                <option value=" Alfombrado"> Alfombrado</option>
                                <option value=" porcelanato"> Porcelanato</option>
                            </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="baños">Baño</label>
                                <input type="text" class="form-control" id="baños" placeholder="Ingrese el numero de baños">
                            </div>
                           <div class="col-md-4 mb-3">
                            <label for="tipo_cocina">Tipo de cocina</label>
                            <select class="form-select" id="tipo_cocina">
                            <option selected disabled > Selecione un tipo de cocina</option>    
                            <option value="Americana">Americana</option>
                            <option value="semi Americana">semi Americana</option>
                            <option value="independiente">Independiente</option>
                            </select>
                        </div>
                            <div class="col-md-4 mb-3">
                                <label for="precio_enero">Precio minimo enero</label>
                                <input type="number" class="form-control" id="precio_min_enero" placeholder="Ingrese el precio de enero">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="precio_enero">Precio maximo enero</label>
                                <input type="number" class="form-control" id="precio_max_enero" placeholder="Ingrese el precio de enero">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="precio_min_febrero">Precio minimo febrero</label>
                                <input type="number" class="form-control" id="precio_min_febrero" placeholder="Ingrese el precio de febrero">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="precio_max_febrero">Precio maximo febrero</label>
                                <input type="number" class="form-control" id="precio_max_febrero" placeholder="Ingrese el precio de febrero">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="precio_marzo_diciembre">Precio marzo a diciembre</label>
                                <select class="form-select mt-2" id="precio_marzo_diciembre">
                                    <option selected disabled > Selecione una opcion</option>
                                    <option value="Si">si</option>
                                    <option value="No">No</option>
                                </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="precio_marzo_diciembre_precio">Precio marzo a diciembre</label>
                                    <input type="number" class="form-control" id="precio_marzo_diciembre_precio" placeholder="Ingrese el precio ">
                                </div>
                            <div class="col-md-4 mb-3">
                                <label for="equipado">Equipado para</label>
                                <input type="text" class="form-control" id="equipado" placeholder="Ingrese detalles de equipado para">
                            </div>
                        
                            <div class="col-md-4 mb-3">
                                <label for="mascotas">Mascotas</label>
                                <select class="form-select mt-2" id="mascotas">
                                    <option selected disabled > Selecione una opcion</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                </select>
                             </div>
                                <div class="col-md-4 mb-3">
                                    <label for="valor_adicional">Valor Adicional</label>
                                    <input type="text" class="form-control" id="valor_adicional" placeholder="Ingrese el valor adicional">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
            
                        <button class="btn btn-primary" id="btn_agregar_verano">Guardar</button>
                        <button type="button" id="btn_cerrar_agregar" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

 <!-- modal exito -->
 <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="successLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
   <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
       <div class="modal-header alert alert-success" role="alert" style="border: none;">
           <div class="container">
               <div class="row">
                   <div class="col-2">
                       <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000"
                           style="width:70px;height:70px"></lord-icon>
                   </div>
                   <div class="col-8 d-flex justify-content-center align-items-center">
                       <p id="texto_success" class="text-uppercase">Datos Guardados con exito
                       </p>
                   </div>
                         <div class="col-2">
                            <button type="button" class="btn-close d-flex justify-content-end"
                                id="close_success"></button>
                         </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Detalles servicios-->
<div class="modal fade" id="detallesformModal" tabindex="-1" aria-labelledby="detallesformModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalles y Servicios Propiedades de verano</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="arriendoForm" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="estacionamientos" class="form-label">Estacionamientos</label>
                                <select class="form-select" id="estacionamientos" name="estacionamientos" required>
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="num_estaciona" class="form-label">N° Estacionamiento</label>
                                <input type="number" class="form-control" id="num_estaciona" name="num_estaciona" placeholder="Ingrese el número de estacionamiento">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label">Servicios</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="cable" name="servicios[]" value="cable">
                                    <label class="form-check-label" for="cable">Cable</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="wifi" name="servicios[]" value="wifi">
                                    <label class="form-check-label" for="wifi">Wifi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="lavadora" name="servicios[]" value="lavadora">
                                    <label class="form-check-label" for="lavadora">Lavadora</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="piscina" class="form-label">Piscina</label>
                                <select class="form-select" id="piscina" name="piscina" required>
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="consergeria" class="form-label">Conserjería</label>
                                <select class="form-select" id="consergeria" name="consergeria" required>
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ascensor" class="form-label">Ascensor</label>
                                <select class="form-select" id="ascensor" name="ascensor" required>
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="juegos_infantiles" class="form-label">Juegos Infantiles</label>
                                <select class="form-select" id="juegos_infantiles" name="juegos_infantiles" required>
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="servi_lavanderia" class="form-label">Servicio de Lavandería</label>
                                <select class="form-select" id="servi_lavanderia" name="servi_lavanderia" required>
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="quinchos" class="form-label">Quinchos</label>
                                <select class="form-select" id="quinchos" name="quinchos" required>
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sala_multiuso" class="form-label">Sala Multiusos</label>
                                <select class="form-select" id="sala_multiuso" name="sala_multiuso" required>
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="terraza" class="form-label">Terraza</label>
                                <select class="form-select" id="terraza" name="terraza" required>
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="imagenes" class="form-label">Agregar imágenes</label>
                                <input class="form-control" type="file" id="imagenes" name="imagenes[]" accept="image/*" multiple>
                                <div class="mt-2" id="imagePreview"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="videos" class="form-label">Agregar videos</label>
                                <input class="form-control" type="file" id="videos" name="videos[]" accept="video/*" multiple>
                                <div class="mt-2" id="videoPreview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn_agregar_verano_detalle">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--MODAL DE CONFIRMAR PARA ELIMINAR -->
<div class="modal fade" id="modalEliminarPropiedadVerano" tabindex="-1" aria-labelledby="modalEliminarPropiedadVeranoLabel" aria-hidden="true"
data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog modal-lg">
    <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
        <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
            <h5 class="m-4 text-uppercase text-center">¿Seguro que quieres eliminar la Propiedad?</h5>
                <input type="hidden" id="eliminar-idPropiedadVe">
            <div class="modalfooter d-flex justify-content-center">
                <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="confirmDelete" class="btn btn-secondary m-2">Eliminar</button>
            </div>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalerroreliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalerroreliminarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-header alert alert-warning" role="alert" style="border: none;">
                <i class="bi bi-x-lg"></i>
                <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                    <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json"trigger="loop" delay="2000"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            </div>
                            <div class="col-8 d-flex justify-content-center align-items-center">
                                <p id="texto_error" class="text-uppercase">
                                </p>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn-close d-flex justify-content-end"
                                    data-bs-dismiss="modal" aria-label="Close" id="btn_cerrar_error_eliminar"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <div class="modal fade" id="modalAlertaAgregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="successLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
            <div class="modal-header alert alert-success" role="alert" style="border: none;">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000"
                                style="width:70px;height:70px"></lord-icon>
                        </div>
                        <div class="col-8 d-flex justify-content-center align-items-center">
                            <p id="texto_success" class="text-uppercase">
                                <!-- Texto dinámico aquí -->
                            </p>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn-close d-flex justify-content-end" id="btn-close"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



 <style>
    .preview {
        display: flex;
        flex-wrap: wrap;
    }
    .preview-item {
        margin: 5px;
        position: relative;
    }
    .preview-item img, .preview-item video {
        max-width: 150px;
        max-height: 150px;
    }
    .remove-btn {
        position: absolute;
        top: 0;
        right: 0;
        background: red;
        color: white;
        border: none;
        cursor: pointer;
    }
</style>
@endsection
@section('javascript')
@parent
<script>
    
$(document).ready(function() {
        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
       
        // jquery listo para usar con ajax
        console.log('Listo para Trabajar');
        var PropietariosAgregados = [];
            var lista = $("#lista-agregados");

            // Función para agregar un icono al arreglo
            $("#agregar-propietario").on('click', function(event) {

                event.preventDefault();

        // Obtener el ID del propietario seleccionado
        var propietarioId = $("#propietarioInput").val();

        // Verificar que se haya seleccionado un propietario
        if (propietarioId) {
            // Objeto que representa el propietario
            var propietarios = {
                id: propietarioId,
            };

            // Agregar el propietario al arreglo
            PropietariosAgregados.push(propietarios);

            // Deshabilitar el elemento seleccionado del select
            $("#propietarioInput option[value='" + propietarioId + "']").prop('disabled', true);

            // Limpiar el campo después de agregar
            $("#propietarioInput").val('0'); // Restablecer a la opción predeterminada

            // Mostrar un mensaje de éxito o realizar otras acciones si es necesario
            console.log("Propietario agregado correctamente:", propietarios);
            console.log("Propietarios agregados:", PropietariosAgregados);

            actualizarLista();
        } else {
            // Mostrar un mensaje de error si no se selecciona un propietario
            alert("Por favor, seleccione un propietario.");
        }
        });

            // Función para actualizar la lista visual de propietarios
            function actualizarLista() {
            lista.empty(); // Vaciar la lista para evitar duplicados

            // Iterar sobre los propietarios agregados y agregarlos a la lista
            $.each(PropietariosAgregados, function(index, propietarios) {
                // Realiza una solicitud AJAX para obtener el nombre del propietario
                $.ajax({
                    url: '/obrero/obtenerVe/propietarioVeNombre',
                    type: 'GET',
                    data: { nombre_pro: propietarios.id }, // Envía el ID del propietario al servidor
                    success: function(response) {
                        // Crear un elemento de la lista con el nombre del propietario y un botón de eliminar
                        var listItem = $("<li>")
                            .html('<i class="fa-solid fa-user-tie"></i> ' + response.nombre)
                            .append(
                                $("<button>")
                                    .html('<i class="fas fa-trash-alt fa-lg text-danger"></i')
                                    .addClass("btn btn-sm ms-2 m-1")
                                    .on('click', function() {
                                        eliminarPropietario(index);
                                    })
                            );
                        lista.append(listItem);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al obtener el nombre del propietario:", error);
                            }
                        });
                    });
                }

        // Función para eliminar un propietario del arreglo
        function eliminarPropietario(index) {
        var propietario = PropietariosAgregados[index];

        // Habilitar nuevamente la opción en el select
        $("#propietarioInput option[value='" + propietario.id + "']").prop('disabled', false);

        // Eliminar el propietario del arreglo
        PropietariosAgregados.splice(index, 1);

        // Actualizar la lista visual
        actualizarLista();
        }


        // Función para manejar la selección de archivos (imágenes y videos)
        const imageSeleccionados = [];
        const videoSeleccionados = [];

        // Función para manejar la selección de archivos
        function handleFileSelect(event, isVideo = false) {
            const files = event.target.files;
            const preview = document.getElementById(isVideo ? 'videoPreview' : 'imagePreview');
            preview.innerHTML = ''; // Limpiar el preview anterior

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const element = document.createElement('div');
                    element.classList.add('preview-item');

                    // Identificar si es imagen o video
                    element.innerHTML = isVideo
                        ? `
                            <video controls>
                                <source src="${e.target.result}" type="${file.type}">
                                Tu navegador no soporta el video.
                            </video>
                            <button class="remove-btn" onclick="removePreview(this, ${isVideo})">X</button>
                        `
                        : `
                            <img src="${e.target.result}" alt="Image" />
                            <button class="remove-btn" onclick="removePreview(this, ${isVideo})">X</button>
                        `;
                    
                    preview.appendChild(element);

                    // Agregar a la lista de seleccionados
                    if (isVideo) {
                        videoSeleccionados.push(file);
                    } else {
                        imageSeleccionados.push(file);
                    }
                };
                reader.readAsDataURL(file);
            });
        }

        // Función para eliminar un preview
        window.removePreview = function(button, isVideo) {
            const previewItem = button.closest('.preview-item');
            const previewContainer = previewItem.parentElement;

            const index = Array.from(previewContainer.children).indexOf(previewItem);

            if (isVideo) {
                videoSeleccionados.splice(index, 1);
            } else {
                imageSeleccionados.splice(index, 1);
            }

            previewItem.remove();
        };

        // Eventos para los inputs de archivos
        document.getElementById('imagenes').addEventListener('change', (e) => handleFileSelect(e));
        document.getElementById('videos').addEventListener('change', (e) => handleFileSelect(e, true));
     

        $("#btn_agregar_verano").on('click', function(event){
            event.preventDefault();

            
            // Recopila los datos del formulario
             // id_propietario = $('#propietario').val(),
              var  direccion = $('#direccion').val();
              var  sector = $('#sector').val();
              var condominio = $('#condominio').val();
              var  torre = $('#torre').val();
              var  num_apartamento = $('#num_apartamento').val();
                // estacionamientos = $('#estacionamiento').val(),
              var piso = $('#piso').val();
              var  ubicacion = $('input[name="ubicacion"]:checked').val();
              var  dormitorios = $('#dormitorios').val();
              var  Tpiso_dormitorios = $('#tipo_piso').val();
              var  baños = $('#baños').val();
              var  tipo_cocina = $('#tipo_cocina').val();
              var  personas = $('#cantidad_personas').val();
                // servicios = $('input[type="checkbox"]:checked').val(),
              var  precio_min_enero = $('#precio_min_enero').val();
              var  precio_max_enero = $('#precio_max_enero').val();
              var  precio_min_febrero = $('#precio_min_febrero').val();
              var  precio_max_febrero = $('#precio_max_febrero').val();
              var  marzo_diciembre = $('#precio_marzo_diciembre').val();
              var  marzo_diciembre_precio = $('#precio_marzo_diciembre_precio').val();
              var  equipado = $('#equipado').val();
              var  mascotas = $('#mascotas').val();
              var  valor_adicional = $('#valor_adicional').val();

                 var formData = new FormData();
                formData.append('direccion', direccion);
                formData.append('sector', sector);
                formData.append('condominio', condominio);
                formData.append('torre', torre);
                formData.append('num_apartamento', num_apartamento);
                formData.append('piso', piso);
                formData.append('ubicacion', ubicacion);
                formData.append('dormitorios', dormitorios);
                formData.append('Tpiso_dormitorios', Tpiso_dormitorios);
                formData.append('baños', baños);
                formData.append('tipo_cocina', tipo_cocina);
                formData.append('personas', personas);
                formData.append('precio_min_enero', precio_min_enero);
                formData.append('precio_max_enero', precio_max_enero);
                formData.append('precio_min_febrero', precio_min_febrero);
                formData.append('precio_max_febrero', precio_max_febrero);
                formData.append('marzo_diciembre', marzo_diciembre);
                formData.append('marzo_diciembre_precio', marzo_diciembre_precio);
                formData.append('equipado', equipado);
                formData.append('mascotas', mascotas);
                formData.append('valor_adicional', valor_adicional);

                formData.append('PropietariosAgregados', JSON.stringify(PropietariosAgregados));

                formData.forEach(function(value, key) {
                        console.log(key, value);
                    });

                    console.log(formData);

            // Realizar la solicitud AJAX
            $.ajax({
                url: '{{ url("/obrero/propiedades_verano") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // alert('formulario guardado con exito')
                    $('#successModal').modal('show');
                    $('#formModal').modal('hide');
                   
                    
                   
                },
                error: function(xhr) {
                    alert('Error al agregar la propiedad. Intente nuevamente.');
                }


            });

        });
           
           $("#close_success").click(function() {
                $("#successModal").modal('hide');
                location.reload();
            });

            //detalles Propiedad ingresar//
  
             var idPropiedad;
            $(".detalle-propiedad-btn").on('click', function(event) {
                event.preventDefault();
                idPropiedad = $(this).data('id'); // Obtén el ID del botón presionado
                console.log('propiedad: ' + idPropiedad);

                // Establecer el ID de la propiedad en un campo oculto si es necesario
                // $("#idPropiedad").val(idPropiedad); // Asegúrate de tener un campo oculto para el ID
                $("#detallesformModal").modal('show');
            });

   

        // Función para agregar archivos a la lista
        // function addFiles(inputId, selectedArray, listId) {
        //     const input = document.getElementById(inputId);
        //     const list = document.getElementById(listId);

        //     if (input.files.length > 0) {
        //         Array.from(input.files).forEach(file => {
        //             selectedArray.push(file);
        //             const li = document.createElement('li');
        //             li.textContent = file.name; // Muestra el nombre del archivo
        //             list.appendChild(li);
        //         });
        //         input.value = ''; // Resetear el input
        //     } else {
        //         alert(`Por favor, selecciona un ${inputId === 'imagenes' ? 'imagen' : 'video'} antes de agregar.`);
        //     }
        // }
                // Eventos para los inputs de archivos
                // document.getElementById('imagenes').addEventListener('change', (e) => handleFileSelect(e));
                // document.getElementById('videos').addEventListener('change', (e) => handleFileSelect(e, true));

                // document.getElementById('#btn_agregar_verano_detalle').addEventListener('click', () => addFiles('imagenes', imageSeleccionados, 'lista-imagenes'));
                // document.getElementById('agregar-videos').addEventListener('click', () => addFiles('videos', videoSeleccionados, 'lista-videos'));


   
            $('#btn_agregar_verano_detalle').on('click', function(event) {
            event.preventDefault(); // Evitar el envío normal del formulario

            // Obtener los valores de los campos de texto
            var estacionamientos = $("#estacionamientos").val();
            var numEstaciona = $("#num_estaciona").val();
            var piscina = $("#piscina").val();
            var consergeria = $("#Consergeria").val();
            var ascensor = $("#ascensor").val();
            var juegosInfantiles = $("#juegos_infantiles").val();
            var serviLavanderia = $("#servi_lavanderia").val();
            var quinchos = $("#quinchos").val();
            var salaMultiuso = $("#sala_multiuso").val();
            var terraza = $("#terraza").val();
            var servicios = {};
            $("input[name='servicios[]']").each(function() {
                var servicio = $(this).val(); // Nombre del servicio (ejemplo: 'wifi')
                servicios[servicio] = $(this).is(':checked') ? 1 : 0; // 1 si está marcado, 0 si no
            });
            // Crear un nuevo FormData
            var formData = new FormData();

            // Agregar los valores al FormData
            formData.append('estacionamientos', estacionamientos);
            formData.append('num_estaciona', numEstaciona);

            formData.append('piscina', piscina);
            formData.append('Consergeria', consergeria);
            formData.append('ascensor', ascensor);
            formData.append('juegos_infantiles', juegosInfantiles);
            formData.append('servi_lavanderia', serviLavanderia);
            formData.append('quinchos', quinchos);
            formData.append('sala_multiuso', salaMultiuso);
            formData.append('terraza', terraza);

            // Agregar los servicios al FormData
            Object.keys(servicios).forEach(function(key) {
                formData.append(key, servicios[key]); // Clave: nombre del servicio, Valor: 1 o 0
            });

            // Agregar imágenes seleccionadas al FormData (si hay)
            // if (typeof imageSeleccionados !== 'undefined') {
            //     imageSeleccionados.forEach(function(image) {
            //         formData.append('imagenes[]', image);
            //     });
            // }

            //Obtener los archivos seleccionados  
            var files = $('#imagenes')[0].files;                    
            // Iterar sobre los archivos seleccionados y agregarlos al objeto FormData                 
            for (var i = 0; i < files.length; i++) {                        
                var file = files[i];                       
                formData.append('imagenes[]', file);                
                    }

            // Agregar videos seleccionados al FormData (si hay)
            if (typeof videoSeleccionados !== 'undefined') {
                videoSeleccionados.forEach(function(video) {
                    formData.append('videos[]', video);
                });
            }

            // Enviar datos a través de AJAX
            $.ajax({
                url: '/obrero/propiedades_verano_detalles/' + idPropiedad, 
                type: 'POST',
                data: formData, // No convertir a JSON, usar FormData directamente
                processData: false, // No procesar los datos
                contentType: false, // No establecer el contentType, el navegador lo hará
                success: function(response) {
                    // Manejar la respuesta del servidor
                    $('#successModal').modal('show');
                    $('#detallesformModal').modal('hide'); // Cerrar el modal
                },
                error: function(xhr, status, error) {
                    // Manejar el error
                    alert('Error al guardar los datos: ' + error);
                    console.log(xhr.responseJSON.errors); // Mostrar los errores en la consola
                }
            });
        });
        $("#close_success").click(function() {
                $("#successModal").modal('hide');
                location.reload();
            });


    });
  ////MOSTRAR MODAL DE ELIMINAR ///
          // Función de confirmar eliminación de propietario
          $('.borrar-propiedadVera-btn').click(function() {
              var id = $(this).data('id');
                 console.log(id);
               $('#eliminar-idPropiedadVe').val(id);
                 $('#modalEliminarPropiedadVerano').modal('show');
            });

        $('#confirmDelete').click(function(event) {
            event.preventDefault();
            var id = $('#eliminar-idPropiedadVe').val();
            console.log(id);
            $.ajax({
                url: '/obrero/propiedadVeranoestado/' + id,
                type: 'PATCH', // o 'PUT'
                data: {
                    _token: '{{csrf_token()}}',
                    estado: 0 // nuevo estado del propietario
                },
                success: function(data) {
                    console.log(data);
                    $('#modalEliminarPropiedadVerano').modal('hide');
                    $("#modalAlertaAgregar").modal('show');
                    console.log($('#texto_success')); // Comprueba si encuentra el elemento
                    $('#texto_success').text('La Propiedad se ha Ocultado con éxito');
                },
                fail: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error", errorThrown);
                    $("#modalEliminarPropiedadVerano").modal('hide');
                    $("#modalerroreliminar").modal('show');
                    $('#texto_error').text('Error al Ocultar el propietario');
                }

          }); // fin delete

          $("#btn-close").click(function() {
                $("#modalAlertaAgregar").modal('hide');
                location.reload();
            });


          $("#btn_cerrar_error_eliminar").click(function() {
                $("#modalerroreliminar").modal('hide');
                location.reload();
         });

//////////////////funcion para deshabilitar el boton de detalles////////////////////
document.querySelectorAll('.detalle-propiedad-btn').forEach(function(btn) {
    const estado = btn.getAttribute('data-estado');
    if (estado == 1) {
        btn.style.pointerEvents = 'none'; // Deshabilitar clics
        btn.style.opacity = '0.5';       // Indicar visualmente que está deshabilitado
    } else {
        btn.style.pointerEvents = 'auto'; // Habilitar clics
        btn.style.opacity = '1';          // Visualmente habilitado
    }
});

// Función para actualizar el estado dinámicamente
// function actualizarEstadoBoton(id, nuevoEstado) {
//     const boton = document.querySelector(`.detalle-propiedad-btn[data-id="${id}"]`);
//     if (boton) {
//         boton.setAttribute('data-estado', nuevoEstado);
//         if (nuevoEstado == 1) {
//             boton.style.pointerEvents = 'none';
//             boton.style.opacity = '0.5';
//         } else {
//             boton.style.pointerEvents = 'auto';
//             boton.style.opacity = '1';
//         }
//     }
// }



 });


</script>
@endsection
