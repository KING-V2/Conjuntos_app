@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Registro Apartamentos</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('apartments.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>Nombre / Número</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Número de apartamento</label>
                        <input type="text" name="number" value="{{ old('number') }}" class="form-control"> 
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Bloque</label>
                        <input type="text" name="block" value="{{ old('block') }}" class="form-control">   
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Piso</label>
                        <input type="number" name="floor" value="{{ old('floor') }}" class="form-control"> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>Dirección</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="form-control">   
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Teléfono</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">   
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control">  
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Cliente</label>
                        <select name="client_id" required class="form-control"> 
                            <option value="">Seleccione un cliente</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->nombre }}</option>
                            @endforeach
                        </select>       
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Notas</label>
                    <textarea name="notes" rows="4" class="form-control">{{ old('notes') }}</textarea> 
                </div>

                <div class="md:col-span-2 flex justify-end space-x-3">
                    <a href="#" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar Apartamento</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection