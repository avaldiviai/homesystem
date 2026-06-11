@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="background-color:rgb(255, 255, 255)">
        <div class="row">
            @include('layouts.sidebar')
            <div class="col">
                <div class="container-fluid">
                    <div class="row overflow-auto p-4" style="max-height: 100vh;">                    
                        <div class="col-lg-12"
                            style="text-align: start; margin-top: 40px; margin-bottom: 20px; margin-start: 30px; color: white;">
                            <h1 class="text-uppercase text-black text-center">Detalles de Verano</h1>
                        </div>
     
                        <div class="col-lg-12">
                            <div class="row shadow mb-4" style="background-color:#E67E22; border-radius: .9rem; margin-bottom: 20px;">
                                <div class="col-lg-12 mb-3">
                                    <div class="p-3 mb-1">
                                        <div class="col-lg-12 text-center mb-1">
                                            <div class="col-lg-4 bg-black px-3 py-2 rounded-pill shadow" style="max-width: 400px;">
                                                <h4 class="m-0 text-white">Detalle de la Propiedad</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                {{-- FILA 1: Dirección | Condominio | Ciudad --}}
                                <div class="col-md-5 mb-3">
                                    <label class="text-white fw-bold">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" value="{{ $propiedadVe->direccion }}" placeholder="Ej: Av. del Mar 123">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="text-white fw-bold">Condominio</label>
                                    <input type="text" class="form-control" id="condominio" name="condominio" value="{{ $propiedadVe->condominio }}" placeholder="Ingrese el condominio">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="text-white fw-bold">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad" value="{{ $propiedadVe->ciudad }}" placeholder="Ej: La Serena">
                                </div>
                        
                                {{-- FILA 2: Edificio (Torre) | N° Depto | N° Estac | Piso | Sector --}}
                                <div class="col-md-3 mb-3">
                                    <label class="text-white fw-bold">Edificio / Torre</label>
                                    <input type="text" class="form-control" id="torre" name="torre" value="{{ $propiedadVe->torre }}" placeholder="Ej: Torre A">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="text-white fw-bold">N° Depto</label>
                                    <input type="text" class="form-control" id="num_apartamento" name="num_apartamento" value="{{ $propiedadVe->num_apartamento }}" placeholder="Ej: 802">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="text-white fw-bold">N° Estacionamiento</label>
                                    <input type="number" class="form-control" id="num_estaciona" name="num_estaciona" value="{{ $detalle->num_estaciona }}" placeholder="Ej: 15">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="text-white fw-bold">Piso</label>
                                    <input type="text" class="form-control" id="piso" name="piso" value="{{ $propiedadVe->piso }}" placeholder="Ej: 8">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="text-white fw-bold">Sector</label>
                                    <input type="text" class="form-control" id="sector" name="sector" value="{{ $propiedadVe->sector }}" placeholder="Ej: Las Brisas">
                                </div>
                        
                                {{-- FILA 3: Precios Enero | Precios Febrero | Propietarios --}}
                                {{-- ENERO --}}
                                <div class="col-md-4 mb-3">
                                    <div class="p-3 rounded" style="background-color: rgba(0,0,0,0.15);">
                                        <label class="text-white fw-bold d-block text-center mb-2">
                                            <i class="bi bi-sun-fill me-1"></i> ENERO
                                        </label>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="text-white small">Precio Mínimo</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control" id="precio_min_enero" name="precio_min_enero"
                                                        value="{{ $propiedadVe->precio_min_enero }}" placeholder="380.000"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label class="text-white small">Precio Máximo</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control" id="precio_max_enero" name="precio_max_enero"
                                                        value="{{ $propiedadVe->precio_max_enero }}" placeholder="500.000"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                {{-- FEBRERO --}}
                                <div class="col-md-4 mb-3">
                                    <div class="p-3 rounded" style="background-color: rgba(0,0,0,0.15);">
                                        <label class="text-white fw-bold d-block text-center mb-2">
                                            <i class="bi bi-sun me-1"></i> FEBRERO
                                        </label>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="text-white small">Precio Mínimo</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control" id="precio_min_febrero" name="precio_min_febrero"
                                                        value="{{ $propiedadVe->precio_min_febrero }}" placeholder="350.000"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label class="text-white small">Precio Máximo</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control" id="precio_max_febrero" name="precio_max_febrero"
                                                        value="{{ $propiedadVe->precio_max_febrero }}" placeholder="450.000"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                {{-- PROPIETARIOS --}}
                                <div class="col-md-4 mb-3">
                                    <div class="p-3 rounded h-100" style="background-color: rgba(0,0,0,0.15);">
                                        <label class="text-white fw-bold d-block text-center mb-2">
                                            <i class="bi bi-person-fill me-1"></i> Propietarios
                                        </label>
                                        <div class="d-flex gap-2 mb-2">
                                            <select id="propietarioInput" class="form-select form-select-sm">
                                                <option disabled selected value="0">Seleccione propietario</option>
                                                @foreach ($new_Propietarios as $propietario)
                                                    <option value="{{ $propietario->id }}">{{ $propietario->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-sm btn-light" id="agregar-propietario" style="white-space:nowrap;">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                        </div>
                                        {{-- Lista propietarios actuales --}}
                                        <div style="max-height: 100px; overflow-y: auto;">
                                            @foreach ($propietarios as $prop)
                                                <div class="d-flex align-items-center justify-content-between mb-1 px-2 py-1 rounded" style="background:rgba(255,255,255,0.15);">
                                                    <span class="text-white small"><i class="fa-solid fa-user-tie me-1"></i>{{ $prop->propietario->nombre }}</span>
                                                    <a href="javascript:void(0)" class="delete-propietario text-white" data-id="{{ $prop->id }}">
                                                        <i class="fas fa-trash-alt fa-sm"></i>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <ul class="text-uppercase mt-2 p-0 m-0" id="lista-agregados" style="list-style:none;"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="row shadow mb-4"
                                style="background-color:#E67E22; border-radius: .9rem; margin-bottom: 20px;">
                                <div class="col-lg-12 mb-3">
                                    <div class="p-3 mb-3">
                                        <div class="col-lg-12 text-center mb-4">
                                            <div class="col-lg-3 sub bg-black px-3 py-2 rounded-pill shadow">
                                                <h4 class="m-0 text-white">
                                                    Detalles Agregados
                                                </h4>
                                            </div>
                                        </div>
                                        <!-- Primera Fila -->
                                        <div class="row mb-3">
                                            {{-- Ubicación --}}
                                            <div class="col-md-3 mb-3">
                                                <label class="text-white fw-bold">Ubicación</label>
                                                <div class="d-flex gap-3 mt-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="ubicacion" id="playa" value="playa" {{ $propiedadVe->ubicacion == 'playa' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="playa">Playa</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="ubicacion" id="centro" value="centro" {{ $propiedadVe->ubicacion == 'centro' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="centro">Centro</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="ubicacion" id="ambos" value="ambos" {{ $propiedadVe->ubicacion == 'ambos' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="ambos">Ambos</label>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- N° Personas --}}
                                            <div class="form-group col-lg-2">
                                                <label for="cantidad_personas" class="text-white">N° Personas</label>
                                                <input type="number" class="form-control" id="cantidad_personas"
                                                    name="cantidad_personas" value="{{ $propiedadVe->personas }}"
                                                    placeholder="Ej: 6">
                                            </div>

                                            {{-- Dormitorios --}}
                                            <div class="form-group col-lg-2">
                                                <label for="dormitorios" class="text-white">Dormitorios</label>
                                                <input type="text" class="form-control" id="dormitorios"
                                                    name="dormitorios" value="{{ $propiedadVe->dormitorios }}"
                                                    placeholder="Ej: 2">
                                            </div>

                                            {{-- Baños --}}
                                            <div class="form-group col-lg-2">
                                                <label for="baños" class="text-white">Baños</label>
                                                <input type="text" class="form-control" id="baños"
                                                    name="baños" value="{{ old('baños', $propiedadVe->baños) }}"
                                                    placeholder="Ej: 1">
                                            </div>

                                            {{-- Tipo de Piso --}}
                                            <div class="form-group col-lg-3">
                                                <label for="tipo_piso" class="text-white">Tipo de Piso</label>
                                                <select class="form-select" id="tipo_piso" name="tipo_piso">
                                                    <option selected disabled>Seleccione un tipo de piso</option>
                                                    <option value="cerámico"    {{ $propiedadVe->Tpiso_dormitorios == 'Cerámico'    ? 'selected' : '' }}>Cerámico</option>
                                                    <option value="flotante"    {{ $propiedadVe->Tpiso_dormitorios == 'Flotante'    ? 'selected' : '' }}>Flotante</option>
                                                    <option value="alfombrado"  {{ $propiedadVe->Tpiso_dormitorios == 'Alfombrado'  ? 'selected' : '' }}>Alfombrado</option>
                                                    <option value="porcelanato" {{ $propiedadVe->Tpiso_dormitorios == 'porcelanato' ? 'selected' : '' }}>Porcelanato</option>
                                                </select>
                                            </div>

                                            {{-- Tipo de Cocina --}}
                                            <div class="form-group col-lg-3 mt-3">
                                                <label for="tipo_cocina" class="text-white">Tipo de Cocina</label>
                                                <select class="form-select" id="tipo_cocina" name="tipo_cocina">
                                                    <option selected disabled>Seleccione un tipo de cocina</option>
                                                    <option value="Americana"        {{ $propiedadVe->tipo_cocina == 'Americana'        ? 'selected' : '' }}>Americana</option>
                                                    <option value="semi Americana" {{ $propiedadVe->tipo_cocina == 'semi Americana' ? 'selected' : '' }}>Semi Americana</option>
                                                    <option value="independiente"  {{ $propiedadVe->tipo_cocina == 'independiente'  ? 'selected' : '' }}>Independiente</option>
                                                </select>
                                            </div>

                                            {{-- Equipado para --}}
                                            <div class="form-group col-lg-3 mt-3">
                                                <label for="equipado" class="text-white">Equipado para</label>
                                                <input type="text" class="form-control" id="equipado"
                                                    name="equipado" value="{{ $propiedadVe->equipado }}"
                                                    placeholder="Ej: Familia">
                                            </div>

                                            {{-- Valor Adicional (Mascota) --}}
                                            <div class="form-group col-lg-3 mt-3">
                                                <label for="valor_adicional" class="text-white">Valor Adicional (Mascota)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control" id="valor_adicional"
                                                        name="valor_adicional" value="{{ $propiedadVe->valor_adicional }}"
                                                        placeholder="Ej: 20.000">
                                                </div>
                                            </div>

                                            {{-- Inventario --}}
                                            <div class="col-lg-6 text-white mt-3">
                                                <div class="form-group">
                                                    <label for="inventariodoc">Inventario</label>
                                                    <div class="d-flex gap-2 mb-2">
                                                        <input type="file" id="inventariodoc" class="form-control">
                                                        <button type="button" class="btn btn-success" id="btn_guardar_inventario"
                                                            data-id="{{ $propiedadVe->id }}">
                                                            <i class="fas fa-save"></i> Guardar
                                                        </button>
                                                    </div>
                                                    <div id="preview_inventario">
                                                        @if(isset($detalle->inventario) && $detalle->inventario != '')
                                                            <div class="card shadow-sm border rounded p-2 d-flex justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="fas fa-file-alt text-primary me-2"></i>
                                                                    <span class="text-truncate" style="max-width: 140px;">{{ basename($detalle->inventario) }}</span>
                                                                </div>
                                                                <a href="{{ asset($detalle->inventario) }}" target="_blank"
                                                                    class="btn btn-sm btn-outline-primary rounded-pill">Ver</a>
                                                            </div>
                                                        @else
                                                            <div class="text-muted fst-italic small mt-2">
                                                                <i class="fas fa-exclamation-circle me-1 text-warning"></i>
                                                                <span class="text-white">Sin documento</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Acta de Entrega --}}
                                            <div class="col-lg-6 text-white mt-3">
                                                <div class="form-group">
                                                    <label for="actadoc">Acta de Entrega</label>
                                                    <div class="d-flex gap-2 mb-2">
                                                        <input type="file" id="actadoc" class="form-control">
                                                        <button type="button" class="btn btn-success" id="btn_guardar_acta"
                                                            data-id="{{ $propiedadVe->id }}">
                                                            <i class="fas fa-save"></i> Guardar
                                                        </button>
                                                    </div>
                                                    <div id="preview_acta">
                                                        @if(isset($detalle->acta_entrega) && $detalle->acta_entrega != '')
                                                            <div class="card shadow-sm border rounded p-2 d-flex justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="fas fa-file-alt text-primary me-2"></i>
                                                                    <span class="text-truncate" style="max-width: 140px;">{{ basename($detalle->acta_entrega) }}</span>
                                                                </div>
                                                                <a href="{{ asset($detalle->acta_entrega) }}" target="_blank"
                                                                    class="btn btn-sm btn-outline-primary rounded-pill">Ver</a>
                                                            </div>
                                                        @else
                                                            <div class="text-muted fst-italic small mt-2">
                                                                <i class="fas fa-exclamation-circle me-1 text-warning"></i>
                                                                <span class="text-white">Sin documento</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row shadow mb-4"
                                style="background-color:#E67E22; border-radius: .9rem; margin-bottom: 20px;">
                                <div class="col-lg-12 mb-3">
                                    <div class="p-3 mb-3">
                                        <div class="col-lg-12 text-center mb-4">
                                            <div class="col-lg-4 sub bg-black px-3 py-2 rounded-pill shadow">
                                                <h4 class="m-0 text-white">
                                                    Servicios y Caracteristicas
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <!-- Piscina -->
                                            <div class="form-group col-lg-3 text-center">
                                                <label class="text-white w-100 mb-2">Piscina</label>
                                                <div class="d-flex justify-content-center gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="piscina" id="piscina_si" value="Si"
                                                            {{ $detalle && $detalle->piscina == 'Si' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="piscina_si">Sí</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="piscina" id="piscina_no" value="No"
                                                            {{ $detalle && $detalle->piscina == 'No' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="piscina_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Conserjería -->
                                            <div class="form-group col-lg-3 text-center">
                                                <label class="text-white w-100 mb-2">Conserjería</label>
                                                <div class="d-flex justify-content-center gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="Consergeria" id="consergeria_si" value="Si"
                                                            {{ $detalle && $detalle->Consergeria == 'Si' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="consergeria_si">Sí</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="Consergeria" id="consergeria_no" value="No"
                                                            {{ $detalle && $detalle->Consergeria == 'No' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="consergeria_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Ascensor -->
                                            <div class="form-group col-lg-3 text-center">
                                                <label class="text-white w-100 mb-2">Ascensor</label>
                                                <div class="d-flex justify-content-center gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="ascensor" id="ascensor_si" value="Si"
                                                            {{ $detalle && $detalle->ascensor == 'Si' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="ascensor_si">Sí</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="ascensor" id="ascensor_no" value="No"
                                                            {{ $detalle && $detalle->ascensor == 'No' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="ascensor_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Juegos Infantiles -->
                                            <div class="form-group col-lg-3 text-center mb-3">
                                                <label class="text-white w-100 mb-2">Juegos Infantiles</label>
                                                <div class="d-flex justify-content-center gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="juegos_infantiles" id="juegos_si" value="Si"
                                                            {{ $detalle && $detalle->juegos_infantiles == 'Si' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="juegos_si">Sí</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="juegos_infantiles" id="juegos_no" value="No"
                                                            {{ $detalle && $detalle->juegos_infantiles == 'No' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="juegos_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Servicio de Lavandería -->
                                            <div class="form-group col-lg-3 text-center mt-3">
                                                <label class="text-white w-100 mb-2">Servicio de Lavandería</label>
                                                <div class="d-flex justify-content-center gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="servi_lavanderia" id="lavanderia_si" value="Si"
                                                            {{ $detalle && $detalle->servi_lavanderia == 'Si' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="lavanderia_si">Sí</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="servi_lavanderia" id="lavanderia_no" value="No"
                                                            {{ $detalle && $detalle->servi_lavanderia == 'No' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="lavanderia_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Quinchos -->
                                            <div class="form-group col-lg-3 text-center mt-3">
                                                <label class="text-white w-100 mb-2">Quinchos</label>
                                                <div class="d-flex justify-content-center gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="quinchos" id="quinchos_si" value="Si"
                                                            {{ $detalle && $detalle->quinchos == 'Si' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="quinchos_si">Sí</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="quinchos" id="quinchos_no" value="No"
                                                            {{ $detalle && $detalle->quinchos == 'No' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="quinchos_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-3 text-center">
                                                <label class="text-white w-100 mb-2">Gimnasio</label>
                                                <div class="d-flex justify-content-center gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gimnasio" id="gimnasio_si" value="Si"
                                                        {{ $detalle && $detalle->gimnasion == 'Si' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="gimnasio_si">Sí</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gimnasio" id="gimnasio_no" value="No"
                                                        {{ $detalle && $detalle->gimnasion == 'No' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="gimnasio_no">No</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Sala Multiuso -->
                                            <div class="form-group col-lg-3 text-center mt-3">
                                                <label class="text-white w-100 mb-2">Sala Multiuso</label>
                                                <div class="d-flex justify-content-center gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sala_multiuso" id="sala_si" value="Si"
                                                            {{ $detalle && $detalle->sala_multiuso == 'Si' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="sala_si">Sí</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sala_multiuso" id="sala_no" value="No"
                                                            {{ $detalle && $detalle->sala_multiuso == 'No' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="sala_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Terraza -->
                                            <div class="form-group col-lg-3 text-center mt-3">
                                                <label class="text-white w-100 mb-2">Terraza</label>
                                                <div class="d-flex justify-content-center gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="terraza" id="terraza_si" value="Si"
                                                            {{ $detalle && $detalle->terraza == 'Si' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="terraza_si">Sí</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="terraza" id="terraza_no" value="No"
                                                            {{ $detalle && $detalle->terraza == 'No' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-white" for="terraza_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-8 mx-auto text-center text-white mt-3">
                                                <label for="servicios" class="text-white d-block mb-2">Servicios</label>
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="form-check flex-fill text-center">
                                                        <input class="form-check-input" type="checkbox" id="wifi"
                                                            name="servicios[]" value="wifi"
                                                            {{ $detalle && $detalle->wifi ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="wifi">Wifi</label>
                                                    </div>
                                                    <div class="form-check flex-fill text-center">
                                                        <input class="form-check-input" type="checkbox" id="cable"
                                                            name="servicios[]" value="cable"
                                                            {{ $detalle && $detalle->cable ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="cable">Cable</label>
                                                    </div>
                                                    <div class="form-check flex-fill text-center">
                                                        <input class="form-check-input" type="checkbox" id="lavadora"
                                                            name="servicios[]" value="lavadora"
                                                            {{ $detalle && $detalle->lavadora ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="lavadora">Lavadora</label>
                                                    </div>
                                                    <div class="form-check flex-fill text-center">
                                                        <input class="form-check-input" type="checkbox" id="sabanas"
                                                            name="servicios[]" value="sabanas"
                                                            {{ $detalle && $detalle->sabanas ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="sabanas">Sábanas</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6"> <!-- gx-4 agrega separación horizontal -->
                            <div class="row imagenes-detalle mb-4 col-lg-12"
                                style="background-color: #E67E22; border-radius: .9rem; margin-top: 30px;">
                                <div class="col-lg-12 mt-2 d-flex justify-content-start">
                                    <div class="col-lg-8 bg-black rounded-pill">
                                        <h4 class="text-center d-block text-white">Imágenes de la Propiedad</h4>
                                    </div>
                                </div>
                                <div class="p-2">
                                    @if ($imagenes && $imagenes->count())
                                        <div class="row" style="max-height: 400px; overflow-y: auto;">
                                            @foreach ($imagenes as $imagen)
                                                <div class="col-md-4 col-sm-6 mb-3">
                                                    <div class="card shadow-sm border-0 rounded">
                                                        <img src="{{ asset($imagen->link) }}" class="card-img-top"
                                                            style="height: 200px; object-fit: cover;"
                                                            alt="Imagen del detalle">
                                                        <div class="card-body text-center">
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <a href="javascript:void(0)"
                                                                    data-id="{{ $imagen->id }}" id="btn-checkPro"
                                                                    class="d-flex align-items-center text-success">
                                                                    <i class="fas fa-check fa-lg"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-sm"
                                                                    style="border: none; background: none; padding: 0;"
                                                                    onclick="confirmarEliminacion({{ $imagen->id }})"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalEliminarImagen">
                                                                    <i class="fas fa-trash"
                                                                        style="color: #e92b12; font-size: 1.5rem;"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center text-white p-3">
                                            <strong >No hay imágenes disponibles para este detalle.
                                            </strong>
                                        </div>
                                    @endif
                                </div>

                                <!-- Sección para agregar imágenes -->
                                <div class="container-fluid ">
                                    <div class="row">
                                        <div class="col-lg-5 bg-black rounded-pill shadow text-white text-center">
                                            <h4>Agregar Imagen</h4>
                                        </div>  
                                        <div class="p-1 mb-2">
                                            <div class="upload-container" id="dropZone">
                                                <input type="file" id="fileInput" 
                                                    accept="image/png, image/jpeg, image/gif" multiple hidden>
                                                <div class="text-center" style="height: auto; border: 2px dashed #000; border-radius: 10px; background-color:rgba(249, 249, 249, 0); cursor: pointer;">
                                                    <!-- <i class="bi bi-upload fs-1 text-white"></i> -->
                                                    <p class="mb-1 text-white">Haga clic para cargar o arrastre y suelte
                                                    </p>
                                                    <p class="small text-muted">PNG, JPG, GIF hasta 10MB cada uno</p>
                                                </div>
                                                <div id="preview" class="d-flex flex-wrap justify-content-center mt-3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row col-lg-12" style="background-color: #E67E22; border-radius: .9rem; margin-top: 30px;">
                                <div class="col-lg-12 p-2">
                                    <div class="col-lg-6 bg-black rounded-pill shadow text-white text-center">
                                        <h4 class="">Video de la propiedad</h4>
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="col-lg-12 p-2">
                                        <div class="d-flex flex-wrap align-items-center justify-content-center">
                                            @if ($detalle && $detalle->videos && $detalle->videos->count())
                                                <div class="row" style="max-height: 400px; overflow-y: auto;">
                                                    @foreach ($detalle->videos as $video)
                                                        @php
                                                            $videoPath = str_replace('/storage/', '', $video->link);
                                                            $streamUrl = url('/stream-video/' . $videoPath);
                                                        @endphp
                                                        <div class="col-md-6 mb-3">
                                                            <div class="card shadow-sm border-0 rounded">
                                                                <video 
                                                                    controls 
                                                                    style="width:100%; height:200px; object-fit:cover; cursor:pointer;"
                                                                    onclick="abrirVideoCompleto('{{ $streamUrl }}')"
                                                                >
                                                                    <source src="{{ $streamUrl }}" type="video/mp4">
                                                                    Tu navegador no soporta el video.
                                                                </video>
                                                                <div class="card-body text-center p-2">
                                                                    <button 
                                                                        class="btn btn-sm btn-primary me-1"
                                                                        onclick="abrirVideoCompleto('{{ $streamUrl }}')"
                                                                    >
                                                                        <i class="fas fa-expand"></i> Pantalla completa
                                                                    </button>
                                                                    <button 
                                                                        class="btn btn-sm btn-danger"
                                                                        onclick="confirmarEliminarVideo({{ $video->id }})"
                                                                    >
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center text-white p-3">
                                                    <strong>Sin video agregado a estos detalles</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col-lg-5 mb-2 bg-black rounded-pill shadow text-white text-center">
                                            <h4>Agregar Video</h4>
                                        </div>                                    
                                        <div class="form-group mb-3 ">
                                            <div id="video-drop-area" class="form-control p-4 d-flex align-items-center justify-content-center text-center"
                                                style="height: auto; border: 2px dashed #000; border-radius: 10px; background-color:rgba(249, 249, 249, 0); cursor: pointer;"ondragover="event.preventDefault()" ondrop="handleVideoDrop(event)">
                                                Arrastra aquí tu video o haz clic para seleccionarlo
                                            </div>
                                            <input class="form-control" type="file" name="videos" id="videos" accept="video/*" style="display: none;">
                                        </div>
                                        <div id="videoProgressContainer" style="display:none; margin-top:10px;">
                                        <div style="background:#e9ecef; border-radius:5px; overflow:hidden;">
                                                <div id="videoProgressBar" style="
                                                    width:0%; height:25px; background:#007bff;
                                                    text-align:center; color:white; line-height:25px;
                                                    transition: width 0.3s ease;
                                                ">0%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ////////////////////////Calendar////////////////////////////////// -->
                         <div class="col-lg-12">
                            <div class="row shadow mb-4 "
                                style="background-color:#E67E22; border-radius: .9rem; margin-bottom: 20px;">
                                <!-- Título -->
                                <div class="col-lg-8 d-flex align-items-center">
                                    <div class="col-lg-7 sub bg-black px-2 py-2 rounded-pill shadow"
                                        style="margin-top: 20px; margin-right: 20px;">
                                        <h4 class="m-0 text-white"
                                            style=" text-align: center; width: 100%; padding: 0 3px;">
                                            Calendario de Arriendo de Verano
                                        </h4>
                                    </div>
                                </div>

                                <!-- Botones editar y eliminar -->
                                <div class="col-lg-4 d-flex justify-content-end align-items-center"
                                    style="margin-top: 20px;">
                                    <button class="btn btn-success btn me-2" data-bs-toggle="modal"
                                        data-bs-target="#addEventModal">
                                        Agregar Nuevo Arriendo de verano
                                    </button>
                                    <button class="btn btn-primary btn" id="verFechasBtn">Ver Fechas</button>
                                </div>
                                <!-- Modal para agregar eventos -->
                                <div class="modal fade" id="addEventModal" tabindex="-1" data-bs-backdrop="static"
                                    aria-labelledby="addEventModalLabel" aria-disabled="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content"
                                            style="background-color:rgb(250, 184, 97); border-radius: .9rem; margin-bottom: 20px;">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addEventModalLabel">Agregar Nuevo Arriendo
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Cerrar"></button>
                                            </div>
                                            <!-- AREA PARA AGREGAR LO DEL SELEC -->
                                            <div class="modal-body">
                                                <form id="eventForm">
                                                    @csrf
                                                    <div class="mb-3 row">
                                                        <div class="col-md-6">
                                                            <label for="id_verano" class="form-label">Propiedad de Verano</label>
                                                            <select class="form-select" id="id_verano" name="id_verano" required disabled>
                                                                @foreach ($proverano as $verano)
                                                                    <option value="{{ $verano->id }}"
                                                                        {{ $verano->id == $propiedadVe->id ? 'selected' : '' }}>
                                                                        {{ $verano->torre }} - #{{ $verano->num_apartamento }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            {{-- Campo hidden para que el valor se envíe igual aunque el select esté disabled --}}
                                                            <input type="hidden" name="id_verano" value="{{ $propiedadVe->id }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="color" class="form-label">Seleccione un
                                                                Color</label>
                                                            <input type="color" id="colorPicker" name="colorPicker"
                                                                class="form-control form-control-color" value="#ff0000" />
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold">Fecha Inicio</label>
                                                            <input type="date" class="form-control" id="inicio_fecha" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold">Hora Inicio</label>
                                                            <input type="time" class="form-control" id="inicio_hora" value="14:00" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold">Fecha Fin</label>
                                                            <input type="date" class="form-control" id="fin_fecha" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold">Hora Fin</label>
                                                            <input type="time" class="form-control" id="fin_hora" value="12:00" required>
                                                        </div>
                                                        {{-- Campos hidden que se llenan automáticamente --}}
                                                        <input type="hidden" id="inicio">
                                                        <input type="hidden" id="fin">
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <!-- Campo Cantidad de Días -->
                                                        <div class="col-md-6">
                                                            <label for="dia" class="form-label">Cantidad de
                                                                Días</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">
                                                                    <i class="fa-solid fa-calendar-days"></i>
                                                                </span>
                                                                <input type="number" class="form-control" id="dia"
                                                                    name="dia" min="1" max="1000000" required
                                                                    readonly>
                                                            </div>
                                                        </div>

                                                    <div class="col-md-6">
                                                        <label for="diario" class="form-label">Monto diario</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                            <input type="number" class="form-control" id="diario" name="diario" required min="0" step="0.01">
                                                        </div>
                                                    </div>



                                                    </div>
                                                        <div class="mb-3 row">
                                                            <!-- Campo Monto del Arriendo -->
                                                            <div class="col-md-4">
                                                                <label for="total" class="form-label">Monto del Arriendo</label>
                                                                <div class="input-group">
                                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                <input type="text" class="form-control" id="total" name="total" required>
                                                                </div>
                                                            </div>

                                                            <!-- Campo ¿Tiene Aseo? en el medio -->
                                                            <div class="col-md-4 text-center">
                                                                <label for="aseoCheck">¿Tiene Aseo?</label>
                                                                <div class="mt-2">
                                                                    <input type="radio" name="aseoCheck" id="aseoSi" value="si">
                                                                    <label for="aseoSi">Sí</label>
                                                                    <input type="radio" name="aseoCheck" id="aseoNo" value="no">
                                                                    <label for="aseoNo">No</label>
                                                                </div>
                                                                <div id="camposAseo" class="form-group mt-2" style="display: none;">
                                                                    <label class="mt-2">Detalles del Aseo</label>
                                                                    <div class="input-group">
                                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                    <input type="text" class="form-control" id="montoInput" placeholder="Ingrese monto" name="montoInput">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Campo 10% del Monto -->
                                                            <div class="col-md-4">
                                                                <label for="porcentaje" class="form-label">10% del Monto</label>
                                                                <div class="input-group">
                                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                <input type="text" class="form-control" id="porcentaje" name="porcentaje" readonly>
                                                                </div>
                                                        </div>

                                                        <!-- fin del chek   -->
                                                    </div>


                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="guardarevent" form="eventForm" class="btn btn-success">Guardar
                                                    Arriendo</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Calendario (FullCalendar)  mas grande-->
                                <div class="col-lg-12 p-4">
                                    <div id="calendar" class="text-uppercase p-3 bg-white mt-2"></div>
                                </div>
                            </div>
                        </div>

                            <!-- Calendario (FullCalendar) -->
                        <div class="col-lg-12 mb-3 mt-3 d-flex justify-content-end">
                            <a href="/verano" class="btn btn-danger mt-4 m-1">Volver</a>
                            <button type="submit" class="btn btn-primary mt-4 m-1" id="btn_editar"
                            data-id="{{ $propiedadVe->id }}">Guardar Edicion</button>
                        </div>
                    </div>
                </div>
            </div>
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


                        <!-- <div id="calendar" class="w-75 text-uppercase"
                            style="margin: 20px auto; background-color: white; padding: 5px; border-radius: 8px;">
                        </div> -->
                        <!-- Modal para mostrar eventos en una fecha específica -->
                        <div class="modal fade" id="eventDateModal" tabindex="-1" aria-labelledby="eventDateModalLabel"
                            aria-disabled="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content"
                                    style="background-color:rgb(250, 184, 97); border-radius: .9rem; margin-bottom: 20px;">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="eventDateModalLabel">Fechas de Arriendo de Verano
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">Dirección</th>
                                                        <th scope="col">Fecha de Inicio</th>
                                                        <th scope="col">Fecha de Fin</th>
                                                        <th scope="col">Cantidad de Días</th>
                                                        <th scope="col">Precio por Día</th>
                                                        <th scope="col">Aseo</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col">Comisión 10%</th>
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="eventsOnDate">
                                                    <!-- Aquí se mostrarán los eventos de la fecha seleccionada -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                            <!-- Modal de Editar FECHAS aca -->


                            <div class="modal fade" id="modalEditarEventoedit" tabindex="-1" role="dialog"
                                aria-labelledby="modalEditarEventoeditLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content"
                                        style="background-color:rgb(250, 184, 97); border-radius: .9rem; margin-bottom: 20px;">
                                        <div class="modal-header border-0">
                                            <h4 class="modal-title fw-bold" id="modalEditarEventoeditLabel">Editar Evento</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form id="formEditarEvento">
                                                {{-- Fila 1: Propiedad --}}
                                                <div class="mb-3 row">
                                                    <div class="col-md-6">
                                                        <label for="id_veranoedit" class="form-label fw-bold">Propiedad de Verano</label>
                                                        <select class="form-select" id="id_veranoedit" name="id_veranoedit" required disabled>
                                                            @foreach ($proverano as $verano)
                                                                <option value="{{ $verano->id }}"
                                                                    {{ $verano->id == $propiedadVe->id ? 'selected' : '' }}>
                                                                    {{ $verano->torre }} - #{{ $verano->num_apartamento }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="id_veranoedit" value="{{ $propiedadVe->id }}">
                                                    </div>
                                                    <!---<div class="col-md-6">
                                                        <label for="colorPickeredit" class="form-label fw-bold">Seleccione un Color</label>
                                                        <input type="color" id="colorPickeredit" name="colorPickeredit"
                                                            class="form-control form-control-color" value="#ff0000" />
                                                    </div> --->
                                                </div>

                                                {{-- Fila 2: Fechas y Horas --}}
                                                <div class="mb-3 row">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">Fecha Inicio</label>
                                                        <input type="date" class="form-control" id="inicioedit_fecha" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">Hora Inicio</label>
                                                        <input type="time" class="form-control" id="inicioedit_hora" value="14:00">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">Fecha Fin</label>
                                                        <input type="date" class="form-control" id="finedit_fecha" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">Hora Fin</label>
                                                        <input type="time" class="form-control" id="finedit_hora" value="12:00">
                                                    </div>
                                                    <input type="hidden" id="inicioedit">
                                                    <input type="hidden" id="finedit">
                                                </div>

                                                {{-- Fila 3: Días y Monto diario --}}
                                                <div class="mb-3 row">
                                                    <div class="col-md-6">
                                                        <label for="diaedit" class="form-label fw-bold">Cantidad de Días</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="fa-solid fa-calendar-days"></i>
                                                            </span>
                                                            <input type="number" class="form-control" id="diaedit"
                                                                name="diaedit" min="1" max="1000000" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="diarioedit" class="form-label fw-bold">Monto diario</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                            <input type="number" class="form-control" id="diarioedit"
                                                                name="diarioedit" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Fila 4: Total, Aseo, 10% --}}
                                                <div class="mb-3 row">
                                                    <div class="col-md-4">
                                                        <label for="totaledit" class="form-label fw-bold">Monto del Arriendo</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                            <input type="number" class="form-control" id="totaledit" name="totaledit" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 text-center">
                                                        <label class="form-label fw-bold d-block">¿Tiene Aseo?</label>
                                                        <div class="mt-1">
                                                            <input type="radio" name="aseoCheckedit" id="aseoSiedit" value="si">
                                                            <label for="aseoSiedit">Sí</label>
                                                            &nbsp;
                                                            <input type="radio" name="aseoCheckedit" id="aseoNoedit" value="no">
                                                            <label for="aseoNoedit">No</label>
                                                        </div>
                                                        <div id="camposAseoedit" class="mt-2" style="display: none;">
                                                            <label class="form-label fw-bold">Detalles del Aseo</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                <input type="text" class="form-control" id="montoInputedit"
                                                                    placeholder="Ingrese monto" name="montoInputedit">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="porcentajeedit" class="form-label fw-bold">10% del Monto</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                            <input type="text" class="form-control" id="porcentajeedit"
                                                                name="porcentajeedit" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-danger px-4" id="cerrar_modaledit"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button class="btn btn-success px-4" id="guardarCambiosedit">
                                                <i class="fas fa-save me-1"></i> Guardar Cambios
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                            <!-- Modal de exito editado -->
                            <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content"
                                        style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
                                        <div class="modal-header alert alert-success" role="alert"
                                            style="border: none;">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json"
                                                            trigger="loop" delay="2000"
                                                            style="width:70px;height:70px"></lord-icon>
                                                    </div>
                                                    <div class="col-8 d-flex justify-content-center align-items-center">
                                                        <p id="texto_success" class="text-uppercase">Datos Guardados
                                                            con éxito</p>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button"
                                                            class="btn-close d-flex justify-content-end"
                                                            id="close_success" data-bs-dismiss="modal"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- Modal de Elinnar  -->

                            <div class="modal fade" id="modaleli" tabindex="-1" aria-labelledby="modaleliLabel"
                                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                <div class="modal-dialog modal-lg">
                                    <div class="alert alert-danger d-flex align-items-center" id="alerta"
                                        role="alert">
                                        <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                                            <h4 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar
                                                Usuario?</h2>
                                                <div class="modalfooter d-flex justify-content-center">
                                                    <button type="button" class="btn btn-danger m-2"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" id="confirmDelete"
                                                        class="btn btn-secondary m-2">Eliminar</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal de Error -->
                            <div class="modal fade" id="modalError" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="modalErrorLabel" aria-disabled="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header alert alert-danger" role="alert"
                                            style="border: none;">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json"
                                                            trigger="loop" delay="2000"
                                                            style="width:70px;height:70px"></lord-icon>
                                                    </div>
                                                    <div class="col-8 d-flex justify-content-center align-items-center">
                                                        <p id="texto_error" class="text-uppercase text-center m-0">Ha
                                                            Ocurrido un
                                                            Error al Guardar, Complete todos los datos.</p>
                                                    </div>
                                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="cerrar_error"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fin de Elinnar -->



                    <!-- modal eliminar fecha  -->
                    <div class="modal fade" id="modaleliminarevento" tabindex="-1"
                        aria-labelledby="modaleliminareventoLabel" aria-hidden="true" data-bs-backdrop="static"
                        data-bs-keyboard="false">
                        <div class="modal-dialog modal-lg">
                            <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
                                <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                                    <h4 class="m-4 text-uppercase text-center">¿Seguro/a que quieres eliminar la fecha?
                                        </h2>
                                        <div class="modalfooter d-flex justify-content-center">
                                            <button type="button" class="btn btn-danger m-2"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="button" id="confirmarfechadelete"
                                                class="btn btn-secondary m-2">Eliminar</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                
                
                <div class="modal fade" id="successModaleditar" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="successModaleditarLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
                            <div class="modal-header alert alert-success" role="alert" style="border: none;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-2">
                                            <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop"
                                                delay="2000" style="width:70px;height:70px"></lord-icon>
                                        </div>
                                        <div class="col-8 d-flex justify-content-center align-items-center">
                                            <p id="texto_success" class="text-uppercase">Datos Actualizados con exito
                                            </p>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn-close d-flex justify-content-end"
                                                id="close_success_editar"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>


                <div class="modal fade" id="modaleli" tabindex="-1" aria-labelledby="modaleliLabel"
                    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-lg">
                        <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
                            <div class="modal-content" style="background-color: rgb(0,0,0,0.0); border:none">
                                <h4 class="m-4 text-uppercase text-center" id="text-info">
                                    </h2>
                                    <div class="modalfooter d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger m-2"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" id="confirmDelete"
                                            class="btn btn-secondary m-2">Eliminar</button>
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
                                <h4 class="m-4 text-uppercase text-center" id="text-info-portada"></h4>
                                <div class="modalfooter d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger m-2"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" id="confirmCambio"
                                        class="btn btn-warning m-2">Cambiar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal error  Al estar un arriendo en el mismo dia   -->


                <div class="modal fade" id="modalerror" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="modalerrorLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered"> <!-- Centrado en la pantalla -->
                        <div class="modal-content "style="background-color: rgb(0,0,0,0.0); border:none">
                            <div class="modal-header alert alert-danger" role="alert" style="border: none;">
                                <div class="container">
                                    <div class="row">
                                        <!-- Icono de error animado -->
                                        <div class="col-2 d-flex justify-content-center align-items-center">
                                            <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json" trigger="loop"
                                                delay="2000" style="width:70px;height:70px">
                                            </lord-icon>
                                        </div>
                                        <!-- Mensaje de error centrado -->
                                        <div class="col-8 d-flex justify-content-center align-items-center">
                                            <p id="texto_error" class="text-uppercase text-center m-0">No es posible
                                                guardar, la fecha ya está reservada.</p>
                                        </div>
                                        <!-- Botón de cierre -->
                                        <div class="col-2 d-flex justify-content-end align-items-center">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="cerrar_error"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--MODAL DE CONFIRMAR PARA ELIMINAR -->
                <div class="modal fade" id="modalEliminarImagen" tabindex="-1"
                    aria-labelledby="modalEliminarImagenLabel" aria-hidden="true" data-bs-backdrop="static"
                    data-bs-keyboard="false">
                    <div class="modal-dialog modal-lg">
                        <div class="alert alert-danger d-flex align-items-center" id="alerta" role="alert">
                            <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.0); border: none;">
                                <h4 class="m-4 text-uppercase text-center">¿Seguro que quieres eliminar esta imagen?
                                </h4>
                                <input type="hidden" id="eliminar-idImagen">
                                <div class="modalfooter d-flex justify-content-center">
                                    <button type="button" class="btn btn-secondary m-2"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" id="confirmDeleteImage"
                                        class="btn btn-danger m-2">Eliminar</button>
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
    

    <div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: rgba(0, 0, 0, 0.0); border: none; width: 700px;">
                <div class="modal-header alert alert-success" role="alert" style="border: none;">
                    <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="loop"
                                    delay="2000" style="width:70px;height:70px"></lord-icon>
                            </div>
                            <div class="col-8 d-flex justify-content-center align-items-center">
                                <p id="texto_success" class="text-uppercase">Datos Actualizados con exito
                                </p>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn-close d-flex justify-content-end"
                                    id="close_guardar_arriendo_verano"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal video pantalla completa -->
    <div class="modal fade" id="modalVideoCompleto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-black border-0">
                <div class="modal-header border-0 p-2">
                    <button type="button" class="btn-close btn-close-white ms-auto" 
                        data-bs-dismiss="modal" onclick="detenerVideo()">
                    </button>
                </div>
                <div class="modal-body p-0">
                    <video id="videoCompleto" controls autoplay 
                        style="width:100%; max-height:80vh;">
                        <source id="videoCompletoSrc" src="" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>




@section('javascript')
    @parent
    <script>
        function confirmarEliminacion(id) {
            const inputId = document.getElementById('eliminar-idImagen');
            if (inputId) {
                inputId.value = id; // Asigna el ID de la imagen al campo oculto
            }
        }

        document.getElementById('confirmDeleteImage').addEventListener('click', function() {
            const id = document.getElementById('eliminar-idImagen').value;
            if (id) {
                // Lógica para enviar la solicitud de eliminación al servidor
                fetch(`/imagenes/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                }).then(response => {
                    $("#modalEliminarImagen").modal('hide');
                    $("#successModal").modal('show');
                    $('#texto_success').text('Imagen eliminada correctamente');
                    // Recargar la página cuando se cierre el modal de éxito
                    $('#successModal').off('hidden.bs.modal').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                }).catch(error => console.error('Error:', error));
            }
        });


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
                    url: '/obtenerVe/propietarioVeNombre',
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
        $(".delete-propietario").on('click', function() {
            event.preventDefault();
            var idPropietario = $(this).data('id');
            console.log('id propietario: ' + idPropietario);

            // Mostrar el modal de confirmación
            $("#modaleli").modal('show');
            $('#text-info').text('¿Seguro/a que quieres Eliminar este Propietario?');

            // Manejar el clic en el botón de confirmación
            $("#confirmDelete").on('click', function() { // Usar off() para evitar múltiples bindings

                // Realizar la solicitud AJAX
                $.ajax({
                        url: '/propietarioVeranoDelete/' +
                            idPropietario, // Usar template literals para construir la URL
                        type: 'DELETE',
                        datatype: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                    })
                    .done(function(respuesta) {
                        // console.log("respuesta", respuesta);
                        $("#modaleli").modal('hide');
                        $("#successModal").modal('show');
                        $('#texto_success').text('Propietario eliminado correctamente');
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                        $("#modalerror").modal('show');
                    });
            });
        });

        $("#cerrar_modaledit").click(function() {
            bootstrap.Modal.getInstance(document.getElementById('modalEditarEventoedit')).hide();
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
                        url: '/portadaVera/cambiar_imgen/' + idImg,
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
                        $("#modaleli").modal('hide');
                        // Mostrar mensaje de error
                        $("#modalAlertaErrorEliminar").modal('show');
                    });
            });
        });

        // document.getElementById('interruptor').addEventListener('change', function() {
        //     // Obtenemos todos los inputs y textareas en la página
        //     const inputs = document.querySelectorAll('input, textarea, select');
        //     const estado = document.getElementById('estado');

        //     // Recorremos todos los inputs y textareas y ajustamos su estado de acuerdo al interruptor
        //     inputs.forEach(input => {
        //         if (input.type !== 'checkbox' || input.id !== 'interruptor') {
        //             input.disabled = !this.checked;
        //         }
        //     });

        //     // Actualizamos el texto del estado
        //     estado.textContent = this.checked ? 'Habilitado para editar' : 'Deshabilitado para editar';
        // });

        /////////////////Evento para subir imagenes ///////////////////////   
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        // Mostrar previsualización de las imágenes seleccionadas
        function showPreview(files) {
            preview.innerHTML = ''; // Limpiar la previsualización
            Array.from(files).forEach(file => {
                if (file.size <= 10 * 1024 * 1024) { // Limitar a 10MB
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-thumbnail', 'me-2', 'mb-2');
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert('El archivo ' + file.name + ' supera los 10MB.');
                }
            });
        }

        // Manejar el evento de clic para abrir el selector de archivos
        dropZone.addEventListener('click', () => fileInput.click());

        // Manejar el evento de cambio del input
        fileInput.addEventListener('change', (e) => showPreview(e.target.files));

        // Manejar el evento de arrastrar y soltar
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-primary');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-primary');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-primary');
            const files = e.dataTransfer.files;
            showPreview(files);
        });


        ///////////////////////////Editar//////////////////////////////////
        $(document).ready(function() {
            // Función para habilitar/deshabilitar la edición
            // $('#interruptor').on('change', function() {
            //     var isEditing = $(this).prop('checked');
            //     $('input, textarea, select').not('#interruptor').prop('disabled', !isEditing);
            //     $('#estado').text(isEditing ? 'Habilitado para editar' : 'Deshabilitado para editar');
            //     // $('#btn_editar').toggle(isEditing);
            // });

            // Manejo del envío del formulario
            $('#btn_editar').on('click', function(event) {
                event.preventDefault();
                var Id = $(this).data('id');

                var propietarios = [];
                $("#propietarios").each(function() {
                    propietarios.push($(this).val()); // Agregar el valor al array
                });
                console.log('los propietarios', propietarios)

                var direccion = $('#direccion').val();
                var ciudad = $('#ciudad').val();
                var sector = $('#sector').val();
                var condominio = $('#condominio').val();
                var torre = $('#torre').val();
                var num_apartamento = $('#num_apartamento').val();
                var piso = $('#piso').val();
                var personas = $('#cantidad_personas').val();
                var ubicacion = $('input[name="ubicacion"]:checked').val();
                var dormitorios = $('#dormitorios').val();
                var Tpiso_dormitorios = $('#tipo_piso').val();
                var baños = $('#baños').val();
                var tipo_cocina = $('#tipo_cocina').val();
                var precio_min_enero = $('#precio_min_enero').val();
                var precio_max_enero = $('#precio_max_enero').val();
                var precio_min_febrero = $('#precio_min_febrero').val();
                var precio_max_febrero = $('#precio_max_febrero').val();
                
                var equipado = $('#equipado').val();
                var mascotas = $('#mascotas').val();
                var valor_adicional = $('#valor_adicional').val();

                var num_estaciona = $('#num_estaciona').val();

                var piscina = $('input[name="piscina"]:checked').val();
                var consergeria = $('input[name="Consergeria"]:checked').val();
                var ascensor = $('input[name="ascensor"]:checked').val();
                var gimnasio = $('input[name="gimnasio"]:checked').val();
                var juegos_infantiles = $('input[name="juegos_infantiles"]:checked').val();
                var servi_lavanderia = $('input[name="servi_lavanderia"]:checked').val();
                var quinchos = $('input[name="quinchos"]:checked').val();
                var sala_multiuso = $('input[name="sala_multiuso"]:checked').val();
                var terraza = $('input[name="terraza"]:checked').val();


                var servicios = {};
                $("input[name='servicios[]']").each(function() {
                    var servicio = $(this).val(); // Nombre del servicio (ejemplo: 'wifi')
                    servicios[servicio] = $(this).is(':checked') ? 1 :
                        0; // 1 si está marcado, 0 si no
                });
                // Crear el objeto FormData
                var formData = new FormData();

                // Agregar los datos al FormData
                formData.append('Id', Id);
                formData.append('direccion', $('#direccion').val());
                formData.append('ciudad', $('#ciudad').val());
                formData.append('sector', $('#sector').val());
                formData.append('condominio', $('#condominio').val());
                formData.append('torre', $('#torre').val());
                formData.append('num_apartamento', $('#num_apartamento').val());
                formData.append('piso', $('#piso').val());
                formData.append('personas', $('#cantidad_personas').val());
                formData.append('ubicacion', $('input[name="ubicacion"]:checked').val());
                formData.append('dormitorios', $('#dormitorios').val());
                formData.append('Tpiso_dormitorios', $('#tipo_piso').val());
                formData.append('baños', $('#baños').val());
                formData.append('tipo_cocina', $('#tipo_cocina').val());
                formData.append('precio_min_enero', $('#precio_min_enero').val());
                formData.append('precio_max_enero', $('#precio_max_enero').val());
                formData.append('precio_min_febrero', $('#precio_min_febrero').val());
                formData.append('precio_max_febrero', $('#precio_max_febrero').val());

                formData.append('equipado', $('#equipado').val());
                formData.append('mascotas', $('#mascotas').val());
                formData.append('valor_adicional', $('#valor_adicional').val());
                formData.append('estacionamientos', $('#estacionamientos').val());
                formData.append('num_estaciona', $('#num_estaciona').val());

                formData.append('piscina', piscina);
                formData.append('Consergeria', consergeria);
                formData.append('ascensor', ascensor);
                formData.append('gimnasio', gimnasio);
                formData.append('juegos_infantiles', juegos_infantiles);
                formData.append('servi_lavanderia', servi_lavanderia);
                formData.append('quinchos', quinchos);
                formData.append('sala_multiuso', sala_multiuso);
                formData.append('terraza', terraza);

                // Convertir iconosAgregados a cadena JSON y agregarlo al FormData
                formData.append('PropietariosAgregados', JSON.stringify(PropietariosAgregados));


                var files = $('#fileInput')[0].files;
                // Iterar sobre los archivos seleccionados y agregarlos al objeto FormData
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    formData.append('imagenes[]', file);
                }

                var videos = $('#videos')[0].files[0];
                // console.log(videos);
                formData.append('videos', videos);

                var inventario = $("#inventariodoc")[0].files[0];
                formData.append('inventario', inventario);

                var acta = $("#actadoc")[0].files[0];
                formData.append('acta', acta);

                // Agregar los servicios al FormData
                Object.keys(servicios).forEach(function(key) {
                    formData.append(key, servicios[
                        key]); // Clave: nombre del servicio, Valor: 1 o 0
                });
                console.log("Datos enviados:", formData);

                // Enviar los datos al servidor
                $.ajax({
                    url: '/property/update/' + Id,
                    type: 'POST',
                    processData: false, // Importante para FormData
                    contentType: false, // Importante para FormData
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $("#loadingOverlay").fadeIn(); // Mostrar overlay al iniciar
                    },
                    success: function(response) {
                        // Ocultar overlay y luego mostrar modal de éxito
                        $("#loadingOverlay").fadeOut(function() {
                            $('#successModaleditar').modal('show');
                        });
                    },
                    error: function(xhr, status, error) {
                        $("#loadingOverlay").fadeOut();
                        var msg = xhr.responseJSON ? xhr.responseJSON.error + ' — línea ' + xhr.responseJSON.line : error;
                        alert('Error: ' + msg);
                    }
                });

            });
        });
        $("#close_success_editar").click(function() {
            $("#successModaleditar").modal('hide');
            location.reload();
        });

        const videoDropArea = document.getElementById('video-drop-area');
        const videoInput = document.getElementById('videos');

        // Hacer clic en el área abre el selector de archivos
        // Reemplaza el evento click del videoDropArea por esto:
        videoDropArea.addEventListener('click', () => videoInput.click());

        videoInput.addEventListener('change', function() {
            if (this.files[0]) {
                const formData = new FormData();
                formData.append('videos', this.files[0]);
                formData.append('Id', '{{ $propiedadVe->id }}');
                formData.append('_token', '{{ csrf_token() }}');

                // Mostrar barra de progreso
                const progressContainer = document.getElementById('videoProgressContainer');
                const progressBar = document.getElementById('videoProgressBar');
                progressContainer.style.display = 'block';
                progressBar.style.width = '0%';
                progressBar.textContent = '0%';

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/propiedades_verano_video', true);

                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        const pct = Math.round((e.loaded / e.total) * 100);
                        progressBar.style.width = pct + '%';
                        progressBar.textContent = pct + '%';
                    }
                };

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        progressBar.style.backgroundColor = '#28a745';
                        progressBar.textContent = '✓ Video guardado';
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        progressBar.style.backgroundColor = '#dc3545';
                        progressBar.textContent = 'Error al subir';
                    }
                };

                xhr.send(formData);
            }
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
        ///////////////////////Calendar//////////////////////////////////////////////////7
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var eventsOnDate = document.getElementById('eventsOnDate');
    var eventDateModal = new bootstrap.Modal(document.getElementById('eventDateModal'));
    var modalError = new bootstrap.Modal(document.getElementById('modalError'));

    // Función para extraer id_verano desde la URL
    function getIdVeranoFromURL() {
        var path = window.location.pathname; // "/propiedadesveranodetalles-5"
        var match = path.match(/-(\d+)$/);   // Extrae el número al final
        return match ? match[1] : null;
    }

    var idVerano = getIdVeranoFromURL();

    // Inicialización del calendario
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
            eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },
        displayEventTime: false, // No mostrar hora en vista mensual
        locale: 'es',
        firstDay: 1,
        buttonText: { today: 'Hoy', month: 'Mes', week: 'Semana', day: 'Día' },
        events: {
            url: '/calendar/events',
            method: 'GET',
            extraParams: function() {
                return { id_verano: idVerano };
            },
            failure: function() {
                alert('No se pudieron cargar los eventos');
            }
        },
        editable: false,
        eventDrop: function(info) {
            var id = info.event.id;
            var start_date = moment(info.event.start).format('YYYY-MM-DD');
            var end_date = moment(info.event.end).format('YYYY-MM-DD');
            console.log(id, start_date, end_date);
        }
    });

    calendar.render();

            // Al enviar el formulario

            $("#guardarevent").off('click').on('click', function(e) {
                e.preventDefault();

                // 1. Combinar fecha+hora en los hidden
                var fechaInicio = $('#inicio_fecha').val();
                var horaInicio  = $('#inicio_hora').val() || '14:00';
                var fechaFin    = $('#fin_fecha').val();
                var horaFin     = $('#fin_hora').val() || '12:00';

                if (!fechaInicio || !fechaFin) {
                    alert('Debe seleccionar fecha de inicio y fecha de fin.');
                    return;
                }

                // 2. Llenar hidden ANTES de leer
                $('#inicio').val(fechaInicio + 'T' + horaInicio);
                $('#fin').val(fechaFin + 'T' + horaFin);

                // 3. Leer todos los valores
                var id_verano  = $('#id_verano').val();
                var inicio     = $('#inicio').val();
                var fin        = $('#fin').val();
                var total      = $('#total').val();
                var porcentaje = $('#porcentaje').val();
                var color      = $('#colorPicker').val();
                var dia        = $('#dia').val();
                var precio_dia = $('#diario').val();
                var monto      = $('#montoInput').val();

                console.log('Enviando:', {id_verano, inicio, fin, total, precio_dia, dia});

                // 4. Validar que los campos requeridos no estén vacíos
                if (!id_verano || !inicio || !fin || !total || !precio_dia) {
                    alert('Complete todos los campos obligatorios.');
                    return;
                }

                // 5. Enviar
                $.ajax({
                    url: '/calendar/events',
                    type: 'POST',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {
                        id_verano:  id_verano,
                        inicio:     inicio,
                        fin:        fin,
                        total:      total,
                        porcentaje: porcentaje,
                        color:      color,
                        dia:        dia,
                        precio_dia: precio_dia,
                        monto:      monto,
                    },
                    success: function(response) {
                        $("#addEventModal").modal('hide');
                        calendar.refetchEvents();  // recargar calendario
                        $('#modalSuccess').modal('show');
                    },
                    error: function(xhr) {
                        console.log('Error completo:', xhr.responseJSON);
                        var msg = (xhr.responseJSON && xhr.responseJSON.message)
                            ? xhr.responseJSON.message
                            : 'Error al guardar. Revisa la consola.';
                        $('#texto_error').text(msg);
                        var modalErr = new bootstrap.Modal(document.getElementById('modalerror'));
                        modalErr.show();
                    }
                });
            });
            $("#close_guardar_arriendo_verano").click(function() {
                var modalS = bootstrap.Modal.getInstance(document.getElementById('modalSuccess'));
                if (modalS) modalS.hide();
                calendar.refetchEvents();
            });

            // Ver los eventos en la fecha actual
            document.getElementById('verFechasBtn').addEventListener('click', function() {
                showAllEvents();
            });

            function showAllEvents() {
                var idVerano = getIdVeranoFromURL();
                
                axios.get('/calendar/events', {
                    params: { id_verano: idVerano }
                })
                .then(function(response) {
                    eventsOnDate.innerHTML = '';
                    if (response.data.length === 0) {
                        eventsOnDate.innerHTML = '<tr><td colspan="9" class="text-center">No hay arriendos registrados.</td></tr>';
                    } else {
                        response.data.forEach(function(event) {
                            var row = `
                            <tr>
                                <td>${event.torre} - #${event.condominio}</td>
                                <td>${event.start}</td>
                                <td>${event.end}</td>
                                <td>${event.dia}</td>
                                <td>$${new Intl.NumberFormat('es-CL').format(event.diario)}</td>
                                <td>$${new Intl.NumberFormat('es-CL').format(event.monto || 0)}</td>
                                <td>$${new Intl.NumberFormat('es-CL').format(event.total)}</td>
                                <td>$${new Intl.NumberFormat('es-CL').format(event.total * 0.10)}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm editarEvento" data-id="${event.id}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm eliminarEvento" data-id="${event.id}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>`;
                            eventsOnDate.innerHTML += row;
                        });
                    }
                    eventDateModal.show();
                })
                .catch(function(error) {
                    console.error('Error cargando eventos:', error);
                });
            }

            // Función para mostrar los eventos de una fecha específica
            
        
            function getIdVeranoFromURL() {
                var path = window.location.pathname; // "/propiedadesveranodetalles-5"
                var match = path.match(/-(\d+)$/);   // Extrae el número al final
                return match ? match[1] : null;
            }
            
            // Función para mostrar los eventos de una fecha específica
            function showEventsOnDate(date) {
                var idVerano = getIdVeranoFromURL();
            
                axios.get(`/calendar/events`, {
                    params: {
                        date: date,
                        id_verano: idVerano
                    }
                })
                .then(function(response) {
                    eventsOnDate.innerHTML = '';
                    if (response.data.length === 0) {
                        eventsOnDate.innerHTML =
                            '<tr><td colspan="12">No hay eventos en esta fecha.</td></tr>';
                    } else {
                        response.data.forEach(function(event) {
                            var row = `
            <tr>
                <td>${event.torre} - #${event.condominio}</td>                    
                <td>${new Date(event.start).toLocaleDateString()}</td>                    
                <td>${new Date(event.end).toLocaleDateString()}</td>                    
                <td>${event.dia}</td>                        
                <td>$${new Intl.NumberFormat('es-CL').format(event.diario)}</td>                    
                <td>${new Intl.NumberFormat('es-CL').format(event.monto) || 0}</td>
                <td>$${new Intl.NumberFormat('es-CL').format(event.total)}</td>                    
                <td>$${new Intl.NumberFormat('es-CL', { minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(event.total * 0.10)}</td>
                <td>
                    <button class="btn btn-warning btn-sm editarEvento d-inline-block" data-id="${event.id}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm eliminarEvento d-inline-block" data-id="${event.id}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>`;
            
                            eventsOnDate.innerHTML += row;
                        });
                    }
                    eventDateModal.show();
                })
                .catch(function(error) {
                    modalError.show();
                });
            }

            // Comienzo para el modal del editar las fechas
            $(document).ready(function() {
                $(document).on('click', '.editarEvento', function(e) {
                    e.preventDefault();
                    var idevento = $(this).data('id');
                    console.log('id del evento',idevento)
                    $.ajax({
                        url:'/editevent/' + idevento,
                        type:'GET',
                        dateType:'json',
                        success: function(respuesta) {
                            console.log('respuesta', respuesta);
                            var modalEditar = new bootstrap.Modal(document.getElementById('modalEditarEventoedit'));
                            modalEditar.show();

                            $('#guardarCambiosedit').data('id', idevento);
                            // Separar fecha y hora del inicio
                            var inicioDate = respuesta.inicio ? respuesta.inicio.split('T') : ['', ''];
                            var finDate    = respuesta.fin    ? respuesta.fin.split('T')    : ['', ''];

                            // Si viene con espacio en lugar de T (formato de MySQL)
                            if (respuesta.inicio && respuesta.inicio.includes(' ')) {
                                inicioDate = respuesta.inicio.split(' ');
                                finDate    = respuesta.fin.split(' ');
                            }

                            $('#inicioedit_fecha').val(inicioDate[0]);
                            $('#inicioedit_hora').val(inicioDate[1] ? inicioDate[1].substring(0, 5) : '14:00');
                            $('#finedit_fecha').val(finDate[0]);
                            $('#finedit_hora').val(finDate[1] ? finDate[1].substring(0, 5) : '12:00');

                            // Actualizar hidden
                            $('#inicioedit').val(respuesta.inicio);
                            $('#finedit').val(respuesta.fin);
                            $("#diaedit").val(respuesta.dia);
                            $("#diarioedit").val(respuesta.precio_dia);
                            $("#montoInputedit").val(respuesta.monto);
                            $("#id_veranoedit").val(respuesta.id_verano);
                            // Después de cargar los demás campos
                            

                            // Verificar si el monto es null
                            if (respuesta.monto === null) {
                                $("#aseoNoedit").prop("checked", true);
                                $("#camposAseoedit").hide();
                            } else {
                                $("#aseoSiedit").prop("checked", true);
                                $("#camposAseoedit").show();
                            }

                                // Calcular la cantidad de días entre inicio y fin
                                let fechaInicio = new Date(respuesta.inicio);
                                let fechaFin = new Date(respuesta.fin);

                                // Obtener la diferencia en milisegundos
                                let diferenciaMs = fechaFin - fechaInicio;

                                // Convertir a días (redondeando para evitar decimales)
                                let dias = Math.ceil(diferenciaMs / (1000 * 60 * 60 * 24)); // Sumar 1 si es necesario

                                // Calcular el total y asignarlo como número entero
                                let total = Math.floor(dias * respuesta.precio_dia); // Eliminar la parte decimal

                                // Calcular el 10% del total
                                let porcentaje = total * 0.10;

                                // Mostrar el total y el porcentaje
                                $("#totaledit").val(total);
                                $("#porcentajeedit").val(Math.floor(porcentaje));  // Mostrar el 10% como número entero


                        }
                    });

                });
            });
            // Combinar fecha+hora en edit
            function actualizarCamposHiddenEdit() {
                var fi = $('#inicioedit_fecha').val();
                var hi = $('#inicioedit_hora').val() || '14:00';
                var ff = $('#finedit_fecha').val();
                var hf = $('#finedit_hora').val() || '12:00';
                if (fi) $('#inicioedit').val(fi + 'T' + hi);
                if (ff) $('#finedit').val(ff + 'T' + hf);
            }

            ['inicioedit_fecha','inicioedit_hora','finedit_fecha','finedit_hora'].forEach(function(id) {
                var el = document.getElementById(id);
                if (el) el.addEventListener('change', actualizarCamposHiddenEdit);
            });

            $('#guardarCambiosedit').on('click', function() {

                actualizarCamposHiddenEdit();
    
                var idevento = $(this).data('id');

                var inicio = $("#inicioedit").val();
                var fin = $("#finedit").val();
                var dia = $("#diaedit").val();
                var precio_dia = $("#diarioedit").val();
                var total = $("#totaledit").val();
                var monto = $("#montoInputedit").val();
                var id_verano = $("#id_veranoedit").val();
                

                var arg = {
                    id: idevento,
                    inicio: inicio,
                    fin: fin,
                    dia: dia,
                    precio_dia: precio_dia,
                    monto: monto,
                    id_verano: id_verano,
                    total: total,
                
                }
                console.log('argumentos',arg);
                
                $.ajax({
                    url: '/eventos/actualizar',
                    method: 'POST',
                    data: arg,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Incluir el token CSRF
                    },
                    success: function(response) {
                        console.log('datos guardados',response)
                        // Mostrar el modal de éxito
                        $('#eventDateModal').modal('hide');
                        $('#successModaleditar').modal('show');

                        // var row = $('tr[data-id="' + response.id + '"]');
                        // row.find('td:nth-child(2)').text(response.start);
                        // row.find('td:nth-child(3)').text(response.end);

                    },
                    error: function(error) {
                        console.error('Error al guardar:', error);
                        alert('Hubo un error al guardar los cambios.');
                    },
                });
            });

            $('#modalEditarEvento .btn-secondary').on('click', function() {
                $('#modalEditarEvento').modal('hide');
            });

            // Cerrar modal de éxito manualmente
            $('#close_success').on('click', function() {
                $('#successModal').modal('hide');
            });



            // Fin del calendario y de editar 
            $(document).ready(function() {
                $(document).on('click', '.eliminarEvento', function(e) {
                    e.preventDefault(); // Cambiar 'event' por 'e'
                    var idevento = $(this).data('id');
                    console.log('id de evento: ' + idevento);

                    // Mostrar el modal de confirmación
                    $("#modaleliminarevento").modal('show');

                    // Eliminar eventos previos en el botón de confirmación para evitar múltiples bindings
                    $("#confirmarfechadelete").off('click').on('click', function() {
                        // Realizar la solicitud AJAX
                        $.ajax({
                                url: `/deleteevento/${idevento}`, // Usar template literals para construir la URL
                                type: 'POST',
                                datatype: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                            })
                            .done(function(respuesta) {
                                console.log("Respuesta:", respuesta);
                                $("#modaleliminarevento").modal('hide');
                                $("#successModal").modal('show');
                                $('#texto_success').text(
                                    'Fecha eliminada correctamente');

                                // Recargar la página después de cerrar el modal de éxito
                                $("#successModal").on('hidden.bs.modal', function() {
                                    location.reload();
                                });
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {
                                console.log("Error:", errorThrown);
                                $("#modalerror").modal('show');
                            });
                    });
                });

                // Recargar la página al cerrar el modal con la "x"
                $("#modaleliminarevento").on('hidden.bs.modal', function() {
                    location.reload();
                });
            });

        
            // Combinar fecha y hora en los campos hidden
            function actualizarCamposHidden() {
                var fechaInicio = document.getElementById('inicio_fecha').value;
                var horaInicio  = document.getElementById('inicio_hora').value  || '14:00';
                var fechaFin    = document.getElementById('fin_fecha').value;
                var horaFin     = document.getElementById('fin_hora').value     || '12:00';

                if (fechaInicio) {
                    document.getElementById('inicio').value = fechaInicio + 'T' + horaInicio;
                }
                if (fechaFin) {
                    document.getElementById('fin').value = fechaFin + 'T' + horaFin;
                }
                calcularDias();
            }

            ['inicio_fecha', 'inicio_hora', 'fin_fecha', 'fin_hora'].forEach(function(id) {
                document.getElementById(id).addEventListener('change', actualizarCamposHidden);
            });

            // Cerrar modal de éxito al hacer clic en la X
            document.getElementById('close_success').addEventListener('click', function() {
                successModal.hide();
            });

            document.getElementById('inicio').addEventListener('change', calcularDias);
            document.getElementById('fin').addEventListener('change', calcularDias);

            function calcularDias() {
                const inicio = document.getElementById('inicio').value;
                const fin = document.getElementById('fin').value;

              if (inicio && fin) {
                const fechaInicio = new Date(inicio);
                const fechaFin = new Date(fin);
                
                // Calcular la diferencia en milisegundos
                const diferencia = (fechaFin - fechaInicio) / (1000 * 60 * 60 * 24); // Convertir a días

                // Asegurarse de que la diferencia sea al menos 1 día
                if (diferencia >= 0) {
                    document.getElementById('dia').value = Math.ceil(diferencia); // Mostrar en el campo de días
                } else {
                    document.getElementById('dia').value = 1; // Si la fecha de fin es anterior, asigna 1 día
                }
            }

                // // Formatear números al estilo chileno
                // function formatCurrency(value) {
                //     return new Intl.NumberFormat('es-CL').format(value);
                // }

                // // Desformatear a número puro
                // function parseCurrency(value) {
                //     return parseInt(value.replace(/\./g, '') || 0);
                // }

                // Evento para formatear dinámicamente
                // document.getElementById('total').addEventListener('input', function(e) {
                //     const rawValue = parseCurrency(this.value); // Convertir a número puro
                //     this.value = formatCurrency(rawValue); // Volver a formatear

                //     // Calcular 10% del total
                //     const porcentajeField = document.getElementById('porcentaje');
                //     porcentajeField.value = formatCurrency(Math.round(rawValue * 0.1));
                // });

                // document.getElementById('diario').addEventListener('input', function(e) {
                //     const rawValue = parseCurrency(this.value); // Convertir a número puro
                //     this.value = formatCurrency(rawValue); // Volver a formatear
                // });
            }

            document.getElementById('diario').addEventListener('input', calcularMontoTotal);
            document.getElementById('dia').addEventListener('input', calcularMontoTotal);

            function calcularMontoTotal() {
                // Obtener los valores de los campos               
                const dia = parseFloat(document.getElementById('dia').value);
                const diario = parseFloat(document.getElementById('diario').value);
                // Verificar si los valores son números válidos                
                if (!isNaN(dia) && !isNaN(diario)) {
                    // Calcular el total (Monto del Arriendo)                    
                    const total = dia * diario;
                    document.getElementById('total').value = total; // Formatear con separador de miles                    
                    // Calcular el porcentaje (10%)                    
                    const porcentaje = Math.round(total * 0.10); // Redondeado a entero                    
                    document.getElementById('porcentaje').value = porcentaje; // Formatear con separador de miles                
                } else {
                    // Si alguno de los valores no es válido, poner los campos en 0                    
                    document.getElementById('total').value = 0;
                    document.getElementById('porcentaje').value = '';
                }

            }
        
        });
        $('#eventForm').on('submit', function(e) {
            e.preventDefault();

            let inicio = $('#inicio').val();
            let fin = $('#fin').val();
            let idVerano = $('#id_verano').val();

            // Llamar al backend para validar la disponibilidad
            $.ajax({
                url: '/eventos/validar-fecha',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    id_verano: idVerano,
                    inicio: inicio,
                    fin: fin,
                },
                success: function(response) {
                    // Si las fechas están disponibles, enviar el formulario
                    $('#eventForm')[0].submit();
                },
                error: function(response) {
                    // Actualizar el mensaje de error en el modal (si es necesario)
                    document.getElementById('texto_error').innerText =
                        'Las fechas seleccionadas están ocupadas.';

                    // Mostrar el modal de error
                    const modalError = new bootstrap.Modal(document.getElementById('modalerror'));
                    modalError.show();
                }


            });

        });
        // inicio chek
        document.addEventListener("DOMContentLoaded", function () {
            const aseoSi = document.getElementById("aseoSiedit");
            const aseoNo = document.getElementById("aseoNoedit");
            const camposAseo = document.getElementById("camposAseoedit");

            function toggleCamposAseo() {
                camposAseo.style.display = aseoSi.checked ? "block" : "none";
            }

            aseoSi.addEventListener("change", toggleCamposAseo);
            aseoNo.addEventListener("change", toggleCamposAseo);

            // Llamamos la función al cargar la página para establecer el estado inicial
            toggleCamposAseo();
        });


        document.addEventListener("DOMContentLoaded", function() {
            // Manejar cambios para "Estacionamientos"                
            document.getElementById("aseoSi").addEventListener("change", function() {
                document.getElementById("camposAseo").style.display = "block";
            });
            document.getElementById("aseoNo").addEventListener("change", function() {
                document.getElementById("camposAseo").style.display = "none";
            });
            $(document).ready(function () {
                // Calcular cantidad de días y total automáticamente
                function calcularMontos() {
                    let inicio = new Date($('#inicioedit').val());
                    let fin = new Date($('#finedit').val());
                    let montoDiario = parseFloat($('#diarioedit').val()) || 0;

                    if (inicio && fin && inicio < fin) {
                        let dias = Math.ceil((fin - inicio) / (1000 * 60 * 60 * 24)); // Diferencia en días
                        $('#diaedit').val(dias);
                        
                        let total = dias * montoDiario;
                        $('#totaledit').val(Math.round(total));  // Redondear el total a un número entero

                        let porcentaje = total * 0.10;
                        $('#porcentajeedit').val(Math.round(porcentaje));  // Redondear el porcentaje también
                    } else {
                        $('#diaedit, #totaledit, #porcentajeedit').val('');
                    }
                }

                // Detectar cambios en fechas o monto diario
                $('#inicioedit, #finedit, #diarioedit').on('input', calcularMontos);
            });

        });

       // Guardar Inventario
        $('#btn_guardar_inventario').on('click', function() {
            var id = $(this).data('id');
            var file = $('#inventariodoc')[0].files[0];
            if (!file) { alert('Seleccione un archivo primero.'); return; }
            var formData = new FormData();
            formData.append('inventario', file);
            formData.append('Id', id);
            $.ajax({
                url: '/property/update/' + id,
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    $('#successModal').modal('show');
                    $('#texto_success').text('Inventario guardado correctamente');

                    // Actualizar visualmente el bloque de inventario
                    var nombreArchivo = file.name;
                    $('#preview_inventario').html(
                        '<div class="card shadow-sm border rounded p-2 d-flex justify-content-between align-items-center">' +
                            '<div class="d-flex align-items-center">' +
                                '<i class="fas fa-file-alt text-primary me-2"></i>' +
                                '<span class="text-truncate" style="max-width: 140px;">' + nombreArchivo + '</span>' +
                            '</div>' +
                        '</div>'
                    );
                },
                error: function() { alert('Error al guardar el inventario.'); }
            });
        });

        // Guardar Acta de Entrega
        $('#btn_guardar_acta').on('click', function() {
            var id = $(this).data('id');
            var file = $('#actadoc')[0].files[0];
            if (!file) { alert('Seleccione un archivo primero.'); return; }
            var formData = new FormData();
            formData.append('acta', file);
            formData.append('Id', id);
            $.ajax({
                url: '/property/update/' + id,
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    $('#successModal').modal('show');
                    $('#texto_success').text('Acta de entrega guardada correctamente');

                    // Actualizar visualmente el bloque de acta
                    var nombreArchivo = file.name;
                    $('#preview_acta').html(
                        '<div class="card shadow-sm border rounded p-2 d-flex justify-content-between align-items-center">' +
                            '<div class="d-flex align-items-center">' +
                                '<i class="fas fa-file-alt text-primary me-2"></i>' +
                                '<span class="text-truncate" style="max-width: 140px;">' + nombreArchivo + '</span>' +
                            '</div>' +
                        '</div>'
                    );
                },
                error: function() { alert('Error al guardar el acta.'); }
            });
        });

        function abrirVideoCompleto(url) {
            const video = document.getElementById('videoCompleto');
            const source = document.getElementById('videoCompletoSrc');
            source.src = url;
            video.load();
            video.play();
            const modal = new bootstrap.Modal(document.getElementById('modalVideoCompleto'));
            modal.show();
        }

        function detenerVideo() {
            const video = document.getElementById('videoCompleto');
            video.pause();
            video.currentTime = 0;
        }

        // Detener video al cerrar modal con la X
        document.getElementById('modalVideoCompleto').addEventListener('hidden.bs.modal', function() {
            detenerVideo();
        });

        function confirmarEliminarVideo(id) {
            if (confirm('¿Seguro que quieres eliminar este video?')) {
                $.ajax({
                    url: '/video-verano/' + id,  // usa tu ruta existente de eliminar
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function() {
                        $('#successModal').modal('show');
                        $('#texto_success').text('Video eliminado correctamente');
                        $('#successModal').on('hidden.bs.modal', function() {
                            location.reload();
                        });
                    },
                    error: function() {
                        alert('Error al eliminar el video');
                    }
                });
            }
        }
        // // fin chek
    </script>

@endsection
@section('css')
    @parent
    <style>
        /* Ajusta el grosor del borde del calendario */
/* Estilo para los eventos en el calendario */
.fc-event {
    border-width: 1px !important;
    border-style: solid;
    white-space: pre-line; /* Respetar los saltos de línea */
    text-align: center; /* Centra el texto dentro del evento */
    vertical-align: middle; /* Centra el contenido verticalmente */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Estilo para los títulos de los eventos */
.fc-event-title {
    display: block;
    white-space: pre-line; /* Respetar los saltos de línea */
    word-wrap: break-word; /* Asegura que las palabras largas se dividan */
    font-size: 12px; /* Tamaño del texto */
    line-height: 1.4; /* Espaciado entre líneas */
    text-align: center; /* Centra el texto dentro del título */
    margin: 0; /* Elimina el margen por defecto */
}



        /* Cambiar el color del checkbox cuando está activado */
        .form-check-input:checked {
            background-color: #198754 !important;
            /* Verde de Bootstrap (success) */
            border-color: #fff !important;
            /* Asegura que el borde sea blanco */
        }

        .form-check-input {
            background-color: #dc3545;
            /* Rojo de Bootstrap (danger) */
            /* Puedes quitar el comentario en border-color si quieres bordes rojos */
            /* border-color: #dc3545; */
            /* Animación suave para los cambios */
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        /* Estilos para el contenedor de subir imágenes */

        .upload-container:hover {
            border-color: #0d6efd;
            /* Azul de Bootstrap (primary) cuando se pasa el ratón */
            color: #0d6efd;
            /* Cambiar color de texto a azul */
        }

        /* Estilos para la imagen dentro del contenedor de subir imágenes */
        .upload-container img {
            margin-top: 1rem;
            max-width: 100%;
            /* Para que la imagen ocupe todo el ancho del contenedor */
            max-height: 150px;
            /* Limitar la altura máxima de la imagen */
            border-radius: 0.5rem;
            /* Bordes redondeados para la imagen */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            /* Sombra sutil alrededor de la imagen */
        }

        /* Calendar */
        .fc-toolbar .fc-center h2 {
            font-size: 10px;
            /* Ajusta el tamaño según sea necesario */
        }

        /* Reducir tamaño de los botones */
        .fc-toolbar .fc-button {
            font-size: 10px;
            /* Ajusta el tamaño según sea necesario */
            padding: 5px 1px;
            /* Ajusta el padding si lo deseas */
        }

        @media (max-width: 768px) {

            .table th,
            .table td {
                font-size: 0.85rem;
                /* Reduce el tamaño de la fuente */
                white-space: nowrap;
                /* Evita que el texto se corte en varias líneas */
            }
        }

        .btn {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-warning {
            background-color: #FFC107;
            color: white;
            border: none;
        }

        .btn-danger {
            background-color: #DC3545;
            color: white;
            border: none;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            opacity: 0.8;
        }
        /* Quitar flechas de inputs type number */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
