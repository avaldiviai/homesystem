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
                            <h1 >Elementos</h1>
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
                            <input type="text" id="buscador_cnn" placeholder="Buscar"  class="form-control shadow-sm border-0" 
                            style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        </div>
                    </span>
        
                        <div class="col-md-3 mb-4 text-end">
                            <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#agregarElemento" style=>
                                <span>AGREGAR ELEMENTO</span>
                            </button>
                        </div>
                    </div>
                    <div class="table-container tabla-scroll" >
                        <table class="table table-striped-columns">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    {{-- <th>observacion</th> --}}
                                    <th>Acciones</th>
                                </tr>

                            </thead>
                            <tbody id="tablaUa">
                                @foreach ($elementos as $elemento)
                                    <tr>

                                        <td >{{ $loop->iteration }}</td>
                                        <td >{{ $elemento->nombre }}</td>
                                        {{-- <td >{{ $elemento->observacion }}</td> --}}
                                        <td>
                                            <!-- Iconos de editar y eliminar -->
                                            <a href="#" class="btn btn-primary btn-sm editar-elemento-btn" data-id="{{ $elemento->id }}"><i class="fas fa-edit"></i> </a>
                                            <a href="#" class="btn btn-danger btn-sm btn-delete-btn" data-id="{{ $elemento->id }}"><i class="fas fa-trash-alt"></i></a>
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

<!-- Modal agregar elemento nuevo-->
<!-- Modal Agregar Elemento Nuevo -->
<div class="modal fade" id="agregarElemento" tabindex="-1" data-bs-backdrop="static" aria-labelledby="agregarElementoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarElementoLabel">Agregar Elemento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregarElemento">
                    <div class="container">
                        <!-- Campos de entrada -->
                        <div class="mb-3">
                            <label for="nombreInput"><b>Nombre</b></label>
                            <input type="text" class="form-control mt-2" id="nombreInput" placeholder="Ej: control" required>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <!-- Botones -->
                            <button type="button" id="btn_agregar" class="btn btn-primary m-2">Guardar</button>
                            <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Elemento -->
<div class="modal fade" id="agregarElementEdit" tabindex="-1" data-bs-backdrop="static" aria-labelledby="agregarElementEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarElementEditLabel">Editar Elemento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarElemento">
                    <div class="container">
                        <!-- Campos de entrada -->
                        <div class="mb-3">
                            <label for="nombreInputEdit"><b>Nombre</b></label>
                            <input type="text" class="form-control mt-2" id="nombreInputEdit" placeholder="Ej: control" required>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <!-- Botones -->
                            <button type="button" id="btn_editar" class="btn btn-primary m-2">Guardar</button>
                            <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Success -->
<div class="modal fade" id="modalAlertaAgregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="successLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
            <div class="modal-header alert alert-success" role="alert" style="border: none;">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000" style="width:70px;height:70px"></lord-icon>
                        </div>
                        <div class="col-8 d-flex justify-content-center align-items-center">
                            <p id="texto_success" class="text-uppercase"></p>
                        </div>
                        <div class="col-2 d-flex justify-content-end">
                            <button type="button" class="btn-close" id="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error -->
<div class="modal fade" id="modalerror" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalerrorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header alert alert-danger" role="alert" style="border: none;">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json" trigger="loop" delay="2000" style="width:70px;height:70px"></lord-icon>
                        </div>
                        <div class="col-8 d-flex justify-content-center align-items-center">
                            <p id="texto_error" class="text-uppercase text-center m-0">Ha ocurrido un error al guardar.</p>
                        </div>
                        <div class="col-2 d-flex justify-content-end align-items-center">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="cerrar_error"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmación de Eliminación -->
<div class="modal fade" id="modalinfo" tabindex="-1" aria-labelledby="modalinfoLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
            <div class="modal-content" style="background-color: rgba(0,0,0,0.0); border: none;">
                <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar el elemento?</h5>
                <div class="modal-footer d-flex justify-content-center">
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

$(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        console.log('Listo para trabajar')

////////////////////////////BUSCADOR/////////////////////////
             $("#buscador_cnn").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tablaUa tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });


    $("#btn_agregar").on('click', function(event){
            event.preventDefault();
            // console.log('hola');
            // Obtener los valores de los campos de texto
            var nombre = $("#nombreInput").val();
            // var descripcion = $("#descripInput").val();


            // Crear un objeto FormData
            var formData = new FormData();

            // Agregar los valores de los campos de texto al objeto FormData

            formData.append('nombre', nombre);
            // formData.append('descripcion', descripcion);


            console.log(formData);

            // Realizar la solicitud AJAX
            $.ajax({
                url: '{{url("/Elementosadd")}}',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,  // Evitar procesamiento de datos
                contentType: false,  // Evitar configuración automática del tipo de contenido
                headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                    success: function(respuesta) {
                    console.log("respuesta", respuesta);
                    $("#agregarElemento").modal('hide'); // Cierra el modal de agregar elemento
                    $("#modalAlertaAgregar").modal('show'); // Muestra el modal de éxito
                    $("#texto_success").html("El elemento se ha creado exitosamente.");

                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log("Error:", errorThrown);
                    // $('#modalError').modal('show');
                }

            });
            $("#btn-close").click(function() {
            $("#modalAlertaAgregar").modal('hide');
            location.reload();
            });
        });

          // boton trae datos del elemento para editar
          $(".editar-elemento-btn").on('click', function(event) {
                event.preventDefault();
                id_elemento = $(this).data('id');
                console.log('Editar Elemento id ' + id_elemento);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/elemento/editar/' + id_elemento,
                    type: 'GET',
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarElementEdit").modal('show');
                        $('#btn_editar').data('id', id_elemento);
                        $("#nombreInputEdit").val(respuesta.elementos.nombre);
                    }
                });
            });

             //boton guardar edicion de elementos
             $("#btn_editar").on('click', function(event) {
                event.preventDefault();
                var id_elemento = $(this).data('id');

                var nombre = $("#nombreInputEdit").val();

                argumentos = {
                    id_elemento: id_elemento,
                    nombre: nombre,
                };

                console.log(argumentos);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/elementos/guadar_elementos') }}',
                    type: 'POST',
                    datatype: 'json',
                    data: argumentos,
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarElementEdit").modal('hide');
                        $("#modalAlertaAgregar").modal('show');
                        $('#texto_success').text('Elemento Editado Correctamente');

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $('#modalerror').modal('show');
                    }
                });
                $("#btn-close").click(function() {
            $("#modalAlertaAgregar").modal('hide');
            location.reload();
            });
            }); // fin editar
             //boton eliminar Elemento
             $(".btn-delete-btn").on('click', function(event) {
                event.preventDefault();
                var id_elemento = $(this).data('id');
                console.log('Elemento: ' + id_elemento);

                $("#modalinfo").modal('show');
                $("#confirmDelete").click(function() {
                    $("#modalinfo").modal('hide');
                    // Realizar la solicitud AJAX
                    $.ajax({
                        url: '/elemento/eliminar/' + id_elemento,
                        type: 'DELETE',
                        datatype: 'json',
                        success: function(respuesta) {
                            console.log("respuesta", respuesta);
                            $("#modalAlertaAgregar").modal('show');
                            $('#texto_success').text(
                                'Elemento Eliminado Correctamente');


                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("Error:", errorThrown);
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
            $("#btn-close").click(function() {
                $("#modalAlertaAgregar").modal('hide');
                location.reload();
            });
});
</script>
@endsection
