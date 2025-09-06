@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">{{ isset($informacionConjunto) ? 'Editar Información' : 'Agregar Información' }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ isset($informacionConjunto) ? url('informacion_conjunto_update') : url('informacion_conjunto_store') }}" method="POST">
                @csrf
                @if (isset($informacionConjunto))
                    @method('PUT')
                @endif

                @php
                    // Asegurar que los valores sean siempre arrays válidos
                    $diasSeleccionados = isset($informacionConjunto) ? json_decode($informacionConjunto->dias, true) : [];
                    $horasSeleccionadas = isset($informacionConjunto) ? json_decode($informacionConjunto->horas, true) : [];

                    $diasSeleccionados = is_array($diasSeleccionados) ? $diasSeleccionados : [];
                    $horasSeleccionadas = is_array($horasSeleccionadas) ? $horasSeleccionadas : [];
                @endphp

                <!-- Días de atención -->
                <div class="form-group mb-3">
                    <label class="form-label">Días de atención</label>
                    <div class="row">
                        @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="dias[]" value="{{ $dia }}" 
                                        {{ in_array($dia, $diasSeleccionados) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $dia }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Horas de atención -->
                <div class="form-group mb-3">
                    <label class="form-label">Horas de atención</label>
                    <div class="row">
                        @foreach (range(0, 23) as $hora)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="horas[]" value="{{ $hora }}:00" 
                                        {{ in_array("$hora:00", $horasSeleccionadas) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $hora }}:00</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Teléfonos de contacto -->
                <div class="form-group mb-3">
                    <label class="form-label">Teléfonos de contacto</label>
                    <input type="text" name="telefonos" class="form-control" value="{{ old('telefonos', $informacionConjunto->telefonos ?? '') }}" placeholder="Ingrese los teléfonos de contacto">
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
