@extends('layouts.app')

@section('content')
<div class="container-fluid"  style="background-color:rgb(255, 255, 255)">
    <div class="row">
        @include('layouts.sidebar')
        <div class="col">
            <div class="containre-fluid">
                <div class="row overflow-auto" style="max-height: 100vh;">                    
                    <div class="col-lg-12" style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px; color: white;">
                        {{-- CAMBIO 0: Título actualizado --}}
                        <h1 class="text-uppercase text-center text-black">Propiedad Venta</h1>
                    </div>

                    {{-- ==================== DETALLES DE LA PROPIEDAD ==================== --}}
                    <div class="col-lg-12 text-white mb-3 p-4">
                        <div class="row shadow p-2" style="background-color:#E67E22; border-radius: .9rem;">
                            <div class="col-lg-12 mb-1">
                                <div class="col-lg-3 mb-3 bg-black rounded-pill text-center">
                                    <h4 class="mb-2">Detalles de la Propiedad</h4>
                                </div>
                            </div>

                            {{-- Precio Venta con switch CLP/UF --}}
                            <div class="col-lg-4 mb-3">
                                <label for="ventaedit">Precio Venta</label>
                                <div class="input-group">
                                    <input type="text"
                                        class="form-control"
                                        id="ventaedit"
                                        placeholder="Precio"
                                        value="{{$precios->venta}}"
                                        oninput="formatearMiles(this)"
                                        required>
                                    <div class="input-group-text p-1">
                                        <div class="custom-control custom-switch">
                                            {{-- CAMBIO 1: switch refleja valor guardado --}}
                                            <input type="checkbox"
                                                class="custom-control-input"
                                                id="switchUF"
                                                {{ ($precios->tipo_moneda ?? 'CLP') === 'UF' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="switchUF"></label>
                                            <span id="monedaTexto" class="ms-2 fw-bold">{{ $precios->tipo_moneda ?? 'CLP' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="tipo_moneda" value="{{ $precios->tipo_moneda ?? 'CLP' }}">
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label for="direccionedit">Dirección</label>
                                <input type="text" id="direccionedit" class="form-control" value="{{ $detalles->direccion }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="ciudadedit">Ciudad de la propiedad</label>
                                <input type="text" id="ciudadedit" class="form-control" value="{{ $detalles->ciudad }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="condominioedit">Condominio</label>
                                <input type="text" id="condominioedit" class="form-control" value="{{ $detalles->condominio }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="viviendaedit">Tipo de Vivienda</label>
                                <select name="viviendaedit" id="viviendaedit" class="form-select">
                                    <option value="" {{ is_null($detalles->tipo_vivienda) ? 'selected' : '' }}>Seleccione una opción</option>
                                    <option value="Casa" {{ $detalles->tipo_vivienda === 'Casa' ? 'selected' : '' }}>Casa</option>
                                    <option value="Departamento" {{ $detalles->tipo_vivienda === 'Departamento' ? 'selected' : '' }}>Departamento</option>
                                </select>
                            </div>
                            {{-- CAMBIO 2: Tipo de cocina eliminado --}}

                            <div class="col-lg-4 mb-3">
                                <label for="torreedit">Torre</label>
                                <input type="text" id="torreedit" class="form-control" value="{{ $detalles->torre }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="numero_torre">N° de Departamento</label>
                                <input type="text" id="numero_torre" class="form-control" value="{{ $detalles->num_torre }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="roledit">Rol</label>
                                <input type="text" id="roledit" class="form-control" value="{{ $detalles->rol }}">
                            </div>

                            {{-- CAMBIO 4: Deuda Hipotecaria con switch CLP/UF --}}
                            <div class="col-lg-4 mb-3">
                                <label for="deuda_hipotecariaedit">Deuda Hipotecaria</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="deuda_hipotecariaedit"
                                        value="{{ $detalles->deuda_hipotecaria }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                    <div class="input-group-text p-1">
                                        <input type="checkbox" id="switchDeuda"
                                            {{ ($detalles->tipo_moneda_deuda ?? 'CLP') === 'UF' ? 'checked' : '' }}>
                                        <span id="monedaDeuda" class="ms-2 fw-bold">{{ $detalles->tipo_moneda_deuda ?? 'CLP' }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- CAMBIO 5: Campo Institución --}}
                            <div class="col-lg-4 mb-3">
                                <label for="institucionedit">Institución</label>
                                <select id="institucionedit" class="form-select" onchange="toggleInstitucionOtro(this)">
                                    <option value="">Seleccione</option>
                                    <option value="Banco Estado" {{ ($detalles->institucion ?? '') == 'Banco Estado' ? 'selected' : '' }}>Banco Estado</option>
                                    <option value="Mercado Pago" {{ ($detalles->institucion ?? '') == 'Mercado Pago' ? 'selected' : '' }}>Mercado Pago</option>
                                    <option value="otro"         {{ ($detalles->institucion ?? '') !== '' && !in_array($detalles->institucion ?? '', ['Banco Estado','Mercado Pago']) ? 'selected' : '' }}>Otro</option>
                                </select>
                                <input type="text" id="institucion_otro" class="form-control mt-2"
                                    placeholder="Escriba la institución"
                                    value="{{ !in_array($detalles->institucion ?? '', ['Banco Estado','Mercado Pago','',null]) ? ($detalles->institucion ?? '') : '' }}"
                                    style="{{ in_array($detalles->institucion ?? '', ['Banco Estado','Mercado Pago','',null]) ? 'display:none' : '' }}">
                            </div>

                            {{-- Propietarios --}}
                            <div class="col-lg-4 mb-3">
                                <label for="propietarioInput">Propietarios</label>
                                <div class="d-flex justify-content-between">
                                    <select id="propietarioInput" class="form-select me-2">
                                        <option selected value="0">Seleccione un propietario</option>
                                        @foreach ($new_Propietarios as $propietario)
                                            <option value="{{ $propietario->id }}">{{ $propietario->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary" id="agregar-propietario">Agregar</button>
                                </div>
                                <ul class="text-uppercase mt-4 m-1 p-1 m-4" id="lista-agregados"></ul>
                            </div>

                            <div class="col-lg-6 mb-3 text-dark">
                                <div class="mb-3">
                                    <div class="row mb-3 p-2 mb-2 shadow" style="background-color: #FFE2B2; border-radius: .9rem;">
                                        <div class="col-lg-12">
                                            <div class="col-lg-6 bg-black rounded-pill shadow text-white text-center">
                                                {{-- CAMBIO 3: título cambiado --}}
                                                <h4>Propietario</h4>
                                            </div>
                                        </div>
                                        @foreach($propietarios as $prop)
                                        <div class="col-lg-6">
                                            <div class="input-group m-1">
                                                <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                                                <input type="text" id="propietarios" class="form-control" value="{{ $prop->propietario->nombre }}" readonly>
                                                <span class="input-group-text">
                                                    <a href="javascript:void(0)" data-id="{{$prop->id}}" class="delete-propietario">
                                                        <i class="fas fa-trash-alt fa-lg" style="color: red;"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ==================== ESTACIONAMIENTO ==================== --}}
                    <div class="col-lg-6 p-4">
                        <div class="row shadow text-white" style="background-color:#E67E22; border-radius: .9rem; height: auto;">
                            <div class="col-lg-12 mb-3">
                                <div class="p-3">
                                    <div class="text-center mb-3 col-lg-7 bg-black text-white rounded-pill shadow">
                                        <h4>Detalles del Estacionamiento</h4>
                                    </div>
                                    <div class="row mb-3">
                                        {{-- CAMBIO 6: Monto con switch CLP/UF --}}
                                        <div class="form-group col-lg-4">
                                            <label for="montoestedit">Monto</label>
                                            <div class="input-group mt-2">
                                                <input type="text" class="form-control" id="montoestedit"
                                                    placeholder="Sin Monto" value="{{ $sub_est->monto }}">
                                                <div class="input-group-text p-1">
                                                    <input type="checkbox" id="switchMontoEst"
                                                        {{ ($sub_est->moneda ?? 'CLP') === 'UF' ? 'checked' : '' }}>
                                                    <span id="monedaEst" class="ms-1 fw-bold">{{ $sub_est->moneda ?? 'CLP' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="rolestedit">Rol</label>
                                            <input type="text" class="form-control mt-2" id="rolestedit"
                                                placeholder="Sin Rol" value="{{ $sub_est->rol }}">
                                        </div>
                                        {{-- CAMBIO 7: label cambiado a N° Estacionamiento --}}
                                        <div class="form-group col-lg-4">
                                            <label for="estacionamientoedit">N° Estacionamiento</label>
                                            <input type="text" class="form-control mt-2" id="estacionamientoedit"
                                                placeholder="Sin N° Estacionamiento" value="{{ $sub_est->estacionamiento }}">
                                        </div>
                                    </div>
                                    <div class="text-center my-3">
                                        <label for="techadoCheck"><b>¿Tiene Techado?</b></label>
                                        <div class="mt-2">
                                            <input type="radio" name="techadoCheck" id="techadoSi" value="1"
                                                {{ isset($sub_est->techado) && $sub_est->techado == 1 ? 'checked' : '' }}>
                                            <label for="techadoSi">Sí</label>
                                            <input type="radio" name="techadoCheck" id="techadoNo" value="0"
                                                {{ isset($sub_est->techado) && $sub_est->techado == 0 ? 'checked' : '' }}>
                                            <label for="techadoNo">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ==================== BODEGA ==================== --}}
                    {{-- CAMBIO 8: mismos cambios en bodega --}}
                    <div class="col-lg-6 p-4">
                        <div class="row shadow text-white" style="background-color:#E67E22; border-radius: .9rem; height: auto;">
                            <div class="col-lg-12">
                                <div class="p-3">
                                    <div class="text-center mb-3 col-lg-6 bg-black text-white rounded-pill shadow">
                                        <h4>Detalles de la Bodega</h4>
                                    </div>
                                    <div class="row">
                                        {{-- Monto con switch CLP/UF --}}
                                        <div class="form-group col-lg-4">
                                            <label for="montoboedit">Monto</label>
                                            <div class="input-group mt-2">
                                                <input type="text" class="form-control" id="montoboedit"
                                                    placeholder="Sin Monto" value="{{ $sub_bodega->monto }}">
                                                <div class="input-group-text p-1">
                                                    <input type="checkbox" id="switchMontoBo"
                                                        {{ ($sub_bodega->moneda ?? 'CLP') === 'UF' ? 'checked' : '' }}>
                                                    <span id="monedaBo" class="ms-1 fw-bold">{{ $sub_bodega->moneda ?? 'CLP' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="rolboedit">Rol</label>
                                            <input type="text" class="form-control mt-2" id="rolboedit"
                                                placeholder="Sin Rol" value="{{ $sub_bodega->rol }}">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="bodegaedit">N° Bodega</label>
                                            <input type="text" class="form-control mt-2" id="bodegaedit"
                                                placeholder="Sin N° Bodega" value="{{ $sub_bodega->bodega }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ==================== MANTENIMIENTOS ==================== --}}
                    <div class="col-lg-12 p-4">
                        <div class="row p-4 shadow mt-2 text-white" style="background-color: #E67E22; border-radius: .9rem;">
                            <div class="text-center mb-3 col-lg-12">
                                <div class="col-lg-3 bg-black rounded-pill shadow text-white">
                                    <h4>Agregar Mantenimientos</h4>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="nombremantenimiento">Nombre del Mantenimiento</label>
                                <input type="text" class="form-control" id="nombremantenimiento" placeholder="Ingrese el nombre del mantenimiento" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="descripcionmantenimiento">Descripción</label>
                                <textarea class="form-control" id="descripcionmantenimiento" placeholder="Ingrese la descripción del mantenimiento" required></textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="mantenimiento">Fecha de Mantenimiento</label>
                                <input type="date" class="form-control" id="mantenimiento" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="cadamantenimiento">Cada Cuántos Meses</label>
                                <input type="number" class="form-control" id="cadamantenimiento" placeholder="Ingrese la cantidad de meses" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="mantenimientodoc">Agregar Documento</label>
                                <input type="file" class="form-control" id="mantenimientodoc" name="mantenciones[0][doc]">
                            </div>
                            <div class="col-lg-12 text-end">
                                <button type="button" data-id="{{$detalles->id}}" class="btn btn-primary" id="agregar-mantencion">Agregar Mantenimiento</button>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <table id="lista-man" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th><th>Nombre</th><th>Fecha de Mantención</th><th>Descripción</th><th>Documento</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Lista Mantenimientos --}}
                    <div class="col-lg-12 p-4 mb-3">
                        <div class="row p-3 shadow mt-2" style="background-color: #E67E22; border-radius: .9rem;">
                            <div class="text-center mb-3 col-lg-12">
                                <div class="col-lg-3 bg-black rounded-pill shadow text-white">
                                    <h4>Lista de Mantenimientos</h4>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th><th>Nombre</th><th>Descripcion</th>
                                            <th>Fecha de la Mantencion</th><th>Cada Cuantos Meses</th>
                                            <th>Proxima Mantencion</th><th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mantenimiento as $mante)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td><input type="text" class="form-control" value="{{$mante->nombre}}" id="nombreedit"></td>
                                                <td><textarea class="form-control" id="descripcioneditman">{{$mante->descripcion}}</textarea></td>
                                                <td><input type="date" class="form-control fechamanedit" value="{{$mante->fecha_mantencion}}" id="fechamanedit"></td>
                                                <td><input type="number" class="form-control mesesedit" value="{{$mante->meses}}" id="mesesedit"></td>
                                                <td><input type="date" class="form-control proximasfechaedit" value="{{$mante->fecha_prox_man}}" id="proximasfechaedit" readonly></td>
                                                <td style="display: none;"><input type="date" class="form-control" value="{{$mante->envio_correo}}" id="enviocorreoedit"></td>
                                                <td>
                                                    <a class="btn btn-danger btn_man_delete" data-id="{{$mante->id}}"><i class="fa-solid fa-trash-can"></i></a>
                                                    <a href="{{ asset('storage/' . $mante->doc) }}" target="_blank" download class="btn btn-primary ms-2"><i class="fas fa-download"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- ==================== CONTRIBUCIONES / CHECKS ==================== --}}
                    <div class="col-lg-12 col-md-12 p-4">
                        <div class="row shadow text-white" style="background-color:#E67E22; border-radius: .9rem; height: auto;">
                            <div class="col-lg-12 mb-3">
                                <div class="p-3">
                                    <div class="row">
                                        <div class="col-lg-3 mb-4">
                                            <label class="form-label w-100">Contribuciones</label>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check me-3">
                                                    <input type="radio" id="contribuciones_edit_yes" name="contribuciones_edit" class="form-check-input" value="1" {{ isset($detalles->contribuciones) && $detalles->contribuciones == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="contribuciones_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="contribuciones_edit_no" name="contribuciones_edit" class="form-check-input" value="0" {{ isset($detalles->contribuciones) && $detalles->contribuciones == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="contribuciones_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-4">
                                            <label class="form-label w-100">Derechos de Aseo</label>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check me-3">
                                                    <input type="radio" id="derechos_aseo_edit_yes" name="derechos_aseo_edit" class="form-check-input" value="1" {{ isset($detalles->derechos_aseo) && $detalles->derechos_aseo == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="derechos_aseo_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="derechos_aseo_edit_no" name="derechos_aseo_edit" class="form-check-input" value="0" {{ isset($detalles->derechos_aseo) && $detalles->derechos_aseo == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="derechos_aseo_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-4">
                                            <label class="form-label w-100">Exclusividad</label>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check me-3">
                                                    <input type="radio" id="exclusividad_edit_yes" name="exclusividad_edit" class="form-check-input" value="1" {{ isset($detalles->exclusividad) && $detalles->exclusividad == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="exclusividad_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="exclusividad_edit_no" name="exclusividad_edit" class="form-check-input" value="0" {{ isset($detalles->exclusividad) && $detalles->exclusividad == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="exclusividad_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-4">
                                            <label class="form-label w-100">Escritura</label>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check me-3">
                                                    <input type="radio" id="sello_verde_edit_yes" name="sello_verde_edit" class="form-check-input" value="1" {{ isset($detalles->sello_verde) && $detalles->sello_verde == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="sello_verde_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sello_verde_edit_no" name="sello_verde_edit" class="form-check-input" value="0" {{ isset($detalles->sello_verde) && $detalles->sello_verde == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="sello_verde_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Mapa --}}
                            <div class="col-lg-6 mt-4">
                                <div class="row p-4 shadow" style="background-color:#E67E22; border-radius: .9rem;">
                                    <div class="col-lg-7 mb-2 bg-black rounded-pill shadow text-white text-center">
                                        <h4 class="mb-2">Ubicación de la propiedad</h4>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-center mb-3">
                                            <div class="d-flex justify-content-center mt-1">
                                                {!! $detalles->maps !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mt-3">
                                        <div class="row p-3 shadow" style="background-color:#E67E22; border-radius: .9rem;">
                                            <div class="col-lg-4 mb-2 bg-black rounded-pill shadow text-white text-center">
                                                <h4 class="form-label">Editar Mapa</h4>
                                            </div>
                                            <div class="mapa mt-2 mb-3">
                                                <input type="text" class="form-control" value="{{$detalles->maps}}"
                                                    placeholder='Ej: <iframe src="..." frameborder="0"></iframe>'
                                                    id="mapaedit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Servicios Básicos --}}
                            <div class="col-lg-6 p-4 mb-3">
                                <div class="row p-2 shadow" style="background-color:#E67E22; border-radius: .9rem;">
                                    <div class="col-lg-12">
                                        <div class="col-lg-5 mb-3 bg-black rounded-pill shadow text-white text-center">
                                            <h4>Servicios Básicos</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-3 mb-3">
                                        <div class="form-group p-3" style="background-color:#F5DEB3; border-radius: .9rem;">
                                            <label for="luzedit">Empresa de luz</label>
                                            <input type="text" id="luzedit" class="form-control" value="{{$detalles->empresa_luz}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-3 mb-3">
                                        <div class="form-group p-3" style="background-color:#F5DEB3; border-radius: .9rem;">
                                            <label for="numero_luzedit">Número de luz</label>
                                            <input type="text" id="numero_luzedit" class="form-control" value="{{$detalles->numero_luz}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-3 mb-3">
                                        <div class="form-group p-3" style="background-color:#F5DEB3; border-radius: .9rem;">
                                            <label for="gasedit">Empresa de gas</label>
                                            <input type="text" id="gasedit" class="form-control" value="{{$detalles->empresa_gas}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-3 mb-3">
                                        <div class="form-group p-3" style="background-color:#F5DEB3; border-radius: .9rem;">
                                            <label for="numero_gasedit">Número de gas</label>
                                            <input type="text" id="numero_gasedit" class="form-control" value="{{$detalles->numero_gas}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-3 mb-3">
                                        <div class="form-group p-3" style="background-color:#F5DEB3; border-radius: .9rem;">
                                            <label for="aguaedit">Empresa de agua</label>
                                            <input type="text" id="aguaedit" class="form-control" value="{{$detalles->empresa_agua}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-3 mb-3">
                                        <div class="form-group p-3" style="background-color:#F5DEB3; border-radius: .9rem;">
                                            <label for="numero_aguaedit">Número de agua</label>
                                            <input type="text" id="numero_aguaedit" class="form-control" value="{{$detalles->numero_agua}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ==================== IMÁGENES Y VIDEOS ==================== --}}
                        <div class="row mt-3">
                            {{-- CAMBIO 9: Imágenes --}}
                            <div class="col-lg-6 mt-3">
                                <div class="row p-3 shadow text-white" style="background-color:#E67E22; border-radius: .9rem;">
                                    <div class="mb-3">
                                        <div class="p-2 text-center">
                                            <div class="col-lg-7 mb-2 bg-black rounded-pill shadow text-white text-center">
                                                <h4 class="form-label">Imágenes de la propiedad</h4>
                                            </div>
                                            @if ($imagen && $imagen->count() > 0)
                                                <div class="d-flex flex-wrap align-items-center justify-content-center" style="max-height: 400px; overflow-y: auto;">
                                                    @foreach ($imagen as $img)
                                                        <div class="position-relative m-1">
                                                            <img src="{{ asset($img->link) }}" class="rounded"
                                                                style="width: 150px; height: 217px; object-fit: cover;"
                                                                alt="{{ $detalles->direccion }}">
                                                            <div class="position-absolute"
                                                                style="top: 10px; right: 10px; display: flex; gap: 5px; background: rgba(255,255,255,0.8); border-radius: 50px; padding: 15px;">
                                                                <a href="javascript:void(0)" data-id="{{ $img->id }}"
                                                                    class="d-flex align-items-center portada">
                                                                    <i class="fas fa-check fa-lg" style="color: green;"></i>
                                                                </a>
                                                                <a href="javascript:void(0)" data-id="{{ $img->id }}"
                                                                    class="d-flex align-items-center delete-img">
                                                                    <i class="fas fa-trash-alt fa-lg" style="color: red;"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p>No hay imágenes disponibles.</p>
                                            @endif
                                            <div class="form-group mb-3 mt-4">
                                                <div class="col-lg-6 mb-2 bg-black rounded-pill shadow text-white text-center">
                                                    <h4 class="form-label">Agregar Imágenes</h4>
                                                </div>
                                                <div class="upload-container">
                                                    <div id="drop-area" class="drop-area">
                                                        <p>Arrastra y suelta las imágenes aquí</p>
                                                        <input class="form-control" type="file" id="imagenes" multiple required style="display: none;">
                                                    </div>
                                                    <div id="preview" class="d-flex flex-wrap justify-content-center mt-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- CAMBIO 4 APLICADO: Video drop area mejorada --}}
                            <div class="col-lg-6 mt-3">
                                <div class="row p-3 shadow text-white" style="background-color:#E67E22; border-radius: .9rem;">
                                    <div class="col-lg-12">
                            
                                        {{-- Videos existentes --}}
                                        <div class="col-lg-6 bg-black rounded-pill shadow text-white text-center mb-3">
                                            <h4>Video de la propiedad</h4>
                                        </div>
                            
                                        @php
                                            $videosVenta = \App\Models\VidArriendo::where('id_propiedad', $detalles->id)->get();
                                        @endphp
                            
                                        @if($videosVenta->count() > 0)
                                            <div class="d-flex flex-wrap align-items-center justify-content-center mb-3"
                                                style="max-height: 300px; overflow-y: auto;"
                                                id="lista-videos-venta">
                                                @foreach($videosVenta as $vid)
                                                    <div class="position-relative m-2" id="video-item-{{ $vid->id }}">
                                                        <video controls style="width:200px; height:150px; object-fit:cover; border-radius:8px;">
                                                            <source src="{{ asset(ltrim($vid->video, '/')) }}" type="video/mp4">
                                                            Tu navegador no soporta el video.
                                                        </video>
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm position-absolute btn-eliminar-video-venta"
                                                            data-id="{{ $vid->id }}"
                                                            style="top:5px; right:5px; padding:2px 6px;">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div id="lista-videos-venta" class="d-flex flex-wrap align-items-center justify-content-center mb-3">
                                                <p class="text-white-50 small">No hay videos agregados.</p>
                                            </div>
                                        @endif
                            
                                        {{-- Agregar nuevo video --}}
                                        <div class="col-lg-6 bg-black rounded-pill shadow text-white text-center mb-2">
                                            <h4>Agregar Video</h4>
                                        </div>
                            
                                        <div id="video-drop-area-venta"
                                            class="form-control p-4 d-flex flex-column align-items-center justify-content-center text-center"
                                            style="height:auto; min-height:120px; border:2px dashed #000; border-radius:10px;
                                                background-color:rgba(249,249,249,0); cursor:pointer;"
                                            ondragover="event.preventDefault(); this.style.borderColor='#0d6efd';"
                                            ondragleave="this.style.borderColor='#000';"
                                            ondrop="handleVideoDropVenta(event)">
                                            <i class="fas fa-film fa-2x mb-2" style="opacity:0.5;"></i>
                                            <p class="mb-1">Arrastra tu video aquí o haz clic para seleccionar</p>
                                            <p class="small mb-0" style="opacity:0.7;">MP4, AVI, MOV, MKV — máx 500 MB</p>
                                            <div id="video-preview-info-venta" class="mt-2" style="display:none;">
                                                <span class="badge bg-success" id="video-filename-venta"></span>
                                            </div>
                                        </div>
                                        <input type="file" id="videos_venta_input" accept="video/*"
                                            style="display:none;" onchange="subirVideoVenta(this)">
                            
                                        {{-- Barra de progreso --}}
                                        <div id="video-progress-wrapper-venta" style="display:none; margin-top:8px;">
                                            <div style="background:#e9ecef; border-radius:5px; overflow:hidden;">
                                                <div id="video-progress-bar-venta"
                                                    style="height:25px; width:0%; background:#007bff; text-align:center;
                                                            color:white; line-height:25px; transition:width 0.3s ease;">0%</div>
                                            </div>
                                        </div>
                            
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ==================== DETALLES AGREGADOS ==================== --}}
                        <div class="row mt-3">
                            <div class="col-lg-6 p-4">
                                <div class="row shadow p-3 text-white" style="background-color:#E67E22; border-radius: .9rem;">
                                    <div class="col-lg-12 mb-2">
                                        <div class="col-lg-6 bg-black rounded-pill shadow text-white text-center">
                                            <h4 class="mb-2">Detalles Agregados</h4>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="ano_construccion_edit">Año de Construcción</label>
                                        <select id="ano_construccion_edit" class="form-control" required>
                                            <option value="">Seleccione año</option>
                                            @for ($y = date('Y'); $y >= 1970; $y--)
                                                <option value="{{ $y }}" {{ $detallespropiedad->ano_construccion == $y ? 'selected' : '' }}>{{ $y }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="piso_edit">Piso</label>
                                        <input type="text" id="piso_edit" placeholder="Eje: 1" class="form-control" value="{{ $detallespropiedad->piso }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="dormitorios_edit">Dormitorios</label>
                                        <input type="text" id="dormitorios_edit" placeholder="Eje: 2" class="form-control" value="{{ $detallespropiedad->dormitorios }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="banos_edit">Baños</label>
                                        <input type="text" id="banos_edit" placeholder="Eje: 1" class="form-control" value="{{ $detallespropiedad->banos }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 mt-3">
                                {{-- Selectores --}}
                                <div class="row shadow p-2 text-white mb-4" style="background-color: #E67E22; border-radius: .9rem;">
                                    <div class="col-lg-12 mb-2">
                                        <div class="col-lg-3 bg-black rounded-pill shadow text-white text-center">
                                            <h4 class="mb-2">Detalles Agregados</h4>
                                        </div>
                                    </div>
                                    {{-- CAMBIO 10: Orientación con nuevas opciones --}}
                                    <div class="col-lg-3 mb-3">
                                        <label for="orientacion_edit">Orientación</label>
                                        <select name="orientacion_edit" id="orientacion_edit" class="form-select">
                                            <option value="" {{ is_null($detallespropiedad->orientacion) ? 'selected' : '' }}>Seleccione una opción</option>
                                            <option value="N"  {{ $detallespropiedad->orientacion === 'N'  ? 'selected' : '' }}>Norte</option>
                                            <option value="S"  {{ $detallespropiedad->orientacion === 'S'  ? 'selected' : '' }}>Sur</option>
                                            <option value="E"  {{ $detallespropiedad->orientacion === 'E'  ? 'selected' : '' }}>Oriente</option>
                                            <option value="O"  {{ $detallespropiedad->orientacion === 'O'  ? 'selected' : '' }}>Poniente</option>
                                            <option value="NO" {{ $detallespropiedad->orientacion === 'NO' ? 'selected' : '' }}>Norponiente</option>
                                            <option value="NE" {{ $detallespropiedad->orientacion === 'NE' ? 'selected' : '' }}>Nororiente</option>
                                            <option value="SO" {{ $detallespropiedad->orientacion === 'SO' ? 'selected' : '' }}>Surponiente</option>
                                            <option value="SE" {{ $detallespropiedad->orientacion === 'SE' ? 'selected' : '' }}>Suroriente</option>
                                        </select>
                                    </div>
                                    {{-- CAMBIO 11: título cambiado a "Conexión de Cocina" --}}
                                    <div class="col-lg-3 mb-3">
                                        <label for="cocina_edit">Conexión de Cocina</label>
                                        <select name="cocina_edit" id="cocina_edit" class="form-select">
                                            <option value="" {{ is_null($detallespropiedad->cocina) ? 'selected' : '' }}>Seleccione una opción</option>
                                            <option value="Eléctrica"    {{ $detallespropiedad->cocina === 'Eléctrica'    ? 'selected' : '' }}>Conexión eléctrica</option>
                                            <option value="Gas"          {{ $detallespropiedad->cocina === 'Gas'          ? 'selected' : '' }}>Gas cilindro</option>
                                            <option value="Conexión Gas" {{ $detallespropiedad->cocina === 'Conexión Gas' ? 'selected' : '' }}>Conexión cañería</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <label for="logia_edit">Logia</label>
                                        <select name="logia_edit" id="logia_edit" class="form-select">
                                            <option value="" {{ is_null($detallespropiedad->logia) ? 'selected' : '' }}>Seleccione una opción</option>
                                            <option value="1" {{ $detallespropiedad->logia === '1' ? 'selected' : '' }}>Si</option>
                                            <option value="2" {{ $detallespropiedad->logia === '2' ? 'selected' : '' }}>No</option>
                                            <option value="3" {{ $detallespropiedad->logia === '3' ? 'selected' : '' }}>Conexión para lavadora</option>
                                        </select>
                                    </div>
                                    {{-- CAMBIO 12: "Termo" → "Termo" --}}
                                    <div class="col-lg-3 mb-3">
                                        <label for="agua_caliente_edit">Agua Caliente</label>
                                        <select name="agua_caliente_edit" id="agua_caliente_edit" class="form-select">
                                            <option value="" {{ is_null($detallespropiedad->agua_caliente) ? 'selected' : '' }}>Seleccione una opción</option>
                                            <option value="Calefont" {{ $detallespropiedad->agua_caliente === 'Calefont' ? 'selected' : '' }}>Calefont</option>
                                            <option value="Termo"    {{ $detallespropiedad->agua_caliente === 'Termo'    ? 'selected' : '' }}>Termo</option>
                                            <option value="Caldera"  {{ $detallespropiedad->agua_caliente === 'Caldera'  ? 'selected' : '' }}>Caldera</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Detalles adicionales --}}
                                <div class="row shadow p-2 text-white" style="background-color: #E67E22; border-radius: .9rem;">
                                    <div class="col-lg-12 mb-2">
                                        <div class="col-lg-3 bg-black rounded-pill shadow text-white text-center">
                                            <h4 class="mb-2">Detalles Agregados</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <label for="mt2_construido_edit">Mt2 Construido</label>
                                        <input type="text" id="mt2_construido_edit" placeholder="Mt2 Construidos" class="form-control" value="{{ $detallespropiedad->mt2_construido }}">
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <label for="mt2_terraza_edit">Mt2 Terraza</label>
                                        <input type="text" id="mt2_terraza_edit" placeholder="Mt2 Terraza" class="form-control" value="{{ $detallespropiedad->mt2_terraza }}">
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <label for="mt2_total_edit">Mt2 Total</label>
                                        <input type="text" id="mt2_total_edit" placeholder="Mt2 Total" class="form-control" value="{{ $detallespropiedad->mt2_total }}">
                                    </div>
                                    {{-- CAMBIO 13: Estacionamiento de Visita eliminado --}}
                                    <!--<div class="col-lg-3 mb-3">
                                        <label for="inventario_edit">Inventario (texto)</label>
                                        <textarea id="inventario_edit" placeholder="Inventario" class="form-control">{{ $detallespropiedad->inventario }}</textarea>
                                    </div> -->
                                    {{-- CAMBIO 14: Inventario acepta PDF y Word --}}
                                    
                                    
                                    {{-- Inventario (documento) — botón de guardar inmediato --}}
                                    <div class="col-lg-3 mb-3">
                                        <label class="text-white fw-bold">Inventario (documento)</label>
                                        <div class="d-flex gap-2 mb-2">
                                            <input type="file" id="doc_inventario_venta" class="form-control" accept=".pdf,.doc,.docx">
                                            <button type="button" class="btn btn-success"
                                                onclick="subirInventarioVenta({{ $detalles->id }})">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </div>
                                        <div id="preview_inventario_venta">
                                            @php $docArch = \App\Models\ArchivoPropiedad::where('id_propiedad', $detalles->id)->first(); @endphp
                                            @if(!empty($docArch?->inventario))
                                                <a href="{{ asset(ltrim($docArch->inventario, '/')) }}" target="_blank"
                                                class="btn btn-sm btn-light">
                                                    <i class="fas fa-file-alt me-1"></i>Ver inventario actual
                                                </a>
                                            @else
                                                <span class="text-white-50 small">Sin documento</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <label for="gasto_comun_edit">Gasto Común</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="gasto_comun_edit" placeholder="Gasto Común"
                                                value="{{ $detallespropiedad->gasto_comun }}"
                                                oninput="this.value = '$' + this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <label for="descripcion_edit">Descripción</label>
                                        <textarea id="descripcion_edit" placeholder="Descripción" class="form-control">{{ $detallespropiedad->descripcion }}</textarea>
                                    </div>

                                    {{-- CAMBIO 15: Documentos adicionales --}}
                                    <div class="col-lg-6 mb-3">
                                        <label class="text-white fw-bold">Documentos Adicionales</label>
                                        <div class="d-flex gap-2 mb-2">
                                            <input type="file" id="doc_adicional_venta" class="form-control" accept=".pdf,.doc,.docx">
                                            <button type="button" class="btn btn-success"
                                                onclick="subirDocumentoVenta({{ $detalles->id }})">
                                                <i class="fas fa-save"></i> Agregar
                                            </button>
                                        </div>
                                        <small class="text-white-50">Haz clic en "Agregar" para subir cada documento</small>
                                    
                                        {{-- Lista de documentos adicionales existentes --}}
                                        <div id="lista-documentos-venta" class="mt-2">
                                            @php
                                                $docsAdicionales = \App\Models\ArchivoPropiedad::where('id_propiedad', $detalles->id)
                                                    ->whereNotNull('archivo')
                                                    ->get();
                                            @endphp
                                            @foreach($docsAdicionales as $doc)
                                                <div class="d-flex align-items-center gap-2 mb-1" id="doc-item-{{ $doc->id }}">
                                                    <a href="{{ asset(ltrim($doc->archivo, '/')) }}" target="_blank"
                                                    class="btn btn-sm btn-light flex-grow-1 text-start">
                                                        <i class="fas fa-file-alt me-1"></i>
                                                        {{ basename($doc->archivo) }}
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm btn-eliminar-doc-venta"
                                                        data-id="{{ $doc->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ==================== CHECKS ==================== --}}
                        <div class="row">
                            <div class="col-lg-12 col-ms-6 mt-3">
                                <div class="row p-2 shadow text-white" style="background-color:#E67E22; border-radius: .9rem;">
                                    <div class="col-lg-12 mb-2">
                                        <div class="col-lg-3 bg-black rounded-pill shadow text-white text-center">
                                            <h4 class="mb-2">Checks Agregados</h4>
                                        </div>
                                    </div>
                                    {{-- CAMBIO 16 y 17: Espacio para Lavadora y Lavadora eliminados --}}
                                    <div class="row w-100">
                                        <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                            <label class="form-label w-100 text-white">Ascensor</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="ascensor_edit_yes" name="ascensor_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->ascensor) && $detallespropiedad->ascensor == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="ascensor_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="ascensor_edit_no" name="ascensor_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->ascensor) && $detallespropiedad->ascensor == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="ascensor_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                            <label class="form-label w-100 text-white">Juegos Infantiles</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="juegos_infantiles_edit_yes" name="juegos_infantiles_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->juegos_infantiles) && $detallespropiedad->juegos_infantiles == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="juegos_infantiles_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="juegos_infantiles_edit_no" name="juegos_infantiles_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->juegos_infantiles) && $detallespropiedad->juegos_infantiles == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="juegos_infantiles_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                            <label class="form-label w-100 text-white">Lavandería</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="lavanderia_edit_yes" name="lavanderia_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->lavanderia) && $detallespropiedad->lavanderia == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="lavanderia_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="lavanderia_edit_no" name="lavanderia_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->lavanderia) && $detallespropiedad->lavanderia == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="lavanderia_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row w-100">
                                        <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                            <label class="form-label w-100 text-white">Quinchos</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="quinchos_edit_yes" name="quinchos_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->quinchos) && $detallespropiedad->quinchos == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="quinchos_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="quinchos_edit_no" name="quinchos_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->quinchos) && $detallespropiedad->quinchos == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="quinchos_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                            <label class="form-label w-100 text-white">Sala Multiuso</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="sala_multiuso_edit_yes" name="sala_multiuso_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->sala_multiuso) && $detallespropiedad->sala_multiuso == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="sala_multiuso_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="sala_multiuso_edit_no" name="sala_multiuso_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->sala_multiuso) && $detallespropiedad->sala_multiuso == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="sala_multiuso_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                            <label class="form-label w-100 text-white">Gimnasio</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="gimnasio_edit_yes" name="gimnasio_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->gimnasio) && $detallespropiedad->gimnasio == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="gimnasio_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="gimnasio_edit_no" name="gimnasio_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->gimnasio) && $detallespropiedad->gimnasio == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="gimnasio_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row w-100">
                                        <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                            <label class="form-label w-100 text-white">Ciclovía</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="ciclovia_edit_yes" name="ciclovia_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->ciclovia) && $detallespropiedad->ciclovia == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="ciclovia_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="ciclovia_edit_no" name="ciclovia_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->ciclovia) && $detallespropiedad->ciclovia == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="ciclovia_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                            <label class="form-label w-100 text-white">Piscina</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="piscina_edit_yes" name="piscina_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->piscina) && $detallespropiedad->piscina == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="piscina_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="piscina_edit_no" name="piscina_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->piscina) && $detallespropiedad->piscina == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="piscina_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                            <label class="form-label w-100 text-white">Áreas Verdes</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="verde_edit_yes" name="verde_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->area_verde) && $detallespropiedad->area_verde == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="verde_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="verde_edit_no" name="verde_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->area_verde) && $detallespropiedad->area_verde == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="verde_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- CAMBIO 18: Conserjería agregada --}}
                                    <div class="row w-100">
                                        <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                            <label class="form-label w-100 text-white">Conserjería</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="conserjeria_edit_yes" name="conserjeria_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->conserjeria) && $detallespropiedad->conserjeria == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="conserjeria_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="conserjeria_edit_no" name="conserjeria_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->conserjeria) && $detallespropiedad->conserjeria == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="conserjeria_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3 mt-3 d-flex justify-content-end">
                            <a href="/propiedadesVenta" class="btn btn-danger m-1">Volver</a>
                            <button class="btn btn-primary m-1" data-id="{{$detalles->id}}" id="guardarCambios">Guardar Edición</button>
                        </div>
                    </div>

                    {{-- Loading overlay --}}
                    <div id="loadingOverlay" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.6);z-index:1050;justify-content:center;align-items:center;color:white;font-size:20px;font-weight:bold;">
                        <div class="spinner-border text-light" role="status"></div>
                        <span class="ms-2">Guardando, por favor espera...</span>
                    </div>

                    {{-- Modal éxito --}}
                    <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" style="background: rgba(0,0,0,0.0); border: none; width: 700px;">
                                <div class="modal-header alert alert-success" role="alert" style="border: none;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-2">
                                                <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000" style="width:70px;height:70px"></lord-icon>
                                            </div>
                                            <div class="col-8 d-flex justify-content-center align-items-center">
                                                <p id="texto_success" class="text-uppercase"></p>
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
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal info eliminar --}}
<div class="modal fade" id="modalinfo" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                <h5 class="m-4 text-uppercase text-center" id="text-info"></h5>
                <div class="modalfooter d-flex justify-content-center">
                    <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="confirmDelete" class="btn btn-secondary m-2">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal portada --}}
<div class="modal fade" id="portada" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                <h5 class="m-4 text-uppercase text-center" id="text-info-portada"></h5>
                <div class="modalfooter d-flex justify-content-center">
                    <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="confirmCambio" class="btn btn-warning m-2">Cambiar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript')
@parent
<script>
// ==================== SWITCHES CLP/UF ====================
let tipoMoneda = "{{ $precios->tipo_moneda ?? 'CLP' }}";
$("#switchUF").on("change", function () {
    tipoMoneda = this.checked ? 'UF' : 'CLP';
    $("#monedaTexto").text(tipoMoneda);
});
 
let tipoMonedaDeuda = "{{ $detalles->tipo_moneda_deuda ?? 'CLP' }}";
$("#switchDeuda").on("change", function () {
    tipoMonedaDeuda = this.checked ? 'UF' : 'CLP';
    $("#monedaDeuda").text(tipoMonedaDeuda);
});
 
let monedaEst = "{{ $sub_est->moneda ?? 'CLP' }}";
let monedaBo  = "{{ $sub_bodega->moneda ?? 'CLP' }}";
$("#switchMontoEst").on("change", function () { monedaEst = this.checked ? 'UF' : 'CLP'; $("#monedaEst").text(monedaEst); });
$("#switchMontoBo").on("change",  function () { monedaBo  = this.checked ? 'UF' : 'CLP'; $("#monedaBo").text(monedaBo); });
 
function toggleInstitucionOtro(sel) {
    document.getElementById('institucion_otro').style.display = sel.value === 'otro' ? 'block' : 'none';
}
 
// ==================== PROPIETARIOS ====================
var PropietariosAgregados = [];
var lista = $("#lista-agregados");
 
$("#agregar-propietario").on('click', function(event) {
    event.preventDefault();
    var propietarioId = $("#propietarioInput").val();
    if (propietarioId && propietarioId !== '0') {
        PropietariosAgregados.push({ id: propietarioId });
        $("#propietarioInput option[value='" + propietarioId + "']").prop('disabled', true);
        $("#propietarioInput").val('0');
        actualizarLista();
    } else {
        alert("Por favor, seleccione un propietario.");
    }
});
 
function actualizarLista() {
    lista.empty();
    $.each(PropietariosAgregados, function(index, propietarios) {
        $.ajax({
            url: '/obtener/propietarioNombre',
            type: 'GET',
            data: { nombre_pro: propietarios.id },
            success: function(response) {
                var listItem = $("<li>")
                    .html('<i class="fa-solid fa-user-tie"></i> ' + response.nombre)
                    .append(
                        $("<button>").html('<i class="fas fa-trash-alt fa-lg text-danger"></i>')
                        .addClass("btn btn-sm ms-2 m-1")
                        .on('click', function() { eliminarPropietario(index); })
                    );
                lista.append(listItem);
            }
        });
    });
}
 
function eliminarPropietario(index) {
    var propietario = PropietariosAgregados[index];
    $("#propietarioInput option[value='" + propietario.id + "']").prop('disabled', false);
    PropietariosAgregados.splice(index, 1);
    actualizarLista();
}
 
// ==================== DROP AREA IMÁGENES ====================
const dropArea  = document.getElementById('drop-area');
const fileInput = document.getElementById('imagenes');
const preview   = document.getElementById('preview');
const addedImages = new Set();
 
dropArea.addEventListener('click', () => fileInput.click());
 
function handleFiles(files) {
    Array.from(files).forEach(file => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => {
                if (!addedImages.has(e.target.result)) {
                    addedImages.add(e.target.result);
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    preview.appendChild(img);
                }
            };
            reader.readAsDataURL(file);
        }
    });
}
fileInput.addEventListener('change', () => handleFiles(fileInput.files));
dropArea.addEventListener('dragover', (e) => { e.preventDefault(); dropArea.style.backgroundColor = '#f8d7da'; });
dropArea.addEventListener('dragleave', () => { dropArea.style.backgroundColor = ''; });
dropArea.addEventListener('drop', (e) => { e.preventDefault(); dropArea.style.backgroundColor = ''; handleFiles(e.dataTransfer.files); });
 
// ==================== VIDEO VENTA ====================
document.getElementById('video-drop-area-venta').addEventListener('click', function () {
    document.getElementById('videos_venta_input').click(); // ← ID correcto
});
 
function handleVideoDropVenta(event) {
    event.preventDefault();
    document.getElementById('video-drop-area-venta').style.borderColor = '#000';
    var files = event.dataTransfer.files;
    if (files.length && files[0].type.startsWith('video/')) {
        var input = document.getElementById('videos_venta_input');
        var dt = new DataTransfer();
        dt.items.add(files[0]);
        input.files = dt.files;
        subirVideoVenta(input);
    } else {
        alert('Por favor sube un archivo de video válido (MP4, AVI, MOV, etc.)');
    }
}
 
function subirVideoVenta(input) {
    if (!input.files || !input.files[0]) return;
 
    var file = input.files[0];
    var mb   = (file.size / 1024 / 1024).toFixed(1);
 
    document.getElementById('video-filename-venta').textContent = file.name + ' (' + mb + ' MB)';
    document.getElementById('video-preview-info-venta').style.display = 'block';
    document.getElementById('video-progress-wrapper-venta').style.display = 'block';
 
    var formData = new FormData();
    formData.append('videos', file);
    formData.append('Id', {{ $detalles->id }});
 
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/propiedad_venta_video', true);
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
 
    xhr.upload.onprogress = function (e) {
        if (e.lengthComputable) {
            var pct = Math.round((e.loaded / e.total) * 100);
            var bar = document.getElementById('video-progress-bar-venta');
            bar.style.width = pct + '%';
            bar.textContent = pct + '%';
        }
    };
 
    xhr.onload = function () {
        var bar = document.getElementById('video-progress-bar-venta');
        if (xhr.status === 200) {
            var resp = JSON.parse(xhr.responseText);
            bar.style.background = '#28a745';
            bar.textContent = '✓ Guardado';
 
            document.getElementById('lista-videos-venta').insertAdjacentHTML('beforeend',
                '<div class="position-relative m-2" id="video-item-' + resp.id + '">' +
                    '<video controls style="width:200px;height:150px;object-fit:cover;border-radius:8px;">' +
                        '<source src="' + resp.url + '" type="video/mp4">' +
                    '</video>' +
                    '<button type="button" class="btn btn-danger btn-sm position-absolute btn-eliminar-video-venta"' +
                        ' data-id="' + resp.id + '" style="top:5px;right:5px;padding:2px 6px;">' +
                        '<i class="fas fa-trash-alt"></i>' +
                    '</button>' +
                '</div>'
            );
 
            setTimeout(function () {
                bar.style.width = '0%';
                bar.style.background = '#007bff';
                bar.textContent = '0%';
                document.getElementById('video-progress-wrapper-venta').style.display = 'none';
                document.getElementById('video-preview-info-venta').style.display = 'none';
            }, 2000);
 
        } else {
            bar.style.background = '#dc3545';
            bar.textContent = 'Error al subir';
            alert('Error al guardar el video.');
        }
    };
 
    xhr.onerror = function () { alert('Error de red al subir el video.'); };
    xhr.send(formData);
}
 
// Eliminar video venta
$(document).on('click', '.btn-eliminar-video-venta', function () {
    var id   = $(this).data('id');
    var item = $(this).closest('.position-relative');
    if (!confirm('¿Seguro que quieres eliminar este video?')) return;
    $.ajax({
        url: '/video_venta/' + id,
        type: 'DELETE',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function () {
            item.remove();
            $("#successModal").modal('show');
            $('#texto_success').text('Video eliminado correctamente');
        },
        error: function () { alert('Error al eliminar el video.'); }
    });
});
 
// ==================== INVENTARIO VENTA ====================
function subirInventarioVenta(idPropiedad) {
    var input = document.getElementById('doc_inventario_venta');
    if (!input.files[0]) { alert('Selecciona un archivo primero.'); return; }
 
    var file     = input.files[0];
    var formData = new FormData();
    formData.append('inventario', file);
 
    $.ajax({
        url: '/propiedad_venta_inventario/' + idPropiedad,
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (resp) {
            document.getElementById('preview_inventario_venta').innerHTML =
                '<a href="' + resp.url + '" target="_blank" class="btn btn-sm btn-light">' +
                    '<i class="fas fa-file-alt me-1"></i>' + resp.nombre +
                '</a>';
            $("#successModal").modal('show');
            $('#texto_success').text(resp.message);
        },
        error: function () { alert('Error al guardar el inventario.'); }
    });
}
 
