@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Apartamento</h5>
        <div class="card-body">
            <form method="post" action="{{ url('apartamentos_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="apartamento_id" name="apartamento_id" placeholder="apartamento_id" value="{{ $apartamento->id }}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value="{{$apartamento->nombre}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">codigo</label>
                        <input class="form-control" type="text" id="codigo" name="codigo" placeholder="codigo" value="{{$apartamento->codigo}}" readonly/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Asignada" {{ $apartamento->estado == 'Asignada' ? 'selected' : ''}}>Asignada</option>
                            <option value="Arriendo" {{ $apartamento->estado == 'Arriendo' ? 'selected' : ''}}>Arriendo</option>
                            <option value="Venta" {{ $apartamento->estado == 'Venta' ? 'selected' : ''}}>Venta</option>
                            <option value="Libre" {{ $apartamento->estado == 'Libre' ? 'selected' : ''}}>Libre</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">bloque</label>
                        <select class="form-control" name="bloque_id" id="bloque_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $bloques as $bloque )
                                <option value="{{$bloque->id }}" {{ $apartamento->bloque->id == $bloque->id ? 'selected' : 'disabled' }}>{{$bloque->nombre}}</option>
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
                <a href="{{ url('apartamentos')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection