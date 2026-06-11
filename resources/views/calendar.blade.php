@extends('layouts.app')

@section('content')
    <div class="container-fluid overflow-hidden" style="background-color: #FFAB40;">
        <div class="row vh-100 overflow-auto" style="background-color: #FFAB40;">
            @include('layouts.sidebar')

            <div class="col pt-5">
            <div class="d-flex align-items-center justify-content-between">

                <h1 style="color: white;">Calendario de Arriendo de Verano</h1>

                <!-- Botón para abrir el modal de agregar eventos y ver fechas -->
                <div class="d-flex justify-content-end ">
                    <!-- Botón para abrir el modal de agregar eventos -->
                    <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addEventModal">Agregar
                        Arriendo</button>

                    <!-- Botón para ver fechas -->
                    <button class="btn btn-primary" id="verFechasBtn">Ver Fechas</button>
                </div>
            </div>

                <!-- Modal para agregar eventos -->
                <div class="modal fade" id="addEventModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="addEventModalLabel" aria-disabled="true">
                        <div class="modal-dialog modal-lg">
                             <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addEventModalLabel">Agregar Nuevo Arriendo</h5>
                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                        <!-- AREA PARA AGREGAR LO DEL SELEC -->
                                        <div class="modal-body">
                                            <form id="eventForm">
                                                @csrf
                                                <div class="mb-3 row">
                                                    <div class="col-md-6">
                                                    <label class="form-label fw-bold">Propiedad</label>
                                                    <input type="text" class="form-control" 
                                                        value="{{ $propiedadVe->torre }} - #{{ $propiedadVe->num_apartamento }}" 
                                                        readonly style="background:#f8f9fa;">
                                                    <input type="hidden" id="id_verano" name="id_verano" value="{{ $propiedadVe->id }}">
                                                </div>
                                                    <div class="col-4">
                                                        <label for="color" class="form-label">Seleccione un Color</label>
                                                        <input type="color" id="colorPicker" name="colorPicker" class="form-control form-control-color" value="#ff0000"/>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Fecha Inicio</label>
                                                        <input type="date" class="form-control" id="inicio_fecha" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Hora Inicio</label>
                                                        <input type="time" class="form-control" id="inicio_hora" value="14:00" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Fecha Fin</label>
                                                        <input type="date" class="form-control" id="fin_fecha" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Hora Fin</label>
                                                        <input type="time" class="form-control" id="fin_hora" value="12:00" required>
                                                    </div>
                                                    {{-- Campos ocultos que se llenan automáticamente --}}
                                                    <input type="hidden" id="inicio">
                                                    <input type="hidden" id="fin">
                                                </div>
                                                <div class="mb-3 row">
                                                    <!-- Campo Cantidad de Días -->
                                                    <div class="col-lg-4">
                                                        
                                                    <label for="dia" class="form-label">Cantidad de Días</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fa-solid fa-calendar-days"></i>
                                                        </span>
                                                        <input type="number" class="form-control" id="dia" name="dia" min="1" max="1000000" required readonly>
                                                    </div>
                                                </div>

                                                <!-- Campo Monto del Arriendo -->
                                                <div class="col-lg-4">
                                                    <label for="diario" class="form-label">Monto diario</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="number" class="form-control" id="diario" name="diario" min="1000" max="1000000" required>
                                                    </div>
                                                </div>

                                                <!-- Campo Monto del Arriendo -->
                                                <div class="col-lg-4">
                                                    <label for="total" class="form-label">Monto del Arriendo</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="number" class="form-control" id="total" name="total" min="1000" max="1000000" required>
                                                    </div>
                                                </div>
                                            </div>

                                                <!-- Campo 10% del Monto, debajo de Cantidad de Días -->
                                                <div class="mb-3 row">
                                                    <div class="col-6">
                                                        <label for="porcentaje" class="form-label">10% del Monto</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">$</span>
                                                            <input type="number" class="form-control" id="porcentaje" name="porcentaje" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" form="eventForm" class="btn btn-success">Guardar Arriendo</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                <!-- Calendario (FullCalendar) -->
                <div id="calendar" class="w-100 text-uppercase"
                    style="margin: 20px auto; background-color: white; padding: 10px; border-radius: 8px;">
                </div>

                <!-- Modal para mostrar eventos en una fecha específica -->
                <div class="modal fade" id="eventDateModal" tabindex="-1" aria-labelledby="eventDateModalLabel"
                aria-disabled="true" >
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eventDateModalLabel"> Fechas de Arriendo de Verano</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Direccion</th>
                                            <th scope="col">Fecha de Inicio</th>
                                            <th scope="col">Fecha de Fin</th>
                                            <th scope="col">Monto</th>
                                            <th scope="col"> Comision 10%</th>
                                            <th scope="col"> precio por Dia </th>
                                            <th scope="col"> Cantidad De Dia </th>
                                        </tr>
                                    </thead>
                                    <tbody id="eventsOnDate">
                                        <!-- Aquí se mostrarán los eventos de la fecha seleccionada -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de éxito al guardar un evento -->
                <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="successLabel" aria-disabled="true">
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
                                            <p id="texto_success" class="text-uppercase">Datos Guardados con éxito</p>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn-close d-flex justify-content-end"
                                                id="close_success" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                    </div>
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
                            <div class="modal-header alert alert-danger" role="alert" style="border: none;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-2">
                                            <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json" trigger="loop"
                                                delay="2000" style="width:70px;height:70px"></lord-icon>
                                        </div>
                                        <div class="col-8 d-flex justify-content-center align-items-center">
                                            <p id="texto_error" class="text-uppercase text-center m-0">Ha Ocurrido un
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
            @include('layouts.footer')
        </div>
    </div>
    </div>


   <script>
    console.log('Listo para trabajar');

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        // var eventsOnDate = document.getElementById('eventsOnDate');
        // var eventDateModal = new bootstrap.Modal(document.getElementById('eventDateModal'));
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        var modalError = new bootstrap.Modal(document.getElementById('modalError'));

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
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
            },
            eventDisplay: 'block',
            dayMaxEvents: false,
            events: '/calendar/events',
            editable: true,

            eventDrop: function(event){
                // console.log(event);
                var id = event.id;
                var start_date = moment(start).fomart('YYYY-MM-DD');
                var end_date = moment(end).fomart('YYYY-MM-DD');

  
            }

            // dateClick: function (info) {
            //     // console.log();
            //     alert("datos del dia de prueba");
            // }
        });
        calendar.render();

        // Al enviar el formulario
        document.getElementById('eventForm').addEventListener('submit', function(e) {
            e.preventDefault();

            var id_verano = document.getElementById('id_verano').value;
            var inicio = document.getElementById('inicio').value;
            var fin = document.getElementById('fin').value;
            var total = document.getElementById('total').value; // Obtener el monto
            var porcentaje = document.getElementById('porcentaje').value; // Obtener el porcentaje
            var color = document.getElementById('colorPicker').value; // Obtener el color
            var dia = document.getElementById('dia').value; // Obtener el día
            var precio_dia = document.getElementById('diario').value; // Obtener el día

            

            // Enviar los datos del evento, incluyendo el monto
            axios.post('/calendar/events', {
                    id_verano: id_verano,
                    inicio: inicio,
                    fin: fin,
                    total: total,
                    porcentaje: porcentaje,
                    dia: dia,
                    precio_dia: precio_dia,
                })
                .then(function(response) {
                    successModal.show();
                    calendar.refetchEvents();
                    location.reload();
                })
                .catch(function(error) {
                    modalError.show();
                });
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
        function showEventsOnDate(date) {
            axios.get(`/calendar/events?date=${date}`)
                .then(function(response) {
                    eventsOnDate.innerHTML = '';
                    if (response.data.length === 0) {
                        eventsOnDate.innerHTML =
                            '<tr><td colspan="3">No hay eventos en esta fecha.</td></tr>';
                    } else {
                        response.data.forEach(function(event) {
                            var row = `<tr>
                                <td>${event.id_verano}</td>
                                <td>${event.start}</td>
                                <td>${event.end}</td>
                                <td>$${parseInt(event.total, 10).toLocaleString('es-CL')}</td>
                                <td>$${Math.round(event.total * 0.10).toLocaleString('es-CL')}</td> <!-- Sin decimales -->
                                <td>$${parseInt(event.diario * 1).toLocaleString('es-CL')}</td>
                                <td>${event.dia}</td>
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
                const diferencia = (fechaFin - fechaInicio) / (1000 * 3600 * 24); // Diferencia en días

                // Asegurarse de que la diferencia sea al menos 1 día
                if (diferencia >= 0) {
                    document.getElementById('dia').value = Math.ceil(diferencia); // Mostrar en el campo de días
                } else {
                    document.getElementById('dia').value = 1; // Si la fecha de fin es anterior a la de inicio, asigna 1 día
                }
            }
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
                document.getElementById('total').value = total;

                // Calcular el porcentaje (10%)
                const porcentaje = Math.round(total * 0.10); // Redondeado a entero
                document.getElementById('porcentaje').value = porcentaje;
            } else {
                // Si alguno de los valores no es válido, poner los campos en 0
                document.getElementById('total').value = 0;
                document.getElementById('porcentaje').value = '';
            }
        }
    });

    // Combinar fecha y hora al cambiar cualquiera de los 4 campos
    ['inicio_fecha', 'inicio_hora', 'fin_fecha', 'fin_hora'].forEach(function(id) {
        document.getElementById(id).addEventListener('change', function() {
            var fechaInicio = document.getElementById('inicio_fecha').value;
            var horaInicio  = document.getElementById('inicio_hora').value;
            var fechaFin    = document.getElementById('fin_fecha').value;
            var horaFin     = document.getElementById('fin_hora').value;

            if (fechaInicio && horaInicio) {
                document.getElementById('inicio').value = fechaInicio + 'T' + horaInicio;
            }
            if (fechaFin && horaFin) {
                document.getElementById('fin').value = fechaFin + 'T' + horaFin;
            }
            // Recalcular días
            calcularDias();
        });
    });
</script>


@endsection

