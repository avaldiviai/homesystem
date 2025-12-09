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
                                <h1>Pagos</h1>
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
                                <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#agregarPago" style=>
                                    <span>AGREGAR PAGO</span>
                                </button>
                            </div>
                        </div>
                        <div class="table-container tabla-scroll">
                            <table class="table table-striped-columns">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mes</th>
                                        <th>Año</th>
                                        <th>Documento de Pago</th>
                                        <th>Estado</th>
                                        <th>Arriendo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaPagos">
                                    @foreach ($pagos as $pago)
                                        <tr id="filas">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pago->mes_nombre}}</td>
                                            <td>{{ $pago->año }}</td>
                                            <td>
                                                <a href="{{ asset($pago->documento_pago) }}" target="_blank">
                                                    {{ basename($pago->documento_pago) }}
                                                </a>
                                            </td>
                                            <td>{{ $pago->estado_pago }}</td>
                                            <td>{{ $pago->arriendo->arrendatario->nombre }} -
                                                {{ $pago->arriendo->propiedad->direccion }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm editar-pago"
                                                    data-id="{{ $pago->id }}"><i class="fas fa-edit"></i> </a>
                                                <a href="#" class="btn btn-danger btn-sm borrar-pago"
                                                    data-id="{{ $pago->id }}"><i class="fas fa-trash-alt"></i></a>
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

    <!-- Modal agregar nuevo pago-->
    <div class="modal fade" id="agregarPago" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="agregarPagoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarPagoLabel">Agregar Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body ">
                    <form>
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                <label for="mesInput"><b>Mes</b></label>
                                    <select class="form-control mt-2" id="mesInput" required>
                                        <option value="" disabled selected >Selecciona un mes</option>
                                        <option value="1">Enero</option>
                                        <option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="añoInput"><b>Año</b></label>
                                    <input type="number" class="form-control mt-2" id="añoInput" min="2024"
                                        max="3000" placeholder="Ej: 1999">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="documentoPagoInput"><b>Documento de Pago</b></label>
                                    <div class="input-group">
                                        <!-- <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">#</span>
                                        </div> -->
                                        <input type="file" class="form-control mt-2" id="documentoPagoInput"
                                            placeholder="Ej: 000000" maxlength="20" required>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-6">
                                    <label for="estadoInput"><b>Estado del Pago</b></label>
                                    <select class="form-select mt-2" id="estadoInput">
                                        <option disabled selected value="">Seleccione un Estado</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Pagado">Pagado</option>
                                        {{-- <option value="otros">Otros</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="arriendoInput"><b>Arriendo</b></label>
                                    <select class="form-select mt-2" id="arriendoInput">
                                        <option disabled selected value="">Seleccione un Arriendo</option>
                                        @foreach ($arriendos as $arri)
                                            <option value="{{ $arri->id }}">{{ $arri->arrendatario->nombre }} -
                                                {{ $arri->propiedad->direccion }}</option>
                                        @endforeach
                                        {{-- <option value="otros">Otros</option> --}}
                                    </select>
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


    <!-- Modal editar pago-->
    <div class="modal fade" id="agregarPagoEdit" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="agregarPagoEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarPagoEditLabel">Agregar Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body ">
                    <form>
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="mesEditInput"><b>Mes</b></label>
                                        <select name="mesEditInput" id="mesEditInput" class="form-select">
                                            <option value="" disabled selected >Selecciona un mes</option>
                                            <option value="1">Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="añoEditInput"><b>Año</b></label>
                                    <input type="number" class="form-control mt-2" id="añoEditInput" min="2024"
                                        max="3000" placeholder="Ej: 1999">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="documentoPagoEditInput"><b>Documento de Pago</b></label>
                                    <div class="input-group">
                                        <!-- <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">#</span>
                                        </div> -->
                                        <input type="file" class="form-control mt-2" id="documentoPagoEditInput"
                                            placeholder="Ej: 000000" maxlength="20" required>
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-6">
                                    <label for="estadoEditInput"><b>Estado</b></label>
                                    <select class="form-select mt-2" id="estadoEditInput">
                                        <option disabled selected value="">Seleccione un Arriendo</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Pagado">Pagado</option>
                                        {{-- <option value="otros">Otros</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="arriendoEditInput"><b>Arriendo</b></label>
                                    <select class="form-select mt-2" id="arriendoEditInput">
                                        <option disabled selected value="">Seleccione un Arriendo</option>
                                        @foreach ($arriendos as $arri)
                                            <option value="{{ $arri->id }}">{{ $arri->arrendatario->nombre }} -
                                                {{ $arri->propiedad->direccion }}</option>
                                        @endforeach
                                        {{-- <option value="otros">Otros</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                            <!-- Botones de cambios -->
                            <button type="button" id="btn_editar_pago" class="btn btn-primary">Guardar</button>
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
            $("#buscador_pagos").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tablaPagos #filas").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            //Boton agregar arriendo
            $("#btn_agregar").on('click', function(event) {
                event.preventDefault();

                // Obtener los valores de los campos de texto
                var mes = $("#mesInput").val();
                var año = $("#añoInput").val();
                // var documento_pago = $("#documentoPagoInput").val();
                
                var estado_pago = $("#estadoInput").val();
                var id_arriendo = $("#arriendoInput").val();

                var formData = new FormData();

                formData.append('mes', mes);
                formData.append('año', año);
                formData.append('estado_pago', estado_pago);
                formData.append('id_arriendo', id_arriendo);
                
                var files = $('#documentoPagoInput')[0].files;
                // Iterar sobre los archivos seleccionados y agregarlos al objeto FormData
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    formData.append('documento_pago[]', file);
                }


                formData.forEach(function(value, key) {
                    console.log(key, value);
                });

                console.log(formData);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/pagos/add_pagos') }}',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarPago").modal('hide');
                        $("#successModal").modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#agregarPago").modal('hide');
                        $('#modalerror').modal('show');
                    }
                });
            }); //fin agregar arriendo

            // boton trae datos de pago para editar
            $(".editar-pago").on('click', function(event) {
                event.preventDefault();
                idPago = $(this).data('id');
                console.log('Editar pago id ' + idPago);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/pagos/editar/' + idPago,
                    type: 'GET',
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarPagoEdit").modal('show');
                        $('#btn_editar_pago').data('id', idPago);
                        $("#mesEditInput").val(respuesta.pagos.mes);
                        $("#añoEditInput").val(respuesta.pagos.año);
                        // $("#documentoPagoEditInput").val(respuesta.pagos.documento_pago);
                        $("#estadoEditInput").val(respuesta.pagos.estado_pago);
                        $("#arriendoEditInput").val(respuesta.pagos.id_arriendo);
                    }
                });
            }); //fin datos de pago

            //boton guardar edicion de pagos
            $("#btn_editar_pago").on('click', function(event) {
                event.preventDefault();
                var idPago = $(this).data('id');
                // Obtener los valores de los campos de texto
                var mes = $("#mesEditInput").val();
                var año = $("#añoEditInput").val();
                // var documento_pago = $("#documentoPagoEditInput").val();
                var estado_pago = $("#estadoEditInput").val();
                var id_arriendo = $("#arriendoEditInput").val();

                var formData = new FormData();

                formData.append('idPago', idPago);
                formData.append('mes', mes);
                formData.append('año', año);
                formData.append('estado_pago', estado_pago);
                formData.append('id_arriendo', id_arriendo);
                
                var files = $('#documentoPagoEditInput')[0].files;
                // Iterar sobre los archivos seleccionados y agregarlos al objeto FormData
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    formData.append('documento_pago[]', file);
                }


                formData.forEach(function(value, key) {
                    console.log(key, value);
                });

                console.log(formData);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/pagos/add_editar_pagos') }}',
                    type: 'POST',
                    datatype:'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarPagoEdit").modal('hide');
                        $("#successModal").modal('show');
                        $('#texto_success').text('Pago Editado Correctamente');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#agregarPagoEdit").modal('hide');
                        $('#modalerror').modal('show');
                    }
                });
            }); // fin editar pagos

            //boton eliminar pagos
            $(".borrar-pago").on('click', function(event) {
                event.preventDefault();
                var idPago = $(this).data('id');
                console.log('Pagos: ' + idPago);

                var estado = 0;

                argumentos = {
                    idPago: idPago,
                    estado: estado
                };

                $("#modalinfo").modal('show');
                $("#confirmDelete").click(function() {
                    $("#modalinfo").modal('hide');
                    // Realizar la solicitud AJAX
                    $.ajax({
                        url: '{{ url('/pagos/eliminar') }}',
                        type: 'POST',
                        datatype: 'json',
                        data: argumentos,
                        success: function(respuesta) {
                            console.log("respuesta", respuesta);
                            $("#modalinfo").modal('hide');
                            $("#successModal").modal('show');
                            $('#texto_success').text(
                                'Pago Eliminado Correctamente');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("Error:", errorThrown);
                            $("#modalinfo").modal('hide');
                            $('#modalerror').modal('show');
                        }
                    });
                });
            }); // fin eliminar pago

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

        // Obtener el mes actual (Los meses en JavaScript empiezan en 0, por eso sumamos 1)
        var currentMonth = new Date().getMonth() + 1;

        // Establecer el valor del input con el mes actual
        document.getElementById('mesInput').value = currentMonth;

        // Escuchar cambios en el input
        document.getElementById('mesInput').addEventListener('input', function(e) {
            var value = parseInt(e.target.value);

            // Solo permitir que el valor esté entre 1 y 12
            if (value < 1 || value > 12) {
                e.target.value = currentMonth; // Volver al valor del mes actual si está fuera del rango
            }
        });

        // Obtener el año actual
        var currentYear = new Date().getFullYear();

        // Establecer el valor del input con el año actual
        document.getElementById('añoInput').value = currentYear;

        // Escuchar cambios en el input
        document.getElementById('añoInput').addEventListener('input', function(e) {
            var value = parseInt(e.target.value);

            // Solo permitir que el valor esté entre 2000 y 3000
            if (value < 2024 || value > 3000) {
                e.target.value = currentYear; // Volver al valor del año actual si está fuera del rango
            }
        });
    </script>
@endsection
