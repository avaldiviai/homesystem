@extends('layouts.app')
@section('content')
{{-- =====================================================================
     VISTA: Propiedades en Venta
     Reorganizada y corregida. Se mantienen colores y estilos originales.
===================================================================== --}}
<div class="container-fluid overflow-hidden" style="background-color: #FFAB40">
    <div class="row vh-100 overflow-auto" style="background-color:rgb(255, 255, 255)">
        @include('layouts.sidebar')
        <div class="col d-flex flex-column h-100" style="padding:0;">
            <div class="flex-grow-1">

                {{-- Encabezado --}}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6"
                            style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px; color: white">
                            <h1 class="text-uppercase text-black">Propiedades en Venta</h1>
                        </div>
                    </div>
                </div>

                {{-- Buscador + Botón agregar --}}
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

                    {{-- Grilla de propiedades --}}
                    <div class="row scrol">
                        @foreach ($propiedadesVenta as $propiedad)
                            @php
                                // Primera imagen de la propiedad
                                $imagen = $propiedad->imagenes->first();
                                $subdetalles = \App\Models\SubDetalles::where('id_propiedad', $propiedad->id)->first();
                                $propietario = \App\Models\Propietario_propiedades::where('id_propiedad', $propiedad->id)->first();
                                $detallePropiedad = \App\Models\DetallePropiedad::where('id_propiedad', $propiedad->id)->first();
                            @endphp
                            <div class="col-lg-3 mb-3">
                                <a href="propiedadesVentaDetalles-{{ $propiedad->id }}" style="text-decoration:none; color: #000;">
                                    <div class="card position-relative registro shadow tarjeta-propiedad" style="border:none;">

                                        @if($imagen)
                                            <img src="{{ asset($imagen->link) }}" class="card-img-top img-fluid"
                                                style="height: 200px; object-fit: cover;"
                                                alt="{{ $propiedad->direccion }}"
                                                data-imagen-url="{{ asset($imagen->link) }}">
                                        @else
                                            <img src="{{ asset('img/OIP.jpg') }}" class="card-img-top img-fluid"
                                                style="height: 200px; object-fit: cover;"
                                                alt="Imagen no disponible"
                                                data-imagen-url="{{ asset('images/default-image.png') }}">
                                        @endif

                                        {{-- Texto sobre la imagen --}}
                                        <div class="texto-propiedad position-absolute bottom-0 start-0 w-100 text-white p-3"
                                            style="background: rgba(0, 0, 0, 0.36); font-size: 12px; line-height: 1.2;">
                                            @if($propietario && $propietario->propietario)
                                                <h6 class="detalles"><strong>Propietario:</strong> {{ $propietario->propietario->nombre }}</h6>
                                            @else
                                                <h6 class="detalles"><strong>Propietario:</strong> Sin propietario</h6>
                                            @endif
                                            <h6 class="detalles"><strong>Condominio:</strong> {{ $propiedad->condominio }}</h6>
                                            <h6 class="detalles"><strong>N° Dpto:</strong> {{ $propiedad->num_torre }}</h6>
                                            @if($subdetalles)
                                                <h6 class="detalles"><strong>N° Estacionamiento:</strong> {{ $subdetalles->estacionamiento }}</h6>
                                            @endif
                                        </div>

                                        {{-- Estado de la propiedad --}}
                                        <div class="position-absolute top-0 p-2 d-flex flex-column">
                                            @if($propiedad->estado_venta == 1)
                                                <a class="btn btn-success vender" data-id="{{ $propiedad->id }}">
                                                    Disponible
                                                </a>
                                            @else
                                                <a class="btn btn-danger">
                                                    Vendida
                                                </a>
                                            @endif
                                        </div>

                                        {{-- Acciones rápidas --}}
                                        <div class="position-absolute end-0 p-1 d-flex flex-column"
                                            style="background: rgba(0, 0, 0, 0.63); top: 60px;">

                                            @if(!$detallePropiedad || $detallePropiedad->ano_construccion === null)
                                                <a href="#" class="text-primary mb-2 detalle-propiedad mt-2"
                                                    data-id="{{ $propiedad->id }}" title="Agregar Detalles">
                                                    <i class="fas fa-edit fa-lg"></i>
                                                </a>
                                            @endif

                                            <a href="#" class="text-success mb-2 btn-Contrato" data-id="{{ $propiedad->id }}" title="Agregar Archivo">
                                                <i class="fa-regular fa-folder fa-lg"></i>
                                            </a>
                                            <a href="#" class="text-warning mb-2 btn-mantencion" data-id="{{ $propiedad->id }}" title="Mantención">
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

{{-- =====================================================================
     MODALES
===================================================================== --}}

{{-- Modal: Agregar Propiedad en Venta --}}
<div class="modal fade" id="agregarPropiedadVenta" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="agregarPropiedadVentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header" style="background-color:rgb(255, 215, 151); justify-content: center; position: relative;">
                <h5 class="modal-title text-uppercase" id="agregarPropiedadVentaLabel">Agregar Propiedad en Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="position: absolute; right: 10px; top: 10px;"></button>
            </div>

            <div class="modal-body">
                <form method="POST">
                    <div class="container">

                        {{-- Detalle de la propiedad --}}
                        <div class="row mb-3 p-4 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                            <div class="col-lg-12 text-center mb-4">
                                <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white">Detalle de la Propiedad</h5>
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label class="form-label"><b>Precio Propiedad</b></label>
                                <div class="input-group">
                                    <input type="text" class="form-control mt-2" id="precioInput" placeholder="Precio"
                                        oninput="formatearMiles(this)" required>
                                    <div class="input-group-text mt-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="switchUF">
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
                                <input type="text" class="form-control mt-2" id="numeroCasaInput" placeholder="Ej: 55" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="rolInput" class="form-label"><b>Rol</b></label>
                                <input type="text" class="form-control mt-2" id="rolInput" placeholder="Ej: 4308-25" required>
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
                                    placeholder='Ej: iframe embed de Google Maps'>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="condominioInput"><b>Sector / Condominio</b></label>
                                <input type="text" class="form-control mt-2" id="condominioInput" placeholder="Ej: Parque Fray Jorge" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="propietarioInput"><b>Propietarios</b></label>
                                <div class="d-flex justify-content-between">
                                    <select id="propietarioInput" class="form-select me-2">
                                        <option disabled selected value="0">Seleccione un propietario</option>
                                        @foreach ($propietarioVenta as $propietario)
                                            <option value="{{ $propietario->id }}">{{ $propietario->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary" id="agregar-propietario">Agregar</button>
                                </div>
                                <ul class="text-uppercase mt-4 m-1 p-1" id="lista-agregados"></ul>
                            </div>
                        </div>

                        {{-- Servicios comunes --}}
                        <div class="row mb-3 p-4 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                            <div class="col-lg-12 text-center mb-4">
                                <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white">Servicios Comúnes</h5>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="empresaLuzInput"><b>Empresa Luz</b></label>
                                <input type="text" class="form-control mt-2" id="empresaLuzInput" placeholder="Ej: CGE" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="numeroLuzInput"><b>N° Luz</b></label>
                                <input type="text" class="form-control mt-2" id="numeroLuzInput" placeholder="Ej: 1728191" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="empresaAguaInput"><b>Empresa Agua</b></label>
                                <input type="text" class="form-control mt-2" id="empresaAguaInput" placeholder="Ej: Aguas del Valle" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="numeroAguaInput"><b>N° Agua</b></label>
                                <input type="text" class="form-control mt-2" id="numeroAguaInput" placeholder="Ej: 1010101-0" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="empresaGasInput"><b>Empresa Gas</b></label>
                                <input type="text" class="form-control mt-2" id="empresaGasInput" placeholder="Ej: GASCO" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="numeroGasInput"><b>N° Gas</b></label>
                                <input type="text" class="form-control mt-2" id="numeroGasInput" placeholder="17281727" required>
                            </div>
                        </div>

                        {{-- Servicios básicos --}}
                        <div class="row mb-3 p-2 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                            <div class="col-lg-12 text-center mb-4">
                                <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white">Servicios Básicos</h5>
                                </div>
                            </div>

                            {{-- Estacionamiento --}}
                            <div class="form-group col-lg-6 text-center">
                                <label for="estacionamientoCheck"><b>¿Tiene Estacionamiento?</b></label>
                                <div class="mt-2">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="estacionamientoSi" name="estacionamientoCheck" value="si">
                                        <label for="estacionamientoSi" class="form-check-label">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="estacionamientoNo" name="estacionamientoCheck" value="no">
                                        <label for="estacionamientoNo" class="form-check-label">No</label>
                                    </div>
                                </div>

                                <div id="camposEstacionamiento" class="form-group col-lg-12" style="display: none; margin-top: 20px;">
                                    <div class="row bg-white m-1" style="border-radius: .9rem;">
                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="precioEstacionamientoInput"><b>Precio Estacionamiento</b></label>
                                                <input type="text" class="form-control mt-2" id="precioEstacionamientoInput"
                                                    placeholder="Ej: $380.000" value="$" required
                                                    oninput="this.value = '$' + this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="rolInputestacionamiento"><b>Rol</b></label>
                                            <input type="text" class="form-control mt-2" id="rolInputestacionamiento" placeholder="Rol">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="numeroEstacionamientoInput"><b>Estacionamiento</b></label>
                                            <input type="text" class="form-control mt-2" id="numeroEstacionamientoInput" placeholder="Numero">
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

                                        <div id="camposTechado" class="form-group col-lg-12" style="display: none; margin-top: 10px;">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label for="montoInputTechado"><b>Monto Techado</b></label>
                                                    <input type="text" class="form-control mt-2" id="montoInputTechado"
                                                        placeholder="Ej: $50.000" value="$"
                                                        oninput="this.value = '$' + this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="rolInputTechado"><b>Rol</b></label>
                                                    <input type="text" class="form-control mt-2" id="rolInputTechado" placeholder="Rol">
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="numeroTechadoInput"><b>N° Techado</b></label>
                                                    <input type="text" class="form-control mt-2" id="numeroTechadoInput" placeholder="Numero">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Bodega --}}
                            <div class="form-group col-lg-6 text-center">
                                <label for="bodegaCheck"><b>¿Tiene Bodega?</b></label>
                                <div class="mt-2">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="bodegaSi" name="bodegaCheck" value="si">
                                        <label for="bodegaSi" class="form-check-label">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="bodegaNo" name="bodegaCheck" value="no">
                                        <label for="bodegaNo" class="form-check-label">No</label>
                                    </div>
                                </div>

                                <div id="camposBodega" class="form-group col-lg-12" style="display: none; margin-top: 20px;">
                                    <div class="row bg-white m-1" style="border-radius: .9rem;">
                                        <label><b>Detalles de la Bodega</b></label>
                                        <div class="col-lg-4 mb-3">
                                            <label for="montoInputbodega"><b>Monto</b></label>
                                            <input type="text" class="form-control mt-2" id="montoInputbodega"
                                                placeholder="Ej: $380.000" value="$"
                                                oninput="this.value = '$' + this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="rolInputbodega"><b>Rol</b></label>
                                            <input type="text" class="form-control mt-2" id="rolInputbodega" placeholder="Rol">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="numeroBodegaInput"><b>Bodega</b></label>
                                            <input type="text" class="form-control mt-2" id="numeroBodegaInput" placeholder="Numero">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Campos adicionales --}}
                        <div class="row p-4 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                            <div class="col-lg-12 text-center mb-4">
                                <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white">Campos Adicionales</h5>
                                </div>
                            </div>
                            <div class="col-lg-4 p-3">
                                <div class="form-check mb-3">
                                    <input type="checkbox" id="toggleDetalles" class="form-check-input">
                                    <label for="toggleDetalles" class="form-check-label"><b>Campos Adicionales</b></label>
                                </div>
                            </div>

                            <div id="detallesAdicionales" style="display: none;">
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="deuda_hipotecaria"><b>Deuda Hipotecaria</b></label>
                                            <input type="text" class="form-control mt-2" id="deuda_hipotecaria"
                                                placeholder="Ej: $50.000" value="$" required
                                                oninput="this.value = '$' + this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="contribuciones_si" class="form-label"><b>Contribuciones</b></label>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" id="contribuciones_si" name="contribuciones" value="1">
                                                    <label for="contribuciones_si" class="form-check-label">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" id="contribuciones_no" name="contribuciones" value="0">
                                                    <label for="contribuciones_no" class="form-check-label">No</label>
                                                </div>
                                            </div>
                                            <div id="campoValorContribuciones" style="display:none;" class="mt-2">
                                                <label for="monto_contribuciones" class="form-label"><b>Valor Contribuciones</b></label>
                                                <input type="text" class="form-control" id="monto_contribuciones" placeholder="Ej: 50.000 anual">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="derechos_aseo_si" class="form-label"><b>Derechos de Aseo</b></label>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" id="derechos_aseo_si" name="derechos_aseo" value="1">
                                                    <label for="derechos_aseo_si" class="form-check-label">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" id="derechos_aseo_no" name="derechos_aseo" value="0">
                                                    <label for="derechos_aseo_no" class="form-check-label">No</label>
                                                </div>
                                            </div>
                                            <div id="campoValorDerechosAseo" style="display:none;" class="mt-2">
                                                <label for="monto_derechos_aseo" class="form-label"><b>Valor Derechos de Aseo</b></label>
                                                <input type="text" class="form-control" id="monto_derechos_aseo" placeholder="Ej: 10.000 anual">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="exclusividad" class="form-label"><b>Exclusividad</b></label>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" id="exclusividad_si" name="exclusividad" value="1">
                                                    <label for="exclusividad_si" class="form-check-label">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" id="exclusividad_no" name="exclusividad" value="0">
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
                                                    <input type="radio" class="form-check-input" id="sello_verde_si" name="sello_verde" value="1">
                                                    <label for="sello_verde_si" class="form-check-label">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" id="sello_verde_no" name="sello_verde" value="0">
                                                    <label for="sello_verde_no" class="form-check-label">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Imágenes --}}
                        <div class="row p-6 shadow mt-5" style="background-color: #FFE2B2; border-radius: .9rem;">
                            <div class="col-lg-4 p-3">
                                <div class="form-group mb-3">
                                    <label for="fileInput" class="form-label"><b>Agregar Imágenes y Videos</b></label>
                                    <div class="upload-container" id="dropZone" style="border: 2px dashed #ccc; padding: 20px; text-align: center;">
                                        <input type="file" id="fileInput" accept="image/png, image/jpeg, image/gif" multiple hidden>
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

                    </div>
                </form>
            </div>

            <hr>
            <div class="modal-header" style="background-color:rgb(255, 215, 151); justify-content: center; position: relative;">
                <button type="button" id="btn_agregar" class="btn btn-primary" style="margin-left: auto;">Guardar</button>
                <button type="button" class="btn btn-danger" style="margin-left: 10px;" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Agregar Detalles de Propiedad --}}
