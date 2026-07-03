@extends('layouts.app')

@section('css')
@parent
<style>
:root {
    --rrhh-primary:   #1a1a2e;
    --rrhh-accent:    #E67E22;
    --rrhh-accent2:   #F39C12;
    --rrhh-success:   #27AE60;
    --rrhh-danger:    #E74C3C;
    --rrhh-surface:   #ffffff;
    --rrhh-bg:        #f4f6f9;
    --rrhh-border:    #e8e4df;
    --rrhh-text:      #1a1a2e;
    --rrhh-muted:     #8a8a9a;
    --rrhh-shadow:    0 4px 24px rgba(0,0,0,.08);
    --rrhh-radius:    16px;
}
.rrhh-main { background: var(--rrhh-bg); min-height: 100vh; }
.rrhh-header {
    background: var(--rrhh-surface);
    border-bottom: 2px solid var(--rrhh-border);
    padding: 22px 32px;
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 16px;
}
.rrhh-titulo {
    font-size: 1.65rem; font-weight: 900; color: var(--rrhh-primary);
    letter-spacing: -.5px; margin: 0; display: flex; align-items: center; gap: 12px;
}
.rrhh-titulo-icon {
    width: 46px; height: 46px;
    background: linear-gradient(135deg, var(--rrhh-accent), var(--rrhh-accent2));
    border-radius: 12px; display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 1.15rem; box-shadow: 0 4px 14px rgba(230,126,34,.35);
}
.rrhh-subtitulo { color: var(--rrhh-muted); font-size: .85rem; margin: 0; }
.rrhh-tabs { display: flex; gap: 8px; }
.rrhh-tab {
    padding: 9px 22px; border-radius: 24px;
    border: 2px solid var(--rrhh-border); background: var(--rrhh-surface);
    color: var(--rrhh-muted); font-size: .83rem; font-weight: 700;
    cursor: pointer; transition: all .2s;
}
.rrhh-tab:hover  { border-color: var(--rrhh-accent); color: var(--rrhh-accent); }
.rrhh-tab.active { background: var(--rrhh-accent); border-color: var(--rrhh-accent); color: #fff; box-shadow: 0 4px 14px rgba(230,126,34,.3); }
.rrhh-search-wrap {
    padding: 18px 32px; display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
}
.rrhh-search-group { position: relative; display: flex; align-items: center; }
.rrhh-search-group i { position: absolute; left: 14px; color: var(--rrhh-muted); }
.rrhh-search {
    padding: 10px 16px 10px 40px; min-width: 240px;
    border: 2px solid var(--rrhh-border); border-radius: 12px;
    font-size: .88rem; background: var(--rrhh-surface);
    color: var(--rrhh-text); transition: border-color .2s;
}
.rrhh-search:focus { outline: none; border-color: var(--rrhh-accent); }
.rrhh-btn {
    padding: 10px 20px; border-radius: 24px; border: none;
    font-weight: 700; font-size: .83rem; cursor: pointer;
    transition: all .2s; display: inline-flex; align-items: center; gap: 7px;
}
.rrhh-btn-primary {
    background: linear-gradient(135deg, var(--rrhh-accent), var(--rrhh-accent2));
    color: #fff; box-shadow: 0 4px 14px rgba(230,126,34,.35);
}
.rrhh-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(230,126,34,.45); }
.rrhh-btn-secondary {
    background: var(--rrhh-surface); color: var(--rrhh-text);
    border: 2px solid var(--rrhh-border);
}
.rrhh-btn-secondary:hover { border-color: var(--rrhh-accent); color: var(--rrhh-accent); }
.rrhh-btn-danger { background: var(--rrhh-danger); color: #fff; box-shadow: 0 4px 14px rgba(231,76,60,.3); }
.rrhh-btn-danger:hover { opacity: .9; transform: translateY(-1px); }

/* Grid */
.rrhh-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
    gap: 20px; padding: 0 32px 40px;
}

