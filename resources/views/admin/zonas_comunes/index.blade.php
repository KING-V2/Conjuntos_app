@extends('layouts.admin')
@section('content')
<div class="container py-4">
    <h2>Zonas Comunes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card p-3 mb-4">
        <h5>Agregar Zona</h5>

        <form action="{{ route('zonas.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-4">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="col-md-2">
                    <label>Límite</label>
                    <input type="number" name="limite" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Tipo</label>
                    <select name="tipo" class="form-control" required>
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miércoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                        <option value="Festivo">Festivo</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Descripción</label>
                    <input type="text" name="descripcion" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="Activo">Activo</option>
                        <option value="No Activo">No Activo</option>
                    </select>
                </div>
            </div>

            <button class="btn btn-primary mt-3">Agregar Zona</button>
        </form>
    </div>

    {{-- =========================
        LISTADO DE ZONAS + HORARIOS
    ========================= --}}
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Zona</th>
                <th>Tipo</th>
                <th>Límite</th>
                <th>Horarios</th>
                <th width="180">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($zonas as $z)
            <tr>
                <td>{{ $z->id }}</td>
                <td>{{ $z->nombre }}</td>
                <td>{{ ucfirst($z->tipo) }}</td>
                <td>{{ $z->limite }}</td>

                {{-- ===== HORARIOS ===== --}}
                <td>
                    <ul class="nav nav-tabs mb-2" role="tablist">
                        @foreach($tipos as $key => $label)
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#zona-{{ $z->id }}-{{ $key }}" type="button" role="tab">
                                    {{ $label }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content border p-2">
                        @foreach($tipos as $key => $label)
                            <div
                                class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="zona-{{ $z->id }}-{{ $key }}" role="tabpanel">
                                {{-- LISTADO --}}
                                @php
                                    $horarios = $z->horarios->where('tipo_dia', $key);
                                @endphp

                                @if($horarios->count())
                                    <ul class="list-group mb-2">
                                        @foreach($horarios->sortBy('price') as $h)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span>
                                                    {{ substr($h->hora_inicio,0,5) }} - {{ substr($h->hora_fin,0,5) }}
                                                </span>

                                                <form action="{{ route('zonas.horarios.delete', $h->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">✕</button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted d-block mb-2">Sin horarios</span>
                                @endif

                                {{-- AGREGAR --}}
                                <form action="{{ route('zonas.horarios.store') }}" method="POST" class="border p-2">
                                    @csrf
                                    <input type="hidden" name="zona_id" value="{{ $z->id }}">
                                    <input type="hidden" name="tipo_dia" value="{{ $key }}">

                                    <div class="row g-1">
                                        <div class="col-5">
                                            <input type="time" name="hora_inicio" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="col-5">
                                            <input type="time" name="hora_fin" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-success btn-sm w-100">+</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </td>
                <td>
                    <a href="{{ route('zonas.edit', $z->id) }}" class="btn btn-warning btn-sm mb-1 w-100">
                        Editar Zona
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
