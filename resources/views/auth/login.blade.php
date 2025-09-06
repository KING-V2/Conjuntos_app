@extends('layouts.app')

@section('content')
    <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center">
            <a href="{{ url('login')}}" class="app-brand-link gap-2">
            <img src="{{ asset('storage/logos')}}/{{ $logo ? $logo : 'logo_empresa.png' }}" alt="Logo Empresa" width="100%">
            </a>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="col-12">
              <label for="inputEmailAddress" class="form-label">Correo</label>
              <input type="email" class="form-control" id="inputEmailAddress" name="email" placeholder="Ingresar Correo">
            </div>
            <div class="col-12">
              <label for="inputChoosePassword" class="form-label">Contraseña</label>
              <div class="input-group" id="show_hide_password">
                <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" placeholder="Ingresar Contraseña">
                <a href="javascript:;" class="input-group-text bg-transparent" id="togglePassword">
                  <i class="bi bi-eye-slash-fill" id="iconPassword"></i>
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </a>
              </div>
            </div>
            <div class="line"></div>
            <div class="col-12 mt-5">
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
              </div>
            </div>
            
            @if ($errors->any())
                <div>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </form>
    </div>

    <!-- Script para mostrar/ocultar contraseña -->
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const togglePassword = document.querySelector("#togglePassword");
        const passwordField = document.querySelector("#inputChoosePassword");
        const icon = document.querySelector("#iconPassword");

        togglePassword.addEventListener("click", function (e) {
          e.preventDefault();
          // Cambiar tipo de input
          const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
          passwordField.setAttribute("type", type);

          // Cambiar icono
          if (type === "text") {
            icon.classList.remove("bi-eye-slash-fill");
            icon.classList.add("bi-eye-fill");
          } else {
            icon.classList.remove("bi-eye-fill");
            icon.classList.add("bi-eye-slash-fill");
          }
        });
      });
    </script>
@endsection
