@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Registrar Reserva</h5>
        <div class="card-body">
            <form method="POST" class="form-control"    action="{{ route('reservations.store') }}">
                @csrf
                <div class="col-md-4 mb-3">
                    <label for="vehicle_plate">Placa del Vehículo</label>
                    <input type="text" id="vehicle_plate" name="vehicle_plate" value="{{ old('vehicle_plate') }}" required class="form-control">
                    <ul id="vehicleResults" class="absolute bg-white border w-full mt-1 hidden max-h-40 overflow-y-auto z-10"></ul>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="space_number">Número de Espacio</label>
                        <input type="text" id="space_number" name="space_number" value="{{ old('space_number') }}" required class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="reservation_date">Fecha de Reserva</label>
                        <input type="date" id="reservation_date" name="reservation_date" value="{{ old('reservation_date') }}" required class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="client_name">Propietario</label>
                        <input type="text" id="client_name" name="client_name" value="{{ old('client_name') }}" required readonly class="form-control">
                    </div>
                    <div class="md:col-span-2 flex justify-end space-x-3">
                        <a href="#" class="btn btn-warning">Cancelar</a>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('javascripts')

<script>
    const vehiclePlateInput = document.getElementById('vehicle_plate');
    const vehicleResults = document.getElementById('vehicleResults');
    const clientNameInput = document.getElementById('client_name');

    vehiclePlateInput.addEventListener('input', function() {
        const query = this.value.trim();

        if (query.length < 2) {
            vehicleResults.classList.add('hidden');
            return;
        }

        fetch("{{ route('vehicles.search') }}?q=" + query)
            .then(res => res.json())
            .then(data => {
                vehicleResults.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(vehicle => {
                        const li = document.createElement('li');
                        li.className = "px-3 py-2 cursor-pointer hover:bg-blue-100";
                        li.innerHTML = `
                            <strong>${vehicle.placa}</strong><br>
                            <span class="text-sm text-gray-600">Propietario: ${vehicle.propietario}</span>
                        `;
                        li.addEventListener('click', () => {
                            vehiclePlateInput.value = vehicle.placa;
                            clientNameInput.value = vehicle.propietario;
                            vehicleResults.classList.add('hidden');
                        });
                        vehicleResults.appendChild(li);
                    });
                    vehicleResults.classList.remove('hidden');
                } else {
                    vehicleResults.classList.add('hidden');
                }
            });
    });

    document.addEventListener('click', function(e) {
        if (!vehiclePlateInput.contains(e.target) && !vehicleResults.contains(e.target)) {
            vehicleResults.classList.add('hidden');
        }
    });
</script>
@endsection