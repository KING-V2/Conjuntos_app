@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Actualizacion Foro</h5>
        <div class="card-body">
            <form method="post" action="{{ url('foros_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="foro_id" name="foro_id" value="{{ $foro->id }}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label for="form" class="form-label">titulo</label>
                        <input class="form-control" type="text" id="titulo" name="titulo" placeholder="titulo" value="{{$foro->titulo}}"/>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Activo" {{ $foro->estado == 'Activo' ? 'selected' : ''}} >Activo</option>
                            <option value="No Activo" {{ $foro->estado == 'No Activo' ? 'selected' : ''}} >No Activo</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <!-- <label for="form" class="form-label">Mes</label> -->
                        <select class="form-control" name="mes" id="mes" hidden>
                            <option value="">-- Seleccione --</option>
                            @foreach($meses as $mes)
                                <option value="{{$mes}}" {{ $foro->mes == $mes ? 'selected' : ''}}>{{$mes}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <textarea class="form-control" rows="6" type="text" id="descripcion" name="descripcion" placeholder="descripcion foro">{{$foro->descripcion}}</textarea>
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
                <a href="{{ url('foros')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection