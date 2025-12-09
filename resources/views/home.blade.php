@extends('layouts.app')
@section('content')
<div class="container-fluid overflow-hidden" style="background-color: rgb(224, 218, 218)">
    <div class="row vh-100 overflow-auto" style="background-image: url('/img/home_casa.jpg'); background-size: cover; background-position: center; height: 100vh;">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- Contenido principal -->
        <div class="col-lg-10 d-flex flex-column" style="padding: 0;">
            <div class="flex-grow-1 p-2">
                <!-- <h2 class="text-white text-uppercase mt-3 mb-3 text-center">Gráficos de Ganancias y Pérdidas</h2> -->
                <!-- Contenedor de gráficos -->
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 text-center mb-3">
                            <h6 class="mb-3 text-black text-uppercase">Filtrar Gráficos</h4>
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
                        <!-- <div class="col-lg-3 bg-white rounded-pill shadow p-3 d-flex align-items-center m-1">
                            <img src="img/propiedadicono.png" alt="Propiedades" style="width: 35px; height: 35px; margin-right: 10px;">
                            <h6 class=" text-black text-uppercase m-0">
                                Prop. de Marzo a Diciembre: {{$propiedadesPorMes->sum('total')}}
                            </h6>
                        </div> -->

                        <!-- <div class="col-lg-3">
                            <h6 class="shadow text-center bg-white rounded-pill p-3 text-black text-uppercase">
                                
                                </spam>
                            </h6>
                        </div> -->
                        <!-- <div class="col-lg-2 bg-white rounded-pill shadow p-3 d-flex align-items-center m-1">
                            <img src="img/venta.png" alt="Propiedades" style="width: 35px; height: 35px; margin-right: 10px;">
                            <h6 class="text-black text-uppercase m-0">
                                Prop. en Venta: {{$ventaPorMes->sum('total')}}
                            </h6>
                        </div> -->
                        <!-- <div class="col-lg-3">
                            <h6 class="shadow text-center bg-white rounded-pill p-3 text-black text-uppercase">Prop. en Venta: 
                                {{$ventaPorMes->sum('total')}}
                                </spam>
                            </h6>
                        </div> -->
                        <!-- <div class="col-lg-2 bg-white rounded-pill shadow p-3 d-flex align-items-center m-1">
                            <img src="img/verano.png" alt="Propiedades" style="width: 35px; height: 35px; margin-right: 10px;">
                            <h6 class="text-black text-uppercase m-0">
                                Prop. de Verano: {{$verano->sum('total_verano')}}
                            </h6>
                        </div>
                        <div class="col-lg-3 bg-white rounded-pill shadow p-3 d-flex align-items-center m-1">
                            <img src="img/ingenieria.png" alt="Propiedades" style="width: 35px; height: 35px; margin-right: 10px;">
                            <h6 class="text-black text-uppercase m-0">
                                Prop. de Año Corrido: {{$propiedadescorridoPorMes->sum('total')}}
                            </h6>
                        </div> -->
                        <!-- <div class="col-lg-3">
                            <h6 class="shadow text-center bg-white rounded-pill p-3 text-black text-uppercase">Prop. de Verano: 
                                {{$veranoPropiedad->sum('total')}}
                                </spam>
                            </h6>
                        </div> -->
                        <!-- Gráfico 3: Arriendos por Mes -->
                        <div class="scroll-graficos" style="max-height: 75vh; overflow-y: auto;">
                            <div class="col-lg-12  overflow-auto 50vh" id="garficosArriendo" style="display: none;">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-12 d-flex justify-content-center">
                                                    <h3 class="card-title text-center bg-black rounded p-2 text-white text-uppercase">Propiedades Arrendadas y Retiradas del Sistema</h3>
                                                </div>

                                                <div class="col-lg-6">
                                                    <h5 class="text-center bg-secondary rounded p-2 text-uppercase text-white rounded-pill">Total Arriendos Realizados: {{$arriendosPorMes->sum('total')}}</h5>
                                                    <h5 class="text-center bg-secondary rounded p-2 text-uppercase text-white rounded-pill">Valor Total de  Arriendos Ingresados: {{ number_format($arriendosPorMes->sum('total_retirado'), 0, '.', '.') }}</h5>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="text-center bg-secondary rounded p-2 text-uppercase text-white rounded-pill">Total Retiradas del Sistema: {{$retiradosPorMes->sum('total')}}</h5>
                                                    <h5 class="text-center bg-secondary rounded p-2 text-uppercase text-white rounded-pill">Valor Total de Retiradas del sistema: {{ number_format($retiradosPorMes->sum('total_retirado'), 0, '.', '.') }}</h5>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    @php
                                                    $valorTotalArriendos = $arriendosPorMes->sum('total_retirado');
                                                    $valorTotalRetiradas = $retiradosPorMes->sum('total_retirado');
                                                    $gananciasTotales = $valorTotalArriendos - $valorTotalRetiradas;
                                                    $porcentajeGanancias = $valorTotalArriendos > 0 ? ($gananciasTotales / $valorTotalArriendos) * 100 : 0;
                                                    @endphp
                                                    
                                                    <h5 class="text-center bg-secondary rounded p-2 text-uppercase text-white rounded-pill">
                                                        Ganancias Totales: {{ number_format($gananciasTotales, 0, '.', '.') }}
                                                    </h5>
                                                    <h5 class="text-center bg-secondary rounded p-2 text-uppercase text-white rounded-pill">
                                                        Porcentaje de Ganancias Totales: {{ number_format($porcentajeGanancias, 2, '.', '') }}%
                                                    </h5>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h6 class=" text-white bg-secondary text-uppercase p-2 rounded-pill text-center">
                                                        Propiedades de Marzo a Diciembre Ingresadas: {{$propiedades->sum('total')}}
                                                    </h6>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h6 class=" text-white bg-secondary text-uppercase p-2 rounded-pill text-center">
                                                        Propiedades Año Corrido Ingresadas: {{$propiedadesC->sum('total')}}
                                                    </h6>
                                                </div>
                                                
                                                <!-- Se ajusta el tamaño del canvas -->
                                                <div class="col-lg-12 mt-3" style="overflow-x: auto;">
                                                    <div style="position: relative; height: 100%; width: 1200px;"> <!-- Aumenta el ancho del gráfico -->
                                                        <canvas id="arriendosYRetiradosPorMesChart" style="width: 200px; min-height: 400px;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
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


                        <!-- Gráfico 2: Ventas por Mes -->
                        <div class="scroll-venta" style="max-height: 75vh; overflow-y: auto;">

                            <div class="col-lg-12" id="Ventasgrafico" style="display: none;">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row text-uppercase">
                                                <div class="col-lg-12 d-flex justify-content-center">
                                                    <h3 class="card-title text-center bg-black rounded p-2 text-white text-uppercase">Propiedades en ventas y retiradas del sistema</h5>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="p-2 rounded bg-secondary text-center text-white rounded-pill">Propiedades totales en Venta {{$ventaPorMes->sum('total')}}</h5>
                                                    <h5 class="p-2 rounded bg-secondary text-center text-white rounded-pill">Valor Total de las Ventas {{ number_format($precioventa->sum('totalventa'), 0, '.', '.') }}</h5>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="p-2 rounded bg-secondary text-center text-white rounded-pill">Propiedades totales Vendidas {{$ventaretiradaPorMes->sum('total')}}</h5>
                                                    <h5 class="p-2 rounded bg-secondary text-center text-white rounded-pill">Valor Total de las Retiradas del sistema {{ number_format($precioventaretirada->sum('totalventa'), 0, '.', '.') }}</h5>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    @php
                                                        $totalVentas = $precioventa->sum('totalventa');
                                                        $totalRetiradas = $precioventaretirada->sum('totalventa');
                                                        $gananciaPerdida = $totalVentas - $totalRetiradas;
                                                        $porcentajeGanancia = $totalVentas > 0 ? ($gananciaPerdida / $totalVentas) * 100 : 0;
                                                    @endphp

                                                    <h5 class="p-2 rounded bg-secondary text-center text-white rounded-pill">
                                                        Ganancia/Pérdida: {{ number_format($gananciaPerdida, 0, '.', '.') }}
                                                    </h5>
                                                    <h5 class="p-2 rounded bg-secondary text-center text-white rounded-pill">
                                                        Porcentaje de Ganancia: {{ number_format($porcentajeGanancia, 2, '.', '.') }}%
                                                    </h5>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h6 class="shadow text-center bg-secondary rounded-pill p-2 text-white text-uppercase">Propiedades en Venta Ingresadas: 
                                                        {{$ventaPorMes->sum('total')}}
                                                        </spam>
                                                    </h6>
                                                </div>
                                                <div class="col-lg-6">

                                                </div>
                                                <div class="col-lg-12" style="overflow-x: auto;">
                                                    <div style="position: relative; height: 100%; width: 1200px;"> <!-- Aumenta el ancho del gráfico -->
                                                        <canvas id="ventasChart" style="width: 200px; min-height: 300px;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Gráfico 4: Propiedades de Verano -->
                            <div class="col-lg-12 mt-3" id="ventaspormesgraf" style="display: none;">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="text-center"><b>Ventas Por Cada Mes</b></h4>
                                        <!-- <canvas id="ventaspropiedadesChart"></canvas> -->
                                        <div class="col-lg-12" style="overflow-x: auto;">
                                            <div style="position: relative; height: 100%; width: 1200px;"> <!-- Aumenta el ancho del gráfico -->
                                                <canvas id="ventaspropiedadesChart" style="width: 200px; min-height: 300px;"></canvas>
                                            </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="scroll-verano" style="max-height: 75vh; overflow-y: auto;">
                            <div class="col-lg-12" id="veranograficos" style="display:none;">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row text-uppercase">
                                                <div class="col-lg-12 d-flex justify-content-center">
                                                    <h3 class="card-title text-center bg-black rounded p-2 text-white text-uppercase">Propiedades de verano y retiradas del sistema</h5>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="p-2 rounded bg-secondary text-center text-white rounded-pill">Propiedades de verano en Arriendo {{$verano->sum('total_verano')}}</h5>
                                                    <h5 class="p-2 rounded bg-secondary text-center text-white rounded-pill">Valor Total de los arriendo de verano ${{ number_format($verano->sum('totalverano'), 0, '.', '.') }}</h5>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="p-2 rounded bg-secondary text-center text-white rounded-pill">Propiedades Disponible para arrendar {{$veranoretirado->sum('total_verano')}}</h5>
                                                    <h5 class="p-2 rounded bg-secondary text-center text-white rounded-pill">Valor Total de las Retiradas del sistema ${{ number_format($veranoretirado->sum('totalverano'), 0, '.', '.') }}</h5>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    @php
                                                        $totalVentas = $verano->sum('totalverano');
                                                        $totalRetiradas = $veranoretirado->sum('totalverano');
                                                        $gananciaPerdida = $totalVentas - $totalRetiradas;
                                                        $porcentajeGanancia = $totalVentas > 0 ? ($gananciaPerdida / $totalVentas) * 100 : 0;
                                                    @endphp

                                                    <h5 class="p-2 rounded bg-secondary text-center text-white rounded-pill">
                                                        Ganancia/Pérdida: {{ number_format($gananciaPerdida, 0, '.', '.') }}
                                                    </h5>
                                                    <h5 class="p-2 rounded bg-secondary text-center text-white rounded-pill">
                                                        Porcentaje de Ganancia: {{ number_format($porcentajeGanancia, 2, '.', '.') }}%
                                                    </h5>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h6 class="shadow text-center bg-secondary rounded-pill p-2 text-white text-uppercase">Propiedades de Verano Ingresadas: 
                                                        {{$veranoPropiedad->sum('total')}}
                                                        </spam>
                                                    </h6>
                                                </div>
                                                <div class="col-lg-12" style="overflow-x: auto;">
                                                    <div style="position: relative; height: 100%; width: 1200px;"> <!-- Aumenta el ancho del gráfico -->
                                                        <canvas id="veranoChart" style="width: 200px; min-height: 300px;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Gráfico 4: Propiedades de Verano -->
                            <div class="col-lg-12 mt-3" id="veranocantidadagrafico" style="display:none ;">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="text-center"><b>Arriendos de Verano Por Cada Mes</b></h3>
                                        <!-- <canvas id="ventaspropiedadesChart"></canvas> -->
                                        <div class="col-lg-12" style="overflow-x: auto;">
                                            <div style="position: relative; height: 100%; width: 1200px;"> <!-- Aumenta el ancho del gráfico -->
                                                <canvas id="veranocantidadChart" style="width: 200px; min-height: 300px;"></canvas>
                                            </div>
                                        </div>
                                        <!--  -->
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
        ],
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
                        size: 22,
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
        return diferencia > 0 ? diferencia : 0; // Solo calcula ganancias
    });
    const perdidasPorMes = normalizedArriendoData.map((arriendo, index) => {
        const diferencia = arriendo - normalizedRetiradoData[index];
        return diferencia < 0 ? Math.abs(diferencia) : 0; // Solo calcula pérdidas
    });



    new Chart(document.getElementById('arriendosYRetiradosPorMesChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: allLabels,
            datasets: [
                {
                    label: 'Valor de Arriendos',
                    data: normalizedArriendoData,
                    backgroundColor: '#198754', // Un verde más suave y sutil
                    borderColor: '#198754',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5, // Bordes redondeados
                    hoverBorderWidth: 2
                },
                {
                    label: 'Retirados por Mes',
                    data: normalizedRetiradoData,
                    backgroundColor: '#dc3545', // Rojo más suave
                    borderColor: '#dc3545',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Ganancias por Mes',
                    data: gananciasPorMes,
                    backgroundColor: 'rgba(38, 38, 255)', // Azul suave
                    borderColor: 'rgb(0, 0, 150)',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                    hoverBorderColor: 'rgb(0, 0, 120)',
                    hoverBorderWidth: 2
                },{
                    label: 'Pérdidas por Mes',
                    data: perdidasPorMes,
                    backgroundColor: 'rgba(132, 0, 255)', // Azul suave
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
                    text: 'Análisis de Arriendos y Retirados por Cada Mes',
                    font: {
                        size: 24,
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
                        text: 'Cantidad/Valores ($)',
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

// Crear gráfico
new Chart(document.getElementById('ventasChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: allVentasLabels,
        datasets: [
            {
                label: 'Ventas Ingresadas',
                data: normalizedVentaData,
                backgroundColor: '#198754', // Verde
                borderColor: '#198754',
                borderWidth: 1,
                barThickness: 25,
                borderRadius: 5,

            },
            {
                label: 'Ventas Retiradas',
                data: normalizedRetiradoventaData,
                backgroundColor: '#dc3545', // Rojo
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
            legend: { position: 'top' },
            title: {
                display: true,
                text: 'Análisis de Ventas por Mes'
            }
        },
        scales: {
            y: {
                beginAtZero: true
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

// Rellena los datos de arriendos con 0 donde no existan
const ventaData = allmesesventaLabels.map(label => {
    const index = ventaMesLabels.indexOf(label);
    return index !== -1 ? ventaPorMesData[index] : 0;
});

// Rellena los datos de retiros con 0 donde no existan
const retiroventaData = allmesesventaLabels.map(label => {
    const index = ventaretiradaPorMesLabels.indexOf(label);
    return index !== -1 ? ventaretiradaPorMesPorMesData[index] : 0;
});

// Gráfico actualizado
const ctxve = document.getElementById('ventaspropiedadesChart').getContext('2d');

new Chart(ctxve, {
    type: 'bar',
    data: {
        labels: allmesesventaLabels,
        datasets: [
            {
                label: 'Ventas Ingresadas por Mes',
                data: ventaData,
                backgroundColor: '#198754',
                borderColor: '#198754',
                borderWidth: 1,
                borderRadius: 10,
                barThickness: 30,
            },
            {
                label: 'Ventas Retiradas por Mes',
                data: retiroventaData,
                backgroundColor: '#dc3545', // Color danger de Bootstrap
                borderColor: '#dc3545', // Semitransparente para el borde
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
                color: '#333',
                font: {
                    size: 24,
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
                        size: 22,
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
        return diferencia > 0 ? diferencia : 0; // Solo calcula ganancias
    });
    const perdidasveranoPorMes = normalizedveranoData.map((verano, index) => {
        const diferencia = verano - normalizedRetiradoveranoData[index];
        return diferencia < 0 ? Math.abs(diferencia) : 0; // Solo calcula pérdidas
    });



    new Chart(document.getElementById('veranoChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: allveranoLabels,
            datasets: [
                {
                    label: 'Valor de Verano',
                    data: normalizedveranoData,
                    backgroundColor: '#198754', // Un verde más suave y sutil
                    borderColor: '#198754',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5, // Bordes redondeados
                    hoverBorderWidth: 2
                },
                {
                    label: 'Retirados por Mes',
                    data: normalizedRetiradoveranoData,
                    backgroundColor: '#dc3545', // Rojo más suave
                    borderColor: '#dc3545',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                },
                {
                    label: 'Ganancias por Mes',
                    data: gananciasveranoPorMes,
                    backgroundColor: 'rgba(38, 38, 255)', // Azul suave
                    borderColor: 'rgb(0, 0, 150)',
                    borderWidth: 1,
                    barThickness: 25,
                    borderRadius: 5,
                    hoverBorderColor: 'rgb(0, 0, 120)',
                    hoverBorderWidth: 2
                },{
                    label: 'Pérdidas por Mes',
                    data: perdidasveranoPorMes,
                    backgroundColor: 'rgba(132, 0, 255)', // Azul suave
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
                    text: 'Análisis de Verano y Retirados por Cada Mes',
                    font: {
                        size: 24,
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
                        text: 'Cantidad/Valores ($)',
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
// console.log(veranoPorMesData, veranoretiroData);

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
                backgroundColor: '#dc3545', // Color danger de Bootstrap
                borderColor: '#dc3545', // Semitransparente para el borde
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
                color: '#333',
                font: {
                    size: 24,
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
                        size: 22,
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





</script>
@endsection
