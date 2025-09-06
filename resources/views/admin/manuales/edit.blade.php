@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Manuales</h5>
        <div class="card-body">
            <form method="post" action="{{ url('manuales_update',[]) }}" enctype="multipart/form-data">
                <input class="form-control" type="hidden" id="id_manual" name="id_manual" value="{{$manual->id}}" />
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Archivo</label>
                        <input class="form-control" type="file" id="archivo" name="archivo" />
                    </div>
                </div>
                <div class="mb-12">
                    <button class="btn btn-warning">Actualizar</button>
                </div>
            </form>
            <div class="mb-12">
                <a href="{{ url('manuales')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection