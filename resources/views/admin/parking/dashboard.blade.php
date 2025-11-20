<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Parqueadero</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <!-- Sidebar sticky -->
    <aside class="w-64 bg-white shadow-md flex flex-col sticky top-0 h-screen">
        <!-- Menú con 10 módulos -->
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


        <!-- Cerrar sesión -->
        <div class="p-4 border-t">
            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="button" id="logoutBtn" class="w-full flex items-center justify-center bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- Contenido principal -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <!-- Header -->
        <header class="flex items-center justify-between bg-white shadow px-6 py-4 sticky top-0 z-10">
            <h1 class="text-2xl font-semibold text-gray-800">Bienvenido, {{ Auth::user()->name }}</h1>
            
            <!-- Perfil + Notificaciones -->
            <div class="flex items-center space-x-6 relative">
                <!-- Notificaciones -->
                <div class="relative">
                    <button id="notifBtn" class="w-10 h-10 flex items-center justify-center bg-blue-600 rounded-full relative focus:outline-none">
                        <i class="fa-solid fa-bell text-white text-lg"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full">3</span>
                    </button>
                    
                    <!-- Dropdown -->
                    <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-lg border z-20">
                        <div class="p-4 border-b">
                            <h3 class="text-gray-700 font-semibold">Notificaciones</h3>
                        </div>
                        <ul class="max-h-60 overflow-y-auto">
                            <li class="px-4 py-3 hover:bg-gray-100 flex items-start space-x-3">
                                <i class="fa-solid fa-car text-blue-500 mt-1"></i>
                                <span>Nuevo vehículo registrado.</span>
                            </li>
                            <li class="px-4 py-3 hover:bg-gray-100 flex items-start space-x-3">
                                <i class="fa-solid fa-clock text-green-500 mt-1"></i>
                                <span>Reserva confirmada para el espacio 12.</span>
                            </li>
                            <li class="px-4 py-3 hover:bg-gray-100 flex items-start space-x-3">
                                <i class="fa-solid fa-file-invoice-dollar text-yellow-500 mt-1"></i>
                                <span>Factura generada para usuario Juan.</span>
                            </li>
                        </ul>
                        <div class="p-2 border-t text-center">
                            <a href="#" class="text-blue-600 text-sm hover:underline">Ver todas</a>
                        </div>
                    </div>
                </div>

                <!-- Perfil -->
                <div class="flex items-center space-x-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=fff" 
                         alt="Perfil" 
                         class="w-10 h-10 rounded-full border">
                    <div class="flex flex-col">
                        <span class="text-gray-700">{{ Auth::user()->email }}</span>
                        <span class="text-sm text-gray-500">Administrador</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenido dinámico -->
        <main class="flex-1 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tarjetas -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2"><i class="fa-solid fa-car-side text-blue-600 mr-2"></i> Vehículos Registrados</h2>
                    <p class="text-gray-500 text-sm">Total: 120</p>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2"><i class="fa-solid fa-square-parking text-green-600 mr-2"></i> Espacios Disponibles</h2>
                    <p class="text-gray-500 text-sm">Total: 35</p>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2"><i class="fa-solid fa-file-invoice-dollar text-yellow-500 mr-2"></i> Facturación Hoy</h2>
                    <p class="text-gray-500 text-sm">$ 2.450.000</p>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2"><i class="fa-solid fa-clock text-purple-600 mr-2"></i> Reservas Activas</h2>
                    <p class="text-gray-500 text-sm">12</p>
                </div>

                <!-- Usuarios registrados -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2"><i class="fa-solid fa-user-group text-pink-600 mr-2"></i> Usuarios Registrados</h2>
                    <p class="text-gray-500 text-sm">58</p>
                </div>

                <!-- Nueva tarjeta -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2"><i class="fa-solid fa-sack-dollar text-green-600 mr-2"></i> Ingresos Hoy</h2>
                    <p class="text-gray-500 text-sm">$ 1.250.000</p>
                </div>

                <!-- Card con diagrama de barras -->
                <div class="bg-white rounded-xl shadow p-6 col-span-1 lg:col-span-2">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800"><i class="fa-solid fa-chart-column text-indigo-600 mr-2"></i> Entradas por Día (última semana)</h2>
                        <span class="text-sm text-gray-500">Actualizado: hoy</span>
                    </div>
                    <div class="w-full h-64">
                        <canvas id="barChart" class="w-full h-full"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2"><i class="fa-solid fa-ticket text-indigo-600 mr-2"></i> Planes Activos</h2>
                    <p class="text-gray-500 text-sm">8</p>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2"><i class="fa-solid fa-building text-red-500 mr-2"></i> Apartamentos</h2>
                    <p class="text-gray-500 text-sm">16 activos</p>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2"><i class="fa-solid fa-chart-line text-teal-600 mr-2"></i> Reportes</h2>
                    <p class="text-gray-500 text-sm">Último: ayer</p>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2"><i class="fa-solid fa-gear text-gray-600 mr-2"></i> Configuración</h2>
                    <p class="text-gray-500 text-sm">General del sistema</p>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Chart.js Script -->
<script>
    const ctx = document.getElementById('barChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
            datasets: [{
                label: 'Entradas',
                data: [45, 60, 75, 50, 90, 70, 85],
                backgroundColor: 'rgba(59,130,246,0.8)',
                borderColor: 'rgba(37,99,235,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
            plugins: { legend: { display: false } }
        }
    });
</script>

<!-- SweetAlert2 Logout -->
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
</script>

<!-- Toggle Notificaciones -->
<script>
    const notifBtn = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');

    notifBtn.addEventListener('click', () => {
        notifDropdown.classList.toggle('hidden');
    });

    // Cerrar al hacer clic fuera
    document.addEventListener('click', (e) => {
        if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
            notifDropdown.classList.add('hidden');
        }
    });
</script>

</body>
</html>
