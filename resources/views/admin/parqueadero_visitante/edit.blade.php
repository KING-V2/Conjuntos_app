@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Actualizar Parqueaderos Visitantes</h5>
        <div class="card-body">
        <form method="post" action="{{ url('parqueadero_visitante_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="parqueadero_visitante_id" name="parqueadero_visitante_id" value="{{ $parqueadero_visitantes->id }}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">placa</label>
                        <input class="form-control" type="text" id="placa" name="placa" placeholder="nombre" value="{{ $parqueadero_visitantes->placa }}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Tipo</label>
                        <select class="form-control" name="categoria_id" id="categoria_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $categorias as $categoria )
                                <option value="{{$categoria->id }}" {{ $categoria->id == $parqueadero_visitantes->categoria->id ? 'selected' : '' }} >{{$categoria->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Parqueadero</label>
                        <select class="form-control" name="parqueadero_id" id="parqueadero_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $parqueaderos as $parqueadero )
                                <option value="{{$parqueadero->id }}" {{ $parqueadero->id == $parqueadero_visitantes->parqueadero->id ? 'selected' : '' }} >{{$parqueadero->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">>
                        <label for="form" class="form-label">Precio</label>
                        <select class="form-control" name="precio_id" id="precio_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $precios as $precio )
                                <option value="{{$precio->id }}" {{ $precio->id == $parqueadero_visitantes->precio->id ? 'selected' : '' }} >{{$precio->valor}} -> ({{$precio->nombre}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection