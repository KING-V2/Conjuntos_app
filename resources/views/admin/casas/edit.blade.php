@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Casas</h5>
        <div class="card-body">
            <form method="post" action="{{ url('casas_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="casa_id" name="casa_id" placeholder="casa_id" value="{{ $casa->id }}"/>
                <input class="form-control" type="hidden" id="codigo" name="codigo" placeholder="codigo" value="{{ $casa->codigo }}"/>
                <div class="row mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <label for="form" class="form-label">Conjunto</label>
                            <select class="form-control" name="conjunto_id" id="conjunto_id">
                                <option value="">-- Seleccione --</option>
                                @foreach( $conjuntos as $conjunto )
                                <option value="{{$conjunto->id }}" {{ $casa->conjunto->id == $conjunto->id ? 'selected' : 'disabled' }}  >{{$conjunto->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-5">
                            <label for="form" class="form-label">nombre</label>
                            <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value="{{$casa->nombre}}"/>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">telefono_uno</label>
                            <input class="form-control" type="text" id="telefono_uno" name="telefono_uno" placeholder="telefono_uno" value="{{$casa->telefono_uno}}"/>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">telefono_dos</label>
                            <input class="form-control" type="text" id="telefono_dos" name="telefono_dos" placeholder="telefono_dos" value="{{$casa->telefono_dos}}"/>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">telefono_tres</label>
                            <input class="form-control" type="text" id="telefono_tres" name="telefono_tres" placeholder="telefono_tres" value="{{$casa->telefono_tres}}"/>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">telefono_cuatro</label>
                            <input class="form-control" type="text" id="telefono_cuatro" name="telefono_cuatro" placeholder="telefono_cuatro" value="{{$casa->telefono_cuatro}}"/>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">telefono_cinco</label>
                            <input class="form-control" type="text" id="telefono_cinco" name="telefono_cinco" placeholder="telefono_cinco" value="{{$casa->telefono_cinco}}"/>
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
            <br>
            <a href="{{ url('citofonia')}}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</div>
@endsection