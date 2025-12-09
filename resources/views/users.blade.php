@extends('layouts.app')
@section('content')
    <div class="container-fluid overflow-hidden" style="background-color:rgb(255, 255, 255)">
        <div class="row vh-100 overflow-auto" style="background-color:rgb(255, 255, 255)">
            @include('layouts.sidebar')
            <div class="col d-flex flex-column h-100" style="padding:0;">
                <div class="flex-grow-1">
                    {{-- Contenido --}}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6 text-uppercase"
                                style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px;color:black">
                                <h1>Usuarios</h1>
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
                                <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal"
                                    data-bs-target="#agregarUsuario" style=>
                                    <span>Agregar Usuario</span>
                                </button>
                            </div>
                        </div>
                        <div class="overflow-auto shadow-lg" style="max-height: 65vh;">
                            <table class="table table-striped-columns">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaUa">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm editar-user"
                                                    data-id="{{ $user->id }}"><i class="fas fa-edit"></i> </a>
                                                <a href="#" class="btn btn-danger btn-sm borrar-user"
                                                    data-id="{{ $user->id }}"><i class="fas fa-trash-alt"></i></a>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarUsuarioLabel">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <form>
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="nombreUsuarioInput"><b>Nombre Usuario</b></label>
                                    <input type="text" class="form-control mt-2" id="nombreUsuarioInput"
                                        placeholder="Ej: Pedro Aguilera" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="cargoUsuarioInput"><b>Cargo Usuario</b></label>
                                    <select class="form-select mt-2" id="cargoUsuarioInput">
                                        <option disabled selected value="">Seleccione un Cargo</option>
                                        @foreach ($cargos as $cargo)
                                            <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                                        @endforeach
                                        {{-- <option value="otros">Otros</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="correoUsuarioInput"><b>Correo Usuario</b></label>
                                    <input type="text" class="form-control mt-2" id="correoUsuarioInput"
                                        placeholder="Ej: example@gmail.com" required>
                                </div>

                                <div class="form-group mb-3 col-6">
                                    <label for="contraseñaUsuarioInput"><b>Rut Usuario</b></label>
                                    <input type="text" class="form-control mt-2" id="contraseñaUsuarioInput"
                                        placeholder="Ej: aaa1@12a" maxlength="10" required>
                                    <small class="form-text text-muted mt-1">
                                        *Recuerda: Esta será la contraseña, se recomienda cambiarla.
                                    </small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!-- Botones de cambios -->
                                <button type="button" id="btn_agregar_user" class="btn btn-primary m-2">Guardar</button>
                                <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-2" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                    </form>
                </div>
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
                <h5 class="modal-title" id="agregarUsuarioEditLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Cuerpo del Modal -->
            <div class="modal-body">
                <form>
                    <div class="container">
                        <!-- Nombre del Usuario -->
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="nombreUsuarioEditInput"><b>Nombre Usuario</b></label>
                                <input type="text" class="form-control mt-2" id="nombreUsuarioEditInput"
                                    placeholder="Ej: Pedro Aguilera" required>
                            </div>
                        </div>
                        <!-- Cargo del Usuario -->
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="cargoUsuarioEditInput"><b>Cargo Usuario</b></label>
                                <select class="form-select mt-2" id="cargoUsuarioEditInput">
                                    <option disabled selected value="">Seleccione un Cargo</option>
                                    @foreach ($cargos as $cargo)
                                        <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Correo del Usuario -->
                        <div class="row">
                            <div class="form-group mb-3 col-6">
                                <label for="correoUsuarioEditInput"><b>Correo Usuario</b></label>
                                <input type="email" class="form-control mt-2" id="correoUsuarioEditInput"
                                    placeholder="Ej: example@gmail.com" required>
                            </div>
                        </div>
                        <!-- Botones -->
                        <div class="row mt-3">
                            <div class="col text-end">
                                <button type="button" id="btn_edit_user" class="btn btn-primary">Guardar</button>
                                <button type="button" id="btn_cerrar_agregar" class="btn btn-danger" 
                                        data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                            <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="confirmDelete" class="btn btn-secondary m-2">Eliminar</button>
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

            ////////////////////////////BUSCADOR/////////////////////////
            $("#buscador_cnn").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tablaUa tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            //Boton agregar usuario
            $("#btn_agregar_user").on('click', function(event) {
                event.preventDefault();

                // Obtener los valores de los campos de texto
                var nombre = $("#nombreUsuarioInput").val();
                var correo = $("#correoUsuarioInput").val();
                var contraseña = $("#contraseñaUsuarioInput").val();
                var cargo = $("#cargoUsuarioInput").val();

                argumentos = {
                    nombre: nombre,
                    correo: correo,
                    contraseña: contraseña,
                    cargo: cargo
                };

                console.log(argumentos);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/usuarios/add_usuarios') }}',
                    type: 'POST',
                    data: argumentos,
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarUsuario").modal('hide');
                        $("#successModal").modal('show');
                        // $("#texto_success_ventas").html("La Carta <b>" + respuesta.nuevo_detalle.titulo_carta + "</b>, se ha creado exitosamente");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#agregarUsuario").modal('hide');
                        $('#modalerror').modal('show');
                    }
                });
            }); //fin agregar usuario

            // boton trae datos del usuario para editar
            $(".editar-user").on('click', function(event) {
                event.preventDefault();
                idUsuario = $(this).data('id');
                console.log('Editar Usuario id ' + idUsuario);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/usuarios/editar/' + idUsuario,
                    type: 'GET',
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarUsuarioEdit").modal('show');
                        $('#btn_edit_user').data('id', idUsuario);
                        $("#nombreUsuarioEditInput").val(respuesta.usuarios.name);
                        $("#correoUsuarioEditInput").val(respuesta.usuarios.email);
                        // $("#contraseñaUsuarioEditInput").val(respuesta.usuarios.pasword);
                        $("#cargoUsuarioEditInput").val(respuesta.usuarios.id_cargo);
                    }
                });
            }); //fin datos del usuario

            //boton guardar edicion de usuario
            $("#btn_edit_user").on('click', function(event) {
                event.preventDefault();
                var idUsuario = $(this).data('id');

                var nombre = $("#nombreUsuarioEditInput").val();
                var correo = $("#correoUsuarioEditInput").val();
                var cargo = $("#cargoUsuarioEditInput").val();


                argumentos = {
                    idUsuario: idUsuario,
                    nombre: nombre,
                    correo: correo,
                    cargo: cargo
                };

                console.log(argumentos);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/usuarios/add_editar_usuario') }}',
                    type: 'POST',
                    datatype: 'json',
                    data: argumentos,
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarUsuarioEdit").modal('hide');
                        $("#successModal").modal('show');
                        $('#texto_success').text('Usuario Editado Correctamente');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#agregarUsuarioEdit").modal('hide');
                        $('#modalerror').modal('show');
                    }
                });
            }); // fin editar usuario

            //boton eliminar usuario
            $(".borrar-user").on('click', function(event) {
                event.preventDefault();
                var idUsuario = $(this).data('id');
                console.log('Usuario: ' + idUsuario);

                $("#modalinfo").modal('show');
                $("#confirmDelete").click(function() {
                    $("#modalinfo").modal('hide');
                    // Realizar la solicitud AJAX
                    $.ajax({
                        url: '/usuarios/eliminar/' + idUsuario,
                        type: 'DELETE',
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
