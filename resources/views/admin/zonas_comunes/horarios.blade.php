@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Zonas Comunes</h1>
        <div class="card-body">
            <h3>Horarios - {{ $zona->nombre }}</h3>

            @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

            <form method="POST" action="{{ route('zonas.horarios.store', $zona->id) }}" class="row g-2 mb-3">
                @csrf
                <div class="col-md-3">
                    <label>Dia</label>
                    <select name="dia_semana" class="form-control" required>
                        <option value="">Seleccione</option>
                        <option value="1">Lunes</option>
                        <option value="2">Martes</option>
                        <option value="3">Miércoles</option>
                        <option value="4">Jueves</option>
                        <option value="5">Viernes</option>
                        <option value="6">Sábado</option>
                        <option value="0">Domingo</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Hora inicio</label>
                    <input type="time" name="hora_inicio" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Hora fin</label>
                    <input type="time" name="hora_fin" class="form-control" required>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-success w-100">Agregar horario</button>
                </div>
            </form>

            <table class="table table-striped">
                <thead><tr><th>Día</th><th>Desde</th><th>Hasta</th><th></th></tr></thead>
                <tbody>
                    @foreach($horarios as $h)
                    <tr>
                        <td>
                            @php
                                $dias = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
                            @endphp
                            {{ $dias[$h->dia_semana] ?? $h->dia_semana }}
                        </td>
                        <td>{{ $h->hora_inicio }}</td>
                        <td>{{ $h->hora_fin }}</td>
                        <td>
                            <form method="POST" action="{{ route('zonas.horarios.delete', $h->id) }}">
                                @csrf
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Eliminar horario?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('zonas.index') }}" class="btn btn-secondary mt-2">Volver</a>
        </div>
    </div>
</div>
@endsection
