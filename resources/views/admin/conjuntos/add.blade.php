@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Conjunto</h1>
        <div class="card-body">
            @empty( $conjuntos[0] )
                <form method="post" action="{{ url('cargar_conjuntos',[]) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <label for="form" class="form-label">nombre</label>
                            <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value=""/>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="form" class="form-label">direccion</label>
                            <input class="form-control" type="text" id="direccion" name="direccion" placeholder="direccion" value=""/>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="form" class="form-label">nit</label>
                            <input class="form-control" type="text" id="nit" name="nit" placeholder="nit" value=""/>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="form" class="form-label">Administrador</label>
                            <select class="form-control" name="administrador_id" id="administrador_id">
                                <option value="">-- Seleccione --</option>
                                @foreach( $administradores as $administrador )
                                    <option value="{{$administrador->id }}">{{$administrador->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <label for="form" class="form-label">icono</label>
                            <input class="form-control" type="file" id="icono" name="icono" accept=".jpg, .jpeg, .png"/>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="form" class="form-label">logo</label>
                            <input class="form-control" type="file" id="logo" name="logo" accept=".jpg, .jpeg, .png"/>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <h1 class="card-header">Casas</h1>
                        <div class="col-sm-12 col-md-3">
                            <label for="form" class="form-label">Numero de Casas</label>
                            <input class="form-control" type="number" id="numero_casas" name="numero_casas" placeholder="Ej: 5" min="1" max="999"/>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success" onclick="return confirm('¿Estás seguro de que deseas Crear este Conjunto?');">Cargar</button>
                </form>
            @endempty
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th> Id </th>
                                    <th> Nombre </th>
                                    <th> Direccion </th>
                                    <th> Nit </th>
                                    <th> Icono </th>
                                    <th> Logo </th>
                                    <th> Administrador </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $conjuntos as $conjunto )
                                    <tr>
                                        <td>{{ $conjunto->id }}</td>
                                        <td>{{ $conjunto->nombre }}</td>
                                        <td>{{ $conjunto->direccion }}</td>
                                        <td>{{ $conjunto->nit }}</td>
                                        <td>
                                            <img src="{{ asset('storage/iconos').'/'.$conjunto->icono }}" alt="" width="70%">
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/logos').'/'.$conjunto->logo }}" alt="" width="70%">
                                        </td>
                                        <td>{{ $conjunto->administrador->name ? $conjunto->administrador->name : NA }}</td>
                                        <td>
                                                <a href="{{ url('conjuntos_edit',[ 'id' =>  $conjunto->id ]) }}" class="btn btn-info mb-2">
                                                    <i class="material-icons-outlined">edit</i>
                                                </a>
                                                <a href="{{ url('conjuntos_delete',[ 'id' =>  $conjunto->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este conjunto?');">
                                                    <i class="material-icons-outlined">delete</i>
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