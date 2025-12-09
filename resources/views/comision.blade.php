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
                            <div class="col-6 text-uppercase" style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px;color:black">
                                <h1>Comisiones</h1>
                            </div>
                        </div>
                    </div>
                    {{-- Tabla de usuarios --}}
                    <div class="container-fluid">
                        <div class="row justify-content-between align-items-center">
                            <div class="input-group mx-2" style="max-width: 400px;">
                                <span class="input-group-text bg-primary text-white shadow-sm">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="text" id="buscador_cnn" placeholder="Buscar" class="form-control">
                            </div>
                            <div class="col-md-3 mb-4 text-end">
                                <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#agregarComision" style=>
                                    <span>AGREGAR COMISION</span>
                                </button>
                            </div>
                        </div>
                        <div class="table-container tabla-scroll">
                            <table class="table table-striped-columns">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Porcentaje</th>
                                        <th>Acciones</th>
                                    </tr>

                                </thead>
                                <tbody id="tablaUa">
                                    @foreach ($comisiones as $comision)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $comision->porcentaje }}
                                            </td>
                                            <td>
                                                <!-- Iconos de editar y eliminar -->
                                                <a href="#" class="btn btn-primary btn-sm btn-editar"
                                                    data-id="{{ $comision->id }}"><i class="fas fa-edit"></i> </a>
                                                <a href="#" class="btn btn-danger btn-sm btn-delete"
                                                    data-id="{{ $comision->id }}"><i class="fas fa-trash-alt"></i></a>
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

    <!-- Modal agregar comision-->
    <div class="modal fade" id="agregarComision" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="agregarComisionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarComisionLabel">Agregar Comision</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body ">
                    <form>
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="porcentajeInput"><b>Agregar Porcentaje de Comision</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control mt-2" id="porcentajeInput"
                                            placeholder="Ej: 10" required>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Botones de cambios -->
                            <div class="d-flex justify-content-end">
                                <button type="button" id="btn_agregar" class="btn btn-primary m-2">Guardar</button>
                                <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-2" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal editar comision-->
    <div class="modal fade" id="agregarComisionEdit" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="agregarComisionEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarComisionEditLabel">Editar Comision</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body ">
                    <form>
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="porcentajeEditInput"><b>Editar Porcentaje de Comision</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control mt-2" id="porcentajeEditInput"
                                            placeholder="Ej: 10" required>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">

                            <!-- Botones de cambios -->
                            <button type="button" id="btn_editar" class="btn btn-primary m-2">Guardar</button>
                            <button type="button" id="btn_cerrar_agregar" class="btn btn-danger"
                                data-bs-dismiss="modal">Cerrar</button>
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
                    <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar la Comision?</h2>
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

            //Boton agregar arriendo
            $("#btn_agregar").on('click', function(event) {
                event.preventDefault();

                // Obtener los valores de los campos de texto
                var porcentaje = $("#porcentajeInput").val();


                argumentos = {
                    porcentaje: porcentaje
                };

                console.log(argumentos);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/comision/add_comision') }}',
                    type: 'POST',
                    data: argumentos,
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarComision").modal('hide');
                        $("#successModal").modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#agregarComision").modal('hide');
                        $('#modalerror').modal('show');
                    }
                });
            }); //fin agregar arriendo

            // boton trae datos del arrendatario para editar
            $(".btn-editar").on('click', function(event) {
                event.preventDefault();
                idComision = $(this).data('id');
                console.log('Editar Comision id ' + idComision);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/comision/editar/' + idComision,
                    type: 'GET',
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarComisionEdit").modal('show');
                        $('#btn_editar').data('id', idComision);
                        $("#porcentajeEditInput").val(respuesta.comision.porcentaje);
                    }
                });
            }); //fin datos del arrendatario

            //boton guardar edicion de arrendatario
            $("#btn_editar").on('click', function(event) {
                event.preventDefault();
                var idComision = $(this).data('id');

                var porcentaje = $("#porcentajeEditInput").val();

                argumentos = {
                    idComision: idComision,
                    porcentaje: porcentaje
                };

                console.log(argumentos);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/comision/add_editar_comision') }}',
                    type: 'POST',
                    datatype: 'json',
                    data: argumentos,
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarComisionEdit").modal('hide');
                        $("#successModal").modal('show');
                        $('#texto_success').text('Comision Editada Correctamente');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#agregarComisionEdit").modal('hide');
                        $('#modalerror').modal('show');
                    }
                });
            }); // fin editar comision

            //boton eliminar comision
            $(".btn-delete").on('click', function(event) {
                event.preventDefault();
                var idComision = $(this).data('id');
                console.log('Comision: ' + idComision);

                $("#modalinfo").modal('show');
                $("#confirmDelete").click(function() {
                    $("#modalinfo").modal('hide');
                    // Realizar la solicitud AJAX
                    $.ajax({
                        url: '/comision/eliminar/' + idComision,
                        type: 'DELETE',
                        datatype: 'json',
                        success: function(respuesta) {
                            console.log("respuesta", respuesta);
                            $("#modalinfo").modal('hide');
                            $("#successModal").modal('show');
                            $('#texto_success').text(
                                'Comision Eliminada Correctamente');
                                // window.location.href = '/comision';

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("Error:", errorThrown);
                            $("#modalinfo").modal('hide');
                            $('#modalerror').modal('show');
                        }
                    });
                });
            }); // fin eliminar comision


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
