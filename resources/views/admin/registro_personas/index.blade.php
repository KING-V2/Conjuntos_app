@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="card text-center mb-3">
        <h5 class="card-header">📋 Registro de Personas</h5>
        <div class="card-body">
            <form action="{{ url('registro_personas_store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-2">
                    <div class="col-md-3">
                        <label>Documento</label>
                        <input type="text" name="documento" id="documento" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label>Foto</label>
                        <div class="input-group">
                            <input type="file" name="foto" id="foto" class="form-control">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCamara">
                                📷 Tomar foto
                            </button>
                        </div>
                        <input type="hidden" name="foto_base64" id="foto_base64">
                        <img id="previewCaptura" class="img-thumbnail mt-2" style="display:none; max-height:150px;">
                    </div>
                    <div class="col-md-3 mt-2">
                        <label>Casa</label>
                        <select name="casa_id" id="casa_id" class="form-control" required>
                            <option value="">Seleccione</option>
                            @foreach($casas as $casa)
                                <option value="{{ $casa->id }}">{{ $casa->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ url('registro_personas') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
        <hr>
        <div class="card-header border-bottom">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                @foreach($meses as $mes)
                    <li class="nav-item">
                        <button type="button"
                            class="nav-link {{ $loop->index == 0 ? 'active' : '' }}"
                            data-bs-toggle="tab"
                            data-bs-target="#tab-{{ strtolower($mes) }}">
                            {{ $mes }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="tab-content p-3">
            @foreach($meses as $mes_actual)
                <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}"
                     id="tab-{{ strtolower($mes_actual) }}">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle tabla-mes" data-mes="{{ $mes_actual }}">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Mes</th>
                                    <th>Foto</th>
                                    <th>Casa</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
    <!-- Modal Cámara -->
    <div class="modal fade" id="modalCamara" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tomar foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">

                <!-- Selector de cámara -->
                <div class="mb-3">
                <button class="btn btn-secondary" id="btnFrontal">Cámara frontal</button>
                <button class="btn btn-secondary" id="btnTrasera">Cámara trasera</button>
                </div>

                <!-- Cámara -->
                <div id="camera" style="width:100%; height:300px;"></div>

                <!-- Vista previa -->
                <div id="resultado" class="mt-3"></div>
            </div>

            <div class="modal-footer">
                <button id="btnTomarFoto" class="btn btn-success">Capturar</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>

            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <!-- Datatables CSS/JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <!-- Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <!-- JSZip para Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // === SELECTORES DEL FORMULARIO ===
    const inputDocumento = document.getElementById('documento');
    const inputNombre = document.getElementById('nombre');
    const selectCasa = document.getElementById('casa_id');

    // =====================================================
    // AUTOCOMPLETE POR DOCUMENTO
    // =====================================================
    inputDocumento.addEventListener('keyup', function () {

        let documento = this.value.trim();
        if (documento.length < 3) return;

        fetch('/buscar_persona/' + documento)
            .then(res => res.json())
            .then(data => {

                if (!data.found) {
                    inputNombre.value = '';
                    selectCasa.value = '';
                    return;
                }

                // LLENAR NOMBRE Y CASA AUTOMÁTICAMENTE
                inputNombre.value = data.nombre;

                if (data.casa_id) {
                    selectCasa.value = data.casa_id;
                }

            })
            .catch(err => console.error('Error en buscar_persona:', err));
    });

    // =====================================================
    //  DATATABLES PARA CADA MES
    // =====================================================
    const tablas = document.querySelectorAll('.tabla-mes');

    tablas.forEach(function (tabla) {

        let mesActual = tabla.getAttribute('data-mes');

        $(tabla).DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('registro-personas.buscar') }}",
                data: function (d) {
                    d.mes = mesActual;
                    d.casa_id = $('#casa_id').val(); // filtro opcional
                }
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'Registros_' + mesActual,
                    text: 'Exportar Excel',
                    className: 'btn btn-success btn-sm'
                }
            ],
            columns: [
                { data: 'nombre' },
                { data: 'documento' },
                { data: 'mes' },
                { data: 'foto', orderable: false, searchable: false },
                { data: 'casas' },
                { data: 'acciones', orderable: false, searchable: false }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json"
            },
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100]
        });
    });

});
</script>
<script>
    let facingMode = "user"; // por defecto: frontal

    function iniciarCamara() {
        Webcam.reset("#camera");

        Webcam.set({
            width: 480,
            height: 360,
            image_format: 'jpeg',
            jpeg_quality: 90,
            constraints: {
                facingMode: facingMode
            }
        });

        Webcam.attach('#camera');
    }

    document.getElementById("btnFrontal").onclick = function(){
        facingMode = "user";
        iniciarCamara();
    };

    document.getElementById("btnTrasera").onclick = function(){
        facingMode = { exact: "environment" };
        iniciarCamara();
    };

    document.getElementById("btnTomarFoto").onclick = function(){
        Webcam.snap(function(data_uri){

            // Mostrar previa
            document.getElementById('resultado').innerHTML =
                '<img src="'+data_uri+'" class="img-thumbnail" style="max-height:200px;">';

            // Guardar en input oculto
            document.getElementById('foto_base64').value = data_uri;

            // Mostrar preview en formulario
            document.getElementById('previewCaptura').src = data_uri;
            document.getElementById('previewCaptura').style.display = "block";

            // Cerrar modal
            var modal = bootstrap.Modal.getInstance(document.getElementById('modalCamara'));
            modal.hide();
        });
    };

    // Inicializar cámara al abrir modal
    document.getElementById('modalCamara').addEventListener('shown.bs.modal', iniciarCamara);

    // Apagar cámara al cerrar
    document.getElementById('modalCamara').addEventListener('hidden.bs.modal', function(){
        Webcam.reset();
    });
</script>

@endsection
