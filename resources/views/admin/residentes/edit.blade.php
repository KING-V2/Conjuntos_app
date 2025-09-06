@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Modificar Residente: <strong> {{ $residente->usuario->name }} </strong></h5>
        <div class="card-body">
            <form method="post" action="{{ url('residentes_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="residente_id" name="residente_id" placeholder="residente_id" value="{{ $residente->id }}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Casa</label>
                        <select class="form-control" name="casa_id" id="casa_id">
                            @foreach( $casas as $casa )
                                <option value="{{$casa->id }}" {{ $residente->casas->id == $casa->id ? 'selected' : ''}} >{{$casa->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Activo" {{ $residente->estado == 'Activo' ? 'selected' : ''}} >Activo</option>
                            <option value="No Activo" {{ $residente->estado == 'No Activo' ? 'selected' : ''}} >No Activo</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Tipo Residente</label>
                        <select class="form-control" name="tipo_residente" id="tipo_residente">
                            <option value="">-- Seleccione --</option>
                                <option value="Propietario" {{ $residente->tipo_residente == 'Propietario' ? 'selected' : ''}} >Propietario</option>
                                <option value="Arrendatario" {{ $residente->tipo_residente == 'Arrendatario' ? 'selected' : ''}} >Arrendatario</option>
                        </select>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <h3>Información adicional</h3>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Parqueadero</label>
                        <select class="form-control" name="parqueadero_id" id="parqueadero_id">
                            <option value="">-- Seleccione --</option>
                            @foreach($parqueaderos as $parqueadero)
                                <option value="{{ $parqueadero->id }}" 
                                    {{ isset($residente->parqueadero) && $residente->parqueadero->id == $parqueadero->id ? 'selected' : '' }}>
                                    {{ $parqueadero->nombre }} - {{ $parqueadero->estado }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label"># Carros </label>
                        <input class="form-control" type="number" id="no_carros" name="no_carros" placeholder="no_carros" value="{{ $residente->no_carros}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label"># motos </label>
                        <input class="form-control" type="number" id="no_motos" name="no_motos" placeholder="no_motos" value="{{ $residente->no_motos}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label"># mascotas </label>
                        <input class="form-control" type="number" id="no_mascotas" name="no_mascotas" placeholder="no_mascotas" value="{{ $residente->no_mascotas}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label"># perros </label>
                        <input class="form-control" type="number" id="no_perros" name="no_perros" placeholder="no_perros" value="{{ $residente->no_perros}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label"># gatos </label>
                        <input class="form-control" type="number" id="no_gatos" name="no_gatos" placeholder="no_gatos" value="{{ $residente->no_gatos}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label"># adultos </label>
                        <input class="form-control" type="number" id="no_adultos" name="no_adultos" placeholder="no_adultos" value="{{ $residente->no_adultos}}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label"># niños </label>
                        <input class="form-control" type="number" id="no_ninos" name="no_ninos" placeholder="no_ninos" value="{{ $residente->no_ninos}}"/>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Actualizar</button>
            </form>
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

    <script src="{{ asset('assets/js/residentes/residentes.js') }}"></script>
@endsection