// ==================== DOCUMENTOS ADICIONALES VENTA ====================
function subirDocumentoVenta(idPropiedad) {
    var input = document.getElementById('doc_adicional_venta');
    if (!input.files[0]) { alert('Selecciona un archivo primero.'); return; }
 
    var file     = input.files[0];
    var formData = new FormData();
    formData.append('documento', file);
 
    $.ajax({
        url: '/propiedad_venta_documento/' + idPropiedad,
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (resp) {
            document.getElementById('lista-documentos-venta').insertAdjacentHTML('beforeend',
                '<div class="d-flex align-items-center gap-2 mb-1" id="doc-item-' + resp.id + '">' +
                    '<a href="' + resp.url + '" target="_blank" class="btn btn-sm btn-light flex-grow-1 text-start">' +
                        '<i class="fas fa-file-alt me-1"></i>' + resp.nombre +
                    '</a>' +
                    '<button type="button" class="btn btn-danger btn-sm btn-eliminar-doc-venta"' +
                        ' data-id="' + resp.id + '">' +
                        '<i class="fas fa-trash-alt"></i>' +
                    '</button>' +
                '</div>'
            );
            input.value = '';
            $("#successModal").modal('show');
            $('#texto_success').text(resp.message);
        },
        error: function () { alert('Error al guardar el documento.'); }
    });
}
 
// Eliminar documento adicional
$(document).on('click', '.btn-eliminar-doc-venta', function () {
    var id   = $(this).data('id');
    var item = $(this).closest('div');
    if (!confirm('¿Seguro que quieres eliminar este documento?')) return;
    $.ajax({
        url: '/archivos/' + id,
        type: 'DELETE',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function () {
            item.remove();
            $("#successModal").modal('show');
            $('#texto_success').text('Documento eliminado correctamente');
        },
        error: function () { alert('Error al eliminar el documento.'); }
    });
});
 
// ==================== GUARDAR CAMBIOS ====================
$('#guardarCambios').off().on('click', function(event) {
    event.preventDefault();
    var id_propiedad = $(this).data('id');
 
    var institucion = $('#institucionedit').val() === 'otro'
        ? $('#institucion_otro').val()
        : $('#institucionedit').val();
 
    function getRadio(name) {
        var checked = $('input[name="' + name + '"]:checked');
        return checked.length ? checked.val() : null;
    }
 
    var formData = new FormData();
    formData.append('id_propiedad',      id_propiedad);
    formData.append('direccion',         $("#direccionedit").val());
    formData.append('ciudad',            $("#ciudadedit").val());
    formData.append('condominio',        $("#condominioedit").val());
    formData.append('tipo_vivienda',     $("#viviendaedit").val());
    formData.append('tipo_cocina',       '');
    formData.append('torre',             $("#torreedit").val());
    formData.append('numero_torre',      $("#numero_torre").val());
    formData.append('rol',               $("#roledit").val());
    formData.append('deuda_hipotecaria', $("#deuda_hipotecariaedit").val());
    formData.append('tipo_moneda_deuda', tipoMonedaDeuda);
    formData.append('institucion',       institucion);
    formData.append('contribuciones',    getRadio('contribuciones_edit'));
    formData.append('derechos_aseo',     getRadio('derechos_aseo_edit'));
    formData.append('exclusividad',      getRadio('exclusividad_edit'));
    formData.append('sello_verde',       getRadio('sello_verde_edit'));
    formData.append('empresa_luz',       $("#luzedit").val());
    formData.append('empresa_gas',       $("#gasedit").val());
    formData.append('empresa_agua',      $("#aguaedit").val());
    formData.append('numero_luz',        $("#numero_luzedit").val());
    formData.append('numero_gas',        $("#numero_gasedit").val());
    formData.append('numero_agua',       $("#numero_aguaedit").val());
    formData.append('precio',            $("#ventaedit").val());
    formData.append('tipo_moneda',       tipoMoneda);
    formData.append('mapa',              $("#mapaedit").val());
    formData.append('monto',             $("#montoestedit").val());
    formData.append('rol_est',           $("#rolestedit").val());
    formData.append('estacionamiento',   $("#estacionamientoedit").val());
    formData.append('moneda_est',        monedaEst);
    formData.append('techado',           getRadio('techadoCheck'));
    formData.append('monto_b',           $("#montoboedit").val());
    formData.append('rol_b',             $("#rolboedit").val());
    formData.append('bodega',            $("#bodegaedit").val());
    formData.append('moneda_bo',         monedaBo);
    formData.append('nombre',            $("#nombreedit").val());
    formData.append('descripcion_man',   $("#descripcioneditman").val());
    formData.append('fecha',             $("#fechamanedit").val());
    formData.append('meses',             $("#mesesedit").val());
    formData.append('proxima_fecha',     $("#proximasfechaedit").val());
    formData.append('envio_correo',      $("#enviocorreoedit").val());
    formData.append('ano_construccion',  $("#ano_construccion_edit").val());
    formData.append('piso',              $("#piso_edit").val());
    formData.append('dormitorios',       $("#dormitorios_edit").val());
    formData.append('banos',             $("#banos_edit").val());
    formData.append('orientacion',       $("#orientacion_edit").val());
    formData.append('cocina',            $("#cocina_edit").val());
    formData.append('logia',             $("#logia_edit").val());
    formData.append('agua_caliente',     $("#agua_caliente_edit").val());
    formData.append('inventario',        $("#inventario_edit").val());
    formData.append('mt2_construido',    $("#mt2_construido_edit").val());
    formData.append('mt2_terraza',       $("#mt2_terraza_edit").val());
    formData.append('mt2_total',         $("#mt2_total_edit").val());
    formData.append('gasto_comun',       $("#gasto_comun_edit").val());
    formData.append('descripcion',       $("#descripcion_edit").val());
    formData.append('ascensor',          getRadio('ascensor_edit'));
    formData.append('juegos_infantiles', getRadio('juegos_infantiles_edit'));
    formData.append('lavanderia',        getRadio('lavanderia_edit'));
    formData.append('quinchos',          getRadio('quinchos_edit'));
    formData.append('sala_multiuso',     getRadio('sala_multiuso_edit'));
    formData.append('gimnasio',          getRadio('gimnasio_edit'));
    formData.append('ciclovia',          getRadio('ciclovia_edit'));
    formData.append('piscina',           getRadio('piscina_edit'));
    formData.append('verde',             getRadio('verde_edit'));
    formData.append('conserjeria',       getRadio('conserjeria_edit'));
    formData.append('PropietariosAgregados', JSON.stringify(PropietariosAgregados));
 
    // Imágenes (video e inventario ya NO van aquí — se suben por separado)
    var files = $('#imagenes')[0].files;
    for (var i = 0; i < files.length; i++) {
        formData.append('imagenes[]', files[i]);
    }
 
    $("#loadingOverlay").css('display', 'flex').show();
    $('#loadingOverlay').html(
        '<div style="text-align:center; color:white;">' +
            '<div class="spinner-border text-light mb-3" role="status"></div>' +
            '<div id="progress-text">Guardando...</div>' +
            '<div style="width:300px; height:8px; background:rgba(255,255,255,0.3); border-radius:4px; margin-top:10px;">' +
                '<div id="progress-bar-overlay" style="height:100%; width:0%; background:white; border-radius:4px; transition:width 0.2s;"></div>' +
            '</div>' +
            '<div id="progress-percent" style="margin-top:6px;">0%</div>' +
        '</div>'
    );
 
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/editarDetalles/Venta', true);
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
 
    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            var pct = Math.round((e.loaded / e.total) * 100);
            $('#progress-bar-overlay').css('width', pct + '%');
            $('#progress-percent').text(pct + '%');
            if (pct === 100) $('#progress-text').text('Procesando...');
        }
    };
 
    xhr.onload = function() {
        $("#loadingOverlay").fadeOut();
        if (xhr.status >= 200 && xhr.status < 300) {
            $("#successModal").modal('show');
            $('#texto_success').text('Edición Realizada con Éxito');
        } else {
            var msg = 'Error desconocido';
            try { var resp = JSON.parse(xhr.responseText); msg = resp.message || resp.error || msg; } catch(e) {}
            alert('Error al guardar: ' + msg);
        }
    };
 
    xhr.onerror = function() {
        $("#loadingOverlay").fadeOut();
        alert('Error de red al guardar. Verifique su conexión.');
    };
 
    xhr.send(formData);
});
 
// ==================== MANTENIMIENTOS ====================
$(document).ready(function () {
    $("#agregar-mantencion").on('click', function (e) {
        e.preventDefault();
        const fecha = $("#mantenimiento").val();
        const meses = parseInt($("#cadamantenimiento").val());
        let proxima = '';
        if (fecha && !isNaN(meses)) {
            const f = new Date(fecha);
            f.setMonth(f.getMonth() + meses);
            proxima = f.toISOString().split('T')[0];
        }
        const formData = new FormData();
        formData.append('id_propiedad', $(this).data('id'));
        formData.append('nombre',       $("#nombremantenimiento").val());
        formData.append('descripcion',  $("#descripcionmantenimiento").val());
        formData.append('fecha',        fecha);
        formData.append('meses',        meses);
        formData.append('proxima',      proxima);
        const docFile = $("#mantenimientodoc")[0].files[0];
        if (docFile) formData.append('doc', docFile);
 
        $.ajax({
            url: '/guardar/mantenciones',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: response => {
                var m = response.data;
                var docEnlace = m.doc
                    ? `<a href="/storage/${m.doc}" target="_blank" class="btn btn-sm btn-primary">Ver Documento</a>`
                    : 'No Disponible';
                $('#lista-man tbody').append(`<tr>
                    <td>${m.id}</td><td>${m.nombre}</td><td>${m.fecha_mantencion}</td>
                    <td>${m.descripcion}</td><td>${docEnlace}</td>
                </tr>`);
                $("#mantenimiento, #cadamantenimiento, #nombremantenimiento, #descripcionmantenimiento, #mantenimientodoc").val('');
            },
            error: () => alert("Error al guardar el mantenimiento.")
        });
    });
 
    $('table tbody').on('input change', '.fechamanedit, .mesesedit', function () {
        const $row = $(this).closest('tr');
        const fechaMantencion = new Date($row.find('.fechamanedit').val());
        const meses = parseInt($row.find('.mesesedit').val());
        if (!isNaN(fechaMantencion.getTime()) && !isNaN(meses)) {
            const prox = new Date(fechaMantencion);
            prox.setMonth(prox.getMonth() + meses);
            $row.find('.proximasfechaedit').val(prox.toISOString().split('T')[0]);
            const envio = new Date(prox);
            envio.setMonth(envio.getMonth() - 1);
            $row.find('.enviocorreoedit').val(envio.toISOString().split('T')[0]);
        }
    });
});
 
$(".btn_man_delete").on('click', function() {
    event.preventDefault();
    var id_mantencion = $(this).data('id');
    $("#modalinfo").modal('show');
    $('#text-info').text('¿Seguro/a que quieres eliminar la Mantención?');
    $("#confirmDelete").off('click').on('click', function() {
        $.ajax({
            url: '/mantencion/' + id_mantencion,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }).done(function() {
            $("#modalinfo").modal('hide');
            $("#successModal").modal('show');
            $('#texto_success').text('Mantención eliminada correctamente');
        }).fail(function() { console.log("Error al eliminar"); });
    });
});
 
$(".delete-img").on('click', function() {
    event.preventDefault();
    var idImg = $(this).data('id');
    $("#modalinfo").modal('show');
    $('#text-info').text('¿Seguro/a que quieres eliminar la Imagen?');
    $("#confirmDelete").off('click').on('click', function() {
        $.ajax({
            url: '/imagen/Venta/' + idImg,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }).done(function() {
            $("#modalinfo").modal('hide');
            $("#successModal").modal('show');
            $('#texto_success').text('Imagen eliminada correctamente');
        });
    });
});
 
$(".portada").on('click', function(event) {
    event.preventDefault();
    var idImg = $(this).data('id');
    $("#portada").modal('show');
    $('#text-info-portada').text('¿Seguro/a que quieres dejar de portada esta Imagen?');
    $("#confirmCambio").off('click').on('click', function() {
        $.ajax({
            url: '/portada/cambiar_img/Venta/' + idImg,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }).done(function() {
            $("#portada").modal('hide');
            $("#successModal").modal('show');
            $('#texto_success').text('Portada cambiada correctamente');
        });
    });
});
 
$(".delete-propietario").on('click', function() {
    event.preventDefault();
    var idPropietario = $(this).data('id');
    $("#modalinfo").modal('show');
    $('#text-info').text('¿Seguro/a que quieres Eliminar este Propietario?');
    $("#confirmDelete").off('click').on('click', function() {
        $.ajax({
            url: '/propietarioDelete/Venta/' + idPropietario,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }).done(function() {
            $("#modalinfo").modal('hide');
            $("#successModal").modal('show');
            $('#texto_success').text('Propietario eliminado correctamente');
        });
    });
});
 
$("#close_success").click(function() {
    $("#successModal").modal('hide');
    location.reload();
});
 
function formatearMiles(input) {
    let valor = input.value.replace(/\D/g, '');
    input.value = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
 
document.addEventListener('DOMContentLoaded', function () {
    const switchUF = document.getElementById('switchUF');
    const monedaTexto = document.getElementById('monedaTexto');
    if (switchUF) {
        monedaTexto.innerText = switchUF.checked ? 'UF' : 'CLP';
        switchUF.addEventListener('change', () => monedaTexto.innerText = switchUF.checked ? 'UF' : 'CLP');
    }
    const switchDeuda = document.getElementById('switchDeuda');
    const monedaDeudaEl = document.getElementById('monedaDeuda');
    if (switchDeuda) {
        monedaDeudaEl.innerText = switchDeuda.checked ? 'UF' : 'CLP';
        switchDeuda.addEventListener('change', () => monedaDeudaEl.innerText = switchDeuda.checked ? 'UF' : 'CLP');
    }
});
</script>
@endsection

@section('css')
@parent
<style>
    .form-check-input:checked { background-color: #198754 !important; border-color: #fff !important; }
    .form-check-input { background-color: #dc3545; }
    .upload-container { border: 2px dashed #6c757d; border-radius: 0.5rem; text-align: center; padding: 2rem; color: #6c757d; cursor: pointer; transition: border-color 0.3s ease, color 0.3s ease; }
    .upload-container:hover { border-color: #0d6efd; color: #0d6efd; }
    .upload-container img { margin-top: 1rem; max-width: 100%; max-height: 150px; border-radius: 0.5rem; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
</style>
@endsection