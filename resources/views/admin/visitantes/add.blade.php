@extends('layouts.admin')
@section('vendors_css')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Visitantes</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_visitantes',[]) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">tipo documento</label>
                        <select class="form-control" name="tipo_documento" id="tipo_documento">
                            <option value="">-- Seleccione --</option>
                            <option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
                            <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="Registro Civil">Registro Civil</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">documento</label>
                        <input class="form-control filter_text_dropdown" type="text" id="documento" name="documento" placeholder="nombre" value=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">placa</label>
                        <input class="form-control" type="text" id="placa" name="placa" placeholder="nombre" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label for="form" class="form-label">Residente</label>
                        <!-- <select class="select2 form-select form-select-lg" data-allow-clear="true" name="residente_id" id="select2Basic"> -->
                        <select id="select2Basic" class="select2 form-select form-select-lg" data-allow-clear="true" name="residente_id">
                            @foreach( $residentes as $residente )
                                <option value="{{$residente->id }}">{{$residente->usuario->name}} ( {{ $residente->bloque->nombre}} | {{  $residente->apartamento->nombre }} )</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th> Id </th>
                                    <th> nombre </th>
                                    <th> documento </th>
                                    <th> placa </th>
                                    <th> residente </th>
                                    <th> hora ingreso </th>
                                    <th> hora salida </th>
                                    <th> opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $visitantes as $visitante )
                                    <tr>
                                        <td>{{ $visitante->id }}</td>
                                        <td>{{ $visitante->nombre }}</td>
                                        <td>{{ $visitante->documento }}</td>
                                        <td>{{ $visitante->placa ?? 'Sin Vehiculo' }}</td>
                                        <td>{{ $visitante->residente->usuario->name }} ( {{ $visitante->residente->bloque->nombre }} | {{ $visitante->residente->apartamento->nombre }} )</td>
                                        <td>{{ $visitante->hora_ingreso }}</td>
                                        <td>{{ $visitante->hora_salida ?? 'Sin Hora Salida' }}</td>
                                        <td>
                                            <a href="{{ url('visitantes_edit',[ 'id' =>  $visitante->id ]) }}" data-bs-toggle="tooltip" data-bs-offset="0,8" data-bs-placement="top" data-bs-custom-class="tooltip-primary" title="Editar Visitante"  class="btn btn-info"><i class="material-icons-outlined">editar</i></a>
                                            <a href="{{ url('visitantes_delete',[ 'id' =>  $visitante->id ]) }}" data-bs-toggle="tooltip" data-bs-offset="0,8" data-bs-placement="top" data-bs-custom-class="tooltip-primary" title="Eliminar Visitante" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');"><i class="material-icons-outlined">borrar</i></a>
                                            <a href="{{ url('registroSalidaVisitante',[ 'id' =>  $visitante->id ]) }}" data-bs-toggle="tooltip" data-bs-offset="0,8" data-bs-placement="top" data-bs-custom-class="tooltip-primary" title="Registrar Salida Visitante" class="btn btn-success" onclick="return confirm('¿Estás seguro de que deseas registrar salida?');"><i class="fa fa-sign-out"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('vendors_js')
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/js/ui-popover.js') }}"></script>
    
@endsection