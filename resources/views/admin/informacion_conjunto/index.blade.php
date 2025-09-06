@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Información del Conjunto</h1>
        <div class="card-body">
            @if( $informaciones->isEmpty() )
                <a href="{{ route('informacion_conjunto.create') }}" class="btn btn-primary">Agregar Información</a>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Días</th>
                        <th>Horas</th>
                        <th>Teléfonos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($informaciones as $info)
                        <tr>
                            <td>{{ implode(', ', $info->dias) }}</td>
                            <td>{{ implode(', ', $info->horas) }}</td>
                            <td>{{ $info->telefonos }}</td>
                            <td>
                                <a href="{{ route('informacion_conjunto.edit', $info->id) }}" class="btn btn-warning"><i class="material-icons-outlined">editar</i></a>
                                <a href="{{ url('informacion_conjunto_delete',[ 'id' =>  $info->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta informacion?');"><i class="material-icons-outlined">borrar</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
