@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Citofonia</h1>
        <div class="card-body">      
            <hr>      
            <div class="col-sm-12 col-md-4">
                <button id="exportExcelBtn" class="btn btn-success btn-md">Exportar</button>
            </div>
            <hr>
            <div class="card">
                <div class="card-datatable table-responsive pt-0">
                    <table id="dt-search-citofonia" class="table table-bordered" style="overflow-x: auto;">
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
@section('javascripts')
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script>
        document.getElementById('exportExcelBtn').addEventListener('click', function() {
            const table = document.getElementById('dt-search-citofonia');
            const wb = XLSX.utils.table_to_book(table, { sheet: "Datos" });
            XLSX.writeFile(wb, 'tabla_export_' + new Date().toISOString().slice(0,19).replace(/[:T]/g,'_') + '.xlsx');
        });
    </script>
@endsection