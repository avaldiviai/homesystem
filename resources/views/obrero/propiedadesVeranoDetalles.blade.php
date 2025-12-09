@extends('layouts.app')

@section('content')
<div class="container-fluid overflow-hidden" style="background-color: #FFAB40">
    <div class="row overflow-auto">
        @include('layouts.sidebar_obrero')
        <div class="col d-flex flex-column h-100" style="padding: 0; background-color: #FFAB40;">
            <div class="flex-grow-1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8" style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px; color: white;">
                            <h1>Detalles De La Propiedad</h1>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-check form-switch bg-dark d-flex align-items-center container p-2" 
                                style="margin-top: 40px; margin-bottom: 30px; color: white; border-radius: .9rem;">
                                <div class="col-lg-10">
                                    <div id="estado" class="text-uppercase m-0 ">Deshabilitado para editar</div> <!-- Texto a la izquierda -->
                                </div>
                                <div class="col-lg-2 d-flex align-items-center justify-content-end">
                                    <input class="form-check-input m-2" type="checkbox" id="interruptor" 
                                    style="transform: scale(1.5); width: 40px; height: 17px;"> <!-- Checkbox a la derecha -->
                                </div>
                            </div>
                        </div>
                        <hr class="mb-2" style="border: 1px solid #000;">
                        <div class="form-group col-lg-6 ">
                            <label for="propietarioInput"><b>Propietarios</b></label>
                            <div class="d-flex justify-content-between ">
                                <select id="propietarioInput" class="form-select me-2" disabled>
                                    <option disabled selected value="0">Seleccione un propietario</option>
                                    @foreach ($new_Propietarios as $propietario)
                                    <option value="{{ $propietario->id}}">{{ $propietario->nombre }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" id="agregar-propietario">Agregar</button>
                            </div>
                            <ul class="text-uppercase mt-4 m-1 p-1 m-4" id="lista-agregados">
                                <!-- <button class="btn btn-danger"><i class="fas fa-trash-alt fa-lg text-white"></i></button> -->
                            </ul>
                        </div>


                        <form id="propiedadVeraForm" method="POST">
                            @csrf

                            <div class="col-lg-12 mb-3">
                                <strong class="d-block mb-3">Todos los Propietarios</strong>
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    @foreach($propietarios as $prop)
                                    <div class="input-group" style="width: auto;">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-user-tie"></i>
                                        </span>
                                        <input type="text" class="form-control" value="{{ $prop->propietario->nombre }}" disabled style="min-width: 200px;">
                                        <span class="input-group-text">
                                            <a href="javascript(0)" id="btn-eliminarPro" data-id="{{$prop->id}}" class="delete-propietario"><i class="fas fa-trash-alt fa-lg" style="color: red;"></i></a>
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr class="mb-2" style="border: 1px solid #000;">
                        <div class="row">  
                            <div class="col-lg-4 mb-3">
                                <label for="direccion">Direccion</label>
                                <input type="text" id="direccion" class="form-control" disabled value="{{$propiedadVe->direccion}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="sector">Sector</label>
                                <input type="text" class="form-control" id="sector" disabled name="sector" value="{{$propiedadVe->sector }}" placeholder="Ingrese el sector">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="condominio">Condominio</label>
                                <input type="text" class="form-control" id="condominio" disabled  name="condominio" value="{{$propiedadVe->condominio }}" placeholder="Ingrese el condominio">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="torre">Torre</label>
                                <input type="text" class="form-control" id="torre" disabled  name="torre" value="{{ $propiedadVe->torre }}" placeholder="Ingrese la torre">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="num_apartamento">N° de Apartamento</label>
                                <input type="text" class="form-control" id="num_apartamento" disabled  name="num_apartamento" value="{{$propiedadVe->num_apartamento}}" placeholder="Ingrese el numero">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="piso">Piso</label>
                                <input type="text" class="form-control" id="piso" disabled  name="piso" value="{{$propiedadVe->piso}}" placeholder="Ingrese el piso">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cantidad_personas">Cantidad de Personas</label>
                                <input type="number" class="form-control" id="cantidad_personas" disabled  name="cantidad_personas" value="{{$propiedadVe->personas}}" placeholder="Ingrese la cantidad de personas">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="ubicacion">Ubicación</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" disabled  name="ubicacion" id="playa" value="playa" {{ $propiedadVe->ubicacion == 'playa' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="playa">Playa</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" disabled  name="ubicacion" id="centro" value="centro" {{ $propiedadVe->ubicacion == 'centro' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="centro">Centro</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" disabled  name="ubicacion" id="ambos" value="ambos" {{ $propiedadVe->ubicacion == 'ambos' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="ambos">Ambos</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dormitorios">Dormitorios</label>
                                <input type="text" class="form-control" id="dormitorios" disabled name="dormitorios" value="{{ $propiedadVe->dormitorios }}" placeholder="Ingrese el número de dormitorios">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tipo_piso">Tipo de Piso</label>
                                <select class="form-select" id="tipo_piso"disabled  name="tipo_piso">
                                    <option selected disabled>Seleccione un tipo de piso</option>
                                    <option value="cerámico" {{$propiedadVe->Tpiso_dormitorios == 'cerámico' ? 'selected' : '' }}>Cerámico</option>
                                    <option value="flotante" {{$propiedadVe->Tpiso_dormitorios == 'flotante' ? 'selected' : '' }}>Flotante</option>
                                    <option value="alfombrado" {{$propiedadVe->Tpiso_dormitorios == 'alfombrado' ? 'selected' : '' }}>Alfombrado</option>
                                    <option value="porcelanato" {{$propiedadVe->Tpiso_dormitorios == 'porcelanato' ? 'selected' : '' }}>Porcelanato</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="baños">Baños</label>
                                <input type="text" class="form-control" id="baños" disabled  name="baños" value="{{ old('baños', $propiedadVe->baños) }}" placeholder="Ingrese el número de baños">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tipo_cocina">Tipo de Cocina</label>
                                  <select class="form-select" id="tipo_cocina" disabled  name="tipo_cocina">
                                    <option selected disabled>Seleccione un tipo de cocina</option>
                                    <option value="America" {{ $propiedadVe->tipo_cocina == 'America' ? 'selected' : '' }}>America</option>
                                    <option value="semi Americana" {{ $propiedadVe->tipo_cocina == 'semi Americana' ? 'selected' : '' }}>Semi Americana</option>
                                   </select>
                            </div>
                            <hr class="mb-2" style="border: 1px solid #000;">
                            <div class="col-md-4 mb-3">
                                <label for="precio_min_enero">Precio Mínimo Enero</label>
                                <input type="number" class="form-control" id="precio_min_enero" disabled  name="precio_min_enero" value="{{ $propiedadVe->precio_min_enero }}" placeholder="Ingrese el precio de enero">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="precio_max_enero">Precio Máximo Enero</label>
                                <input type="number" class="form-control" id="precio_max_enero" disabled  name="precio_max_enero" value="{{$propiedadVe->precio_max_enero }}" placeholder="Ingrese el precio de enero">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="precio_min_febrero">Precio Mínimo Febrero</label>
                                <input type="number" class="form-control" id="precio_min_febrero" disabled  name="precio_min_febrero" value="{{$propiedadVe->precio_min_febrero }}" placeholder="Ingrese el precio de febrero">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="precio_max_febrero">Precio Máximo Febrero</label>
                                <input type="number" class="form-control" id="precio_max_febrero" disabled  name="precio_max_febrero" value="{{ $propiedadVe->precio_max_febrero }}" placeholder="Ingrese el precio de febrero">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="precio_marzo_diciembre">Precio Marzo a Diciembre</label>
                                <select class="form-select mt-2" id="precio_marzo_diciembre"  disabled  name=" precio_marzo_diciembre">
                                    <option selected disabled>Seleccione una opción</option>
                                    <option value="Si" {{  $propiedadVe->marzo_diciembre == 'Si' ? 'selected' : '' }}>Sí</option>
                                    <option value="No" {{  $propiedadVe->marzo_diciembre == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="marzo_diciembre_precio">Precio Marzo a Diciembre</label>
                                <input type="number" class="form-control" id="marzo_diciembre_precio" disabled name="marzo_diciembre_precio" value="{{$propiedadVe->marzo_diciembre_precio }}" placeholder="Ingrese el precio">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="equipado">Equipado para</label>
                                <input type="text" class="form-control" id="equipado" name="equipado" disabled value="{{ $propiedadVe->equipado }}" placeholder="Ingrese detalles de equipado para">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="mascotas">Mascotas</label>
                                <select class="form-control" id="mascotas" disabled  name="mascotas">
                                    <option selected disabled>Seleccione una opción</option>
                                    <option value="si" {{  $propiedadVe->mascotas == 'si' ? 'selected' : '' }}>Sí</option>
                                    <option value="no" {{ $propiedadVe->mascotas == 'no' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="valor_adicional">Valor Adicional</label>
                                <input type="text" class="form-control" id="valor_adicional" disabled name="valor_adicional" value="{{ $propiedadVe->valor_adicional }}" placeholder="Ingrese el valor adicional">
                            </div>
                        </div>
                        <hr class="mb-2" style="border: 1px solid #000;">

                        <div class="imagenes-detalle">
                            <h4 class="mb-4">Imgenes de la Propiedad {{ $propiedadVe->nombre }}</h4>
                            @if($imagenes && $imagenes->count())
                                <div class="row">
                                    @foreach($imagenes as $imagen)
                                        <div class="col-md-4 col-sm-6 mb-3">
                                            <div class="card shadow-sm">
                                                <img src="{{ asset($imagen->link) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Imagen del detalle">
                                                <div class="card-body text-center">
                                                    <a href="javascript:void(0)" data-id="{{$imagen->id}}" id="btn-checkPro" class="d-flex align-items-center portada">
                                                        <i class="fas fa-check fa-lg" style="color: green;"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm" style="border: none; background: none; padding: 0;" onclick="confirmarEliminacion({{ $imagen->id }})" data-bs-toggle="modal" data-bs-target="#modalEliminarImagen">
                                                        <i class="fas fa-trash" style="color: #e92b12; font-size: 1.5rem;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No hay imágenes disponibles para este detalle.</p>
                            @endif
                        </div> 

                        <div class="videos-detalle">
                            <h4 class="mb-4">Videos de la Propiedad {{ $propiedadVe->nombre }}</h4>
                            @if($videos && $videos->count())
                                <div class="row">
                                    @foreach($videos as $video)
                                        <div class="col-md-4 col-sm-6 mb-3">
                                            <div class="card shadow-sm">
                                                {{-- Video Player --}}
                                                <video controls class="card-img-top" style="height: 200px; object-fit: cover;">
                                                    <source src="{{ asset($video->link) }}" type="video/mp4">
                                                    Tu navegador no soporta la reproducción de videos.
                                                </video>
                                                <div class="card-body text-center">
                                                    {{-- Botón de acción para marcar o realizar una acción con el video --}}
                                                    <a href="javascript:void(0)" data-id="{{ $video->id }}" id="btn-checkProVideo" class="d-flex align-items-center portada">
                                                        <i class="fas fa-check fa-lg" style="color: green;"></i>
                                                    </a>
                                                    {{-- Botón para eliminar el video --}}
                                                    <button type="button" class="btn btn-sm" style="border: none; background: none; padding: 0;" onclick="confirmarEliminacionVideo({{ $video->id }})" data-bs-toggle="modal" data-bs-target="#modalEliminarVideo">
                                                        <i class="fas fa-trash" style="color: #e92b12; font-size: 1.5rem;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No hay videos disponibles para este detalle.</p>
                            @endif
                        </div>
                        

                        <div class="container mt-4">
                            <div class="row justify-content-center mt-3">
                                <div class="col-md-6">
                                    <div class="upload-container"  id="dropZone">
                                        <input type="file" id="fileInput" disabled  accept="image/png, image/jpeg, image/gif" multiple hidden>
                                        <div>
                                            <i class="bi bi-upload fs-1"></i>
                                            <p class="mb-1">Haga clic para cargar o arrastre y suelte</p>
                                            <p class="small text-muted">PNG, JPG, GIF hasta 10MB cada uno</p>
                                        </div>
                                        <div id="preview" class="d-flex flex-wrap justify-content-center mt-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="mb-2" style="border: 1px solid #000;">                         
                            <div class="row">
                                <h4>Servicios y Amenidades</h4>
                                <!-- Estacionamientos -->
                                <div class="col-md-6 mb-3">
                                    <label for="estacionamientos">Estacionamiento</label>
                                    <select class="form-select" id="estacionamientos" disabled  name="estacionamientos" required>
                                        <option selected disabled > Selecione una opcion</option>
                                        <option value="Si" {{ $detalle && $detalle->estacionamientos == 'Si' ? 'selected' : '' }}>Si</option>
                                        <option value="No" {{ $detalle && $detalle->estacionamientos == 'No' ? 'selected' : '' }}>No</option>
                                        
                                    </select>
                                </div>
                    
                                <!-- N° Estacionamiento -->
                                <div class="col-md-6 mb-3">
                                    <label for="num_estaciona">N° Estacionamiento</label>

                                    <input type="number" class="form-control" id="num_estaciona" disabled name="num_estaciona" value="{{$detalle && $detalle->num_estaciona }}" placeholder="Ingrese el número de estacionamiento">
                                  
                                </div>
                    
                                <!-- Servicios -->
                                <div class="col-6 mb-3">
                                    <label for="servicios">Servicios</label>
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="wifi" disabled name="servicios[]" value="wifi" {{$detalle && $detalle->wifi ? 'checked' : '' }}>
                                        <label class="form-check-label" for="wifi">Wifi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cable" disabled  name="servicios[]" value="cable" {{$detalle && $detalle->cable ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cable">Cable</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="lavadora" disabled  name="servicios[]" value="lavadora" {{ $detalle && $detalle->lavadora ? 'checked' : '' }}>
                                        <label class="form-check-label" for="lavadora">Lavadora</label>
                                    </div>
                                </div>
                            
                
                                <!-- Piscina -->
                                <div class="col-md-6 mb-3">
                                    <label for="piscina">Piscina</label>
                                    <select class="form-select" id="piscina" disabled name="piscina" required>
                                        <option selected disabled > Selecione una opcion</option>
                                        <option value="Si" {{$detalle &&   $detalle->piscina == 'Si' ? 'selected' : '' }}>Si</option>
                                        <option value="No" {{ $detalle &&  $detalle->piscina == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                    
                                <!-- Consergeria -->
                                <div class="col-md-6 mb-3">
                                    <label for="Consergeria">Consergeria</label>
                                    <select class="form-select" id="Consergeria"disabled  name="Consergeria" required>
                                        <option selected disabled > Selecione una opcion</option>
                                        <option value="Si" {{$detalle &&  $detalle->Consergeria == 'Si' ? 'selected' : '' }}>Si</option>
                                        <option value="No" {{ $detalle && $detalle->Consergeria == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                    
                                <!-- Ascensor -->
                                <div class="col-md-6 mb-3">
                                    <label for="ascensor">Ascensor</label>
                                    <select class="form-select" id="ascensor" disabled name="ascensor" required>
                                        <option selected disabled > Selecione una opcion</option>
                                        <option value="Si" {{ $detalle && $detalle->ascensor == 'Si' ? 'selected' : '' }}>Si</option>
                                        <option value="No" {{$detalle &&  $detalle->ascensor == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                    
                                <!-- Juegos Infantiles -->
                                <div class="col-md-6 mb-3">
                                    <label for="juegos_infantiles">Juegos Infantiles</label>
                                    <select class="form-select" id="juegos_infantiles" disabled name="juegos_infantiles" required>
                                        <option selected disabled > Selecione una opcion</option>
                                        <option value="Si" {{ $detalle &&  $detalle->juegos_infantiles == 'Si' ? 'selected' : '' }}>Si</option>
                                        <option value="No" {{ $detalle &&  $detalle->juegos_infantiles == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                    
                                <!-- Servicio de Lavandería -->
                                <div class="col-md-6 mb-3">
                                    <label for="servi_lavanderia">Servicio de Lavandería</label>
                                    <select class="form-select" id="servi_lavanderia" disabled name="servi_lavanderia" required>
                                        <option selected disabled > Selecione una opcion</option>
                                        <option value="Si" {{  $detalle && $detalle->servi_lavanderia == 'Si' ? 'selected' : '' }}>Si</option>
                                        <option value="No" {{ $detalle && $detalle->servi_lavanderia == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                    
                                <!-- Quinchos -->
                                <div class="col-md-6 mb-3">
                                    <label for="quinchos">Quinchos</label>
                                    <select class="form-select" id="quinchos" disabled  name="quinchos" required>
                                        <option selected disabled > Selecione una opcion</option>
                                        <option value="Si" {{ $detalle && $detalle->quinchos == 'Si' ? 'selected' : '' }}>Si</option>
                                        <option value="No" {{$detalle &&  $detalle->quinchos == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                    
                                <!-- Sala Multiusos -->
                                <div class="col-md-6 mb-3">
                                    <label for="sala_multiuso">Sala Multiusos</label>
                                    <select class="form-select" id="sala_multiuso" disabled name="sala_multiuso" required>
                                        <option selected disabled > Selecione una opcion</option>
                                        <option value="Si" {{ $detalle &&  $detalle->sala_multiuso == 'Si' ? 'selected' : '' }}>Si</option>
                                        <option value="No" {{$detalle &&  $detalle->sala_multiuso == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                    
                                <!-- Terraza -->
                                <div class="col-md-6 mb-3">
                                    <label for="terraza">Terraza</label>
                                    <select class="form-select" id="terraza" disabled name="terraza" required>
                                        <option selected disabled > Selecione una opcion</option>
                                        <option value="Si" {{ $detalle &&  $detalle->terraza == 'Si' ? 'selected' : '' }}>Si</option>
                                        <option value="No" {{ $detalle &&  $detalle->terraza == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>  
                              
                        
                   
                                <hr class="mb-2" style="border: 1px solid #000;">
                            <div class="col-lg-12 mb-3 mt-3 d-flex justify-content-end">
                                <a href="/verano" class="btn btn-danger mt-4">Volver</a>
                                <button type="submit" class="btn btn-primary mt-4"  id="btn_editar" data-id="{{ $propiedadVe->id }}">Guardar Edicion</button>
          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                       
                        

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
                                      <p id="texto_success" class="text-uppercase">Datos Actualizados con exito
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

               <div class="modal fade" id="modalinfo" tabindex="-1" aria-labelledby="modalinfoLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
            <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                <h5 class="m-4 text-uppercase text-center" id="text-info"></h2>
                    <div class="modalfooter d-flex justify-content-center">
                        <button type="button" class="btn btn-danger m-2"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="confirmDelete" class="btn btn-secondary m-2">Eliminar</button>
                    </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="portada" tabindex="-1" aria-labelledby="portadaLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-primary d-flex align-items-center" id="alerta" role="alert">
            <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                <h5 class="m-4 text-uppercase text-center" id="text-info-portada"></h5>
                    <div class="modalfooter d-flex justify-content-center">
                        <button type="button" class="btn btn-danger m-2"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="confirmCambio" class="btn btn-warning m-2">Cambiar</button>
                    </div>
            </div>
        </div>
    </div>
</div>

<!--MODAL DE CONFIRMAR PARA ELIMINAR -->
<div class="modal fade" id="modalEliminarImagen" tabindex="-1" aria-labelledby="modalEliminarImagenLabel" aria-hidden="true"
     data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
            <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.0); border: none;">
                <h5 class="m-4 text-uppercase text-center">¿Seguro que quieres eliminar esta imagen?</h5>
                <input type="hidden" id="eliminar-idImagen">
                <div class="modalfooter d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary m-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="confirmDeleteImage" class="btn btn-danger m-2">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
 </div>
</div>

@section('javascript')
@parent
<script>
   function confirmarEliminacion(id) {
    const inputId = document.getElementById('eliminar-idImagen');
    if (inputId) {
        inputId.value = id; // Asigna el ID de la imagen al campo oculto
    }
}

document.getElementById('confirmDeleteImage').addEventListener('click', function () {
    const id = document.getElementById('eliminar-idImagen').value;
    if (id) {
        // Lógica para enviar la solicitud de eliminación al servidor
        fetch(`/obrero/imagenes/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => {
            if (response.ok) {
                location.reload(); // Refresca la página tras la eliminación
            
            }
        }).catch(error => console.error('Error:', error));
    }
});

</script>
<script>

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
$(".delete-propietario").on('click', function() {
        event.preventDefault();
        var idPropietario = $(this).data('id');
        console.log('id propietario: ' + idPropietario);

        // Mostrar el modal de confirmación
        $("#modalinfo").modal('show');
        $('#text-info').text('¿Seguro/a que quieres Eliminar este Propietario?');

        // Manejar el clic en el botón de confirmación
        $("#confirmDelete").on('click', function() { // Usar off() para evitar múltiples bindings

            // Realizar la solicitud AJAX
            $.ajax({
                url: '/obrero/propietarioVeranoDelete/' + idPropietario, // Usar template literals para construir la URL
                type: 'DELETE',
                datatype: 'json',     
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            })
            .done(function(respuesta) {
                // console.log("respuesta", respuesta);
                $("#modalinfo").modal('hide');
                $("#successModal").modal('show');
                $('#texto_success').text('Propietario eliminado correctamente');
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log("Error:", errorThrown);
                $("#modalerror").modal('show');
            });
        });
    });

    $(".portada").on('click', function(event) {
        event.preventDefault();
        var idImg = $(this).data('id');
        console.log("ID portada Img: " + idImg);

        $("#portada").modal('show');
        $('#text-info-portada').text('¿Seguro/a que quieres Dejar de portada esta Imagen?');

        // $("#editarDetalles").modal('hide');


        $("#confirmCambio").on('click', function() {
            // Consulta a AJAX
            $.ajax({
                url: '/obrero/portadaVera/cambiar_imgen/' + idImg,
                type: 'POST',
                datatype: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
            .done(function(respuesta) {
                $("#portada").modal('hide');
                $("#successModal").modal('show');
                $('#texto_success').text('portada cambiada correctamente');
                // Reordenar las imágenes
                var $selectedImage = $('[data-id="' + idImg + '"]').closest('.image-container');
                $('.image-container').first().before($selectedImage);
                // alert('La portada se cambio con exito');
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $("#modalinfo").modal('hide');
                // Mostrar mensaje de error
                $("#modalAlertaErrorEliminar").modal('show');
            });
        });
    });

    document.getElementById('interruptor').addEventListener('change', function() {
        // Obtenemos todos los inputs y textareas en la página
        const inputs = document.querySelectorAll('input, textarea, select');
        const estado = document.getElementById('estado');

        // Recorremos todos los inputs y textareas y ajustamos su estado de acuerdo al interruptor
        inputs.forEach(input => {
            if (input.type !== 'checkbox' || input.id !== 'interruptor') {
                input.disabled = !this.checked;
            }
        });

        // Actualizamos el texto del estado
        estado.textContent = this.checked ? 'Habilitado para editar' : 'Deshabilitado para editar';
    });

 /////////////////Evento para subir imagenes ///////////////////////   
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('preview');

    // Mostrar previsualización de las imágenes seleccionadas
    function showPreview(files) {
        preview.innerHTML = ''; // Limpiar la previsualización
        Array.from(files).forEach(file => {
            if (file.size <= 10 * 1024 * 1024) { // Limitar a 10MB
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-thumbnail', 'me-2', 'mb-2');
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else {
                alert('El archivo ' + file.name + ' supera los 10MB.');
            }
        });
    }

    // Manejar el evento de clic para abrir el selector de archivos
    dropZone.addEventListener('click', () => fileInput.click());

    // Manejar el evento de cambio del input
    fileInput.addEventListener('change', (e) => showPreview(e.target.files));

    // Manejar el evento de arrastrar y soltar
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('border-primary');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-primary');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-primary');
        const files = e.dataTransfer.files;
        showPreview(files);
    });


    ///////////////////////////Editar//////////////////////////////////
    $(document).ready(function() {
    // Función para habilitar/deshabilitar la edición
    $('#interruptor').on('change', function() {
        var isEditing = $(this).prop('checked');
        $('input, textarea, select').not('#interruptor').prop('disabled', !isEditing);
        $('#estado').text(isEditing ? 'Habilitado para editar' : 'Deshabilitado para editar');
        $('#btn_editar').toggle(isEditing);
    });

    // Manejo del envío del formulario
    $('#btn_editar').on('click', function(event) {
        event.preventDefault();
        var Id = $(this).data('id');

        var propietarios = [];
            $("#propietarios").each(function () {
                propietarios.push($(this).val()); // Agregar el valor al array
            });
            console.log('los propietarios',propietarios)

        var direccion = $('#direccion').val();
        var sector = $('#sector').val();
        var condominio = $('#condominio').val();
        var torre = $('#torre').val();
        var num_apartamento = $('#num_apartamento').val();
        var piso = $('#piso').val();
        var personas = $('#cantidad_personas').val();
        var ubicacion = $('input[name="ubicacion"]:checked').val();
        var dormitorios = $('#dormitorios').val();
        var Tpiso_dormitorios = $('#tipo_piso').val();
        var baños = $('#baños').val();
        var tipo_cocina = $('#tipo_cocina').val();
        var precio_min_enero = $('#precio_min_enero').val();
        var precio_max_enero = $('#precio_max_enero').val();
        var precio_min_febrero = $('#precio_min_febrero').val();
        var precio_max_febrero = $('#precio_max_febrero').val();
        var precio_marzo_diciembre = $('#precio_marzo_diciembre').val();
        var marzo_diciembre_precio = $('#marzo_diciembre_precio').val();
        var equipado = $('#equipado').val();
        var mascotas = $('#mascotas').val();
        var valor_adicional = $('#valor_adicional').val();

        var estacionamientos = $('#estacionamientos').val();
        var num_estaciona = $('#num_estaciona').val();
        var piscina = $('#piscina').val();
        var Consergeria = $('#Consergeria').val();
        var ascensor = $('#ascensor').val();
        var juegos_infantiles = $('#juegos_infantiles').val();
        var servi_lavanderia = $('#servi_lavanderia').val();
        var quinchos = $('#quinchos').val();
        var sala_multiuso = $('#sala_multiuso').val();
        var terraza = $('#terraza').val();

        var servicios = {};
        $("input[name='servicios[]']").each(function() {
        var servicio = $(this).val(); // Nombre del servicio (ejemplo: 'wifi')
        servicios[servicio] = $(this).is(':checked') ? 1 : 0; // 1 si está marcado, 0 si no
    });
        // Crear el objeto FormData
        var formData = new FormData();

        // Agregar los datos al FormData
        formData.append('direccion', $('#direccion').val());
        formData.append('sector', $('#sector').val());
        formData.append('condominio', $('#condominio').val());
        formData.append('torre', $('#torre').val());
        formData.append('num_apartamento', $('#num_apartamento').val());
        formData.append('piso', $('#piso').val());
        formData.append('personas', $('#cantidad_personas').val());
        formData.append('ubicacion', $('input[name="ubicacion"]:checked').val());
        formData.append('dormitorios', $('#dormitorios').val());
        formData.append('Tpiso_dormitorios', $('#tipo_piso').val());
        formData.append('baños', $('#baños').val());
        formData.append('tipo_cocina', $('#tipo_cocina').val());
        formData.append('precio_min_enero', $('#precio_min_enero').val());
        formData.append('precio_max_enero', $('#precio_max_enero').val());
        formData.append('precio_min_febrero', $('#precio_min_febrero').val());
        formData.append('precio_max_febrero', $('#precio_max_febrero').val());
        formData.append('precio_marzo_diciembre', $('#precio_marzo_diciembre').val());
        formData.append('marzo_diciembre_precio', $('#marzo_diciembre_precio').val());
        formData.append('equipado', $('#equipado').val());
        formData.append('mascotas', $('#mascotas').val());
        formData.append('valor_adicional', $('#valor_adicional').val());

        formData.append('estacionamientos', $('#estacionamientos').val());
        formData.append('num_estaciona', $('#num_estaciona').val());
        formData.append('piscina', $('#piscina').val());
        formData.append('Consergeria', $('#Consergeria').val());
        formData.append('ascensor', $('#ascensor').val());
        formData.append('juegos_infantiles', $('#juegos_infantiles').val());
        formData.append('servi_lavanderia', $('#servi_lavanderia').val());
        formData.append('quinchos', $('#quinchos').val());
        formData.append('sala_multiuso', $('#sala_multiuso').val());
        formData.append('terraza', $('#terraza').val());
         // Convertir iconosAgregados a cadena JSON y agregarlo al FormData
         formData.append('PropietariosAgregados', JSON.stringify(PropietariosAgregados));

        // Agregar las imágenes al FormData
        var files = $('#fileInput').prop('files');
        for (var i = 0; i < files.length; i++) {
            formData.append('imagenes[]', files[i]);
        }
        // Agregar los servicios al FormData
        Object.keys(servicios).forEach(function(key) {
                formData.append(key, servicios[key]); // Clave: nombre del servicio, Valor: 1 o 0
            });
        console.log("Datos enviados:", formData);

        // Enviar los datos al servidor
        $.ajax({
            url: '/obrero/property/update/' + Id,
            type: 'POST',
            processData: false, // Importante para FormData
            contentType: false, // Importante para FormData
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                    // alert('Propiedad actualizada con éxito');
                    $('#successModal').modal('show');
                
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            }
        });
    });
    $("#close_success").click(function() {
                $("#successModal").modal('hide');
                location.reload();
            });

});
</script>
@endsection
@section('css')
@parent
<style>
    /* Cambiar el color del checkbox cuando está activado */
.form-check-input:checked {
    background-color: #198754 !important; /* Bootstrap verde (success) */
    border-color: #fff !important;
}
.form-check-input {
    background-color: #dc3545; /* Bootstrap rojo (danger) */
    /* border-color: #dc3545; */
    /* transition: background-color 0.3s, border-color 0.3s; Animación suave */
}
/* ESTILOS DE SUBIR IMAGENES */
.upload-container {
        border: 2px dashed #6c757d;
        border-radius: 0.5rem;
        text-align: center;
        padding: 2rem;
        color: #6c757d;
        cursor: pointer;
        transition: border-color 0.3s ease, color 0.3s ease;
    }

    .upload-container:hover {
        border-color: #0d6efd;
        color: #0d6efd;
    }

    .upload-container img {
        margin-top: 1rem;
        max-width: 100%;
        max-height: 150px;
        border-radius: 0.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection