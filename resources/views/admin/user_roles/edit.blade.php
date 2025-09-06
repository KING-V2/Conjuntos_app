@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Asignar Roles a {{ $user->name }}</h1>

    <form action="{{ route('user_roles.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="roles" class="form-label">Roles</label>
            <select name="roles[]" id="roles" class="form-control" multiple>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" 
                        {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Asignar Roles</button>
        <a href="{{ route('user_roles.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
