@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Modificar Tarifa</h5>
        <div class="card-body">
            <form method="POST" action="{{ url('tarifas/' . $tarifas->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Nombre de la tarifa</label>
                        <select class="form-control" name="nombre" id="nombre" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($nombres as $nombre)
                                <option value="{{$nombre}}" {{ $tarifas->nombre ==  $nombre ? 'selected' : '' }}>{{ucfirst($nombre)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Tipo de tarifa</label>
                        <select class="form-control" name="tipo" id="tipo" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($tipos as $tipo)
                                <option value="{{$tipo}}" {{ $tarifas->tipo ==  $tipo ? 'selected' : '' }}>{{ucfirst($tipo)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Costo</label>
                        <input class="form-control" type="text" id="costo" name="costo" value="{{$tarifas->costo}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Minutos de Gavela</label>
                        <input class="form-control" type="text" id="minutos_gavela" name="minutos_gavela" value="{{$tarifas->minutos_gavela}}" />
                    </div>
                </div>
                <hr>
                <div class="mb-12">
                    <button class="btn btn-warning">Actualizar</button>
                    <a href="{{ url('tarifas')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection