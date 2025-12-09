@extends('layouts.app')
@section('content')
<div class="container-fluid overflow-hidden" style="background-color: #FFAB40">
    <div class="row vh-100 overflow-auto" style="background-color:rgb(255, 255, 255)">
        @include('layouts.sidebar')
        <div class="col d-flex flex-column h-100" style="padding:0;">
            <div class="flex-grow-1">
                {{-- Contenido --}}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6" style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px;color: white">
                            <h1 class="text-uppercase text-black">Propietarios</h1>
                        </div>
                    </div>
                </div>
                {{-- Tabla de usuarios --}}
                <div class="container-fluid">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-4 mb-4">
                            <div class="input-group mx-2 shadow-lg" style="max-width: 400px;">
                                <span class="input-group-text bg-primary text-white shadow-sm">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="text" id="buscador_cnn" placeholder="Buscar Propietario" 
                                    class="form-control shadow-sm border-0" 
                                    style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 text-end">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarpropietario" style=>
                                <span>AGREGAR PROPIETARIO</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-auto shadow-lg" style="max-height: 65vh;">
                        <table class="table table-striped-columns">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Rut</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Diereccion</th>
                                    <th>Ciudad</th>
                                    <th>Acciones</th>
                                </tr>

                            </thead>
                            <tbody id="tablaUa">
                                @foreach ($propietarios as $propietario)
                                    <tr>

                                        <td >{{ $loop->iteration }}</td>
                                        <td >{{ $propietario->nombre }}</td>
                                        <td >{{ $propietario->rut }}</td>
                                        <td >{{ $propietario->correo }}</td>
                                        <td >{{ $propietario->telefono }}</td>
                                        <td >{{ $propietario->direccion }}</td>
                                        <td >{{ $propietario->ciudad }}</td>

                                        <td>
                                            <!-- Iconos de editar y eliminar -->
                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm editar-propietario-btn" data-id="{{ $propietario->id }}" data-toggle="modal">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm borrar-propietario-btn" data-id="{{ $propietario->id }}"><i class="fas fa-trash-alt"></i></a>
                                            <a href="#" class="btn btn-success btn-sm mostra-cuentas-btn"data-id="{{ $propietario->id }}"><i class="fa-solid fa-sack-dollar"></i></i></a>

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

<!-- Modal agregar Propietario nuevo-->
<div class="modal fade" id="agregarpropietario"  tabindex="-1" data-bs-backdrop="static" tabindex="-1" aria-labelledby="agregarpropietarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarpropietarioLabel">Agregar Propietario</h5>
            </div>

            <div class="modal-body ">
                <form>
                    <div class="container">
                        <!-- Campos de entrada -->
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="nombreInput"><b>Nombre</b></label>
                                <input type="text" class="form-control mt-2" id="nombreInput" placeholder="Ej: Pedro Aguilera" required>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="rutInput"><b>Rut</b></label>
                            <input type="text" class="form-control mt-2" id="rutInput" placeholder="12.345.678-9"
                            pattern="\d{1,2}\.\d{3}\.\d{3}-[\dkK]" title="Formato válido: 12.345.678-9" minlength="9" maxlength="12">
                        </div>

                        <div class="form-group mb-3 col-6">
                            <label for="telefonoInput"><b>Teléfono</b></label>
                            <input type="text" class="form-control mt-2" id="telefonoInput" 
                                placeholder="Ej: 912345678" maxlength="9" minlength="9" required 
                                pattern="\d{9}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);">
                        </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group mb-3 ">
                                <label for="correoInput"><b>Correo</b></label>
                                <input type="text" class="form-control mt-2" id="correoInput" placeholder="Ej: pedro@gmail.com" required>
                            </div>

                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="direccionInput"><b>Dirección</b></label>
                                    <input type="text" class="form-control mt-2" id="direccionInput" placeholder="Dirección" required>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label for="ciudadInput"><b>Ciudad</b></label>
                                    <input type="text" class="form-control mt-2" id="ciudadInput" placeholder="Ciudad" required>
                                </div>
                            </div>
                        <div class="col-12">
                            <button class="btn btn-success w-100 mt-3 mb-3 text-uppercase text-white" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample2 ">
                                <b>Agregar Datos Bancarios</b>
                            </button>
                        </div>
                        <!-- <h5><b>Datos Bancarios</b></h5> -->
                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                        <div class="row">
                                <div class="col-md-4">
                                    <label for="nombreBancoInput"><b>Nombre del Banco</b></label>
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control m-1" id="nombreBancoInput" placeholder="Nombre del Banco" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="numeroCuenteInput"><b>Numero de Cuenta</b></label>
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control m-1" id="numeroCuenteInput" placeholder="numero de cuenta" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="TipoCuentaInput"><b>Tipo de Cuenta</b></label>
                                    <div class="form-group mb-2 d-flex">
                                        <select name="notificaion" id="TipoCuentaInput" class="form-select m-1">
                                            <option selected disabled value="option">Seleccione un tipo de Cuenta</option>
                                            <option value="Ahorro">Ahorro</option>
                                            <option value="Corriente">Corriente</option>
                                            <option value="Vista">Vista</option>
                                            <option value="Chequera electrónica">Chequera Electrónica</option>


                                        </select>
                                    </div>
                                </div>
                            {{-- <div class="col-md-4">
                                <label for="monedaInput"><b>Moneda:</b></label>
                                <div class="form-group mb-2 d-flex">
                                   <select id="monedaInput" name="moneda"class="form-select m-1" required>
                                    <option value="Peso Chileno">Cl - Peso Chileno</option>
                                    <option value="USD">USD - Dólar Americano</option>
                                    <option value="EUR">EUR - Euro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="swiftInput"><b>Código SWIFT:</b></label>
                                <div class="form-group mb-2 d-flex">
                                <input type="text" id="swiftInput" name="codigo_swift" placeholder="codigo" class="form-control m-1">
                                </div>
                            </div>
                                <div class="col-md-4">
                                <label for="paisInput"><b>Pais:</b></label>
                                <div class="form-group mb-2 d-flex">
                                <input type="text" id="paisInput" name="pais"placeholder="pais donde esta el banco"class="form-control m-1">
                             </div> --}}

                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-success m-1 text-uppercase text-white" id="agregar-datosbanca"><b>Agregar Cuenta</b></button>
                                </div>
                            </div>
                        </div>
                                <ul class="text-uppercase mt-4" id="lista-Datos">
                                    <!-- <li></li> -->
                                </ul>
                            </div>
                        <div class="modal-footer">
                        <!-- Botones de cambios -->
                        <button type="button" id="btn_agregar" class="btn btn-primary">Guardar</button>
                        <button type="button" id="btn_cerrar_agregar" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
 <!-- Modal exito -->
 {{-- <div class="modal fade" id="modalAlertaAgregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAlertaAgregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
            <div class="modal-header alert alert-success" role="alert" style="border: none;">
                <i class="bi bi-check-circle animate__animated animate__pulse" style="font-size: 40px;"></i>
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000" style="width:70px;height:70px"></lord-icon>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

                        </div>
                        <div class="col-8 d-flex justify-content-center align-items-center">
                            <p id="texto_succes_cliente" class="text-uppercase"></p>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn-close d-flex justify-content-end" id="btn_cerrar_modal_cliente_agregar"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Modal Editar Propietario -->
<div class="modal fade" id="editarPropietarioModal"  tabindex="-1" data-bs-backdrop="static" tabindex="-1" aria-labelledby="EditarpropietarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="EditarpropietarioLabel">Editar Propietario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form>
                    <div class="container">
                        <!-- Campos de entrada -->
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="nombreEditInput"><b>Nombre</b></label>
                                <input type="text" class="form-control mt-2" id="nombreEditInput" placeholder="Ej: Pedro Aguilera" required>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="rutEditInput"><b>Rut</b></label>
                            <input type="text" class="form-control mt-2" id="rutEditInput" placeholder="12.345.678-9" 
                            title="Formato válido: 12.345.678-9" minlength="9" maxlength="12">
                        </div>

                            <div class="form-group mb-3 col-6">
                                <label for="telefonoEditInput"><b>Telefono</b></label>
                                <input type="text" class="form-control mt-2" id="telefonoEditInput" placeholder="Ej: 912345678" required>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group mb-3 ">
                                <label for="correoEditInput"><b>Correo</b></label>
                                <input type="text" class="form-control mt-2" id="correoEditInput" placeholder="Ej: pedro@gmail.com" required>
                            </div>

                        <div class="row">
                            <div class="form-group mb-3 col-6">
                                <label for="direccionEditInput"><b>Dirección</b></label>
                                <input type="text" class="form-control mt-2" id="direccionEditInput" placeholder="Dirección" required>
                            </div>
                            <div class="form-group mb-3 col-6">
                                <label for="ciudadEditInput"><b>Ciudad</b></label>
                                <input type="text" class="form-control mt-2" id="ciudadEditInput" placeholder="Ciudad" required>
                            </div>
                        </div>

                        </div>
                        <hr>
                    </div>
                        <!-- Botones de cambios -->
                        <div class="modal-footer">
                        <button type="button" id="btn_editar" class="btn btn-primary">Guardar</button>
                        <button type="button" id="btn_cerrar_agregar" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


 <!-- Modal editar -->
 <div class="modal fade" id="MostrarCuenta" tabindex="-1" aria-labelledby="MostrarcuentaLabel"
 aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
 <div class="modal-dialog modal-xl" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <h5 class="modal-title" id="" style="text-align: center;">Cuentas Bancarias</h5>
         <form action="" method="POST" enctype="multipart/form-data">
             <div class="modal-body">
                 <div class="row">
                 <h5 class=" text-cent">
                </div>
                <div class="form-group">
                    <div id="listaCuentasEdit"></div>
                </div>
                <ul class="text-uppercase mt-4" id="lista-agregados-edit">
                    <!-- <li></li> -->
                </ul>
                <div class="col-12">
                    <button class="btn btn-warning w-100 mt-3 mb-3 text-uppercase text-white" 
                    data-id="" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target=".multi-collapse3" 
                    aria-expanded="false" 
                    aria-controls="multiCollapseExample3">
                    <b>Agregar Nueva cuenta</b>
                </button>

                </div>
                <div class="collapse multi-collapse3" id="multiCollapseExample3">
                    <div class="row">
                   
                            <input type="hidden" id="idPropietarioInput"> <!-- Campo oculto para el ID del propietario -->
                     
                        <div class="col-md-4">
                                <label for="nombreBancoInput2"><b>Nombre del Banco</b></label>
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control m-1" id="nombreBancoInput2" placeholder="Nombre del Banco" required>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <label for="numeroCuenteInput2"><b>Numero de Cuenta</b></label>
                            <div class="form-group mb-2">
                                <input type="text" class="form-control m-1" id="numeroCuenteInput2" placeholder="numero de cuenta" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="TipoCuentaInput2"><b>Tipo de Cuenta</b></label>
                            <div class="form-group mb-2 d-flex">
                                <select name="notificaion" id="TipoCuentaInput2" class="form-select m-1">
                                    <option selected disabled value="option">Seleccione un tipo de Cuenta</option>
                                    <option value="Ahorro">Ahorro</option>
                                    <option value="Corriente">Corriente</option>
                                    <option value="Vista">vista</option>
                                    <option value="Chequera electronica">Chequera Electronica</option>
                                </select>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-info m-1 text-uppercase text-white" data-id="" id="agregar-datosbanca2"><b>Agregar Nueva Cuenta</b></button>
                </div>
            </div>
         </form>
        </div>
    </div>
</div>
</div>

<!-- Modal Editar Cuenta-->
<div class="modal fade" id="editarCuentaModal"  tabindex="-1" data-bs-backdrop="static" tabindex="-1" aria-labelledby="EditarCuetaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="EditarCuentaLabel">Editar Cuentas Bancarias</h5>
            </div>

            <div class="modal-body ">
                <form>
                    <div class="container">
                        <!-- Campos de entrada -->
                        <div class="col-md-12 mb-3">
                            <!-- <label for="NombreTestigoDetalles" class="form-label">Testigo</label> -->
                            <div id="listaCuentasDetalle"></div>
                            <!-- <input type="text" class="form-control" id="NombreTestigoDetalles" disabled> -->
                        </div>

                         {{-- <div class="collapse multi-collapsee" id="multiCollapseEdit"> --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="nombreBancoInputEdit"><b>Nombre del Banco</b></label>
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control m-1" id="nombreBancoInputEdit" placeholder="Nombre del Banco" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="numeroCuenteInputEdit"><b>Numero de Cuenta</b></label>
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control m-1" id="numeroCuenteInputEdit" placeholder="numero de cuenta" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="TipoCuentaInputEdit"><b>Tipo de Cuenta</b></label>
                                    <div class="form-group mb-2 d-flex">
                                        <select name="notificaion" id="TipoCuentaInputEdit" class="form-select m-1">
                                            <option selected disabled value="option">Seleccione un tipo de Cuenta</option>
                                            <option value="Ahorro">Ahorro</option>
                                            <option value="Corriente">Corriente</option>
                                            <option value="Vista">Vista</option>
                                            <option value="Chequera electronica">Chequera electronica</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                            <ul class="text-uppercase mt-4" id="lista_Datos_Cuentas">
                                    <!-- <li></li> -->
                             </ul>


                        <!-- Botones de cambios -->
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> -->
                            <button type="button" class="btn btn-warning text-uppercase" id="btn_editar_cuenta"><b>Guardar cambios</b></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--MODAL DE CONFIRMAR PARA ELIMINAR -->
<div class="modal fade" id="modalEliminarPropietario" tabindex="-1" aria-labelledby="modalEliminarPropietarioLabel" aria-hidden="true"
data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog modal-lg">
    <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
        <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
            <h5 class="m-4 text-uppercase text-center">¿Seguro que quieres eliminar el propietario?</h5>
                <input type="hidden" id="eliminar-idPropietario">
            <div class="modalfooter d-flex justify-content-center">
                <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="confirmDelete" class="btn btn-secondary m-2">Eliminar</button>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="modalerroreliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalerroreliminarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-header alert alert-warning" role="alert" style="border: none;">
                <i class="bi bi-x-lg"></i>
                <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                    <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json"trigger="loop" delay="2000"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            </div>
                            <div class="col-8 d-flex justify-content-center align-items-center">
                                <p id="texto_error" class="text-uppercase">
                                </p>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn-close d-flex justify-content-end"
                                    data-bs-dismiss="modal" aria-label="Close" id="btn_cerrar_error_eliminar"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      {{-- <!-- Modal ERROR CONTRA PARTE-->
      <div class="modal fade" id="testigoAlertModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="testigoAlertModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none; max-width: 700px;">
                <div class="modal-header alert alert-danger" style="border: none;">
                    <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <!-- <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop" delay="2000" style="width:70px;height:70px"></lord-icon> -->
                            </div>
                            <div class="col-8 d-flex justify-content-center align-items-center">
                                    <p id="texto_success_archivos" class="text-uppercase">Por favor, Ingrese sus Datos Bancarios</p>
                                </div>
                                <div class="col-2">
                                <button type="button" class="btn-close d-flex justify-content-end" data-bs-dismiss="modal" aria-label="Close" id="btn_cerrar_modal"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
     <!-- modal delete cuenta -->
     <div class="modal fade" id="deleteCuentaModal" tabindex="-1" aria-labelledby="deleteCuentaModalLabel"
     aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
     <div class="modal-dialog modal-lg">
         <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
             <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                 <h5 class="m-4 text-uppercase text-center">¿Seguro que quieres eliminar la cuenta?</h2>
                 <div class="modalfooter d-flex justify-content-center">
                     <button type="button" class="btn btn-danger m-2"
                         data-bs-dismiss="modal">Cancelar</button>
                     <button type="button" id="btn_eliminar_cuenta"
                         class="btn btn-secondary m-2">Eliminar</button>
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
                                </p>
                            </div>
                                <div class="col-2">
                                    <button type="button" class="btn-close d-flex justify-content-end"  id="btn-close"></button>
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
        console.log('Listo para trabajar')

             ////////////////////////////BUSCADOR/////////////////////////
             $("#buscador_cnn").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tablaUa tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // para que salga con . y - el rut normal 
            document.getElementById('rutInput').addEventListener('input', function (event) {
                let input = event.target.value.replace(/[^\dkK]/g, ''); // Elimina cualquier cosa que no sea dígito o 'k'/'K'

                if (input.length > 1) {
                    let body = input.slice(0, -1); // Cuerpo del RUT
                    let formattedBody = body.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Añade puntos cada 3 dígitos
                    let dv = input.slice(-1).toUpperCase(); // Dígito verificador, en mayúscula
                    event.target.value = `${formattedBody}-${dv}`; // Formatea el valor
                } else {
                    event.target.value = input; // Si tiene menos de 2 caracteres, no formatea
                }
            });

            // para que salga con . y - el rut editar

            document.getElementById('rutEditInput').addEventListener('input', function (event) {
                let input = event.target.value.replace(/[^\dkK]/g, ''); // Elimina cualquier cosa que no sea dígito o 'k'/'K'

                if (input.length > 1) {
                    let body = input.slice(0, -1); // Cuerpo del RUT
                    let formattedBody = body.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Añade puntos cada 3 dígitos
                    let dv = input.slice(-1).toUpperCase(); // Dígito verificador, en mayúscula
                    event.target.value = `${formattedBody}-${dv}`; // Formatea el valor
                } else {
                    event.target.value = input; // Si tiene menos de 2 caracteres, no formatea
                }
            });

/// LISTA DE LA TABLAS DE CUENTAS AGREGADAS/////////////


        var DatosAgregados = [];
        var listaDatos = $("#lista-Datos");
            $("#agregar-datosbanca").on('click', function(event){
                event.preventDefault();

                var nombre_banco = $("#nombreBancoInput").val();
                var numero_cuenta = $("#numeroCuenteInput").val();
                var tipo_cuenta = $("#TipoCuentaInput").val();
                // var moneda = $("#monedaInput").val();
                // var codigo_swift= $("#swiftInput").val();
                // var pais_banco = $("#paisInput").val();

                if(nombre_banco) {
                    var datosbancarios= {
                        id: DatosAgregados.length + 1, // Generar un ID temporal o único
                        nombre_banco: nombre_banco,
                        numero_cuenta: numero_cuenta,
                        tipo_cuenta:tipo_cuenta,
                        // moneda: moneda,
                        // codigo_swift: codigo_swift,
                        // pais_banco:pais_banco,
                    };


                    // Agregar el dato al arreglo
                    DatosAgregados.push(datosbancarios);


                    // Limpiar el campo de entrada
                    $("#nombreBancoInput").val('');
                    $("#numeroCuenteInput").val('');
                    $("#TipoCuentaInput").val('option');
                    // $("#monedaInput").val('option');
                    // $("#swiftInput").val('');
                    // $("#paisInput").val('');


                    // Crear la tabla si no existe
                    if ($("#tablaDatos").length === 0) {
                        var table = $("<table>").attr("id", "tablaDatos").addClass("table table-striped table-bordered");
                        var thead = $("<thead>");
                        var headerRow = $("<tr>");
                        headerRow.append($("<th>").text("Nombre Banco"));
                        headerRow.append($("<th>").text("N° CUENTA"));
                        headerRow.append($("<th>").text("TIPO DE CUENTA"));
                        thead.append(headerRow);
                        table.append(thead);
                        listaDatos.append(table); // 'listaDatos' es el contenedor donde se desea agregar la tabla
                    }

                    // Agregar una nueva fila a la tabla con los datos del testigo
                    var tbody = $("#tablaDatos tbody");
                    if (tbody.length === 0) {
                        tbody = $("<tbody>");
                        $("#tablaDatos").append(tbody);
                    }

                    var row = $("<tr>");
                    row.append($("<td>").html(datosbancarios.nombre_banco + "&nbsp;&nbsp;&nbsp;")); // Espacio añadido
                    row.append($("<td>").html(datosbancarios.numero_cuenta + "&nbsp;&nbsp;&nbsp;"));    // Espacio añadido
                    row.append($("<td>").html(datosbancarios.tipo_cuenta + "&nbsp;&nbsp;&nbsp;")); // Espacio añadido
                    tbody.append(row);


                    console.log("Datos  agregado correctamente:", datosbancarios);
                    console.log("Datos agregados:", DatosAgregados);

                } else {
                    $("#testigoAlertModal").modal('show');

                    // alert("Por favor, ingrese el nombre del testigo.");
                }
            });





                // Limpiar los mensajes de error anteriores
                $(".error-message").remove();
        $("#buscador_cn").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".cartas .card").each(function() {
                var cardText = $(this).find('.card-title').text().toLowerCase();
                if (cardText.includes(value)) {
                    $(this).prependTo($(this).parent()); // Mover al principio del contenedor padre
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $("#btn_agregar").on('click', function(event) {
            event.preventDefault();

            // Limpiar errores previos
            $(".error-message").remove();

            // Obtener valores
            var nombre = $("#nombreInput").val().trim();
            var rut = $("#rutInput").val().trim();
            var telefono = $("#telefonoInput").val().trim();
            var correo = $("#correoInput").val().trim();
            var direccion = $("#direccionInput").val().trim();
            var ciudad = $("#ciudadInput").val().trim();

            let valid = true;

            // Función para mostrar error debajo del campo
            function showError(selector, mensaje) {
                $(selector).after(`<small class="text-danger error-message">${mensaje}</small>`);
                valid = false;
            }

            // Validar campos
            if (nombre === "") showError("#nombreInput", "Campo obligatorio");
            if (rut === "") showError("#rutInput", "Campo obligatorio");
            if (telefono === "") showError("#telefonoInput", "Campo obligatorio");
            else if (telefono.length !== 9) showError("#telefonoInput", "Debe tener 9 dígitos");
            if (correo === "") showError("#correoInput", "Campo obligatorio");
            if (direccion === "") showError("#direccionInput", "Campo obligatorio");
            if (ciudad === "") showError("#ciudadInput", "Campo obligatorio");

            if (!valid) return; // Detener si hay errores

            // Crear FormData
            var formData = new FormData();
            formData.append('nombre', nombre);
            formData.append('rut', rut);
            formData.append('telefono', telefono);
            formData.append('correo', correo);
            formData.append('direccion', direccion);
            formData.append('ciudad', ciudad);

            if (typeof DatosAgregados !== 'undefined') {
                formData.append('DatosAgregados', JSON.stringify(DatosAgregados));
            }

            // Enviar AJAX
            $.ajax({
                url: '{{url("/propietariosadd")}}',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(respuesta) {
                    console.log("respuesta", respuesta);
                    $("#agregarpropietario").modal('hide');
                    $("#modalAlertaAgregar").modal('show');
                    $("#texto_success").html("El Propietario se ha creado exitosamente.");
                },
                error: function(jqXHR, textStatus, errorThrown){
                    if (jqXHR.status === 409 && jqXHR.responseJSON?.message) {
                        alert(jqXHR.responseJSON.message); // O muestra en un modal debajo del campo
                    } else {
                        console.log("Error:", errorThrown);
                    }
                }
            });

            // Cierre del modal
            $("#btn-close").click(function() {
                $("#modalAlertaAgregar").modal('hide');
                location.reload();
            });
        });


        $('.editar-propietario-btn').on('click', function() {
            event.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: 'GET',
                url: '/propietarios/' + id,
                dataType: 'json',
                success: function(data) {
                    $('#editarPropietarioModal').modal('show');
                    $("#btn_editar").data("id",id);
                    $('#nombreEditInput').val(data.nombre);
                    $('#rutEditInput').val(data.rut);
                    $('#telefonoEditInput').val(data.telefono);
                    $('#correoEditInput').val(data.correo);
                    $('#direccionEditInput').val(data.direccion);
                    $('#ciudadEditInput').val(data.ciudad);

                    // $('#nombreBancoInputEdit').val(data.nombre_banco);
                    // $('#numeroCuenteInputEdit').val(data.numero_cuenta);
                    // $('#TipoCuentaInputEdit').val(data.tipo_cuenta);

                     }
               });
            });
            $('#btn_editar').on('click', function() {
            event.preventDefault();
            var Id = $(this).data('id');
            var nombre = $('#nombreEditInput').val();
            var rut = $('#rutEditInput').val();
            var telefono = $('#telefonoEditInput').val();
            var correo = $('#correoEditInput').val();
            var direccion = $('#direccionEditInput').val();
            var ciudad = $('#ciudadEditInput').val();
            var argumentos = {
            nombre: nombre,
            rut: rut,
            telefono: telefono,
            correo: correo,
            direccion: direccion,
            ciudad: ciudad

            };

            console.log("Datos Obtenidos", argumentos);

            $.ajax({
            url: '/propietarios/'+ Id,
            type: 'POST',
            datatype: 'json',
            data: argumentos
            })

            .done(function(respuesta) {
                console.log("respuesta", respuesta);
                $("#editarPropietarioModal").modal('hide');
                $("#modalAlertaAgregar").modal('show');
                $("#texto_success").html("El Propietario se ha Editado exitosamente.");
            })

            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log("Error", errorThrown);
                $("#myModal").modal('hide');
                $("#modalerrorcliente").modal('show');
            });

            $("#btn-close").click(function() {
                $("#modalAlertaAgregar").modal('hide');
                location.reload();
            });
        });



        $('.borrar-propietario-btn').click(function() {
              var id = $(this).data('id');
                 console.log(id);
               $('#eliminar-idPropietario').val(id);
                 $('#modalEliminarPropietario').modal('show');
            });

        // Función de confirmar eliminación de propietario
        $('#confirmDelete').click(function(event) {
            event.preventDefault();
            var id = $('#eliminar-idPropietario').val();
            console.log(id);
            $.ajax({
                url: '/propietarioestado/' + id,
                type: 'PATCH', // o 'PUT'
                data: {
                    _token: '{{csrf_token()}}',
                    estado: 0 // nuevo estado del propietario
                },
                success: function(data) {
                    console.log(data);
                    $('#modalEliminarPropietario').modal('hide');
                    $("#modalAlertaAgregar").modal('show');
                    $('#texto_success').text('El Propietario se ha Ocultado con éxito');
                },
                fail: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error", errorThrown);
                    $("#modalEliminarPropietario").modal('hide');
                    $("#modalerroreliminar").modal('show');
                    $('#texto_error').text('Error al Ocultar el propietario');
                }

          }); // fin delete

          $("#btn-close").click(function() {
                $("#modalAlertaAgregar").modal('hide');
                location.reload();
            });


          $("#btn_cerrar_error_eliminar").click(function() {
                $("#modalerroreliminar").modal('hide');
                location.reload();
         });


         });

         ////MOSTRAR MODAL DE TABLA DE CUENTAS ///

            $(".mostra-cuentas-btn").on('click', function(event) {
            event.preventDefault();

            var id_Cuenta = $(this).data('id');
            // Asignar idPropietario al campo oculto
            $('#idPropietarioInput').val(id_Cuenta);
            $.ajax({
                url: '/Mostrar/cuenta/' + id_Cuenta,
                type: 'GET',
                dataType: 'json'
            })
            .done(function(respuesta) {
                console.log('Respuesta del servidor:');
                console.log(respuesta);

                var listaCuentasEdit = $("#lista-agregados-edit");
                // listaCuentasEdit.empty();

                if (respuesta.datosbancarios) {
                    console.log('Datos bancarios:');
                  console.log(respuesta.datosbancarios);
                  var tableContainer = $("<div>").addClass("table-responsive");
                    var table = $("<table>").addClass("table table-striped table-bordered");
                    var header = $("<thead>")
                        .append($("<tr>")
                            .append($("<th>").text("Nombre De Banco"))
                            .append($("<th>").text("Numero Cuenta"))
                            .append($("<th>").text("Tipo Cuenta"))
                            .append($("<th>").text("Acciones"))
                        );
                    table.append(header);

                    var body = $("<tbody>");
                    respuesta.datosbancarios.forEach(function(datosbancarios) {
                        var row = $("<tr>")
                            .append($("<td>").text(datosbancarios.nombre_banco))
                            .append($("<td>").text(datosbancarios.numero_cuenta))
                            .append($("<td>").text(datosbancarios.tipo_cuenta))
                            .append(
                                $("<td>").html(
                                    '<a href="#" class="btn btn-warning btn-sm editar-cuenta" data-id="' + datosbancarios.id + '"><i class="fas fa-edit"></i></a> ' +
                                    '<a href="#" class="btn btn-danger btn-sm eliminar-cuenta" data-id="' + datosbancarios.id + '"><i class="fas fa-trash-alt"></i></a>')
                            );
                        body.append(row);
                    });


                    table.append(body);
                    listaCuentasEdit.html(table);
                    tableContainer.append(table); // Envolver la tabla en el contenedor responsive
                    listaCuentasEdit.html(tableContainer);

                }
                  // Mostrar el modal después de actualizar la tabla
                     $('#MostrarCuenta').modal('show');

            });
        });

        //  GUARDAR NUEVA CUENTA BANCARIA

         //Boton agregar  cuenta
         $("#agregar-datosbanca2").on('click', function(event) {
                event.preventDefault();
                var idPropietario = $('#idPropietarioInput').val();
                var nombreBanco = $('#nombreBancoInput2').val();
                var numeroCuenta = $('#numeroCuenteInput2').val();
                var tipoCuenta = $('#TipoCuentaInput2').val();


                argumentos = {
                    id_propietario: idPropietario,
                    nombre_banco: nombreBanco,
                    numero_cuenta: numeroCuenta,
                    tipo_cuenta: tipoCuenta

                };

                console.log(argumentos);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{ url("/Nueva/cuenta2aad") }}',
                    type: 'POST',
                    data: argumentos,
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log("respuesta", respuesta);

                        $("#modalAlertaAgregar").modal('show');
                        $("#texto_success").html("La cuenta se ha Creado exitosamente");
                        $("#MostrarCuenta").modal('hide');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $('#modalerror').modal('show');

                    }

                });  $("#btn-close").click(function() {
                $("#modalAlertaAgregar").modal('hide');
                location.reload(); // Recarga la página



                });
            }); //fin agregar arriendo




   // Manejar edición de cuentas
        $(document).on('click', '.editar-cuenta', function() {
            var id_cuenta = $(this).data('id');
            console.log('id cuenta:', id_cuenta);

            // Realizar la solicitud AJAX para obtener los datos de la cuenta
            $.ajax({
                url: '/cuentas/editar_cuenta/' + id_cuenta,
                type: 'GET',
                dataType: 'json',
            })
            .done(function(respuesta) {
                console.log(respuesta);

                // Verificar si hay un error en la respuesta
                if (respuesta.error) {
                    alert(respuesta.error); // Muestra un mensaje de error si no se encuentra la cuenta
                    return;
                }

                // Mostrar el modal de edición
                $("#editarCuentaModal").modal('show');
                $("#MostrarCuenta").modal('hide');
                $("#btn_editar_cuenta").data('id', id_cuenta);

                // Asignar los valores a los campos de edición
                $("#nombreBancoInputEdit").val(respuesta.cuenta_bancaria.nombre_banco);
                $("#numeroCuenteInputEdit").val(respuesta.cuenta_bancaria.numero_cuenta);
                $("#TipoCuentaInputEdit").val(respuesta.cuenta_bancaria.tipo_cuenta);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log("Error:", errorThrown);
                alert("Ocurrió un error al intentar obtener los datos de la cuenta.");
            });
        });
        // Guardar la edicion de la cuenta bancaria
            $("#btn_editar_cuenta").on('click', function() {
                var id = $(this).data('id');
                console.log('id cuentaee:', id);

                // Obtener los valores del formulario
                var nombre_banco = $("#nombreBancoInputEdit").val();
                var numero_cuenta = $("#numeroCuenteInputEdit").val();
                var tipo_cuenta = $("#TipoCuentaInputEdit").val();


                var argumentos = {
                    id: id,
                    nombre_banco: nombre_banco,
                    numero_cuenta: numero_cuenta,
                    tipo_cuenta: tipo_cuenta,

                }
                console.log(argumentos)
                console.log('ID de cuenta enviado:', id);
                // Realizar la solicitud AJAX para guardar los cambios
                $.ajax({
                    url: '/cuentaEditar/guardar/'+ id,
                    type: 'POST',
                    dataType: 'json',
                    data: argumentos,
                })
                .done(function(respuesta) {
                    console.log(respuesta);
                        // Si la respuesta es exitosa, puedes cerrar el modal y actualizar la lista de testigos
                        $("#modalAlertaAgregar").modal('show');
                        $("#texto_success").html("La cuenta se ha Editado exitosamente");
                        $("#editarCuentaModal").modal('hide');


                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    console.log("Error", errorThrown);
                    // Aquí podrías mostrar un modal o mensaje de error
                });
                 // Manejar el clic en la "X"
                    $("#btn-close").on("click", function() {
                        $("#modalAlertaAgregar").modal('hide'); // Oculta el mensaje
                        location.reload(); // Recarga la página
                    });
            });

            $(document).on('click', '.eliminar-cuenta', function() {
                event.preventDefault();

                var id_cuenta = $(this).data('id');
                console.log("Id Cuenta: " + id_cuenta);

                $("#editarCliente").modal('hide');

                // Mostrar modal de confirmación
                $("#deleteCuentaModal").modal('show');

                // Manejar confirmación
                $("#btn_eliminar_cuenta").on('click', function() {
                //     // Realizar la solicitud AJAX solo si se confirma la eliminación
                    $.ajax({
                        url: '/cuenta/eliminar/' + id_cuenta,
                        type: 'DELETE',
                        dataType: 'json',
                    })
                    .done(function(respuesta) {
                        $("#deleteCuentaModal").modal('hide');

                        $("#modalAlertaAgregar").modal('show');
                        $("#texto_success").html("La cuenta Bancaria se Eliminado exitosamente");
                        $("#MostrarCuenta").modal('hide');

                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log("Error", errorThrown);
                        // $("#modalAlertaErrorEliminar").modal('show');

                    });  $("#btn-close").click(function() {
                    $("#modalAlertaAgregar").modal('hide');


                    });
                });
            });
        });

</script>
@endsection

