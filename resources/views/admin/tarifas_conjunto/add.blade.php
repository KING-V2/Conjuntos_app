@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Tarifas Conjunto</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_tarifas_conjunto',[]) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Tipo Tarifa</label>
                        <select class="form-control" name="tipo" id="tipo">
                            <option value="">-- Seleccione --</option>
                            <option value="administrativa">Administrativa</option>
                            <option value="parqueadero_visitantes">Parqueadero Visitantes</option>
                            <option value="multa">Multa</option>
                            <option value="otros">Otros</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <label for="form" class="form-label">Descripcion Tarifa</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion" placeholder="descripcion de la tarifa" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">valor Tarifa</label>
                        <input class="form-control" type="number" id="valor" name="valor" placeholder="valor tarifa" value=""/>
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
                                    <th> tipo </th>
                                    <th> descripcion </th>
                                    <th> estado </th>
                                    <th> valor </th>
                                    <th> opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $tarifas_conjunto as $tarifas )
                                    <tr>
                                        <td>{{ $tarifas->id }}</td>
                                        <td>{{ $tarifas->tipo }}</td>
                                        <td>{{ $tarifas->descripcion }}</td>
                                        <td>{{ $tarifas->estado }}</td>
                                        <td>{{ $tarifas->valor }}</td>
                                        <td>
                                            <a href="{{ url('tarifas_conjunto_edit',[ 'id' =>  $tarifas->id ]) }}" data-bs-toggle="tooltip" data-bs-offset="0,8" data-bs-placement="top" data-bs-custom-class="tooltip-primary" title="Editar tarifas"  class="btn btn-info"><i class="material-icons-outlined">editar</i></a>
                                            <a href="{{ url('tarifas_conjunto_delete',[ 'id' =>  $tarifas->id ]) }}" data-bs-toggle="tooltip" data-bs-offset="0,8" data-bs-placement="top" data-bs-custom-class="tooltip-primary" title="Eliminar Visitante" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');"><i class="material-icons-outlined">borrar</i></a>
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
@section('vendors_js')
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/js/ui-popover.js') }}"></script>
    
@endsection