@extends('layouts.app')

@section('content')
<div class="container-fluid overflow-hidden px-0" style="background-color: #f5f5f5;">
    <div class="row vh-100 g-0" style="background-image: url('/img/home_casa.jpg'); background-size: cover; background-position: center;">
        
        @include('layouts.sidebar')

        <div class="col overflow-auto vh-100 py-4 px-4">
            
            <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
    
                <button class="pla-toggle active rounded-pill px-3" style="border: 2px solid #0d6efd; color: #000000;">
                    <i class="fa-solid fa-key me-2" style="color: #0d6efd;"></i>Adm.
                </button>
                
                <button class="pla-toggle rounded-pill px-3" style="border: 2px solid #ea0e0e; color: #000000;">
                    <i class="fa-solid fa-house me-2" style="color: #ea0e0e;"></i>Arriend.
                </button>
                
                <button class="pla-toggle rounded-pill px-3" style="border: 2px solid #d9b215; color: #000000;">
                    <i class="fa-solid fa-dollar-sign me-2" style="color: #d9b215;"></i>Ventas
                </button>
                
                <button class="pla-toggle rounded-pill px-3" style="border: 2px solid #fd7e14; color: #000000;">
                    <i class="fa-solid fa-helmet-safety me-2" style="color: #fd7e14;"></i>Obras
                </button>
                
                <button class="pla-toggle rounded-pill px-3" style="border: 2px solid #198754; color: #000000;">
                    <i class="fa-solid fa-money-bill-wave me-2" style="color: #198754;"></i>Sueldos
                </button>
                
                <button class="pla-toggle rounded-pill px-3" style="border: 2px solid #8b0ef2; color: #000000;">
                    <i class="fa-solid fa-percent me-2" style="color: #8b0ef2;"></i>Arqueo
                </button>

            </div>

           <div class="row">
                <div class="col-md-6">
                    
                    <div class="card border-0 p-3 text-start h-100 pla-card-propietarios">
                        
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="pla-icon-container">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div>
                                <div class="pla-cell-title text-dark fw-700">Listado de Propietarios</div>
                                <div class="pla-cell-sub text-muted">Ordenado alfabéticamente</div>
                            </div>
                        </div>

                        <div class="pla-doc-list propietarios-scroll">
                            
                            <div class="pla-doc-item justify-content-between align-items-center py-2 px-1 propietario-item">
                                <span class="fw-600 text-dark propietario-name">
                                    <i class="fa-regular fa-circle-user me-2 text-muted"></i>Alejandro Vargas M.
                                </span>
                                <a href="#" class="badge rounded-pill text-decoration-none btn-hoja-vida">
                                    Hoja de Vida
                                </a>
                            </div>

                            <div class="pla-doc-item justify-content-between align-items-center py-2 px-1 propietario-item">
                                <span class="fw-600 text-dark propietario-name">
                                    <i class="fa-regular fa-circle-user me-2 text-muted"></i>Carlos Fuentes Q.
                                </span>
                                <a href="#" class="badge rounded-pill text-decoration-none btn-hoja-vida">
                                    Hoja de Vida
                                </a>
                            </div>

                            <div class="pla-doc-item justify-content-between align-items-center py-2 px-1 propietario-item">
                                <span class="fw-600 text-dark propietario-name">
                                    <i class="fa-regular fa-circle-user me-2 text-muted"></i>Daniela Soto L.
                                </span>
                                <a href="#" class="badge rounded-pill text-decoration-none btn-hoja-vida">
                                    Hoja de Vida
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
@endsection

@section('css')
@parent
<style>
   /* ─── Card de Propietarios con Borde y Sombra Naranja Izquierda ─── */
    .pla-card-propietarios {
        background: #ffffff; 
        border-radius: 16px; 
        border-left: 5px solid #E67E22 !important; 
        box-shadow: -6px 4px 18px rgba(230, 126, 34, 0.2), 0 4px 12px rgba(0,0,0,0.03);
    }

    /* Contenedor del Icono de Perfil Naranja */
    .pla-icon-container {
        background: #E67E22; 
        width: 40px; 
        height: 40px; 
        border-radius: 10px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 1.1rem; 
        color: #fff; 
        flex-shrink: 0;
    }

    /* Ajustes de Texto Generales */
    .pla-card-propietarios .pla-cell-title {
        font-size: 1.05rem; 
        line-height: 1.2;
    }

    .pla-card-propietarios .pla-cell-sub {
        font-size: .75rem; 
        margin-top: 1px;
    }

    /* Scroll Controlado para la lista */
    .propietarios-scroll {
        max-height: 220px; 
        overflow-y: auto; 
        scrollbar-width: thin;
    }

    /* Items de Propietarios */
    .propietario-item {
        border-bottom: 1px solid #f0ede8;
    }

    .propietario-name {
        font-size: .88rem;
    }

    .propietario-name i {
        font-size: .95rem;
    }

    /* Badge / Botón Naranja de Hoja de Vida */
    .btn-hoja-vida {
        background: #E67E22; 
        color: #fff; 
        font-size: .7rem; 
        padding: 5px 10px;
        transition: background 0.2s ease;
    }

    .btn-hoja-vida:hover {
        background: #d35400;
        color: #fff;
    }
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
