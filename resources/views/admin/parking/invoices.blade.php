@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Facturacion</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('invoices.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label>Número de Factura</label>
                        <input type="text" name="invoice_number" value="{{ old('invoice_number') }}" required class="form-control @error('invoice_number') border-red-500 @enderror">
                        @error('invoice_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Cliente</label>
                        <select name="client_id" required class="form-control">
                            <option value="">Seleccione un cliente</option>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Vehículo</label>
                        <select name="vehicle_id" required class="form-control">
                            <option value="">Seleccione un vehículo</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->placa }} - {{ $vehicle->propietario }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label>Monto</label>
                        <input type="text" name="amount" value="{{ old('amount') }}" required class="form-control @error('amount') border-red-500 @enderror">
                        @error('amount')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-4">
                        <label>Fecha de Factura</label>
                        <input type="date" name="invoice_date" value="{{ old('invoice_date') }}" required class="form-control @error('invoice_date') border-red-500 @enderror">
                        @error('invoice_date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-12 mb-4">
                    <label>Descripción</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                </div>

                <div class="md:col-span-2 flex justify-end space-x-3 mt-2">
                    <a href="#" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar Factura</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection