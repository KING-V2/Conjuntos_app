@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Actualizar Parqueadero</h5>
        <div class="card-body">
            <form method="post" action="{{ url('registro_parqueaderos_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="registro_parqueadero_id" name="registro_parqueadero_id" placeholder="registro_parqueadero_id" value="{{$registro->id}}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Residente</label>
                        <select class="form-control" name="residente_id" id="residente_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $residentes as $residente )
                                <option value="{{$residente->usuario->id }}" {{ $residente->usuario->id == $registro->residente_id ? 'selected' : '' }}>{{$residente->usuario->name}} / {{ $residente->casas->nombre ?? '-'}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Casas</label>
                        <select class="form-control" name="casa_id" id="casa_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $casas as $casa )
                                <option value="{{$casa->id }}" {{ $casa->id == $registro->casa_id ? 'selected' : '' }}>{{$casa->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Parqueadero</label>
                        <select class="form-control" name="parqueadero_id" id="parqueadero_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $parqueaderos as $parqueadero )
                                <option value="{{$parqueadero->id }}" {{ $parqueadero->id == $registro->parqueadero_id ? 'selected' : '' }}>{{$parqueadero->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Vehiculo</label>
                        <select class="form-control" name="vehiculo_id" id="vehiculo_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $vehiculos as $vehiculo )
                                <option value="{{$vehiculo->id }}" {{ $vehiculo->id == $registro->vehiculo_id ? 'selected' : '' }}>{{$vehiculo->placa}} / {{ $vehiculo->tipo_vehiculo}}</option>
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