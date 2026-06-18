@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="background-color:#f7f3ee; min-height:100vh;">
        <div class="row">
            @include('layouts.sidebar')
            <div class="col">
                <div class="container-fluid px-4 py-4">

                    {{-- TÍTULO --}}
                    <div class="text-center mb-4">
                        <h1 class="fw-bold text-uppercase" style="color:#1a1a1a; letter-spacing:2px; font-size:1.6rem;">
                            Detalles Año Corrido
                        </h1>
                        <div style="height:3px; width:80px; background:#E67E22; margin:8px auto 0;"></div>
                    </div>

                {{-- FOTOS / VIDEO --}}
                <div class="row gx-2 gy-0 align-items-stretch mb-3">
                    <div class="col-xl-5 col-lg-5 col-md-6 px-1">
                        <div class="card-seccion h-100 card-seccion-compacta">
                            <div class="card-seccion-header">
                                <span><i class="fas fa-images me-2"></i>Fotos / Video</span>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge-orden" id="btn-orden-alfa" title="Orden Alfabético">
                                        <i class="fas fa-sort-alpha-down me-1"></i>A–Z
                                    </span>
                                    <div class="btns-accion">
                                        <button class="btn-edit" onclick="toggleEditFotos()" title="Editar" id="btn-edit-fotos">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-seccion-body p-3">

                                    {{-- TABS SECCIONES --}}
                                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                        <div id="tabs-secciones" class="d-flex flex-wrap gap-1"></div>
                                    </div>

                                    {{-- FILA PRINCIPAL: Imagen grande + Strip miniaturas vertical --}}
                                    <div class="d-flex gap-2 mb-3" style="min-height: 280px;">

                                        {{-- Imagen principal --}}
                                        <div class="position-relative flex-grow-1">
                                            @if ($imagen && $imagen->count() > 0)
                                                <img id="img-principal" src="{{ asset($imagen->first()->link) }}"
                                                    class="rounded w-100 h-100"
                                                    style="object-fit:cover; border:2px solid rgba(255,255,255,.2); max-height:280px;"
                                                    alt="{{ $detalles->direccion }}">
                                                <span id="img-principal-seccion" class="badge-seccion-img"></span>
                                                @if ($videos->count() > 0)
                                                    <div class="img-video-overlay">
                                                        <video controls loop muted autoplay playsinline>
                                                            <source src="{{ asset($videos->first()->video) }}"
                                                                type="video/mp4">
                                                        </video>
                                                        <a href="javascript:void(0)" data-id="{{ $videos->first()->id }}"
                                                            class="delete-video btn-eliminar-flotante">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="sin-imagen h-100">
                                                    <i class="fas fa-image fa-2x mb-1"></i>
                                                    <p class="mb-0 small">Sin imágenes aún</p>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Strip miniaturas VERTICAL (derecha) --}}
                                        <div id="strip-miniaturas"
                                            style="display:flex; flex-direction:column; gap:6px; overflow-y:auto; overflow-x:hidden; width:95px; max-height:280px;">
                                        </div>
                                        <div id="sin-imagenes-seccion" class="small text-center py-2"
                                            style="display:none; color:rgba(255,255,255,.5);">
                                            Sin imágenes en esta sección
                                        </div>

                                    </div>

                                    {{-- Panel subir fotos/video (se muestra al editar) --}}
                                    <div id="panel-fotos-inline" style="display:none;" class="mt-3">
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <label class="label-campo mb-1">Sección para las imágenes</label>
                                                <div class="d-flex gap-2 mb-2">
                                                    <select id="campo-seccion-subir" class="input-inline flex-grow-1"
                                                        style="min-height:34px;"></select>
                                                    <input type="text" id="nueva-seccion-input" class="input-inline"
                                                        style="width:130px;" placeholder="Nueva sección...">
                                                    <button type="button" id="btn-crear-seccion"
                                                        class="btn-guardar-inline px-3"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="label-campo mb-1">Imágenes</label>
                                                <div id="drop-area" class="drop-area-inline">
                                                    <i class="fas fa-images fa-lg mb-1"></i>
                                                    <p class="mb-0 small">Arrastra o haz clic para subir</p>
                                                    <input type="file" id="imagenes" multiple style="display:none;"
                                                        accept="image/*">
                                                </div>
                                                <div id="preview" class="d-flex flex-wrap gap-1 mt-2"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="label-campo mb-1">Video</label>
                                                <div id="video-drop-area" class="drop-area-inline"
                                                    ondragover="event.preventDefault()" ondrop="handleVideoDrop(event)">
                                                    <i class="fas fa-cloud-upload-alt me-1"></i> Subir video
                                                    <input type="file" name="videos" id="videos" accept="video/*"
                                                        style="display:none;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2 mt-3">
                                            <button type="button" class="btn-cancelar-inline"
                                                onclick="cancelarEditFotos()">Cancelar</button>
                                            <button type="button" class="btn-guardar-inline"
                                                onclick="guardarSeccion('fotos')">
                                                <i class="fas fa-save me-1"></i>Guardar
                                            </button>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-6 px-1">
                        <div class="card-seccion h-100" id="card-arriendo">
                            <div class="card-seccion-header">
                                <span><i class="fas fa-file-invoice-dollar me-2"></i>Resumen del Arriendo</span>
                                <div class="btns-accion">
                                    <button class="btn-edit" onclick="toggleEdit('arriendo')" id="btn-edit-arriendo" title="Editar"><i class="fas fa-pen"></i></button>
                                    <button class="btn-del" onclick="confirmarEliminar('arriendo')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                            <div class="card-seccion-body" id="body-arriendo">

                                    {{-- VISTA --}}
                                    <div id="view-arriendo">
                                        <div class="fila-dato">
                                            <span class="label-campo">Valor Actual Arriendo</span>
                                            <span class="valor-dato resaltado" id="disp-valor-arriendo">
                                                ${{ number_format(floatval($precios->ano_corrido ?? 0) * 1000, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        <div class="fila-dato">
                                            <span class="label-campo">Gastos Comunes</span>
                                            <span class="valor-dato"
                                                id="disp-gastos-comunes">${{ number_format($arriendos->first()->gastos_comunes ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="fila-dato">
                                            <span class="label-campo">Valor Real</span>
                                            <span class="valor-dato"
                                                id="disp-valor-real">${{ number_format($arriendos->first()->valor_real ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="fila-dato">
                                            <span class="label-campo">Fecha Inicio</span>
                                            <span class="valor-dato"
                                                id="disp-fecha-inicio">{{ $arriendos->first()?->fecha_entrega ? \Carbon\Carbon::parse($arriendos->first()->fecha_entrega)->format('d/m/Y') : '—' }}</span>
                                        </div>
                                        <div class="fila-dato">
                                            <span class="label-campo">Próximo Reajuste</span>
                                            <span class="valor-dato"
                                                id="disp-proximo-reajuste">{{ $arriendos->first()?->fecha_reajuste ? \Carbon\Carbon::parse($arriendos->first()->fecha_reajuste)->format('d/m/Y') : '—' }}</span>
                                        </div>
                                        <div class="fila-dato">
                                            <span class="label-campo">Reajuste</span>
                                            <span class="valor-dato" style="font-size:.82rem; opacity:.75;">Cada 1 año
                                                automáticamente</span>
                                        </div>
                                    </div>

                                    {{-- EDICIÓN --}}
                                    <div id="edit-arriendo" style="display:none;">
                                        <div class="fila-edit">
                                            <label class="label-campo">Valor Actual Arriendo</label>
                                            <input type="number" id="m_valor_arriendo" class="input-inline resaltado"
                                                value="{{ $precios->ano_corrido ?? '' }}" placeholder="Ej: 450000">
                                        </div>
                                        <div class="fila-edit">
                                            <label class="label-campo">Gastos Comunes</label>
                                            <input type="text" id="m_gastos_comunes" class="input-inline"
                                                value="{{ $arriendos->first()?->gastos_comunes ? '$' . number_format($arriendos->first()->gastos_comunes, 0, ',', '.') : '' }}"
                                                placeholder="Ej: $150.000">
                                        </div>
                                        <div class="fila-edit">
                                            <label class="label-campo">Valor Real</label>
                                            <input type="text" id="m_valor_real" class="input-inline"
                                                value="{{ $arriendos->first()?->valor_real ? '$' . number_format($arriendos->first()->valor_real, 0, ',', '.') : '' }}"
                                                placeholder="Ej: $450.000">
                                        </div>
                                        <div class="fila-edit">
                                            <label class="label-campo">Fecha Inicio</label>
                                            <input type="date" id="m_fecha_inicio" class="input-inline"
                                                value="{{ $arriendos->first()?->fecha_entrega ? \Carbon\Carbon::parse($arriendos->first()->fecha_entrega)->format('Y-m-d') : '' }}">
                                        </div>
                                        <div class="fila-edit">
                                            <label class="label-campo">Próximo Reajuste</label>
                                            <input type="date" id="m_proximo_reajuste" class="input-inline"
                                                value="{{ $arriendos->first()?->fecha_reajuste ? \Carbon\Carbon::parse($arriendos->first()->fecha_reajuste)->format('Y-m-d') : '' }}">
                                        </div>
                                        <div class="d-flex justify-content-end gap-2 mt-3">
                                            <button type="button" class="btn-cancelar-inline"
                                                onclick="cancelarEdit('arriendo')">Cancelar</button>
                                            <button type="button" class="btn-guardar-inline"
                                                onclick="guardarSeccion('arriendo')">
                                                <i class="fas fa-save me-1"></i>Guardar
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ══════════════════════════════════════════
                     FILA MEDIA: Detalles Propiedad + Características
                ══════════════════════════════════════════ --}}
                <div class="row gx-2 gy-2 align-items-stretch mb-3">

                    {{-- DETALLES DE LA PROPIEDAD --}}
                    <div class="col-lg-8">
                        <div class="card-seccion h-100" id="card-propiedad">
                            <div class="card-seccion-header">
                                <span><i class="fas fa-building me-2"></i>Detalle de la Propiedad</span>
                                <div class="btns-accion">
                                    <button class="btn-edit" onclick="toggleEdit('propiedad')" id="btn-edit-propiedad" title="Editar"><i class="fas fa-pen"></i></button>
                                    <button class="btn-del" onclick="confirmarEliminar('propiedad')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                            <div class="card-seccion-body">

                                    {{-- VISTA --}}
                                    <div id="view-propiedad">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="grupo-datos">
                                                    <p class="grupo-titulo">Ubicación</p>
                                                    <div class="fila-dato"><span
                                                            class="label-campo">Propietario</span><span
                                                            class="valor-dato">{{ $propietarios->first()->propietario->nombre ?? '—' }}</span>
                                                    </div>
                                                    <div class="fila-dato"><span class="label-campo">Dirección</span><span
                                                            class="valor-dato"
                                                            id="disp-direccion">{{ $detalles->direccion }}</span></div>
                                                    <div class="fila-dato"><span class="label-campo">Comuna</span><span
                                                            class="valor-dato"
                                                            id="disp-ciudad">{{ $detalles->ciudad }}</span></div>
                                                    <div class="fila-dato"><span class="label-campo">Rol</span><span
                                                            class="valor-dato" id="disp-rol">{{ $detalles->rol }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="grupo-datos">
                                                    <p class="grupo-titulo">Servicios Básicos</p>
                                                    <div class="fila-dato"><span class="label-campo">Empresa
                                                            Luz</span><span class="valor-dato"
                                                            id="disp-empresa-luz">{{ $detalles->empresa_luz ?? '—' }}</span>
                                                    </div>
                                                    <div class="fila-dato"><span class="label-campo">N° Cliente
                                                            Luz</span><span class="valor-dato"
                                                            id="disp-numero-luz">{{ $detalles->numero_luz ?? '—' }}</span>
                                                    </div>
                                                    <div class="fila-dato"><span class="label-campo">Empresa
                                                            Agua</span><span class="valor-dato"
                                                            id="disp-empresa-agua">{{ $detalles->empresa_agua ?? '—' }}</span>
                                                    </div>
                                                    <div class="fila-dato"><span class="label-campo">N° Cliente
                                                            Agua</span><span class="valor-dato"
                                                            id="disp-numero-agua">{{ $detalles->numero_agua ?? '—' }}</span>
                                                    </div>
                                                    <div class="fila-dato"><span class="label-campo">Empresa
                                                            Gas</span><span class="valor-dato"
                                                            id="disp-empresa-gas">{{ $detalles->empresa_gas ?? '—' }}</span>
                                                    </div>
                                                    <div class="fila-dato"><span class="label-campo">N° Cliente
                                                            Gas</span><span class="valor-dato"
                                                            id="disp-numero-gas">{{ $detalles->numero_gas ?? '—' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($propietarios->count() > 1)
                                            <div class="mt-2">
                                                <p class="grupo-titulo">Todos los Propietarios</p>
                                                <div class="d-flex flex-wrap gap-2" id="lista-chips-propietarios">
                                                    @foreach ($propietarios as $prop)
                                                        <span class="chip-propietario">
                                                            <i
                                                                class="fa-solid fa-user-tie me-1"></i>{{ $prop->propietario->nombre }}
                                                            <a href="javascript:void(0)" data-id="{{ $prop->id }}"
                                                                class="delete-propietario ms-1" style="color:#f9a8a8;">
                                                                <i class="fas fa-times" style="font-size:.7rem;"></i>
                                                            </a>
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- EDICIÓN --}}
                                    <div id="edit-propiedad" style="display:none;">
                                        <div class="row g-2 mb-2">
                                            <div class="col-md-6">
                                                <div class="grupo-datos">
                                                    <p class="grupo-titulo">Ubicación</p>
                                                    <div class="fila-edit"><label
                                                            class="label-campo">Dirección</label><input type="text"
                                                            id="m_direccion" class="input-inline"
                                                            value="{{ $detalles->direccion }}"></div>
                                                    <div class="fila-edit"><label class="label-campo">Comuna</label><input
                                                            type="text" id="m_ciudad" class="input-inline"
                                                            value="{{ $detalles->ciudad }}"></div>
                                                    <div class="fila-edit"><label class="label-campo">Rol</label><input
                                                            type="text" id="m_rol" class="input-inline"
                                                            value="{{ $detalles->rol }}"></div>
                                                    <div class="fila-edit"><label class="label-campo">Tipo
                                                            Vivienda</label>
                                                        <select id="m_tipo_vivienda" class="input-inline">
                                                            <option value="Casa"
                                                                {{ $detalles->tipo_vivienda === 'Casa' ? 'selected' : '' }}>
                                                                Casa</option>
                                                            <option value="Departamento"
                                                                {{ $detalles->tipo_vivienda === 'Departamento' ? 'selected' : '' }}>
                                                                Departamento</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="grupo-datos">
                                                    <p class="grupo-titulo">Servicios Básicos</p>
                                                    <div class="fila-edit"><label class="label-campo">Empresa
                                                            Luz</label><input type="text" id="m_empresa_luz"
                                                            class="input-inline" value="{{ $detalles->empresa_luz }}">
                                                    </div>
                                                    <div class="fila-edit"><label class="label-campo">N° Cliente
                                                            Luz</label><input type="text" id="m_numero_luz"
                                                            class="input-inline" value="{{ $detalles->numero_luz }}">
                                                    </div>
                                                    <div class="fila-edit"><label class="label-campo">Empresa
                                                            Agua</label><input type="text" id="m_empresa_agua"
                                                            class="input-inline" value="{{ $detalles->empresa_agua }}">
                                                    </div>
                                                    <div class="fila-edit"><label class="label-campo">N° Cliente
                                                            Agua</label><input type="text" id="m_numero_agua"
                                                            class="input-inline" value="{{ $detalles->numero_agua }}">
                                                    </div>
                                                    <div class="fila-edit"><label class="label-campo">Empresa
                                                            Gas</label><input type="text" id="m_empresa_gas"
                                                            class="input-inline" value="{{ $detalles->empresa_gas }}">
                                                    </div>
                                                    <div class="fila-edit"><label class="label-campo">N° Cliente
                                                            Gas</label><input type="text" id="m_numero_gas"
                                                            class="input-inline" value="{{ $detalles->numero_gas }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grupo-datos">
                                            <p class="grupo-titulo">Agregar Propietario</p>
                                            <div class="d-flex gap-2">
                                                <select id="m_propietario" class="input-inline">
                                                    <option disabled selected value="0">Seleccione...</option>
                                                    @foreach ($new_Propietarios as $p)
                                                        <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn-guardar-inline px-3"
                                                    onclick="agregarPropietarioInline()">Agregar</button>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2 mt-3">
                                            <button type="button" class="btn-cancelar-inline"
                                                onclick="cancelarEdit('propiedad')">Cancelar</button>
                                            <button type="button" class="btn-guardar-inline"
                                                onclick="guardarSeccion('propiedad')">
                                                <i class="fas fa-save me-1"></i>Guardar
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    {{-- CARACTERÍSTICAS --}}
                    <div class="col-lg-4">
                        <div class="card-seccion h-100" id="card-caracteristicas">
                            <div class="card-seccion-header">
                                <span><i class="fas fa-list-check me-2"></i>Características</span>
                                <div class="btns-accion">
                                    <button class="btn-edit" onclick="toggleEdit('caracteristicas')" id="btn-edit-caracteristicas" title="Editar"><i class="fas fa-pen"></i></button>
                                    <button class="btn-del" onclick="confirmarEliminar('caracteristicas')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                            <div class="card-seccion-body">

                                    {{-- VISTA --}}
                                    <div id="view-caracteristicas">
                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            <div class="chip-num"><i class="fas fa-bed"></i><span
                                                    id="disp-dorm">{{ $detallespropiedad->dormitorios ?? '—' }}</span><small>Dorm.</small>
                                            </div>
                                            <div class="chip-num"><i class="fas fa-bath"></i><span
                                                    id="disp-banos">{{ $detallespropiedad->banos ?? '—' }}</span><small>Baños</small>
                                            </div>
                                            <div class="chip-num"><i class="fas fa-ruler-combined"></i><span
                                                    id="disp-mt2">{{ $detallespropiedad->mt2_total ?? '—' }}</span><small>m²</small>
                                            </div>
                                            <div class="chip-num"><i class="fas fa-car"></i><span
                                                    id="disp-est">{{ $sub_est->estacionamiento ?? '—' }}</span><small>Est.</small>
                                            </div>
                                            <div class="chip-num"><i class="fas fa-box"></i><span
                                                    id="disp-bodega">{{ $sub_bodega->bodega ?? '—' }}</span><small>Bodega</small>
                                            </div>
                                        </div>
                                        <div class="fila-dato"><span class="label-campo">Vivienda</span><span
                                                class="valor-dato"
                                                id="disp-vivienda">{{ $detalles->tipo_vivienda ?? '—' }}</span></div>
                                        <div class="fila-dato">
                                            <span class="label-campo">Amoblado</span>
                                            <span id="disp-amoblado">
                                                @if (($detallespropiedad->amoblado ?? 'no') === 'si')
                                                    <span class="badge-si">SÍ</span>
                                                @else
                                                    <span class="badge-no">NO</span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="fila-dato"><span class="label-campo">Elementos Entregados</span><span
                                                class="valor-dato"
                                                id="disp-elementos">{{ $detallespropiedad->elementos_entregados ?? '—' }}</span>
                                        </div>
                                        @if ($detallespropiedad->observaciones ?? null)
                                            <div class="mt-2 p-2 rounded" id="disp-obs-wrap"
                                                style="background:rgba(0,0,0,.2); font-size:.83rem; color:#fff;">
                                                <i class="fas fa-comment-dots me-1" style="opacity:.7;"></i>
                                                <span
                                                    id="disp-observaciones">{{ $detallespropiedad->observaciones }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- EDICIÓN --}}
                                    <div id="edit-caracteristicas" style="display:none;">
                                        <div class="row g-2 mb-2">
                                            <div class="col-4"><label class="label-campo">Dormitorios</label><input
                                                    type="text" id="m_dormitorios" class="input-inline text-center"
                                                    value="{{ $detallespropiedad->dormitorios }}"></div>
                                            <div class="col-4"><label class="label-campo">Baños</label><input
                                                    type="text" id="m_banos" class="input-inline text-center"
                                                    value="{{ $detallespropiedad->banos }}"></div>
                                            <div class="col-4"><label class="label-campo">m² Total</label><input
                                                    type="text" id="m_mt2" class="input-inline text-center"
                                                    value="{{ $detallespropiedad->mt2_total }}"></div>
                                            <div class="col-4"><label class="label-campo">Estacionamiento</label><input
                                                    type="text" id="m_est" class="input-inline text-center"
                                                    value="{{ $sub_est->estacionamiento }}"></div>
                                            <div class="col-4"><label class="label-campo">N° Bodega</label><input
                                                    type="text" id="m_bodega" class="input-inline text-center"
                                                    value="{{ $sub_bodega->bodega }}"></div>
                                            <div class="col-4"><label class="label-campo">Vivienda</label>
                                                <select id="m_vivienda" class="input-inline">
                                                    <option value="Casa"
                                                        {{ $detalles->tipo_vivienda === 'Casa' ? 'selected' : '' }}>Casa
                                                    </option>
                                                    <option value="Departamento"
                                                        {{ $detalles->tipo_vivienda === 'Departamento' ? 'selected' : '' }}>
                                                        Depto</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="fila-edit">
                                            <label class="label-campo">Amoblado</label>
                                            <div class="btn-group btn-group-sm">
                                                <input type="radio" class="btn-check" name="m_am_op" id="m_am_si"
                                                    {{ ($detallespropiedad->amoblado ?? '') == 'si' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-light btn-sm" for="m_am_si">SÍ</label>
                                                <input type="radio" class="btn-check" name="m_am_op" id="m_am_no"
                                                    {{ ($detallespropiedad->amoblado ?? 'no') != 'si' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-light btn-sm" for="m_am_no">NO</label>
                                            </div>
                                        </div>
                                        <div class="fila-edit mt-2">
                                            <label class="label-campo">Elementos Entregados</label>
                                            <input type="text" id="m_elementos" class="input-inline"
                                                value="{{ $detallespropiedad->elementos_entregados ?? '' }}">
                                        </div>
                                        <div class="mt-2">
                                            <label class="label-campo">Observaciones</label>
                                            <textarea id="m_observaciones" class="input-inline" rows="2" style="resize:none;">{{ $detallespropiedad->observaciones ?? '' }}</textarea>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2 mt-3">
                                            <button type="button" class="btn-cancelar-inline"
                                                onclick="cancelarEdit('caracteristicas')">Cancelar</button>
                                            <button type="button" class="btn-guardar-inline"
                                                onclick="guardarSeccion('caracteristicas')">
                                                <i class="fas fa-save me-1"></i>Guardar
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ══════════════════════════════════════════
                     FILA: ARRENDATARIO
                ══════════════════════════════════════════ --}}
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <div class="card-seccion" id="card-arrendatario">
                                <div class="card-seccion-header">
                                    <span><i class="fas fa-user me-2"></i>Arrendatario</span>
                                    <div class="btns-accion">
                                        <button class="btn-edit" onclick="toggleEdit('arrendatario')"
                                            id="btn-edit-arrendatario" title="Editar"><i class="fas fa-pen"></i></button>
                                        <button class="btn-del" onclick="confirmarEliminar('arrendatario')"
                                            title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                <div class="card-seccion-body">

                                    {{-- VISTA --}}
                                    <div id="view-arrendatario">
                                        <div class="row g-2">
                                            <div class="col-md-2 col-6"><span class="label-campo">Nombre</span>
                                                <p class="valor-dato-lg" id="disp-arr-nombre">
                                                    {{ $arrendatario->nombre ?? '—' }}</p>
                                            </div>
                                            <div class="col-md-2 col-6"><span class="label-campo">RUT</span>
                                                <p class="valor-dato-lg" id="disp-arr-rut">
                                                    {{ $arrendatario->rut ?? '—' }}</p>
                                            </div>
                                            <div class="col-md-2 col-6"><span class="label-campo">Teléfono</span>
                                                <p class="valor-dato-lg" id="disp-arr-tel">
                                                    {{ $arrendatario->telefono ?? '—' }}</p>
                                            </div>
                                            <div class="col-md-2 col-6"><span class="label-campo">Correo</span>
                                                <p class="valor-dato-lg" id="disp-arr-correo"
                                                    style="font-size:.82rem; word-break:break-all;">
                                                    {{ $arrendatario->correo ?? '—' }}</p>
                                            </div>
                                            <div class="col-md-2 col-6"><span class="label-campo">Profesión</span>
                                                <p class="valor-dato-lg" id="disp-arr-prof">
                                                    {{ $arrendatario->profesion ?? '—' }}</p>
                                            </div>
                                            <div class="col-md-2 col-6"><span class="label-campo">Fecha de Pago</span>
                                                <p class="valor-dato-lg" id="disp-arr-pago">Día
                                                    {{ $arrendatario->fecha_pago ?? '—' }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 pt-2" style="border-top:1px solid rgba(255,255,255,.15);">
                                            <p class="label-campo mb-2"><i class="fas fa-paperclip me-1"></i>Archivos</p>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button class="btn-archivo" onclick="toggleEdit('arrendatario')">
                                                    <i class="fas fa-id-card me-1"></i> Info Cliente
                                                </button>
                                                <button class="btn-archivo" onclick="toggleEdit('arrendatario')">
                                                    <i class="fas fa-file-contract me-1"></i> Contratos / Acta / Inventario
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- EDICIÓN --}}
                                    <div id="edit-arrendatario" style="display:none;">
                                        <div class="row g-2">
                                            <div class="col-md-4 col-6">
                                                <label class="label-campo">Nombre</label>
                                                <input type="text" id="m_nombre_arr" class="input-inline"
                                                    value="{{ $arrendatario->nombre ?? '' }}">
                                            </div>
                                            <div class="col-md-4 col-6">
                                                <label class="label-campo">RUT</label>
                                                <input type="text" id="m_rut_arr" class="input-inline"
                                                    value="{{ $arrendatario->rut ?? '' }}" placeholder="12.345.678-9">
                                            </div>
                                            <div class="col-md-4 col-6">
                                                <label class="label-campo">Teléfono</label>
                                                <input type="text" id="m_tel_arr" class="input-inline"
                                                    value="{{ $arrendatario->telefono ?? '' }}">
                                            </div>
                                            <div class="col-md-4 col-6">
                                                <label class="label-campo">Correo</label>
                                                <input type="email" id="m_correo_arr" class="input-inline"
                                                    value="{{ $arrendatario->correo ?? '' }}">
                                            </div>
                                            <div class="col-md-4 col-6">
                                                <label class="label-campo">Profesión u Oficio</label>
                                                <input type="text" id="m_prof_arr" class="input-inline"
                                                    value="{{ $arrendatario->profesion ?? '' }}">
                                            </div>
                                            <div class="col-md-4 col-6">
                                                <label class="label-campo">Fecha de Pago</label>
                                                <select id="m_fecha_pago" class="input-inline">
                                                    <option value="" disabled>Seleccione día</option>
                                                    @for ($d = 1; $d <= 28; $d++)
                                                        <option value="{{ $d }}"
                                                            {{ ($arrendatario->fecha_pago ?? 0) == $d ? 'selected' : '' }}>
                                                            Día {{ $d }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-3 pt-2" style="border-top:1px solid rgba(255,255,255,.15);">
                                            <p class="label-campo mb-2"><i class="fas fa-paperclip me-1"></i>Archivos</p>
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <label class="label-campo">Info Cliente</label>
                                                    <input type="file" id="m_info_cliente" class="input-inline"
                                                        style="padding:.2rem .4rem;">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="label-campo">Contratos / Acta / Inventario</label>
                                                    <input type="file" id="m_docs_arr" class="input-inline"
                                                        style="padding:.2rem .4rem;" multiple>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2 mt-3">
                                            <button type="button" class="btn-cancelar-inline"
                                                onclick="cancelarEdit('arrendatario')">Cancelar</button>
                                            <button type="button" class="btn-guardar-inline"
                                                onclick="guardarSeccion('arrendatario')">
                                                <i class="fas fa-save me-1"></i>Guardar
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ══════════════════════════════════════════
                     MANTENIMIENTOS
                ══════════════════════════════════════════ --}}
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <div class="card-seccion">
                                <div class="card-seccion-header">
                                    <span><i class="fas fa-tools me-2"></i>Mantenimientos y Trabajos Propiedad</span>
                                </div>
                                <div class="card-seccion-body">

                                    {{-- FORMULARIO AGREGAR --}}
                                    <div class="p-3 mb-4" style="background:rgba(0,0,0,.15); border-radius:.7rem;">
                                        <div class="row g-3">
                                            <div class="col-lg-5">
                                                <div class="mb-3">
                                                    <label class="label-mantenimiento">Tipo de Trabajo</label>
                                                    <input type="text" id="tipo_trabajo" class="input-mantenimiento"
                                                        placeholder="Ej: Calefón, Caldera, Pintura...">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="label-mantenimiento">Fecha de Mantención</label>
                                                    <input type="date" id="fecha_mantencion_nueva"
                                                        class="input-mantenimiento">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="label-mantenimiento">Persona a Cargo</label>
                                                    <input type="text" id="persona_cargo_nueva"
                                                        class="input-mantenimiento" placeholder="Ej: Juan Pérez">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="label-mantenimiento">Próxima Mantención</label>
                                                    <input type="date" id="proxima_mantencion_nueva"
                                                        class="input-mantenimiento">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="label-mantenimiento">Descripción del trabajo</label>
                                                    <textarea rows="7" id="descripcion_trabajo_nueva" class="input-mantenimiento"
                                                        placeholder="Detalle del trabajo realizado..."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mb-3">
                                                    <label class="label-mantenimiento">Archivo (doc/pdf)</label>
                                                    <input type="file" id="archivo_trabajo"
                                                        class="archivo-mantenimiento">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="label-mantenimiento">Fotos</label>
                                                    <input type="file" multiple id="fotos_trabajo"
                                                        class="archivo-mantenimiento" accept="image/*">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="label-mantenimiento">Videos</label>
                                                    <input type="file" multiple id="videos_trabajo"
                                                        class="archivo-mantenimiento" accept="video/*">
                                                </div>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <button type="button" id="btn_agregar_trabajo"
                                                        class="btn-guardar-inline">
                                                        <i class="fas fa-plus me-1"></i> Agregar Trabajo
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- CARDS TRABAJOS GUARDADOS --}}
                                    @if (isset($trabajos) && $trabajos->count() > 0)
                                        <p class="label-campo mb-3"
                                            style="font-size:.8rem; opacity:.75; letter-spacing:.5px;">
                                            <i class="fas fa-clipboard-list me-1"></i>
                                            {{ $trabajos->count() }} trabajo(s) registrado(s)
                                        </p>
                                        <div class="row g-3">
                                            @foreach ($trabajos as $t)
                                                <div class="col-lg-4 col-md-6" id="card-trabajo-{{ $t->id }}">
                                                    <div class="card-trabajo">

                                                        {{-- VISTA --}}
                                                        <div id="view-trabajo-{{ $t->id }}">
                                                            <div
                                                                class="d-flex align-items-start justify-content-between mb-2 gap-2">
                                                                <span class="trabajo-tipo-badge">
                                                                    <i class="fas fa-wrench me-1"></i>{{ $t->nombre }}
                                                                </span>
                                                                <span class="trabajo-fecha">
                                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                                    {{ $t->fecha_mantencion ? \Carbon\Carbon::parse($t->fecha_mantencion)->format('d/m/Y') : '—' }}
                                                                </span>
                                                            </div>

                                                            <p class="trabajo-descripcion">{{ $t->descripcion }}</p>

                                                            <div
                                                                style="border-top:1px solid rgba(255,255,255,.15); padding-top:.6rem; margin-bottom:.6rem;">
                                                                @if ($t->persona_cargo)
                                                                    <div class="fila-dato">
                                                                        <span class="label-campo"><i
                                                                                class="fas fa-user me-1"></i>Persona a
                                                                            Cargo</span>
                                                                        <span
                                                                            class="valor-dato">{{ $t->persona_cargo }}</span>
                                                                    </div>
                                                                @endif
                                                                @if ($t->fecha_prox_man)
                                                                    <div class="fila-dato">
                                                                        <span class="label-campo"><i
                                                                                class="fas fa-clock me-1"></i>Próxima
                                                                            Mantención</span>
                                                                        <span class="valor-dato" style="color:#ffd580;">
                                                                            {{ \Carbon\Carbon::parse($t->fecha_prox_man)->format('d/m/Y') }}
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            @if ($t->doc)
                                                                <div class="mb-2">
                                                                    <a href="{{ asset($t->doc) }}" target="_blank"
                                                                        class="trabajo-adjunto">
                                                                        <i class="fas fa-file me-1"></i>Ver Documento
                                                                    </a>
                                                                </div>
                                                            @endif

                                                            {{-- Botones ver --}}
                                                            <div class="d-flex gap-2 mt-2">
                                                                <button type="button"
                                                                    class="btn-guardar-inline flex-fill"
                                                                    onclick="toggleEditTrabajo({{ $t->id }})">
                                                                    <i class="fas fa-pen me-1"></i>Editar
                                                                </button>
                                                                <button type="button"
                                                                    style="background:rgba(220,50,50,.5); color:#fff; border:none; border-radius:50px; padding:.35rem 1rem; font-size:.83rem; cursor:pointer;"
                                                                    onclick="eliminarTrabajo({{ $t->id }})">
                                                                    <i class="fas fa-trash-alt me-1"></i>Eliminar
                                                                </button>
                                                            </div>
                                                        </div>

                                                        {{-- EDICIÓN --}}
                                                        <div id="edit-trabajo-{{ $t->id }}" style="display:none;">
                                                            <div class="mb-2">
                                                                <label class="label-campo">Tipo de Trabajo</label>
                                                                <input type="text" id="edit-tipo-{{ $t->id }}"
                                                                    class="input-inline" value="{{ $t->nombre }}">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="label-campo">Fecha Mantención</label>
                                                                <input type="date" id="edit-fecha-{{ $t->id }}"
                                                                    class="input-inline"
                                                                    value="{{ $t->fecha_mantencion ? \Carbon\Carbon::parse($t->fecha_mantencion)->format('Y-m-d') : '' }}">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="label-campo">Persona a Cargo</label>
                                                                <input type="text"
                                                                    id="edit-persona-{{ $t->id }}"
                                                                    class="input-inline" value="{{ $t->persona_cargo }}">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="label-campo">Próxima Mantención</label>
                                                                <input type="date"
                                                                    id="edit-proxima-{{ $t->id }}"
                                                                    class="input-inline"
                                                                    value="{{ $t->fecha_prox_man ? \Carbon\Carbon::parse($t->fecha_prox_man)->format('Y-m-d') : '' }}">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="label-campo">Descripción</label>
                                                                <textarea id="edit-desc-{{ $t->id }}" class="input-inline" rows="3" style="resize:none;">{{ $t->descripcion }}</textarea>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="label-campo">Documento (opcional)</label>
                                                                <input type="file" id="edit-doc-{{ $t->id }}"
                                                                    class="input-inline" style="padding:.2rem .4rem;">
                                                            </div>
                                                            <div class="d-flex gap-2 mt-2">
                                                                <button type="button"
                                                                    class="btn-cancelar-inline flex-fill"
                                                                    onclick="toggleEditTrabajo({{ $t->id }})">Cancelar</button>
                                                                <button type="button"
                                                                    class="btn-guardar-inline flex-fill"
                                                                    onclick="guardarEditTrabajo({{ $t->id }})">
                                                                    <i class="fas fa-save me-1"></i>Guardar
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-4"
                                            style="color:rgba(255,255,255,.4); font-size:.88rem;">
                                            <i class="fas fa-clipboard-list fa-2x mb-2 d-block" style="opacity:.35;"></i>
                                            Aún no hay trabajos registrados para esta propiedad
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                </div>{{-- /container-fluid --}}
            </div>
            @include('layouts.footer')
        </div>
    </div>

    {{-- Modal reasignar sección imagen --}}
    <div id="modal-reasignar"
        style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.6); z-index:9999; align-items:center; justify-content:center;">
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

    {{-- Loading overlay --}}
    <div id="loadingOverlay"
        style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5); z-index:99999; align-items:center; justify-content:center;">
        <div class="bg-white rounded p-4 shadow text-center" style="min-width:220px;">
            <div id="overlay-spinner" class="spinner-border text-dark mb-2" role="status"></div>
            <div id="overlay-icono" style="display:none;" class="mb-2"></div>
            <p id="overlay-texto" class="mb-0 fw-bold">Guardando cambios...</p>
        </div>
    </div>

    {{-- JSON imágenes --}}
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

@endsection
@section('javascript')
    @parent
    <script>
        // ════════════════════════════════════
        // VARIABLES GLOBALES (scope global para que las funciones externas al ready puedan accederlas)
        // ════════════════════════════════════
        var imagenesData = [];
        var secciones = [];
        var seccionActiva = 'todas';
        var imgReasignarId = null;
        var ordenAlfabetico = false;

        $(document).ready(function() {

            $(document).on('input', '#m_gastos_comunes, #m_valor_real', function() {
                var raw = $(this).val().replace(/[^0-9]/g, '');
                if (raw) $(this).val('$' + Number(raw).toLocaleString('es-CL'));
                else $(this).val('');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const ID_PROPIEDAD = {{ $detalles->id }};

            // ════════════════════════════════════
            // INICIALIZAR IMÁGENES DESDE PHP
            // ════════════════════════════════════
            try {
                var raw = document.getElementById('datos-imagenes-php');
                if (raw) imagenesData = JSON.parse(raw.textContent);
            } catch (e) {}

            imagenesData.forEach(function(img) {
                if (img.seccion && img.seccion !== '' && secciones.indexOf(img.seccion) === -1) {
                    secciones.push(img.seccion);
                }
            });

            $('#btn-orden-alfa').on('click', function() {
                ordenAlfabetico = !ordenAlfabetico;
                $(this).toggleClass('activo', ordenAlfabetico);
                renderMiniaturas();
            });

            renderTabs();
            renderMiniaturas();
            actualizarSelectores();

            // ════════════════════════════════════
            // TRABAJOS DE MANTENIMIENTO — AJAX
            // ════════════════════════════════════
            $('#btn_agregar_trabajo').on('click', function() {
                var tipo = $('#tipo_trabajo').val().trim();
                var fecha = $('#fecha_mantencion_nueva').val();
                var personaCargo = $('#persona_cargo_nueva').val().trim();
                var descripcion = $('#descripcion_trabajo_nueva').val().trim();
                var proxima = $('#proxima_mantencion_nueva').val();

                if (!tipo || !fecha || !descripcion) {
                    alert('Por favor completa al menos el Tipo, Fecha y Descripción.');
                    return;
                }

                var fd = new FormData();
                fd.append('id_propiedad', {{ $detalles->id }});
                fd.append('tipo_trabajo', tipo);
                fd.append('fecha_mantencion', fecha);
                fd.append('persona_cargo', personaCargo);
                fd.append('descripcion_trabajo', descripcion);
                fd.append('proxima_mantencion', proxima);

                var archivoFile = $('#archivo_trabajo')[0].files[0];
                if (archivoFile) fd.append('archivo_trabajo', archivoFile);

                var fotos = $('#fotos_trabajo')[0].files;
                for (var i = 0; i < fotos.length; i++) fd.append('fotos_trabajo[]', fotos[i]);

                var videos = $('#videos_trabajo')[0].files;
                for (var v = 0; v < videos.length; v++) fd.append('videos_trabajo[]', videos[v]);

                mostrarLoading(true);

                $.ajax({
                        url: '/guardarTrabajo',
                        type: 'POST',
                        data: fd,
                        processData: false,
                        contentType: false
                    })
                    .done(function() {
                        mostrarExito();
                        setTimeout(function() {
                            ocultarLoading();
                            location.reload();
                        }, 1500);
                    })
                    .fail(function(xhr) {
                        var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON
                            .message : 'Error al guardar el trabajo.';
                        mostrarError(msg);
                    });
            });

            // ════════════════════════════════════
            // ELIMINAR IMAGEN
            // ════════════════════════════════════
            $(document).on('click', '.delete-img', function(e) {
                e.preventDefault();
                var idImg = $(this).data('id');
                if (!confirm('¿Seguro/a que quieres eliminar la imagen?')) return;
                $.ajax({
                        url: '/imagen/' + idImg,
                        type: 'DELETE'
                    })
                    .done(function() {
                        imagenesData = imagenesData.filter(function(i) {
                            return i.id !== idImg;
                        });
                        renderTabs();
                        renderMiniaturas();
                    })
                    .fail(function() {
                        alert('Error al eliminar la imagen.');
                    });
            });

            // ════════════════════════════════════
            // PORTADA
            // ════════════════════════════════════
            $(document).on('click', '.portada', function(e) {
                e.preventDefault();
                var idImg = $(this).data('id');
                if (!confirm('¿Dejar esta imagen como portada?')) return;
                $.ajax({
                        url: '/portada/cambiar_img/' + idImg,
                        type: 'POST'
                    })
                    .done(function() {
                        alert('Portada cambiada correctamente');
                    })
                    .fail(function() {
                        alert('Error al cambiar la portada.');
                    });
            });

            // ════════════════════════════════════
            // ELIMINAR VIDEO
            // ════════════════════════════════════
            $(document).on('click', '.delete-video', function(e) {
                e.preventDefault();
                var idVideo = $(this).data('id');
                var $wrap = $(this).closest('.position-relative');
                if (!confirm('¿Seguro/a que quieres eliminar el video?')) return;
                $.ajax({
                        url: '/video/' + idVideo,
                        type: 'DELETE'
                    })
                    .done(function() {
                        $wrap.remove();
                    })
                    .fail(function() {
                        alert('Error al eliminar el video.');
                    });
            });

            // ════════════════════════════════════
            // ELIMINAR PROPIETARIO
            // ════════════════════════════════════
            $(document).on('click', '.delete-propietario', function(e) {
                e.preventDefault();
                var idPropietario = $(this).data('id');
                var $chip = $(this).closest('.chip-propietario');
                if (!confirm('¿Seguro/a que quieres eliminar este propietario?')) return;
                $.ajax({
                        url: '/propietarioDelete/' + idPropietario,
                        type: 'DELETE'
                    })
                    .done(function() {
                        $chip.remove();
                    })
                    .fail(function() {
                        alert('Error al eliminar el propietario.');
                    });
            });

            // ════════════════════════════════════
            // MODAL REASIGNAR
            // ════════════════════════════════════
            $(document).on('click', '.btn-reasignar', function() {
                imgReasignarId = $(this).data('id');
                $('#modal-preview-img').attr('src', $(this).data('src'));
                $('#modal-select-seccion').val($(this).data('sec') || '');
                $('#modal-reasignar').css('display', 'flex');
            });

            $('#modal-btn-cancelar').on('click', function() {
                $('#modal-reasignar').hide();
                imgReasignarId = null;
            });

            $('#modal-btn-confirmar').on('click', function() {
                if (imgReasignarId === null) return;
                var nuevaSeccion = $('#modal-select-seccion').val();
                var img = imagenesData.find(function(i) {
                    return i.id === imgReasignarId;
                });
                if (img) img.seccion = nuevaSeccion;
                $.ajax({
                    url: '/imagen/seccion/' + imgReasignarId,
                    type: 'POST',
                    data: {
                        seccion: nuevaSeccion,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#modal-reasignar').hide();
                imgReasignarId = null;
                renderTabs();
                renderMiniaturas();
            });

            // ════════════════════════════════════
            // RUT FORMAT
            // ════════════════════════════════════
            $(document).on('input', '#m_rut_arr', function() {
                let val = $(this).val().replace(/[^0-9kK]/g, '').toUpperCase();
                if (val.length > 1) val = val.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + val
                    .slice(-1);
                $(this).val(val);
            });

            // ════════════════════════════════════
            // CLICK MINIATURAS
            // ════════════════════════════════════
            $(document).on('click', '.miniatura-recorrido', function() {
                var src = $(this).data('src'),
                    sec = $(this).data('seccion') || '';
                $('#img-principal').attr('src', src);
                $('#img-principal-seccion').text(sec ? '📁 ' + sec : '');
                $('.miniatura-recorrido').css('border-color', 'transparent');
                $(this).css('border-color', '#fff');
            });

        });

        // ════════════════════════════════════
        // FUNCIONES DE IMÁGENES (scope global)
        // ════════════════════════════════════
        function getImagenesOrdenadas() {
            var lista = seccionActiva === 'todas' ?
                imagenesData.slice() :
                imagenesData.filter(function(i) {
                    return i.seccion === seccionActiva;
                });
            if (ordenAlfabetico) lista.sort(function(a, b) {
                return (a.seccion || '').localeCompare(b.seccion || '');
            });
            return lista;
        }

        function renderTabs() {
            var $tabs = $('#tabs-secciones');
            $tabs.empty();
            $tabs.append(
                $('<button type="button">')
                .addClass('tab-sec ' + (seccionActiva === 'todas' ? 'tab-sec-activo' : ''))
                .attr('data-sec', 'todas')
                .text('Todas (' + imagenesData.length + ')')
            );
            secciones.forEach(function(sec) {
                var count = imagenesData.filter(function(i) {
                    return i.seccion === sec;
                }).length;
                var $btn = $('<button type="button">')
                    .addClass('tab-sec d-flex align-items-center gap-1 ' + (seccionActiva === sec ?
                        'tab-sec-activo' : ''))
                    .attr('data-sec', sec)
                    .html(sec + ' <span class="badge bg-dark text-white ms-1" style="font-size:.65rem;">' + count +
                        '</span>');
                if (count === 0) {
                    $btn.append(
                        $('<i class="fas fa-times ms-1" style="font-size:.65rem; cursor:pointer;">').on('click',
                            function(e) {
                                e.stopPropagation();
                                secciones.splice(secciones.indexOf(sec), 1);
                                if (seccionActiva === sec) seccionActiva = 'todas';
                                renderTabs();
                                actualizarSelectores();
                            })
                    );
                }
                $tabs.append($btn);
            });
            $tabs.find('.tab-sec').on('click', function() {
                seccionActiva = $(this).data('sec');
                renderTabs();
                renderMiniaturas();
            });
        }

        function renderMiniaturas() {
            var $strip = $('#strip-miniaturas');
            $strip.empty();
            var lista = getImagenesOrdenadas();
            if (lista.length === 0) {
                $('#sin-imagenes-seccion').show();
                return;
            }
            $('#sin-imagenes-seccion').hide();

            lista.forEach(function(img) {
                var $wrap = $('<div class="position-relative flex-shrink-0">').css({
                    width: '85px'
                });

                var $img = $('<img>').addClass('rounded miniatura-recorrido')
                    .attr({
                        src: img.src,
                        'data-src': img.src,
                        'data-id': img.id,
                        'data-seccion': img.seccion
                    })
                    .css({
                        width: '85px',
                        height: '75px',
                        'object-fit': 'cover',
                        cursor: 'pointer',
                        border: '2px solid transparent',
                        borderRadius: '.4rem',
                        transition: 'border-color .2s'
                    });

                if (img.seccion) {
                    $wrap.append(
                        $('<span>').addClass('position-absolute badge bg-dark text-white')
                        .css({
                            bottom: '3px',
                            left: '3px',
                            'font-size': '.5rem',
                            'max-width': '75px',
                            overflow: 'hidden',
                            'text-overflow': 'ellipsis',
                            'white-space': 'nowrap'
                        })
                        .text(img.seccion)
                    );
                }

                var $bar = $('<div class="position-absolute d-flex gap-1">').css({
                    top: '3px',
                    right: '3px',
                    background: 'rgba(255,255,255,.88)',
                    'border-radius': '50px',
                    padding: '3px'
                });
                $bar.append($('<a href="javascript:void(0)">').attr('data-id', img.id).addClass(
                    'portada d-flex align-items-center').html(
                    '<i class="fas fa-check" style="color:green;font-size:.6rem;"></i>'));
                $bar.append($('<a href="javascript:void(0)">').addClass('btn-reasignar d-flex align-items-center')
                    .attr({
                        'data-id': img.id,
                        'data-src': img.src,
                        'data-sec': img.seccion || ''
                    }).html('<i class="fas fa-tag" style="color:#E67E22;font-size:.6rem;"></i>'));
                $bar.append($('<a href="javascript:void(0)">').attr('data-id', img.id).addClass(
                    'delete-img d-flex align-items-center').html(
                    '<i class="fas fa-trash-alt" style="color:red;font-size:.6rem;"></i>'));

                $wrap.append($img).append($bar);
                $strip.append($wrap);
            });

            if (lista.length > 0 && $('#img-principal').length) {
                $('#img-principal').attr('src', lista[0].src);
                $('#img-principal-seccion').text(lista[0].seccion ? '📁 ' + lista[0].seccion : '');
            }
        }

        function actualizarSelectores() {
            var $sel2 = $('#modal-select-seccion');
            $sel2.empty().append('<option value="">— Sin sección —</option>');
            secciones.forEach(function(sec) {
                $sel2.append($('<option>').val(sec).text(sec));
            });

            var $selSubir = $('#campo-seccion-subir');
            if ($selSubir.length) {
                $selSubir.empty().append('<option value="">— Sin sección —</option>');
                secciones.forEach(function(sec) {
                    $selSubir.append($('<option>').val(sec).text(sec));
                });
            }
        }

        // ════════════════════════════════════
        // PROPIETARIOS INLINE
        // ════════════════════════════════════
        var _propietariosNuevos = [];

        function agregarPropietarioInline() {
            var id = $('#m_propietario').val();
            var nombre = $('#m_propietario option:selected').text();
            if (!id || id === '0') return;
            _propietariosNuevos.push({
                id: id
            });
            alert('Propietario "' + nombre + '" será agregado al guardar.');
            $('#m_propietario').val('0');
        }

        // ════════════════════════════════════
        // TOGGLE INLINE EDIT
        // ════════════════════════════════════
        function toggleEdit(seccion) {
            var $view = $('#view-' + seccion);
            var $edit = $('#edit-' + seccion);
            var $btn = $('#btn-edit-' + seccion);
            var isEditing = $edit.is(':visible');
            if (isEditing) {
                cancelarEdit(seccion);
            } else {
                $view.hide();
                $edit.slideDown(180);
                $btn.html('<i class="fas fa-times"></i>').attr('title', 'Cancelar');
                $btn.css('background', 'rgba(255,255,255,.45)');
            }
        }

        function cancelarEdit(seccion) {
            $('#view-' + seccion).show();
            $('#edit-' + seccion).slideUp(180);
            var $btn = $('#btn-edit-' + seccion);
            $btn.html('<i class="fas fa-pen"></i>').attr('title', 'Editar');
            $btn.css('background', 'rgba(255,255,255,.2)');
            _propietariosNuevos = [];
        }

        // ════════════════════════════════════
        // FOTOS INLINE TOGGLE
        // ════════════════════════════════════
        function toggleEditFotos() {
            var $panel = $('#panel-fotos-inline');
            var $btn = $('#btn-edit-fotos');
            if ($panel.is(':visible')) {
                cancelarEditFotos();
            } else {
                $panel.slideDown(180);
                $btn.html('<i class="fas fa-times"></i>').attr('title', 'Cancelar').css('background',
                    'rgba(255,255,255,.45)');
                actualizarSelectores();
                bindDropAreaInline();

                // ── FIX: usar variable global secciones ──
                $('#btn-crear-seccion').off('click').on('click', function() {
                    var nombre = $('#nueva-seccion-input').val().trim();
                    if (!nombre) return;
                    if (secciones.indexOf(nombre) === -1) {
                        secciones.push(nombre);
                    }
                    $('#nueva-seccion-input').val('');
                    actualizarSelectores(); // actualiza selects
                    renderTabs(); // muestra el nuevo tab
                    renderMiniaturas(); // refresca strip
                });
            }
        }

        function cancelarEditFotos() {
            $('#panel-fotos-inline').slideUp(180);
            var $btn = $('#btn-edit-fotos');
            $btn.html('<i class="fas fa-pen"></i>').attr('title', 'Editar').css('background', 'rgba(255,255,255,.2)');
        }

        function bindDropAreaInline() {
            var dropArea = document.getElementById('drop-area');
            var fileInput = document.getElementById('imagenes');
            var preview = document.getElementById('preview');
            if (!dropArea || !fileInput) return;
            dropArea.onclick = function() {
                fileInput.click();
            };
            fileInput.onchange = function() {
                handleFilesInline(fileInput.files, preview);
            };
            dropArea.ondragover = function(e) {
                e.preventDefault();
                dropArea.style.background = 'rgba(0,0,0,.25)';
            };
            dropArea.ondragleave = function() {
                dropArea.style.background = '';
            };
            dropArea.ondrop = function(e) {
                e.preventDefault();
                dropArea.style.background = '';
                handleFilesInline(e.dataTransfer.files, preview);
            };
            var videoDrop = document.getElementById('video-drop-area');
            if (videoDrop) videoDrop.onclick = function() {
                document.getElementById('videos').click();
            };
        }

        function handleFilesInline(files, preview) {
            if (!preview) return;
            preview.innerHTML = '';
            Array.from(files).forEach(function(file) {
                if (file.type.startsWith('image/')) {
                    var reader = new FileReader();
                    reader.onload = function(ev) {
                        var img = document.createElement('img');
                        img.src = ev.target.result;
                        img.style.cssText = 'height:60px; width:80px; object-fit:cover; border-radius:.3rem;';
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // ════════════════════════════════════
        // GUARDAR SECCIÓN
        // ════════════════════════════════════
        function guardarSeccion(seccion) {
            var fd = new FormData();
            fd.append('id_propiedad', {{ $detalles->id }});
            fd.append('_seccion', seccion);

            if (seccion === 'arriendo') {
                fd.append('valor_arriendo', $('#m_valor_arriendo').val());
                fd.append('gastos_comunes', $('#m_gastos_comunes').val().replace(/[^0-9]/g, ''));
                fd.append('valor_real', $('#m_valor_real').val().replace(/[^0-9]/g, ''));
                fd.append('fecha_inicio', $('#m_fecha_inicio').val());
                fd.append('proximo_reajuste', $('#m_proximo_reajuste').val());

            } else if (seccion === 'propiedad') {
                fd.append('direccion', $('#m_direccion').val());
                fd.append('ciudad', $('#m_ciudad').val());
                fd.append('rol', $('#m_rol').val());
                fd.append('tipo_vivienda', $('#m_tipo_vivienda').val());
                fd.append('empresa_luz', $('#m_empresa_luz').val());
                fd.append('numero_luz', $('#m_numero_luz').val());
                fd.append('empresa_agua', $('#m_empresa_agua').val());
                fd.append('numero_agua', $('#m_numero_agua').val());
                fd.append('empresa_gas', $('#m_empresa_gas').val());
                fd.append('numero_gas', $('#m_numero_gas').val());
                fd.append('PropietariosAgregados', JSON.stringify(_propietariosNuevos));

            } else if (seccion === 'caracteristicas') {
                fd.append('dormitorios', $('#m_dormitorios').val());
                fd.append('banos', $('#m_banos').val());
                fd.append('mt2_total', $('#m_mt2').val());
                fd.append('estacionamiento', $('#m_est').val());
                fd.append('bodega', $('#m_bodega').val());
                fd.append('tipo_vivienda', $('#m_vivienda').val());
                fd.append('amoblado', $('#m_am_si').is(':checked') ? 'si' : 'no');
                fd.append('elementos_entregados', $('#m_elementos').val());
                fd.append('observaciones', $('#m_observaciones').val());

            } else if (seccion === 'arrendatario') {
                fd.append('nombre_arrendatario', $('#m_nombre_arr').val());
                fd.append('rut_arrendatario', $('#m_rut_arr').val());
                fd.append('telefono_arrendatario', $('#m_tel_arr').val());
                fd.append('correo_arrendatario', $('#m_correo_arr').val());
                fd.append('profesion_arrendatario', $('#m_prof_arr').val());
                fd.append('fecha_pago', $('#m_fecha_pago').val());
                var infoCliente = $('#m_info_cliente')[0].files[0];
                if (infoCliente) fd.append('info_cliente', infoCliente);
                var docs = $('#m_docs_arr')[0].files;
                for (var j = 0; j < docs.length; j++) fd.append('documentos_arrendatario[]', docs[j]);

            } else if (seccion === 'fotos') {
                fd.append('imagenes_seccion', $('#campo-seccion-subir').val());
                var imgFiles = $('#imagenes')[0] ? $('#imagenes')[0].files : [];
                for (var i = 0; i < imgFiles.length; i++) fd.append('imagenes[]', imgFiles[i]);
                var videoFile = $('#videos')[0] ? $('#videos')[0].files[0] : null;
                if (videoFile) fd.append('videos', videoFile);
            }

            mostrarLoading(true);

            $.ajax({
                    url: seccion === 'arriendo' ? '/editarArriendoAnoCorrido' : '/editarDetallesAnoCorrido',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false
                })
                .done(function(resp) {
                    mostrarExito();

                    // ── Actualizar DOM sin recargar ──
                    if (seccion === 'arriendo') {
                        var va = $('#m_valor_arriendo').val();
                        var gc = $('#m_gastos_comunes').val().replace(/[^0-9]/g, '');
                        var vr = $('#m_valor_real').val().replace(/[^0-9]/g, '');
                        var fi = $('#m_fecha_inicio').val();
                        var pr = $('#m_proximo_reajuste').val();
                        $('#disp-valor-arriendo').text('$' + Number(va).toLocaleString('es-CL'));
                        $('#disp-gastos-comunes').text('$' + Number(gc).toLocaleString('es-CL'));
                        $('#disp-valor-real').text('$' + Number(vr).toLocaleString('es-CL'));
                        $('#disp-fecha-inicio').text(fi || '—');
                        $('#disp-proximo-reajuste').text(pr || '—');

                    } else if (seccion === 'propiedad') {
                        $('#disp-direccion').text($('#m_direccion').val());
                        $('#disp-ciudad').text($('#m_ciudad').val());
                        $('#disp-rol').text($('#m_rol').val());
                        $('#disp-empresa-luz').text($('#m_empresa_luz').val() || '—');
                        $('#disp-numero-luz').text($('#m_numero_luz').val() || '—');
                        $('#disp-empresa-agua').text($('#m_empresa_agua').val() || '—');
                        $('#disp-numero-agua').text($('#m_numero_agua').val() || '—');
                        $('#disp-empresa-gas').text($('#m_empresa_gas').val() || '—');
                        $('#disp-numero-gas').text($('#m_numero_gas').val() || '—');

                    } else if (seccion === 'caracteristicas') {
                        $('#disp-dorm').text($('#m_dormitorios').val() || '—');
                        $('#disp-banos').text($('#m_banos').val() || '—');
                        $('#disp-mt2').text($('#m_mt2').val() || '—');
                        $('#disp-est').text($('#m_est').val() || '—');
                        $('#disp-bodega').text($('#m_bodega').val() || '—');
                        $('#disp-vivienda').text($('#m_vivienda').val() || '—');
                        var amoblado = $('#m_am_si').is(':checked');
                        $('#disp-amoblado').html(amoblado ?
                            '<span class="badge-si">SÍ</span>' :
                            '<span class="badge-no">NO</span>');
                        $('#disp-elementos').text($('#m_elementos').val() || '—');
                        var obs = $('#m_observaciones').val();
                        if (obs) {
                            if ($('#disp-obs-wrap').length) {
                                $('#disp-observaciones').text(obs);
                            } else {
                                $('#view-caracteristicas').append(
                                    '<div class="mt-2 p-2 rounded" id="disp-obs-wrap" style="background:rgba(0,0,0,.2); font-size:.83rem; color:#fff;">' +
                                    '<i class="fas fa-comment-dots me-1" style="opacity:.7;"></i>' +
                                    '<span id="disp-observaciones">' + obs + '</span></div>'
                                );
                            }
                        }

                    } else if (seccion === 'arrendatario') {
                        $('#disp-arr-nombre').text($('#m_nombre_arr').val() || '—');
                        $('#disp-arr-rut').text($('#m_rut_arr').val() || '—');
                        $('#disp-arr-tel').text($('#m_tel_arr').val() || '—');
                        $('#disp-arr-correo').text($('#m_correo_arr').val() || '—');
                        $('#disp-arr-prof').text($('#m_prof_arr').val() || '—');
                        var dia = $('#m_fecha_pago').val();
                        $('#disp-arr-pago').text(dia ? 'Día ' + dia : '—');

                    } else if (seccion === 'fotos') {
                        // Recargar para ver las imágenes nuevas en el strip
                        setTimeout(function() {
                            location.reload();
                        }, 1200);
                        return;
                    }

                    if (seccion === 'fotos') {
                        cancelarEditFotos();
                    } else {
                        cancelarEdit(seccion);
                    }

                    setTimeout(function() {
                        ocultarLoading();
                    }, 1500);
                })
                .fail(function(xhr) {
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message :
                        'Error al guardar.';
                    mostrarError(msg);
                });
        }

        // ════════════════════════════════════
        // LOADING HELPERS
        // ════════════════════════════════════
        function mostrarLoading() {
            $('#loadingOverlay').css('display', 'flex');
            $('#overlay-spinner').show();
            $('#overlay-icono').hide();
            $('#overlay-texto').text('Guardando cambios...');
        }

        function mostrarExito() {
            $('#overlay-spinner').hide();
            $('#overlay-icono').html('<i class="fas fa-check-circle fa-3x text-success"></i>').show();
            $('#overlay-texto').text('¡Cambios guardados correctamente!');
        }

        function mostrarError(msg) {
            $('#overlay-spinner').hide();
            $('#overlay-icono').html('<i class="fas fa-times-circle fa-3x text-danger"></i>').show();
            $('#overlay-texto').text(msg);
            setTimeout(function() {
                ocultarLoading();
            }, 3000);
        }

        function ocultarLoading() {
            $('#loadingOverlay').hide();
            $('#overlay-spinner').show();
            $('#overlay-icono').html('').hide();
            $('#overlay-texto').text('Guardando cambios...');
        }

        // ════════════════════════════════════
        // CONFIRMAR ELIMINAR
        // ════════════════════════════════════
        function confirmarEliminar(seccion) {
            var nombres = {
                arriendo: 'Resumen del Arriendo',
                propiedad: 'Detalle de la Propiedad',
                caracteristicas: 'Características',
                arrendatario: 'datos del Arrendatario'
            };
            if (confirm('¿Seguro/a que deseas eliminar ' + (nombres[seccion] || seccion) +
                    '? Esta acción no se puede deshacer.')) {
                alert('Función de eliminación pendiente de implementar en el backend para: ' + seccion);
            }
        }

        function handleVideoDrop(event) {
            event.preventDefault();
            var files = event.dataTransfer.files;
            var videoInput = document.getElementById('videos');
            if (files.length && files[0].type.startsWith('video/')) {
                videoInput.files = files;
                alert('Video listo: ' + files[0].name);
            } else {
                alert('Por favor, sube un archivo de video válido.');
            }
        }

        // ════════════════════════════════════
        // TRABAJOS — TOGGLE EDIT
        // ════════════════════════════════════
        function toggleEditTrabajo(id) {
            var $view = $('#view-trabajo-' + id);
            var $edit = $('#edit-trabajo-' + id);
            if ($edit.is(':visible')) {
                $edit.slideUp(180);
                $view.slideDown(180);
            } else {
                $view.hide();
                $edit.slideDown(180);
            }
        }

        // ════════════════════════════════════
        // TRABAJOS — GUARDAR EDICIÓN
        // ════════════════════════════════════
        function guardarEditTrabajo(id) {
            var fd = new FormData();
            fd.append('nombre', $('#edit-tipo-' + id).val());
            fd.append('descripcion', $('#edit-desc-' + id).val());
            fd.append('fecha', $('#edit-fecha-' + id).val());
            fd.append('proxima_fecha', $('#edit-proxima-' + id).val());
            fd.append('persona_cargo', $('#edit-persona-' + id).val());

            var docFile = $('#edit-doc-' + id)[0].files[0];
            if (docFile) fd.append('doc', docFile);

            mostrarLoading(true);

            $.ajax({
                    url: '/guardar/mantenimiento-editar/' + id,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false
                })
                .done(function() {
                    mostrarExito();
                    setTimeout(function() {
                        ocultarLoading();
                        location.reload();
                    }, 1500);
                })
                .fail(function(xhr) {
                    var msg = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message : 'Error al guardar.';
                    mostrarError(msg);
                });
        }

        // ════════════════════════════════════
        // TRABAJOS — ELIMINAR
        // ════════════════════════════════════
        function eliminarTrabajo(id) {
            if (!confirm('¿Seguro/a que deseas eliminar este trabajo? Esta acción no se puede deshacer.')) return;

            mostrarLoading(true);

            $.ajax({
                    url: '/mantencion/' + id,
                    type: 'DELETE'
                })
                .done(function() {
                    mostrarExito();
                    setTimeout(function() {
                        ocultarLoading();
                        $('#card-trabajo-' + id).fadeOut(300, function() {
                            $(this).remove();
                        });
                    }, 1000);
                })
                .fail(function() {
                    mostrarError('Error al eliminar el trabajo.');
                });
        }
    </script>
@endsection
@section('css')
    @parent
    <style>
        :root {
            --naranja: #E67E22;
            --naranja-claro: #fce8d5;
            --negro: #1a1a1a;
            --fondo: #f7f3ee;
            --card-bg: #fff;
            --borde: #e8e0d5;
            --radio: .9rem;
        }

/* ── WRAPPER SECCIÓN ── */
.card-seccion {
    background-color: var(--naranja);
    border-radius: var(--radio);
    overflow: hidden;
    min-width: 0;
}
.card-seccion-body {
    min-width: 0;
}
.card-seccion-compacta .card-seccion-body {
    padding: .75rem .9rem;
    min-height: 1px;
}
.card-seccion-compacta {
    max-width: none;
    width: 100%;
}

        /* ── HEADER ── */
        .card-seccion-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #000;
            color: #fff;
            font-weight: bold;
            font-size: .95rem;
            padding: .65rem 1rem;
            letter-spacing: .3px;
        }

        /* ── BODY ── */
        .card-seccion-body {
            background-color: rgba(255, 255, 255, .12);
            border-radius: 0 0 var(--radio) var(--radio);
            padding: 1rem 1.1rem;
        }

        #strip-miniaturas::-webkit-scrollbar {
            width: 4px;
        }

        #strip-miniaturas::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .3);
            border-radius: 10px;
        }

        /* ── BOTONES ACCIÓN ── */
        .btns-accion {
            display: flex;
            gap: .4rem;
        }

        .btn-edit,
        .btn-del {
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: .75rem;
            transition: transform .15s, background .15s;
        }

        .btn-edit {
            background: rgba(255, 255, 255, .2);
            color: #fff;
        }

        .btn-del {
            background: rgba(220, 50, 50, .35);
            color: #ffe5e5;
        }

        .btn-edit:hover {
            background: rgba(255, 255, 255, .4);
            transform: scale(1.1);
        }

        .btn-del:hover {
            background: rgba(220, 50, 50, .6);
            transform: scale(1.1);
        }

        /* ── LABELS ── */
        .label-campo {
            color: #fff;
            font-size: .8rem;
            font-weight: bold;
            white-space: nowrap;
            flex-shrink: 0;
        }

        /* ── FILAS DATO/EDICIÓN ── */
        .fila-dato {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            padding: .3rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, .2);
            font-size: .87rem;
            gap: .5rem;
        }

        .fila-dato:last-child {
            border-bottom: none;
        }

        .fila-edit {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .3rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, .2);
            font-size: .87rem;
            gap: .6rem;
        }

        .fila-edit:last-child {
            border-bottom: none;
        }

        /* ── VALORES ── */
        .valor-dato {
            color: #fff;
            font-weight: 600;
            text-align: right;
        }

        .valor-dato-lg {
            color: #fff;
            font-weight: 600;
            font-size: .9rem;
            margin: 0;
        }

        .valor-dato.resaltado {
            font-size: 1.1rem;
            font-weight: 800;
        }

        /* ── INPUTS ── */
        .input-inline {
            border: none;
            border-radius: .5rem;
            background: #fff;
            color: var(--negro);
            font-weight: 600;
            font-size: .85rem;
            padding: .3rem .6rem;
            width: 100%;
            outline: none;
            min-height: 34px;
            transition: box-shadow .15s;
        }

        .input-inline:focus {
            box-shadow: 0 0 0 2px #000;
        }

        .input-inline.resaltado {
            font-size: 1rem;
            font-weight: 800;
        }

        select.input-inline {
            cursor: pointer;
        }

        textarea.input-inline {
            resize: none;
        }

        /* ── BOTONES GUARDAR/CANCELAR ── */
        .btn-guardar-inline {
            background: #000;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: .35rem 1.1rem;
            font-weight: 700;
            font-size: .83rem;
            cursor: pointer;
            transition: opacity .15s;
            display: inline-flex;
            align-items: center;
            gap: .3rem;
        }

        .btn-guardar-inline:hover {
            opacity: .8;
        }

        .btn-cancelar-inline {
            background: rgba(255, 255, 255, .2);
            color: #fff;
            border: 1.5px solid rgba(255, 255, 255, .4);
            border-radius: 50px;
            padding: .35rem 1rem;
            font-size: .83rem;
            cursor: pointer;
        }

        .btn-cancelar-inline:hover {
            background: rgba(255, 255, 255, .35);
        }

        /* ── GRUPOS DATOS ── */
        .grupo-datos {
            background: rgba(0, 0, 0, .15);
            border-radius: .5rem;
            padding: .7rem .9rem;
            margin-bottom: .5rem;
        }

        .grupo-titulo {
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: #fff;
            margin-bottom: .4rem;
        }

        /* ── CHIPS NUMÉRICOS ── */
        .chip-num {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, .2);
            border: 1.5px solid rgba(255, 255, 255, .3);
            border-radius: .5rem;
            padding: .4rem .6rem;
            min-width: 58px;
            font-size: .75rem;
            color: #fff;
        }

        .chip-num i {
            color: #fff;
            font-size: .85rem;
            margin-bottom: 2px;
            opacity: .8;
        }

        .chip-num span {
            font-weight: 700;
            font-size: 1rem;
            line-height: 1;
        }

        .chip-num small {
            color: rgba(255, 255, 255, .7);
            font-size: .68rem;
        }

        .chip-propietario {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            background: rgba(0, 0, 0, .2);
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 50px;
            padding: .2rem .7rem;
            font-size: .8rem;
            color: #fff;
        }

        .badge-si {
            background: rgba(0, 0, 0, .3);
            color: #a8f0c6;
            font-size: .78rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 50px;
        }

        .badge-no {
            background: rgba(0, 0, 0, .3);
            color: #f9a8a8;
            font-size: .78rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 50px;
        }

        /* ── TABS IMÁGENES ── */
        .tab-sec {
            background: rgba(0, 0, 0, .2);
            border: 1.5px solid rgba(255, 255, 255, .3);
            border-radius: 50px;
            padding: 2px 10px;
            font-size: .75rem;
            color: #fff;
            cursor: pointer;
            transition: all .15s;
        }

        .tab-sec:hover {
            background: rgba(0, 0, 0, .35);
        }

        .tab-sec-activo {
            background: #000;
            border-color: #000;
            color: #fff !important;
            font-weight: 700;
        }

        /* ── BADGE SECCIÓN IMG ── */
        .badge-seccion-img {
            position: absolute;
            bottom: 8px;
            left: 8px;
            background: rgba(0, 0, 0, .65);
            color: #fff;
            font-size: .72rem;
            padding: 2px 8px;
            border-radius: 50px;
        }

        .img-video-overlay {
            position: absolute;
            right: 10px;
            bottom: 10px;
            width: 180px;
            max-width: 38%;
            border-radius: .9rem;
            overflow: hidden;
            box-shadow: 0 18px 32px rgba(0, 0, 0, .35);
            background: #000;
            z-index: 4;
        }

        .img-video-overlay video {
            width: 100%;
            height: auto;
            display: block;
        }

        .img-video-overlay .btn-eliminar-flotante {
            position: absolute;
            top: 8px;
            right: 8px;
            padding: 7px 9px;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, .65);
            color: #fff;
            text-decoration: none;
        }

        .sin-imagen {
            height: 180px;
            background: rgba(0, 0, 0, .15);
            border-radius: .5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, .5);
        }

        .miniatura-recorrido:hover {
            border-color: #fff !important;
            opacity: .9;
        }

        #strip-miniaturas::-webkit-scrollbar {
            height: 4px;
        }

        #strip-miniaturas::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .3);
            border-radius: 10px;
        }

        /* ── BADGE ORDEN ── */
        .badge-orden {
            font-size: .72rem;
            background: rgba(0, 0, 0, .2);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, .3);
            border-radius: 50px;
            padding: 2px 9px;
            cursor: pointer;
            transition: background .15s;
            user-select: none;
        }

        .badge-orden:hover,
        .badge-orden.activo {
            background: rgba(0, 0, 0, .45);
        }

        /* ── BOTÓN ARCHIVO ── */
        .btn-archivo {
            background: rgba(0, 0, 0, .2);
            border: 1.5px solid rgba(255, 255, 255, .35);
            color: #fff;
            border-radius: 50px;
            padding: .3rem .9rem;
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .15s;
        }

        .btn-archivo:hover {
            background: rgba(0, 0, 0, .4);
        }

        /* ── BOTÓN ELIMINAR FLOTANTE ── */
        .btn-eliminar-flotante {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, .85);
            color: #c0392b;
            padding: 7px 9px;
            border-radius: .4rem;
            font-size: .85rem;
        }

        /* ── DROP AREA ── */
        .drop-area-inline {
            border: 2px dashed rgba(255, 255, 255, .5);
            border-radius: .5rem;
            padding: .8rem;
            text-align: center;
            color: rgba(255, 255, 255, .8);
            font-size: .83rem;
            cursor: pointer;
            min-height: 70px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: background .15s;
        }

        .drop-area-inline:hover {
            background: rgba(0, 0, 0, .15);
        }

        /* ── PANEL FOTOS ── */
        #panel-fotos-inline {
            border: 1.5px dashed rgba(255, 255, 255, .4);
            border-radius: .5rem;
            background: rgba(0, 0, 0, .1);
            padding: 1rem;
            margin-top: .75rem;
        }

        /* ── MANTENIMIENTO FORM ── */
        .label-mantenimiento {
            font-size: .85rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 5px;
            display: block;
        }

        .input-mantenimiento {
            border: none;
            border-radius: .5rem;
            background: #fff;
            color: var(--negro);
            font-weight: 600;
            font-size: .85rem;
            padding: .3rem .6rem;
            width: 100%;
            min-height: 36px;
            outline: none;
        }

        .input-mantenimiento:focus {
            box-shadow: 0 0 0 2px #000;
        }

        textarea.input-mantenimiento {
            resize: none;
            min-height: 150px;
        }

        .archivo-mantenimiento {
            background: #fff;
            color: var(--negro);
            border: none;
            border-radius: .5rem;
            font-size: .83rem;
            width: 100%;
        }

        /* ── CARDS TRABAJOS ── */
        .card-trabajo {
            background: rgba(0, 0, 0, .2);
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: .75rem;
            padding: 1rem;
            height: 100%;
            transition: background .15s;
        }

        .card-trabajo:hover {
            background: rgba(0, 0, 0, .3);
        }

        .trabajo-tipo-badge {
            background: #000;
            color: #fff;
            border-radius: 50px;
            padding: 3px 12px;
            font-size: .78rem;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 60%;
        }

        .trabajo-fecha {
            font-size: .75rem;
            color: rgba(255, 255, 255, .7);
            white-space: nowrap;
        }

        .trabajo-descripcion {
            font-size: .83rem;
            color: #fff;
            margin-bottom: .6rem;
            line-height: 1.5;
        }

        .trabajo-adjunto {
            background: rgba(0, 0, 0, .3);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 50px;
            padding: 2px 10px;
            font-size: .73rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }

        .trabajo-adjunto:hover {
            background: rgba(0, 0, 0, .5);
            color: #fff;
        }

        /* ── LOADING ── */
        #loadingOverlay {
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection
