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
                            <h1 >Contratos</h1>
                        </div>
                    </div>
                </div>
                {{-- Tabla de contratos --}}
                <div class="container-fluid">
                    <div class="row justify-content-between align-items-center">
                        <div class="input-group mx-2" style="max-width: 400px;">
                            <span class="input-group-text bg-primary text-white shadow-sm">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input type="text" id="buscador_contratos" placeholder="Buscar" class="form-control">
                        </div>
                        <div class="col-md-3 mb-4 text-end">
                            <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#agregarContrato" style=>
                                <span>AGREGAR CONTRATO</span>
                            </button>
                        </div>
                    </div>
                    <div class="table-container tabla-scroll" >
                        <table class="table table-striped-columns ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Contrato</th>
                                    <th>Detalles del Arriendo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaUa" >
                                @foreach ($contratos as $contrato)
                                    <tr class="">
                                        <td >{{ $loop->iteration }}</td>

                                        <td>
                                            <a href="{{ asset($contrato->contrato) }}" target="_blank">
                                                {{ basename($contrato->contrato) }}
                                            </a>
                                        <td >Arrendatario: {{ $contrato->arriendo->arrendatario->nombre}} - Vivienda: {{ $contrato->arriendo->propiedad->tipo_vivienda}} - Inicio: {{ $contrato->arriendo->fecha_entrega}}</td>
                                        <td>
                                            <a href="{{ asset($contrato->contrato)}}" class="btn btn-primary btn-sm " download><i class="fas fa-download"></i> </a>
                                            <a href="#" class="btn btn-danger btn-sm borrar-contrato-btn" data-id="{{ $contrato->id }}"><i class="fas fa-trash-alt"></i></a>
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

<!-- Modal agregar contrato nuevo-->
 <!-- Modal -->
 <div class="modal fade" id="agregarContrato" tabindex="-1" data-bs-backdrop="static" aria-labelledby="agregarContratoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarContratoLabel">Agregar contrato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('contratos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="contrato" class="form-label"><strong>Selecciona el archivo a cargar:</strong></label>
                        <input type="file" name="contrato" accept=".pdf,.doc,.docx" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="id_arriendo" class="form-label"><strong>Selecciona un Arriendo:</strong></label>
                        <select name="id_arriendo" required class="form-select">
                            <option selected disabled value="">Seleccione un arriendo</option>
                                @foreach($arriendos as $id)
                                    <option value="{{ $id->id }}">Arrendatario: {{$id->arrendatario->nombre}} - Direccion: {{ $id->propiedad->direccion }} - Numero de Torre: #{{$id->propiedad->num_torre}}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary m-2">Guardar</button>
                        <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-2" data-bs-dismiss="modal">Cerrar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!--  Modal  de exito de archivo subido-->
<div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
            <div class="modal-header alert alert-success" role="alert" style="border: none;">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000" style="width:70px;height:70px"></lord-icon>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
                        </div>
                        <div class="col-8 d-flex justify-content-center align-items-center">
                            <p class="text-uppercase">El archivo se ha agregado exitosamente </p>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn-close d-flex justify-content-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAlertaAgregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                            <p id="texto_success" class="text-uppercase">
                                <!-- Texto dinámico aquí -->
                            </p>
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

<div class="modal fade" id="ModalContrato" tabindex="-1" aria-labelledby="ModalContratoLabel" aria-hidden="true"
data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog modal-lg">
    <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
        <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
            <h5 class="m-4 text-uppercase text-center">¿Seguro que quieres eliminar el contrato?</h5>
                <input type="hidden" id="eliminar-idPropiedadVe">
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

    ////////////////////////////BUSCADOR/////////////////////////
    $("#buscador_contratos").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tablaUa tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    // Mostrar el modal si hay un mensaje de éxito
    $(document).ready(function() {
    // Mostrar el modal de éxito si hay un mensaje de éxito en la sesión
    @if(session('success'))
        $('#successModal').modal('show');
    @endif

    // Manejar el clic en el botón de eliminar contrato
    $('.borrar-contrato-btn').click(function(e) {
        e.preventDefault(); // Evitar el comportamiento por defecto del enlace

        // Obtener el ID del contrato
        var contratoId = $(this).data('id');
        $('#ModalContrato').modal('show');


        // Confirmar la eliminación
        $('#confirmDelete').click(function(event) {
            // Realizar la solicitud AJAX
            $.ajax({
                url: '/elimicontra/' + contratoId, // Asegúrate de que esta URL sea correcta
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' // Agregar token CSRF para la seguridad
                },
                success: function(response) {
                    // alert('Contrato eliminado exitosamente.');
                    // Opcional: recargar la página o eliminar el elemento de la vista
                    // location.reload(); // Recargar la página
                    $('#ModalContrato').modal('hide');
                    $("#modalAlertaAgregar").modal('show');
                    $('#texto_success').text('El Contrato fue eliminado con éxito');

                },
                error: function(xhr) {
                    alert('Error al eliminar el contrato: ' + xhr.responseJSON.error);
                }
            });
        })
    });
    $("#btn-close").click(function() {
        $("#modalAlertaAgregar").modal('hide');
        location.reload();
    });
});






</script>
@endsection
