@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Tabla Residentes</h5>
        <div class="card-body">
            <form id="filter-form" class="mb-4">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Casa</label>
                        <select class="form-control" name="filter_casa_id" id="filter_casa_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $casas as  $casa )
                                <option value="{{ $casa->id }}">{{ $casa->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Residente</label>
                        <select class="form-control" name="filter_usuario_id" id="filter_usuario_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $usuarios as $usuario )
                                <option value="{{ $usuario->id }}">{{ $usuario->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="filter_estado" id="filter_estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Activo">Activo</option>
                            <option value="No Activo">No Activo</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Tipo Residente</label>
                        <select class="form-control" name="filter_tipo_residente" id="filter_tipo_residente">
                            <option value="">-- Seleccione --</option>
                            <option value="Propietario">Propietario</option>
                            <option value="Arrendatario">Arrendatario</option>
                        </select>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="col-md-12">
                        <button type="button" id="filter" class="btn btn-primary">Filtrar</button>
                        <button type="button" id="reset" class="btn btn-secondary">Resetear</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="card-datatable text-nowrap">
                <table id="dt-search-residente" class="table table-bordered">
                    <thead>
                        <tr>
                            <th> casa </th>
                            <th> residente </th>
                            <th> estado </th>
                            <th> tipo residente </th>
                            <th> Opciones </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/js/residentes/residentes.js') }}"></script>
@endsection