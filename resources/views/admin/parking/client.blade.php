@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Clientes</h5>
        <div class="card-body">
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="nombre">Nombre Completo</label>
                        <input type="text" id="nombre" name="nombre" required class="form-control">
                    </div>
    
                    <div class="col-md-4 mb-3">
                        <label for="cedula">Cédula</label>
                        <input type="text" id="cedula" name="cedula" required class="form-control">
                    </div>
    
                    <div class="col-md-4 mb-3">
                        <label for="telefono">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" required class="form-control">
                    </div>
    
                    <div class="col-md-4 mb-3">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" required class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="direccion">Dirección</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="4" class="form-control"></textarea>
                    </div>
                </div>

                <div class="flex justify-between mt-4">
                    <a href="{{ route('clients.list') }}" class="btn btn-info">
                        Ver clientes
                    </a>
                    <a href="#" class="btn btn-danger">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection