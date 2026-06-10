@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color:rgb(255, 255, 255)">
    <div class="row">
        @include('layouts.sidebar')
        <div class="col">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12" style="text-align: start; margin-top: 40px; margin-bottom: 20px; color: white;">
                        <h1 class="text-uppercase text-black text-center">Detalles Año Corrido</h1>
                    </div>

                    {{-- IMÁGENES CON SECCIONES --}}
                    <div class="col-lg-6 p-4">
                        <div class="row p-3 shadow text-white mb-4" style="background-color:#E67E22; border-radius: .9rem;">
                            <div class="mb-3">
                                <div class="p-2">

                                    <div class="col-lg-7 mb-3 bg-black rounded-pill shadow text-white text-center">
                                        <h4 class="form-label">Imágenes de la propiedad</h4>
                                    </div>

                                    @if($imagen && $imagen->count() > 0)
                                        <div class="mb-2" id="img-principal-wrap">
                                            <img id="img-principal"
                                                 src="{{ asset($imagen->first()->link) }}"
                                                 class="rounded w-100"
                                                 style="height: 320px; object-fit: cover; cursor: pointer; border: 2px solid rgba(0,0,0,.15);"
                                                 alt="{{ $detalles->direccion }}">
                                            <div class="mt-1 text-end">
                                                <small id="img-principal-seccion" class="badge bg-dark text-white" style="font-size:.75rem;"></small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="mb-2 rounded d-flex align-items-center justify-content-center"
                                             style="height:200px; background:rgba(0,0,0,.2);">
                                            <p class="text-white-50 mb-0"><i class="fas fa-image me-1"></i> Sin imágenes aún</p>
                                        </div>
                                    @endif

                                    <div class="mt-3 mb-1">
                                        <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                            <span class="text-white fw-bold small">Secciones:</span>
                                            <div id="tabs-secciones" class="d-flex flex-wrap gap-1"></div>
                                            <div class="d-flex gap-1 ms-auto">
                                                <input type="text" id="nueva-seccion-input"
                                                       class="form-control form-control-sm"
                                                       style="width:130px; font-size:.8rem;"
                                                       placeholder="Nueva sección...">
                                                <button type="button" id="btn-crear-seccion"
                                                        class="btn btn-dark btn-sm rounded-pill px-2"
                                                        style="white-space:nowrap;">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="strip-miniaturas" class="d-flex gap-2 pb-2 mb-1"
                                         style="overflow-x: auto; min-height: 80px;"></div>
                                    <div id="sin-imagenes-seccion" class="text-white-50 small text-center py-2" style="display:none;">
                                        Sin imágenes en esta sección
                                    </div>

                                    {{-- Modal reasignar sección --}}
                                    <div id="modal-reasignar"
                                         style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.6);
                                                z-index:9999; align-items:center; justify-content:center;">
                                        <div class="bg-white rounded p-4 shadow" style="max-width:340px; width:90%;">
                                            <h6 class="fw-bold mb-3 text-dark">Mover imagen a sección</h6>
                                            <img id="modal-preview-img" src="" class="rounded w-100 mb-3"
                                                 style="height:140px; object-fit:cover;">
                                            <select id="modal-select-seccion" class="form-select form-select-sm mb-3"></select>
                                            <div class="d-flex gap-2">
                                                <button type="button" id="modal-btn-confirmar"
                                                        class="btn btn-dark btn-sm rounded-pill flex-fill">Guardar</button>
                                                <button type="button" id="modal-btn-cancelar"
                                                        class="btn btn-outline-secondary btn-sm rounded-pill flex-fill">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>

                                    <script id="datos-imagenes-php" type="application/json">
                                        [
                                            @foreach($imagen as $img)
                                            {
                                                "id": {{ $img->id }},
                                                "src": "{{ asset($img->link) }}",
                                                "seccion": "{{ $img->seccion ?? '' }}"
                                            }{{ !$loop->last ? ',' : '' }}
                                            @endforeach
                                        ]
                                    </script>

                                    <div class="form-group mb-3 mt-3">
                                        <div class="col-lg-7 mb-2 bg-black rounded-pill shadow text-white text-center">
                                            <h4 class="form-label" style="font-size:1rem;">Agregar Imágenes</h4>
                                        </div>
                                        <div class="mb-2">
                                            <select id="seccion-subir" class="form-select form-select-sm">
                                                <option value="">— Sin sección —</option>
                                            </select>
                                        </div>
                                        <div class="upload-container">
                                            <div id="drop-area" class="drop-area">
                                                <p><i class="fas fa-images me-1"></i> Arrastra o haz clic para subir imágenes</p>
                                                <input class="form-control" type="file" id="imagenes" multiple style="display: none;">
                                                <input type="hidden" id="imagenes-seccion-valor" name="imagenes_seccion" value="">
                                            </div>
                                            <div id="preview" class="d-flex flex-wrap justify-content-center mt-2"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- VIDEOS --}}
                        <div class="row p-3 shadow text-white" style="background-color:#E67E22; border-radius: .9rem;">
                            <div class="col-lg-12 mb-3">
                                <div class="col-lg-6 bg-black rounded-pill shadow text-white text-center">
                                    <h4>Video de la propiedad</h4>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <div class="d-flex flex-wrap align-items-center justify-content-center">
                                        @foreach($videos as $vid)
                                            <div class="position-relative w-100 mb-3">
                                                <video controls loop muted autoplay playsinline
                                                       style="width:100%; height: 420px; object-fit: cover; display: block; border-radius: .5rem; margin-bottom: 5px;">
                                                    <source src="{{ asset($vid->video) }}" type="video/mp4">
                                                </video>
                                                <a href="javascript:void(0)" data-id="{{$vid->id}}" class="position-absolute delete-video"
                                                   style="top: 12px; right: 12px; background: rgba(255,255,255,0.85); padding: 10px; border-radius: .5rem;">
                                                    <i class="fas fa-trash-alt fa-lg" style="color: red;"></i>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="col-lg-4 mb-2 bg-black rounded-pill shadow text-white text-center">
                                        <h4 class="small p-1">Agregar Video</h4>
                                    </div>
                                    <div class="form-group mb-2">
                                        <div id="video-drop-area"
                                             class="form-control p-2 d-flex align-items-center justify-content-center text-center"
                                             style="border: 1.5px dashed #000; border-radius: 8px; cursor: pointer; font-size: .82rem; min-height: 50px; color: #333;"
                                             ondragover="event.preventDefault()"
                                             ondrop="handleVideoDrop(event)">
                                            <i class="fas fa-cloud-upload-alt me-1"></i> Subir video
                                        </div>
                                        <input class="form-control" type="file" name="videos" id="videos" accept="video/*" style="display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- RESUMEN ARRIENDO --}}
                        <div class="row shadow p-3 text-white card-naranja mt-4">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-6 bg-black text-white text-center rounded-pill shadow">
                                    <h4 class="mb-2">Resumen del Arriendo</h4>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="fw-bold small">Valor actual del arriendo</label>
                                <input type="number" id="valor_arriendo" class="form-control form-control-sm"
                                       value="{{ $precios->ano_corrido ?? '' }}" placeholder="Ej: 450000">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="fw-bold small">Fecha inicio arriendo</label>
                                <input type="date" id="fecha_inicio" class="form-control form-control-sm" value="2025-08-17">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="fw-bold small">Próximo reajuste</label>
                                <input type="date" id="proximo_reajuste" class="form-control form-control-sm" value="2026-08-17">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="fw-bold small">Reajuste automático</label>
                                <input type="text" class="form-control form-control-sm" value="Se reajusta cada 1 año automáticamente" readonly>
                            </div>
                        </div>

                    </div>

                    {{-- COLUMNA DERECHA --}}
                    <div class="col-lg-6 mb-3 p-4">

                        <div class="row shadow p-3 mb-4" style="background-color:#E67E22; border-radius:.9rem;">
                            <div class="col-lg-12 mb-3">
                                <div class="col-lg-7 bg-black text-white text-center rounded-pill shadow">
                                    <h4>Detalles de la Propiedad</h4>
                                </div>
                            </div>

                            <div class="row mb-4 text-white">
                                <div class="col-lg-6">
                                    <label>Propietarios</label>
                                    <div class="d-flex justify-content-between">
                                        <select id="propietarioInput" class="form-select me-2">
                                            <option disabled selected value="0">Seleccione un propietario</option>
                                            @foreach ($new_Propietarios as $propietario)
                                                <option value="{{ $propietario->id }}">{{ $propietario->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary rounded-pill" id="agregar-propietario">Agregar</button>
                                    </div>
                                    <ul class="mt-4" id="lista-agregados"></ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-2 shadow text-dark" style="background-color:#FFE2B2; border-radius:.9rem;">
                                        <div class="bg-black rounded-pill text-white text-center mb-2">
                                            <h5 class="small p-1">Lista de Propietarios</h5>
                                        </div>
                                        <div style="max-height:120px; overflow-y:auto;">
                                            @foreach($propietarios as $prop)
                                                <div class="input-group mb-1">
                                                    <span class="input-group-text p-1"><i class="fa-solid fa-user-tie"></i></span>
                                                    <input type="text" class="form-control form-control-sm" value="{{ $prop->propietario->nombre }}" readonly>
                                                    <span class="input-group-text p-1">
                                                        <a href="javascript:void(0)" data-id="{{$prop->id}}" class="delete-propietario">
                                                            <i class="fas fa-trash-alt" style="color:red;"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="border-light">

                            <div class="row">
                                <div class="col-lg-6 text-dark">
                                    <div class="mb-2 p-2 rounded shadow-sm" style="background-color:#F5DEB3;">
                                        <label>Dirección</label>
                                        <input type="text" id="direccionedit" class="form-control form-control-sm" value="{{ $detalles->direccion }}">
                                    </div>
                                    <div class="mb-2 p-2 rounded shadow-sm" style="background-color:#F5DEB3;">
                                        <label>Comuna</label>
                                        <input type="text" id="ciudadedit" class="form-control form-control-sm" value="{{ $detalles->ciudad }}">
                                    </div>
                                    <div class="mb-2 p-2 rounded shadow-sm" style="background-color:#F5DEB3;">
                                        <label>Rol</label>
                                        <input type="text" id="roledit" class="form-control form-control-sm" value="{{ $detalles->rol }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 text-dark">
                                    <div class="mb-2 p-2 rounded shadow-sm" style="background-color:#F5DEB3;">
                                        <label>N° Cliente Luz</label>
                                        <input type="text" id="numero_luzedit" class="form-control form-control-sm" value="{{ $detalles->numero_luz }}">
                                    </div>
                                    <div class="mb-2 p-2 rounded shadow-sm" style="background-color:#F5DEB3;">
                                        <label>N° Cliente Agua</label>
                                        <input type="text" id="numero_aguaedit" class="form-control form-control-sm" value="{{ $detalles->numero_agua }}">
                                    </div>
                                    <div class="mb-2 p-2 rounded shadow-sm" style="background-color:#F5DEB3;">
                                        <label>N° Cliente Gas</label>
                                        <input type="text" id="numero_gasedit" class="form-control form-control-sm" value="{{ $detalles->numero_gas }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- CARACTERÍSTICAS --}}
                        <div class="row shadow p-3 text-white" style="background-color:#E67E22; border-radius:.9rem;">
                            <div class="col-lg-12 mb-3">
                                <div class="col-lg-6 bg-black text-white text-center rounded-pill shadow">
                                    <h4>Características</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label>Dormitorios</label>
                                <input type="text" id="dormitorios_edit" class="form-control form-control-sm" value="{{ $detallespropiedad->dormitorios }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label>Baños</label>
                                <input type="text" id="banos_edit" class="form-control form-control-sm" value="{{ $detallespropiedad->banos }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label>Mt2 Total</label>
                                <input type="text" id="mt2_total_edit" class="form-control form-control-sm" value="{{ $detallespropiedad->mt2_total }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label>Estacionamiento</label>
                                <input type="text" id="numeroEstacionamientoInput" class="form-control form-control-sm" value="{{ $sub_est->estacionamiento }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label>N° Bodega</label>
                                <input type="text" id="numeroBodegaInput" class="form-control form-control-sm" value="{{ $sub_bodega->bodega }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label>Vivienda</label>
                                <select id="viviendaedit" class="form-select form-select-sm">
                                    <option value="Casa" {{ $detalles->tipo_vivienda === 'Casa' ? 'selected' : '' }}>Casa</option>
                                    <option value="Departamento" {{ $detalles->tipo_vivienda === 'Departamento' ? 'selected' : '' }}>Depto</option>
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label>Amoblado</label>
                                <div class="btn-group btn-group-sm w-100 shadow-sm">
                                    <input type="radio" class="btn-check" name="am_op" id="am_si">
                                    <label class="btn btn-dark" for="am_si">SÍ</label>
                                    <input type="radio" class="btn-check" name="am_op" id="am_no" checked>
                                    <label class="btn btn-dark" for="am_no">NO</label>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label>Elementos Entregados</label>
                                <input type="text" id="elementos_entregados" class="form-control form-control-sm">
                            </div>
                            <div class="col-lg-12">
                                <label>Observaciones adicionales</label>
                                <textarea id="observaciones_caracteristicas" class="form-control form-control-sm" rows="2"></textarea>
                            </div>
                        </div>

                        {{-- ARRENDATARIO --}}
                        <div class="row shadow p-3 text-white mt-4" style="background-color:#E67E22; border-radius:.9rem;">
                            <div class="col-lg-12 mb-3">
                                <div class="col-lg-6 bg-black text-white text-center rounded-pill shadow">
                                    <h4>Arrendatario</h4>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label>Nombre</label>
                                <input type="text" id="nombre_arrendatario" class="form-control form-control-sm"
                                       value="{{ $arrendatario->nombre ?? '' }}" placeholder="Nombre completo">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label>Rut</label>
                                <input type="text" id="rut_arrendatario" class="form-control form-control-sm"
                                       value="{{ $arrendatario->rut ?? '' }}" placeholder="12.345.678-9">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label>Teléfono</label>
                                <input type="text" id="telefono_arrendatario" class="form-control form-control-sm"
                                       value="{{ $arrendatario->telefono ?? '' }}" placeholder="+56 9 1234 5678">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label>Correo</label>
                                <input type="email" id="correo_arrendatario" class="form-control form-control-sm"
                                       value="{{ $arrendatario->correo ?? '' }}" placeholder="correo@ejemplo.cl">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label>Profesión u Oficio</label>
                                <input type="text" id="profesion_arrendatario" class="form-control form-control-sm"
                                       placeholder="Ej: Ingeniero, Contador...">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label>Fecha de Pago</label>
                                <select id="fecha_pago" class="form-select form-select-sm">
                                    <option value="" disabled selected>Seleccione día hábil</option>
                                    @for($d = 1; $d <= 28; $d++)
                                        <option value="{{ $d }}">Día {{ $d }}</option>
                                    @endfor
                                </select>
                                <small class="text-white-50" style="font-size:.75rem;">Día hábil del mes de pago</small>
                            </div>

                            <div class="col-lg-12 mt-2 mb-2">
                                <div class="col-lg-5 bg-black text-white text-center rounded-pill shadow">
                                    <h5 class="mb-0 py-1">Servicios Básicos</h5>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label>Empresa Luz</label>
                                <input type="text" id="empresa_luz_arr" class="form-control form-control-sm" placeholder="Ej: CGE">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label>N° Cliente Luz</label>
                                <input type="text" id="numero_luz_arr" class="form-control form-control-sm" placeholder="Ej: 123456789">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label>Empresa Agua</label>
                                <input type="text" id="empresa_agua_arr" class="form-control form-control-sm" placeholder="Ej: Aguas del Valle">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label>N° Cliente Agua</label>
                                <input type="text" id="numero_agua_arr" class="form-control form-control-sm" placeholder="Ej: 987654321">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label>Empresa Gas</label>
                                <input type="text" id="empresa_gas_arr" class="form-control form-control-sm" placeholder="Ej: Abastible">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label>N° Cliente Gas</label>
                                <input type="text" id="numero_gas_arr" class="form-control form-control-sm" placeholder="Ej: 456789123">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label>Adjuntar Información Cliente</label>
                                <input type="file" id="info_cliente" class="form-control form-control-sm">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label>Contratos / Acta / Inventario</label>
                                <input type="file" id="documentos_arrendatario" class="form-control form-control-sm" multiple>
                            </div>
                        </div>

                    </div>

                    {{-- MANTENIMIENTO --}}
                    <div class="col-lg-12 mt-4">
                        <div class="shadow p-4 text-white" style="background-color:#E67E22; border-radius: .9rem; margin-bottom: 20px;">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="px-4 py-2 text-white text-center shadow" style="background-color:#000; border-radius: 50px;">
                                    <h4 class="mb-0">Mantenimientos y Trabajos Propiedad</h4>
                                </div>
                            </div>
                            <div class="p-3 mb-4" style="background-color: rgba(255,255,255,0.12); border-radius: .9rem;">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="mb-3">
                                            <label class="label-mantenimiento">Tipo de Trabajo</label>
                                            <input type="text" id="tipo_trabajo" class="form-control input-mantenimiento" placeholder="Ej: Calefón, Caldera, Pintura...">
                                        </div>
                                        <div class="mb-3">
                                            <label class="label-mantenimiento">Fecha de Mantención</label>
                                            <input type="date" id="fecha_mantencion_nueva" class="form-control input-mantenimiento">
                                        </div>
                                        <div class="mb-3">
                                            <label class="label-mantenimiento">Persona a Cargo</label>
                                            <input type="text" id="persona_cargo_nueva" class="form-control input-mantenimiento" placeholder="Ej: Juan Pérez">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="label-mantenimiento">Descripción del trabajo</label>
                                            <textarea rows="6" id="descripcion_trabajo_nueva" class="form-control input-mantenimiento" placeholder="Detalle del trabajo realizado..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="label-mantenimiento">Archivo</label>
                                            <input type="file" id="archivo_trabajo" class="form-control archivo-mantenimiento">
                                        </div>
                                        <div class="mb-3">
                                            <label class="label-mantenimiento">Fotos</label>
                                            <input type="file" multiple id="fotos_trabajo" class="form-control archivo-mantenimiento">
                                        </div>
                                        <div class="mb-3">
                                            <label class="label-mantenimiento">Videos</label>
                                            <input type="file" multiple id="videos_trabajo" class="form-control archivo-mantenimiento">
                                        </div>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="button" id="btn_agregar_trabajo" class="btn btn-dark rounded-pill px-4">
                                                <i class="fas fa-plus me-1"></i> Agregar Trabajo
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="lista_trabajos"></div>
                        </div>
                    </div>

                    {{-- BOTÓN GUARDAR --}}
                    <div class="col-lg-12 mb-5 text-center">
                        <button type="button"
                                id="guardarCambios"
                                data-id="{{ $detalles->id }}"
                                class="btn btn-dark btn-lg rounded-pill px-5 shadow">
                            <i class="fas fa-save me-2"></i> Guardar Todos los Cambios
                        </button>
                    </div>

                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>

{{-- Loading overlay --}}
<div id="loadingOverlay"
     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5);
            z-index:99999; align-items:center; justify-content:center;">
    <div class="bg-white rounded p-4 shadow text-center" style="min-width:220px;">
        <div id="overlay-spinner" class="spinner-border text-dark mb-2" role="status"></div>
        <div id="overlay-icono" style="display:none;" class="mb-2">
            <i class="fas fa-check-circle fa-3x text-success"></i>
        </div>
        <p id="overlay-texto" class="mb-0 fw-bold">Guardando cambios...</p>
    </div>
</div>

@endsection

@section('javascript')
@parent
<script>
$(document).ready(function () {

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // ============================================================
    // SECCIONES DE IMÁGENES
    // ============================================================
    var imagenesData  = [];
    var secciones     = [];
    var seccionActiva = 'todas';
    var imgReasignarId = null;

    try {
        var raw = document.getElementById('datos-imagenes-php');
        if (raw) imagenesData = JSON.parse(raw.textContent);
    } catch(e) {}

    imagenesData.forEach(function(img) {
        if (img.seccion && img.seccion !== '' && secciones.indexOf(img.seccion) === -1) {
            secciones.push(img.seccion);
        }
    });

    function renderTabs() {
        var $tabs = $('#tabs-secciones');
        $tabs.empty();
        $tabs.append(
            $('<button type="button">')
                .addClass('btn btn-sm rounded-pill tab-seccion ' + (seccionActiva === 'todas' ? 'btn-light text-dark' : 'btn-outline-light'))
                .attr('data-sec', 'todas')
                .text('Todas (' + imagenesData.length + ')')
        );
        secciones.forEach(function(sec) {
            var count = imagenesData.filter(function(i){ return i.seccion === sec; }).length;
            var $btn = $('<button type="button">')
                .addClass('btn btn-sm rounded-pill tab-seccion d-flex align-items-center gap-1 ' + (seccionActiva === sec ? 'btn-light text-dark' : 'btn-outline-light'))
                .attr('data-sec', sec)
                .html(sec + ' <span class="badge bg-dark text-white ms-1" style="font-size:.7rem;">' + count + '</span>');
            if (count === 0) {
                $btn.append(
                    $('<i class="fas fa-times ms-1" style="font-size:.7rem; cursor:pointer;">')
                        .on('click', function(e) {
                            e.stopPropagation();
                            secciones.splice(secciones.indexOf(sec), 1);
                            if (seccionActiva === sec) seccionActiva = 'todas';
                            renderTabs(); actualizarSelectores();
                        })
                );
            }
            $tabs.append($btn);
        });
        $tabs.find('.tab-seccion').on('click', function() {
            seccionActiva = $(this).data('sec');
            renderTabs(); renderMiniaturas();
        });
    }

    function renderMiniaturas() {
        var $strip = $('#strip-miniaturas');
        $strip.empty();
        var lista = seccionActiva === 'todas' ? imagenesData : imagenesData.filter(function(i){ return i.seccion === seccionActiva; });
        if (lista.length === 0) { $('#sin-imagenes-seccion').show(); return; }
        $('#sin-imagenes-seccion').hide();
        lista.forEach(function(img) {
            var $wrap = $('<div class="position-relative flex-shrink-0" style="width:100px;">');
            var $img = $('<img>').addClass('rounded miniatura-recorrido')
                .attr({ src: img.src, 'data-src': img.src, 'data-id': img.id, 'data-seccion': img.seccion })
                .css({ width:'100px', height:'70px', 'object-fit':'cover', cursor:'pointer', border:'2px solid transparent', transition:'border-color .2s' });
            if (img.seccion) {
                $wrap.append($('<span>').addClass('position-absolute badge bg-dark text-white')
                    .css({ bottom:'4px', left:'4px', 'font-size':'.6rem', 'max-width':'90px', overflow:'hidden', 'text-overflow':'ellipsis', 'white-space':'nowrap' })
                    .text(img.seccion));
            }
            var $bar = $('<div class="position-absolute d-flex gap-1">')
                .css({ top:'3px', right:'3px', background:'rgba(255,255,255,.88)', 'border-radius':'50px', padding:'5px' });
            $bar.append($('<a href="javascript:void(0)">').attr('data-id', img.id).addClass('portada d-flex align-items-center').html('<i class="fas fa-check" style="color:green;font-size:.7rem;"></i>'));
            $bar.append($('<a href="javascript:void(0)">').addClass('btn-reasignar d-flex align-items-center').attr({'data-id': img.id, 'data-src': img.src, 'data-sec': img.seccion || '', title: 'Cambiar sección'}).html('<i class="fas fa-tag" style="color:#E67E22;font-size:.7rem;"></i>'));
            $bar.append($('<a href="javascript:void(0)">').attr('data-id', img.id).addClass('delete-img d-flex align-items-center').html('<i class="fas fa-trash-alt" style="color:red;font-size:.7rem;"></i>'));
            $bar.append($('<a>').attr({ href: img.src, download: '' }).addClass('d-flex align-items-center').html('<i class="fas fa-download" style="color:#007bff;font-size:.7rem;"></i>'));
            $wrap.append($img).append($bar);
            $strip.append($wrap);
        });
        if (lista.length > 0 && $('#img-principal').length) {
            $('#img-principal').attr('src', lista[0].src);
            $('#img-principal-seccion').text(lista[0].seccion ? '📁 ' + lista[0].seccion : '');
        }
    }

    function actualizarSelectores() {
        var $sel1 = $('#seccion-subir'), $sel2 = $('#modal-select-seccion');
        $sel1.empty().append('<option value="">— Sin sección —</option>');
        $sel2.empty().append('<option value="">— Sin sección —</option>');
        secciones.forEach(function(sec) { $sel1.append($('<option>').val(sec).text(sec)); $sel2.append($('<option>').val(sec).text(sec)); });
    }

    $('#btn-crear-seccion').on('click', function() {
        var nombre = $('#nueva-seccion-input').val().trim();
        if (!nombre) return;
        if (secciones.indexOf(nombre) !== -1) { alert('Esa sección ya existe.'); return; }
        secciones.push(nombre);
        $('#nueva-seccion-input').val('');
        renderTabs(); actualizarSelectores();
    });
    $('#nueva-seccion-input').on('keydown', function(e) { if (e.key === 'Enter') { e.preventDefault(); $('#btn-crear-seccion').trigger('click'); } });

    $(document).on('click', '.miniatura-recorrido', function() {
        var src = $(this).data('src'), sec = $(this).data('seccion') || '';
        $('#img-principal').attr('src', src);
        $('#img-principal-seccion').text(sec ? '📁 ' + sec : '');
        $('.miniatura-recorrido').css('border-color', 'transparent');
        $(this).css('border-color', '#000');
    });

    $(document).on('click', '.btn-reasignar', function() {
        imgReasignarId = $(this).data('id');
        $('#modal-preview-img').attr('src', $(this).data('src'));
        $('#modal-select-seccion').val($(this).data('sec') || '');
        $('#modal-reasignar').css('display', 'flex');
    });
    $('#modal-btn-cancelar').on('click', function() { $('#modal-reasignar').hide(); imgReasignarId = null; });
    $('#modal-btn-confirmar').on('click', function() {
        if (imgReasignarId === null) return;
        var nuevaSeccion = $('#modal-select-seccion').val();
        var img = imagenesData.find(function(i){ return i.id === imgReasignarId; });
        if (img) img.seccion = nuevaSeccion;
        $.ajax({ url: '/imagen/seccion/' + imgReasignarId, type: 'POST', data: { seccion: nuevaSeccion, _token: $('meta[name="csrf-token"]').attr('content') } });
        $('#modal-reasignar').hide(); imgReasignarId = null;
        renderTabs(); renderMiniaturas();
    });

    $('#seccion-subir').on('change', function() { $('#imagenes-seccion-valor').val($(this).val()); });

    renderTabs(); renderMiniaturas(); actualizarSelectores();

    // ============================================================
    // RUT FORMAT
    // ============================================================
    $('#rut_arrendatario').on('input', function () {
        let val = $(this).val().replace(/[^0-9kK]/g, '').toUpperCase();
        if (val.length > 1) val = val.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + val.slice(-1);
        $(this).val(val);
    });

    // ============================================================
    // PROPIETARIOS
    // ============================================================
    var PropietariosAgregados = [];
    var $lista = $('#lista-agregados');

    $('#agregar-propietario').on('click', function(e) {
        e.preventDefault();
        var propietarioId = $('#propietarioInput').val();
        if (propietarioId && propietarioId !== '0') {
            PropietariosAgregados.push({ id: propietarioId });
            $('#propietarioInput option[value="' + propietarioId + '"]').prop('disabled', true);
            $('#propietarioInput').val('0');
            actualizarListaPropietarios();
        } else { alert('Por favor, seleccione un propietario.'); }
    });

    function actualizarListaPropietarios() {
        $lista.empty();
        $.each(PropietariosAgregados, function(index, prop) {
            $.ajax({ url: '/obtener/propietarioNombre', type: 'GET', data: { nombre_pro: prop.id },
                success: function(response) {
                    $lista.append($('<li>').html('<i class="fa-solid fa-user-tie"></i> ' + response.nombre)
                        .append($('<button>').html('<i class="fas fa-trash-alt fa-lg text-danger"></i>').addClass('btn btn-sm ms-2 m-1')
                            .on('click', function() { eliminarPropietario(index); })));
                }
            });
        });
    }

    function eliminarPropietario(index) {
        $('#propietarioInput option[value="' + PropietariosAgregados[index].id + '"]').prop('disabled', false);
        PropietariosAgregados.splice(index, 1);
        actualizarListaPropietarios();
    }

    // ============================================================
    // TRABAJOS DE MANTENIMIENTO
    // ============================================================
    var trabajosAgregados = [];

    $('#btn_agregar_trabajo').on('click', function () {
        var tipo = $('#tipo_trabajo').val().trim();
        var fecha = $('#fecha_mantencion_nueva').val();
        var personaCargo = $('#persona_cargo_nueva').val().trim();
        var descripcion = $('#descripcion_trabajo_nueva').val().trim();
        if (!tipo || !fecha || !descripcion) { alert('Por favor completa al menos el Tipo, Fecha y Descripción.'); return; }
        trabajosAgregados.push({ tipo, fecha, persona_cargo: personaCargo, descripcion });
        renderizarTrabajos();
        $('#tipo_trabajo, #fecha_mantencion_nueva, #persona_cargo_nueva, #descripcion_trabajo_nueva').val('');
        $('#archivo_trabajo, #fotos_trabajo, #videos_trabajo').val('');
    });

    function renderizarTrabajos() {
        var $cont = $('#lista_trabajos');
        $cont.empty();
        if (trabajosAgregados.length === 0) return;
        var $tabla = $('<div class="table-responsive"><table class="table table-bordered table-sm bg-white text-dark rounded"><thead class="table-dark text-center"><tr><th>#</th><th>Tipo</th><th>Fecha</th><th>Persona a Cargo</th><th>Descripción</th><th>Eliminar</th></tr></thead><tbody id="tbody_trabajos"></tbody></table></div>');
        trabajosAgregados.forEach(function(t, i) {
            var $fila = $('<tr>');
            $fila.append($('<td class="text-center">').text(i + 1));
            $fila.append($('<td>').text(t.tipo));
            $fila.append($('<td class="text-center">').text(t.fecha));
            $fila.append($('<td class="text-center">').text(t.persona_cargo || '—'));
            $fila.append($('<td>').text(t.descripcion));
            $fila.append($('<td class="text-center">').append(
                $('<button type="button" class="btn btn-danger btn-sm rounded-pill">').html('<i class="fas fa-trash-alt"></i>')
                    .on('click', function() { trabajosAgregados.splice(i, 1); renderizarTrabajos(); })
            ));
            $tabla.find('#tbody_trabajos').append($fila);
        });
        $cont.append($tabla);
    }

    // ============================================================
    // GUARDAR CAMBIOS — solo campos que existen en esta vista
    // ============================================================
    $('#guardarCambios').off().on('click', function(e) {
        e.preventDefault();
        var id_propiedad = $(this).data('id');

        var formData = new FormData();

        // Propiedad
        formData.append('id_propiedad',    id_propiedad);
        formData.append('direccion',       $('#direccionedit').val());
        formData.append('ciudad',          $('#ciudadedit').val());
        formData.append('rol',             $('#roledit').val());
        formData.append('tipo_vivienda',   $('#viviendaedit').val());
        formData.append('numero_luz',      $('#numero_luzedit').val());
        formData.append('numero_agua',     $('#numero_aguaedit').val());
        formData.append('numero_gas',      $('#numero_gasedit').val());

        // Características
        formData.append('dormitorios',     $('#dormitorios_edit').val());
        formData.append('banos',           $('#banos_edit').val());
        formData.append('mt2_total',       $('#mt2_total_edit').val());
        formData.append('estacionamiento', $('#numeroEstacionamientoInput').val());
        formData.append('bodega',          $('#numeroBodegaInput').val());
        formData.append('amoblado',        $('#am_si').is(':checked') ? 'si' : 'no');

        // Resumen arriendo
        formData.append('valor_arriendo',  $('#valor_arriendo').val());

        // Arrendatario
        formData.append('nombre_arrendatario',   $('#nombre_arrendatario').val());
        formData.append('rut_arrendatario',      $('#rut_arrendatario').val());
        formData.append('telefono_arrendatario', $('#telefono_arrendatario').val());
        formData.append('correo_arrendatario',   $('#correo_arrendatario').val());

        // Propietarios nuevos
        formData.append('PropietariosAgregados', JSON.stringify(PropietariosAgregados));

        // Trabajos
        formData.append('trabajos', JSON.stringify(trabajosAgregados));

        // Sección imágenes
        formData.append('imagenes_seccion', $('#seccion-subir').val());

        // Imágenes
        var imgFiles = $('#imagenes')[0].files;
        for (var i = 0; i < imgFiles.length; i++) { formData.append('imagenes[]', imgFiles[i]); }

        // Video
        var videoFile = $('#videos')[0].files[0];
        if (videoFile) formData.append('videos', videoFile);

        // Archivos arrendatario
        var infoCliente = $('#info_cliente')[0].files[0];
        if (infoCliente) formData.append('info_cliente', infoCliente);
        var docsArr = $('#documentos_arrendatario')[0].files;
        for (var j = 0; j < docsArr.length; j++) { formData.append('documentos_arrendatario[]', docsArr[j]); }

        $('#loadingOverlay').css('display', 'flex');

        $.ajax({
            url: '/editarDetallesAnoCorrido',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
        .done(function() {
    $('#overlay-spinner').hide();
    $('#overlay-icono').show();
    $('#overlay-texto').text('¡Cambios guardados correctamente!');
    setTimeout(function() {
        $('#loadingOverlay').hide();
        $('#overlay-spinner').show();
        $('#overlay-icono').hide();
        $('#overlay-texto').text('Guardando cambios...');
    }, 2000);
})
.fail(function(xhr) {
    $('#overlay-spinner').hide();
    $('#overlay-icono').html('<i class="fas fa-times-circle fa-3x text-danger"></i>').show();
    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Error al guardar. Intente nuevamente.';
    $('#overlay-texto').text(msg);
    setTimeout(function() {
        $('#loadingOverlay').hide();
        $('#overlay-spinner').show();
        $('#overlay-icono').html('<i class="fas fa-check-circle fa-3x text-success"></i>').hide();
        $('#overlay-texto').text('Guardando cambios...');
    }, 3000);
});
    });

    // ============================================================
    // ELIMINAR IMAGEN
    // ============================================================
    $(document).on('click', '.delete-img', function(e) {
        e.preventDefault();
        var idImg = $(this).data('id');
        if (!confirm('¿Seguro/a que quieres eliminar la imagen?')) return;
        $.ajax({ url: '/imagen/' + idImg, type: 'DELETE', headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } })
        .done(function() {
            imagenesData = imagenesData.filter(function(i){ return i.id !== idImg; });
            renderTabs(); renderMiniaturas();
            if ($('#successModal').length) { $('#successModal').modal('show'); $('#texto_success').text('Imagen eliminada correctamente'); }
        })
        .fail(function() { alert('Error al eliminar la imagen.'); });
    });

    // ============================================================
    // PORTADA
    // ============================================================
    $(document).on('click', '.portada', function(e) {
        e.preventDefault();
        var idImg = $(this).data('id');
        if (!confirm('¿Dejar esta imagen como portada?')) return;
        $.ajax({ url: '/portada/cambiar_img/' + idImg, type: 'POST', headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } })
        .done(function() { alert('Portada cambiada correctamente'); })
        .fail(function() { alert('Error al cambiar la portada.'); });
    });

    // ============================================================
    // ELIMINAR VIDEO
    // ============================================================
    $(document).on('click', '.delete-video', function(e) {
        e.preventDefault();
        var idVideo = $(this).data('id');
        var $wrap = $(this).closest('.position-relative');
        if (!confirm('¿Seguro/a que quieres eliminar el video?')) return;
        $.ajax({ url: '/video/' + idVideo, type: 'DELETE', headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } })
        .done(function() { $wrap.remove(); alert('Video eliminado correctamente'); })
        .fail(function() { alert('Error al eliminar el video.'); });
    });

    // ============================================================
    // ELIMINAR PROPIETARIO
    // ============================================================
    $(document).on('click', '.delete-propietario', function(e) {
        e.preventDefault();
        var idPropietario = $(this).data('id');
        var $row = $(this).closest('.input-group');
        if (!confirm('¿Seguro/a que quieres eliminar este propietario?')) return;
        $.ajax({ url: '/propietarioDelete/' + idPropietario, type: 'DELETE', headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } })
        .done(function() { $row.remove(); alert('Propietario eliminado correctamente'); })
        .fail(function() { alert('Error al eliminar el propietario.'); });
    });

    $('#close_success').on('click', function() { $('#successModal').modal('hide'); location.reload(); });

    // ============================================================
    // DROP AREA IMÁGENES
    // ============================================================
    var dropArea  = document.getElementById('drop-area');
    var fileInput = document.getElementById('imagenes');
    var preview   = document.getElementById('preview');

    dropArea.addEventListener('click', function() { fileInput.click(); });

    function handleFiles(files) {
        preview.innerHTML = '';
        Array.from(files).forEach(function(file) {
            if (file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(ev) { var img = document.createElement('img'); img.src = ev.target.result; preview.appendChild(img); };
                reader.readAsDataURL(file);
            }
        });
    }

    fileInput.addEventListener('change', function() { handleFiles(fileInput.files); });
    dropArea.addEventListener('dragover', function(e) { e.preventDefault(); dropArea.style.backgroundColor = '#f8d7da'; });
    dropArea.addEventListener('dragleave', function() { dropArea.style.backgroundColor = ''; });
    dropArea.addEventListener('drop', function(e) { e.preventDefault(); dropArea.style.backgroundColor = ''; handleFiles(e.dataTransfer.files); });
    document.getElementById('video-drop-area').addEventListener('click', function() { document.getElementById('videos').click(); });

});