/* Card */
.rrhh-card {
    background: var(--rrhh-surface); border-radius: var(--rrhh-radius);
    box-shadow: var(--rrhh-shadow); border: 2px solid transparent;
    transition: all .25s; overflow: hidden;
}
.rrhh-card:hover {
    border-color: var(--rrhh-accent);
    box-shadow: 0 8px 32px rgba(230,126,34,.15);
    transform: translateY(-3px);
}
.rrhh-card-header {
    background: linear-gradient(135deg, var(--rrhh-primary), #2c3e50);
    padding: 20px 22px 16px; display: flex; align-items: center; gap: 14px;
}
.rrhh-avatar {
    width: 52px; height: 52px; border-radius: 14px;
    background: linear-gradient(135deg, var(--rrhh-accent), var(--rrhh-accent2));
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; font-weight: 900; color: #fff;
    flex-shrink: 0; box-shadow: 0 4px 14px rgba(230,126,34,.4); letter-spacing: -.5px;
}
.rrhh-card-name { font-size: 1rem; font-weight: 800; color: #fff; margin: 0; line-height: 1.2; }
.rrhh-card-cargo { font-size: .74rem; color: rgba(255,255,255,.65); margin: 3px 0 0; display: flex; align-items: center; gap: 5px; }
.rrhh-cargo-badge {
    background: rgba(230,126,34,.3); color: var(--rrhh-accent2);
    padding: 2px 8px; border-radius: 8px; font-size: .7rem;
    font-weight: 700; border: 1px solid rgba(230,126,34,.4);
}
.rrhh-card-body { padding: 18px 22px 14px; }
.rrhh-field { margin-bottom: 11px; }
.rrhh-field-label {
    font-size: .68rem; font-weight: 700; color: var(--rrhh-muted);
    text-transform: uppercase; letter-spacing: .6px;
    display: flex; align-items: center; gap: 5px; margin-bottom: 3px;
}
.rrhh-field-value {
    font-size: .87rem; color: var(--rrhh-text); font-weight: 500;
    padding: 7px 12px; background: var(--rrhh-bg); border-radius: 8px;
    border: 1px solid var(--rrhh-border); word-break: break-all;
}
.rrhh-field-value.empty { color: var(--rrhh-muted); font-style: italic; }
.rrhh-archivos-list { display: flex; flex-direction: column; gap: 5px; margin-top: 4px; }
.rrhh-archivo-item {
    display: flex; align-items: center; gap: 8px;
    background: var(--rrhh-bg); border-radius: 8px;
    padding: 6px 10px; border: 1px solid var(--rrhh-border);
    font-size: .78rem; color: var(--rrhh-text);
}
.rrhh-archivo-icon { font-size: .85rem; flex-shrink: 0; }
.rrhh-archivo-icon.pdf   { color: #e74c3c; }
.rrhh-archivo-icon.excel { color: #27ae60; }
.rrhh-archivo-icon.word  { color: #2980b9; }
.rrhh-archivo-icon.img   { color: #8e44ad; }
.rrhh-archivo-icon.other { color: #7f8c8d; }
.rrhh-archivo-name { flex: 1; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.rrhh-archivo-del {
    color: var(--rrhh-danger); cursor: pointer; padding: 2px 4px;
    border-radius: 4px; font-size: .75rem; flex-shrink: 0; transition: background .15s;
}
.rrhh-archivo-del:hover { background: rgba(231,76,60,.12); }
.rrhh-card-footer {
    padding: 12px 22px 18px; display: flex; gap: 8px; justify-content: flex-end;
    border-top: 1px solid var(--rrhh-border);
}
.rrhh-icon-btn {
    width: 36px; height: 36px; border-radius: 10px; border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center; font-size: .85rem; transition: all .2s;
}
.rrhh-icon-btn-edit { background: rgba(41,128,185,.12); color: #2980b9; }
.rrhh-icon-btn-edit:hover { background: #2980b9; color: #fff; }
.rrhh-icon-btn-del { background: rgba(231,76,60,.12); color: var(--rrhh-danger); }
.rrhh-icon-btn-del:hover { background: var(--rrhh-danger); color: #fff; }

/* Tabla cargos */
.rrhh-table-wrap {
    background: var(--rrhh-surface); border-radius: var(--rrhh-radius);
    box-shadow: var(--rrhh-shadow); overflow: hidden; margin: 0 32px 40px;
}
.rrhh-table { width: 100%; border-collapse: collapse; }
.rrhh-table thead th {
    background: var(--rrhh-primary); color: rgba(255,255,255,.85);
    padding: 14px 18px; font-size: .75rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .5px; border: none;
}
.rrhh-table tbody td {
    padding: 13px 18px; font-size: .87rem;
    border-bottom: 1px solid var(--rrhh-border); color: var(--rrhh-text); vertical-align: middle;
}
.rrhh-table tbody tr:last-child td { border-bottom: none; }
.rrhh-table tbody tr:hover td { background: #faf9f7; }

/* Modales */
.rrhh-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,.55); z-index: 1050;
    align-items: center; justify-content: center; padding: 20px;
}
.rrhh-overlay.show { display: flex; }
.rrhh-modal {
    background: var(--rrhh-surface); border-radius: 20px;
    width: 100%; max-width: 620px; max-height: 90vh; overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,.25); animation: rrhh-modal-in .25s ease;
}
@keyframes rrhh-modal-in {
    from { opacity: 0; transform: scale(.95) translateY(-12px); }
    to   { opacity: 1; transform: scale(1)  translateY(0); }
}
.rrhh-modal-header {
    padding: 22px 28px 18px; display: flex; align-items: center; gap: 14px;
    border-bottom: 2px solid var(--rrhh-border);
    position: sticky; top: 0; background: var(--rrhh-surface); z-index: 2;
}
.rrhh-modal-icon {
    width: 42px; height: 42px; border-radius: 11px;
    background: linear-gradient(135deg, var(--rrhh-accent), var(--rrhh-accent2));
    display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1rem;
}
.rrhh-modal-title { font-size: 1.05rem; font-weight: 800; color: var(--rrhh-primary); margin: 0; }
.rrhh-modal-close {
    margin-left: auto; background: var(--rrhh-bg); border: none;
    width: 34px; height: 34px; border-radius: 8px; cursor: pointer;
    color: var(--rrhh-muted); font-size: 1rem; display: flex; align-items: center; justify-content: center; transition: all .2s;
}
.rrhh-modal-close:hover { background: var(--rrhh-danger); color: #fff; }
.rrhh-modal-body { padding: 24px 28px; }
.rrhh-modal-footer {
    padding: 16px 28px 24px; display: flex; gap: 10px; justify-content: flex-end;
    border-top: 2px solid var(--rrhh-border);
}
.rrhh-form-group { margin-bottom: 16px; }
.rrhh-label {
    display: block; font-size: .74rem; font-weight: 700; color: var(--rrhh-muted);
    text-transform: uppercase; letter-spacing: .5px; margin-bottom: 6px;
}
.rrhh-input {
    width: 100%; padding: 10px 14px; border: 2px solid var(--rrhh-border);
    border-radius: 10px; font-size: .88rem; color: var(--rrhh-text);
    background: var(--rrhh-bg); transition: border-color .2s; box-sizing: border-box;
}
.rrhh-input:focus { outline: none; border-color: var(--rrhh-accent); background: #fff; }
.rrhh-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23888' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;
}
.rrhh-file-input {
    width: 100%; padding: 10px 14px; border: 2px dashed var(--rrhh-border);
    border-radius: 10px; font-size: .83rem; color: var(--rrhh-muted);
    background: var(--rrhh-bg); cursor: pointer; transition: border-color .2s; box-sizing: border-box;
}
.rrhh-file-input:hover { border-color: var(--rrhh-accent); }
.rrhh-cargo-row { display: flex; gap: 8px; align-items: flex-end; }
.rrhh-cargo-row .rrhh-select { flex: 1; }
.rrhh-add-cargo-btn {
    height: 42px; width: 42px; flex-shrink: 0; border-radius: 10px;
    background: linear-gradient(135deg, var(--rrhh-accent), var(--rrhh-accent2));
    border: none; color: #fff; cursor: pointer; font-size: 1rem;
    display: flex; align-items: center; justify-content: center; transition: all .2s;
}
.rrhh-add-cargo-btn:hover { transform: scale(1.08); box-shadow: 0 4px 14px rgba(230,126,34,.4); }
.rrhh-mini-modal {
    background: var(--rrhh-surface); border-radius: 14px; width: 100%; max-width: 340px;
    box-shadow: 0 20px 60px rgba(0,0,0,.25); animation: rrhh-modal-in .2s ease;
}
.rrhh-toast {
    position: fixed; bottom: 30px; right: 30px; z-index: 9999;
    background: var(--rrhh-primary); color: #fff;
    padding: 14px 22px; border-radius: 12px; font-size: .87rem; font-weight: 600;
    box-shadow: 0 8px 28px rgba(0,0,0,.3); display: flex; align-items: center; gap: 10px;
    transform: translateY(80px); opacity: 0;
    transition: all .35s cubic-bezier(.34,1.56,.64,1); max-width: 340px;
}
.rrhh-toast.show { transform: translateY(0); opacity: 1; }
.rrhh-toast.success { border-left: 4px solid var(--rrhh-success); }
.rrhh-toast.error   { border-left: 4px solid var(--rrhh-danger); }
.rrhh-empty { text-align: center; padding: 60px 20px; color: var(--rrhh-muted); font-size: .9rem; }
.rrhh-empty i { font-size: 3rem; margin-bottom: 16px; opacity: .3; display: block; }
@media (max-width: 768px) {
    .rrhh-header { padding: 16px 20px; }
    .rrhh-search-wrap, .rrhh-grid, .rrhh-table-wrap { padding-left: 16px; padding-right: 16px; }
    .rrhh-grid { grid-template-columns: 1fr; }
}
</style>
@endsection

@section('content')
<div class="container-fluid overflow-hidden" style="background:#fff;">
<div class="row vh-100 overflow-auto" style="background:var(--rrhh-bg, #f4f6f9);">

    @include('layouts.sidebar')

    <div class="col d-flex flex-column h-100 rrhh-main" style="padding:0; overflow-y:auto;">

        {{-- Header --}}
        <div class="rrhh-header">
            <div>
                <h1 class="rrhh-titulo">
                    <span class="rrhh-titulo-icon"><i class="fa-solid fa-users"></i></span>
                    Recursos Humanos
                </h1>
                <p class="rrhh-subtitulo">Gestión del equipo de trabajo</p>
            </div>
            <div class="rrhh-tabs">
                <button class="rrhh-tab active" id="tab-equipo" onclick="switchTab('equipo')">
                    <i class="fa-solid fa-id-card me-1"></i> Equipo
                </button>
                <button class="rrhh-tab" id="tab-cargos" onclick="switchTab('cargos')">
                    <i class="fa-solid fa-briefcase me-1"></i> Cargos
                </button>
            </div>
        </div>

        {{-- VISTA EQUIPO --}}
        <div id="vista-equipo">
            <div class="rrhh-search-wrap">
                <div class="rrhh-search-group">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" class="rrhh-search" id="buscador-equipo" placeholder="Buscar por nombre, RUT, cargo…">
                </div>
                <button class="rrhh-btn rrhh-btn-primary" onclick="abrirModalUsuario()">
                    <i class="fa-solid fa-plus"></i> Agregar Colaborador
                </button>
            </div>

            <div class="rrhh-grid" id="gridEquipo">
                @forelse ($users as $user)
                    {{-- ▼ CAMBIO CLAVE: apunta a partials.card_usuario (carpeta resources/views/partials/) --}}
                    @include('partials.card_usuario', ['user' => $user])
                @empty
                    <div class="rrhh-empty" style="grid-column:1/-1;">
                        <i class="fa-solid fa-user-slash"></i>
                        No hay colaboradores registrados aún.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- VISTA CARGOS --}}
        <div id="vista-cargos" style="display:none;">
            <div class="rrhh-search-wrap">
                <div class="rrhh-search-group">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" class="rrhh-search" id="buscador-cargos" placeholder="Buscar cargo…">
                </div>
                <button class="rrhh-btn rrhh-btn-primary" onclick="abrirModalCargo()">
                    <i class="fa-solid fa-plus"></i> Nuevo Cargo
                </button>
            </div>

            <div class="rrhh-table-wrap">
                <table class="rrhh-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre del Cargo</th>
                            <th>Colaboradores</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaCargosBody">
                        @foreach ($cargos as $i => $cargo)
                        <tr data-nombre="{{ strtolower($cargo->nombre) }}">
                            <td>{{ $i + 1 }}</td>
                            <td><span style="font-weight:700;">{{ $cargo->nombre }}</span></td>
                            <td>
                                <span style="font-size:.78rem; padding:4px 10px; border-radius:10px; background:rgba(230,126,34,.12); color:#E67E22; border:1px solid rgba(230,126,34,.3); font-weight:700;">
                                    {{ $users->where('id_cargo', $cargo->id)->count() }} colaborador(es)
                                </span>
                            </td>
                            <td>
                                <button class="rrhh-icon-btn rrhh-icon-btn-edit me-1"
                                        onclick="editarCargo({{ $cargo->id }}, '{{ addslashes($cargo->nombre) }}')"
                                        title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="rrhh-icon-btn rrhh-icon-btn-del"
                                        onclick="eliminarCargo({{ $cargo->id }})"
                                        title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @include('layouts.footer')
    </div>
</div>
</div>

{{-- ── MODAL USUARIO ── --}}
<div class="rrhh-overlay" id="overlayUsuario">
    <div class="rrhh-modal">
        <div class="rrhh-modal-header">
            <div class="rrhh-modal-icon"><i class="fa-solid fa-user-pen"></i></div>
            <h5 class="rrhh-modal-title" id="tituloModalUsuario">Agregar Colaborador</h5>
            <button class="rrhh-modal-close" onclick="cerrarModal('overlayUsuario')"><i class="fas fa-times"></i></button>
        </div>
        <div class="rrhh-modal-body">
            <input type="hidden" id="userId">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="rrhh-form-group">
                        <label class="rrhh-label"><i class="fas fa-user me-1"></i> Nombre completo *</label>
                        <input type="text" class="rrhh-input" id="inputNombre" placeholder="Ej: Pedro Aguilera">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="rrhh-form-group">
                        <label class="rrhh-label"><i class="fas fa-id-card me-1"></i> RUT</label>
                        <input type="text" class="rrhh-input" id="inputRut" placeholder="Ej: 12.345.678-9">
                    </div>
                </div>
                <div class="col-12">
                    <div class="rrhh-form-group">
                        <label class="rrhh-label"><i class="fas fa-envelope me-1"></i> Correo electrónico *</label>
                        <input type="email" class="rrhh-input" id="inputEmail" placeholder="Ej: pedro@empresa.com">
                    </div>
                </div>
                <div class="col-12">
                    <div class="rrhh-form-group">
                        <label class="rrhh-label"><i class="fas fa-map-marker-alt me-1"></i> Dirección</label>
                        <input type="text" class="rrhh-input" id="inputDireccion" placeholder="Ej: Av. Las Flores 123">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="rrhh-form-group">
                        <label class="rrhh-label"><i class="fas fa-briefcase me-1"></i> Cargo *</label>
                        <div class="rrhh-cargo-row">
                            <select class="rrhh-input rrhh-select" id="inputCargo">
                                <option value="">Seleccione un cargo</option>
                                @foreach ($cargos as $cargo)
                                    <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                                @endforeach
                            </select>
                            <button class="rrhh-add-cargo-btn" onclick="abrirMiniModalCargo()" title="Crear nuevo cargo">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="rrhh-form-group">
                        <label class="rrhh-label"><i class="fas fa-lock me-1"></i> Contraseña <span id="passNote" style="color:var(--rrhh-muted);text-transform:none;font-weight:400;">(requerida)</span></label>
                        <input type="password" class="rrhh-input" id="inputPassword" placeholder="••••••">
                    </div>
                </div>
                {{-- Datos bancarios --}}
                <div class="col-12">
                    <div style="background:var(--rrhh-bg); border-radius:12px; padding:16px; border:1px solid var(--rrhh-border);">
                        <div style="font-size:.75rem; font-weight:700; color:var(--rrhh-muted); text-transform:uppercase; letter-spacing:.5px; margin-bottom:12px;">
                            <i class="fas fa-university me-1"></i> Datos de cuenta bancaria
                        </div>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <label class="rrhh-label">Banco</label>
                                <input type="text" class="rrhh-input" id="inputBanco" placeholder="Ej: Banco Estado">
                            </div>
                            <div class="col-md-4">
                                <label class="rrhh-label">N° Cuenta</label>
                                <input type="text" class="rrhh-input" id="inputNumeroCuenta" placeholder="Ej: 000123456">
                            </div>
                            <div class="col-md-4">
                                <label class="rrhh-label">Tipo cuenta</label>
                                <select class="rrhh-input rrhh-select" id="inputTipoCuenta">
                                    <option value="">Seleccionar</option>
                                    <option value="Cuenta Corriente">Cuenta Corriente</option>
                                    <option value="Cuenta Vista">Cuenta Vista</option>
                                    <option value="Cuenta de Ahorro">Cuenta de Ahorro</option>
                                    <option value="Cuenta RUT">Cuenta RUT</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Archivos --}}
                <div class="col-12">
                    <div class="rrhh-form-group">
                        <label class="rrhh-label"><i class="fas fa-paperclip me-1"></i> Archivos adjuntos</label>
                        <input type="file" class="rrhh-file-input" id="inputArchivos" multiple
                               accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.gif">
                        <small style="color:var(--rrhh-muted); font-size:.74rem;">PDF, Word, Excel, imágenes. Puedes seleccionar varios.</small>
                    </div>
                    <div id="listaArchivosExistentes" style="display:none;">
                        <div style="font-size:.74rem; font-weight:700; color:var(--rrhh-muted); margin-bottom:6px;">Archivos actuales:</div>
                        <div class="rrhh-archivos-list" id="archivosExistentesList"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rrhh-modal-footer">
            <button class="rrhh-btn rrhh-btn-secondary" onclick="cerrarModal('overlayUsuario')">Cancelar</button>
            <button class="rrhh-btn rrhh-btn-primary" onclick="guardarUsuario()">
                <i class="fas fa-save me-1"></i> Guardar
            </button>
        </div>
    </div>
</div>

{{-- ── MODAL CARGO ── --}}
<div class="rrhh-overlay" id="overlayCargo">
    <div class="rrhh-modal" style="max-width:460px;">
        <div class="rrhh-modal-header">
            <div class="rrhh-modal-icon"><i class="fa-solid fa-briefcase"></i></div>
            <h5 class="rrhh-modal-title" id="tituloModalCargo">Gestionar Cargo</h5>
            <button class="rrhh-modal-close" onclick="cerrarModal('overlayCargo')"><i class="fas fa-times"></i></button>
        </div>
        <div class="rrhh-modal-body">
            <div class="rrhh-form-group" style="display:flex; gap:8px;">
                <input type="hidden" id="cargoId">
                <input type="text" class="rrhh-input" id="inputCargoNombre" placeholder="Nombre del cargo" style="flex:1;">
                <button class="rrhh-btn rrhh-btn-primary" onclick="guardarCargo()" style="white-space:nowrap;">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </div>
        <div class="rrhh-modal-footer" style="border-top:none; padding-top:0;">
            <button class="rrhh-btn rrhh-btn-secondary" onclick="cerrarModal('overlayCargo')">Cerrar</button>
        </div>
    </div>
</div>

{{-- ── MINI MODAL CARGO RÁPIDO ── --}}
<div class="rrhh-overlay" id="overlayMiniCargo">
    <div class="rrhh-mini-modal">
        <div class="rrhh-modal-header">
            <div class="rrhh-modal-icon" style="width:36px;height:36px;font-size:.85rem;"><i class="fas fa-plus"></i></div>
            <h5 class="rrhh-modal-title" style="font-size:.95rem;">Nuevo Cargo</h5>
            <button class="rrhh-modal-close" onclick="cerrarModal('overlayMiniCargo')"><i class="fas fa-times"></i></button>
        </div>
        <div class="rrhh-modal-body" style="padding:18px 24px;">
            <label class="rrhh-label">Nombre del cargo</label>
            <input type="text" class="rrhh-input" id="inputMiniCargoNombre" placeholder="Ej: Contador">
        </div>
        <div class="rrhh-modal-footer">
            <button class="rrhh-btn rrhh-btn-secondary" onclick="cerrarModal('overlayMiniCargo')">Cancelar</button>
            <button class="rrhh-btn rrhh-btn-primary" onclick="guardarMiniCargo()">
                <i class="fas fa-save"></i> Crear
            </button>
        </div>
    </div>
</div>

{{-- ── MODAL CONFIRMAR ELIMINAR ── --}}
<div class="rrhh-overlay" id="overlayConfirm">
    <div class="rrhh-mini-modal">
        <div class="rrhh-modal-header">
            <div class="rrhh-modal-icon" style="background:linear-gradient(135deg,#E74C3C,#C0392B);"><i class="fas fa-exclamation-triangle"></i></div>
            <h5 class="rrhh-modal-title" id="confirmTitulo">¿Eliminar?</h5>
            <button class="rrhh-modal-close" onclick="cerrarModal('overlayConfirm')"><i class="fas fa-times"></i></button>
        </div>
        <div class="rrhh-modal-body" style="padding:12px 24px;">
            <p id="confirmTexto" style="margin:0; color:var(--rrhh-muted); font-size:.88rem;"></p>
        </div>
        <div class="rrhh-modal-footer">
            <button class="rrhh-btn rrhh-btn-secondary" onclick="cerrarModal('overlayConfirm')">Cancelar</button>
            <button class="rrhh-btn rrhh-btn-danger" id="btnConfirm"><i class="fas fa-trash-alt"></i> Eliminar</button>
        </div>
    </div>
</div>

{{-- Toast --}}
<div class="rrhh-toast" id="rrhhToast">
    <i class="fas fa-check-circle" id="toastIcon"></i>
    <span id="toastMsg">Guardado correctamente</span>
</div>
@endsection

@section('javascript')
@parent
<script>
const CSRF = '{{ csrf_token() }}';
let modoEdicion = false;

function mostrarToast(msg, tipo = 'success') {
    const t = document.getElementById('rrhhToast');
    t.className = 'rrhh-toast ' + tipo;
    document.getElementById('toastMsg').textContent = msg;
    document.getElementById('toastIcon').className = tipo === 'success'
        ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3200);
}
function cerrarModal(id) { document.getElementById(id).classList.remove('show'); }
function abrirModal(id)  { document.getElementById(id).classList.add('show'); }

document.querySelectorAll('.rrhh-overlay').forEach(ov => {
    ov.addEventListener('click', e => { if (e.target === ov) ov.classList.remove('show'); });
});

function switchTab(tab) {
    document.getElementById('vista-equipo').style.display = tab === 'equipo' ? 'block' : 'none';
    document.getElementById('vista-cargos').style.display = tab === 'cargos' ? 'block' : 'none';
    document.getElementById('tab-equipo').classList.toggle('active', tab === 'equipo');
    document.getElementById('tab-cargos').classList.toggle('active', tab === 'cargos');
}

document.getElementById('buscador-equipo').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#gridEquipo .rrhh-card').forEach(card => {
        card.style.display = card.dataset.busqueda.includes(q) ? '' : 'none';
    });
});
document.getElementById('buscador-cargos').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#tablaCargosBody tr').forEach(tr => {
        tr.style.display = (tr.dataset.nombre || '').includes(q) ? '' : 'none';
    });
});

function iconoArchivo(ext) {
    if (!ext) return { icon: 'fa-file', cls: 'other' };
    ext = ext.toLowerCase();
    if (ext === 'pdf')                          return { icon: 'fa-file-pdf',   cls: 'pdf' };
    if (['xls','xlsx'].includes(ext))           return { icon: 'fa-file-excel', cls: 'excel' };
    if (['doc','docx'].includes(ext))           return { icon: 'fa-file-word',  cls: 'word' };
    if (['jpg','jpeg','png','gif'].includes(ext))return { icon: 'fa-file-image', cls: 'img' };
    return { icon: 'fa-file', cls: 'other' };
}

function abrirModalUsuario(userId = null) {
    modoEdicion = !!userId;
    const titulo   = document.getElementById('tituloModalUsuario');
    const passNote = document.getElementById('passNote');

    // Limpiar todos los campos
    ['userId','inputNombre','inputRut','inputEmail','inputDireccion',
     'inputPassword','inputBanco','inputNumeroCuenta'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
    });
    document.getElementById('inputCargo').value      = '';
    document.getElementById('inputTipoCuenta').value = '';
    document.getElementById('inputArchivos').value   = '';
    document.getElementById('listaArchivosExistentes').style.display = 'none';
    document.getElementById('archivosExistentesList').innerHTML = '';

    if (!userId) {
        titulo.textContent   = 'Agregar Colaborador';
        passNote.textContent = '(requerida)';
        abrirModal('overlayUsuario');
        return;
    }

    // Modo edición: cargar datos del servidor
    titulo.textContent   = 'Editar Colaborador';
    passNote.textContent = '(dejar vacío para no cambiar)';
    document.getElementById('userId').value = userId;

    fetch(`/rrhh/usuario/${userId}`, {
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        const u = data.user;

        // Datos personales
        document.getElementById('inputNombre').value    = u.name        || '';
        document.getElementById('inputRut').value       = u.rut         || '';
        document.getElementById('inputEmail').value     = u.email       || '';
        document.getElementById('inputDireccion').value = u.direccion   || '';
        document.getElementById('inputCargo').value     = u.id_cargo    || '';

        // ── Datos bancarios ──────────────────────────────────────────────────
        if (data.datos_bancarios) {
            const db = data.datos_bancarios;
            document.getElementById('inputBanco').value        = db.nombre_banco  || '';
            document.getElementById('inputNumeroCuenta').value = db.numero_cuenta || '';
            document.getElementById('inputTipoCuenta').value   = db.tipo_cuenta   || '';
        }

        // ── Archivos existentes ──────────────────────────────────────────────
        if (data.archivos && data.archivos.length > 0) {
            const lista = document.getElementById('archivosExistentesList');
            lista.innerHTML = '';
            data.archivos.forEach(a => {
                const { icon, cls } = iconoArchivo(a.tipo_archivo);
                lista.insertAdjacentHTML('beforeend', `
                    <div class="rrhh-archivo-item" id="archivo-${a.id}">
                        <i class="fas ${icon} rrhh-archivo-icon ${cls}"></i>
                        <span class="rrhh-archivo-name">${a.nombre_archivo}</span>
                        <a href="/storage/${a.ruta_archivo}" target="_blank"
                           class="rrhh-archivo-del" title="Ver">
                            <i class="fas fa-eye"></i>
                        </a>
                        <span class="rrhh-archivo-del"
                              onclick="eliminarArchivoRrhh(${a.id})" title="Eliminar">
                            <i class="fas fa-trash-alt"></i>
                        </span>
                    </div>
                `);
            });
            document.getElementById('listaArchivosExistentes').style.display = 'block';
        }

        abrirModal('overlayUsuario');
    })
    .catch(() => mostrarToast('Error al cargar datos del colaborador', 'error'));
}

