@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Listado Respuestas</h5>
        <div class="card-body">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th> Id </th>
                                    <th> Usuario </th>
                                    <th> Encuesta </th>
                                    <th> Respuesta </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $encuestas_respuestas as $encuestas_respuesta )
                                    <tr>
                                        <td>{{ $encuestas_respuesta->id }}</td>
                                        <td>{{ $encuestas_respuesta->usuario->name }}</td>
                                        <td>{{ $encuestas_respuesta->encuesta->descripcion }}</td>
                                        <td>{{ $encuestas_respuesta->respuesta }}</td>
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