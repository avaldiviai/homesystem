@extends('layouts.app')
@section('content')
    <div class="container-fluid overflow-hidden" style="background-color: ">
        <div class="row vh-100 overflow-auto" style="background-color: ">
            @include('layouts.sidebar')
            <div class="col d-flex flex-column h-100" style="padding:0;" style="background-color: #b86e13">
                <div class="flex-grow-1">
                    {{-- Contenido --}}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6" style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px;">
                                <h1 class="text-black text-uppercase">Arrendatarios</h1>
                            </div>
                        </div>
                    </div>
                    {{-- Tabla de usuarios --}}
                    <div class="container-fluid">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-4 mb-4">
                                <div class="input-group mx-2 shadow-lg" style="max-width: 400px;">
                                    <span class="input-group-text bg-primary text-white shadow-sm">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </span>
                                    <input type="text" id="buscador_cnn" placeholder="Buscar Arrendatario" 
                                        class="form-control shadow-sm border-0" 
                                        style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                </div>                            
                            </div>
                            <div class="col-md-3 mb-4 text-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarArrendatario">
                                    <span>AGREGAR ARRENDATARIO</span>
                                </button>
                            </div>
                        </div>
                        <div class="overflow-auto shadow-lg" style="max-height: 50vh;">
                            <table class="table table-striped-columns ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Rut</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                        <th>Ciudad</th>
                                        <th>Acciones</th>
                                    </tr>

                                </thead>
                                <tbody id="tablaUa">
                                    @foreach ($arrendatarios as $arrendatario)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $arrendatario->nombre }}</td>
                                            <td>{{ $arrendatario->rut }}</td>
                                            <td>{{ $arrendatario->correo }}</td>
                                            <td>{{ $arrendatario->telefono }}</td>
                                            <td>{{ $arrendatario->direccion }}</td>
                                            <td>{{ $arrendatario->ciudad }}</td>

                                            <td>
                                                <!-- Iconos de editar y eliminar -->
                                                <a href="#" class="btn btn-primary btn-sm btn-editar"
                                                    data-id="{{ $arrendatario->id }}"><i class="fas fa-edit"></i> </a>
                                                <a href="#" class="btn btn-danger btn-sm btn-eliminar"
                                                    data-id="{{ $arrendatario->id }}"><i class="fas fa-trash-alt"></i></a>
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

<!-- Modal agregar nuevo arrendatario-->
<div class="modal fade" id="agregarArrendatario" tabindex="-1" data-bs-backdrop="static" aria-labelledby="agregarArrendatarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarArrendatarioLabel">Agregar Arrendatario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form>
                    <div class="container">
                        <!-- Campos de entrada -->
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="nombreArrendatarioInput"><b>Nombre Arrendatario</b></label>
                                <input type="text" class="form-control mt-2" id="nombreArrendatarioInput" placeholder="Ej: Pedro Aguilera" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-6">
                                <label for="rutInput"><b>Rut</b></label>
                                <input type="text" class="form-control mt-2" id="rutInput" placeholder="Ej: 1234567-8" maxlength="10" required>
                            </div>

                            <div class="form-group mb-3 col-6">
                                <label for="telefonoInput"><b>Telefono</b></label>
                                <input type="text" class="form-control mt-2" id="telefonoInput" placeholder="Ej: 965577377" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="correoInput"><b>Correo</b></label>
                                <input type="text" class="form-control mt-2" id="correoInput" placeholder="Ej: example@gmail.com" required>
                            </div>

                            <div class="form-group mb-3 col-6">
                                <label for="direccionInput"><b>Direccion</b></label>
                                <input type="text" class="form-control mt-2" id="direccionInput" placeholder="Ej: av.libertades" required>
                            </div>
                            <div class="form-group mb-3 col-6">
                                <label for="ciudadInput"><b>Ciudad</b></label>
                                <input type="text" class="form-control mt-2" id="ciudadInput" placeholder="Ciudad" required>
                            </div>
                        </div>
                        <!-- Botones de cambios -->
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


    <!-- Modal editar arrendatario-->
    <div class="modal fade" id="editarArrendatario" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="editarArrendatarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarArrendatarioLabel">Editar Arrendatario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body ">
                    <form>
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="nombreArrendatarioEditInput"><b>Nombre Arrendatario</b></label>
                                    <input type="text" class="form-control mt-2" id="nombreArrendatarioEditInput"
                                        placeholder="Ej: Pedro Aguilera" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="rutEditInput"><b>Rut</b></label>
                                    <input type="text" class="form-control mt-2" id="rutEditInput"
                                        placeholder="Ej: 1234567-8" maxlength="10" required>
                                </div>

                                <div class="form-group mb-3 col-6">
                                    <label for="telefonoEditInput"><b>Telefono</b></label>
                                    <input type="text" class="form-control mt-2" id="telefonoEditInput"
                                        placeholder="Ej: +56 9 6557 7377" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 ">
                                    <label for="correoEditInput"><b>Correo</b></label>
                                    <input type="text" class="form-control mt-2" id="correoEditInput"
                                        placeholder="Ej: example@gmail.com" required>
                                </div>

                                <div class="form-group mb-3 col-6">
                                    <label for="direccionEditInput"><b>Direccion</b></label>
                                    <input type="text" class="form-control mt-2" id="direccionEditInput"
                                        placeholder="Ej: av.libertades" required>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="ciudadEditInput"><b>Ciudad</b></label>
                                    <input type="text" class="form-control mt-2" id="ciudadEditInput"
                                        placeholder="Ciudad" required>
                                </div>
                            </div>
                            <!-- Botones de cambios -->
                            <div class="modal-footer">
                            <button type="button" id="btn_editar" class="btn btn-primary">Guardar</button>
                            <button type="button" id="btn_cerrar_editar" class="btn btn-danger"
                                data-bs-dismiss="modal">Cerrar</button>
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
                    <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar Arrendatario?</h2>
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

            // //Boton agregar arrendatario
             $("#btn_agregar").on('click', function(event) {
                event.preventDefault();

                Obtener los valores de los campos de texto
                var nombre = $("#nombreArrendatarioInput").val();
                var rut = $("#rutInput").val();
                var telefono = $("#telefonoInput").val();
                var correo = $("#correoInput").val();
                var direccion = $("#direccionInput").val();
                var ciudad = $("#ciudadInput").val();

                argumentos = {
                nombre: nombre,
                rut: rut,
                telefono: telefono,
                correo: correo,
                direccion: direccion,
                ciudad: ciudad
               };

               console.log(argumentos);

               // Realizar la solicitud AJAX
                $.ajax({
                url: '{{ url('/arrendatarios/add') }}',
                type: 'POST',
                 data: argumentos,
                dataType: 'json',
                   success: function(respuesta) {
                     console.log("respuesta", respuesta);
                      $("#agregarArrendatario").modal('hide');
                      $("#successModal").modal('show');
                     // $("#texto_success_ventas").html("La Carta <b>" + respuesta.nuevo_detalle.titulo_carta + "</b>, se ha creado exitosamente");
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                       console.log("Error:", errorThrown);
                    $("#agregarArrendatario").modal('hide');
                       $('#modalerror').modal('show');
                  }
               });
             }); //fin agregar arrendatario

            // boton trae datos del arrendatario para editar
            $(".btn-editar").on('click', function(event) {
                event.preventDefault();
                idArrendatario = $(this).data('id');
                console.log('Editar Arrendatario id ' + idArrendatario);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/arrendatarios/editar/' + idArrendatario,
                    type: 'GET',
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#editarArrendatario").modal('show');
                        $('#btn_editar').data('id', idArrendatario);
                        $("#nombreArrendatarioEditInput").val(respuesta.arrendatario.nombre);
                        $("#rutEditInput").val(respuesta.arrendatario.rut);
                        $("#telefonoEditInput").val(respuesta.arrendatario.telefono);
                        $("#correoEditInput").val(respuesta.arrendatario.correo);
                        $("#direccionEditInput").val(respuesta.arrendatario.direccion);
                        $("#ciudadEditInput").val(respuesta.arrendatario.ciudad);

                    }
                });
            }); //fin datos del arrendatario

            //boton guardar edicion de arrendatario
            $("#btn_editar").on('click', function(event) {
                event.preventDefault();
                var idArrendatario = $(this).data('id');

                var nombre = $("#nombreArrendatarioEditInput").val();
                var rut = $("#rutEditInput").val();
                var telefono = $("#telefonoEditInput").val();
                var correo = $("#correoEditInput").val();
                var direccion = $("#direccionEditInput").val();
                var ciudad = $("#ciudadEditInput").val();

                argumentos = {
                    idArrendatario: idArrendatario,
                    nombre: nombre,
                    rut: rut,
                    telefono: telefono,
                    correo: correo,
                    direccion: direccion,
                    ciudad: ciudad
                };

                console.log(argumentos);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/arrendatarios/add_editar_arrendatario') }}',
                    type: 'POST',
                    datatype: 'json',
                    data: argumentos,
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#editarArrendatario").modal('hide');
                        $("#successModal").modal('show');
                        $('#texto_success').text('Arrendatario Editado Correctamente');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#editarArrendatario").modal('hide');
                        $('#modalerror').modal('show');
                    }
                });
            }); // fin editar arrendatario

            //boton eliminar arrendatario
            $(".btn-eliminar").on('click', function(event) {
                event.preventDefault();
                var idArrendatario = $(this).data('id');
                console.log('Arrendatario: ' + idArrendatario);

                var estado = 0;

                argumentos = {
                    idArrendatario: idArrendatario,
                    estado: estado
                };

                $("#modalinfo").modal('show');
                $("#confirmDelete").click(function() {
                    $("#modalinfo").modal('hide');
                    // Realizar la solicitud AJAX
                    $.ajax({
                        url: '{{ url('/arrendatarios/eliminar') }}',
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

        // Función que formatea el valor a formato RUT
        function formatRUT(rut) {
            // Eliminar puntos, guiones y caracteres no válidos
            rut = rut.replace(/[^\dkK]/g, '');

            // Añadir el guion antes del último dígito
            if (rut.length > 1) {
                rut = rut.slice(0, -1) + '-' + rut.slice(-1);
            }
            return rut;
        }

        // Escuchar cambios en el input y formatear en tiempo real
        $('#rutInput').on('input', function() {
            let formattedRUT = formatRUT($(this).val());
            $(this).val(formattedRUT);
        });

        // Escuchar cambios en el input y formatear en tiempo real
        $('#rutEditInput').on('input', function() {
            let formattedRUT = formatRUT($(this).val());
            $(this).val(formattedRUT);
        });
    </script>
@endsection
