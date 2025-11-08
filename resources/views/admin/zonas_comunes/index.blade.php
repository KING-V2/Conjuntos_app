@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Zonas Comunes</h1>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('zonas.create') }}" class="btn btn-primary">Nueva Zona</a>
            </div>

            @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($zonas as $z)
                    <tr>
                        <td>{{ $z->nombre }}</td>
                        <td>{{ $z->estado ?? 'Activo' }}</td>
                        <td>{{ $z->descripcion }}</td>
                        <td style="white-space:nowrap">
                            <a href="{{ route('zonas.edit', $z->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <a href="{{ route('zonas.horarios.index', $z->id) }}" class="btn btn-sm btn-info">Horarios</a>

                            <form action="{{ route('zonas.delete', $z->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar zona?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $zonas->links() }}
        </div>
    </div>
</div>
@endsection