<div class="modal fade" id="Detalle_Propiedad" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="Detalle_PropiedadLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header" style="background-color: #FFE2B2; justify-content: center; position: relative;">
                <h5 class="modal-title text-uppercase" id="Detalle_PropiedadLabel"
                    style="color: #4A4A4A; text-align: center; font-size: 1.5rem;">Detalles de la Propiedad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="position: absolute; right: 10px; top: 10px;"></button>
            </div>

            <div class="modal-body">
                <form method="POST">
                    <div class="container">
                        <div class="row g-3">
                            <div class="row">
                                {{-- Columna 1 --}}
                                <div class="col-12 col-md-6 p-3">
                                    <div class="row g-3 m-1 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-group col-12 col-lg-6">
                                                    <label for="ano_construccion" class="form-label">Año de Construcción</label>
                                                    <select id="ano_construccion" class="form-control" name="ano_construccion" required>
                                                        <option value="">Seleccione año</option>
                                                        @for ($y = date('Y'); $y >= 1970; $y--)
                                                            <option value="{{ $y }}">{{ $y }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-group col-12 col-lg-6">
                                                    <label for="piso" class="form-label"><b>Piso</b></label>
                                                    <input type="number" class="form-control" id="piso" placeholder="Ej: 3" name="piso">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-group col-12 col-lg-6">
                                                    <label for="dormitorios" class="form-label"><b>Dormitorios</b></label>
                                                    <input type="number" class="form-control" id="dormitorios" placeholder="Ej: 4" name="dormitorios">
                                                </div>
                                                <div class="form-group col-12 col-lg-6">
                                                    <label for="banos" class="form-label"><b>Baños</b></label>
                                                    <input type="number" class="form-control" id="banos" name="banos" placeholder="Ej: 1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Columna 2 --}}
                                <div class="col-12 col-md-6 p-3">
                                    <div class="row g-3 m-1 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="orientacion" class="form-label"><b>Orientación</b></label>
                                            <select class="form-select" name="orientacion" id="orientacion">
                                                <option value="" disabled selected>Seleccionar una opción</option>
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
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="Eléctrica">Conexión eléctrica</option>
                                                <option value="Gas">Gas cilindro</option>
                                                <option value="Conexión Gas">Conexión cañería</option>
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
                                            <label for="agua_caliente" class="form-label"><b>Agua Caliente</b></label>
                                            <select class="form-select" name="agua_caliente" id="agua_caliente">
                                                <option value="" disabled selected>Seleccione una opción</option>
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
                                            </select>
                                        </div>
                                        {{-- Se usa desde JS para decidir si mostrar el campo "Tipo de cocina (Depto)" --}}
                                        <input type="hidden" id="modal_tipo_propiedad">
                                    </div>
                                </div>
                            </div>

                            {{-- Metrajes e inventario --}}
                            <div class="row g-3 m-1 shadow mb-4" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="mt2_construido" class="form-label"><b>MT2 Construido</b></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="mt2_construido" placeholder="Ej: 230" name="mt2_construido">
                                        <div class="input-group-prepend"><span class="input-group-text">mt2</span></div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-lg-4">
                                    <label for="mt2_terraza" class="form-label"><b>MT2 Terraza</b></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="mt2_terraza" placeholder="Ej: 320" name="mt2_terraza">
                                        <div class="input-group-prepend"><span class="input-group-text">mt2</span></div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-lg-4">
                                    <label for="mt2_total" class="form-label"><b>MT2 Total</b></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="mt2_total" placeholder="Ej: 201" name="mt2_total">
                                        <div class="input-group-prepend"><span class="input-group-text">mt2</span></div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-lg-5">
                                    <label for="inventario" class="form-label"><b>Inventario</b></label>
                                    <input type="text" class="form-control" id="inventario" placeholder="Ej: Muebles incluidos" name="inventario">
                                </div>

                                <div class="form-group mb-3 col-lg-4">
                                    <label for="estacionamiento_visitas" class="form-label"><b>Estacionamiento de Visitas</b></label>
                                    <input type="number" class="form-control" id="estacionamiento_visitas" placeholder="Ej: 201" name="estacionamiento_visitas">
                                </div>

                                <div class="form-group mb-3 col-lg-4">
                                    <label for="gasto_comun" class="form-label"><b>Gasto Común</b></label>
                                    <input type="text" class="form-control" id="gasto_comun" placeholder="Ej: $60.000" name="gasto_comun"
                                        oninput="this.value = '$' + this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                </div>

                                <div class="form-group mb-3 col-lg-12">
                                    <label for="descripcion" class="form-label"><b>Descripción</b></label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                                        placeholder="Descripción general de la propiedad"></textarea>
                                </div>
                            </div>

                            {{-- Características / equipamiento --}}
                            <div class="row g-3 m-1 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="espacio_lavadora" class="form-label"><b>Espacio para Lavadora</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="espacio_lavadora_si" name="espacio_lavadora" value="1">
                                            <label for="espacio_lavadora_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="espacio_lavadora_no" name="espacio_lavadora" value="0">
                                            <label for="espacio_lavadora_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="lavadora" class="form-label"><b>Lavadora</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="lavadora_si" name="lavadora" value="1">
                                            <label for="lavadora_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="lavadora_no" name="lavadora" value="0">
                                            <label for="lavadora_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-lg-3 col-sm-3 text-center">
                                    <label for="ascensor" class="form-label"><b>Ascensor</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="ascensor_si" name="ascensor" value="1">
                                            <label for="ascensor_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="ascensor_no" name="ascensor" value="0">
                                            <label for="ascensor_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="juegos_infantiles" class="form-label"><b>Juegos Infantiles</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="juegos_infantiles_si" name="juegos_infantiles" value="1">
                                            <label for="juegos_infantiles_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="juegos_infantiles_no" name="juegos_infantiles" value="0">
                                            <label for="juegos_infantiles_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="lavanderia" class="form-label"><b>Lavandería</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="lavanderia_si" name="lavanderia" value="1">
                                            <label for="lavanderia_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="lavanderia_no" name="lavanderia" value="0">
                                            <label for="lavanderia_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="quinchos" class="form-label"><b>Quinchos</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="quinchos_si" name="quinchos" value="1">
                                            <label for="quinchos_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="quinchos_no" name="quinchos" value="0">
                                            <label for="quinchos_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="sala_multiuso" class="form-label"><b>Sala Multiuso</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="sala_multiuso_si" name="sala_multiuso" value="1">
                                            <label for="sala_multiuso_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="sala_multiuso_no" name="sala_multiuso" value="0">
                                            <label for="sala_multiuso_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-lg-3 col-sm-4 text-center">
                                    <label for="gimnasio" class="form-label"><b>Gimnasio</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="gimnasio_si" name="gimnasio" value="1">
                                            <label for="gimnasio_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="gimnasio_no" name="gimnasio" value="0">
                                            <label for="gimnasio_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-lg-4 col-sm-4 text-center">
                                    <label for="ciclovia" class="form-label"><b>Ciclovía</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="ciclovia_si" name="ciclovia" value="1">
                                            <label for="ciclovia_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="ciclovia_no" name="ciclovia" value="0">
                                            <label for="ciclovia_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-lg-4 col-sm-4 text-center">
                                    <label for="piscina" class="form-label"><b>Piscina</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="piscina_si" name="piscina" value="1">
                                            <label for="piscina_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="piscina_no" name="piscina" value="0">
                                            <label for="piscina_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-lg-4 col-sm-4 text-center">
                                    <label for="verde" class="form-label"><b>Áreas Verdes</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="verde_si" name="verde" value="1">
                                            <label for="verde_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="verde_no" name="verde" value="0">
                                            <label for="verde_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer" style="background-color: #FFE2B2;">
                <button type="button" id="btn_agregardetalle" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Archivos de la propiedad --}}
