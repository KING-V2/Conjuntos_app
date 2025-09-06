@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Encuestas</h1>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_encuestas',[]) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Mes</label>
                        <select class="form-control" name="mes" id="mes">
                            <option value="">-- Seleccione --</option>
                            <option value="Enero">Enero</option>
                            <option value="Febrero">Febrero</option>
                            <option value="Marzo">Marzo</option>
                            <option value="Abril">Abril</option>
                            <option value="Mayo">Mayo</option>
                            <option value="Junio">Junio</option>
                            <option value="Julio">Julio</option>
                            <option value="Agosto">Agosto</option>
                            <option value="Septiembre">Septiembre</option>
                            <option value="Octubre">Octubre</option>
                            <option value="Noviembre">Noviembre</option>
                            <option value="Diciembre">Diciembre</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Opciones</label>
                        <select class="form-control" name="opciones" id="opciones">
                            <option value="">-- Seleccione --</option>
                            <option value="Si/No">Si/No</option>
                            <option value="Acuerdo/Desacuerdo">Acuerdo/Desacuerdo</option>
                            <option value="Nivel de Satisfaccion">Nivel de Satisfaccion</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Activo" selected>Activo</option>
                            <option value="No Activo">No Activo</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Tipo Residente</label>
                        <select class="form-control" name="tipo_residente" id="tipo_residente">
                            <option value="">-- Seleccione --</option>
                            <option value="Arrendatario" selected>Arrendatario</option>
                            <option value="Propietario">Propietario</option>
                            <option value="Ambos">Ambos</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <textarea class="form-control" rows="3" type="text" id="descripcion" name="descripcion" placeholder="descripcion encuesta"></textarea>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card text-center mb-3">
                    <div class="card-header border-bottom">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            @foreach($meses as $mes)
                                <li class="nav-item">
                                    <button type="button" class="nav-link {{ $loop->index == 0 ? 'active' : ''}}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-{{strtolower($mes)}}" aria-controls="navs-tab-{{strtolower($mes)}}" aria-selected="true">{{$mes}}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content">
                        @foreach($meses as $mes_actual)
                            <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}" id="navs-tab-{{ strtolower($mes_actual)}}" role="tabpanel">
                                <div class="card-datatable table-responsive pt-0">
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Id </th>
                                                <th> Mes </th>
                                                <th> Descripcion </th>
                                                <th> Estado </th>
                                                <th> Tipo residente </th>
                                                <th> Respuestas </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $encuestas->where('mes',$mes_actual) as $encuesta )
                                                <tr>
                                                    <td>{{ $encuesta->id }}</td>
                                                    <td>{{ $encuesta->mes }}</td>
                                                    <td><p>{{$encuesta->descripcion }}</p></td>
                                                    <td>{{ $encuesta->estado }}</td>
                                                    <td>{{ $encuesta->tipo_residente }}</td>
                                                    <td>{{ $encuesta->opciones }}</td>
                                                    <td>
                                                        <div class="col-md-12"><a href="{{ url('encuestas_edit',[ 'id' =>  $encuesta->id ]) }}" class="btn btn-info form-control mb-2"><i class="material-icons-outlined">editar</i></a></div>
                                                        <!-- <div class="col-md-12"><a href="{{ url('encuestas_delete',[ 'id' =>  $encuesta->id ]) }}" class="btn btn-danger form-control mb-2" onclick="return confirm('¿Estás seguro de que deseas eliminar esta encuesta?');"><i class="material-icons-outlined">borrar</i></a></div> -->
                                                        <div class="col-md-12"><a class="btn btn-success form-control" data-bs-toggle="modal" data-bs-target="#resultadoModal" onclick="mostrarEstadisticas({{ $encuesta->id }});"><i class="material-icons-outlined">Ver</i></a></div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para mostrar los resultados de la encuesta -->
<div class="modal fade" id="modalEstadisticas" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Título de la Encuesta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modalFecha">Fecha de creación: </p>
                <canvas id="pieChart" width="400" height="400"></canvas>

                <!-- Contenedor para mostrar los totales de respuestas -->
                <div id="totalesRespuestas" class="mt-3">
                    <!-- Aquí se insertarán los totales de respuestas -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('vendors_js')
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/charts-chartjs.js') }}"></script>
    <script>
        function mostrarEstadisticas(encuestaId) {
            // Llamada a la API para obtener los datos de estadísticas
            fetch(`/api/estadisticaEncuestasWeb/${encuestaId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al cargar los datos de la encuesta.');
                    }
                    return response.json();
                })
                .then(data => {
                    // Título de la encuesta
                    const modalTitle = document.getElementById('modalTitle');
                    modalTitle.textContent = data.titulo;

                    // Fecha de creación
                    const modalFecha = document.getElementById('modalFecha');
                    modalFecha.textContent = `Fecha de creación: ${data.fecha_creacion}`;



                    // Configuración de datos para el gráfico
                    const chartLabels = data.respuestas.map(item => item.respuesta);
                    const chartData = data.respuestas.map(item => item.total_respuestas);
                    const chartColors = [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                    ];

                    // Actualización del gráfico
                    const ctx = document.getElementById('pieChart').getContext('2d');
                    if (window.myChart) {
                        window.myChart.destroy(); // Eliminar gráfico existente
                    }
                    window.myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: chartLabels,
                            datasets: [{
                                data: chartData,
                                backgroundColor: chartColors,
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            return `${label}: ${value} respuestas`;
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // Mostrar los totales de respuestas debajo del gráfico
                    const totalesContainer = document.getElementById('totalesRespuestas');
                    totalesContainer.innerHTML = ''; // Limpiar el contenedor de respuestas previas
                    let totalRespuestas = 0;
                    data.respuestas.forEach((item, index) => {
                        const respuestaElement = document.createElement('p');
                        totalRespuestas += item.total_respuestas; // Sumar las respuestas totales
                        
                        // Crear un contenedor para la viñeta y el texto
                        const respuestaRow = document.createElement('div');
                        respuestaRow.classList.add('d-flex', 'align-items-center');
                        
                        // Crear la viñeta (círculo)
                        const viñeta = document.createElement('span');
                        viñeta.style.width = '15px';
                        viñeta.style.height = '15px';
                        viñeta.style.borderRadius = '50%';
                        viñeta.style.backgroundColor = chartColors[index]; // Asignar color correspondiente
                        viñeta.style.marginRight = '10px';
                        
                        // Añadir la viñeta y el texto
                        respuestaRow.appendChild(viñeta);
                        respuestaElement.textContent = `${item.respuesta}: ${item.total_respuestas} respuestas`;
                        respuestaRow.appendChild(respuestaElement);
                        
                        // Añadir al contenedor
                        totalesContainer.appendChild(respuestaRow);
                    });
                    const totalElement = document.createElement('p');
                    totalElement.textContent = `Total Respuestas: ${totalRespuestas}`;
                    totalElement.style.fontWeight = 'bold'; // Hacerlo más destacado
                    totalesContainer.appendChild(totalElement);

                    // Mostrar la modal
                    $('#modalEstadisticas').modal('show');
                })
                .catch(error => {
                    console.error('Error al mostrar las estadísticas:', error);
                    alert('No se pudieron cargar las estadísticas de la encuesta.');
                });
        }

    </script>
@endsection
