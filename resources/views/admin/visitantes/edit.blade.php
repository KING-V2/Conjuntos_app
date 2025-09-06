@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Actualizar Parqueadero</h5>
        <div class="card-body">
        <form method="post" action="{{ url('visitantes_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="visitante_id" name="visitante_id" placeholder="visitante_id" value="{{ $visitante->id }}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value="{{ $visitante->nombre }}"/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">tipo documento</label>
                        <select class="form-control" name="tipo_documento" id="tipo_documento">
                            <option value="">-- Seleccione --</option>
                            <option value="Cedula de Ciudadania" {{ $visitante->tipo_documento == "Cedula de Ciudadania" ? 'selected' : '' }} >Cedula de Ciudadania</option>
                            <option value="Tarjeta de Identidad" {{ $visitante->tipo_documento == "Tarjeta de Identidad" ? 'selected' : '' }} >Tarjeta de Identidad</option>
                            <option value="Pasaporte" {{ $visitante->tipo_documento == "Pasaporte" ? 'selected' : '' }} >Pasaporte</option>
                            <option value="Registro Civil" {{ $visitante->tipo_documento == "Registro Civil" ? 'selected' : '' }} >Registro Civil</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">documento</label>
                        <input class="form-control filter_text_dropdown" type="text" id="documento" name="documento" placeholder="documento" value="{{ $visitante->documento}}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">placa</label>
                        <input class="form-control" type="text" id="placa" name="placa" placeholder="nombre" value="{{ $visitante->placa ?? '' }}"/>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label for="form" class="form-label">Residente</label>
                        <select id="select2Basic" class="select2 form-select form-select-md" data-allow-clear="true" name="residente_id">
                            @foreach( $residentes as $residente )
                                <option value="{{$residente->id }}" {{ $visitante->residente->id == $residente->id ? 'selected' : '' }}>{{$residente->usuario->name}} ( {{ $residente->bloque->nombre}} | {{  $residente->apartamento->nombre }} )</option>
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