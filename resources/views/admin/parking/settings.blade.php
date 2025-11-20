<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - Parqueadero</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
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
       class="flex items-center p-2 rounded-lg bg-blue-600 text-white">
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
            <h1 class="text-2xl font-semibold text-gray-800">Configuración</h1>
            <div class="flex items-center space-x-6 relative">
                <!-- Notificaciones -->
                <div class="relative">
                    <button id="notifBtn" class="w-10 h-10 flex items-center justify-center bg-blue-600 rounded-full focus:outline-none">
                        <i class="fa-solid fa-bell text-white text-lg"></i>
                    </button>
                    <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-72 bg-white shadow-lg border z-20">
                        <div class="p-4 border-b"><h3 class="text-gray-700 font-semibold">Notificaciones</h3></div>
                        <ul class="max-h-60 overflow-y-auto">
                            <li class="px-4 py-3 hover:bg-gray-100 flex items-start space-x-3">
                                <i class="fa-solid fa-gear text-blue-500 mt-1"></i>
                                <span>Configuración actualizada.</span>
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

        <!-- Contenido principal -->
        <main class="flex-1 p-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4"><i class="fa-solid fa-gear mr-2 text-blue-600"></i> Panel de Configuración</h2>

                <!-- Tabs -->
                <div class="flex space-x-4 mb-6 border-b">
                    <button class="py-2 px-4 font-medium border-b-2 border-blue-600 text-blue-600" onclick="openTab(event, 'general')">General</button>
                    <button class="py-2 px-4 font-medium hover:text-blue-600" onclick="openTab(event, 'usuarios')">Usuarios</button>
                    <button class="py-2 px-4 font-medium hover:text-blue-600" onclick="openTab(event, 'pagos')">Pagos</button>
                    <button class="py-2 px-4 font-medium hover:text-blue-600" onclick="openTab(event, 'seguridad')">Seguridad</button>
                </div>

                <!-- Tab General -->
                <div id="general" class="tab-content">
                    <h3 class="text-lg font-semibold mb-3">Ajustes Generales</h3>
                    <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium">Nombre del Sistema</label>
                            <input type="text" value="ParqueaderoApp" class="w-full border px-3 py-2 focus:ring focus:ring-blue-200">
                        </div>
                        <div>
                            <label class="block font-medium">Zona Horaria</label>
                            <select class="w-full border px-3 py-2 focus:ring focus:ring-blue-200">
                                <option selected>America/Bogota</option>
                                <option>America/New_York</option>
                                <option>Europe/Madrid</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block font-medium">Descripción del Sistema</label>
                            <textarea class="w-full border px-3 py-2 focus:ring focus:ring-blue-200" rows="4">Sistema de gestión de parqueaderos y facturación.</textarea>
                        </div>
                        <div class="md:col-span-2 flex justify-end">
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar Cambios</button>
                        </div>
                    </form>
                </div>

                <!-- Tab Usuarios -->
                <div id="usuarios" class="tab-content hidden">
                    <h3 class="text-lg font-semibold mb-3">Administrar Usuarios</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded shadow">
                            <h4 class="font-semibold mb-2">Agregar Usuario</h4>
                            <form>
                                <input type="text" placeholder="Nombre" class="w-full border px-3 py-2 mb-2">
                                <input type="email" placeholder="Email" class="w-full border px-3 py-2 mb-2">
                                <input type="password" placeholder="Contraseña" class="w-full border px-3 py-2 mb-2">
                                <button class="bg-green-500 text-white px-4 py-2 mt-2 hover:bg-green-600">Agregar</button>
                            </form>
                        </div>
                        <div class="bg-gray-50 p-4 rounded shadow">
                            <h4 class="font-semibold mb-2">Lista de Usuarios</h4>
                            <ul class="space-y-2">
                                <li class="flex justify-between items-center p-2 bg-white rounded shadow">
                                    Juan Pérez
                                    <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Eliminar</button>
                                </li>
                                <li class="flex justify-between items-center p-2 bg-white rounded shadow">
                                    María López
                                    <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Eliminar</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tab Pagos -->
                <div id="pagos" class="tab-content hidden">
                    <h3 class="text-lg font-semibold mb-3">Ajustes de Pagos</h3>
                    <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium">Método de Pago</label>
                            <select class="w-full border px-3 py-2">
                                <option>Transferencia</option>
                                <option>Tarjeta</option>
                                <option>PayPal</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium">Moneda</label>
                            <select class="w-full border px-3 py-2">
                                <option>USD</option>
                                <option>COP</option>
                                <option>EUR</option>
                            </select>
                        </div>
                        <div class="md:col-span-2 flex justify-end">
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar Pagos</button>
                        </div>
                    </form>
                </div>

                <!-- Tab Seguridad -->
                <div id="seguridad" class="tab-content hidden">
                    <h3 class="text-lg font-semibold mb-3">Opciones de Seguridad</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded shadow">
                            <label class="block font-medium">Cambiar Contraseña</label>
                            <input type="password" placeholder="Nueva Contraseña" class="w-full border px-3 py-2 mb-2">
                            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Actualizar</button>
                        </div>
                        <div class="bg-gray-50 p-4 rounded shadow">
                            <label class="block font-medium">Autenticación 2FA</label>
                            <select class="w-full border px-3 py-2">
                                <option>Activar</option>
                                <option>Desactivar</option>
                            </select>
                            <button class="bg-yellow-500 text-white px-4 py-2 rounded mt-2 hover:bg-yellow-600">Guardar</button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

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
    document.addEventListener('click', function(e) {
        if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
            notifDropdown.classList.add('hidden');
        }
    });

    function openTab(evt, tabName) {
        let i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.add("hidden");
        }
        tablinks = document.getElementsByTagName("button");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("border-b-2", "border-blue-600", "text-blue-600");
        }
        document.getElementById(tabName).classList.remove("hidden");
        evt.currentTarget.classList.add("border-b-2", "border-blue-600", "text-blue-600");
    }
</script>

</body>
</html>
