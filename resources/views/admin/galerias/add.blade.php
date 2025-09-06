@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Cargue Galeria Conjunto</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_galeria_conjunto',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <label for="form" class="form-label">descripcion</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion" placeholder="descripcion" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">imagen</label>
                        <input class="form-control" type="file" id="imagen" name="imagen" accept=".jpeg,.png,.jpg" />
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
                                    <th> descripcion </th>
                                    <th> imagen</th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $galerias as $galeria )
                                    <tr>
                                        <td>{{ $galeria->id }}</td> 
                                        <td>{{ $galeria->descripcion }}</td>
                                        <td>
                                            <img src="{{ asset('storage/galeria_conjunto').'/'.$galeria->imagen }}" alt="imagen" width="200px;">
                                        </td>
                                        <td>
                                            <a href="{{ url('galeria_conjunto_edit',[ 'id' =>  $galeria->id ]) }}" class="btn btn-info"><i class="material-icons-outlined">editar</i></a>
                                            <a href="{{ url('galeria_conjunto_delete',[ 'id' =>  $galeria->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este elemento?');"><i class="material-icons-outlined">borrar</i></a>
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