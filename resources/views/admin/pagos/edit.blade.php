@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Pago</h5>
        <div class="card-body">
            <form action="{{ url('pagos_update', []) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="form-control" type="hidden" id="pago_id" name="pago_id" value="{{$pago->id}}" />
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Tipo de Pago</label>
                        <select class="form-control" name="tipo_pago" id="tipo_pago" required>
                            @foreach($tipos_pagos as $tipos_pago)
                                <option value="{{ $tipos_pago }}" {{ $pago->tipo_pago == $tipos_pago ? 'selected' : '' }}>{{ $tipos_pago }}</option>
                            @endforeach
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Casa</label>
                        <select class="form-control" name="bloque_id" id="bloque_id" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($casas as $casa)
                                <option value="{{ $casa->id }}" {{ $pago->casa_id == $casa->id ? 'selected' : '' }}>{{ $bloque->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Mes</label>
                        <select class="form-control" name="mes" id="mes" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($meses as $mes)
                                <option value="{{ $mes }}" {{ $pago->mes == $mes ? 'selected' : '' }}>{{ $mes }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Estado</label>
                        <select name="estado" class="form-control">
                            <option {{ $pago->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option {{ $pago->estado == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
                            <option {{ $pago->estado == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Descripción</label>
                        <textarea name="comentario_admin" id="comentario_admin" class="form-control">{{ $pago->comentario_admin }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Adjunto</label>
                        @if($pago->adjunto)
                            <p><a href="{{ asset('storage/pagos/' . $pago->adjunto) }}" target="_blank">Ver archivo actual</a></p>
                        @endif
                        <input type="file" name="adjunto" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Descripción</label>
                        <textarea name="descripcion" class="form-control" readonly>{{ $pago->descripcion }}</textarea>
                    </div>
                </div>
                <div class=" col-md-12 mb-3">
                    <label>Comentario del Administrador</label>
                    <textarea name="comentario_admin" class="form-control">{{ $pago->comentario_admin }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ url('pagos') }}" class="btn btn-secondary">Volver</a>
            </form>
            <hr>
            <div class="mb-12">
                <a href="{{ url('pagos')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection