@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header"> Log Usuarios</h5>
        <div class="card-body">
            <div class="row">
                <h5 class="card-header">Listado</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if( $log_usuarios )
                                @foreach( $log_usuarios as $log )
                                <tr>
                                    <td>{{ $log->usuario }}</td>
                                    <td>{{ $log->fecha }}</td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <h4>No hay registros</h4>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>

</div>
@endsection