@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Modificar Trasteo</h5>
        <div class="card-body">
            <form method="post" action="{{ url('trasteos_update',[]) }}">
                {{ csrf_field() }}
                <input class="hidden" type="hidden" id="trasteo_id" name="trasteo_id" placeholder="trasteo_id" value="{{$trasteo->id}}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Mes</label>
                        <select class="form-control" name="mes" id="mes">
                            <option value="">-- Seleccione --</option>
                            @foreach($meses as $mes)
                                <option value="{{$mes}}" {{ $trasteo->mes == $mes ? 'selected' : '' }} >{{$mes}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">fecha</label>
                        <input class="form-control" type="date" id="fecha" name="fecha" placeholder="fecha" value="{{$trasteo->fecha}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">hora</label>
                        <input class="form-control" type="time" id="hora" name="hora" placeholder="Hora" value="{{$trasteo->hora}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="" {{$trasteo->estado == '' ? 'selected' : '' }}>-- Seleccione --</option>
                            <option value="Aprobado" {{$trasteo->estado == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
                            <option value="Pendiente" {{$trasteo->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="No Aprobado" {{$trasteo->estado == 'No Aprobado' ? 'selected' : '' }}>No Aprobado</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <label for="form" class="form-label">Respuesta Administrador</label>
                        <textarea class="form-control" name="descripcion_respuesta" id="descripcion_respuesta" rows="2" >{{$trasteo->descripcion_respuesta}}</textarea>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <label for="form" class="form-label">Descripcion Solicitud</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" rows="5" placeholder="decripcion" readonly>{{$trasteo->descripcion}}</textarea>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection