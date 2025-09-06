@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edición Usuarios</h5>
        <div class="card-body">
            <form method="post" action="{{ url('users_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="user_id" name="user_id" value="{{$user->id}}" />
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">nombre</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="nombre completo" value="{{$user->name}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">correo</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="correo" value="{{$user->email}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">contraseña</label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña" value=""/>
                    </div>
                </div>
                <br>
                <div class="col-md-12">
                    <button class="btn btn-warning">Actualizar</button>
                    <a href="{{ url('users')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection