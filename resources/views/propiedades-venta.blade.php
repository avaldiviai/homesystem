@extends('layouts.app')
@section('content')
    <div class="container-fluid overflow-hidden" style="background-color: #FFAB40">
        <div class="row vh-100 overflow-auto" style="background-color:rgb(255, 255, 255)">
            @include('layouts.sidebar')
            <div class="col d-flex flex-column h-100" style="padding:0;">
                <div class="flex-grow-1">
                    {{-- Contenido --}}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6"
                                style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px;color: white">
                                <h1 class="text-uppercase text-black">Propiedades en Venta</h1>
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
                                <button type="button" class="btn btn-success shadow" data-bs-toggle="modal"
                                    data-bs-target="#agregarPropiedadVenta">
                                    <span>AGREGAR PROPIEDAD</span>
                                </button>
                            </div>
                        </div>
                        <div class="row scrol">
                            @foreach ($propiedadesVenta as $propiedad)
                                <div class="col-lg-3 mb-3">
                                    <a href="propiedadesVentaDetalles-{{$propiedad->id}}" style="text-decoration:none; color: #000;">
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
                                            <!-- Iconos sobre la imagen -->
                                            <div class="position-absolute top-0 p-2 d-flex flex-column">
                                                @if($propiedad->estado_venta == 1)
                                                    <a  class="btn btn-success vender" data-id="{{$propiedad->id}}">
                                                        Disponible
                                                    </a>
                                                @else
                                                    <a class="btn btn-danger ">
                                                        Vendida
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
                                                    <a href="#" class="text-primary mb-2 detalle-propiedad mt-2" data-id="{{ $propiedad->id }}" title="Agregar Detalles">
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

    {{-- SECCION DE MODALES --}}

    <!-- Modal agregar usuario nuevo-->
    <div class="modal fade" id="agregarPropiedadVenta" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="agregarPropiedadVentaLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modal-xl">
                <div class="modal-header"
                    style="background-color:rgb(255, 215, 151); justify-content: center; position: relative;">
                    <h5 class="modal-title text-uppercase" id="agregarPropiedadVentaLabel">Agregar Propiedad en Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="position: absolute; right: 10px; top: 10px;"></button>

                </div>
                <div class="modal-body ">
                    <form method="POST">
                        <div class="container">
                            <div class="row mb-3 p-4 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="col-lg-12 text-center mb-4">
                                    <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                        <h5 class="m-0 text-white">
                                            Detalle de la Propiedad
                                        </h5>
                                    </div>
                                </div>
                                
                                <div class="form-group col-lg-4">
                                    <label class="form-label"><b>Precio Propiedad</b></label>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control mt-2"
                                            id="precioInput"
                                            placeholder="Precio"
                                            oninput="formatearMiles(this)"
                                            required>

                                        <div class="input-group-text mt-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"
                                                    class="custom-control-input "
                                                    id="switchUF">
                                                <label class="custom-control-label" for="switchUF"></label>
                                            </div>
                                            <span id="monedaTexto" class="ms-2 fw-bold">CLP</span>
                                        </div>
                                    </div>
                                    <input type="hidden" id="tipo_moneda" value="CLP">
                                </div>
                            

                                <div class="form-group col-lg-4">
                                    <label for="direccionInput" class="form-label"><b>Dirección de Propiedad</b></label>
                                    <input type="text" class="form-control mt-2" id="direccionInput" placeholder="Ej: Av. Raul Biltran" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="ciudadInput" class="form-label"><b>Ciudad de la propiedad</b></label>
                                    <input type="text" class="form-control mt-2" id="ciudadInput" placeholder="Nombre de la Ciudad" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="torreInput" class="form-label"><b>Torre</b></label>
                                    <input type="text" class="form-control mt-2" id="torreInput" placeholder="Ej: El Maitén" required>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="numeroCasaInput" class="form-label"><b>N° Casa / Departamento</b></label>
                                    <input type="text" class="form-control mt-2"
                                        id="numeroCasaInput"placeholder="Ej: 55" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="rolInput" class="form-label"><b>Rol</b></label>
                                    <input type="text" class="form-control mt-2" id="rolInput"
                                        placeholder="Ej: 4308-25" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="tipoInput"><b>Tipo Vivienda</b></label>
                                    <select class="form-select mt-2" id="tipoInput">
                                        <option value="" selected disabled>Seleccione Tipo Vivienda</option>
                                        <option value="Casa">Casa</option>
                                        <option value="Departamento">Departamento</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="rutaInput"><b>Ruta de Maps</b></label>
                                    <input type="text" class="form-control mt-2" id="rutaInput" required
                                        placeholder='Ej:<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d10785.048068881935!2d-71.25756221840972!3d-29.90451371620642!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4" '>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="condominioInput"><b>Sector / Condominio</b></label>
                                    <input type="text" class="form-control mt-2" id="condominioInput"
                                        placeholder="Ej: Parque Fray Jorge" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="propietarioInput"><b>Propietarios</b></label>

                                    <div class="d-flex justify-content-between ">
                                        <select id="propietarioInput" class="form-select me-2">
                                            <option disabled selected value="0">Seleccione un propietario</option>
                                            @foreach ($propietarioVenta as $propietario)
                                                <option value="{{ $propietario->id }}">{{ $propietario->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary" id="agregar-propietario">Agregar</button>
                                    </div>
                                    <ul class="text-uppercase mt-4 m-1 p-1" id="lista-agregados">
                                        <!-- <button class="btn btn-danger"><i class="fas fa-trash-alt fa-lg text-white"></i></button> -->
                                    </ul>
                                </div>
                            </div>

                            <div class="row mb-3 p-4 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="col-lg-12 text-center mb-4">
                                    <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                        <h5 class="m-0 text-white">
                                            Servicios Comúnes
                                        </h5>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="empresaLuzInput"><b>Empresa Luz</b></label>
                                    <input type="text" class="form-control mt-2" id="empresaLuzInput"
                                        placeholder="Ej: CGE" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="numeroLuzInput"><b>N° Luz</b></label>
                                    <input type="text" class="form-control mt-2" id="numeroLuzInput"
                                        placeholder="Ej: 1728191" required>
                                </div>

                                <div class="form-group col-6">
                                    <label for="empresaAguaInput"><b>Empresa Agua</b></label>
                                    <input type="text" class="form-control mt-2" id="empresaAguaInput"
                                        placeholder="Ej: Aguas del Valle" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="numeroAguaInput"><b>N° Agua</b></label>
                                    <input type="text" class="form-control mt-2" id="numeroAguaInput"
                                        placeholder="Ej: 1010101-0" required>
                                </div>

                                <div class="form-group col-6">
                                    <label for="empresaGasInput"><b>Empresa Gas</b></label>
                                    <input type="text" class="form-control mt-2" id="empresaGasInput"
                                        placeholder="Ej: GASCO" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="numeroGasInput"><b>N° Gas</b></label>
                                    <input type="text" class="form-control mt-2" id="numeroGasInput"
                                        placeholder="17281727" required>
                                </div>
                            </div>

                            <div class="row mb-3 p-2 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="col-lg-12 text-center mb-4">
                                    <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                        <h5 class="m-0 text-white">
                                            Servicios Básicos
                                        </h5>
                                    </div>
                                </div>

                                <!-- Pregunta: ¿Tiene Estacionamiento? -->
                                <div class="form-group col-lg-6 text-center">
                                    <label for="estacionamientoCheck"><b>¿Tiene Estacionamiento?</b></label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="estacionamientoSi"
                                                name="estacionamientoCheck" value="si">
                                            <label for="estacionamientoSi" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="estacionamientoNo"
                                                name="estacionamientoCheck" value="no">
                                            <label for="estacionamientoNo" class="form-check-label">No</label>
                                        </div>
                                    </div>

                                    <div id="camposEstacionamiento" class="form-group col-lg-12"
                                        style="display: none; margin-top: 20px;">
                                        <div class="row bg-white m-1" style="border-radius: .9rem;">
                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="precioInput"><b>Precio Propiedad</b></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control mt-2" id="precioInput" 
                                                        placeholder="Ej: $380.000" name="precioInput" value="$" required
                                                        oninput="this.value = '$' + this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                                </div>
                                            </div>
                                        </div>
                                            <div class="form-group col-lg-4">
                                                <label for="rolInputestacionamiento"><b>Rol</b></label>
                                                <input type="text" class="form-control mt-2"
                                                    id="rolInputestacionamiento" placeholder="Rol">
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="numeroEstacionamientoInput"><b>Estacionamiento</b></label>
                                                <input type="text" class="form-control mt-2"
                                                    id="numeroEstacionamientoInput" placeholder="Numero ">
                                            </div>
                                            <div class="form-group col-lg-12 text-center">
                                            <label for="techadoCheck"><b>¿Tiene Techado?</b></label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" id="techadoSi" name="techadoCheck" value="si">
                                                    <label for="techadoSi" class="form-check-label">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" id="techadoNo" name="techadoCheck" value="no">
                                                    <label for="techadoNo" class="form-check-label">No</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                </div>

                                <!-- Pregunta: ¿Tiene Bodega? -->
                                <div class="form-group col-lg-6 text-center">
                                    <label for="bodegaCheck"><b>¿Tiene Bodega?</b></label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="bodegaSi"
                                                name="bodegaCheck" value="si">
                                            <label for="bodegaSi" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="bodegaNo"
                                                name="bodegaCheck" value="no">
                                            <label for="bodegaNo" class="form-check-label">No</label>
                                        </div>
                                    </div>

                                    <div id="camposBodega" class="form-group col-lg-12"
                                        style="display: none; margin-top: 20px;">
                                        <div class="row bg-white m-1" style="border-radius: .9rem;">
                                            <label><b>Detalles de la Bodega</b></label>
                                            <div class="col-lg-4 mb-3">
                                                <label for="montoInputbodega"><b>Monto</b></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control mt-2" id="montoInputbodega" 
                                                    placeholder="Ej: $380.000" name="montoInputbodega" value="$"             
                                                    oninput="this.value = '$' + this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                                </div>
                                            </div>


                                            <div class="form-group col-lg-4">
                                                <label for="rolInputbodega"><b>Rol</b></label>
                                                <input type="text" class="form-control mt-2" id="rolInputbodega"
                                                    placeholder="Rol">
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="numeroBodegaInput"><b>Bodega</b></label>
                                                <input type="text" class="form-control mt-2" id="numeroBodegaInput"
                                                    placeholder="Numero">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-4 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="col-lg-12 text-center mb-4">
                                    <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                        <h5 class="m-0 text-white">
                                            Campos Adicionales
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-lg-4 p-3">
                                    <div class="form-check mb-3">
                                        <input type="checkbox" id="toggleDetalles" class="form-check-input">
                                        <label for="toggleDetalles" class="form-check-label"><b>Campos
                                                Adicionales</b></label>
                                    </div>
                                </div>
                                <div id="detallesAdicionales" style="display: none;">
                                    <hr>
                                    <div class="row">
                                    <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                            <label for="deuda_hipotecaria"><b>Deuda Hipotecaria</b></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control mt-2" id="deuda_hipotecaria"
                                                    placeholder="Ej: $50.000" name="deuda_hipotecaria" value="$" required
                                                    oninput="this.value = '$' + this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                            </div>
                                        </div>

                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="contribuciones" class="form-label"><b>Construcción</b></label>
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input"
                                                            id="contribuciones_si" name="contribuciones" value="1">
                                                        <label for="contribuciones_si" class="form-check-label">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input"
                                                            id="contribuciones_no" name="contribuciones" value="0">
                                                        <label for="contribuciones_no" class="form-check-label">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="derechos_aseo" class="form-label"><b>Derechos de
                                                        Aseo</b></label>
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input"
                                                            id="derechos_aseo_si" name="derechos_aseo" value="1">
                                                        <label for="derechos_aseo_si" class="form-check-label">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input"
                                                            id="derechos_aseo_no" name="derechos_aseo" value="0">
                                                        <label for="derechos_aseo_no" class="form-check-label">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="exclusividad" class="form-label"><b>Exclusividad</b></label>
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input"
                                                            id="exclusividad_si" name="exclusividad" value="1">
                                                        <label for="exclusividad_si" class="form-check-label">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input"
                                                            id="exclusividad_no" name="exclusividad" value="0">
                                                        <label for="exclusividad_no" class="form-check-label">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="sello_verde" class="form-label"><b>Escritura</b></label>
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input"
                                                            id="sello_verde_si" name="sello_verde" value="1">
                                                        <label for="sello_verde_si" class="form-check-label">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input"
                                                            id="sello_verde_no" name="sello_verde" value="0">
                                                        <label for="sello_verde_no" class="form-check-label">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-6 shadow mt-5" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="col-lg-4 p-3">
                                    <div class="form-group mb-3">
                                        <label for="imagenes" class="form-label"><b>Agregar Imágenes y Videos</b></label>
                                        <div class="upload-container" id="dropZone"
                                            style="border: 2px dashed #ccc; padding: 20px; text-align: center;">
                                            <input type="file" id="fileInput"
                                                accept="image/png, image/jpeg, image/gif" multiple hidden>
                                            <div>
                                                <i class="bi bi-upload fs-1"></i>
                                                <p class="mb-1">Haga clic para cargar o arrastre y suelte</p>
                                                <p class="small text-muted">PNG, JPG, GIF hasta 10MB cada uno</p>
                                            </div>
                                            <div id="preview" class="d-flex flex-wrap justify-content-center mt-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>


                <hr>
                <div class="modal-header"
                    style="background-color:rgb(255, 215, 151); justify-content: center; position: relative;">
                    <button type="button" id="btn_agregar" class="btn btn-primary"
                        style="margin-left: auto;">Guardar</button>
                    <button type="button" id="btn_cerrar_agregar" class="btn btn-danger" style="margin-left: 10px;"
                        data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
    </div>


    <!-- Agregar Detalles de Propiedad -->
    <div class="modal fade" id="Detalle_Propiedad" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="Detalle_PropiedadLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modal-xl">
                <!-- Header del Modal -->
                <div class="modal-header" style="background-color: #FFE2B2; justify-content: center; position: relative;">
                    <h5 class="modal-title text-uppercase" id="Detalle_PropiedadLabel"
                        style="color: #4A4A4A; text-align: center; font-size: 1.5rem;">Detalles de la Propiedad</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;"></button>

                </div>

                <!-- Cuerpo del Modal -->
                <div class="modal-body">
                    <form method="POST">
                        <div class="container">
                            <div class="row g-3">
                                <div class="container">
                                    <div class="row">
                                        <!-- Primera columna -->
                                        <div class="col-12 col-md-6 p-3">
                                            <div class="row g-3 m-1 shadow"
                                                style="background-color: #FFE2B2; border-radius: .9rem;">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="ano_construccion" class="form-label">Año de Construcción</label>
                                                            <select id="ano_construccion" class="form-control"  name="ano_construccion" required>
                                                                <option value="">Seleccione año</option>
                                                                @for ($y = date('Y'); $y >= 1970; $y--)
                                                                    <option value="{{ $y }}">{{ $y }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="piso" class="form-label"><b>Piso</b></label>
                                                            <input type="number" class="form-control" id="piso"
                                                                placeholder="Ej: 3" name="piso">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <!-- Dormitorios al lado de Baños -->
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="dormitorios"
                                                                class="form-label"><b>Dormitorios</b></label>
                                                            <input type="number" class="form-control" id="dormitorios"
                                                                placeholder="Ej: 4" name="dormitorios">
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="banos" class="form-label"><b>Baños</b></label>
                                                            <input type="number" class="form-control" id="banos"
                                                                name="banos" placeholder="Ej: 1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Segunda columna -->
                                        <div class="col-12 col-md-6 p-3">
                                            <div class="row g-3 m-1 shadow"
                                                style="background-color: #FFE2B2; border-radius: .9rem;">
                                                <div class="form-group col-12 col-lg-6">
                                                    <label for="orientacion" class="form-label"><b>Orientación</b></label>
                                                    <select class="form-select" name="orientacion" id="orientacion">
                                                        <option value="" disabled selected>Seleccionar una opción
                                                        </option>
                                                        <option value="N">Norte</option>
                                                        <option value="NE">Noreste</option>
                                                        <option value="E">Oriente (Este)</option>
                                                        <option value="SE">Sureste</option>
                                                        <option value="S">Sur</option>
                                                        <option value="SO">Suroeste</option>
                                                        <option value="O">Poniente (Oeste)</option>
                                                        <option value="NO">Noroeste</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-12 col-lg-6">
                                                    <label for="cocina" class="form-label"><b>Tipo de conexión</b></label>
                                                    <select class="form-select" name="cocina" id="cocina">
                                                        <option value="" disabled selected>Seleccione una opción
                                                        </option>
                                                        <option value="Eléctrica">Conexión eléctrica</option>
                                                        <option value="Gas">Gas cilindro</option>
                                                        <option value="Conexión Gas">Conexión cañeria</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-12 col-lg-6">
                                                    <label for="logia" class="form-label"><b>Logia</b></label>
                                                    <select class="form-select" name="logia" id="logia">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                        <option value="1">Si</option>
                                                        <option value="2">No</option>
                                                        <option value="3">Conexión para lavadora</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-12 col-lg-6">
                                                    <label for="agua_caliente" class="form-label"><b>Agua
                                                            Caliente</b></label>
                                                    <select class="form-select" name="agua_caliente" id="agua_caliente">
                                                        <option value="" disabled selected>Seleccione una opción
                                                        </option>
                                                        <option value="Calefont">Calefont</option>
                                                        <option value="Termo">Termo</option>
                                                        <option value="Caldera">Caldera</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-12 col-lg-6 d-none" id="wrap_tipo_cocina_depto">
                                                    <label for="tipo_cocina_depto" class="form-label"><b>Tipo de cocina (Depto)</b></label>
                                                    <select class="form-select" name="tipo_cocina_depto" id="tipo_cocina_depto">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                        <option value="Encimera">Encimera</option>
                                                        <option value="Vitroceramica">Vitrocerámica</option>
                                                        <input type="hidden" id="modal_tipo_propiedad">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 m-1 shadow mb-4"
                                    style="background-color: #FFE2B2; border-radius: .9rem;">
                                    <div class="form-group mb-3 col-lg-4">
                                        <label for="mt2_construido" class="form-label"><b>MT2 Construido</b></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="mt2_construido"
                                                placeholder="Ej: 230" name="mt2_construido">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">mt2</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 col-lg-4">
                                        <label for="mt2_terraza" class="form-label"><b>MT2 Terraza</b></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="mt2_terraza"
                                                placeholder="Ej: 320" name="mt2_terraza">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">mt2</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 col-lg-4">
                                        <label for="mt2_total" class="form-label"><b>MT2 Total</b></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="mt2_total"
                                                placeholder="Ej: 201" name="mt2_total">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">mt2</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 col-lg-5">
                                        <label for="inventario" class="form-label"><b>Inventario</b></label>
                                        <input type="text" class="form-control" id="inventario"
                                            placeholder="Ej: Muebles incluidos" name="inventario">
                                    </div>

                                    <div class="form-group mb-3 col-lg-4">
                                        <label for="estacionamiento_visitas" class="form-label"><b>Estacionamiento de
                                                Visitas</b></label>
                                        <input type="number" class="form-control" id="estacionamiento_visitas"
                                            placeholder="Ej: 201" name="estacionamiento_visitas">
                                    </div>
                                </div>

                                <div class="row g-3 m-1 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                    <!-- Espacio para Lavadora -->
                                    <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                        <label for="espacio_lavadora" class="form-label"><b>Espacio para
                                                Lavadora</b></label>
                                        <div class="form-group my-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="espacio_lavadora_si"
                                                    name="espacio_lavadora" value="1">
                                                <label for="espacio_lavadora_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="espacio_lavadora_no"
                                                    name="espacio_lavadora" value="0">
                                                <label for="espacio_lavadora_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Lavadora -->
                                    <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                        <label for="lavadora" class="form-label"><b>Lavadora</b></label>
                                        <div class="form-group my-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="lavadora_si"
                                                    name="lavadora" value="1">
                                                <label for="lavadora_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="lavadora_no"
                                                    name="lavadora" value="0">
                                                <label for="lavadora_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Ascensor -->
                                    <div class="mb-3 col-lg-3 col-sm-3 text-center">
                                        <label for="ascensor" class="form-label"><b>Ascensor</b></label>
                                        <div class="form-group my-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="ascensor_si"
                                                    name="ascensor" value="1">
                                                <label for="ascensor_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="ascensor_no"
                                                    name="ascensor" value="0">
                                                <label for="ascensor_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Juegos Infantiles -->
                                    <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                        <label for="juegos_infantiles" class="form-label"><b>Juegos Infantiles</b></label>
                                        <div class="form-group my-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="juegos_infantiles_si"
                                                    name="juegos_infantiles" value="1">
                                                <label for="juegos_infantiles_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="juegos_infantiles_no"
                                                    name="juegos_infantiles" value="0">
                                                <label for="juegos_infantiles_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Lavandería -->
                                    <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                        <label for="lavanderia" class="form-label"><b>Lavandería</b></label>
                                        <div class="form-group my-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="lavanderia_si"
                                                    name="lavanderia" value="1">
                                                <label for="lavanderia_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="lavanderia_no"
                                                    name="lavanderia" value="0">
                                                <label for="lavanderia_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quinchos -->
                                    <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                        <label for="quinchos" class="form-label"><b>Quinchos</b></label>
                                        <div class="form-group my-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="quinchos_si"
                                                    name="quinchos" value="1">
                                                <label for="quinchos_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="quinchos_no"
                                                    name="quinchos" value="0">
                                                <label for="quinchos_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sala Multiuso -->
                                    <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                        <label for="sala_multiuso" class="form-label"><b>Sala Multiuso</b></label>
                                        <div class="form-group my-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="sala_multiuso_si"
                                                    name="sala_multiuso" value="1">
                                                <label for="sala_multiuso_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="sala_multiuso_no"
                                                    name="sala_multiuso" value="0">
                                                <label for="sala_multiuso_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Gimnasio -->
                                    <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                        <label for="gimnasio" class="form-label"><b>Gimnasio</b></label>
                                        <div class="form-group my-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="gimnasio_si"
                                                    name="gimnasio" value="1">
                                                <label for="gimnasio_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="gimnasio_no"
                                                    name="gimnasio" value="0">
                                                <label for="gimnasio_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Ciclovía -->
                                    <div class="form-group mb-3 col-lg-4 col-sm-4 text-center">
                                        <label for="ciclovia" class="form-label"><b>Ciclovía</b></label>
                                        <div class="form-group my-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="ciclovia_si"
                                                    name="ciclovia" value="1">
                                                <label for="ciclovia_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="ciclovia_no"
                                                    name="ciclovia" value="0">
                                                <label for="ciclovia_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 col-lg-4 col-sm-4 text-center">
                                        <label for="piscina" class="form-label"><b>Piscina</b></label>
                                        <div class="form-group my-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="piscina_si"class="form-check-input" name="piscina" value="1"> 
                                                <label for="piscina_si">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="piscina_no"class="form-check-input" name="piscina" value="0"> 
                                                <label for="piscina_no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 col-lg-4 col-sm-4 text-center">
                                        <label for="verde" class="form-label"><b>Areas Verdes</b></label>
                                        <div class="form-group my-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="verde_si"class="form-check-input" name="verde" value="1"> 
                                                <label for="verde_si">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="verde_no"class="form-check-input" name="verde" value="0"> 
                                                <label for="verde_no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="row g-3 m-1 shadow mb-4"
                                    style="background-color: #FFE2B2; border-radius: .9rem;">
                                    <div class="col-12 col-md-6">
                                        <label for="gasto_comun" class="form-label"><b>Gasto Común</b></label>
                                        <input type="number" class="form-control" id="gasto_comun"
                                            placeholder="Ej: 12000" name="gasto_comun">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="descripcion" class="form-label"><b>Descripción</b></label>
                                        <textarea class="form-control" placeholder="La vivienda se ubica ...." id="descripcion" name="descripcion"></textarea>
                                    </div>
                                </div>
                                <hr>
                                Botones -->
                            <!-- </div>
                        </form> -->
                    </div>
                
                </div>
            </div>
            <div class="modal-footer" style="background-color: #FFE2B2;">
                <button type="button" id="btn_agregardetalle"
                    class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
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
                        <h5 class="modal-title text-center w-100">Archivos Agregados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Archivos existentes -->
                        <div class="mb-4">
                            <h6>Archivos de la Propiedad:</h6>
                            <div id="lista-agregados-edit" class="mt-3">
                                <!-- Lista generada dinámicamente con archivos recuperados -->
                            </div>
                        </div>

                        <!-- Botón para agregar nuevos archivos -->
                        <div class="col-12">
                            <button class="btn btn-warning w-100 mt-3 mb-3 text-uppercase text-white" type="button"
                                data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3" aria-expanded="false"
                                aria-controls="multiCollapseExample3">
                                <b>Agregar Nuevos Archivos</b>
                            </button>
                        </div>

                        <!-- Sección para agregar nuevos archivos -->
                        <div class="collapse multi-collapse3" id="multiCollapseExample3">
                            <div>
                                <label for="contrato" class="form-label"><strong>Selecciona los archivos a
                                        cargar:</strong></label>
                                <input type="file" name="contratos2[]" accept=".pdf,.doc,.docx,.jpg,.png" required
                                    class="form-control" id="Archivos2" multiple>
                                <ul class="text-uppercase mt-4" id="lista-Datosdos">
                                    <!-- Vista previa de documentos seleccionados -->
                                </ul>
                            </div>

                            <div class="col-md-12 d-flex justify-content-end mt-3">
                                <button type="button" id="btn_agregardos" class="btn btn-success me-2">Guardar</button>
                                <button type="button" id="btn_cerrar_agregar" class="btn btn-danger"
                                    data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
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
                    <div class="modal-footer d-flex justify-content-end">
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
        <!-- modal error -->
        <div class="modal fade" id="modalerror" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalerrorLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"> <!-- Centrado en la pantalla -->
                <div class="modal-content">
                    <div class="modal-header alert alert-danger" role="alert" style="border: none;">
                        <div class="container">
                            <div class="row">
                                <!-- Icono de error animado -->
                                <div class="col-2">
                                    <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json" trigger="loop" delay="2000"
                                        style="width:70px;height:70px">
                                    </lord-icon>
                                </div>
                                <!-- Mensaje de error centrado -->
                                <div class="col-8 d-flex justify-content-center align-items-center">
                                    <p id="texto_error" class="text-uppercase text-center m-0">Ha Ocurrido un Error al
                                        Guardar.</p>
                                </div>
                                <!-- Botón de cierre -->
                                <div class="col-2 d-flex justify-content-end align-items-center">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        id="cerrar_error"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal info -->
        <div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalinfoLabel" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
                    <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                        <h5 class="m-4 text-uppercase text-center " id="textoinfo">¿Seguro/a que quieres eliminar
                            Propiedad?
                            </h2>
                            <div class="modalfooter d-flex justify-content-center">
                                <button type="button" class="btn btn-danger m-2"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" id="confirmDelete" class="btn btn-secondary m-2">Eliminar</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal infro archivo -->
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
                <!-- Modal infro archivo -->
        <div class="modal fade" id="venderpropiedadModal" tabindex="-1" aria-labelledby="venderpropiedadModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="alert alert-success d-flex align-items-center" id="alerta" role="alert">
                    <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                        <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres Vender esta Propiedad?</h2>
                        <div class="modalfooter d-flex justify-content-center">
                            <button type="button" class="btn btn-danger m-2"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="confimarventa"
                                class="btn btn-success m-2">Vender</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            // funcion que siempre tiene que ir en script inicio
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                console.log('Listo para trabajar');

                ////////////Mostrar Campos Adicionales ////////////////////
                $('#toggleDetalles').change(function() {
                    if ($(this).is(':checked')) {
                        $('#detallesAdicionales').slideDown();
                    } else {
                        $('#detallesAdicionales').slideUp();
                    }
                });

                ////////////////////////////BUSCADOR/////////////////////////
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
                            url: '/obtener/propietarioVenta',
                            type: 'GET',
                            data: {
                                nombre_pro: propietarios.id
                            }, // Envía el ID del propietario al servidor
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
                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.classList.add('img', 'me-2', 'mb-2');
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
                
                let tipoMoneda = 'CLP';
        
                $("#switchUF").on("change", function () {
                    tipoMoneda = this.checked ? 'UF' : 'CLP';
                });
                //Boton agregar arriendo
                $("#btn_agregar").on('click', function(event) {
                    event.preventDefault();

                    // Obtener los valores de los campos de texto
                    var direccion = $("#direccionInput").val();
                    var ciudad = $("#ciudadInput").val();
                    var maps = $("#rutaInput").val();
                    var rol = $("#rolInput").val();
                    var tipo_vivienda = $("#tipoInput").val();
                    var condominio = $("#condominioInput").val();
                    var torre = $("#torreInput").val();
                    var num_departamento = $("#numeroCasaInput").val();
                    var empresaluz = $("#empresaLuzInput").val();
                    var numeroluz = $("#numeroLuzInput").val();
                    var empresaagua = $("#empresaAguaInput").val();
                    var numeroagua = $("#numeroAguaInput").val();
                    var empresagas = $("#empresaGasInput").val();
                    var numerogas = $("#numeroGasInput").val();
                    var precio = $("#precioInput").val();
                    var deuda_hipotecaria = $("#deuda_hipotecaria").val();
                    var contribuciones = $("input[name='contribuciones']:checked").val();
                    var derechos_aseo = $("input[name='derechos_aseo']:checked").val();
                    var exclusividad = $("input[name='exclusividad']:checked").val();
                    var sello_verde = $("input[name='sello_verde']:checked").val();
                    var tipo_moneda = tipoMoneda;


                    var monto = $("#montoInput").val();
                    var rol_est = $("#rolInputestacionamiento").val();
                    var estacionamiento = $("#numeroEstacionamientoInput").val();

                    var monto_b = $("#montoInputbodega").val();
                    var rol_b = $("#rolInputbodega").val();
                    var bodega = $("#numeroBodegaInput").val();

                    var monto_t = $("#montoInputTechado").val();
                    var rol_t = $("#rolInputTechado").val();
                    var techado = $("#numeroTechadoInput").val();

                    // Crear un objeto FormData
                    var formData = new FormData();

                    // Agregar los datos del formulario al FormData
                    formData.append('direccion', direccion);
                    formData.append('ciudad', ciudad);
                    formData.append('maps', maps);
                    formData.append('rol', rol);
                    formData.append('tipo_vivienda', tipo_vivienda);
                    formData.append('condominio', condominio);
                    formData.append('torre', torre);
                    formData.append('num_departamento', num_departamento);
                    formData.append('empresaluz', empresaluz);
                    formData.append('numeroluz', numeroluz);
                    formData.append('empresaagua', empresaagua);
                    formData.append('numeroagua', numeroagua);
                    formData.append('empresagas', empresagas);
                    formData.append('numerogas', numerogas);
                    formData.append('precio', precio);
                    formData.append('deuda_hipotecaria', deuda_hipotecaria);
                    formData.append('contribuciones', contribuciones);
                    formData.append('derechos_aseo', derechos_aseo);
                    formData.append('exclusividad', exclusividad);
                    formData.append('sello_verde', sello_verde);
                    formData.append('tipo_moneda', tipo_moneda);

                    formData.append('monto', monto);
                    formData.append('rol_est', rol_est);
                    formData.append('estacionamiento', estacionamiento);

                    formData.append('monto_b', monto_b);
                    formData.append('rol_b', rol_b);
                    formData.append('bodega', bodega);

                    formData.append('monto_t', monto_t);
                    formData.append('rol_t', rol_t);
                    formData.append('techado', techado);

                    // Obtener los archivos seleccionados
                    var files = $('#fileInput')[0].files;

                    // Iterar sobre los archivos seleccionados y agregarlos al objeto FormData
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        formData.append('imagenes[]', file);
                    }

                    // Convertir iconosAgregados a cadena JSON y agregarlo al FormData
                    formData.append('PropietariosAgregados', JSON.stringify(PropietariosAgregados));

                    formData.forEach(function(value, key) {
                        console.log(key, value);
                    });

                    console.log(formData);

                    // Realizar la solicitud AJAX
                    $.ajax({
                        url: '{{ url('/propiedadesVenta/add_propiedad') }}',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(respuesta) {
                            console.log("respuesta", respuesta);
                            $("#agregarPropiedadVenta").modal('hide');
                            $("#successModal").modal('show');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("Error:", errorThrown);
                            $("#agregarPropiedadVenta").modal('hide');
                            $('#modalerror').modal('show');
                        }
                    });
                }); //fin agregar arriendo
                $(".vender").on('click', function(event) {
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
                        url: '/venderpropiedad' + idPropiedad,
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

                ////MOSTRAR MODAL DE DETALLES ///
                $(document).ready(function() {
                    let idPropiedad;
                    let tipoVivienda;

                    $(".detalle-propiedad").on('click', function(event) {
                        event.preventDefault();
                        idPropiedad = $(this).data('id');
                        $("#Detalle_Propiedad").modal('show');
                    });

                    $('#btn_agregardetalle').click(function(e) {
                        event.preventDefault();


                        var camposVacios = false; // Variable para verificar si hay campos vacíos

                        // Limpiar mensajes anteriores
                        $(".campo-error").remove();


                        var ano_construccion = $("#ano_construccion").val();
                        var piso = $("#piso").val();
                        var dormitorios = $("#dormitorios").val();
                        var banos = $("#banos").val();
                        var orientacion = $("#orientacion").val();
                        var cocina = $("#cocina").val();
                        var logia = $("#logia").val();
                        var agua_caliente = $("#agua_caliente").val();
                        var espacio_lavadora = $("input[name='espacio_lavadora']:checked").val();
                        var lavadora = $("input[name='lavadora']:checked").val();
                        var inventario = $("#inventario").val();
                        var mt2_total = $("#mt2_total").val();
                        var mt2_construido = $("#mt2_construido").val();
                        var mt2_terraza = $("#mt2_terraza").val();
                        var estacionamiento_visitas = $("#estacionamiento_visitas")
                        .val();
                        var ascensor = $("input[name='ascensor']:checked").val();
                        var juegos_infantiles = $("input[name='juegos_infantiles']:checked").val();
                        var lavanderia = $("input[name='lavanderia']:checked").val();
                        var quinchos = $("input[name='quinchos']:checked").val();
                        var sala_multiuso = $("input[name='sala_multiuso']:checked").val();
                        var gimnasio = $("input[name='gimnasio']:checked").val();
                        var ciclovia = $("input[name='ciclovia']:checked").val();
                        var piscina = $("input[name='piscina']:checked").val();
                        var verde = $("input[name='verde']:checked").val();

                        var gasto_comun = $("#gasto_comun").val();
                        var descripcion = $("#descripcion").val();

                        // Validar los campos y mostrar el mensaje de advertencia si están vacíos
                        if (!ano_construccion) {
                            mostrarError("#ano_construccion");
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
                            mostrarError("#baños");
                            camposVacios = true;
                        }
                        if (!orientacion) {
                            mostrarError("#orientacion");
                            camposVacios = true;
                        }
                        if (!cocina) {
                            mostrarError("#cocina");
                            camposVacios = true;
                        }
                       
                        if (!logia) {
                            mostrarError("#logia");
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
                            formData.append('id_propiedad', idPropiedad);
                            formData.append('ano_construccion', ano_construccion);
                            formData.append('piso', piso);
                            formData.append('dormitorios', dormitorios);
                            formData.append('banos', banos);
                            formData.append('orientacion', orientacion);
                            formData.append('cocina', cocina);
                            formData.append('logia', logia);
                            formData.append('agua_caliente', agua_caliente);
                            formData.append('espacio_lavadora', espacio_lavadora);
                            formData.append('lavadora', lavadora);
                            formData.append('inventario', inventario);
                            formData.append('mt2_total', mt2_total);
                            formData.append('mt2_construido', mt2_construido);
                            formData.append('mt2_terraza', mt2_terraza);
                            formData.append('estacionamiento_visitas', estacionamiento_visitas);
                            formData.append('ascensor', ascensor);
                            formData.append('juegos_infantiles', juegos_infantiles);
                            formData.append('lavanderia', lavanderia);
                            formData.append('quinchos', quinchos);
                            formData.append('sala_multiuso', sala_multiuso);
                            formData.append('gimnasio', gimnasio);
                            formData.append('ciclovia', ciclovia);
                            formData.append('gasto_comun', gasto_comun);
                            formData.append('descripcion', descripcion);
                            formData.append('piscina', piscina);
                            formData.append('verde', verde);


                            console.log('ID de propiedad enviado:', idPropiedad);

                            $.ajax({
                                url: '/detallesVentaPropiedad/' + idPropiedad,
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    $('#Detalle_Propiedad').modal('hide');
                                    $('#successModal').modal(
                                        'show'); // Mostrar modal de éxito
                                },
                                error: function(xhr) {
                                    // Manejo de errores
                                    var errors = xhr.responseJSON.errors;
                                    var errorMessage = '';
                                    $.each(errors, function(key, value) {
                                        errorMessage += value[0] +
                                            '\n'; // Concatenar mensajes de error
                                    });
                                    $("#modalerror").modal('show');
                                    console.log(errorMessage); // Mostrar errores
                                }

                            });
                        }
                    });

                    function mostrarError(campo) {
                        if ($(campo).next(".campo-error").length === 0) {
                            $(campo).after(
                                '<div class="campo-error" style="color: red; font-size: 12px;">Por favor complete este campo.</div>'
                            );
                        }
                    }
                });
            });

            //toggle de estacionamiento, bodegas y techado
            document.addEventListener("DOMContentLoaded", function() {
                // Manejar cambios para "Estacionamientos"
                document.getElementById("estacionamientoSi").addEventListener("change", function() {
                    document.getElementById("camposEstacionamiento").style.display = "block";
                });
                document.getElementById("estacionamientoNo").addEventListener("change", function() {
                    document.getElementById("camposEstacionamiento").style.display = "none";
                });

                // Manejar cambios para "Bodega" (puedes agregar comportamiento si es necesario)
                document.getElementById("bodegaSi").addEventListener("change", function() {
                    // Comportamiento adicional para "Bodega" si lo necesitas
                    document.getElementById("camposBodega").style.display = "block";

                });
                document.getElementById("bodegaNo").addEventListener("change", function() {
                    // Comportamiento adicional para "Bodega" si lo necesitas
                    document.getElementById("camposBodega").style.display = "none";
                });
                // Manejar cambios para "camposTechado" (puedes agregar comportamiento si es necesario)
                document.getElementById("techadoSi").addEventListener("change", function() {
                    // Comportamiento adicional para "camposTechado" si lo necesitas
                    document.getElementById("camposTechado").style.display = "block";

                });
                document.getElementById("techadoNo").addEventListener("change", function() {
                    // Comportamiento adicional para "camposTechado" si lo necesitas
                    document.getElementById("camposTechado").style.display = "none";
                });
            });

            // MOSTRAR ARCHIVOS
            $(".btn-Contrato").on('click', function(event) {
                event.preventDefault();

                var id_propiedad = $(this).data('id');
                var archivosSeleccionados2 = []; // Mantener los archivos seleccionados
                var listaDatos2 = document.getElementById('lista-Datosdos');

                console.log('idPropiedad btn1 : ', id_propiedad);

                archivosSeleccionados2 = [];
                listaDatos2.innerHTML = '';

                // Mostrar modal
                $("#ModificarArchivoModal").modal('show');

                // Obtener archivos existentes desde el servidor
                $.ajax({
                        url: '/mostrar/archivo/' + id_propiedad,
                        type: 'GET',
                        dataType: 'json'
                    })
                    .done(function(respuesta) {
                        console.log('Respuesta del servidor:', respuesta);

                        var listaArchivos = $("#lista-agregados-edit"); // Contenedor para la tabla

                        // Limpia la tabla existente
                        listaArchivos.empty();

                        // Verifica si hay datos para mostrar
                        if (respuesta.datosarchivos && respuesta.datosarchivos.length > 0) {
                            console.log('Archivos obtenidos:', respuesta.datosarchivos);

                            // Crea la estructura de la tabla
                            var table = $("<table>").addClass("table table-striped table-bordered");
                            var header = $("<thead>")
                                .append($("<tr>")
                                    .append($("<th>").text("Nombre del Archivo"))
                                    .append($("<th>").text("Acciones"))
                                );
                            table.append(header);

                            // Cuerpo de la tabla
                            var body = $("<tbody>");
                            respuesta.datosarchivos.forEach(function(datosarchivos) {
                                var nombreArchivo = datosarchivos.archivo.split('/')
                                    .pop(); // Extraer nombre del archivo

                                var row = $("<tr>")
                                    .append(
                                        $("<td>").html(
                                            `<a href="${datosarchivos.archivo}" target="_blank">${nombreArchivo}</a>`
                                        )
                                    )
                                    .append(
                                        $("<td>").html(`
                        <a href="${datosarchivos.archivo}" class="btn btn-primary btn-sm" download="${nombreArchivo}">
                            <i class="fas fa-download"></i>
                        </a>
                        <button class="btn btn-danger btn-sm borrar-archivo" 
                        data-bs-toggle="modal" 
                        data-bs-target="#eliminarContratoModal" 
                        data-id="${datosarchivos.id}">
                        <i class="fas fa-trash-alt"></i>
                        </button>
                    `)
                                    );
                                body.append(row);
                            });

                            table.append(body);
                            listaArchivos.append(table); // Agrega la tabla al contenedor
                        } else {
                            listaArchivos.html("<p>No se encontraron archivos.</p>");
                        }
                    })
                    .fail(function() {
                        console.error('Error al obtener archivos existentes');
                    });

                // Escuchar cambios en el input de archivos
                $('#Archivos2').off('change').on('change', function() {
                    const inputArchivo = this;

                    if (inputArchivo.files.length > 0) {
                        Array.from(inputArchivo.files).forEach((archivo) => {
                            archivosSeleccionados2.push(archivo); // Agregar al array

                            // Crear vista previa con opción de eliminar
                            const li = document.createElement('li');
                            li.className = 'd-flex align-items-center mb-2';
                            li.innerHTML = getFilePreview(archivo, archivosSeleccionados2
                                .length - 1);
                            listaDatos2.appendChild(li);
                        });

                        inputArchivo.value = ''; // Resetear input
                    }
                });

                // Generar vista previa para los archivos
                function getFilePreview(archivo, index) {
                    return `
                        <div class="file-item-container">
                        <span class="file-name">${archivo.name}</span>
                        <button type="button" class="btn btn-sm btn-danger eliminar-archivo" data-index="${index}">
                            <i class="fas fa-times"></i>
                        </button>
                        </div>`;
                }

                // Evento para eliminar archivos de la lista
                $(listaDatos2).on('click', '.eliminar-archivo', function() {
                    const index = $(this).data('index');

                    // Eliminar archivo del array
                    archivosSeleccionados2.splice(index, 1);

                    // Eliminar elemento visual y actualizar índices
                    $(this).closest('li').remove();
                    actualizarIndices(listaDatos2);
                });

                // Actualizar índices visuales después de eliminar
                function actualizarIndices(lista) {
                    $(lista).find('li').each((i, li) => {
                        $(li).find('.eliminar-archivo').data('index', i);
                    });
                }

                // Guardar archivos seleccionados en el servidor
                $('#btn_agregardos').off('click').on('click', function() {
                    event.preventDefault();
                    var formData = new FormData();

                    formData.append('idPropiedad', id_propiedad);
                    archivosSeleccionados2.forEach((archivo) => {
                        formData.append('contratos2[]', archivo);
                    });

                    formData.append('_token', '{{ csrf_token() }}');

                    console.log('id propiedad archivo: ', id_propiedad);

                    $.ajax({
                        url: '/archivosVenta/guardar/' + id_propiedad,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $("#ModificarArchivoModal").modal('hide');
                            $("#successModal").modal('show');
                            $('#texto_success').text('Archivo Guardado Correctamente');
                            $("#listaArchivos").html(
                                response); // Actualizar lista de archivos
                        },
                        error: function() {
                            $("#ModificarArchivoModal").modal('hide');
                            $("#modalerror").modal('show');
                        }
                    });
                });
            });

            $(document).ready(function() {
                var archivoId; // Variable para almacenar el ID del archivo a eliminar

                // Delegación de eventos para el botón de eliminación
                $(document).on('click', '.borrar-archivo', function(e) {
                    event.preventDefault(); // Evitar el comportamiento por defecto del enlace

                    // Obtener el ID del archivo
                    archivoId = $(this).data('id'); // Guardar el ID del archivo
                    $('#confirmarEliminarContratoBtn').data('id',
                        archivoId); // Pasar el ID al botón de confirmación

                    // Mostrar el modal
                    $('#eliminarContratoModal').modal('show');
                });

                // Escuchar el clic en el botón de confirmar eliminación
                $('#confirmarEliminarContratoBtn').on('click', function() {
                    // Realizar la solicitud AJAX
                    $.ajax({
                        url: '/elimiarchivo/' + archivoId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $("#successModal").modal('show');
                            $('#texto_success').text('Archivo Eliminado Correctamente');
                            // Eliminar la fila correspondiente de la tabla
                            $('button.borrar-archivo[data-id="' + archivoId + '"]')
                                .closest('tr').remove();

                            // Cerrar el modal
                            $('#eliminarContratoModal').modal('hide');
                        },
                        error: function(xhr) {
                            $("#modalerror").modal('show');
                            $('#texto_error').text('No se Puede eliminar el Archivo');
                            // Mostrar un mensaje de error
                            console.log('Error al eliminar el archivo: ' + xhr
                                .responseJSON.error);
                        }
                    });
                });
            });

            ////MOSTRAR MODAL DE ELIMINAR ///
            //boton eliminar propiedad
            $(".borrar-propiedad-btn").on('click', function(event) {
                event.preventDefault();
                var idPropiedad = $(this).data('id');
                console.log('propiedad: ' + idPropiedad);

                // Mostrar el modal de confirmación
                $("#modalInfo").modal('show');

                // Manejar el clic en el botón de confirmación
                $("#confirmDelete").off('click').on('click',
                    function() { // Usar off() para evitar múltiples bindings
                        $("#modalInfo").modal('hide');

                        // Realizar la solicitud AJAX
                        $.ajax({
                            url: `/propiedadVenta/${idPropiedad}`, // Usar template literals para construir la URL
                            type: 'DELETE',
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content') // Incluir el token CSRF
                            },
                            success: function(respuesta) {
                                console.log("respuesta", respuesta);
                                $("#successModal").modal('show');
                                $('#texto_success').text(
                                    'Propiedad eliminada correctamente');
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log("Error:", errorThrown);
                                $("#modalerror").modal('show');
                            }
                        });
                    });
            }); // fin eliminar propiedad

            //funcion al cerrar modal sucess actualice los datos
            $("#cerrar_error").click(function() {
                $("#modalerror").modal('hide');
            });

            //funcion al cerrar modal sucess actualice los datos
            $("#close_success").click(function() {
                $("#successModal").modal('hide');
                location.reload();
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
            function formatearMiles(input) {
                // Obtener el valor actual sin caracteres no numéricos
                let valor = input.value.replace(/\D/g, '');
                
                // Aplicar el formato de separador de miles
                let valorFormateado = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                
                // Asignar el valor formateado al campo
                input.value = valorFormateado;
            }
            function toggleTipoCocinaDepto() {
                const tipo = String($("#modal_tipo_propiedad").val() || '').toLowerCase();
                const esDepto = (tipo === 'departamento' || tipo === 'depto');

                if (esDepto) {
                    $("#wrap_tipo_cocina_depto").removeClass("d-none");
                    $("#tipo_cocina_depto").prop("required", true);
                } else {
                    $("#wrap_tipo_cocina_depto").addClass("d-none");
                    $("#tipo_cocina_depto").prop("required", false).val("");
                }

            }


            $(document).ready(function () {

                // Cuando se abra el modal, ya debe venir seteado modal_tipo_propiedad desde el click
                $("#Detalle_Propiedad").on("shown.bs.modal", function () {
                    toggleTipoCocinaDepto();
                });

            });

            document.addEventListener('DOMContentLoaded', function () {

                const switchUF = document.getElementById('switchUF');
                const monedaTexto = document.getElementById('monedaTexto');

                function actualizarMoneda() {
                    monedaTexto.innerText = switchUF.checked ? 'UF' : 'CLP';
                }

                // Estado inicial
                actualizarMoneda();

                // Al cambiar el switch
                switchUF.addEventListener('change', actualizarMoneda);
            });
        </script>
    @endsection
    @section('css')
        @parent
        <style>
                .tarjeta-propiedad .texto-propiedad {
                transition: opacity 0.3s ease;
            }
            
            .tarjeta-propiedad:hover .texto-propiedad {
                opacity: 0;
            }
            /* Contenedor para cada archivo */
            .file-item-container {
                position: relative;
                display: inline-block;
                width: 100px;
                /* Ajusta según sea necesario */
                margin-right: 10px;
                text-align: center;
                border: 1px solid #ccc;
                background-color: #f4f4f4;
                padding: 10px;
                border-radius: 5px;
            }

            /* Nombre del archivo */
            .file-name {
                font-size: 14px;
                color: #333;
                word-break: break-word;
                padding: 10px 0;
            }

            /* Botón de eliminar sobrepuesto */
            .file-item-container .btn.eliminar-archivo {
                position: absolute;
                top: 5px;
                right: 5px;
                background-color: rgba(255, 0, 0, 0.8);
                color: white;
                border: none;
                border-radius: 50%;
                padding: 5px 8px;
                cursor: pointer;
                z-index: 10;
                font-size: 12px;
            }

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

            .scrol {
                max-height: 420px;
                /* Altura máxima del contenedor */
                overflow-y: auto;
                /* Habilita el scroll vertical */
                scrollbar-width: thin;
                /* Para navegadores modernos, hace el scroll más delgado */
                scrollbar-color: #dc3545 #f8f9fa;
                /* Color del scroll (primero: barra, segundo: fondo) */
            }
        </style>
    @endsection
