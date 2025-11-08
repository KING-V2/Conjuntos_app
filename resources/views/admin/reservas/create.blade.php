@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">
            <h3>Solicitar Reserva</h3>
            
        </h1>
        <div class="card-body">

            @if($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif

            <form method="POST" action="{{ route('reservas.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Zona</label>
                    <select name="zona_comun_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($zonas as $z)
                            <option value="{{ $z->id }}" {{ old('zona_comun_id') == $z->id ? 'selected':'' }}>{{ $z->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}" required>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Hora inicio</label>
                        <input type="time" name="hora_inicio" class="form-control" value="{{ old('hora_inicio') }}" required>
                    </div>
                    <div class="col">
                        <label>Hora fin</label>
                        <input type="time" name="hora_fin" class="form-control" value="{{ old('hora_fin') }}" required>
                    </div>
                </div>

                <div class="mb-3 mt-2">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Comprobante (opcional)</label>
                    <input type="file" name="comprobante" class="form-control">
                </div>

                <button class="btn btn-primary">Enviar solicitud</button>
                <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</div>
@endsection
