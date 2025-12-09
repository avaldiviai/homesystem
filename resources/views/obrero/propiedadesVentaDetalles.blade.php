@extends('layouts.app')

@section('content')
    <div class="container-fluid overflow-hidden" style="background-color: #FFAB40">
        <div class="row overflow-auto">
            @include('layouts.sidebar_obrero')
            <div class="col d-flex flex-column h-100" style="padding: 0; background-color: #FFAB40;">
                <div class="flex-grow-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8"
                                style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px; color: white;">
                                <h1>Detalles De La Propiedad</h1>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-check form-switch bg-dark d-flex align-items-center container p-2" 
                                    style="margin-top: 40px; margin-bottom: 30px; color: white; border-radius: .9rem;">
                                    <div class="col-lg-10">
                                        <div id="estado" class="text-uppercase m-0 ">Deshabilitado para editar</div> <!-- Texto a la izquierda -->
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-center justify-content-end">
                                        <input class="form-check-input m-2" type="checkbox" id="interruptor" 
                                        style="transform: scale(1.5); width: 40px; height: 17px;"> <!-- Checkbox a la derecha -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="direccionInput">Direccion</label>
                                <input type="text" id="direccionInput" class="form-control" disabled
                                    value="{{ $detalles->direccion }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="condominioInput">Condominio</label>
                                <input type="text" id="condominioInput" class="form-control" disabled
                                    value="{{ $detalles->condominio }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="tipoViviendaInput">Tipo de Vivienda</label>
                                <input type="text" id="tipoViviendaInput" class="form-control" disabled
                                    value="{{ $detalles->tipo_vivienda }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="numEstacionamientoInput">N° Estacionamientos</label>
                                <input type="text" id="numEstacionamientoInput" class="form-control" disabled
                                    value="{{ $detalles->num_estacionamiento }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="torreInput">Torre</label>
                                <input type="text" id="torreInput" class="form-control" disabled
                                    value="{{ $detalles->torre }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="nunmeroTorreInput">N° Torre</label>
                                <input type="text" id="nunmeroTorreInput" class="form-control" disabled
                                    value="{{ $detalles->num_torre }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="bodegaInput">Bodega</label>
                                <input type="text" id="bodegaInput" class="form-control" disabled
                                    value="{{ $detalles->bodega }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="rolInput">Rol</label>
                                <input type="text" id="rolInput" class="form-control" disabled
                                    value="{{ $detalles->rol }}">
                            </div>
                            <hr class="text-white">
                            <div class="col-lg-12 mb-1">
                                <strong>Servicios Basicos</strong>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="empresaLuzInput">Empresa de luz</label>
                                <input type="text" id="empresaLuzInput" class="form-control" disabled
                                    value="{{ $detalles->empresa_luz }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="empresaGasInput">Empresa de gas</label>
                                <input type="text" id="empresaGasInput" class="form-control" disabled
                                    value="{{ $detalles->empresa_gas }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="empresaAguaInput">Empresa de agua</label>
                                <input type="text" id="empresaAguaInput" class="form-control" disabled
                                    value="{{ $detalles->empresa_agua }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="numeroLuzInput">Numero de luz</label>
                                <input type="text" id="numeroLuzInput" class="form-control" disabled
                                    value="{{ $detalles->numero_luz }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="numeroGasInput">Numero de gas</label>
                                <input type="text" id="numeroGasInput" class="form-control" disabled
                                    value="{{ $detalles->numero_gas }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="numeroAguaInput">Numero de agua</label>
                                <input type="text" id="numeroAguaInput" class="form-control" disabled
                                    value="{{ $detalles->numero_agua }}">
                            </div>
                            <hr class="text-white mb-3">
                            <strong class="mb-1">Precio de la Propiedad</strong>
                            <div class="col-lg-4 mb-3">
                                <label for="precioInput">Precio</label>
                                <input type="text" id="precioInput" value="{{ $detalles->precio_venta }}"
                                    class="form-control">
                            </div>
                            <hr class="text-white mb-3">
                            <div class="col-lg-6 mb-3 text-center">
                                <strong class="mb-1">Ubicacion de la propiedad</strong>
                                <div class="d-flex justify-content-center ">
                                    {!! $detalles->maps !!}
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3 text-center">
                                <strong class="mb-1">Imágenes de la Propiedad</strong>
                                @if ($imagen && count($imagen) > 0)
                                    <div class="d-flex align-items-start">
                                        <!-- Miniaturas -->
                                        <div class="d-flex flex-column gap-2 me-3">
                                            @foreach ($imagen as $img)
                                                <img src="{{ asset($img->link) }}" class="rounded-3"
                                                    style="width: 70px; height: 70px; object-fit: cover; cursor: pointer;"
                                                    alt="Miniatura de la propiedad"
                                                    onclick="changeMainImage('{{ asset($img->link) }}')">
                                            @endforeach
                                        </div>
                                        <!-- Imagen principal -->
                                        <div>
                                            <img id="mainImage" src="{{ asset($imagen[0]->link) }}" class="img-fluid"
                                                style="width: 100%; max-height: 300px; object-fit: cover;"
                                                alt="Imagen de la propiedad">
                                        </div>
                                    </div>
                                @else
                                    <p>No hay imágenes disponibles.</p>
                                @endif
                            </div>
                            <hr class="text-white mb-3">
                            <strong class="mb-1">Detalles de la Propiedad</strong>
                            <div class="col-lg-3 mb-3">
                                <label for="añoConstruccionInput">Año de Construccion</label>
                                <input type="date" id="añoConstruccionInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->año_construccion ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="pisoInput">Piso</label>
                                <input type="number" id="pisoInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->piso ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="dormitoriosInput">Dormitorios</label>
                                <input type="number" id="dormitoriosInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->dormitorios ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="bañosInput">Baños</label>
                                <input type="number" id="bañosInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->baños ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="orientacionInput">Orientacion</label>
                                <input type="text" id="orien disabled tacionInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->orientacion ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="cocinaInput">Cocina</label>
                                <input type="text" id="cocinaInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->cocina ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="logiaInput">Logia</label>
                                <input type="text" id="logiaInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->logia ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="aguaCalienteInput">Agua Caliente</label>
                                <input type="text" id="aguaCalienteInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->agua_caliente ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="espacioLavadoraInput">Espacio para Lavadora</label>
                                <input type="text" id="espacioLavadoraInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->espacio_lavadora ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="lavadoraInput">Lavadora</label>
                                <input type="text" id="lavadoraInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->lavadora ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="inventarioInput">Inventario</label>
                                <input type="text" id="inventarioInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->inventario ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="mt2TotalInput">mt2 Total</label>
                                <input type="text" id="mt2TotalInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->mt2_total ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="mt2ConstruidoInput">mt2 Construido</label>
                                <input type="text" id="mt2ConstruidoInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->mt2_construido ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="mt2TerrazaInput">mt2 Terraza</label>
                                <input type="text" id="mt2TerrazaInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->mt2_terraza ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="esatcionamientoVisitasInput">Estacionamiento Visitas</label>
                                <input type="text" id="esatcionamientoVisitasInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->estacionamiento_visitas ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="ascensorInput">Ascensor</label>
                                <input type="text" id="ascensorInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->ascensor ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="juegosInfantilesInput">Juegos Infantiles</label>
                                <input type="text" id="juegosInfantilesInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->juegos_infantiles ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="lavanderiaInput">Lavanderia</label>
                                <input type="text" id="lavanderiaInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->lavanderia ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="quinchosInput">Quinchos</label>
                                <input type="text" id="quinchosInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->quinchos ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="salaMultiusoInput">Sala Multiuso</label>
                                <input type="text" id="salaMultiusoInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->sala_multiuso ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="gimnasioInput">Gimnasio</label>
                                <input type="text" id="gimnasioInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->gimnasio ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="cicloviaInput">Ciclovia</label>
                                <input type="text" id="cicloviaInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->ciclovia ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="gastoComunInput">Gasto Comun</label>
                                <input type="text" id="gastoComunInput" class="form-control" disabled
                                    value="{{ $detallePropiedad->gasto_comun ?? '' }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="descripcionInput">Descripcion</label>
                                <textarea class="form-control" id="descripcionInput" disabled>{{ $detallePropiedad->descripcion ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('javascript')
    @parent
    <script>
        document.getElementById('interruptor').addEventListener('change', function() {
            // Obtenemos todos los inputs y textareas en la página
            const inputs = document.querySelectorAll('input, textarea');
            const estado = document.getElementById('estado');

            // Recorremos todos los inputs y textareas y ajustamos su estado de acuerdo al interruptor
            inputs.forEach(input => {
                if (input.type !== 'checkbox' || input.id !== 'interruptor') {
                    input.disabled = !this.checked;
                }
            });

            // Actualizamos el texto del estado
            estado.textContent = this.checked ? 'Habilitado para editar' : 'Deshabilitado para editar';
        });

        //funcion js para cambio de imagen en detalles 
        function changeMainImage(src) {
            document.getElementById('mainImage').src = src;
        }
    </script>
@endsection
@section('css')
    @parent
    <style>
        /* Cambiar el color del checkbox cuando está activado */
        .form-check-input:checked {
            background-color: #198754 !important;
            /* Bootstrap verde (success) */
            border-color: #fff !important;
        }

        .form-check-input {
            background-color: #dc3545;
            /* Bootstrap rojo (danger) */
            /* border-color: #dc3545; */
            /* transition: background-color 0.3s, border-color 0.3s; Animación suave */
        }
    </style>
@endsection
