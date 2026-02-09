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
                        <div class="card-body">
                            <div class="row">
                                @foreach ($espacios as $espacio)
                                @php
                                $ticket_activo = $tickets_activos->firstWhere('espacio_id', $espacio->id)
                                @endphp
                                <div class="col-md-2 mb-3" style="text-align: center">
                                    <h5>Espacio: {{$espacio->numero}}</h5>
                                    @if($ticket_activo)
                                        <button class="btn btn-danger btn-ocupado" data-ticket-id="{{$ticket_activo->id}}"
                                        style="width: 100%; height: 200px">
                                        <small>{{$ticket_activo->vehiculo?->placa ?? 'Sin placa'}}</small>
                                        <small>{{$ticket_activo->fecha_ingreso}}</small>
                                        <small>{{$ticket_activo->hora_ingreso}}</small>
                                        </button>
                                    @else
                                        @if ($espacio->estado == 'disponible')
                                        <button class="btn btn-success btn-ticket" data-espacio-id="{{$espacio->id}}" data-numero-espacio="{{$espacio->numero}}"
                                        style="width: 100%; height: 200px">
                                        Disponible
                                        </button>
                                        @endif

                                        @if ($espacio->estado == 'reservado')
                                        <button class="btn btn-warning btn-reservado" data-espacio-id="{{$espacio->id}}"
                                        style="width: 100%; height: 200px">
                                        Reservado
                                        </button>
                                        @endif
                                        @if ($espacio->estado == 'ocupado')
                                        <button class="btn btn-danger" data-espacio-id="{{$espacio->id}}"
                                        style="width: 100%; height: 200px">
                                        OcupadoV2
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
                    <div class="col-sm-12 col-md-4">
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


<!-- Modal para espacio en reserva -->
<div class="modal fade" id="modal_reservado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFB92E;color:white">
                <h4 class="modal-title" id="exampleModalLabel">Estado del sitio:</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Espacio reservado: Es inaccesible ahora mismo</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal para espacio ocupado -->
<div class="modal fade" id="modal_ocupado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #B35D5D;color: white">
                <h4 class="modal-title" id="exampleModalLabel">Finalizar ticket:</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <hr>
               <div class="row">
                    <div class="col-md-12">
                       <a href="#" id="btn_imprimir_ticket" class="btn  btn-warning"><i class="fas fa-print"></i>Imprimir</a> 
                    </div>
               </div> 
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascripts')
<script>

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
                    $('#info_vehiculo').html('Error al cargart la información')

                }
            });
        }else{
            alert('Debe seleccionar un vehiculo');
        }
        });

    });


    $('#form_ticket').on('submit', function(event){
        var espacio_id = $('#espacio_id').val();
        var vehiculo_id = $('#vehiculo_id').val()
        var tarifa_id = $('#tarifa_id').val()
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

    $('.btn-reservado').on('click',function(){
        $('#modal_reservado').modal('show');
    });

    $('.btn-ocupado').on('click',function(){
        var ticket_id = $(this).data('ticket-id');
        var urlImprimir = "{{url('/tickets/')}}"+"/" + ticket_id+"/imprimir";
        $('#btn_imprimir_ticket').attr('href', urlImprimir);
        $('#modal_ocupado').modal('show');
    });
</script>
@endsection