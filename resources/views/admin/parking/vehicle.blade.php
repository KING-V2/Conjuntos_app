@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Registrar Reserva</h5>
        <div class="card-body">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">
                <i class="fa-solid fa-plus mr-2 text-blue-600"></i> Nuevo Vehículo
            </h2>
            <form action="{{ route('vehicles.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                <!-- Placa -->
                <div>
                    <label for="placa" class="block text-gray-700 font-medium">Placa</label>
                    <input type="text" id="placa" name="placa" value="{{ old('placa') }}" required class="w-full border px-3 py-2 focus:ring focus:ring-blue-200 @error('placa') border-red-500 @enderror">
                    @error('placa')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Marca -->
                <div>
                    <label for="marca" class="block text-gray-700 font-medium">Marca</label>
                    <input type="text" id="marca" name="marca" value="{{ old('marca') }}" required class="w-full border px-3 py-2 focus:ring focus:ring-blue-200 @error('marca') border-red-500 @enderror">
                    @error('marca')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Modelo -->
                <div>
                    <label for="modelo" class="block text-gray-700 font-medium">Modelo</label>
                    <input type="text" id="modelo" name="modelo" value="{{ old('modelo') }}" required class="w-full border px-3 py-2 focus:ring focus:ring-blue-200 @error('modelo') border-red-500 @enderror">
                    @error('modelo')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Propietario -->
                <div class="relative">
                    <label for="propietario" class="block text-gray-700 font-medium">Propietario</label>
                    <input type="text" id="propietario" name="propietario"
                        value="{{ old('propietario') }}"
                        required
                        class="w-full border px-3 py-2 focus:ring focus:ring-blue-200 @error('propietario') border-red-500 @enderror">
                    <!-- Aquí aparecerán los resultados -->
                    <ul id="clientResults" class="absolute bg-white border w-full mt-1 hidden max-h-40 overflow-y-auto z-10"></ul>
                    @error('propietario')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Descripción -->
                <div class="md:col-span-2">
                    <label for="descripcion" class="block text-gray-700 font-medium">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4" class="w-full border px-3 py-2 focus:ring focus:ring-blue-200 @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="md:col-span-2 flex justify-end space-x-3">
                    <a href="{{ route('vehicles.list') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Ver vehículos
                    </a>

                    <a href="{{ route('vehicles.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                        Cancelar
                    </a>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Guardar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
<!-- Scripts -->
<script>
    // Notificación de éxito (si existe en sesión)
    @if(session('success'))
        const alertBox = document.createElement("div");
        alertBox.className = "fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded shadow-lg transition-opacity duration-500";
        alertBox.innerText = "{{ session('success') }}";
        document.body.appendChild(alertBox);

        setTimeout(() => {
            alertBox.style.opacity = "0";
            setTimeout(() => alertBox.remove(), 500);
        }, 3000);
    @endif
    // Autocompletar propietario
const propietarioInput = document.getElementById('propietario');
const clientResults = document.getElementById('clientResults');

propietarioInput.addEventListener('input', function() {
    const query = this.value;

    if (query.length < 2) {
        clientResults.classList.add('hidden');
        return;
    }

    fetch(`clients/search?q=${query}`)
        .then(res => res.json())
        .then(data => {
            clientResults.innerHTML = '';
            if (data.length > 0) {
                data.forEach(client => {
                    const li = document.createElement('li');
                    li.className = "px-3 py-2 cursor-pointer hover:bg-blue-100";
                    li.innerHTML = `<strong>${client.nombre}</strong><br><span class="text-sm text-gray-600">${client.telefono}</span>`;
                    li.addEventListener('click', () => {
                        propietarioInput.value = client.nombre;
                        clientResults.classList.add('hidden');
                    });
                    clientResults.appendChild(li);
                });
                clientResults.classList.remove('hidden');
            } else {
                clientResults.classList.add('hidden');
            }
        });
});

// Ocultar resultados si se hace clic fuera
document.addEventListener('click', function(e) {
    if (!propietarioInput.contains(e.target) && !clientResults.contains(e.target)) {
        clientResults.classList.add('hidden');
    }
});
</script>
@endsection