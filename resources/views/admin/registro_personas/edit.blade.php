@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="card text-center mb-3">
        <h5 class="card-header">📋 Registro de Personas</h5>
        <div class="card-body">
            <h3 class="text-center mb-4">✏️ Editar Registro</h3>

            <form action="{{ url('registro_personas_update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $registro->id }}">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $registro->nombre }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Documento</label>
                        <input type="text" name="documento" class="form-control" value="{{ $registro->documento }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Casa</label>
                        <select name="casa_id" class="form-control" required>
                            @foreach($casas as $a)
                                <option value="{{ $a->id }}" {{ $registro->casa_id == $a->id ? 'selected' : '' }}>
                                    {{ $a->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Foto</label><br>
                        @if($registro->foto)
                            <a href="{{ asset('storage/registro_personas/'.$registro->foto) }}" target="_blank">
                                <img src="{{ asset('storage/registro_personas/'.$registro->foto) }}" width="60" height="60" class="rounded mb-2">
                            </a>
                        @endif
                        <input type="file" name="foto" class="form-control">
                    </div>
                    
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ url('registro_personas') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>  
</div>
@endsection
