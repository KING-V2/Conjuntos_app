@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Registro Parqueadero</h5>
        <div class="card-body">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Registro Parqueadero</h2>
            <p class="text-center text-gray-500 mb-6">Bienvenido, crea tu cuenta</p>

            <!-- Mensajes -->
            @if (session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 border border-green-400 text-green-700">
                    <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 rounded bg-red-100 border border-red-400 text-red-700">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Nombre -->
                <div class="flex items-center border rounded-lg px-3 py-2 focus-within:ring-2 focus-within:ring-blue-500">
                    <i class="fa-solid fa-user text-gray-400 mr-2"></i>
                    <input type="text" name="name" placeholder="Nombre" class="w-full outline-none text-gray-700" required />
                </div>

                <!-- Email -->
                <div class="flex items-center border rounded-lg px-3 py-2 focus-within:ring-2 focus-within:ring-blue-500">
                    <i class="fa-solid fa-envelope text-gray-400 mr-2"></i>
                    <input type="email" name="email" placeholder="Correo electrónico" class="w-full outline-none text-gray-700" required autcomplete="off" />
                </div>

                <!-- Contraseña -->
                <div class="flex items-center border rounded-lg px-3 py-2 focus-within:ring-2 focus-within:ring-blue-500 relative">
                    <i class="fa-solid fa-lock text-gray-400 mr-2"></i>
                    <input id="password" type="password" name="password" placeholder="Contraseña" autocomplete="off"
                        class="w-full outline-none text-gray-700 pr-8" required />
                    <i id="togglePassword" class="fa-solid fa-eye text-gray-400 absolute right-3 cursor-pointer"></i>
                </div>

                <!-- Botón -->
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i> Registrar
                </button>
            </form>


            <!-- Extras -->
            <div class="flex justify-between mt-4 text-sm">
               <a href="{{ route('forgot.form') }}" class="text-blue-600 hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
                <a href="{{ route('login.form') }}" class="text-blue-600 hover:underline">
                    Iniciar Sesión
                </a>

            </div>
        </div>
    </div>
</div>
@endsection