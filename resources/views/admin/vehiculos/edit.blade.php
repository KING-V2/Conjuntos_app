@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Actualizar Vehiculo</h5>
        <div class="card-body">
            <form method="post" action="{{ url('vehiculos_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="vehiculo_id" name="vehiculo_id" placeholder="vehiculo_id" value="{{$vehiculo->id}}"/>
                <div class="row">
                     <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">placa</label>
                        <input class="form-control" type="text" id="placa" name="placa" placeholder="placa" value="{{ $vehiculo->placa }}" autofocus/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">tipo Vehiculo</label>
                        <select class="form-control" name="tipo_vehiculo" id="tipo_vehiculo" required>
                            <option value="">-- Seleccione --</option>
                            <option value="Carro" {{ $vehiculo->tipo_vehiculo == 'Carro' ? 'selected' : '' }}>Carro</option>
                            <option value="Moto" {{ $vehiculo->tipo_vehiculo == 'Moto' ? 'selected' : '' }}>Moto</option>
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