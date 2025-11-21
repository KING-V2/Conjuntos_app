@extends('layouts.admin')
@section('content')

<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Zonas Comunes horarios</h1>

        <div class="card-body">

            {{-- MENSAJES --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- ============================= --}}
            {{--      FORMULARIO ZONA COMÚN   --}}
            {{-- ============================= --}}
            <h3>{{ isset($zona) ? 'Editar Zona Común' : 'Nueva Zona Común' }}</h3>

            <form method="POST" action="{{ isset($zona) ? route('zonas.update', $zona->id) : route('zonas.store') }}">
                @csrf

                <div class="mb-3">
                    <label>Nombre</label>
                    <input name="nombre" class="form-control"
                           value="{{ old('nombre', $zona->nombre ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ old('descripcion', $zona->descripcion ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Estado</label>
                    <select name="estado" class="form-control">
                        <option value="Activo" {{ old('estado', $zona->estado ?? '') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado', $zona->estado ?? '') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <button class="btn btn-success">
                    {{ isset($zona) ? 'Actualizar Zona' : 'Crear Zona' }}
                </button>

                <a href="{{ route('zonas.index') }}" class="btn btn-secondary">Volver</a>
            </form>



            {{-- SOLO MOSTRAR HORARIOS SI YA EXISTE LA ZONA --}}
            @if(isset($zona))

            <hr>

            {{-- ============================= --}}
            {{--      AGREGAR HORARIOS         --}}
            {{-- ============================= --}}
            <h3>Horarios – {{ $zona->nombre }}</h3>

            <form method="POST" action="{{ route('zonas.horarios.store', $zona->id) }}" class="row g-2 mb-3">
                @csrf

                <div class="col-md-3">
                    <label>Día</label>
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


            {{-- ============================= --}}
            {{--      LISTADO DE HORARIOS      --}}
            {{-- ============================= --}}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dias = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
                    @endphp

                    @foreach($horarios as $h)
                        <tr>
                            <td>{{ $dias[$h->dia_semana] ?? $h->dia_semana }}</td>
                            <td>{{ $h->hora_inicio }}</td>
                            <td>{{ $h->hora_fin }}</td>
                            <td>
                                <form method="POST" action="{{ route('zonas.horarios.delete', $h->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Eliminar horario?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @endif {{-- fin if zona --}}

        </div>
    </div>
</div>

@endsection
