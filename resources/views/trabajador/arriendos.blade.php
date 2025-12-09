@extends('layouts.app')
@section('content')
    <div class="container-fluid overflow-hidden" style="background-color: #FFAB40">
        <div class="row" style="background-color:rgb(255, 255, 255)">
            @include('layouts.sidebar_trabajador')
            <div class="col d-flex flex-column vh-100" style="padding:0;">
                <div class="flex-grow-1">
                    {{-- Contenido --}}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6"
                                style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px;color:black">
                                <h1>ARRIENDOS</h1>
                            </div>
                        </div>
                    </div>
                    {{-- Tabla de arriendos --}}
                    <div class="container-fluid">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-4 mb-4">
                                <div class="input-group mx-2 shadow-lg" style="max-width: 400px;">
                                    <span class="input-group-text bg-primary text-white shadow-sm">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </span>
                                    <input type="text" id="buscador_cnn" placeholder="Buscar Arriendo" 
                                        class="form-control shadow-sm border-0" 
                                        style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                </div>                            
                            </div>
                            <div class="col-md-3 mb-4 text-end">
                                <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal"
                                    data-bs-target="#agregarArriendo" style=>
                                    <span>AGREGAR ARRIENDO</span>
                                </button>
                            </div>
                        </div>
                        <div class="table-container tabla-scroll shadow-lg">
                            <table class="table table-striped-columns">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Arrendatario</th>
                                        <th>Propiedad</th>
                                        <th>Inicio de Arriendo</th>
                                        {{-- <th>Fecha Devolucion</th> --}}
                                        <th>Fecha Pago</th>
                                        <th>Valor Arriendo</th>
                                        <th>Comision</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaUa">
                                    @foreach ($arriendos as $arriendo)
                                        <tr id="filas">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $arriendo->arrendatario->nombre }}</td>
                                            <td>{{ $arriendo->propiedad->tipo_vivienda }} -
                                                {{ $arriendo->propiedad->direccion }}</td>
                                            <td>{{ $arriendo->fecha_entrega }}</td>
                                            {{-- <td>{{ $arriendo->fecha_devolucion }}</td> --}}
                                            <td>{{ $arriendo->fecha_pago }}</td>
                                            <td>$ {{ $arriendo->valor_real }}</td>
                                            <td>{{ $arriendo->comision->porcentaje }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm btn-editar m-1"
                                                    data-id="{{ $arriendo->id }}"><i class="fas fa-edit"></i> </a>
                                                <a href="#" class="btn btn-danger btn-sm borrar-arriendo m-1"
                                                    data-id="{{ $arriendo->id}}"><i class="fas fa-trash-alt"></i></a>
                                                <a href="#" class="btn btn-success btn-sm btn-Contrato m-1"
                                                    data-id="{{ $arriendo->id }}"><i class="fa-regular fa-folder"></i>
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

    <!-- Modal agregar nuevo arriendo-->
    <div class="modal fade" id="agregarArriendo" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="agregarArriendoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarArriendoLabel">Agregar Arriendo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="arriendoForm" action="{{ url('/trabajador/arriendos/add_arriendos') }}" method="POST"
                        enctype="multipart/form-data" id="form-arriendo">
                        @csrf
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3 col-4">
                                    <label for="propiedadesInput"><b>Propiedades</b></label>
                                    <select class="form-select mt-2" id="propiedadesInput" required>
                                        <option disabled selected value="">Seleccione una Propiedad</option>
                                        @foreach ($propiedades as $pro)
                                            <option value="{{ $pro->id }}">{{ $pro->tipo_vivienda }} -
                                                {{ $pro->direccion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group mb-3 col-4">
                                    <label for="valorArriendoInput"><b>Valor Arriendo Diciembre</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-2">$</span>
                                        <input type="text" class="form-control mt-2" id="valorArriendoInput"
                                            placeholder="Ej: $460.000" required readonly>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-4">
                                    <label for="valorArriendoAñocorridoInput"><b>Valor Arriendo Año corrido</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-2">$</span>
                                        <input type="text" class="form-control mt-2" id="valorArriendoAñocorridoInput"
                                            placeholder="Ej: $460.000" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-4">
                                    <label for="valorreal"><b>Valor real para el Arriendo</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">$</span>
                                        </div>
                                        <input type="text" class="form-control mt-2" id="valorreal"
                                            placeholder="Ej:$480.000" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-4">
                                    <label for="mesGarantiaInput"><b>Mes Garantia</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">$</span>
                                        </div>
                                        <input type="text" class="form-control mt-2" id="mesGarantiaInput"
                                            placeholder="Ej:$460.000" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-4">
                                    <label for="gastosComunesInput"><b>Gastos Comunes</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-2">$</span>
                                        <input type="text" class="form-control mt-2" id="gastosComunesInput"
                                            placeholder="Ej: $450.000" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="fechaPagoInput"><b>Fecha de Pago</b></label>
                                    <input type="date" class="form-control mt-2" id="fechaPagoInput" required>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="estado" class="mb-3"><b>Estado del pago</b></label>
                                    <select name="estado" class="form-select" id="estado">
                                        <option value="">Seleccione un estado del pago</option>
                                        @foreach($estados as $es)
                                            <option value="{{$es->id}}">{{$es->estado}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="fechaEntregaInput"><b>Fecha inicio de Arriendo</b></label>
                                    <input type="date" class="form-control mt-2" id="fechaEntregaInput" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="arrendatarioInput"><b>Arrendatario</b></label>
                                    <select class="form-select mt-2" id="arrendatarioInput" required>
                                        <option disabled selected value="">Seleccione un Arrendatario</option>
                                        @foreach ($arrendatario as $arren)
                                            <option value="{{ $arren->id }}">{{ $arren->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="comisionesInput"><b>Comisiones</b></label>
                                    <select class="form-select mt-2" id="comisionesInput" required>
                                        <option disabled selected value="">Seleccione una Comisión</option>
                                        @foreach ($comision as $com)
                                            <option value="{{ $com->id }}">{{ $com->porcentaje }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-lg-4">
                                    <label for="reajusteInput"><b>Reajuste IPC</b></label>
                                    <input type="text" class="form-control mt-2" placeholder="Reajuste IPC" id="reajusteInput" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="modal-title" id="agregarContratoLabel">Agregar Documentos</h5>
                                </div>
                                <div class="modal-body">

                                        <div class="mb-3">
                                            <label for="contrato" class="form-label"><strong>Selecciona el archivo a cargar:</strong></label>
                                            <input type="file" name="contratos[]" accept=".pdf,.doc,.docx" required class="form-control" id="Archivo" multiple>
                                        </div>
                                        <button type="button" class="btn btn-success m-1 text-uppercase text-white" id="agregar-datos"><b>Agregar Documentos</b></button>
                                    </form>
                                </div>
                                <ul class="text-uppercase mt-4" id="lista-Datos">
                                    <!-- Lista de documentos cargados -->
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <ul class="text-uppercase mt-4" id="lista-Datos">
                    <!-- Lista de documentos cargados -->
                </ul>
                <div class="modal-footer">
        
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" id="btn_agregar" class="btn btn-primary m-2">Guardar</button>
                        <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-2"
                        data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    </div>
    </div>

    <!-- Modal editar arriendo-->
    <div class="modal fade" id="editarArriendo" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="editarArriendoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarArriendoLabel">Editar Arriendo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body ">
                    <form>
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="propiedadesEditInput"><b>Propiedades</b></label>
                                    <select class="form-select mt-2" id="propiedadesEditInput">
                                        <option disabled selected value="">Seleccione una Propiedad</option>
                                        @foreach ($propiedades as $pro)
                                            <option value="{{ $pro->id }}">{{ $pro->tipo_vivienda }} -
                                                {{ $pro->direccion }}</option>
                                        @endforeach
                                        {{-- <option value="otros">Otros</option> --}}
                                    </select>
                                </div>
                                
                                <div class="form-group mb-3 col-6">
                                    <label for="valorArriendoEditInput"><b>Valor Arriendo</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">$</span>
                                        </div>
                                        <input type="text" class="form-control mt-2" id="valorArriendoEditInput"
                                            placeholder="Ej:$460.000" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="mesGarantiaEditInput"><b>Mes Garantia</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">$</span>
                                        </div>
                                        <input type="text" class="form-control mt-2" id="mesGarantiaEditInput" required>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="gastosComunesEditInput"><b>Gatos Comunes</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mt-2">$</span>
                                        </div>
                                        
                                        <input type="text" class="form-control mt-2" id="gastosComunesEditInput"
                                            placeholder="Ej: $450.000" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                            </div>
                            <div class="row">
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
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-6">
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

    <!-- Modal Editar contrato-->
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
        <div class="modal-dialog"> <!-- Centrado en la pantalla -->
            <div class="modal-content"  style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
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
                    <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar Arriendo?</h2>
                        <div class="modalfooter d-flex justify-content-center">
                            <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="confirmDelete" class="btn btn-secondary m-2">Eliminar</button>
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
                    <h5 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar el contrato?</h2>
                        <div class="modalfooter d-flex justify-content-center">
                            <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="confirmarEliminarContratoBtn" class="btn btn-secondary m-2">Eliminar</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal exito -->
    <div class="modal fade" id="modalexito" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalexitoLabel" aria-hidden="true">
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
                                    id="close_success_exito"></button>
                            </div>
                        </div>
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
                $("#tablaUa #filas").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            ////////////////////////////lista de Documentos agregados /////////////////////////
            const archivosSeleccionados = [];
            // Evento para agregar archivos
            document.getElementById('agregar-datos').addEventListener('click', function() {
                const inputArchivo = document.getElementById('Archivo');
                const listaDatos = document.getElementById('lista-Datos');

                if (inputArchivo.files.length > 0) {
                    // Agregar todos los archivos seleccionados al array
                    Array.from(inputArchivo.files).forEach(archivo => {
                        archivosSeleccionados.push(archivo);
                        const li = document.createElement('li');
                        li.textContent = archivo.name; // Muestra el nombre del archivo
                        listaDatos.appendChild(li);
                    });

                    // Resetear el input para permitir cargar el mismo archivo nuevamente si es necesario
                    inputArchivo.value = '';
                } else {
                    alert('Por favor, selecciona un archivo antes de agregar.');
                }
            });

            // Evento para enviar los datos
            $("#btn_agregar").on('click', function(event) {
                event.preventDefault();
                // $("#modalexito").modal('show');

                // Obtener los valores de los campos de texto
                // var fecha_devolucion = $("#fechaDevolucionInput").val();
                var fecha_entrega = $("#fechaEntregaInput").val();
                var valor_arriendo = $("#valorArriendoInput").val();
                var mes_garantia = $("#mesGarantiaInput").val();
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
                    url: '{{ url('/trabajador/arriendos/add_arriendos') }}',
                    type: 'POST',
                    data: formData,
                    processData: false, // Para evitar que jQuery procese los datos
                    contentType: false, // Para evitar que jQuery establezca el tipo de contenido
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);
                        $("#agregarArriendo").modal('hide');
                        $("#modalexito").modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#agregarArriendo").modal('hide');

                        // alert('erro al agregar');
                        $('#modalerror').modal('show');
                    }
                });
            }); // fin agregar arriendo
            //funcion al cerrar modal sucess actualice los datos
            $("#close_success_exito").click(function() {
                $("#modalexito").modal('hide');
                location.reload();
            });

            // boton trae datos del arriendo para editar
            $(".btn-editar").on('click', function(event) {
                event.preventDefault();
                idArriendo = $(this).data('id');
                console.log('Editar Arriendo id ' + idArriendo);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/trabajador/arriendos/editar/' + idArriendo,
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
                        $("#mesGarantiaEditInput").val(respuesta.arriendos.mes_garantia);
                        $("#gastosComunesEditInput").val(respuesta.arriendos.gastos_comunes);
                        $("#fechaPagoEditInput").val(respuesta.arriendos.fecha_pago);
                        $("#propiedadesEditInput").val(respuesta.arriendos.id_propiedad);
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
                var mes_garantia = $("#mesGarantiaEditInput").val();
                var gastos_comunes = $("#gastosComunesEditInput").val();
                var fecha_pago = $("#fechaPagoEditInput").val();
                var propiedad = $("#propiedadesEditInput").val();
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
                    propiedad: propiedad,
                    arrendatario: arrendatario,
                    comisiones: comisiones,
                    estadoedit: estadoedit,
                    reajusteedit: reajusteedit
                };

                console.log(argumentos);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url('/trabajador/arriendos/add_editar_arriendos') }}',
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
                $("#confirmDelete").click(function() {
                    $("#modalinfo").modal('hide');
                    // Realizar la solicitud AJAX
                    $.ajax({
                        url: '{{ url('/trabajador/arriendos/eliminar') }}',
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
        // Botón buscar valor de la propiedad
        $("#propiedadesInput").on('change', function(event) {
            event.preventDefault();
            var id_propiedad = $(this).val(); // Obtener el valor seleccionado del select
            console.log('ID de la propiedad seleccionada: ' + id_propiedad);

            if (!id_propiedad) {
                console.log("No se seleccionó ninguna propiedad.");
                $("#valorArriendoInput").val(''); // Limpiar el input si no hay selección
                $("#valorArriendoAñocorridoInput").val(''); // Limpiar el otro input también
                return;
            }

            // Realizar la solicitud AJAX
            $.ajax({
                url: `/trabajador/propiedades/${id_propiedad}/valor-arriendo`, // Ruta configurada en Laravel
                type: 'GET',
                dataType: 'json',
                success: function(respuesta) {
                    console.log("Respuesta del servidor:", respuesta);

                    if (respuesta) {
                        // Verificar si los valores 'diciembre' y 'año_corrido' existen
                        const valorDiciembre = respuesta.diciembre || 0;
                        const valorAnoCorrido = respuesta.ano_corrido || 0;

                        // Formatear los valores recibidos con separadores de miles
                        const valorFormateado = new Intl.NumberFormat('es-CL', { useGrouping: true }).format(valorDiciembre);
                        const valorFormateadoAnocorrido = new Intl.NumberFormat('es-CL', { useGrouping: true }).format(valorAnoCorrido);

                        // Actualizar los inputs con los valores formateados
                        $("#valorArriendoInput").val(valorDiciembre);
                        $("#valorArriendoAñocorridoInput").val(valorAnoCorrido);
                    } else {
                        console.log("No se encontró el valor del arriendo.");
                        $("#valorArriendoInput").val('');
                        $("#valorArriendoAñocorridoInput").val('');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error al obtener el valor del arriendo:", errorThrown);
                    alert('Hubo un error al obtener el valor del arriendo. Intente nuevamente.');
                }
            });
        });


        function formatCurrency(inputId) {
            document.getElementById(inputId).addEventListener('input', function(event) {
                let value = event.target.value.replace(/\D/g, ''); // Elimina cualquier cosa que no sea dígito
                value = new Intl.NumberFormat('es-CL').format(value); // No se especifica minimumFractionDigits
                event.target.value = value;
            });
        }

        // Aplicar a los campos necesarios
        formatCurrency('valorArriendoInput');
        formatCurrency('valorreal');
        formatCurrency('mesGarantiaInput');
        formatCurrency('gastosComunesInput');
        formatCurrency('valorArriendoEditInput');
        formatCurrency('mesGarantiaEditInput');
        formatCurrency('gastosComunesEditInput');



  ////MOSTRAR MODAL DE TABLA DE ARCHIVOS ///
  $(".btn-Contrato").on('click', function(event) {
    event.preventDefault();

            var id_contrato = $(this).data('id');

            $.ajax({
                    url: '/trabajador/Mostrar/Archivo/' + id_contrato,
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
        ////////////////////////////lista de Documentos agregados /////////////////////////
        const archivosSeleccionados2 = [];
// Evento para agregar archivos
    document.getElementById('agregar-datossolo').addEventListener('click', function() {
    const inputArchivo = document.getElementById('Archivos2');
    const listaDatos2 = document.getElementById('lista-Datosdos');

    if (inputArchivo.files.length > 0) {
        // Agregar todos los archivos seleccionados al array
        Array.from(inputArchivo.files).forEach(archivo => {
            archivosSeleccionados2.push(archivo);
            const li = document.createElement('li');
            li.textContent = archivo.name; // Muestra el nombre del archivo
            listaDatos2.appendChild(li);
        });

        // Resetear el input para permitir cargar el mismo archivo nuevamente si es necesario
        inputArchivo.value = '';
    } else {
        alert('Por favor, selecciona un archivo antes de agregar.');
    }
});

$(document).ready(function () {
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
            url: '/trabajador/archivos/guardar/' + idArriendo, // Ruta del controlador en Laravel
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // alert('Archivos guardados exitosamente');
                $('#ModificarArchivoModal').modal('hide');
                $('#modalexito').modal('show');

                // Actualiza la lista de archivos si es necesario
                $('#listaArchivos').html(response);
            },
            error: function (response) {
                alert('Hubo un error al guardar los archivos');
            }
        });
    });
});





$(document).ready(function() {
    var contratoId; // Variable para almacenar el ID del contrato a eliminar

    // Delegación de eventos para el botón de eliminación
    $(document).on('click', '.borrar-contrato-btn', function(e) {
        e.preventDefault(); // Evitar el comportamiento por defecto del enlace

        // Obtener el ID del contrato
        contratoId = $(this).data('id'); // Obtener el ID del contrato
        $('#confirmarEliminarContratoBtn').data('id', contratoId); // Pasar el ID al botón de confirmación

        // Mostrar el modal
        $('#eliminarContratoModal').modal('show');
    });

    // Escuchar el clic en el botón de confirmar eliminación
    $('#confirmarEliminarContratoBtn').on('click', function() {
        // Realizar la solicitud AJAX
        $.ajax({
            url: '/trabajador/elimicontra/' + contratoId,
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

   // Manejar el clic en el botón de eliminar contrato
  



    </script>
@endsection