function handleVideoDrop(event) {
    event.preventDefault();
    var files = event.dataTransfer.files;
    var videoInput = document.getElementById('videos');
    if (files.length && files[0].type.startsWith('video/')) {
        videoInput.files = files;
        alert('Se agregó el video: ' + files[0].name);
    } else {
        alert('Por favor, sube un archivo de video válido.');
    }
}
</script>
@endsection

@section('css')
@parent
<style>
#img-principal { transition: opacity .2s ease; }
.miniatura-recorrido:hover { border-color: #E67E22 !important; opacity: .9; }
#strip-miniaturas::-webkit-scrollbar { height: 5px; }
#strip-miniaturas::-webkit-scrollbar-thumb { background: rgba(0,0,0,.3); border-radius: 10px; }
.tab-seccion { font-size: .78rem !important; padding: 3px 10px !important; transition: all .15s; }
.tab-seccion:hover { opacity: .85; }
.upload-container {
    border: 1.5px dashed #000; border-radius: 0.5rem; text-align: center;
    padding: .75rem 1rem; color: #6c757d; cursor: pointer; font-size: .85rem;
}
.upload-container img { margin-top: .5rem; max-width: 100%; max-height: 100px; border-radius: 0.5rem; }
.card-naranja { background-color: #E67E22; border-radius: .9rem; }
.label-mantenimiento { font-size: .85rem; font-weight: bold; color: #fff; margin-bottom: 5px; display: block; }
.input-mantenimiento { border: none; border-radius: .5rem; min-height: 38px; }
.input-mantenimiento:focus { box-shadow: none; border: 2px solid #000; }
textarea.input-mantenimiento { resize: none; }
.archivo-mantenimiento { background: #fff; color: #000; border: none; border-radius: .5rem; }
#lista_trabajos .table thead { font-size: .85rem; }
#lista_trabajos .table tbody td { vertical-align: middle; font-size: .9rem; }
#loadingOverlay { align-items: center; justify-content: center; }
#guardarCambios { font-size: 1.1rem; padding: .75rem 3rem; }
#guardarCambios:active { transform: scale(.97); }
</style>
@endsection