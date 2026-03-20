@extends('layouts.app')

@section('content')
<div class="container-fluid"  style="background-color:rgb(255, 255, 255)">
    <div class="row">
        @include('layouts.sidebar')
        <div class="col">
            <div class="containre-fluid">
                <div class="row overflow-auto" style="max-height: 100vh;">                    
                    <div class="col-lg-12" style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px; color: white;">
                        <h1 class="text-uppercase text-center text-black">Detalles Completos</h1>
                    </div>
                    <!-- <div class="col-lg-4">
                        <div class="form-check form-switch bg-black d-flex align-items-center container p-2 shadow" 
                            style="margin-top: 40px; margin-bottom: 30px; color: white; border-radius: .9rem;">
                            <div class="col-lg-10">
                                <div id="estado" class="text-uppercase m-0 ">Deshabilitado para editar</div>
                            </div>
                            <div class="col-lg-2 d-flex align-items-center justify-content-end">
                                <input class="form-check-input m-2" type="checkbox" id="interruptor" 
                                style="transform: scale(1.5); width: 40px; height: 17px;">
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-12 text-white mb-3 p-4">
                        <div class="row shadow p-2" style="background-color:#E67E22; border-radius: .9rem;">
                            <div class="col-lg-12 mb-1">
                                <div class="col-lg-3 mb-3 bg-black rounded-pill text-center">
                                    <h4 class="mb-2">Detalles de la Propiedad</h4>
                                </div>
                            </div>
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
                                            <input type="checkbox"
                                                class="custom-control-input"
                                                id="switchUF">
                                            <label class="custom-control-label" for="switchUF"></label>
                                            <span id="monedaTexto" class="ms-2 fw-bold">CLP</span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="tipo_moneda" value="CLP">
                            
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="direccionedit">Dirección</label>
                                <input type="text" id="direccionedit" class="form-control" value="{{ $detalles->direccion }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="ciudadedit">Ciudad de la propiedad</label>
                                <input type="text" id="ciudadedit" class="form-control"  value="{{ $detalles->ciudad }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="condominioedit">Condominio</label>
                                <input type="text" id="condominioedit" class="form-control"  value="{{ $detalles->condominio }}">
                            </div>
                           <div class="col-lg-4">
                                <label for="viviendaedit">Tipo de Vivienda</label>
                                <!-- <input type="text" id="viviendaedit" class="form-control"  value="{{$detalles->tipo_vivienda}}"> -->
                                <select name="viviendaedit" id="viviendaedit" class="form-select" >
                                    <option value="" {{ is_null($detalles->tipo_vivienda) ? 'selected' : '' }}>Seleccione una opción</option>
                                    <option value="Casa" {{ $detalles->tipo_vivienda === 'Casa' ? 'selected' : '' }}>Casa</option>
                                    <option value="Departamento" {{ $detalles->tipo_vivienda === 'Departamento' ? 'selected' : '' }}>Departamento</option>

                                </select>
                            </div>

                            <div class="form-group col-4 col-lg-4 d-none" id="wrap_tipo_cocina_depto_edit">
                                <label for="tipo_cocina_depto_edit">Tipo de cocina</label>
                                <select class="form-select" name="tipo_cocina_depto_edit" id="tipo_cocina_depto_edit">
                                    <option value="" {{ is_null($detalles->tipo_cocina) ? 'selected' : '' }}>
                                        Seleccione una opción
                                    </option>
                                    <option value="Encimera"
                                        {{ $detalles->tipo_cocina === 'Encimera' ? 'selected' : '' }}>
                                        Encimera
                                    </option>
                                    <option value="Vitroceramica"
                                        {{ $detalles->tipo_cocina === 'Vitroceramica' ? 'selected' : '' }}>
                                        Vitrocerámica
                                    </option>
                                </select>
                                <input type="hidden" id="modal_tipo_vivienda" value="{{ $detallespropiedad->tipo_vivienda }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="torreedit">Torre</label>
                                <input type="text" id="torreedit" class="form-control"  value="{{ $detalles->torre }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="numero_torre">N° de Departamento</label>
                                <input type="text" id="numero_torre" class="form-control"  value="{{ $detalles->num_torre }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="roledit">Rol</label>
                                <input type="text" id="roledit" class="form-control"  value="{{ $detalles->rol }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="deuda_hipotecariaedit">Deuda Hipotecaria</label>
                                <div class="input-group">
                                <input type="text" class="form-control" id="deuda_hipotecariaedit"  value="{{ $detalles->deuda_hipotecaria }}"           
                                    oninput="this.value = '$' + this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                         
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="propietarioInput">Propietarios</label>
                                <div class="d-flex justify-content-between">
                                    <select id="propietarioInput" class="form-select me-2" >
                                        <option  selected value="0">Seleccione un propietario</option>
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
                                                <h4>Todos los Propietarios</h4>
                                            </div>
                                        </div>
                                        @foreach($propietarios as $prop)
                                        <div class="col-lg-6">
                                            <div class="input-group m-1" style="max-width: auto;">
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-user-tie"></i>
                                                </span>
                                                <input type="text" id="propietarios" class="form-control" value="{{ $prop->propietario->nombre }}" readonly>
                                                <span class="input-group-text">
                                                    <a href="javascript(0)" id="btn-eliminarPro" data-id="{{$prop->id}}" class="delete-propietario"><i class="fas fa-trash-alt fa-lg" style="color: red;"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Columna Izquierda: Detalles del Estacionamiento -->
                    <div class="col-lg-6 p-4">
                        <div class="row shadow text-white" style="background-color:#E67E22; border-radius: .9rem; height: auto;">
                            <div class="col-lg-12 mb-3">
                                <div class="p-3">
                                    <!-- Detalles del Estacionamiento -->
                                    <div class="text-center mb-3 col-lg-7 bg-black text-white rounded-pill shadow">
                                        <h4>Detalles del Estacionamiento</h4>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-group col-lg-4">
                                            <label for="montoestedit">Monto</label>
                                            <input type="text" class="form-control mt-2" id="montoestedit" placeholder="Sin Monto"  value="{{ $sub_est->monto }}">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="rolestedit">Rol</label>
                                            <input type="text" class="form-control mt-2" id="rolestedit" placeholder="Sin Rol"  value="{{ $sub_est->rol }}">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="estacionamientoedit">Estacionamiento</label>
                                            <input type="text" class="form-control mt-2" id="estacionamientoedit" placeholder="Sin N° Estacionamiento"  value="{{ $sub_est->estacionamiento }}">
                                        </div>
                                    </div>
                                    <div class="text-center my-3">
                                        <label for="techadoCheck"><b>¿Tiene Techado?</b></label>
                                        <div class="mt-2">
                                            <input type="radio" name="techadoCheck" id="techadoSi" value="1" 
                                                {{ isset($sub_est->techado) && $sub_est->techado == 1 ? 'checked' : '' }} >
                                            <label for="techadoSi">Sí</label>

                                            <input type="radio" name="techadoCheck" id="techadoNo" value="0" 
                                                {{ isset($sub_est->techado) && $sub_est->techado == 0 ? 'checked' : '' }} >
                                            <label for="techadoNo">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Detalles de la Bodega -->
                    <div class="col-lg-6 p-4">
                        <div class="row shadow text-white" style="background-color:#E67E22; border-radius: .9rem; height: auto;">
                            <div class="col-lg-12">
                                <div class="p-3">
                                    <!-- Detalles de la Bodega -->
                                    <div class="text-center mb-3 col-lg-6 bg-black text-white rounded-pill shadow">
                                        <h4>Detalles de la Bodega</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-4">
                                            <label for="montoboedit">Monto</label>
                                            <input type="text" class="form-control mt-2" id="montoboedit" placeholder="Sin Monto"  value="{{ $sub_bodega->monto}}">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="rolboedit">Rol</label>
                                            <input type="text" class="form-control mt-2" id="rolboedit" placeholder="Sin Rol"  value="{{ $sub_bodega->rol }}">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="bodegaedit">N° Bodega</label>
                                            <input type="text" class="form-control mt-2" id="bodegaedit" placeholder="Sin N° Bodega"  value="{{ $sub_bodega->bodega }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
             
                    <div class="col-lg-12 p-4">
                        <div class="row p-4 shadow mt-2 text-white"style="background-color: #E67E22; border-radius: .9rem;">
                            <div class="text-center mb-3 col-lg-12 ">
                                <div class="col-lg-3 bg-black rounded-pill shadow text-white">
                                    <h4>Agregar Mantenimientos</h4>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="nombremantenimiento">Nombre del Mantenimiento</label>
                                <input type="text" class="form-control " id="nombremantenimiento" placeholder="Ingrese el nombre del mantenimiento" required >
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="descripcionmantenimiento">Descripción</label>
                                <textarea class="form-control " id="descripcionmantenimiento" placeholder="Ingrese la descripción del mantenimiento" required ></textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="mantenimiento">Fecha de Mantenimiento</label>
                                <input type="date" class="form-control "id="mantenimiento" required >
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="cadamantenimiento">Cada Cuántos Meses</label>
                                <input type="number" class="form-control " id="cadamantenimiento" placeholder="Ingrese la cantidad de meses para la mantención" required >
                            </div>
                            <div class="col-lg-6">
                                <label for="mantenimientodoc">Agregar Documento</label>
                                <input type="file" class="form-control" id="mantenimientodoc" name="mantenciones[0][doc]">
                            </div>
                            <div class="col-lg-12 text-end">
                                <button type="button" data-id="{{$detalles->id}}" class="btn btn-primary" id="agregar-mantencion">Agregar Mantenimiento</button>
                                <!-- <button type="button" class="btn btn-success" id="guardar-mantenciones">Guardar Todo</button> -->
                            </div>
                            <div class="col-lg-12 mt-3">
                                <table id="lista-man" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Fecha de Mantención</th>
                                            <th>Descripción</th>
                                            <th>Documento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Las filas se agregarán aquí dinámicamente -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-lg-12 p-4 mb-3">
                        <div class="row p-3 shadow mt-2"style="background-color: #E67E22; border-radius: .9rem;">
                            <div class="text-center mb-3 col-lg-12 ">
                                <div class="col-lg-3 bg-black rounded-pill shadow text-white">
                                    <h4>Lista de Mantenimientos</h4>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Fecha de la Mantencion</th>
                                            <th>Cada Cuantos Meses</th>
                                            <th>Proxima Mantencion</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mantenimiento as $mante)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td><input type="text" class="form-control" value="{{$mante->nombre}}" id="nombreedit" ></td>
                                                <td><textarea class="form-control" id="descripcioneditman" >{{$mante->descripcion}}</textarea></td>
                                                <td><input type="date" class="form-control fechamanedit" value="{{$mante->fecha_mantencion}}" id="fechamanedit" ></td>
                                                <td><input type="number" class="form-control mesesedit" value="{{$mante->meses}}" id="mesesedit" ></td>
                                                <td><input type="date" class="form-control proximasfechaedit" value="{{$mante->fecha_prox_man}}" id="proximasfechaedit" readonly></td>
                                                <td style="display: none;"><input type="date" class="form-control" value="{{$mante->envio_correo}}" id="enviocorreoedit"></td>
                                                <td>
                                                    <a class="btn btn-danger btn_man_delete" data-id="{{$mante->id}}">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/' . $mante->doc) }}" target="_blank" download class="btn btn-primary ms-2">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
               
                    <div class="col-lg-12 col-md-12 p-4">
                        <div class="row shadow text-white" style="background-color:#E67E22; border-radius: .9rem; height: auto;">
                            <div class="col-lg-12 mb-3">
                                <div class="p-3">
                                    <div class="row">
                                        <div class="col-lg-3 mb-4">
                                            <label for="contribuciones_edit" class="form-label w-100">Contribuciones</label>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check me-3">
                                                    <input type="radio" id="contribuciones_edit_yes" name="contribuciones_edit" class="form-check-input" value="1" {{ isset($detalles->contribuciones) && $detalles->contribuciones == 1 ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="contribuciones_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="contribuciones_edit_no" name="contribuciones_edit" class="form-check-input" value="0" {{ isset($detalles->contribuciones) && $detalles->contribuciones == 0 ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="contribuciones_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-4">
                                            <label for="derechos_aseo_edit" class="form-label w-100">Derechos de Aseo</label>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check me-3">
                                                    <input type="radio" id="derechos_aseo_edit_yes" name="derechos_aseo_edit" class="form-check-input" value="1" {{ isset($detalles->derechos_aseo) && $detalles->derechos_aseo == 1 ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="derechos_aseo_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="derechos_aseo_edit_no" name="derechos_aseo_edit" class="form-check-input" value="0" {{ isset($detalles->derechos_aseo) && $detalles->derechos_aseo == 0 ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="derechos_aseo_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-4">
                                            <label for="exclusividad_edit" class="form-label w-100">Exclusividad</label>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check me-3">
                                                    <input type="radio" id="exclusividad_edit_yes" name="exclusividad_edit" class="form-check-input" value="1" {{ isset($detalles->exclusividad) && $detalles->exclusividad == 1 ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="exclusividad_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="exclusividad_edit_no" name="exclusividad_edit" class="form-check-input" value="0" {{ isset($detalles->exclusividad) && $detalles->exclusividad == 0 ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="exclusividad_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-4">
                                            <label for="sello_verde_edit" class="form-label w-100">Escritura</label>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check me-3">
                                                    <input type="radio" id="sello_verde_edit_yes" name="sello_verde_edit" class="form-check-input" value="1" {{ isset($detalles->sello_verde) && $detalles->sello_verde == 1 ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="sello_verde_edit_yes">Sí</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sello_verde_edit_no" name="sello_verde_edit" class="form-check-input" value="0" {{ isset($detalles->sello_verde) && $detalles->sello_verde == 0 ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="sello_verde_edit_no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            </div>

                            <div class="row">
                                <!-- Columna Izquierda: Ubicación -->
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
                                                    <h4 for="" class="form-label">Editar Mapa</h4>
                                                </div>
                                                <div class="mapa mt-2 mb-3">
                                                    <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        value="{{$detalles->maps}}" 
                                                        placeholder='Ej: <iframe src="..." frameborder="0"></iframe>' 
                                                        id="mapaedit" 
                                                        
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Columna Derecha: Servicios Básicos -->
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
                                                <input type="text" id="luzedit" class="form-control"  value="{{$detalles->empresa_luz}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-3 mb-3">
                                            <div class="form-group p-3" style="background-color:#F5DEB3; border-radius: .9rem;">
                                                <label for="numero_luzedit">Número de luz</label>
                                                <input type="text" id="numero_luzedit" class="form-control"  value="{{$detalles->numero_luz}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-3 mb-3">
                                            <div class="form-group p-3" style="background-color:#F5DEB3; border-radius: .9rem;">
                                                <label for="gasedit">Empresa de gas</label>
                                                <input type="text" id="gasedit" class="form-control"  value="{{$detalles->empresa_gas}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-3 mb-3">
                                            <div class="form-group p-3" style="background-color:#F5DEB3; border-radius: .9rem;">
                                                <label for="numero_gasedit">Número de gas</label>
                                                <input type="text" id="numero_gasedit" class="form-control"  value="{{$detalles->numero_gas}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-3 mb-3">
                                            <div class="form-group p-3" style="background-color:#F5DEB3; border-radius: .9rem;">
                                                <label for="aguaedit">Empresa de agua</label>
                                                <input type="text" id="aguaedit" class="form-control"  value="{{$detalles->empresa_agua}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-3 mb-3">
                                            <div class="form-group p-3" style="background-color:#F5DEB3; border-radius: .9rem;">
                                                <label for="numero_aguaedit">Número de agua</label>
                                                <input type="text" id="numero_aguaedit" class="form-control"  value="{{$detalles->numero_agua}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    
                            <div class="row mt-3">
                                <!-- Columna: Imágenes de la propiedad -->
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
                                                                    alt="{{ $detalles->direccion }}" data-imagen-url="{{ asset($img->link) }}">
                                                                <div class="position-absolute"
                                                                    style="top: 10px; right: 10px; display: flex; gap: 5px; background: rgba(255, 255, 255, 0.8); border-radius: 50px; padding: 15px;">
                                                                    <a href="javascript:void(0)" data-id="{{ $img->id }}" id="btn-checkPro"
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

                                <!-- Columna: Detalles Agregados -->
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
                                                    <option value="{{ $y }}" {{ $detallespropiedad->ano_construccion == $y ? 'selected' : '' }}>
                                                        {{ $y }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="piso_edit">Piso</label>
                                            <input type="text" id="piso_edit" placeholder="Eje: 1" class="form-control"
                                                value="{{ $detallespropiedad->piso }}" >
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="dormitorios_edit">Dormitorios</label>
                                            <input type="text" id="dormitorios_edit" placeholder="Eje: 2" class="form-control"
                                                value="{{ $detallespropiedad->dormitorios }}" >
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="banos_edit">Baños</label>
                                            <input type="text" id="banos_edit" placeholder="Eje: 1" class="form-control"
                                                value="{{ $detallespropiedad->banos }}" >
                                        </div>
                                    </div>                           
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-3">
                                    <!-- Primera Sección: Selectores -->
                                    <div class="row shadow p-2 text-white mb-4" style="background-color: #E67E22; border-radius: .9rem;">
                                        <!-- Encabezado -->
                                        <div class="col-lg-12 mb-2">
                                            <div class="col-lg-3 bg-black rounded-pill shadow text-white text-center">
                                                <h4 class="mb-2">Detalles Agregados</h4>
                                            </div>
                                        </div>
                                        
                                        <!-- Contenido de Selectores -->
                                        <div class="col-lg-3 mb-3">
                                            <label for="orientacion_edit">Orientación</label>
                                            <select name="orientacion_edit" id="orientacion_edit" class="form-select" >
                                                <option value="" {{ is_null($detallespropiedad->orientacion) ? 'selected' : '' }}>Seleccione una opción</option>
                                                <option value="N"  {{ $detallespropiedad->orientacion === 'N'  ? 'selected' : '' }}>Norte</option>
                                                <option value="NE" {{ $detallespropiedad->orientacion === 'NE' ? 'selected' : '' }}>Noreste</option>
                                                <option value="E"  {{ $detallespropiedad->orientacion === 'E'  ? 'selected' : '' }}>Oriente (Este)</option>
                                                <option value="SE" {{ $detallespropiedad->orientacion === 'SE' ? 'selected' : '' }}>Sureste</option>
                                                <option value="S"  {{ $detallespropiedad->orientacion === 'S'  ? 'selected' : '' }}>Sur</option>
                                                <option value="SO" {{ $detallespropiedad->orientacion === 'SO' ? 'selected' : '' }}>Suroeste</option>
                                                <option value="O"  {{ $detallespropiedad->orientacion === 'O'  ? 'selected' : '' }}>Poniente (Oeste)</option>
                                                <option value="NO" {{ $detallespropiedad->orientacion === 'NO' ? 'selected' : '' }}>Noroeste</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="cocina_edit">Tipo de conexión</label>
                                            <select name="cocina_edit" id="cocina_edit" class="form-select" >
                                                <option value="" {{ is_null($detallespropiedad->cocina) ? 'selected' : '' }}>Seleccione una opción</option>
                                                <option value="Eléctrica" {{ $detallespropiedad->cocina === 'Eléctrica' ? 'selected' : '' }}>Conexión eléctrica</option>
                                                <option value="Gas" {{ $detallespropiedad->cocina === 'Gas' ? 'selected' : '' }}>Gas cilindro</option>
                                                <option value="Conexión Gas" {{ $detallespropiedad->cocina === 'Conexión Gas' ? 'selected' : '' }}>Conexión cañeria</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="logia_edit">Logia</label>
                                            <select name="logia_edit" id="logia_edit" class="form-select" >
                                                <option value="" {{ is_null($detallespropiedad->logia) ? 'selected' : '' }}>Seleccione una opción</option>
                                                <option value="1" {{ $detallespropiedad->logia === '1' ? 'selected' : '' }}>Si</option>
                                                <option value="2" {{ $detallespropiedad->logia === '2' ? 'selected' : '' }}>No</option>
                                                <option value="3" {{ $detallespropiedad->logia === '3' ? 'selected' : '' }}>Conexión para lavadora</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="agua_caliente_edit">Agua Caliente</label>
                                            <select name="agua_caliente_edit" id="agua_caliente_edit" class="form-select" >
                                                <option value="" {{ is_null($detallespropiedad->agua_caliente) ? 'selected' : '' }}>Seleccione una opción</option>
                                                <option value="Calefont" {{ $detallespropiedad->agua_caliente === 'Calefont' ? 'selected' : '' }}>Calefont</option>
                                                <option value="Thermo" {{ $detallespropiedad->agua_caliente === 'Thermo' ? 'selected' : '' }}>Thermo</option>
                                                <option value="Caldera" {{ $detallespropiedad->agua_caliente === 'Caldera' ? 'selected' : '' }}>Caldera</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Segunda Sección: Detalles adicionales -->
                                    <div class="row shadow p-2 text-white" style="background-color: #E67E22; border-radius: .9rem;">
                                        <!-- Encabezado -->
                                        <div class="col-lg-12 mb-2">
                                            <div class="col-lg-3 bg-black rounded-pill shadow text-white text-center">
                                                <h4 class="mb-2">Detalles Agregados</h4>
                                            </div>
                                        </div>

                                        <!-- Detalles -->
                                        <div class="col-lg-3 mb-3">
                                            <label for="mt2_construido_edit">Mt2 Construido</label>
                                            <input type="text" id="mt2_construido_edit" placeholder="Mt2 Construidos" class="form-control" value="{{ $detallespropiedad->mt2_construido }}" >
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="mt2_terraza_edit">Mt2 Terraza</label>
                                            <input type="text" id="mt2_terraza_edit" placeholder="Mt2 Terraza" class="form-control" value="{{ $detallespropiedad->mt2_terraza }}" >
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="mt2_total_edit">Mt2 Total</label>
                                            <input type="text" id="mt2_total_edit" placeholder="Mt2 Total" class="form-control" value="{{ $detallespropiedad->mt2_total }}" >
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="estacionamiento_visita_edit">Estacionamiento de Visita</label>
                                            <input type="text" id="estacionamiento_visita_edit" placeholder="Estacionamientos de visitas" class="form-control" value="{{ $detallespropiedad->estacionamiento_visitas }}" >
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="inventario_edit">Inventario</label>
                                            <textarea id="inventario_edit" placeholder="Inventario" class="form-control" >{{ $detallespropiedad->inventario }}</textarea>
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
                                            <textarea id="descripcion_edit" placeholder="Descripción" class="form-control" >{{ $detallespropiedad->descripcion }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-ms-6 mt-3">
                                    <div class="row p-2 shadow text-white" style="background-color:#E67E22; border-radius: .9rem;">
                                        <div class="col-lg-12 mb-2">
                                            <div class="col-lg-3 bg-black rounded-pill shadow text-white text-center">
                                                <h4 class="mb-2">Checks Agregados</h4>
                                            </div>
                                        </div>  

                                        <!-- Primera fila de 3 columnas -->
                                        <div class="row w-100">
                                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                                <label for="espacio_lavadora_edit" class="form-label w-100 text-white">Espacio para Lavadora</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="espacio_lavadora_edit_yes" name="espacio_lavadora_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->espacio_lavadora) && $detallespropiedad->espacio_lavadora == 1 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="espacio_lavadora_edit_yes">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="espacio_lavadora_edit_no" name="espacio_lavadora_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->espacio_lavadora) && $detallespropiedad->espacio_lavadora == 0 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="espacio_lavadora_edit_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                                <label for="lavadora_edit" class="form-label w-100 text-white">Lavadora</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="lavadora_edit_yes" name="lavadora_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->lavadora) && $detallespropiedad->lavadora == 1 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="lavadora_edit_yes">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="lavadora_edit_no" name="lavadora_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->lavadora) && $detallespropiedad->lavadora == 0 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="lavadora_edit_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                                <label for="ascensor_edit" class="form-label w-100 text-white">Ascensor</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="ascensor_edit_yes" name="ascensor_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->ascensor) && $detallespropiedad->ascensor == 1 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="ascensor_edit_yes">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="ascensor_edit_no" name="ascensor_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->ascensor) && $detallespropiedad->ascensor == 0 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="ascensor_edit_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Segunda fila de 3 columnas -->
                                        <div class="row w-100">
                                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                                <label for="juegos_infantiles_edit" class="form-label w-100 text-white">Juegos Infantiles</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="juegos_infantiles_edit_yes" name="juegos_infantiles_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->juegos_infantiles) && $detallespropiedad->juegos_infantiles == 1 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="juegos_infantiles_edit_yes">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="juegos_infantiles_edit_no" name="juegos_infantiles_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->juegos_infantiles) && $detallespropiedad->juegos_infantiles == 0 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="juegos_infantiles_edit_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                                <label for="lavanderia_edit" class="form-label w-100 text-white">Lavandería</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="lavanderia_edit_yes" name="lavanderia_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->lavanderia) && $detallespropiedad->lavanderia == 1 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="lavanderia_edit_yes">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="lavanderia_edit_no" name="lavanderia_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->lavanderia) && $detallespropiedad->lavanderia == 0 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="lavanderia_edit_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                                <label for="quinchos_edit" class="form-label w-100 text-white">Quinchos</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="quinchos_edit_yes" name="quinchos_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->quinchos) && $detallespropiedad->quinchos == 1 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="quinchos_edit_yes">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="quinchos_edit_no" name="quinchos_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->quinchos) && $detallespropiedad->quinchos == 0 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="quinchos_edit_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tercera fila de 3 columnas -->
                                        <div class="row w-100">
                                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                                <label for="sala_multiuso_edit" class="form-label w-100 text-white">Sala Multiuso</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="sala_multiuso_edit_yes" name="sala_multiuso_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->sala_multiuso) && $detallespropiedad->sala_multiuso == 1 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="sala_multiuso_edit_yes">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="sala_multiuso_edit_no" name="sala_multiuso_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->sala_multiuso) && $detallespropiedad->sala_multiuso == 0 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="sala_multiuso_edit_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                                <label for="gimnasio_edit" class="form-label w-100 text-white">Gimnasio</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="gimnasio_edit_yes" name="gimnasio_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->gimnasio) && $detallespropiedad->gimnasio == 1 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="gimnasio_edit_yes">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="gimnasio_edit_no" name="gimnasio_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->gimnasio) && $detallespropiedad->gimnasio == 0 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="gimnasio_edit_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                                <label for="ciclovia_edit" class="form-label w-100 text-white">Ciclovía</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="ciclovia_edit_yes" name="ciclovia_edit" class="form-check-input" value="1" {{ isset($detallespropiedad->ciclovia) && $detallespropiedad->ciclovia == 1 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="ciclovia_edit_yes">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="ciclovia_edit_no" name="ciclovia_edit" class="form-check-input" value="0" {{ isset($detallespropiedad->ciclovia) && $detallespropiedad->ciclovia == 0 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="ciclovia_edit_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                                <label for="piscina_edit" class="form-label w-100 text-white">Piscina</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="piscina_edit_yes" name="piscina_edit" class="form-check-input" value="1" 
                                                            {{ isset($detallespropiedad->piscina) && $detallespropiedad->piscina == 1 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="piscina_edit_yes">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="piscina_edit_no" name="piscina_edit" class="form-check-input" value="0" 
                                                            {{ isset($detallespropiedad->piscina) && $detallespropiedad->piscina == 0 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="piscina_edit_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                                <label for="verde_edit" class="form-label w-100 text-white">Areas Verdes</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="verde_edit_yes" name="verde_edit" class="form-check-input" value="1" 
                                                            {{ isset($detallespropiedad->area_verde) && $detallespropiedad->area_verde == 1 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="verde_edit">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="verde_edit_no" name="verde_edit" class="form-check-input" value="0" 
                                                            {{ isset($detallespropiedad->area_verde) && $detallespropiedad->area_verde == 0 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="verde_edit_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Botones fuera de la fila -->
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12 mb-3 mt-3 d-flex justify-content-end">
                                <a href="/propiedadesVenta" class="btn btn-danger m-1">Volver</a>
                                <button class="btn btn-primary m-1" data-id="{{$detalles->id}}" id="guardarCambios">Guardar Edición</button>
                            </div>
                        </div>
                        <div id="loadingOverlay" style="
                            display:none;
                            position:fixed;
                            top:0; left:0; right:0; bottom:0;
                            background:rgba(0,0,0,0.6);
                            z-index:1050;
                            justify-content:center;
                            align-items:center;
                            color:white;
                            font-size:20px;
                            font-weight:bold;
                        ">
                            <div class="spinner-border text-light" role="status"></div>
                            <span class="ms-2">Guardando, por favor espera...</span>
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
                                                    <p id="texto_success" class="text-uppercase">
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
                        <h5 class="m-4 text-uppercase text-center" id="text-info">
                            </h2>
                            <div class="modalfooter d-flex justify-content-center">
                                <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" id="confirmDelete" class="btn btn-secondary m-2">Eliminar</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="portada" tabindex="-1" aria-labelledby="portadaLabel" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="alert alert-primary d-flex align-items-center" id="alerta" role="alert">
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
        var PropietariosAgregados = [];
        var lista = $("#lista-agregados");

        // Función para agregar un icono al arreglo
        $("#agregar-propietario").on('click', function(event) {
            event.preventDefault();

            // Obtener el ID del propietario seleccionado
            var propietarioId = $("#propietarioInput").val();

            // Verificar que se haya seleccionado un propietario
            if (propietarioId) {
                // Objeto que representa el propietario
                var propietarios = {
                    id: propietarioId,
                };

                // Agregar el propietario al arreglo
                PropietariosAgregados.push(propietarios);

                // Deshabilitar el elemento seleccionado del select
                $("#propietarioInput option[value='" + propietarioId + "']").prop('disabled', true);

                // Limpiar el campo después de agregar
                $("#propietarioInput").val('0'); // Restablecer a la opción predeterminada

                // Mostrar un mensaje de éxito o realizar otras acciones si es necesario
                console.log("Propietario agregado correctamente:", propietarios);
                console.log("Propietarios agregados:", PropietariosAgregados);

                actualizarLista();
            } else {
                // Mostrar un mensaje de error si no se selecciona un propietario
                alert("Por favor, seleccione un propietario.");
            }
        });

        // Función para actualizar la lista visual de propietarios
        function actualizarLista() {
            lista.empty(); // Vaciar la lista para evitar duplicados

            // Iterar sobre los propietarios agregados y agregarlos a la lista
            $.each(PropietariosAgregados, function(index, propietarios) {
                // Realiza una solicitud AJAX para obtener el nombre del propietario
                $.ajax({
                    url: '/obtener/propietarioNombre',
                    type: 'GET',
                    data: {
                        nombre_pro: propietarios.id
                    }, // Envía el ID del propietario al servidor
                    success: function(response) {
                        // Crear un elemento de la lista con el nombre del propietario y un botón de eliminar
                        var listItem = $("<li>")
                            .html('<i class="fa-solid fa-user-tie"></i> ' + response.nombre)
                            .append(
                                $("<button>")
                                .html('<i class="fas fa-trash-alt fa-lg text-danger"></i')
                                .addClass("btn btn-sm ms-2 m-1")
                                .on('click', function() {
                                    eliminarPropietario(index);
                                })
                            );
                        lista.append(listItem);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al obtener el nombre del propietario:", error);
                    }
                });
            });
        }
        // Función para eliminar un propietario del arreglo
        function eliminarPropietario(index) {
            var propietario = PropietariosAgregados[index];

            // Habilitar nuevamente la opción en el select
            $("#propietarioInput option[value='" + propietario.id + "']").prop('disabled', false);

            // Eliminar el propietario del arreglo
            PropietariosAgregados.splice(index, 1);

            // Actualizar la lista visual
            actualizarLista();
        }

        // document.getElementById('interruptor').addEventListener('change', function() {
        //     // Obtenemos todos los inputs y textareas en la página
        //     const inputs = document.querySelectorAll('input, textarea, select, a');
        //     const estado = document.getElementById('estado');

        //     // Recorremos todos los inputs y textareas y ajustamos su estado de acuerdo al interruptor
        //     inputs.forEach(input => {
        //         if (input.type !== 'checkbox' || input.id !== 'interruptor') {
        //             input. = !this.checked;
        //         }
        //     });

        //     // Actualizamos el texto del estado
        //     estado.textContent = this.checked ? 'Habilitado para editar' : 'Deshabilitado para editar';
        // });
        const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('imagenes');
const preview = document.getElementById('preview');

// Crea un conjunto para almacenar las imágenes únicas por su URL
const addedImages = new Set();

// Abre el selector de archivos al hacer clic en el área
dropArea.addEventListener('click', () => fileInput.click());

// Maneja los archivos seleccionados o arrastrados
function handleFiles(files) {
    Array.from(files).forEach(file => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => {
                const imgSrc = e.target.result;

                // Verifica si la imagen ya ha sido añadida
                if (!addedImages.has(imgSrc)) {
                    addedImages.add(imgSrc); // Añade la imagen al conjunto de imágenes únicas
                    
                    const img = document.createElement('img');
                    img.src = imgSrc;
                    preview.appendChild(img);
                }
            };
            reader.readAsDataURL(file);
        }
    });
}

// Detecta los cambios en el input de archivos
fileInput.addEventListener('change', () => handleFiles(fileInput.files));

// Maneja el arrastre y soltar
dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.style.backgroundColor = '#f8d7da';
});

dropArea.addEventListener('dragleave', () => {
    dropArea.style.backgroundColor = '';
});

dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.style.backgroundColor = '';
    const files = e.dataTransfer.files;
    handleFiles(files);
});



        let tipoMoneda = "{{ $precios->tipo_moneda ?? 'CLP' }}";
        
        $("#switchUF").on("change", function () {
            tipoMoneda = this.checked ? 'UF' : 'CLP';
        });

        // Enviar datos al servidor
        $('#guardarCambios').off().on('click', function(event) {
            event.preventDefault();
            var id_propiedad = $(this).data('id');
            console.log('id de la propiedad:', id_propiedad);

            // Obtener los valores de los campos de texto
            // var propietarios = $("#propietarios").[].val();
            var propietarios = [];
            $("#propietarios").each(function() {
                propietarios.push($(this).val()); // Agregar el valor al array
            });
            console.log('los propietarios', propietarios)

            var direccion = $("#direccionedit", ).val();
            var condominio = $("#condominioedit").val();
            var tipo_vivienda = $("#viviendaedit").val();
            var ciudad = $("#ciudadedit").val();

            var tipo_cocina = null;

            if (tipo_vivienda === 'Departamento') {
                tipo_cocina = $("#tipo_cocina_depto_edit").val();
            }
            var torre = $("#torreedit").val();
            var numero_torre = $("#numero_torre").val();
            var rol = $("#roledit").val();
            var deuda_hipotecaria = $('#deuda_hipotecariaedit').val();
            var tipo_moneda = tipoMoneda;

            var monto = $("#montoestedit").val();
            var rol_est = $("#rolestedit").val();
            var estacionamiento = $("#estacionamientoedit").val();

            var monto_b = $("#montoboedit").val();
            var rol_b = $("#rolboedit").val();
            var bodega = $("#bodegaedit").val();

            var monto_t = $("#montotechedit").val();
            var rol_t = $("#roltechedit").val();
            var techado = $("#numeroTechadoInputedit").val();

            var contribuciones_edit_yes = $("#contribuciones_edit_yes").is(':checked');
            var contribuciones_edit_no = $("#contribuciones_edit_no").is(':checked');
            var contribuciones_final;

            if (contribuciones_edit_yes) {
                // Si el checkbox espacio_lavadora_edit_yes está seleccionado
                contribuciones_final = $("#contribuciones_edit_yes").val();
            } else if (contribuciones_edit_no) {
                // Si el checkbox espacio_lavadora_edit_no está seleccionado
                contribuciones_final = $("#contribuciones_edit_no").val();
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            var derechos_aseo_edit_yes = $("#derechos_aseo_edit_yes").is(':checked');
            var derechos_aseo_edit_no = $("#derechos_aseo_edit_no").is(':checked');
            var derechos_aseo_final;

            if (derechos_aseo_edit_yes) {
                // Si el checkbox espacio_lavadora_edit_yes está seleccionado
                derechos_aseo_final = $("#derechos_aseo_edit_yes").val();
            } else if (derechos_aseo_edit_no) {
                // Si el checkbox espacio_lavadora_edit_no está seleccionado
                derechos_aseo_final = $("#derechos_aseo_edit_no").val();
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            var exclusividad_edit_yes = $("#exclusividad_edit_yes").is(':checked');
            var exclusividad_edit_no = $("#exclusividad_edit_no").is(':checked');
            var exclusividad_final;

            if (exclusividad_edit_yes) {
                // Si el checkbox espacio_lavadora_edit_yes está seleccionado
                exclusividad_final = $("#exclusividad_edit_yes").val();
            } else if (exclusividad_edit_no) {
                // Si el checkbox espacio_lavadora_edit_no está seleccionado
                exclusividad_final = $("#exclusividad_edit_no").val();
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            var sello_verde_edit_yes = $("#sello_verde_edit_yes").is(':checked');
            var sello_verde_edit_no = $("#sello_verde_edit_no").is(':checked');
            var sello_verde_final;

            if (sello_verde_edit_yes) {
                // Si el checkbox espacio_lavadora_edit_yes está seleccionado
                sello_verde_final = $("#sello_verde_edit_yes").val();
            } else if (sello_verde_edit_no) {
                // Si el checkbox espacio_lavadora_edit_no está seleccionado
                sello_verde_final = $("#sello_verde_edit_no").val();
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }
            

            var empresa_luz = $("#luzedit").val();
            var empresa_gas = $("#gasedit").val();
            var empresa_agua = $("#aguaedit").val();
            var numero_luz = $("#numero_luzedit").val();
            var numero_gas = $("#numero_gasedit").val();
            var numero_agua = $("#numero_aguaedit").val();

            var precio = $("#ventaedit").val();
            var mapa = $("#mapaedit").val();
            var deuda_hipotecaria = $("#deuda_hipotecariaedit").val();

            var nombre = $("#nombreedit").val();
            var descripcion_man = $("#descripcioneditman").val();
            var fecha = $("#fechamanedit").val();
            var meses = $("#mesesedit").val();
            var proxima_fecha = $("#proximasfechaedit").val();
            var envio_correo = $("#enviocorreoedit").val();

            var ano_construccion = $("#ano_construccion_edit").val();
            var piso = $("#piso_edit").val();
            var dormitorios = $("#dormitorios_edit").val();
            var banos = $("#banos_edit").val();
            var orientacion = $("#orientacion_edit").val();
            var cocina = $("#cocina_edit").val();
            var logia = $("#logia_edit").val();
            var agua_caliente = $("#agua_caliente_edit").val();
            var inventario = $("#inventario_edit").val();
            var mt2_construido = $("#mt2_construido_edit").val();
            var mt2_terraza = $("#mt2_terraza_edit").val();
            var mt2_total = $("#mt2_total_edit").val();
            var estacionamiento_visita = $("#estacionamiento_visita_edit").val();
            var gasto_comun = $("#gasto_comun_edit").val();
            var descripcion = $("#descripcion_edit").val();


            var espacio_lavadora_edit_yes = $("#espacio_lavadora_edit_yes").is(':checked');
            var espacio_lavadora_edit_no = $("#espacio_lavadora_edit_no").is(':checked');
            var espacio_lavadora_final;

            if (espacio_lavadora_edit_yes) {
                // Si el checkbox espacio_lavadora_edit_yes está seleccionado
                espacio_lavadora_final = $("#espacio_lavadora_edit_yes").val();
                console.log("Espacio Lavadora Sí Seleccionado: " + espacio_lavadora_final);
            } else if (espacio_lavadora_edit_no) {
                // Si el checkbox espacio_lavadora_edit_no está seleccionado
                espacio_lavadora_final = $("#espacio_lavadora_edit_no").val();
                console.log("Espacio Lavadora No Seleccionado: " + espacio_lavadora_final);
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }
            var lavadora_edit_yes = $("#lavadora_edit_yes").is(':checked');
            var lavadora_edit_no = $("#lavadora_edit_no").is(':checked');
            var lavadora_final;

            if (lavadora_edit_yes) {
                // Si el checkbox lavadora_edit_yes está seleccionado
                lavadora_final = $("#lavadora_edit_yes").val();
                console.log("Lavadora Sí Seleccionado: " + lavadora_final);
            } else if (lavadora_edit_no) {
                // Si el checkbox lavadora_edit_no está seleccionado
                lavadora_final = $("#lavadora_edit_no").val();
                console.log("Lavadora No Seleccionado: " + lavadora_final);
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            // Ahora puedes usar lavadora_final según sea necesario.

            var ascensor_edit_yes = $("#ascensor_edit_yes").is(':checked');
            var ascensor_edit_no = $("#ascensor_edit_no").is(':checked');
            var ascensor_final;

            if (ascensor_edit_yes) {
                // Si el checkbox ascensor_edit_yes está seleccionado
                ascensor_final = $("#ascensor_edit_yes").val();
                console.log("Ascensor Sí Seleccionado: " + ascensor_final);
            } else if (ascensor_edit_no) {
                // Si el checkbox ascensor_edit_no está seleccionado
                ascensor_final = $("#ascensor_edit_no").val();
                console.log("Ascensor No Seleccionado: " + ascensor_final);
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            // Ahora puedes usar ascensor_final según sea necesario.

            var juegos_infantiles_edit_yes = $("#juegos_infantiles_edit_yes").is(':checked');
            var juegos_infantiles_edit_no = $("#juegos_infantiles_edit_no").is(':checked');
            var juegos_infantiles_final;

            if (juegos_infantiles_edit_yes) {
                // Si el checkbox juegos_infantiles_edit_yes está seleccionado
                juegos_infantiles_final = $("#juegos_infantiles_edit_yes").val();
                console.log("Juegos Infantiles Sí Seleccionado: " + juegos_infantiles_final);
            } else if (juegos_infantiles_edit_no) {
                // Si el checkbox juegos_infantiles_edit_no está seleccionado
                juegos_infantiles_final = $("#juegos_infantiles_edit_no").val();
                console.log("Juegos Infantiles No Seleccionado: " + juegos_infantiles_final);
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            // Ahora puedes usar juegos_infantiles_final según sea necesario.
            var lavanderia_edit_yes = $("#lavanderia_edit_yes").is(':checked');
            var lavanderia_edit_no = $("#lavanderia_edit_no").is(':checked');
            var lavanderia_final;

            if (lavanderia_edit_yes) {
                // Si el checkbox lavanderia_edit_yes está seleccionado
                lavanderia_final = $("#lavanderia_edit_yes").val();
                console.log("Lavandería Sí Seleccionado: " + lavanderia_final);
            } else if (lavanderia_edit_no) {
                // Si el checkbox lavanderia_edit_no está seleccionado
                lavanderia_final = $("#lavanderia_edit_no").val();
                console.log("Lavandería No Seleccionado: " + lavanderia_final);
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            // Ahora puedes usar lavanderia_final según sea necesario.
            var quinchos_edit_yes = $("#quinchos_edit_yes").is(':checked');
            var quinchos_edit_no = $("#quinchos_edit_no").is(':checked');
            var quinchos_final;

            if (quinchos_edit_yes) {
                // Si el checkbox quinchos_edit_yes está seleccionado
                quinchos_final = $("#quinchos_edit_yes").val();
                console.log("Quinchos Sí Seleccionado: " + quinchos_final);
            } else if (quinchos_edit_no) {
                // Si el checkbox quinchos_edit_no está seleccionado
                quinchos_final = $("#quinchos_edit_no").val();
                console.log("Quinchos No Seleccionado: " + quinchos_final);
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            // Ahora puedes usar quinchos_final según sea necesario.

            var sala_multiuso_edit_yes = $("#sala_multiuso_edit_yes").is(':checked');
            var sala_multiuso_edit_no = $("#sala_multiuso_edit_no").is(':checked');
            var sala_multiuso_final;

            if (sala_multiuso_edit_yes) {
                // Si el checkbox sala_multiuso_edit_yes está seleccionado
                sala_multiuso_final = $("#sala_multiuso_edit_yes").val();
                console.log("Sala Multiuso Sí Seleccionado: " + sala_multiuso_final);
            } else if (sala_multiuso_edit_no) {
                // Si el checkbox sala_multiuso_edit_no está seleccionado
                sala_multiuso_final = $("#sala_multiuso_edit_no").val();
                console.log("Sala Multiuso No Seleccionado: " + sala_multiuso_final);
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            // Ahora puedes usar sala_multiuso_final según sea necesario.

            var gimnasio_edit_yes = $("#gimnasio_edit_yes").is(':checked');
            var gimnasio_edit_no = $("#gimnasio_edit_no").is(':checked');
            var gimnasio_final;

            if (gimnasio_edit_yes) {
                // Si el checkbox gimnasio_edit_yes está seleccionado
                gimnasio_final = $("#gimnasio_edit_yes").val();
                console.log("Gimnasio Sí Seleccionado: " + gimnasio_final);
            } else if (gimnasio_edit_no) {
                // Si el checkbox gimnasio_edit_no está seleccionado
                gimnasio_final = $("#gimnasio_edit_no").val();
                console.log("Gimnasio No Seleccionado: " + gimnasio_final);
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            // Ahora puedes usar gimnasio_final según sea necesario.
            var ciclovia_edit_yes = $("#ciclovia_edit_yes").is(':checked');
            var ciclovia_edit_no = $("#ciclovia_edit_no").is(':checked');
            var ciclovia_final;

            if (ciclovia_edit_yes) {
                // Si el checkbox ciclovia_edit_yes está seleccionado
                ciclovia_final = $("#ciclovia_edit_yes").val();
                console.log("Ciclovia Sí Seleccionado: " + ciclovia_final);
            } else if (ciclovia_edit_no) {
                // Si el checkbox ciclovia_edit_no está seleccionado
                ciclovia_final = $("#ciclovia_edit_no").val();
                console.log("Ciclovia No Seleccionado: " + ciclovia_final);
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            
            var piscina_edit_yes = $("#piscina_edit_yes").is(':checked');
            var piscina_edit_no = $("#piscina_edit_no").is(':checked');
            var piscina_final;

            if (piscina_edit_yes) {
                // Si el checkbox ciclovia_edit_yes está seleccionado
                piscina_final = $("#piscina_edit_yes").val();
                console.log("Piscina Sí Seleccionada: " + piscina_final);
            } else if (piscina_edit_no) {
                // Si el checkbox piscina_edit_no está seleccionado
                piscina_final = $("#piscina_edit_no").val();
                console.log("Piscina No Seleccionada: " + piscina_final);
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            var verde_edit_yes = $("#verde_edit_yes").is(':checked');
            var verde_edit_no = $("#verde_edit_no").is(':checked');
            var verde_final;

            if (verde_edit_yes) {
                // Si el checkbox ciclovia_edit_yes está seleccionado
                verde_final = $("#verde_edit_yes").val();
                console.log("Area Verde Sí Seleccionada: " + verde_final);
            } else if (verde_edit_no) {
                // Si el checkbox piscina_edit_no está seleccionado
                verde_final = $("#verde_edit_no").val();
                console.log("Area Verde No Seleccionada: " + verde_final);
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }

            var techadoSi = $("#techadoSi").is(':checked');
            var techadoNo = $("#techadoNo").is(':checked');
            var techado_final;

            if (techadoSi) {
                // Si el checkbox ciclovia_edit_yes está seleccionado
                techado_final = $("#techadoSi").val();
                console.log("Techado Sí Seleccionada: " + techado_final);
            } else if (techadoNo) {
                // Si el checkbox piscina_edit_no está seleccionado
                techado_final = $("#techadoNo").val();
                console.log("Techado No Seleccionada: " + techado_final);
            } else {
                // Si ninguno está seleccionado
                console.log("Ningún checkbox está seleccionado");
            }


            // Ahora puedes usar ciclovia_final según sea necesario.

            var formData = new FormData();

            // Agregar cada campo manualmente al formData
            formData.append('propietarios', propietarios);
            formData.append('id_propiedad', id_propiedad);
            formData.append('direccion', direccion);
            formData.append('ciudad', ciudad);
            formData.append('mantenimiento', mantenimiento);
            formData.append('condominio', condominio);
            formData.append('tipo_vivienda', tipo_vivienda);
            formData.append('tipo_cocina', tipo_cocina);
            formData.append('torre', torre);
            formData.append('numero_torre', numero_torre);
            formData.append('rol', rol);
            formData.append('deuda_hipotecaria', deuda_hipotecaria);
            formData.append('contribuciones', contribuciones_final);
            formData.append('derechos_aseo', derechos_aseo_final);
            formData.append('exclusividad', exclusividad_final);
            formData.append('sello_verde', sello_verde_final);
            formData.append('empresa_luz', empresa_luz);
            formData.append('empresa_gas', empresa_gas);
            formData.append('empresa_agua', empresa_agua);
            formData.append('numero_luz', numero_luz);
            formData.append('numero_gas', numero_gas);
            formData.append('numero_agua', numero_agua);
            formData.append('precio', precio);
            formData.append('mapa', mapa);
            formData.append('ano_construccion', ano_construccion);
            formData.append('piso', piso);
            formData.append('dormitorios', dormitorios);
            formData.append('banos', banos);
            formData.append('orientacion', orientacion);
            formData.append('cocina', cocina);
            formData.append('logia', logia);
            formData.append('agua_caliente', agua_caliente);
            formData.append('espacio_lavadora', espacio_lavadora_final);
            formData.append('lavadora', lavadora_final);
            formData.append('inventario', inventario);
            formData.append('mt2_construido', mt2_construido);
            formData.append('mt2_terraza', mt2_terraza);
            formData.append('mt2_total', mt2_total);
            formData.append('estacionamiento_visita', estacionamiento_visita);
            formData.append('gasto_comun', gasto_comun);
            formData.append('descripcion', descripcion);
            formData.append('ascensor', ascensor_final);
            formData.append('juegos_infantiles', juegos_infantiles_final);
            formData.append('lavanderia', lavanderia_final);
            formData.append('quinchos', quinchos_final);
            formData.append('sala_multiuso', sala_multiuso_final);
            formData.append('gimnasio', gimnasio_final);
            formData.append('ciclovia', ciclovia_final);
            formData.append('piscina', piscina_final);
            formData.append('verde', verde_final);
            formData.append('tipo_moneda', tipo_moneda);

            formData.append('monto', monto);
            formData.append('rol_est', rol_est);
            formData.append('estacionamiento', estacionamiento);
            formData.append('techado', techado_final);


            formData.append('monto_b', monto_b);
            formData.append('rol_b', rol_b);
            formData.append('bodega', bodega);

            formData.append('nombre', nombre);
            formData.append('descripcion_man', descripcion_man);
            formData.append('fecha', fecha);
            formData.append('meses', meses);
            formData.append('proxima_fecha', proxima_fecha);
            formData.append('envio_correo', envio_correo);

            
            // Obtener los archivos seleccionados
            var files = $('#imagenes')[0].files;

            // Iterar sobre los archivos seleccionados y agregarlos al objeto FormData
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                formData.append('imagenes[]', file);
            }

                    

            
            // Convertir iconosAgregados a cadena JSON y agregarlo al FormData
            formData.append('PropietariosAgregados', JSON.stringify(PropietariosAgregados));

            formData.forEach(function(value, key) {
                        console.log(key, value);
                    });


            // Convertir iconosAgregados a cadena JSON y agregarlo al FormData
            formData.append('PropietariosAgregados', JSON.stringify(PropietariosAgregados));

            formData.forEach(function(value, key) {
                console.log(key, value);
            });

            $.ajax({
                url: '/editarDetalles/Venta',
                type: 'POST',
                datatype: 'json',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $("#loadingOverlay").fadeIn(); // Mostrar overlay al iniciar
                }
            })
            .done(function(response) {
                console.log(response);
            
                // Ocultar overlay y luego mostrar modal de éxito
                $("#loadingOverlay").fadeOut(function() {
                    $("#successModal").modal('show');
                    $('#texto_success').text('Edicion Realizada con Exito');
                });
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log("Error:", errorThrown);
                $("#loadingOverlay").fadeOut(); // Ocultar overlay en caso de error
                alert('Error al editar');
            });

        }); // fin guardar 

        $(document).ready(function () {
            $("#agregar-mantencion").on('click', function (e) {
            e.preventDefault();

            const fecha = $("#mantenimiento").val();
            const meses = parseInt($("#cadamantenimiento").val());

            // Calcular la próxima mantención
            let proxima = '';
            if (fecha && !isNaN(meses)) {
                const f = new Date(fecha);
                f.setMonth(f.getMonth() + meses);
                proxima = f.toISOString().split('T')[0];
            }

            const formData = new FormData();
            formData.append('id_propiedad', $(this).data('id'));
            formData.append('nombre', $("#nombremantenimiento").val());
            formData.append('descripcion', $("#descripcionmantenimiento").val());
            formData.append('fecha', fecha);
            formData.append('meses', meses);
            formData.append('proxima', proxima);

            const docFile = $("#mantenimientodoc")[0].files[0];
            if (docFile) {
                formData.append('doc', docFile);
            }

            $.ajax({
                url: '/guardar/mantenciones',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: response => {
                    console.log(response);
                    // Asegúrate de que `res.data` contenga los datos de la mantención guardada
                    var nuevaMantencion = response.data;

                    // Generar el enlace al documento, si existe uno
                    var docEnlace = nuevaMantencion.doc 
                        ? `<a href="/storage/${nuevaMantencion.doc}" target="_blank" class="btn btn-sm btn-primary">Ver Documento</a>` 
                        : 'No Disponible';
                    // Crear una nueva fila de tabla
                    var nuevaFila = `
                    <tbody>
                        <tr>
                            <td>${nuevaMantencion.id}</td>
                            <td>${nuevaMantencion.nombre}</td>
                            <td>${nuevaMantencion.fecha_mantencion}</td>
                            <td>${nuevaMantencion.descripcion}</td>
                            <td>${docEnlace}</td>
                        </tr>
                    </tbody>

                    `;

                    // Agregar la nueva fila a la tabla con id "list-mantenciones"
                    $('#lista-man').append(nuevaFila);

                    // Limpiar los campos del formulario
                    $("#mantenimiento").val('');
                    $("#cadamantenimiento").val('');
                    $("#nombremantenimiento").val('');
                    $("#descripcionmantenimiento").val('');
                    $("#mantenimientodoc").val('');
                },
                error: (xhr, status, error) => {
                    console.error("Error:", error);
                    alert("Error al guardar el mantenimiento.");
                }
            });
        });

        function actualizarListaMantenciones() {
        lista.empty(); // Vaciar la tabla antes de volver a llenarla

        // Crear la cabecera de la tabla
        var table = $("<table>")
            .addClass("table table-bordered")
            .append(
                $("<thead>").append(
                    $("<tr>")
                        .append($("<th>").text("ID Propiedad"))
                        .append($("<th>").text("Nombre"))
                        .append($("<th>").text("Descripción"))
                        .append($("<th>").text("Fecha de Mantención"))
                        .append($("<th>").text("Cada Cuántos Meses"))
                        .append($("<th>").text("Próxima Fecha de Mantención"))
                        // .append($("<th>").text("Fecha de Envío de Correo"))
                        .append($("<th>").text("Acciones"))
                )
            );

        var tbody = $("<tbody>");

        // Iterar sobre las mantenciones agregadas y agregarlas a la tabla
        MantencionesAgregadas.forEach(function (mantencion, index) {
            // Calcular la próxima fecha de mantención
            var fechaInicial = new Date(mantencion.fecha);
            var proximaFecha = new Date(fechaInicial.setMonth(fechaInicial.getMonth() + parseInt(mantencion.meses)));

            // Formatear la próxima fecha en formato YYYY-MM-DD
            var proximaFechaFormatted = proximaFecha.toISOString().split("T")[0];

            // Calcular la fecha de envío (un mes antes de la próxima fecha)
            var fechaEnvio = new Date(proximaFecha);
            fechaEnvio.setMonth(fechaEnvio.getMonth() - 1);

            // Formatear la fecha de envío en formato YYYY-MM-DD
            var fechaEnvioFormatted = fechaEnvio.toISOString().split("T")[0];

            // Actualizar el objeto mantencion con la próxima fecha calculada y la fecha de envío
            mantencion.proximaFecha = proximaFechaFormatted;
            mantencion.fechaEnvio = fechaEnvioFormatted;

            var row = $("<tr>")
                .append($("<td>").text(mantencion.id_propiedad)) // Mostrar ID de la propiedad
                .append($("<td>").text(mantencion.nombre))
                .append($("<td>").text(mantencion.descripcion))
                .append($("<td>").text(mantencion.fecha))
                .append($("<td>").text(mantencion.meses))
                .append($("<td>").text(proximaFechaFormatted))
                // .append($("<td>").text(fechaEnvioFormatted)) // Mostrar la fecha de envío del correo
                .append(
                    $("<td>").append(
                        $("<button>")
                            .html('<i class="fas fa-trash-alt fa-lg text-white"></i>')
                            .addClass("btn btn-sm btn-danger btn-link")
                            .on("click", function () {
                                eliminarMantencion(index);
                            })
                    )
                );

            tbody.append(row);
        });

        // Agregar el cuerpo de la tabla al contenedor
        table.append(tbody);
        lista.append(table);
    }




        // Función para eliminar una mantención del arreglo y lista visual
        function eliminarMantencion(index) {
            MantencionesAgregadas.splice(index, 1); // Eliminar del arreglo
            actualizarListaMantenciones(); // Actualizar la lista visual
        }

        // Función para guardar las mantenciones en el servidor mediante AJAX
        $("#guardar-mantenciones").on('click', function (event) {
            event.preventDefault();

            if (MantencionesAgregadas.length > 0) {
                $.ajax({
                    url: '/guardar/mantenciones', // Ruta del backend para guardar
                    type: 'POST',
                    data: {
                        mantenciones: MantencionesAgregadas,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        alert("Mantenciones guardadas exitosamente.");
                        MantencionesAgregadas = []; // Limpiar el arreglo
                        actualizarListaMantenciones(); // Vaciar la lista visual
                    },
                    error: function (xhr, status, error) {
                        console.error("Error al guardar las mantenciones:", error);
                        alert("Hubo un problema al guardar las mantenciones.");
                    }
                });
            } else {
                alert("No hay mantenciones para guardar.");
            }
        });
    });
    $(".btn_man_delete").on('click', function() {
        event.preventDefault();
        var id_mantencion = $(this).data('id');
        console.log('id mantencion: ' + id_mantencion);

        // Mostrar el modal de confirmación
        $("#modalinfo").modal('show');
        $('#text-info').text('¿Seguro/a que quieres eliminar la Mantencion?');


        // Manejar el clic en el botón de confirmación
        $("#confirmDelete").on('click', function() { // Usar off() para evitar múltiples bindings

            // Realizar la solicitud AJAX
            $.ajax({
                url: '/mantencion/' + id_mantencion, // Usar template literals para construir la URL
                type: 'DELETE',
                datatype: 'json',     
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            })
            .done(function(respuesta) {
                // console.log("respuesta", respuesta);
                $("#modalinfo").modal('hide');
                $("#successModal").modal('show');
                $('#texto_success').text('Mantencion eliminada correctamente');
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log("Error:", errorThrown);
                $("#modalerror").modal('show');
            });
        });
    });
        //boton eliminar img
        $(".delete-img").on('click', function() {
            event.preventDefault();
            var idImg = $(this).data('id');
            console.log('img: ' + idImg);

            // Mostrar el modal de confirmación
            $("#modalinfo").modal('show');
            $('#text-info').text('¿Seguro/a que quieres eliminar la Imagen?');


            // Manejar el clic en el botón de confirmación
            $("#confirmDelete").on('click', function() { // Usar off() para evitar múltiples bindings

                // Realizar la solicitud AJAX
                $.ajax({
                        url: '/imagen/Venta/' + idImg, // Usar template literals para construir la URL
                        type: 'DELETE',
                        datatype: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                    })
                    .done(function(respuesta) {
                        // console.log("respuesta", respuesta);
                        $("#modalinfo").modal('hide');
                        $("#successModal").modal('show');
                        $('#texto_success').text('imagen eliminada correctamente');
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#modalerror").modal('show');
                    });
            });
        });

        //cambiar portada 
        $(".portada").on('click', function(event) {
            event.preventDefault();
            var idImg = $(this).data('id');
            console.log("ID portada Img: " + idImg);

            $("#portada").modal('show');
            $('#text-info-portada').text('¿Seguro/a que quieres Dejar de portada esta Imagen?');

            // $("#editarDetalles").modal('hide');

            $("#confirmCambio").on('click', function() {
                // Consulta a AJAX
                $.ajax({
                        url: '/portada/cambiar_img/Venta/' + idImg,
                        type: 'POST',
                        datatype: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    })
                    .done(function(respuesta) {
                        $("#portada").modal('hide');
                        $("#successModal").modal('show');
                        $('#texto_success').text('portada cambiada correctamente');
                        // Reordenar las imágenes
                        var $selectedImage = $('[data-id="' + idImg + '"]').closest('.image-container');
                        $('.image-container').first().before($selectedImage);
                        // alert('La portada se cambio con exito');
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        $("#modalinfo").modal('hide');
                        // Mostrar mensaje de error
                        $("#modalAlertaErrorEliminar").modal('show');
                    });
            });
        });

        $(".delete-propietario").on('click', function() {
            event.preventDefault();
            var idPropietario = $(this).data('id');
            console.log('id propietario: ' + idPropietario);

            // Mostrar el modal de confirmación
            $("#modalinfo").modal('show');
            $('#text-info').text('¿Seguro/a que quieres Eliminar este Propietario?');

            // Manejar el clic en el botón de confirmación
            $("#confirmDelete").on('click', function() { // Usar off() para evitar múltiples bindings

                // Realizar la solicitud AJAX
                $.ajax({
                        url: '/propietarioDelete/Venta/' +
                            idPropietario, // Usar template literals para construir la URL
                        type: 'DELETE',
                        datatype: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                    })
                    .done(function(respuesta) {
                        // console.log("respuesta", respuesta);
                        $("#modalinfo").modal('hide');
                        $("#successModal").modal('show');
                        $('#texto_success').text('Propietario eliminado correctamente');
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#modalerror").modal('show');
                    });
            });
        });

        //funcion al cerrar modal sucess actualice los datos
        $("#cerrar_error").click(function() {
            $("#modalerror").modal('hide');
        });

        //funcion al cerrar modal sucess actualice los datos
        $("#close_success").click(function() {
            $("#successModal").modal('hide');
            location.reload();
        });

        $(document).ready(function () {
            // Escuchamos eventos de cambio y entrada dentro de cada fila
            $('table tbody').on('input change', '.fechamanedit, .mesesedit', function () {
                const $row = $(this).closest('tr'); // Obtenemos la fila actual

                const fechaMantencion = new Date($row.find('.fechamanedit').val());
                const meses = parseInt($row.find('.mesesedit').val());

                if (!isNaN(fechaMantencion.getTime()) && !isNaN(meses)) {
                    // Calcular próxima fecha de mantenimiento
                    const proximaFecha = new Date(fechaMantencion);
                    proximaFecha.setMonth(proximaFecha.getMonth() + meses);
                    $row.find('.proximasfechaedit').val(proximaFecha.toISOString().split('T')[0]);

                    // Calcular fecha de envío del correo
                    const fechaEnvioCorreo = new Date(proximaFecha);
                    fechaEnvioCorreo.setMonth(fechaEnvioCorreo.getMonth() - 1);
                    $row.find('.enviocorreoedit').val(fechaEnvioCorreo.toISOString().split('T')[0]);
                }
            });
        });
        
        $("#tipo_vivienda_edit").on("change", function () {
            $("#modal_tipo_vivienda").val($(this).val());
            toggleTipoCocinaDeptoEdit();
        });
        

        function formatearMiles(input) {
                // Obtener el valor actual sin caracteres no numéricos
            let valor = input.value.replace(/\D/g, '');
            
            // Aplicar el formato de separador de miles
            let valorFormateado = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            
            // Asignar el valor formateado al campo
            input.value = valorFormateado;
        }
        
        document.addEventListener('DOMContentLoaded', function () {

                const switchUF = document.getElementById('switchUF');
                const monedaTexto = document.getElementById('monedaTexto');

                function actualizarMoneda() {
                    monedaTexto.innerText = switchUF.checked ? 'UF' : 'CLP';
                }

                // Estado inicial
                actualizarMoneda();

                // Al cambiar el switch
                switchUF.addEventListener('change', actualizarMoneda);
            });
            
        document.addEventListener('DOMContentLoaded', function () {

            const vivienda = document.getElementById('viviendaedit');
            const wrapCocina = document.getElementById('wrap_tipo_cocina_depto_edit');

            function validarTipoVivienda() {
                if (vivienda.value === 'Departamento') {
                    wrapCocina.classList.remove('d-none');
                } else {
                    wrapCocina.classList.add('d-none');
                }
            }

            validarTipoVivienda();
            vivienda.addEventListener('change', validarTipoVivienda);
        });
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


        .upload-container {
            border: 2px dashed #6c757d;
            border-radius: 0.5rem;
            text-align: center;
            padding: 2rem;
            color: #6c757d;
            cursor: pointer;
            transition: border-color 0.3s ease, color 0.3s ease;
        }

        .upload-container:hover {
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .upload-container img {
            margin-top: 1rem;
            max-width: 100%;
            max-height: 150px;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
