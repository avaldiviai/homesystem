@extends('layouts.app')
@section('content')
    <div class="container-fluid overflow-hidden" style="background-color: #FFAB40">
        <div class="row vh-100 overflow-auto" style="background-color:rgb(255, 255, 255)">
            @include('layouts.sidebar')
            <div class="col d-flex flex-column h-100" style="padding:0;">
                <div class="flex-grow-1">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6"
                                style="text-align: start; margin-top: 40px; margin-bottom: 20px; color: white">
                                <h1 class="text-uppercase text-black">Propietarios</h1>
                            </div>
                        </div>
                    </div>

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
                                <button type="button" class="btn btn-success shadow" data-bs-toggle="modal"
                                    data-bs-target="#agregarpropietario">
                                    <i class="fas fa-plus me-1"></i> AGREGAR PROPIETARIO
                                </button>
                            </div>
                        </div>

                        {{-- VISTA LISTA --}}
                        <div class="pb-4">
                            <div class="overflow-auto shadow-lg" style="max-height: 65vh;">
                                <table class="table table-striped-columns align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width: 60px;">#</th>
                                            <th>Nombre del Propietario</th>
                                            <th style="width: 120px; text-align:center;">Teléfono</th>
                                            <th style="width: 120px; text-align:center;">Correo</th>
                                            <th style="width: 120px; text-align:center;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaUa">
                                        @foreach ($propietarios->sortBy('nombre') as $propietario)
                                            <tr class="propietario-fila"
                                                data-nombre="{{ strtolower($propietario->nombre) }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="cursor: pointer;"
                                                    onclick="window.location='{{ route('propietario.detalles', $propietario->id) }}'">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="prop-avatar-sm">
                                                            {{ strtoupper(substr($propietario->nombre, 0, 1)) }}
                                                        </div>
                                                        <span class="fw-600">{{ $propietario->nombre }}</span>
                                                    </div>
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $propietario->telefono }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $propietario->correo }}
                                                </td>
                                                <td style="text-align:center;">
                                                    <button class="btn btn-sm btn-outline-primary btn-editar"
                                                        data-id="{{ $propietario->id }}" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger btn-eliminar ms-1"
                                                        data-id="{{ $propietario->id }}"
                                                        data-nombre="{{ $propietario->nombre }}" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>

    {{-- ====================== MODAL AGREGAR PROPIETARIO ====================== --}}
    <div class="modal fade" id="agregarpropietario" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="agregarpropietarioLabel" aria-hidden="true">
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
                                    <input type="text" class="form-control mt-2" id="nombreInput"
                                        placeholder="Ej: Pedro Aguilera" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="rutInput"><b>Rut</b></label>
                                    <input type="text" class="form-control mt-2" id="rutInput"
                                        placeholder="12.345.678-9" pattern="\d{1,2}\.\d{3}\.\d{3}-[\dkK]"
                                        title="Formato válido: 12.345.678-9" minlength="9" maxlength="12">
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="telefonoInput"><b>Teléfono</b></label>
                                    <input type="text" class="form-control mt-2" id="telefonoInput"
                                        placeholder="Ej: 912345678" maxlength="9" minlength="9" required pattern="\d{9}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="correoInput"><b>Correo</b></label>
                                    <input type="text" class="form-control mt-2" id="correoInput"
                                        placeholder="Ej: pedro@gmail.com" required>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-6">
                                        <label for="direccionInput"><b>Dirección</b></label>
                                        <input type="text" class="form-control mt-2" id="direccionInput"
                                            placeholder="Dirección" required>
                                    </div>
                                    <div class="form-group mb-3 col-6">
                                        <label for="ciudadInput"><b>Ciudad</b></label>
                                        <input type="text" class="form-control mt-2" id="ciudadInput"
                                            placeholder="Ciudad" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-success w-100 mt-3 mb-3 text-uppercase text-white"
                                        type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse"
                                        aria-expanded="false">
                                        <b>Agregar Datos Bancarios</b>
                                    </button>
                                </div>
                                <div class="collapse multi-collapse" id="multiCollapseExample2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nombreBancoInput"><b>Nombre del Banco</b></label>
                                            <div class="form-group mb-2">
                                                <input type="text" class="form-control m-1" id="nombreBancoInput"
                                                    placeholder="Nombre del Banco" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="numeroCuenteInput"><b>Numero de Cuenta</b></label>
                                            <div class="form-group mb-2">
                                                <input type="text" class="form-control m-1" id="numeroCuenteInput"
                                                    placeholder="numero de cuenta" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="TipoCuentaInput"><b>Tipo de Cuenta</b></label>
                                            <div class="form-group mb-2 d-flex">
                                                <select name="notificaion" id="TipoCuentaInput" class="form-select m-1">
                                                    <option selected disabled value="option">Seleccione un tipo de Cuenta
                                                    </option>
                                                    <option value="Ahorro">Ahorro</option>
                                                    <option value="Corriente">Corriente</option>
                                                    <option value="Vista">Vista</option>
                                                    <option value="Chequera electrónica">Chequera Electrónica</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-end">
                                            <button class="btn btn-success m-1 text-uppercase text-white"
                                                id="agregar-datosbanca"><b>Agregar Cuenta</b></button>
                                        </div>
                                    </div>
                                </div>
                                <ul class="text-uppercase mt-4" id="lista-Datos"></ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="btn_agregar" class="btn btn-primary">Guardar</button>
                                <button type="button" id="btn_cerrar_agregar" class="btn btn-danger"
                                    data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ====================== MODAL EDITAR PROPIETARIO ====================== --}}
    <div class="modal fade" id="editarPropietario" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="editarPropietarioLabel" aria-hidden="true">

        <div class="modal-dialog modal-xl">
            <div class="modal-content shadow">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editarPropietarioLabel">
                        <i class="fas fa-user-edit me-2"></i>
                        Editar Propietario
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="editId">

                    <!-- DATOS PERSONALES -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>Información Personal</strong>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        <b>Nombre</b>
                                    </label>

                                    <input type="text" class="form-control" id="editNombre"
                                        placeholder="Ej: Pedro Aguilera">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <b>Rut</b>
                                    </label>

                                    <input type="text" class="form-control" id="editRut"
                                        placeholder="12.345.678-9">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <b>Teléfono</b>
                                    </label>

                                    <input type="text" class="form-control" id="editTelefono" maxlength="9"
                                        placeholder="912345678"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,9)">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        <b>Correo</b>
                                    </label>

                                    <input type="email" class="form-control" id="editCorreo"
                                        placeholder="correo@gmail.com">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <b>Dirección</b>
                                    </label>

                                    <input type="text" class="form-control" id="editDireccion">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <b>Ciudad</b>
                                    </label>

                                    <input type="text" class="form-control" id="editCiudad">
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- CUENTAS BANCARIAS -->
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">

                            <strong>
                                <i class="fas fa-university me-2"></i>
                                Cuentas Bancarias
                            </strong>

                            <button type="button" class="btn btn-success btn-sm" id="btnAgregarCuenta">

                                <i class="fas fa-plus"></i>
                                Agregar Cuenta
                            </button>

                        </div>

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-bordered align-middle">

                                    <thead class="table-light">

                                        <tr>
                                            <th>Banco</th>
                                            <th>Tipo Cuenta</th>
                                            <th>N° Cuenta</th>
                                            <th width="80">Acción</th>
                                        </tr>

                                    </thead>

                                    <tbody id="cuentasBody">
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" id="btn_guardar_editar" class="btn btn-primary">

                        <i class="fas fa-save me-1"></i>
                        Guardar Cambios
                    </button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        Cerrar
                    </button>

                </div>

            </div>
        </div>
    </div>

    {{-- ====================== MODAL CONFIRMAR ELIMINACIÓN ====================== --}}
    <div class="modal fade" id="modalEliminar" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Eliminar Propietario</h5>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar a <strong id="nombreEliminar"></strong>?</p>
                    <p class="text-muted small">Esta acción no se puede deshacer.</p>
                    <input type="hidden" id="idEliminar">
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn_confirmar_eliminar" class="btn btn-danger">Sí, eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ====================== MODAL ÉXITO ====================== --}}
    <div class="modal fade" id="modalAlertaAgregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background:rgba(0,0,0,0.0);border:none;width:700px;">
                <div class="modal-header alert alert-success" role="alert" style="border:none;">
                    <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000"
                                    style="width:70px;height:70px"></lord-icon>
                            </div>
                            <div class="col-8 d-flex justify-content-center align-items-center">
                                <p id="texto_success" class="text-uppercase"></p>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn-close d-flex justify-content-end"
                                    id="btn-close"></button>
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
        .fw-600 {
            font-weight: 600 !important;
        }

        /* Avatar pequeño para la lista */
        .prop-avatar-sm {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(13, 110, 253, .2);
        }

        /* Hover en filas */
        #tablaUa tr.propietario-fila:hover td {
            background-color: #f0f4ff;
        }

        #tablaUa tr.propietario-fila td {
            transition: background-color .15s ease;
        }
    </style>
@endsection

@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Agregar fila de cuenta bancaria en el modal de edicións
            $('#btnAgregarCuenta').on('click', function() {
                agregarFilaCuenta();
            });

            /* ─── Buscador ─────────────────────────────────────────────────── */
            $('#buscador_cnn').on('keyup', function() {
                var valor = $(this).val().toLowerCase();
                var contador = 0;
                $('#tablaUa tr.propietario-fila').each(function() {
                    var nombre = $(this).data('nombre') || '';
                    var visible = nombre.includes(valor);
                    $(this).toggle(visible);
                    if (visible) {
                        contador++;
                        $(this).find('td:first').text(contador);
                    }
                });
            });

            /* ─── RUT formatter ─────────────────────────────────────────────── */
            function formatRut(input) {
                let val = input.value.replace(/[^\dkK]/g, '');
                if (val.length > 1) {
                    let body = val.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    let dv = val.slice(-1).toUpperCase();
                    input.value = `${body}-${dv}`;
                } else {
                    input.value = val;
                }
            }
            document.getElementById('rutInput').addEventListener('input', function() {
                formatRut(this);
            });
            document.getElementById('editRut').addEventListener('input', function() {
                formatRut(this);
            });

            /* ─── Datos bancarios ────────────────────────────────────────────── */
            var DatosAgregados = [];
            var listaDatos = $('#lista-Datos');

            $('#agregar-datosbanca').on('click', function(e) {
                e.preventDefault();
                var nombre_banco = $('#nombreBancoInput').val();
                var numero_cuenta = $('#numeroCuenteInput').val();
                var tipo_cuenta = $('#TipoCuentaInput').val();

                if (nombre_banco) {
                    var dato = {
                        id: DatosAgregados.length + 1,
                        nombre_banco,
                        numero_cuenta,
                        tipo_cuenta
                    };
                    DatosAgregados.push(dato);
                    $('#nombreBancoInput, #numeroCuenteInput').val('');
                    $('#TipoCuentaInput').val('option');

                    if ($('#tablaDatos').length === 0) {
                        var tbl = $('<table>').attr('id', 'tablaDatos').addClass(
                            'table table-striped table-bordered');
                        tbl.append($('<thead>').append($('<tr>').append($('<th>').text('Nombre Banco'))
                            .append($('<th>').text('N° Cuenta')).append($('<th>').text('Tipo'))));
                        listaDatos.append(tbl);
                    }
                    var tbody = $('#tablaDatos tbody').length ? $('#tablaDatos tbody') : $('<tbody>')
                        .appendTo('#tablaDatos');
                    tbody.append($('<tr>').append($('<td>').text(dato.nombre_banco)).append($('<td>').text(
                        dato.numero_cuenta)).append($('<td>').text(dato.tipo_cuenta)));
                }
            });

            /* ─── Guardar nuevo propietario ──────────────────────────────────── */
            $('#btn_agregar').on('click', function(e) {
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
                if (typeof DatosAgregados !== 'undefined') formData.append('DatosAgregados', JSON.stringify(
                    DatosAgregados));

                $.ajax({
                    url: '{{ url('/propietariosadd') }}',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        var nuevoId = res.id ?? '';

                        var nuevaFila = `
                    <tr class="propietario-fila"
                        data-nombre="${nombre.toLowerCase()}">
                        <td></td>
                        <td style="cursor: pointer;"
                            onclick="window.location='/propietario/${nuevoId}/detalles'">
                            <div class="d-flex align-items-center gap-3">
                                <div class="prop-avatar-sm">${nombre.charAt(0).toUpperCase()}</div>
                                <span class="fw-600">${nombre}</span>
                            </div>
                        </td>
                        <td style="text-align:center;">
                            <button class="btn btn-sm btn-outline-primary btn-editar"
                                data-id="${nuevoId}" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger btn-eliminar ms-1"
                                data-id="${nuevoId}" data-nombre="${nombre}" title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>`;

                        var insertado = false;
                        $('#tablaUa tr.propietario-fila').each(function() {
                            if ($(this).data('nombre') > nombre.toLowerCase()) {
                                $(this).before(nuevaFila);
                                insertado = true;
                                return false;
                            }
                        });
                        if (!insertado) $('#tablaUa').append(nuevaFila);

                        renumerar();

                        // Limpiar formulario
                        $('#nombreInput, #rutInput, #telefonoInput, #correoInput, #direccionInput, #ciudadInput')
                            .val('');
                        DatosAgregados = [];
                        $('#lista-Datos').empty();

                        $('#agregarpropietario').modal('hide');
                        $('#texto_success').html('El Propietario se ha creado exitosamente.');
                        swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'El propietario se ha creado correctamente.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(jqXHR) {
                        if (jqXHR.status === 409 && jqXHR.responseJSON?.message) {
                            swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: jqXHR.responseJSON.message,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    }
                });
            });

            $('#btn-close').off('click').on('click', function() {
                $('#modalAlertaAgregar').modal('hide');
            });

            /* ─── Abrir modal Editar ─────────────────────────────────────────────── */
            $(document).on('click', '.btn-editar', function(e) {
                e.stopPropagation();
                var id = $(this).data('id');

                $.ajax({
                    url: '/propietarios/' + id,
                    type: 'GET',
                    success: function(data) {

                        $('#editId').val(data.id);
                        $('#editNombre').val(data.nombre);
                        $('#editRut').val(data.rut);
                        $('#editTelefono').val(data.telefono);
                        $('#editCorreo').val(data.correo);
                        $('#editDireccion').val(data.direccion);
                        $('#editCiudad').val(data.ciudad);

                        $('#cuentasBody').html('');

                        if (data.datos_bancarios && data.datos_bancarios.length > 0) {

                            data.datos_bancarios.forEach(function(cuenta) {

                                agregarFilaCuenta({
                                    id: cuenta.id,
                                    banco: cuenta.nombre_banco,
                                    tipo_cuenta: cuenta.tipo_cuenta,
                                    numero_cuenta: cuenta.numero_cuenta,
                                })

                            });

                        } else {

                            agregarFilaCuenta();
                        }

                        $('#editarPropietario').modal('show');
                    },
                    error: function() {
                        swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudieron cargar los datos del propietario.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
            });

            function agregarFilaCuenta(cuenta = {}) {

                let fila = `
                    <tr>

                        <input type="hidden"
                            class="cuenta_id"
                            value="${cuenta.id ?? ''}">

                        <td>
                            <input type="text"
                                class="form-control banco"
                                value="${cuenta.banco ?? ''}">
                        </td>

                        <td>
                            <select class="form-select tipo_cuenta">
                                <option value="Corriente"
                                    ${cuenta.tipo_cuenta == 'Corriente' ? 'selected' : ''}>
                                    Corriente
                                </option>
                                <option value="Vista"
                                    ${cuenta.tipo_cuenta == 'Vista' ? 'selected' : ''}>
                                    Vista
                                </option>
                                <option value="Ahorro"
                                    ${cuenta.tipo_cuenta == 'Ahorro' ? 'selected' : ''}>
                                    Ahorro
                                </option>
                                <option value="Chequera electrónica"
                                    ${cuenta.tipo_cuenta == 'Chequera electrónica' ? 'selected' : ''}>
                                    Chequera Electrónica
                                </option>
                            </select>
                        </td>

                        <td>
                            <input type="text"
                                class="form-control numero_cuenta"
                                value="${cuenta.numero_cuenta ?? ''}">
                        </td>

                        <td>
                            <button type="button"
                                class="btn btn-danger btn-sm eliminarCuenta">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>

                    </tr>
                `;

                $('#cuentasBody').append(fila);
            }

            let cuentasEliminadas = [];

            $(document).on('click', '.eliminarCuenta', function() {

                let fila = $(this).closest('tr');
                let idCuenta = fila.find('.cuenta_id').val();

                Swal.fire({
                    title: '¿Eliminar cuenta?',
                    text: 'La cuenta bancaria será eliminada.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {

                    if (!result.isConfirmed) {
                        return;
                    }

                    // Si no existe en BD, solo quitar de la vista
                    if (!idCuenta) {
                        fila.remove();
                        return;
                    }

                    // Existe en BD, eliminar registro
                    $.ajax({
                        url: '/datos-bancarios/' + idCuenta,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function() {

                            fila.remove();

                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                text: 'La cuenta bancaria fue eliminada.',
                                timer: 1500,
                                showConfirmButton: false
                            });

                        },
                        error: function() {

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo eliminar la cuenta bancaria.'
                            });

                        }
                    });

                });

            });

            /* ─── Guardar edición ────────────────────────────────────────────────── */

            let cuentasNuevas = [];

            $('#cuentasBody tr').each(function() {

                let idCuenta = $(this).find('.cuenta_id').val();

                if (!idCuenta) {

                    cuentasNuevas.push({
                        nombre_banco: $(this).find('.banco').val(),
                        tipo_cuenta: $(this).find('.tipo_cuenta').val(),
                        numero_cuenta: $(this).find('.numero_cuenta').val()
                    });

                }

            });

            $('#btn_guardar_editar').on('click', function() {

                var id = $('#editId').val();

                let cuentasNuevas = [];

                $('#cuentasBody tr').each(function() {

                    let idCuenta = $(this).find('.cuenta_id').val();

                    if (!idCuenta) {

                        cuentasNuevas.push({
                            nombre_banco: $(this).find('.banco').val(),
                            tipo_cuenta: $(this).find('.tipo_cuenta').val(),
                            numero_cuenta: $(this).find('.numero_cuenta').val()
                        });

                    }

                });

                $.ajax({
                    url: '/propietarios/' + id,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),

                        nombre: $('#editNombre').val().trim(),
                        rut: $('#editRut').val().trim(),
                        telefono: $('#editTelefono').val().trim(),
                        correo: $('#editCorreo').val().trim(),
                        direccion: $('#editDireccion').val().trim(),
                        ciudad: $('#editCiudad').val().trim(),

                        cuentas_nuevas: cuentasNuevas
                    },
                    success: function(data) {

                        var nuevoNombre = data.nombre;

                        var fila = $('#tablaUa .btn-editar[data-id="' + id + '"]')
                            .closest('tr');

                        fila.find('.fw-600').text(nuevoNombre);
                        fila.find('.prop-avatar-sm').text(
                            nuevoNombre.charAt(0).toUpperCase()
                        );

                        fila.data('nombre', nuevoNombre.toLowerCase());
                        fila.find('.btn-eliminar').data('nombre', nuevoNombre);
                        swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Los cambios se han guardado correctamente.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudieron guardar los cambios.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });

            });

            /* ─── Abrir modal Eliminar ───────────────────────────────────────────── */
            $(document).on('click', '.btn-eliminar', function(e) {
                e.stopPropagation();
                $('#idEliminar').val($(this).data('id'));
                $('#nombreEliminar').text($(this).data('nombre'));
                $('#modalEliminar').modal('show');
            });

            /* ─── Confirmar eliminación ──────────────────────────────────────────── */
            $('#btn_confirmar_eliminar').on('click', function() {
                var id = $('#idEliminar').val();

                $.ajax({
                    url: '/propietarioestado/' + id,
                    type: 'POST',
                    data: {
                        _method: 'PATCH',
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function() {
                        $('#tablaUa .btn-eliminar[data-id="' + id + '"]').closest('tr')
                            .remove();
                        renumerar();

                        $('#modalEliminar').modal('hide');
                        $('#texto_success').html(
                            'El propietario ha sido eliminado correctamente.');
                        $('#modalAlertaAgregar').modal('show');
                    },
                    error: function() {
                        alert('Error al eliminar el propietario.');
                    }
                });
            });

            /* ─── Renumerar filas visibles ───────────────────────────────────── */
            function renumerar() {
                var i = 1;
                $('#tablaUa tr.propietario-fila:visible').each(function() {
                    $(this).find('td:first').text(i++);
                });
            }
        });
    </script>
@endsection
