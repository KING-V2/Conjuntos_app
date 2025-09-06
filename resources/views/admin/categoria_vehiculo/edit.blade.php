@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Actualizar Categoria</h5>
        <div class="card-body">
            <form action="{{ url('categoria_vehiculo_update',[]) }}" method="POST">
                @csrf
                <div class="row">
                    <input class="form-control" type="hidden" id="categoria_vehiculo_id" name="categoria_vehiculo_id" placeholder="categoria_vehiculo_id" value="{{$categoria_vehiculo->id}}"/>
                    <div class="col-sm-12 col-md-3">
                        <label for="numero">Número:</label>
                        <input type="text" name="numero" id="numero" class="form-control" value="{{ old('numero', $categoria_vehiculo->numero) }}" required>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $categoria_vehiculo->nombre) }}" required>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <label for="limite">Límite:</label>
                        <input type="number" name="limite" id="limite" class="form-control" value="{{ old('limite', $categoria_vehiculo->limite) }}" required>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <label for="valor">Valor:</label>
                        <input type="number" name="valor" id="valor" class="form-control" value="{{ old('valor', $categoria_vehiculo->valor) }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection