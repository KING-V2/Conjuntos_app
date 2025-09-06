@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Asignar Roles a Usuarios</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('user_roles.edit', $user->id) }}" class="btn btn-warning btn-sm">Asignar Roles</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
