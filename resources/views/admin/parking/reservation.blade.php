<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Reserva - Parqueadero</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md flex flex-col sticky top-0 h-screen">
   <nav class="flex-1 flex flex-col justify-center p-4 space-y-3 text-gray-700">
    <a href="{{ route('dashboard') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-gauge mr-3"></i> Dashboard
    </a>

    <a href="{{ route('clients.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('clients.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-user-group mr-3"></i> Clientes
    </a>

    <a href="{{ route('vehicles.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('vehicles.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-car mr-3"></i> Vehículos
    </a>

    <a href="{{ route('spaces.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('spaces.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-square-parking mr-3"></i> Espacios
    </a>

    <a href="{{ route('reservations.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('reservations.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-clock mr-3"></i> Reservas
    </a>

    <a href="{{ route('invoices.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('invoices.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-file-invoice-dollar mr-3"></i> Facturación
    </a>

    <a href="{{ route('reports.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('reports.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-chart-line mr-3"></i> Reportes
    </a>

    <a href="{{ route('apartments.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('apartments.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-building mr-3"></i> Apartamentos
    </a>

    <a href="{{ route('settings.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('settings.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-gear mr-3"></i> Configuración
    </a>
</nav>

        <div class="p-4 border-t">
            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="button" id="logoutBtn" class="w-full flex items-center justify-center bg-red-500 text-white px-3 py-2 hover:bg-red-600">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- Contenido -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <!-- Header -->
        <header class="flex items-center justify-between bg-white shadow px-6 py-4 sticky top-0 z-10">
            <h1 class="text-2xl font-semibold text-gray-800">Nueva Reserva</h1>
            <div class="flex items-center space-x-6 relative">
                <!-- Notificaciones -->
                <div class="relative">
                    <button id="notifBtn" class="w-10 h-10 flex items-center justify-center bg-blue-600 rounded-full relative focus:outline-none">
                        <i class="fa-solid fa-bell text-white text-lg"></i>
                    </button>
                    <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-72 bg-white shadow-lg border z-20">
                        <div class="p-4 border-b"><h3 class="text-gray-700 font-semibold">Notificaciones</h3></div>
                        <ul class="max-h-60 overflow-y-auto">
                            <li class="px-4 py-3 hover:bg-gray-100 flex items-start space-x-3">
                                <i class="fa-solid fa-car text-blue-500 mt-1"></i><span>Nueva reserva registrada.</span>
                            </li>
                        </ul>
                        <div class="p-2 border-t text-center"><a href="#" class="text-blue-600 text-sm hover:underline">Ver todas</a></div>
                    </div>
                </div>
                <!-- Perfil -->
                <div class="flex items-center space-x-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=fff"
                         alt="Perfil" class="w-10 h-10 rounded-full border">
                    <div class="flex flex-col">
                        <span class="text-gray-700">{{ Auth::user()->email }}</span>
                        <span class="text-sm text-gray-500">Administrador</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Formulario -->
        <main class="flex-1 p-6">
            <div class="bg-white shadow p-6 w-full">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">
                    <i class="fa-solid fa-plus mr-2 text-blue-600"></i> Registrar Reserva
                </h2>
                <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf

                    <!-- Placa del vehículo -->
                    <div class="relative">
                        <label for="vehicle_plate" class="block text-gray-700 font-medium">Placa del Vehículo</label>
                        <input type="text" id="vehicle_plate" name="vehicle_plate" value="{{ old('vehicle_plate') }}" required class="w-full border px-3 py-2 focus:ring focus:ring-blue-200 @error('vehicle_plate') border-red-500 @enderror">
                        <ul id="vehicleResults" class="absolute bg-white border w-full mt-1 hidden max-h-40 overflow-y-auto z-10"></ul>
                        @error('vehicle_plate')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Número de espacio -->
                    <div>
                        <label for="space_number" class="block text-gray-700 font-medium">Número de Espacio</label>
                        <input type="text" id="space_number" name="space_number" value="{{ old('space_number') }}" required class="w-full border px-3 py-2 focus:ring focus:ring-blue-200 @error('space_number') border-red-500 @enderror">
                        @error('space_number')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de reserva -->
                    <div>
                        <label for="reservation_date" class="block text-gray-700 font-medium">Fecha de Reserva</label>
                        <input type="date" id="reservation_date" name="reservation_date" value="{{ old('reservation_date') }}" required class="w-full border px-3 py-2 focus:ring focus:ring-blue-200 @error('reservation_date') border-red-500 @enderror">
                        @error('reservation_date')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Propietario -->
                    <div>
                        <label for="client_name" class="block text-gray-700 font-medium">Propietario</label>
                        <input type="text" id="client_name" name="client_name" value="{{ old('client_name') }}" required readonly class="w-full border px-3 py-2 bg-gray-100 focus:ring focus:ring-blue-200 @error('client_name') border-red-500 @enderror">
                        @error('client_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="md:col-span-2 flex justify-end space-x-3">
                        <a href="#" class="bg-gray-300 text-gray-700 px-4 py-2 hover:bg-gray-400">Cancelar</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 hover:bg-blue-700">Guardar</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<!-- Scripts -->
<script>
    document.getElementById('logoutBtn').addEventListener('click', function () {
        Swal.fire({
            title: '¿Cerrar sesión?',
            text: "Tu sesión actual se cerrará.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, salir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });

    const notifBtn = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');
    notifBtn.addEventListener('click', () => notifDropdown.classList.toggle('hidden'));
    document.addEventListener('click', (e) => {
        if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
            notifDropdown.classList.add('hidden');
        }
    });

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

</body>
</html>
