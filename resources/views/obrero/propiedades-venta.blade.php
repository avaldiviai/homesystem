@extends('layouts.app')
@section('content')
    <div class="container-fluid overflow-hidden" style="background-color: #FFAB40">
        <div class="row vh-100 overflow-auto" style="background-color: #FFAB40">
            @include('layouts.sidebar_obrero')
            <div class="col d-flex flex-column h-100" style="padding:0;">
                <div class="flex-grow-1">
                    {{-- Contenido --}}
                    <div class="container">
                        <div class="row">
                            <div class="col-6"
                                style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px;color: white">
                                <h1>Propiedades en Venta</h1>
                            </div>
                        </div>
                    </div>
                    {{-- Card propiedades en venta --}}
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="input-group mx-2" style="max-width: 400px;">
                                    <span class="input-group-text bg-primary text-white shadow-sm">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </span>
                                    <input type="text" id="buscador_cn" placeholder="Buscar Propiedad"
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
                        <div class="row">
                            @foreach ($propiedadesVenta as $propiedad)
                                <div class="col-md-3 mb-3">
                                    <a href="/obrero/propiedadesVentaDetalles-{{ $propiedad->id }}"
                                        style="text-decoration:none; color: #000; cursor: pointer;">
                                        <div class="card shadow position-relative" style="border:none;">
                                            <div id="carousel-{{ $propiedad->id }}" class="carousel slide"
                                                data-bs-ride="carousel" data-bs-interval="3000">
                                                <div class="carousel-inner">
                                                    @foreach ($propiedad->imagenes as $index => $imagen)
                                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                            <img src="{{ asset($imagen->link) }}" class="card-img-top"
                                                                alt="Imagen de propiedad"
                                                                style="width: 100%; height: 15rem; object-fit: cover;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- Texto extendido dentro de la imagen -->
                                            <div class="position-absolute bottom-0 start-0 w-100 text-white p-2"
                                                style="background: rgba(0, 0, 0, 0.6); font-size: 12px; line-height: 1.2;">
                                                <span><strong>Dirección:</strong> {{ $propiedad->direccion }}</span> <br>
                                                <span><strong>Tipo de Vivienda:</strong>
                                                    {{ $propiedad->tipo_vivienda }}</span> <br>
                                                <span><strong>Torre:</strong> {{ $propiedad->torre }} </span> <br>
                                                <span><strong>N° Torre:</strong> {{ $propiedad->num_torre }}</span>
                                            </div>
                                            <!-- Iconos sobre la imagen -->
                                            <div class="position-absolute top-0 end-0 p-2 d-flex flex-column "
                                                style="background: rgba(0, 0, 0, 0.6); ">
                                                <a href="#" class="text-primary mb-2 detalle-propiedad"
                                                    data-id="{{ $propiedad->id }}" title="Agregar Detalles">
                                                    <i class="fas fa-edit fa-lg"></i>
                                                </a>
                                                <a href="#" class="text-success mb-2 btn-Contrato"
                                                    data-id="{{ $propiedad->id }}" title="Archivo">
                                                    <i class="fa-regular fa-folder fa-lg"></i>
                                                </a>
                                                <a href="#" class="text-danger borrar-propiedad"
                                                    data-id="{{ $propiedad->id }}" title="Borrar">
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarPropiedadVentaLabel">Agregar Propiedad en Venta</h5>
                </div>

                <div class="modal-body ">
                    <form method="POST">
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3 col-6 ">
                                    <label for="propietarioInput"><b>Propietarios</b></label>
                                    <div class="d-flex justify-content-between ">
                                        <select id="propietarioInput" class="form-select me-2">
                                            <option disabled selected value="0">Seleccione un propietario</option>
                                            @foreach ($propietarioVenta as $propietario)
                                            <option value="{{ $propietario->id }}">{{ $propietario->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary" id="agregar-propietario">Agregar</button>
                                    </div>
                                    <ul class="text-uppercase mt-4 m-1 p-1" id="lista-agregados">
                                        <!-- <button class="btn btn-danger"><i class="fas fa-trash-alt fa-lg text-white"></i></button> -->
                                    </ul>
                                </div>
                                <div class="form-group col-6">
                                    <label for="precioInput"><b>Precio Propiedad</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control mt-2" id="precioInput"
                                            placeholder="Ej: 380.000" required>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="direccionInput"><b>Direccion de Propiedad</b></label>
                                    <input type="text" class="form-control mt-2" id="direccionInput"
                                        placeholder="Ej: Av.Raul Biltran" required>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="rutaInput"><b>Ruta de Maps</b></label>
                                    <input type="text" class="form-control mt-2" id="rutaInput"
                                        placeholder="Ej: https://maps.app.goo.gl/aQkato2ZZJGFEeeA6" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="rolInput"><b>Rol</b></label>
                                    <input type="text" class="form-control mt-2" id="rolInput"
                                        placeholder="Ej: 4308-25" required>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="tipoInput"><b>Tipo Vivienda</b></label>
                                    <select class="form-select mt-2" id="tipoInput">
                                        <option value="" selected disabled>Seleccione Tipo Vivienda</option>
                                        <option value="Casa">Casa</option>
                                        <option value="Departamento">Departamento</option>
                                        <option value="Condominio">Condominio</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="condominioInput"><b>Sector / Condominio</b></label>
                                    <input type="text" class="form-control mt-2" id="condominioInput"
                                        placeholder="Ej: Parque Fray Jorge" required>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="torreInput"><b>Torre</b></label>
                                    <input type="text" class="form-control mt-2" id="torreInput"
                                        placeholder="Ej: El Maitén" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="numeroCasaInput"><b>N° Casa/Departamento</b></label>
                                    <input type="text" class="form-control mt-2" id="numeroCasaInput"
                                        placeholder="Ej: 55" required>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="estacionamientoInput"><b>N° Estacionamiento</b></label>
                                    <input type="text" class="form-control mt-2" id="estacionamientoInput"
                                        placeholder="Ej: 33" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="bodegaInput"><b>N° Bodega</b></label>
                                    <input type="text" class="form-control mt-2" id="bodegaInput"
                                        placeholder="Ej: 50" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
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
                            </div>

                            <div class="row mb-3">
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
                            </div>

                            <div class="row mb-3">
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
                            <div class="row">
                                <div class="mb-3">
                                    <input type="checkbox" id="toggleDetalles" class="form-check-input">
                                    <label for="toggleDetalles" class="form-check-label"><b>Campos Adicionales</b></label>
                                </div>
                            </div>
                            <div id="detallesAdicionales" style="display: none;">
                                <hr>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="deuda_hipotecaria" class="form-label"><b>Deuda Hipotecaria</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="deuda_hipotecaria"
                                                placeholder="Ej: 50" name="deuda_hipotecaria">
                                            <span class="input-group-text">$</span>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="contribuciones" class="form-label"><b>Contribuciones</b></label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="contribuciones_si"
                                                    name="contribuciones" value="sí">
                                                <label for="contribuciones_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="contribuciones_no"
                                                    name="contribuciones" value="no">
                                                <label for="contribuciones_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="derechos_aseo" class="form-label"><b>Derechos de Aseo</b></label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="derechos_aseo_si"
                                                    name="derechos_aseo" value="sí">
                                                <label for="derechos_aseo_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="derechos_aseo_no"
                                                    name="derechos_aseo" value="no">
                                                <label for="derechos_aseo_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="exclusividad" class="form-label"><b>Exclusividad</b></label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="exclusividad_si"
                                                    name="exclusividad" value="sí">
                                                <label for="exclusividad_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="exclusividad_no"
                                                    name="exclusividad" value="no">
                                                <label for="exclusividad_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="sello_verde" class="form-label"><b>Sello Verde</b></label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="sello_verde_si"
                                                    name="sello_verde" value="sí">
                                                <label for="sello_verde_si" class="form-check-label">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="sello_verde_no"
                                                    name="sello_verde" value="no">
                                                <label for="sello_verde_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="imagenes" class="form-label"> <b>Agregar imagenes</b></label>
                                    <input class="form-control" type="file" id="imagenes" multiple required>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <!-- Botones de cambios -->
                                <button type="button" id="btn_agregar" class="btn btn-success">Guardar</button>
                                <button type="button" id="btn_cerrar_agregar" class="btn btn-danger"
                                    data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Agregar Detalles de Propiedad -->
    <div class="modal fade" id="Detalle_Propiedad" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="Detalle_PropiedadLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Header del Modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="Detalle_PropiedadLabel">Agregar Detalles a Propiedad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <!-- Cuerpo del Modal -->
                <div class="modal-body">
                    <form method="POST">
                        <div class="container">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="año_construccion" class="form-label"> <b>Año Construcción</b></label>
                                    <input type="date" class="form-control" id="año_construccion"
                                        name="año_construccion">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="piso" class="form-label"><b>Piso</b></label>
                                    <input type="number" class="form-control" id="piso" placeholder="Ej: 3"
                                        name="piso">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="dormitorios" class="form-label"><b>Dormitorios</b></label>
                                    <input type="number" class="form-control" id="dormitorios" placeholder="Ej: 4"
                                        name="dormitorios">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="baños" class="form-label"><b>Baños</b></label>
                                    <input type="number" class="form-control" id="baños" name="baños"
                                        placeholder="Ej: 1">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="orientacion" class="form-label"><b>Orientación</b></label>
                                    <input type="text" class="form-control" id="orientacion" placeholder="Ej: Sur"
                                        name="orientacion">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="cocina" class="form-label"><b>Cocina</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="cocina_si" name="cocina"
                                                value="sí">
                                            <label for="cocina_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="cocina_no" name="cocina"
                                                value="no">
                                            <label for="cocina_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="logia" class="form-label"><b>Logia</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="logia_si" name="logia"
                                                value="sí">
                                            <label for="logia_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="logia_no" name="logia"
                                                value="no">
                                            <label for="logia_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="agua_caliente" class="form-label"><b>Agua Caliente</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="agua_caliente_si"
                                                name="agua_caliente" value="sí">
                                            <label for="agua_caliente_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="agua_caliente_no"
                                                name="agua_caliente" value="no">
                                            <label for="agua_caliente_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="espacio_lavadora" class="form-label"><b>Espacio para
                                            Lavadora</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="espacio_lavadora_si"
                                                name="espacio_lavadora" value="sí">
                                            <label for="espacio_lavadora_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="espacio_lavadora_no"
                                                name="espacio_lavadora" value="no">
                                            <label for="espacio_lavadora_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="lavadora" class="form-label"><b>Lavadora</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="lavadora_si"
                                                name="lavadora" value="sí">
                                            <label for="lavadora_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="lavadora_no"
                                                name="lavadora" value="no">
                                            <label for="lavadora_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="inventario" class="form-label"><b>Inventario</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="inventario_si"
                                                name="inventario" value="sí">
                                            <label for="inventario_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="inventario_no"
                                                name="inventario" value="no">
                                            <label for="inventario_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="mt2_total" class="form-label"><b>Metros Cuadrados
                                            Totales</b></label>
                                    <div class="input-group">
                                        <input type="number" placeholder="Ej: 201" class="form-control" id="mt2_total"
                                            name="mt2_total">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">mt2</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="mt2_construido" class="form-label"><b>Metros Cuadrados
                                            Construidos</b></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="mt2_construido"
                                            placeholder="Ej: 230" name="mt2_construido">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">mt2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="mt2_terraza" class="form-label"><b>Metros Cuadrados
                                            Terraza</b></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="mt2_terraza"
                                            placeholder="Ej: 320" name="mt2_terraza">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">mt2</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="estacionamiento_visitas" class="form-label"><b>Estacionamiento de
                                            Visitas</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input"
                                                id="estacionamiento_visitas_si" name="estacionamiento_visitas"
                                                value="sí">
                                            <label for="estacionamiento_visitas_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input"
                                                id="estacionamiento_visitas_no" name="estacionamiento_visitas"
                                                value="no">
                                            <label for="estacionamiento_visitas_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="ascensor" class="form-label"><b>Ascensor</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="ascensor_si"
                                                name="ascensor" value="sí">
                                            <label for="ascensor_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="ascensor_no"
                                                name="ascensor" value="no">
                                            <label for="ascensor_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="juegos_infantiles" class="form-label"><b>Juegos
                                            Infantiles</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="juegos_infantiles_si"
                                                name="juegos_infantiles" value="sí">
                                            <label for="juegos_infantiles_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="juegos_infantiles_no"
                                                name="juegos_infantiles" value="no">
                                            <label for="juegos_infantiles_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="lavanderia" class="form-label"><b>Lavandería</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="lavanderia_si"
                                                name="lavanderia" value="sí">
                                            <label for="lavanderia_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="lavanderia_no"
                                                name="lavanderia" value="no">
                                            <label for="lavanderia_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="quinchos" class="form-label"><b>Quinchos</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="quinchos_si"
                                                name="quinchos" value="sí">
                                            <label for="quinchos_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="quinchos_no"
                                                name="quinchos" value="no">
                                            <label for="quinchos_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="sala_multiuso" class="form-label"><b>Sala Multiuso</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="sala_multiuso_si"
                                                name="sala_multiuso" value="sí">
                                            <label for="sala_multiuso_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="sala_multiuso_no"
                                                name="sala_multiuso" value="no">
                                            <label for="sala_multiuso_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="gimnasio" class="form-label"><b>Gimnasio</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="gimnasio_si"
                                                name="gimnasio" value="sí">
                                            <label for="gimnasio_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="gimnasio_no"
                                                name="gimnasio" value="no">
                                            <label for="gimnasio_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="ciclovia" class="form-label"><b>Ciclovía</b></label>
                                    <div class="form-group my-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="ciclovia_si"
                                                name="ciclovia" value="sí">
                                            <label for="ciclovia_si" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="ciclovia_no"
                                                name="ciclovia" value="no">
                                            <label for="ciclovia_no" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="gasto_comun" class="form-label"><b>Gasto Común</b></label>
                                    <input type="number" class="form-control" id="gasto_comun" placeholder="Ej: 12000"
                                        name="gasto_comun">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="descripcion" class="form-label"><b>Descripción</b></label>
                                    <textarea class="form-control" placeholder="La vivienda se ubica ...." id="descripcion" name="descripcion"></textarea>
                                </div>
                            </div>
                            <hr>
                            <!-- Botones -->
                            <div class="mt-4 justify-content-end">
                                <button type="button" id="btn_agregardetalle" class="btn btn-success">Guardar</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
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


    <!-- modal exito -->
    <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="successLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: rgba(0, 0, 0, 0); border: none; width: 700px;">
                <div class="modal-header alert alert-success" role="alert" style="border: none;">
                    <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000"
                                    style="width:70px;height:70px"></lord-icon>
                            </div>
                            <div class="col-8 d-flex justify-content-center align-items-center">
                                <p id="texto_success" class="text-uppercase">Datos Guardados con éxito</p>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
                    <h5 class="m-4 text-uppercase text-center " id="textoinfo">¿Seguro/a que quieres eliminar Propiedad?
                        </h2>
                        <div class="modalfooter d-flex justify-content-center">
                            <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
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
                            <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="confirmarEliminarContratoBtn"
                                class="btn btn-secondary m-2">Eliminar</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    @parent
    <script>
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
                        url: '/obtener/propietarioNombre',
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

            //Boton agregar arriendo
            $("#btn_agregar").on('click', function(event) {
                event.preventDefault();

                // Obtener los valores de los campos de texto
                var direccion = $("#direccionInput").val();
                var maps = $("#rutaInput").val();
                var rol = $("#rolInput").val();
                var tipo_vivienda = $("#tipoInput").val();
                var condominio = $("#condominioInput").val();
                var torre = $("#torreInput").val();
                var bodega = $("#bodegaInput").val();
                var num_departamento = $("#numeroCasaInput").val();
                var id_propietario = $("#propietarioInput").val();
                var empresaluz = $("#empresaLuzInput").val();
                var numeroluz = $("#numeroLuzInput").val();
                var empresaagua = $("#empresaAguaInput").val();
                var numeroagua = $("#numeroAguaInput").val();
                var empresagas = $("#empresaGasInput").val();
                var numerogas = $("#numeroGasInput").val();
                var num_estacionamiento = $("#estacionamientoInput").val();
                var precio = $("#precioInput").val();
                var deuda_hipotecaria = $("#deuda_hipotecaria").val();
                var contribuciones = $("input[name='contribuciones']:checked").val();
                var derechos_aseo = $("input[name='derechos_aseo']:checked").val();
                var exclusividad = $("input[name='exclusividad']:checked").val();
                var sello_verde = $("input[name='sello_verde']:checked").val();

                // Crear un objeto FormData
                var formData = new FormData();

                // Agregar los datos del formulario al FormData
                formData.append('direccion', direccion);
                formData.append('maps', maps);
                formData.append('rol', rol);
                formData.append('tipo_vivienda', tipo_vivienda);
                formData.append('condominio', condominio);
                formData.append('torre', torre);
                formData.append('bodega', bodega);
                formData.append('num_departamento', num_departamento);
                formData.append('id_propietario', id_propietario);
                formData.append('empresaluz', empresaluz);
                formData.append('numeroluz', numeroluz);
                formData.append('empresaagua', empresaagua);
                formData.append('numeroagua', numeroagua);
                formData.append('empresagas', empresagas);
                formData.append('numerogas', numerogas);
                formData.append('num_estacionamiento', num_estacionamiento);
                formData.append('precio', precio);
                formData.append('deuda_hipotecaria', deuda_hipotecaria);
                formData.append('contribuciones', contribuciones);
                formData.append('derechos_aseo', derechos_aseo);
                formData.append('exclusividad', exclusividad);
                formData.append('sello_verde', sello_verde);

                // Obtener los archivos seleccionados
                var files = $('#imagenes')[0].files;

                // Iterar sobre los archivos seleccionados y agregarlos al objeto FormData
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    formData.append('imagenes[]', file);
                }

                formData.forEach(function(value, key) {
                    console.log(key, value);
                });

                console.log(formData);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/obrero/propiedadesVenta/add_propiedad') }}',
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

            ////MOSTRAR MODAL DE DETALLES ///
            $(document).ready(function() {
                let idPropiedad;

                $(".detalle-propiedad").on('click', function(event) {
                    event.preventDefault();
                    idPropiedad = $(this).data('id'); // Obtén el ID del botón presionado
                    console.log('propiedad: ' + idPropiedad);
                    $("#Detalle_Propiedad").modal('show');
                });

                $('#btn_agregardetalle').click(function(e) {
                    event.preventDefault();
                    var año_construccion = $("#año_construccion").val();
                    var piso = $("#piso").val();
                    var dormitorios = $("#dormitorios").val();
                    var baños = $("#baños").val();
                    var orientacion = $("#orientacion").val();
                    var cocina = $("input[name='cocina']:checked").val();
                    var logia = $("input[name='logia']:checked").val();
                    var agua_caliente = $("input[name='agua_caliente']:checked").val();
                    var espacio_lavadora = $("input[name='espacio_lavadora']:checked").val();
                    var lavadora = $("input[name='lavadora']:checked").val();
                    var inventario = $("input[name='inventario']:checked").val();
                    var mt2_total = $("#mt2_total").val();
                    var mt2_construido = $("#mt2_construido").val();
                    var mt2_terraza = $("#mt2_terraza").val();
                    var estacionamiento_visitas = $("input[name='estacionamiento_visitas']:checked")
                        .val();
                    var ascensor = $("input[name='ascensor']:checked").val();
                    var juegos_infantiles = $("input[name='juegos_infantiles']:checked").val();
                    var lavanderia = $("input[name='lavanderia']:checked").val();
                    var quinchos = $("input[name='quinchos']:checked").val();
                    var sala_multiuso = $("input[name='sala_multiuso']:checked").val();
                    var gimnasio = $("input[name='gimnasio']:checked").val();
                    var ciclovia = $("input[name='ciclovia']:checked").val();
                    var gasto_comun = $("#gasto_comun").val();
                    var descripcion = $("#descripcion").val();

                    // Crear un objeto FormData
                    var formData = new FormData();
                    // Detalles propiedad 
                    formData.append('id_propiedad', idPropiedad);
                    formData.append('año_construccion', año_construccion);
                    formData.append('piso', piso);
                    formData.append('dormitorios', dormitorios);
                    formData.append('baños', baños);
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

                    console.log('ID de propiedad enviado:', idPropiedad);

                    $.ajax({
                        url: '/obrero/detallesVentaPropiedad/' + idPropiedad,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('#Detalle_Propiedad').modal('hide');
                            $('#successModal').modal('show'); // Mostrar modal de éxito
                        },
                        error: function(xhr) {
                            // Manejo de errores
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = '';
                            $.each(errors, function(key, value) {
                                errorMessage += value[0] +
                                    '\n'; // Concatenar mensajes de error
                            });
                            alert(errorMessage); // Mostrar errores
                        }
                    });
                });
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
                    url: '/obrero/archivosVenta/guardar/' + id_propiedad,
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
                        console.log('Error al eliminar el archivo: ' + xhr.responseJSON.error);
                    }
                });
            });
        });

        ////MOSTRAR MODAL DE ELIMINAR ///
        //boton eliminar propiedad
        $(".borrar-propiedad").on('click', function(event) {
            event.preventDefault();
            var idPropiedad = $(this).data('id');
            console.log('propiedad: ' + idPropiedad);

            // Mostrar el modal de confirmación
            $("#modalInfo").modal('show');

            // Manejar el clic en el botón de confirmación
            $("#confirmDelete").off('click').on('click', function() { // Usar off() para evitar múltiples bindings
                $("#modalInfo").modal('hide');

                // Realizar la solicitud AJAX
                $.ajax({
                    url: `/obrero/propiedadVenta/${idPropiedad}`, // Usar template literals para construir la URL
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

        //funcion al cerrar modal sucess actualice los datos
        $("#cerrar_error").click(function() {
            $("#modalerror").modal('hide');
        });

        //funcion al cerrar modal sucess actualice los datos
        $("#close_success").click(function() {
            $("#successModal").modal('hide');
            location.reload();
        });
    </script>
@endsection
@section('css')
    @parent
    <style>
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
    </style>
@endsection
