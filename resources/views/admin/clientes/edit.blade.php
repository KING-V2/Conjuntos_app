@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Modificar Cliente</h5>
        <div class="card-body">
            <form method="POST" action="{{ url('clientes/' . $clientes->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Nombre del cliente</label>
                        <input class="form-control" type="text" id="nombres" name="nombres" value="{{$clientes->nombres}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Numero de Documento</label>
                        <input class="form-control" type="number" id="numero_documento" name="numero_documento" value="{{$clientes->numero_documento}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Email</label>
                        <input class="form-control" type="email" id="email" name="email" value="{{$clientes->email}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">celular</label>
                        <input class="form-control" type="number" id="celular" name="celular" value="{{$clientes->celular}}" />
                    </div>
                </div>
                <hr>
                <div class="mb-12">
                    <button class="btn btn-warning">Actualizar</button>
                    <a href="{{ url('clientes')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection