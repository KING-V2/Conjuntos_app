<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Vehículo - Parqueadero</title>
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
            <h1 class="text-2xl font-semibold text-gray-800">Registrar Vehículo</h1>
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
                                <i class="fa-solid fa-car text-blue-500 mt-1"></i><span>Nuevo vehículo registrado.</span>
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
        </main>
    </div>
</div>

<!-- Scripts -->
<script>
    // Confirmación de logout
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

    // Dropdown notificaciones
    const notifBtn = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');
    notifBtn.addEventListener('click', () => notifDropdown.classList.toggle('hidden'));
    document.addEventListener('click', (e) => {
        if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
            notifDropdown.classList.add('hidden');
        }
    });

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
</script>

<script>
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

</body>
</html>
