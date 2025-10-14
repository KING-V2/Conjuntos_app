@extends('layouts.admin')
@section('content')
    <div class="card">
        <h1 class="card-header">Emprendimientos</h1>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_emprendimiento',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Titulo</label>
                        <input class="form-control" type="text" id="titulo" name="titulo" />
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">imagen</label>
                        <input class="form-control" type="file" id="imagen" name="imagen" accept="image/jpg, image/png, image/jpeg"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Whatsapp</label>
                        <input class="form-control" type="text" id="whatsapp" name="whatsapp" placeholder="whatsapp"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Instagram</label>
                        <input class="form-control" type="text" id="instagram" name="instagram" placeholder="instagram"/>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card text-center mb-3">
                    <div class="card-header border-bottom">
                            <div class="card-datatable table-responsive pt-0">
                                <table class="table table-bordered" style="overflow-x: auto;">
                                    <thead>
                                        <tr>
                                            <th> Titulo </th>
                                            <th> Imagen </th>
                                            <th> Instagram </th>
                                            <th> Whatsapp </th>
                                            <th> Opciones </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $emprendimientos as $emprendimiento )
                                            <tr>
                                                <td>{{ $emprendimiento->titulo }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                </td>
                                                <td>
                                                    <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                </td>
                                                <td>
                                                    <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info mb-2" alt="editar"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger mb-2" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="fa fa-trash"></i></a>
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