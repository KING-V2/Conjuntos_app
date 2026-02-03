@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edición de Espacio de Parqueadero</h5>
        <div class="card-body">
            <form method="POST" action="{{ url('espacios/' . $espacios->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="numero" class="form-label">Número</label>
                        <input class="form-control" type="text" id="numero" name="numero" value="{{ $espacios->numero }}" required/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado }}" {{ $espacios->estado == $estado ? 'selected' : '' }}>
                                    {{ ucfirst($estado) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="mb-12">
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                    <a href="{{ url('espacios') }}" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection