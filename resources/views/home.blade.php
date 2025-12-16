@extends('layouts.app')
@section('content')
<div class="container-fluid overflow-hidden" style="background-color: rgb(224, 218, 218)">
    <div class="row vh-100 overflow-auto" style="background-image: url('/img/home_casa.jpg'); background-size: cover; background-position: center; height: 100vh;">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- Contenido principal -->
        <div class="col-lg-10 d-flex flex-column" style="padding: 0;">
            <div class="flex-grow-1 p-2">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 text-center mb-3">
                            <h4 class="mb-3 text-dark fw-bold">Filtrar gráficos</h4>
                            <div class="d-flex justify-content-center gap-3 flex-wrap">
                                <a href="#" 
                                    class="btn btn-primary px-4 py-2 shadow-lg rounded-pill d-flex align-items-center" 
                                    onclick="mostrarArriendo()">
                                    <i class="bi bi-house-fill me-2"></i> Arriendo
                                </a>
                                <a href="#" class="btn btn-success px-4 py-2 shadow-lg rounded-pill d-flex align-items-center" 
                                    onclick="mostrarVentas()">
                                    <i class="bi bi-bar-chart-line-fill me-2"></i> Ventas
                                </a>
                                <a href="#" class="btn btn-warning px-4 py-2 shadow-lg rounded-pill d-flex align-items-center"
                                    onclick="mostrarVerano()">
                                    <i class="bi bi-sun-fill me-2"></i> Verano
                                </a>
                            </div>
                        </div>

                        <!-- CONTENEDOR DE ARRIENDOS -->
                        <div class="scroll-graficos" style="max-height: 75vh; overflow-y: auto;">
                            <div class="col-lg-12 overflow-auto" id="garficosArriendo" style="display: none;">
                                <div class="card border-0 shadow-lg">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-12 d-flex justify-content-center mb-4">
                                                    <h3 class="card-title text-center bg-primary rounded p-3 text-white">
                                                        <i class="bi bi-house-fill me-2"></i>Propiedades arrendadas y retiradas del sistema
                                                    </h3>
                                                </div>

                                                <!-- Estadísticas de Arriendos -->
                                                <div class="row mb-4">
                                                    <!-- Columna izquierda -->
                                                    <div class="col-lg-6">
                                                        <div class="card mb-3 border-success border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-success text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-house-check-fill fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Total arriendos realizados</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$arriendosPorMes->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card border-info border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-info text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-cash-coin fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Valor total ingresado</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">${{ number_format($arriendosPorMes->sum('total_retirado'), 0, '.', '.') }}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Columna derecha -->
                                                    <div class="col-lg-6">
                                                        <div class="card mb-3 border-danger border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-danger text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-house-x-fill fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Total retiradas del sistema</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$retiradosPorMes->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card border-warning border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-warning text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-cash-stack fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Valor total retirado</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">${{ number_format($retiradosPorMes->sum('total_retirado'), 0, '.', '.') }}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Ganancias Totales -->
                                                @php
                                                    $valorTotalArriendos = $arriendosPorMes->sum('total_retirado');
                                                    $valorTotalRetiradas = $retiradosPorMes->sum('total_retirado');
                                                    $gananciasTotales = $valorTotalArriendos - $valorTotalRetiradas;
                                                    $porcentajeGanancias = $valorTotalArriendos > 0 ? ($gananciasTotales / $valorTotalArriendos) * 100 : 0;
                                                    $gananciaClass = $gananciasTotales >= 0 ? 'success' : 'danger';
                                                @endphp
                                                
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="card border-{{ $gananciaClass }} border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-{{ $gananciaClass }} text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-graph-up-arrow fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Ganancias totales</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">
                                                                            ${{ number_format($gananciasTotales, 0, '.', '.') }}
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card border-{{ $gananciaClass }} border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-{{ $gananciaClass }} text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-percent fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Porcentaje de ganancias</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">
                                                                            {{ number_format($porcentajeGanancias, 2, '.', '') }}%
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Propiedades ingresadas -->
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="card border-primary border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-primary text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-calendar-range fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Propiedades Marzo-Diciembre</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$propiedades->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card border-secondary border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-secondary text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-calendar-fill fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Propiedades año corrido</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$propiedadesC->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Gráfico -->
                                                <div class="col-lg-12 mt-3">
                                                    <div style="overflow-x: auto;">
                                                        <div style="position: relative; height: 100%; width: 1200px;">
                                                            <canvas id="arriendosYRetiradosPorMesChart" style="width: 200px; min-height: 400px;"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gráfico de arriendos por mes -->
                            <div class="col-lg-12 mt-3" id="arriendopromeses" style="display: none;">
                                <div class="card w-100 border-0 shadow-lg">
                                    <div class="card-body" style="overflow-x: auto;">
                                        <h4 class="text-center mb-4 text-dark fw-bold">
                                            <i class="bi bi-bar-chart-fill me-2"></i>Arriendos por mes
                                        </h4>
                                        <div style="position: relative; height: 100%; width: 1200px;">
                                            <canvas id="propiedadesPorMesChart" style="width: 200px; min-height: 300px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CONTENEDOR DE VENTAS -->
                        <div class="scroll-venta" style="max-height: 75vh; overflow-y: auto;">
                            <div class="col-lg-12" id="Ventasgrafico" style="display: none;">
                                <div class="card border-0 shadow-lg">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-12 d-flex justify-content-center mb-4">
                                                    <h3 class="card-title text-center bg-success rounded p-3 text-white">
                                                        <i class="bi bi-bar-chart-line-fill me-2"></i>Propiedades en ventas y retiradas del sistema
                                                    </h3>
                                                </div>

                                                <!-- Estadísticas de Ventas -->
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="card mb-3 border-success border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-success text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-shop fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Total propiedades en venta</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$ventaPorMes->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card border-info border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-info text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-currency-dollar fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Valor total de ventas</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">${{ number_format($precioventa->sum('totalventa'), 0, '.', '.') }}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="card mb-3 border-danger border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-danger text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-cart-x-fill fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Propiedades vendidas</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$ventaretiradaPorMes->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card border-warning border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-warning text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-cash fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Valor retirado del sistema</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">${{ number_format($precioventaretirada->sum('totalventa'), 0, '.', '.') }}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Ganancia/Pérdida -->
                                                @php
                                                    $totalVentas = $precioventa->sum('totalventa');
                                                    $totalRetiradas = $precioventaretirada->sum('totalventa');
                                                    $gananciaPerdida = $totalVentas - $totalRetiradas;
                                                    $porcentajeGanancia = $totalVentas > 0 ? ($gananciaPerdida / $totalVentas) * 100 : 0;
                                                    $ventaClass = $gananciaPerdida >= 0 ? 'success' : 'danger';
                                                @endphp

                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="card border-{{ $ventaClass }} border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-{{ $ventaClass }} text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-graph-up fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Ganancia / Pérdida</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">
                                                                            ${{ number_format($gananciaPerdida, 0, '.', '.') }}
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card border-{{ $ventaClass }} border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-{{ $ventaClass }} text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-percent fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Porcentaje de ganancia</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">
                                                                            {{ number_format($porcentajeGanancia, 2, '.', '.') }}%
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Propiedades en venta ingresadas -->
                                                <div class="row mb-4">
                                                    <div class="col-lg-12">
                                                        <div class="card border-primary border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-primary text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-house-add-fill fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Propiedades en venta ingresadas</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$ventaPorMes->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Gráfico -->
                                                <div class="col-lg-12">
                                                    <div style="overflow-x: auto;">
                                                        <div style="position: relative; height: 100%; width: 1200px;">
                                                            <canvas id="ventasChart" style="width: 200px; min-height: 300px;"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Gráfico de ventas por mes -->
                            <div class="col-lg-12 mt-3" id="ventaspormesgraf" style="display: none;">
                                <div class="card border-0 shadow-lg">
                                    <div class="card-body">
                                        <h4 class="text-center mb-4 text-dark fw-bold">
                                            <i class="bi bi-bar-chart-line-fill me-2"></i>Ventas por mes
                                        </h4>
                                        <div class="col-lg-12" style="overflow-x: auto;">
                                            <div style="position: relative; height: 100%; width: 1200px;">
                                                <canvas id="ventaspropiedadesChart" style="width: 200px; min-height: 300px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CONTENEDOR DE VERANO -->
                        <div class="scroll-verano" style="max-height: 75vh; overflow-y: auto;">
                            <div class="col-lg-12" id="veranograficos" style="display:none;">
                                <div class="card border-0 shadow-lg">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-12 d-flex justify-content-center mb-4">
                                                    <h3 class="card-title text-center bg-warning rounded p-3 text-white">
                                                        <i class="bi bi-sun-fill me-2"></i>Propiedades de verano y retiradas del sistema
                                                    </h3>
                                                </div>

                                                <!-- Estadísticas de Verano -->
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="card mb-3 border-warning border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-warning text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-sun fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Propiedades de verano en arriendo</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$verano->sum('total_verano')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card border-info border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-info text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-cash-stack fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Valor total arriendo verano</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">${{ number_format($verano->sum('totalverano'), 0, '.', '.') }}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="card mb-3 border-success border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-success text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-house-door-fill fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Disponibles para arrendar</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$veranoretirado->sum('total_verano')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card border-secondary border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-secondary text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-cash-coin fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Valor retirado del sistema</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">${{ number_format($veranoretirado->sum('totalverano'), 0, '.', '.') }}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Ganancia/Pérdida -->
                                                @php
                                                    $totalVentas = $verano->sum('totalverano');
                                                    $totalRetiradas = $veranoretirado->sum('totalverano');
                                                    $gananciaPerdida = $totalVentas - $totalRetiradas;
                                                    $porcentajeGanancia = $totalVentas > 0 ? ($gananciaPerdida / $totalVentas) * 100 : 0;
                                                    $veranoClass = $gananciaPerdida >= 0 ? 'success' : 'danger';
                                                @endphp

                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="card border-{{ $veranoClass }} border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-{{ $veranoClass }} text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-graph-up-arrow fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Ganancia / Pérdida</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">
                                                                            ${{ number_format($gananciaPerdida, 0, '.', '.') }}
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card border-{{ $veranoClass }} border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-{{ $veranoClass }} text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-percent fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Porcentaje de ganancia</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">
                                                                            {{ number_format($porcentajeGanancia, 2, '.', '.') }}%
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Propiedades de verano ingresadas -->
                                                <div class="row mb-4">
                                                    <div class="col-lg-12">
                                                        <div class="card border-primary border-start border-4 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-primary text-white rounded-circle p-3 me-3">
                                                                        <i class="bi bi-house-heart-fill fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1 text-muted">Propiedades de verano ingresadas</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$veranoPropiedad->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Gráfico -->
                                                <div class="col-lg-12">
                                                    <div style="overflow-x: auto;">
                                                        <div style="position: relative; height: 100%; width: 1200px;">
                                                            <canvas id="veranoChart" style="width: 200px; min-height: 300px;"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Gráfico de verano por mes -->
                            <div class="col-lg-12 mt-3" id="veranocantidadagrafico" style="display:none ;">
                                <div class="card border-0 shadow-lg">
                                    <div class="card-body">
                                        <h4 class="text-center mb-4 text-dark fw-bold">
                                            <i class="bi bi-sun-fill me-2"></i>Arriendos de verano por mes
                                        </h4>
                                        <div class="col-lg-12" style="overflow-x: auto;">
                                            <div style="position: relative; height: 100%; width: 1200px;">
                                                <canvas id="veranocantidadChart" style="width: 200px; min-height: 300px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection

@section('css')
@parent
<style>
    .card {
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .rounded-circle {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .border-start {
        border-left-width: 4px !important;
    }
    
    .text-muted {
        font-size: 0.9rem;
        color: #6c757d !important;
    }
    
    h4.text-dark {
        font-size: 1.5rem;
    }
    
    h6.text-muted {
        font-size: 0.9rem;
    }
    
    .scroll-graficos::-webkit-scrollbar,
    .scroll-venta::-webkit-scrollbar,
    .scroll-verano::-webkit-scrollbar {
        width: 8px;
    }
    
    .scroll-graficos::-webkit-scrollbar-track,
    .scroll-venta::-webkit-scrollbar-track,
    .scroll-verano::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .scroll-graficos::-webkit-scrollbar-thumb,
    .scroll-venta::-webkit-scrollbar-thumb,
    .scroll-verano::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    
    .scroll-graficos::-webkit-scrollbar-thumb:hover,
    .scroll-venta::-webkit-scrollbar-thumb:hover,
    .scroll-verano::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endsection

@section('javascript')
@parent
<script>
    // Convierte los datos de PHP a formato JavaScript
    const propiedadesPorMes = @json($propiedadesPorMes); //Propiedades por meses

    const arriendosPorMes = @json($arriendosPorMes); //Arriendos por meses
    const retiradosPorMes = @json($retiradosPorMes); //Arriendos Retirados

    const ventaPorMes = @json($ventaPorMes);//Ventas por meses
    const ventaretiradaPorMes = @json($ventaretiradaPorMes);//Ventas Retiradas
    const precioventa = @json($precioventa);//Precio de venta por meses
    const precioventaretirada = @json($precioventaretirada);//Precio de venta retiradas

    const verano = @json($verano);//Propiedades de verano
    const veranoretirado = @json($veranoretirado);//Propiedades de verano retiradas

    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const añoActual = new Date().getFullYear();

    const propiedadMesLabels = propiedadesPorMes.map(p => `${meses[p.mes - 1]} ${añoActual}`);
    const propiedadMesData = propiedadesPorMes.map(p => p.total);
    

    const arriendoMesLabels = arriendosPorMes.map(a => `${meses[a.mes - 1]} ${añoActual}`);
    const arriendoMesData = arriendosPorMes.map(a => a.total);
    const arriendoMesvalorData = arriendosPorMes.map(a => a.total_retirado);

    const retiradoMesLabels = retiradosPorMes.map(a => `${meses[a.mes - 1]} ${añoActual}`);
    const retiradoMesData = retiradosPorMes.map(a => a.total);
    const retiradoMesvalorData = retiradosPorMes.map(a => a.total_retirado);



    const ventaMesLabels = ventaPorMes.map(v => `${meses[v.mes - 1]} ${añoActual}`);
    const ventaPorMesData = ventaPorMes.map(v => v.total); 
    const ventarevalorPorMesData = precioventa.map(v => v.totalventa);


    const ventaretiradaPorMesLabels = ventaretiradaPorMes.map(v => `${meses[v.mes - 1]} ${añoActual}`);
    const ventaretiradaPorMesPorMesData = ventaretiradaPorMes.map(v => v.total);
    const retiradovalorPorMesData = precioventaretirada.map(v => v.totalventa);

    const veranoMesLabels = verano.map(ver => `${meses[ver.mes - 1]} ${añoActual}`);
    const veranoPorMesData = verano.map(ver => ver.total_verano); 
    const veranovalorPorMesData = verano.map(ver => ver.totalverano);

    const veranoretiradaPorMesLabels = veranoretirado.map(ver => `${meses[ver.mes - 1]} ${añoActual}`);
    const veranoretiradaPorMesPorMesData = veranoretirado.map(ver => ver.total_verano);
    const veranoretiradovalorPorMesData = veranoretirado.map(ver => ver.totalverano);

    // Combina las etiquetas únicas de ambos conjuntos
    const allmesesLabels = Array.from(new Set([...arriendoMesLabels, ...retiradoMesLabels]));

    // Rellena los datos de arriendos con 0 donde no existan
    const arriendoData = allmesesLabels.map(label => {
        const index = arriendoMesLabels.indexOf(label);
        return index !== -1 ? arriendoMesData[index] : 0;
    });

    // Rellena los datos de retiros con 0 donde no existan
    const retiroData = allmesesLabels.map(label => {
        const index = retiradoMesLabels.indexOf(label);
        return index !== -1 ? retiradoMesData[index] : 0;
    });

    // Gráfico actualizado
    const ctx = document.getElementById('propiedadesPorMesChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: allmesesLabels,
            datasets: [
                {
                    label: 'Arriendos ingresados por mes',
                    data: arriendoData,
                    backgroundColor: '#198754',
                    borderColor: '#198754',
                    borderWidth: 1,
                    borderRadius: 10,
                    barThickness: 30,
                },
                {
                    label: 'Arriendos retirados por mes',
                    data: retiroData,
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545',
                    borderWidth: 1,
                    borderRadius: 10,
                    barThickness: 30,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Arriendos por cada mes',
                    color: '#333',
                    font: {
                        size: 20,
                        weight: 'bold',
                        family: 'Arial',
                    },
                    padding: 20,
                },
                legend: {
                    display: true,
                    labels: {
                        color: '#555',
                        font: {
                            size: 14,
                            family: 'Arial',
                        },
                    },
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function (context) {
                            return ` ${context.dataset.label}: ${context.raw.toLocaleString('es-CL')}`;
                        },
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: { size: 14 },
                    bodyFont: { size: 12 },
                    padding: 10,
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Meses',
                        font: {
                            size: 16,
                            family: "'Poppins', sans-serif",
                            weight: '600',
                        },
                        color: '#333',
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12,
                            family: "'Poppins', sans-serif",
                            weight: '400',
                        },
                        color: '#333',
                    },
                    grid: {
                        display: true,
                        color: '#ddd',
                        lineWidth: 1,
                    },
                    categoryPercentage: 0.85,
                    barPercentage: 0.85,
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad',
                        font: {
                            size: 16,
                            family: "'Poppins', sans-serif",
                            weight: '600',
                        },
                        color: '#333',
                    },
                    ticks: {
                        font: {
                            size: 12,
                            family: "'Poppins', sans-serif",
                            weight: '400',
                        },
                        color: '#333',
                    },
                    grid: {
                        display: true,
                        color: '#ddd',
                        lineWidth: 1,
                    },
                },
            },
        },
    });

    // Combina y normaliza etiquetas
    const allLabels = [...new Set([...arriendoMesLabels, ...retiradoMesLabels])];

    // Normaliza datos de arriendos
    const normalizedArriendoData = allLabels.map(label => {
        const index = arriendoMesLabels.indexOf(label);
        return index !== -1 ? arriendoMesvalorData[index] : 0;
    });

    // Normaliza datos de retirados
    const normalizedRetiradoData = allLabels.map(label => {
        const index = retiradoMesLabels.indexOf(label);
        return index !== -1 ? retiradoMesvalorData[index] : 0;
    });

    // Calcula ganancias/pérdidas
    const gananciasPorMes = normalizedArriendoData.map((arriendo, index) => {
        const diferencia = arriendo - normalizedRetiradoData[index];
        return diferencia > 0 ? diferencia : 0;
    });
    const perdidasPorMes = normalizedArriendoData.map((arriendo, index) => {
        const diferencia = arriendo - normalizedRetiradoData[index];
        return diferencia < 0 ? Math.abs(diferencia) : 0;
    });

    new Chart(document.getElementById('arriendosYRetiradosPorMesChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: allLabels,
            datasets: [
                {
                    label: 'Valor de arriendos',
                    data: normalizedArriendoData,
                    backgroundColor: '#198754',
                    borderColor: '#198754',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                    hoverBorderWidth: 2
                },
                {
                    label: 'Retirados por mes',
                    data: normalizedRetiradoData,
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Ganancias por mes',
                    data: gananciasPorMes,
                    backgroundColor: 'rgba(38, 38, 255)',
                    borderColor: 'rgb(0, 0, 150)',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                    hoverBorderColor: 'rgb(0, 0, 120)',
                    hoverBorderWidth: 2
                },{
                    label: 'Pérdidas por mes',
                    data: perdidasPorMes,
                    backgroundColor: 'rgba(132, 0, 255)',
                    borderColor: 'rgb(89, 0, 255)',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                    hoverBorderColor: 'rgb(98, 0, 255)',
                    hoverBorderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Análisis de arriendos y retirados por cada mes',
                    font: {
                        size: 20,
                        weight: 'bold',
                        family: "'Poppins', sans-serif",
                        lineHeight: 1.2
                    },
                    color: '#333',
                    padding: 20
                },
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,
                            family: "'Poppins', sans-serif",
                            weight: '500'
                        },
                        color: '#555'
                    },
                    padding: 10
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Meses',
                        font: {
                            size: 16,
                            family: "'Poppins', sans-serif",
                            weight: '600'
                        },
                        color: '#333'
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12,
                            family: "'Poppins', sans-serif",
                            weight: '400'
                        },
                        color: '#333'
                    },
                    grid: {
                        display: true,
                        color: '#ddd',
                        lineWidth: 1
                    },
                    categoryPercentage: 0.85,
                    barPercentage: 0.85
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad / Valores ($)',
                        font: {
                            size: 16,
                            family: "'Poppins', sans-serif",
                            weight: '600'
                        },
                        color: '#333'
                    },
                    ticks: {
                        font: {
                            size: 12,
                            family: "'Poppins', sans-serif",
                            weight: '400'
                        },
                        color: '#333'
                    },
                    grid: {
                        display: true,
                        color: '#ddd',
                        lineWidth: 1
                    }
                }
            }
        }
    });

    // Fusionar todas las etiquetas de meses en una sola lista sin duplicados
    const allVentasLabels = [...new Set([...ventaMesLabels, ...ventaretiradaPorMesLabels])];

    // Normalizar datos de ventas ingresadas
    const normalizedVentaData = allVentasLabels.map(label => {
        const index = ventaMesLabels.indexOf(label);
        return index !== -1 ? ventarevalorPorMesData[index] : 0;
    });

    // Normalizar datos de ventas retiradas
    const normalizedRetiradoventaData = allVentasLabels.map(label => {
        const index = ventaretiradaPorMesLabels.indexOf(label);
        return index !== -1 ? retiradovalorPorMesData[index] : 0;
    });

    // Calcular diferencia entre ventas ingresadas y retiradas
    const diferenciaVentas = normalizedVentaData.map((venta, index) => venta - normalizedRetiradoventaData[index]);

    // Separar ganancias y pérdidas
    const diferenciaPositiva = diferenciaVentas.map(val => val >= 0 ? val : 0);
    const diferenciaNegativa = diferenciaVentas.map(val => val < 0 ? Math.abs(val) : 0);

    // Crear gráfico de ventas
    new Chart(document.getElementById('ventasChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: allVentasLabels,
            datasets: [
                {
                    label: 'Ventas ingresadas',
                    data: normalizedVentaData,
                    backgroundColor: '#198754',
                    borderColor: '#198754',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Ventas retiradas',
                    data: normalizedRetiradoventaData,
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Ganancia',
                    data: diferenciaPositiva,
                    backgroundColor: 'blue',
                    borderColor: 'blue',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Pérdida',
                    data: diferenciaNegativa,
                    backgroundColor: 'purple',
                    borderColor: 'purple',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,
                            family: "'Poppins', sans-serif",
                            weight: '500'
                        },
                        color: '#555'
                    }
                },
                title: {
                    display: true,
                    text: 'Análisis de ventas por mes',
                    font: {
                        size: 20,
                        weight: 'bold',
                        family: "'Poppins', sans-serif",
                        lineHeight: 1.2
                    },
                    color: '#333',
                    padding: 20
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Meses',
                        font: {
                            size: 16,
                            family: "'Poppins', sans-serif",
                            weight: '600'
                        },
                        color: '#333'
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12,
                            family: "'Poppins', sans-serif",
                            weight: '400'
                        },
                        color: '#333'
                    },
                    grid: {
                        display: true,
                        color: '#ddd',
                        lineWidth: 1
                    },
                    categoryPercentage: 0.85,
                    barPercentage: 0.85
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad / Valores ($)',
                        font: {
                            size: 16,
                            family: "'Poppins', sans-serif",
                            weight: '600'
                        },
                        color: '#333'
                    },
                    ticks: {
                        font: {
                            size: 12,
                            family: "'Poppins', sans-serif",
                            weight: '400'
                        },
                        color: '#333'
                    },
                    grid: {
                        display: true,
                        color: '#ddd',
                        lineWidth: 1
                    }
                }
            }
        }
    });

    // Combina las etiquetas únicas de ambos conjuntos
    const allmesesventaLabels = Array.from(new Set([...ventaMesLabels, ...ventaretiradaPorMesLabels]));

    // Rellena los datos de ventas con 0 donde no existan
    const ventaData = allmesesventaLabels.map(label => {
        const index = ventaMesLabels.indexOf(label);
        return index !== -1 ? ventaPorMesData[index] : 0;
    });

    // Rellena los datos de retiros con 0 donde no existan
    const retiroventaData = allmesesventaLabels.map(label => {
        const index = ventaretiradaPorMesLabels.indexOf(label);
        return index !== -1 ? ventaretiradaPorMesPorMesData[index] : 0;
    });

    // Gráfico de ventas por mes
    const ctxve = document.getElementById('ventaspropiedadesChart').getContext('2d');

    new Chart(ctxve, {
        type: 'bar',
        data: {
            labels: allmesesventaLabels,
            datasets: [
                {
                    label: 'Ventas ingresadas por mes',
                    data: ventaData,
                    backgroundColor: '#198754',
                    borderColor: '#198754',
                    borderWidth: 1,
                    borderRadius: 10,
                    barThickness: 30,
                },
                {
                    label: 'Ventas retiradas por mes',
                    data: retiroventaData,
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545',
                    borderWidth: 1,
                    borderRadius: 10,
                    barThickness: 30,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Ventas por cada mes',
                    color: '#333',
                    font: {
                        size: 20,
                        weight: 'bold',
                        family: 'Arial',
                    },
                    padding: 20,
                },
                legend: {
                    display: true,
                    labels: {
                        color: '#555',
                        font: {
                            size: 14,
                            family: 'Arial',
                        },
                    },
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function (context) {
                            return ` ${context.dataset.label}: ${context.raw.toLocaleString('es-CL')}`;
                        },
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: { size: 14 },
                    bodyFont: { size: 12 },
                    padding: 10,
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Meses',
                        font: {
                            size: 16,
                            family: "'Poppins', sans-serif",
                            weight: '600',
                        },
                        color: '#333',
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12,
                            family: "'Poppins', sans-serif",
                            weight: '400',
                        },
                        color: '#333',
                    },
                    grid: {
                        display: true,
                        color: '#ddd',
                        lineWidth: 1,
                    },
                    categoryPercentage: 0.85,
                    barPercentage: 0.85,
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad',
                        font: {
                            size: 16,
                            family: "'Poppins', sans-serif",
                            weight: '600',
                        },
                        color: '#333',
                    },
                    ticks: {
                        font: {
                            size: 12,
                            family: "'Poppins', sans-serif",
                            weight: '400',
                        },
                        color: '#333',
                    },
                    grid: {
                        display: true,
                        color: '#ddd',
                        lineWidth: 1,
                    },
                },
            },
        },
    });

    // Combina y normaliza etiquetas de verano
    const allveranoLabels = [...new Set([...veranoMesLabels, ...veranoretiradaPorMesLabels])];

    // Normaliza datos de verano
    const normalizedveranoData = allveranoLabels.map(label => {
        const index = veranoMesLabels.indexOf(label);
        return index !== -1 ? veranovalorPorMesData[index] : 0;
    });

    // Normaliza datos de retirados
    const normalizedRetiradoveranoData = allveranoLabels.map(label => {
        const index = veranoretiradaPorMesLabels.indexOf(label);
        return index !== -1 ? veranoretiradovalorPorMesData[index] : 0;
    });

    // Calcula ganancias/pérdidas
    const gananciasveranoPorMes = normalizedveranoData.map((verano, index) => {
        const diferencia = verano - normalizedRetiradoveranoData[index];
        return diferencia > 0 ? diferencia : 0;
    });
    const perdidasveranoPorMes = normalizedveranoData.map((verano, index) => {
        const diferencia = verano - normalizedRetiradoveranoData[index];
        return diferencia < 0 ? Math.abs(diferencia) : 0;
    });

    new Chart(document.getElementById('veranoChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: allveranoLabels,
            datasets: [
                {
                    label: 'Valor de verano',
                    data: normalizedveranoData,
                    backgroundColor: '#198754',
                    borderColor: '#198754',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                    hoverBorderWidth: 2
                },
                {
                    label: 'Retirados por mes',
                    data: normalizedRetiradoveranoData,
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Ganancias por mes',
                    data: gananciasveranoPorMes,
                    backgroundColor: 'rgba(38, 38, 255)',
                    borderColor: 'rgb(0, 0, 150)',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                    hoverBorderColor: 'rgb(0, 0, 120)',
                    hoverBorderWidth: 2
                },{
                    label: 'Pérdidas por mes',
                    data: perdidasveranoPorMes,
                    backgroundColor: 'rgba(132, 0, 255)',
                    borderColor: 'rgb(89, 0, 255)',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                    hoverBorderColor: 'rgb(98, 0, 255)',
                    hoverBorderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Análisis de verano y retirados por cada mes',
                    font: {
                        size: 20,
                        weight: 'bold',
                        family: "'Poppins', sans-serif",
                        lineHeight: 1.2
                    },
                    color: '#333',
                    padding: 20
                },
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,
                            family: "'Poppins', sans-serif",
                            weight: '500'
                        },
                        color: '#555'
                    },
                    padding: 10
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Meses',
                        font: {
                            size: 16,
                            family: "'Poppins', sans-serif",
                            weight: '600'
                        },
                        color: '#333'
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12,
                            family: "'Poppins', sans-serif",
                            weight: '400'
                        },
                        color: '#333'
                    },
                    grid: {
                        display: true,
                        color: '#ddd',
                        lineWidth: 1
                    },
                    categoryPercentage: 0.85,
                    barPercentage: 0.85
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad / Valores ($)',
                        font: {
                            size: 16,
                            family: "'Poppins', sans-serif",
                            weight: '600'
                        },
                        color: '#333'
                    },
                    ticks: {
                        font: {
                            size: 12,
                            family: "'Poppins', sans-serif",
                            weight: '400'
                        },
                        color: '#333'
                    },
                    grid: {
                        display: true,
                        color: '#ddd',
                        lineWidth: 1
                    }
                }
            }
        }
    });

    // Combina las etiquetas únicas de ambos conjuntos
    const allmesesveranoLabels = Array.from(new Set([...veranoMesLabels, ...veranoretiradaPorMesLabels]));

    // Rellena los datos de arriendos con 0 donde no existan
    const veranoData = allmesesveranoLabels.map(label => {
        const index = veranoMesLabels.indexOf(label);
        return index !== -1 ? veranoPorMesData[index] : 0;
    });

    // Rellena los datos de retiros con 0 donde no existan
    const veranoretiroData = allmesesveranoLabels.map(label => {
        const index = veranoretiradaPorMesLabels.indexOf(label);
        return index !== -1 ? veranoretiradaPorMesPorMesData[index] : 0;
    });

    // Gráfico de verano por mes
    const ctxverano = document.getElementById('veranocantidadChart').getContext('2d');

    new Chart(ctxverano, {
        type: 'bar',
        data: {
            labels: allmesesveranoLabels,
            datasets: [
                {
                    label: 'Arriendos ingresados por mes',
                    data: veranoData,
                    backgroundColor: '#198754',
                    borderColor: '#198754',
                    borderWidth: 1,
                    borderRadius: 10,
                    barThickness: 30,
                },
                {
                    label: 'Arriendos retirados por mes',
                    data: veranoretiroData,
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545',
                    borderWidth: 1,
                    borderRadius: 10,
                    barThickness: 30,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Arriendos de verano por cada mes',
                    color: '#333',
                    font: {
                        size: 20,
                        weight: 'bold',
                        family: 'Arial',
                    },
                    padding: 20,
                },
                legend: {
                    display: true,
                    labels: {
                        color: '#555',
                        font: {
                            size: 14,
                            family: 'Arial',
                        },
                    },
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function (context) {
                            return ` ${context.dataset.label}: ${context.raw.toLocaleString('es-CL')}`;
                        },
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: { size: 14 },
                    bodyFont: { size: 12 },
                    padding: 10,
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Meses',
                        font: {
                            size: 16,
                            family: "'Poppins', sans-serif",
                            weight: '600',
                        },
                        color: '#333',
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12,
                            family: "'Poppins', sans-serif",
                            weight: '400',
                        },
                        color: '#333',
                    },
                    grid: {
                        display: true,
                        color: '#ddd',
                        lineWidth: 1,
                    },
                    categoryPercentage: 0.85,
                    barPercentage: 0.85,
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad',
                        font: {
                            size: 16,
                            family: "'Poppins', sans-serif",
                            weight: '600',
                        },
                        color: '#333',
                    },
                    ticks: {
                        font: {
                            size: 12,
                            family: "'Poppins', sans-serif",
                            weight: '400',
                        },
                        color: '#333',
                    },
                    grid: {
                        display: true,
                        color: '#ddd',
                        lineWidth: 1,
                    },
                },
            },
        },
    });

    function mostrarArriendo() {
        document.getElementById('arriendopromeses').style.display = 'block';
        document.getElementById('garficosArriendo').style.display = 'block';
        document.getElementById('Ventasgrafico').style.display = 'none';
        document.getElementById('ventaspormesgraf').style.display = 'none';
        document.getElementById('veranograficos').style.display = 'none';
        document.getElementById('veranocantidadagrafico').style.display = 'none';
    }
    
    function mostrarVentas() {
        document.getElementById('Ventasgrafico').style.display = 'block';
        document.getElementById('ventaspormesgraf').style.display = 'block';
        document.getElementById('arriendopromeses').style.display = 'none';
        document.getElementById('garficosArriendo').style.display = 'none';
        document.getElementById('veranograficos').style.display = 'none';
        document.getElementById('veranocantidadagrafico').style.display = 'none';
    }
    
    function mostrarVerano() {
        document.getElementById('veranograficos').style.display = 'block';
        document.getElementById('veranocantidadagrafico').style.display = 'block';
        document.getElementById('Ventasgrafico').style.display = 'none';
        document.getElementById('ventaspormesgraf').style.display = 'none';
        document.getElementById('arriendopromeses').style.display = 'none';
        document.getElementById('garficosArriendo').style.display = 'none';
    }

    // Mostrar arriendos por defecto al cargar la página
    window.onload = function() {
        mostrarArriendo();
    };
</script>
@endsection