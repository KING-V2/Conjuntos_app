@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Reserva</h5>
        <div class="card-body">
            <form method="post" action="{{ url('reservas_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="reserva_id" name="reserva_id" placeholder="reserva_id" value="{{ $reserva->id }}"/>
                <div class="row">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">fecha</label>
                            <input class="form-control" type="date" id="fecha" name="fecha" placeholder="fecha" value="{{$reserva->fecha}}"/>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">hora inicio</label>
                            <input class="form-control" type="time" id="hora_inicio" name="hora_inicio" placeholder="hora_inicio" value="{{$reserva->hora_inicio}}"/>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">hora fin</label>
                            <input class="form-control" type="time" id="hora_fin" name="hora_fin" placeholder="hora_fin" value="{{$reserva->hora_fin}}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">Usuario</label>
                            <select class="form-control" name="usuario_id" id="usuario_id">
                                <option value="">-- Seleccione --</option>
                                @foreach( $usuarios as $usuario )
                                    <option value="{{$usuario->id }}" {{ $reserva->usuario->id == $usuario->id ?  'selected' : ''}}>{{$usuario->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">Zona Comun</label>
                            <select class="form-control" name="zona_comun_id" id="zona_comun_id">
                                <option value="">-- Seleccione --</option>
                                @foreach( $zonas as $zona )
                                    <option value="{{$zona->id }}" {{$reserva->zona_comun->id == $zona->id ?  'selected' : ''}} >{{$zona->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <label for="form" class="form-label">Descripcion</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" placeholder="decripcion de actividad a realizar">{{$reserva->descripcion}}</textarea>
                        </div>
                    </div>
                    <h5 class="card-header">Respuesta Administrador</h5>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">Estado</label>
                            <select class="form-control" name="estado" id="estado">
                                <option value="Pendiente">Pendiente</option>
                                <option value="Aprobado">Arobado</option>
                                <option value="No Aprobado">No Aprobado</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">Administrador</label>
                            <select class="form-control" name="administrador_id" id="administrador_id">
                                <option value="">-- Seleccione --</option>
                                @foreach( $usuarios as $usuario )
                                    <option value="{{$usuario->id }}" {{ $reserva->usuario->id == 1 ?  'selected' : ''}}>{{$usuario->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <label for="form" class="form-label">Respuesta Descripcion</label>
                            <textarea class="form-control" name="descripcion_respuesta" id="descripcion_respuesta" rows="3" placeholder="respuesta a reserva"></textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="mb-12">
                        <button class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="mb-12">
                <a href="{{ url('reservas')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection