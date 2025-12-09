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
                            <div class="col-6"
                                style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px;color:black">
                                <h1 class="text-uppercase">Sueldos de Usuarios</h1>
                            </div>
                        </div>
                    </div>
                    {{-- Tabla de pagos --}}
                    <div class="container-fluid">
                        <div class="row justify-content-between align-items-center">
                            <div class="input-group mx-2" style="max-width: 400px;">
                                <span class="input-group-text bg-primary text-white shadow-sm">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="text" id="buscador_cnn" placeholder="Buscar" class="form-control">
                            </div>
                            <div class="col-md-3 mb-4 text-end">
                                <button type="button" class="btn btn-success rounded-pill mt-2" data-bs-toggle="modal"
                                    data-bs-target="#agregarUsuario" style=>
                                    <span>Agregar Sueldo a Usuario</span>
                                </button>
                            </div>
                        </div>
                        @php
                            $sueldosAgrupados = $sueldos->groupBy('id_user');
                        @endphp

                        <div class="table-container tabla-scroll shadow-lg" style="max-height: 65vh; overflow-y: auto;">
                            <table class="table table-striped-columns">
                                <thead>
                                    <tr>
                                        <th>#</th> 
                                        <th>Nombre del Usuario</th>
                                        <th>Detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sueldosAgrupados as $id_user => $listaSueldos)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $listaSueldos->first()->user->name }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-secondary rounded-pill" data-bs-toggle="collapse" data-bs-target="#sueldosUsuario{{ $id_user }}">
                                                    Ver sueldos
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="collapse" id="sueldosUsuario{{ $id_user }}">
                                            <td colspan="3">
                                                <!-- Filtro por mes -->
                                                <div class="mb-3">
                                                    <label for="filtroMes{{ $id_user }}" class="form-label fw-semibold text-primary">
                                                        Filtrar por mes
                                                    </label>
                                                    <select 
                                                        class="form-select form-select-sm filtro-mes" 
                                                        id="filtroMes{{ $id_user }}" 
                                                        data-target="#tablaSueldos{{ $id_user }}"
                                                        aria-label="Seleccione el mes para filtrar"
                                                    >
                                                        <option value="todos">Todos los meses</option>
                                                        @php
                                                            $mesesUnicos = $listaSueldos->pluck('fecha')->map(function ($fecha) {
                                                                return \Carbon\Carbon::parse($fecha)->format('Y-m');
                                                            })->unique();
                                                        @endphp
                                                        @foreach ($mesesUnicos as $mes)
                                                            <option class="text-uppercase" value="{{ $mes }}">
                                                                {{ \Carbon\Carbon::parse($mes)->locale('es')->translatedFormat('F Y') }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Tabla de sueldos -->
                                                <table class="table table-sm table-bordered mb-0" id="tablaSueldos{{ $id_user }}">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Sueldos</th>
                                                            <th>Fecha</th>
                                                            <th>Documentos</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($listaSueldos as $sueldo)
                                                            <tr data-mes="{{ \Carbon\Carbon::parse($sueldo->fecha)->format('Y-m') }}">
                                                                <td>$ {{ $sueldo->sueldos }}</td>
                                                                <td>{{ $sueldo->fecha }}</td>
                                                                <td>
                                                                    @if ($sueldo->documentos)
                                                                        <a href="{{ asset('storage/' . $sueldo->documentos) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill">
                                                                            <i class="fas fa-eye"></i> Ver
                                                                        </a>
                                                                        <a href="{{ asset('storage/' . $sueldo->documentos) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill" download>
                                                                            <i class="fa-solid fa-cloud-arrow-down"></i> Descargar
                                                                        </a>
                                                                    @else
                                                                        <span class="text-muted">Sin archivo</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="btn btn-primary btn-sm editar-user rounded-circle" data-id="{{ $sueldo->id }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <a href="#" class="btn btn-danger btn-sm borrar-user rounded-circle" data-id="{{ $sueldo->id }}">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
    {{-- SECCION DE MODALES --}}

    <!-- Modal agregar nuevo usuario-->
    <div class="modal fade" id="agregarUsuario" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="agregarUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modal-xl">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarUsuarioLabel">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <form>
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="usuarioSelect"><b><i class="fas fa-user"></i> Usuario</b></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                            <select class="form-select" id="usuarioSelect" name="usuario_id" required>
                                                <option disabled selected value="">Seleccione un Usuario</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="sueldoUsuarioInput"><b><i class="fas fa-dollar-sign"></i> Sueldo del Usuario</b></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                            <input type="text" class="form-control format-number" id="sueldoUsuarioInput" name="sueldo"
                                                placeholder="Ingrese el sueldo mensual" min="0" step="1000" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="fechaInput"><b><i class="fas fa-calendar-alt"></i> Fecha</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="date" id="fechaInput" class="form-control" placeholder="Selecciona una fecha" value="<?= date('Y-m-d') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="archivoUsuarioInput"><b><i class="fas fa-paperclip"></i> Adjuntar Archivo</b></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                            <input type="file" class="form-control" id="archivoUsuarioInput" name="archivo" accept=".pdf,.jpg,.png,.jpeg" required>
                                        </div>
                                        <small class="form-text text-muted">Formatos permitidos: PDF, JPG, PNG</small>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <!-- Botones de cambios -->
                    <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-1 rounded-pill" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="btn_agregar_user" class="btn btn-primary m-1 rounded-pill">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal editar usuario-->
    <div class="modal fade" id="agregarUsuarioEdit" tabindex="-1" data-bs-backdrop="static" 
        aria-labelledby="agregarUsuarioEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Encabezado del Modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarUsuarioEditLabel">Editar Sueldo de Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Cuerpo del Modal -->
                <div class="modal-body">
                    <form>
                        <div class="container">
                            <!-- Nombre del Usuario -->
                            <div class="row">
                                {{-- Selector de Usuario --}}
                                <!-- <div class="form-group col-lg-4 mb-3">
                                    <label for="cargoUsuarioEditInput"><b>Usuario</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <select class="form-select" id="cargoUsuarioEditInput" required>
                                            <option disabled selected value="">Seleccione un Usuario</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->

                                {{-- Sueldo del Usuario --}}
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="sueldoUsuarioEditInput"><b>Sueldo</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        <input type="text" min="0" class="form-control format-number" id="sueldoUsuarioEditInput"
                                            placeholder="Ej: 850000" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="fechaInputedit"><b><i class="fas fa-calendar-alt"></i> Fecha</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="date" id="fechaInputedit" class="form-control" placeholder="Selecciona una fecha">
                                        </div>
                                    </div>
                                </div>

                                {{-- Subir Documento --}}
                                <div class="form-group col-lg-12 mb-3">
                                    <label for="archivoUsuarioEditInput"><b>Subir Documento</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-file-upload"></i></span>
                                        <input type="file" class="form-control" id="archivoUsuarioEditInput"
                                            accept=".pdf,.jpg,.jpeg,.png">
                                    </div>
                                    <small class="form-text text-muted">Formatos permitidos: PDF, JPG, PNG</small>
                                </div>
                                <div class="mt-3 col-lg-12" id="listaDocumentos">
                                    <label><b>Documentos Adjuntos</b></label>
                                    <ul class="list-group" id="documentosUsuarioLista"></ul>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
                <div class=" card-footer col text-end">
                    <button type="button" id="btn_cerrar_agregar" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="btn_edit_user" class="btn btn-primary rounded-pill">Guardar</button>
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
        <div class="modal-dialog modal-dialog-centered"> <!-- Centrado en la pantalla -->
            <div class="modal-content">
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
                    <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar Usuario?</h2>
                        <div class="modalfooter d-flex justify-content-center">
                            <button type="button" class="btn btn-danger rounded-pill m-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="confirmDevare" class="btn btn-secondary rounded-pill m-2">Eliminar</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
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

            $('.filtro-mes').on('change', function () {
                var mesSeleccionado = $(this).val();
                var tablaTarget = $(this).data('target');

                $(tablaTarget + ' tbody tr').each(function () {
                    var mesFila = $(this).data('mes');
                    if (mesSeleccionado === 'todos' || mesFila === mesSeleccionado) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            ////////////////////////////BUSCADOR/////////////////////////
            $("#buscador_cnn").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tablaUa tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            function formatNumber(value) {
                value = value.replace(/\./g, ''); // quitar puntos existentes
                value = value.replace(/\D/g, ''); // quitar no numéricos
                return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
            $(document).ready(function () {
                $('.format-number').on('input', function () {
                    const formatted = formatNumber($(this).val());
                    $(this).val(formatted);
                });

                // Opcional: quitar los puntos antes de enviar el formulario
                /*
                $('form').on('submit', function () {
                    $('.format-number').each(function () {
                        $(this).val($(this).val().replace(/\./g, ''));
                    });
                });
                */
            });


            $("#btn_agregar_user").on('click', function(event) {
                event.preventDefault();

                var id_user = $("#usuarioSelect").val();
                var sueldo = $("#sueldoUsuarioInput").val();
                var archivo = $("#archivoUsuarioInput")[0].files[0];
                var fecha = $("#fechaInput").val();

                if (!id_user || !sueldo || !archivo || !fecha) {
                    alert("Todos los campos son obligatorios.");
                    return;
                }

                var formData = new FormData();
                formData.append('id_user', id_user);
                formData.append('sueldo', sueldo);
                formData.append('archivo', archivo);
                formData.append('fecha', fecha);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ url("/usuarios/asignar_sueldo") }}',
                    type: 'POST',
                    data: formData,
                    contentType: false, // Importante para enviar archivos
                    processData: false,
                    success: function(respuesta) {
                        console.log("Respuesta:", respuesta);
                        $("#agregarUsuario").modal('hide');
                        $("#successModal").modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#agregarUsuario").modal('hide');
                        $('#modalerror').modal('show');
                    }
                });
            });



            // boton trae datos del usuario para editar
            $(".editar-user").on('click', function(event) {
                event.preventDefault();
                id = $(this).data('id');
                console.log('Editar sueldo id ' + id);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/sueldo_editar/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarUsuarioEdit").modal('show');
                        $('#btn_edit_user').data('id', id);
                        $("#sueldoUsuarioEditInput").val(respuesta.sueldos.sueldos);
                        // $("#cargoUsuarioEditInput").val(respuesta.sueldos.id_user);
                        $("#fechaInputedit").val(respuesta.sueldos.fecha);
                        // Supongamos que esto es lo que llega en la respuesta:
                        let documentos = respuesta.sueldos.documentos; // puede ser string o array

                        // Limpia la lista anterior
                        $("#documentosUsuarioLista").empty();

                        // Si es string separado por comas, conviértelo en array
                        if (typeof documentos === 'string') {
                            documentos = documentos.split(',');
                        }

                        // Recorre los archivos y agrégalos a la lista
                        documentos.forEach(function(archivo) {
                            let nombreArchivo = archivo.split('/').pop(); // solo el nombre del archivo
                            let item = `
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-file-alt me-2 text-primary"></i>${nombreArchivo}</span>
                                    <a href="/storage/${archivo}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill">
                                        Ver
                                    </a>
                                </li>
                            `;
                            $("#documentosUsuarioLista").append(item);
                        });

                    }
                });
            }); //fin datos del usuario

            // Botón guardar edición de usuario
            $("#btn_edit_user").on('click', function(event) {
                event.preventDefault();

                var id = $(this).data('id');
                var sueldo = $("#sueldoUsuarioEditInput").val();
                // var cargo = $("#cargoUsuarioEditInput").val();
                var archivo = $("#archivoUsuarioEditInput")[0].files[0];
                var fecha = $("#fechaInputedit").val();

                // Crear objeto FormData
                var formData = new FormData();
                // formData.append('id_user', cargo); // o id_usuario, según tu backend
                formData.append('sueldo', sueldo);
                formData.append('fecha', fecha);
                formData.append('id', id); // si lo necesitas en el controlador
                if (archivo) {
                    formData.append('documento', archivo); // nombre esperado en el backend
                }

                // CSRF token para Laravel
                formData.append('_token', '{{ csrf_token() }}');

                // Enviar AJAX
                $.ajax({
                    url: '{{ url('/sueldos/add_editar_sueldos') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarUsuarioEdit").modal('hide');
                        $("#successModal").modal('show');
                        $('#texto_success').text('Sueldo editado correctamente');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#agregarUsuarioEdit").modal('hide');
                        $('#modalerror').modal('show');
                    }
                });
            });


            //boton eliminar usuario
            $(".borrar-user").on('click', function(event) {
                event.preventDefault();
                var idUsuario = $(this).data('id');
                console.log('Usuario: ' + idUsuario);

                $("#modalinfo").modal('show');
                $("#confirmDevare").click(function() {
                    $("#modalinfo").modal('hide');
                    // Realizar la solicitud AJAX
                    $.ajax({
                        url: '/usuarios/eliminar/' + idUsuario,
                        type: 'DEvarE',
                        datatype: 'json',
                        success: function(respuesta) {
                            console.log("respuesta", respuesta);
                            $("#modalinfo").modal('hide');
                            $("#successModal").modal('show');
                            $('#texto_success').text(
                                'Usuario Eliminado Correctamente');
                            // window.location.href = '/comision';

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("Error:", errorThrown);
                            $("#modalinfo").modal('hide');
                            $('#modalerror').modal('show');
                        }
                    });
                });
            }); // fin eliminar usuario

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
    </script>
@endsection
