@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Cargue Parqueadero</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_registro_parqueaderos',[]) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Casas</label>
                        <select class="form-control" name="casa_id" id="casa_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $casas as $casa )
                                <option value="{{$casa->id }}">{{$casa->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Parqueadero</label>
                        <select class="form-control" name="parqueadero_id" id="parqueadero_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $parqueaderos as $parqueadero )
                                <option value="{{$parqueadero->id }}">{{$parqueadero->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Vehiculo</label>
                        <select class="form-control" name="vehiculo_id" id="vehiculo_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $vehiculos as $vehiculo )
                                <option value="{{$vehiculo->id }}">{{$vehiculo->placa}} / {{ $vehiculo->tipo_vehiculo}}</option>
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
                                    <th> casa </th>
                                    <th> residente </th>
                                    <th> vehiculo </th>
                                    <th> tipo vehiculo </th>
                                    <th> parqueadero </th>
                                    <th> opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $registros as $registro )
                                    <tr>
                                        <td>{{ $registro->id }}</td>
                                        <td>{{ $registro->casas->nombre ?? 'Libre' }}</td>
                                        <td>{{ $registro->residente->usuario->name ?? 'Libre' }}</td>
                                        <td>{{ $registro->vehiculo->placa ?? 'Sin vehiculo' }}</td>
                                        <td>{{ $registro->vehiculo->tipo_vehiculo ?? 'Sin tipo' }}</td>
                                        <td>{{ $registro->parqueadero->nombre ?? 'Sin parqueadero' }}</td>
                                        <td>
                                            <a href="{{ url('registro_parqueaderos_edit',[ 'id' =>  $registro->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                            <!-- <a href="{{ url('parqueaderos_delete',[ 'id' =>  $registro->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este parqueadero?');"><i class="material-icons-outlined">borrar</i></a> -->
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