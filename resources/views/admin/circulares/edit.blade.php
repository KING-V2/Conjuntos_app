@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Circulares</h5>
        <div class="card-body">
            <form method="post" action="{{ url('circulares_update',[]) }}" enctype="multipart/form-data">
                <input class="form-control" type="hidden" id="id_circular" name="id_circular" value="{{$circular->id}}" />
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Titulo</label>
                        <input class="form-control" type="text" id="titulo" name="titulo" value="{{$circular->titulo}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Mes</label>
                        <select class="form-control" name="mes" id="mes">
                            <option value="">-- Seleccione --</option>
                            @foreach($meses as $mes)
                                <option value="{{$mes}}" {{ $circular->mes == $mes ? 'selected' : '' }} >{{$mes}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Archivo</label>
                        <input class="form-control" type="file" id="archivo" name="archivo" accept=".pdf"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <label for="form" class="form-label">Descripcion Archivo</label>
                        <textarea class="form-control" type="text" id="descripcion" name="descripcion" placeholder="descripcion_archivo">{{ $circular->descripcion}}</textarea>
                    </div>
                </div>
                <hr>
                <div class="mb-12">
                    <button class="btn btn-warning">Actualizar</button>
                    <a href="{{ url('circulares')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection