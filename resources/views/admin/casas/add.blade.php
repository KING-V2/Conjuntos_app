@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Lista casas</h1>
        <div class="card-body">
            <div class="col-md-12">
                <div class="card">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
                            <div class="tab-content">
                                @foreach($casas as $casa)
                                    <div class="card text-center mb-3">
                                        <div class="card-header border-bottom">
                                            <h5 class="card-title">{{ $casa->nombre }}</h5>
                                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <button
                                                        type="button"
                                                        class="nav-link active"
                                                        role="tab"
                                                        data-bs-toggle="tab"
                                                        data-bs-target="#navs-tab-propietario-{{$casa->id}}"
                                                        aria-controls="navs-tab-propietario-{{$casa->id}}"
                                                        aria-selected="false">
                                                        Propietario
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button
                                                        type="button"
                                                        class="nav-link"
                                                        role="tab"
                                                        data-bs-toggle="tab"
                                                        data-bs-target="#navs-tab-arrendatario-{{$casa->id}}"
                                                        aria-controls="navs-tab-arrendatario-{{$casa->id}}"
                                                        aria-selected="true">
                                                        Arrendatario
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade" id="navs-tab-arrendatario-{{$casa->id}}" role="tabpanel">
                                                @if( $residentes->where('casa_id' , $casa->id )->where('tipo_residente' , 'Arrendatario') )
                                                    @foreach( $residentes->where('casa_id' , $casa->id )->where('tipo_residente' , 'Arrendatario') as $residente )
                                                        <h5 class="card-title">{{ $residente->usuario->name }}</h5>
                                                        @if ( $residente->estado == 'Activo' )
                                                            <p class="card-text" style="color: green;">Estado: {{ $residente->estado }}</p>
                                                        @else
                                                            <p class="card-text" style="color: red;">Estado: {{ $residente->estado }}</p>
                                                        @endif
                                                        <hr>
                                                    @endforeach
                                                @else
                                                    <h3>Sin Arrendatarios</h3>
                                                @endif
                                                <button 
                                                    class="btn btn-primary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalResidente" 
                                                    data-conjunto_id="{{ $conjunto->id }}"
                                                    data-casa_id="{{ $casa->id }}"
                                                    data-tipo_residente="Arrendatario">
                                                    Agregar Arrendatario
                                                </button>
                                            </div>
                                            <div class="tab-pane fade show active" id="navs-tab-propietario-{{$casa->id}}" role="tabpanel">
                                                @if( $residentes->where('casa_id' , $casa->id )->where('tipo_residente' , 'Propietario') )
                                                    @foreach( $residentes->where('casa_id' , $casa->id )->where('tipo_residente' , 'Propietario') as $residente )
                                                        <h5 class="card-title">{{ $residente->usuario->name }}</h5>
                                                        @if ( $residente->estado == 'Activo' )
                                                            <p class="card-text" style="color: green;">Estado: {{ $residente->estado }}</p>
                                                        @else
                                                            <p class="card-text" style="color: red;">Estado: {{ $residente->estado }}</p>
                                                        @endif
                                                        <hr>
                                                    @endforeach
                                                @else
                                                    <h3>Sin Propietario</h3>
                                                @endif
                                                <button 
                                                    class="btn btn-primary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalResidente" 
                                                    data-conjunto_id="{{ $conjunto->id }}"
                                                    data-casa_id="{{ $casa->id }}"
                                                    data-tipo_residente="Propietario">
                                                    Agregar Propietario
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalResidente" tabindex="-1" aria-labelledby="modalResidenteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalResidenteLabel">Enviar datos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modalForm">
                    @csrf
                    <input type="hidden" name="modal_casa_id" id="modal_casa_id">
                    <input type="hidden" name="modal_conjunto_id" id="modal_conjunto_id">
                    <input type="hidden" name="modal_estado" id="modal_estado" value="Activo">
                    <input type="hidden" name="modal_tipo_residente" id="modal_tipo_residente">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="form" class="form-label">Residente</label>
                        <select class="form-control" name="modal_usuario_id" id="modal_usuario_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $usuarios as $usuario )
                                <option value="{{$usuario->id }}">{{$usuario->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <!-- <p>Los valores se enviarán vía AJAX al cerrar la modal.</p> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="sendData">Enviar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <script src="{{ asset('assets/js/audios/configs.js') }}"></script>
    <script src="{{ asset('assets/js/tables-datatables-basic.js') }}"></script>

    <script src="{{ asset('assets/js/archivos/archivos.js') }}"></script>
    <script>
        // Asignar valores al abrir la modal
        const exampleModal = document.getElementById('modalResidente');
        exampleModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Botón que activó la modal
            // Obtener valores de los atributos data- del botón
            const conjuntoId    = button.getAttribute('data-conjunto_id');
            const casaId      = button.getAttribute('data-casa_id');
            const tipoResidente = button.getAttribute('data-tipo_residente');

            // Asignar valores a los inputs ocultos
            document.getElementById('modal_conjunto_id').value = conjuntoId;
            document.getElementById('modal_casa_id').value = casaId;
            document.getElementById('modal_estado').value = 'Activo';
            document.getElementById('modal_tipo_residente').value = tipoResidente;
        });

        // Enviar datos vía AJAX
        document.getElementById('sendData').addEventListener('click', function () {
            const formData = $('#modalForm').serialize(); // Serializar datos del formulario
            $.ajax({
                url: '/registrarResidente', // Cambia esto a tu endpoint real
                method: 'POST',
                data: formData,
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function (error) {
                    alert(response.message);
                    location.reload();
                }
            });
        });
    </script>
@endsection