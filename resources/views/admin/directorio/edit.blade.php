@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Contacto</h5>
        <div class="card-body">
            <form method="post" action="{{ url('directorios_update',[]) }}" >
                <input class="form-control" type="hidden" id="id_directorio" name="id_directorio" value="{{$directorio->id}}" />
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" value="{{$directorio->nombre}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Telefono</label>
                        <input class="form-control" type="text" id="telefono" name="telefono" value="{{$directorio->telefono}}" />
                    </div>
                </div>
                <div class="mb-12">
                    <button class="btn btn-warning mt-2">Actualizar</button>
                </div>
            </form>
            <div class="mb-12">
                <a href="{{ url('directorios')}}" class="btn btn-danger mt-2">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection