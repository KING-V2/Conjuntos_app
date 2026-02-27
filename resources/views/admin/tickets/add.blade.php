@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Espacios registrados</h3>
                        </div>
                        <form action="{{ url('/exportar-tickets') }}" method="GET" class="d-inline-flex align-items-end gap-2 mb-3">
                        <select name="mes" class="form-control form-control-sm">
                            <option value="">Todos los meses</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                        <select name="anio" class="form-control form-control-sm">
                            <option value="">Todos los años</option>
                            @for ($y = now()->year; $y >= now()->year - 4; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                        <button type="submit" class="btn btn-success d-flex align-items-center gap-2">
                        <i class="fas fa-file-excel"></i> Reporte Excel
                        </button>
                        </form>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($espacios as $espacio)
                                @php
                                $ticket_activo = $tickets_activos->firstWhere('espacio_id', $espacio->id)
                                @endphp
                                <div class="col-md-2 mb-3" style="text-align: center">
                                    <h5>Espacio: {{$espacio->numero}}</h5>
                                    @if($ticket_activo)
                                    <button class="btn btn-danger btn-ocupado" 
                                    data-ticket-id="{{$ticket_activo->id}}"
                                    data-codigo="{{ $ticket_activo->codigo_ticket }}"
                                    data-cliente="{{ $ticket_activo->cliente->nombres }}"
                                    data-documento="{{ $ticket_activo->cliente->numero_documento }}"
                                    data-placa="{{ $ticket_activo->vehiculo->placa }}"
                                    data-numero-espacio="{{ $ticket_activo->espacio->numero }}"
                                    data-fecha-ingreso="{{ $ticket_activo->fecha_ingreso }}"
                                    data-hora-ingreso="{{ $ticket_activo->hora_ingreso }}"
                                    style="width: 100%; height: 200px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                        <span><p>Placa:</p>{{$ticket_activo->vehiculo?->placa ?? 'Sin placa'}}</span>
                                        <br>
                                        <span><p>Fecha Ingreso:</p>{{$ticket_activo->fecha_ingreso}}</span>
                                        <span>{{$ticket_activo->hora_ingreso}}</span>
                                    </button>
                                    @else
                                        @if ($espacio->estado == 'disponible')
                                        <button class="btn btn-success btn-ticket" data-espacio-id="{{$espacio->id}}" data-numero-espacio="{{$espacio->numero}}"
                                        style="width: 100%; height: 200px">
                                        Disponible
                                        </button>
                                        @endif
                                        @if ($espacio->estado == 'ocupado')
                                        <button class="btn btn-danger" data-espacio-id="{{$espacio->id}}"
                                        style="width: 100%; height: 200px">
                                        Ocupado
                                        </button>
                                        @endif
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal para generar ticket -->
<div class="modal fade" id="modal_ticket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #4DA9F7;color:white">
                <h4 class="modal-title" id="exampleModalLabel">Generar ticket</h4><span id="espacio"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('cargar_tickets',[])}}" method="POST" id="form_ticket">
                    @csrf
                <input type="text" id="espacio_id" name="espacio_id">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label for="form" class="form-label">Seleccionar Vehiculo</label>
                        <select name="vehiculo_id" id="vehiculo_id" class="form-control select2" >
                            <option value="">-- Seleccione --</option>
                            @foreach($vehiculos as $vehiculo)
                                <option value="{{$vehiculo->id}}" > Placa: {{ $vehiculo->placa}} - Cliente: {{ $vehiculo->cliente->nombres}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Seleccionar Tarifa</label>
                        <select name="tarifa_id" id="tarifa_id" class="form-control select2" >
                            <option value="">-- Seleccione --</option>
                            @foreach($tarifas as $tarifa)
                                <option value="{{$tarifa->id}}">{{$tarifa->nombre}} - {{$tarifa->tipo}} - {{$tarifa->costo}} - {{$tarifa->minutos_gavela}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Seleccionar Apartamento</label>
                        <select name="apartamento_id" id="apartamento_id" class="form-control select2" >
                            <option value="">-- Seleccione --</option>
                            @foreach($apartamentos as $apartamento)
                                <option value="{{$apartamento->id}}">{{$apartamento->codigo}} - {{$apartamento->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Seleccionar Casa</label>
                        <select name="casas_id" id="casas_id" class="form-control select2" >
                            <option value="">-- Seleccione --</option>
                            @foreach($casas as $casa)
                                <option value="{{$casa->id}}">{{$casa->codigo}} - {{$casa->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label for="form" class="form-label">Observaciones</label>
                        <textarea name="obs" class="form-control" id="obs" cols="30" rows="2"></textarea>
                    </div>


                    <hr>

                    <button class="btn btn-success" type="submit">Cargar</button>
                </div>
                </form>
            </div>
            <div id="info_vehiculo">
            </div>
        </div>
    </div>
</div>


<!-- Modal para espacio ocupado -->
<div class="modal fade" id="modal_ocupado"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #B35D5D;color: white">
                <h4 class="modal-title" id="exampleModalLabel">Finalizar ticket:</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <h3 style="margin: 5px 0; font-size: 14px; text-align: center">
                            <b>TICKET: </b> <span id="codigo_ticket"></span>
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <b>Datos del cliente:</b> <br>
                    <b>Señor(a):</b> <span id="cliente"></span> <br>
                    <b>Documento:</b> <span id="documento"></span> <br>
                    <b>Placa del vehículo:</b> <span id="placa"></span> <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <b>Espacio nro: </b> <span id="numero_espacio"></span> <br>
                    <b>Fecha de ingreso: </b> <span id="fecha_ingreso"></span><br>
                    <b>Hora de ingreso: </b> <span id="hora_ingreso"></span> <br>
                </div>
            </div>
        </div>
            <div class="modal-body">
               <hr>
               <div class="row">
                    <div class="col-md-12">
                       <a href="#" id="btn_imprimir_ticket" class="btn btn-warning"><i class="fas fa-print"></i>Imprimir</a> 
                    </div>
               </div>
               <br>
               <div class="row">
                    <div class="col-md-12">
                    <a href="#" id="btn_finalizar_ticket" class="btn btn-success"><i class="fas fa-money-bill"></i>Facturar</a> 
                    </div>
               </div>
               <br>
               <form action="" method="post" id="form_cancel_ticket" style="display: inline">
                @csrf
                @method('DELETE')
                <input type="hidden" name="ticket_id" id="ticket_id">
                <button type="button" class="btn btn-danger" id="btn_cancelar_ticket">
                    <i class="fas fa-trash"></i> Cancelar ticket
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .swal2-container {
        z-index: 99999 !important;
    }
</style>

<!-- Modal pdf Ticket -->
<div class="modal fade" id="modal_pdf_ticket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Factura del Ticket</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="pdf_iframe_ticket" src="" width="100%" height="500px"></iframe>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="ticket_id_pdf" value="{{ session('ticket_id') }}">
                <button type="button" id="btn_confirmar_salida" class="btn btn-success">
                    <i class="fas fa-check"></i> Confirmar Salida
                </button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascripts')

@if (session('ticket_id'))
<script>
    $(document).ready(function(){
        var urlParams = new URLSearchParams(window.location.search);
        if (!urlParams.has('solo_salida')) {
            var factura_id = "{{ session('factura_id') }}";
            var urlFactura = "{{ url('factura') }}" + "/" + factura_id; // <- solo esto
            $('#pdf_iframe_ticket').attr('src', urlFactura);
            $('#modal_pdf_ticket').modal('show');
        }
    });
</script>
@endif
<script>

    let ticket_a_imprimir = null;
    $(document).ready(function(){
        $('.select2').select2({
            allowClear: true,
            width: '150%',
            dropdownParent: $('#modal_ticket')
        });

        $('#vehiculo_id').on('change',function(){
            var vehiculo_id = $(this).val();
            if(vehiculo_id){
                $.ajax({
                    url : "{{ url('/tickets_vehiculo')}}/" + vehiculo_id,
                    type : 'GET',
                    success: function(data){
                        $('#info_vehiculo').html(data);
                    },
                    error: function(){
                        $('#info_vehiculo').html('Error al cargar la información')
                    }
                });
            }else{
                alert('Debe seleccionar un vehiculo');
            }
        });

        $('#form_ticket').on('submit', function(event){
            var espacio_id = $('#espacio_id').val();
            var vehiculo_id = $('#vehiculo_id').val();
            var tarifa_id = $('#tarifa_id').val();
            if(!espacio_id || !vehiculo_id || !tarifa_id){
                event.preventDefault();
                alert("Por favor, complete todos los campos");
            }
        });

        $('.btn-ticket').on('click',function(){
            var espacio_id = $(this).data('espacio-id');
            var numero_espacio = $(this).data('numero-espacio');
            $('#espacio_id').val(espacio_id);
            $('#espacio').html(numero_espacio);
            $('#modal_ticket').modal('show');
        });

        $(document).on('click', '#btn_imprimir_ticket', function(event) {
            event.preventDefault();
            var urlImprimir = $(this).attr('href');
            
            // Guardar el ticket_id en el input del modal PDF
            var ticket_id = $('#ticket_id').val();
            $('#ticket_id_pdf').val(ticket_id); // <- agrega esto
            
            $('#modal_ocupado').modal('hide');
            $('#pdf_iframe_ticket').attr('src', urlImprimir);
            $('#modal_pdf_ticket').modal('show');
        });

        $('.btn-ocupado').on('click',function(){
            var ticket_id = $(this).data('ticket-id');
            var urlImprimir = "{{ url('tickets') }}" +"/" + ticket_id +"/imprimir";
            var urlfinalizar_ticket = "{{ url('tickets') }}" +"/" + ticket_id +"/finalizar_ticket";
            var codigo = $(this).data('codigo');
            var cliente = $(this).data('cliente');
            var documento = $(this).data('documento');
            var placa = $(this).data('placa');
            var numero_espacio = $(this).data('numero-espacio');
            var fecha_ingreso = $(this).data('fecha-ingreso');
            var hora_ingreso = $(this).data('hora-ingreso');


            $('#codigo_ticket').html(codigo);
            $('#cliente').html(cliente);
            $('#documento').html(documento);
            $('#placa').html(placa);
            $('#numero_espacio').html(numero_espacio);
            $('#fecha_ingreso').html(fecha_ingreso);
            $('#hora_ingreso').html(hora_ingreso);
            $('#ticket_id').val(ticket_id);
            $('#btn_imprimir_ticket').attr('href', urlImprimir);
            $('#btn_finalizar_ticket').attr('href', urlfinalizar_ticket);
            $('#modal_ocupado').modal('show');
        });

        $(document).on('click', '#btn_cancelar_ticket', function(event) {
            event.preventDefault();
            var ticket_id = $('#ticket_id').val();
            if (ticket_id) {
                Swal.fire({
                    title: '¿Desea eliminar este registro?',
                    text: '',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Eliminar',
                    confirmButtonColor: '#a5161d',
                    denyButtonColor: '#270a0a',
                    denyButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $('#form_cancel_ticket');
                        var url = "{{ url('tickets') }}" + "/" + ticket_id;
                        form.attr('action', url);
                        form.submit();
                    }
                });
            }
        });

        $(document).on('click', '#btn_finalizar_ticket', function(event) {
        event.preventDefault();
        var ticket_id = $('#ticket_id').val();

        Swal.fire({
            title: '¿Desea facturar este ticket?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Facturar',
            confirmButtonColor: '#28a745',
            denyButtonColor: '#6c757d',
            denyButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ url('tickets') }}" + "/" + ticket_id + "/finalizar_ticket";
            }
        });
        });

        $(document).on('click', '#btn_confirmar_salida', function() {
        var ticket_id = $('#ticket_id_pdf').val(); // <- cambia esto
        
        Swal.fire({
            title: '¿Confirmar salida del vehículo?',
            text: 'El espacio quedará disponible',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Confirmar',
            confirmButtonColor: '#28a745',
            denyButtonText: 'Cancelar',
            denyButtonColor: '#6c757d',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ url('tickets') }}" + "/" + ticket_id + "/finalizar_ticket?solo_salida=1";
            }
        });
        });
        
    });
</script>
@endsection