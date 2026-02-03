@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Filtrar Reportes</h5>
        <div class="card-body">
            <form method="GET" action="{{ route('reports.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label>Desde</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label>Hasta</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="btn btn-info">
                            Filtrar
                        </button>
                    </div>
                </div>
            </form>

            <!-- Tabla de resultados -->
            <div class="overflow-x-auto">
                <table class="table table-striped w-full">
                    <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="py-2 px-4 border">Cod</th>
                        <th class="py-2 px-4 border">Factura</th>
                        <th class="py-2 px-4 border">Cliente</th>
                        <th class="py-2 px-4 border">Vehículo</th>
                        <th class="py-2 px-4 border">Monto</th>
                        <th class="py-2 px-4 border">Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reports as $report)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border text-center">{{ $report->id }}</td>
                            <td class="py-2 px-4 border">{{ $report->invoice_number }}</td>
                            <td class="py-2 px-4 border">{{ $report->client->nombre }}</td>
                            <td class="py-2 px-4 border">{{ $report->vehicle->placa }}</td>
                            <td class="py-2 px-4 border">${{ number_format($report->amount, 2) }}</td>
                            <td class="py-2 px-4 border">{{ $report->invoice_date->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center">No hay reportes disponibles.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection