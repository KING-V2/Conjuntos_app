@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Clasificado Galeria</h1>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_clasificado_galeria',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label for="form" class="form-label">Casa Clasificado</label>
                        <select class="form-control" name="clasificado_id" id="clasificado_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $clasificados as $clasificado )
                                <option value="{{$clasificado->id }}">{{$clasificado->casa->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="form" class="form-label">Imagenes</label>
                        <input class="form-control" type="file" id="imagen" name="imagen[]" accept=".jpg, .jpeg, .png" multiple/>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card text-center mb-3">
                        <div class="card-datatable table-responsive pt-0">
                            @if( $galeria->where('estado','Alquiler') )
                                <table class="table table-bordered" style="overflow-x: auto;">
                                    <thead>
                                        <tr>
                                            <th> Id </th>
                                            <th> apartamento </th>
                                            <th> foto </th>
                                            <th> Opciones </th>
                                        </tr>
                                    </thead>    
                                    <tbody>
                                        @foreach( $galeria as $clasificado )
                                            <tr>
                                                <td>{{ $clasificado->id }}</td>
                                                <td>{{ $clasificado->clasificado->casa->nombre }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/clasificado_galeria').'/'.$clasificado->imagen }}" alt="" width="50%">
                                                </td>
                                                <td>
                                                    <a href="{{ url('clasificado_galeria_delete',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este interior?');"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h4>Sin Alquileres</h4>
                            @endif
                        </div>
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