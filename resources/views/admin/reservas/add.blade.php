@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Reservas</h1>
        <div class="card-body">
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th> Id </th>
                                    <th> residente </th>
                                    <th> zona comun </th>
                                    <th> fecha </th>
                                    <th> Hora inicio </th>
                                    <th> Hora fin </th>
                                    <th> descripcion </th>
                                    <th> estado </th>
                                    <th> administrador </th>
                                    <th> respuesta </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $reservas as $reserva )
                                    <tr>
                                        <td>{{ $reserva->id }}</td>
                                        <td>{{ $reserva->usuario->name }}</td>
                                        <td>{{ $reserva->zona_comun->nombre }}</td>
                                        <td>{{ $reserva->fecha }}</td>
                                        <td>{{ $reserva->hora_inicio }}</td>
                                        <td>{{ $reserva->hora_fin }}</td>
                                        <td>{{ $reserva->descripcion ? $reserva->descripcion : '-' }}</td>
                                        <td>{{ $reserva->estado }}</td>
                                        <td>{{ $reserva->administrador ? $reserva->administrador->name : '-' }}</td>
                                        <td>{{ $reserva->descripcion_respuesta ? $reserva->descripcion_respuesta : '-' }}</td>
                                        <td>
                                            <a href="{{ url('reservas_edit',[ 'id' =>  $reserva->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('reservas_delete',[ 'id' =>  $reserva->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');"><i class="fa fa-trash"></i></a>
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
@section('javascripts')

    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <script src="{{ asset('assets/js/audios/configs.js') }}"></script>
    <script src="{{ asset('assets/js/tables-datatables-basic.js') }}"></script>

    <script src="{{ asset('assets/js/archivos/archivos.js') }}"></script>
@endsection