@extends('layouts.app')

@section('content')
<div class="container-fluid overflow-hidden" style="background:#fff;">
    <div class="row" style="flex-wrap:nowrap; height:100vh; overflow:hidden;">
        @include('layouts.sidebar')

        <div class="col d-flex flex-column graf-main-col" style="padding:0; background:#f0f2f5; height:100vh; overflow-y:auto;">
            <div class="flex-grow-1">

                {{-- ── HEADER ── --}}
                <div class="graf-header">
                    <div>
                        <h1 class="graf-titulo">
                            Gráficos de Empresa
                        </h1>
                        <p class="graf-subtitulo">Resumen financiero mensual y anual</p>
                    </div>

                    {{-- TABS --}}
                    <div class="graf-tabs">
                        <button class="graf-tab active" id="tab-mensual" onclick="mostrarVista('mensual')">
                            Mensual
                        </button>
                        <button class="graf-tab" id="tab-anual" onclick="mostrarVista('anual')">
                            Anual
                        </button>
                    </div>
                </div>

                {{-- ══════════════════════════════════════════════════════════════ --}}
                {{-- VISTA MENSUAL --}}
                {{-- ══════════════════════════════════════════════════════════════ --}}
                <div id="vista-mensual" class="px-4 py-4">

                    {{-- Selector de año --}}
                    <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
                        <label class="graf-label-año">Año:</label>
                        <div class="graf-año-selector" id="mensualAñoSelector">
                            @foreach($años as $a)
                                <button class="graf-año-btn {{ $a == $año ? 'active' : '' }}"
                                        onclick="cambiarAño({{ $a }})">{{ $a }}</button>
                            @endforeach
                        </div>
                        <button class="graf-año-add-btn" onclick="agregarAño('mensual')" title="Agregar nuevo año">
                            + Año
                        </button>
                        <span class="graf-año-actual">
                            Mostrando <strong>{{ $año }}</strong>
                        </span>
                    </div>

                    {{-- Grid de 12 cards mensuales --}}
                    <div class="graf-grid-meses" id="gridMeses">
                        @foreach($meses as $numMes => $datos)
                        <div class="graf-mes-card {{ $datos['tiene_datos'] ? 'has-data' : 'no-data' }}"
                             data-mes="{{ $numMes }}"
                             data-año="{{ $año }}"
                             onclick="abrirDetalleMes({{ $año }}, {{ $numMes }})">

                            <div class="graf-mes-num">{{ str_pad($numMes, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="graf-mes-nombre">{{ $datos['nombre_mes'] }}</div>

                            @if($datos['tiene_datos'])
                                <div class="graf-mes-resumen">
                                    <div class="graf-mes-stat ingreso">
                                        ${{ number_format($datos['total_ingresos'] / 1000, 0) }}K
                                    </div>
                                    <div class="graf-mes-stat egreso">
                                        ${{ number_format($datos['total_egresos'] / 1000, 0) }}K
                                    </div>
                                </div>

                                <div class="graf-mes-bar-wrap">
                                    @php
                                        $maxRef = 10000000;
                                        $pct = min(100, ($datos['total_ingresos'] / $maxRef) * 100);
                                    @endphp
                                    <div class="graf-mes-bar" style="width: {{ $pct }}%;"></div>
                                </div>
                            @else
                                <div class="graf-mes-empty">
                                    <span>Sin datos aún</span>
                                </div>
                            @endif

                            {{-- HOVER PREVIEW --}}
                            <div class="graf-mes-preview">
                                <div class="preview-titulo">{{ $datos['nombre_mes'] }} {{ $año }}</div>
                                @if($datos['tiene_datos'])
                                    <canvas class="preview-canvas"
                                            id="preview-{{ $numMes }}"
                                            data-ingresos="{{ json_encode(array_values($datos['ingresos'])) }}"
                                            data-egresos="{{ json_encode(array_values($datos['egresos'])) }}"
                                            width="176" height="70"></canvas>
                                    <div class="preview-totales">
                                        <div class="preview-total-item">
                                            <span class="preview-dot" style="background:#27AE60;"></span>
                                            Ing: <strong style="color:#27AE60;">${{ number_format($datos['total_ingresos']/1000,0) }}K</strong>
                                        </div>
                                        <div class="preview-total-item">
                                            <span class="preview-dot" style="background:#E74C3C;"></span>
                                            Egr: <strong style="color:#E74C3C;">${{ number_format($datos['total_egresos']/1000,0) }}K</strong>
                                        </div>
                                    </div>
                                @else
                                    <div class="preview-empty">
                                        <span>Sin datos</span>
                                    </div>
                                @endif
                                <div class="preview-cta">Click para detalle</div>
                            </div>

                        </div>
                        @endforeach
                    </div>

                </div><!-- /vista-mensual -->

                {{-- ══════════════════════════════════════════════════════════════ --}}
                {{-- VISTA ANUAL --}}
                {{-- ══════════════════════════════════════════════════════════════ --}}
                <div id="vista-anual" class="px-4 py-4" style="display:none;">

                    <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
                        <label class="graf-label-año">Año:</label>
                        <div class="graf-año-selector" id="anualAñoSelector">
                            @foreach($años as $a)
                                <button class="graf-año-btn {{ $a == $año ? 'active' : '' }}"
                                        onclick="cargarAnual({{ $a }})">{{ $a }}</button>
                            @endforeach
                        </div>
                        <button class="graf-año-add-btn" onclick="agregarAño('anual')" title="Agregar nuevo año">
                            + Año
                        </button>
                        <span class="graf-año-actual" id="anualAñoLabel">
                            Resumen <strong id="anualAñoTexto">{{ $año }}</strong>
                        </span>
                    </div>

                    <div id="anual-loading" class="text-center py-5" style="display:none;">
                        <div class="spinner-border text-warning" style="width:3rem;height:3rem;"></div>
                        <p class="mt-3 text-muted">Calculando datos anuales…</p>
                    </div>

                    <div id="anual-contenido">
                        <div class="row g-4">

                            <div class="col-lg-6">
                                <div class="graf-chart-card">
                                    <div class="graf-chart-header ingreso">
                                        Ingresos Anuales
                                        <span class="graf-year-badge" id="anual-ing-year">{{ $año }}</span>
                                    </div>
                                    <div class="graf-chart-total" id="anual-ing-total">$ 0</div>
                                    <div style="position:relative; height:300px; padding:16px;">
                                        <canvas id="chartAnualIngresos"></canvas>
                                    </div>
                                    <div id="anual-ing-empty" class="graf-empty-state" style="display:none;">
                                        <p>Sin datos de ingresos para este año</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="graf-chart-card">
                                    <div class="graf-chart-header egreso">
                                        Egresos Anuales
                                        <span class="graf-year-badge" id="anual-egr-year">{{ $año }}</span>
                                    </div>
                                    <div class="graf-chart-total" id="anual-egr-total">$ 0</div>
                                    <div style="position:relative; height:300px; padding:16px;">
                                        <canvas id="chartAnualEgresos"></canvas>
                                    </div>
                                    <div id="anual-egr-empty" class="graf-empty-state" style="display:none;">
                                        <p>Sin datos de egresos para este año</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="graf-chart-card">
                                    <div class="graf-chart-header" style="background: linear-gradient(135deg,#34495E,#2C3E50); color:#fff;">
                                        Resumen mensual <span id="anual-tabla-year">{{ $año }}</span>
                                    </div>
                                    <div class="table-responsive p-3">
                                        <table class="graf-table w-100" id="tablaAnualMeses">
                                            <thead>
                                                <tr>
                                                    <th>Mes</th>
                                                    <th>Adm (10%)</th>
                                                    <th>Arriendos $</th>
                                                    <th>Ventas $</th>
                                                    <th>Obras Men.</th>
                                                    <th>Arr. Temp.</th>
                                                    <th class="text-success fw-700">Total Ingresos</th>
                                                    <th class="text-danger fw-700">Total Egresos</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablaAnualBody">
                                                <tr><td colspan="8" class="text-center py-4 text-muted">Cargando…</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- /vista-anual -->

            </div><!-- /flex-grow-1 -->
            @include('layouts.footer')
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
{{-- MODAL DETALLE MES --}}
{{-- ═══════════════════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="modalDetalleMes" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content graf-modal">

            <div class="modal-header graf-modal-header" id="detalleMesHeader">
                <div class="d-flex align-items-center gap-3">
                    <div class="graf-modal-icon">
                        <i class="fa-solid fa-chart-bar"></i>
                    </div>
                    <div>
                        <h5 class="modal-title mb-0" id="detalleMesTitulo">Detalle del Mes</h5>
                        <small id="detalleMesSubtitulo" style="opacity:.8;">Ingresos y Egresos</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4" id="detalleMesBody">

                <div id="detalle-loading" class="text-center py-5">
                    <div class="spinner-border text-warning" style="width:3rem;height:3rem;"></div>
                    <p class="mt-3 text-muted">Cargando datos…</p>
                </div>

                <div id="detalle-contenido" style="display:none;">

                    <div class="row g-3 mb-4" id="detalleKpis"></div>

                    <div class="row g-4">

                        <div class="col-12">
                            <div class="graf-chart-card">
                                <div class="graf-chart-header ingreso">
                                    Ingresos del Mes
                                </div>
                                <div style="position:relative; height:320px; padding:16px 24px;">
                                    <canvas id="chartDetalleIngresos"></canvas>
                                </div>
                                <div id="detalle-ing-empty" class="graf-empty-state" style="display:none;">
                                    <p>No hay datos de ingresos para este mes</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="graf-chart-card">
                                <div class="graf-chart-header egreso">
                                    Egresos del Mes
                                    <span class="badge ms-2 rounded-pill" style="background:rgba(255,255,255,.25);font-size:.72rem;">Próximamente completo</span>
                                </div>
                                <div style="position:relative; height:280px; padding:16px 24px;">
                                    <canvas id="chartDetalleEgresos"></canvas>
                                </div>
                                <div id="detalle-egr-empty" class="graf-empty-state" style="display:none;">
                                    <p>No hay egresos registrados para este mes</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div><!-- /modal-body -->

            <div class="modal-footer" style="background:#f8f7f4; border-top:1px solid #ece9e4;">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
{{-- MODAL AGREGAR AÑO --}}
{{-- ═══════════════════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="modalAgregarAño" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
        <div class="modal-content" style="border-radius:16px; overflow:hidden; border:none;">
            <div class="modal-header" style="background:linear-gradient(135deg,#E67E22,#F39C12); color:#fff; border:none;">
                <h5 class="modal-title mb-0">Agregar nuevo año</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <label class="form-label fw-700" style="font-size:.85rem; color:#666; text-transform:uppercase; letter-spacing:.4px;">
                    Año a agregar
                </label>
                <input type="number"
                       id="inputNuevoAño"
                       class="form-control form-control-lg text-center"
                       style="border-radius:10px; font-size:1.4rem; font-weight:800; letter-spacing:2px; border:2px solid #e0ddd8;"
                       min="2026"
                       max="2099"
                       placeholder="2027">
                <div id="errorNuevoAño" class="text-danger mt-2" style="font-size:.82rem; display:none;"></div>
            </div>
            <div class="modal-footer" style="border:none; padding:0 1.5rem 1.5rem;">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-warning rounded-pill px-4 text-white fw-700" onclick="confirmarAgregarAño()">
                    Agregar
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- ══════════════════════════════════════════════════════════════════════ --}}
@section('css')
@parent
<style>
.graf-main-col { background: #f0f2f5 !important; }

.graf-header {
    background: #fff;
    border-bottom: 2px solid #f0ede8;
    padding: 20px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
}
.graf-titulo {
    font-size: 1.6rem;
    font-weight: 800;
    color: #1a1a2e;
    letter-spacing: -.5px;
    margin: 0;
}
.graf-subtitulo { color: #aaa; font-size: .88rem; margin: 0; }

.graf-tabs { display: flex; gap: 8px; }
.graf-tab {
    padding: 8px 22px;
    border-radius: 24px;
    border: 2px solid #e0ddd8;
    background: #fff;
    color: #666;
    font-size: .84rem;
    font-weight: 700;
    cursor: pointer;
    transition: all .2s;
}
.graf-tab:hover  { border-color: #E67E22; color: #E67E22; }
.graf-tab.active { background: #E67E22; border-color: #E67E22; color: #fff; }

.graf-label-año   { font-weight: 700; font-size: .82rem; color: #666; text-transform: uppercase; letter-spacing: .4px; white-space: nowrap; }
.graf-año-selector { display: flex; gap: 6px; flex-wrap: wrap; }
.graf-año-btn {
    padding: 5px 14px;
    border-radius: 16px;
    border: 2px solid #e0ddd8;
    background: #fff;
    color: #666;
    font-size: .8rem;
    font-weight: 700;
    cursor: pointer;
    transition: all .2s;
}
.graf-año-btn:hover  { border-color: #E67E22; color: #E67E22; }
.graf-año-btn.active { background: #E67E22; border-color: #E67E22; color: #fff; }
.graf-año-actual { font-size: .82rem; color: #aaa; }

/* Botón agregar año */
.graf-año-add-btn {
    padding: 5px 14px;
    border-radius: 16px;
    border: 2px dashed #E67E22;
    background: transparent;
    color: #E67E22;
    font-size: .8rem;
    font-weight: 700;
    cursor: pointer;
    transition: all .2s;
    white-space: nowrap;
}
.graf-año-add-btn:hover { background: #E67E22; color: #fff; }

.graf-grid-meses {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}
@media (max-width: 1200px) { .graf-grid-meses { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 768px)  { .graf-grid-meses { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px)  { .graf-grid-meses { grid-template-columns: 1fr; } }

.graf-mes-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    border: 2px solid transparent;
    cursor: pointer;
    transition: all .25s;
    position: relative;
    overflow: visible;
}
.graf-mes-card:hover {
    border-color: #E67E22;
    box-shadow: 0 8px 28px rgba(230,126,34,.2);
    transform: translateY(-4px);
    z-index: 10;
}
.graf-mes-card.has-data  { border-left: 4px solid #27AE60; }
.graf-mes-card.no-data   { border-left: 4px solid #e0ddd8; opacity: .75; }
.graf-mes-num {
    font-size: 2rem;
    font-weight: 900;
    color: #f0ede8;
    line-height: 1;
    margin-bottom: 2px;
}
.graf-mes-nombre {
    font-size: 1rem;
    font-weight: 800;
    color: #1a1a2e;
    margin-bottom: 10px;
}

.graf-mes-resumen { display: flex; gap: 8px; margin-bottom: 8px; flex-wrap: wrap; }
.graf-mes-stat {
    font-size: .72rem;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 4px;
}
.graf-mes-stat.ingreso { background: #eafaf1; color: #27AE60; }
.graf-mes-stat.egreso  { background: #fdf2f2; color: #E74C3C; }

.graf-mes-bar-wrap { height: 4px; background: #f0ede8; border-radius: 4px; overflow: hidden; margin-top: 4px; }
.graf-mes-bar      { height: 100%; background: linear-gradient(90deg, #E67E22, #F39C12); border-radius: 4px; transition: width .8s ease; }

.graf-mes-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    padding: 12px 0;
    color: #ccc;
    font-size: .75rem;
}

.graf-mes-preview {
    display: none;
    position: absolute;
    top: 0;
    left: calc(100% + 10px);
    width: 200px;
    background: #1a1a2e;
    border-radius: 12px;
    padding: 12px;
    box-shadow: 0 8px 28px rgba(0,0,0,.4);
    z-index: 100;
    pointer-events: none;
}
.graf-mes-card:nth-child(4n) .graf-mes-preview,
.graf-mes-card:nth-child(4n-1) .graf-mes-preview {
    left: auto;
    right: calc(100% + 10px);
}
.graf-mes-card:hover .graf-mes-preview { display: block; }

.preview-titulo {
    font-size: .72rem;
    font-weight: 800;
    color: #E67E22;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: .5px;
}
.preview-canvas {
    border-radius: 6px;
    width: 100% !important;
    height: 70px !important;
    margin-bottom: 8px;
}
.preview-totales { display: flex; flex-direction: column; gap: 3px; margin-bottom: 6px; }
.preview-total-item {
    font-size: .68rem;
    color: #bbb;
    display: flex;
    align-items: center;
    gap: 5px;
}
.preview-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
.preview-cta {
    font-size: .65rem;
    color: #E67E22;
    text-align: center;
    padding-top: 6px;
    border-top: 1px solid rgba(255,255,255,.1);
}
.preview-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #555;
    font-size: .72rem;
    text-align: center;
    padding: 10px 0;
}

.graf-chart-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,.07);
    border: 1px solid #f0ede8;
    overflow: hidden;
}
.graf-chart-header {
    padding: 16px 24px;
    font-weight: 700;
    font-size: .9rem;
    display: flex;
    align-items: center;
    gap: 6px;
}
.graf-chart-header.ingreso { background: linear-gradient(135deg, #27AE60, #1E8449); color: #fff; }
.graf-chart-header.egreso  { background: linear-gradient(135deg, #E74C3C, #C0392B); color: #fff; }
.graf-chart-total {
    padding: 8px 24px 0;
    font-size: 1.4rem;
    font-weight: 900;
    color: #1a1a2e;
}
.graf-year-badge {
    margin-left: auto;
    background: rgba(255,255,255,.25);
    padding: 2px 10px;
    border-radius: 12px;
    font-size: .75rem;
    font-weight: 600;
}
.graf-empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 40px 24px;
    color: #bbb;
    font-size: .88rem;
    text-align: center;
}

.graf-table { border-collapse: separate; border-spacing: 0 4px; }
.graf-table thead th {
    background: #f0ede8;
    padding: 9px 14px;
    font-size: .75rem;
    font-weight: 700;
    color: #666;
    text-transform: uppercase;
    letter-spacing: .4px;
    border: none;
    white-space: nowrap;
}
.graf-table thead th:first-child { border-radius: 8px 0 0 8px; }
.graf-table thead th:last-child  { border-radius: 0 8px 8px 0; }
.graf-table tbody td {
    background: #fff;
    padding: 10px 14px;
    font-size: .82rem;
    vertical-align: middle;
    border-top: 1px solid #f5f2ee;
    border-bottom: 1px solid #f5f2ee;
    white-space: nowrap;
}
.graf-table tbody td:first-child { border-left: 1px solid #f5f2ee; border-radius: 8px 0 0 8px; }
.graf-table tbody td:last-child  { border-right: 1px solid #f5f2ee; border-radius: 0 8px 8px 0; }
.graf-table tbody tr:hover td    { background: #fafaf8; }
.fw-700 { font-weight: 700 !important; }

.graf-modal { border-radius: 16px; overflow: hidden; border: none; }
.graf-modal-header { background: linear-gradient(135deg, #1a1a2e, #2c3e50); color: #fff; padding: 20px 24px; }
.graf-modal-icon {
    width: 44px; height: 44px; border-radius: 11px;
    background: rgba(255,255,255,.15);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; color: #fff;
}

.graf-kpi {
    background: #fff;
    border-radius: 12px;
    padding: 14px 18px;
    border: 1px solid #f0ede8;
    box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.graf-kpi-label { font-size: .7rem; color: #aaa; text-transform: uppercase; letter-spacing: .4px; margin-bottom: 4px; }
.graf-kpi-value { font-size: 1.15rem; font-weight: 800; color: #1a1a2e; }
.graf-kpi-ico   { font-size: 1.4rem; opacity: .7; }

.pla-sidebar-col {
    position: sticky; top: 0; height: 100vh;
    overflow-y: auto; flex-shrink: 0;
    scrollbar-width: thin;
}
.pla-sidebar-col::-webkit-scrollbar { width: 4px; }
.pla-sidebar-col::-webkit-scrollbar-thumb { background: rgba(0,0,0,.15); border-radius: 4px; }
</style>
@endsection

{{-- ══════════════════════════════════════════════════════════════════════ --}}
@section('javascript')
@parent
<script>
const COLORES_ING = ['#E67E22','#2980B9','#27AE60','#8E44AD','#16A085','#D4AC0D'];
const COLORES_EGR = ['#E74C3C','#C0392B','#922B21','#641E16','#4A235A','#154360'];

const LABELS_ING = [
    'Adm 10%','Arriendos (cant.)','Arriendos ($)',
    'Ventas (cant.)','Ventas ($)','Obras Menores',
    'Arr. Temporal','Arr. Temp. Aseo'
];
const LABELS_EGR = ['SII','KUTT','Sueldos','Cotizaciones','Contador','Otros'];

// Años disponibles en sesión (mínimo desde 2026)
let añosDisponibles = @json(array_values(array_filter($años, fn($a) => $a >= 2026)));
if (añosDisponibles.length === 0) añosDisponibles = [2026];

function money(n) {
    if (n === null || n === undefined) return '$ 0';
    return '$ ' + Number(n).toLocaleString('es-CL', { maximumFractionDigits: 0 });
}

// ─── Cambiar entre vistas ──────────────────────────────────────────────────────
function mostrarVista(vista) {
    document.getElementById('vista-mensual').style.display = vista === 'mensual' ? 'block' : 'none';
    document.getElementById('vista-anual').style.display   = vista === 'anual'   ? 'block' : 'none';
    document.getElementById('tab-mensual').classList.toggle('active', vista === 'mensual');
    document.getElementById('tab-anual').classList.toggle('active',   vista === 'anual');

    if (vista === 'anual') {
        const añoActivo = document.querySelector('#anualAñoSelector .graf-año-btn.active');
        cargarAnual(añoActivo ? parseInt(añoActivo.textContent) : {{ $año }});
    }
}

// ─── Cambiar año (mensual) ─────────────────────────────────────────────────────
function cambiarAño(año) {
    window.location.href = '{{ route("graficos.mensual") }}?año=' + año;
}

// ─── Agregar año ───────────────────────────────────────────────────────────────
let _vistaDestino = 'mensual';

function agregarAño(vista) {
    _vistaDestino = vista;
    const siguiente = añosDisponibles.length > 0
        ? Math.max(...añosDisponibles) + 1
        : 2026;
    document.getElementById('inputNuevoAño').value = siguiente;
    document.getElementById('errorNuevoAño').style.display = 'none';
    $('#modalAgregarAño').modal('show');
}

function confirmarAgregarAño() {
    const input   = document.getElementById('inputNuevoAño');
    const errorEl = document.getElementById('errorNuevoAño');
    const año     = parseInt(input.value);

    errorEl.style.display = 'none';

    if (!año || año < 2026 || año > 2099) {
        errorEl.textContent = 'Ingresa un año válido entre 2026 y 2099.';
        errorEl.style.display = 'block';
        return;
    }
    if (añosDisponibles.includes(año)) {
        errorEl.textContent = 'Ese año ya existe en el selector.';
        errorEl.style.display = 'block';
        return;
    }

    fetch('{{ route("graficos.agregarAño") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({ año }),
    })
    .then(r => r.json())
    .then(() => {
        $('#modalAgregarAño').modal('hide');

        if (_vistaDestino === 'mensual') {
            cambiarAño(año); // recarga con ?año=XXXX
        } else {
            añosDisponibles.push(año);
            añosDisponibles.sort((a, b) => a - b);
            _agregarBtnAño('anualAñoSelector', año, () => cargarAnual(año));
            cargarAnual(año);
        }
    })
    .catch(() => {
        errorEl.textContent = 'Error al guardar el año. Intenta de nuevo.';
        errorEl.style.display = 'block';
    });
}

function _agregarBtnAño(selectorId, año, fn) {
    const container = document.getElementById(selectorId);
    // Insertar en orden
    const botones = Array.from(container.querySelectorAll('.graf-año-btn'));
    const nuevoBtn = document.createElement('button');
    nuevoBtn.className = 'graf-año-btn';
    nuevoBtn.textContent = año;
    nuevoBtn.onclick = fn;

    const siguiente = botones.find(b => parseInt(b.textContent) > año);
    if (siguiente) {
        container.insertBefore(nuevoBtn, siguiente);
    } else {
        container.appendChild(nuevoBtn);
    }
}

// ─── Mini chart en hover preview ──────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.preview-canvas').forEach(canvas => {
        const ing = JSON.parse(canvas.dataset.ingresos || '[]');
        const egr = JSON.parse(canvas.dataset.egresos  || '[]');
        const totalIng = ing.reduce((a,b) => a + (parseFloat(b)||0), 0);
        const totalEgr = egr.reduce((a,b) => a + (parseFloat(b)||0), 0);

        new Chart(canvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Ingresos','Egresos'],
                datasets: [{
                    data: [totalIng, totalEgr],
                    backgroundColor: ['#27AE60CC','#E74C3CCC'],
                    borderColor:     ['#27AE60','#E74C3C'],
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { callbacks: { label: ctx => money(ctx.raw) } } },
                scales: {
                    x: { ticks: { color: '#aaa', font: { size: 9 } }, grid: { display: false } },
                    y: { display: false, beginAtZero: true }
                }
            }
        });
    });
});

// ─── Modal Detalle Mes ─────────────────────────────────────────────────────────
let chartDetIng = null;
let chartDetEgr = null;

function abrirDetalleMes(año, mes) {
    document.getElementById('detalle-loading').style.display   = 'block';
    document.getElementById('detalle-contenido').style.display = 'none';

    const nombresMes = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio',
                        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

    document.getElementById('detalleMesTitulo').textContent    = nombresMes[mes] + ' ' + año;
    document.getElementById('detalleMesSubtitulo').textContent = 'Ingresos y Egresos del mes';

    $('#modalDetalleMes').modal('show');

    fetch(`/graficos/mes/${año}/${mes}`)
        .then(r => r.json())
        .then(d => renderDetalleMes(d))
        .catch(() => {
            document.getElementById('detalle-loading').innerHTML =
                '<p class="text-danger">Error al cargar datos</p>';
        });
}

function renderDetalleMes(d) {
    document.getElementById('detalle-loading').style.display   = 'none';
    document.getElementById('detalle-contenido').style.display = 'block';

    document.getElementById('detalleKpis').innerHTML = `
        <div class="col-sm-6 col-lg-3">
            <div class="graf-kpi d-flex align-items-center gap-3">
                <span class="graf-kpi-ico text-success"><i class="fa-solid fa-arrow-trend-up"></i></span>
                <div>
                    <div class="graf-kpi-label">Total Ingresos</div>
                    <div class="graf-kpi-value text-success">${money(d.total_ingresos)}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="graf-kpi d-flex align-items-center gap-3">
                <span class="graf-kpi-ico text-danger"><i class="fa-solid fa-arrow-trend-down"></i></span>
                <div>
                    <div class="graf-kpi-label">Total Egresos</div>
                    <div class="graf-kpi-value text-danger">${money(d.total_egresos)}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="graf-kpi d-flex align-items-center gap-3">
                <span class="graf-kpi-ico text-warning"><i class="fa-solid fa-scale-balanced"></i></span>
                <div>
                    <div class="graf-kpi-label">Balance</div>
                    <div class="graf-kpi-value ${d.total_ingresos - d.total_egresos >= 0 ? 'text-success' : 'text-danger'}">${money(d.total_ingresos - d.total_egresos)}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="graf-kpi d-flex align-items-center gap-3">
                <span class="graf-kpi-ico" style="color:#E67E22;"><i class="fa-solid fa-key"></i></span>
                <div>
                    <div class="graf-kpi-label">Arriendos activos</div>
                    <div class="graf-kpi-value">${d.ingresos.arriendos_cantidad ?? 0}</div>
                </div>
            </div>
        </div>`;

    const ing = d.ingresos;
    const datosIng = [
        ing.adm_grafico        ?? 0,
        ing.arriendos_cantidad ?? 0,
        ing.arriendos_pesos    ?? 0,
        ing.ventas_cantidad    ?? 0,
        ing.ventas_pesos       ?? 0,
        ing.obras_menores_pesos?? 0,
        ing.arriendo_temp_pesos?? 0,
        ing.arriendo_temp_aseo ?? 0,
    ];

    const totalIng = datosIng.reduce((a,b)=>a+b, 0);
    const emptyIng = totalIng === 0;
    document.getElementById('detalle-ing-empty').style.display = emptyIng ? 'flex' : 'none';
    if (chartDetIng) chartDetIng.destroy();
    const cvIng = document.getElementById('chartDetalleIngresos');
    cvIng.style.display = emptyIng ? 'none' : 'block';
    if (!emptyIng) {
        chartDetIng = new Chart(cvIng.getContext('2d'), {
            type: 'bar',
            data: {
                labels: LABELS_ING,
                datasets: [{ label: 'Monto', data: datosIng,
                    backgroundColor: COLORES_ING.map(c => c + 'CC'),
                    borderColor: COLORES_ING, borderWidth: 2, borderRadius: 8 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { callbacks: { label: ctx => ' ' + money(ctx.raw) } } },
                scales: { x: { ticks: { font: { size: 11 } }, grid: { display: false } },
                          y: { beginAtZero: true, ticks: { callback: v => money(v) } } }
            }
        });
    }

    const egr = d.egresos;
    const datosEgr = [egr.egr_sii??0, egr.egr_kutt??0, egr.egr_sueldos??0,
                      egr.egr_cotizaciones??0, egr.egr_contador??0, egr.egr_otros??0];
    const totalEgr = datosEgr.reduce((a,b)=>a+b, 0);
    const emptyEgr = totalEgr === 0;
    document.getElementById('detalle-egr-empty').style.display = emptyEgr ? 'flex' : 'none';
    if (chartDetEgr) chartDetEgr.destroy();
    const cvEgr = document.getElementById('chartDetalleEgresos');
    cvEgr.style.display = emptyEgr ? 'none' : 'block';
    if (!emptyEgr) {
        chartDetEgr = new Chart(cvEgr.getContext('2d'), {
            type: 'bar',
            data: {
                labels: LABELS_EGR,
                datasets: [{ label: 'Monto', data: datosEgr,
                    backgroundColor: COLORES_EGR.map(c => c + 'CC'),
                    borderColor: COLORES_EGR, borderWidth: 2, borderRadius: 8 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { callbacks: { label: ctx => ' ' + money(ctx.raw) } } },
                scales: { x: { ticks: { font: { size: 11 } }, grid: { display: false } },
                          y: { beginAtZero: true, ticks: { callback: v => money(v) } } }
            }
        });
    }
}

// ─── Vista Anual ───────────────────────────────────────────────────────────────
let chartAnualIng = null;
let chartAnualEgr = null;
let añoAnualActual = {{ $año }};

function cargarAnual(año) {
    añoAnualActual = año;
    document.getElementById('anualAñoTexto').textContent    = año;
    document.getElementById('anual-tabla-year').textContent = año;

    document.querySelectorAll('#anualAñoSelector .graf-año-btn').forEach(btn => {
        btn.classList.toggle('active', parseInt(btn.textContent) === año);
    });

    document.getElementById('anual-loading').style.display   = 'block';
    document.getElementById('anual-contenido').style.display = 'none';

    fetch(`/graficos/anual/${año}`)
        .then(r => r.json())
        .then(d => renderAnual(d))
        .catch(() => alert('Error al cargar datos anuales'));
}

function renderAnual(d) {
    document.getElementById('anual-loading').style.display   = 'none';
    document.getElementById('anual-contenido').style.display = 'block';

    const ti = d.totales_ingresos;
    const te = d.totales_egresos;

    const labelsIng   = ['Adm 10%','Arriendos $','Ventas $','Obras Men.','Arr. Temp.','Aseo Temp.'];
    const datosIngPie = [
        ti.adm_grafico ?? 0, ti.arriendos_pesos ?? 0, ti.ventas_pesos ?? 0,
        ti.obras_menores_pesos ?? 0, ti.arriendo_temp_pesos ?? 0, ti.arriendo_temp_aseo ?? 0,
    ];
    const totalIngAnual = datosIngPie.reduce((a,b)=>a+b, 0);
    document.getElementById('anual-ing-total').textContent = money(totalIngAnual);
    document.getElementById('anual-ing-year').textContent  = d.año;

    const emptyIng = totalIngAnual === 0;
    document.getElementById('anual-ing-empty').style.display = emptyIng ? 'flex' : 'none';
    document.querySelector('#chartAnualIngresos').parentElement.style.display = emptyIng ? 'none' : 'block';
    if (chartAnualIng) chartAnualIng.destroy();
    if (!emptyIng) {
        chartAnualIng = new Chart(document.getElementById('chartAnualIngresos').getContext('2d'), {
            type: 'doughnut',
            data: { labels: labelsIng, datasets: [{ data: datosIngPie,
                backgroundColor: COLORES_ING.map(c=>c+'CC'), borderColor: COLORES_ING, borderWidth: 2 }] },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right', labels: { font: { size: 11 } } },
                    tooltip: { callbacks: { label: ctx => ` ${ctx.label}: ${money(ctx.raw)} (${((ctx.raw/totalIngAnual)*100).toFixed(1)}%)` } }
                }
            }
        });
    }

    const labelsEgr   = ['SII','KUTT','Sueldos','Cotizaciones','Contador','Otros'];
    const datosEgrPie = [te.egr_sii??0, te.egr_kutt??0, te.egr_sueldos??0,
                         te.egr_cotizaciones??0, te.egr_contador??0, te.egr_otros??0];
    const totalEgrAnual = datosEgrPie.reduce((a,b)=>a+b, 0);
    document.getElementById('anual-egr-total').textContent = money(totalEgrAnual);
    document.getElementById('anual-egr-year').textContent  = d.año;

    const emptyEgr = totalEgrAnual === 0;
    document.getElementById('anual-egr-empty').style.display = emptyEgr ? 'flex' : 'none';
    document.querySelector('#chartAnualEgresos').parentElement.style.display = emptyEgr ? 'none' : 'block';
    if (chartAnualEgr) chartAnualEgr.destroy();
    if (!emptyEgr) {
        chartAnualEgr = new Chart(document.getElementById('chartAnualEgresos').getContext('2d'), {
            type: 'doughnut',
            data: { labels: labelsEgr, datasets: [{ data: datosEgrPie,
                backgroundColor: COLORES_EGR.map(c=>c+'CC'), borderColor: COLORES_EGR, borderWidth: 2 }] },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right', labels: { font: { size: 11 } } },
                    tooltip: { callbacks: { label: ctx => ` ${ctx.label}: ${money(ctx.raw)} (${totalEgrAnual > 0 ? ((ctx.raw/totalEgrAnual)*100).toFixed(1) : 0}%)` } }
                }
            }
        });
    }

    const nombresMes = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio',
                        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    let filas = '';
    for (let m = 1; m <= 12; m++) {
        const md = d.meses[m];
        const ing = md.ingresos;
        const clsTot = md.total_ingresos > 0 ? 'text-success fw-700' : 'text-muted';
        const clsEgr = md.total_egresos  > 0 ? 'text-danger fw-700'  : 'text-muted';
        filas += `<tr>
            <td><strong>${nombresMes[m]}</strong></td>
            <td>${money(ing.adm_grafico)}</td>
            <td>${money(ing.arriendos_pesos)}</td>
            <td>${money(ing.ventas_pesos)}</td>
            <td>${money(ing.obras_menores_pesos)}</td>
            <td>${money((ing.arriendo_temp_pesos||0) + (ing.arriendo_temp_aseo||0))}</td>
            <td class="${clsTot}">${money(md.total_ingresos)}</td>
            <td class="${clsEgr}">${money(md.total_egresos)}</td>
        </tr>`;
    }
    document.getElementById('tablaAnualBody').innerHTML = filas;
}
</script>
@endsection