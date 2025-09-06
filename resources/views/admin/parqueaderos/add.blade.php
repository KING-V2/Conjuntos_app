@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Cargue Parqueadero</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_parqueaderos',[]) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Residente</label>
                        <select class="form-control" name="usuario_id" id="usuario_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $usuarios as $usuario )
                                <option value="{{$usuario->usuario->id }}">{{$usuario->usuario->name}} - {{ $usuario->bloque->nombre}} - {{ $usuario->apartamento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Asignado">Asignado</option>
                            <option value="Ocupado">Ocupado</option>
                            <option value="Disponible">Disponible</option>
                            <option value="Visitantes">Visitantes</option>
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
                                    <th> estado </th>
                                    <th> nombre </th>
                                    <th> bloque </th>
                                    <th> apartamento </th>
                                    <th> propietario </th>
                                    <th> opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $parqueaderos as $parqueadero )
                                    <tr>
                                        <td>{{ $parqueadero->id }}</td>
                                        <td>{{ $parqueadero->nombre }}</td>
                                        <td>{{ $parqueadero->estado }}</td>
                                        <td>{{ $parqueadero->usuario ? $parqueadero->usuario->name : 'Libre' }}</td>
                                        <td>{{ $parqueadero->residente?->bloque?->nombre ?? 'Sin bloque' }}</td>
                                        <td>{{ $parqueadero->residente?->apartamento?->nombre ?? 'Sin apartamento' }}</td>
                                        <td>
                                            <a href="{{ url('parqueaderos_edit',[ 'id' =>  $parqueadero->id ]) }}" class="btn btn-info"><i class="material-icons-outlined">edit</i></a>
                                            <!-- <a href="{{ url('parqueaderos_delete',[ 'id' =>  $parqueadero->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este parqueadero?');"><i class="material-icons-outlined">delete</i></a> -->
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