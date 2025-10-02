@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Modificar Residente: <strong> {{ $residente->usuario->name }} </strong></h5>
        <div class="card-body">
            <form method="post" action="{{ url('residentes_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="residente_id" name="residente_id" placeholder="residente_id" value="{{ $residente->id }}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Casa</label>
                        <select class="form-control" name="casa_id" id="casa_id">
                            @foreach( $casas as $casa )
                                <option value="{{$casa->id }}" {{ $residente->casas->id == $casa->id ? 'selected' : ''}} >{{$casa->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Activo" {{ $residente->estado == 'Activo' ? 'selected' : ''}} >Activo</option>
                            <option value="No Activo" {{ $residente->estado == 'No Activo' ? 'selected' : ''}} >No Activo</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Tipo Residente</label>
                        <select class="form-control" name="tipo_residente" id="tipo_residente">
                            <option value="">-- Seleccione --</option>
                                <option value="Propietario" {{ $residente->tipo_residente == 'Propietario' ? 'selected' : ''}} >Propietario</option>
                                <option value="Arrendatario" {{ $residente->tipo_residente == 'Arrendatario' ? 'selected' : ''}} >Arrendatario</option>
                        </select>
                    </div>
                </div>
                <hr>
                <h3>Parqueaderos</h3>
                <div class="col-md-12">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th> Id </th>
                                    <th> casa </th>
                                    <th> residente </th>
                                    <th> vehiculo </th>
                                    <th> tipo vehiculo </th>
                                    <th> parqueadero </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $registro_parqueaderos as $registro )
                                    <tr>
                                        <td>{{ $registro->id }}</td>
                                        <td>{{ $registro->residente->casas->nombre ?? '-' }}</td>
                                        <td>{{ $registro->residente->usuario->name ?? '-' }}</td>
                                        <td>{{ $registro->vehiculo->placa ?? '-' }}</td>
                                        <td>{{ $registro->vehiculo->tipo_vehiculo ?? '-' }}</td>
                                        <td>{{ $registro->parqueadero->nombre ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Actualizar</button>
            </form>
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

    <script src="{{ asset('assets/js/residentes/residentes.js') }}"></script>
@endsection