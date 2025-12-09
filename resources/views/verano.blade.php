@extends('layouts.app')

@section('content')
<div class="container-fluid overflow-hidden" style="background-color: ">
    <div class="row vh-100">
        @include('layouts.sidebar')
        <div class="col d-flex flex-column h-100" style="padding: 0; background-color:rgb(255, 255, 255);">
            <div class="flex-grow-1">
                {{-- Contenido --}}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12" style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px; color: white;">
                            <h1 class="text-uppercase text-black">Propiedades verano</h1>
                        </div>
                    </div>
                </div>
                   {{-- Card propiedades en venta --}}
                <div class="container-fluid">
                   <div class="row mb-4">
                     <div class="col-md-4">
                        <div class="input-group mx-2 shadow-lg" style="max-width: 400px;">
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

                <div class="row scrol">
                    @foreach ($propiedadesVerano as $propiedad)
                        <div class="col-md-3 mb-3">
                            {{-- @if($propiedad->detallesVeranos->isNotEmpty())  <!-- Verifica si la propiedad tiene detalles --> --}}
                                <!-- Envolver toda la tarjeta con el enlace -->
                                {{-- <a href="{{ route('propiedadesVeraDetalles', ['id' => $propiedad->id, 'detalleId' => $propiedad->detallesVeranos->first()->id]) }}" style="text-decoration: none;"> --}}
                                    <a href="propiedadesVeranoDetalles-{{$propiedad->id}}" style="text-decoration:none; color: #000;">
                                    <div class="card shadow position-relative registro tarjeta-propiedad" style="border:none; min-height: 200px;">
                                        @php
                                            // Obtener la primera imagen de los detalles de la propiedad
                                            $imagen = $propiedad->detallesVeranos->flatMap(function ($detalle) {
                                                return $detalle->imagenes;
                                            })->first();
                                            $propietarioverano = \App\Models\PropietarioVerano::where('id_verano', $propiedad->id)->first();
                                            $Subdetalles = \App\Models\DetallesVerano::where('id_verano', $propiedad->id)->first();

                                        @endphp
                                        <div class="card-img-top img-fluid" style="height: 200px; object-fit: cover; background-color: #f5f5f5; display: flex; justify-content: center; align-items: center;">
                                            @if($imagen)
                                                <img src="{{ asset($imagen->link) }}" style="height: 100%; width: 100%; object-fit: cover;" alt="{{ $propiedad->direccion }}" data-imagen-url="{{ asset($imagen->link) }}">
                                            @else
                                                <img src="{{ asset('img/OIP.jpg') }}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="Imagen no disponible" data-imagen-url="{{ asset('images/default-image.png') }}">
                                            @endif
                                        </div>
                            
                                        <!-- Texto extendido dentro de la imagen -->
                                        <div class="texto-propiedad position-absolute bottom-0 start-0 w-100 text-white p-2" style="background: rgba(0, 0, 0, 0.6); font-size: 12px; line-height: 1.2;">
                                            @if($propietarioverano && $propietarioverano->propietario)
                                                <h6 class="detalles"><strong>Propietario:</strong> {{ $propietarioverano->propietario->nombre }}</h6> 
                                            @else
                                                <h6 class="detalles"><strong>Propietario:</strong> Sin propietario</h6>
                                            @endif
                                            <h6 class="detalles"><strong>Condominio:</strong> {{ $propiedad->condominio }}</h6>
                                            <h6 class="detalles"><strong>N° Dpto:</strong> {{ $propiedad->num_apartamento }} </h6>
                                            @if($Subdetalles)
                                                <h6 class="detalles"><strong>N° Estacionamiento:</strong> {{ $Subdetalles->num_estaciona}}</h6>
                                            @endif
                                        </div>
                            
                                        <!-- Iconos sobre la imagen -->
                                        <div class="position-absolute end-0 p-2 d-flex flex-column" style="background: rgba(0, 0, 0, 0.6); top: 75px;">
                                        @if ($propiedad->mostrarBoton)
                                            <a href="#" class="text-primary mb-2 detalle-propiedad-btn mt-3" data-id="{{ $propiedad->id }}" title="Agregar Detalles">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </a>
                                          @endif
                                     

                                            {{-- <a href="#" class="text-success mb-2 btn-Contrato" data-id="{{ $propiedad->id }}" title="Archivo">
                                                <i class="fa-regular fa-folder fa-lg"></i>
                                            </a> --}}
                                            <a href="#" class="text-warning mb-2 btn-mantencion" data-id="{{ $propiedad->id }}" title="Mantencion">
                                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                            </a>
                                            <a href="#" class="text-danger borrar-propiedadVera-btn mb-1" data-id="{{ $propiedad->id }}" title="Borrar">
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
            @include('layouts.footer')
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header" style="background-color: rgb(255, 215, 151); justify-content: center; position: relative;">
                <h5 class="modal-title text-uppercase" id="formModalLabel">Propiedades de verano</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="container">
                        <div class="row mb-4 p-4 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                            <div class="col-lg-12 mb-3">
                                <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white text-center">Detalles de la Propiedad</h5>
                                </div>
                            </div>

                            <!-- Bloque de precios -->
                            <div class="col-md-4 mb-3">
                                <label for="precio_min_enero"><b>Precio mínimo enero</b></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" id="precio_min_enero" placeholder="Ej: 380.000" name="precio_min_enero" required
                                        oninput="this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="precio_max_enero"><b>Precio máximo enero</b></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" id="precio_max_enero" placeholder="Ej: 380.000" name="precio_max_enero" required
                                        oninput="this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="precio_min_febrero"><b>Precio mínimo febrero</b></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" id="precio_min_febrero" placeholder="Ej: 380.000" name="precio_min_febrero" required
                                        oninput="this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="precio_max_febrero" class="form-label"><b>Precio máximo febrero</b></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" id="precio_max_febrero" placeholder="Ej: 380.000" name="precio_max_febrero" required
                                        oninput="this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                </div>
                            </div>




                            <!-- Bloque de dirección -->
                            <div class="col-md-4 mb-3">
                                <label for="direccion"><b>Dirección</b></label>
                                <input type="text" class="form-control" id="direccion" placeholder="Ingrese la dirección">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="ciudad"><b>Ciudad</b></label>
                                <input type="text" class="form-control" id="ciudad" placeholder="Ingrese la ciudad">
                            </div>

                            <!-- Bloque de propietarios -->
                            <div class="col-md-4 mb-3">
                                <label for="sector"><b>Sector</b></label>
                                <input type="text" class="form-control" id="sector" placeholder="Ingrese el sector">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="condominio"><b>Condominio</b></label>
                                <input type="text" class="form-control" id="condominio" placeholder="Ingrese el condominio">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="torre"><b>Torre</b></label>
                                <input type="text" class="form-control" id="torre" placeholder="Ingrese la torre">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="num_apartamento"><b>N° Departamento</b></label>
                                <input type="text" class="form-control" id="num_apartamento" placeholder="Numero del Departamento">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="propietarioInput"><b>Propietarios</b></label>
                                <div class="d-flex justify-content-between">
                                    <select id="propietarioInput" class="form-select me-2">
                                        <option disabled selected value="0">Seleccione un propietario</option>
                                        @foreach ($propietarios as $propietario)
                                        <option value="{{ $propietario->id }}">{{ $propietario->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary" id="agregar-propietario">Agregar</button>
                                </div>
                                <ul class="text-uppercase mt-4 m-1 p-1" id="lista-agregados">
                                    <!-- Aquí se agregarán propietarios -->
                                </ul>
                            </div>
                        </div>
              
         

                     <div class="row mb-3 p-4 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                     
                            <div class="col-md-4 mb-3">
                                <label for="piso"><b>Piso</b></label>
                                <input type="text" class="form-control" id="piso" placeholder="Ingrese el piso">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cantidad_personas"><b>Cantidad de Personas</b></label>
                                <input type="number" class="form-control" id="cantidad_personas" placeholder="Ingrese la cantidad de personas">
                            </div>
                            <div class="col-md-4">
                                <label for="ubicacion"><b>Ubicación</b></label>
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
                                <label for="dormitorios"><b>Dormitorios</b> </label>
                                <input type="text" class="form-control" id="dormitorios" placeholder="Ingrese el numero de dormitorios">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tipo_piso"><b>Tipo de Piso</b></label>       
                                <select class="form-select" id="tipo_piso"> 
                                <option selected disabled > Selecione un tipo de piso</option> 
                                <option value="Cerámico">Cerámico</option>
                                <option value=" Flotante"> Flotante</option>
                                <option value=" Alfombrado"> Alfombrado</option>
                                <option value=" porcelanato"> Porcelanato</option>
                            </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="baños"><b>Baño</b></label>
                                <input type="text" class="form-control" id="baños" placeholder="Ingrese el numero de baños">
                            </div>
                           <div class="col-md-4 mb-3">
                            <label for="tipo_cocina"><b>Tipo de cocina</b></label>
                            <select class="form-select" id="tipo_cocina">
                            <option selected disabled > Selecione un tipo de cocina</option>    
                            <option value="America">America</option>
                            <option value="semi Americana">Semi Americana</option>
                            </select>
                        </div>
                            <div class="col-md-4 mb-3">
                                <label for="equipado"><b>Equipado para</b></label>
                                <input type="text" class="form-control" id="equipado" placeholder="Ingrese detalles de equipado para">
                            </div>
                        
                            <div class="col-md-4 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="mascotas" onchange="valorAdicional.classList.toggle('d-none', !this.checked)">
                                    <label class="form-check-label" for="mascotas">
                                        <b>¿Tiene mascotas?</b>
                                    </label>
                                </div>

                                <div class="col-md-12 mb-3 d-none" id="valorAdicional">
                                    <label for="valor_adicional"><b>Valor Adicional</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" id="valor_adicional" 
                                            placeholder="Ej: 380.000" name="valor_adicional" required
                                            oninput="this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center" style="background-color: rgb(255, 215, 151);">
                <button class="btn btn-primary" id="btn_agregar_verano">Guardar</button>
                <button type="button" id="btn_cerrar_agregar" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div> 
</div>
   
       


<div class="modal fade" id="ModalMantencion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="ModalMantencionLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Mantenciones</h5>
                        <button type="button" class="btn-close" id="" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div id="mantencionesContainer">
                                <div class="row p-2 mantencion-item" style="background-color: #FFE2B2; border-radius: .9rem; margin-bottom: 10px;">
                                    <div class="col-lg-6 mb-3">
                                        <label for="nombremantenimiento">Nombre del Mantenimiento</label>
                                        <input type="text" class="form-control " id="nombremantenimiento" placeholder="Ingrese el nombre del mantenimiento" required>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="descripcionmantenimiento">Descripción</label>
                                        <textarea class="form-control " id="descripcionmantenimiento" placeholder="Ingrese la descripción del mantenimiento" required></textarea>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="mantenimiento">Fecha de Mantenimiento</label>
                                        <input type="date" class="form-control "id="mantenimiento" required>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="cadamantenimiento">Cada Cuántos Meses</label>
                                        <input type="number" class="form-control " id="cadamantenimiento" placeholder="Ingrese la cantidad de meses para la mantención" required>
                                    </div>
                                    <div class="col-lg-12 text-end">
                                        <button type="button" class="btn btn-primary" id="agregar-mantencion">Agregar Mantención</button>
                                    </div>
                                </div>
                            </div>
                            <div id="lista-mantenciones" class="mt-3"></div>
                            <!-- <button type="button" class="btn btn-secondary mt-3" id="addMantencion">Agregar Mantenimiento</button> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="guardar-mantenciones">Guardar Todo</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
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
    <div class="modal fade" id="detallesformModal" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="detallesformModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modal-xl">
                <!-- Header del Modal -->
                <div class="modal-header" style="background-color: #FFE2B2; justify-content: center; position: relative;">
                    <h5 class="modal-title text-uppercase" id="detallesformModalLabel"
                        style="color: #4A4A4A; text-align: center; font-size: 1.5rem;">Detalles de la Propiedad de Verano</h5>
                    <button type="button" class="Close btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="position: absolute; right: 1rem; top: 1rem;"></button>
                </div>
     
    
                <div class="modal-body">
                    <form id="arriendoForm" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row g-3 shadow m-1 p-3 mb-3" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="col-md-6">
                                    <!-- Checkbox de Estacionamiento -->
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="detalle_estacionamiento" onclick="document.getElementById('campoEstacionamiento').classList.toggle('d-none')">
                                        <label class="form-check-label" for="detalle_estacionamiento"><b>¿Tiene Estacionamiento?</b></label>
                                    </div>
    
                                    <!-- Campo adicional oculto por defecto -->
                                    <div id="campoEstacionamiento" class="d-none">
                                        <!-- <label for="estacionamientos" class="form-label"><b>Detalle del Estacionamiento</b></label> -->
                                        <input type="text" class="form-control" id="estacionamientos" name="estacionamientos" placeholder="Ej: Subterráneo, número, etc.">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="piscina" class="form-label"><b>Piscina</b></label>
                                    <select class="form-select" id="piscina" name="piscina" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ascensor" class="form-label"><b>Ascensor</b></label>
                                    <select class="form-select" id="ascensor" name="ascensor" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="quinchos" class="form-label"><b>Quinchos</b></label>
                                    <select class="form-select" id="quinchos" name="quinchos" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="juegos_infantiles" class="form-label"><b>Juegos Infantiles</b></label>
                                    <select class="form-select" id="juegos_infantiles" name="juegos_infantiles" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="sala_multiuso" class="form-label"><b>Sala Multiusos</b></label>
                                    <select class="form-select" id="sala_multiuso" name="sala_multiuso" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="terraza" class="form-label"><b>Terraza</b></label>
                                    <select class="form-select" id="terraza" name="terraza" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="servi_lavanderia" class="form-label"><b>Servicio de Lavandería</b></label>
                                    <select class="form-select" id="servi_lavanderia" name="servi_lavanderia" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
    
                            <div class="row g-3 m-1 shadow mb-4" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="col-12 mb-4">
                                    <label class="form-label fw-bold" style="font-size: 1.2rem;">Servicios</label>
                                    <div class="d-flex justify-content-center align-items-center" style="gap: 4cm;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="cable" name="servicios[]" value="cable">
                                            <label class="form-check-label" for="cable"><b>Cable</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="wifi" name="servicios[]" value="wifi">
                                            <label class="form-check-label" for="wifi"><b>Wifi</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="lavadora" name="servicios[]" value="lavadora">
                                            <label class="form-check-label" for="lavadora"><b>Lavadora</b></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sabanas" name="servicios[]" value="sabanas">
                                            <label class="form-check-label" for="sabanas"><b>Sabanas</b></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 m-1 shadow mb-4" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <!-- Sección de Agregar Imágenes -->
                                <div class="col-12 mb-3">
                                    <label for="imagenes" class="form-label"><b>Agregar imágenes</b></label>
                                    <input class="form-control" type="file" id="imagenes" name="imagenes[]" accept="image/*" multiple>
                                    <div class="mt-2" id="imagePreview"></div>
                                </div>
                                <!-- Fin Sección de Agregar Imágenes -->
    
                                <!-- Sección de Agregar Videos -->
                                <div class="col-12 mb-3">
                                    <label for="videos" class="form-label"><b>Agregar videos</b></label>
                                    <input class="form-control" type="file" id="videos" name="videos[]" accept="video/*" multiple>
                                    <div class="mt-2" id="videoPreview"></div>
                                </div>
                                <!-- Fin Sección de Agregar Videos -->
                            </div>
    
                        </div>
                    </div>
                    <div class="modal-footer" style="background-color: #FFE2B2;">
                        <button type="submit" class="btn btn-primary" id="btn_agregar_verano_detalle">Guardar</button>
                        <button type="button" id="btn_cerrar_agregar" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
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
                                Accion Realizada con exito
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
    .scrol {
    max-height: 420px; /* Altura máxima del contenedor */
    overflow-y: auto;  /* Habilita el scroll vertical */
    scrollbar-width: thin; /* Para navegadores modernos, hace el scroll más delgado */
    scrollbar-color: #dc3545 #f8f9fa; /* Color del scroll (primero: barra, segundo: fondo) */
    }
    .tarjeta-propiedad .texto-propiedad {
        transition: opacity 0.3s ease;
    }
    
    .tarjeta-propiedad:hover .texto-propiedad {
        opacity: 0;
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
        $("#buscador_cnn").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".registro").each(function() {
                var cardText = $(this).find('.detalles').text().toLowerCase();
                console.log(value, cardText); // Depuración
                if (cardText.includes(value)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
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
                    url: '/obtenerVe/propietarioVeNombre',
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
        $(".btn-mantencion").on('click', function(event) {
                event.preventDefault();
                var id_propiedad = $(this).data('id');
                console.log('id de la propiedad', id_propiedad);
                $("#agregar-mantencion").data('id_propiedad', id_propiedad);

                // alert('boton correcto');
                $("#ModalMantencion").modal('show');

            });
            $(document).ready(function () {
                var MantencionesAgregadas = [];
                var lista = $("#lista-mantenciones");

                // Función para agregar una nueva mantención al arreglo y lista visual
                $("#agregar-mantencion").on('click', function (event) {
                    event.preventDefault();

                    var id_propiedad = $(this).data('id_propiedad');
                    // Obtener los valores de los campos de entrada
                    var nombre = $("#nombremantenimiento").val();
                    var descripcion = $("#descripcionmantenimiento").val();
                    var fecha = $("#mantenimiento").val();
                    var meses = $("#cadamantenimiento").val();
                    var arg = {
                        id_propiedad:id_propiedad,
                        nombre:nombre,
                        descripcion:descripcion,
                        fecha:fecha,
                        meses:meses
                    }
                    console.log('argumentos:',arg);

                    // Validar que todos los campos estén completos
                    if (nombre && descripcion && fecha && meses) {
                        // Crear un objeto para la mantención
                        var mantencion = { nombre, descripcion, fecha, meses, id_propiedad};

                        // Agregar al arreglo de mantenciones
                        MantencionesAgregadas.push(mantencion);
                        console.log('mantencion agregada:', mantencion);

                        // Limpiar los campos después de agregar
                        $("#nombremantenimiento").val('');
                        $("#descripcionmantenimiento").val('');
                        $("#mantenimiento").val('');
                        $("#cadamantenimiento").val('');

                        // Actualizar la lista visual
                        actualizarListaMantenciones();
                    } else {
                        alert("Por favor, complete todos los campos antes de agregar una mantención.");
                    }
                });

                function actualizarListaMantenciones() {
                lista.empty(); // Vaciar la tabla antes de volver a llenarla

                // Crear la cabecera de la tabla
                var table = $("<table>")
                    .addClass("table table-bordered")
                    .append(
                        $("<thead>").append(
                            $("<tr>")
                                .append($("<th>").text("ID Propiedad"))
                                .append($("<th>").text("Nombre"))
                                .append($("<th>").text("Descripción"))
                                .append($("<th>").text("Fecha de Mantención"))
                                .append($("<th>").text("Cada Cuántos Meses"))
                                .append($("<th>").text("Próxima Fecha de Mantención"))
                                // .append($("<th>").text("Fecha de Envío de Correo"))
                                .append($("<th>").text("Acciones"))
                        )
                    );

                var tbody = $("<tbody>");

                // Iterar sobre las mantenciones agregadas y agregarlas a la tabla
                MantencionesAgregadas.forEach(function (mantencion, index) {
                    // Calcular la próxima fecha de mantención
                    var fechaInicial = new Date(mantencion.fecha);
                    var proximaFecha = new Date(fechaInicial.setMonth(fechaInicial.getMonth() + parseInt(mantencion.meses)));

                    // Formatear la próxima fecha en formato YYYY-MM-DD
                    var proximaFechaFormatted = proximaFecha.toISOString().split("T")[0];

                    // Calcular la fecha de envío (un mes antes de la próxima fecha)
                    var fechaEnvio = new Date(proximaFecha);
                    fechaEnvio.setMonth(fechaEnvio.getMonth() - 1);

                    // Formatear la fecha de envío en formato YYYY-MM-DD
                    var fechaEnvioFormatted = fechaEnvio.toISOString().split("T")[0];

                    // Actualizar el objeto mantencion con la próxima fecha calculada y la fecha de envío
                    mantencion.proximaFecha = proximaFechaFormatted;
                    mantencion.fechaEnvio = fechaEnvioFormatted;

                    var row = $("<tr>")
                        .append($("<td>").text(mantencion.id_propiedad)) // Mostrar ID de la propiedad
                        .append($("<td>").text(mantencion.nombre))
                        .append($("<td>").text(mantencion.descripcion))
                        .append($("<td>").text(mantencion.fecha))
                        .append($("<td>").text(mantencion.meses))
                        .append($("<td>").text(proximaFechaFormatted))
                        // .append($("<td>").text(fechaEnvioFormatted)) // Mostrar la fecha de envío del correo
                        .append(
                            $("<td>").append(
                                $("<button>")
                                    .html('<i class="fas fa-trash-alt fa-lg text-danger"></i>')
                                    .addClass("btn btn-sm btn-link")
                                    .on("click", function () {
                                        eliminarMantencion(index);
                                    })
                            )
                        );

                    tbody.append(row);
                });
                                // Agregar el cuerpo de la tabla al contenedor
                                table.append(tbody);
                lista.append(table);
            }

                // Función para eliminar una mantención del arreglo y lista visual
                function eliminarMantencion(index) {
                    MantencionesAgregadas.splice(index, 1); // Eliminar del arreglo
                    actualizarListaMantenciones(); // Actualizar la lista visual
                }

                // Función para guardar las mantenciones en el servidor mediante AJAX
                $("#guardar-mantenciones").on('click', function (event) {
                    event.preventDefault();

                    if (MantencionesAgregadas.length > 0) {
                        $.ajax({
                            url: '/guardar/mantenciones', // Ruta del backend para guardar
                            type: 'POST',
                            data: {
                                mantenciones: MantencionesAgregadas,
                            },
                            success: function (response) {
                                alert("Mantenciones guardadas exitosamente.");
                                MantencionesAgregadas = []; // Limpiar el arreglo
                                actualizarListaMantenciones(); // Vaciar la lista visual
                            },
                            error: function (xhr, status, error) {
                                console.error("Error al guardar las mantenciones:", error);
                                alert("Hubo un problema al guardar las mantenciones.");
                            }
                        });
                    } else {
                        alert("No hay mantenciones para guardar.");
                    }
                });
            });


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
              var  ciudad = $('#ciudad').val();
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
                formData.append('ciudad', ciudad);

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
                url: '{{ url("/propiedades_verano") }}',
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

                // document.getElementById('#').addEventListener('click', () => addFiles('imagenes', imageSeleccionados, 'lista-imagenes'));
                // document.getElementById('agregar-videos').addEventListener('click', () => addFiles('videos', videoSeleccionados, 'lista-videos'));


   
        $('#btn_agregar_verano_detalle').on('click', function(event) {
            event.preventDefault(); // Evitar el envío normal del formulario
            
            var camposVacios = false; // Variable para verificar si hay campos vacíos

            // Limpiar mensajes anteriores
            $(".campo-error").remove();

            // Obtener los valores de los campos de texto
            var estacionamientos = $("#estacionamientos").val();
            // var numEstaciona = $("#num_estaciona").val();
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
                // Validar los campos y mostrar el mensaje de advertencia si están vacíos
                if (!estacionamientos) {
                    mostrarError("#estacionamientos");
                    camposVacios = true;
                }
                // if (!numEstaciona) {
                //     mostrarError("#num_estaciona");
                //     camposVacios = true;
                // }
                if (!piscina) {
                    mostrarError("#piscina");
                    camposVacios = true;
                }
                if (!consergeria) {
                    mostrarError("#Consergeria");
                    camposVacios = true;
                }
                if (!ascensor) {
                    mostrarError("#ascensor");
                    camposVacios = true;
                }
                if (!juegosInfantiles) {
                    mostrarError("#juegos_infantiles");
                    camposVacios = true;
                }
                if (!serviLavanderia) {
                    mostrarError("#servi_lavanderia");
                    camposVacios = true;
                }
                if (!quinchos) {
                    mostrarError("#quinchos");
                    camposVacios = true;
                }
                if (!salaMultiuso) {
                    mostrarError("#sala_multiuso");
                    camposVacios = true;
                }
                if (!terraza) {
                    mostrarError("#terraza");
                    camposVacios = true;
                } else {
                console.log('Todo Correcto');

                // Crear un nuevo FormData
                var formData = new FormData();

                // Agregar los valores al FormData
                formData.append('estacionamientos', estacionamientos);
                // formData.append('num_estaciona', numEstaciona);

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
                    url: 'propiedades_verano_detalles/' + idPropiedad, 
                    type: 'POST',
                    data: formData, // No convertir a JSON, usar FormData directamente
                    processData: false, // No procesar los datos
                    contentType: false, // No establecer el contentType, el navegador lo hará
                    success: function(response) {
                        console.log(response);
                        // Manejar la respuesta del servidor
                        $('#successModal').modal('show');
                        $('#detallesformModal').modal('hide'); // Cerrar el modal
                    },
                    error: function(xhr, status, error) {
                        // Manejar el error
                        alert('Error al guardar los datos: ' + error);
                        console.log('error',error); // Mostrar los errores en la consola
                    }
                });
            }
        });
        function mostrarError(campo) {
            if ($(campo).next(".campo-error").length === 0) {
                $(campo).after('<div class="campo-error" style="color: red; font-size: 12px;">Por favor complete este campo.</div>');
                }
            }
        });
        $("#close_success").click(function() {
            $("#successModal").modal('hide');
            location.reload();
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
                url: '/propiedadVeranoestado/' + id,
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