<div class="modal fade" id="ModificarArchivoModal" tabindex="-1" aria-labelledby="ModificarArchivoLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center w-100">Archivos Agregados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h6>Archivos de la Propiedad:</h6>
                    <div id="lista-agregados-edit" class="mt-3"></div>
                </div>

                <div class="col-12">
                    <button class="btn btn-warning w-100 mt-3 mb-3 text-uppercase text-white" type="button"
                        data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3" aria-expanded="false"
                        aria-controls="multiCollapseExample3">
                        <b>Agregar Nuevos Archivos</b>
                    </button>
                </div>

                <div class="collapse multi-collapse3" id="multiCollapseExample3">
                    <div>
                        <label for="Archivos2" class="form-label"><strong>Selecciona los archivos a cargar:</strong></label>
                        <input type="file" name="contratos2[]" accept=".pdf,.doc,.docx,.jpg,.png" required class="form-control" id="Archivos2" multiple>
                        <ul class="text-uppercase mt-4" id="lista-Datosdos"></ul>
                    </div>

                    <div class="col-md-12 d-flex justify-content-end mt-3">
                        <button type="button" id="btn_agregardos" class="btn btn-success me-2">Guardar</button>
                        <button type="button" id="btn_cerrar_archivo" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Mantención --}}
<div class="modal fade" id="ModalMantencion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="ModalMantencionLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Mantenimientos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div id="mantencionesContainer">
                        <div class="row p-2 mantencion-item" style="background-color: #FFE2B2; border-radius: .9rem; margin-bottom: 10px;">
                            <div class="col-lg-6 mb-3">
                                <label for="nombremantenimiento">Nombre del Mantenimiento</label>
                                <input type="text" class="form-control" id="nombremantenimiento" placeholder="Ingrese el nombre del mantenimiento" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="descripcionmantenimiento">Descripción</label>
                                <textarea class="form-control" id="descripcionmantenimiento" placeholder="Ingrese la descripción del mantenimiento" required></textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="mantenimiento">Fecha de Mantenimiento</label>
                                <input type="date" class="form-control" id="mantenimiento" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="cadamantenimiento">Cada Cuántos Meses</label>
                                <input type="number" class="form-control" id="cadamantenimiento" placeholder="Ingrese la cantidad de meses para la mantención" required>
                            </div>
                            <div class="col-lg-12 text-end">
                                <button type="button" class="btn btn-primary" id="agregar-mantencion">Agregar Mantenimiento</button>
                            </div>
                        </div>
                    </div>
                    <div id="lista-mantenciones" class="mt-3"></div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-primary" id="guardar-mantenciones">Guardar Todo</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Éxito --}}
<div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="successLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
            <div class="modal-header alert alert-success" role="alert" style="border: none;">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000" style="width:70px;height:70px"></lord-icon>
                        </div>
                        <div class="col-8 d-flex justify-content-center align-items-center">
                            <p id="texto_success" class="text-uppercase">Datos Guardados con exito</p>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn-close d-flex justify-content-end" id="close_success"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Error --}}
<div class="modal fade" id="modalerror" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalerrorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header alert alert-danger" role="alert" style="border: none;">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json" trigger="loop" delay="2000" style="width:70px;height:70px"></lord-icon>
                        </div>
                        <div class="col-8 d-flex justify-content-center align-items-center">
                            <p id="texto_error" class="text-uppercase text-center m-0">Ha Ocurrido un Error al Guardar.</p>
                        </div>
                        <div class="col-2 d-flex justify-content-end align-items-center">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_error"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Confirmar eliminar propiedad --}}
<div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalinfoLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-danger d-flex align-items-center" id="alertaEliminarPropiedad" role="alert">
            <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                <h5 class="m-4 text-uppercase text-center" id="textoinfo">¿Seguro/a que quieres eliminar Propiedad?</h5>
                <div class="modalfooter d-flex justify-content-center">
                    <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="confirmDelete" class="btn btn-secondary m-2">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Confirmar eliminar contrato/archivo --}}
<div class="modal fade" id="eliminarContratoModal" tabindex="-1" aria-labelledby="eliminarContratoLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-danger d-flex align-items-center" id="alertaEliminarContrato" role="alert">
            <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar el contrato?</h5>
                <div class="modalfooter d-flex justify-content-center">
                    <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="confirmarEliminarContratoBtn" class="btn btn-secondary m-2">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Confirmar venta de propiedad --}}
<div class="modal fade" id="venderpropiedadModal" tabindex="-1" aria-labelledby="venderpropiedadModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-success d-flex align-items-center" id="alertaVenderPropiedad" role="alert">
            <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres Vender esta Propiedad?</h5>
                <div class="modalfooter d-flex justify-content-center">
                    <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="confimarventa" class="btn btn-success m-2">Vender</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
@parent
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        // =====================================================
        // BUSCADOR
        // =====================================================
        $("#buscador_cnn").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".registro").each(function() {
                var cardText = $(this).find('.detalles').text().toLowerCase();
                $(this).toggle(cardText.includes(value));
            });
        });

        // =====================================================
        // CAMPOS ADICIONALES (toggle)
        // =====================================================
        $('#toggleDetalles').change(function() {
            $('#detallesAdicionales').slideToggle($(this).is(':checked'));
        });

        // =====================================================
        // PROPIETARIOS AGREGADOS AL FORMULARIO
        // =====================================================
        var PropietariosAgregados = [];
        var listaPropietarios = $("#lista-agregados");

        $("#agregar-propietario").on('click', function(event) {
            event.preventDefault();
            var propietarioId = $("#propietarioInput").val();

            if (!propietarioId || propietarioId === '0') {
                alert("Por favor, seleccione un propietario.");
                return;
            }

            PropietariosAgregados.push({ id: propietarioId });
            $("#propietarioInput option[value='" + propietarioId + "']").prop('disabled', true);
            $("#propietarioInput").val('0');
            actualizarListaPropietarios();
        });

        function actualizarListaPropietarios() {
            listaPropietarios.empty();
            $.each(PropietariosAgregados, function(index, propietario) {
                $.ajax({
                    url: '/obtener/propietarioVenta',
                    type: 'GET',
                    data: { nombre_pro: propietario.id },
                    success: function(response) {
                        var listItem = $("<li>")
                            .html('<i class="fa-solid fa-user-tie"></i> ' + response.nombre)
                            .append(
                                $("<button>")
                                    .attr('type', 'button')
                                    .html('<i class="fas fa-trash-alt fa-lg text-danger"></i>')
                                    .addClass("btn btn-sm ms-2 m-1")
                                    .on('click', function() { eliminarPropietario(index); })
                            );
                        listaPropietarios.append(listItem);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al obtener el nombre del propietario:", error);
                    }
                });
            });
        }

        function eliminarPropietario(index) {
            var propietario = PropietariosAgregados[index];
            $("#propietarioInput option[value='" + propietario.id + "']").prop('disabled', false);
            PropietariosAgregados.splice(index, 1);
            actualizarListaPropietarios();
        }

        // =====================================================
        // SUBIDA DE IMÁGENES (drag & drop)
        // =====================================================
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        function showPreview(files) {
            preview.innerHTML = '';
            Array.from(files).forEach(file => {
                if (file.size <= 10 * 1024 * 1024) {
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

        dropZone.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', (e) => showPreview(e.target.files));
        dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('border-primary'); });
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('border-primary'));
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-primary');
            showPreview(e.dataTransfer.files);
        });

        // =====================================================
        // MONEDA (CLP / UF)
        // =====================================================
        var tipoMoneda = 'CLP';
        var switchUF = document.getElementById('switchUF');
        var monedaTexto = document.getElementById('monedaTexto');

        function actualizarMoneda() {
            tipoMoneda = switchUF.checked ? 'UF' : 'CLP';
            monedaTexto.innerText = tipoMoneda;
        }
        actualizarMoneda();
        switchUF.addEventListener('change', actualizarMoneda);

        // =====================================================
        // GUARDAR NUEVA PROPIEDAD
        // =====================================================
        $("#btn_agregar").on('click', function(event) {
            event.preventDefault();

            var formData = new FormData();
            formData.append('direccion', $("#direccionInput").val());
            formData.append('ciudad', $("#ciudadInput").val());
            formData.append('maps', $("#rutaInput").val());
            formData.append('rol', $("#rolInput").val());
            formData.append('tipo_vivienda', $("#tipoInput").val());
            formData.append('condominio', $("#condominioInput").val());
            formData.append('torre', $("#torreInput").val());
            formData.append('num_departamento', $("#numeroCasaInput").val());
            formData.append('empresaluz', $("#empresaLuzInput").val());
            formData.append('numeroluz', $("#numeroLuzInput").val());
            formData.append('empresaagua', $("#empresaAguaInput").val());
            formData.append('numeroagua', $("#numeroAguaInput").val());
            formData.append('empresagas', $("#empresaGasInput").val());
            formData.append('numerogas', $("#numeroGasInput").val());
            formData.append('precio', $("#precioInput").val());
            formData.append('tipo_moneda', tipoMoneda);
            formData.append('deuda_hipotecaria', $("#deuda_hipotecaria").val());
            formData.append('contribuciones', $("input[name='contribuciones']:checked").val());
            formData.append('monto_contribuciones', $("#monto_contribuciones").val());
            formData.append('derechos_aseo', $("input[name='derechos_aseo']:checked").val());
            formData.append('monto_derechos_aseo', $("#monto_derechos_aseo").val());
            formData.append('exclusividad', $("input[name='exclusividad']:checked").val());
            formData.append('sello_verde', $("input[name='sello_verde']:checked").val());

            // Estacionamiento
            formData.append('tiene_estacionamiento', $("input[name='estacionamientoCheck']:checked").val());
            formData.append('monto', $("#precioEstacionamientoInput").val());
            formData.append('rol_est', $("#rolInputestacionamiento").val());
            formData.append('estacionamiento', $("#numeroEstacionamientoInput").val());

            // Bodega
            formData.append('tiene_bodega', $("input[name='bodegaCheck']:checked").val());
            formData.append('monto_b', $("#montoInputbodega").val());
            formData.append('rol_b', $("#rolInputbodega").val());
            formData.append('bodega', $("#numeroBodegaInput").val());

            // Techado
            formData.append('tiene_techado', $("input[name='techadoCheck']:checked").val());
            formData.append('monto_t', $("#montoInputTechado").val());
            formData.append('rol_t', $("#rolInputTechado").val());
            formData.append('techado', $("#numeroTechadoInput").val());

            var files = $('#fileInput')[0].files;
            for (var i = 0; i < files.length; i++) {
                formData.append('imagenes[]', files[i]);
            }

            formData.append('PropietariosAgregados', JSON.stringify(PropietariosAgregados));

            $.ajax({
                url: '{{ url('/propiedadesVenta/add_propiedad') }}',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(respuesta) {
                    $("#agregarPropiedadVenta").modal('hide');
                    $('#texto_success').text('Datos Guardados con exito');
                    $("#successModal").modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error:", errorThrown);
                    $("#agregarPropiedadVenta").modal('hide');
                    $('#modalerror').modal('show');
                }
            });
        });

        // =====================================================
        // VENDER PROPIEDAD
        // =====================================================
        $(".vender").on('click', function(event) {
            event.preventDefault();
            var idPropiedad = $(this).data('id');
            $("#venderpropiedadModal").modal('show');
            $("#confimarventa").data('id', idPropiedad);
        });

        $("#confimarventa").on('click', function(event) {
            event.preventDefault();
            var idPropiedad = $(this).data('id');
            $.ajax({
                url: '/venderpropiedad/' + idPropiedad,
                type: 'POST',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                dataType: 'json',
                success: function(respuesta) {
                    $("#venderpropiedadModal").modal('hide');
                    $('#texto_success').text('Propiedad Vendida Con Exito');
                    $("#successModal").modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error:", errorThrown);
                    $("#venderpropiedadModal").modal('hide');
                    $('#modalerror').modal('show');
                }
            });
        });

        // =====================================================
        // DETALLES DE LA PROPIEDAD
        // =====================================================
        var idPropiedadDetalle;

        $(".detalle-propiedad").on('click', function(event) {
            event.preventDefault();
            idPropiedadDetalle = $(this).data('id');
            $("#Detalle_Propiedad").modal('show');
        });

        $("#Detalle_Propiedad").on("shown.bs.modal", function() {
            toggleTipoCocinaDepto();
        });

        $('#btn_agregardetalle').on('click', function(event) {
            event.preventDefault();

            $(".campo-error").remove();
            var camposVacios = false;

            var ano_construccion = $("#ano_construccion").val();
            var piso = $("#piso").val();
            var dormitorios = $("#dormitorios").val();
            var banos = $("#banos").val();
            var orientacion = $("#orientacion").val();
            var cocina = $("#cocina").val();
            var logia = $("#logia").val();
            var agua_caliente = $("#agua_caliente").val();

            if (!ano_construccion) { mostrarError("#ano_construccion"); camposVacios = true; }
            if (!piso) { mostrarError("#piso"); camposVacios = true; }
            if (!dormitorios) { mostrarError("#dormitorios"); camposVacios = true; }
            if (!banos) { mostrarError("#banos"); camposVacios = true; }
            if (!orientacion) { mostrarError("#orientacion"); camposVacios = true; }
            if (!cocina) { mostrarError("#cocina"); camposVacios = true; }
            if (!logia) { mostrarError("#logia"); camposVacios = true; }
            if (!agua_caliente) { mostrarError("#agua_caliente"); camposVacios = true; }

            if (camposVacios) return;

            var formData = new FormData();
            formData.append('id_propiedad', idPropiedadDetalle);
            formData.append('ano_construccion', ano_construccion);
            formData.append('piso', piso);
            formData.append('dormitorios', dormitorios);
            formData.append('banos', banos);
            formData.append('orientacion', orientacion);
            formData.append('cocina', cocina);
            formData.append('logia', logia);
            formData.append('agua_caliente', agua_caliente);
            formData.append('tipo_cocina_depto', $("#tipo_cocina_depto").val());
            formData.append('espacio_lavadora', $("input[name='espacio_lavadora']:checked").val());
            formData.append('lavadora', $("input[name='lavadora']:checked").val());
            formData.append('inventario', $("#inventario").val());
            formData.append('mt2_total', $("#mt2_total").val());
            formData.append('mt2_construido', $("#mt2_construido").val());
            formData.append('mt2_terraza', $("#mt2_terraza").val());
            formData.append('estacionamiento_visitas', $("#estacionamiento_visitas").val());
            formData.append('ascensor', $("input[name='ascensor']:checked").val());
            formData.append('juegos_infantiles', $("input[name='juegos_infantiles']:checked").val());
            formData.append('lavanderia', $("input[name='lavanderia']:checked").val());
            formData.append('quinchos', $("input[name='quinchos']:checked").val());
            formData.append('sala_multiuso', $("input[name='sala_multiuso']:checked").val());
            formData.append('gimnasio', $("input[name='gimnasio']:checked").val());
            formData.append('ciclovia', $("input[name='ciclovia']:checked").val());
            formData.append('piscina', $("input[name='piscina']:checked").val());
            formData.append('verde', $("input[name='verde']:checked").val());
            formData.append('gasto_comun', $("#gasto_comun").val());
            formData.append('descripcion', $("#descripcion").val());

            $.ajax({
                url: '/detallesVentaPropiedad/' + idPropiedadDetalle,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#Detalle_Propiedad').modal('hide');
                    $('#texto_success').text('Detalles Guardados con exito');
                    $('#successModal').modal('show');
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                    var errorMessage = '';
                    if (errors) {
                        $.each(errors, function(key, value) { errorMessage += value[0] + '\n'; });
                    }
                    $("#modalerror").modal('show');
                    console.error(errorMessage);
                }
            });
        });

        function mostrarError(campo) {
            if ($(campo).next(".campo-error").length === 0) {
                $(campo).after('<div class="campo-error" style="color: red; font-size: 12px;">Por favor complete este campo.</div>');
            }
        }

        // =====================================================
        // TOGGLES: Estacionamiento / Bodega / Techado / Contribuciones / Derechos de Aseo
        // =====================================================
        $("input[name='estacionamientoCheck']").on("change", function() {
            $("#camposEstacionamiento").toggle(this.value === 'si' && this.checked);
        });

        $("input[name='bodegaCheck']").on("change", function() {
            $("#camposBodega").toggle(this.value === 'si' && this.checked);
        });

        $("input[name='techadoCheck']").on("change", function() {
            $("#camposTechado").toggle(this.value === 'si' && this.checked);
        });

        $("input[name='contribuciones']").on("change", function() {
            var mostrar = this.value === '1';
            $("#campoValorContribuciones").toggle(mostrar);
            if (!mostrar) $("#monto_contribuciones").val("");
        });

        $("input[name='derechos_aseo']").on("change", function() {
            var mostrar = this.value === '1';
            $("#campoValorDerechosAseo").toggle(mostrar);
            if (!mostrar) $("#monto_derechos_aseo").val("");
        });

        // =====================================================
        // ARCHIVOS DE LA PROPIEDAD
        // =====================================================
        $(".btn-Contrato").on('click', function(event) {
            event.preventDefault();

            var id_propiedad = $(this).data('id');
            var archivosSeleccionados2 = [];
            var listaDatos2 = document.getElementById('lista-Datosdos');
            listaDatos2.innerHTML = '';

            $("#ModificarArchivoModal").modal('show');

            $.ajax({
                url: '/mostrar/archivo/' + id_propiedad,
                type: 'GET',
                dataType: 'json'
            }).done(function(respuesta) {
                var listaArchivos = $("#lista-agregados-edit");
                listaArchivos.empty();

                if (respuesta.datosarchivos && respuesta.datosarchivos.length > 0) {
                    var table = $("<table>").addClass("table table-striped table-bordered");
                    var header = $("<thead>").append(
                        $("<tr>")
                            .append($("<th>").text("Nombre del Archivo"))
                            .append($("<th>").text("Acciones"))
                    );
                    table.append(header);

                    var body = $("<tbody>");
                    respuesta.datosarchivos.forEach(function(datosarchivos) {
                        var nombreArchivo = datosarchivos.archivo.split('/').pop();
                        var row = $("<tr>")
                            .append($("<td>").html(`<a href="${datosarchivos.archivo}" target="_blank">${nombreArchivo}</a>`))
                            .append($("<td>").html(`
                                <a href="${datosarchivos.archivo}" class="btn btn-primary btn-sm" download="${nombreArchivo}">
                                    <i class="fas fa-download"></i>
                                </a>
                                <button class="btn btn-danger btn-sm borrar-archivo"
                                    data-bs-toggle="modal" data-bs-target="#eliminarContratoModal"
                                    data-id="${datosarchivos.id}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            `));
                        body.append(row);
                    });
                    table.append(body);
                    listaArchivos.append(table);
                } else {
                    listaArchivos.html("<p>No se encontraron archivos.</p>");
                }
            }).fail(function() {
                console.error('Error al obtener archivos existentes');
            });

            $('#Archivos2').off('change').on('change', function() {
                if (this.files.length > 0) {
                    Array.from(this.files).forEach((archivo) => {
                        archivosSeleccionados2.push(archivo);
                        var li = document.createElement('li');
                        li.className = 'd-flex align-items-center mb-2';
                        li.innerHTML = getFilePreview(archivo, archivosSeleccionados2.length - 1);
                        listaDatos2.appendChild(li);
                    });
                    this.value = '';
                }
            });

            function getFilePreview(archivo, index) {
                return `
                    <div class="file-item-container">
                        <span class="file-name">${archivo.name}</span>
                        <button type="button" class="btn btn-sm btn-danger eliminar-archivo" data-index="${index}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>`;
            }

            $(listaDatos2).off('click', '.eliminar-archivo').on('click', '.eliminar-archivo', function() {
                var index = $(this).data('index');
                archivosSeleccionados2.splice(index, 1);
                $(this).closest('li').remove();
                $(listaDatos2).find('li').each((i, li) => $(li).find('.eliminar-archivo').data('index', i));
            });

            $('#btn_agregardos').off('click').on('click', function(event) {
                event.preventDefault();
                var formData = new FormData();
                formData.append('idPropiedad', id_propiedad);
                archivosSeleccionados2.forEach((archivo) => formData.append('contratos2[]', archivo));
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '/archivosVenta/guardar/' + id_propiedad,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#ModificarArchivoModal").modal('hide');
                        $('#texto_success').text('Archivo Guardado Correctamente');
                        $("#successModal").modal('show');
                    },
                    error: function() {
                        $("#ModificarArchivoModal").modal('hide');
                        $("#modalerror").modal('show');
                    }
                });
            });
        });

        // Eliminar archivo
        var archivoId;
        $(document).on('click', '.borrar-archivo', function(event) {
            event.preventDefault();
            archivoId = $(this).data('id');
            $('#confirmarEliminarContratoBtn').data('id', archivoId);
            $('#eliminarContratoModal').modal('show');
        });

        $('#confirmarEliminarContratoBtn').on('click', function() {
            $.ajax({
                url: '/elimiarchivo/' + archivoId,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    $('#texto_success').text('Archivo Eliminado Correctamente');
                    $("#successModal").modal('show');
                    $('button.borrar-archivo[data-id="' + archivoId + '"]').closest('tr').remove();
                    $('#eliminarContratoModal').modal('hide');
                },
                error: function(xhr) {
                    $('#texto_error').text('No se Puede eliminar el Archivo');
                    $("#modalerror").modal('show');
                    console.error('Error al eliminar el archivo', xhr.responseJSON ? xhr.responseJSON.error : xhr);
                }
            });
        });

        // =====================================================
        // ELIMINAR PROPIEDAD
        // =====================================================
        $(".borrar-propiedad-btn").on('click', function(event) {
            event.preventDefault();
            var idPropiedad = $(this).data('id');
            $("#modalInfo").modal('show');

            $("#confirmDelete").off('click').on('click', function() {
                $("#modalInfo").modal('hide');
                $.ajax({
                    url: `/propiedadVenta/${idPropiedad}`,
                    type: 'DELETE',
                    dataType: 'json',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(respuesta) {
                        $('#texto_success').text('Propiedad eliminada correctamente');
                        $("#successModal").modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error:", errorThrown);
                        $("#modalerror").modal('show');
                    }
                });
            });
        });

        $("#cerrar_error").on('click', function() { $("#modalerror").modal('hide'); });

        $("#close_success").on('click', function() {
            $("#successModal").modal('hide');
            location.reload();
        });

        // =====================================================
        // MANTENCIONES
        // =====================================================
        $(".btn-mantencion").on('click', function(event) {
            event.preventDefault();
            var id_propiedad = $(this).data('id');
            $("#agregar-mantencion").data('id_propiedad', id_propiedad);
            $("#ModalMantencion").modal('show');
        });

        var MantencionesAgregadas = [];
        var listaMantenciones = $("#lista-mantenciones");

        $("#agregar-mantencion").on('click', function(event) {
            event.preventDefault();

            var id_propiedad = $(this).data('id_propiedad');
            var nombre = $("#nombremantenimiento").val();
            var descripcion = $("#descripcionmantenimiento").val();
            var fecha = $("#mantenimiento").val();
            var meses = $("#cadamantenimiento").val();

            if (!(nombre && descripcion && fecha && meses)) {
                alert("Por favor, complete todos los campos antes de agregar un mantenimiento.");
                return;
            }

            MantencionesAgregadas.push({ nombre, descripcion, fecha, meses, id_propiedad });

            $("#nombremantenimiento").val('');
            $("#descripcionmantenimiento").val('');
            $("#mantenimiento").val('');
            $("#cadamantenimiento").val('');

            actualizarListaMantenciones();
        });

        function actualizarListaMantenciones() {
            listaMantenciones.empty();

            var table = $("<table>").addClass("table table-bordered").append(
                $("<thead>").append(
                    $("<tr>")
                        .append($("<th>").text("ID Propiedad"))
                        .append($("<th>").text("Nombre"))
                        .append($("<th>").text("Descripción"))
                        .append($("<th>").text("Fecha de Mantención"))
                        .append($("<th>").text("Cada Cuántos Meses"))
                        .append($("<th>").text("Próxima Fecha de Mantención"))
                        .append($("<th>").text("Acciones"))
                )
            );

            var tbody = $("<tbody>");

            MantencionesAgregadas.forEach(function(mantencion, index) {
                var fechaInicial = new Date(mantencion.fecha);
                var proximaFecha = new Date(fechaInicial.setMonth(fechaInicial.getMonth() + parseInt(mantencion.meses)));
                var proximaFechaFormatted = proximaFecha.toISOString().split("T")[0];

                var fechaEnvio = new Date(proximaFecha);
                fechaEnvio.setMonth(fechaEnvio.getMonth() - 1);
                mantencion.proximaFecha = proximaFechaFormatted;
                mantencion.fechaEnvio = fechaEnvio.toISOString().split("T")[0];

                var row = $("<tr>")
                    .append($("<td>").text(mantencion.id_propiedad))
                    .append($("<td>").text(mantencion.nombre))
                    .append($("<td>").text(mantencion.descripcion))
                    .append($("<td>").text(mantencion.fecha))
                    .append($("<td>").text(mantencion.meses))
                    .append($("<td>").text(proximaFechaFormatted))
                    .append($("<td>").append(
                        $("<button>")
                            .attr('type', 'button')
                            .html('<i class="fas fa-trash-alt fa-lg text-danger"></i>')
                            .addClass("btn btn-sm btn-link")
                            .on("click", function() { eliminarMantencion(index); })
                    ));

                tbody.append(row);
            });

            table.append(tbody);
            listaMantenciones.append(table);
        }

        function eliminarMantencion(index) {
            MantencionesAgregadas.splice(index, 1);
            actualizarListaMantenciones();
        }

        $("#guardar-mantenciones").on('click', function(event) {
            event.preventDefault();

            if (MantencionesAgregadas.length === 0) {
                alert("No hay mantenciones para guardar.");
                return;
            }

            $.ajax({
                url: '/guardar/mantenciones',
                type: 'POST',
                data: { mantenciones: MantencionesAgregadas },
                success: function(response) {
                    alert("Mantenciones guardadas exitosamente.");
                    MantencionesAgregadas = [];
                    actualizarListaMantenciones();
                },
                error: function(xhr, status, error) {
                    console.error("Error al guardar las mantenciones:", error);
                    alert("Hubo un problema al guardar las mantenciones.");
                }
            });
        });

    }); // fin $(document).ready

    // =====================================================
    // FUNCIONES GLOBALES (usadas por atributos oninput/onclick inline)
    // =====================================================
    function formatearMiles(input) {
        var valor = input.value.replace(/\D/g, '');
        input.value = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function toggleTipoCocinaDepto() {
        var tipo = String($("#modal_tipo_propiedad").val() || '').toLowerCase();
        var esDepto = (tipo === 'departamento' || tipo === 'depto');

        if (esDepto) {
            $("#wrap_tipo_cocina_depto").removeClass("d-none");
            $("#tipo_cocina_depto").prop("required", true);
        } else {
            $("#wrap_tipo_cocina_depto").addClass("d-none");
            $("#tipo_cocina_depto").prop("required", false).val("");
        }
    }
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
        margin-right: 10px;
        text-align: center;
        border: 1px solid #ccc;
        background-color: #f4f4f4;
        padding: 10px;
        border-radius: 5px;
    }

    .file-name {
        font-size: 14px;
        color: #333;
        word-break: break-word;
        padding: 10px 0;
    }

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
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #dc3545 #f8f9fa;
    }
</style>
@endsection