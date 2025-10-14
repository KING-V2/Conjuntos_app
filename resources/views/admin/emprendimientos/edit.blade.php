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
                        <label for="form" class="form-label">Titulo</label>
                        <input class="form-control" type="text" id="titulo" name="titulo" value="{{$emprendimiento->titulo}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="formFile" class="form-label">Imagen</label>
                        <input class="form-control" type="file" id="imagen" name="imagen" accept="image/jpg, image/png, image/jpeg"/>
                    </div>
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