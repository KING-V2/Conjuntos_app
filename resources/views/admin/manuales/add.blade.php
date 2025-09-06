@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Cargue Manual</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_manuales',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label for="form" class="form-label">Archivo</label>
                        <input class="form-control" type="file" id="archivo" name="archivo" accept=".pdf" />
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <br>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th> Id </th>
                                    <th> Archivo </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $manuales as $manual )
                                    <tr>
                                        <td>{{ $manual->id }}</td>
                                        <td>
                                            <a href="{{ asset('storage/manual').'/'.$manual->archivo }}" alt="" width="40%">{{$manual->archivo}}</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('manuales_edit',[ 'id' =>  $manual->id ]) }}" class="btn btn-info"><i class="material-icons-outlined">editar</i></a>
                                            <a href="{{ url('manuales_delete',[ 'id' =>  $manual->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este manual?');"><i class="material-icons-outlined">borrar</i></a>
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