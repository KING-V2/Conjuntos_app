@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Usuarios</h1>
        <div class="card-body">
            <div class="col-md-12">
                <h3>Agregar Usuario</h3>
                <form method="post" action="{{ url('users_create',[]) }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">name</label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="name" value=""/>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">email</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="email" value=""/>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">password</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="password" value=""/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">Rol</label>
                            <select class="form-control" name="rol" id="rol">
                                <option value="">-- Seleccione --</option>
                                @foreach($roles as $rol)
                                    <option value="{{$rol->name}}">{{$rol->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <br>
                            <input type="checkbox" id="login_web" name="login_web" value="1">
                            <label class="form-label" for="login_web">Login Web</label><br>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <br>
                            <input type="checkbox" id="login_mobile" name="login_mobile" value="1">
                            <label class="form-label" for="login_mobile">Login App</label><br>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success">Guardar</button>
                </form>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <h3>Roles Disponibles</h3>
                    <ul class="list-group">
                        @foreach ($roles as $role)
                            <li class="list-group-item">
                                {{ $role->name }}
                                <span class="badge bg-primary float-end">{{ isset( $rolesWithUsers[$role->id] ) ? $rolesWithUsers[$role->id]->count() : 0 }} Usuarios</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-8">
                    <h3>Usuarios Agrupados por Rol</h3>
                    @foreach ($rolesWithUsers as $roleId => $usersInRole)
                        <div class="card mb-3">
                            <div class="card-header">
                                <strong>{{ $roles->where('id', $roleId)->first()->name }}</strong>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach ($usersInRole as $user)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $user->user_name }}</strong> ({{ $user->user_email }})
                                            <br>
                                            <div class="col-md-12">
                                                    <input type="checkbox" class="form-check-input" id="login_web" onchange="modificarAccesosUsuario('web',{{$user->user_id}},{{$user->login_web}})" name="login_web" {{ $user->login_web == '1' ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="login_web">Login Web</label>
                                                    &nbsp;&nbsp;|&nbsp;&nbsp;
                                                    <input type="checkbox" class="form-check-input" id="login_mobile" onchange="modificarAccesosUsuario('mobile',{{$user->user_id}},{{$user->login_mobile}})" name="login_mobile" {{ $user->login_mobile == '1' ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="login_mobile">Login Mobile</label>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{ url('users_edit',['id' => $user->user_id])}}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('users_delete',['id' => $user->user_id])}}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function modificarAccesosUsuario(origin, user_id, value){
            console.log(origin);
            console.log(user_id);
            console.log(value);
            $.ajax({
                url: '/modificarAccesosUsuario', // Cambia esto a tu endpoint real
                method: 'POST',
                data: { 
                    origen: origin, 
                    user: user_id, 
                    valor: value 
                },
                success: function (response) {
                    console.log(response.message);
                },
                error: function (error) {
                    console.log(error.message);
                }
            });
        }
    </script>
@endsection
