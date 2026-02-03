@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header"><i class="fa-solid fa-gear mr-2 text-blue-600"></i> Panel de Configuración</h5>
        <div class="card-body">
            <div class="card-header border-bottom">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-general" aria-controls="navs-tab-general" aria-selected="true">General</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-usuarios" aria-controls="navs-tab-usuarios" aria-selected="true">Usuarios</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-seguridad" aria-controls="navs-tab-seguridad" aria-selected="true">Seguridad</button>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-tab-general" role="tabpanel">
                    <h3 class="text-lg font-semibold mb-3">Ajustes Generales</h3>
                    <form method="post" action="{{ url('settings_conjuntos_update',[]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input class="form-control" type="hidden" id="conjunto_id" name="conjunto_id" placeholder="conjunto_id" value="{{ $conjunto->id }}"/>
                            <div class="row">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <label for="form" class="form-label">nombre</label>
                                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value="{{ $conjunto->nombre }}"/>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="form" class="form-label">direccion</label>
                                        <input class="form-control" type="text" id="direccion" name="direccion" placeholder="direccion" value="{{ $conjunto->direccion }}"/>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="form" class="form-label">nit</label>
                                        <input class="form-control" type="text" id="nit" name="nit" placeholder="nit" value="{{ $conjunto->nit }}"/>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                    <label for="form" class="form-label">Administrador</label>
                                    <select class="form-control" name="administrador_id" id="administrador_id">
                                        <option value="">-- Seleccione --</option>
                                        @foreach( $administradores as $administrador )
                                            <option value="{{$administrador->id }}" {{$administrador->id == $conjunto->administrador->id ? 'selected' : '' }}>{{$administrador->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <label for="form" class="form-label">icono</label>
                                        <input class="form-control" type="file" id="icono" name="icono" />
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="form" class="form-label">logo</label>
                                        <input class="form-control" type="file" id="logo" name="logo" />
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <button class="btn btn-success">Actualizar</button>
                                <a href="{{ url('conjuntos')}}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-tab-seguridad" role="tabpanel">
                    <h3 class="text-lg font-semibold mb-3">Opciones de Seguridad</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded shadow">
                            <label class="block font-medium">Cambiar Contraseña</label>
                            <input type="password" placeholder="Nueva Contraseña" class="form-control mb-2">
                            <button class="btn btn-warning">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection