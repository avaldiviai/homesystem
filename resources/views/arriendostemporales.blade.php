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
                    {{-- SECCIÓN  --}}
                    <div class="px-4 py-4">

                        {{-- Cabecera de columnas --}}
                        <div class="pla-row-header d-none d-lg-grid mb-2">
                            <div class="pla-col-label"><i class="fa-solid fa-tag me-1"></i> Seccion</div>
                            <div class="pla-col-label"><i class="fa-solid fa-folder-open me-1"></i> Documentos</div>
                            <div class="pla-col-label"><i class="fa-solid fa-calculator me-1"></i> Total Mes</div>
                        </div>

                        {{-- FILA 1 – Arriendo --}}
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
                                    style="background:#E67E22; color:#fff; font-size:.7rem;">{{ $countArriendos }}</span>
                            </div>

                            {{-- Col 2: Documentos --}}
                            <div class="pla-cell pla-cell--docs">
                                <div class="pla-doc-zone" id="docs-1">

                                    @if ($arriendos->count())
                                        @foreach ($arriendos as $arriendo)
                                            @php
                                                $archivos = json_decode($arriendo->archivo, true) ?? [];
                                            @endphp

                                            @foreach ($archivos as $archivo)
                                                <a href="{{ asset('storage/' . $archivo) }}" target="_blank"
                                                    class="d-block text-decoration-none mb-1">

                                                    <i class="fa-solid fa-file text-danger"></i>
                                                    {{ basename($archivo) }}

                                                </a>
                                            @endforeach
                                        @endforeach
                                    @else
                                        <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.4rem;color:#ccc;"></i>

                                        <span style="font-size:.78rem;color:#aaa;">
                                            Sin archivos aún
                                        </span>
                                    @endif

                                </div>
                                <div class="pla-actions mt-2">
                                    <button class="pla-abtn pla-abtn--filled btn-agregar" data-tipo="1"
                                        data-titulo="Arriendos" data-color="#E67E22" style="background:#E67E22;">
                                        <i class="fa-solid fa-plus"></i> Agregar
                                    </button>
                                    <button class="pla-abtn btn-ver" data-tipo="1"
                                        style="border-color:#E67E22; color:#E67E22;" data-titulo="Arriendos"
                                        data-color="#E67E22">
                                        <i class="fa-solid fa-eye"></i> Ver
                                    </button>
                                </div>
                            </div>

                            {{-- Col 3: Total Mes --}}
                            <div class="pla-cell pla-cell--total">
                                <div class="pla-total-inner">
                                    <div class="pla-tlabel">Total Acumulado</div>
                                    <div class="pla-tvalue" id="tv-1" style="color:#E67E22;">$
                                        {{ number_format($totalArriendos, 2) }}</div>
                                    <div class="pla-tnota">Suma de Arriendos</div>
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
                                    style="background:#2980B9; color:#fff; font-size:.7rem;">{{ $countAseos }}</span>
                            </div>

                            <div class="pla-cell pla-cell--docs">
                                <div class="pla-doc-zone" id="docs-2">

                                    @if ($aseos->count())
                                        @foreach ($aseos as $aseo)
                                            @php
                                                $archivos = json_decode($aseo->archivo, true) ?? [];
                                            @endphp

                                            @foreach ($archivos as $archivo)
                                                <a href="{{ asset('storage/' . $archivo) }}" target="_blank"
                                                    class="d-block text-decoration-none mb-1">

                                                    <i class="fa-solid fa-file text-primary"></i>
                                                    {{ basename($archivo) }}

                                                </a>
                                            @endforeach
                                        @endforeach
                                    @else
                                        <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.4rem;color:#ccc;"></i>

                                        <span style="font-size:.78rem;color:#aaa;">
                                            Sin archivos aún
                                        </span>
                                    @endif

                                </div>
                                <div class="pla-actions mt-2">
                                    <button class="pla-abtn pla-abtn--filled btn-agregar" data-tipo="2" data-titulo="Aseos"
                                        data-color="#2980B9" style="background:#2980B9;">
                                        <i class="fa-solid fa-plus"></i> Agregar
                                    </button>
                                    <button class="pla-abtn btn-ver" data-tipo="2" data-titulo="Aseos"
                                        data-color="#2980B9" style="border-color:#2980B9; color:#2980B9;">
                                        <i class="fa-solid fa-eye"></i> Ver
                                    </button>
                                </div>
                            </div>

                            <div class="pla-cell pla-cell--total">
                                <div class="pla-total-inner">
                                    <div class="pla-tlabel">Total acumulado</div>
                                    <div class="pla-tvalue" id="tv-2">$ {{ number_format($totalAseos, 2) }}</div>
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

                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                                    <div>
                                        <h5 class="fw-700 mb-0">
                                            <i class="fa-solid fa-chart-pie me-2 text-warning"></i>
                                            Resumen Financiero Mensual
                                        </h5>

                                        <small class="text-muted">
                                            Totales por mes seleccionado
                                        </small>
                                    </div>

                                    <div class="d-flex gap-2 align-items-center">

                                        <input type="month" id="mesGrafico" class="form-control"
                                            value="{{ date('Y-m') }}" style="width:180px;">

                                        <button type="button" class="btn btn-warning active" id="btn-pie">

                                            <i class="fa-solid fa-chart-pie"></i>
                                            Pastel

                                        </button>

                                        <button type="button" class="btn btn-outline-warning" id="btn-bar">

                                            <i class="fa-solid fa-chart-column"></i>
                                            Barras

                                        </button>

                                    </div>

                                </div>

                                <div class="row g-3 mb-4" id="grafico-totales"></div>

                                <hr>

                                <div class="d-flex justify-content-center">

                                    <div style="width:100%; max-width:700px;">

                                        <canvas id="graficoConsolidado"></canvas>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div><!-- /flex-grow-1 -->
                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>

    {{-- ZONA DE MODALES --}}
    {{-- Agergar Arriendo y Aseo --}}
    <div class="modal fade" id="modalAgregarPlanilla" tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0">

                <div class="modal-header text-white" id="headerAgregar" style="background:#E67E22;">

                    <div>
                        <h4 class="mb-0">
                            Agregar - <span id="tituloAgregar"></span>
                        </h4>
                    </div>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                    </button>

                </div>

                <form id="formPlanilla" enctype="multipart/form-data">

                    @csrf

                    <input type="hidden" name="tipo" id="tipo_planilla">

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-4">

                                <label class="form-label fw-bold">
                                    FECHA
                                </label>

                                <input type="date" name="fecha" class="form-control" required>

                            </div>

                            <div class="col-md-8">

                                <label class="form-label fw-bold">
                                    ARCHIVOS
                                </label>

                                <input type="file" name="archivos[]" multiple class="form-control" required>

                                <small class="text-muted">
                                    xlsx, xls, csv, pdf
                                </small>

                            </div>

                        </div>

                        <div class="mt-4">

                            <label class="form-label fw-bold">
                                TOTAL MES ($)
                            </label>

                            <input type="text" name="total_mes" id="total_mes" class="form-control"
                                placeholder="Ej: 1.250.000">

                        </div>

                        <div class="mt-3 text-warning">

                            <i class="fa-solid fa-circle-info"></i>

                            Se utilizará este valor para los gráficos.

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                            Cancelar

                        </button>

                        <button type="submit" class="btn text-white" id="btnGuardarPlanilla">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Ver Arriendos y aseos  --}}
    <div class="modal fade" id="modalVerPlanilla" tabindex="-1">

        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content border-0">

                <div class="modal-header text-white" id="headerVer" style="background:#E67E22;">

                    <div>

                        <h4 class="mb-0">
                            <span id="tituloVer"></span>
                        </h4>

                        <small>
                            Historial completo
                        </small>

                    </div>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Archivos</th>
                                    <th>Total</th>
                                    <th width="120">Acciones</th>
                                </tr>
                            </thead>

                            <tbody id="tablaPlanillas">
                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">

                        Cerrar

                    </button>

                </div>

            </div>

        </div>

    </div>

    {{-- Editar Arriendos y aseos --}}
    <div class="modal fade" id="modalEditarPlanilla" tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 shadow">

                <div class="modal-header text-white" id="headerEditar" style="background:#E67E22;">

                    <div>
                        <h4 class="mb-0" id="tituloEditar">
                            Editar Registro
                        </h4>

                        <small>
                            Modificar información existente
                        </small>
                    </div>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                    </button>

                </div>

                <form id="formEditarPlanilla">

                    @csrf

                    <input type="hidden" id="edit_id" name="id">
                    <input type="hidden" id="edit_tipo" name="tipo">

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Fecha
                                </label>

                                <input type="date" class="form-control" id="edit_fecha" name="fecha" required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Total
                                </label>

                                <input type="number" class="form-control" id="edit_total" name="total" required>

                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Archivos actuales
                            </label>

                            <div id="edit_archivos_actuales" class="border rounded p-3 bg-light">

                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Agregar nuevos archivos
                            </label>

                            <input type="file" class="form-control" name="archivos[]" multiple>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                            Cancelar

                        </button>

                        <button type="submit" class="btn btn-success" id="btnActualizarPlanilla">

                            <i class="fa-solid fa-save me-1"></i>
                            Actualizar

                        </button>

                    </div>

                </form>

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
        let grafico = null;
        let tipoGrafico = 'pie';

        $('#btn-pie').click(function() {

            tipoGrafico = 'pie';

            $('#btn-pie')
                .removeClass('btn-outline-warning')
                .addClass('btn-warning');

            $('#btn-bar')
                .removeClass('btn-warning')
                .addClass('btn-outline-warning');

            cargarGrafico();
        });

        $('#btn-bar').click(function() {

            tipoGrafico = 'bar';

            $('#btn-bar')
                .removeClass('btn-outline-warning')
                .addClass('btn-warning');

            $('#btn-pie')
                .removeClass('btn-warning')
                .addClass('btn-outline-warning');

            cargarGrafico();
        });

        $('#mesGrafico').change(function() {

            cargarGrafico();

        });

        function cargarGrafico() {
            let mes = $('#mesGrafico').val();

            $.ajax({

                url: '/resumen-financiero',

                type: 'GET',

                data: {
                    mes: mes
                },

                success: function(data) {

                    let totalGeneral =
                        parseFloat(data.arriendos) +
                        parseFloat(data.aseos);

                    $('#grafico-totales').html(`

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm">

                        <div class="card-body text-center">

                            <h6>Arriendos</h6>

                            <h4 class="text-warning">

                                $ ${Number(data.arriendos)
                                    .toLocaleString('es-CL')}

                            </h4>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm">

                        <div class="card-body text-center">

                            <h6>Aseos</h6>

                            <h4 class="text-primary">

                                $ ${Number(data.aseos)
                                    .toLocaleString('es-CL')}

                            </h4>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm">

                        <div class="card-body text-center">

                            <h6>Total General</h6>

                            <h4 class="text-success">

                                $ ${Number(totalGeneral)
                                    .toLocaleString('es-CL')}

                            </h4>

                        </div>

                    </div>

                </div>

            `);

                    if (grafico) {

                        grafico.destroy();

                    }

                    let ctx = document
                        .getElementById('graficoConsolidado')
                        .getContext('2d');

                    grafico = new Chart(ctx, {

                        type: tipoGrafico,

                        data: {

                            labels: [
                                'Arriendos',
                                'Aseos'
                            ],

                            datasets: [{

                                label: 'Total',

                                data: [
                                    data.arriendos,
                                    data.aseos
                                ],

                                backgroundColor: [
                                    '#E67E22',
                                    '#2980B9'
                                ],

                                borderWidth: 1

                            }]
                        },

                        options: {

                            responsive: true,

                            maintainAspectRatio: false,

                            plugins: {

                                legend: {

                                    display: true,

                                    position: 'bottom'

                                }

                            }

                        }

                    });

                }

            });
        }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            console.log('Listo para trabajar');

            cargarGrafico();

            $('#btn-pie').click(function() {

                tipoGrafico = 'pie';

                $('#btn-pie')
                    .addClass('active btn-warning')
                    .removeClass('btn-outline-warning');

                $('#btn-bar')
                    .removeClass('active btn-warning')
                    .addClass('btn-outline-warning');

                cargarGrafico();
            });

            $('#btn-bar').click(function() {

                tipoGrafico = 'bar';

                $('#btn-bar')
                    .addClass('active btn-warning')
                    .removeClass('btn-outline-warning');

                $('#btn-pie')
                    .removeClass('active btn-warning')
                    .addClass('btn-outline-warning');

                cargarGrafico();
            });

            $(document).on('click', '.btn-agregar', function(e) {

                e.preventDefault();

                let tipo = $(this).data('tipo');
                let titulo = $(this).data('titulo');
                let color = $(this).data('color');

                $('#tipo_planilla').val(tipo);
                $('#tituloAgregar').text(titulo);
                $('#headerAgregar').css('background', color);
                $('#btnGuardarPlanilla').css('background', color);

                let modal = new bootstrap.Modal(
                    document.getElementById('modalAgregarPlanilla')
                );

                modal.show();

            });

            $(document).on('click', '.btn-ver', function(e) {

                e.preventDefault();

                let tipo = $(this).data('tipo');
                let titulo = $(this).data('titulo');
                let color = $(this).data('color');

                $('#tituloVer').text(titulo);
                $('#headerVer').css('background', color);

                cargarPlanillas(tipo);

                let modal = new bootstrap.Modal(
                    document.getElementById('modalVerPlanilla')
                );

                modal.show();

            });

            $('#formPlanilla').submit(function(e) {

                e.preventDefault();

                let tipo = $('#tipo_planilla').val();

                let url = '';

                if (tipo == 1) {
                    url = "{{ route('arriendos.store') }}";
                } else if (tipo == 2) {
                    url = "{{ route('aseos.store') }}";
                }

                let formData = new FormData(this);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(resp) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Registro guardado',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });

                        $('#modalAgregarPlanilla').modal('hide');

                        $('#formPlanilla')[0].reset();

                    },

                    error: function(xhr) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo guardar',
                            confirmButton: false,
                            timer: 1500,
                        });

                    }
                });

            });

            function cargarPlanillas(tipo) {

                console.log('Tipo:', tipo);

                let url = '';

                if (tipo == 1) {
                    url = '/arriendos/listar';
                } else {
                    url = '/aseos/listar';
                }

                $.ajax({
                    url: url,
                    type: 'GET',

                    success: function(data) {

                        let html = '';

                        data.forEach((item, index) => {

                            let archivos = JSON.parse(item.archivo || '[]');

                            let listaArchivos = '';

                            archivos.forEach(archivo => {

                                let nombre = archivo.split('/').pop();

                                listaArchivos += `
                        <a href="/storage/${archivo}"
                            target="_blank"
                            class="d-block">
                            <i class="fa fa-file me-1"></i>
                            ${nombre}
                        </a>
                    `;
                            });

                            html += `
                    <tr>

                        <td>${index + 1}</td>

                        <td>${item.fecha}</td>

                        <td>
                            ${listaArchivos}
                        </td>

                        <td>
                            $ ${Number(item.total)
                                .toLocaleString('es-CL')}
                        </td>

                        <td>

                            <button
                                class="btn btn-warning btn-sm btn-editar"
                                data-id="${item.id}"
                                data-tipo="${tipo}">

                                <i class="fa fa-pencil"></i>

                            </button>

                            <button
                                class="btn btn-danger btn-sm btn-eliminar"
                                data-id="${item.id}"
                                data-tipo="${tipo}">

                                <i class="fa fa-trash"></i>

                            </button>

                        </td>

                    </tr>
                `;
                        });

                        $('#tablaPlanillas').html(html);

                    }
                });
            }

            $(document).on('click', '.btn-editar', function() {

                let id = $(this).data('id');
                let tipo = $(this).data('tipo');

                let url = '';

                if (tipo == 1) {

                    url = '/arriendos/' + id;

                    $('#headerEditar').css('background', '#E67E22');

                    $('#tituloEditar').text('Editar Arriendo');

                } else {

                    url = '/aseos/' + id;

                    $('#headerEditar').css('background', '#2980B9');

                    $('#tituloEditar').text('Editar Aseo');
                }

                $.get(url, function(data) {

                    $('#edit_id').val(data.id);
                    $('#edit_tipo').val(tipo);

                    $('#edit_fecha').val(data.fecha);
                    $('#edit_total').val(data.total);

                    let archivos = JSON.parse(data.archivo || '[]');

                    let html = '';

                    archivos.forEach((archivo, index) => {

                        let nombre = archivo.split('/').pop();

                        html += `
                            <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2">

                                <a href="/storage/${archivo}"
                                    target="_blank">

                                    <i class="fa-solid fa-file me-2"></i>
                                    ${nombre}

                                </a>

                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm btn-eliminar-archivo"
                                    data-index="${index}"
                                    data-archivo="${archivo}"
                                    data-id="${data.id}"
                                    data-tipo="${$('#edit_tipo').val()}">

                                    <i class="fa fa-trash"></i>

                                </button>

                            </div>
                        `;
                    });

                    $('#edit_archivos_actuales').html(html);

                    $('#modalEditarPlanilla').modal('show');

                });

            });

            $('#formEditarPlanilla').submit(function(e) {

                e.preventDefault();

                let id = $('#edit_id').val();
                let tipo = $('#edit_tipo').val();

                let url = '';

                if (tipo == 1) {
                    url = '/arriendos/update/' + id;
                } else {
                    url = '/aseos/update/' + id;
                }

                let formData = new FormData(this);

                $.ajax({

                    url: url,
                    type: 'POST',
                    data: formData,

                    processData: false,
                    contentType: false,

                    success: function(resp) {

                        Swal.fire({
                            icon: 'success',
                            title: resp.message,
                            showCancelButton: false,
                            showCnfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });

                        $('#modalEditarPlanilla').modal('hide');

                        cargarPlanillas(tipo);
                    }

                });

            });

            $(document).on('click', '.btn-eliminar-archivo', function() {

                let id = $(this).data('id');
                let tipo = $(this).data('tipo');
                let archivo = $(this).data('archivo');

                let url = '';

                if (tipo == 1) {
                    url = '/arriendos/archivo/' + id;
                } else {
                    url = '/aseos/archivo/' + id;
                }

                $.ajax({

                    url: url,
                    type: 'DELETE',

                    data: {
                        archivo: archivo,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function() {

                        $('.btn-editar[data-id="' + id + '"]').click();

                    }

                });

            });

            $(document).on('click', '.btn-eliminar', function() {

                let id = $(this).data('id');
                let tipo = $(this).data('tipo');

                let url = '';

                if (tipo == 1) {
                    url = '/arriendos/delete/' + id;
                } else {
                    url = '/aseos/delete/' + id;
                }

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#E67E22',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registro eliminado',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'No se pudo eliminar',
                                    confirmButton: false,
                                    timer: 1500,
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
