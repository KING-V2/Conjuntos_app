@extends('layouts.admin')
@section('aditional_styles')
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Listado Correspondencia</h5>
        <hr>
        <div class="card-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <button class="ml-3 btn btn-danger" onclick="recepcionServiciosConjuntos('Luz');">Servicios de Luz</button>
                    </div>
                    <div class="col-md-3">
                        <button class="ml-3 btn btn-info" onclick="recepcionServiciosConjuntos('Agua');">Servicios de Agua</button>
                    </div>
                    <div class="col-md-3">
                        <button class="ml-3 btn btn-success" onclick="recepcionServiciosConjuntos('Gas');">Servicios de Gas</button>
                    </div>
                </div>
                <br>
                <div class="card-datatable table-responsive pt-0">
                    <table class="table table-bordered" style="overflow-x: auto; font-size: 18px;">
                        <thead>
                            <tr>
                                <th> Id </th>
                                <th> casa </th>
                                <th> luz </th>
                                <th> agua </th>
                                <th> gas </th>
                                <th> mensajes </th>
                                <th> paquetes </th>
                                <th> Reiniciar </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $correspondencias as $correspondencia )
                                <tr style="text-align: center;">
                                    <td> {{ $correspondencia->id }}</td>
                                    <td> {{ $correspondencia->casa->nombre }}</td>
                                    <!-- <td style="width: 120px;" > {{ $correspondencia->luz }} <br> <i style="color: green; fonts-size: 20px;" class="fa-solid fa-circle-plus" onClick="sumarElemento( {{$correspondencia->id}} , 'luz')"></i> | <i style="color: red; fonts-size: 20px;" class="fa-solid fa-circle-minus" onClick="restarElemento( {{$correspondencia->id}} , 'luz')"></i> </td> -->
                                    <td style="width: 120px;">
                                        <span id="valor-{{$correspondencia->id}}-luz">{{ $correspondencia->luz }}</span> 
                                        <br>
                                        <i style="color: green; font-size: 20px;" class="fa-solid fa-circle-plus" onClick="sumarElemento({{$correspondencia->id}}, 'luz')"></i> | 
                                        <i style="color: red; font-size: 20px;" class="fa-solid fa-circle-minus" onClick="restarElemento({{$correspondencia->id}}, 'luz')"></i>
                                    </td>
                                    <td style="width: 120px;"> 
                                        <span id="valor-{{$correspondencia->id}}-agua">{{ $correspondencia->agua }}</span>
                                        <br> 
                                        <i style="color: green; fonts-size: 20px;" class="fa-solid fa-circle-plus" onClick="sumarElemento( {{$correspondencia->id}} , 'agua')"></i> | 
                                        <i style="color: red; fonts-size: 20px;" class="fa-solid fa-circle-minus" onClick="restarElemento( {{$correspondencia->id}} , 'agua')"></i> 
                                    </td>
                                    <td style="width: 120px;"> 
                                        <span id="valor-{{$correspondencia->id}}-gas">{{ $correspondencia->gas }}</span>
                                        <br> 
                                        <i style="color: green; fonts-size: 20px;" class="fa-solid fa-circle-plus" onClick="sumarElemento( {{$correspondencia->id}} , 'gas')"></i> | 
                                        <i style="color: red; fonts-size: 20px;" class="fa-solid fa-circle-minus" onClick="restarElemento( {{$correspondencia->id}} , 'gas')"></i> 
                                    </td>
                                    <td style="width: 120px;"> 
                                        <span id="valor-{{$correspondencia->id}}-mensajes">{{ $correspondencia->mensajes }}</span>
                                        <br> 
                                        <i style="color: green; fonts-size: 20px;" class="fa-solid fa-circle-plus" onClick="sumarElemento( {{$correspondencia->id}} , 'mensajes')"></i> | 
                                        <i style="color: red; fonts-size: 20px;" class="fa-solid fa-circle-minus" onClick="restarElemento( {{$correspondencia->id}} , 'mensajes')"></i> 
                                    </td>
                                    <td style="width: 120px;"> 
                                        <span id="valor-{{$correspondencia->id}}-paquetes">{{ $correspondencia->paquetes }}</span>
                                        <br> 
                                        <i style="color: green; fonts-size: 20px;" class="fa-solid fa-circle-plus" onClick="sumarElemento( {{$correspondencia->id}} , 'paquetes')"></i> | 
                                        <i style="color: red; fonts-size: 20px;" class="fa-solid fa-circle-minus" onClick="restarElemento( {{$correspondencia->id}} , 'paquetes')"></i> 
                                    </td>
                                    <td> <i style="color: red; fonts-size: 25px;" class="fa-solid fa-circle-minus" onClick="reiniciarElemento( {{$correspondencia->id}} )"> </i> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> 
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/correspondencia/correspondencia.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                "responsive": true,
                "autoWidth": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                }
            });
        });
        
    </script>
@endsection