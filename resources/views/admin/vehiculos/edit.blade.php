@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Modificar Vehiculo</h5>
        <div class="card-body">
            <form method="POST" action="{{ url('vehiculos/' . $vehiculos->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">PLaca</label>
                        <input class="form-control" type="text" id="placa" name="placa" value="{{$vehiculos->placa}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Marca</label>
                        <input class="form-control" type="text" id="marca" name="marca" value="{{$vehiculos->marca}}" />
                    </div>
                </div>
                <hr>
                <div class="mb-12">
                    <button class="btn btn-warning">Actualizar</button>
                    <a href="{{ url('vehiculos')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection