@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Gestión de Permisos</h2>
    <!-- Formulario para crear un nuevo permiso -->
    <div class="card mb-4">
        <div class="card-header">Crear Nuevo Permiso</div>
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Permiso</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Ejemplo: editar usuarios" required>
                </div>
                <button type="submit" class="btn btn-primary">Crear Permiso</button>
            </form>
        </div>
    </div>

    <!-- Lista de permisos existentes -->
    <div class="card">
        <div class="card-header">Permisos Existentes</div>
        <div class="card-body">
            @if($permissions->isEmpty())
                <p>No hay permisos disponibles.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre del Permiso</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $permission->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
