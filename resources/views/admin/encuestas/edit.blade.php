@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Actualizacion Encuestas</h5>
        <div class="card-body">
            <form method="post" action="{{ url('encuestas_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="encuesta_id" name="encuesta_id" value="{{ $encuesta->id }}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Mes</label>
                        <select class="form-control" name="mes" id="mes">
                            <option value="">-- Seleccione --</option>
                            <option value="Enero" {{ $encuesta->mes == 'Enero' ? 'selected' : ''}}>Enero</option>
                            <option value="Febrero" {{ $encuesta->mes == 'Febrero' ? 'selected' : ''}}>Febrero</option>
                            <option value="Marzo" {{ $encuesta->mes == 'Marzo' ? 'selected' : ''}}>Marzo</option>
                            <option value="Abril" {{ $encuesta->mes == 'Abril' ? 'selected' : ''}}>Abril</option>
                            <option value="Mayo" {{ $encuesta->mes == 'Mayo' ? 'selected' : ''}}>Mayo</option>
                            <option value="Junio" {{ $encuesta->mes == 'Junio' ? 'selected' : ''}}>Junio</option>
                            <option value="Julio" {{ $encuesta->mes == 'Julio' ? 'selected' : ''}}>Julio</option>
                            <option value="Agosto" {{ $encuesta->mes == 'Agosto' ? 'selected' : ''}}>Agosto</option>
                            <option value="Septiembre" {{ $encuesta->mes == 'Septiembre' ? 'selected' : ''}}>Septiembre</option>
                            <option value="Octubre" {{ $encuesta->mes == 'Octubre' ? 'selected' : ''}}>Octubre</option>
                            <option value="Noviembre" {{ $encuesta->mes == 'Noviembre' ? 'selected' : ''}}>Noviembre</option>
                            <option value="Diciembre" {{ $encuesta->mes == 'Diciembre' ? 'selected' : ''}}>Diciembre</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Opciones</label>
                        <select class="form-control" name="opciones" id="opciones">
                            <option value="">-- Seleccione --</option>
                            <option value="Si/No" {{ $encuesta->opciones == 'Si/No' ? 'selected' : ''}} >Si/No</option>
                            <option value="Acuerdo/Desacuerdo" {{ $encuesta->opciones == 'Acuerdo/Desacuerdo' ? 'selected' : ''}} >Acuerdo/Desacuerdo</option>
                            <option value="Nivel de Satisfaccion" {{ $encuesta->opciones == 'Nivel de Satisfaccion' ? 'selected' : ''}} >Nivel de Satisfaccion</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Activo" {{ $encuesta->estado == 'Activo' ? 'selected' : ''}} >Activo</option>
                            <option value="No Activo" {{ $encuesta->estado == 'No Activo' ? 'selected' : ''}} >No Activo</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Tipo Residente</label>
                        <select class="form-control" name="tipo_residente" id="tipo_residente">
                            <option value="">-- Seleccione --</option>
                            <option value="Arrendatario" {{ $encuesta->tipo_residente == 'Arrendatario' ? 'selected' : ''}}>Arrendatario</option>
                            <option value="Propietario" {{ $encuesta->tipo_residente == 'Propietario' ? 'selected' : ''}}>Propietario</option>
                            <option value="Ambos" {{ $encuesta->tipo_residente == 'Ambos' ? 'selected' : ''}}>Ambos</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <textarea class="form-control" rows="6" type="text" id="descripcion" name="descripcion" placeholder="descripcion encuesta">{{$encuesta->descripcion}}</textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="mb-12">
                        <button class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="mb-12">
                <a href="{{ url('encuestas')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection