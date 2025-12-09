@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color:rgb(255, 255, 255)">
    <div class="row">
            @include('layouts.sidebar_trabajador')
        <div class="col">
            <div class="container-fluid">
                <div class="row overflow-auto" style="max-height: 100vh;">                      
                    <div class="col-lg-12" style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px; color: white;">
                        <h1 class="text-uppercase text-black text-center">Detalles Marzo a Diciembre</h1>
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
                    <div class="col-lg-12 text-white  mb-3 p-4" >
                        <div class="row shadow p-2"style="background-color:#E67E22; border-radius: .9rem;">
                            <div class="col-lg-12 mb-1">
                                <div class="col-lg-3 bg-black text-white text-center rounded-pill shadow">
                                    <h4 class="mb-2">Detalles de la Propiedad</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="diciembreedit">Precio Marzo a Diciembre</label>
                                <input type="text" id="diciembreedit" class="form-control format-number" value="{{$precios->diciembre}}" >
                            </div>  
                            <div class="col-lg-4 mb-3">
                                    <label for="direccionedit">Direccion de la propiedad</label>
                                    <input type="text" id="direccionedit" class="form-control"  value="{{$detalles->direccion}}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                    <label for="ciudadedit">Ciudad de la propiedad</label>
                                    <input type="text" id="ciudadedit" class="form-control"  value="{{$detalles->ciudad}}">
                            </div>

                            <div class="col-lg-4 mb-3">
                                    <label for="condominioedit">Condominio</label>
                                    <input type="text" id="condominioedit" class="form-control"  value="{{$detalles->condominio}}">
                            </div>
                            <div class="col-lg-4">
                                <label for="viviendaedit">Tipo de Vivienda</label>
                                <!-- <input type="text" id="viviendaedit" class="form-control" disabled value="{{$detalles->tipo_vivienda}}"> -->
                                <select name="viviendaedit" id="viviendaedit" class="form-select" >
                                    <option value="" {{ is_null($detalles->tipo_vivienda) ? 'selected' : '' }}>Seleccione una opción</option>
                                    <option value="Casa" {{ $detalles->tipo_vivienda === 'Casa' ? 'selected' : '' }}>Casa</option>
                                    <option value="Departamento" {{ $detalles->tipo_vivienda === 'Departamento' ? 'selected' : '' }}>Departamento</option>

                                </select>
                            </div>
                            
                            <div class="col-lg-4 mb-3">
                                <label for="torreedit">Torre</label>
                                <input type="text" id="torreedit" class="form-control"  value="{{$detalles->torre}}">
                            </div>
                            <div class="col-lg-2 mb-3">
                                <label for="numero_torre">N° Torre</label>
                                <input type="text" id="numero_torre" class="form-control"  value="{{$detalles->num_torre}}">
                            </div>
                            <div class="col-lg-2">
                                <label for="roledit">Rol</label>
                                <input type="text" id="roledit" class="form-control"  value="{{$detalles->rol}}">
                            </div>
                            <div class="col-lg-8 mb-3">
                                <!-- <div class="form-group"> -->
                                    <label class="" for="descripcionPropiedad">Descripcion</label>
                                    <textarea class="form-control" name="descripcionPropiedad" id="descripcionPropiedad" placeholder="Descripcion de la propiedad">{{$detalles->descripcion}}</textarea>
                                <!-- </div> -->
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label for="propietarioInput">Propietarios</label>
                                <div class="d-flex justify-content-between ">
                                    <select id="propietarioInput" class="form-select me-2" >
                                        <option disabled selected value="0">Seleccione un propietario</option>
                                        @foreach ($new_Propietarios as $propietario)
                                        <option value="{{ $propietario->id}}">{{ $propietario->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary rounded-pill" id="agregar-propietario">Agregar</button>
                                </div>
                                <ul class="text-uppercase mt-4 m-1 p-1 m-4" id="lista-agregados">
                                    <!-- <button class="btn btn-danger"><i class="fas fa-trash-alt fa-lg text-white"></i></button> -->
                                </ul>
                            </div>
                            
                            <div class="col-lg-6 mt-3 mb-3 text-dark">
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
                    <div class="col-lg-12 p-4">
                        <div class="row" style="background-color:#E67E22; border-radius: .9rem; height: auto;">
                            <div class="col-lg-12 p-3">
                                <div class="text-center mb-3 col-lg-2 bg-black text-white rounded-pill shadow">
                                    <h4 class="p-1">Arriendos</h4>
                                </div>
                            </div>
                           
                            <div class="container-fluid text-white">
                                <!-- Campos de entrada -->
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-4">
                                        <label for="arrendatarioInput"><b>Arrendatario</b></label>
                                        <select name="arrendatarioInput" id="arrendatarioInput">
                                            <option selected value="">Seleccione un Arrendatario</option>
                                            @foreach ($arrendatario as $arren)
                                                <option value="{{ $arren->id }}">{{ $arren->nombre }}</option>
                                            @endforeach
                                            <option value="nuevo_arrendatario" class="bg-warning">Agregar Nuevo</option> <!-- Cambia este valor -->
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 col-4">
                                        <label for="valorArriendoInput"><b>Valor Arriendo Diciembre</b></label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" id="valorArriendoInput" value="{{$precios->diciembre}}" 
                                                placeholder="Ej: $460.000" required readonly>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group mb-3 col-4">
                                        <label for="valorArriendoAñocorridoInput"><b>Valor Arriendo Año corrido</b></label>
                                        <div class="input-group">
                                            <span class="input-group-text mt-2">$</span>
                                            <input type="text" class="form-control mt-2" id="valorArriendoAñocorridoInput"
                                                placeholder="Ej: $460.000" required readonly>
                                        </div>
                                    </div> -->
                                
                                    <!-- Campo 1 -->
                                    <div class="form-group mb-3 col-4">
                                        <label for="valorreal"><b>Valor real para el Arriendo</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control format-number" id="valorreal"
                                                placeholder="Ej: 480.000" maxlength="20" required>
                                        </div>
                                    </div>

                                    <!-- Campo 2 -->
                                    <div class="form-group mb-3 col-4 text-center">
                                        <label class="d-block mb-2"><b>¿Incluye Mes de Garantía?</b></label>
                                        
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mes_garantia" id="mesGarantiaSi" value="1" required>
                                            <label class="form-check-label" for="mesGarantiaSi">Sí</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mes_garantia" id="mesGarantiaNo" value="0">
                                            <label class="form-check-label" for="mesGarantiaNo">No</label>
                                        </div>
                                    </div>

                                    <!-- Campo 3 -->
                                    <div class="form-group mb-3 col-4">
                                        <label for="gastosComunesInput"><b>Gastos Comunes</b></label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" class="form-control format-number" id="gastosComunesInput"
                                                placeholder="Ej: 450.000" maxlength="20" required>
                                        </div>
                                    </div>
                                
                                    <div class="form-group mb-3 col-lg-4">
                                        <label for="fechaPagoInput"><b>Fecha de Pago</b></label>
                                        <input type="date" class="form-control" id="fechaPagoInput" required>
                                    </div>
                                    <div class="form-group mb-3 col-lg-4">
                                        <label for="estado" class=""><b>Estado del pago</b></label>
                                        <select name="estado" class="form-select" id="estado">
                                            <option value="">Seleccione un estado del pago</option>
                                            @foreach($estados as $es)
                                                <option value="{{$es->id}}">{{$es->estado}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 col-lg-4">
                                        <label for="fechaEntregaInput"><b>Fecha inicio de Arriendo</b></label>
                                        <input type="date" class="form-control" id="fechaEntregaInput" required>
                                    </div>
                                

                                    <div class="form-group mb-3 col-lg-4">
                                        <label for="comisionesInput"><b>Comisiones</b></label>
                                        <select class="form-select" id="comisionesInput" required>
                                            <option disabled selected value="">Seleccione una Comisión</option>
                                            @foreach ($comision as $com)
                                                <option value="{{ $com->id }}">{{ $com->porcentaje }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 col-lg-4">
                                        <label for="reajusteInput"><b>Reajuste IPC</b></label>
                                        <input type="text" class="form-control" placeholder="Reajuste IPC" id="reajusteInput" required>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <h5 class="modal-title" id="agregarContratoLabel">Agregar Documentos</h5>
                                    </div>
                                    <div class="col-lg-12 text-white">
                                        <div class="mb-3">
                                            <label for="contrato" class="form-label text-white"><strong>Selecciona el archivo a cargar:</strong></label>
                                            <input type="file" name="contratos[]" accept=".pdf,.doc,.docx" required class="form-control" id="Archivo" multiple>
                                        </div>
                                        <button type="button" class="btn btn-primary rounded-pill m-1 text-uppercase text-white" id="agregar-datos"><b>Agregar Documentos</b></button>
                                    </div>
                                    <div class="col-lg-12">
                                        <ul class="text-uppercase mt-4" id="lista-Datos">
                                            <!-- Lista de documentos cargados -->
                                        </ul>
                                    </div>
                                    <div class="col-lg-12 mb-3 d-flex justify-content-end">
                                        <button class="btn btn-success rounded-pill" id="btn_agregar_arriendo" data-id="{{$detalles->id}}">Guardar Arriendo</button>
                                    </div>
                                </div>
                                <div class="row p-4">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3><em>Historial de Arriendos</em></h3>
                                                <div class="mb-3 d-flex align-items-center gap-3">
                                                    <div><span class="badge" style="background-color: #d4edda; color: #155724;">🟢 Vigente</span></div>
                                                    <div><span class="badge" style="background-color: #f8d7da; color: #721c24;">🔴 Caducado</span></div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="overflow-auto mb-3 w-100" style="max-height: 50vh;">
                                                    <table class="table table-light">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Arrendatario</th>
                                                                <th scope="col">Inico del Arriendo</th>
                                                                <th scope="col">Fecha de Pago</th>
                                                                <th scope="col">Valor del Arriendo</th>
                                                                <th scope="col">Comision</th>
                                                                <th scope="col" class="text-center">Acciones</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($arriendos as $arriendo)
                                                                @php
                                                                    $fechaEntrega = \Carbon\Carbon::parse($arriendo->fecha_devolucion);
                                                                    $claseFila = $fechaEntrega->isFuture() || $fechaEntrega->isToday() ? 'table-success' : 'table-danger';
                                                                @endphp
                                                                <tr id="filas" class="{{ $claseFila }}">
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $arriendo->arrendatario->nombre }}</td>
                                                                    <td>{{ $arriendo->fecha_entrega }}</td>
                                                                    <td>{{ $arriendo->fecha_pago }}</td>
                                                                    <td>$ {{ $arriendo->valor_real }}</td>
                                                                    <td>{{ $arriendo->comision->porcentaje }}</td>
                                                                    <td class="text-center">
                                                                        <a href="#" class="btn btn-primary rounded-circle btn-sm btn-editar m-1" data-id="{{ $arriendo->id }}">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                        <a href="#" class="btn btn-danger rounded-circle btn-sm borrar-arriendo m-1" data-id="{{ $arriendo->id}}">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </a>
                                                                        <a href="#" class="btn btn-success rounded-circle btn-sm btn-Contrato m-1" data-id="{{ $arriendo->id }}">
                                                                            <i class="fa-regular fa-folder"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 p-4 mb-3">
                        <!-- Columna Izquierda -->
                        <div class="row shadow text-white "style="background-color:#E67E22; border-radius: .9rem; height: auto;">
                            <div class="col-lg-12 mb-3">
                                <div class="p-3 mb-3">
                                    <!-- Detalles del Estacionamiento -->
                                    <div class="text-center mb-3 col-lg-7 bg-black text-white rounded-pill shadow">
                                        <h4>Detalles del Estacionamiento</h4>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-group col-lg-4">
                                            <label for="montoInput">Monto</label>
                                            <input type="text" class="form-control mt-2" id="montoInput" placeholder="Sin Monto"  value="{{$sub_est->monto}}">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="rolInput">Rol</label>
                                            <input type="text" class="form-control mt-2" id="rolInput" placeholder="Sin Rol"  value="{{$sub_est->rol}}">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="numeroEstacionamientoInput">Estacionamiento</label>
                                            <input type="text" class="form-control mt-2" id="numeroEstacionamientoInput" placeholder="Sin N° Estacionamiento"  value="{{$sub_est->estacionamiento}}">
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
                    
                    <div class="col-lg-6 p-4 mb-3">
                        <div class="row shadow text-white"style="background-color:#E67E22; border-radius: .9rem; height: auto;">
                            <div class="col-lg-12">
                                <div class="p-3">
                                    <!-- Detalles de la Bodega -->
                                    <div class="text-center mb-3 col-lg-6 bg-black rounded-pill shadow text-white">
                                        <h4>Detalles de la Bodega</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-4">
                                            <label for="montoInputbodega">Monto</label>
                                            <input type="text" class="form-control mt-2" id="montoInputbodega" placeholder="Sin Monto"  value="{{$sub_bodega->monto}}">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="rolInputbodega">Rol</label>
                                            <input type="text" class="form-control mt-2" id="rolInputbodega" placeholder="Sin Rol"  value="{{$sub_bodega->rol}}">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="numeroBodegaInput">N° Bodega</label>
                                            <input type="text" class="form-control mt-2" id="numeroBodegaInput" placeholder="Sin N° Bodega"  value="{{$sub_bodega->bodega}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 p-4">
                        <div class="row p-3 shadow mt-2 text-white"style="background-color: #E67E22; border-radius: .9rem;">
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
                                <button type="button" data-id="{{$detalles->id}}" class="btn btn-primary m-1 rounded-pill" id="agregar-mantencion">Agregar Mantención</button>
                                <!-- <button type="button" class="btn btn-success m-1" id="guardar-mantenciones">Guardar todas las Mantenciones</button> -->
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
                            <div style="overflow-x: auto; max-height: 400px; padding: 10px;">
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
                                                <td><textarea type="text" class="form-control" id="descripcioneditman" >{{$mante->descripcion}}</textarea></td>
                                                <td><input type="date" class="form-control fechamanedit" value="{{$mante->fecha_mantencion}}" id="fechamanedit" ></td>
                                                <td><input type="number" class="form-control mesesedit" value="{{$mante->meses}}" id="mesesedit" ></td>
                                                <td><input type="date" class="form-control proximasfechaedit" value="{{$mante->fecha_prox_man}}" id="proximasfechaedit" ></td>

                                                <td style="display: none;"><input type="date" class="form-control enviocorreoedit" value="{{$mante->envio_correo}}" id="enviocorreoedit" ></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a class="btn btn-danger btn_man_delete" data-id="{{$mante->id}}">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </a>
                                                        <a href="{{ asset('storage/public/' . $mante->doc) }}" target="_blank" download class="btn btn-primary ms-2">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 p-4">
                        <div class="row p-4 shadow" style="background-color:#E67E22; border-radius: .9rem;">
                            <div class="col-lg-7 mb-2 bg-black rounded-pill shadow text-white text-center">
                                <h4 class="mb-2">Ubicacion de la propiedad</h4>
                            </div>
                            <div class="col-lg-12">
                                <div class="text-center mb-3">
                                    <div class="d-flex justify-content-center mt-1" >
                                    {!! $detalles->maps !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-3">
                                <div class="row p-3 shadow "style="background-color:#E67E22; border-radius: .9rem;">
                                    <div class="col-lg-4 mb-2 bg-black rounded-pill shadow text-white text-center">
                                        <h4 for="" class="form-label">Editar Mapa</h4>
                                    </div>
                                    <div class="mapa mt-2 mb-3">
                                        <input type="text" class="form-control" value="{{$detalles->maps}}" placeholder="Ej: <iframe src=" id="mapaedit" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Columna Derecha -->
                    <div class="col-lg-6 p-4 mb-3">
                        <div class="row p-2 shadow"style="background-color:#E67E22; border-radius: .9rem;">
                            <div class="col-lg-12">
                                <div class="col-lg-6 mb-3 bg-black rounded-pill shadow text-white text-center">
                                    <h4>Servicios Básicos</h4>
                                </div>
                            </div>
                            <div class="col-lg-6 p-3 mb-3">
                                <div class="form-group p-3" style="background-color:#F5DEB3;border-radius: .9rem;">
                                    <label for="luzedit">Empresa de luz</label>
                                    <input type="text" id="luzedit" class="form-control"  value="{{$detalles->empresa_luz}}">
                                </div>
                            </div>
                            <div class="col-lg-6 p-3 mb-3" >
                                <div class="form-group p-3" style="background-color:#F5DEB3;border-radius: .9rem;">
                                    <label for="numero_luzedit">Número de luz</label>
                                    <input type="text" id="numero_luzedit" class="form-control"  value="{{$detalles->numero_luz}}">
                                </div>
                            </div>
                            <div class="col-lg-6 p-3 mb-3">
                                <div class="form-group p-3" style="background-color:#F5DEB3;border-radius: .9rem;">
                                    <label for="gasedit">Empresa de gas</label>
                                    <input type="text" id="gasedit" class="form-control"  value="{{$detalles->empresa_gas}}">
                                </div>
                            </div>
                            <div class="col-lg-6 p-3 mb-3">
                                <div class="form-group p-3" style="background-color:#F5DEB3;border-radius: .9rem;">
                                    <label for="numero_gasedit">Número de gas</label>
                                    <input type="text" id="numero_gasedit" class="form-control"  value="{{$detalles->numero_gas}}">
                                </div>
                            </div>
                            <div class="col-lg-6 p-3 mb-3">
                                <div class="form-group p-3" style="background-color:#F5DEB3;border-radius: .9rem;">
                                    <label for="aguaedit">Empresa de agua</label>
                                    <input type="text" id="aguaedit" class="form-control"  value="{{$detalles->empresa_agua}}">
                               </div>
                            </div>
                            <div class="col-lg-6 p-3 mb-3">
                                <div class="form-group p-3" style="background-color:#F5DEB3;border-radius: .9rem;">
                                    <label for="numero_aguaedit">Número de agua</label>
                                    <input type="text" id="numero_aguaedit" class="form-control"  value="{{$detalles->numero_agua}}">
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    
                    <div class="col-lg-6 p-4">
                        <div class="row p-3 shadow text-white" style="background-color:#E67E22; border-radius: .9rem;">
                            <div class=" mb-3">
                                <div class=" p-2 text-center">
                                    <div class="col-lg-7 mb-2 bg-black rounded-pill shadow text-white text-center">
                                        <h4 for="" class="form-label">Imágenes de la propiedad</h4>
                                    </div>                                    
                                    @if($imagen && $imagen->count() > 0)
                                        <div class="d-flex flex-wrap align-items-center justify-content-center" style="max-height: 400px; overflow-y: auto;">
                                            @foreach($imagen as $img)
                                                <div class="position-relative m-1">
                                                    <img src="{{ asset($img->link) }}" class="rounded" style="width: 150px; height: 217px; object-fit: cover;" alt="{{ $detalles->direccion }}" data-imagen-url="{{ asset($img->link) }}">
                                                    <div class="position-absolute" style="top: 10px; right: 10px; display: flex; gap: 5px; background: rgba(255, 255, 255, 0.8); border-radius: 50px; padding: 15px;">
                                                        <a href="javascript:void(0)" data-id="{{$img->id}}" id="btn-checkPro" class="d-flex align-items-center portada">
                                                            <i class="fas fa-check fa-lg" style="color: green;"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" data-id="{{$img->id}}" class="d-flex align-items-center delete-img">
                                                            <i class="fas fa-trash-alt fa-lg" style="color: red;"></i>
                                                        </a>
                                                        <a href="{{ asset($img->link) }}" download class="d-flex align-items-center">
                                                            <i class="fas fa-download fa-lg" style="color: #007bff;"></i>
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
                                            <h4 for="" class="form-label">Agregar Imágenes</h4>
                                        </div>  
                                        <!-- Área de arrastre y soltar -->
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
                    <div class="col-lg-6 p-4">
                        <div class="row p-3 shadow text-white"style="background-color:#E67E22; border-radius: .9rem;">
                            <div class="col-lg-12 mb-5">
                                <div class="col-lg-6 bg-black rounded-pill shadow text-white text-center">
                                    <h4 class="">video de la propiedad</h4>
                                </div>
                            </div>  
                            <div class="row mt-5">
                                <div class="col-lg-12">
                                    <div class="d-flex flex-wrap align-items-center justify-content-center">
                                        @foreach($videos as $vid)
                                            <div class="position-relative m-1" >
                                                <video width="100%" height="300" controls loop muted autoplay playsinline 
                                                    style="width: 100%; display: block; margin-bottom: 5px;" class="">
                                                    <source src="{{ asset(''. $vid->video) }}" alt="video" type="video/mp4">
                                                    Tu navegador no soporta la etiqueta de video.
                                                </video>
                                                <a href="javascript:void(0)" data-id="{{$vid->id}}" class="position-absolute delete-video" 
                                                    style="top: 30px; right: 10px; background: rgba(255, 255, 255, 0.8); padding: 15px; border-radius: .5rem;">
                                                    <i class="fas fa-trash-alt fa-lg" style="color: red;"></i>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <div class="col-lg-4 mb-2 bg-black rounded-pill shadow text-white text-center">
                                        <h4>Agregar Video</h4>
                                    </div>                                    
                                    <div class="form-group mb-3 ">
                                        <div id="video-drop-area" class="form-control p-4 d-flex align-items-center justify-content-center text-center"
                                            style="height: auto; border: 2px dashed #000; border-radius: 10px; background-color:rgba(249, 249, 249, 0); cursor: pointer;"ondragover="event.preventDefault()" ondrop="handleVideoDrop(event)">
                                            Arrastra aquí tu video o haz clic para seleccionarlo
                                        </div>
                                        <input class="form-control" type="file" name="videos" id="videos" accept="video/*" style="display: none;">
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-4">
                        <div class="row shadow p-2 text-white" style="background-color:#E67E22; border-radius: .9rem;">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-6 bg-black rounded-pill shadow text-white text-center">
                                    <h4 class="mb-2">Detalles Agregados</h4>
                                </div>
                            </div>  
                            <div class="col-lg-6 mb-3">
                                <label for="ano_construccion_edit">Año de Construcción</label>
                                <input type="date" id="ano_construccion_edit" placeholder="" class="form-control" value="{{$detallespropiedad->ano_construccion}}" >
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="piso_edit">Piso</label>
                                <input type="text" id="piso_edit" placeholder="Eje: 1" class="form-control" value="{{$detallespropiedad->piso}}" >
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="dormitorios_edit">Dormitorios</label>
                                <input type="text" id="dormitorios_edit" placeholder="Eje: 2" class="form-control" value="{{$detallespropiedad->dormitorios}}" >
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="banos_edit">Baños</label>
                                <input type="text" id="banos_edit" placeholder="Eje: 1" class="form-control" value="{{$detallespropiedad->banos}}" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-4">
                        <div class="row shadow p-2 text-white" style="background-color:#E67E22; border-radius: .9rem;">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-6 bg-black rounded-pill shadow text-white text-center">
                                    <h4 class="mb-2">Detalles Agregados</h4>
                                </div>
                            </div>  
                            <div class="col-lg-6 mb-3">
                                <label for="orientacion_edit">Orientación</label>
                                <select name="orientacion_edit" id="orientacion_edit" class="form-select" >
                                    <option value="" {{ is_null($detallespropiedad->orientacion) ? 'selected' : '' }}>Seleccione una opción</option>
                                    <option value="O" {{ $detallespropiedad->orientacion === 'O' ? 'selected' : '' }}>Oriente (Este)</option>
                                    <option value="P" {{ $detallespropiedad->orientacion === 'P' ? 'selected' : '' }}>Poniente (Oeste)</option>
                                    <option value="N" {{ $detallespropiedad->orientacion === 'N' ? 'selected' : '' }}>Norte</option>
                                    <option value="NO" {{ $detallespropiedad->orientacion === 'NO' ? 'selected' : '' }}>Norte - Poniente (Noroeste)</option>
                                    <option value="SO" {{ $detallespropiedad->orientacion === 'SO' ? 'selected' : '' }}>Sur - Poniente (Suroeste)</option>
                                </select>

                                <!-- <input type="text" id="orientacion_edit" class="form-control" value="{{$detallespropiedad->orientacion}}" disabled> -->
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="cocina_edit">Cocina</label>
                                <select name="cocina_edit" id="cocina_edit" class="form-select" >
                                    <option value="" {{ is_null($detallespropiedad->cocina) ? 'selected' : '' }}>Seleccione una opción</option>
                                    <option value="Eléctrica" {{ $detallespropiedad->cocina === 'Eléctrica' ? 'selected' : '' }}>Eléctrica</option>
                                    <option value="Gas" {{ $detallespropiedad->cocina === 'Gas' ? 'selected' : '' }}>Gas</option>
                                    <option value="Conexión Gas" {{ $detallespropiedad->cocina === 'Conexión Gas' ? 'selected' : '' }}>Conexión Gas</option>
                                </select>

                                <!-- <input type="text" id="cocina_edit" class="form-control" value="{{$detallespropiedad->cocina}}" disabled> -->
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="logia_edit">Logia</label>
                                <select name="logia_edit" id="logia_edit" class="form-select" >
                                    <option value="" {{ is_null($detallespropiedad->logia) ? 'selected' : '' }}>Seleccione una opción</option>
                                    <option value="1" {{ $detallespropiedad->logia === '1' ? 'selected' : '' }}>1</option>
                                    <!-- <option value="1 1/2" {{ $detallespropiedad->logia === '1 1/2' ? 'selected' : '' }}>1 1/2</option> -->
                                    <option value="2" {{ $detallespropiedad->logia === '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $detallespropiedad->logia === '3' ? 'selected' : '' }}>3</option>
                                </select>

                                <!-- <input type="text" id="logia_edit" class="form-control" value="{{$detallespropiedad->logia}}" disabled> -->
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="agua_caliente_edit">Agua Caliente</label>
                                <select name="agua_caliente_edit" id="agua_caliente_edit" class="form-select" >
                                    <option value="" {{ is_null($detallespropiedad->agua_caliente) ? 'selected' : '' }}>Seleccione una opción</option>
                                    <option value="Calefont" {{ $detallespropiedad->agua_caliente === 'Calefont' ? 'selected' : '' }}>Calefont</option>
                                    <option value="Thermo" {{ $detallespropiedad->agua_caliente === 'Thermo' ? 'selected' : '' }}>Thermo</option>
                                    <option value="Caldera" {{ $detallespropiedad->agua_caliente === 'Caldera' ? 'selected' : '' }}>Caldera</option>
                                </select>

                                <!-- <input type="text" id="agua_caliente_edit" class="form-control" value="{{$detallespropiedad->agua_caliente}}" disabled> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 p-4">
                        <div class="row shadow p-2 text-white" style="background-color:#E67E22; border-radius: .9rem;">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-3 bg-black rounded-pill shadow text-white text-center">
                                    <h4 class="mb-2">Detalles Agregados</h4>
                                </div>
                            </div>  
                            <div class="col-lg-3 mb-3">
                                <label for="mt2_construido_edit">Mt2 Construido</label>
                                <input type="text" id="mt2_construido_edit" placeholder="Mt2 Construidos" class="form-control" value="{{$detallespropiedad->mt2_construido}}" >
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="mt2_terraza_edit">Mt2 Terraza</label>
                                <input type="text" id="mt2_terraza_edit" placeholder="Mt2 Terraza" class="form-control" value="{{$detallespropiedad->mt2_terraza}}" >
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="mt2_total_edit">Mt2 Total</label>
                                <input type="text" id="mt2_total_edit" placeholder="Mt2 Total" class="form-control" value="{{$detallespropiedad->mt2_total}}" >
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="estacionamiento_visita_edit">Estacionamiento de Visita</label>
                                <input type="text" id="estacionamiento_visita_edit"placeholder="Estacionamientos de visitas" class="form-control" value="{{$detallespropiedad->estacionamiento_visitas}}" >
                            </div>

                            <div class="col-lg-3 mb-4">
                                <div class="form-group">
                                    <label for="inventariodoc" class="">Inventario</label>
                                    <input type="file" id="inventariodoc" class="form-control mb-2">

                                    @if(isset($doc->inventario) && $doc->inventario != '')
                                        <div class="card shadow-sm border rounded p-2 d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-alt text-primary me-2"></i>
                                                <span class="text-truncate" style="max-width: 140px;">{{ basename($doc->inventario) }}</span>
                                            </div>
                                            <a href="{{ asset($doc->inventario) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill">
                                                Ver
                                            </a>
                                        </div>
                                    @else
                                        <div class="text-muted fst-italic small mt-2">
                                            <i class="fas fa-exclamation-circle me-1 text-warning"></i>Sin documento
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3 mb-4">
                                <div class="form-group">
                                    <label for="actadoc" class="">Acta de Entrega</label>
                                    <input type="file" id="actadoc" class="form-control mb-2">

                                    @if(isset($doc->acta_entrega) && $doc->acta_entrega != '')
                                        <div class="card shadow-sm border rounded p-2 d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-alt text-primary me-2"></i>
                                                <span class="text-truncate" style="max-width: 140px;">{{ basename($doc->acta_entrega) }}</span>
                                            </div>
                                            <a href="{{ asset($doc->acta_entrega) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill">
                                                Ver
                                            </a>
                                        </div>
                                    @else
                                        <div class="text-muted fst-italic small mt-2">
                                            <i class="fas fa-exclamation-circle me-1 text-warning"></i>Sin documento
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3 mb-4">
                                <div class="form-group">
                                    <label for="contratodoc" class="">Contrato</label>
                                    <input type="file" id="contratodoc" class="form-control mb-2">

                                    @if(isset($doc->contrato) && $doc->contrato != '')
                                        <div class="card shadow-sm border rounded p-2 d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-alt text-primary me-2"></i>
                                                <span class="text-truncate" style="max-width: 140px;">{{ basename($doc->contrato) }}</span>
                                            </div>
                                            <a href="{{ asset($doc->contrato) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill">
                                                Ver
                                            </a>
                                        </div>
                                    @else
                                        <div class="text-muted fst-italic small mt-2">
                                            <i class="fas fa-exclamation-circle me-1 text-warning"></i>Sin documento
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3 mb-4">
                                <div class="form-group">
                                    <label for="poderdoc" class="">Poder de Administración</label>
                                    <input type="file" id="poderdoc" class="form-control mb-2">

                                    @if(isset($doc->poder_adm) && $doc->poder_adm != '')
                                        <div class="card shadow-sm border rounded p-2 d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-alt text-primary me-2"></i>
                                                <span class="text-truncate" style="max-width: 140px;">{{ basename($doc->poder_adm) }}</span>
                                            </div>
                                            <a href="{{ asset($doc->poder_adm) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill">
                                                Ver
                                            </a>
                                        </div>
                                    @else
                                        <div class="text-muted fst-italic small mt-2">
                                            <i class="fas fa-exclamation-circle me-1 text-warning"></i>Sin documento
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- <div class="col-lg-3 mb-3">
                                <label for="inventario_edit">Inventario</label>
                                <textarea type="text" id="inventario_edit" placeholder="Inventario" class="form-control" value="{{$detallespropiedad->inventario}}" ></textarea>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-12 col-ms-6 p-4">
                        <div class="row p-2 shadow text-white" style="background-color:#E67E22; border-radius: .9rem;">
                            <div class="col-lg-12 mb-2">
                                <div class="col-lg-3 bg-black rounded-pill shadow text-white text-center">
                                    <h4 class="mb-2">Checks Agregados</h4>
                                </div>
                            </div>  
                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                <label for="espacio_lavadora_edit" class="form-label w-100 text-white">Espacio para Lavadora</label>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="espacio_lavadora_edit_yes" name="espacio_lavadora_edit" 
                                            class="form-check-input" value="1" 
                                            {{ isset($detallespropiedad->espacio_lavadora) && $detallespropiedad->espacio_lavadora == 1 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="espacio_lavadora_edit_yes">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="espacio_lavadora_edit_no" name="espacio_lavadora_edit" 
                                            class="form-check-input" value="0" 
                                            {{ isset($detallespropiedad->espacio_lavadora) && $detallespropiedad->espacio_lavadora == 0 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="espacio_lavadora_edit_no">No</label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                <label for="lavadora_edit" class="form-label w-100 text-white">Lavadora</label>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="lavadora_edit_yes" name="lavadora_edit" 
                                            class="form-check-input" value="1" 
                                            {{ isset($detallespropiedad->lavadora) && $detallespropiedad->lavadora == 1 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="lavadora_edit_yes">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="lavadora_edit_no" name="lavadora_edit" class="form-check-input" value="0" 
                                            {{ isset($detallespropiedad->lavadora) && $detallespropiedad->lavadora == 0 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="lavadora_edit_no">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                <label for="ascensor_edit" class="form-label w-100 text-white">Ascensor</label>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="ascensor_edit_yes" name="ascensor_edit" class="form-check-input" value="1" 
                                            {{ isset($detallespropiedad->ascensor) && $detallespropiedad->ascensor == 1 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="ascensor_edit_yes">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="ascensor_edit_no" name="ascensor_edit" class="form-check-input" value="0" 
                                            {{ isset($detallespropiedad->ascensor) && $detallespropiedad->ascensor == 0 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="ascensor_edit_no">No</label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                <label for="juegos_infantiles_edit" class="form-label w-100 text-white">Juegos Infantiles</label>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="juegos_infantiles_edit_yes" name="juegos_infantiles_edit" class="form-check-input" value="1" 
                                            {{ isset($detallespropiedad->juegos_infantiles) && $detallespropiedad->juegos_infantiles == 1 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="juegos_infantiles_edit_yes">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="juegos_infantiles_edit_no" name="juegos_infantiles_edit" class="form-check-input" value="0" 
                                            {{ isset($detallespropiedad->juegos_infantiles) && $detallespropiedad->juegos_infantiles == 0 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="juegos_infantiles_edit_no">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                <label for="lavanderia_edit" class="form-label w-100 text-white">Lavandería</label>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="lavanderia_edit_yes" name="lavanderia_edit" class="form-check-input" value="1" 
                                            {{ isset($detallespropiedad->lavanderia) && $detallespropiedad->lavanderia == 1 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="lavanderia_edit_yes">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="lavanderia_edit_no" name="lavanderia_edit" class="form-check-input" value="0" 
                                            {{ isset($detallespropiedad->lavanderia) && $detallespropiedad->lavanderia == 0 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="lavanderia_edit_no">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                <label for="quinchos_edit" class="form-label w-100 text-white">Quinchos</label>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="quinchos_edit_yes" name="quinchos_edit" class="form-check-input" value="1" 
                                            {{ isset($detallespropiedad->quinchos) && $detallespropiedad->quinchos == 1 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="quinchos_edit_yes">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="quinchos_edit_no" name="quinchos_edit" class="form-check-input" value="0" 
                                            {{ isset($detallespropiedad->quinchos) && $detallespropiedad->quinchos == 0 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="quinchos_edit_no">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                <label for="sala_multiuso_edit" class="form-label w-100 text-white">Sala Multiuso</label>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="sala_multiuso_edit_yes" name="sala_multiuso_edit" class="form-check-input" value="1" 
                                            {{ isset($detallespropiedad->sala_multiuso) && $detallespropiedad->sala_multiuso == 1 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="sala_multiuso_edit_yes">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="sala_multiuso_edit_no" name="sala_multiuso_edit" class="form-check-input" value="0" 
                                            {{ isset($detallespropiedad->sala_multiuso) && $detallespropiedad->sala_multiuso == 0 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="sala_multiuso_edit_no">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                <label for="gimnasio_edit" class="form-label w-100 text-white">Gimnasio</label>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="gimnasio_edit_yes" name="gimnasio_edit" class="form-check-input" value="1" 
                                            {{ isset($detallespropiedad->gimnasio) && $detallespropiedad->gimnasio == 1 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="gimnasio_edit_yes">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="gimnasio_edit_no" name="gimnasio_edit" class="form-check-input" value="0" 
                                            {{ isset($detallespropiedad->gimnasio) && $detallespropiedad->gimnasio == 0 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="gimnasio_edit_no">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-ms-6 mb-4 d-flex flex-column align-items-center text-center">
                                <label for="ciclovia_edit" class="form-label w-100 text-white">Ciclovía</label>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="ciclovia_edit_yes" name="ciclovia_edit" class="form-check-input" value="1" 
                                            {{ isset($detallespropiedad->ciclovia) && $detallespropiedad->ciclovia == 1 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="ciclovia_edit_yes">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="ciclovia_edit_no" name="ciclovia_edit" class="form-check-input" value="0" 
                                            {{ isset($detallespropiedad->ciclovia) && $detallespropiedad->ciclovia == 0 ? 'checked' : '' }} >
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
                    </div>
                    <div class="col-lg-12 mb-3 mt-3 d-flex justify-content-end">
                        <a href="/propiedades" class="btn btn-danger m-1 rounded-pill">Volver</a>
                        <button class="btn btn-primary m-1 rounded-pill"data-id="{{$detalles->id}}" id="guardarCambios">Guardar Edicion</button>
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
                <h5 class="m-4 text-uppercase text-center" id="text-info"></h2>
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
                        <button type="button" class="btn btn-danger m-2"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="confirmCambio" class="btn btn-warning m-2">Cambiar</button>
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
<!-- modal exito -->
<div class="modal fade" id="errormodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="errormodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
            <div class="modal-header alert alert-danger" role="alert" style="border: none;">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000"
                                style="width:70px;height:70px"></lord-icon>
                        </div>
                        <div class="col-8 d-flex justify-content-center align-items-center">
                            <p id="texto_danger" class="text-uppercase">
                            </p>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn-close d-flex justify-content-end"
                                id="close_danger"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar nuevo arrendatario -->
<div class="modal fade" id="modalNuevoArrendatario" tabindex="-1" aria-labelledby="nuevoArrendatarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoArrendatarioLabel">Agregar Nuevo Arrendatario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="container">
                        <!-- Campos de entrada -->
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="nombreArrendatarioInput"><b>Nombre Arrendatario</b></label>
                                <input type="text" class="form-control mt-2" id="nombreArrendatarioInput" placeholder="Ej: Pedro Aguilera" required>
                                <small id="errorNombre" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-6">
                                <label for="rutInput"><b>Rut</b></label>
                                <input type="text" class="form-control mt-2" id="rutInput" placeholder="Ej: 1234567-8" maxlength="10" required>
                                <small id="errorRut" class="text-danger"></small>

                            </div>

                            <div class="form-group mb-3 col-6">
                                <label for="telefonoInput"><b>Telefono</b></label>
                                <input type="text" class="form-control mt-2" id="telefonoInput" placeholder="Ej: 965577377"  maxlength="9" minlength="9" required 
                                pattern="\d{9}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);">
                                <small id="errorTelefono" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="correoInput"><b>Correo</b></label>
                                <input type="mail" class="form-control mt-2" id="correoInput" placeholder="Ej: example@gmail.com" required>
                                <small id="errorCorreo" class="text-danger"></small>

                            </div>

                            <div class="form-group mb-3 col-6">
                                <label for="direccionInput"><b>Direccion</b></label>
                                <input type="text" class="form-control mt-2" id="direccionInput" placeholder="Ej: av.libertades" required>
                                <small id="errorDireccion" class="text-danger"></small>

                            </div>
                            <div class="form-group mb-3 col-6">
                                <label for="ciudadInput"><b>Ciudad</b></label>
                                <input type="text" class="form-control mt-2" id="ciudadInput" placeholder="Ciudad" required>
                                <small id="errorCiudad" class="text-danger"></small>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary rounded-pill" id="btn_agregar">Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editarArriendo" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="editarArriendoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header">
                <h5 class="modal-title" id="editarArriendoLabel">Editar Arriendo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ">
                <form>
                    <div class="container">
                        <!-- Campos de entrada -->
                        <div class="row">
                            <div class="form-group mb-3 col-lg-4">
                                <label for="valorArriendoEditInput"><b>Valor Arriendo</b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text mt-2">$</span>
                                    </div>
                                    <input type="text" class="form-control mt-2" id="valorArriendoEditInput"
                                        placeholder="Ej:$460.000" maxlength="20" required>
                                </div>
                            </div>
                        
                            <div class="form-group mb-3 col-4 text-center">
                                <label class="d-block mb-2"><b>¿Incluye Mes de Garantía?</b></label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="mes_garantiaedit" id="mesGarantiaSi" value="1">
                                    <label class="form-check-label text-black" for="mesGarantiaSi">Sí</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="mes_garantiaedit" id="mesGarantiaNo" value="0">
                                    <label class="form-check-label text-black" for="mesGarantiaNo">No</label>
                                </div>
                            </div>

                            <div class="form-group mb-3 col-lg-4">
                                <label for="gastosComunesEditInput"><b>Gatos Comunes</b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text mt-2">$</span>
                                    </div>
                                    
                                    <input type="text" class="form-control mt-2" id="gastosComunesEditInput"
                                        placeholder="Ej: $450.000" maxlength="20" required>
                                </div>
                            </div>
                        
                            <div class="form-group mb-3 col-lg-4">
                                <label for="fechaPagoEditInput"><b>Fecha de Pago</b></label>
                                <input type="date" class="form-control mt-2" id="fechaPagoEditInput" required>
                            </div>
                            <div class="form-group mb-3 col-lg-4">
                                <label for="estadoedit" class="mb-3"><b>Estado del pago</b></label>
                                <select name="estadoedit" class="form-select" id="estadoedit">
                                    <option value="">Seleccione un estado del pago</option>
                                    @foreach($estados as $es)
                                        <option value="{{$es->id}}">{{$es->estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3 col-lg-4">
                                <label for="fechaEntregaEditInput"><b>Fecha Inicio de Arriendo</b></label>
                                <input type="date" class="form-control mt-2" id="fechaEntregaEditInput" required>
                            </div>
                        
                            <div class="form-group mb-3 col-4">
                                <label for="arrendatarioEditInput"><b>Arrendatario</b></label>
                                <select class="form-select mt-2" id="arrendatarioEditInput">
                                    <option disabled selected value="">Seleccione un Arrendatario</option>
                                    @foreach ($arrendatario as $arren)
                                        <option value="{{ $arren->id }}">{{ $arren->nombre }}</option>
                                    @endforeach
                                    {{-- <option value="otros">Otros</option> --}}
                                </select>
                            </div>
                            <div class="form-group mb-3 col-4">
                                <label for="comisionesEditInput"><b>Comisiones</b></label>
                                <select class="form-select mt-2" id="comisionesEditInput">
                                    <option disabled selected value="">Seleccione una Comision</option>
                                    @foreach ($comision as $com)
                                        <option value="{{ $com->id }}">{{ $com->porcentaje }}
                                        </option>
                                    @endforeach
                                    {{-- <option value="otros">Otros</option> --}}
                                </select>
                            </div>
                            <div class="form-group mb-3 col-lg-4">
                                <label for="reajusteInputedit"><b>Reajuste IPC</b></label>
                                <input type="text" class="form-control mt-2" placeholder="Reajuste IPC" id="reajusteInputedit" required>
                            </div>
                        
                            <div class="form-group mb-3 col-lg-4">
                                <label for="fechaDevolucionEditInput"><b>Fecha de Devolucion</b></label>
                                <input type="date" class="form-control mt-2" id="fechaDevolucionEditInput"
                                    required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Botones de cambios -->
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-1" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_agregar_editar" class="btn btn-primary m-1">Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModificarArchivoModal" tabindex="-1" aria-labelledby="ModificarArchivoLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <h5 class="modal-title mt-4" id="" style="text-align: center;">Archivos Agregados </h5>
                @if(isset($arriendo))
                    <form action="{{ route('archivos.guardar', $arriendo->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- campos del formulario -->
                    </form>
                @else
                    <p>No se ha encontrado la propiedad.</p>
                @endif
                <div class="modal-body">
                    <div class="row">
                    <h5 class=" text-cent">
                </div>
                <div class="form-group">
                    <div id="listaArchivos"></div>
                </div>
                <ul class="text-uppercase mt-4" id="lista-agregados-edit">
                    <!-- <li></li> -->
                </ul>
                <div class="col-12">
                    <button class="btn btn-warning w-100 mt-3 mb-3 text-uppercase text-white" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse3" aria-expanded="false" aria-controls="multiCollapseExample3 ">
                        <b>Agregar Nuevos Archivos</b>
                    </button>
                </div>
                <div class="collapse multi-collapse3" id="multiCollapseExample3">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="modal-title" id="agregarContratoLabel">Agregar Documentos</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="mb-3">
                                            <label for="Archivos2" class="form-label fw-bold">Selecciona el archivo a cargar:</label>
                                            <input type="file" name="contratos2[]" accept=".pdf,.doc,.docx" required class="form-control" id="Archivos2" multiple>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3 mt-4 p-2">
                                            <button type="button" class="btn btn-info text-uppercase text-white fw-bold" id="agregar-datossolo">
                                                Agregar Documentos
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <ul class="text-uppercase mt-4" id="lista-Datosdos">
                                <!-- Lista de documentos cargados -->
                            </ul>
                        </div>
                    
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-1" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" id="btn_agregardos" class="btn btn-primary m-1">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="eliminarContratoModal" tabindex="-1" aria-labelledby="eliminarContratoLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
            <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar el Archivo?</h2>
                    <div class="modalfooter d-flex justify-content-center">
                        <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="confirmarEliminarContratoBtn" class="btn btn-secondary m-2">Eliminar</button>
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
        console.log('Listo para trabajar');
        function formatNumber(value) {
            value = value.replace(/\./g, ''); // quitar puntos existentes
            value = value.replace(/\D/g, ''); // quitar no numéricos
            return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $(document).ready(function () {
            $('.format-number').on('input', function () {
                const formatted = formatNumber($(this).val());
                $(this).val(formatted);
            });

            // Opcional: quitar los puntos antes de enviar el formulario
            /*
            $('form').on('submit', function () {
                $('.format-number').each(function () {
                    $(this).val($(this).val().replace(/\./g, ''));
                });
            });
            */
        });
        //Boton agregar arrendatario
        $("#btn_agregar").on('click', function(event) {
            event.preventDefault();
            console.log('todo correcto');

            // Limpiar errores anteriores
            $("small.text-danger").text("");

            // Obtener valores
            var nombre = $("#nombreArrendatarioInput").val().trim();
            var rut = $("#rutInput").val().trim();
            var telefono = $("#telefonoInput").val().trim();
            var correo = $("#correoInput").val().trim();
            var direccion = $("#direccionInput").val().trim();
            var ciudad = $("#ciudadInput").val().trim();

            let hayErrores = false;

            // Validar campos vacíos
            if (nombre === "") {
                $("#errorNombre").text("Este campo es obligatorio");
                hayErrores = true;
            }
            if (rut === "") {
                $("#errorRut").text("Este campo es obligatorio");
                hayErrores = true;
            }
            if (telefono === "") {
                $("#errorTelefono").text("Este campo es obligatorio");
                hayErrores = true;
            }
            if (correo === "") {
                $("#errorCorreo").text("Este campo es obligatorio");
                hayErrores = true;
            }
            if (direccion === "") {
                $("#errorDireccion").text("Este campo es obligatorio");
                hayErrores = true;
            }
            if (ciudad === "") {
                $("#errorCiudad").text("Este campo es obligatorio");
                hayErrores = true;
            }

            // Si hay errores, no continuar con el AJAX
            if (hayErrores) return;

            // Datos
            let argumentos = {
                nombre: nombre,
                rut: rut,
                telefono: telefono,
                correo: correo,
                direccion: direccion,
                ciudad: ciudad
            };

            // Enviar AJAX
            $.ajax({
                url: '{{ url('/arrendatarios/add') }}',
                type: 'POST',
                data: argumentos,
                dataType: 'json',
                success: function(respuesta) {
                    console.log("respuesta", respuesta);
                    $("#modalNuevoArrendatario").modal('hide');
                    $("#successModal").modal('show');
                    $("#texto_success").html("El Arrendatario se ha creado exitosamente");
                },
                error: function(jqXHR) {
                    if (jqXHR.responseJSON && jqXHR.responseJSON.mensaje) {
                        alert(jqXHR.responseJSON.mensaje);
                    } else {
                        alert('Ocurrió un error inesperado.');
                    }
                }
            });
        });
        // Evento para enviar los datos
        $("#btn_agregar_arriendo").on('click', function(event) {
            event.preventDefault();
            var id_propiedad = $(this).data('id');
            console.log('id de la propiedad:', id_propiedad);
            // $("#modalexito").modal('show');

            // Obtener los valores de los campos de texto
            // var fecha_devolucion = $("#fechaDevolucionInput").val();
            var fecha_entrega = $("#fechaEntregaInput").val();
            var valor_arriendo = $("#valorArriendoInput").val();
            var mes_garantia = $('input[name="mes_garantia"]:checked').val(); // obtiene el valor 1 o 0
            var gastos_comunes = $("#gastosComunesInput").val();
            var fecha_pago = $("#fechaPagoInput").val();
            var propiedades = $("#propiedadesInput").val();
            var arrendatario = $("#arrendatarioInput").val();
            var comisiones = $("#comisionesInput").val();
            var valor_real = $("#valorreal").val();
            var estado = $("#estado").val();
            var reajuste_ipc = $("#reajusteInput").val();

            // Crear un objeto FormData
            var formData = new FormData();

            // Agregar los datos del formulario al FormData
            // formData.append('fecha_devolucion', fecha_devolucion);
            formData.append('id_propiedad', id_propiedad);
            formData.append('fecha_entrega', fecha_entrega);
            formData.append('valor_arriendo', valor_arriendo);
            formData.append('mes_garantia', mes_garantia);
            formData.append('gastos_comunes', gastos_comunes);
            formData.append('fecha_pago', fecha_pago);
            formData.append('propiedades', propiedades);
            formData.append('arrendatario', arrendatario);
            formData.append('comisiones', comisiones);
            formData.append('valor_real', valor_real);
            formData.append('estado', estado);
            formData.append('reajuste_ipc', reajuste_ipc);


            // Agregar los archivos seleccionados al FormData
            archivosSeleccionados.forEach(archivo => {
                formData.append('Archivo[]', archivo); // Agregar cada archivo del array
            });

            console.log([...formData]); // Verificar los datos en la consola

            // Realizar la solicitud AJAX
            $.ajax({
                url: '{{ url('/arriendos/add_arriendos') }}',
                type: 'POST',
                data: formData,
                processData: false, // Para evitar que jQuery procese los datos
                contentType: false, // Para evitar que jQuery establezca el tipo de contenido
                dataType: 'json',
                success: function(respuesta) {
                    console.log("respuesta", respuesta);
                    $("#successModal").modal('show');
                    $("#texto_success").html("El Arriendo se ha creado exitosamente");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error:", errorThrown);
                    $("#agregarArriendo").modal('hide');

                    // alert('erro al agregar');
                    $('#modalerror').modal('show');
                }
            });
        }); // fin agregar arriendo

        var archivosSeleccionados = [];

        // Evento para agregar archivos
        $('#agregar-datos').on('click', function () {
            const inputArchivo = $('#Archivo')[0]; // accedemos al DOM nativo con [0]
            const listaDatos = $('#lista-Datos');

            if (inputArchivo.files.length > 0) {
                // Agregar todos los archivos seleccionados al array
                $.each(inputArchivo.files, function (index, archivo) {
                    archivosSeleccionados.push(archivo);

                    const li = $('<li></li>').text(archivo.name);
                    listaDatos.append(li);
                });

                // Resetear el input para permitir cargar el mismo archivo nuevamente si es necesario
                $('#Archivo').val('');
            } else {
                alert('Por favor, selecciona un archivo antes de agregar.');
            }
        });
        // boton trae datos del arriendo para editar
        $(".btn-editar").on('click', function(event) {
            event.preventDefault();
            idArriendo = $(this).data('id');
            console.log('Editar Arriendo id ' + idArriendo);

            // Realizar la solicitud AJAX
            $.ajax({
                url: '/arriendos/editar/' + idArriendo,
                type: 'GET',
                dataType: 'json',
                success: function(respuesta) {
                    console.log("respuesta", respuesta);
                    $("#editarArriendo").modal('show');
                    $('#btn_agregar_editar').data('id', idArriendo);
                    $("#fechaDevolucionEditInput").val(respuesta.arriendos
                        .fecha_devolucion);
                    $("#fechaEntregaEditInput").val(respuesta.arriendos.fecha_entrega);
                    $("#valorArriendoEditInput").val(respuesta.arriendos.valor_real);
                    $('input[name="mes_garantiaedit"][value="' + respuesta.arriendos.mes_garantia + '"]').prop('checked', true);
                    $("#gastosComunesEditInput").val(respuesta.arriendos.gastos_comunes);
                    $("#fechaPagoEditInput").val(respuesta.arriendos.fecha_pago);
                    // $("#propiedadesEditInput").val(respuesta.arriendos.id_propiedad);
                    $("#arrendatarioEditInput").val(respuesta.arriendos.id_arrendatario);
                    $("#comisionesEditInput").val(respuesta.arriendos.id_comision);
                    $("#estadoedit").val(respuesta.arriendos.id_estadopagos);
                    $("#reajusteInputedit").val(respuesta.arriendos.reajuste_ipc);


                }
            });
        }); //fin datos del arriendo

        //boton guardar edicion de arriendo
        $("#btn_agregar_editar").on('click', function(event) {
            event.preventDefault();
            var idArriendo = $(this).data('id');

            var fecha_devolucion = $("#fechaDevolucionEditInput").val();
            var fecha_entrega = $("#fechaEntregaEditInput").val();
            var valor_arriendo = $("#valorArriendoEditInput").val();
            var mes_garantia = $('input[name="mes_garantiaedit"]:checked').val(); // obtiene el valor 1 o 0
            var gastos_comunes = $("#gastosComunesEditInput").val();
            var fecha_pago = $("#fechaPagoEditInput").val();
            // var propiedad = $("#propiedadesEditInput").val();
            var arrendatario = $("#arrendatarioEditInput").val();
            var comisiones = $("#comisionesEditInput").val();
            var estadoedit = $("#estadoedit").val();
            var reajusteedit = $("#reajusteInputedit").val();

            argumentos = {
                idArriendo: idArriendo,
                fecha_devolucion: fecha_devolucion,
                fecha_entrega: fecha_entrega,
                valor_arriendo: valor_arriendo,
                mes_garantia: mes_garantia,
                gastos_comunes: gastos_comunes,
                fecha_pago: fecha_pago,
                // propiedad: propiedad,
                arrendatario: arrendatario,
                comisiones: comisiones,
                estadoedit: estadoedit,
                reajusteedit: reajusteedit
            };

            console.log(argumentos);

            // Realizar la solicitud AJAX
            $.ajax({
                url: '{{ url('/arriendos/add_editar_arriendos') }}',
                type: 'POST',
                datatype: 'json',
                data: argumentos,
                success: function(respuesta) {
                    console.log("respuesta", respuesta);
                    $("#editarArriendo").modal('hide');
                    $("#successModal").modal('show');
                    $('#texto_success').text('Arriendo Editado Correctamente');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error:", errorThrown);
                    $("#editarArriendo").modal('hide');
                    $('#modalerror').modal('show');
                }
            });
        }); // fin editar arriendo

        //boton eliminar arrendatario
        $(".borrar-arriendo").on('click', function(event) {
            event.preventDefault();
            var idArriendo = $(this).data('id');
            console.log('Arriendos: ' + idArriendo);

            var estado = 0;

            argumentos = {
                idArriendo: idArriendo,
                estado: estado
            };

            $("#modalinfo").modal('show');
            $('#text-info').text('¿Seguro/a que quieres eliminar el Arriendo?');
            $("#confirmDelete").click(function() {
                $("#modalinfo").modal('hide');
                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/arriendos/eliminar') }}',
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
                // alert("");
                $("#errormodal").modal('show');
                $('#texto_danger').text('Por favor, seleccione un propietario.');
                
            }
        });
        $("#close_danger").click(function() {
            $("#errormodal").modal('hide');
            location.reload();
        });

        // Función para actualizar la lista visual de propietarios
        function actualizarLista() {
            lista.empty(); // Vaciar la lista para evitar duplicados

            // Iterar sobre los propietarios agregados y agregarlos a la lista
            $.each(PropietariosAgregados, function(index, propietarios) {
                // Realiza una solicitud AJAX para obtener el nombre del propietario
                $.ajax({
                    url: '/trabajador/obtener/propietarioNombre',
                    type: 'GET',
                    data: { nombre_pro: propietarios.id }, // Envía el ID del propietario al servidor
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

        // Enviar datos al servidor
        $('#guardarCambios').off().on('click', function(event) {
            event.preventDefault();
                var id_propiedad = $(this).data('id');
                console.log('id de la propiedad:', id_propiedad);

                // Obtener los valores de los campos de texto
                // var propietarios = $("#propietarios").[].val();
                var propietarios = [];
                $("#propietarios").each(function () {
                    propietarios.push($(this).val()); // Agregar el valor al array
                });
                console.log('los propietarios',propietarios)

                var direccion = $("#direccionedit",).val();
                var condominio = $("#condominioedit").val();
                var tipo_vivienda = $("#viviendaedit").val();
                var ciudad = $("#ciudadedit").val();
                // var estacionamiento = $("#estacionamientoedit").val();
                var torre = $("#torreedit").val();
                var numero_torre = $("#numero_torre").val();
                // var bodega = $("#bodegaedit").val();
                var rol = $("#roledit").val();
                var descripcionpropiedad = $("#descripcionPropiedad").val();
                var empresa_luz = $("#luzedit").val();
                var empresa_gas = $("#gasedit").val();
                var empresa_agua = $("#aguaedit").val();
                var numero_luz = $("#numero_luzedit").val();
                var numero_gas = $("#numero_gasedit").val();
                var numero_agua = $("#numero_aguaedit").val();

                var monto = $("#montoInput").val();
                var rol_est = $("#rolInput").val();
                var estacionamiento = $("#numeroEstacionamientoInput").val();

                var monto_b = $("#montoInputbodega").val();
                var rol_b = $("#rolInputbodega").val();
                var bodega = $("#numeroBodegaInput").val();

                var monto_t = $("#montoInputTechado").val();
                var rol_t = $("#rolInputTechado").val();
                var techado = $("#numeroTechadoInput").val();

                var diciembre = $("#diciembreedit").val();
                var ano_corrido = $("#ano_corridoedit").val();
                // var contratoedit = $("#contrato").val();
                var mantenimiento = $("#mantenimientoedit").val();
                var reajuste = $("#reajusteedit").val();
                var mapa = $("#mapaedit").val();
                
                var nombre = $("#nombreedit").val();
                var descripcion = $("#descripcioneditman").val();
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
                formData.append('condominio', condominio);
                formData.append('tipo_vivienda', tipo_vivienda);
                // formData.append('estacionamiento', estacionamiento);
                formData.append('torre', torre);
                formData.append('numero_torre', numero_torre);
                formData.append('descripcionpropiedad', descripcionpropiedad);
                formData.append('rol', rol);
                formData.append('empresa_luz', empresa_luz);
                formData.append('empresa_gas', empresa_gas);
                formData.append('empresa_agua', empresa_agua);
                formData.append('numero_luz', numero_luz);
                formData.append('numero_gas', numero_gas);
                formData.append('numero_agua', numero_agua);
                formData.append('diciembre', diciembre);
                formData.append('ano_corrido', ano_corrido);
                formData.append('mantenimiento', mantenimiento);
                formData.append('reajuste', reajuste);
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
                formData.append('ascensor', ascensor_final);
                formData.append('juegos_infantiles', juegos_infantiles_final);
                formData.append('lavanderia', lavanderia_final);
                formData.append('quinchos', quinchos_final);
                formData.append('sala_multiuso', sala_multiuso_final);
                formData.append('gimnasio', gimnasio_final);
                formData.append('ciclovia', ciclovia_final);
                formData.append('piscina', piscina_final);
                formData.append('verde', verde_final);


                formData.append('monto', monto);
                formData.append('rol_est', rol_est);
                formData.append('estacionamiento', estacionamiento);
                formData.append('techado', techado_final);


                formData.append('monto_b', monto_b);
                formData.append('rol_b', rol_b);
                formData.append('bodega', bodega);

                formData.append('nombre', nombre);
                formData.append('descripcion', descripcion);
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

                var videoFile = $('#videos')[0].files[0];
                formData.append('videos', videoFile);

                var inventario = $("#inventariodoc")[0].files[0];
                formData.append('inventario', inventario);

                var acta = $("#actadoc")[0].files[0];
                formData.append('acta', acta);

                var contrato = $("#contratodoc")[0].files[0];
                formData.append('contrato', contrato);

                var poder = $("#poderdoc")[0].files[0];
                formData.append('poder', poder);

                
                // Convertir iconosAgregados a cadena JSON y agregarlo al FormData
                formData.append('PropietariosAgregados', JSON.stringify(PropietariosAgregados));

                formData.forEach(function(value, key) {
                            console.log(key, value);
                        });

            $.ajax({
                url: '/trabajador/editarDetalles', // Cambia por la URL del controlador en Laravel
                type: 'POST',
                datatype:'json',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

            })
            .done(function(response){
                console.log("Edicion Guardada");
                console.log(response);
                // $('#editarDetalles').modal('hide');
                // $('#modalExito').modal('show'); // Mostrar modal de éxito
                // alert('edicion realizada con exito');
                $("#successModal").modal('show');
                $('#texto_success').text('Edicion Realizada con Exito');
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                console.log("Error:", errorThrown);
                alert('erro al editar');
                // $('#modalError').modal('show'); // Mostrar modal de error
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
                    url: '/trabajador/imagen/' + idImg, // Usar template literals para construir la URL
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
        $("#close_success").click(function() {
            $("#successModal").modal('hide');
            location.reload();
        });
        
        //boton eliminar img
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
                    url: '/trabajador/mantencion/' + id_mantencion, // Usar template literals para construir la URL
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
        $(".delete-video").on('click', function() {
            event.preventDefault();
            var idVideo = $(this).data('id');
            console.log('video: ' + idVideo);

            // Mostrar el modal de confirmación
            $("#modalinfo").modal('show');
            $('#text-info').text('¿Seguro/a que quieres eliminar el video?');


            // Manejar el clic en el botón de confirmación
            $("#confirmDelete").off().on('click', function() { // Usar off() para evitar múltiples bindings

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/trabajador/video/' + idVideo, // Usar template literals para construir la URL
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
                    $('#texto_success').text('video eliminado correctamente');
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    console.log("Error:", errorThrown);
                    $("#modalerror").modal('show');
                });
            });
        });
        $(".btn-Contrato").on('click', function(event) {
            event.preventDefault();
            var id_contrato = $(this).data('id');
            console.log('id del arriendo', id_contrato);

            $.ajax({
                url: '/Mostrar/Archivo/' + id_contrato,
                type: 'GET',
                dataType: 'json'
            })
            .done(function(respuesta) {
                console.log('Respuesta del servidor:');
                console.log(respuesta);

                var listaArchivos = $("#lista-agregados-edit");

            if (respuesta.datosarchivos) {
                console.log('lista de Archivos:');
                console.log(respuesta.datosarchivos);
                var table = $("<table>").addClass("table table-striped table-bordered");
                var header = $("<thead>")
                    .append($("<tr>")
                        .append($("<th>").text("Archivo"))
                    // .append($("<th>").text("ID Arriendo"))
                    );
                table.append(header);

                            var body = $("<tbody>");
                            respuesta.datosarchivos.forEach(function(datosarchivos) {
                                // Obtener solo el nombre del archivo (basename)
                                var nombreArchivo = datosarchivos.archivo.split('/')
                            .pop(); // Para sistemas Unix

                    var row = $("<tr>")
                        .append($("<td>").html('<a href="' + datosarchivos.archivo + '" target="t_blank">' + nombreArchivo + '</a>')) // Hacer el nombre del archivo clickeable
                    // .append($("<td>").text(datosarchivos.id_arriendo))
                        .append(
                            $("<td>").html(
                            '<a href="' + datosarchivos.archivo + '" class="btn btn-primary btn-sm" download="' + nombreArchivo + '"><i class="fas fa-download"></i></a> ' +
                                '<a href="#" class="btn btn-danger btn-sm borrar-contrato-btn" data-id="' + datosarchivos.id + '" data-toggle="modal" data-target="#eliminarContratoModal"><i class="fas fa-trash-alt"></i></a>')
                        );   
                    body.append(row);
                });

                    table.append(body);
                    listaArchivos.html(table);
                }
                // Show the modal
                $("#ModificarArchivoModal").modal('show');

                // Asignar el ID del contrato al botón de guardar para enviar los archivos
                $('#btn_agregardos').data('id', id_contrato);
            });
        });
        const archivosSeleccionados2 = [];

        // Evento para agregar archivos usando jQuery
        $('#agregar-datossolo').on('click', function () {
            const inputArchivo = $('#Archivos2')[0];
            const listaDatos2 = $('#lista-Datosdos');

            if (inputArchivo.files.length > 0) {
                $.each(inputArchivo.files, function (index, archivo) {
                    archivosSeleccionados2.push(archivo);
                    const li = $('<li>').text(archivo.name);
                    listaDatos2.append(li);
                });

                // Resetear el input para permitir cargar el mismo archivo nuevamente
                inputArchivo.value = '';
            } else {
                alert('Por favor, selecciona un archivo antes de agregar.');
            }
        });

        $('#btn_agregardos').click(function () {
            let formData = new FormData();
            let files = $('#Archivos2')[0].files;
            let idArriendo = $(this).data('id'); // Obtén el ID del arriendo del botón presionado
            console.log("ID de arriendo para guardar archivos:", idArriendo); 

            // Agregar archivos de la lista al FormData
            archivosSeleccionados2.forEach(archivo => {
                formData.append('contratos2[]', archivo);
            });

            
            formData.append('_token', '{{ csrf_token() }}');  // Agregar token CSRF
            // Verificar qué archivos se están enviando
            // Verificar qué archivos se están enviando
            console.log("Archivos a enviar:");
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + (pair[1].name || pair[1])); // Imprime el nombre del archivo o el valor
            }
            $.ajax({
                url: '/archivos_guardar/' + idArriendo, // Ruta del controlador en Laravel
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // alert('Archivos guardados exitosamente');
                    $('#ModificarArchivoModal').modal('hide');
                    $("#successModal").modal('show');
                    $('#texto_success').text('El Archivo se Guardo Correctamente');

                    // Actualiza la lista de archivos si es necesario
                    $('#listaArchivos').html(response);
                },
                error: function (response) {
                    alert('Hubo un error al guardar los archivos');
                }
            });
        });
        $(document).ready(function() {
            var contratoId; // Variable para almacenar el ID del contrato a eliminar

            // Delegación de eventos para el botón de eliminación
            $(document).on('click', '.borrar-contrato-btn', function(e) {
                e.preventDefault(); // Evitar el comportamiento por defecto del enlace

                // Obtener el ID del contrato
                contratoId = $(this).data('id'); // Obtener el ID del contrato
                console.log('id del archivo',contratoId);
                $('#confirmarEliminarContratoBtn').data('id', contratoId); // Pasar el ID al botón de confirmación

                // Mostrar el modal
                $('#eliminarContratoModal').modal('show');
            });

            // Escuchar el clic en el botón de confirmar eliminación
            $('#confirmarEliminarContratoBtn').on('click', function() {
                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/elimicontra/' + contratoId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' 
                    },
                    success: function(response) {
                        alert('Contrato eliminado exitosamente.');
                        // Eliminar la fila correspondiente de la tabla
                        $('a.borrar-contrato-btn[data-id="' + contratoId + '"]').closest('tr').remove();
                        $('#eliminarContratoModal').modal('hide'); // Cerrar el modal
                    },
                    error: function(xhr) {
                        alert('Error al eliminar el contrato: ' + xhr.responseJSON.error);
                    }
                });
            });

        });

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
                    url: '/trabajador/portada/cambiar_img/' + idImg,
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
            formData.append('doc', $("#mantenimientodoc")[0].files[0]);

            $.ajax({
                url: '/trabajador/guardar/mantenciones',
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
                    var docEnlace = nuevaMantencion.doc ? `<a href="/storage/${nuevaMantencion.doc}" target="_blank">Ver Documento</a>` : 'No Disponible';

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
                    alert("Error al guardar la mantención.");
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
                            .append($("<th>").text("Documento"))
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
                console.log('mantencion:',mantencion);

                var row = $("<tr>")
                    .append($("<td>").text(mantencion.id_propiedad)) // Mostrar ID de la propiedad
                    .append($("<td>").text(mantencion.nombre))
                    .append($("<td>").text(mantencion.descripcion))
                    .append($("<td>").text(mantencion.fecha))
                    .append($("<td>").text(mantencion.meses))
                    .append($("<td>").text(proximaFechaFormatted))
                    .append(
                        $("<td>").append(
                            $("<a>")
                                .attr("href", mantencion.doc)             // Ruta completa del archivo
                                .attr("download", "")                     // Esto forza la descarga
                                .addClass("btn btn-sm btn-info text-white")
                                .html('<i class="fas fa-file-download"></i> Descargar')
                        )
                    )



                    

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
                        url: '/trabajador/guardar/mantenciones', // Ruta del backend para guardar
                        type: 'POST',
                        data: {
                            mantenciones: MantencionesAgregadas,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            $("#successModal").modal('show');
                            $('#texto_success').text('Mantenciones Guardadas con Exito');
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
                    url: '/trabajador/propietarioDelete/' + idPropietario, // Usar template literals para construir la URL
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
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('imagenes');
        const preview = document.getElementById('preview');

        // Abre el selector de archivos al hacer clic en el área
        dropArea.addEventListener('click', () => fileInput.click());

        // Maneja los archivos seleccionados o arrastrados
        function handleFiles(files) {
            preview.innerHTML = ''; // Limpia las vistas previas anteriores
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        preview.appendChild(img);
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
        const videoDropArea = document.getElementById('video-drop-area');
        const videoInput = document.getElementById('videos');

        // Hacer clic en el área abre el selector de archivos
        videoDropArea.addEventListener('click', () => {
            videoInput.click();
        });

        // Manejar el evento de soltar archivos
        function handleVideoDrop(event) {
            event.preventDefault();
            const files = event.dataTransfer.files;

            if (files.length && files[0].type.startsWith('video/')) {
                videoInput.files = files; // Asignar archivos al input
                alert(`Se agregó el video: ${files[0].name}`);
            } else {
                alert('Por favor, sube un archivo de video válido.');
            }
        }

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

        new SlimSelect({
            select: '#arrendatarioInput',
            search: true,
            settings: {
                placeholderText: '🔍 Seleccione una Categoria',
                searchText: 'No se encontraron coincidencias',
                searchPlaceholder: 'Escriba para buscar...',
                allowDeselect: true,
                closeOnSelect: true,
                hideSelected: true,
                searchHighlight: true
            },
            events: {
                afterChange: (newVal) => {
                    if (newVal[0].value === 'nuevo_arrendatario') {
                        // Limpiar selección
                        // slimArrendatario.set('');
                        // Mostrar modal para nuevo arrendatario
                        const modalNuevo = new bootstrap.Modal(document.getElementById('modalNuevoArrendatario'));
                        modalNuevo.show();
                    }
                }
            }
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

    });




</script>
@endsection

@section('css')
@parent
<style>
    /* Cambiar el color del checkbox cuando está activado */
.form-check-input:checked {
    background-color: #198754 !important; /* Bootstrap verde (success) */
    border-color: #fff !important;
}
.form-check-input {
    background-color: #dc3545; /* Bootstrap rojo (danger) */
    /* border-color: #dc3545; */
    /* transition: background-color 0.3s, border-color 0.3s; Animación suave */
}
.form-check-input:disabled {
    background-color: #e9ecef;
    border-color: #ced4da;
    cursor: not-allowed;
}

.form-check-label {
    font-weight: bold;
    color: #495057;
}

.form-check-inline {
    margin-right: 1rem;
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.form-check-input {
    width: 1.5rem;
    height: 1.5rem;
    cursor: pointer;
}

label.form-label {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
}

/* ESTILOS DE SUBIR IMAGENES */
.upload-container {
    border: 2px dashed #000;
    border-radius: 0.5rem;
    text-align: center;
    padding: 2rem;
    color: #6c757d;
    cursor: pointer;
    transition: border-color 0.3s ease, color 0.3s ease;
}



.upload-container img {
    margin-top: 1rem;
    max-width: 100%;
    max-height: 150px;
    border-radius: 0.5rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}
.form-check-label{
    color:#fff;
}
</style>
@endsection

