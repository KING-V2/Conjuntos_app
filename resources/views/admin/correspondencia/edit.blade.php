@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Bloques</h5>
        <div class="card-body">
            <form method="post" action="{{ url('bloques_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="bloque_id" name="bloque_id" placeholder="bloque_id" value="{{ $bloque->id }}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value="{{$bloque->nombre}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">codigo</label>
                        <input class="form-control" type="text" id="codigo" name="codigo" placeholder="codigo" value="{{$bloque->codigo}}" readonly/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Conjunto</label>
                        <select class="form-control" name="conjunto_id" id="conjunto_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $conjuntos as $conjunto )
                                <option value="{{$conjunto->id }}" {{ $bloque->conjunto->id == $conjunto->id ? 'selected' : 'disabled' }}  >{{$conjunto->nombre}}</option>
                            @endforeach
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
                <a href="{{ url('bloques')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection