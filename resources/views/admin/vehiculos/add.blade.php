@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Cargue vehiculo</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_vehiculos',[]) }}">
                {{ csrf_field() }}
                <div class="row">
                     <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">placa</label>
                        <input class="form-control" type="text" id="placa" name="placa" placeholder="placa" value="" autofocus/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">tipo Vehiculo</label>
                        <select class="form-control" name="tipo_vehiculo" id="tipo_vehiculo" required>
                            <option value="">-- Seleccione --</option>
                            <option value="Carro">Carro</option>
                            <option value="Moto">Moto</option>
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
                                    <th> tipo vehiculo </th>
                                    <th> opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $vehiculos as $vehiculo )
                                    <tr>
                                        <td>{{ $vehiculo->id }}</td>
                                        <td>{{ $vehiculo->placa }}</td>
                                        <td>{{ $vehiculo->tipo_vehiculo }}</td>
                                        <td>
                                            <a href="{{ url('vehiculos_edit',[ 'id' =>  $vehiculo->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                            <!-- <a href="{{ url('vehiculos_delete',[ 'id' =>  $vehiculo->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este parqueadero?');"><i class="material-icons-outlined">borrar</i></a> -->
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