@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Citofonia</h1>
        <div class="card-body">            
            <div class="card">
                <div class="card-datatable table-responsive pt-0">
                    <table class="table table-bordered" style="overflow-x: auto;">
                        <thead>
                            <tr>
                                <th> Nombre </th>
                                <th> Telefono uno</th>
                                <th> Telefono dos</th>
                                <th> Telefono tres</th>
                                <th> Telefono cuatro</th>
                                <th> Telefono cinco</th>
                                <th> Opciones </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $casas as $casa )
                                <tr>
                                    <td>{{ $casa->nombre }}</td>
                                    <td>{{ $casa->telefono_uno }}</td>
                                    <td>{{ $casa->telefono_dos }}</td>
                                    <td>{{ $casa->telefono_tres }}</td>
                                    <td>{{ $casa->telefono_cuatro }}</td>
                                    <td>{{ $casa->telefono_cinco }}</td>
                                    <td>
                                        <a href="{{ url('casas_edit',[ 'id' =>  $casa->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                        <!-- <a href="{{ url('casas_delete',[ 'id' =>  $casa->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta casa?');"><i class="fa fa-trash"></i></a> -->
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
@endsection