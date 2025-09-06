@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Archivos</h5>
        <div class="card-body">
        <form method="post" action="{{ url('conjuntos_update',[]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input class="form-control" type="hidden" id="conjunto_id" name="conjunto_id" placeholder="conjunto_id" value="{{ $conjunto->id }}"/>
                <div class="row">
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <label for="form" class="form-label">nombre</label>
                            <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value="{{ $conjunto->nombre }}"/>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="form" class="form-label">direccion</label>
                            <input class="form-control" type="text" id="direccion" name="direccion" placeholder="direccion" value="{{ $conjunto->direccion }}"/>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="form" class="form-label">nit</label>
                            <input class="form-control" type="text" id="nit" name="nit" placeholder="nit" value="{{ $conjunto->nit }}"/>
                        </div>
                        <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Administrador</label>
                        <select class="form-control" name="administrador_id" id="administrador_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $administradores as $administrador )
                                <option value="{{$administrador->id }}" {{$administrador->id == $conjunto->administrador->id ? 'selected' : '' }}>{{$administrador->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <label for="form" class="form-label">icono</label>
                            <input class="form-control" type="file" id="icono" name="icono" />
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="form" class="form-label">logo</label>
                            <input class="form-control" type="file" id="logo" name="logo" />
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-md-12">
                    <button class="btn btn-success">Actualizar</button>
                    <a href="{{ url('conjuntos')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection