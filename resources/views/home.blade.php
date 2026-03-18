@extends('layouts.app')
@section('content')
<div class="container-fluid overflow-hidden" style="background-color: #f5f5f5">
    <div class="row vh-100 overflow-auto" style="background-image: url('/img/home_casa.jpg'); background-size: cover; background-position: center; height: 100vh;">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- Contenido principal -->
        <div class="col-lg-10 d-flex flex-column" style="padding: 0;">
            <div class="flex-grow-1 p-2">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 text-center mb-3">
                            <h6 class="mb-3 text-black text-uppercase">Filtrar Gráficos</h4>
                            <div class="d-flex justify-content-center gap-3 flex-wrap">
                                <a href="#"
                                    class="btn px-4 py-2 shadow-lg rounded-pill d-flex align-items-center"
                                    style="background: linear-gradient(135deg, #D4AF37, #B89B35); color: white; border: none;"
                                    onclick="mostrarArriendo()">
                                    <i class="bi bi-house-fill me-2"></i> Arriendo
                                </a>
                                <a href="#" class="btn px-4 py-2 shadow-lg rounded-pill d-flex align-items-center"
                                    style="background: linear-gradient(135deg, #C0C0C0, #A9A9A9); color: white; border: none;"
                                    onclick="mostrarVentas()">
                                    <i class="bi bi-bar-chart-line-fill me-2"></i> Ventas
                                </a>
                                <a href="#" class="btn px-4 py-2 shadow-lg rounded-pill d-flex align-items-center"
                                    style="background: linear-gradient(135deg, #D4AF37, #B89B35); color: white; border: none;"
                                    onclick="mostrarVerano()">
                                    <i class="bi bi-sun-fill me-2"></i> Verano
                                </a>
                                <a href="#" class="btn btn-info px-4 py-2 shadow-lg rounded-pill d-flex align-items-center"
                                    onclick="mostrarAnuales()">
                                    <i class="bi bi-cash-coin me-2"></i> Anuales
                                </a>
                            </div>
                        </div>

                        <!-- CONTENEDOR DE ARRIENDOS -->
                        <div class="scroll-graficos" style="max-height: 75vh; overflow-y: auto;">
                            <div class="col-lg-12 overflow-auto" id="garficosArriendo" style="display: none;">
                                <div class="card border-0 shadow-lg" style="background: rgba(255, 255, 255, 0.95);">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-12 d-flex justify-content-center mb-4">
                                                    <h3 class="card-title text-center p-3 text-white fw-bold"
                                                        style="background: linear-gradient(135deg, #D4AF37, #B89B35); border-radius: 10px;">
                                                        <i class="bi bi-house-fill me-2"></i>Propiedades arrendadas y retiradas del sistema
                                                    </h3>
                                                </div>

                                                <!-- Estadísticas de Arriendos -->
                                                <div class="row mb-4">
                                                    <!-- Columna izquierda - INGRESOS -->
                                                    <div class="col-lg-6">
                                                        <div class="card mb-3 shadow-sm" style="border-left: 4px solid #28a745;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #f8fff9, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #28a745, #20c997);">
                                                                        <i class="bi bi-house-check-fill fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Total arriendos realizados</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$arriendosPorMes->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card shadow-sm" style="border-left: 4px solid #20c997;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #f8fff9, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #20c997, #17a2b8);">
                                                                        <i class="bi bi-cash-coin fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Valor total ingresado</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">${{ number_format($arriendosPorMes->sum('total_retirado'), 0, '.', '.') }}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Columna derecha - EGRESOS -->
                                                    <div class="col-lg-6">
                                                        <div class="card mb-3 shadow-sm" style="border-left: 4px solid #dc3545;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #fff8f8, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #dc3545, #e83e8c);">
                                                                        <i class="bi bi-house-x-fill fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Total retiradas del sistema</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$retiradosPorMes->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card shadow-sm" style="border-left: 4px solid #e83e8c;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #fff8f8, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #e83e8c, #dc3545);">
                                                                        <i class="bi bi-cash-stack fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Valor total retirado</h6>
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
                                                    $gananciaColor = $gananciasTotales >= 0 ? '#28a745' : '#dc3545';
                                                    $gananciaGradient = $gananciasTotales >= 0 ? 'linear-gradient(135deg, #28a745, #20c997)' : 'linear-gradient(135deg, #dc3545, #e83e8c)';
                                                @endphp

                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="card shadow-sm" style="border-left: 4px solid {{ $gananciaColor }};">
                                                            <div class="card-body" style="background: linear-gradient(to right, {{ $gananciasTotales >= 0 ? '#f8fff9' : '#fff8f8' }}, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: {{ $gananciaGradient }};">
                                                                        <i class="bi bi-graph-up-arrow fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Ganancias totales</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">
                                                                            ${{ number_format($gananciasTotales, 0, '.', '.') }}
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card shadow-sm" style="border-left: 4px solid {{ $gananciaColor }};">
                                                            <div class="card-body" style="background: linear-gradient(to right, {{ $gananciasTotales >= 0 ? '#f8fff9' : '#fff8f8' }}, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: {{ $gananciaGradient }};">
                                                                        <i class="bi bi-percent fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Porcentaje de ganancias</h6>
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
                                                        <div class="card shadow-sm" style="border-left: 4px solid #D4AF37;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #fffdf0, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #D4AF37, #B89B35);">
                                                                        <i class="bi bi-calendar-range fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Propiedades Marzo-Diciembre</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$propiedades->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card shadow-sm" style="border-left: 4px solid #C0C0C0;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #f8f9fa, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #C0C0C0, #A9A9A9);">
                                                                        <i class="bi bi-calendar-fill fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Propiedades año corrido</h6>
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
                                <div class="card w-100 border-0 shadow-lg" style="background: rgba(255, 255, 255, 0.95);">
                                    <div class="card-body" style="overflow-x: auto;">
                                        <h4 class="text-center mb-4 text-dark fw-bold" style="color: #B89B35;">
                                            <i class="bi bi-bar-chart-fill me-2"></i>Arriendos por mes
                                        </h4>
                                        <div style="position: relative; height: 100%; width: 1200px;">
                                            <canvas id="propiedadesPorMesChart" style="width: 200px; min-height: 300px;"></canvas>
                                        </div>
                                    </div>
                                </div>

                            </div>
                             <div class="col-lg-12 mt-3" id="arriendopromeses" style="display: none;">
                                <div class="card w-100">
                                    <div class="card-body" style="overflow-x: auto;">
                                        <div style="position: relative; height: 100%; width: 1200px;"> <!-- Aumenta el ancho del gráfico -->
                                            <canvas id="propiedadesPorMesChart" style="width: 200px; min-height: 300px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- CONTENEDOR DE VENTAS -->
                        <div class="scroll-venta" style="max-height: 75vh; overflow-y: auto;">
                            <div class="col-lg-12" id="Ventasgrafico" style="display: none;">
                                <div class="card border-0 shadow-lg" style="background: rgba(255, 255, 255, 0.95);">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-12 d-flex justify-content-center mb-4">
                                                    <h3 class="card-title text-center p-3 text-white fw-bold"
                                                        style="background: linear-gradient(135deg, #C0C0C0, #A9A9A9); border-radius: 10px;">
                                                        <i class="bi bi-bar-chart-line-fill me-2"></i>Propiedades en ventas y retiradas del sistema
                                                    </h3>
                                                </div>

                                                <!-- Estadísticas de Ventas -->
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="card mb-3 shadow-sm" style="border-left: 4px solid #28a745;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #f8fff9, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #28a745, #20c997);">
                                                                        <i class="bi bi-shop fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Total propiedades en venta</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$ventaPorMes->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card shadow-sm" style="border-left: 4px solid #20c997;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #f8fff9, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #20c997, #17a2b8);">
                                                                        <i class="bi bi-currency-dollar fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Valor total de ventas</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">${{ number_format($precioventa->sum('totalventa'), 0, '.', '.') }}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="card mb-3 shadow-sm" style="border-left: 4px solid #dc3545;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #fff8f8, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #dc3545, #e83e8c);">
                                                                        <i class="bi bi-cart-x-fill fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Propiedades vendidas</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$ventaretiradaPorMes->sum('total')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card shadow-sm" style="border-left: 4px solid #e83e8c;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #fff8f8, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #e83e8c, #dc3545);">
                                                                        <i class="bi bi-cash fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Valor retirado del sistema</h6>
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
                                                    $ventaColor = $gananciaPerdida >= 0 ? '#28a745' : '#dc3545';
                                                    $ventaGradient = $gananciaPerdida >= 0 ? 'linear-gradient(135deg, #28a745, #20c997)' : 'linear-gradient(135deg, #dc3545, #e83e8c)';
                                                @endphp

                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="card shadow-sm" style="border-left: 4px solid {{ $ventaColor }};">
                                                            <div class="card-body" style="background: linear-gradient(to right, {{ $gananciaPerdida >= 0 ? '#f8fff9' : '#fff8f8' }}, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: {{ $ventaGradient }};">
                                                                        <i class="bi bi-graph-up fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Ganancia / Pérdida</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">
                                                                            ${{ number_format($gananciaPerdida, 0, '.', '.') }}
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card shadow-sm" style="border-left: 4px solid {{ $ventaColor }};">
                                                            <div class="card-body" style="background: linear-gradient(to right, {{ $gananciaPerdida >= 0 ? '#f8fff9' : '#fff8f8' }}, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: {{ $ventaGradient }};">
                                                                        <i class="bi bi-percent fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Porcentaje de ganancia</h6>
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
                                                        <div class="card shadow-sm" style="border-left: 4px solid #D4AF37;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #fffdf0, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #D4AF37, #B89B35);">
                                                                        <i class="bi bi-house-add-fill fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Propiedades en venta ingresadas</h6>
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
                                <div class="card border-0 shadow-lg" style="background: rgba(255, 255, 255, 0.95);">
                                    <div class="card-body">
                                        <h4 class="text-center mb-4 text-dark fw-bold" style="color: #A9A9A9;">
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
                                <div class="card border-0 shadow-lg" style="background: rgba(255, 255, 255, 0.95);">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-12 d-flex justify-content-center mb-4">
                                                    <h3 class="card-title text-center p-3 text-white fw-bold"
                                                        style="background: linear-gradient(135deg, #D4AF37, #B89B35); border-radius: 10px;">
                                                        <i class="bi bi-sun-fill me-2"></i>Propiedades de verano y retiradas del sistema
                                                    </h3>
                                                </div>

                                                <!-- Estadísticas de Verano -->
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="card mb-3 shadow-sm" style="border-left: 4px solid #28a745;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #f8fff9, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #28a745, #20c997);">
                                                                        <i class="bi bi-sun fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Propiedades de verano en arriendo</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$verano->sum('total_verano')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card shadow-sm" style="border-left: 4px solid #20c997;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #f8fff9, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #20c997, #17a2b8);">
                                                                        <i class="bi bi-cash-stack fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Valor total arriendo verano</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">${{ number_format($verano->sum('totalverano'), 0, '.', '.') }}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="card mb-3 shadow-sm" style="border-left: 4px solid #dc3545;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #fff8f8, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #dc3545, #e83e8c);">
                                                                        <i class="bi bi-house-door-fill fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Disponibles para arrendar</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">{{$veranoretirado->sum('total_verano')}}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card shadow-sm" style="border-left: 4px solid #e83e8c;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #fff8f8, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #e83e8c, #dc3545);">
                                                                        <i class="bi bi-cash-coin fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Valor retirado del sistema</h6>
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
                                                    $veranoColor = $gananciaPerdida >= 0 ? '#28a745' : '#dc3545';
                                                    $veranoGradient = $gananciaPerdida >= 0 ? 'linear-gradient(135deg, #28a745, #20c997)' : 'linear-gradient(135deg, #dc3545, #e83e8c)';
                                                @endphp

                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="card shadow-sm" style="border-left: 4px solid {{ $veranoColor }};">
                                                            <div class="card-body" style="background: linear-gradient(to right, {{ $gananciaPerdida >= 0 ? '#f8fff9' : '#fff8f8' }}, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: {{ $veranoGradient }};">
                                                                        <i class="bi bi-graph-up-arrow fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Ganancia / Pérdida</h6>
                                                                        <h4 class="mb-0 text-dark fw-bold">
                                                                            ${{ number_format($gananciaPerdida, 0, '.', '.') }}
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card shadow-sm" style="border-left: 4px solid {{ $veranoColor }};">
                                                            <div class="card-body" style="background: linear-gradient(to right, {{ $gananciaPerdida >= 0 ? '#f8fff9' : '#fff8f8' }}, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: {{ $veranoGradient }};">
                                                                        <i class="bi bi-percent fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Porcentaje de ganancia</h6>
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
                                                        <div class="card shadow-sm" style="border-left: 4px solid #D4AF37;">
                                                            <div class="card-body" style="background: linear-gradient(to right, #fffdf0, #ffffff);">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #D4AF37, #B89B35);">
                                                                        <i class="bi bi-house-heart-fill fs-4 text-white"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1" style="color: #495057;">Propiedades de verano ingresadas</h6>
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
                                <div class="card border-0 shadow-lg" style="background: rgba(255, 255, 255, 0.95);">
                                    <div class="card-body">
                                        <h4 class="text-center mb-4 text-dark fw-bold" style="color: #B89B35;">
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

                        <div class="scroll-anual" id="anualesgrafico"  style="display:none;">
                            <!-- Gráfico 5: Anuales -->
                            <div class="row d-flex" >

                                <div class="col-lg-4 mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="text-center"><b>Arriendos anuales</b></h3>
                                            <canvas id="arriendoAnualChart" ></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="text-center"><b>Ventas anuales</b></h3>
                                            <canvas id="ventasAnualChart" ></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="text-center"><b>Verano anuales</b></h3>
                                            <canvas id="veranoAnualChart" ></canvas>
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
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .rounded-circle {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .text-muted {
        font-size: 0.9rem;
        color: #6c757d !important;
    }

    h4.text-dark {
        font-size: 1.5rem;
    }

    h6 {
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
        background: linear-gradient(135deg, #D4AF37, #B89B35);
        border-radius: 10px;
    }

    .scroll-graficos::-webkit-scrollbar-thumb:hover,
    .scroll-venta::-webkit-scrollbar-thumb:hover,
    .scroll-verano::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #B89B35, #9A8230);
    }

    /* Colores corporativos */
    .color-dorado {
        color: #D4AF37;
    }

    .color-dorado-apagado {
        color: #B89B35;
    }

    .color-plateado {
        color: #C0C0C0;
    }

    .color-plateado-apagado {
        color: #A9A9A9;
    }

    .bg-dorado {
        background: linear-gradient(135deg, #D4AF37, #B89B35) !important;
    }

    .bg-plateado {
        background: linear-gradient(135deg, #C0C0C0, #A9A9A9) !important;
    }

    /* Botones mejorados */
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
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

    const labelsArriendosAnio = @json($labelsArriendosAnio ?? []);
    const dataArriendosAnio   = @json($dataArriendosAnio ?? []);

    const labelsVentasAnio = @json($labelsVentasAnio ?? []);
    const dataVentasAnio   = @json($dataVentasAnio ?? []);

    const labelsFinal = labelsArriendosAnio.length ? labelsArriendosAnio : ['2023','2024'];
    const dataFinal   = dataArriendosAnio.length ? dataArriendosAnio : [29,71];

    console.log('cac', @json($labelsVentasAnio), @json($dataVentasAnio));
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

    // Colores corporativos y funcionales
    const colorDorado = '#D4AF37';
    const colorDoradoApagado = '#B89B35';
    const colorPlateado = '#C0C0C0';
    const colorPlateadoApagado = '#A9A9A9';
    const colorVerde = '#28a745';
    const colorVerdeClaro = '#20c997';
    const colorRojo = '#dc3545';
    const colorRojoClaro = '#e83e8c';
    const colorAzul = '#007bff';
    const colorMorado = '#6f42c1';

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

    const ctx3 = document.getElementById('ventasAnualChart');

    new Chart(ctx3, {
        type: 'pie',
        data: {
            labels: labelsVentasAnio,
            datasets: [{
                label: 'Total Ventas por Año',
                data: dataVentasAnio
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let valor = Number(context.raw).toLocaleString('es-CL');
                            return context.label + ': $' + valor;
                        }
                    }
                }
            }
        }
    });

    const ctx2 = document.getElementById('veranoAnualChart');

    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: labelsFinal,
            datasets: [{
                label: 'Total Arriendos por Año',
                data: dataFinal
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let valor = Number(context.raw).toLocaleString('es-CL');
                            return context.label + ': $' + valor;
                        }
                    }
                }
            }
        }
    });
    // Gráfico actualizado
    const ctx = document.getElementById('propiedadesPorMesChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
            data: {
                labels: allmesesLabels,
                datasets: [
                    {
                        label: 'Arriendos Ingresados por Mes',
                        data: arriendoData,
                        backgroundColor: '#198754',
                        borderColor: '#198754',
                        borderWidth: 1,
                        borderRadius: 10,
                        barThickness: 30,
                    },
                    {
                        label: 'Arriendos Retirados por Mes',
                        data: retiroData,
                        backgroundColor: '#dc3545', // Color danger de Bootstrap
                        borderColor: '#dc3545', // Semitransparente para el borde
                        borderWidth: 1,
                        borderRadius: 10,
                        barThickness: 30,

                    },
                                {
                            label: 'Arriendos retirados',
                            data: retiroData,
                            backgroundColor: colorRojo,
                            borderColor: colorRojo,
                            borderWidth: 1,
                            borderRadius: 5,
                            barThickness: 30,
                        },
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Arriendos Por Cada Mes',
                        color: '#333',
                        font: {
                            size: 24,
                            weight: 'bold',
                            family: 'Arial',
                        },

                    }
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
                            },
                            padding: 20,
                        },
                        legend: {
                            display: true,
                            labels: {
                                color: '#555',
                                font: {
                                    size: 14,
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
                                    weight: '600',
                                },
                                color: '#333',
                            },
                            ticks: {
                                maxRotation: 45,
                                minRotation: 45,
                                font: {
                                    size: 12,
                                },
                                color: '#333',
                            },
                            grid: {
                                display: true,
                                color: '#e9ecef',
                                lineWidth: 1,
                            },
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Cantidad',
                                font: {
                                    size: 16,
                                    weight: '600',
                                },
                                color: '#333',
                            },
                            ticks: {
                                font: {
                                    size: 12,
                                },
                                color: '#333',
                            },
                            grid: {
                                display: true,
                                color: '#e9ecef',
                                lineWidth: 1,
                            },
                        },
                    },
                },
            },
    });

    // Combina y normaliza etiquetas para gráfico de valores
    const allLabels = [...new Set([...arriendoMesLabels, ...retiradoMesLabels])];

    // Normaliza datos de arriendos (ingresos - VERDE)
    const normalizedArriendoData = allLabels.map(label => {
        const index = arriendoMesLabels.indexOf(label);
        return index !== -1 ? arriendoMesvalorData[index] : 0;
    });

    // Normaliza datos de retirados (egresos - ROJO)
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

    // Gráfico principal de arriendos (valores)
    new Chart(document.getElementById('arriendosYRetiradosPorMesChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: allLabels,
            datasets: [
                {
                    label: 'Ingresos por arriendos',
                    data: normalizedArriendoData,
                    backgroundColor: colorVerde,
                    borderColor: colorVerde,
                    borderWidth: 2,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Egresos por retiros',
                    data: normalizedRetiradoData,
                    backgroundColor: colorRojo,
                    borderColor: colorRojo,
                    borderWidth: 2,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Ganancias netas',
                    data: gananciasPorMes,
                    backgroundColor: colorDorado,
                    borderColor: colorDoradoApagado,
                    borderWidth: 2,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Pérdidas netas',
                    data: perdidasPorMes,
                    backgroundColor: colorPlateado,
                    borderColor: colorPlateadoApagado,
                    borderWidth: 2,
                    barThickness: 25,
                    borderRadius: 5,
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
                    },
                    color: '#333',
                    padding: 20
                },
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,
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
                            weight: '600'
                        },
                        color: '#333'
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12,
                        },
                        color: '#333'
                    },
                    grid: {
                        display: true,
                        color: '#e9ecef',
                        lineWidth: 1
                    },
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Valores ($)',
                        font: {
                            size: 16,
                            weight: '600'
                        },
                        color: '#333'
                    },
                    ticks: {
                        font: {
                            size: 12,
                        },
                        color: '#333',
                        callback: function(value) {
                            return '$' + value.toLocaleString('es-CL');
                        }
                    },
                    grid: {
                        display: true,
                        color: '#e9ecef',
                        lineWidth: 1
                    }
                }
            }
        }
    });

    // Fusionar todas las etiquetas de meses en una sola lista sin duplicados (VENTAS)
    const allVentasLabels = [...new Set([...ventaMesLabels, ...ventaretiradaPorMesLabels])];

    // Normalizar datos de ventas ingresadas (VERDE)
    const normalizedVentaData = allVentasLabels.map(label => {
        const index = ventaMesLabels.indexOf(label);
        return index !== -1 ? ventarevalorPorMesData[index] : 0;
    });

    // Normalizar datos de ventas retiradas (ROJO)
    const normalizedRetiradoventaData = allVentasLabels.map(label => {
        const index = ventaretiradaPorMesLabels.indexOf(label);
        return index !== -1 ? retiradovalorPorMesData[index] : 0;
    });

    // Calcular diferencia entre ventas ingresadas y retiradas
    const diferenciaVentas = normalizedVentaData.map((venta, index) => venta - normalizedRetiradoventaData[index]);

    // Separar ganancias y pérdidas
    const diferenciaPositiva = diferenciaVentas.map(val => val >= 0 ? val : 0);
    const diferenciaNegativa = diferenciaVentas.map(val => val < 0 ? Math.abs(val) : 0);

    // Gráfico de ventas (valores)
    new Chart(document.getElementById('ventasChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: allVentasLabels,
            datasets: [
                {
                    label: 'Ingresos por ventas',
                    data: normalizedVentaData,
                    backgroundColor: colorVerde,
                    borderColor: colorVerde,
                    borderWidth: 2,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Egresos por retiros',
                    data: normalizedRetiradoventaData,
                    backgroundColor: colorRojo,
                    borderColor: colorRojo,
                    borderWidth: 2,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Ganancias netas',
                    data: diferenciaPositiva,
                    backgroundColor: colorDorado,
                    borderColor: colorDoradoApagado,
                    borderWidth: 2,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Pérdidas netas',
                    data: diferenciaNegativa,
                    backgroundColor: colorPlateado,
                    borderColor: colorPlateadoApagado,
                    borderWidth: 2,
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
                            weight: '600'
                        },
                        color: '#333'
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12,
                        },
                        color: '#333'
                    },
                    grid: {
                        display: true,
                        color: '#e9ecef',
                        lineWidth: 1
                    },
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Valores ($)',
                        font: {
                            size: 16,
                            weight: '600'
                        },
                        color: '#333'
                    },
                    ticks: {
                        font: {
                            size: 12,
                        },
                        color: '#333',
                        callback: function(value) {
                            return '$' + value.toLocaleString('es-CL');
                        }
                    },
                    grid: {
                        display: true,
                        color: '#e9ecef',
                        lineWidth: 1
                    }
                }
            }
        }
    });

    // Combina las etiquetas únicas de ambos conjuntos (VENTAS - cantidad)
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

    // Gráfico de ventas por mes (cantidad)
    const ctxve = document.getElementById('ventaspropiedadesChart').getContext('2d');
    new Chart(ctxve, {
        type: 'bar',
        data: {
            labels: allmesesventaLabels,
            datasets: [
                {
                    label: 'Ventas ingresadas',
                    data: ventaData,
                    backgroundColor: colorVerde,
                    borderColor: colorVerde,
                    borderWidth: 2,
                    borderRadius: 5,
                    barThickness: 30,
                },
                {
                    label: 'Ventas retiradas',
                    data: retiroventaData,
                    backgroundColor: colorRojo,
                    borderColor: colorRojo,
                    borderWidth: 2,
                    borderRadius: 5,
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
                    },
                    padding: 20,
                },
                legend: {
                    display: true,
                    labels: {
                        color: '#555',
                        font: {
                            size: 14,
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
                            weight: '600',
                        },
                        color: '#333',
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12,
                        },
                        color: '#333',
                    },
                    grid: {
                        display: true,
                        color: '#e9ecef',
                        lineWidth: 1,
                    },
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad',
                        font: {
                            size: 16,
                            weight: '600',
                        },
                        color: '#333',
                    },
                    ticks: {
                        font: {
                            size: 12,
                        },
                        color: '#333',
                    },
                    grid: {
                        display: true,
                        color: '#e9ecef',
                        lineWidth: 1,
                    },
                },
            },
        },
    });

    // Combina y normaliza etiquetas de verano
    const allveranoLabels = [...new Set([...veranoMesLabels, ...veranoretiradaPorMesLabels])];

    // Normaliza datos de verano (ingresos - VERDE)
    const normalizedveranoData = allveranoLabels.map(label => {
        const index = veranoMesLabels.indexOf(label);
        return index !== -1 ? veranovalorPorMesData[index] : 0;
    });

    // Normaliza datos de retirados (egresos - ROJO)
    const normalizedRetiradoveranoData = allveranoLabels.map(label => {
        const index = veranoretiradaPorMesLabels.indexOf(label);
        return index !== -1 ? veranoretiradovalorPorMesData[index] : 0;
    });

    // Calcula ganancias/pérdidas para verano
    const gananciasveranoPorMes = normalizedveranoData.map((verano, index) => {
        const diferencia = verano - normalizedRetiradoveranoData[index];
        return diferencia > 0 ? diferencia : 0;
    });
    const perdidasveranoPorMes = normalizedveranoData.map((verano, index) => {
        const diferencia = verano - normalizedRetiradoveranoData[index];
        return diferencia < 0 ? Math.abs(diferencia) : 0;
    });

    // Gráfico de verano (valores)
    new Chart(document.getElementById('veranoChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: allveranoLabels,
            datasets: [
                {
                    label: 'Ingresos por verano',
                    data: normalizedveranoData,
                    backgroundColor: colorVerde,
                    borderColor: colorVerde,
                    borderWidth: 2,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Egresos por retiros',
                    data: normalizedRetiradoveranoData,
                    backgroundColor: colorRojo,
                    borderColor: colorRojo,
                    borderWidth: 2,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Ganancias netas',
                    data: gananciasveranoPorMes,
                    backgroundColor: colorDorado,
                    borderColor: colorDoradoApagado,
                    borderWidth: 2,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Pérdidas netas',
                    data: perdidasveranoPorMes,
                    backgroundColor: colorPlateado,
                    borderColor: colorPlateadoApagado,
                    borderWidth: 2,
                    barThickness: 25,
                    borderRadius: 5,
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
                    },
                    color: '#333',
                    padding: 20
                },
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,
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
                            weight: '600'
                        },
                        color: '#333'
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12,
                        },
                        color: '#333'
                    },
                    grid: {
                        display: true,
                        color: '#e9ecef',
                        lineWidth: 1
                    },
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Valores ($)',
                        font: {
                            size: 16,
                            weight: '600'
                        },
                        color: '#333'
                    },
                    ticks: {
                        font: {
                            size: 12,
                        },
                        color: '#333',
                        callback: function(value) {
                            return '$' + value.toLocaleString('es-CL');
                        }
                    },
                    grid: {
                        display: true,
                        color: '#e9ecef',
                        lineWidth: 1
                    }
                }
            }
        }
    });

    // Combina las etiquetas únicas de ambos conjuntos (VERANO - cantidad)
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

    // Gráfico actualizado
    const ctxanual = document.getElementById('arriendoAnualChart').getContext('2d');
    new Chart(ctxanual, {
        type: 'pie',
        data: {
            labels: labelsFinal,
            datasets: [{
                label: 'Total Arriendos por Año',
                data: dataFinal
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let valor = Number(context.raw).toLocaleString('es-CL');
                            return context.label + ': $' + valor;
                        }
                    }
                }
            }
        }
    });

    // Gráfico actualizado
    const ctxverano = document.getElementById('veranocantidadChart').getContext('2d');

    new Chart(ctxverano, {
        type: 'bar',
        data: {
            labels: allmesesveranoLabels,
            datasets: [
                {
                    label: 'Arriendos Ingresados por Mes',
                    data: veranoData,
                    backgroundColor: '#198754',
                    borderColor: '#198754',
                    borderWidth: 1,
                    borderRadius: 10,
                    barThickness: 30,
                },
                {
                    label: 'Arriendos Retirados por Mes',
                    data: veranoretiroData,
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545',
                    borderWidth: 1,
                    borderRadius: 10,
                    barThickness: 30,
                }
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
                    },
                    padding: 20,
                },
                legend: {
                    display: true,
                    labels: {
                        color: '#555',
                        font: {
                            size: 14,
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
                            weight: '600',
                        },
                        color: '#333',
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12,
                        },
                        color: '#333',
                    },
                    grid: {
                        display: true,
                        color: '#e9ecef',
                        lineWidth: 1,
                    },
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad',
                        font: {
                            size: 16,
                            weight: '600',
                        },
                        color: '#333',
                    },
                    ticks: {
                        font: {
                            size: 12,
                        },
                        color: '#333',
                    },
                    grid: {
                        display: true,
                        color: '#e9ecef',
                        lineWidth: 1,
                    },
                },
            },
        }
    });

    // Funciones para mostrar/ocultar secciones
    function mostrarArriendo() {
        document.getElementById('arriendopromeses').style.display = 'block';
        document.getElementById('garficosArriendo').style.display = 'block';
        document.getElementById('Ventasgrafico').style.display = 'none';
        document.getElementById('ventaspormesgraf').style.display = 'none';
        document.getElementById('veranograficos').style.display = 'none';
        document.getElementById('veranocantidadagrafico').style.display = 'none';
        document.getElementById('anualesgrafico').style.display = 'none';
    }

    function mostrarVentas() {
        document.getElementById('Ventasgrafico').style.display = 'block';
        document.getElementById('ventaspormesgraf').style.display = 'block';
        document.getElementById('arriendopromeses').style.display = 'none';
        document.getElementById('garficosArriendo').style.display = 'none';
        document.getElementById('veranograficos').style.display = 'none';
        document.getElementById('veranocantidadagrafico').style.display = 'none';
        document.getElementById('anualesgrafico').style.display = 'none';
    }
    function mostrarVerano() {
        document.getElementById('veranograficos').style.display = 'block';
        document.getElementById('veranocantidadagrafico').style.display = 'block';
        document.getElementById('Ventasgrafico').style.display = 'none';
        document.getElementById('ventaspormesgraf').style.display = 'none';
        document.getElementById('arriendopromeses').style.display = 'none';
        document.getElementById('garficosArriendo').style.display = 'none';
        document.getElementById('anualesgrafico').style.display = 'none';

    }

    function mostrarAnuales() {
        document.getElementById('veranograficos').style.display = 'none';
        document.getElementById('veranocantidadagrafico').style.display = 'none';
        document.getElementById('Ventasgrafico').style.display = 'none';
        document.getElementById('ventaspormesgraf').style.display = 'none';
        document.getElementById('arriendopromeses').style.display = 'none';
        document.getElementById('garficosArriendo').style.display = 'none';
        document.getElementById('anualesgrafico').style.display = 'block';
    }

</script>
@endsection
