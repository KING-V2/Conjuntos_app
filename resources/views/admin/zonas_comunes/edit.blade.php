@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Zona Comun</h5>
        <div class="card-body">
            <form method="post" action="{{ url('zonas_comunes_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="zona_comun_id" name="zona_comun_id" placeholder="zona_comun_id" value="{{ $zona_comun->id }}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value="{{$zona_comun->nombre}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">bloque</label>
                        <select class="form-control" name=" estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Activo" {{$zona_comun->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="No Activo" {{$zona_comun->estado == 'No Activo' ? 'selected' : '' }}>No Activo</option>
                        </select>
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
                <a href="{{ url('zonas_comunes')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection