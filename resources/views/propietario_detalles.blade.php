@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="background-color:rgb(255,255,255)">
        <div class="row">
            @include('layouts.sidebar')
            <div class="col">
                <div class="container-fluid">

                    {{-- Encabezado --}}
                    <div class="row mt-4 mb-3">
                        <div class="col-12 d-flex align-items-center gap-3">
                            <a href="/propietarios" class="btn btn-secondary rounded-pill">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                            <h2 class="text-uppercase mb-0">{{ $propietario->nombre }}</h2>
                        </div>
                    </div>

                    {{-- Filtro por tipo de propiedad --}}
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex gap-2 flex-wrap align-items-center">
                                <button class="btn btn-primary filtro-btn active" data-tipo="todos">Todas</button>
                                <button class="btn btn-outline-primary filtro-btn" data-tipo="1">Marzo a Diciembre</button>
                                <button class="btn btn-outline-primary filtro-btn" data-tipo="3">Año Corrido</button>
                                <button class="btn btn-outline-primary filtro-btn" data-tipo="2">Venta</button>
                                <button class="btn btn-outline-primary filtro-btn" data-tipo="4">Verano</button>

                                <div class="ms-auto">
                                    <button class="btn btn-success btn-agregar-tipo" id="btn-agregar-todos"
                                        data-bs-toggle="modal" data-bs-target="#modalSeleccionarTipo">
                                        <i class="fas fa-plus"></i> Agregar Propiedad
                                    </button>
                                    <button class="btn btn-success btn-agregar-tipo d-none" id="btn-agregar-1"
                                        data-bs-toggle="modal" data-bs-target="#modalMarzodiciembre">
                                        <i class="fas fa-plus"></i> Agregar Marzo a Dic.
                                    </button>
                                    <button class="btn btn-success btn-agregar-tipo d-none" id="btn-agregar-3"
                                        data-bs-toggle="modal" data-bs-target="#modalAnoCorrido">
                                        <i class="fas fa-plus"></i> Agregar Año Corrido
                                    </button>
                                    <button class="btn btn-success btn-agregar-tipo d-none" id="btn-agregar-2"
                                        data-bs-toggle="modal" data-bs-target="#modalVenta">
                                        <i class="fas fa-plus"></i> Agregar Venta
                                    </button>
                                    <button class="btn btn-success btn-agregar-tipo d-none" id="btn-agregar-4"
                                        data-bs-toggle="modal" data-bs-target="#modalVerano">
                                        <i class="fas fa-plus"></i> Agregar Verano
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tarjetas de propiedades --}}
                    <div class="row" id="contenedor-propiedades">
                        @forelse($propiedades as $propiedad)
                            @php
                                if ($propiedad->tipo_propiedad == 4) {
                                    $detalle = $propiedad->detallesVeranos->first();
                                    $imagen = $detalle && $detalle->imagenes ? $detalle->imagenes->first() : null;
                                    $precio = null;
                                } else {
                                    $imagen = $propiedad->imagenes ? $propiedad->imagenes->first() : null;
                                    $precio = $propiedad->precios ? $propiedad->precios->first() : null;
                                }

                                if ($propiedad->tipo_propiedad == 1) {
                                    $url = '/propiedadesDetalles-' . $propiedad->id;
                                    $badge = 'Marzo a Dic.';
                                    $badgeColor = 'bg-primary';
                                } elseif ($propiedad->tipo_propiedad == 3) {
                                    $url = '/proanocorridopropiedadesDetalles-' . $propiedad->id;
                                    $badge = 'Año Corrido';
                                    $badgeColor = 'bg-success';
                                } elseif ($propiedad->tipo_propiedad == 2) {
                                    $url = '/propiedadesVentaDetalles-' . $propiedad->id;
                                    $badge = 'Venta';
                                    $badgeColor = 'bg-warning text-dark';
                                } elseif ($propiedad->tipo_propiedad == 4) {
                                    $url = '/propiedadesVeranoDetalles-' . $propiedad->id;
                                    $badge = 'Verano';
                                    $badgeColor = 'bg-info text-dark';
                                } else {
                                    $url = '#';
                                    $badge = 'Otro';
                                    $badgeColor = 'bg-secondary';
                                }
                            @endphp

                            <div class="col-lg-3 col-md-4 mb-4 tarjeta-propiedad"
                                data-tipo="{{ $propiedad->tipo_propiedad }}">
                                <a href="{{ $url }}" style="text-decoration:none; color:#000;">
                                    <div class="card shadow position-relative" style="border:none;">
                                        <div class="position-absolute top-0 end-0 m-2" style="z-index:1000;"
                                            >
                                            <button type="button" class="btn btn-danger btn-sm btn-eliminar-propiedad" onclick="event.preventDefault(); event.stopPropagation();"
                                                data-id="{{ $propiedad->id }}" title="Eliminar propiedad">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        @if ($imagen)
                                            <img src="{{ asset($imagen->link) }}" class="card-img-top"
                                                style="height:200px; object-fit:cover;">
                                        @else
                                            <img src="{{ asset('img/OIP.jpg') }}" class="card-img-top"
                                                style="height:200px; object-fit:cover;">
                                        @endif
                                        <span
                                            class="position-absolute top-0 start-0 m-2 badge {{ $badgeColor }}">{{ $badge }}</span>
                                        <div class="position-absolute bottom-0 start-0 w-100 text-white p-2"
                                            style="background:rgba(0,0,0,0.5); font-size:12px;">
                                            <strong>{{ $propiedad->condominio }}</strong><br>
                                            {{ $propiedad->direccion }}<br>
                                            N° {{ $propiedad->num_torre }}
                                            @if ($precio)
                                                <br>
                                                @if ($propiedad->tipo_propiedad == 2)
                                                    Precio:
                                                    ${{ number_format((float) str_replace('.', '', $precio->venta), 0, ',', '.') }}
                                                @elseif($propiedad->tipo_propiedad == 3)
                                                    Año corrido:
                                                    ${{ number_format((float) str_replace('.', '', $precio->ano_corrido), 0, ',', '.') }}
                                                @elseif($propiedad->tipo_propiedad == 1)
                                                    Diciembre:
                                                    ${{ number_format((float) str_replace('.', '', $precio->diciembre), 0, ',', '.') }}
                                                @endif
                                            @endif
                                            @if ($propiedad->tipo_propiedad == 4)
                                                @php
                                                    $ene_min = (float) str_replace(
                                                        '.',
                                                        '',
                                                        $propiedad->precio_min_enero,
                                                    );
                                                    $ene_max = (float) str_replace(
                                                        '.',
                                                        '',
                                                        $propiedad->precio_max_enero,
                                                    );
                                                    $feb_min = (float) str_replace(
                                                        '.',
                                                        '',
                                                        $propiedad->precio_min_febrero,
                                                    );
                                                    $feb_max = (float) str_replace(
                                                        '.',
                                                        '',
                                                        $propiedad->precio_max_febrero,
                                                    );
                                                @endphp
                                                <br>
                                                Enero: ${{ number_format($ene_min, 0, ',', '.') }} -
                                                ${{ number_format($ene_max, 0, ',', '.') }}<br>
                                                Febrero: ${{ number_format($feb_min, 0, ',', '.') }} -
                                                ${{ number_format($feb_max, 0, ',', '.') }}
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">Este propietario no tiene propiedades asociadas.</div>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ===================== MODAL SELECTOR ===================== --}}
    <div class="modal fade" id="modalSeleccionarTipo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#FFE2B2;">
                    <h5 class="modal-title fw-bold">¿Qué tipo de propiedad deseas agregar?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-grid gap-3">
                        <button class="btn btn-primary btn-lg" data-bs-dismiss="modal" data-bs-toggle="modal"
                            data-bs-target="#modalMarzodiciembre">
                            <i class="fas fa-home me-2"></i> Marzo a Diciembre
                        </button>
                        <button class="btn btn-success btn-lg" data-bs-dismiss="modal" data-bs-toggle="modal"
                            data-bs-target="#modalAnoCorrido">
                            <i class="fas fa-calendar me-2"></i> Año Corrido
                        </button>
                        <button class="btn btn-warning btn-lg" data-bs-dismiss="modal" data-bs-toggle="modal"
                            data-bs-target="#modalVenta">
                            <i class="fas fa-tag me-2"></i> Venta
                        </button>
                        <button class="btn btn-info btn-lg text-dark" data-bs-dismiss="modal" data-bs-toggle="modal"
                            data-bs-target="#modalVerano">
                            <i class="fas fa-umbrella-beach me-2"></i> Verano
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== MODAL MARZO A DICIEMBRE ===================== --}}
    <div class="modal fade" id="modalMarzodiciembre" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-color:rgb(255,215,151); justify-content:center; position:relative;">
                    <h5 class="modal-title text-uppercase">Agregar Propiedad Marzo a Diciembre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="position:absolute;right:10px;top:10px;"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-3 p-4 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-4 bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white text-center">Detalles de la Propiedad</h5>
                                </div>
                            </div>
                            <div class="form-group col-lg-4 mt-3">
                                <label><b>Precio Marzo a Diciembre</b></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="md_diciembre"
                                        placeholder="Ej: 380.000" oninput="formatearMiles(this)">
                                    <span class="input-group-text fw-bold">CLP</span>
                                </div>
                            </div>
                            <div class="form-group col-lg-4 mt-3">
                                <label><b>Dirección</b></label>
                                <input type="text" class="form-control" id="md_direccion"
                                    placeholder="Ej: Calle #123">
                            </div>
                            <div class="form-group col-lg-4 mt-3">
                                <label><b>Ciudad</b></label>
                                <input type="text" class="form-control" id="md_ciudad"
                                    placeholder="Nombre de la ciudad">
                            </div>
                            <div class="form-group col-lg-4 mt-2">
                                <label><b>Condominio</b></label>
                                <input type="text" class="form-control" id="md_condominio"
                                    placeholder="Nombre del condominio">
                            </div>
                            <div class="form-group col-lg-4 mt-2">
                                <label><b>Torre</b></label>
                                <input type="text" class="form-control" id="md_torre"
                                    placeholder="Nombre de la torre">
                            </div>
                            <div class="form-group col-lg-4 mt-2">
                                <label><b>N° Departamento</b></label>
                                <input type="text" class="form-control" id="md_num_torre" placeholder="Número">
                            </div>
                            <div class="form-group col-lg-4 mt-2">
                                <label><b>Rol</b></label>
                                <input type="text" class="form-control" id="md_rol" placeholder="Ej: 123-456">
                            </div>
                            <div class="form-group col-lg-4 mt-2">
                                <label><b>Estado Vivienda</b></label>
                                <select class="form-select" id="md_estado">
                                    <option value="" disabled selected>Seleccione</option>
                                    <option value="Amoblada">Amoblada</option>
                                    <option value="Sin Amoblar">Sin Amoblar</option>
                                    <option value="SemiAmoblado">SemiAmoblado</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4 mt-2">
                                <label><b>Tipo Inmueble</b></label>
                                <select class="form-select" id="md_tipo">
                                    <option value="" disabled selected>Seleccione</option>
                                    <option value="Casa">Casa</option>
                                    <option value="Departamento">Departamento</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12 mt-2">
                                <label><b>Descripción</b></label>
                                <textarea class="form-control" id="md_descripcion" placeholder="Descripción de la propiedad"></textarea>
                            </div>
                            <div class="form-group col-lg-4 mt-2">
                                <label><b>Ruta de Maps</b></label>
                                <input type="text" class="form-control" id="md_ruta" placeholder="<iframe src=...">
                            </div>
                        </div>

                        <div class="row mb-3 p-4 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-4 bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white text-center">Servicios Básicos</h5>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 mt-2"><label><b>Empresa Luz</b></label><input type="text"
                                    class="form-control" id="md_empresa_luz" placeholder="Ej: CGE"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>N° Luz</b></label><input type="text"
                                    class="form-control" id="md_numero_luz" placeholder="Ej: 1728191"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>Empresa Agua</b></label><input type="text"
                                    class="form-control" id="md_empresa_agua" placeholder="Ej: Aguas del Valle"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>N° Agua</b></label><input type="text"
                                    class="form-control" id="md_numero_agua" placeholder="Ej: 1010101-0"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>Empresa Gas</b></label><input type="text"
                                    class="form-control" id="md_empresa_gas" placeholder="Ej: GASCO"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>N° Gas</b></label><input type="text"
                                    class="form-control" id="md_numero_gas" placeholder="Ej: 17281727"></div>
                        </div>

                        <div class="row mb-3 p-4 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-4 bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white text-center">Detalles Adicionales</h5>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 text-center mt-2">
                                <label><b>¿Tiene Estacionamiento?</b></label>
                                <div class="mt-1">
                                    <input type="radio" name="md_estCheck" id="md_estSi" value="si">
                                    <label for="md_estSi">Sí</label>
                                    <input type="radio" name="md_estCheck" id="md_estNo" value="no">
                                    <label for="md_estNo">No</label>
                                </div>
                                <div id="md_camposEst" class="mt-2" style="display:none;">
                                    <div class="row bg-white m-1 p-2" style="border-radius:.9rem;">
                                        <div class="col-lg-4"><label><b>Monto</b></label><input type="text"
                                                class="form-control" id="md_monto_est"></div>
                                        <div class="col-lg-4"><label><b>Rol</b></label><input type="text"
                                                class="form-control" id="md_rol_est"></div>
                                        <div class="col-lg-4"><label><b>N° Estac.</b></label><input type="text"
                                                class="form-control" id="md_num_est"></div>
                                        <div class="col-lg-12 text-center mt-2">
                                            <label><b>¿Techado?</b></label>
                                            <div>
                                                <input type="radio" name="md_techadoCheck" id="md_techadoSi"
                                                    value="1"><label for="md_techadoSi">Sí</label>
                                                <input type="radio" name="md_techadoCheck" id="md_techadoNo"
                                                    value="0"><label for="md_techadoNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 text-center mt-2">
                                <label><b>¿Tiene Bodega?</b></label>
                                <div class="mt-1">
                                    <input type="radio" name="md_bodCheck" id="md_bodSi" value="si"><label
                                        for="md_bodSi">Sí</label>
                                    <input type="radio" name="md_bodCheck" id="md_bodNo" value="no"><label
                                        for="md_bodNo">No</label>
                                </div>
                                <div id="md_camposBod" class="mt-2" style="display:none;">
                                    <div class="row bg-white m-1 p-2" style="border-radius:.9rem;">
                                        <div class="col-lg-4"><label><b>Monto</b></label><input type="text"
                                                class="form-control" id="md_monto_bod"></div>
                                        <div class="col-lg-4"><label><b>Rol</b></label><input type="text"
                                                class="form-control" id="md_rol_bod"></div>
                                        <div class="col-lg-4"><label><b>N° Bodega</b></label><input type="text"
                                                class="form-control" id="md_num_bod"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row p-4 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-6 mt-2"><label><b>Imágenes</b></label><input type="file"
                                    class="form-control" id="md_imagenes" multiple></div>
                            <div class="col-lg-6 mt-2"><label><b>Video</b></label><input type="file"
                                    class="form-control" id="md_video" accept="video/*"></div>
                            <div class="col-lg-12 mt-2"><label><b>Documentos</b></label><input type="file"
                                    class="form-control" id="md_archivos" accept=".pdf,.doc,.docx" multiple></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background-color:rgb(255,215,151);">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn_guardar_marzodiciembre">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== MODAL AÑO CORRIDO ===================== --}}
    <div class="modal fade" id="modalAnoCorrido" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-color:rgb(255,215,151); justify-content:center; position:relative;">
                    <h5 class="modal-title text-uppercase">Agregar Propiedad Año Corrido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="position:absolute;right:10px;top:10px;"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-3 p-4 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-4 bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white text-center">Detalles de la Propiedad</h5>
                                </div>
                            </div>
                            <div class="form-group col-lg-4 mt-3"><label><b>Precio Año Corrido</b></label>
                                <div class="input-group"><input type="text" class="form-control" id="ac_ano_corrido"
                                        placeholder="Ej: 380.000" oninput="formatearMiles(this)"><span
                                        class="input-group-text fw-bold">CLP</span></div>
                            </div>
                            <div class="form-group col-lg-4 mt-3"><label><b>Dirección</b></label><input type="text"
                                    class="form-control" id="ac_direccion"></div>
                            <div class="form-group col-lg-4 mt-3"><label><b>Ciudad</b></label><input type="text"
                                    class="form-control" id="ac_ciudad"></div>
                            <div class="form-group col-lg-4 mt-2"><label><b>Condominio</b></label><input type="text"
                                    class="form-control" id="ac_condominio"></div>
                            <div class="form-group col-lg-4 mt-2"><label><b>Torre</b></label><input type="text"
                                    class="form-control" id="ac_torre"></div>
                            <div class="form-group col-lg-4 mt-2"><label><b>N° Departamento</b></label><input
                                    type="text" class="form-control" id="ac_num_torre"></div>
                            <div class="form-group col-lg-4 mt-2"><label><b>Rol</b></label><input type="text"
                                    class="form-control" id="ac_rol"></div>
                            <div class="form-group col-lg-4 mt-2"><label><b>Estado Vivienda</b></label><select
                                    class="form-select" id="ac_estado">
                                    <option value="" disabled selected>Seleccione</option>
                                    <option value="Amoblada">Amoblada</option>
                                    <option value="Sin Amoblar">Sin Amoblar</option>
                                    <option value="SemiAmoblado">SemiAmoblado</option>
                                </select></div>
                            <div class="form-group col-lg-4 mt-2"><label><b>Tipo Inmueble</b></label><select
                                    class="form-select" id="ac_tipo">
                                    <option value="" disabled selected>Seleccione</option>
                                    <option value="Casa">Casa</option>
                                    <option value="Departamento">Departamento</option>
                                </select></div>
                            <div class="form-group col-lg-12 mt-2"><label><b>Descripción</b></label>
                                <textarea class="form-control" id="ac_descripcion"></textarea>
                            </div>
                            <div class="form-group col-lg-4 mt-2"><label><b>Ruta de Maps</b></label><input type="text"
                                    class="form-control" id="ac_ruta"></div>
                        </div>
                        <div class="row mb-3 p-4 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-4 bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white text-center">Servicios Básicos</h5>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 mt-2"><label><b>Empresa Luz</b></label><input type="text"
                                    class="form-control" id="ac_empresa_luz"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>N° Luz</b></label><input type="text"
                                    class="form-control" id="ac_numero_luz"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>Empresa Agua</b></label><input type="text"
                                    class="form-control" id="ac_empresa_agua"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>N° Agua</b></label><input type="text"
                                    class="form-control" id="ac_numero_agua"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>Empresa Gas</b></label><input type="text"
                                    class="form-control" id="ac_empresa_gas"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>N° Gas</b></label><input type="text"
                                    class="form-control" id="ac_numero_gas"></div>
                        </div>
                        <div class="row mb-3 p-4 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-4 bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white text-center">Detalles Adicionales</h5>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 text-center mt-2">
                                <label><b>¿Tiene Estacionamiento?</b></label>
                                <div class="mt-1"><input type="radio" name="ac_estCheck" id="ac_estSi"
                                        value="si"><label for="ac_estSi">Sí</label> <input type="radio"
                                        name="ac_estCheck" id="ac_estNo" value="no"><label
                                        for="ac_estNo">No</label></div>
                                <div id="ac_camposEst" class="mt-2" style="display:none;">
                                    <div class="row bg-white m-1 p-2" style="border-radius:.9rem;">
                                        <div class="col-lg-4"><label><b>Monto</b></label><input type="text"
                                                class="form-control" id="ac_monto_est"></div>
                                        <div class="col-lg-4"><label><b>Rol</b></label><input type="text"
                                                class="form-control" id="ac_rol_est"></div>
                                        <div class="col-lg-4"><label><b>N° Estac.</b></label><input type="text"
                                                class="form-control" id="ac_num_est"></div>
                                        <div class="col-lg-12 text-center mt-2"><label><b>¿Techado?</b></label>
                                            <div><input type="radio" name="ac_techadoCheck" id="ac_techadoSi"
                                                    value="1"><label for="ac_techadoSi">Sí</label> <input
                                                    type="radio" name="ac_techadoCheck" id="ac_techadoNo"
                                                    value="0"><label for="ac_techadoNo">No</label></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 text-center mt-2">
                                <label><b>¿Tiene Bodega?</b></label>
                                <div class="mt-1"><input type="radio" name="ac_bodCheck" id="ac_bodSi"
                                        value="si"><label for="ac_bodSi">Sí</label> <input type="radio"
                                        name="ac_bodCheck" id="ac_bodNo" value="no"><label
                                        for="ac_bodNo">No</label></div>
                                <div id="ac_camposBod" class="mt-2" style="display:none;">
                                    <div class="row bg-white m-1 p-2" style="border-radius:.9rem;">
                                        <div class="col-lg-4"><label><b>Monto</b></label><input type="text"
                                                class="form-control" id="ac_monto_bod"></div>
                                        <div class="col-lg-4"><label><b>Rol</b></label><input type="text"
                                                class="form-control" id="ac_rol_bod"></div>
                                        <div class="col-lg-4"><label><b>N° Bodega</b></label><input type="text"
                                                class="form-control" id="ac_num_bod"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-4 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-6 mt-2"><label><b>Imágenes</b></label><input type="file"
                                    class="form-control" id="ac_imagenes" multiple></div>
                            <div class="col-lg-6 mt-2"><label><b>Video</b></label><input type="file"
                                    class="form-control" id="ac_video" accept="video/*"></div>
                            <div class="col-lg-12 mt-2"><label><b>Documentos</b></label><input type="file"
                                    class="form-control" id="ac_archivos" accept=".pdf,.doc,.docx" multiple></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background-color:rgb(255,215,151);">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn_guardar_anocorrido">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== MODAL VENTA ===================== --}}
    <div class="modal fade" id="modalVenta" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-color:rgb(255,215,151); justify-content:center; position:relative;">
                    <h5 class="modal-title text-uppercase">Agregar Propiedad en Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="position:absolute;right:10px;top:10px;"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-3 p-4 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-4 bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white text-center">Detalle de la Propiedad</h5>
                                </div>
                            </div>
                            <div class="form-group col-lg-4 mt-3"><label><b>Precio Propiedad</b></label>
                                <div class="input-group"><input type="text" class="form-control" id="vta_precio"
                                        placeholder="Ej: 80.000.000" oninput="formatearMiles(this)">
                                    <div class="input-group-text">
                                        <div class="custom-control custom-switch"><input type="checkbox"
                                                class="custom-control-input" id="vta_switchUF"><label
                                                class="custom-control-label" for="vta_switchUF"></label></div><span
                                            id="vta_monedaTexto" class="ms-2 fw-bold">CLP</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-4 mt-3"><label><b>Dirección</b></label><input type="text"
                                    class="form-control" id="vta_direccion"></div>
                            <div class="form-group col-lg-4 mt-3"><label><b>Ciudad</b></label><input type="text"
                                    class="form-control" id="vta_ciudad"></div>
                            <div class="form-group col-lg-4 mt-2"><label><b>Torre</b></label><input type="text"
                                    class="form-control" id="vta_torre"></div>
                            <div class="form-group col-lg-4 mt-2"><label><b>N° Departamento</b></label><input
                                    type="text" class="form-control" id="vta_num_departamento"></div>
                            <div class="form-group col-lg-4 mt-2"><label><b>Rol</b></label><input type="text"
                                    class="form-control" id="vta_rol"></div>
                            <div class="form-group col-lg-4 mt-2"><label><b>Tipo Vivienda</b></label><select
                                    class="form-select" id="vta_tipo_vivienda">
                                    <option value="" disabled selected>Seleccione</option>
                                    <option value="Casa">Casa</option>
                                    <option value="Departamento">Departamento</option>
                                </select></div>
                            <div class="form-group col-lg-4 mt-2"><label><b>Sector / Condominio</b></label><input
                                    type="text" class="form-control" id="vta_condominio"></div>
                            <div class="form-group col-lg-4 mt-2"><label><b>Ruta de Maps</b></label><input type="text"
                                    class="form-control" id="vta_maps"></div>
                        </div>
                        <div class="row mb-3 p-4 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-4 bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white text-center">Servicios Comunes</h5>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 mt-2"><label><b>Empresa Luz</b></label><input type="text"
                                    class="form-control" id="vta_empresa_luz"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>N° Luz</b></label><input type="text"
                                    class="form-control" id="vta_numero_luz"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>Empresa Agua</b></label><input type="text"
                                    class="form-control" id="vta_empresa_agua"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>N° Agua</b></label><input type="text"
                                    class="form-control" id="vta_numero_agua"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>Empresa Gas</b></label><input type="text"
                                    class="form-control" id="vta_empresa_gas"></div>
                            <div class="form-group col-lg-6 mt-2"><label><b>N° Gas</b></label><input type="text"
                                    class="form-control" id="vta_numero_gas"></div>
                        </div>
                        <div class="row mb-3 p-2 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-12 mb-2 mt-2">
                                <div class="col-lg-4 bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white text-center">Detalles Adicionales</h5>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 text-center mt-2">
                                <label><b>¿Tiene Estacionamiento?</b></label>
                                <div class="mt-1"><input type="radio" name="vta_estCheck" id="vta_estSi"
                                        value="si"><label for="vta_estSi">Sí</label> <input type="radio"
                                        name="vta_estCheck" id="vta_estNo" value="no"><label
                                        for="vta_estNo">No</label></div>
                                <div id="vta_camposEst" class="mt-2" style="display:none;">
                                    <div class="row bg-white m-1 p-2" style="border-radius:.9rem;">
                                        <div class="col-lg-4"><label><b>Monto</b></label><input type="text"
                                                class="form-control" id="vta_monto_est"></div>
                                        <div class="col-lg-4"><label><b>Rol</b></label><input type="text"
                                                class="form-control" id="vta_rol_est"></div>
                                        <div class="col-lg-4"><label><b>N° Estac.</b></label><input type="text"
                                                class="form-control" id="vta_num_est"></div>
                                        <div class="col-lg-12 text-center mt-2"><label><b>¿Techado?</b></label>
                                            <div><input type="radio" name="vta_techadoCheck" id="vta_techadoSi"
                                                    value="si"><label for="vta_techadoSi">Sí</label> <input
                                                    type="radio" name="vta_techadoCheck" id="vta_techadoNo"
                                                    value="no"><label for="vta_techadoNo">No</label></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 text-center mt-2">
                                <label><b>¿Tiene Bodega?</b></label>
                                <div class="mt-1"><input type="radio" name="vta_bodCheck" id="vta_bodSi"
                                        value="si"><label for="vta_bodSi">Sí</label> <input type="radio"
                                        name="vta_bodCheck" id="vta_bodNo" value="no"><label
                                        for="vta_bodNo">No</label></div>
                                <div id="vta_camposBod" class="mt-2" style="display:none;">
                                    <div class="row bg-white m-1 p-2" style="border-radius:.9rem;">
                                        <div class="col-lg-4"><label><b>Monto</b></label><input type="text"
                                                class="form-control" id="vta_monto_bod"></div>
                                        <div class="col-lg-4"><label><b>Rol</b></label><input type="text"
                                                class="form-control" id="vta_rol_bod"></div>
                                        <div class="col-lg-4"><label><b>N° Bodega</b></label><input type="text"
                                                class="form-control" id="vta_num_bod"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-4 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-12 mt-2"><label><b>Imágenes</b></label><input type="file"
                                    class="form-control" id="vta_imagenes" multiple></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background-color:rgb(255,215,151);">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn_guardar_venta">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== MODAL VERANO ===================== --}}
    <div class="modal fade" id="modalVerano" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-color:rgb(255,215,151); justify-content:center; position:relative;">
                    <h5 class="modal-title text-uppercase">Agregar Propiedad de Verano</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="position:absolute;right:10px;top:10px;"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-4 p-4 shadow" style="background-color:#FFE2B2;border-radius:.9rem;">
                            <div class="col-lg-12 mb-3">
                                <div class="col-lg-4 bg-black px-3 py-2 rounded-pill shadow">
                                    <h5 class="m-0 text-white text-center">Detalles de la Propiedad</h5>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3"><label><b>Precio mínimo enero</b></label>
                                <div class="input-group"><span class="input-group-text">$</span><input type="text"
                                        class="form-control" id="ve_precio_min_enero"
                                        oninput="this.value=this.value.replace(/\D/g,'').replace(/\B(?=(\d{3})+(?!\d))/g,'.')">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3"><label><b>Precio máximo enero</b></label>
                                <div class="input-group"><span class="input-group-text">$</span><input type="text"
                                        class="form-control" id="ve_precio_max_enero"
                                        oninput="this.value=this.value.replace(/\D/g,'').replace(/\B(?=(\d{3})+(?!\d))/g,'.')">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3"><label><b>Precio mínimo febrero</b></label>
                                <div class="input-group"><span class="input-group-text">$</span><input type="text"
                                        class="form-control" id="ve_precio_min_febrero"
                                        oninput="this.value=this.value.replace(/\D/g,'').replace(/\B(?=(\d{3})+(?!\d))/g,'.')">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3"><label><b>Precio máximo febrero</b></label>
                                <div class="input-group"><span class="input-group-text">$</span><input type="text"
                                        class="form-control" id="ve_precio_max_febrero"
                                        oninput="this.value=this.value.replace(/\D/g,'').replace(/\B(?=(\d{3})+(?!\d))/g,'.')">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3"><label><b>Dirección</b></label><input type="text"
                                    class="form-control" id="ve_direccion"></div>
                            <div class="col-md-4 mb-3"><label><b>Ciudad</b></label><input type="text"
                                    class="form-control" id="ve_ciudad"></div>
                            <div class="col-md-4 mb-3"><label><b>Sector</b></label><input type="text"
                                    class="form-control" id="ve_sector"></div>
                            <div class="col-md-4 mb-3"><label><b>Condominio</b></label><input type="text"
                                    class="form-control" id="ve_condominio"></div>
                            <div class="col-md-4 mb-3"><label><b>Torre</b></label><input type="text"
                                    class="form-control" id="ve_torre"></div>
                            <div class="col-md-4 mb-3"><label><b>N° Departamento</b></label><input type="text"
                                    class="form-control" id="ve_num_apartamento"></div>
                            <div class="col-md-4 mb-3"><label><b>Piso</b></label><input type="text"
                                    class="form-control" id="ve_piso"></div>
                            <div class="col-md-4 mb-3"><label><b>Personas</b></label><input type="number"
                                    class="form-control" id="ve_personas"></div>
                            <div class="col-md-4 mb-3"><label><b>Ubicación</b></label>
                                <div><input class="form-check-input" type="radio" name="ve_ubicacion" id="ve_ub_playa"
                                        value="playa"><label for="ve_ub_playa" class="me-3">Playa</label><input
                                        class="form-check-input" type="radio" name="ve_ubicacion" id="ve_ub_centro"
                                        value="centro"><label for="ve_ub_centro" class="me-3">Centro</label><input
                                        class="form-check-input" type="radio" name="ve_ubicacion" id="ve_ub_ambos"
                                        value="ambos"><label for="ve_ub_ambos">Ambos</label></div>
                            </div>
                            <div class="col-md-4 mb-3"><label><b>Dormitorios</b></label><input type="text"
                                    class="form-control" id="ve_dormitorios"></div>
                            <div class="col-md-4 mb-3"><label><b>Tipo de Piso</b></label><select class="form-select"
                                    id="ve_tipo_piso">
                                    <option disabled selected>Seleccione</option>
                                    <option value="Cerámico">Cerámico</option>
                                    <option value="Flotante">Flotante</option>
                                    <option value="Alfombrado">Alfombrado</option>
                                    <option value="Porcelanato">Porcelanato</option>
                                </select></div>
                            <div class="col-md-4 mb-3"><label><b>Baños</b></label><input type="text"
                                    class="form-control" id="ve_banos"></div>
                            <div class="col-md-4 mb-3"><label><b>Tipo de cocina</b></label><select class="form-select"
                                    id="ve_tipo_cocina">
                                    <option disabled selected>Seleccione</option>
                                    <option value="Americana">Americana</option>
                                    <option value="semi Americana">Semi Americana</option>
                                    <option value="independiente">Independiente</option>
                                </select></div>
                            <div class="col-md-4 mb-3"><label><b>Equipado para</b></label><input type="text"
                                    class="form-control" id="ve_equipado"></div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="ve_mascotas"
                                        onchange="document.getElementById('ve_valorAdicionalDiv').classList.toggle('d-none', !this.checked)"><label
                                        class="form-check-label" for="ve_mascotas"><b>¿Tiene mascotas?</b></label></div>
                                <div class="d-none" id="ve_valorAdicionalDiv"><label><b>Valor Adicional</b></label>
                                    <div class="input-group"><span class="input-group-text">$</span><input type="text"
                                            class="form-control" id="ve_valor_adicional"
                                            oninput="this.value=this.value.replace(/\D/g,'').replace(/\B(?=(\d{3})+(?!\d))/g,'.')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background-color:rgb(255,215,151);">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn_guardar_verano">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== MODAL ÉXITO ===================== --}}
    <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background:rgba(0,0,0,0);border:none;width:700px;">
                <div class="modal-header alert alert-success" role="alert" style="border:none;">
                    <div class="container">
                        <div class="row">
                            <div class="col-2"><lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop"
                                    delay="2000" style="width:70px;height:70px"></lord-icon></div>
                            <div class="col-8 d-flex justify-content-center align-items-center">
                                <p id="texto_success" class="text-uppercase">Datos Guardados con éxito</p>
                            </div>
                            <div class="col-2"><button type="button" class="btn-close d-flex justify-content-end"
                                    id="close_success"></button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    @parent
    <script>
        const PROPIETARIO_ID = {{ $propietario->id }};
        const propietarioActual = [{
            id: PROPIETARIO_ID
        }];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* ─── Filtro de tarjetas ──────────────────────────────────────────────── */
        $('.filtro-btn').on('click', function() {
            $('.filtro-btn').removeClass('active btn-primary').addClass('btn-outline-primary');
            $(this).removeClass('btn-outline-primary').addClass('active btn-primary');
            var tipo = $(this).data('tipo');
            if (tipo === 'todos') {
                $('.tarjeta-propiedad').show();
            } else {
                $('.tarjeta-propiedad').each(function() {
                    $(this).toggle($(this).data('tipo') == tipo);
                });
            }
            $('.btn-agregar-tipo').addClass('d-none');
            if (tipo === 'todos') $('#btn-agregar-todos').removeClass('d-none');
            else $('#btn-agregar-' + tipo).removeClass('d-none');
        });

        /* ─── Helpers ─────────────────────────────────────────────────────────── */
        function formatearMiles(input) {
            let v = input.value.replace(/\D/g, '');
            input.value = v.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function mostrarExito(texto) {
            $('#texto_success').text(texto);
            $('#successModal').modal('show');
        }

        $('#close_success').on('click', function() {
            $('#successModal').modal('hide');
            location.reload();
        });

        /* ─── Radios toggle ───────────────────────────────────────────────────── */
        function bindRadioToggle(siId, noId, camposId) {
            var si = document.getElementById(siId);
            var no = document.getElementById(noId);
            if (si) si.addEventListener('change', function() {
                document.getElementById(camposId).style.display = 'block';
            });
            if (no) no.addEventListener('change', function() {
                document.getElementById(camposId).style.display = 'none';
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            bindRadioToggle('md_estSi', 'md_estNo', 'md_camposEst');
            bindRadioToggle('md_bodSi', 'md_bodNo', 'md_camposBod');
            bindRadioToggle('ac_estSi', 'ac_estNo', 'ac_camposEst');
            bindRadioToggle('ac_bodSi', 'ac_bodNo', 'ac_camposBod');
            bindRadioToggle('vta_estSi', 'vta_estNo', 'vta_camposEst');
            bindRadioToggle('vta_bodSi', 'vta_bodNo', 'vta_camposBod');

            var swUF = document.getElementById('vta_switchUF');
            if (swUF) swUF.addEventListener('change', function() {
                document.getElementById('vta_monedaTexto').innerText = this.checked ? 'UF' : 'CLP';
            });
        });

        /* ─── GUARDAR: Marzo a Diciembre ──────────────────────────────────────── */
        $('#btn_guardar_marzodiciembre').on('click', function() {
            if (!$('#md_direccion').val() || !$('#md_condominio').val() || !$('#md_diciembre').val()) {
                alert('Por favor complete: Dirección, Condominio y Precio.');
                return;
            }
            var formData = new FormData();
            formData.append('direccion', $('#md_direccion').val());
            formData.append('ciudad', $('#md_ciudad').val());
            formData.append('ruta', $('#md_ruta').val());
            formData.append('tipo', $('#md_tipo').val());
            formData.append('descripcion', $('#md_descripcion').val());
            formData.append('estado_propiedad', $('#md_estado').val());
            formData.append('condominio', $('#md_condominio').val());
            formData.append('torre', $('#md_torre').val());
            formData.append('num_torre', $('#md_num_torre').val());
            formData.append('rol', $('#md_rol').val());
            formData.append('diciembre', $('#md_diciembre').val());
            formData.append('tipo_moneda', 'CLP');
            formData.append('empresaluz', $('#md_empresa_luz').val());
            formData.append('numeroluz', $('#md_numero_luz').val());
            formData.append('empresaagua', $('#md_empresa_agua').val());
            formData.append('numeroagua', $('#md_numero_agua').val());
            formData.append('empresagas', $('#md_empresa_gas').val());
            formData.append('numerogas', $('#md_numero_gas').val());
            formData.append('monto', $('#md_monto_est').val());
            formData.append('rol_est', $('#md_rol_est').val());
            formData.append('estacionamiento', $('#md_num_est').val());
            formData.append('techado', $('input[name="md_techadoCheck"]:checked').val() || '');
            formData.append('monto_b', $('#md_monto_bod').val());
            formData.append('rol_b', $('#md_rol_bod').val());
            formData.append('bodega', $('#md_num_bod').val());
            formData.append('PropietariosAgregados', JSON.stringify(propietarioActual));
            var imgs = $('#md_imagenes')[0].files;
            for (var i = 0; i < imgs.length; i++) formData.append('imagenes[]', imgs[i]);
            var vid = $('#md_video')[0].files[0];
            if (vid) formData.append('videos', vid);
            var docs = $('#md_archivos')[0].files;
            for (var i = 0; i < docs.length; i++) formData.append('Archivo[]', docs[i]);

            $.ajax({
                url: '{{ url('/propiedades') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    $('#modalMarzodiciembre').modal('hide');
                    mostrarExito('Propiedad Marzo a Diciembre creada correctamente');
                },
                error: function() {
                    alert('Error al guardar.');
                }
            });
        });

        /* ─── GUARDAR: Año Corrido ────────────────────────────────────────────── */
        $('#btn_guardar_anocorrido').on('click', function() {
            if (!$('#ac_direccion').val() || !$('#ac_condominio').val() || !$('#ac_ano_corrido').val()) {
                alert('Por favor complete: Dirección, Condominio y Precio.');
                return;
            }
            var formData = new FormData();
            formData.append('direccion', $('#ac_direccion').val());
            formData.append('ciudad', $('#ac_ciudad').val());
            formData.append('ruta', $('#ac_ruta').val());
            formData.append('tipo', $('#ac_tipo').val());
            formData.append('descripcionpro', $('#ac_descripcion').val());
            formData.append('estado_propiedad', $('#ac_estado').val());
            formData.append('condominio', $('#ac_condominio').val());
            formData.append('torre', $('#ac_torre').val());
            formData.append('num_torre', $('#ac_num_torre').val());
            formData.append('rol', $('#ac_rol').val());
            formData.append('ano_corrido', $('#ac_ano_corrido').val());
            formData.append('tipo_moneda', 'CLP');
            formData.append('empresaluz', $('#ac_empresa_luz').val());
            formData.append('numeroluz', $('#ac_numero_luz').val());
            formData.append('empresaagua', $('#ac_empresa_agua').val());
            formData.append('numeroagua', $('#ac_numero_agua').val());
            formData.append('empresagas', $('#ac_empresa_gas').val());
            formData.append('numerogas', $('#ac_numero_gas').val());
            formData.append('monto', $('#ac_monto_est').val());
            formData.append('rol_est', $('#ac_rol_est').val());
            formData.append('estacionamiento', $('#ac_num_est').val());
            formData.append('techado', $('input[name="ac_techadoCheck"]:checked').val() || '');
            formData.append('monto_b', $('#ac_monto_bod').val());
            formData.append('rol_b', $('#ac_rol_bod').val());
            formData.append('bodega', $('#ac_num_bod').val());
            formData.append('PropietariosAgregados', JSON.stringify(propietarioActual));
            var imgs = $('#ac_imagenes')[0].files;
            for (var i = 0; i < imgs.length; i++) formData.append('imagenes[]', imgs[i]);
            var vid = $('#ac_video')[0].files[0];
            if (vid) formData.append('videos', vid);
            var docs = $('#ac_archivos')[0].files;
            for (var i = 0; i < docs.length; i++) formData.append('Archivo[]', docs[i]);

            $.ajax({
                url: '{{ url('/proanocorrido/add') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    $('#modalAnoCorrido').modal('hide');
                    mostrarExito('Propiedad Año Corrido creada correctamente');
                },
                error: function() {
                    alert('Error al guardar.');
                }
            });
        });

        /* ─── GUARDAR: Venta ──────────────────────────────────────────────────── */
        $('#btn_guardar_venta').on('click', function() {
            if (!$('#vta_direccion').val() || !$('#vta_precio').val()) {
                alert('Por favor complete: Dirección y Precio.');
                return;
            }
            var tipoMoneda = document.getElementById('vta_switchUF').checked ? 'UF' : 'CLP';
            var formData = new FormData();
            formData.append('direccion', $('#vta_direccion').val());
            formData.append('ciudad', $('#vta_ciudad').val());
            formData.append('maps', $('#vta_maps').val());
            formData.append('rol', $('#vta_rol').val());
            formData.append('tipo_vivienda', $('#vta_tipo_vivienda').val());
            formData.append('condominio', $('#vta_condominio').val());
            formData.append('torre', $('#vta_torre').val());
            formData.append('num_departamento', $('#vta_num_departamento').val());
            formData.append('empresaluz', $('#vta_empresa_luz').val());
            formData.append('numeroluz', $('#vta_numero_luz').val());
            formData.append('empresaagua', $('#vta_empresa_agua').val());
            formData.append('numeroagua', $('#vta_numero_agua').val());
            formData.append('empresagas', $('#vta_empresa_gas').val());
            formData.append('numerogas', $('#vta_numero_gas').val());
            formData.append('precio', $('#vta_precio').val());
            formData.append('tipo_moneda', tipoMoneda);
            formData.append('monto', $('#vta_monto_est').val());
            formData.append('rol_est', $('#vta_rol_est').val());
            formData.append('estacionamiento', $('#vta_num_est').val());
            formData.append('techado', $('input[name="vta_techadoCheck"]:checked').val() || '');
            formData.append('monto_b', $('#vta_monto_bod').val());
            formData.append('rol_b', $('#vta_rol_bod').val());
            formData.append('bodega', $('#vta_num_bod').val());
            formData.append('PropietariosAgregados', JSON.stringify(propietarioActual));
            var imgs = $('#vta_imagenes')[0].files;
            for (var i = 0; i < imgs.length; i++) formData.append('imagenes[]', imgs[i]);

            $.ajax({
                url: '{{ url('/propiedadesVenta/add_propiedad') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    $('#modalVenta').modal('hide');
                    mostrarExito('Propiedad en Venta creada correctamente');
                },
                error: function() {
                    alert('Error al guardar.');
                }
            });
        });

        /* ─── GUARDAR: Verano ─────────────────────────────────────────────────── */
        $('#btn_guardar_verano').on('click', function() {
            if (!$('#ve_direccion').val() || !$('#ve_precio_min_enero').val()) {
                alert('Por favor complete: Dirección y Precio mínimo enero.');
                return;
            }
            var formData = new FormData();
            formData.append('direccion', $('#ve_direccion').val());
            formData.append('ciudad', $('#ve_ciudad').val());
            formData.append('sector', $('#ve_sector').val());
            formData.append('condominio', $('#ve_condominio').val());
            formData.append('torre', $('#ve_torre').val());
            formData.append('num_apartamento', $('#ve_num_apartamento').val());
            formData.append('piso', $('#ve_piso').val());
            formData.append('ubicacion', $('input[name="ve_ubicacion"]:checked').val() || '');
            formData.append('dormitorios', $('#ve_dormitorios').val());
            formData.append('Tpiso_dormitorios', $('#ve_tipo_piso').val());
            formData.append('baños', $('#ve_banos').val());
            formData.append('tipo_cocina', $('#ve_tipo_cocina').val());
            formData.append('personas', $('#ve_personas').val());
            formData.append('precio_min_enero', $('#ve_precio_min_enero').val());
            formData.append('precio_max_enero', $('#ve_precio_max_enero').val());
            formData.append('precio_min_febrero', $('#ve_precio_min_febrero').val());
            formData.append('precio_max_febrero', $('#ve_precio_max_febrero').val());
            formData.append('equipado', $('#ve_equipado').val());
            formData.append('mascotas', $('#ve_mascotas').is(':checked') ? '1' : '');
            formData.append('valor_adicional', $('#ve_valor_adicional').val());
            formData.append('PropietariosAgregados', JSON.stringify(propietarioActual));

            $.ajax({
                url: '{{ url('/propiedades_verano') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    $('#modalVerano').modal('hide');
                    mostrarExito('Propiedad de Verano creada correctamente');
                },
                error: function() {
                    alert('Error al guardar.');
                }
            });

        });

        $('.btn-eliminar-propiedad').on('click', function() {
            swal.fire({
                title: '¿Está seguro?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (!result.isConfirmed) return;

                var PROPIETARIO_ID = $(this).data('id');
                $.ajax({
                    url: '{{ url('/proanocorrido/propiedad') }}/' + PROPIETARIO_ID,
                    type: 'DELETE',
                    success: function() {
                        swal.fire({
                            title: 'Propiedad eliminada',
                            text: 'La propiedad ha sido eliminada exitosamente.',
                            icon: 'success',
                            confirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = '{{ url('/propietario/{propietario_id}/detalles') }}';
                        });
                    },
                    error: function() {
                        swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error al eliminar la propiedad.',
                            icon: 'error',
                            confirmButton: false,
                            timer: 2000
                        });
                    }
                });
            });
        });
    </script>
@endsection
