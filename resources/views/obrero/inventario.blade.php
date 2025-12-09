@extends('layouts.app')

@section('content')
<div class="container-fluid overflow-hidden" style="background-color:rgb(255, 255, 255)">
    <div class="row vh-100 overflow-auto">
        @include('layouts.sidebar_obrero')
        <div class="col d-flex flex-column h-100" style="padding: 0;">
            <div class="flex-grow-1">
                {{-- Título y Botón --}}
                <div class="container-fluid">
                    <div class="row align-items-center" style="margin-top: 40px;">
                        <div class="col-6" style="margin-bottom: 20px; margin-left: 30px; color: black; text-align: start;">
                            <h1 class="text-uppercase">Inventario</h1>
                        </div>
                        <div class="container-fluid">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-4 mb-2">
                                    <div class="input-group mx-2 shadow-lg" style="max-width: 400px;">
                                    <span class="input-group-text bg-primary text-white shadow-sm">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </span>
                                    <input type="text" id="buscador_cnn" placeholder="Buscar inventario" 
                                        class="form-control shadow-sm border-0" 
                                        style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                </div>                                
                            </div>
                                <div class="col-md-3 mb-2 text-end">
                                    <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#agregarModal">
                                        <span>AGREGAR </span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Modal para agregar nombre y foto --}}
                        <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="agregarModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="agregarModalLabel">Agregar Inventario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="agregar-inventario-form">
                                            <div class="form-group">
                                                <label for="nombre" class="text-black">Nombre del Inventario:</label>
                                                <input type="text" class="form-control" id="nombre" required placeholder="Nombre del Inventario">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion" class="text-black">Descripcion del Inventario:</label>
                                                <input type="text" class="form-control" id="descripcion" required  placeholder="Descripcion del Inventario">
                                            </div>
                                            <div class="form-group">
                                                <label for="foto" class="text-black">Selecciona una Imagen:</label>
                                                <input type="file" class="form-control" id="foto" accept="image/*" required>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary m2" onclick="agregarInventario()">Guardar</button>
                                        <button type="button" class="btn btn-danger m2" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tabla de Inventario --}}
                    <div class="container-fluid">
                        <h4 class="text-white">Lista de Inventarios</h4>
                        <div class="table-container tabla-scroll shadow-lg">
                            <table class="table table-striped-columns">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Descripcion</th>
                                        <th class="text-center">Imagen</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaInventario">
                                    @foreach ($inventarios as $inventario)
                                        <tr>
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            <td class="text-center align-middle">{{ $inventario->nombre }}</td>
                                            <td class="text-center align-middle">{{ $inventario->descripcion }}</td>
                                            <td class="text-center align-middle">
                                                <img src="{{ asset('storage/' . $inventario->foto) }}" alt="{{ $inventario->nombre }}" style="width: 100px; height: 100px; object-fit: cover;">
                                            </td>
                                            <td class="text-center align-middle">
                                                 <button class="btn btn-primary btn-sm" onclick="mostrarModalEditar({{ $inventario->id }}, '{{ $inventario->nombre }}', '{{ $inventario->descripcion }}', '{{ asset('storage/' . $inventario->foto) }}')">
                                                    <i class="fas fa-edit"></i> 
                                                </button>
                                                <button class="btn btn-danger btn-sm" onclick="eliminarInventario({{ $inventario->id }})">
                                                    <i class="fas fa-trash-alt"></i> 
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

    {{-- Modal de Éxito --}}
    <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="successLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
                <div class="modal-header alert alert-success" role="alert" style="border: none;">
                    <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000" style="width:70px;height:70px"></lord-icon>
                            </div>
                            <div class="col-8 d-flex justify-content-center align-items-center">
                                <p id="texto_success" class="text-uppercase">Datos Guardados con éxito</p>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn-close d-flex justify-content-end" id="close_success"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de Error --}}
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
                                <p id="texto_error" class="text-uppercase text-center m-0">Complete todos los datos.</p>
                            </div>
                            <div class="col-2 d-flex justify-content-end align-items-center">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_error"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para Editar Inventario --}}
    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Inventario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editar-inventario-form">
                        <input type="hidden" id="inventario_id">
                        <div class="form-group">
                            <label for="edit_nombre" class="text-black">Nombre del Inventario:</label>
                            <input type="text" class="form-control" id="edit_nombre" required placeholder="Nombre del Inventario">
                        </div>
                        <div class="form-group">
                            <label for="edit_descripcion" class="text-black">Descripcion del Inventario:</label>
                            <input type="text" class="form-control" id="edit_descripcion" required placeholder="Descripcion del Inventario">
                        </div>
                        <div class="form-group">
                            <label for="edit_foto" class="text-black">Selecciona una Imagen:</label>
                            <input type="file" class="form-control" id="edit_foto" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" onclick="guardarEdicion()">Guardar</button>
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
        });
        console.log('Listo para trabajar');

        ////////////////////////////BUSCADOR/////////////////////////
        $("#buscador_cnn").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tablaInventario tr").filter(function() {
                $(this).toggle($(this).find("td:eq(1)").text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Función para agregar inventario
        window.agregarInventario = function() {
            const nombre = $("#nombre").val();
            const descripcion = $("#descripcion").val();
            const foto = $("#foto")[0].files[0]; 
            const formData = new FormData(); 
            formData.append('nombre', nombre);            
            formData.append('descripcion', descripcion);
            formData.append('foto', foto);

            // Cambia la URL según la ruta actual
            const url = window.location.pathname.includes('/obrero') ? '/obrero/inventario' : '/inventario';

                $.ajax({
                    url: url,
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        $('#agregarModal').modal('hide');
                        $("#agregar-inventario-form")[0].reset();
                        $('#successModal').modal('show'); 
                        
                        // Recargar la página después de 2 segundos
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function(xhr) {
                        $('#modalerror').modal('show'); // Mostrar el modal de error
                    }
                });
            };
            window.mostrarModalEditar = function(id, nombre, descripcion, foto) {
            $('#inventario_id').val(id);
            $('#edit_nombre').val(nombre);
            $('#edit_descripcion').val(descripcion);

                console.log(id);

            // Opcional: Vista previa de la imagen
            const previewContainer = $('#edit_foto').parent();
            let imgPreview = previewContainer.find('.img-preview');
            if (!imgPreview.length) {
                imgPreview = $('<img class="img-preview" style="max-width: 20%; margin-top: 10px;">');
                previewContainer.append(imgPreview);
            }
            imgPreview.attr('src', foto);

            const modal = new bootstrap.Modal($('#editarModal'));
            modal.show();
        };

        window.guardarEdicion = function() {
    const id = $('#inventario_id').val();
    const nombre = $('#edit_nombre').val();
    const descripcion = $('#edit_descripcion').val();
    const foto = $('#edit_foto')[0].files[0];

    const formData = new FormData();
    formData.append('id', id);
    formData.append('nombre', nombre);
    formData.append('descripcion', descripcion);
    if (foto) formData.append('foto', foto);

    // Realizar la solicitud AJAX para actualizar el inventario
    $.ajax({
        url: `/obrero/inventario/${id}/update`,
        type: 'POST',
        data: formData,
        processData: false, // Evitar que jQuery procese los datos
        contentType: false, // Evitar que jQuery configure un tipo de contenido incorrecto
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data) {
            if (data.success) {
                // Cerrar el modal y actualizar la lista de inventarios
                const modal = bootstrap.Modal.getInstance(document.getElementById('editarModal'));
                modal.hide();
                // location.reload(); // Recargar la página para mostrar los cambios
                $('#successModal').modal('show');            
                $('#texto_success').text('Inventario editado correctamente.');
            } else {
                alert('Hubo un error al editar el inventario.');
            }
        },
        error: function(xhr, status, error) {
            alert('Error: ' + xhr.responseText || error);
        }
    });
}
$("#close_success").click(function() {
    $("#successModal").modal('hide');
    location.reload();
});

        window.eliminarInventario = function(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este inventario?')) {
                $.ajax({
                    url: '/obrero/inventario/' + id,
                    method: 'DELETE',
                    success: function(response) {
                        // Eliminar la fila correspondiente del inventario
                        $('#tablaInventario tr').each(function() {
                            if ($(this).find('td').first().text() == id) {
                                $(this).remove(); // Eliminar la fila
                            }
                        });

                        // Cambiar el mensaje del modal de éxito
                        $('#texto_success').text('Inventario eliminado correctamente.');
                        $('#successModal').modal('show');

                        // Recargar la página después de 2 segundos
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Ajusta el tiempo si es necesario
                    },
                    error: function(xhr) {
                        // Cambiar el mensaje del modal de error y mostrarlo
                        $('#texto_error').text('Hubo un error al eliminar el inventario. Por favor, inténtalo nuevamente.');
                        $('#modalerror').modal('show');
                    }
                });
            }
        };
    });
</script>
@endsection
