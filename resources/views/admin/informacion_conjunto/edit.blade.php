@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Editar Información</h2>
        </div>
        <div class="card-body">
            <form method="post" action="{{ url('informacion_conjunto_update',[]) }}">
                @csrf
                @if (isset($informacionConjunto))
                    @method('PUT')
                @endif
                <!-- Días de atención -->
                <div class="form-group">
                    <label class="form-label">Días de atención</label>
                    <div class="row">
                        @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="dias[]" value="{{ $dia }}" 
                                        {{ in_array($dia, $informacionConjunto->dias) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $dia }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Horas de atención -->
                <div class="form-group mt-3">
                    <label class="form-label">Horas de atención</label>
                    <div class="row">
                        @foreach (range(0, 23) as $hora)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="horas[]" value="{{ $hora }}:00" 
                                        {{ in_array("$hora:00", $informacionConjunto->horas) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $hora }}:00</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Teléfonos de contacto -->
                <div class="form-group mt-3">
                    <label class="form-label">Teléfonos de contacto</label>
                    <input type="text" name="telefonos" class="form-control" value="{{ old('telefonos', $informacionConjunto->telefonos ?? '') }}" placeholder="Ingrese los teléfonos de contacto">
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
