@extends('layouts.app')

@section('content')
    <div class="container-fluid overflow-hidden" style="background:#fff;">
        <div class="row" style="flex-wrap:nowrap; height:100vh; overflow:hidden;">
            @include('layouts.sidebar')

            <div class="col d-flex flex-column" style="padding:0; background:#f5f4f0; height:100vh; overflow-y:auto;">
                <div class="flex-grow-1">

                    {{-- ── HEADER ── --}}
                    <div class="px-4 pt-4 pb-3" style="background:#fff; border-bottom:2px solid #f0ede8;">
                        <h1 class="fw-800 mb-1" style="font-size:1.75rem; color:#1a1a2e; letter-spacing:-.5px;">
                            <i class="fa-solid fa-file-lines me-2" style="color:#E67E22;"></i>
                            Planillas de Empresa
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
                            <div class="pla-col-label"><i class="fa-solid fa-tag me-1"></i> Planilla</div>
                            <div class="pla-col-label"><i class="fa-solid fa-folder-open me-1"></i> Documentos</div>
                            <div class="pla-col-label"><i class="fa-solid fa-calculator me-1"></i> Total Mes</div>
                        </div>

                        {{-- ════════════════════════════════════════════════════════════ --}}
                        {{-- FILA 1 – 10% Administración --}}
                        {{-- ════════════════════════════════════════════════════════════ --}}
                        <div class="pla-row mb-3" data-tipo="1">

                            {{-- Col 1: Info --}}
                            <div class="pla-cell pla-cell--info" style="border-left-color:#E67E22;">
                                <div class="pla-cell-icon" style="background:#E67E22;">
                                    <i class="fa-solid fa-percent"></i>
                                </div>
                                <div>
                                    <div class="pla-cell-title">Planilla 10% Administración</div>
                                    <div class="pla-cell-sub">El 10% del total se refleja en el gráfico</div>
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

                        {{-- ════════════════════════════════════════════════════════════ --}}
                        {{-- FILA 2 – Arriendos Mensuales --}}
                        {{-- ════════════════════════════════════════════════════════════ --}}
                        <div class="pla-row mb-3" data-tipo="2">

                            <div class="pla-cell pla-cell--info" style="border-left-color:#2980B9;">
                                <div class="pla-cell-icon" style="background:#2980B9;">
                                    <i class="fa-solid fa-key"></i>
                                </div>
                                <div>
                                    <div class="pla-cell-title">Planilla Arriendos Mensuales</div>
                                    <div class="pla-cell-sub">Total de arriendos cobrados en el mes</div>
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

                        {{-- ════════════════════════════════════════════════════════════ --}}
                        {{-- FILA 3 – Ventas --}}
                        {{-- ════════════════════════════════════════════════════════════ --}}
                        <div class="pla-row mb-3" data-tipo="3">

                            <div class="pla-cell pla-cell--info" style="border-left-color:#27AE60;">
                                <div class="pla-cell-icon" style="background:#27AE60;">
                                    <i class="fa-solid fa-tag"></i>
                                </div>
                                <div>
                                    <div class="pla-cell-title">Planilla Ventas</div>
                                    <div class="pla-cell-sub">Ingresos totales por ventas del período</div>
                                </div>
                                <span class="badge rounded-pill ms-auto" id="cnt-3"
                                    style="background:#27AE60; color:#fff; font-size:.7rem;">0</span>
                            </div>

                            <div class="pla-cell pla-cell--docs">
                                <div class="pla-doc-zone" id="docs-3">
                                    <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.4rem;color:#ccc;"></i>
                                    <span style="font-size:.78rem;color:#aaa;">Sin archivos aún</span>
                                </div>
                                <div class="pla-actions mt-2">
                                    <button class="pla-abtn pla-abtn--filled btn-agregar" data-tipo="3"
                                        style="background:#27AE60;">
                                        <i class="fa-solid fa-plus"></i> Agregar
                                    </button>
                                    <button class="pla-abtn btn-ver" data-tipo="3"
                                        style="border-color:#27AE60; color:#27AE60;">
                                        <i class="fa-solid fa-eye"></i> Ver
                                    </button>
                                </div>
                            </div>

                            <div class="pla-cell pla-cell--total">
                                <div class="pla-total-inner">
                                    <div class="pla-tlabel">Total acumulado</div>
                                    <div class="pla-tvalue" id="tv-3">$ 0</div>
                                    <div class="pla-tnota">Suma de registros</div>
                                </div>
                                <div class="pla-to-chart">
                                    <i class="fa-solid fa-arrow-right"></i> al gráfico
                                </div>
                            </div>

                        </div><!-- /fila 3 -->

                        <div class="pla-divider"></div>

                        {{-- ════════════════════════════════════════════════════════════ --}}
                        {{-- FILA 4 – Obras --}}
                        {{-- ════════════════════════════════════════════════════════════ --}}
                        <div class="pla-row mb-3" data-tipo="4">

                            <div class="pla-cell pla-cell--info" style="border-left-color:#8E44AD;">
                                <div class="pla-cell-icon" style="background:#8E44AD;">
                                    <i class="fa-solid fa-helmet-safety"></i>
                                </div>
                                <div>
                                    <div class="pla-cell-title">Planilla Obras</div>
                                    <div class="pla-cell-sub">Costos de obras y servicios del mes</div>
                                </div>
                                <span class="badge rounded-pill ms-auto" id="cnt-4"
                                    style="background:#8E44AD; color:#fff; font-size:.7rem;">0</span>
                            </div>

                            <div class="pla-cell pla-cell--docs">
                                <div class="pla-doc-zone" id="docs-4">
                                    <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.4rem;color:#ccc;"></i>
                                    <span style="font-size:.78rem;color:#aaa;">Sin archivos aún</span>
                                </div>
                                <div class="pla-actions mt-2">
                                    <button class="pla-abtn pla-abtn--filled btn-agregar" data-tipo="4"
                                        style="background:#8E44AD;">
                                        <i class="fa-solid fa-plus"></i> Agregar
                                    </button>
                                    <button class="pla-abtn btn-ver" data-tipo="4"
                                        style="border-color:#8E44AD; color:#8E44AD;">
                                        <i class="fa-solid fa-eye"></i> Ver
                                    </button>
                                </div>
                            </div>

                            <div class="pla-cell pla-cell--total">
                                <div class="pla-total-inner">
                                    <div class="pla-tlabel">Total acumulado</div>
                                    <div class="pla-tvalue" id="tv-4">$ 0</div>
                                    <div class="pla-tnota">Suma de registros</div>
                                </div>
                                <div class="pla-to-chart">
                                    <i class="fa-solid fa-arrow-right"></i> al gráfico
                                </div>
                            </div>

                        </div><!-- /fila 4 -->

                        <div class="pla-divider"></div>

                        {{-- ════════════════════════════════════════════════════════════ --}}
                        {{-- FILA 5 – Sueldos (próximamente) --}}
                        {{-- ════════════════════════════════════════════════════════════ --}}
                        <div class="pla-row pla-row--disabled mb-3">

                            <div class="pla-cell pla-cell--info" style="border-left-color:#95A5A6;">
                                <div class="pla-cell-icon" style="background:#95A5A6;">
                                    <i class="fa-solid fa-money-check-dollar"></i>
                                </div>
                                <div>
                                    <div class="pla-cell-title" style="color:#95A5A6;">Sueldos</div>
                                    <div class="pla-cell-sub">Próximamente disponible</div>
                                </div>
                                <span class="badge rounded-pill ms-auto"
                                    style="background:#BDC3C7; color:#fff; font-size:.7rem;">Pendiente</span>
                            </div>

                            <div class="pla-cell pla-cell--docs">
                                <div class="pla-doc-zone pla-doc-zone--disabled"
                                    style="flex-direction:column; align-items:center; justify-content:center;">
                                    <i class="fa-solid fa-lock fa-xl mb-1" style="color:#BDC3C7;"></i>
                                    <span style="font-size:.78rem;color:#BDC3C7;">Disponible próximamente</span>
                                </div>
                            </div>

                            <div class="pla-cell pla-cell--total">
                                <div class="pla-total-inner">
                                    <div class="pla-tlabel">Total acumulado</div>
                                    <div class="pla-tvalue" style="color:#BDC3C7;">$ —</div>
                                    <div class="pla-tnota">No disponible aún</div>
                                </div>
                            </div>

                        </div><!-- /fila 5 -->

                        <div class="pla-divider"></div>

                        {{-- ════════════════════════════════════════════════════════════ --}}
                        {{-- FILA 6 – Arqueo (sin total mes) --}}
                        {{-- ════════════════════════════════════════════════════════════ --}}
                        <div class="pla-row" data-tipo="6">

                            <div class="pla-cell pla-cell--info" style="border-left-color:#C0392B;">
                                <div class="pla-cell-icon" style="background:#C0392B;">
                                    <i class="fa-solid fa-calculator"></i>
                                </div>
                                <div>
                                    <div class="pla-cell-title">Planilla Arqueo</div>
                                    <div class="pla-cell-sub">Registro de arqueo de caja</div>
                                </div>
                                <span class="badge rounded-pill ms-auto" id="cnt-6"
                                    style="background:#C0392B; color:#fff; font-size:.7rem;">0</span>
                            </div>

                            <div class="pla-cell pla-cell--docs">
                                <div class="pla-doc-zone" id="docs-6">
                                    <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.4rem;color:#ccc;"></i>
                                    <span style="font-size:.78rem;color:#aaa;">Sin archivos aún</span>
                                </div>
                                <div class="pla-actions mt-2">
                                    <button class="pla-abtn pla-abtn--filled btn-agregar" data-tipo="6"
                                        style="background:#C0392B;">
                                        <i class="fa-solid fa-plus"></i> Agregar
                                    </button>
                                    <button class="pla-abtn btn-ver" data-tipo="6"
                                        style="border-color:#C0392B; color:#C0392B;">
                                        <i class="fa-solid fa-eye"></i> Ver
                                    </button>
                                </div>
                            </div>

                            {{-- Sin total mes --}}
                            <div class="pla-cell pla-cell--total pla-cell--no-total">
                                <div style="text-align:center; color:#BDC3C7;">
                                    <i class="fa-solid fa-ban fa-xl mb-1"></i>
                                    <div style="font-size:.78rem;">Sin total mes</div>
                                </div>
                            </div>

                        </div><!-- /fila 6 -->

                    </div><!-- /px-4 py-4 -->

                    {{-- ══════════════════════════════════════════════════════════════ --}}
                    {{-- ── SECCIÓN GRÁFICOS ─────────────────────────────────────── --}}
                    {{-- ══════════════════════════════════════════════════════════════ --}}
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
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    {{-- MODAL AGREGAR --}}
    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="modalAgregar" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content pla-modal">
                <div class="modal-header pla-mh" id="mhAgregar">
                    <div class="d-flex align-items-center gap-3">
                        <div class="pla-icon-wrap" id="mhAgregarIcon">
                            <i id="mhAgregarIco" class="fa-solid fa-file-excel"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0" id="mhAgregarTitulo">Agregar archivo</h5>
                            <small id="mhAgregarNota" style="opacity:.8;"></small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="aTipo">
                    <input type="hidden" id="aSinTotal" value="0">
                    <input type="hidden" id="aEsAdmin" value="0">

                    <div class="pla-step-label mb-2">
                        <span class="pla-step-num">1</span> Fecha y archivos
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="pla-label">Fecha <span class="text-danger">*</span></label>
                            <input type="date" class="pla-input" id="aFecha">
                        </div>
                        <div class="col-md-8">
                            <label class="pla-label">Archivos (puede seleccionar varios) <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="pla-input" id="aArchivos" accept=".xlsx,.xls,.csv,.pdf"
                                multiple>
                            <small class="text-muted">Formatos: xlsx, xls, csv, pdf — máx. 20 MB c/u</small>
                        </div>
                    </div>

                    <div class="pla-step-label mb-2" id="divATotalLabel" style="display:none;">
                        <span class="pla-step-num">2</span> Total mes
                    </div>
                    <div class="row g-3" id="divATotal" style="display:none;">
                        <div class="col-12">
                            <label class="pla-label" id="aTotalLabel">
                                Total Mes ($) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">$</span>
                                <input type="text" class="pla-input" id="aTotal" placeholder="Ej: 1.250.000"
                                    oninput="fmtMiles(this)">
                            </div>
                            <small class="text-warning fw-600" id="aAdminNota" style="display:none;">
                                <i class="fa-solid fa-circle-info me-1"></i>
                                Se calculará el <strong>10 %</strong> de este valor para el gráfico
                            </small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background:#f8f7f4; border-top:1px solid #ece9e4;">
                    <button type="button" class="pla-btn-sec" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="pla-btn-pri" id="btnGuardar">
                        <i class="fa-solid fa-save me-1"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    {{-- MODAL VER ARCHIVOS --}}
    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="modalVer" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content pla-modal">
                <div class="modal-header pla-mh" id="mhVer">
                    <div class="d-flex align-items-center gap-3">
                        <div class="pla-icon-wrap" id="mhVerIconDiv">
                            <i id="mhVerIco" class="fa-solid fa-table"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0" id="mhVerTitulo">Archivos guardados</h5>
                            <small style="opacity:.8;">Historial completo</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="vTipo">
                    <div class="table-responsive">
                        <table class="pla-table w-100" id="tblVer">
                            <thead>
                                <tr>
                                    <th style="width:50px;">#</th>
                                    <th>Fecha</th>
                                    <th>Archivo</th>
                                    <th>Total Mes</th>
                                    <th style="width:130px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyVer">
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Cargando…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer" style="background:#f8f7f4; border-top:1px solid #ece9e4;">
                    <button type="button" class="pla-btn-sec" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    {{-- MODAL EDITAR --}}
    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="modalEditar" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content pla-modal">
                <div class="modal-header" style="background:#34495E; color:#fff;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="pla-icon-wrap"><i class="fa-solid fa-pen"></i></div>
                        <h5 class="modal-title mb-0">Editar Registro</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="eId">
                    <input type="hidden" id="eSinTotal" value="0">
                    <input type="hidden" id="eEsAdmin" value="0">
                    <input type="hidden" id="eTipoEdit" value="">

                    <div class="pla-step-label mb-2">
                        <span class="pla-step-num" style="background:#34495E;">1</span> Fecha y archivo
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="pla-label">Fecha</label>
                            <input type="date" class="pla-input" id="eFecha">
                        </div>
                        <div class="col-md-8">
                            <label class="pla-label">Reemplazar archivo <small
                                    class="text-muted fw-400">(opcional)</small></label>
                            <input type="file" class="pla-input" id="eArchivo" accept=".xlsx,.xls,.csv,.pdf">
                        </div>
                    </div>

                    <div id="divETotalLabel" class="pla-step-label mb-2">
                        <span class="pla-step-num" style="background:#34495E;">2</span> Total mes
                    </div>
                    <div class="col-12" id="divETotal">
                        <label class="pla-label">Total Mes ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">$</span>
                            <input type="text" class="pla-input" id="eTotal" oninput="fmtMiles(this)">
                        </div>
                        <small class="text-warning fw-600" id="eAdminNota" style="display:none;">
                            <i class="fa-solid fa-circle-info me-1"></i>
                            Se usará el 10 % en el gráfico
                        </small>
                    </div>
                </div>
                <div class="modal-footer" style="background:#f8f7f4; border-top:1px solid #ece9e4;">
                    <button type="button" class="pla-btn-sec" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="pla-btn-pri" id="btnEditar">
                        <i class="fa-solid fa-save me-1"></i> Guardar cambios
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    {{-- MODAL ELIMINAR --}}
    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border:none; border-radius:16px; overflow:hidden;">
                <div class="p-4 text-center" style="background:#FDF2F2;">
                    <i class="fa-solid fa-triangle-exclamation fa-2x mb-3" style="color:#E74C3C;"></i>
                    <h5 class="fw-700 mb-1">¿Eliminar este registro?</h5>
                    <p class="text-muted mb-4" style="font-size:.88rem;">Esta acción no se puede deshacer.</p>
                    <input type="hidden" id="elId">
                    <input type="hidden" id="elTipo">
                    <div class="d-flex justify-content-center gap-3">
                        <button class="pla-btn-sec px-4" data-bs-dismiss="modal">Cancelar</button>
                        <button class="pla-btn-danger px-4" id="btnConfEliminar">
                            <i class="fa-solid fa-trash me-1"></i> Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    {{-- MODAL ÉXITO --}}
    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="successModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background:transparent; border:none; max-width:680px;">
                <div class="modal-header alert alert-success mb-0" style="border:none;">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000"
                                    style="width:65px;height:65px;"></lord-icon>
                            </div>
                            <div class="col-8 text-center">
                                <p id="texto_success" class="text-uppercase mb-0 fw-700">Operación exitosa</p>
                            </div>
                            <div class="col-2 text-end">
                                <button class="btn-close" id="btnCloseSuccess"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
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

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
@section('javascript')
    @parent
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const CFG = {
            1: {
                titulo: 'Planilla 10% Administración',
                color: '#E67E22',
                icono: 'fa-percent',
                sinTotal: false,
                esAdmin: true
            },
            2: {
                titulo: 'Planilla Arriendos Mensuales',
                color: '#2980B9',
                icono: 'fa-key',
                sinTotal: false,
                esAdmin: false
            },
            3: {
                titulo: 'Planilla Ventas',
                color: '#27AE60',
                icono: 'fa-tag',
                sinTotal: false,
                esAdmin: false
            },
            4: {
                titulo: 'Planilla Obras',
                color: '#8E44AD',
                icono: 'fa-helmet-safety',
                sinTotal: false,
                esAdmin: false
            },
            6: {
                titulo: 'Planilla Arqueo',
                color: '#C0392B',
                icono: 'fa-calculator',
                sinTotal: true,
                esAdmin: false
            },
        };

        let DB = {
            1: [],
            2: [],
            3: [],
            4: [],
            6: []
        };

        function fmtMiles(el) {
            let v = el.value.replace(/\D/g, '');
            el.value = v.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function parseNum(str) {
            return parseFloat((str || '0').replace(/\./g, '').replace(',', '.')) || 0;
        }

        function money(n) {
            return '$ ' + Number(n).toLocaleString('es-CL', {
                maximumFractionDigits: 0
            });
        }

        // ─── Mini cards sobre el gráfico (con valor real y 10% para Admin) ────────────
        function renderMiniTotales() {
            const container = document.getElementById('grafico-totales');
            let html = '';
            Object.keys(CFG).forEach(t => {
                const c = CFG[t];
                if (c.sinTotal) return;
                const suma = DB[t].reduce((a, b) => a + (parseFloat(b.total_mes) || 0), 0);
                const disp = c.esAdmin ? suma * 0.10 : suma;

                let extraHtml = '';
                if (c.esAdmin) {
                    extraHtml = `<div class="pla-mini-raw">Total real: ${money(suma)}</div>`;
                }

                html += `<div class="col-sm-6 col-lg-3">
            <div class="pla-mini-card">
                <div class="pla-mini-icon" style="background:${c.color};">
                    <i class="fa-solid ${c.icono}"></i>
                </div>
                <div>
                    <div class="pla-mini-label">${c.titulo.replace('Planilla ','')}</div>
                    <div class="pla-mini-value">${money(disp)}</div>
                    ${extraHtml}
                </div>
            </div>
        </div>`;
            });
            container.innerHTML = html;
        }

        // ─── Gráfico ──────────────────────────────────────────────────────────────────
        let chart = null;
        let chartType = 'pie';

        function refreshChart() {
            // Construir dataset incluyendo valor raw para tooltip de Admin
            const datos = Object.keys(CFG).map(t => {
                const c = CFG[t];
                const suma = DB[t].reduce((a, b) => a + (parseFloat(b.total_mes) || 0), 0);
                const val = c.sinTotal ? 0 : (c.esAdmin ? suma * 0.10 : suma);
                return {
                    label: c.titulo.replace('Planilla ', ''),
                    valor: val,
                    raw: suma,
                    esAdmin: c.esAdmin,
                    color: c.color
                };
            }).filter(x => x.valor > 0);

            const canvas = document.getElementById('graficoConsolidado');
            const empty = document.getElementById('grafico-empty');

            renderMiniTotales();

            if (!datos.length) {
                empty.style.display = 'block';
                canvas.style.display = 'none';
                if (chart) {
                    chart.destroy();
                    chart = null;
                }
                return;
            }

            empty.style.display = 'none';
            canvas.style.display = 'block';
            if (chart) chart.destroy();

            chart = new Chart(canvas.getContext('2d'), {
                type: chartType === 'pie' ? 'doughnut' : 'bar',
                data: {
                    labels: datos.map(d => d.label),
                    datasets: [{
                        data: datos.map(d => d.valor),
                        backgroundColor: datos.map(d => d.color + 'CC'),
                        borderColor: datos.map(d => d.color),
                        borderWidth: 2,
                        borderRadius: chartType === 'bar' ? 8 : 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: chartType === 'pie' ? 'right' : 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(ctx) {
                                    const d = datos[ctx.dataIndex];
                                    if (d.esAdmin) {
                                        return [
                                            ' 10% (gráfico): ' + money(d.valor),
                                            ' Total ingresado: ' + money(d.raw)
                                        ];
                                    }
                                    return ' ' + money(ctx.raw);
                                }
                            }
                        }
                    },
                    scales: chartType === 'bar' ? {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: v => money(v)
                            }
                        }
                    } : {}
                }
            });
        }

        function cambiarGrafico(tipo) {
            chartType = tipo;
            document.getElementById('btn-pie').classList.toggle('active', tipo === 'pie');
            document.getElementById('btn-bar').classList.toggle('active', tipo === 'bar');
            refreshChart();
        }

        // ─── Actualizar UI de una fila ────────────────────────────────────────────────
        function refreshCard(tipo) {
            const items = DB[tipo] || [];
            const c = CFG[tipo];

            const badge = document.getElementById('cnt-' + tipo);
            if (badge) badge.textContent = items.length;

            // Zona documentos — ordenar más nuevo → más antiguo, mostrar solo top 3
            const docZone = document.getElementById('docs-' + tipo);
            if (docZone) {
                if (!items.length) {
                    docZone.innerHTML = `
                <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.4rem;color:#ccc;"></i>
                <span style="font-size:.78rem;color:#aaa;">Sin archivos aún</span>`;
                } else {
                    // Clonar y ordenar descendente por fecha
                    const sorted = [...items].sort((a, b) => {
                        const da = a.fecha ? new Date(a.fecha) : new Date(0);
                        const db = b.fecha ? new Date(b.fecha) : new Date(0);
                        return db - da; // más reciente primero
                    });

                    const top3 = sorted.slice(0, 3);
                    const extras = sorted.length - 3;

                    let listHtml = '<div class="pla-doc-list">';
                    top3.forEach(item => {
                        // Elegir ícono según extensión
                        const ext = (item.nombre_archivo || '').split('.').pop().toLowerCase();
                        const ico = ext === 'pdf' ? 'fa-file-pdf' : 'fa-file-excel';
                        const icoColor = ext === 'pdf' ? '#E74C3C' : '#27AE60';

                        listHtml += `<div class="pla-doc-item">
                    <i class="fa-solid ${ico}" style="color:${icoColor};"></i>
                    <span class="text-truncate" style="max-width:140px;" title="${item.nombre_archivo || ''}">${item.nombre_archivo || 'archivo'}</span>
                    <small class="ms-auto text-muted" style="white-space:nowrap;">${item.fecha || ''}</small>
                </div>`;
                    });

                    if (extras > 0) {
                        listHtml += `<div class="pla-doc-item" style="justify-content:center;color:#aaa;font-style:italic;">
                    <i class="fa-solid fa-ellipsis me-1"></i>+${extras} archivo${extras > 1 ? 's' : ''} más
                </div>`;
                    }

                    listHtml += '</div>';
                    docZone.innerHTML = listHtml;
                }
            }

            // Total mes
            if (!c.sinTotal) {
                const suma = items.reduce((a, b) => a + (parseFloat(b.total_mes) || 0), 0);
                const disp = c.esAdmin ? suma * 0.10 : suma;

                // Valor en gráfico
                const tval = document.getElementById('tv-' + tipo);
                if (tval) tval.textContent = money(disp);

                // Valor raw (solo tipo Admin)
                const traw = document.getElementById('tv-raw-' + tipo);
                if (traw) traw.textContent = money(suma);
            }

            refreshChart();
        }

        // ─── MODAL AGREGAR ────────────────────────────────────────────────────────────
        $(document).on('click', '.btn-agregar', function() {
            const tipo = parseInt($(this).data('tipo'));
            const c = CFG[tipo];

            $('#aTipo').val(tipo);
            $('#aSinTotal').val(c.sinTotal ? 1 : 0);
            $('#aEsAdmin').val(c.esAdmin ? 1 : 0);
            $('#aFecha').val(new Date().toISOString().split('T')[0]);
            $('#aArchivos').val('');
            $('#aTotal').val('');

            $('#mhAgregar').css('background', c.color);
            $('#mhAgregarIco').attr('class', 'fa-solid ' + c.icono);
            $('#mhAgregarTitulo').text('Agregar – ' + c.titulo);

            if (c.sinTotal) {
                $('#divATotal').hide();
                $('#divATotalLabel').hide();
            } else {
                $('#divATotal').show();
                $('#divATotalLabel').show();
                $('#aAdminNota').toggle(c.esAdmin);
                $('#aTotalLabel').html('Total Mes ($) ' + (!c.esAdmin ? '<span class="text-danger">*</span>' : ''));
            }

            $('#modalAgregar').modal('show');
        });

        $('#btnGuardar').on('click', function() {
            const tipo = parseInt($('#aTipo').val());
            const sinTotal = $('#aSinTotal').val() === '1';
            const fecha = $('#aFecha').val();
            const archivos = $('#aArchivos')[0].files;
            const totalStr = $('#aTotal').val();

            if (!fecha) {
                alert('Selecciona una fecha.');
                return;
            }
            if (!archivos.length) {
                alert('Selecciona al menos un archivo.');
                return;
            }
            if (!sinTotal && !CFG[tipo].esAdmin && parseNum(totalStr) <= 0) {
                alert('Ingresa el total del mes.');
                return;
            }

            const fd = new FormData();
            fd.append('tipo', tipo);
            fd.append('fecha', fecha);
            fd.append('total_mes', sinTotal ? '' : parseNum(totalStr));
            Array.from(archivos).forEach(f => fd.append('documentos[]', f));

            $('#btnGuardar').prop('disabled', true).text('Guardando…');

            $.ajax({
                url: '/planillas/guardar',
                type: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                success: res => onGuardadoOk(tipo, res, archivos, fecha, sinTotal, totalStr),
                error: () => onGuardadoFallback(tipo, archivos, fecha, sinTotal, totalStr),
                complete: () => $('#btnGuardar').prop('disabled', false)
                    .html('<i class="fa-solid fa-save me-1"></i> Guardar'),
            });
        });

        function onGuardadoOk(tipo, res, archivos, fecha, sinTotal, totalStr) {
            if (res.registros) {
                res.registros.forEach(r => DB[tipo].push(r));
            } else {
                onGuardadoFallback(tipo, archivos, fecha, sinTotal, totalStr, false);
                return;
            }
            refreshCard(tipo);
            $('#modalAgregar').modal('hide');
            showSuccess('Archivos guardados correctamente');
        }

        function onGuardadoFallback(tipo, archivos, fecha, sinTotal, totalStr, hide = true) {
            Array.from(archivos).forEach(f => {
                DB[tipo].push({
                    id: Date.now() + Math.random(),
                    fecha,
                    nombre_archivo: f.name,
                    documento: null,
                    total_mes: sinTotal ? null : parseNum(totalStr),
                    tipo,
                });
            });
            refreshCard(tipo);
            if (hide) $('#modalAgregar').modal('hide');
            showSuccess('Archivos guardados correctamente');
        }

        // ─── MODAL VER ────────────────────────────────────────────────────────────────
        $(document).on('click', '.btn-ver', function() {
            const tipo = parseInt($(this).data('tipo'));
            const c = CFG[tipo];
            $('#vTipo').val(tipo);
            $('#mhVer').css('background', c.color);
            $('#mhVerIco').attr('class', 'fa-solid ' + c.icono);
            $('#mhVerTitulo').text(c.titulo);
            renderTabla(tipo);
            $('#modalVer').modal('show');
        });

        function renderTabla(tipo) {
            const items = DB[tipo] || [];
            const c = CFG[tipo];
            const tbody = $('#tbodyVer');

            if (!items.length) {
                tbody.html(
                    '<tr><td colspan="5" class="text-center py-5 text-muted"><i class="fa-solid fa-inbox fa-2x mb-2 d-block opacity-25"></i>No hay archivos registrados</td></tr>'
                    );
                return;
            }

            let html = '';
            items.forEach((item, i) => {
                const totalCell = c.sinTotal ?
                    '<span class="badge bg-secondary rounded-pill">N/A</span>' :
                    (item.total_mes != null ? `<span class="fw-700">${money(item.total_mes)}</span>` :
                        '<span class="text-muted">—</span>');

                const docBtns = item.documento ?
                    `<a href="${item.documento}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill me-1" style="font-size:.7rem;"><i class="fa-solid fa-eye"></i> Ver</a>
               <a href="${item.documento}" download class="btn btn-sm btn-outline-primary rounded-pill" style="font-size:.7rem;"><i class="fa-solid fa-download"></i></a>` :
                    '<span class="text-muted" style="font-size:.78rem;">Sin ruta</span>';

                html += `<tr>
            <td><span class="badge rounded-pill" style="background:#f0ede8;color:#666;">${i+1}</span></td>
            <td>${item.fecha || '—'}</td>
            <td>
                <i class="fa-solid fa-file-excel text-success me-1"></i>
                <span class="fw-600">${item.nombre_archivo || 'archivo'}</span>
                <div class="mt-1">${docBtns}</div>
            </td>
            <td>${totalCell}</td>
            <td>
                <button class="btn btn-sm btn-warning rounded-circle me-1 btn-editar"
                        data-id="${item.id}" data-tipo="${tipo}" title="Editar">
                    <i class="fa-solid fa-pen"></i>
                </button>
                <button class="btn btn-sm btn-danger rounded-circle btn-eliminar"
                        data-id="${item.id}" data-tipo="${tipo}" title="Eliminar">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        </tr>`;
            });
            tbody.html(html);
        }

        // ─── MODAL EDITAR ─────────────────────────────────────────────────────────────
        $(document).on('click', '.btn-editar', function() {
            const id = $(this).data('id');
            const tipo = parseInt($(this).data('tipo'));
            const c = CFG[tipo];
            const item = DB[tipo].find(x => x.id == id);
            if (!item) return;

            $('#eId').val(id);
            $('#eSinTotal').val(c.sinTotal ? 1 : 0);
            $('#eEsAdmin').val(c.esAdmin ? 1 : 0);
            $('#eTipoEdit').val(tipo);
            $('#eFecha').val(item.fecha);
            $('#eArchivo').val('');
            $('#eTotal').val(item.total_mes != null ?
                Number(item.total_mes).toLocaleString('es-CL', {
                    maximumFractionDigits: 0
                }) : '');

            if (c.sinTotal) {
                $('#divETotal').hide();
                $('#divETotalLabel').hide();
            } else {
                $('#divETotal').show();
                $('#divETotalLabel').show();
                $('#eAdminNota').toggle(c.esAdmin);
            }

            $('#btnEditar').data('tipo', tipo);
            $('#modalEditar').modal('show');
        });

        $('#btnEditar').on('click', function() {
            const tipo = $(this).data('tipo');
            const id = $('#eId').val();
            const sinTotal = $('#eSinTotal').val() === '1';
            const fecha = $('#eFecha').val();
            const totalStr = $('#eTotal').val();
            const archivo = $('#eArchivo')[0].files[0];

            const fd = new FormData();
            fd.append('id', id);
            fd.append('fecha', fecha);
            fd.append('total_mes', sinTotal ? '' : parseNum(totalStr));
            if (archivo) fd.append('documento', archivo);

            $('#btnEditar').prop('disabled', true).text('Guardando…');

            $.ajax({
                url: '/planillas/editar',
                type: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                success: () => finEditar(tipo, id, fecha, totalStr, sinTotal, archivo),
                error: () => finEditar(tipo, id, fecha, totalStr, sinTotal, archivo),
                complete: () => $('#btnEditar').prop('disabled', false)
                    .html('<i class="fa-solid fa-save me-1"></i> Guardar cambios'),
            });
        });

        function finEditar(tipo, id, fecha, totalStr, sinTotal, archivo) {
            const idx = DB[tipo].findIndex(x => x.id == id);
            if (idx !== -1) {
                DB[tipo][idx].fecha = fecha;
                DB[tipo][idx].total_mes = sinTotal ? null : parseNum(totalStr);
                if (archivo) DB[tipo][idx].nombre_archivo = archivo.name;
            }
            refreshCard(tipo);
            renderTabla(tipo);
            $('#modalEditar').modal('hide');
            showSuccess('Registro actualizado correctamente');
        }

        // ─── MODAL ELIMINAR ───────────────────────────────────────────────────────────
        $(document).on('click', '.btn-eliminar', function() {
            $('#elId').val($(this).data('id'));
            $('#elTipo').val($(this).data('tipo'));
            $('#modalEliminar').modal('show');
        });

        $('#btnConfEliminar').on('click', function() {
            const id = $('#elId').val();
            const tipo = parseInt($('#elTipo').val());
            $.ajax({
                url: '/planillas/eliminar/' + id,
                type: 'DELETE',
                success: () => finEliminar(tipo, id),
                error: () => finEliminar(tipo, id),
            });
        });

        function finEliminar(tipo, id) {
            DB[tipo] = DB[tipo].filter(x => x.id != id);
            refreshCard(tipo);
            renderTabla(tipo);
            $('#modalEliminar').modal('hide');
            showSuccess('Registro eliminado correctamente');
        }

        // ─── Éxito ────────────────────────────────────────────────────────────────────
        function showSuccess(msg) {
            $('#texto_success').text(msg);
            $('#successModal').modal('show');
        }
        $('#btnCloseSuccess').on('click', () => $('#successModal').modal('hide'));

        // ─── Init ─────────────────────────────────────────────────────────────────────
        $(document).ready(function() {
            $.get('/planillas/listar', function(res) {
                if (res && res.data) {
                    res.data.forEach(item => {
                        const t = item.tipo;
                        if (DB[t]) DB[t].push(item);
                    });
                }
            }).always(() => {
                [1, 2, 3, 4, 6].forEach(t => refreshCard(t));
            });
        });
    </script>
@endsection
