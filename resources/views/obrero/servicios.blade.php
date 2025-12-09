@extends('layouts.app')
@section('content')
<div class="container-fluid overflow-hidden" style="background-color: #FFAB40">
    <div class="row" style="background-color:rgb(255, 255, 255)">
            @include('layouts.sidebar_obrero')
            <div class="col d-flex flex-column h-100" style="padding:0;">
                <div class="flex-grow-1">
                    {{-- Contenido --}}
                    <div class="container-fluid" >
                        <div class="row">
                            <div class="col-6"
                                style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px;color:black">
                                <h1 class="text-uppercase">Servicios</h1>
                            </div>
                        </div>
                    </div>
                    {{-- Tabla de pagos --}}
                    <div class="container-fluid ">
                        <div class="row justify-content-between align-items-center">
                            <div class="input-group mx-2" style="max-width: 400px;">
                                <span class="input-group-text bg-primary text-white shadow-sm">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="text" id="buscador_cnn" placeholder="Buscar" class="form-control">
                            </div>
                            <div class="col-md-3 mb-4 text-end">
                                <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal"
                                    data-bs-target="#agregarServicio" style=>
                                    <span>Agregar Servicio</span>
                                </button>
                            </div>
                        </div>

                        <div class="overflow-auto" style="max-height: 62vh;">                            <h4>Línea Blanca</h4>
                            <div class="table-responsive">
                        
                                <table class="table table-striped-columns">
                                    <thead>
                                        <tr>
                                            <th>#</th>    
                                            <th>Propiedad</th>     
                                            <th>Trabajador</th>                               
                                            <th>Fecha</th>
                                            <th>Trabajo</th>
                                            <th>Mano Obra</th>
                                            <th>Dias Garantia</th>
                                            <th>Valor Total</th>
                                            <th>Acciones</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaLBlanca">
                                        @foreach ($servtecs as $servtec)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $servtec->propiedad->direccion }}</td>                                    
                                                <td>{{ $servtec->nombre_trabajador }}</td>
                                                <td>{{ $servtec->fecha }}</td>
                                                <td>{{ $servtec->trabajo_realizado }}</td>                                            
                                                <td>{{ $servtec->mano_obra_valor }}</td>   
                                                <td>{{ $servtec->garantia }}</td>  
                                                <td>{{ $servtec->valor_total }}</td>              
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-sm editar-servicio"
                                                        data-id="{{ $servtec->id }}" data-tipo="1"><i class="fas fa-edit"></i> </a>
                                                    <a href="#" class="btn btn-danger btn-sm borrar-servicio"
                                                        data-id="{{ $servtec->id }}" data-tipo="1"><i class="fas fa-trash-alt"></i></a>
                                                    <a href="#" class="btn btn-info btn-sm ver-imagenes"
                                                        data-id="{{ $servtec->id }}" data-tipo="1"><i class="fa-solid fa-panorama"></i> </a>
                                                    <a href="#" class="btn btn-info btn-sm ver-video"
                                                        data-id="{{ $servtec->id }}" data-tipo="1"><i class="fa-solid fa-play-circle"></i></a>
                                                    <a href="#" class="btn btn-info btn-sm ver-archivo"
                                                        data-id="{{ $servtec->id }}" data-tipo="1">
                                                            <i class="fa-solid fa-upload"></i></a>
                                                    {{-- <a href="#" class="btn btn-success btn-sm ver-materiales" 
                                                        data-id="{{ $servtec->id }}" data-tipo="1"> <i class="fas fa-file-excel"></i> --}}
                                                
                                                    </td>
                                                
                                                <!-- Estado con clase condicional -->
                                            <td>
                                                <input type="checkbox" class="cambiar-estado" data-id="{{ $servtec->id }}" data-estado="{{ $servtec->estado }}" {{ $servtec->estado == 'Realizado' ? 'checked' : '' }}>
                                                <label for="estado-checkbox" class="{{ $servtec->estado == 'Realizado' ? 'estado-realizado' : 'estado-pendiente' }}">
                                                    {{ $servtec->estado == 'Realizado' ? 'Realizado' : 'Pendiente' }}
                                                </label>
                                            </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <h4>Gasfiteria</h4>
                            <div class="table-responsive">
                                <table class="table table-striped-columns">
                                    <thead>
                                        <tr>
                                            <th>#</th>    
                                            <th>Propiedad</th>     
                                            <th>Trabajador</th>                               
                                            <th>Fecha</th>
                                            <th>Trabajo</th>
                                            <th>Mano Obra</th>
                                            <th>Dias Garantia</th>
                                            <th>Valor Total</th>
                                            <th>Acciones</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaGasfiteria">
                                        @foreach ($gasfiterias as $gasfiteria)
                                            <tr>
                                                
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $gasfiteria->propiedad->direccion }}</td>                                    
                                                <td>{{ $gasfiteria->nombre_trabajador }}</td>
                                                <td>{{ $gasfiteria->fecha }}</td>
                                                <td>{{ $gasfiteria->trabajo_realizado }}</td>                                            
                                                <td>{{ $gasfiteria->mano_obra_valor }}</td>   
                                                <td>{{ $gasfiteria->garantia }}</td>  
                                                <td>{{ $gasfiteria->valor_total }}</td>       
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-sm editar-servicio"
                                                        data-id="{{ $gasfiteria->id }}" data-tipo="2"><i class="fas fa-edit"></i> </a>
                                                    <a href="#" class="btn btn-danger btn-sm borrar-servicio"
                                                        data-id="{{ $gasfiteria->id }}" data-tipo="2"><i class="fas fa-trash-alt"></i></a>
                                                    <a href="#" class="btn btn-info btn-sm ver-imagenes"
                                                        data-id="{{ $gasfiteria->id }}" data-tipo="2"><i class="fa-solid fa-panorama"></i> </a>
                                                    <a href="#" class="btn btn-info btn-sm ver-video"
                                                        data-id="{{ $gasfiteria->id }}" data-tipo="2"><i class="fa-solid fa-play-circle"></i></a>
                                                    <a href="#" class="btn btn-info btn-sm ver-archivo"
                                                        data-id="{{ $gasfiteria->id }}" data-tipo="2">
                                                            <i class="fa-solid fa-upload"></i>
                                                        </a>
                                                        
                                                    {{-- <a href="#" class="btn btn-success btn-sm ver-materiales" 
                                                        data-id="{{ $gasfiteria->id }}" data-tipo="2"> <i class="fas fa-file-excel"></i>
                                                --}}
                                                </td>
                                                    <!-- Estado con clase condicional -->
                                                    <td>
                                                        <input type="checkbox" class="cambiar-estado2" data-id="{{ $gasfiteria->id }}" data-estado="{{ $gasfiteria->estado }}" {{ $gasfiteria->estado == 'Realizado' ? 'checked' : '' }}>
                                                        <label for="estado-checkbox" class="{{ $gasfiteria->estado == 'Realizado' ? 'estado-realizado' : 'estado-pendiente' }}">
                                                            {{ $gasfiteria->estado == 'Realizado' ? 'Realizado' : 'Pendiente' }}
                                                        </label>
                                                    </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <h4>Obras mayores</h4>
                            <div class="table-responsive">
                                <table class="table table-striped-columns">
                                    <thead>
                                        <tr>
                                            <th>#</th>    
                                            <th>Propiedad</th>     
                                            <th>Trabajador</th>                               
                                            <th>Fecha</th>
                                            <th>Trabajo</th>
                                            <th>Mano Obra</th>
                                            <th>Dias Garantia</th>
                                            <th>Valor Total</th>
                                            <th>Acciones</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaOMayor">
                                        @foreach ($obrasmayores as $obramayor)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $obramayor->propiedad->direccion }}</td>
                                                <td>{{ $obramayor->nombre_trabajador }}</td>
                                                <td>{{ $obramayor->fecha }}</td>
                                                <td>{{ $obramayor->trabajo_realizado }}</td>
                                                <td>{{ $obramayor->mano_obra_valor }}</td>
                                                <td>{{ $obramayor->garantia }}</td>
                                                <td>{{ $obramayor->valor_total }}</td>
                                                <td>
                                                    <!-- Botones de acción -->
                                                    <a href="#" class="btn btn-primary btn-sm editar-servicio" data-id="{{ $obramayor->id }}" data-tipo="3"><i class="fas fa-edit"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm borrar-servicio" data-id="{{ $obramayor->id }}" data-tipo="3"><i class="fas fa-trash-alt"></i></a>
                                                    <a href="#" class="btn btn-info btn-sm ver-imagenes" data-id="{{ $obramayor->id }}" data-tipo="3"><i class="fa-solid fa-panorama"></i></a>
                                                    <a href="#" class="btn btn-info btn-sm ver-video" data-id="{{ $obramayor->id }}" data-tipo="3"><i class="fa-solid fa-play-circle"></i></a>
                                                    <a href="#" class="btn btn-info btn-sm ver-archivo" data-id="{{ $obramayor->id }}" data-tipo="3"><i class="fa-solid fa-upload"></i></a>
                                                    <a href="#" class="btn btn-success btn-sm ver-materiales" data-id="{{ $obramayor->id }}" data-tipo="3"><i class="fas fa-file-excel"></i></a>
                                                </td>
                                                    <!-- Estado con clase condicional -->
                                                    <td>
                                                    <input type="checkbox" class="cambiar-estado3" data-id="{{ $obramayor->id }}" data-estado="{{ $obramayor->estado }}" {{ $obramayor->estado == 'Realizado' ? 'checked' : '' }}>
                                                    <label for="estado-checkbox" class="{{ $obramayor->estado == 'Realizado' ? 'estado-realizado' : 'estado-pendiente' }}">
                                                        {{ $obramayor->estado == 'Realizado' ? 'Realizado' : 'Pendiente' }}
                                                    </label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>

                            <h4>Obras Menores</h4>
                            <div class="table-responsive">
                                <table class="table table-striped-columns">
                                    <thead>
                                        <tr>
                                            <th>#</th>    
                                            <th>Propiedad</th>     
                                            <th>Trabajador</th>                               
                                            <th>Fecha</th>
                                            <th>Trabajo</th>
                                            <th>Mano Obra</th>
                                            <th>Dias Garantia</th>
                                            <th>Valor Total</th>
                                            <th>Acciones</th>
                                            <th>Estado</th>

                                        </tr>
                                    </thead>
                                    <tbody id="tablaOMenor">
                                        @foreach ($obrasmenores as $obramenor)
                                            <tr>
                                                
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $obramenor->propiedad->direccion }}</td>                                    
                                                <td>{{ $obramenor->nombre_trabajador }}</td>
                                                <td>{{ $obramenor->fecha }}</td>
                                                <td>{{ $obramenor->trabajo_realizado }}</td>                                            
                                                <td>{{ $obramenor->mano_obra_valor }}</td>   
                                                <td>{{ $obramenor->garantia }}</td>  
                                                <td>{{ $obramenor->valor_total }}</td>       
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-sm editar-servicio"
                                                        data-id="{{ $obramenor->id }}" data-tipo="4"><i class="fas fa-edit"></i> </a>
                                                    <a href="#" class="btn btn-danger btn-sm borrar-servicio"
                                                        data-id="{{ $obramenor->id }}" data-tipo="4"><i class="fas fa-trash-alt"></i></a>
                                                    <a href="#" class="btn btn-info btn-sm ver-imagenes"
                                                        data-id="{{ $obramenor->id }}" data-tipo="4"><i class="fa-solid fa-panorama"></i> </a>
                                                        <a href="#" class="btn btn-info btn-sm ver-video"
                                                        data-id="{{ $obramenor->id }}" data-tipo="4"><i class="fa-solid fa-play-circle"></i></a>
                                                    <a href="#" class="btn btn-info btn-sm ver-archivo"
                                                        data-id="{{ $obramenor->id }}" data-tipo="4">
                                                            <i class="fa-solid fa-upload"></i>
                                                        </a> 
                                                    <a href="#" class="btn btn-success btn-sm ver-materiales" 
                                                        data-id="{{ $obramenor->id }}" data-tipo="4"> <i class="fas fa-file-excel"></i>

                                                </td>
                                                <!-- Estado con clase condicional -->
                                                <td>
                                                    <input type="checkbox" class="cambiar-estado4" data-id="{{ $obramenor->id }}" data-estado="{{ $obramenor->estado }}" {{ $obramenor->estado == 'Realizado' ? 'checked' : '' }}>
                                                    <label for="estado-checkbox" class="{{ $obramenor->estado == 'Realizado' ? 'estado-realizado' : 'estado-pendiente' }}">
                                                        {{ $obramenor->estado == 'Realizado' ? 'Realizado' : 'Pendiente' }}
                                                    </label>
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
    </div>
    <style>
        .estado-pendiente {
            color: red;
            font-weight: bold;
        }
        .estado-realizado {
            color: green;
            font-weight: bold;
        }
    </style>
    {{-- SECCION DE MODALES --}}

    <!-- Modal de creación de nuevos servicios flexible -->
    <div class="modal fade" id="agregarServicio" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="agregarServicioLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarServicioLabel">Agregar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <form>
                        <div class="container">

                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label class="mb-1" for="tiposervicio"><b>Tipo de Servicio</label>
                                    <select class="form-select" id="tiposervicio">
                                        <option value="" selected disabled>Seleccione el tipo de servicio</option>
                                        <option value="1">Linea Blanca</option>
                                        <option value="2">Gasfiteria</option>
                                        <option value="3">Obra Mayor</option>
                                        <option value="4">Obra Menor</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="propiedadServicioInput"><b>Propiedad del Servicio</b></label>
                                    <select class="form-select mt-2" id="propiedadServicioInput">
                                        <option disabled selected value="">Seleccione una Propiedad</option>
                                        @foreach ($propiedades as $propiedad)
                                            <option value="{{ $propiedad->id }}">{{ $propiedad->direccion }}</option>
                                        @endforeach                                        
                                    </select>
                                </div>
                            </div>                       

                            <div class="row"> 
                                <div class="form-group mb-3"> 
                                    <label class="mb-1" for="trabajador">Trabajador</label> 
                                    <select class="form-control" id="trabajador" name="trabajador" required> 

                                        <option value="null" disabled selected>Elija Trabajador</option> 
                                        <option value="">Externo</option> 

                                        @foreach($trabajadores as $trabajador) 
                                            <option value="{{ $trabajador->id }}">{{ $trabajador->name }}</option> 
                                        @endforeach 

                                    </select> 
                                </div>
                            </div>

                            <!-- Campo no-oculto para el nombre del trabajador externo -->
                            <div class="row"> 
                                <div class="form-group mb-3"> 
                                    <label class="mb-1" for="nombretrabajadorEservicio">Nombre del Trabajador Externo</label> 
                                    <input type="text" class="form-control" id="nombretrabajadorEservicio" name="nombretrabajadorEservicio" disabled> 
                                </div> 
                            </div>
                            
                            <!-- Campo oculto para el nombre del trabajador interno --> 
                            <input type="hidden" id="nombretrabajadorIservicio" name="nombretrabajadorIservicio">

                            <div class="row">
                                <div class="form-group mb-3">
                                    <label class="mb-1" for="fechaservicio">Fecha de Servicio</label>
                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="fechaservicio" required></input>
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="form-group mb-3"> 
                                    <label class="mb-1" for="descripcionservicio">Descripcion del Trabajo</label> 
                                    <textarea class="form-control" id="descripcionservicio" name="descripcionservicio" rows="4"></textarea> 
                                </div> 
                            </div>

                            {{-- <div class="row">

                                <div class="form-group mb-3 col-6"> 
                                    <label for="manoservicio"><b>Valor Mano de Obra</b></label> 
                                    <div class="input-group mt-2"> 
                                        <div class="input-group-prepend"> 
                                            <span class="input-group-text">$</span> 
                                        </div> 
                                        <input type="text" class="form-control" id="manoservicio" placeholder="Ej: 40000" required> 
                                    </div> 
                                </div>
                            
                                <div class="form-group mb-3 col-6">
                                    <label for="garantiaservicio"><b>Dias de garantia</b></label>
                                    <input type="text" class="form-control mt-2" id="garantiaservicio"
                                        placeholder="Ej: 200" required>
                                </div>

                            </div>     
                                                        
                            <div class="row"> 
                                <div class="form-group mb-3"> 
                                    <label class="mb-1" for="totalServicio">Valor Total del Trabajo</label> 
                                    <div class="input-group"> 
                                        <span class="input-group-text">$</span> 
                                        <input type="text" class="form-control" id="totalServicio" name="totalServicio"> 
                                    </div> 
                                </div> 
                            </div> --}}
                            
                            <!-- Botones de cambios -->
                            <div class="d-flex justify-content-end">
                                <button type="button" id="btn_agregar_servicio" class="btn btn-primary m-2">Guardar</button>
                                <button type="button" id="btn_cerrar_agregar" class="btn btn-danger m-2" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </div>
    <!-- Modal de edición de servicios flexible -->    
    <div class="modal fade" id="ServicioEdit" tabindex="-1" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="ServicioEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="ServicioEditLabel">Editar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body ">
                    <form>
                        <div class="container">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="propiedadServicioEdit"><b>Propiedad del Servicio</b></label>
                                    <select class="form-select mt-2" id="propiedadServicioEdit">
                                        <option disabled selected value="">Seleccione una Propiedad</option>
                                        @foreach ($propiedades as $propiedad)
                                            <option value="{{ $propiedad->id }}">{{ $propiedad->direccion }}</option>
                                        @endforeach                                        
                                    </select>
                                </div>
                            </div>                       

                            <div class="row"> 
                                <div class="form-group mb-3"> 
                                    <label class="mb-1" for="trabajadorEdit">Trabajador</label> 
                                    <select class="form-control" id="trabajadorEdit" name="trabajadorEdit" required> 
                                        <option value="">Externo</option> 
                                        @foreach($trabajadores as $trabajador) 
                                            <option value="{{ $trabajador->id }}">{{ $trabajador->name }}</option> 
                                        @endforeach 
                                    </select> 
                                </div> 
                            </div>

                            <!-- Campo oculto para el nombre del trabajador externo -->
                            <div class="row"> 
                                <div class="form-group mb-3"> 
                                    <label class="mb-1" for="nombretrabajadorEservicioEdit">Nombre del Trabajador Externo</label> 
                                    <input type="text" class="form-control" id="nombretrabajadorEservicioEdit" name="nombretrabajadorEservicioEdit" disabled> 
                                </div> 
                            </div> 
                            
                            <!-- Campo oculto para el nombre del trabajador interno --> 
                            <input type="hidden" id="nombretrabajadorIservicioEdit" name="nombretrabajadorIservicioEdit">

                            <div class="row">
                                <div class="form-group mb-3">
                                    <label class="mb-1" for="fechaservicioEdit">Fecha de Servicio</label>
                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="fechaservicioEdit" required></input>
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="form-group mb-3"> 
                                    <label class="mb-1" for="descripcionservicioEdit">Descripcion del Trabajo</label> 
                                    <textarea class="form-control" id="descripcionservicioEdit" name="descripcionservicioEdit" rows="4"></textarea> 
                                </div> 
                            </div>

                            <div class="row">

                                <div class="form-group mb-3 col-6"> 
                                    <label for="manoservicioEdit"><b>Valor Mano de Obra</b></label> 
                                    <div class="input-group mt-2"> 
                                        <div class="input-group-prepend"> 
                                            <span class="input-group-text">$</span> 
                                        </div> 
                                        <input type="text" class="form-control" id="manoservicioEdit" placeholder="Ej: 40000" required> 
                                    </div> 
                                </div>
                            
                                <div class="form-group mb-3 col-6">
                                    <label for="garantiaservicioEdit"><b>Dias de garantia</b></label>
                                    <input type="text" class="form-control mt-2" id="garantiaservicioEdit"
                                        placeholder="Ej: 200" required>
                                </div>

                            </div>     
                                                        
                            <div class="row"> 
                                <div class="form-group mb-3"> 
                                    <label class="mb-1" for="totalServicioEdit">Valor Total del Trabajo</label> 
                                    <input type="text" class="form-control" id="totalServicioEdit" name="totalServicioEdit"> 
                                </div> 
                            </div>          

                            <!-- Campo oculto para mantener id y tipo-->
                            <input type="hidden" id="editar-idServicio">
                            <input type="hidden" id="editar-idServicioTipo">
                            
                            <div class="d-flex justify-content-end">

                            <!-- Botones de cambios -->
                            <button type="button" id="btn_edit_servicio" class="btn btn-primary">Guardar</button>
                            <button type="button" id="btn_cerrar_editar" class="btn btn-danger"
                                data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
 </div>

    <!-- Modal de mostrar imagenes -->
    <div class="modal fade" id="modalImagenes" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addImagenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImagenModalLabel">Administración de Imagenes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Imagenes</h3>
                        <button type="button" id="btnAgregarImagen" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addImagenModal">
                            Añadir Imagen
                        </button>
                    </div>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                           
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Link</th>         
                                <th>Documento</th> 
                                <th>Tipo</th>
                                <th>Acciones</th>                         
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se cargarán los datos de forma dinámica -->
                        </tbody>
                    </table>  
                    {{-- <div style="height: 20px;"></div>
                    <table class="table table-bordered">
                        <thead>
                            <h3>Videos</h3>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Link</th>         
                                <th>Documento</th> 
                                <th>Tipo</th>
                                <th>Acciones</th>                         
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se cargarán los datos de forma dinámica -->
                        </tbody>
                    </table>  
                    <div style="height: 20px;"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Link</th>         
                                <th>Documento</th> 
                                <th>Tipo</th>
                                <th>Acciones</th>                         
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se cargarán los datos de forma dinámica -->
                        </tbody>
                    </table>                                         --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de agregar imagenes -->
    <div class="modal fade" id="addImagenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Imagen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Campos de entrada -->
                <div class="modal-body">
                    <form id="addImagenForm" enctype="multipart/form-data">

                        <div class="mb-3"> 
                            <label for="tipoInput" class="form-label">Tipo de archivo</label> 
                            <select class="form-control" id="tipoInput" name="tipo" disabled> 
                                <option value="imagen">Imagen</option> 
                                {{-- <option value="video">Video</option> --}}  
                                {{-- <option value="documento">Documento</option>  --}}
                            </select> 
                        </div>

                        <div class="mb-3">
                            <label for="imagenInput" class="form-label">Selecciona un archivo</label>
                            <input type="file" class="form-control" id="imagenInput" name="imagen">
                        </div>                        

                        <!-- Campo oculto para mantener id y tipo del servicio-->
                        <input type="hidden" id="imagen-idServicio">
                        <input type="hidden" id="imagen-tipoServicio">
                        <div class="modal-footer">
                        <button type="submit" id="btn_guardar_imagen" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="addImagenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Archivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Campos de entrada -->
                <div class="modal-body">
                    <form id="addImagenForm" enctype="multipart/form-data">

                        {{-- <div class="mb-3"> 
                            <label for="tipoInput" class="form-label">Tipo de archivo</label> 
                            <select class="form-control" id="tipoInput" name="tipo"> 
                                <option value="imagen">Imagen</option> 
                                <option value="video">Video</option> 
                                <option value="documento">Documento</option> 
                            </select> 
                        </div> --}}

                        {{-- <div class="mb-3">
                            <P><label for="imagenInput" class="form-label">Selecciona una Imegen</label></P>
                            <input type="file" class="form-control" id="imagenInput" name="imagen">
                        </div>        --}}
                        {{-- <div class="mb-3">
                           <P> <label for="imagenInput" class="form-label">Selecciona un Video</label></P>
                            <input type="file" class="form-control" id="videoInput" name="imagen">
                        </div>  
                        <div class="mb-3">
                            <p><label for="imagenInput" class="form-label">Selecciona un archivo</label>
                            <input type="file" class="form-control" id="ArchivoInput" name="imagen">
                        </div>                    --}}

                        <!-- Campo oculto para mantener id y tipo del servicio-->
                        {{-- <input type="hidden" id="imagen-idServicio">
                        <input type="hidden" id="imagen-tipoServicio">
                        <div class="modal-footer">
                        <button type="submit" id="btn_guardar_imagen" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Modal de reemplazar imagen -->
    <div class="modal" tabindex="-1" id="modal-reemplazar-imagen">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reemplazar Imagen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form>

                        <div class="mb-3"> 
                            <label for="tipoInputEdit" class="form-label">Tipo de archivo</label> 
                            <select class="form-control" id="tipoInputEdit" name="tipoEdit" disabled> 
                                <option value="imagen">Imagen</option> 
                                {{-- <option value="video">Video</option> 
                                <option value="documento">Documento</option>  --}}
                            </select> 
                        </div>

                        <div class="mb-3">
                            <label for="reemplazar-imagenInput" class="form-label">Selecciona el archivo nuevo</label>
                            <input type="file" class="form-control" id="reemplazar-imagenInput" name="imagen">
                        </div>   
                                             

                        <!-- Campo oculto para mantener ids y tipo de servicio-->
                        <input type="hidden" id="imagen-idServicioE">
                        <input type="hidden" id="imagen-tipoServicioE">
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="guardar-nueva-imagen">Reemplazar archivo</button>
                </div>

            </div>
        </div>
    </div>


    

    {{-- Modal dinamico para mostrar materiales --}}
    <div class="modal fade" id="modalMateriales" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMaterialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMaterialModalLabel">Administración de materiales</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="container" style="display: flex; justify-content: flex-end">
                        <button type="button" id="btnAgregarMaterial" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addMaterialModal">
                            Añadir Material
                        </button>
                    </div>

                    <div style="height: 20px;"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Precio</th>                          
                                <th>Acciones</th>                         
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se cargarán los datos de forma dinámica -->
                        </tbody>
                    </table>                                        
                </div>
            </div>
        </div>
    </div>
  <!-- Modal de mostrar videos -->
  <div class="modal fade" id="modalVideos" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addVideoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVideoModalLabel">Administración de Videos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <div class="d-flex justify-content-between align-items-center">
                    <h3>Videos </h3>
                    <button type="button" id="btnAgregarImagen" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addVideoModal">
                        Añadir Video 
                    </button>
                </div>
                <br>
              
                <table class="table table-bordered">
                    <thead>
                        
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Link</th>         
                            <th>Documento</th> 
                            <th>Tipo</th>
                            <th>Acciones</th>                         
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se cargarán los datos de forma dinámica -->
                    </tbody>
                </table>  
                                                    
            </div>
        </div>
    </div>
</div>

<!-- Modal de agregar Videos -->
<div class="modal fade" id="addVideoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Campos de entrada -->
            <div class="modal-body">
                <form id="addVideoForm" enctype="multipart/form-data">

                    <div class="mb-3"> 
                        <label for="tipoInput" class="form-label">Tipo de archivo</label> 
                        <select class="form-control" id="tipoInputvi" name="tipo" disabled> 
                            {{-- <option value="imagen">Imagen</option>  --}}
                            <option value="video">Video</option> 
                            {{-- <option value="documento">Documento</option>  --}}
                        </select> 
                    </div>

                    <div class="mb-3">
                        <label for="imagenInput" class="form-label">Selecciona un archivo</label>
                        <input type="file" class="form-control" id="imagenInput" name="imagen">
                    </div>                        

                    <!-- Campo oculto para mantener id y tipo del servicio-->
                    <input type="hidden" id="video-idServicio">
                    <input type="hidden" id="video-tipoServicio">
                    <div class="modal-footer">
                    <button type="submit" id="btn_guardar_imagen" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
 <!-- Modal de reemplazar Video -->
 <div class="modal" tabindex="-1" id="modal-reemplazar-video">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reemplazar Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form>

                    <div class="mb-3"> 
                        <label for="tipoInputviEdit" class="form-label">Tipo de archivo</label> 
                        <select class="form-control" id="tipoInputviEdit" name="tipoEdit" disabled> 
                            {{-- <option value="imagen">Imagen</option>  --}}
                            <option value="video">Video</option> 
                            {{-- <option value="documento">Documento</option>  --}}
                        </select> 
                    </div>

                    <div class="mb-3">
                        <label for="reemplazar-videoInput" class="form-label">Selecciona el archivo nuevo</label>
                        <input type="file" class="form-control" id="reemplazar-videoInput" name="imagen">
                    </div>   
                                         

                    <!-- Campo oculto para mantener ids y tipo de servicio-->
                    <input type="hidden" id="imagen-idServicioE">
                    <input type="hidden" id="imagen-tipoServicioE">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardar-nueva-video">Reemplazar archivo</button>
            </div>

        </div>
    </div>
</div>

  <!-- Modal de mostrar Documentos -->
  <div class="modal fade" id="modalDocumentos" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addDocumeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDocumeModalLabel">Administración de documentos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="d-flex justify-content-between align-items-center">
                    <h3>Documentos </h3>
                    <button type="button" id="btnAgregarImagen" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addDocumeModal">
                        Añadir Documento
                    </button>
                </div>
                <br>

                <div style="height: 20px;"></div>
                <table class="table table-bordered">
                    <thead>
                        
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Link</th>         
                            <th>Documento</th> 
                            <th>Tipo</th>
                            <th>Acciones</th>                         
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se cargarán los datos de forma dinámica -->
                    </tbody>
                </table>  
                                                    
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="modal-reemplazar-documento">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reemplazar Documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form>

                    <div class="mb-3"> 
                        <label for="tipoInputdoEdit" class="form-label">Tipo de archivo</label> 
                        <select class="form-control" id="tipoInputdoEdit" name="tipoEdit" disabled> 
                            {{-- <option value="imagen">Imagen</option>  --}}
                            {{-- <option value="video">Video</option> --}}
                           <option value="documento">Documento</option>  
                        </select> 
                    </div>

                    <div class="mb-3">
                        <label for="reemplazar-documeInput" class="form-label">Selecciona el archivo nuevo</label>
                        <input type="file" class="form-control" id="reemplazar-documeInput" name="imagen">
                    </div>   
                                         

                    <!-- Campo oculto para mantener ids y tipo de servicio-->
                    <input type="hidden" id="docume-idServicioE">
                    <input type="hidden" id="docume-tipoServicioE">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardar-nueva-docume">Reemplazar archivo</button>
            </div>

        </div>
    </div>
</div>
<!-- Modal de agregar Archivos -->
<div class="modal fade" id="addDocumeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Archivos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Campos de entrada -->
            <div class="modal-body">
                <form id="addDocumeForm" enctype="multipart/form-data">

                    <div class="mb-3"> 
                        <label for="tipoInputdoc" class="form-label">Tipo de archivo</label> 
                        <select class="form-control" id="tipoInputdoc" name="tipo" disabled> 
                            {{-- <option value="imagen">Imagen</option>  --}}
                            {{-- <option value="video">Video</option>  --}}
                            <option value="documento">Documento</option> 
                        </select> 
                    </div>

                    <div class="mb-3">
                        <label for="imagenInput" class="form-label">Selecciona un archivo</label>
                        <input type="file" class="form-control" id="imagenInput" name="imagen">
                    </div>                        

                    <!-- Campo oculto para mantener id y tipo del servicio-->
                    <input type="hidden" id="documento-idServicio">
                    <input type="hidden" id="documento-tipoServicio">
                    <div class="modal-footer">
                    <button type="submit" id="btn_guardar_imagen" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
    {{-- Modal dinamico para agregar materiales --}}
    <div class="modal fade" id="addMaterialModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Campos de entrada -->
                <div class="modal-body">
                    <form id="addMaterialForm">

                        <div class="row"> 
                            <div class="form-group mb-3"> 
                                <label class="mb-1" for="nombreMaterialInput">Nombre del Material</label> 
                                <input type="text" class="form-control" id="nombreMaterialInput" name="nombreMaterialInput"> 
                            </div> 
                        </div>      

                        <div class="row"> 
                            <div class="form-group mb-3"> 
                                <label class="mb-1" for="precioMaterialInput">Precio del Material</label> 
                                <input type="text" class="form-control" id="precioMaterialInput" name="precioMaterialInput"> 
                            </div> 
                        </div>      

                        <!-- Campo oculto para mantener id y tipo del servicio-->
                        <input type="hidden" id="material-idServicio">
                        <input type="hidden" id="material-tipoServicio">
                        <div class="modal-footer">
                        <button type="submit" id="btn_guardar_material" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal dinamico para editar materiales --}}
    <div class="modal" tabindex="-1" id="modal-reemplazar-material">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form>

                        <div class="row"> 
                            <div class="form-group mb-3"> 
                                <label class="mb-1" for="nombreMaterialEdit">Nombre del Material</label> 
                                <input type="text" class="form-control" id="nombreMaterialEdit" name="nombreMaterialEdit"> 
                            </div> 
                        </div>         
                        
                        <div class="row"> 
                            <div class="form-group mb-3"> 
                                <label class="mb-1" for="precioMaterialEdit">Precio del Material</label> 
                                <input type="text" class="form-control" id="precioMaterialEdit" name="precioMaterialEdit"> 
                            </div> 
                        </div>      

                        <!-- Campo oculto para mantener ids y tipo de servicio-->
                        <input type="hidden" id="material-idMaterialE">
                        <input type="hidden" id="material-tipoServicioE">
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="guardar-nuevo-material">Editar Material</button>
                </div>

            </div>
        </div>
    </div>
{{-- Modal que confirma que la tarea ha sido hecha --}}
    <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"aria-labelledby="successLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"  style="background: rgb(0,0,0,0.0); border: none; ">
                <div class="alert alert-success d-flex align-items-center" id="alerta" role="alert">
                    <div class="modal-header">
                        <lord-icon
                            src="https://cdn.lordicon.com/laqlvddb.json"
                            trigger="loop"
                            stroke="light"
                            style="width:70px;height:70px">
                        </lord-icon>
                    </div>
                    <div class="modal-body">
                        <h5 id="texto_success" class="text-uppercase"></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn_cerrar_modal"
                            data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Modal que indica que hubo un error --}}
    <div class="modal fade" id="errorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="errorLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background: rgb(0,0,0,0.0); border: none;">
                <div class="alert alert-danger d-flex align-items-center" id="alertaError" role="alert">
                    <div class="modal-header">
                        <lord-icon
                            src="https://cdn.lordicon.com/nocovwne.json"
                            trigger="loop"
                            colors="primary:#e74c3c"
                            style="width:70px;height:70px">
                        </lord-icon>
                    </div>
                    <div class="modal-body">
                        <h5 id="texto_error" class="text-uppercase"></h5>
                    </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn_cerrar_modal_error" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="successModalEstado" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="successLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background: rgb(0,0,0,0.0); border: none;">
                <div class="alert alert-success d-flex align-items-center" id="alerta" role="alert">
                    <div class="modal-header">
                        <lord-icon
                            src="https://cdn.lordicon.com/laqlvddb.json"
                            trigger="loop"
                            stroke="light"
                            style="width:70px;height:70px">
                        </lord-icon>
                    </div>
                    <div class="modal-body">
                        <h5 id="texto_exito" class="text-uppercase"></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn_cerrar_modalEstado" data-bs-dismiss="modal">Cerrar</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal de confirmación ESTADO -->

    <div class="modal fade" id="confirmModalEstado" tabindex="-1" aria-labelledby="confirmLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none;">
            <div class="alert alert-warning w-90 m-0 position-relative" id="alertaError" role="alert">
              <!-- <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button> -->
              
              <div class="modal-header">
                <div class="mb-3">
                  <lord-icon
                    src="https://cdn.lordicon.com/tdrtiskw.json"
                    trigger="loop"
                    colors="primary:#f39c12"
                    style="width:70px; height:70px;">
                  </lord-icon>
                </div>
                
                <div class="text-center mb-4">
                  <p id="confirmMessage"></p>
                </div>
              </div>
              <div class="d-flex justify-content-end mt-4">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmYes">Sí</button>
              </div>
            </div>
          </div>
        </div>
      </div>



<!-- Modal de error ESTADO -->
<div class="modal fade" id="errorModalEstado" tabindex="-1" aria-labelledby="errorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none;">
            <div class="alert alert-danger d-flex flex-column" id="alertaError" role="alert">
                <!-- <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button> -->
                
                <div class="mb-3" style="display: flex; align-items: center;">
                    <lord-icon
                        src="https://cdn.lordicon.com/tdrtiskw.json" 
                        trigger="loop"
                        colors="primary:#e74c3c"
                        style="width:70px;height:70px; margin-right: 10px;">
                    </lord-icon>
                    <div class="text-center">
                        <p id="errorMessage"></p>
                    </div>
                    <!-- Aquí puedes añadir el contenido que quieres que esté a la derecha del ícono -->
                </div>
                
                
                
                <hr class="w-100 my-3">
                
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" id="btn_cerrar_Error_Estado" data-bs-dismiss="modal">Cerrar</button>
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

            // Manejar trabajadores
            $('#agregarServicio').on('shown.bs.modal', function () {        

                // Iniciar por si las moscas
                $('#nombretrabajadorEservicio').prop('disabled', true).val(''); 
                $('#nombretrabajadorIservicio').val('');
                
                // Manejo de eventos bastante grande
                $('#trabajador').off('change').on('change', function() { 

                    var trabajadorElegido = $(this).find('option:selected').text(); 
                    
                    // Obtener el nombre del trabajador seleccionado si no es externo
                    if ($(this).val() === '') { 

                        $('#nombretrabajadorEservicio').prop('disabled', false); 
                        $('#nombretrabajadorIservicio').val(''); // Limpiar el campo para trabajadores internos por si acaso

                    } else { 

                        $('#nombretrabajadorEservicio').prop('disabled', true).val(''); 
                        $('#nombretrabajadorIservicio').val(trabajadorElegido); // Asignar el nombre al campo oculto 

                    } 
                }); 
            });  
            
            // Manejar trabajadores pero en el modal de editar trabajador
            $('#ServicioEdit').on('shown.bs.modal', function () {             
                
                // Manejo de eventos bastante grande
                $('#trabajadorEdit').off('change').on('change', function() { 

                    var trabajadorElegido = $(this).find('option:selected').text(); 
                    
                    // Obtener el nombre del trabajador seleccionado si no es externo
                    if ($(this).val() === '') { 

                        $('#nombretrabajadorEservicioEdit').prop('disabled', false); 
                        $('#nombretrabajadorIservicioEdit').val(''); // Limpiar el campo para trabajadores internos por si acaso

                    } else { 

                        $('#nombretrabajadorEservicioEdit').prop('disabled', true).val(''); 
                        $('#nombretrabajadorIservicioEdit').val(trabajadorElegido); // Asignar el nombre al campo oculto 

                    } 
                }); 

            });
            
            // Mostrar modal de exito
            function showSuccessModal(message) { 

                // Establece el mensaje del modal 
                $('#texto_success').text(message); 
                
                // Muestra el modal 
                $('#successModal').modal('show'); 
                
                // Oculta el modal después de 5 segundos 
                setTimeout(function() { 
                    $('#successModal').modal('hide'); 
                }, 1000); 
            }

            // Mostrar modal de error
            function showErrorModal(message) { 
                
                // Establece el mensaje del modal 
                $('#texto_error').text(message); 
                
                // Muestra el modal 
                $('#errorModal').modal('show'); 
                
                // Oculta el modal después de 5 segundos 
                setTimeout(function() { 
                    $('#errorModal').modal('hide'); 
                }, 1000); 
            }

            ////////////////////////////BUSCADOR/////////////////////////
            $("#buscador_cnn").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            //Funcionalidad de modal de añadir servicio -------------------------------------------------------
            $('#btn_agregar_servicio').click(function(e) {
                e.preventDefault();

                var tiposervicio = $('#tiposervicio').val();
                var id_propiedad = $('#propiedadServicioInput').val();
                var id_trabajador = $('#trabajador').val();
                
                console.log(id_trabajador);

                var nombre_trabajador; 
                
                // Verificar si el trabajador seleccionado es externo o interno 
                if ($('#trabajador').val() === '') { 
                    nombre_trabajador = $('#nombretrabajadorEservicio').val(); 
                } else { 
                    nombre_trabajador = $('#nombretrabajadorIservicio').val(); 
                }

                var fecha = $('#fechaservicio').val();
                var trabajo_realizado = $('#descripcionservicio').val();
                var mano_obra_valor = $('#manoservicio').val();
                var garantia = $('#garantiaservicio').val();
                var valor_total = $('#totalServicio').val();

                if (tiposervicio == 1) { 

                    $.ajax({ 
                        url: '/obrero/agregarLN', 
                        type: 'POST', 
                        data: { 

                            id_propiedad: id_propiedad,
                            id_trabajador: id_trabajador,
                            nombre_trabajador: nombre_trabajador,
                            fecha: fecha,
                            trabajo_realizado: trabajo_realizado, 
                            mano_obra_valor: mano_obra_valor,    
                            garantia: garantia,
                            valor_total: valor_total,

                            _token: '{{ csrf_token() }}' 
                        }, 
                        success: function(response) { 

                            // Cerrar el modal 
                            $('#agregarServicio').modal('hide'); 

                            // Mostrar el modal de éxito
                            showSuccessModal('Servicio guardado con éxito. La pagina se actualizara');

                            // Limpiar el formulario 
                            $('#tiposervicio').val(''); 
                            $('#propiedadServicioInput').val(''); 
                            $('#trabajador').val(''); 
                            $('#nombretrabajadorEservicio').val(''); 
                            $('#nombretrabajadorIservicio').val(''); 
                            $('#descripcionservicio').val(''); 
                            $('#manoservicio').val(''); 
                            $('#garantiaservicio').val(''); 
                            $('#totalServicio').val('');                             

                            // Respuestas
                            console.log(response); 
                            setTimeout(function() { location.reload(); }, 1000); 
                        }, 
                        error: function(error) { 
                            // Manejar el error 
                            console.log(error); 
                            console.log(fechaservicio); 

                            // Mostrar el modal de error
                            showErrorModal('Error al guardar el servicio.');

                        } 
                    }); 
                } 

                if (tiposervicio == 2) { 

                    $.ajax({ 
                        url: '/obrero/agregarGas', 
                        type: 'POST', 
                        data: { 
                            id_propiedad: id_propiedad,
                            id_trabajador: id_trabajador,
                            nombre_trabajador: nombre_trabajador,
                            fecha: fecha,
                            trabajo_realizado: trabajo_realizado, 
                            mano_obra_valor: mano_obra_valor,    
                            garantia: garantia,
                            valor_total: valor_total,

                            _token: '{{ csrf_token() }}' 
                        }, 
                        success: function(response) { 

                            // Cerrar el modal 
                            $('#agregarServicio').modal('hide'); 

                            // Mostrar el modal de éxito
                            showSuccessModal('Servicio guardado con éxito. La pagina se actualizara');

                            // Limpiar el formulario 
                            $('#tiposervicio').val(''); 
                            $('#propiedadServicioInput').val(''); 
                            $('#trabajador').val(''); 
                            $('#nombretrabajadorEservicio').val(''); 
                            $('#nombretrabajadorIservicio').val(''); 
                            $('#descripcionservicio').val(''); 
                            $('#manoservicio').val(''); 
                            $('#garantiaservicio').val(''); 
                            $('#totalServicio').val('');        

                            // Respuestas
                            console.log(response); 
                            setTimeout(function() { location.reload(); }, 1000); 
                        }, 
                        error: function(error) { 
                            // Manejar el error 
                            console.log(error); 
                            console.log(fechaservicio); 

                            // Mostrar el modal de error
                            showErrorModal('Error al guardar el servicio.');

                        } 
                    }); 
                }

                if (tiposervicio == 3) { 

                    $.ajax({ 
                        url: '/obrero/agregarOMa', 
                        type: 'POST', 
                        data: { 
                            id_propiedad: id_propiedad,
                            id_trabajador: id_trabajador,
                            nombre_trabajador: nombre_trabajador,
                            fecha: fecha,
                            trabajo_realizado: trabajo_realizado, 
                            mano_obra_valor: mano_obra_valor,    
                            garantia: garantia,
                            valor_total: valor_total,

                            _token: '{{ csrf_token() }}' 
                        }, 
                        success: function(response) { 

                            // Cerrar el modal 
                            $('#agregarServicio').modal('hide'); 

                            // Mostrar el modal de éxito
                            showSuccessModal('Servicio guardado con éxito. La pagina se actualizara');

                            // Limpiar el formulario 
                            $('#tiposervicio').val(''); 
                            $('#propiedadServicioInput').val(''); 
                            $('#trabajador').val(''); 
                            $('#nombretrabajadorEservicio').val(''); 
                            $('#nombretrabajadorIservicio').val(''); 
                            $('#descripcionservicio').val(''); 
                            $('#manoservicio').val(''); 
                            $('#garantiaservicio').val(''); 
                            $('#totalServicio').val('');        

                            // Respuestas
                            console.log(response); 
                            setTimeout(function() { location.reload(); }, 1000); 
                        }, 
                        error: function(error) { 
                            // Manejar el error 
                            console.log(error); 
                            console.log(fechaservicio); 

                            // Mostrar el modal de error
                            showErrorModal('Error al guardar el servicio.');

                        } 
                    }); 
                }

                if (tiposervicio == 4) { 

                    $.ajax({ 
                        url: '/obrero/agregarOMe', 
                        type: 'POST', 
                        data: { 
                            id_propiedad: id_propiedad,
                            id_trabajador: id_trabajador,
                            nombre_trabajador: nombre_trabajador,
                            fecha: fecha,
                            trabajo_realizado: trabajo_realizado, 
                            mano_obra_valor: mano_obra_valor,    
                            garantia: garantia,
                            valor_total: valor_total,

                            _token: '{{ csrf_token() }}' 
                        }, 
                        success: function(response) { 

                            // Cerrar el modal 
                            $('#agregarServicio').modal('hide'); 

                            // Mostrar el modal de éxito
                            showSuccessModal('Servicio guardado con éxito. La pagina se actualizara');

                            // Limpiar el formulario 
                            $('#tiposervicio').val(''); 
                            $('#propiedadServicioInput').val(''); 
                            $('#trabajador').val(''); 
                            $('#nombretrabajadorEservicio').val(''); 
                            $('#nombretrabajadorIservicio').val(''); 
                            $('#fechaservicio').val('');
                            $('#descripcionservicio').val(''); 
                            $('#manoservicio').val(''); 
                            $('#garantiaservicio').val(''); 
                            $('#totalServicio').val('');        

                            // Respuestas
                            console.log(response); 
                            setTimeout(function() { location.reload(); }, 1000); 
                        }, 
                        error: function(error) { 
                            // Manejar el error 
                            console.log(error); 
                            console.log(fechaservicio); 

                            // Mostrar el modal de error
                            showErrorModal('Error al guardar el servicio.');

                        } 
                    }); 
                }

            });        
            
            // Funcionalidad de mostrar datos originales del servicio en el modal de editar
            $('.editar-servicio').click(function() {

                var id = $(this).data('id'); 
                var tipo = $(this).data('tipo');               

                // Establece la id del servicio seleccionado para conseguir sus datos actuales y rellenarlos en el modal
                $('#editar-idServicio').val(id);      
                $('#editar-idServicioTipo').val(tipo);            

                if (tipo == 1) {                    

                    $.ajax({                        

                        url: '/obrero/conseguirLN/' + id,
                        type: 'GET',
                        dataType: 'json',

                        success: function(data) {                            

                            var servtecln = data.servtecln;

                            // Rellena los inputs correspondientes                        
                            
                            $('#propiedadServicioEdit').val(servtecln.id_propiedad);                             
                            $('#fechaservicioEdit').val(servtecln.fecha);

                            $('#trabajadorEdit').val(servtecln.id_trabajador);                            

                            if ($('#trabajadorEdit').val() === '') {

                                $('#nombretrabajadorEservicioEdit').prop('disabled', false); 
                                $('#nombretrabajadorIservicioEdit').val('');
                                $('#nombretrabajadorEservicioEdit').val(servtecln.nombre_trabajador);

                            } else {

                                $('#nombretrabajadorEservicioEdit').prop('disabled', true).val('');
                                $('#nombretrabajadorIservicioEdit').val(servtecln.nombre_trabajador);
                                $('#nombretrabajadorEservicioEdit').val('');                               
                                
                            }                            

                            $('#descripcionservicioEdit').val(servtecln.trabajo_realizado); 
                            $('#manoservicioEdit').val(servtecln.mano_obra_valor); 
                            $('#garantiaservicioEdit').val(servtecln.garantia); 
                            $('#totalServicioEdit').val(servtecln.valor_total); 

                            $('#ServicioEdit').modal('show');

                        },

                        error: function(error) {

                            console.log(error);                            

                        }

                    });

                }                

                if (tipo == 2) { 

                    $.ajax({

                        url: '/obrero/conseguirGas/' + id,
                        type: 'GET',
                        dataType: 'json',

                        success: function(data) {

                            var gasfiteria = data.gasfiteria;

                            // Rellena los inputs correspondientes

                            $('#propiedadServicioEdit').val(gasfiteria.id_propiedad);                             
                            $('#fechaservicioEdit').val(gasfiteria.fecha);

                            $('#trabajadorEdit').val(gasfiteria.id_trabajador);                      

                            if ($('#trabajadorEdit').val() === '') {                                

                                $('#nombretrabajadorEservicioEdit').prop('disabled', false); 
                                $('#nombretrabajadorIservicioEdit').val('');
                                $('#nombretrabajadorEservicioEdit').val(gasfiteria.nombre_trabajador);

                            } else {

                                $('#nombretrabajadorEservicioEdit').prop('disabled', true).val('');
                                $('#nombretrabajadorIservicioEdit').val(gasfiteria.nombre_trabajador);
                                $('#nombretrabajadorEservicioEdit').val('');

                            }  

                            $('#descripcionservicioEdit').val(gasfiteria.trabajo_realizado); 
                            $('#manoservicioEdit').val(gasfiteria.mano_obra_valor); 
                            $('#garantiaservicioEdit').val(gasfiteria.garantia); 
                            $('#totalServicioEdit').val(gasfiteria.valor_total);                    

                            $('#ServicioEdit').modal('show');

                        },

                        error: function(error) {

                            console.log(error);

                        }

                    });

                }

                if (tipo == 3) { 

                    $.ajax({

                        url: '/obrero/conseguirOMa/' + id,
                        type: 'GET',
                        dataType: 'json',

                        success: function(data) {

                            var obra_mayor = data.obra_mayor;

                            // Rellena los inputs correspondientes

                            $('#propiedadServicioEdit').val(obra_mayor.id_propiedad);                             
                            $('#fechaservicioEdit').val(obra_mayor.fecha);

                            $('#trabajadorEdit').val(obra_mayor.id_trabajador);                            

                            if ($('#trabajadorEdit').val() === '') {

                                $('#nombretrabajadorEservicioEdit').prop('disabled', false); 
                                $('#nombretrabajadorIservicioEdit').val('');
                                $('#nombretrabajadorEservicioEdit').val(obra_mayor.nombre_trabajador);

                            } else {

                                $('#nombretrabajadorEservicioEdit').prop('disabled', true).val('');
                                $('#nombretrabajadorIservicioEdit').val(obra_mayor.nombre_trabajador);
                                $('#nombretrabajadorEservicioEdit').val('');                                

                            }  

                            $('#descripcionservicioEdit').val(obra_mayor.trabajo_realizado); 
                            $('#manoservicioEdit').val(obra_mayor.mano_obra_valor); 
                            $('#garantiaservicioEdit').val(obra_mayor.garantia); 
                            $('#totalServicioEdit').val(obra_mayor.valor_total);                            

                            $('#ServicioEdit').modal('show');

                        },

                        error: function(error) {

                            console.log(error);

                        }

                    });

                }

                if (tipo == 4) { 

                    $.ajax({

                        url: '/obrero/conseguirOMe/' + id,
                        type: 'GET',
                        dataType: 'json',

                        success: function(data) {

                            var obra_menor = data.obra_menor;

                            // Rellena los inputs correspondientes

                            $('#propiedadServicioEdit').val(obra_menor.id_propiedad);                             
                            $('#fechaservicioEdit').val(obra_menor.fecha);

                            $('#trabajadorEdit').val(obra_menor.id_trabajador);                            

                            if ($('#trabajadorEdit').val() === '') {

                                $('#nombretrabajadorEservicioEdit').prop('disabled', false); 
                                $('#nombretrabajadorIservicioEdit').val('');
                                $('#nombretrabajadorEservicioEdit').val(obra_menor.nombre_trabajador);

                            } else {

                                $('#nombretrabajadorEservicioEdit').prop('disabled', true).val('');
                                $('#nombretrabajadorIservicioEdit').val(obra_menor.nombre_trabajador);
                                $('#nombretrabajadorEservicioEdit').val('');

                            }

                            $('#descripcionservicioEdit').val(obra_menor.trabajo_realizado); 
                            $('#manoservicioEdit').val(obra_menor.mano_obra_valor); 
                            $('#garantiaservicioEdit').val(obra_menor.garantia); 
                            $('#totalServicioEdit').val(obra_menor.valor_total); 
                        
                            $('#ServicioEdit').modal('show');

                        },

                        error: function(error) {

                            console.log(error);

                        }

                    });

                }   

            });

            // Funcionalidad para guardar los cambios del modal de editar ------------------------------------------
            $('#btn_edit_servicio').click(function() {

                var id = $('#editar-idServicio').val();
                var tipo = $('#editar-idServicioTipo').val();

                // Valores actualizados de los campos.
                var fecha = $('#fechaservicioEdit').val();
                var trabajo_realizado = $('#descripcionservicioEdit').val();
                var mano_obra_valor = $('#manoservicioEdit').val();
                var garantia = $('#garantiaservicioEdit').val();
                var valor_total = $('#totalServicioEdit').val();
                var id_propiedad = $('#propiedadServicioEdit').val();

                var id_trabajador = $('#trabajadorEdit').val();

                var nombre_trabajador;

                // Verificar si el trabajador seleccionado es externo o interno 
                if ($('#trabajadorEdit').val() === '') { 
                    nombre_trabajador = $('#nombretrabajadorEservicioEdit').val(); 
                } else { 
                    nombre_trabajador = $('#nombretrabajadorIservicioEdit').val(); 
                }       

                console.log(nombre_trabajador);

                // Verificación de campos vacíos 
                /*if (motivo === "" && lugar_prop === "") { 
                    alert("Rellene los datos faltantes."); 
                    return false;
                }*/
               
                if(!nombre_trabajador){
                    alert("Rellene los datos faltantes");
                    return false
                }                

                // Actualiza el servicio en la base de datos.

                if (tipo == 1) { 

                    $.ajax({

                        url: '/obrero/editarLN/' + id,
                        type: 'PUT',

                        data: {

                            id_propiedad: id_propiedad,
                            id_trabajador: id_trabajador,
                            nombre_trabajador: nombre_trabajador,
                            fecha: fecha,
                            trabajo_realizado: trabajo_realizado, 
                            mano_obra_valor: mano_obra_valor,    
                            garantia: garantia,
                            valor_total: valor_total,

                            _token: '{{csrf_token()}}'
                        },

                        success: function(data) {

                            // Mostrar el modal de éxito
                            showSuccessModal('El servicio ha sido editado con éxito.');

                            console.log(data.message);

                        },

                        error: function(error) {

                            // Mostrar el modal de error
                            showErrorModal('Error al editar el servicio.');

                            console.log(error);

                        }

                    });

                }

                if (tipo == 2) { 
                    
                    $.ajax({

                        url: '/obrero/editarGas/' + id,
                        type: 'PUT',

                        data: {

                            id_propiedad: id_propiedad,
                            id_trabajador: id_trabajador,
                            nombre_trabajador: nombre_trabajador,
                            fecha: fecha,
                            trabajo_realizado: trabajo_realizado, 
                            mano_obra_valor: mano_obra_valor,    
                            garantia: garantia,
                            valor_total: valor_total,

                            _token: '{{csrf_token()}}'
                        },

                        success: function(data) {

                            // Mostrar el modal de éxito
                            showSuccessModal('El servicio ha sido editado con éxito.');

                            console.log(data.message);

                        },

                        error: function(error) {

                            console.log(error);

                            // Mostrar el modal de error
                            showErrorModal('Error al editar el servicio.');

                        }

                    });

                }

                if (tipo == 3) { 

                    $.ajax({

                        url: '/obrero/editarOMa/' + id,
                        type: 'PUT',

                        data: {

                            id_propiedad: id_propiedad,
                            id_trabajador: id_trabajador,
                            nombre_trabajador: nombre_trabajador,
                            fecha: fecha,
                            trabajo_realizado: trabajo_realizado, 
                            mano_obra_valor: mano_obra_valor,    
                            garantia: garantia,
                            valor_total: valor_total,

                            _token: '{{csrf_token()}}'
                        },

                        success: function(data) {

                            // Mostrar el modal de éxito
                            showSuccessModal('El servicio ha sido editado con éxito.');

                            console.log(data.message);

                        },

                        error: function(error) {

                            console.log(error);

                            // Mostrar el modal de error
                            showErrorModal('Error al editar el servicio.');

                        }

                    });

                }

                if (tipo == 4) { 

                    $.ajax({

                        url: '/obrero/editarOMe/' + id,
                        type: 'PUT',

                        data: {

                            id_propiedad: id_propiedad,
                            id_trabajador: id_trabajador,
                            nombre_trabajador: nombre_trabajador,
                            fecha: fecha,
                            trabajo_realizado: trabajo_realizado, 
                            mano_obra_valor: mano_obra_valor,    
                            garantia: garantia,
                            valor_total: valor_total,

                            _token: '{{csrf_token()}}'
                        },

                        success: function(data) {

                            // Mostrar el modal de éxito
                            showSuccessModal('El servicio ha sido editado con éxito. La pagina se actualizara');

                            console.log(data.message);

                        },

                        error: function(error) {

                            console.log(error);

                            // Mostrar el modal de error
                            showErrorModal('Error al editar el servicio. La pagina se actualizara');

                        }

                    });

                }
                
                // Cierra el modal.
                $('#ServicioEdit').modal('hide');
                setTimeout(function() { location.reload(); }, 1000);

            });

 //Funcionalidad de borrar de la tabla --------------------------------------------------------------
            $('.borrar-servicio').click(function(e) {

                e.preventDefault();

                var id = $(this).data('id');
                var tipo = $(this).data('tipo');                

                var confirmation = confirm('Está a punto de eliminar un servicio. ¿Quiere continuar?');
                if (confirmation) {

                    if (tipo == 1) { 

                        $.ajax({

                            url: '/obrero/borrarLN/' + id,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },

                            success: function(response) {

                                // Mostrar el modal de éxito
                                showSuccessModal('Servicio eliminado con éxito. La pagina se actualizara');
                                
                                setTimeout(function() { location.reload(); }, 1000);

                            },

                            error: function(response) {

                                if (response.status === 409) {
                                    // Si el código de estado es 409, entonces es un error de violación de restricción de integridad
                                    alert(response.responseJSON.message);
                                } else {
                                    
                                    // Mostrar el modal de error
                                    showErrorModal('Error al eliminar el servicio.');

                                }

                            }

                        });

                    }

                    if (tipo == 2) { 

                        $.ajax({

                            url: '/obrero/borrarGas/' + id,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },

                            success: function(response) {

                                // Mostrar el modal de éxito
                                showSuccessModal('Servicio eliminado con éxito. La pagina se actualizara');
                                
                                setTimeout(function() { location.reload(); }, 1000);

                            },

                            error: function(response) {

                                if (response.status === 409) {
                                    // Si el código de estado es 409, entonces es un error de violación de restricción de integridad
                                    alert(response.responseJSON.message);
                                } else {

                                    // Mostrar el modal de error
                                    showErrorModal('Error al eliminar el servicio.');

                                }

                            }

                        });

                    }

                    if (tipo == 3) { 

                        $.ajax({

                            url: '/obrero/borrarOMa/' + id,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },

                            success: function(response) {

                                // Mostrar el modal de éxito
                                showSuccessModal('Servicio eliminado con éxito. La pagina se actualizara');
                                
                                setTimeout(function() { location.reload(); }, 1000);

                            },

                            error: function(response) {

                                if (response.status === 409) {
                                    // Si el código de estado es 409, entonces es un error de violación de restricción de integridad
                                    alert(response.responseJSON.message);
                                } else {

                                    // Mostrar el modal de error
                                    showErrorModal('Error al eliminar el servicio.');

                                }

                            }

                        });

                    }

                    if (tipo == 4) { 

                        $.ajax({

                            url: '/obrero/borrarOMe/' + id,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },

                            success: function(response) {

                                // Mostrar el modal de éxito
                                showSuccessModal('Servicio eliminado con éxito. La pagina se actualizara');
                                
                                setTimeout(function() { location.reload(); }, 1000);

                            },

                            error: function(response) {

                                if (response.status === 409) {
                                    // Si el código de estado es 409, entonces es un error de violación de restricción de integridad
                                    alert(response.responseJSON.message);
                                } else {
                                    
                                    // Mostrar el modal de error
                                    showErrorModal('Error al eliminar el servicio.');

                                }

                            }

                        });

                    }
                    
                }
            });

    //Funcionalidad de conseguir imagenes de un servicio --------------------------------------------------------------
            // $('.ver-imagenes').on('click', function(event) { 

            //     event.preventDefault(); 

            //     var button = $(this);                 
            //     var id = button.data('id'); 
            //     var tipoServicio = button.data('tipo'); 
            //     var modal = $('#modalImagenes'); 

            //     // Establece la id del servicio seleccionado para manejar las imagenes
            //     $('#imagen-idServicio').val(id);      
            //     $('#imagen-tipoServicio').val(tipoServicio);      

            //     // Abre el modal 
            //     modal.modal('show'); 
                
            //     // Realiza la petición AJAX para obtener los datos 
            //     $.ajax({ 

            //         url: '/conseguirImagenes/' + id + '/' + tipoServicio, 
            //         method: 'GET', 
            //         success: function(response) { 

            //             var tbody = modal.find('table tbody'); 
            //             tbody.empty(); // Limpia el contenido actual 

            //             response.forEach(function(image) { 

            //                 var row = '<tr>' + 
            //                 '<td>' + image.id + '</td>' + 
            //                 '<td>' + image.nombre + '</td>' + 
            //                 '<td><a href="' + image.link + '" target="_blank">Ver enlace</a></td>' + 
            //                 '<td>'; 
                            
            //                 if (image.tipo === 'imagen') { 
            //                     row += '<img src="' + image.link + '" alt="' + image.nombre + '" width="100">'; 
            //                 } else if (image.tipo === 'video') { 
            //                     row += '<video width="100" controls><source src="' + image.link + '" type="video/mp4">Tu navegador no soporta la reproducción de videos.</video>'; 
            //                 } else if (image.tipo === 'documento') { 
            //                     row += '<a href="' + image.link + '" download>' + image.nombre + '</a>'; 
            //                 }

            //                 row += '</td>' +
            //                 '<td>' + image.tipo + '</td>' +
            //                 '<td>' + 
            //                     '<button class="btn btn-warning btn-sm reemplazar-imagen" data-id="' + image.id + '" data-tipo="' + tipoServicio + '">Reemplazar</button> ' + 
            //                     '<button class="btn btn-danger btn-sm eliminar-imagen" data-id="' + image.id + '" data-tipo="' + tipoServicio + '">Eliminar</button>' + '</td>' +
            //                 '</tr>'; 

            //                 tbody.append(row); 

            //             }); 
            //         }, 

            //         error: function() { 
            //             var tbody = modal.find('table tbody'); 
            //             tbody.html('<tr><td colspan="5">Error al cargar los datos.</td></tr>'); 
            //         }

            //     });
            // });  

     $('.ver-imagenes').on('click', function(event) { 
    event.preventDefault(); 

    var button = $(this);                 
    var id = button.data('id'); 
    var tipoServicio = button.data('tipo'); 
    var modal = $('#modalImagenes'); 

    // Establece la id del servicio seleccionado para manejar las imagenes
    $('#imagen-idServicio').val(id);      
    $('#imagen-tipoServicio').val(tipoServicio);      

    // Abre el modal 
    modal.modal('show'); 
    
    // Realiza la petición AJAX para obtener los datos 
    $.ajax({ 
        url: '/obrero/conseguirImagenes/' + id + '/' + tipoServicio, 
        method: 'GET', 
        success: function(response) { 
            var tbody = modal.find('table tbody'); 
            tbody.empty(); // Limpia el contenido actual 

            response.forEach(function(image) { 
                if (image.tipo === 'imagen') { // Filtra solo las imágenes
                    var row = '<tr>' + 
                    '<td>' + image.id + '</td>' + 
                    '<td>' + image.nombre + '</td>' + 
                    '<td><a href="' + image.link + '" target="_blank">Ver enlace</a></td>' + 
                    '<td><img src="' + image.link + '" alt="' + image.nombre + '" width="100"></td>' +
                    '<td>' + image.tipo + '</td>' +
                    '<td>' + 
                        '<button class="btn btn-warning btn-sm reemplazar-imagen" data-id="' + image.id + '" data-tipo="' + tipoServicio + '">Reemplazar</button> ' + 
                        '<button class="btn btn-danger btn-sm eliminar-imagen" data-id="' + image.id + '" data-tipo="' + tipoServicio + '">Eliminar</button>' + 
                    '</td>' +
                    '</tr>'; 

                    tbody.append(row); 
                }
            }); 
        }, 

        error: function() { 
            var tbody = modal.find('table tbody'); 
            tbody.html('<tr><td colspan="5">Error al cargar los datos.</td></tr>'); 
        }
    });
});


            $('#addImagenForm').on('submit', function(event) { 

                event.preventDefault(); 
                
                var formData = new FormData(this); 
                var idServicio = $('#imagen-idServicio').val(); 
                var tipoServicio = $('#imagen-tipoServicio').val(); 
                var tipoInput = $('#tipoInput').val();
                
                formData.append('idServicio', idServicio); 
                formData.append('tipoServicio', tipoServicio);  
                formData.append('tipo', tipoInput);               

                console.log(tipoInput);                           
                
                $.ajax({ 
                    url: '/obrero/guardarImagen', 
                    method: 'POST', 
                    data: formData, 
                    processData: false, 
                    contentType: false, 

                    success: function(response) { 

                        // Cerrar el modal y mostrar un mensaje de éxito 
                        $('#addImagenModal').modal('hide'); 
                        
                        // Mostrar el modal de éxito
                        showSuccessModal('Archivo guardado con éxito.'); 

                        // Actualiza la tabla de imágenes en el modal principal para no tener que tirar F5 // EXPERIMENTAL
                        var nuevoArchivo = '<tr>' + 
                            '<td>' + response.id + '</td>' + 
                            '<td>' + response.nombre + '</td>' + 
                            '<td><a href="' + response.link + '" target="_blank">Ver enlace</a></td>' + 
                            '<td>'; 

                        if (response.tipo === 'Imagen') { 
                            nuevoArchivo += '<img src="' + response.link + '" alt="' + response.nombre + '" width="100">'; 
                        } else if (response.tipo === 'Video') { 
                            nuevoArchivo += '<video width="100" controls><source src="' + response.link + '" type="video/mp4">Tu navegador no soporta la reproducción de videos.</video>'; 
                        } else if (response.tipo === 'Documento') { 
                            nuevoArchivo += '<a href="' + response.link + '" download>' + response.nombre + '</a>'; 
                        } 
                        
                        nuevoArchivo += '</td>' + 
                            '<td>' + response.tipo + '</td>' + 
                            '<td>' + 
                                '<button class="btn btn-warning btn-sm reemplazar-archivo" data-id="' + response.id + '" data-tipo-servicio="' + tipoServicio + '">Reemplazar</button> ' + 
                                '<button class="btn btn-danger btn-sm eliminar-archivo" data-id="' + response.id + '" data-tipo-servicio="' + tipoServicio + '">Eliminar</button>' + 
                            '</td>' + 
                            '</tr>'; 

                        $('#modalImagenes').find('table tbody').append(nuevoArchivo); 

                    }, 
                    error: function() { 

                        // Mostrar el modal de error
                        showErrorModal('Error al guardar el archivo.');

                    } 
                }); 
            });          
            
            //Muestra el modal de reemplazar imagen
            $(document).on('click', '.reemplazar-imagen', function() { 

                var button = $(this); 
                var idImagen = button.data('id'); 
                var tipoServicio = button.data('tipo'); 
                

                // Llena los campos ocultos con los datos correspondientes 
                $('#imagen-idServicioE').val(idImagen); 
                $('#imagen-tipoServicioE').val(tipoServicio);

                $.ajax({

                    url: '/obrero/verImagenEdit',
                    type: 'GET',
                    dataType: 'json',
                    data: {

                        idImagen: idImagen,
                        tipoServicio: tipoServicio,

                        _token: '{{ csrf_token() }}'

                    },
                    success: function(data) {

                        var image = data.image;

                        // Rellena los inputs correspondientes               

                        $('#tipoInputEdit').val(image.tipo);                      

                    },

                    error: function(error) {

                        console.log(error);

                    }

                });

                // Abre el modal de reemplazo de imagen 
                $('#modal-reemplazar-imagen').modal('show'); 

            });

            //Guardar imagen reemplazante
            $('#guardar-nueva-imagen').on('click', function(event) { 
                
                event.preventDefault(); 
                
                var formData = new FormData(); 
                var idImagen = $('#imagen-idServicioE').val(); 
                var tipoServicio = $('#imagen-tipoServicioE').val(); 
                var imagenNueva = $('#reemplazar-imagenInput')[0].files[0]; 
                var tipoInput = $('#tipoInputEdit').val();
                
                formData.append('idImagen', idImagen); 
                formData.append('tipoServicio', tipoServicio); 
                formData.append('imagen', imagenNueva); 
                formData.append('tipo', tipoInput);  
                
                $.ajax({ 

                    url: '/obrero/reemplazarImagen', 
                    method: 'POST', 

                    data: formData, 
                    processData: false, 
                    contentType: false, 

                    success: function(response) { 
                        
                        // Cerrar el modal y mostrar un mensaje de éxito (Por crear) 
                        $('#modal-reemplazar-imagen').modal('hide'); 

                        // Mostrar el modal de éxito
                        showSuccessModal('Archivo reemplazado con éxito.'); 
                        setTimeout(function() { location.reload(); }, 1000);

                        // Actualizar despues sin f5 - EXPERIMENTAL                       
                        var row = $('button[data-id="' + idImagen + '"]').closest('tr'); 
                        row.find('td:nth-child(2)').text(response.nombre); 
                        row.find('td:nth-child(3) a').attr('href', response.link).text('Ver enlace'); 
                        
                        if (response.tipo === 'Imagen') { 
                            row.find('td:nth-child(4)').html('<img src="' + response.link + '" alt="' + response.nombre + '" width="100">'); 
                        } else if (response.tipo === 'Video') { 
                            row.find('td:nth-child(4)').html('<video width="100" controls><source src="' + response.link + '" type="video/mp4">Tu navegador no soporta la reproducción de videos.</video>'); 
                        } else if (response.tipo === 'Documento') { 
                            row.find('td:nth-child(4)').html('<a href="' + response.link + '" download>' + response.nombre + '</a>'); 
                        }

                    }, 

                    error: function() { 

                        // Mostrar el modal de error
                        showErrorModal('Error al reemplazar el archivo.');

                    } 

                }); 
            });

      /////////////////////////////////////////////////////////////////////////////////////////      
            //Muestra el modal de reemplazar video
     $(document).on('click', '.reemplazar-video', function() { 

            var button = $(this); 
            var idImagen = button.data('id'); 
            var tipoServicio = button.data('tipo'); 


            // Llena los campos ocultos con los datos correspondientes 
            $('#imagen-idServicioE').val(idImagen); 
            $('#imagen-tipoServicioE').val(tipoServicio);

            $.ajax({

                url: '/obrero/verVideoEdit',
                type: 'GET',
                dataType: 'json',
                data: {

                    idImagen: idImagen,
                    tipoServicio: tipoServicio,

                    _token: '{{ csrf_token() }}'

                },
                success: function(data) {

                    var image = data.image;

                    // Rellena los inputs correspondientes               

                    $('#tipoInputviEdit').val(image.tipo);                      

                },

                error: function(error) {

                    console.log(error);

                }

            });

            // Abre el modal de reemplazo de imagen 
            $('#modal-reemplazar-video').modal('show'); 

            });

            //Guardar imagen reemplazante
            $('#guardar-nueva-video').on('click', function(event) { 

            event.preventDefault(); 

            var formData = new FormData(); 
            var idImagen = $('#imagen-idServicioE').val(); 
            var tipoServicio = $('#imagen-tipoServicioE').val(); 
            var imagenNueva = $('#reemplazar-videoInput')[0].files[0]; 
            var tipoInput = $('#tipoInputviEdit').val();

            formData.append('idImagen', idImagen); 
            formData.append('tipoServicio', tipoServicio); 
            formData.append('imagen', imagenNueva); 
            formData.append('tipo', tipoInput);  

            $.ajax({ 

                url: '/obrero/reemplazarVideo', 
                method: 'POST', 

                data: formData, 
                processData: false, 
                contentType: false, 

                success: function(response) { 
                    
                    // Cerrar el modal y mostrar un mensaje de éxito (Por crear) 
                    $('#modal-reemplazar-video').modal('hide'); 

                    // Mostrar el modal de éxito
                    showSuccessModal('Video reemplazado con éxito.'); 
                    setTimeout(function() { location.reload(); }, 1000);

                    // Actualizar despues sin f5 - EXPERIMENTAL                       
                    var row = $('button[data-id="' + idImagen + '"]').closest('tr'); 
                    row.find('td:nth-child(2)').text(response.nombre); 
                    row.find('td:nth-child(3) a').attr('href', response.link).text('Ver enlace'); 
                    
                    if (response.tipo === 'Imagen') { 
                        row.find('td:nth-child(4)').html('<img src="' + response.link + '" alt="' + response.nombre + '" width="100">'); 
                    } else if (response.tipo === 'Video') { 
                        row.find('td:nth-child(4)').html('<video width="100" controls><source src="' + response.link + '" type="video/mp4">Tu navegador no soporta la reproducción de videos.</video>'); 
                    } else if (response.tipo === 'Documento') { 
                        row.find('td:nth-child(4)').html('<a href="' + response.link + '" download>' + response.nombre + '</a>'); 
                    }

                }, 

                error: function() { 

                    // Mostrar el modal de error
                    showErrorModal('Error al reemplazar el archivo.');

                } 

            }); 
            });



            // Maneja las eliminaciones de imagenes
            $(document).on('click', '.eliminar-imagen', function() { 

                var button = $(this); 
                var idImagen = button.data('id'); 
                var tipoServicio = button.data('tipo'); 
                
                // Mostrar confirmación antes de eliminar 
                if (confirm('¿Seguro que quieres borrar esta imagen?')) { 

                    $.ajax({ 
                        
                        url: '/obrero/eliminarImagen', 
                        method: 'POST', 
                        data: { 
                            
                            idImagen: idImagen, 
                            tipoServicio: tipoServicio, 
                            _token: '{{ csrf_token() }}' // Por si acaso de nuevo la token CSRF para la seguridad 
                        }, 
                        success: function(response) { 

                            // Mostrar el modal de éxito
                            showSuccessModal('Imagen eliminada con éxito.');
                            
                            // Eliminar la fila de manera dinamica, algo que estoy probando para evitar F5 a cada instante
                            button.closest('tr').remove();                             

                        }, error: function() { 

                            // Mostrar el modal de error
                            showErrorModal('Error al eliminar la imagen.');

                        } 
                    }); 
                } 
            });     
 //Funcionalidad de conseguir Videos de un servicio --------------------------------------------------------------            

            $('.ver-video').on('click', function(event) { 

        event.preventDefault(); 

        var button = $(this);                 
        var id = button.data('id'); 
        var tipoServicio = button.data('tipo'); 
        var modal = $('#modalVideos'); 

        // Establece la id del servicio seleccionado para manejar las imagenes
        $('#video-idServicio').val(id);      
        $('#video-tipoServicio').val(tipoServicio);      

        // Abre el modal 
        modal.modal('show'); 

        // Realiza la petición AJAX para obtener los datos 
        $.ajax({ 

            url: '/obrero/conseguirVideos/' + id + '/' + tipoServicio, 
            method: 'GET',
            success: function(response) {
                var tbody = modal.find('table tbody');
                tbody.empty(); // Limpia el contenido actual

                response.forEach(function(item) {
                    if (item.tipo === 'video') { // Filtra solo los videos
                        var row = '<tr>' +
                            '<td>' + item.id + '</td>' +
                            '<td>' + item.nombre + '</td>' +
                            '<td><a href="' + item.link + '" target="_blank">Ver enlace</a></td>' +
                            '<td>' +
                                '<video width="100" controls>' +
                                    '<source src="' + item.link + '" type="video/mp4">' +
                                    'Tu navegador no soporta la reproducción de videos.' +
                                '</video>' +
                            '</td>' +
                            '<td>' + item.tipo + '</td>' +
                            '<td>' +
                                '<button class="btn btn-warning btn-sm reemplazar-video" data-id="' + item.id + '" data-tipo="' + tipoServicio + '">Reemplazar</button> ' +
                                '<button class="btn btn-danger btn-sm eliminar-imagen" data-id="' + item.id + '" data-tipo="' + tipoServicio + '">Eliminar</button>' +
                            '</td>' +
                        '</tr>';

                        tbody.append(row);
                    }
                });
            },
            error: function() {
                var tbody = modal.find('table tbody');
                tbody.html('<tr><td colspan="5">Error al cargar los datos.</td></tr>');
            }

        });
        });  
        
        $('#addVideoForm').on('submit', function(event) { 

        event.preventDefault(); 

        var formData = new FormData(this); 
        var idServicio = $('#video-idServicio').val(); 
        var tipoServicio = $('#video-tipoServicio').val(); 
        var tipoInput = $('#tipoInputvi').val();

        formData.append('idServicio', idServicio); 
        formData.append('tipoServicio', tipoServicio);  
        formData.append('tipo', tipoInput);               

        console.log(tipoInput);                           

        $.ajax({ 
            url: '/obrero/guardarVideo', 
            method: 'POST', 
            data: formData, 
            processData: false, 
            contentType: false, 

            success: function(response) { 

                // Cerrar el modal y mostrar un mensaje de éxito 
                $('#addVideoModal').modal('hide'); 
                
                // Mostrar el modal de éxito
                showSuccessModal('Video guardado con éxito.'); 

                // Actualiza la tabla de imágenes en el modal principal para no tener que tirar F5 // EXPERIMENTAL
                var nuevoArchivo = '<tr>' + 
                    '<td>' + response.id + '</td>' + 
                    '<td>' + response.nombre + '</td>' + 
                    '<td><a href="' + response.link + '" target="_blank">Ver enlace</a></td>' + 
                    '<td>'; 
                if (response.tipo === 'video') { 
                            nuevoArchivo += '<video width="100" controls><source src="' + response.link + '" type="video/mp4">Tu navegador no soporta la reproducción de videos.</video>'; 
               } else  if (response.tipo === 'Imagen') { 
                    nuevoArchivo += '<img src="' + response.link + '" alt="' + response.nombre + '" width="100">'; 
               
                } else if (response.tipo === 'Documento') { 
                    nuevoArchivo += '<a href="' + response.link + '" download>' + response.nombre + '</a>'; 
                } 
                
                nuevoArchivo += '</td>' + 
                    '<td>' + response.tipo + '</td>' + 
                    '<td>' + 
                        '<button class="btn btn-warning btn-sm reemplazar-archivo" data-id="' + response.id + '" data-tipo-servicio="' + tipoServicio + '">Reemplazar</button> ' + 
                        '<button class="btn btn-danger btn-sm eliminar-archivo" data-id="' + response.id + '" data-tipo-servicio="' + tipoServicio + '">Eliminar</button>' + 
                    '</td>' + 
                    '</tr>'; 

                $('#modalVideos').find('table tbody').append(nuevoArchivo); 

            }, 
            error: function() { 

                // Mostrar el modal de error
                showErrorModal('Error al guardar el archivo.');

            } 
        }); 
        });          


///////////////////////////////////////////////////////////////////////////////////////////////////////////

//Funcionalidad de conseguir Documentos  de un servicio --------------------------------------------------------------            

        $('.ver-archivo').on('click', function(event) { 

        event.preventDefault(); 

        var button = $(this);                 
        var id = button.data('id'); 
        var tipoServicio = button.data('tipo'); 
        var modal = $('#modalDocumentos'); 

        // Establece la id del servicio seleccionado para manejar las imagenes
        $('#documento-idServicio').val(id);      
        $('#documento-tipoServicio').val(tipoServicio);      

        // Abre el modal 
        modal.modal('show'); 

        // Realiza la petición AJAX para obtener los datos 
        $.ajax({ 

            url: '/obrero/conseguirDocume/' + id + '/' + tipoServicio, 
            method: 'GET',
            success: function(response) { 
            var tbody = modal.find('table tbody'); 
            tbody.empty(); // Limpia el contenido actual 

            response.forEach(function(archivo) { 
                if (archivo.tipo === 'documento') { // Solo carga documentos
                    var row = '<tr>' + 
                        '<td>' + archivo.id + '</td>' + 
                        '<td>' + archivo.nombre + '</td>' + 
                        '<td><a href="' + archivo.link + '" download>' + archivo.nombre + '</a></td>' + 
                        '<td>' + archivo.tipo + '</td>' +
                        '<td>' + 
                            '<button class="btn btn-warning btn-sm reemplazar-documento" data-id="' + archivo.id + '" data-tipo="' + tipoServicio + '">Reemplazar</button> ' + 
                            '<button class="btn btn-danger btn-sm eliminar-imagen" data-id="' + archivo.id + '" data-tipo="' + tipoServicio + '">Eliminar</button>' + 
                        '</td>' +
                    '</tr>'; 
                    tbody.append(row); 
                }
            }); 
        }, 

            error: function() {
                var tbody = modal.find('table tbody');
                tbody.html('<tr><td colspan="5">Error al cargar los datos.</td></tr>');
            }

        });
        });  

        $('#addDocumeForm').on('submit', function(event) { 

        event.preventDefault(); 

        var formData = new FormData(this); 
        var idServicio = $('#documento-idServicio').val(); 
        var tipoServicio = $('#documento-tipoServicio').val(); 
        var tipoInput = $('#tipoInputdoc').val();

        formData.append('idServicio', idServicio); 
        formData.append('tipoServicio', tipoServicio);  
        formData.append('tipo', tipoInput);               

        console.log(tipoInput);                           

        $.ajax({ 
            url: '/obrero/guardarDocume', 
            method: 'POST', 
            data: formData, 
            processData: false, 
            contentType: false, 

            success: function(response) { 

                // Cerrar el modal y mostrar un mensaje de éxito 
                $('#addDocumeModal').modal('hide'); 
                
                // Mostrar el modal de éxito
                showSuccessModal('Archivo guardado con éxito.'); 

                // Actualiza la tabla de imágenes en el modal principal para no tener que tirar F5 // EXPERIMENTAL
                var nuevoArchivo = '<tr>' + 
                    '<td>' + response.id + '</td>' + 
                    '<td>' + response.nombre + '</td>' + 
                    '<td><a href="' + response.link + '" target="_blank">Ver enlace</a></td>' + 
                    '<td>'; 
                if (response.tipo === 'video') { 
                            nuevoArchivo += '<video width="100" controls><source src="' + response.link + '" type="video/mp4">Tu navegador no soporta la reproducción de videos.</video>'; 
            } else  if (response.tipo === 'Imagen') { 
                    nuevoArchivo += '<img src="' + response.link + '" alt="' + response.nombre + '" width="100">'; 
            
                } else if (response.tipo === 'documento') { 
                    nuevoArchivo += '<a href="' + response.link + '" download>' + response.nombre + '</a>'; 
                } 
                
                nuevoArchivo += '</td>' + 
                    '<td>' + response.tipo + '</td>' + 
                    '<td>' + 
                        '<button class="btn btn-warning btn-sm reemplazar-archivo" data-id="' + response.id + '" data-tipo-servicio="' + tipoServicio + '">Reemplazar</button> ' + 
                        '<button class="btn btn-danger btn-sm eliminar-archivo" data-id="' + response.id + '" data-tipo-servicio="' + tipoServicio + '">Eliminar</button>' + 
                    '</td>' + 
                    '</tr>'; 

                $('#modalDocumentos').find('table tbody').append(nuevoArchivo); 

            }, 
            error: function() { 

                // Mostrar el modal de error
                showErrorModal('Error al guardar el archivo.');

            } 
        }); 
        });          
///////////////////////////////////////////////////////////////////////////////////////////////////////////
 //Muestra el modal de reemplazar imagen
 $(document).on('click', '.reemplazar-documento', function() { 

var button = $(this); 
var idImagen = button.data('id'); 
var tipoServicio = button.data('tipo'); 


// Llena los campos ocultos con los datos correspondientes 
$('#docume-idServicioE').val(idImagen); 
$('#docume-tipoServicioE').val(tipoServicio);

$.ajax({

    url: '/obrero/verImagenEdit',
    type: 'GET',
    dataType: 'json',
    data: {

        idImagen: idImagen,
        tipoServicio: tipoServicio,

        _token: '{{ csrf_token() }}'

    },
    success: function(data) {

        var image = data.image;

        // Rellena los inputs correspondientes               

        $('#tipoInputEdit').val(image.tipo);                      

    },

    error: function(error) {

        console.log(error);

    }

});

// Abre el modal de reemplazo de imagen 
$('#modal-reemplazar-documento').modal('show'); 

});

//Guardar imagen reemplazante
$('#guardar-nueva-docume').on('click', function(event) { 

event.preventDefault(); 

var formData = new FormData(); 
var idImagen = $('#docume-idServicioE').val(); 
var tipoServicio = $('#docume-tipoServicioE').val(); 
var imagenNueva = $('#reemplazar-documeInput')[0].files[0]; 
var tipoInput = $('#tipoInputdoEdit').val();

formData.append('idImagen', idImagen); 
formData.append('tipoServicio', tipoServicio); 
formData.append('imagen', imagenNueva); 
formData.append('tipo', tipoInput);  

$.ajax({ 

    url: '/obrero/reemplazarDocume', 
    method: 'POST', 

    data: formData, 
    processData: false, 
    contentType: false, 

    success: function(response) { 
        
        // Cerrar el modal y mostrar un mensaje de éxito (Por crear) 
        $('#modal-reemplazar-documento').modal('hide'); 

        // Mostrar el modal de éxito
        showSuccessModal('Archivo reemplazado con éxito.'); 
        setTimeout(function() { location.reload(); }, 1000);

        // Actualizar despues sin f5 - EXPERIMENTAL                       
        var row = $('button[data-id="' + idImagen + '"]').closest('tr'); 
        row.find('td:nth-child(2)').text(response.nombre); 
        row.find('td:nth-child(3) a').attr('href', response.link).text('Ver enlace'); 
        
        if (response.tipo === 'Imagen') { 
            row.find('td:nth-child(4)').html('<img src="' + response.link + '" alt="' + response.nombre + '" width="100">'); 
        } else if (response.tipo === 'Video') { 
            row.find('td:nth-child(4)').html('<video width="100" controls><source src="' + response.link + '" type="video/mp4">Tu navegador no soporta la reproducción de videos.</video>'); 
        } else if (response.tipo === 'Documento') { 
            row.find('td:nth-child(4)').html('<a href="' + response.link + '" download>' + response.nombre + '</a>'); 
        }

    }, 

    error: function() { 

        // Mostrar el modal de error
        showErrorModal('Error al reemplazar el archivo.');

    } 

}); 
});

            //Funcionalidad de conseguir materiales de un servicio --------------------------------------------------------------
            $('.ver-materiales').on('click', function(event) { 

                event.preventDefault(); 

                var button = $(this);                 
                var id = button.data('id'); 
                var tipoServicio = button.data('tipo'); 
                var modal = $('#modalMateriales'); 

                // Establece la id del servicio seleccionado para manejar los materiales
                $('#material-idServicio').val(id);      
                $('#material-tipoServicio').val(tipoServicio);      

                // Abre el modal 
                modal.modal('show'); 
                
                // Realiza la petición AJAX para obtener los datos 
                $.ajax({ 

                    url: '/obrero/conseguirMateriales/' + id + '/' + tipoServicio, 
                    method: 'GET', 
                    success: function(response) { 

                        var tbody = modal.find('table tbody'); 
                        tbody.empty(); // Limpia el contenido actual 

                        response.forEach(function(material) { 

                            var row = '<tr>' + 
                            '<td>' + material.id + '</td>' + 
                            '<td>' + material.nombre + '</td>' + 
                            '<td>' + material.precio + '</td>' + 
                            
                            '<td>' + 
                                '<button class="btn btn-warning btn-sm reemplazar-material" data-id="' + material.id + '" data-tipo="' + tipoServicio + '">Reemplazar</button> ' + 
                                '<button class="btn btn-danger btn-sm eliminar-material" data-id="' + material.id + '" data-tipo="' + tipoServicio + '">Eliminar</button>' + '</td>' +
                            '</tr>'; 

                            tbody.append(row); 

                        }); 
                    }, 

                    error: function() { 
                        var tbody = modal.find('table tbody'); 
                        tbody.html('<tr><td colspan="5">Error al cargar los datos.</td></tr>'); 
                    }

                });
            });  

            $('#addMaterialForm').on('submit', function(event) { 

                event.preventDefault();                 
                
                var idServicio = $('#material-idServicio').val(); 
                var tipoServicio = $('#material-tipoServicio').val(); 
               
                var nombre = $('#nombreMaterialInput').val();
                var precio = $('#precioMaterialInput').val();                
                
                $.ajax({ 
                    url: '/obrero/guardarMaterial', 
                    type: 'POST',
                    data: {

                        nombre: nombre,
                        precio: precio,
                        idServicio: idServicio,
                        tipoServicio: tipoServicio,

                        _token: '{{ csrf_token() }}'
                    },

                    success: function(response) { 

                        // Cerrar el modal y mostrar un mensaje de éxito 
                        $('#addMaterialModal').modal('hide');                         
                        $('#modalMateriales').modal('hide'); 
                        
                        // Mostrar el modal de éxito
                        showSuccessModal('Material guardado con éxito. Se refrescara la pagina');       
                        
                        setTimeout(function() { location.reload(); }, 1000); 

                    }, 
                    error: function() { 

                        // Mostrar el modal de error
                        showErrorModal('Error al guardar el material.');

                    } 
                }); 
            });          
            
            // Muestra el modal de reemplazar material y establece los datos originales
            $(document).on('click', '.reemplazar-material', function() { 

                var button = $(this); 
                var idMaterial = button.data('id'); 
                var tipoServicio = button.data('tipo'); 

                // Llena los campos ocultos con los datos correspondientes 
                $('#material-idMaterialE').val(idMaterial); 
                $('#material-tipoServicioE').val(tipoServicio);

                $.ajax({

                    url: '/obrero/verMaterial',
                    type: 'GET',
                    dataType: 'json',
                    data: {

                        idMaterial: idMaterial,
                        tipoServicio: tipoServicio,

                        _token: '{{ csrf_token() }}'

                    },
                    success: function(data) {

                        var material = data.material;

                        // Rellena los inputs correspondientes                       

                        $('#nombreMaterialEdit').val(material.nombre);
                        $('#precioMaterialEdit').val(material.precio);
                        

                    },

                    error: function(error) {

                        console.log(error);

                    }

                });

                // Abre el modal de reemplazo de material
                $('#modal-reemplazar-material').modal('show'); 

            });

            //Guardar material reemplazante
            $('#guardar-nuevo-material').on('click', function(event) { 
                
                event.preventDefault();                 
               
                var idMaterial = $('#material-idMaterialE').val(); 
                var tipoServicio = $('#material-tipoServicioE').val(); 
                
                var nombre = $('#nombreMaterialEdit').val();
                var precio = $('#precioMaterialEdit').val();                
                
                
                $.ajax({

                    url: '/obrero/reemplazarMaterial',
                    type: 'PUT',

                    data: {

                        idMaterial: idMaterial,
                        tipoServicio: tipoServicio,
                        nombre: nombre,
                        precio: precio,

                        _token: '{{csrf_token()}}'
                    },

                    success: function(data) {

                        // Cerrar el modal y mostrar un mensaje de éxito
                        $('#modal-reemplazar-material').modal('hide'); 

                        // Cerrar el modal y mostrar un mensaje de éxito
                        $('#modalMateriales').modal('hide'); 

                        // Mostrar el modal de éxito
                        showSuccessModal('Material reemplazado con éxito. Se refrescara la pagina.'); 

                        setTimeout(function() { location.reload(); }, 1000); 

                    },

                    error: function() { 

                        // Mostrar el modal de error
                        showErrorModal('Error al reemplazar el material.');

                    } 

                }); 
            });

            // Maneja las eliminaciones de materiales
            $(document).on('click', '.eliminar-material', function() { 

                var button = $(this); 
                var idMaterial = button.data('id'); 
                var tipoServicio = button.data('tipo'); 
                
                // Mostrar confirmación antes de eliminar 
                if (confirm('¿Seguro que quieres borrar este material?')) { 

                    $.ajax({ 
                        
                        url: '/obrero/eliminarMaterial', 
                        method: 'POST', 
                        data: { 
                            
                            idMaterial: idMaterial, 
                            tipoServicio: tipoServicio, 
                            _token: '{{ csrf_token() }}' // Por si acaso de nuevo la token CSRF para la seguridad 
                        }, 
                        success: function(response) { 

                            // Cerrar el modal y mostrar un mensaje de éxito
                            $('#modalMateriales').modal('hide'); 

                            // Mostrar el modal de éxito
                            showSuccessModal('Material eliminado con éxito.');
                            
                            // Eliminar la fila de manera dinamica, algo que estoy probando para evitar F5 a cada instante
                            button.closest('tr').remove();                             

                        }, error: function() { 

                            // Mostrar el modal de error
                            showErrorModal('Error al eliminar el material.');

                        } 
                    }); 
                } 
            });     

        });
       
       
// $(document).on('change', '.cambiar-estado', function () {
//     var id = $(this).data('id');  // Obtener el ID
//     var estado = $(this).is(':checked') ? 'Realizado' : 'Pendiente';  // Determinar el nuevo estado

//     $.ajax({
//         url: '/cambiar-estado/' + id,
//         method: 'POST',
//         data: {
//             _token: $('meta[name="csrf-token"]').attr('content'),  // Token CSRF
//             estado: estado  // Pasar el nuevo estado
//         },
//         success: function (response) {
//             alert(response.message);  // Mostrar mensaje de éxito
//             location.reload();  // Recargar la página para reflejar el cambio
//         },
//         error: function (xhr) {
//             alert('Error: ' + xhr.responseJSON.message);  // Mostrar mensaje de error
//         }
//     });
// });  

///////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////FUNCION PARA LLAMAR LOS MODales del estado de los servicios
function showConfirmModalEstado(message, onConfirm) {
    document.getElementById('confirmMessage').innerText = message;
    var confirmModal = new bootstrap.Modal(document.getElementById('confirmModalEstado'));
    confirmModal.show();

    document.getElementById('confirmYes').onclick = function() {
        confirmModal.hide();
        if (onConfirm) onConfirm();
    };
}

function showErrorModalEstado(message) {
    document.getElementById('errorMessage').innerText = message;
    var errorModal = new bootstrap.Modal(document.getElementById('errorModalEstado'));
    errorModal.show();

    // Evento para el botón "Cerrar"
    document.getElementById('btn_cerrar_Error_Estado').onclick = function () {
        errorModal.hide();
        location.reload();
    };
   
}
function showSuccessModalEstado(message) {
    // Actualizar el mensaje del modal
    document.getElementById('texto_exito').innerText = message;

    // Mostrar el modal
    var successModalEstado = new bootstrap.Modal(document.getElementById('successModalEstado'));
    successModalEstado.show();

     // Evento para el botón "Cerrar"
     document.getElementById('btn_cerrar_modalEstado').onclick = function () {
        successModalEstado.hide();
        location.reload();
    };
       
}


$(document).on('change', '.cambiar-estado', function () {
    var id = $(this).data('id');
    var nuevoEstado = $(this).is(':checked') ? 'Realizado' : 'Pendiente';
    var estadoActual = $(this).data('estado');

    if (estadoActual === 'Realizado' && nuevoEstado === 'Pendiente') {
        showConfirmModalEstado('El Estado Ya Ha Sido Cambiado A "Realizado". ¿Está Seguro De Que Desea Cambiarlo A "Pendiente"?', function () {
            enviarSolicitudAjax(id, nuevoEstado);
        });
        $(this).prop('checked', true);
        return;
    }

    if (estadoActual === 'Pendiente' && nuevoEstado === 'Realizado') {
        showConfirmModalEstado('El Estado Actual Es "Pendiente". ¿Está Seguro De Que Desea Cambiarlo A "Realizado"?', function () {
            enviarSolicitudAjax(id, nuevoEstado);
        });
        $(this).prop('checked', false); // Revertimos temporalmente el cambio
        return;
    }

    enviarSolicitudAjax(id, nuevoEstado);
});

function enviarSolicitudAjax(id, estado) {
$.ajax({
        url: '/obrero/cambiar-estado/' + id,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            estado: estado
        },
        success: function (response) {
            if (estado === 'Realizado') {
                showSuccessModalEstado('El estado se ha cambiado a "Realizado" correctamente.');
            } else {
                location.reload(); // Recarga la página directamente si el estado no es "Realizado"
            }
        },
        error: function (xhr) {
            showErrorModalEstado('Error: ' + xhr.responseJSON.message);
            $('.cambiar-estado[data-id="' + id + '"]').prop('checked', !$('.cambiar-estado[data-id="' + id + '"]').is(':checked'));
        }
    });
}


// $(document).on('change', '.cambiar-estado', function () {
//     var id = $(this).data('id');  // Obtener el ID
//     var nuevoEstado = $(this).is(':checked') ? 'Realizado' : 'Pendiente';  // Determinar el nuevo estado
//     var estadoActual = $(this).data('estado');  // Obtener el estado actual

//     // Confirmación para cambiar de "Realizado" a "Pendiente"
//     if (estadoActual === 'Realizado' && nuevoEstado === 'Pendiente') {
//         var confirmacion = confirm('El estado ya ha sido cambiado a "Realizado". ¿Está seguro de que desea cambiarlo a "Pendiente"?');
//         if (!confirmacion) {
//             $(this).prop('checked', true);  // Revertir el cambio si se cancela la confirmación
//             return;
//         }
//     }

//     // Enviar la solicitud AJAX
//     $.ajax({
//         url: '/cambiar-estado/' + id,
//         method: 'POST',
//         data: {
//             _token: $('meta[name="csrf-token"]').attr('content'),  // Token CSRF
//             estado: nuevoEstado  // Pasar el nuevo estado
//         },
//         success: function (response) {
//             alert(response.message);  // Mostrar mensaje de éxito
//             location.reload();  // Recargar la página para reflejar el cambio
//         },
//         error: function (xhr) {
//             alert('Error: ' + xhr.responseJSON.message);  // Mostrar mensaje de error
//             $(this).prop('checked', !$(this).is(':checked'));  // Revertir el cambio en caso de error
//         }
//     });
// });


// $(document).on('change', '.cambiar-estado2', function () {
//     var id = $(this).data('id');  // Obtener el ID
//     var nuevoEstado = $(this).is(':checked') ? 'Realizado' : 'Pendiente';  // Determinar el nuevo estado
//     var estadoActual = $(this).data('estado');  // Obtener el estado actual

//     // Confirmación para cambiar de "Realizado" a "Pendiente"
//     if (estadoActual === 'Realizado' && nuevoEstado === 'Pendiente') {
//         var confirmacion = confirm('El estado ya ha sido cambiado a "Realizado". ¿Está seguro de que desea cambiarlo a "Pendiente"?');
//         if (!confirmacion) {
//             $(this).prop('checked', true);  // Revertir el cambio si se cancela la confirmación
//             return;
//         }
//     }
//     $.ajax({
//         url: '/cambiar-estado2/' + id,
//         method: 'POST',
//         data: {
//             _token: $('meta[name="csrf-token"]').attr('content'),  // Token CSRF
//             estado: nuevoEstado  // Pasar el nuevo estado
//         },
//         success: function (response) {
//             alert(response.message);  // Mostrar mensaje de éxito
//             location.reload();  // Recargar la página para reflejar el cambio
//         },
//         error: function (xhr) {
//             alert('Error: ' + xhr.responseJSON.message);  // Mostrar mensaje de error
//         }
//     });
// });

$(document).on('change', '.cambiar-estado2', function () {
    var id = $(this).data('id');
    var nuevoEstado = $(this).is(':checked') ? 'Realizado' : 'Pendiente';
    var estadoActual = $(this).data('estado');

    if (estadoActual === 'Realizado' && nuevoEstado === 'Pendiente') {
        showConfirmModalEstado('El Estado Ya Ha Sido Cambiado A "Realizado". ¿Está Seguro De Que Desea Cambiarlo A "Pendiente"?', function () {
            enviarSolicitudAjaxGasfiteria(id, nuevoEstado);
        });
        $(this).prop('checked', true);
        return;
    }

    if (estadoActual === 'Pendiente' && nuevoEstado === 'Realizado') {
        showConfirmModalEstado('El Estado Actual Es "Pendiente". ¿Está Seguro De Que Desea Cambiarlo A "Realizado"?', function () {
            enviarSolicitudAjaxGasfiteria(id, nuevoEstado);
            location.reload();

        });
        $(this).prop('checked', false); // Revertimos temporalmente el cambio
        return;
    }

    enviarSolicitudAjaxGasfiteria(id, nuevoEstado);
});
function enviarSolicitudAjaxGasfiteria(id, estado) {
    $.ajax({
        url: '/obrero/cambiar-estado2/' + id,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            estado: estado
        },
        success: function (response) {
            if (estado === 'Realizado') {
                showSuccessModalEstado('El estado se ha cambiado a "Realizado" correctamente.');
            } else {
                location.reload(); // Recarga la página directamente si el estado no es "Realizado"
            }
        },
        error: function (xhr) {
            showErrorModalEstado('Error: ' + xhr.responseJSON.message);
            $('.cambiar-estado2[data-id="' + id + '"]').prop('checked', !$('.cambiar-estado2[data-id="' + id + '"]').is(':checked'));
        }
    });
    
}

////////////////////SERVICIO OBRA MAYOR////////////////////////////////////////
    
// $(document).on('change', '.cambiar-estado3', function () {
//     var id = $(this).data('id');  // Obtener el ID
//     var nuevoEstado = $(this).is(':checked') ? 'Realizado' : 'Pendiente';  // Determinar el nuevo estado
//     var estadoActual = $(this).data('estado');  // Obtener el estado actual

//     // Confirmación para cambiar de "Realizado" a "Pendiente"
//     if (estadoActual === 'Realizado' && nuevoEstado === 'Pendiente') {
//         var confirmacion = confirm('El estado ya ha sido cambiado a "Realizado". ¿Está seguro de que desea cambiarlo a "Pendiente"?');
//         if (!confirmacion) {
//             $(this).prop('checked', true);  // Revertir el cambio si se cancela la confirmación
//             return;
//         }
//     }


//     $.ajax({
//         url: '/cambiar-estado3/' + id,
//         method: 'POST',
//         data: {
//             _token: $('meta[name="csrf-token"]').attr('content'),  // Token CSRF
//             estado: nuevoEstado  // Pasar el nuevo estado
//         },
//         success: function (response) {
//             alert(response.message);  // Mostrar mensaje de éxito
//             location.reload();  // Recargar la página para reflejar el cambio
//         },
//         error: function (xhr) {
//             alert('Error: ' + xhr.responseJSON.message);  // Mostrar mensaje de error
//         }
//     });
// });


$(document).on('change', '.cambiar-estado3', function () {
    var id = $(this).data('id');
    var nuevoEstado = $(this).is(':checked') ? 'Realizado' : 'Pendiente';
    var estadoActual = $(this).data('estado');

    if (estadoActual === 'Realizado' && nuevoEstado === 'Pendiente') {
        showConfirmModalEstado('El Estado Ya Ha Sido Cambiado A "Realizado". ¿Está Seguro De Que Desea Cambiarlo A "Pendiente"?', function () {
            enviarSolicitudAjaxObraMayor(id, nuevoEstado);
        });
        $(this).prop('checked', true);
        return;
    }

    if (estadoActual === 'Pendiente' && nuevoEstado === 'Realizado') {
        showConfirmModalEstado('El Estado Actual Es "Pendiente". ¿Está Seguro De Que Desea Cambiarlo A "Realizado"?', function () {
            enviarSolicitudAjaxObraMayor(id, nuevoEstado);
        });
        $(this).prop('checked', false); // Revertimos temporalmente el cambio
        return;
    }

    enviarSolicitudAjaxObraMayor(id, nuevoEstado);
});

function enviarSolicitudAjaxObraMayor(id, estado) {
    $.ajax({
        url: '/obrero/cambiar-estado3/' + id,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            estado: estado
        },
        success: function (response) {
            if (estado === 'Realizado') {
                showSuccessModalEstado('El estado se ha cambiado a "Realizado" correctamente.');
            } else {
                location.reload(); // Recarga la página directamente si el estado no es "Realizado"
            }
        },
        error: function (xhr) {
            showErrorModalEstado('Error: ' + xhr.responseJSON.message);
            $('.cambiar-estado3[data-id="' + id + '"]').prop('checked', !$('.cambiar-estado3[data-id="' + id + '"]').is(':checked'));
        }
    });
}





//     $(document).on('change', '.cambiar-estado4', function () {
//     var id = $(this).data('id');  // Obtener el ID
//     var nuevoEstado4 = $(this).is(':checked') ? 'Realizado' : 'Pendiente';  // Determinar el nuevo estado
//     var estadoActual4 = $(this).data('estado');  // Obtener el estado actual

//     // Confirmación para cambiar de "Realizado" a "Pendiente"
//     if (estadoActual4 === 'Realizado' && nuevoEstado4 === 'Pendiente') {
//         var confirmacion = confirm('El estado ya ha sido cambiado a "Realizado". ¿Está seguro de que desea cambiarlo a "Pendiente"?');
//         if (!confirmacion) {
//             $(this).prop('checked', true);  // Revertir el cambio si se cancela la confirmación
//             return;
//         }
//     }

//     $.ajax({
//         url: '/cambiar-estado4/' + id,
//         method: 'POST',
//         data: {
//             _token: $('meta[name="csrf-token"]').attr('content'),  // Token CSRF
//             estado: nuevoEstado4  // Pasar el nuevo estado
//         },
//         success: function (response) {
//             alert(response.message);  // Mostrar mensaje de éxito
//             location.reload();  // Recargar la página para reflejar el cambio
//         },
//         error: function (xhr) {
//             alert('Error: ' + xhr.responseJSON.message);  // Mostrar mensaje de error
//         }
//     });
// });


$(document).on('change', '.cambiar-estado4', function () {
    var id = $(this).data('id');
    var nuevoEstado = $(this).is(':checked') ? 'Realizado' : 'Pendiente';
    var estadoActual = $(this).data('estado');

    if (estadoActual === 'Realizado' && nuevoEstado === 'Pendiente') {
        showConfirmModalEstado('El Estado Ya Ha Sido Cambiado A "Realizado". ¿Está Seguro De Que Desea Cambiarlo A "Pendiente"?', function () {
            enviarSolicitudAjaxObraMenor(id, nuevoEstado);
        });
        $(this).prop('checked', true);
        return;
    }

    if (estadoActual === 'Pendiente' && nuevoEstado === 'Realizado') {
        showConfirmModalEstado('El Estado Actual Es "Pendiente". ¿Está Seguro De Que Desea Cambiarlo A "Realizado"?', function () {
            enviarSolicitudAjaxObraMenor(id, nuevoEstado);
        });
        $(this).prop('checked', false); // Revertimos temporalmente el cambio
        return;
    }

    enviarSolicitudAjaxObraMenor(id, nuevoEstado);
});

function enviarSolicitudAjaxObraMenor(id, estado) {
    $.ajax({
        url: '/obrero/cambiar-estado4/' + id,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            estado: estado
        },
        success: function (response) {
            if (estado === 'Realizado') {
                showSuccessModalEstado('El estado se ha cambiado a "Realizado" correctamente.');
            } else {
                location.reload(); // Recarga la página directamente si el estado no es "Realizado"
            }
        },
        error: function (xhr) {
            showErrorModalEstado('Error: ' + xhr.responseJSON.message);
            $('.cambiar-estado4[data-id="' + id + '"]').prop('checked', !$('.cambiar-estado4[data-id="' + id + '"]').is(':checked'));
        }
    });
}



    </script>
@endsection