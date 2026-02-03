@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Registrar Reserva</h5>
        <div class="card-body">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">
                    <i class="fa-solid fa-plus mr-2 text-blue-600"></i> Nuevo Espacio
                </h2>
                <form action="{{ route('spaces.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf

                    <!-- Número -->
                    <div>
                        <label for="numero" class="block text-gray-700 font-medium">Número</label>
                        <input type="text" id="numero" name="numero" value="{{ old('numero') }}" required class="w-full border px-3 py-2">
                        @error('numero') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Ubicación -->
                    <div>
                        <label for="ubicacion" class="block text-gray-700 font-medium">Ubicación</label>
                        <input type="text" id="ubicacion" name="ubicacion" value="{{ old('ubicacion') }}" class="w-full border px-3 py-2">
                        @error('ubicacion') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tipo -->
                    <div>
                        <label for="tipo" class="block text-gray-700 font-medium">Tipo</label>
                        <select id="tipo" name="tipo" class="w-full border px-3 py-2">
                            <option value="carro">Carro</option>
                            <option value="moto">Moto</option>
                            <option value="bicicleta">Bicicleta</option>
                        </select>
                        @error('tipo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Estado -->
                    <div>
                        <label for="estado" class="block text-gray-700 font-medium">Estado</label>
                        <select id="estado" name="estado" class="w-full border px-3 py-2">
                            <option value="disponible">Disponible</option>
                            <option value="ocupado">Ocupado</option>
                            <option value="reservado">Reservado</option>
                        </select>
                        @error('estado') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Botones -->
                    <div class="md:col-span-2 flex justify-end space-x-3">
                        <a href="{{ route('spaces.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 hover:bg-gray-400">Cancelar</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 hover:bg-blue-700">Guardar</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
<!-- Scripts -->
<script>

    // Mensaje de éxito
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
</script>
@endsection