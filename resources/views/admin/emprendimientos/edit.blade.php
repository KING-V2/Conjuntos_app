@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Emprendimiento</h5>
        <div class="card-body">
            <form method="post" action="{{ url('emprendimiento_update',[]) }}" enctype="multipart/form-data">
                <input class="form-control" type="hidden" id="id_emprendimiento" name="id_emprendimiento" value="{{$emprendimiento->id}}" />
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Mes</label>
                        <select class="form-control" name="mes" id="mes" required>
                        <option value="" {{ $emprendimiento->mes == "" ? 'selected' : '' }} >-- Seleccione --</option>
                            <option value="Enero" {{ $emprendimiento->mes == "Enero" ? 'selected' : '' }} >Enero</option>
                            <option value="Febrero" {{ $emprendimiento->mes == "Febrero" ? 'selected' : '' }} >Febrero</option>
                            <option value="Marzo" {{ $emprendimiento->mes == "Marzo" ? 'selected' : '' }} >Marzo</option>
                            <option value="Abril" {{ $emprendimiento->mes == "Abril" ? 'selected' : '' }} >Abril</option>
                            <option value="Mayo" {{ $emprendimiento->mes == "Mayo" ? 'selected' : '' }} >Mayo</option>
                            <option value="Junio" {{ $emprendimiento->mes == "Junio" ? 'selected' : '' }} >Junio</option>
                            <option value="Julio" {{ $emprendimiento->mes == "Julio" ? 'selected' : '' }} >Julio</option>
                            <option value="Agosto" {{ $emprendimiento->mes == "Agosto" ? 'selected' : '' }} >Agosto</option>
                            <option value="Septiembre" {{ $emprendimiento->mes == "Septiembre" ? 'selected' : '' }} >Septiembre</option>
                            <option value="Octubre" {{ $emprendimiento->mes == "Octubre" ? 'selected' : '' }} >Octubre</option>
                            <option value="Noviembre" {{ $emprendimiento->mes == "Noviembre" ? 'selected' : '' }} >Noviembre</option>
                            <option value="Diciembre" {{ $emprendimiento->mes == "Diciembre" ? 'selected' : '' }} >Diciembre</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Titulo</label>
                        <input class="form-control" type="text" id="titulo" name="titulo" value="{{$emprendimiento->titulo}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="formFile" class="form-label">Imagen</label>
                        <input class="form-control" type="file" id="imagen" name="imagen" accept="image/jpg, image/png, image/jpeg"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Instagram</label>
                        <input class="form-control" type="text" id="instagram" name="instagram" value="{{$emprendimiento->instagram}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Whatsapp</label>
                        <input class="form-control" type="text" id="whatsapp" name="whatsapp" value="{{$emprendimiento->whatsapp}}" />
                    </div>
                </div>
                <div class="mb-12">
                    <button class="btn btn-warning">Actualizar</button>
                </div>
            </form>
            <div class="mb-12">
                <a href="{{ url('emprendimientos')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection