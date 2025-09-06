@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Apartamento</h5>
        <div class="card-body">
            <form method="post" action="{{ url('actividades_update',[]) }}">
                <input class="form-control" type="hidden" id="actividad_id" name="actividad_id" placeholder="actividad_id" value="{{ $actividad->id }}"/>
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="Pendiente" {{ $actividad->estado == 'Pendiente' ? 'selected' : ''}}>Pendiente</option>
                            <option value="En Proceso" {{ $actividad->estado == 'En Proceso' ? 'selected' : ''}}>En Proceso</option>
                            <option value="Hecha" {{ $actividad->estado == 'Hecha' ? 'selected' : ''}}>Hecha</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <label for="form" class="form-label">descripcion</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="descripcion">{{ $actividad->descripcion }}</textarea>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="mb-12">
                <a href="{{ url('apartamentos')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection