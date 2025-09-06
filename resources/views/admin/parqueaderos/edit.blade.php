@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Actualizar Parqueadero</h5>
        <div class="card-body">
            <form method="post" action="{{ url('parqueaderos_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="parqueadero_id" name="parqueadero_id" placeholder="parqueadero_id" value="{{$parqueaderos->id}}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value="{{$parqueaderos->nombre}}"/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Residente</label>
                        <select class="form-control" name="usuario_id" id="usuario_id">
                            <option value="">-- Seleccione --</option>
                            @if( !  is_null( $parqueaderos->usuario ) )
                                @foreach( $usuarios as $usuario )
                                    <option value="{{$usuario->id }}" {{ $parqueaderos->usuario->id == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                                @endforeach
                            @else
                                @foreach( $usuarios as $usuario )
                                    <option value="{{$usuario->id }}">{{ $usuario->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="" {{ $parqueaderos->estado == "" ? 'selected' : ''}} >-- Seleccione --</option>
                            <option value="Asignado" {{$parqueaderos->estado == "Asignado" ? 'selected' : ''}} >Asignado</option>
                            <option value="Ocupado" {{$parqueaderos->estado == "Ocupado" ? 'selected' : ''}} >Ocupado</option>
                            <option value="Disponible" {{$parqueaderos->estado == "Disponible" ? 'selected' : ''}} >Disponible</option>
                            <option value="Alquiler" {{$parqueaderos->estado == "Alquiler" ? 'selected' : ''}} >Alquiler</option>
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