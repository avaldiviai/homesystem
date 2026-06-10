@extends('layouts.app')
@section('content')
    <div class="container-fluid overflow-hidden" style="background-color:rgb(255, 255, 255)">
        <div class="row" style="background-color:rgb(255, 255, 255)">
            @include('layouts.sidebar')

            <div class="col d-flex flex-column" style="padding:0; background:#f5f4f0; height:100vh; overflow-y:auto;">
                <div class="flex-grow-1">

                    {{-- ── HEADER ── --}}
                    <div class="px-4 pt-4 pb-3" style="background:#fff; border-bottom:2px solid #f0ede8;">
                        <h1 class="fw-800 mb-1" style="font-size:1.75rem; color:#1a1a2e; letter-spacing:-.5px;">
                            <i class="fa-solid fa-file-lines me-2" style="color:#E67E22;"></i>
                            Arriendos Temporales
                        </h1>
                        <p class="text-muted mb-0" style="font-size:.9rem;">
                            Gestión de documentos, totales mensuales y resumen financiero
                        </p>
                    </div>

                    {{-- ══════════════════════════════════════════════════════════════ --}}
                    {{-- ── SECCIÓN DE PLANILLAS (filas: Info | Documentos | Total Mes) --}}
                    {{-- ══════════════════════════════════════════════════════════════ --}}
                    <div class="px-4 py-4">

                        {{-- ─ Cabecera de columnas ─ --}}
                        <div class="pla-row-header d-none d-lg-grid mb-2">
                            <div class="pla-col-label"><i class="fa-solid fa-tag me-1"></i> Seccion</div>
                            <div class="pla-col-label"><i class="fa-solid fa-folder-open me-1"></i> Documentos</div>
                            <div class="pla-col-label"><i class="fa-solid fa-calculator me-1"></i> Total Mes</div>
                        </div>

                        {{-- FILA 1 – 10% Administración --}}
                        <div class="pla-row mb-3" data-tipo="1">

                            {{-- Col 1: Info --}}
                            <div class="pla-cell pla-cell--info" style="border-left-color:#E67E22;">
                                <div class="pla-cell-icon" style="background:#E67E22;">
                                    <i class="fa-solid fa-house"></i>
                                </div>
                                <div>
                                    <div class="pla-cell-title">Arriendos</div>
                                    <div class="pla-cell-sub">Total de Arriendos</div>
                                </div>
                                <span class="badge rounded-pill ms-auto" id="cnt-1"
                                    style="background:#E67E22; color:#fff; font-size:.7rem;">0</span>
                            </div>

                            {{-- Col 2: Documentos --}}
                            <div class="pla-cell pla-cell--docs">
                                <div class="pla-doc-zone" id="docs-1">
                                    <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.4rem;color:#ccc;"></i>
                                    <span style="font-size:.78rem;color:#aaa;">Sin archivos aún</span>
                                </div>
                                <div class="pla-actions mt-2">
                                    <button class="pla-abtn pla-abtn--filled btn-agregar" data-tipo="1"
                                        style="background:#E67E22;">
                                        <i class="fa-solid fa-plus"></i> Agregar
                                    </button>
                                    <button class="pla-abtn btn-ver" data-tipo="1"
                                        style="border-color:#E67E22; color:#E67E22;">
                                        <i class="fa-solid fa-eye"></i> Ver
                                    </button>
                                </div>
                            </div>

                            {{-- Col 3: Total Mes --}}
                            <div class="pla-cell pla-cell--total">
                                <div class="pla-total-inner">
                                    <div class="pla-tlabel">Total ingresado</div>
                                    <div class="pla-tvalue-raw" id="tv-raw-1">$ 0</div>
                                    <div class="pla-tsep"></div>
                                    <div class="pla-tlabel" style="color:#E67E22;">10% → Gráfico</div>
                                    <div class="pla-tvalue" id="tv-1" style="color:#E67E22;">$ 0</div>
                                    <div class="pla-tnota">Valor que se graficará</div>
                                </div>
                                <div class="pla-to-chart">
                                    <i class="fa-solid fa-arrow-right"></i> al gráfico
                                </div>
                            </div>

                        </div><!-- /fila 1 -->

                        <div class="pla-divider"></div>

                        {{-- FILA 2 – Arriendos Mensuales --}}
                       
                        <div class="pla-row mb-3" data-tipo="2">

                            <div class="pla-cell pla-cell--info" style="border-left-color:#2980B9;">
                                <div class="pla-cell-icon" style="background:#2980B9;">
                                    <i class="fa-solid fa-broom"></i>
                                </div>
                                <div>
                                    <div class="pla-cell-title">Aseos</div>
                                    <div class="pla-cell-sub">Total de Aseos</div>
                                </div>
                                <span class="badge rounded-pill ms-auto" id="cnt-2"
                                    style="background:#2980B9; color:#fff; font-size:.7rem;">0</span>
                            </div>

                            <div class="pla-cell pla-cell--docs">
                                <div class="pla-doc-zone" id="docs-2">
                                    <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.4rem;color:#ccc;"></i>
                                    <span style="font-size:.78rem;color:#aaa;">Sin archivos aún</span>
                                </div>
                                <div class="pla-actions mt-2">
                                    <button class="pla-abtn pla-abtn--filled btn-agregar" data-tipo="2"
                                        style="background:#2980B9;">
                                        <i class="fa-solid fa-plus"></i> Agregar
                                    </button>
                                    <button class="pla-abtn btn-ver" data-tipo="2"
                                        style="border-color:#2980B9; color:#2980B9;">
                                        <i class="fa-solid fa-eye"></i> Ver
                                    </button>
                                </div>
                            </div>

                            <div class="pla-cell pla-cell--total">
                                <div class="pla-total-inner">
                                    <div class="pla-tlabel">Total acumulado</div>
                                    <div class="pla-tvalue" id="tv-2">$ 0</div>
                                    <div class="pla-tnota">Suma de registros</div>
                                </div>
                                <div class="pla-to-chart">
                                    <i class="fa-solid fa-arrow-right"></i> al gráfico
                                </div>
                            </div>

                        </div><!-- /fila 2 -->

                        <div class="pla-divider"></div>
                    {{-- SECCIÓN GRÁFICOS --}}
                    <div class="px-4 pb-4">
                        <div class="pla-chart-card">

                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                                <div>
                                    <h5 class="fw-700 mb-0" style="color:#1a1a2e;">
                                        <i class="fa-solid fa-chart-pie me-2" style="color:#E67E22;"></i>
                                        Resumen Financiero Mensual
                                    </h5>
                                    <small class="text-muted">Basado en los totales ingresados por planilla</small>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="pla-toggle active" id="btn-pie" onclick="cambiarGrafico('pie')">
                                        <i class="fa-solid fa-chart-pie me-1"></i> Pastel
                                    </button>
                                    <button class="pla-toggle" id="btn-bar" onclick="cambiarGrafico('bar')">
                                        <i class="fa-solid fa-chart-bar me-1"></i> Barras
                                    </button>
                                </div>
                            </div>

                            {{-- Mini totales sobre gráfico --}}
                            <div class="row g-3 mb-4" id="grafico-totales"></div>

                            <div style="border-top:1px solid #f0ede8; margin-bottom:24px;"></div>

                            <div style="position:relative; height:340px;">
                                <canvas id="graficoConsolidado"></canvas>
                            </div>

                            <div id="grafico-empty" class="text-center text-muted py-5" style="display:none;">
                                <i class="fa-solid fa-chart-pie fa-3x mb-3 opacity-25"></i>
                                <p class="mb-1 fw-600">Sin datos para mostrar</p>
                                <p class="mb-0" style="font-size:.85rem;">Agrega documentos con totales mensuales para
                                    ver el gráfico.</p>
                            </div>

                        </div>
                    </div>

                </div><!-- /flex-grow-1 -->
                @include('layouts.footer')
            </div>
            {{-- <div class="col d-flex flex-column vh-100" style="padding:0;">
                <div class="flex-grow-1">
                    {{-- Contenido --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 text-uppercase"
                        style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px;color:black">
                        <h1>Arriendos</h1>
                    </div>
                </div>
            </div>
            {{-- Tabla de arriendos --}}
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-4 mb-4">
                        <div class="input-group mx-2" style="max-width: 400px;">
                            <span class="input-group-text bg-primary text-white shadow-sm">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input type="text" id="buscador_cnn" placeholder="Buscar Arriendo"
                                class="form-control shadow-sm border-0" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 text-end">
                        <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal"
                            data-bs-target="#agregarArriendo" style=>
                            <span>AGREGAR ARRIENDO</span>
                        </button>
                    </div>
                </div>
                <div class="overflow-auto shadow-lg" style="max-height: 65vh;">
                    <table class="table table-striped-columns">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Arrendatario</th>
                                <th>Propiedad</th>
                                <th>Inicio de Arriendo</th>
                                {{-- <th>Fecha Devolucion</th> --}}
                                <th>Fecha Pago</th>
                                <th>Valor Arriendo</th>
                                <th>Comision</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaUa">
                            @foreach ($arriendos as $arriendo)
                                <tr id="filas">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $arriendo->arrendatario->nombre }}</td>
                                    <td>{{ $arriendo->propiedad->tipo_vivienda }} -
                                        {{ $arriendo->propiedad->direccion }}</td>
                                    <td>{{ $arriendo->fecha_entrega }}</td>
                                    {{-- <td>{{ $arriendo->fecha_devolucion }}</td> --}}
                                    <td>{{ $arriendo->fecha_pago }}</td>
                                    <td>$ {{ $arriendo->valor_real }}</td>
                                    <td>{{ $arriendo->comision->porcentaje }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm btn-editar m-1"
                                            data-id="{{ $arriendo->id }}"><i class="fas fa-edit"></i> </a>
                                        <a href="#" class="btn btn-danger btn-sm borrar-arriendo m-1"
                                            data-id="{{ $arriendo->id }}"><i class="fas fa-trash-alt"></i></a>
                                        <a href="#" class="btn btn-success btn-sm btn-Contrato m-1"
                                            data-id="{{ $arriendo->id }}"><i class="fa-regular fa-folder"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div> --}}
    </div>
    </div>

    {{-- SECCION DE MODALES --}}

    <!-- Modal agregar nuevo arriendo-->
    <div class="modal fade" id="agregarArriendo" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="agregarArriendoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarArriendoLabel">Agregar Arriendo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="arriendoForm" action="{{ url('/arriendos/add_arriendos') }}" method="POST"
                        enctype="multipart/form-data" id="form-arriendo">
                        @csrf
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3 col-4">
                                    <label for="propiedadesInput"><b>Propiedades</b></label>
                                    <select class="form-select mt-2" id="propiedadesInput" required>
                                        <option disabled selected value="">Seleccione una Propiedad</option>
                                        @foreach ($propiedades as $pro)
                                            <option value="{{ $pro->id }}">{{ $pro->tipo_vivienda }} -
                                                {{ $pro->propietario->first()->nombre ?? 'Sin Propietario' }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="valorArriendoInput"><b>Valor Arriendo Diciembre</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-2">$</span>
                                        <input type="text" class="form-control mt-2" id="valorArriendoInput"
                                            placeholder="Ej: $460.000" required readonly>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-4">
                                    <label for="valorArriendoAñocorridoInput"><b>Valor Arriendo Año corrido</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-2">$</span>
                                        <input type="text" class="form-control mt-2" id="valorArriendoAñocorridoInput"
                                            placeholder="Ej: $460.000" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-4">
                                    <label for="valorreal"><b>Valor real para el Arriendo</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">$</span>
                                        </div>
                                        <input type="text" class="form-control mt-2" id="valorreal"
                                            placeholder="Ej:$480.000" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-4">
                                    <label for="mesGarantiaInput"><b>Mes Garantia</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">$</span>
                                        </div>
                                        <input type="text" class="form-control mt-2" id="mesGarantiaInput"
                                            placeholder="Ej:$460.000" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-4">
                                    <label for="gastosComunesInput"><b>Gastos Comunes</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-2">$</span>
                                        <input type="text" class="form-control mt-2" id="gastosComunesInput"
                                            placeholder="Ej: $450.000" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="fechaPagoInput"><b>Fecha de Pago</b></label>
                                    <input type="date" class="form-control mt-2" id="fechaPagoInput" required>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="estado" class="mb-3"><b>Estado del pago</b></label>
                                    <select name="estado" class="form-select" id="estado">
                                        <option value="">Seleccione un estado del pago</option>
                                        @foreach ($estados as $es)
                                            <option value="{{ $es->id }}">{{ $es->estado }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="fechaEntregaInput"><b>Fecha inicio de Arriendo</b></label>
                                    <input type="date" class="form-control mt-2" id="fechaEntregaInput" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="arrendatarioInput"><b>Arrendatario</b></label>
                                    <select class="form-select mt-2" id="arrendatarioInput" required>
                                        <option disabled selected value="">Seleccione un Arrendatario</option>
                                        @foreach ($arrendatario as $arren)
                                            <option value="{{ $arren->id }}">{{ $arren->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="comisionesInput"><b>Comisiones</b></label>
                                    <select class="form-select mt-2" id="comisionesInput" required>
                                        <option disabled selected value="">Seleccione una Comisión</option>
                                        @foreach ($comision as $com)
                                            <option value="{{ $com->id }}">{{ $com->porcentaje }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="reajusteInput"><b>Reajuste IPC</b></label>
                                    <input type="date" class="form-control mt-2" placeholder="Reajuste IPC"
                                        id="reajusteInput" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="modal-title" id="agregarContratoLabel">Agregar Documentos</h5>
                                </div>
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="contrato" class="form-label"><strong>Selecciona el archivo a
                                                cargar:</strong></label>
                                        <input type="file" name="contratos[]" accept=".pdf,.doc,.docx" required
                                            class="form-control" id="Archivo" multiple>
                                    </div>
                                    <button type="button" class="btn btn-success m-1 text-uppercase text-white"
                                        id="agregar-datos"><b>Agregar Documentos</b></button>
                    </form>
                </div>
                <ul class="text-uppercase mt-4" id="lista-Datos">
                    <!-- Lista de documentos cargados -->
                </ul>
            </div>
        </div>
        </form>
    </div>
    <ul class="text-uppercase mt-4" id="lista-Datos">
        <!-- Lista de documentos cargados -->
    </ul>
    <div class="modal-footer">

        <div class="col-md-12 d-flex justify-content-end">
            <button type="button" id="btn_agregar" class="btn btn-primary m-2">Guardar</button>
            <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-2"
                data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>

    <!-- Modal editar arriendo-->
    <div class="modal fade" id="editarArriendo" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="editarArriendoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarArriendoLabel">Editar Arriendo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body ">
                    <form>
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="propiedadesEditInput"><b>Propiedades</b></label>
                                    <select class="form-select mt-2" id="propiedadesEditInput">
                                        <option disabled selected value="">Seleccione una Propiedad</option>
                                        @foreach ($propiedades as $pro)
                                            <option value="{{ $pro->id }}">{{ $pro->tipo_vivienda }} -
                                                {{ $pro->direccion }}</option>
                                        @endforeach
                                        {{-- <option value="otros">Otros</option> --}}
                                    </select>
                                </div>

                                <div class="form-group mb-3 col-6">
                                    <label for="valorArriendoEditInput"><b>Valor Arriendo</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">$</span>
                                        </div>
                                        <input type="text" class="form-control mt-2" id="valorArriendoEditInput"
                                            placeholder="Ej:$460.000" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="mesGarantiaEditInput"><b>Mes Garantia</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">$</span>
                                        </div>
                                        <input type="text" class="form-control mt-2" id="mesGarantiaEditInput"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="gastosComunesEditInput"><b>Gatos Comunes</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">$</span>
                                        </div>

                                        <input type="text" class="form-control mt-2" id="gastosComunesEditInput"
                                            placeholder="Ej: $450.000" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="fechaPagoEditInput"><b>Fecha de Pago</b></label>
                                    <input type="date" class="form-control mt-2" id="fechaPagoEditInput" required>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="estadoedit" class="mb-3"><b>Estado del pago</b></label>
                                    <select name="estadoedit" class="form-select" id="estadoedit">
                                        <option value="">Seleccione un estado del pago</option>
                                        @foreach ($estados as $es)
                                            <option value="{{ $es->id }}">{{ $es->estado }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="fechaEntregaEditInput"><b>Fecha Inicio de Arriendo</b></label>
                                    <input type="date" class="form-control mt-2" id="fechaEntregaEditInput" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-4">
                                    <label for="arrendatarioEditInput"><b>Arrendatario</b></label>
                                    <select class="form-select mt-2" id="arrendatarioEditInput">
                                        <option disabled selected value="">Seleccione un Arrendatario</option>
                                        @foreach ($arrendatario as $arren)
                                            <option value="{{ $arren->id }}">{{ $arren->nombre }}</option>
                                        @endforeach
                                        {{-- <option value="otros">Otros</option> --}}
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-4">
                                    <label for="comisionesEditInput"><b>Comisiones</b></label>
                                    <select class="form-select mt-2" id="comisionesEditInput">
                                        <option disabled selected value="">Seleccione una Comision</option>
                                        @foreach ($comision as $com)
                                            <option value="{{ $com->id }}">{{ $com->porcentaje }}
                                            </option>
                                        @endforeach
                                        {{-- <option value="otros">Otros</option> --}}
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="reajusteInputedit"><b>Reajuste IPC</b></label>
                                    <input type="text" class="form-control mt-2" placeholder="Reajuste IPC"
                                        id="reajusteInputedit" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="fechaDevolucionEditInput"><b>Fecha de Devolucion</b></label>
                                    <input type="date" class="form-control mt-2" id="fechaDevolucionEditInput"
                                        required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Botones de cambios -->
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-1"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="btn_agregar_editar" class="btn btn-primary m-1">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar contrato-->
    <div class="modal fade" id="ModificarArchivoModal" tabindex="-1" aria-labelledby="ModificarArchivoLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5 class="modal-title mt-4" id="" style="text-align: center;">Archivos Agregados </h5>
                @if (isset($arriendo))
                    <form action="{{ route('archivos.guardar', $arriendo->id) }}" method="POST"
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
                                                <label for="Archivos2" class="form-label fw-bold">Selecciona el archivo a
                                                    cargar:</label>
                                                <input type="file" name="contratos2[]" accept=".pdf,.doc,.docx"
                                                    required class="form-control" id="Archivos2" multiple>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3 mt-4 p-2">
                                                <button type="button"
                                                    class="btn btn-info text-uppercase text-white fw-bold"
                                                    id="agregar-datossolo">
                                                    Agregar Documentos
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="text-uppercase mt-4" id="lista-Datosdos">
                                    <!-- Lista de documentos cargados -->
                                </ul>
                            </div>

                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-1"
                                data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" id="btn_agregardos" class="btn btn-primary m-1">Guardar</button>
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
        <div class="modal-dialog"> <!-- Centrado en la pantalla -->
            <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
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
    <div class="modal fade" id="modalinfo" tabindex="-1" aria-labelledby="modalinfoLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
                <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                    <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar Arriendo?</h2>
                        <div class="modalfooter d-flex justify-content-center">
                            <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
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
                            <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="confirmarEliminarContratoBtn"
                                class="btn btn-secondary m-2">Eliminar</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal exito -->
    <div class="modal fade" id="modalexito" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalexitoLabel" aria-hidden="true">
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
                                    id="close_success_exito"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    @parent
    <style>
        /* ─── Sidebar sticky ─── */
        /* La col-lg-2 del sidebar se ancla; solo el col principal hace scroll */
        .pla-sidebar-col {
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            flex-shrink: 0;
            scrollbar-width: thin;
        }

        .pla-sidebar-col::-webkit-scrollbar {
            width: 4px;
        }

        .pla-sidebar-col::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, .15);
            border-radius: 4px;
        }

        /* ─── Helpers ─── */
        .fw-700 {
            font-weight: 700 !important;
        }

        .fw-800 {
            font-weight: 800 !important;
        }

        .fw-600 {
            font-weight: 600 !important;
        }

        /* ─── Cabecera columnas ─── */
        .pla-row-header {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
            padding: 0 4px;
        }

        .pla-col-label {
            font-size: .72rem;
            font-weight: 700;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: .5px;
            padding-left: 8px;
        }

        /* ─── Fila de planilla (3 columnas) ─── */
        .pla-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
            align-items: stretch;
        }

        @media (max-width: 991px) {
            .pla-row {
                grid-template-columns: 1fr;
            }

            .pla-row-header {
                display: none !important;
            }
        }

        .pla-row--disabled {
            opacity: .6;
        }

        .pla-row--disabled .pla-cell {
            pointer-events: none;
        }

        /* ─── Divisor entre filas ─── */
        .pla-divider {
            border: none;
            border-top: 2px dashed #ede9e3;
            margin: 0 0 16px 0;
        }

        /* ─── Celda base ─── */
        .pla-cell {
            background: #fff;
            border-radius: 14px;
            padding: 16px 18px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .06);
            border: 1px solid #f0ede8;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: box-shadow .2s, transform .2s;
        }

        .pla-cell:hover {
            box-shadow: 0 6px 22px rgba(0, 0, 0, .11);
            transform: translateY(-2px);
        }

        /* Info cell */
        .pla-cell--info {
            border-left: 4px solid #E67E22;
            flex-direction: row;
            align-items: center;
            gap: 14px;
            flex-wrap: nowrap;
        }

        .pla-cell-icon {
            width: 44px;
            height: 44px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #fff;
            flex-shrink: 0;
        }

        .pla-cell-title {
            font-weight: 700;
            font-size: .9rem;
            color: #1a1a2e;
            line-height: 1.25;
        }

        .pla-cell-sub {
            font-size: .72rem;
            color: #aaa;
            margin-top: 2px;
        }

        /* Docs cell */
        .pla-cell--docs {
            justify-content: space-between;
        }

        /* Total cell */
        .pla-cell--total {
            justify-content: space-between;
        }

        .pla-cell--no-total {
            justify-content: center;
            align-items: center;
            background: #fafaf8;
            border: 1px dashed #e0ddd8;
        }

        /* ─── Zona de documentos ─── */
        .pla-doc-zone {
            background: #f8f7f4;
            border: 2px dashed #e0ddd8;
            border-radius: 10px;
            padding: 14px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80px;
            gap: 4px;
            transition: border-color .2s, background .2s;
            flex: 1;
        }

        .pla-doc-zone:not(.pla-doc-zone--disabled):hover {
            border-color: #E67E22;
            background: #fef9f5;
        }

        .pla-doc-zone--disabled {
            cursor: not-allowed;
            opacity: .6;
        }

        .pla-doc-list {
            width: 100%;
        }

        .pla-doc-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .78rem;
            color: #555;
            padding: 4px 0;
            border-bottom: 1px solid #f0ede8;
        }

        .pla-doc-item:last-child {
            border-bottom: none;
        }

        .pla-doc-item i {
            color: #27AE60;
        }

        /* ─── Total block ─── */
        .pla-total-inner {
            flex: 1;
        }

        .pla-tlabel {
            font-size: .7rem;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .pla-tvalue {
            font-size: 1.25rem;
            font-weight: 800;
            color: #1a1a2e;
            margin: 2px 0;
        }

        .pla-tvalue-raw {
            font-size: .95rem;
            font-weight: 700;
            color: #888;
            margin: 2px 0;
        }

        .pla-tsep {
            border-top: 1px dashed #e8e5e0;
            margin: 8px 0;
        }

        .pla-tnota {
            font-size: .7rem;
            color: #bbb;
        }

        .pla-to-chart {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: .72rem;
            color: #aaa;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px dashed #e8e5e0;
        }

        .pla-to-chart i {
            color: #E67E22;
        }

        /* ─── Botones de acción ─── */
        .pla-actions {
            display: flex;
            gap: 8px;
        }

        .pla-abtn {
            flex: 1;
            padding: 7px 10px;
            border-radius: 9px;
            border: 2px solid;
            background: transparent;
            font-size: .77rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .pla-abtn:hover {
            opacity: .85;
            transform: translateY(-1px);
        }

        .pla-abtn--filled {
            color: #fff !important;
            border-color: transparent !important;
        }

        /* ─── Toggle botones gráfico ─── */
        .pla-toggle {
            padding: 6px 18px;
            border-radius: 20px;
            border: 2px solid #e0ddd8;
            background: #fff;
            color: #666;
            font-size: .82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .pla-toggle:hover {
            border-color: #E67E22;
            color: #E67E22;
        }

        .pla-toggle.active {
            background: #E67E22;
            border-color: #E67E22;
            color: #fff;
        }

        /* ─── Chart card ─── */
        .pla-chart-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px 32px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .07);
            border: 1px solid #f0ede8;
        }

        /* ─── Mini cards sobre el gráfico ─── */
        .pla-mini-card {
            background: #f8f7f4;
            border-radius: 12px;
            padding: 12px 16px;
            border: 1px solid #ece9e4;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pla-mini-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            color: #fff;
            flex-shrink: 0;
        }

        .pla-mini-label {
            font-size: .7rem;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .pla-mini-value {
            font-size: .95rem;
            font-weight: 800;
            color: #1a1a2e;
        }

        .pla-mini-raw {
            font-size: .72rem;
            color: #bbb;
            margin-top: 1px;
        }

        /* ─── Modals ─── */
        .pla-modal {
            border-radius: 16px;
            overflow: hidden;
            border: none;
        }

        .pla-mh {
            padding: 20px 24px;
            color: #fff;
        }

        .pla-icon-wrap {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .22);
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .pla-label {
            display: block;
            font-size: .8rem;
            font-weight: 700;
            color: #555;
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 5px;
        }

        .pla-input {
            border-radius: 10px !important;
            border: 2px solid #e8e5e0 !important;
            padding: 9px 14px !important;
            font-size: .88rem !important;
            transition: all .2s;
            width: 100%;
        }

        .pla-input:focus {
            border-color: #E67E22 !important;
            outline: none;
            box-shadow: 0 0 0 3px rgba(230, 126, 34, .12) !important;
        }

        .pla-step-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .78rem;
            font-weight: 700;
            color: #888;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .pla-step-num {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #E67E22;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .72rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .pla-btn-pri {
            background: #E67E22;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 22px;
            font-weight: 700;
            font-size: .85rem;
            cursor: pointer;
            transition: all .2s;
        }

        .pla-btn-pri:hover {
            background: #D35400;
        }

        .pla-btn-sec {
            background: #f0ede8;
            color: #666;
            border: none;
            border-radius: 10px;
            padding: 9px 22px;
            font-weight: 600;
            font-size: .85rem;
            cursor: pointer;
            transition: all .2s;
        }

        .pla-btn-sec:hover {
            background: #e0ddd8;
        }

        .pla-btn-danger {
            background: #E74C3C;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 22px;
            font-weight: 700;
            font-size: .85rem;
            cursor: pointer;
            transition: all .2s;
        }

        .pla-btn-danger:hover {
            background: #C0392B;
        }

        /* ─── Table ─── */
        .pla-table {
            border-collapse: separate;
            border-spacing: 0 5px;
        }

        .pla-table thead th {
            background: #f0ede8;
            padding: 10px 14px;
            font-size: .77rem;
            font-weight: 700;
            color: #666;
            text-transform: uppercase;
            letter-spacing: .4px;
            border: none;
        }

        .pla-table thead th:first-child {
            border-radius: 8px 0 0 8px;
        }

        .pla-table thead th:last-child {
            border-radius: 0 8px 8px 0;
        }

        .pla-table tbody td {
            background: #fff;
            padding: 11px 14px;
            font-size: .85rem;
            vertical-align: middle;
            border-top: 1px solid #f5f2ee;
            border-bottom: 1px solid #f5f2ee;
        }

        .pla-table tbody td:first-child {
            border-left: 1px solid #f5f2ee;
            border-radius: 8px 0 0 8px;
        }

        .pla-table tbody td:last-child {
            border-right: 1px solid #f5f2ee;
            border-radius: 0 8px 8px 0;
        }

        .pla-table tbody tr:hover td {
            background: #fafaf8;
        }
    </style>
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

            ////////////////////////////BUSCADOR/////////////////////////
            $("#buscador_cnn").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tablaUa #filas").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            ////////////////////////////lista de Documentos agregados /////////////////////////
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

            // // Evento para enviar los datos
            // $("#btn_agregar").on('click', function(event) {
            //     event.preventDefault();
            //     // $("#modalexito").modal('show');

            //     // Obtener los valores de los campos de texto
            //     // var fecha_devolucion = $("#fechaDevolucionInput").val();
            //     var fecha_entrega = $("#fechaEntregaInput").val();
            //     var valor_arriendo = $("#valorArriendoInput").val();
            //     var mes_garantia = $("#mesGarantiaInput").val();
            //     var gastos_comunes = $("#gastosComunesInput").val();
            //     var fecha_pago = $("#fechaPagoInput").val();
            //     var propiedades = $("#propiedadesInput").val();
            //     var arrendatario = $("#arrendatarioInput").val();
            //     var comisiones = $("#comisionesInput").val();
            //     var valor_real = $("#valorreal").val();
            //     var estado = $("#estado").val();
            //     var reajuste_ipc = $("#reajusteInput").val();

            //     // Crear un objeto FormData
            //     var formData = new FormData();

            //     // Agregar los datos del formulario al FormData
            //     // formData.append('fecha_devolucion', fecha_devolucion);
            //     formData.append('fecha_entrega', fecha_entrega);
            //     formData.append('valor_arriendo', valor_arriendo);
            //     formData.append('mes_garantia', mes_garantia);
            //     formData.append('gastos_comunes', gastos_comunes);
            //     formData.append('fecha_pago', fecha_pago);
            //     formData.append('propiedades', propiedades);
            //     formData.append('arrendatario', arrendatario);
            //     formData.append('comisiones', comisiones);
            //     formData.append('valor_real', valor_real);
            //     formData.append('estado', estado);
            //     formData.append('reajuste_ipc', reajuste_ipc);


            //     // Agregar los archivos seleccionados al FormData
            //     archivosSeleccionados.forEach(archivo => {
            //         formData.append('Archivo[]', archivo); // Agregar cada archivo del array
            //     });

            //     console.log([...formData]); // Verificar los datos en la consola

            //     // Realizar la solicitud AJAX
            //     $.ajax({
            //         url: '{{ url('/arriendos/add_arriendos') }}',
            //         type: 'POST',
            //         data: formData,
            //         processData: false, // Para evitar que jQuery procese los datos
            //         contentType: false, // Para evitar que jQuery establezca el tipo de contenido
            //         dataType: 'json',
            //         success: function(respuesta) {
            //             console.log("respuesta", respuesta);
            //             $("#agregarArriendo").modal('hide');
            //             $("#modalexito").modal('show');
            //         },
            //         error: function(jqXHR, textStatus, errorThrown) {
            //             console.log("Error:", errorThrown);
            //             $("#agregarArriendo").modal('hide');

            //             // alert('erro al agregar');
            //             $('#modalerror').modal('show');
            //         }
            //     });
            // }); // fin agregar arriendo
            //funcion al cerrar modal sucess actualice los datos
            $("#close_success_exito").click(function() {
                $("#modalexito").modal('hide');
                location.reload();
            });

            // boton trae datos del arriendo para editar
            $(".btn-editar").on('click', function(event) {
                event.preventDefault();
                idArriendo = $(this).data('id');
                console.log('Editar Arriendo id ' + idArriendo);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/arriendos/editar/' + idArriendo,
                    type: 'GET',
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#editarArriendo").modal('show');
                        $('#btn_agregar_editar').data('id', idArriendo);
                        $("#fechaDevolucionEditInput").val(respuesta.arriendos
                            .fecha_devolucion);
                        $("#fechaEntregaEditInput").val(respuesta.arriendos.fecha_entrega);
                        $("#valorArriendoEditInput").val(respuesta.arriendos.valor_real);
                        $("#mesGarantiaEditInput").val(respuesta.arriendos.mes_garantia);
                        $("#gastosComunesEditInput").val(respuesta.arriendos.gastos_comunes);
                        $("#fechaPagoEditInput").val(respuesta.arriendos.fecha_pago);
                        $("#propiedadesEditInput").val(respuesta.arriendos.id_propiedad);
                        $("#arrendatarioEditInput").val(respuesta.arriendos.id_arrendatario);
                        $("#comisionesEditInput").val(respuesta.arriendos.id_comision);
                        $("#estadoedit").val(respuesta.arriendos.id_estadopagos);
                        $("#reajusteInputedit").val(respuesta.arriendos.reajuste_ipc);


                    }
                });
            }); //fin datos del arriendo

            //boton guardar edicion de arriendo
            $("#btn_agregar_editar").on('click', function(event) {
                event.preventDefault();
                var idArriendo = $(this).data('id');

                var fecha_devolucion = $("#fechaDevolucionEditInput").val();
                var fecha_entrega = $("#fechaEntregaEditInput").val();
                var valor_arriendo = $("#valorArriendoEditInput").val();
                var mes_garantia = $("#mesGarantiaEditInput").val();
                var gastos_comunes = $("#gastosComunesEditInput").val();
                var fecha_pago = $("#fechaPagoEditInput").val();
                var propiedad = $("#propiedadesEditInput").val();
                var arrendatario = $("#arrendatarioEditInput").val();
                var comisiones = $("#comisionesEditInput").val();
                var estadoedit = $("#estadoedit").val();
                var reajusteedit = $("#reajusteInputedit").val();

                argumentos = {
                    idArriendo: idArriendo,
                    fecha_devolucion: fecha_devolucion,
                    fecha_entrega: fecha_entrega,
                    valor_arriendo: valor_arriendo,
                    mes_garantia: mes_garantia,
                    gastos_comunes: gastos_comunes,
                    fecha_pago: fecha_pago,
                    propiedad: propiedad,
                    arrendatario: arrendatario,
                    comisiones: comisiones,
                    estadoedit: estadoedit,
                    reajusteedit: reajusteedit
                };

                console.log(argumentos);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/arriendos/add_editar_arriendos') }}',
                    type: 'POST',
                    datatype: 'json',
                    data: argumentos,
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#editarArriendo").modal('hide');
                        $("#successModal").modal('show');
                        $('#texto_success').text('Arriendo Editado Correctamente');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#editarArriendo").modal('hide');
                        $('#modalerror').modal('show');
                    }
                });
            }); // fin editar arriendo

            //boton eliminar arrendatario
            $(".borrar-arriendo").on('click', function(event) {
                event.preventDefault();
                var idArriendo = $(this).data('id');
                console.log('Arriendos: ' + idArriendo);

                var estado = 0;

                argumentos = {
                    idArriendo: idArriendo,
                    estado: estado
                };

                $("#modalinfo").modal('show');
                $("#confirmDelete").click(function() {
                    $("#modalinfo").modal('hide');
                    // Realizar la solicitud AJAX
                    $.ajax({
                        url: '{{ url('/arriendos/eliminar') }}',
                        type: 'POST',
                        datatype: 'json',
                        data: argumentos,
                        success: function(respuesta) {
                            console.log("respuesta", respuesta);
                            $("#modalinfo").modal('hide');
                            $("#successModal").modal('show');
                            $('#texto_success').text(
                                'Arrendatario Eliminado Correctamente');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("Error:", errorThrown);
                            $("#modalinfo").modal('hide');
                            $('#modalerror').modal('show');
                        }
                    });
                });
            }); // fin eliminar arrendatario

            //funcion al cerrar modal sucess actualice los datos
            $("#cerrar_error").click(function() {
                $("#modalerror").modal('hide');
            });

            //funcion al cerrar modal sucess actualice los datos
            $("#close_success").click(function() {
                $("#successModal").modal('hide');
                location.reload();
            });

        });
        // Botón buscar valor de la propiedad
        $("#propiedadesInput").on('change', function(event) {
            event.preventDefault();
            var id_propiedad = $(this).val(); // Obtener el valor seleccionado del select
            console.log('ID de la propiedad seleccionada: ' + id_propiedad);

            if (!id_propiedad) {
                console.log("No se seleccionó ninguna propiedad.");
                $("#valorArriendoInput").val(''); // Limpiar el input si no hay selección
                $("#valorArriendoAñocorridoInput").val(''); // Limpiar el otro input también
                return;
            }

            // Realizar la solicitud AJAX
            $.ajax({
                url: `/propiedades/${id_propiedad}/valor-arriendo`, // Ruta configurada en Laravel
                type: 'GET',
                dataType: 'json',
                success: function(respuesta) {
                    console.log("Respuesta del servidor:", respuesta);

                    if (respuesta) {
                        // Verificar si los valores 'diciembre' y 'año_corrido' existen
                        const valorDiciembre = respuesta.diciembre || 0;
                        const valorAnoCorrido = respuesta.ano_corrido || 0;

                        // Formatear los valores recibidos con separadores de miles
                        const valorFormateado = new Intl.NumberFormat('es-CL', {
                            useGrouping: true
                        }).format(valorDiciembre);
                        const valorFormateadoAnocorrido = new Intl.NumberFormat('es-CL', {
                            useGrouping: true
                        }).format(valorAnoCorrido);

                        // Actualizar los inputs con los valores formateados
                        $("#valorArriendoInput").val(valorDiciembre);
                        $("#valorArriendoAñocorridoInput").val(valorAnoCorrido);
                    } else {
                        console.log("No se encontró el valor del arriendo.");
                        $("#valorArriendoInput").val('');
                        $("#valorArriendoAñocorridoInput").val('');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error al obtener el valor del arriendo:", errorThrown);
                    alert('Hubo un error al obtener el valor del arriendo. Intente nuevamente.');
                }
            });
        });


        function formatCurrency(inputId) {
            document.getElementById(inputId).addEventListener('input', function(event) {
                let value = event.target.value.replace(/\D/g, ''); // Elimina cualquier cosa que no sea dígito
                value = new Intl.NumberFormat('es-CL').format(value); // No se especifica minimumFractionDigits
                event.target.value = value;
            });
        }

        // Aplicar a los campos necesarios
        formatCurrency('valorArriendoInput');
        formatCurrency('valorreal');
        formatCurrency('mesGarantiaInput');
        formatCurrency('gastosComunesInput');
        formatCurrency('valorArriendoEditInput');
        formatCurrency('mesGarantiaEditInput');
        formatCurrency('gastosComunesEditInput');



        ////MOSTRAR MODAL DE TABLA DE ARCHIVOS ///
        $(".btn-Contrato").on('click', function(event) {
            event.preventDefault();

            var id_contrato = $(this).data('id');

            $.ajax({
                    url: '/Mostrar/Archivo/' + id_contrato,
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
                                    '" target="t_blank">' + nombreArchivo + '</a>'
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
                    $('#btn_agregardos').data('id', id_contrato);
                });
        });
        ////////////////////////////lista de Documentos agregados /////////////////////////
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
                let idArriendo = $(this).data('id'); // Obtén el ID del arriendo del botón presionado
                console.log("ID de arriendo para guardar archivos:", idArriendo);

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
                    url: '/archivos/guardar/' + idArriendo, // Ruta del controlador en Laravel
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // alert('Archivos guardados exitosamente');
                        $('#ModificarArchivoModal').modal('hide');
                        $('#modalexito').modal('show');

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
            let hoy = new Date();
            let año = hoy.getFullYear();
            let mes = String(hoy.getMonth() + 1).padStart(2, '0');

            // Día máximo: si el mes tiene menos de 30 días, ajusta
            let ultimoDia = new Date(año, hoy.getMonth() + 1, 0).getDate();
            let maxDia = (ultimoDia >= 30) ? 30 : ultimoDia;

            let minFecha = `${año}-${mes}-01`;
            let maxFecha = `${año}-${mes}-${String(maxDia).padStart(2, '0')}`;

            $("#fechaPagoInput").attr("min", minFecha);
            $("#fechaPagoInput").attr("max", maxFecha);

            // Valor inicial
            let dia = hoy.getDate();
            if (dia > maxDia) dia = maxDia;
            $("#fechaPagoInput").val(`${año}-${mes}-${String(dia).padStart(2, '0')}`);
        });




        $(document).ready(function() {
            var contratoId; // Variable para almacenar el ID del contrato a eliminar

            // Delegación de eventos para el botón de eliminación
            $(document).on('click', '.borrar-contrato-btn', function(e) {
                e.preventDefault(); // Evitar el comportamiento por defecto del enlace

                // Obtener el ID del contrato
                contratoId = $(this).data('id'); // Obtener el ID del contrato
                $('#confirmarEliminarContratoBtn').data('id',
                    contratoId); // Pasar el ID al botón de confirmación

                // Mostrar el modal
                $('#eliminarContratoModal').modal('show');
            });

            // Escuchar el clic en el botón de confirmar eliminación
            $('#confirmarEliminarContratoBtn').on('click', function() {
                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/elimicontra/' + contratoId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Contrato eliminado exitosamente.');
                        // Eliminar la fila correspondiente de la tabla
                        $('a.borrar-contrato-btn[data-id="' + contratoId + '"]').closest('tr')
                            .remove();
                        $('#eliminarContratoModal').modal('hide'); // Cerrar el modal
                    },
                    error: function(xhr) {
                        alert('Error al eliminar el contrato: ' + xhr.responseJSON.error);
                    }
                });
            });

        });

        // Manejar el clic en el botón de eliminar contrato
    </script>
@endsection
