@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Lista Mensajes</h5>
        <div class="card-body">
            <a href="{{ route('mensajes_vistas.create') }}" class="btn btn-primary mb-3">Nuevo Mensaje</a>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vista</th>
                                    <th>Mensaje</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mensajes as $msj)
                                <tr>
                                    <td>{{ $msj->id }}</td>
                                    <td>{{ $msj->vista }}</td>
                                    <td>{{ $msj->mensaje }}</td>
                                    <td>
                                        <a href="{{ route('mensajes_vistas.edit', $msj->id) }}" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
                                        <a href="{{ route('mensajes_vistas.delete', $msj->id) }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Seguro de eliminar?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
