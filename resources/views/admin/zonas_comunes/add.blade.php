@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Zonas Comunes</h1>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_zonas_comunes',[]) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Activo">Activo</option>
                            <option value="No Activo">No Activo</option>
                        </select>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th> Id </th>
                                    <th> Nombre </th>
                                    <th> estado </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $zonas_comunes as $zona_comun )
                                    <tr>
                                        <td>{{ $zona_comun->id }}</td>
                                        <td>{{ $zona_comun->nombre }}</td>
                                        <td>{{ $zona_comun->estado }}</td>
                                        <td>
                                            <a href="{{ url('zonas_comunes_edit',[ 'id' =>  $zona_comun->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('zonas_comunes_delete',[ 'id' =>  $zona_comun->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta zona comun?');"><i class="fa fa-trash"></i></a>
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