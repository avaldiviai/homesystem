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
                            <i class="fa-solid fa-money-check-dollar me-2" style="color:#16A085;"></i>
                            Planilla Sueldos
                        </h1>
                        <p class="text-muted mb-0" style="font-size:.9rem;">
                            Gestión de sueldos por colaborador · acceso protegido por contraseña
                        </p>
                    </div>

                    {{-- ══════════════════════════════════════════════════════════════ --}}
                    {{-- GRILLA DE USUARIOS                                            --}}
                    {{-- ══════════════════════════════════════════════════════════════ --}}
                    <div class="px-4 py-4">

                        {{-- Barra superior: búsqueda + agregar --}}
                        <div class="d-flex align-items-center justify-content-between gap-3 mb-4 flex-wrap">
                            <div class="sld-search-wrap">
                                <i class="fa-solid fa-magnifying-glass sld-search-ico"></i>
                                <input type="text" id="buscarUsuario" class="sld-search"
                                       placeholder="Buscar colaborador…">
                            </div>
                            <button class="pla-btn-pri d-flex align-items-center gap-2" id="btnAbrirAgregar">
                                <i class="fa-solid fa-plus"></i> Agregar sueldo
                            </button>
                        </div>

                        {{-- Cards de usuarios --}}
                        <div class="row g-3" id="gridUsuarios">
                            @foreach($usuarios as $u)
                            <div class="col-sm-6 col-lg-4 col-xl-3 sld-user-col"
                                 data-nombre="{{ strtolower($u->name) }}">
                                <div class="sld-user-card" data-uid="{{ $u->id }}" data-nombre="{{ $u->name }}">
                                    <div class="sld-avatar">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-grow-1 min-width-0">
                                        <div class="sld-uname text-truncate">{{ $u->name }}</div>
                                        <div class="sld-uemail text-truncate">{{ $u->email }}</div>
                                    </div>
                                    <div class="sld-badge-wrap">
                                        <span class="sld-cnt-badge" id="cnt-u-{{ $u->id }}">0</span>
                                    </div>
                                    <button class="sld-eye-btn btn-ver-sueldo"
                                            data-uid="{{ $u->id }}"
                                            data-nombre="{{ $u->name }}"
                                            title="Ver sueldos">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($usuarios->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fa-solid fa-users fa-3x mb-3 opacity-25"></i>
                            <p class="mb-0">No hay colaboradores registrados.</p>
                        </div>
                        @endif
                    </div>

                    {{-- ══════════════════════════════════════════════════════════════ --}}
                    {{-- GRÁFICO CONSOLIDADO                                           --}}
                    {{-- ══════════════════════════════════════════════════════════════ --}}
                    <div class="px-4 pb-5">
                        <div class="pla-chart-card">

                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                                <div>
                                    <h5 class="fw-700 mb-0" style="color:#1a1a2e;">
                                        <i class="fa-solid fa-chart-bar me-2" style="color:#16A085;"></i>
                                        Resumen Total de Sueldos
                                    </h5>
                                    <small class="text-muted">Suma acumulada por colaborador</small>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="pla-toggle active" id="btn-pie-s" onclick="cambiarGraficoS('pie')">
                                        <i class="fa-solid fa-chart-pie me-1"></i> Pastel
                                    </button>
                                    <button class="pla-toggle" id="btn-bar-s" onclick="cambiarGraficoS('bar')">
                                        <i class="fa-solid fa-chart-bar me-1"></i> Barras
                                    </button>
                                </div>
                            </div>

                            {{-- Mini totales --}}
                            <div class="row g-3 mb-4" id="sld-mini-totales"></div>

                            <div style="border-top:1px solid #f0ede8; margin-bottom:24px;"></div>

                            <div style="position:relative; height:340px;">
                                <canvas id="graficoSueldos"></canvas>
                            </div>

                            <div id="sld-empty" class="text-center text-muted py-5" style="display:none;">
                                <i class="fa-solid fa-chart-bar fa-3x mb-3 opacity-25"></i>
                                <p class="mb-1 fw-600">Sin datos para mostrar</p>
                                <p class="mb-0" style="font-size:.85rem;">Agrega sueldos para ver el gráfico.</p>
                            </div>
                        </div>
                    </div>

                </div><!-- /flex-grow-1 -->
                @include('layouts.footer')
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    {{-- MODAL: VERIFICAR CONTRASEÑA                                            --}}
    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="modalVerificar" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
            <div class="modal-content pla-modal">
                <div class="modal-header pla-mh" style="background:#16A085;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="pla-icon-wrap">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0">Acceso protegido</h5>
                            <small id="vNombreUsuario" style="opacity:.8;">Ingresa la contraseña del colaborador</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="vUid">

                    <div class="sld-lock-ilustra mb-4">
                        <i class="fa-solid fa-user-lock fa-3x" style="color:#16A085; opacity:.25;"></i>
                    </div>

                    <label class="pla-label">Contraseña del colaborador <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" class="pla-input" id="vPassword"
                               placeholder="••••••••" autocomplete="current-password">
                        <button class="btn btn-outline-secondary" type="button" id="togglePass"
                                style="border-radius:0 10px 10px 0 !important; border:2px solid #e8e5e0;">
                            <i class="fa-solid fa-eye" id="togglePassIco"></i>
                        </button>
                    </div>
                    <div id="vError" class="text-danger mt-2" style="font-size:.82rem; display:none;">
                        <i class="fa-solid fa-circle-xmark me-1"></i> Contraseña incorrecta.
                    </div>
                </div>
                <div class="modal-footer" style="background:#f8f7f4; border-top:1px solid #ece9e4;">
                    <button type="button" class="pla-btn-sec" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="pla-btn-pri" id="btnVerificar"
                            style="background:#16A085;">
                        <i class="fa-solid fa-unlock me-1"></i> Acceder
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    {{-- MODAL: VER SUELDOS DEL USUARIO                                         --}}
    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="modalVerSueldo" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content pla-modal">
                <div class="modal-header pla-mh" style="background:#16A085;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="pla-icon-wrap"><i class="fa-solid fa-money-check-dollar"></i></div>
                        <div>
                            <h5 class="modal-title mb-0" id="mhVerSueldoTitulo">Sueldos</h5>
                            <small style="opacity:.8;">Historial de registros</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="vsUid">

                    {{-- Resumen rápido --}}
                    <div class="row g-3 mb-4" id="sld-resumen-usuario"></div>

                    <div class="table-responsive">
                        <table class="pla-table w-100">
                            <thead>
                                <tr>
                                    <th style="width:50px;">#</th>
                                    <th>Fecha</th>
                                    <th>Archivo</th>
                                    <th>Total Mes</th>
                                    <th style="width:130px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbodySueldo">
                                <tr><td colspan="5" class="text-center py-4 text-muted">Cargando…</td></tr>
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
    {{-- MODAL: AGREGAR SUELDO                                                  --}}
    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="modalAgregarSueldo" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content pla-modal">
                <div class="modal-header pla-mh" style="background:#16A085;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="pla-icon-wrap"><i class="fa-solid fa-plus"></i></div>
                        <div>
                            <h5 class="modal-title mb-0">Agregar Sueldo</h5>
                            <small style="opacity:.8;">Selecciona colaborador, monto y documento</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">

                    <div class="pla-step-label mb-2">
                        <span class="pla-step-num" style="background:#16A085;">1</span> Colaborador y fecha
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="pla-label">Colaborador <span class="text-danger">*</span></label>
                            <select class="pla-input" id="aUserId">
                                <option value="">— Selecciona —</option>
                                @foreach($usuarios as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="pla-label">Fecha <span class="text-danger">*</span></label>
                            <input type="date" class="pla-input" id="aFechaSueldo">
                        </div>
                    </div>

                    <div class="pla-step-label mb-2">
                        <span class="pla-step-num" style="background:#16A085;">2</span> Monto y documento
                    </div>
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="pla-label">Total Mes ($) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">$</span>
                                <input type="text" class="pla-input" id="aTotalSueldo"
                                       placeholder="Ej: 850.000" oninput="fmtMiles(this)">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <label class="pla-label">Documento <small class="text-muted fw-400">(opcional)</small></label>
                            <input type="file" class="pla-input" id="aDocSueldo"
                                   accept=".xlsx,.xls,.csv,.pdf">
                            <small class="text-muted">Formatos: xlsx, xls, csv, pdf — máx. 20 MB</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background:#f8f7f4; border-top:1px solid #ece9e4;">
                    <button type="button" class="pla-btn-sec" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnGuardarSueldo" class="pla-btn-pri"
                            style="background:#16A085;">
                        <i class="fa-solid fa-save me-1"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    {{-- MODAL: EDITAR SUELDO                                                   --}}
    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="modalEditarSueldo" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content pla-modal">
                <div class="modal-header" style="background:#34495E; color:#fff;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="pla-icon-wrap"><i class="fa-solid fa-pen"></i></div>
                        <h5 class="modal-title mb-0">Editar Sueldo</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="eIdSueldo">
                    <input type="hidden" id="eUidSueldo">

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="pla-label">Fecha</label>
                            <input type="date" class="pla-input" id="eFechaSueldo">
                        </div>
                        <div class="col-md-6">
                            <label class="pla-label">Total Mes ($)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">$</span>
                                <input type="text" class="pla-input" id="eTotalSueldo" oninput="fmtMiles(this)">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="pla-label">Reemplazar documento <small class="text-muted fw-400">(opcional)</small></label>
                        <input type="file" class="pla-input" id="eDocSueldo" accept=".xlsx,.xls,.csv,.pdf">
                    </div>
                </div>
                <div class="modal-footer" style="background:#f8f7f4; border-top:1px solid #ece9e4;">
                    <button type="button" class="pla-btn-sec" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnEditarSueldo" class="pla-btn-pri">
                        <i class="fa-solid fa-save me-1"></i> Guardar cambios
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    {{-- MODAL: ELIMINAR                                                        --}}
    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="modalEliminarSueldo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border:none; border-radius:16px; overflow:hidden;">
                <div class="p-4 text-center" style="background:#FDF2F2;">
                    <i class="fa-solid fa-triangle-exclamation fa-2x mb-3" style="color:#E74C3C;"></i>
                    <h5 class="fw-700 mb-1">¿Eliminar este registro?</h5>
                    <p class="text-muted mb-4" style="font-size:.88rem;">Esta acción no se puede deshacer.</p>
                    <input type="hidden" id="elIdSueldo">
                    <input type="hidden" id="elUidSueldo">
                    <div class="d-flex justify-content-center gap-3">
                        <button class="pla-btn-sec px-4" data-bs-dismiss="modal">Cancelar</button>
                        <button class="pla-btn-danger px-4" id="btnConfEliminarSueldo">
                            <i class="fa-solid fa-trash me-1"></i> Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    {{-- MODAL ÉXITO                                                            --}}
    {{-- ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="successModalS" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
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
                                <p id="texto_success_s" class="text-uppercase mb-0 fw-700">Operación exitosa</p>
                            </div>
                            <div class="col-2 text-end">
                                <button class="btn-close" id="btnCloseSuccessS"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- ════════════════════════════════════════════════════════════════════════════ --}}
@section('css')
    @parent
    <style>
        .fw-700  { font-weight:700 !important; }
        .fw-800  { font-weight:800 !important; }
        .fw-600  { font-weight:600 !important; }
        .min-width-0 { min-width:0; }

        /* ─── Buscador ─── */
        .sld-search-wrap {
            position:relative;
            flex:1; max-width:320px;
        }
        .sld-search-ico {
            position:absolute; left:12px; top:50%;
            transform:translateY(-50%);
            color:#aaa; font-size:.85rem; pointer-events:none;
        }
        .sld-search {
            width:100%; padding:9px 14px 9px 34px;
            border-radius:10px; border:2px solid #e8e5e0;
            font-size:.88rem; background:#fff;
            transition:border-color .2s;
        }
        .sld-search:focus {
            outline:none; border-color:#16A085;
            box-shadow:0 0 0 3px rgba(22,160,133,.1);
        }

        /* ─── User card ─── */
        .sld-user-card {
            background:#fff;
            border-radius:14px;
            padding:14px 16px;
            box-shadow:0 2px 12px rgba(0,0,0,.06);
            border:1px solid #f0ede8;
            border-left:4px solid #16A085;
            display:flex; align-items:center; gap:12px;
            transition:box-shadow .2s, transform .2s;
        }
        .sld-user-card:hover {
            box-shadow:0 6px 22px rgba(0,0,0,.1);
            transform:translateY(-2px);
        }
        .sld-avatar {
            width:42px; height:42px; border-radius:50%;
            background:linear-gradient(135deg,#16A085,#1ABC9C);
            color:#fff; font-weight:800; font-size:1.1rem;
            display:flex; align-items:center; justify-content:center;
            flex-shrink:0;
        }
        .sld-uname {
            font-weight:700; font-size:.9rem; color:#1a1a2e;
            line-height:1.25;
        }
        .sld-uemail {
            font-size:.72rem; color:#aaa; margin-top:2px;
        }
        .sld-badge-wrap { margin-left:auto; flex-shrink:0; }
        .sld-cnt-badge {
            background:#16A085; color:#fff;
            border-radius:50px; padding:2px 9px;
            font-size:.7rem; font-weight:700;
        }
        .sld-eye-btn {
            width:34px; height:34px; border-radius:9px;
            border:2px solid #16A085; background:transparent;
            color:#16A085; font-size:.85rem;
            display:flex; align-items:center; justify-content:center;
            cursor:pointer; flex-shrink:0;
            transition:all .2s;
        }
        .sld-eye-btn:hover {
            background:#16A085; color:#fff;
        }

        /* ─── Ilustración lock ─── */
        .sld-lock-ilustra {
            text-align:center; padding:12px 0 4px;
        }

        /* ─── Chart card (reuse de planillas) ─── */
        .pla-chart-card {
            background:#fff; border-radius:16px;
            padding:28px 32px;
            box-shadow:0 4px 24px rgba(0,0,0,.07);
            border:1px solid #f0ede8;
        }

        /* ─── Mini cards ─── */
        .pla-mini-card {
            background:#f8f7f4; border-radius:12px;
            padding:12px 16px; border:1px solid #ece9e4;
            display:flex; align-items:center; gap:10px;
        }
        .pla-mini-icon {
            width:36px; height:36px; border-radius:9px;
            display:flex; align-items:center; justify-content:center;
            font-size:.95rem; color:#fff; flex-shrink:0;
        }
        .pla-mini-label {
            font-size:.7rem; color:#aaa;
            text-transform:uppercase; letter-spacing:.4px;
        }
        .pla-mini-value {
            font-size:.95rem; font-weight:800; color:#1a1a2e;
        }

        /* ─── Toggle gráfico ─── */
        .pla-toggle {
            padding:6px 18px; border-radius:20px;
            border:2px solid #e0ddd8; background:#fff;
            color:#666; font-size:.82rem; font-weight:600;
            cursor:pointer; transition:all .2s;
        }
        .pla-toggle:hover { border-color:#16A085; color:#16A085; }
        .pla-toggle.active { background:#16A085; border-color:#16A085; color:#fff; }

        /* ─── Modals (reutilizados) ─── */
        .pla-modal { border-radius:16px; overflow:hidden; border:none; }
        .pla-mh    { padding:20px 24px; color:#fff; }
        .pla-icon-wrap {
            width:42px; height:42px; border-radius:11px;
            display:flex; align-items:center; justify-content:center;
            background:rgba(255,255,255,.22); font-size:1.1rem; flex-shrink:0;
        }
        .pla-label {
            display:block; font-size:.8rem; font-weight:700;
            color:#555; text-transform:uppercase;
            letter-spacing:.4px; margin-bottom:5px;
        }
        .pla-input {
            border-radius:10px !important; border:2px solid #e8e5e0 !important;
            padding:9px 14px !important; font-size:.88rem !important;
            transition:all .2s; width:100%;
        }
        .pla-input:focus {
            border-color:#16A085 !important; outline:none;
            box-shadow:0 0 0 3px rgba(22,160,133,.12) !important;
        }
        .pla-step-label {
            display:flex; align-items:center; gap:8px;
            font-size:.78rem; font-weight:700; color:#888;
            text-transform:uppercase; letter-spacing:.4px;
        }
        .pla-step-num {
            width:22px; height:22px; border-radius:50%;
            background:#16A085; color:#fff;
            display:inline-flex; align-items:center; justify-content:center;
            font-size:.72rem; font-weight:800; flex-shrink:0;
        }
        .pla-btn-pri {
            background:#E67E22; color:#fff; border:none;
            border-radius:10px; padding:9px 22px;
            font-weight:700; font-size:.85rem;
            cursor:pointer; transition:all .2s;
        }
        .pla-btn-pri:hover { filter:brightness(.9); }
        .pla-btn-sec {
            background:#f0ede8; color:#666; border:none;
            border-radius:10px; padding:9px 22px;
            font-weight:600; font-size:.85rem;
            cursor:pointer; transition:all .2s;
        }
        .pla-btn-sec:hover { background:#e0ddd8; }
        .pla-btn-danger {
            background:#E74C3C; color:#fff; border:none;
            border-radius:10px; padding:9px 22px;
            font-weight:700; font-size:.85rem;
            cursor:pointer; transition:all .2s;
        }
        .pla-btn-danger:hover { background:#C0392B; }

        /* ─── Table ─── */
        .pla-table { border-collapse:separate; border-spacing:0 5px; }
        .pla-table thead th {
            background:#f0ede8; padding:10px 14px;
            font-size:.77rem; font-weight:700;
            color:#666; text-transform:uppercase;
            letter-spacing:.4px; border:none;
        }
        .pla-table thead th:first-child { border-radius:8px 0 0 8px; }
        .pla-table thead th:last-child  { border-radius:0 8px 8px 0; }
        .pla-table tbody td {
            background:#fff; padding:11px 14px;
            font-size:.85rem; vertical-align:middle;
            border-top:1px solid #f5f2ee;
            border-bottom:1px solid #f5f2ee;
        }
        .pla-table tbody td:first-child {
            border-left:1px solid #f5f2ee; border-radius:8px 0 0 8px;
        }
        .pla-table tbody td:last-child {
            border-right:1px solid #f5f2ee; border-radius:0 8px 8px 0;
        }
        .pla-table tbody tr:hover td { background:#fafaf8; }
    </style>
@endsection

{{-- ════════════════════════════════════════════════════════════════════════════ --}}
@section('javascript')
    @parent
    <script>
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // ── Helpers ──────────────────────────────────────────────────────────────
    function fmtMiles(el) {
        let v = el.value.replace(/\D/g,'');
        el.value = v.replace(/\B(?=(\d{3})+(?!\d))/g,'.');
    }
    function parseNum(str) {
        return parseFloat((str||'0').replace(/\./g,'').replace(',','.')) || 0;
    }
    function money(n) {
        return '$ ' + Number(n).toLocaleString('es-CL', { maximumFractionDigits:0 });
    }
    function showSuccessS(msg) {
        $('#texto_success_s').text(msg);
        $('#successModalS').modal('show');
    }

    // ── Estado local ─────────────────────────────────────────────────────────
    // DB: { uid: [ registros ] }
    const DB_S = {};

    // Totales globales cargados desde servidor
    let globalTotales = []; // [{ id_user, nombre, total }]

    // ── Búsqueda de colaboradores ─────────────────────────────────────────────
    $('#buscarUsuario').on('input', function() {
        const q = this.value.toLowerCase().trim();
        $('.sld-user-col').each(function() {
            const nombre = $(this).data('nombre') || '';
            $(this).toggle(!q || nombre.includes(q));
        });
    });

    // ── MODAL VERIFICAR ───────────────────────────────────────────────────────
    $(document).on('click', '.btn-ver-sueldo', function() {
        const uid    = $(this).data('uid');
        const nombre = $(this).data('nombre');
        $('#vUid').val(uid);
        $('#vPassword').val('');
        $('#vError').hide();
        $('#vNombreUsuario').text(nombre);
        $('#modalVerificar').modal('show');
        setTimeout(() => $('#vPassword').focus(), 400);
    });

    // Toggle visibilidad contraseña
    $('#togglePass').on('click', function() {
        const inp = $('#vPassword');
        const ico = $('#togglePassIco');
        if (inp.attr('type') === 'password') {
            inp.attr('type','text');
            ico.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            inp.attr('type','password');
            ico.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Enter en campo contraseña
    $('#vPassword').on('keydown', function(e) {
        if (e.key === 'Enter') $('#btnVerificar').click();
    });

    $('#btnVerificar').on('click', function() {
        const uid  = $('#vUid').val();
        const pass = $('#vPassword').val();
        if (!pass) { $('#vError').text('Ingresa la contraseña.').show(); return; }

        $(this).prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-1"></i> Verificando…');

        $.ajax({
            url:  '/sueldos/verificar',
            type: 'POST',
            data: { id_user: uid, password: pass },
            success: res => {
                if (res.ok) {
                    DB_S[uid] = res.data;
                    actualizarBadge(uid);
                    $('#modalVerificar').modal('hide');
                    abrirModalVerSueldo(uid);
                }
            },
            error: () => {
                $('#vError').text('Contraseña incorrecta.').show();
            },
            complete: () => {
                $('#btnVerificar').prop('disabled', false)
                    .html('<i class="fa-solid fa-unlock me-1"></i> Acceder');
            }
        });
    });

    // ── MODAL VER SUELDOS ─────────────────────────────────────────────────────
    function abrirModalVerSueldo(uid) {
        const $card  = $(`.sld-user-card[data-uid="${uid}"]`);
        const nombre = $card.data('nombre') || 'Colaborador';
        $('#vsUid').val(uid);
        $('#mhVerSueldoTitulo').text('Sueldos — ' + nombre);
        renderResumenUsuario(uid);
        renderTablaSueldo(uid);
        $('#modalVerSueldo').modal('show');
    }

    function renderResumenUsuario(uid) {
        const items = DB_S[uid] || [];
        const suma  = items.reduce((a,b) => a + (parseFloat(b.total_mes)||0), 0);
        const n     = items.length;
        const $div  = $('#sld-resumen-usuario');
        $div.html(`
            <div class="col-sm-6 col-md-4">
                <div class="pla-mini-card">
                    <div class="pla-mini-icon" style="background:#16A085;">
                        <i class="fa-solid fa-money-check-dollar"></i>
                    </div>
                    <div>
                        <div class="pla-mini-label">Total acumulado</div>
                        <div class="pla-mini-value">${money(suma)}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="pla-mini-card">
                    <div class="pla-mini-icon" style="background:#8E44AD;">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <div>
                        <div class="pla-mini-label">Registros</div>
                        <div class="pla-mini-value">${n}</div>
                    </div>
                </div>
            </div>
        `);
    }

    function renderTablaSueldo(uid) {
        const items  = DB_S[uid] || [];
        const $tbody = $('#tbodySueldo');
        if (!items.length) {
            $tbody.html(`<tr><td colspan="5" class="text-center py-5 text-muted">
                <i class="fa-solid fa-inbox fa-2x mb-2 d-block opacity-25"></i>Sin registros</td></tr>`);
            return;
        }
        let html = '';
        items.forEach((item, i) => {
            const ext     = (item.nombre_archivo||'').split('.').pop().toLowerCase();
            const ico     = ext==='pdf' ? 'fa-file-pdf' : 'fa-file-excel';
            const icoClr  = ext==='pdf' ? '#E74C3C'     : '#27AE60';
            const docBtns = item.documento
                ? `<a href="${item.documento}" target="_blank"
                      class="btn btn-sm btn-outline-secondary rounded-pill me-1"
                      style="font-size:.7rem;"><i class="fa-solid fa-eye"></i> Ver</a>
                   <a href="${item.documento}" download
                      class="btn btn-sm btn-outline-primary rounded-pill"
                      style="font-size:.7rem;"><i class="fa-solid fa-download"></i></a>`
                : '<span class="text-muted" style="font-size:.78rem;">Sin archivo</span>';

            html += `<tr>
                <td><span class="badge rounded-pill" style="background:#f0ede8;color:#666;">${i+1}</span></td>
                <td>${item.fecha||'—'}</td>
                <td>
                    <i class="fa-solid ${ico}" style="color:${icoClr}; margin-right:5px;"></i>
                    <span class="fw-600">${item.nombre_archivo||'—'}</span>
                    <div class="mt-1">${docBtns}</div>
                </td>
                <td><span class="fw-700">${money(item.total_mes||0)}</span></td>
                <td>
                    <button class="btn btn-sm btn-warning rounded-circle me-1 btn-editar-sueldo"
                            data-id="${item.id}" data-uid="${uid}" title="Editar">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <button class="btn btn-sm btn-danger rounded-circle btn-eliminar-sueldo"
                            data-id="${item.id}" data-uid="${uid}" title="Eliminar">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>`;
        });
        $tbody.html(html);
    }

    // ── MODAL AGREGAR SUELDO ──────────────────────────────────────────────────
    $('#btnAbrirAgregar').on('click', function() {
        $('#aUserId').val('');
        $('#aFechaSueldo').val(new Date().toISOString().split('T')[0]);
        $('#aTotalSueldo').val('');
        $('#aDocSueldo').val('');
        $('#modalAgregarSueldo').modal('show');
    });

    $('#btnGuardarSueldo').on('click', function() {
        const uid    = $('#aUserId').val();
        const fecha  = $('#aFechaSueldo').val();
        const total  = parseNum($('#aTotalSueldo').val());
        const archivo= $('#aDocSueldo')[0].files[0];

        if (!uid)   { alert('Selecciona un colaborador.'); return; }
        if (!fecha) { alert('Selecciona una fecha.'); return; }
        if (total <= 0) { alert('Ingresa el total del mes.'); return; }

        const fd = new FormData();
        fd.append('id_user', uid);
        fd.append('fecha',   fecha);
        fd.append('sueldo',  total);
        if (archivo) fd.append('archivo', archivo);

        $(this).prop('disabled', true).text('Guardando…');

        $.ajax({
            url: '/usuarios/asignar_sueldo', type:'POST',
            data: fd, processData:false, contentType:false,
            success: res => {
                if (res.ok) {
                    if (!DB_S[uid]) DB_S[uid] = [];
                    DB_S[uid].unshift(res.registro);
                    actualizarBadge(uid);
                    actualizarTotalGlobal(uid, res.registro.total_mes, 'add');
                    $('#modalAgregarSueldo').modal('hide');
                    showSuccessS('Sueldo guardado correctamente');
                    refreshGraficoS();
                }
            },
            error: () => {
                // Fallback local
                if (!DB_S[uid]) DB_S[uid] = [];
                DB_S[uid].unshift({
                    id: Date.now(), fecha, total_mes: total,
                    nombre_archivo: archivo ? archivo.name : null,
                    documento: null, id_user: uid
                });
                actualizarBadge(uid);
                actualizarTotalGlobal(uid, total, 'add');
                $('#modalAgregarSueldo').modal('hide');
                showSuccessS('Sueldo guardado correctamente');
                refreshGraficoS();
            },
            complete: () => $('#btnGuardarSueldo').prop('disabled',false)
                .html('<i class="fa-solid fa-save me-1"></i> Guardar'),
        });
    });

    // ── MODAL EDITAR ──────────────────────────────────────────────────────────
    $(document).on('click', '.btn-editar-sueldo', function() {
        const id  = $(this).data('id');
        const uid = $(this).data('uid');
        const item= (DB_S[uid]||[]).find(x => x.id == id);
        if (!item) return;

        $('#eIdSueldo').val(id);
        $('#eUidSueldo').val(uid);
        $('#eFechaSueldo').val(item.fecha);
        $('#eTotalSueldo').val(Number(item.total_mes).toLocaleString('es-CL',{maximumFractionDigits:0}));
        $('#eDocSueldo').val('');
        $('#modalEditarSueldo').modal('show');
    });

    $('#btnEditarSueldo').on('click', function() {
        const id    = $('#eIdSueldo').val();
        const uid   = $('#eUidSueldo').val();
        const fecha = $('#eFechaSueldo').val();
        const total = parseNum($('#eTotalSueldo').val());
        const arch  = $('#eDocSueldo')[0].files[0];

        const fd = new FormData();
        fd.append('id', id); fd.append('fecha', fecha); fd.append('sueldo', total);
        if (arch) fd.append('documento', arch);

        $(this).prop('disabled',true).text('Guardando…');

        $.ajax({
            url: '/sueldos/editar', type:'POST',
            data: fd, processData:false, contentType:false,
            success: () => finEditarSueldo(uid, id, fecha, total, arch),
            error:   () => finEditarSueldo(uid, id, fecha, total, arch),
            complete:() => $('#btnEditarSueldo').prop('disabled',false)
                .html('<i class="fa-solid fa-save me-1"></i> Guardar cambios'),
        });
    });

    function finEditarSueldo(uid, id, fecha, total, arch) {
        const idx = (DB_S[uid]||[]).findIndex(x => x.id == id);
        if (idx !== -1) {
            const old = DB_S[uid][idx].total_mes || 0;
            DB_S[uid][idx].fecha     = fecha;
            DB_S[uid][idx].total_mes = total;
            if (arch) DB_S[uid][idx].nombre_archivo = arch.name;
            // Recalcular total global del usuario
            recalcularTotalGlobal(uid);
        }
        renderResumenUsuario(uid);
        renderTablaSueldo(uid);
        refreshGraficoS();
        $('#modalEditarSueldo').modal('hide');
        showSuccessS('Registro actualizado correctamente');
    }

    // ── MODAL ELIMINAR ────────────────────────────────────────────────────────
    $(document).on('click', '.btn-eliminar-sueldo', function() {
        $('#elIdSueldo').val($(this).data('id'));
        $('#elUidSueldo').val($(this).data('uid'));
        $('#modalEliminarSueldo').modal('show');
    });

    $('#btnConfEliminarSueldo').on('click', function() {
        const id  = $('#elIdSueldo').val();
        const uid = $('#elUidSueldo').val();
        $.ajax({
            url: '/sueldos/eliminar/' + id, type:'DELETE',
            success: () => finEliminarSueldo(uid, id),
            error:   () => finEliminarSueldo(uid, id),
        });
    });

    function finEliminarSueldo(uid, id) {
        DB_S[uid] = (DB_S[uid]||[]).filter(x => x.id != id);
        actualizarBadge(uid);
        recalcularTotalGlobal(uid);
        renderResumenUsuario(uid);
        renderTablaSueldo(uid);
        refreshGraficoS();
        $('#modalEliminarSueldo').modal('hide');
        showSuccessS('Registro eliminado correctamente');
    }

    // ── Helpers de estado ─────────────────────────────────────────────────────
    function actualizarBadge(uid) {
        const n = (DB_S[uid]||[]).length;
        $('#cnt-u-' + uid).text(n);
    }

    function actualizarTotalGlobal(uid, monto, op) {
        const entry = globalTotales.find(x => x.id_user == uid);
        if (entry) {
            entry.total = op === 'add'
                ? (entry.total + parseFloat(monto))
                : Math.max(0, entry.total - parseFloat(monto));
        }
    }

    function recalcularTotalGlobal(uid) {
        const suma  = (DB_S[uid]||[]).reduce((a,b)=>a+(parseFloat(b.total_mes)||0),0);
        const entry = globalTotales.find(x => x.id_user == uid);
        if (entry) entry.total = suma;
    }

    // ── GRÁFICO ───────────────────────────────────────────────────────────────
    let chartS     = null;
    let chartTypeS = 'pie';

    const PALETTE = [
        '#16A085','#2980B9','#8E44AD','#E67E22',
        '#27AE60','#C0392B','#F39C12','#1ABC9C',
        '#D35400','#2C3E50',
    ];

    function refreshGraficoS() {
        const datos = globalTotales
            .filter(x => x.total > 0)
            .map((x, i) => ({
                label: x.nombre,
                valor: x.total,
                color: PALETTE[i % PALETTE.length],
            }));

        renderMiniTotalesS(datos);

        const canvas = document.getElementById('graficoSueldos');
        const empty  = document.getElementById('sld-empty');

        if (!datos.length) {
            empty.style.display  = 'block';
            canvas.style.display = 'none';
            if (chartS) { chartS.destroy(); chartS = null; }
            return;
        }
        empty.style.display  = 'none';
        canvas.style.display = 'block';
        if (chartS) chartS.destroy();

        chartS = new Chart(canvas.getContext('2d'), {
            type: chartTypeS === 'pie' ? 'doughnut' : 'bar',
            data: {
                labels:   datos.map(d => d.label),
                datasets: [{
                    data:            datos.map(d => d.valor),
                    backgroundColor: datos.map(d => d.color + 'CC'),
                    borderColor:     datos.map(d => d.color),
                    borderWidth:     2,
                    borderRadius:    chartTypeS === 'bar' ? 8 : 0,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend:  { position: chartTypeS === 'pie' ? 'right' : 'top' },
                    tooltip: { callbacks: { label: ctx => ' ' + money(ctx.raw) } }
                },
                scales: chartTypeS === 'bar'
                    ? { y: { beginAtZero:true, ticks: { callback: v => money(v) } } }
                    : {}
            }
        });
    }

    function renderMiniTotalesS(datos) {
        if (!datos.length) { $('#sld-mini-totales').html(''); return; }
        let html = '';
        datos.slice(0, 8).forEach(d => {
            html += `<div class="col-sm-6 col-lg-3">
                <div class="pla-mini-card">
                    <div class="pla-mini-icon" style="background:${d.color};">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div style="min-width:0;">
                        <div class="pla-mini-label text-truncate">${d.label}</div>
                        <div class="pla-mini-value">${money(d.valor)}</div>
                    </div>
                </div>
            </div>`;
        });
        $('#sld-mini-totales').html(html);
    }

    function cambiarGraficoS(tipo) {
        chartTypeS = tipo;
        $('#btn-pie-s').toggleClass('active', tipo === 'pie');
        $('#btn-bar-s').toggleClass('active', tipo === 'bar');
        refreshGraficoS();
    }

    // ── Init ──────────────────────────────────────────────────────────────────
    $(document).ready(function() {
        $.get('/sueldos/listar', function(res) {
            if (res && res.totales) {
                globalTotales = res.totales;
            }
        }).always(() => refreshGraficoS());
    });

    $('#btnCloseSuccessS').on('click', () => $('#successModalS').modal('hide'));
    </script>
@endsection