@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Lista Parqueadero</h5>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Ingreso vehiculo</h5>
                        <div class="card-body">
                            <form method="post" action="{{ url('cargar_parqueadero_visitante',[]) }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <label for="form" class="form-label">placa</label>
                                        <input class="form-control" type="text" id="placa" name="placa" placeholder="nombre" value=""/>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="form" class="form-label">Tipo</label>
                                        <select class="form-control" name="categoria_id" id="categoria_id">
                                            <option value="">-- Seleccione --</option>
                                            @foreach( $categorias as $categoria )
                                                <option value="{{$categoria->id }}">{{$categoria->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <label for="form" class="form-label">Parqueadero</label>
                                    <select class="form-control" name="parqueadero_id" id="parqueadero_id">
                                        <option value="">-- Seleccione --</option>
                                        @foreach( $parqueaderos as $parqueadero )
                                            <option value="{{$parqueadero->id }}">{{$parqueadero->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <label for="form" class="form-label">Precio</label>
                                    <select class="form-control" name="precio_id" id="precio_id">
                                        <option value="">-- Seleccione --</option>
                                        @foreach( $precios as $precio )
                                            <option value="{{$precio->id }}">{{$precio->valor}} -> ({{$precio->nombre}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <button class="btn btn-success">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Disponibilidad</h5>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($disponibilidad as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $item['nombre'] }}
                                        <span class="badge bg-success rounded-pill">
                                            {{ $item['disponibles'] }} / {{ $item['limite'] }} disponibles
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th> Id </th>
                                    <th> parqueadero </th>
                                    <th> placa </th>
                                    <th> tipo </th>
                                    <th> hora ingreso </th>
                                    <th> hora salida </th>
                                    <th> valor </th>
                                    <th> opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $parqueadero_visitantes as $parqueadero_visitante )
                                    <tr>
                                        <td>{{ $parqueadero_visitante->id }}</td>
                                        <td>{{ $parqueadero_visitante->parqueadero->nombre }}</td>
                                        <td>{{ $parqueadero_visitante->placa }}</td>
                                        <td>{{ $parqueadero_visitante->categoria->nombre }}</td>
                                        <td>{{ $parqueadero_visitante->hora_ingreso }}</td>
                                        <td>{{ is_null($parqueadero_visitante->hora_salida) ? 'Sin Salida' : $parqueadero_visitante->hora_salida }}</td>
                                        <td>$ {{ $parqueadero_visitante->valor ? number_format($parqueadero_visitante->valor, 0, ',', '.') : 0 }}</td>
                                        <td>  
                                        @if( !$parqueadero_visitante->hora_salida )
                                            <a href="{{ url('parqueadero_visitante_edit',[ 'id' =>  $parqueadero_visitante->id ]) }}" class="btn btn-info"><i class="material-icons-outlined">editar</i></a>
                                            <a href="{{ url('parqueadero_visitante_delete',[ 'id' =>  $parqueadero_visitante->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este manual?');"><i class="material-icons-outlined">borrar</i></a>
                                            <a href="{{ url('registroSalidaVehiculo',[ 'id' =>  $parqueadero_visitante->id ]) }}" target="_blank" data-bs-toggle="tooltip" data-bs-offset="0,8" data-bs-placement="top" data-bs-custom-class="tooltip-primary" title="Registrar Salida Visitante" class="btn btn-success" onclick="return confirm('¿Estás seguro de que deseas registrar salida?');"><i class="material-icons-outlined">person</i></a>
                                        @else
                                            <a href="{{ url('recibo_parqueadero',[ 'id' =>  $parqueadero_visitante->id ]) }}" target="_blank" data-bs-toggle="tooltip" data-bs-offset="0,8" data-bs-placement="top" data-bs-custom-class="tooltip-primary" title="Ver Recibo" class="btn btn-info"><i class="material-icons-outlined">visibility</i></a>
                                        @endif
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