// ════════════════════════════════════
// GUARDAR USUARIO (con manejo de errores detallado)
// ════════════════════════════════════
function guardarUsuario() {
    const userId = document.getElementById('userId').value;
    const nombre = document.getElementById('inputNombre').value.trim();
    const email  = document.getElementById('inputEmail').value.trim();
    const cargo  = document.getElementById('inputCargo').value;

    if (!nombre || !email || !cargo) {
        mostrarToast('Nombre, correo y cargo son obligatorios.', 'error'); return;
    }
    if (!modoEdicion && !document.getElementById('inputPassword').value) {
        mostrarToast('La contraseña es obligatoria para nuevos colaboradores.', 'error'); return;
    }

    const fd = new FormData();
    fd.append('name',          nombre);
    fd.append('email',         email);
    fd.append('id_cargo',      cargo);
    fd.append('rut',           document.getElementById('inputRut').value.trim());
    fd.append('direccion',     document.getElementById('inputDireccion').value.trim());
    fd.append('password',      document.getElementById('inputPassword').value);
    fd.append('nombre_banco',  document.getElementById('inputBanco').value.trim());
    fd.append('numero_cuenta', document.getElementById('inputNumeroCuenta').value.trim());
    fd.append('tipo_cuenta',   document.getElementById('inputTipoCuenta').value);
    fd.append('_token', CSRF);
    Array.from(document.getElementById('inputArchivos').files)
         .forEach(f => fd.append('archivos[]', f));

    const url = modoEdicion ? `/rrhh/usuario/${userId}` : '/rrhh/usuario';

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': CSRF,
            'Accept': 'application/json'   // 👈 fuerza respuesta JSON en vez de redirect HTML
        },
        body: fd
    })
    .then(async r => {
        const data = await r.json().catch(() => null);

        if (!r.ok) {
            let msg = data && data.message ? data.message : `Error ${r.status}`;
            if (data && data.errors) {
                msg = Object.values(data.errors).flat().join(' ');
            }
            console.error('Error del servidor:', data);
            mostrarToast(msg, 'error');
            return;
        }

        cerrarModal('overlayUsuario');
        mostrarToast(data.message || 'Guardado correctamente');
        setTimeout(() => location.reload(), 1000);
    })
    .catch(err => {
        console.error('Error de red/parseo:', err);
        mostrarToast('Error al guardar el colaborador.', 'error');
    });
}

function eliminarUsuario(userId, nombre) {
    document.getElementById('confirmTitulo').textContent = '¿Eliminar colaborador?';
    document.getElementById('confirmTexto').textContent  =
        `Se eliminará a "${nombre}" y todos sus archivos adjuntos. Esta acción no se puede deshacer.`;
    abrirModal('overlayConfirm');
    document.getElementById('btnConfirm').onclick = () => {
        fetch(`/rrhh/usuario/${userId}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            cerrarModal('overlayConfirm');
            mostrarToast(data.message || 'Colaborador eliminado');
            setTimeout(() => location.reload(), 900);
        })
        .catch(() => mostrarToast('Error al eliminar.', 'error'));
    };
}

function eliminarArchivoRrhh(archivoId) {
    fetch(`/rrhh/archivo/${archivoId}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        const el = document.getElementById('archivo-' + archivoId);
        if (el) el.remove();
        mostrarToast(data.message || 'Archivo eliminado');
    })
    .catch(() => mostrarToast('Error al eliminar archivo.', 'error'));
}

function abrirModalCargo(id = null, nombre = '') {
    document.getElementById('cargoId').value         = id || '';
    document.getElementById('inputCargoNombre').value = nombre;
    document.getElementById('tituloModalCargo').textContent = id ? 'Editar Cargo' : 'Nuevo Cargo';
    abrirModal('overlayCargo');
}
function editarCargo(id, nombre) { abrirModalCargo(id, nombre); }

function guardarCargo() {
    const id     = document.getElementById('cargoId').value;
    const nombre = document.getElementById('inputCargoNombre').value.trim();
    if (!nombre) { mostrarToast('El nombre del cargo es obligatorio.', 'error'); return; }

    fetch(id ? `/rrhh/cargo/${id}` : '/rrhh/cargo', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({ nombre })
    })
    .then(r => r.json())
    .then(data => {
        cerrarModal('overlayCargo');
        mostrarToast(data.message || 'Cargo guardado');
        setTimeout(() => location.reload(), 900);
    })
    .catch(() => mostrarToast('Error al guardar cargo.', 'error'));
}

function eliminarCargo(id) {
    document.getElementById('confirmTitulo').textContent = '¿Eliminar cargo?';
    document.getElementById('confirmTexto').textContent  =
        'Se eliminará este cargo. Los colaboradores asignados quedarán sin cargo.';
    abrirModal('overlayConfirm');
    document.getElementById('btnConfirm').onclick = () => {
        fetch(`/rrhh/cargo/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            cerrarModal('overlayConfirm');
            mostrarToast(data.message || 'Cargo eliminado');
            setTimeout(() => location.reload(), 900);
        })
        .catch(() => mostrarToast('Error al eliminar cargo.', 'error'));
    };
}

function abrirMiniModalCargo() {
    document.getElementById('inputMiniCargoNombre').value = '';
    abrirModal('overlayMiniCargo');
}
function guardarMiniCargo() {
    const nombre = document.getElementById('inputMiniCargoNombre').value.trim();
    if (!nombre) { mostrarToast('Ingresa un nombre para el cargo.', 'error'); return; }

    fetch('/rrhh/cargo', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({ nombre })
    })
    .then(r => r.json())
    .then(data => {
        cerrarModal('overlayMiniCargo');
        mostrarToast('Cargo "' + nombre + '" creado');
        const sel = document.getElementById('inputCargo');
        sel.add(new Option(nombre, data.cargo.id, true, true));
    })
    .catch(() => mostrarToast('Error al crear cargo.', 'error'));
}
</script>
@endsection