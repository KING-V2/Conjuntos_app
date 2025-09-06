@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Respuesta Publicacion</h5>
        <div class="card-body">
            <form method="post" action="{{ url('respuesta_foros_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="respuesta_foro_id" name="respuesta_foro_id" placeholder="respuesta_foro_id" value="{{ $respuesta_foro->id }}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <textarea class="form-control" rows="3" type="text" id="descripcion_admin" name="descripcion_admin" placeholder="Respuesta admin"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-12">
                        <button class="btn btn-success">Responder</button>
                    </div>
                    <div class="mb-12">
                        <a href="{{ url('respuesta_foros')}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection