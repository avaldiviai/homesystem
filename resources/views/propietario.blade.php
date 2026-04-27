@extends('layouts.app')
@section('content')
<div class="container-fluid overflow-hidden" style="background-color: #FFAB40">
    <div class="row vh-100 overflow-auto" style="background-color:rgb(255, 255, 255)">
        @include('layouts.sidebar')
        <div class="col d-flex flex-column h-100" style="padding:0;">
            <div class="flex-grow-1">
                {{-- Contenido --}}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6" style="text-align: start; margin-top: 40px; margin-bottom: 20px; color: white">
                            <h1 class="text-uppercase text-black">Propietarios</h1>
                        </div>
                    </div>
                </div>

                {{-- Barra de herramientas --}}
                <div class="container-fluid">
                    <div class="row justify-content-between align-items-center mb-3">
                        <div class="col-md-5 mb-3">
                            <div class="input-group shadow-lg" style="max-width: 420px;">
                                <span class="input-group-text bg-primary text-white shadow-sm">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="text" id="buscador_cnn" placeholder="Buscar Propietario"
                                    class="form-control shadow-sm border-0"
                                    style="box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            </div>
                        </div>
                        <div class="col-md-7 mb-3 d-flex justify-content-end align-items-center gap-2">
                            {{-- Toggle vista --}}
                            <div class="btn-group shadow-sm" role="group">
                                <button type="button" id="btn-vista-tarjetas" class="btn btn-primary btn-sm px-3 active-view" title="Vista tarjetas">
                                    <i class="fa-solid fa-grip"></i>
                                </button>
                                <button type="button" id="btn-vista-lista" class="btn btn-outline-secondary btn-sm px-3" title="Vista lista">
                                    <i class="fa-solid fa-list"></i>
                                </button>
                            </div>
                            <button type="button" class="btn btn-success shadow" data-bs-toggle="modal" data-bs-target="#agregarpropietario">
                                <i class="fas fa-plus me-1"></i> AGREGAR PROPIETARIO
                            </button>
                        </div>
                    </div>

                    {{-- ===== VISTA TARJETAS ===== --}}
                    <div id="vista-tarjetas" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-3 pb-4">
                        @foreach ($propietarios as $propietario)
                        <div class="col propietario-item" data-nombre="{{ strtolower($propietario->nombre) }}" data-rut="{{ strtolower($propietario->rut) }}">
                            <div class="card-propietario h-100 shadow-sm position-relative">
                                {{-- Enlace principal a detalle --}}
                                <a href="{{ route('propietario.detalles', $propietario->id) }}" class="card-link-overlay" title="Ver propiedades de {{ $propietario->nombre }}"></a>

                                {{-- Avatar e info --}}
                                <div class="card-prop-body">
                                    <div class="prop-avatar">
                                        {{ strtoupper(substr($propietario->nombre, 0, 1)) }}
                                    </div>
                                    <div class="prop-info">
                                        <h6 class="prop-name">{{ $propietario->nombre }}</h6>
                                        <span class="prop-rut">{{ $propietario->rut }}</span>
                                    </div>
                                </div>

                                {{-- Datos de contacto --}}
                                <div class="card-prop-details">
                                    <div class="prop-detail-item">
                                        <i class="fa-solid fa-envelope text-primary"></i>
                                        <span class="text-truncate">{{ $propietario->correo ?? '—' }}</span>
                                    </div>
                                    <div class="prop-detail-item">
                                        <i class="fa-solid fa-phone text-success"></i>
                                        <span>{{ $propietario->telefono ?? '—' }}</span>
                                    </div>
                                    <div class="prop-detail-item">
                                        <i class="fa-solid fa-location-dot text-danger"></i>
                                        <span class="text-truncate">{{ $propietario->ciudad ?? '—' }}</span>
                                    </div>
                                </div>

                                {{-- Acciones --}}
                                <div class="card-prop-actions">
                                    <a href="{{ route('propietario.detalles', $propietario->id) }}"
                                       class="btn-prop-action btn-ver" title="Ver propiedades">
                                        <i class="fas fa-building"></i>
                                        <span>Propiedades</span>
                                    </a>
                                    <button type="button"
                                        class="btn-prop-action btn-editar editar-propietario-btn"
                                        data-id="{{ $propietario->id }}" title="Editar">
                                        <i class="fas fa-edit"></i>
                                        <span>Editar</span>
                                    </button>
                                    <button type="button"
                                        class="btn-prop-action btn-cuenta mostra-cuentas-btn"
                                        data-id="{{ $propietario->id }}" title="Cuentas bancarias">
                                        <i class="fa-solid fa-sack-dollar"></i>
                                        <span>Cuentas</span>
                                    </button>
                                    <button type="button"
                                        class="btn-prop-action btn-eliminar borrar-propietario-btn"
                                        data-id="{{ $propietario->id }}" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Eliminar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- ===== VISTA LISTA ===== --}}
                    <div id="vista-lista" class="pb-4" style="display:none;">
                        <div class="overflow-auto shadow-lg" style="max-height: 65vh;">
                            <table class="table table-striped-columns align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Rut</th>
                                        <th>Correo</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Ciudad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaUa">
                                    @foreach ($propietarios as $propietario)
                                    <tr class="propietario-fila"
                                        data-nombre="{{ strtolower($propietario->nombre) }}"
                                        data-rut="{{ strtolower($propietario->rut) }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('propietario.detalles', $propietario->id) }}" style="text-decoration:none; color:inherit; font-weight:600;">
                                                {{ $propietario->nombre }}
                                            </a>
                                        </td>
                                        <td>{{ $propietario->rut }}</td>
                                        <td>{{ $propietario->correo }}</td>
                                        <td>{{ $propietario->telefono }}</td>
                                        <td>{{ $propietario->direccion }}</td>
                                        <td>{{ $propietario->ciudad }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm editar-propietario-btn" data-id="{{ $propietario->id }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm borrar-propietario-btn" data-id="{{ $propietario->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <a href="#" class="btn btn-success btn-sm mostra-cuentas-btn" data-id="{{ $propietario->id }}">
                                                <i class="fa-solid fa-sack-dollar"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>{{-- /container --}}
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>

{{-- ====================== MODALES (sin cambios) ====================== --}}

<!-- Modal agregar Propietario -->
<div class="modal fade" id="agregarpropietario" tabindex="-1" data-bs-backdrop="static" aria-labelledby="agregarpropietarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarpropietarioLabel">Agregar Propietario</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="container">
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="nombreInput"><b>Nombre</b></label>
                                <input type="text" class="form-control mt-2" id="nombreInput" placeholder="Ej: Pedro Aguilera" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-6">
                                <label for="rutInput"><b>Rut</b></label>
                                <input type="text" class="form-control mt-2" id="rutInput" placeholder="12.345.678-9"
                                    pattern="\d{1,2}\.\d{3}\.\d{3}-[\dkK]" title="Formato válido: 12.345.678-9" minlength="9" maxlength="12">
                            </div>
                            <div class="form-group mb-3 col-6">
                                <label for="telefonoInput"><b>Teléfono</b></label>
                                <input type="text" class="form-control mt-2" id="telefonoInput"
                                    placeholder="Ej: 912345678" maxlength="9" minlength="9" required
                                    pattern="\d{9}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="correoInput"><b>Correo</b></label>
                                <input type="text" class="form-control mt-2" id="correoInput" placeholder="Ej: pedro@gmail.com" required>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="direccionInput"><b>Dirección</b></label>
                                    <input type="text" class="form-control mt-2" id="direccionInput" placeholder="Dirección" required>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="ciudadInput"><b>Ciudad</b></label>
                                    <input type="text" class="form-control mt-2" id="ciudadInput" placeholder="Ciudad" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success w-100 mt-3 mb-3 text-uppercase text-white" type="button"
                                    data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false">
                                    <b>Agregar Datos Bancarios</b>
                                </button>
                            </div>
                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nombreBancoInput"><b>Nombre del Banco</b></label>
                                        <div class="form-group mb-2">
                                            <input type="text" class="form-control m-1" id="nombreBancoInput" placeholder="Nombre del Banco" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="numeroCuenteInput"><b>Numero de Cuenta</b></label>
                                        <div class="form-group mb-2">
                                            <input type="text" class="form-control m-1" id="numeroCuenteInput" placeholder="numero de cuenta" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="TipoCuentaInput"><b>Tipo de Cuenta</b></label>
                                        <div class="form-group mb-2 d-flex">
                                            <select name="notificaion" id="TipoCuentaInput" class="form-select m-1">
                                                <option selected disabled value="option">Seleccione un tipo de Cuenta</option>
                                                <option value="Ahorro">Ahorro</option>
                                                <option value="Corriente">Corriente</option>
                                                <option value="Vista">Vista</option>
                                                <option value="Chequera electrónica">Chequera Electrónica</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <button class="btn btn-success m-1 text-uppercase text-white" id="agregar-datosbanca"><b>Agregar Cuenta</b></button>
                                    </div>
                                </div>
                            </div>
                            <ul class="text-uppercase mt-4" id="lista-Datos"></ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btn_agregar" class="btn btn-primary">Guardar</button>
                            <button type="button" id="btn_cerrar_agregar" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Propietario -->
<div class="modal fade" id="editarPropietarioModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="EditarpropietarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="EditarpropietarioLabel">Editar Propietario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="container">
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="nombreEditInput"><b>Nombre</b></label>
                                <input type="text" class="form-control mt-2" id="nombreEditInput" placeholder="Ej: Pedro Aguilera" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-6">
                                <label for="rutEditInput"><b>Rut</b></label>
                                <input type="text" class="form-control mt-2" id="rutEditInput" placeholder="12.345.678-9" minlength="9" maxlength="12">
                            </div>
                            <div class="form-group mb-3 col-6">
                                <label for="telefonoEditInput"><b>Telefono</b></label>
                                <input type="text" class="form-control mt-2" id="telefonoEditInput" placeholder="Ej: 912345678" required>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="correoEditInput"><b>Correo</b></label>
                                <input type="text" class="form-control mt-2" id="correoEditInput" placeholder="Ej: pedro@gmail.com" required>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="direccionEditInput"><b>Dirección</b></label>
                                    <input type="text" class="form-control mt-2" id="direccionEditInput" placeholder="Dirección" required>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="ciudadEditInput"><b>Ciudad</b></label>
                                    <input type="text" class="form-control mt-2" id="ciudadEditInput" placeholder="Ciudad" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn_editar" class="btn btn-primary">Guardar</button>
                        <button type="button" id="btn_cerrar_agregar" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Mostrar Cuentas -->
<div class="modal fade" id="MostrarCuenta" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <h5 class="modal-title" style="text-align:center;">Cuentas Bancarias</h5>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row"><h5 class="text-cent"></div>
                    <div class="form-group"><div id="listaCuentasEdit"></div></div>
                    <ul class="text-uppercase mt-4" id="lista-agregados-edit"></ul>
                    <div class="col-12">
                        <button class="btn btn-warning w-100 mt-3 mb-3 text-uppercase text-white" type="button"
                            data-bs-toggle="collapse" data-bs-target=".multi-collapse3">
                            <b>Agregar Nueva cuenta</b>
                        </button>
                    </div>
                    <div class="collapse multi-collapse3" id="multiCollapseExample3">
                        <div class="row">
                            <input type="hidden" id="idPropietarioInput">
                            <div class="col-md-4">
                                <label for="nombreBancoInput2"><b>Nombre del Banco</b></label>
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control m-1" id="nombreBancoInput2" placeholder="Nombre del Banco" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="numeroCuenteInput2"><b>Numero de Cuenta</b></label>
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control m-1" id="numeroCuenteInput2" placeholder="numero de cuenta" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="TipoCuentaInput2"><b>Tipo de Cuenta</b></label>
                                <div class="form-group mb-2 d-flex">
                                    <select name="notificaion" id="TipoCuentaInput2" class="form-select m-1">
                                        <option selected disabled value="option">Seleccione un tipo de Cuenta</option>
                                        <option value="Ahorro">Ahorro</option>
                                        <option value="Corriente">Corriente</option>
                                        <option value="Vista">vista</option>
                                        <option value="Chequera electronica">Chequera Electronica</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                            <button class="btn btn-info m-1 text-uppercase text-white" data-id="" id="agregar-datosbanca2"><b>Agregar Nueva Cuenta</b></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Cuenta -->
<div class="modal fade" id="editarCuentaModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="EditarCuentaLabel">Editar Cuentas Bancarias</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="container">
                        <div class="col-md-12 mb-3"><div id="listaCuentasDetalle"></div></div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="nombreBancoInputEdit"><b>Nombre del Banco</b></label>
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control m-1" id="nombreBancoInputEdit" placeholder="Nombre del Banco" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="numeroCuenteInputEdit"><b>Numero de Cuenta</b></label>
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control m-1" id="numeroCuenteInputEdit" placeholder="numero de cuenta" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="TipoCuentaInputEdit"><b>Tipo de Cuenta</b></label>
                                <div class="form-group mb-2 d-flex">
                                    <select name="notificaion" id="TipoCuentaInputEdit" class="form-select m-1">
                                        <option selected disabled value="option">Seleccione un tipo de Cuenta</option>
                                        <option value="Ahorro">Ahorro</option>
                                        <option value="Corriente">Corriente</option>
                                        <option value="Vista">Vista</option>
                                        <option value="Chequera electronica">Chequera electronica</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="text-uppercase mt-4" id="lista_Datos_Cuentas"></ul>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning text-uppercase" id="btn_editar_cuenta"><b>Guardar cambios</b></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmar Eliminar -->
<div class="modal fade" id="modalEliminarPropietario" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
            <div class="modal-content" style="background-color:rgb(0,0,0,0.0);border:none">
                <h5 class="m-4 text-uppercase text-center">¿Seguro que quieres eliminar el propietario?</h5>
                <input type="hidden" id="eliminar-idPropietario">
                <div class="modalfooter d-flex justify-content-center">
                    <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="confirmDelete" class="btn btn-secondary m-2">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error Eliminar -->
<div class="modal fade" id="modalerroreliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-header alert alert-warning" role="alert" style="border:none;">
            <div class="modal-content" style="background-color:rgb(0,0,0,0.0);border:none">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json" trigger="loop" delay="2000" style="width:70px;height:70px"></lord-icon>
                        </div>
                        <div class="col-8 d-flex justify-content-center align-items-center">
                            <p id="texto_error" class="text-uppercase"></p>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn-close d-flex justify-content-end" data-bs-dismiss="modal" aria-label="Close" id="btn_cerrar_error_eliminar"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Cuenta -->
<div class="modal fade" id="deleteCuentaModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
            <div class="modal-content" style="background-color:rgb(0,0,0,0.0);border:none">
                <h5 class="m-4 text-uppercase text-center">¿Seguro que quieres eliminar la cuenta?</h5>
                <div class="modalfooter d-flex justify-content-center">
                    <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn_eliminar_cuenta" class="btn btn-secondary m-2">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Éxito -->
<div class="modal fade" id="modalAlertaAgregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:rgba(0,0,0,0.0);border:none;width:700px;">
            <div class="modal-header alert alert-success" role="alert" style="border:none;">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000" style="width:70px;height:70px"></lord-icon>
                        </div>
                        <div class="col-8 d-flex justify-content-center align-items-center">
                            <p id="texto_success" class="text-uppercase"></p>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn-close d-flex justify-content-end" id="btn-close"></button>
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
/* ─── Tarjetas de propietario ─────────────────────────────────────── */
.card-propietario {
    background: #fff;
    border-radius: 16px;
    border: 1.5px solid #f0f0f0;
    overflow: hidden;
    transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    cursor: pointer;
    display: flex;
    flex-direction: column;
}
.card-propietario:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.12) !important;
    border-color: #0d6efd44;
}

/* Enlace invisible que cubre toda la tarjeta */
.card-link-overlay {
    position: absolute;
    inset: 0;
    z-index: 1;
    border-radius: 16px;
}

/* Zona de acciones con z-index superior al overlay */
.card-prop-actions {
    position: relative;
    z-index: 2;
}

/* Cabecera con avatar */
.card-prop-body {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 20px 18px 14px;
    border-bottom: 1px solid #f5f5f5;
    background: linear-gradient(135deg, #fff 60%, #f8f4ff 100%);
}
.prop-avatar {
    width: 52px;
    height: 52px;
    min-width: 52px;
    border-radius: 14px;
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    color: #fff;
    font-size: 1.5rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(13,110,253,.25);
    letter-spacing: -1px;
}
.prop-info {
    overflow: hidden;
}
.prop-name {
    margin: 0;
    font-size: .95rem;
    font-weight: 700;
    color: #1a1a2e;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.prop-rut {
    font-size: .78rem;
    color: #888;
    font-weight: 500;
}

/* Detalles de contacto */
.card-prop-details {
    padding: 12px 18px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1;
}
.prop-detail-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: .82rem;
    color: #555;
    overflow: hidden;
}
.prop-detail-item i {
    width: 16px;
    text-align: center;
    flex-shrink: 0;
}
.prop-detail-item span {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Acciones */
.card-prop-actions {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    border-top: 1px solid #f0f0f0;
}
.btn-prop-action {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 3px;
    padding: 10px 6px 8px;
    font-size: .7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .3px;
    background: none;
    border: none;
    border-right: 1px solid #f0f0f0;
    cursor: pointer;
    transition: background .18s, color .18s;
    color: #555;
    text-decoration: none;
}
.btn-prop-action:last-child { border-right: none; }
.btn-prop-action i { font-size: .95rem; }

.btn-ver:hover     { background: #e8f0fe; color: #0d6efd; }
.btn-editar:hover  { background: #fff3cd; color: #d97706; }
.btn-cuenta:hover  { background: #d1fae5; color: #059669; }
.btn-eliminar:hover{ background: #fee2e2; color: #dc2626; }

/* ─── Toggle botones ──────────────────────────────────────────────── */
#btn-vista-tarjetas.active-view,
#btn-vista-lista.active-view {
    background-color: #0d6efd;
    color: #fff;
    border-color: #0d6efd;
}
</style>
@endsection

@section('javascript')
@parent
<script>
$(document).ready(function () {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    /* ─── Toggle vista tarjetas / lista ─────────────────────────── */
    var vistaActual = localStorage.getItem('propietarios_vista') || 'tarjetas';

    function aplicarVista(vista) {
        if (vista === 'tarjetas') {
            $('#vista-tarjetas').show();
            $('#vista-lista').hide();
            $('#btn-vista-tarjetas').addClass('active-view btn-primary').removeClass('btn-outline-secondary');
            $('#btn-vista-lista').addClass('btn-outline-secondary').removeClass('active-view btn-primary');
        } else {
            $('#vista-tarjetas').hide();
            $('#vista-lista').show();
            $('#btn-vista-lista').addClass('active-view btn-primary').removeClass('btn-outline-secondary');
            $('#btn-vista-tarjetas').addClass('btn-outline-secondary').removeClass('active-view btn-primary');
        }
        vistaActual = vista;
        localStorage.setItem('propietarios_vista', vista);
    }

    aplicarVista(vistaActual);

    $('#btn-vista-tarjetas').on('click', function () { aplicarVista('tarjetas'); });
    $('#btn-vista-lista').on('click', function ()    { aplicarVista('lista'); });

    /* ─── Buscador (funciona en ambas vistas) ────────────────────── */
    $('#buscador_cnn').on('keyup', function () {
        var valor = $(this).val().toLowerCase();
        // Tarjetas
        $('.propietario-item').each(function () {
            var texto = $(this).data('nombre') + ' ' + $(this).data('rut');
            $(this).toggle(texto.includes(valor));
        });
        // Lista
        $('#tablaUa tr.propietario-fila').each(function () {
            var texto = $(this).text().toLowerCase();
            $(this).toggle(texto.includes(valor));
        });
    });

    /* ─── RUT formatters ─────────────────────────────────────────── */
    function formatRut(input) {
        let val = input.value.replace(/[^\dkK]/g, '');
        if (val.length > 1) {
            let body = val.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            let dv = val.slice(-1).toUpperCase();
            input.value = `${body}-${dv}`;
        } else { input.value = val; }
    }
    document.getElementById('rutInput').addEventListener('input', function () { formatRut(this); });
    document.getElementById('rutEditInput').addEventListener('input', function () { formatRut(this); });

    /* ─── Datos bancarios (agregar a lista) ─────────────────────── */
    var DatosAgregados = [];
    var listaDatos = $('#lista-Datos');

    $('#agregar-datosbanca').on('click', function (e) {
        e.preventDefault();
        var nombre_banco = $('#nombreBancoInput').val();
        var numero_cuenta = $('#numeroCuenteInput').val();
        var tipo_cuenta = $('#TipoCuentaInput').val();

        if (nombre_banco) {
            var dato = { id: DatosAgregados.length + 1, nombre_banco, numero_cuenta, tipo_cuenta };
            DatosAgregados.push(dato);
            $('#nombreBancoInput, #numeroCuenteInput').val('');
            $('#TipoCuentaInput').val('option');

            if ($('#tablaDatos').length === 0) {
                var tbl = $('<table>').attr('id','tablaDatos').addClass('table table-striped table-bordered');
                tbl.append($('<thead>').append($('<tr>').append($('<th>').text('Nombre Banco')).append($('<th>').text('N° Cuenta')).append($('<th>').text('Tipo'))));
                listaDatos.append(tbl);
            }
            var tbody = $('#tablaDatos tbody').length ? $('#tablaDatos tbody') : $('<tbody>').appendTo('#tablaDatos');
            tbody.append($('<tr>').append($('<td>').text(dato.nombre_banco)).append($('<td>').text(dato.numero_cuenta)).append($('<td>').text(dato.tipo_cuenta)));
        }
    });

    /* ─── Guardar nuevo propietario ─────────────────────────────── */
    $('#btn_agregar').on('click', function (e) {
        e.preventDefault();
        $('.error-message').remove();
        var nombre = $('#nombreInput').val().trim();
        var rut = $('#rutInput').val().trim();
        var telefono = $('#telefonoInput').val().trim();
        var correo = $('#correoInput').val().trim();
        var direccion = $('#direccionInput').val().trim();
        var ciudad = $('#ciudadInput').val().trim();
        var valid = true;

        function showError(sel, msg) {
            $(sel).after(`<small class="text-danger error-message">${msg}</small>`);
            valid = false;
        }
        if (!nombre) showError('#nombreInput', 'Campo obligatorio');
        if (!rut) showError('#rutInput', 'Campo obligatorio');
        if (!telefono) showError('#telefonoInput', 'Campo obligatorio');
        else if (telefono.length !== 9) showError('#telefonoInput', 'Debe tener 9 dígitos');
        if (!correo) showError('#correoInput', 'Campo obligatorio');
        if (!direccion) showError('#direccionInput', 'Campo obligatorio');
        if (!ciudad) showError('#ciudadInput', 'Campo obligatorio');
        if (!valid) return;

        var formData = new FormData();
        formData.append('nombre', nombre);
        formData.append('rut', rut);
        formData.append('telefono', telefono);
        formData.append('correo', correo);
        formData.append('direccion', direccion);
        formData.append('ciudad', ciudad);
        if (typeof DatosAgregados !== 'undefined') formData.append('DatosAgregados', JSON.stringify(DatosAgregados));

        $.ajax({
            url: '{{ url("/propietariosadd") }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function () {
                $('#agregarpropietario').modal('hide');
                $('#modalAlertaAgregar').modal('show');
                $('#texto_success').html('El Propietario se ha creado exitosamente.');
            },
            error: function (jqXHR) {
                if (jqXHR.status === 409 && jqXHR.responseJSON?.message) {
                    alert(jqXHR.responseJSON.message);
                }
            }
        });

        $('#btn-close').click(function () { $('#modalAlertaAgregar').modal('hide'); location.reload(); });
    });

    /* ─── Editar propietario ────────────────────────────────────── */
    $(document).on('click', '.editar-propietario-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var id = $(this).data('id');
        $.ajax({ type: 'GET', url: '/propietarios/' + id, dataType: 'json',
            success: function (data) {
                $('#editarPropietarioModal').modal('show');
                $('#btn_editar').data('id', id);
                $('#nombreEditInput').val(data.nombre);
                $('#rutEditInput').val(data.rut);
                $('#telefonoEditInput').val(data.telefono);
                $('#correoEditInput').val(data.correo);
                $('#direccionEditInput').val(data.direccion);
                $('#ciudadEditInput').val(data.ciudad);
            }
        });
    });

    $('#btn_editar').on('click', function (e) {
        e.preventDefault();
        var Id = $(this).data('id');
        $.ajax({
            url: '/propietarios/' + Id,
            type: 'POST',
            datatype: 'json',
            data: {
                nombre: $('#nombreEditInput').val(), rut: $('#rutEditInput').val(),
                telefono: $('#telefonoEditInput').val(), correo: $('#correoEditInput').val(),
                direccion: $('#direccionEditInput').val(), ciudad: $('#ciudadEditInput').val()
            }
        }).done(function () {
            $('#editarPropietarioModal').modal('hide');
            $('#modalAlertaAgregar').modal('show');
            $('#texto_success').html('El Propietario se ha Editado exitosamente.');
        });
        $('#btn-close').click(function () { $('#modalAlertaAgregar').modal('hide'); location.reload(); });
    });

    /* ─── Eliminar propietario ──────────────────────────────────── */
    $(document).on('click', '.borrar-propietario-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var id = $(this).data('id');
        $('#eliminar-idPropietario').val(id);
        $('#modalEliminarPropietario').modal('show');
    });

    $('#confirmDelete').click(function (e) {
        e.preventDefault();
        var id = $('#eliminar-idPropietario').val();
        $.ajax({
            url: '/propietarioestado/' + id,
            type: 'PATCH',
            data: { _token: '{{ csrf_token() }}', estado: 0 },
            success: function () {
                $('#modalEliminarPropietario').modal('hide');
                $('#modalAlertaAgregar').modal('show');
                $('#texto_success').text('El Propietario se ha Ocultado con éxito');
            }
        });
        $('#btn-close').click(function () { $('#modalAlertaAgregar').modal('hide'); location.reload(); });
        $('#btn_cerrar_error_eliminar').click(function () { $('#modalerroreliminar').modal('hide'); location.reload(); });
    });

    /* ─── Mostrar cuentas bancarias ─────────────────────────────── */
    $(document).on('click', '.mostra-cuentas-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var id_Cuenta = $(this).data('id');
        $('#idPropietarioInput').val(id_Cuenta);

        $.ajax({ url: '/Mostrar/cuenta/' + id_Cuenta, type: 'GET', dataType: 'json' })
        .done(function (respuesta) {
            var listaCuentasEdit = $('#lista-agregados-edit');
            if (respuesta.datosbancarios) {
                var tableContainer = $('<div>').addClass('table-responsive');
                var table = $('<table>').addClass('table table-striped table-bordered');
                var header = $('<thead>').append($('<tr>').append($('<th>').text('Nombre De Banco')).append($('<th>').text('Numero Cuenta')).append($('<th>').text('Tipo Cuenta')).append($('<th>').text('Acciones')));
                table.append(header);
                var body = $('<tbody>');
                respuesta.datosbancarios.forEach(function (d) {
                    body.append($('<tr>').append($('<td>').text(d.nombre_banco)).append($('<td>').text(d.numero_cuenta)).append($('<td>').text(d.tipo_cuenta)).append($('<td>').html('<a href="#" class="btn btn-warning btn-sm editar-cuenta" data-id="'+d.id+'"><i class="fas fa-edit"></i></a> <a href="#" class="btn btn-danger btn-sm eliminar-cuenta" data-id="'+d.id+'"><i class="fas fa-trash-alt"></i></a>')));
                });
                table.append(body);
                tableContainer.append(table);
                listaCuentasEdit.html(tableContainer);
            }
            $('#MostrarCuenta').modal('show');
        });
    });

    /* ─── Agregar nueva cuenta bancaria ─────────────────────────── */
    $('#agregar-datosbanca2').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{ url("/Nueva/cuenta2aad") }}',
            type: 'POST',
            data: {
                id_propietario: $('#idPropietarioInput').val(),
                nombre_banco: $('#nombreBancoInput2').val(),
                numero_cuenta: $('#numeroCuenteInput2').val(),
                tipo_cuenta: $('#TipoCuentaInput2').val()
            },
            dataType: 'json',
            success: function () {
                $('#modalAlertaAgregar').modal('show');
                $('#texto_success').html('La cuenta se ha Creado exitosamente');
                $('#MostrarCuenta').modal('hide');
            }
        });
        $('#btn-close').click(function () { $('#modalAlertaAgregar').modal('hide'); location.reload(); });
    });

    /* ─── Editar cuenta bancaria ─────────────────────────────────── */
    $(document).on('click', '.editar-cuenta', function (e) {
        e.preventDefault();
        var id_cuenta = $(this).data('id');
        $.ajax({ url: '/cuentas/editar_cuenta/' + id_cuenta, type: 'GET', dataType: 'json' })
        .done(function (r) {
            $('#editarCuentaModal').modal('show');
            $('#MostrarCuenta').modal('hide');
            $('#btn_editar_cuenta').data('id', id_cuenta);
            $('#nombreBancoInputEdit').val(r.cuenta_bancaria.nombre_banco);
            $('#numeroCuenteInputEdit').val(r.cuenta_bancaria.numero_cuenta);
            $('#TipoCuentaInputEdit').val(r.cuenta_bancaria.tipo_cuenta);
        });
    });

    $('#btn_editar_cuenta').on('click', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '/cuentaEditar/guardar/' + id,
            type: 'POST',
            dataType: 'json',
            data: {
                id, nombre_banco: $('#nombreBancoInputEdit').val(),
                numero_cuenta: $('#numeroCuenteInputEdit').val(),
                tipo_cuenta: $('#TipoCuentaInputEdit').val()
            }
        }).done(function () {
            $('#modalAlertaAgregar').modal('show');
            $('#texto_success').html('La cuenta se ha Editado exitosamente');
            $('#editarCuentaModal').modal('hide');
        });
        $('#btn-close').on('click', function () { $('#modalAlertaAgregar').modal('hide'); location.reload(); });
    });

    /* ─── Eliminar cuenta bancaria ───────────────────────────────── */
    $(document).on('click', '.eliminar-cuenta', function (e) {
        e.preventDefault();
        var id_cuenta = $(this).data('id');
        $('#deleteCuentaModal').modal('show');
        $('#btn_eliminar_cuenta').off('click').on('click', function () {
            $.ajax({ url: '/cuenta/eliminar/' + id_cuenta, type: 'DELETE', dataType: 'json' })
            .done(function () {
                $('#deleteCuentaModal').modal('hide');
                $('#modalAlertaAgregar').modal('show');
                $('#texto_success').html('La cuenta Bancaria se ha Eliminado exitosamente');
                $('#MostrarCuenta').modal('hide');
            });
            $('#btn-close').click(function () { $('#modalAlertaAgregar').modal('hide'); });
        });
    });

}); // end ready
</script>
@endsection