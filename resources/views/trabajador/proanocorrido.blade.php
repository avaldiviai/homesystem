@extends('layouts.app')

@section('content')
<div class="container-fluid overflow-hidden " style="background-color:">
    <div class="row overflow-auto vh-100">
        @include('layouts.sidebar_trabajador')
        <div class="col d-flex flex-column " style="padding: 0; background-color:rgb(255, 255, 255);">
            <div class="flex-grow-1">
                {{-- Contenido --}}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12" style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px; color: white;">
                            <h1 class="text-uppercase text-black">Propiedades Año Corrido</h1>
                        </div>
                        
                    </div>
                </div>

                {{-- Tarjetas de propiedades --}}
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-lg-8 mb-3">
                            <div class="input-group mx-2 shadow-lg" style="max-width: 400px;">
                                <span class="input-group-text bg-primary text-white shadow-sm">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="text" id="buscador_cnn" placeholder="Buscar Propiedad" 
                                    class="form-control shadow-sm border-0" 
                                    style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            </div>
                        </div>

                        <div class="col-lg-4 text-end">
                            <button type="button" class="btn btn-success shadow " data-bs-toggle="modal" data-bs-target="#agregarPropiedad">
                                <span>AGREGAR PROPIEDAD</span>
                            </button>
                        </div>
                    </div>
                    <div class="row scrol">
                        @foreach ($propiedades as $propiedad)
                            <div class="col-lg-3 mb-3"> 
                                <a href="proanocorridopropiedadesDetallestrabajador-{{$propiedad->id}}" style="text-decoration:none; color: #000;">
                                    <div class="card position-relative registro shadow tarjeta-propiedad" style="border:none;">
                                        @php
                                            // Obtener la primera imagen de la propiedad
                                            $imagen = $propiedad->imagenes->first();
                                            $subdetalles = \App\Models\SubDetalles::where('id_propiedad', $propiedad->id)->first();
                                            $propietario = \App\Models\Propietario_propiedades::where('id_propiedad', $propiedad->id)->first();

                                        @endphp
                                        @if($imagen)
                                            <img src="{{ asset($imagen->link) }}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="{{ $propiedad->direccion }}" data-imagen-url="{{ asset($imagen->link) }}">
                                        @else
                                            <img src="{{ asset('img/OIP.jpg') }}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="Imagen no disponible" data-imagen-url="{{ asset('images/default-image.png') }}">
                                        @endif

                                        <!-- Texto extendido dentro de la imagen -->
                                            <div class="texto-propiedad position-absolute bottom-0 start-0 w-100 text-white p-3" style="background: rgba(0, 0, 0, 0.36); font-size: 12px; line-height: 1.2;">
                                                @if($propietario && $propietario->propietario)
                                                    <h6 class="detalles"><strong>Propietario:</strong> {{ $propietario->propietario->nombre }}</h6> 
                                                @else
                                                    <h6 class="detalles"><strong>Propietario:</strong> Sin propietario</h6>
                                                @endif
                                                <h6 class="detalles"><strong>Condominio:</strong> {{ $propiedad->condominio }}</h6>
                                                <h6 class="detalles"><strong>N° Dpto:</strong> {{ $propiedad->num_torre }} </h6>
                                                @if($subdetalles)
                                                    <h6 class="detalles"><strong>N° Estacionamiento:</strong> {{ $subdetalles->estacionamiento}}</h6>
                                                @endif
                                            </div>
                                            <div class="position-absolute top-0 p-2 d-flex flex-column">
                                                @if($propiedad->estado_venta == 2)
                                                    <a class="btn btn-primary estado-propiedad" data-id="{{ $propiedad->id }}">
                                                        Reservada
                                                    </a>
                                                @elseif($propiedad->estado_venta == 1)
                                                    <a class="btn btn-success">
                                                        Disponible
                                                    </a>
                                                @elseif($propiedad->estado_venta == 0)
                                                    <a class="btn btn-warning">
                                                        Arrendada
                                                    </a>
                                                @endif
                                            </div>
                                        <div class="position-absolute end-0 p-1 d-flex flex-column " style="background: rgba(0, 0, 0, 0.63); top: 60px;">
                                           <!-- @php
                                                    $detallePropiedad = \App\Models\DetallePropiedad::where(
                                                        'id_propiedad',
                                                        $propiedad->id,
                                                    )->first();
                                                @endphp -->

                                            @if($detallePropiedad && $detallePropiedad->ano_construccion === null)
                                                <a href="#" class="text-primary mb-2 detalle-propiedad-btn mt-2" data-id="{{ $propiedad->id }}" title="Agregar Detalles">
                                                    <i class="fas fa-edit fa-lg"></i>
                                                </a>
                                            @endif

                                            <a href="#" class="text-success mb-2 btn-Contrato" data-id="{{ $propiedad->id }}" title="Agregar Archivo">
                                                <i class="fa-regular fa-folder fa-lg"></i>
                                            </a>
                                            <a href="#" class="text-warning mb-2 btn-mantencion" data-id="{{ $propiedad->id }}" title="Mantencion">
                                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                            </a>
                                            <a href="#" class="text-danger borrar-propiedad-btn mb-1" data-id="{{ $propiedad->id }}" title="Eliminar Propiedad">
                                                <i class="fas fa-trash-alt fa-lg"></i>
                                            </a>
                                        </div>

                                    </div>
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
<!-- Modal para mostrar la imagen ampliada -->

<div class="modal fade" id="imagenModal" tabindex="-1" aria-labelledby="imagenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagenModalLabel">Imagen Ampliada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="imagenAmpliada" src="" class="img-fluid" alt="Imagen Ampliada">
            </div>
        </div>
    </div>
</div>


    {{-- SECCION DE MODALES --}}

    <!-- Modal agregar propiedad nuevo-->
    <div class="modal fade" id="agregarPropiedad" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="agregarPropiedadLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modal-xl">
                <div class="modal-header" style="background-color:rgb(255, 215, 151); justify-content: center; position: relative;">
                    <h5 class="modal-title text-uppercase" id="agregarPropiedadLabel">Agregar Propiedad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;"></button>
                </div>
                <div class="modal-body ">
                    <form id="arriendoForm" action="{{ url('/trabajador/proanocorrido') }}" method="POST" enctype="multipart/form-data" id="form-arriendo">
                        @csrf
                        <div class="container ">
                            <div class="row mb-3 p-4 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="col-lg-12">
                                    <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                        <h5 class="m-0 text-white text-center">
                                            Detalles de la Propiedad
                                        </h5>                            
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 mt-3">
                                    <label for="AnoCorridoInput">Precio Año Corrido</label>
                                    <input type="text" class="form-control" id="AnoCorridoInput" placeholder="Precio Año Corrido" oninput="formatearMiles(this)"  required>
                                </div>
                                <div class="form-group col-lg-4 mt-3">
                                    <label for="direccionInput">Dirección de Propiedad</label>
                                    <input type="text" class="form-control" id="direccionInput" placeholder="Ej: Calle #123" required>
                                </div>
                                <div class="form-group col-lg-4 mt-3">
                                    <label for="CiudadInput">Ciudad de la propiedad</label>
                                    <input type="text" class="form-control" id="CiudadInput" placeholder="Nombre de la Ciudad" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="condominioInput">Condominio</label>
                                    <input type="text" class="form-control" id="condominioInput" placeholder="Nombre del Condominio" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="TorreInput">Torre</label>
                                    <input type="text" class="form-control" id="TorreInput" placeholder="Nombre de la torre" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="TorrenumeroInput">N° Torre</label>
                                    <input type="text" class="form-control" id="TorrenumeroInput" placeholder="Numero de la torre" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="rolInput">Rol</label>
                                    <input type="text" class="form-control" id="rolInput"
                                        placeholder="Ej: 123-456" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="estadoInput">Estado Vivienda</label>
                                    <select class="form-select" id="estadoInput" required>
                                        <option value="" disabled selected>Seleccione un Estado</option>
                                        <option value="Amoblada">Amoblada</option>
                                        <option value="Sin Amoblar">Sin Amoblar</option>
                                        <option value="SemiAmoblado">SemiAmoblado</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="tipoInput">Tipo Inmueble</label>
                                    <select class="form-select" id="tipoInput">
                                        <option value="" disabled selected>Seleccione un Tipo</option>
                                        <option value="Casa">Casa</option>
                                        <option value="Departamento">Departamento</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-lg-12">
                                    <label class="" for="descripcion">Descripcion</label>
                                    <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion de la propiedad"></textarea>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="rutaInput">Ruta de Maps</label>
                                    <input type="text" class="form-control" id="rutaInput"
                                        placeholder="Ej: <iframe src=" required>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="propietarioInput">Agregar Propietarios</label>
                                    <div class="d-flex justify-content-between">
                                        <select id="propietarioInput" class="form-select me-2" style="flex: 1;">
                                            <option disabled selected value="0">Seleccione un propietario</option>
                                            @foreach ($propietarios as $propietario)
                                            <option value="{{ $propietario->id }}">{{ $propietario->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary" id="agregar-propietario">Agregar</button>
                                    </div>

                                    
                                </div>

                                <div class="form-group col-lg-3">
                                    <label for="">Propietarios Agregados</label>
                                    <div id="lista-agregados" class="text-uppercase w-100">
                                        <!-- Aquí se agregarán los propietarios -->
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row mb-3 p-4 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="col-lg-12">
                                    <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                        <h5 class="m-0 text-white text-center">
                                            Servicios Básicos
                                        </h5>                            
                                    </div>
                                </div>
                               
                                <div class="col-lg-12 mt-3">
                                    <div class="row col-lg-12">
                                        <div class="form-group col-lg-6">
                                            <label for="empresaLuzInput">Empresa Luz</label>
                                            <input type="text" class="form-control mt-2" id="empresaLuzInput" placeholder="Ingrese el nombre de la empresa de luz" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="numeroLuzInput">N° Luz</label>
                                            <input type="text" class="form-control mt-2" id="numeroLuzInput" placeholder="Ingrese el número de luz" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="empresaAguaInput">Empresa Agua</label>
                                            <input type="text" class="form-control mt-2" id="empresaAguaInput" placeholder="Ingrese el nombre de la empresa de agua" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="numeroAguaInput">N° Agua</label>
                                            <input type="text" class="form-control mt-2" id="numeroAguaInput" placeholder="Ingrese el número de agua" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="empresaGasInput">Empresa Gas</label>
                                            <input type="text" class="form-control mt-2" id="empresaGasInput" placeholder="Ingrese el nombre de la empresa de gas" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="numeroGasInput">N° Gas</label>
                                            <input type="text" class="form-control mt-2" id="numeroGasInput" placeholder="Ingrese el número de gas" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 p-4 mb-2 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="col-lg-12 mb-3">
                                    <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                        <h5 class="m-0 text-white text-center">
                                            Detalles Adicionales
                                        </h5>                            
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 text-center">
                                    <label for="estacionamientoCheck" >¿Tiene Estacionamiento?</label>
                                    <div class="mt-2">
                                        <input type="radio" name="estacionamientoCheck" id="estacionamientoSi" value="si">
                                        <label for="estacionamientoSi">Sí</label>
                                        <input type="radio" name="estacionamientoCheck" id="estacionamientoNo" value="no" >
                                        <label for="estacionamientoNo">No</label>
                                    </div>
                                    <div id="camposEstacionamiento" class="form-group col-lg-12" style="display: none;">
                                        <div class="row bg-white m-1" style="border-radius: .9rem;">
                                            <label class="mt-2">Detalles de Estacionamiento</label>
                                            <div class="form-group col-lg-4">
                                                <label for="montoInput">Monto</label>
                                                <input type="text" class="form-control mt-2" id="montoInput" placeholder="Monto">
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="rolInputest">Rol</label>
                                                <input type="text" class="form-control mt-2" id="rolInputest" placeholder="Rol">
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="numeroEstacionamientoInput">Estacionamiento</label>
                                                <input type="text" class="form-control mt-2" id="numeroEstacionamientoInput" placeholder="Numero">
                                            </div>
                                            <div class="form-group col-lg-12 text-center">
                                                <label for="techadoCheck"><b>¿Tiene Techado?</b></label>
                                                <div class="mt-2">
                                                    <input type="radio" name="techadoCheck" id="techadoSi" value="1">
                                                    <label for="techadoSi">Sí</label>
                                                    <input type="radio" name="techadoCheck" id="techadoNo" value="0" >
                                                    <label for="techadoNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-lg-6 text-center">
                                    <label for="bodegaCheck">¿Tiene Bodega?</label>
                                    <div class="mt-2">
                                        <input type="radio" name="bodegaCheck" id="bodegaSi" value="si">
                                        <label for="bodegaSi">Sí</label>
                                        <input type="radio" name="bodegaCheck" id="bodegaNo" value="no" >
                                        <label for="bodegaNo">No</label>
                                    </div>
                                    <div id="camposBodega" class="form-group col-lg-12" style="display: none;">
                                        <div class="row bg-white m-1" style="border-radius: .9rem;">
                                            <label class="mt-2">Detalles de la Bodega</label>
                                            <div class="form-group col-lg-4">
                                                <label for="montoInputbodega">Monto</label>
                                                <input type="text" class="form-control mt-2" id="montoInputbodega" placeholder="Monto">
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="rolInputbodega">Rol</label>
                                                <input type="text" class="form-control mt-2" id="rolInputbodega" placeholder="Rol">
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="numeroBodegaInput">Bodega</label>
                                                <input type="text" class="form-control mt-2" id="numeroBodegaInput" placeholder="Numero">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-4 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="col-lg-12">
                                    <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                        <h5 class="m-0 text-white text-center">
                                            Media y Documentos
                                        </h5>                            
                                    </div>
                                </div>
                                <div class="col-lg-4 p-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input bg-primary border-primary" type="checkbox" id="toggleColumns">
                                        <label class="form-check-label" for="toggleColumns">Agregar Imagenes y Videos</label>
                                    </div>
                                </div>
                                <div class="div" id="upload-section" style="display: none;">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="imagenes" class="form-label">Agregar imagenes</label>
                                                <input class="form-control" type="file" name="imagenes" id="imagenes" multiple>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="videos" class="form-label">Agregar videos</label>
                                                <input class="form-control" type="file" name="videos" id="videos">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="form-label" id="agregarContratoLabel">Agregar Documentos</label>
                                            <input type="file" name="contratos[]" accept=".pdf,.doc,.docx" required
                                            class="form-control" id="Archivo" multiple>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mt-4 p-2">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-info text-uppercase text-white w-100"
                                            id="agregar-datos">Agregar Documentos
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <ul class="text-uppercase mt-4" id="lista-Datos">
                    <!-- Lista de documentos cargados -->
                </ul>
            </div>
            <div class="modal-footer d-flex justify-content-end"style="background-color:rgb(255, 215, 151); ">
                <!-- Botones de cambios -->
                <button type="button" id="btn_cerrar_agregar" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_agregar" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

    <!-- detalles propiedad -->
    <div class="modal fade" id="Detalle_Propiedad" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="Detalle_PropiedadLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modal-xl">
                <div class="modal-header" style="background-color: #FFE2B2; justify-content: center; position: relative;">
                    <h5 class="modal-title text-uppercase" id="Detalle_PropiedadLabel">Agregar Detalles a la Propiedad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;"></button>
                </div>
                <div class="modal-body ">
                    <form id="arriendoForm" action="{{ url('/trabajador/detallespropiedad') }}" method="POST"
                        enctype="multipart/form-data" id="form-arriendo">
                        @csrf
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row g-3">
                                <!-- Primera columna -->
                                <div class="col-12 col-md-6 p-3 " >
                                    <div class="row g-3 m-1 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="AnocoInput" class="form-label">Año de Construcción</label>
                                            <input type="date" class="form-control" id="AnocoInput" placeholder="Ej: 1999" required>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="piso" class="form-label">Piso</label>
                                            <input type="number" class="form-control" id="piso" name="piso" placeholder="Ej: 3">
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="dormitorios" class="form-label">Dormitorios</label>
                                            <input type="number" class="form-control" id="dormitorios" name="dormitorios" placeholder="Ej: 2">
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="banos" class="form-label">Banos</label>
                                            <input type="number" class="form-control" id="banos" name="banos" placeholder="Ej: 1">
                                        </div>
                                    </div>
                                </div>

                                <!-- Segunda columna -->
                                <div class="col-12 col-md-6 p-3">
                                    <div class="row g-3 m-1 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="orientacionInput">Orientación</label>
                                            <select class="form-select" id="orientacionInput">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="O">Oriente (Este)</option>
                                                <option value="P">Poniente (Oeste)</option>
                                                <option value="N">Norte</option>
                                                <option value="S">Sur</option>
                                                <option value="NE">Noreste</option>
                                                <option value="NO">Noroeste</option>
                                                <option value="SE">Sureste</option>
                                                <option value="SO">Suroeste</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="cocina" class="form-label">Cocina</label>
                                            <select class="form-select" id="cocina">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="Eléctrica">Eléctrica</option>
                                                <option value="Gas">Gas</option>
                                                <option value="Conexión Gas">Conexión Gas</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="logia" class="form-label">Logia</label>
                                            <select class="form-select" id="logiaInput">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1">1</option>
                                                <!-- <option value="1 1/2">1 1/2</option> -->
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="agua_caliente" class="form-label">Agua Caliente</label>
                                            <select class="form-select" id="agua_caliente">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="Calefont">Calefont</option>
                                                <option value="Thermo">Thermo</option>
                                                <option value="Caldera">Caldera</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 m-1 shadow mb-4" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="mt2_construido" class="form-label">MT2 Construido</label>
                                    <input type="number" class="form-control" id="mt2_construido" name="mt2_construido" placeholder="Ej: 80">
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="mt2_terraza" class="form-label">MT2 de Terraza</label>
                                    <input type="number" class="form-control" id="mt2_terraza" name="mt2_terraza" placeholder="Ej: 20">
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="mt2_total" class="form-label">MT2 Total</label>
                                    <input type="number" class="form-control" id="mt2_total" name="mt2_total" placeholder="Ej: 100">
                                </div>
                                <div class="form-group mb-3 col-lg-5">
                                        <label for="inventario" class="form-label">Inventario</label>
                                        <textarea type="text" class="form-control" id="inventario" name="inventario" placeholder="Ej: muebles incluidos"></textarea>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="estacionamiento_visitas" class="form-label">Estacionamiento Visitas</label>
                                    <input type="text" class="form-control" id="estacionamiento_visitas" name="estacionamiento_visitas"
                                        placeholder="Ej: 5">
                                </div>
                            </div>    
                            <div class="row g-3 m-1 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="espacio_lavadora" class="form-label">Espacio para Lavadora</label>
                                    <div>
                                        <input type="radio" id="espacio_lavadora" name="espacio_lavadora" value="1
                                        "> 
                                        <label for="espacio_lavadora">Sí</label>
                                        <input type="radio" id="espacio_lavadora_no" name="espacio_lavadora" value="0"> 
                                        <label for="espacio_lavadora_no">No</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="lavadora" class="form-label">Lavadora</label>
                                    <div>
                                        <input type="radio" id="lavadora" name="lavadora" value="1
                                        "> 
                                        <label for="lavadora">Sí</label>
                                        <input type="radio" id="lavadora_no" name="lavadora" value="0"> 
                                        <label for="lavadora_no">No</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="ascensor" class="form-label">Ascensor</label>
                                    <div>
                                        <input type="radio" id="ascensor" name="ascensor" value="1
                                        "> 
                                        <label for="ascensor">Sí</label>
                                        <input type="radio" id="ascensor_no" name="ascensor" value="0"> 
                                        <label for="ascensor_no">No</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="juegos_infantiles" class="form-label">Juegos Infantiles</label>
                                    <div>
                                        <input type="radio" id="juegos_infantiles_si" name="juegos_infantiles_si" value="1
                                        "> 
                                        <label for="juegos_infantiles_si">Sí</label>
                                        <input type="radio" id="juegos_infantiles_no" name="juegos_infantiles_no" value="0"> 
                                        <label for="juegos_infantiles_no">No</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="lavanderia" class="form-label">Lavandería</label>
                                    <div>
                                        <input type="radio" id="lavanderia_si" name="lavanderia" value="1
                                        "> 
                                        <label for="lavanderia_si">Sí</label>
                                        <input type="radio" id="lavanderia_no" name="lavanderia" value="0"> 
                                        <label for="lavanderia_no">No</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="quinchos" class="form-label">Quinchos</label>
                                    <div>
                                        <input type="radio" id="quinchos_si" name="quinchos" value="1
                                        "> 
                                        <label for="quinchos_si">Sí</label>
                                        <input type="radio" id="quinchos_no" name="quinchos" value="0"> 
                                        <label for="quinchos_no">No</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="sala_multiuso" class="form-label">Sala Multiuso</label>
                                    <div>
                                        <input type="radio" id="sala_multiuso_si" name="sala_multiuso" value="1
                                        "> 
                                        <label for="sala_multiuso_si">Sí</label>
                                        <input type="radio" id="sala_multiuso_no" name="sala_multiuso" value="0"> 
                                        <label for="sala_multiuso_no">No</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="gimnasio" class="form-label">Gimnasio</label>
                                    <div>
                                        <input type="radio" id="gimnasio_si" name="gimnasio" value="1
                                        "> 
                                        <label for="gimnasio_si">Sí</label>
                                        <input type="radio" id="gimnasio_no" name="gimnasio" value="0"> 
                                        <label for="gimnasio_no">No</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-lg-4 col-sm-4 text-center">
                                    <label for="ciclovia" class="form-label">Ciclovía</label>
                                    <div>
                                        <input type="radio" id="ciclovia_si" name="ciclovia" value="1
                                        "> 
                                        <label for="ciclovia_si">Sí</label>
                                        <input type="radio" id="ciclovia_no" name="ciclovia" value="0"> 
                                        <label for="ciclovia_no">No</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-lg-4 col-sm-4 text-center">
                                    <label for="piscina" class="form-label">Piscina</label>
                                    <div>
                                        <input type="radio" id="piscina_si" name="piscina" value="1"> 
                                        <label for="piscina_si">Sí</label>
                                        <input type="radio" id="piscina_no" name="piscina" value="0"> 
                                        <label for="piscina_no">No</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-lg-4 col-sm-4 text-center">
                                    <label for="verde" class="form-label">Areas Verdes</label>
                                    <div>
                                        <input type="radio" id="verde_si" name="verde" value="1"> 
                                        <label for="verde_si">Sí</label>
                                        <input type="radio" id="verde_no" name="verde" value="0"> 
                                        <label for="verde_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Botones de cambios -->
                    <div class="modal-footer" style="background-color: #FFE2B2;">
                        <button type="button" id="btn_cerrar_agregar" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" id="btn_agregardetalle" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- Modal Mostrar Archivos-->
        <div class="modal fade" id="ModificarArchivoModal" tabindex="-1" aria-labelledby="ModificarArchivoLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <h5 class="modal-title" id="" style="text-align: center;">Archivos Agregados </h5>
                    @if (isset($propiedad))
                        <form action="{{ route('archivos.guardar', $propiedad->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- campos del formulario -->
                        </form>
                    @else
                        <p>No se ha encontrado la propiedad.</p>
                    @endif
                    <div class="modal-body">
                        <div class="row">
                            <h5 class=" text-cent">
                        </div>
                        <div class="form-group">
                            <div id="listaArchivos"></div>
                        </div>
                        <ul class="text-uppercase mt-4" id="lista-agregados-edit">
                            <!-- <li></li> -->
                        </ul>
                        <div class="col-12">
                            <button class="btn btn-warning w-100 mt-3 mb-3 text-uppercase text-white" type="button"
                                data-bs-toggle="collapse" data-bs-target=".multi-collapse3" aria-expanded="false"
                                aria-controls="multiCollapseExample3 ">
                                <b>Agregar Nuevos Archivos</b>
                            </button>
                        </div>
                        <div class="collapse multi-collapse3" id="multiCollapseExample3">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="modal-title" id="agregarContratoLabel">Agregar Documentos</h5>
                                </div>
                                <div class="modal-body">

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <div class="mb-3">
                                                    <label for="contrato" class="form-label"><strong>Selecciona el archivo a
                                                            cargar:</strong></label>
                                                    <input type="file" name="contratos2" accept=".pdf,.doc,.docx" required
                                                        class="form-control" id="Archivos2" multiple>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 ">
                                                <div class="mb-3 mt-4 p-1">
                                                    <button type="button" class="btn btn-info m-1 text-uppercase text-white"
                                                        id="agregar-datossolo"><b>Agregar Documentos</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="text-uppercase mt-4 m-4" id="lista-Datosdos">
                                        <!-- Lista de documentos cargados -->
                                    </ul>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-1"
                            data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" id="btn_agregardos" class="btn btn-success m-1">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Mantencion -->
        <div class="modal fade" id="ModalMantencion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="ModalMantencionLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Mantenimientos</h5>
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
                                        <button type="button" class="btn btn-primary" id="agregar-mantencion">Agregar Mantenimiento</button>
                                    </div>
                                </div>
                            </div>
                            <div id="lista-mantenciones" class="mt-3"></div>
                            <!-- <button type="button" class="btn btn-secondary mt-3" id="addMantencion">Agregar Mantenimiento</button> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" id="guardar-mantenciones">Guardar Todo</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- modal exito -->
        <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="successModalLabel" aria-hidden="true">
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
        <!-- modal info -->
        <div class="modal fade" id="modalinfo" tabindex="-1" aria-labelledby="modalinfoLabel" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
                    <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                        <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar la Propiedad?</h2>
                            <div class="modalfooter d-flex justify-content-center">
                                <button type="button" class="btn btn-danger m-2"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" id="confirmDelete" class="btn btn-secondary m-2">Eliminar</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="eliminarContratoModal" tabindex="-1" aria-labelledby="eliminarContratoLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
                    <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                        <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar el contrato?</h2>
                            <div class="modalfooter d-flex justify-content-center">
                                <button type="button" class="btn btn-danger m-2"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" id="confirmarEliminarContratoBtn"
                                    class="btn btn-secondary m-2">Eliminar</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="venderpropiedadModal" tabindex="-1" aria-labelledby="venderpropiedadModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="alert alert-success d-flex align-items-center" id="alerta" role="alert">
                    <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                        <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres Arrendar esta Propiedad?</h2>
                        <div class="modalfooter d-flex justify-content-center">
                            <button type="button" class="btn btn-danger m-2"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="confimarventa"
                                class="btn btn-success m-2">Arrendar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalAlertaAgregar" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="successLabel" aria-hidden="true">
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
                                    </p>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn-close d-flex justify-content-end"
                                        id="btn-close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


  
@endsection
@section('css')
<style>
    .scrol {
    max-height: 420px; /* Altura máxima del contenedor */
    overflow-y: auto;  /* Habilita el scroll vertical */
    scrollbar-width: thin; /* Para navegadores modernos, hace el scroll más delgado */
    scrollbar-color:rgb(105, 101, 101) #f8f9fa; /* Color del scroll (primero: barra, segundo: fondo) */
    }    
    .tarjeta-propiedad .texto-propiedad {
        transition: opacity 0.3s ease;
    }
    
    .tarjeta-propiedad:hover .texto-propiedad {
        opacity: 0;
    }


</style>
@parent
<style>
    
</style>
@endsection

    @section('javascript')
        @parent
        <script>
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

            $(".estado-propiedad").on('click', function(event) {
                event.preventDefault();
                idPropiedad = $(this).data('id'); // Obtén el ID del botón presionado
                console.log('propiedad: ' + idPropiedad);
                $("#venderpropiedadModal").modal('show');
                $("#confimarventa").data('id',idPropiedad);
            });
            $("#confimarventa").click(function(event){
                event.preventDefault();
                idPropiedad = $(this).data('id'); // Obtén el ID del botón presionado
                console.log('propiedad vendida: ' + idPropiedad);
                $.ajax({
                    url: '/trabajador/venderpropiedad' + idPropiedad,
                    type: 'POST',
                    data: idPropiedad,
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#venderpropiedadModal").modal('hide');
                        $("#successModal").modal('show');
                        $('#texto_success').text('Propiedad Vendida Con Exito');

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#venderpropiedadModal").modal('hide');
                        $('#modalerror').modal('show');
                    }
                })
            });
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
                        url: '/trabajador/obtener/propietarioNombre',
                        type: 'GET',
                        data: { nombre_pro: propietarios.id }, // Envía el ID del propietario al servidor
                        success: function(response) {
                            // Crear un elemento de la lista con el nombre del propietario y un botón de eliminar
                            var listItem = $("<div>")
                            .append(
                                $("<div>")
                                    .addClass("bg-white p-2 rounded d-flex align-items-center justify-content-between w-100 mb-1")
                                    .append(
                                        $("<span>")
                                            .html('<i class="fa-solid fa-user-tie me-2"></i>' + response.nombre) // Texto con ícono
                                    )
                                    .append(
                                        $("<button>")
                                            .html('<i class="fas fa-trash-alt fa-lg text-danger"></i>') // Ícono de eliminar
                                            .addClass("btn btn-sm btn-link p-0") // Botón pequeno y minimalista
                                            .on("click", function () {
                                                eliminarPropietario(index);
                                            })
                                    )
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

            ///////// FUNCION PARA CAMBIAR DE FOTO /////////
            function cambiarImagen(button) {
                const ImagenId = button.getAttribute('data-id');
                const inputFile = document.createElement('input');
                inputFile.type = 'file';
                inputFile.accept = 'image/*';

                    inputFile.onchange = function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const formData = new FormData();
                            formData.append('imagen', file);
                            formData.append('id_imagen', ImagenId);

                            $.ajax({

                                url: '{{ url('/trabajador/imagen/cambiar + ImagenId ') }}',
                                type: 'POST',
                                data: formData,
                                processData: false, // No procesar los datos
                                contentType: false, // No establecer el contentType
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Asegúrate de incluir el token CSRF
                                },
                                success: function(data) {
                                    if (data.success) {
                                        const imgElement = button.closest('.position-relative').querySelector(
                                            'img');
                                        imgElement.src = data
                                            .newImageUrl; // Asegúrate de que el servidor devuelva la nueva URL de la imagen
                                    } else {
                                        alert('Error al cambiar la imagen');
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error('Error:', textStatus, errorThrown);
                                    alert('Error en la solicitud. Por favor, intenta de nuevo.');
                                }
                            });
                        }
                    };

                    inputFile.click(); // Simula un clic en el input para abrir el selector de archivos
                }

                // Ahora, podemos agregar el evento DOMContentLoaded para cualquier inicialización si es necesario
                document.addEventListener('DOMContentLoaded', function() {
                    // Aquí puedes agregar otros códigos que necesites ejecutar al cargar el DOM
                });

                $(document).ready(function() {
                    // Manejar el clic en las imágenes
                    $(".imagen-propiedad").click(function() {
                        var imagenUrl = $(this).data(
                            "imagen-url"); // Obtener la URL de la imagen desde el atributo data
                        $('#imagenAmpliada').attr('src',
                            imagenUrl); // Establecer la fuente de la imagen en el modal
                        $("#imagenModal").modal('show'); // Mostrar el modal
                    });
                });

                function toggleDetalles() {
                    const detalles = document.getElementById("detallesPropiedad");
                    detalles.style.display = detalles.style.display === "none" || detalles.style.display === "" ? "block" : "none";
                }
                // funcion que siempre tiene que ir en script inicio
                $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    console.log('Listo para trabajar')

                    $("#buscador_cn").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $(".cartas .card").each(function() {
                            var cardText = $(this).find('.card-title').text().toLowerCase();
                            if (cardText.includes(value)) {
                                $(this).prependTo($(this)
                                    .parent()); // Mover al principio del contenedor padre
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    });



                    ////////////////////////////lista de Archivos agregados /////////////////////////
                    const archivosSeleccionados = [];
                    // Evento para agregar archivos
                    document.getElementById('agregar-datos').addEventListener('click', function() {
                        const inputArchivo = document.getElementById('Archivo');
                        const listaDatos = document.getElementById('lista-Datos');

                        if (inputArchivo.files.length > 0) {
                            // Agregar todos los archivos seleccionados al array
                            Array.from(inputArchivo.files).forEach(archivo => {
                                archivosSeleccionados.push(archivo);
                                const li = document.createElement('li');
                                li.textContent = archivo.name; // Muestra el nombre del archivo
                                listaDatos.appendChild(li);
                            });

        // Resetear el input para permitir cargar el mismo archivo nuevamente si es necesario
        inputArchivo.value = '';
    } else {
        alert('Por favor, selecciona un archivo antes de agregar.');
    }
});
        $("#btn_agregar").on('click', function(event){
            event.preventDefault();

            var camposVacios = false; // Variable para verificar si hay campos vacíos

            // Limpiar mensajes anteriores
            $(".campo-error").remove();
            // console.log('hola');
            // Obtener los valores de los campos de texto
            var direccion = $("#direccionInput").val();
            var ciudad = $("#CiudadInput").val();
            var rol = $("#rolInput").val();
            var ruta = $("#rutaInput").val();
            var tipo = $("#tipoInput").val();
            var descripcionpro = $("#descripcion").val();
            var estado_propiedad = $("#estadoInput").val();
            var empresaluz = $("#empresaLuzInput").val();
            var numeroluz = $("#numeroLuzInput").val();
            var empresaagua = $("#empresaAguaInput").val();
            var numeroagua = $("#numeroAguaInput").val();
            var empresagas = $("#empresaGasInput").val();
            var numerogas = $("#numeroGasInput").val();
            var condominio = $("#condominioInput").val();

            var torre = $("#TorreInput").val();
            var num_torre = $("#TorrenumeroInput").val();
            var ano_corrido = $("#AnoCorridoInput").val();

            var monto = $("#montoInput").val();
            var rol_est = $("#rolInputest").val();
            var estacionamiento = $("#numeroEstacionamientoInput").val();
            var techado = $('input[name="techadoCheck"]:checked').val();


            var monto_b = $("#montoInputbodega").val();
            var rol_b = $("#rolInputbodega").val();
            var bodega = $("#numeroBodegaInput").val();




            // Validar los campos y mostrar el mensaje de advertencia si están vacíos
            if (!direccion) {
                mostrarError("#direccionInput");
                camposVacios = true;
            }
            if (!rol) {
                mostrarError("#rolInput");
                camposVacios = true;
            }
            if (!ruta) {
                mostrarError("#rutaInput");
                camposVacios = true;
            }
            if (!tipo) {
                mostrarError("#tipoInput");
                camposVacios = true;
            }
            if(!descripcionpro){
                mostrarError("#descripcion");
                camposVacios = true;
            }
            if (!estado_propiedad) {
                mostrarError("#estadoInput");
                camposVacios = true;
            }
            // if (!empresaluz) {
            //     mostrarError("#empresaLuzInput");
            //     camposVacios = true;
            // }
            // if (!empresaagua) {
            //     mostrarError("#empresaAguaInput");
            //     camposVacios = true;
            // }
            // if (!numeroagua) {
            //     mostrarError("#numeroAguaInput");
            //     camposVacios = true;
            // }
            if (!ciudad) {
                mostrarError("#CiudadInput");
                camposVacios = true;
            }
            // if (!empresagas) {
            //     mostrarError("#empresaGasInput");
            //     camposVacios = true;
            // }
            // if (!numerogas) {
            //     mostrarError("#numeroGasInput");
            //     camposVacios = true;
            // }
            if (!condominio) {
                mostrarError("#condominioInput");
                camposVacios = true;
            }
            if (!ano_corrido) {
                mostrarError("#AnoCorridoInput");
                camposVacios = true;
            }
            if (!torre) {
                mostrarError("#TorreInput");
                camposVacios = true;
            }
            // if (!numeroluz) {
            //     mostrarError("#numeroLuzInput");
            //     camposVacios = true;
            // }
            if (!num_torre) {
                mostrarError("#TorrenumeroInput");
                camposVacios = true;
            }

            // Verificar si hay campos vacíos
            if (camposVacios) {
                // Si hay campos vacíos, mostrar el mensaje de advertencia
                // alert("Por favor, complete todos los campos.");
            } else {


            var formData = new FormData();

            // Agregar los valores de los campos de texto al objeto FormData
            formData.append('direccion', direccion);
            formData.append('ciudad', ciudad);
            formData.append('rol', rol);
            formData.append('ruta', ruta);
            formData.append('tipo', tipo);
            formData.append('estado_propiedad', estado_propiedad);
            formData.append('empresaluz', empresaluz);
            formData.append('numeroluz', numeroluz);
            formData.append('empresaagua', empresaagua);
            formData.append('numeroagua', numeroagua);
            formData.append('empresagas', empresagas);
            formData.append('numerogas', numerogas);
            formData.append('condominio', condominio);
            formData.append('descripcionpro',descripcionpro);
    
            formData.append('ano_corrido', ano_corrido);

            // formData.append('propietario', propietario);
            formData.append('torre', torre);
            formData.append('num_torre', num_torre);

            formData.append('monto', monto);
            formData.append('rol_est', rol_est);
            formData.append('estacionamiento', estacionamiento);
            formData.append('techado', techado);


            formData.append('monto_b', monto_b);
            formData.append('rol_b', rol_b);
            formData.append('bodega', bodega);

            archivosSeleccionados.forEach(archivo => {
            formData.append('Archivo[]', archivo); // Agregar cada archivo del array
             });

            // Obtener los archivos seleccionados
            var files = $('#imagenes')[0].files;

            // Iterar sobre los archivos seleccionados y agregarlos al objeto FormData
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                formData.append('imagenes[]', file);
            }
            var videoFile = $('#videos')[0].files[0];
            
            formData.append('videos', videoFile);

            // Convertir iconosAgregados a cadena JSON y agregarlo al FormData
            formData.append('PropietariosAgregados', JSON.stringify(PropietariosAgregados));

            formData.forEach(function(value, key) {
                console.log(key, value);
            });

            console.log(formData);
            console.log('todo correcto');


                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/trabajador/proanocorrido/add') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#successModal').modal('show');
                        $('#agregarPropiedad').modal('hide');

                },
                error: function(xhr) {
                    alert('Error al agregar la propiedad. Intente nuevamente.');
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
//funcion al cerrar modal sucess actualice los datos
$("#close_success").click(function() {
    $("#successModal").modal('hide');
    location.reload();
});



                ////MOSTRAR MODAL DE ELIMINAR ///
                //boton eliminar propiedad
                $(".borrar-propiedad-btn").on('click', function(event) {
                    event.preventDefault();
                    var idPropiedad = $(this).data('id');
                    console.log('propiedad: ' + idPropiedad);

                    // Mostrar el modal de confirmación
                    $("#modalinfo").modal('show');

                    // Manejar el clic en el botón de confirmación
                    $("#confirmDelete").off('click').on('click', function() { // Usar off() para evitar múltiples bindings
                        $("#modalinfo").modal('hide');

                        // Realizar la solicitud AJAX
                        $.ajax({
                            url: `/trabajador/propiedad/${idPropiedad}`, // Usar template literals para construir la URL
                            type: 'DELETE',
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content') // Incluir el token CSRF
                            },
                            success: function(respuesta) {
                                console.log("respuesta", respuesta);
                                $("#successModal").modal('show');
                                $('#texto_success').text('Propiedad eliminada correctamente');
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log("Error:", errorThrown);
                                $("#modalerror").modal('show');
                            }
                        });
                    });
                }); // fin eliminar propiedad


                ////MOSTRAR MODAL DE DETALLES ///
            $(document).ready(function() {
                let idPropiedad;

                $(".detalle-propiedad-btn").on('click', function(event) {
                    event.preventDefault();
                    var idPropiedad = $(this).data('id'); // Obtén el ID del botón presionado

                    $("#btn_agregardetalle").data('idpro',idPropiedad);

                    console.log('propiedad: ' + idPropiedad);

                    // Establecer el ID de la propiedad en un campo oculto si es necesario
                    // $("#idPropiedad").val(idPropiedad); // Asegúrate de tener un campo oculto para el ID
                    $("#Detalle_Propiedad").modal('show');

                });

                $('#btn_agregardetalle').on('click', function(e) {
                    e.preventDefault(); // Previene el comportamiento por defecto del botón

                    var camposVacios = false; // Variable para verificar si hay campos vacíos

                    // Limpiar mensajes anteriores
                    $(".campo-error").remove();

                    var id_propiedad = $(this).data('idpro'); // Obtén el ID del botón presionado
                    console.log('id',id_propiedad);
                    // Recoger los datos del formulario
                    var ano_construccion = $("#AnocoInput").val();
                    var piso = $("#piso").val();
                    var dormitorios = $("#dormitorios").val();
                    var banos = $("#banos").val();
                    var orientacion = $("#orientacionInput").val();
                    var cocina = $("#cocina").val();
                    var logia = $("#logiaInput").val();
                    var agua_caliente = $("#agua_caliente").val();

                    var espacio_lavadora = $("#espacio_lavadora").is(':checked');
                    var espacio_lavadora_no = $("#espacio_lavadora_no").is(':checked');

                    var espacio_final;

                    if (espacio_lavadora) {
                        // Si el checkbox espacio_lavadora está seleccionado
                        espacio_final = $("#espacio_lavadora").val();
                        console.log("Seleccionado: " + espacio_final);
                    } else if (espacio_lavadora_no) {
                        // Si el checkbox espacio_lavadora_no está seleccionado
                        espacio_final = $("#espacio_lavadora_no").val();
                        console.log("espacio lavadora Seleccionado: " + espacio_final);
                    } else {
                        // Si ninguno está seleccionado
                        console.log("Ningún checkbox está seleccionado");
                    }

                    // Ahora puedes usar espacio_final

                    // Ahora puedes usar espacio_final en el código
                    console.log('opcion de espacio',espacio_final);


                    var lavadora = $("#lavadora").is(':checked');
                    var lavadora_no = $("#lavadora_no").is(':checked');
                    var lavadora_final;

                    if (lavadora) {
                        // Si el checkbox espacio_lavadora está seleccionado
                        lavadora_final = $("#lavadora").val();
                        console.log("lavadora Seleccionado: " + lavadora_final);
                    } else if (lavadora_no) {
                        // Si el checkbox espacio_lavadora_no está seleccionado
                        lavadora_final = $("#lavadora_no").val();
                        console.log("lavadora Seleccionado: " + lavadora_final);
                    } else {
                        // Si ninguno está seleccionado
                        console.log("Ningún checkbox está seleccionado");
                    }

                    // Ahora puedes usar espacio_final

                    // Ahora puedes usar espacio_final en el código
                    // console.log('opcion de lavadora',lavadora_final);

                    var inventario = $("#inventario").val();
                    var mt2_total = $("#mt2_total").val();
                    var mt2_construido = $("#mt2_construido").val();
                    var mt2_terraza = $("#mt2_terraza").val();
                    var estacionamiento_visitas = $("#estacionamiento_visitas").val();

                    var ascensor = $("#ascensor").is(':checked');
                    var ascensor_no = $("#ascensor_no").is(':checked');
                    var ascensor_final;

                    if (ascensor) {
                        // Si el checkbox espacio_lavadora está seleccionado
                        ascensor_final = $("#ascensor").val();
                        console.log("Seleccionado: " + ascensor_final);
                    } else if (ascensor_no) {
                        // Si el checkbox espacio_lavadora_no está seleccionado
                        ascensor_final = $("#ascensor_no").val();
                        console.log("ascensor Seleccionado: " + ascensor_final);
                    } else {
                        // Si ninguno está seleccionado
                        console.log("Ningún checkbox está seleccionado");
                    }

                    // Ahora puedes usar espacio_final

                    // Ahora puedes usar espacio_final en el código
                    // console.log('opcion de lavadora',ascensor_final);
                    var juegos_infantiles_si = $("#juegos_infantiles_si").is(':checked');
                    var juegos_infantiles_no = $("#juegos_infantiles_no").is(':checked');
                    var juegos_infantiles_final;

                    if (juegos_infantiles_si) {
                        // Si el checkbox juegos_infantiles está seleccionado
                        juegos_infantiles_final = $("#juegos_infantiles_si").val();
                        console.log("Juegos Infantiles Seleccionado: " + juegos_infantiles_final);
                    } else if (juegos_infantiles_no) {
                        // Si el checkbox juegos_infantiles_no está seleccionado
                        juegos_infantiles_final = $("#juegos_infantiles_no").val();
                        console.log("Juegos Infantiles No Seleccionado: " + juegos_infantiles_final);
                    } else {
                        // Si ninguno está seleccionado
                        console.log("Ningún checkbox está seleccionado");
                    }

                    // Ahora puedes usar juegos_infantiles_final según sea necesario.

                    var lavanderia_si = $("#lavanderia_si").is(':checked');
                    var lavanderia_no = $("#lavanderia_no").is(':checked');
                    var lavanderia_final;

                    if (lavanderia_si) {
                        // Si el checkbox lavanderia_si está seleccionado
                        lavanderia_final = $("#lavanderia_si").val();
                        console.log("Lavandería Seleccionado: " + lavanderia_final);
                    } else if (lavanderia_no) {
                        // Si el checkbox lavanderia_no está seleccionado
                        lavanderia_final = $("#lavanderia_no").val();
                        console.log("Lavandería No Seleccionado: " + lavanderia_final);
                    } else {
                        // Si ninguno está seleccionado
                        console.log("Ningún checkbox está seleccionado");
                    }

                    // Ahora puedes usar lavanderia_final según sea necesario.
                    var quinchos_si = $("#quinchos_si").is(':checked');
                    var quinchos_no = $("#quinchos_no").is(':checked');
                    var quinchos_final;

                    if (quinchos_si) {
                        // Si el checkbox quinchos_si está seleccionado
                        quinchos_final = $("#quinchos_si").val();
                        console.log("Quinchos Seleccionado: " + quinchos_final);
                    } else if (quinchos_no) {
                        // Si el checkbox quinchos_no está seleccionado
                        quinchos_final = $("#quinchos_no").val();
                        console.log("Quinchos No Seleccionado: " + quinchos_final);
                    } else {
                        // Si ninguno está seleccionado
                        console.log("Ningún checkbox está seleccionado");
                    }

                    // Ahora puedes usar quinchos_final según sea necesario.
                    var sala_multiuso_si = $("#sala_multiuso_si").is(':checked');
                    var sala_multiuso_no = $("#sala_multiuso_no").is(':checked');
                    var sala_multiuso_final;

                    if (sala_multiuso_si) {
                        // Si el checkbox sala_multiuso_si está seleccionado
                        sala_multiuso_final = $("#sala_multiuso_si").val();
                        console.log("Sala Multiuso Seleccionado: " + sala_multiuso_final);
                    } else if (sala_multiuso_no) {
                        // Si el checkbox sala_multiuso_no está seleccionado
                        sala_multiuso_final = $("#sala_multiuso_no").val();
                        console.log("Sala Multiuso No Seleccionado: " + sala_multiuso_final);
                    } else {
                        // Si ninguno está seleccionado
                        console.log("Ningún checkbox está seleccionado");
                    }

                    // Ahora puedes usar sala_multiuso_final según sea necesario.
                    var gimnasio_si = $("#gimnasio_si").is(':checked');
                    var gimnasio_no = $("#gimnasio_no").is(':checked');
                    var gimnasio_final;

                    if (gimnasio_si) {
                        // Si el checkbox gimnasio_si está seleccionado
                        gimnasio_final = $("#gimnasio_si").val();
                        console.log("Gimnasio Seleccionado: " + gimnasio_final);
                    } else if (gimnasio_no) {
                        // Si el checkbox gimnasio_no está seleccionado
                        gimnasio_final = $("#gimnasio_no").val();
                        console.log("Gimnasio No Seleccionado: " + gimnasio_final);
                    } else {
                        // Si ninguno está seleccionado
                        console.log("Ningún checkbox está seleccionado");
                    }

                    // Ahora puedes usar gimnasio_final según sea necesario.
                    var ciclovia_si = $("#ciclovia_si").is(':checked');
                    var ciclovia_no = $("#ciclovia_no").is(':checked');
                    var ciclovia_final;

                    if (ciclovia_si) {
                        // Si el checkbox ciclovia_si está seleccionado
                        ciclovia_final = $("#ciclovia_si").val();
                        console.log("Ciclovia Seleccionado: " + ciclovia_final);
                    } else if (ciclovia_no) {
                        // Si el checkbox ciclovia_no está seleccionado
                        ciclovia_final = $("#ciclovia_no").val();
                        console.log("Ciclovia No Seleccionado: " + ciclovia_final);
                    } else {
                        // Si ninguno está seleccionado
                        console.log("Ningún checkbox está seleccionado");
                    }

                    var piscina_si = $("#piscina_si").is(':checked');
                    var piscina_no = $("#piscina_no").is(':checked');
                    var Piscina_final;

                    if (piscina_si) {
                        // Si el checkbox ciclovia_si está seleccionado
                        Piscina_final = $("#piscina_si").val();
                        console.log("Piscina Seleccionada: " + Piscina_final);
                    } else if (piscina_no) {
                        // Si el checkbox ciclovia_no está seleccionado
                        Piscina_final = $("#piscina_no").val();
                        console.log("Piscina No Seleccionada: " + Piscina_final);
                    } else {
                        // Si ninguno está seleccionado
                        console.log("Ningún checkbox está seleccionado");
                    }

                    var verde_si = $("#verde_si").is(':checked');
                    var verde_no = $("#verde_no").is(':checked');
                    var verde_final;

                    if (verde_si) {
                        // Si el checkbox ciclovia_si está seleccionado
                        verde_final = $("#verde_si").val();
                        console.log("Area Verde Seleccionada: " + verde_final);
                    } else if (verde_no) {
                        // Si el checkbox ciclovia_no está seleccionado
                        verde_final = $("#verde_no").val();
                        console.log("Area Verde No Seleccionada: " + verde_final);
                    } else {
                        // Si ninguno está seleccionado
                        console.log("Ningún checkbox está seleccionado");
                    }


                        // Validar los campos y mostrar el mensaje de advertencia si están vacíos
                    if (!ano_construccion) {
                        mostrarError("#AnocoInput");
                        camposVacios = true;
                    }
                    if (!piso) {
                        mostrarError("#piso");
                        camposVacios = true;
                    }
                    if (!dormitorios) {
                        mostrarError("#dormitorios");
                        camposVacios = true;
                    }
                    if (!banos) {
                        mostrarError("#banos");
                        camposVacios = true;
                    }
                    if (!orientacion) {
                        mostrarError("#orientacionInput");
                        camposVacios = true;
                    }
                    if (!cocina) {
                        mostrarError("#cocina");
                        camposVacios = true;
                    }
                    if (!logia) {
                        mostrarError("#logiaInput");
                        camposVacios = true;
                    }
                    if (!agua_caliente) {
                        mostrarError("#agua_caliente");
                        camposVacios = true;
                    }



                    // Verificar si hay campos vacíos
                    if (camposVacios) {
                        // Si hay campos vacíos, mostrar el mensaje de advertencia
                        // alert("Por favor, complete todos los campos.");
                    } else {

                    // Crear un objeto FormData
                    var formData = new FormData();
                    // Detalles propiedad 
                    formData.append('id_propiedad', id_propiedad);
                    formData.append('ano_construccion', ano_construccion);
                    formData.append('piso', piso);
                    formData.append('dormitorios', dormitorios);
                    formData.append('banos', banos);
                    formData.append('orientacion', orientacion);
                    formData.append('cocina', cocina);
                    formData.append('logia', logia);
                    formData.append('agua_caliente', agua_caliente);
                    formData.append('espacio_lavadora', espacio_final);
                    formData.append('lavadora', lavadora_final);
                    formData.append('inventario', inventario);
                    formData.append('mt2_total', mt2_total);
                    formData.append('mt2_construido', mt2_construido);
                    formData.append('mt2_terraza', mt2_terraza);
                    formData.append('estacionamiento_visitas', estacionamiento_visitas);
                    formData.append('ascensor', ascensor_final);
                    formData.append('juegos_infantiles', juegos_infantiles_final);
                    formData.append('lavanderia', lavanderia_final);
                    formData.append('quinchos', quinchos_final);
                    formData.append('sala_multiuso', sala_multiuso_final);
                    formData.append('gimnasio', gimnasio_final);
                    formData.append('ciclovia', ciclovia_final);
                    formData.append('piscina', Piscina_final);
                    formData.append('verde', verde_final);

                    console.log('ID de propiedad enviado:', id_propiedad);
                    console.log(formData);

                    $.ajax({
                        url: '/trabajador/detallespropiedad/' + id_propiedad, // URL de la ruta definida
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                                // alert('guardados con exito'); // Mensaje de 
                                $("#Detalle_Propiedad").modal('hide');
                                $("#successModal").modal('show');
                                $('#texto_success').text('Detalles Creados con exito')
                                // $('#Detalle_Propiedad').modal('hide'); // Cerrar el modal
                                // $('#successModal').modal('show'); // Mostrar modal de éxito
                        },
                        error: function(xhr) {
                            // Manejo de errores
                            
                            alert('error al guardar'); // Mostrar errores
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
                        alert("Por favor, complete todos los campos antes de agregar un mantenimiento.");
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
                            url: '/trabajador/guardar/mantenciones', // Ruta del backend para guardar
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


            ////MOSTRAR MODAL DE TABLA DE ARCHIVOS ///
            $(".btn-Contrato").on('click', function(event) {
                event.preventDefault();

                var id_propiedad = $(this).data('id');

                $.ajax({
                        url: '/trabajador/mostrar/archivo/' + id_propiedad,
                        type: 'GET',
                        dataType: 'json'
                    })
                    .done(function(respuesta) {
                        console.log('Respuesta del servidor:');
                        console.log(respuesta);

                        var listaArchivos = $("#lista-agregados-edit");

                        if (respuesta.datosarchivos) {
                            console.log('lista de Archivos:');
                            console.log(respuesta.datosarchivos);
                            var table = $("<table>").addClass("table table-striped table-bordered");
                            var header = $("<thead>")
                                .append($("<tr>")
                                    .append($("<th>").text("Archivo"))
                                    // .append($("<th>").text("ID Arriendo"))
                                );
                            table.append(header);

                            var body = $("<tbody>");
                            respuesta.datosarchivos.forEach(function(datosarchivos) {
                                // Obtener solo el nombre del archivo (basename)
                                var nombreArchivo = datosarchivos.archivo.split('/')
                                    .pop(); // Para sistemas Unix

                                var row = $("<tr>")
                                    .append($("<td>").html('<a href="' + datosarchivos.archivo +
                                        '" target="_blank">' + nombreArchivo + '</a>'
                                    )) // Hacer el nombre del archivo clickeable
                                    // .append($("<td>").text(datosarchivos.id_arriendo))
                                    .append(
                                        $("<td>").html(
                                            '<a href="' + datosarchivos.archivo +
                                            '" class="btn btn-primary btn-sm" download="' + nombreArchivo +
                                            '"><i class="fas fa-download"></i></a> ' +
                                            '<a href="#" class="btn btn-danger btn-sm borrar-contrato-btn" data-id="' +
                                            datosarchivos.id +
                                            '" data-toggle="modal" data-target="#eliminarContratoModal"><i class="fas fa-trash-alt"></i></a>'
                                        )
                                    );
                                body.append(row);
                            });

                            table.append(body);
                            listaArchivos.html(table);
                        }
                        // Show the modal
                        $("#ModificarArchivoModal").modal('show');

                        // Asignar el ID del contrato al botón de guardar para enviar los archivos
                        $('#btn_agregardos').data('id', id_propiedad);
                    });

                const archivosSeleccionados2 = [];
                // Evento para agregar archivos
                document.getElementById('agregar-datossolo').addEventListener('click', function() {
                    const inputArchivo = document.getElementById('Archivos2');
                    const listaDatos2 = document.getElementById('lista-Datosdos');

                    if (inputArchivo.files.length > 0) {
                        // Agregar todos los archivos seleccionados al array
                        Array.from(inputArchivo.files).forEach(archivo => {
                            archivosSeleccionados2.push(archivo);
                            const li = document.createElement('li');
                            li.textContent = archivo.name; // Muestra el nombre del archivo
                            listaDatos2.appendChild(li);
                        });

                        // Resetear el input para permitir cargar el mismo archivo nuevamente si es necesario
                        inputArchivo.value = '';
                    } else {
                        alert('Por favor, selecciona un archivo antes de agregar.');
                    }
                });

                    $(document).ready(function() {
                        $('#btn_agregardos').click(function() {
                            let formData = new FormData();
                            let files = $('#Archivos2')[0].files;
                            let idPropiedad = $(this).data(
                                'id'); // Obtén el ID del arriendo del botón presionado
                            console.log("ID de arriendo para guardar archivos:", idPropiedad);

                            // Agregar archivos de la lista al FormData
                            archivosSeleccionados2.forEach(archivo => {
                                formData.append('contratos2[]', archivo);
                            });


                            formData.append('_token', '{{ csrf_token() }}'); // Agregar token CSRF
                            // Verificar qué archivos se están enviando
                            // Verificar qué archivos se están enviando
                            console.log("Archivos a enviar:");
                            for (let pair of formData.entries()) {
                                console.log(pair[0] + ': ' + (pair[1].name || pair[
                                    1])); // Imprime el nombre del archivo o el valor
                            }
                            $.ajax({
                                url: '/trabajador/archivos/guardar/' +
                                    idPropiedad, // Ruta del controlador en Laravel
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    // alert('Archivos guardados exitosamente');
                                    $('#ModificarArchivoModal').modal('hide');
                                    $("#successModal").modal('show');
                                    $('#texto_success').text('Archivo Guardado con Exito');
                                    // Actualiza la lista de archivos si es necesario
                                    $('#listaArchivos').html(response);
                                },
                                error: function(response) {
                                    alert('Hubo un error al guardar los archivos');
                                }
                            });
                        });
                    });


                    $(document).ready(function() {
                        var archivoId; // Variable para almacenar el ID del contrato a eliminar

                        // Delegación de eventos para el botón de eliminación
                        $(document).on('click', '.borrar-contrato-btn', function(e) {
                            e.preventDefault(); // Evitar el comportamiento por defecto del enlace

                            // Obtener el ID del contrato
                            archivoId = $(this).data('id'); // Obtener el ID del contrato
                            $('#confirmarEliminarContratoBtn').data('id',
                                archivoId); // Pasar el ID al botón de confirmación

                            // Mostrar el modal
                            $('#eliminarContratoModal').modal('show');

                        });

                        // Escuchar el clic en el botón de confirmar eliminación
                        $('#confirmarEliminarContratoBtn').on('click', function() {
                            // Realizar la solicitud AJAX
                            $.ajax({
                                url: '/trabajador/elimiarchivo/' + archivoId,
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    // alert('Contrato eliminado exitosamente.');
                                    // Eliminar la fila correspondiente de la tabla
                                    $('a.borrar-contrato-btn[data-id="' + archivoId + '"]')
                                        .closest('tr').remove();
                                    $('#eliminarContratoModal').modal(
                                        'hide'); // Cerrar el modal
                                    $("#successModal").modal('show');
                                    $('#texto_success').text('Archivo Eliminado con Exito');

                            },
                            error: function(xhr) {
                                alert('Error al eliminar el archivo: ' + xhr.responseJSON
                                    .error);
                            }
                        });
                    });
                });
            });
            const toggleCheckbox = document.getElementById('toggleColumns');
            const uploadSection = document.getElementById('upload-section');
            
            toggleCheckbox.addEventListener('change', function () {
                // Mostrar u ocultar las columnas según el estado del checkbox
                uploadSection.style.display = this.checked ? 'block' : 'none';
            });
            document.addEventListener("DOMContentLoaded", function () {
                // Manejar cambios para "Estacionamientos"
                document.getElementById("estacionamientoSi").addEventListener("change", function () {
                    document.getElementById("camposEstacionamiento").style.display = "block";
                });
                document.getElementById("estacionamientoNo").addEventListener("change", function () {
                    document.getElementById("camposEstacionamiento").style.display = "none";
                });

                // Manejar cambios para "Bodega" (puedes agregar comportamiento si es necesario)
                document.getElementById("bodegaSi").addEventListener("change", function () {
                    // Comportamiento adicional para "Bodega" si lo necesitas
                    document.getElementById("camposBodega").style.display = "block";

                });
                document.getElementById("bodegaNo").addEventListener("change", function () {
                    // Comportamiento adicional para "Bodega" si lo necesitas
                    document.getElementById("camposBodega").style.display = "none";
                });
               
            });
            document.querySelectorAll('label').forEach(label => {
                const boldElement = document.createElement('b'); // Crea un elemento <b>
                boldElement.innerHTML = label.innerHTML; // Copia el contenido del label al <b>
                label.innerHTML = ''; // Limpia el contenido original del label
                label.appendChild(boldElement); // Inserta el <b> dentro del label
            });
            // Función para formatear números con separador de miles
            function formatearMiles(input) {
                // Obtener el valor actual sin caracteres no numéricos
                let valor = input.value.replace(/\D/g, '');
                
                // Aplicar el formato de separador de miles
                let valorFormateado = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                
                // Asignar el valor formateado al campo
                input.value = valorFormateado;
            }


</script>
@endsection

