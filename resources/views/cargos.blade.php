@extends('layouts.app')
@section('content')
<div class="container-fluid overflow-hidden" style="background-color:rgb(255, 255, 255)">
    <div class="row vh-100 overflow-auto" style="background-color:rgb(255, 255, 254)">
        @include('layouts.sidebar')
        <div class="col d-flex flex-column h-100" style="padding:0;">
            <div class="flex-grow-1">
                {{-- Contenido --}}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 text-uppercase" style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px;color:black">
                            <h1 >Cargos</h1>
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
                            <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#agregarCargo" style=>
                                <span>Agregar nuevo cargo</span>
                            </button>
                        </div>
                    </div>
                    <div class="table-container tabla-scroll" >
                        <table class="table table-striped-columns">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaPagos">
                                @foreach ($cargos as $cargo)
                                    <tr>
                                        <td >{{ $loop->iteration }}</td>
                                        <td >{{ $cargo->nombre }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm editar-cargo-btn" data-id="{{ $cargo->id }}"><i class="fas fa-edit"></i> </a>
                                            <a href="#" class="btn btn-danger btn-sm borrar-cargo-btn" data-id="{{ $cargo->id }}"><i class="fas fa-trash-alt"></i></a>
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

    <!-- Modal agregar cargo-->
    <div class="modal fade" id="agregarCargo" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="agregarCargoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarComisionLabel">Agregar Cargo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body ">
                    <form>
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="CargoInput"><b>Agregar Cargo</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control mt-2" id="CargoInput"
                                            placeholder="Ej: Administrador" required>
                                        <div class="input-group-prepend">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Botones de cambios -->
                        <div class="d-flex justify-content-end">
                            <button type="button" id="btn_agregar" class="btn btn-primary m-2">Guardar</button>
                            <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-2" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal editar comision-->
    <div class="modal fade" id="agregarCargoEdit" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="agregarCargoEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarCargoEditLabel">Editar Cargo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body ">
                    <form>
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="CargoEditInput"><b>Editar Cargo</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control mt-2" id="CargoEditInput"
                                            placeholder="" required>
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!-- Botones de cambios -->
                                <button type="button" id="btn_editar" class="btn btn-primary m-2">Guardar</button>
                                <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-2" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                    <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar cargo?</h2>
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
                var nombre= $("#CargoInput").val();


                argumentos = {
                    nombre:nombre, 
                };

                console.log(argumentos);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/cargos/add_cargo') }}',
                    type: 'POST',
                    data: argumentos,
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarCargo").modal('hide');
                        $("#successModal").modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#agregarCargo").modal('hide');
                        $('#modalerror').modal('show');
                    }
                });
            }); //fin agregar arriendo

            // boton trae datos del arrendatario para editar
            $(".editar-cargo-btn").on('click', function(event) {
                event.preventDefault();
                idCargo = $(this).data('id');
                console.log('Editar Cargo id ' + idCargo);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/cargo/editar/' + idCargo,
                    type: 'GET',
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarCargoEdit").modal('show');
                        $('#btn_editar').data('id', idCargo);
                        $("#CargoEditInput").val(respuesta.cargos.nombre);
                        console.log(respuesta);
                    }
                });
            }); //fin datos del arrendatario

            //boton guardar edicion de arrendatario
            $("#btn_editar").on('click', function(event) {
                event.preventDefault();
                var idCargo = $(this).data('id');

                var nombre = $("#CargoEditInput").val();

                argumentos = {
                    idCargo: idCargo,
                    nombre: nombre
                };

                console.log(argumentos);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/cargo/add_editar_cargo') }}',
                    type: 'POST',
                    datatype: 'json',
                    data: argumentos,
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarCargoEdit").modal('hide');
                        $("#successModal").modal('show');
                        $('#texto_success').text('Cargo Editado Correctamente');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#agregarCargoEdit").modal('hide');
                        $('#modalerror').modal('show');
                    }
                });
            }); // fin editar cargo

            //boton eliminar comision
            $(".borrar-cargo-btn").on('click', function(event) {
                event.preventDefault();
                var idCargo = $(this).data('id');
                console.log('Cargo: ' + idCargo);

                $("#modalinfo").modal('show');
                $("#confirmDelete").click(function() {
                    $("#modalinfo").modal('hide');
                    // Realizar la solicitud AJAX
                    $.ajax({
                        url: '/cargo/eliminar/' + idCargo,
                        type: 'DELETE',
                        datatype: 'json',
                        success: function(respuesta) {
                            console.log("respuesta", respuesta);
                            $("#modalinfo").modal('hide');
                            $("#successModal").modal('show');
                            $('#texto_success').text(
                                'Cargo Eliminada Correctamente');
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

