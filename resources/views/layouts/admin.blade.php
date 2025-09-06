<!DOCTYPE html>

<html
        lang="en"
        class="light-style layout-navbar-fixed layout-menu-fixed"
        dir="ltr"
        data-theme="theme-default"
        data-assets-path="{{asset('assets')}}/"
        data-path="{{url('/')}}"
        data-template="vertical-menu-template-no-customizer"
>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

        <title>{{ env('APP_NAME') }}</title>

        <meta name="description" content="" />
        <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/favicon.ico')}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/fonts/fontawesome.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/fonts/flag-icons.css')}}" />


        <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/core.css') }}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/theme-default.css') }}" />
        <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
        
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
        
        @yield('vendors_css')
        @yield('aditional_styles')
        
        <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
        <script src="{{asset('assets/js/config.js')}}"></script>
        <style>.light-style .menu .app-brand.demo {height: 80px !important;}</style>
    </head>

    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                    <div class="app-brand demo">
                        <a href="{{  url('empleados') }}" class="app-brand-link">
                            <span class="app-brand-logo demo">
                                <svg
                                        width="26px"
                                        height="26px"
                                        viewBox="0 0 26 26"
                                        version="1.1"
                                        xmlns="{{asset('storage/iconos')}}/{{ session('icono') ? session('icono') : 'icono_empresa.png' }}"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>{{ env('APP_NAME') }}</title>
                                </svg>
                            </span>
                            <img src="{{asset('storage/logos')}}/{{ session('logo') ? session('logo') : 'logo_empresa.png' }}" width="170px;" alt="Logo Ciudadela">
                        </a>
                    </div>
                    <div class="menu-divider mt-0"></div>
                    <div class="menu-inner-shadow"></div>
                    <ul class="menu-inner py-1">
                        <li class="menu-item">
                            @can('modulo administracion')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa fa-building"></i>
                                <div data-i18n="Administración">Administración</div>
                            </a>
                            @endcan
                            <ul class="menu-sub">
                                @can('conjunto')
                                <li class="menu-item">
                                    <a href="{{ url('conjuntos')}}" class="menu-link">
                                        <i class="menu-icon tf-icons fa fa-home"></i>
                                        <div data-i18n="Conjunto">Conjunto</div>
                                    </a>
                                </li>
                                @endcan
                                @can('informacion conjunto')
                                <li class="menu-item">
                                    <a href="{{ url('informacion_conjunto')}}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-buildings"></i>
                                        <div data-i18n="Información Conjuntos">Información Conjunto</div>
                                    </a>
                                </li>
                                @endcan
                                @can('galeria conjunto')
                                <li class="menu-item">
                                    <a href="{{ url('galeria_conjunto')}}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-image"></i>
                                        <div data-i18n="Galeria Conjunto">Galeria Conjunto</div>
                                    </a>
                                </li>
                                @endcan
                                @can('casas')
                                <li class="menu-item">
                                    <a href="{{ url('casas')}}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-home"></i>
                                        <div data-i18n="casas">Casas</div>
                                    </a>
                                </li>
                                @endcan
                                @can('usuarios')
                                <li class="menu-item">
                                    <a href="{{ url('users')}}" class="menu-link">
                                        <i class="menu-icon fa-solid fa-users"></i>
                                        <div data-i18n="Usuarios">Usuarios</div>
                                    </a>
                                </li>
                                @endcan
                                @can('residente')
                                <li class="menu-item">
                                    <a href="{{ url('residentes')}}" class="menu-link">
                                        <i class="menu-icon fa-solid fa-drivers-license"></i>
                                        <div data-i18n=" Residentes"> Residentes</div>
                                    </a>
                                </li>
                                @endcan
                                @can('parqueaderos')
                                <li class="menu-item">
                                    <a href="{{ url('parqueaderos')}}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-car"></i>
                                        <div data-i18n="Parqueaderos">Parqueaderos</div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="menu-item">
                            @can('modulo citofonia')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa fa-phone"></i>
                                <div data-i18n="Citofonia">Citofonia</div>
                            </a>
                            @endcan
                            <ul class="menu-sub">
                                @can('citofonia')
                                <li class="menu-item">
                                    <a href="{{ url('citofonia')}}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-phone"></i>
                                        <div data-i18n="casas">Citofonia</div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="menu-item">
                            @can('modulo empleados')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa fa-users"></i>
                                <div data-i18n="Empleados">Empleados</div>
                            </a>
                            @endcan
                            <ul class="menu-sub">
                                @can('empleado')
                                <li class="menu-item">
                                    <a href="{{ url('empleados')}}" class="menu-link">
                                        <i class="menu-icon fa-solid fa-users"></i>
                                        <div data-i18n="Empleados">Empleados</div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="menu-item">
                            @can('modulo trasteos')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-car"></i>
                                <div data-i18n="Trasteos">Trasteos</div>
                            </a>
                            @endcan
                            <ul class="menu-sub">
                                @can('trasteo')
                                <li class="menu-item">
                                    <a href="{{ url('trasteos')}}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-car"></i>
                                        <div data-i18n="Solicitudes Trasteos">Solicitudes Trasteos</div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="menu-item">
                            @can('modulo correspondencia')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa fa-envelope"></i>
                                <div data-i18n="Correspondencia">Correspondencia</div>
                            </a>
                            @endcan
                            <ul class="menu-sub">
                                @can('correspondencia')
                                <li class="menu-item">
                                    <a href="{{ url('correspondencia')}}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-envenlope"></i>
                                        <div data-i18n="Correspondencia">Correspondencia</div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="menu-item">
                            @can('modulo encuestas')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa fa-bar-chart"></i>
                                <div data-i18n="Encuestas">Encuestas</div>
                            </a>
                            @endcan
                            <ul class="menu-sub">
                                @can('encuestas')
                                <li class="menu-item">
                                    <a href="{{ url('encuestas')}}" class="menu-link">
                                        <i class="menu-icon tf-icons fa fa-bar-chart"></i>
                                        <div data-i18n="Encuestas">Encuestas</div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="menu-item">
                            @can('modulo informacion')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa fa-info-circle"></i>
                                <div data-i18n="Información">Información</div>
                            </a>
                            @endcan
                            <ul class="menu-sub">
                                @can('directorio')
                                <li class="menu-item">
                                    <a href="{{ url('directorios')}}" class="menu-link">
                                        <i class="menu-icon fa-solid fa-address-book"></i>
                                        <div data-i18n="Directorio">Directorio</div>
                                    </a>
                                </li>
                                @endcan
                                @can('circulares')
                                <li class="menu-item">
                                    <a href="{{ url('circulares')}}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-file"></i>
                                        <div data-i18n="Circulares">Circulares</div>
                                    </a>
                                </li>
                                @endcan
                                @can('manual')
                                <li class="menu-item">
                                    <a href="{{ url('manuales')}}" class="menu-link">
                                        <i class="menu-icon fa-solid fa-book"></i>
                                        <div data-i18n="Manual de Convivencia ">Manual de Convivencia </div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="menu-item">
                            @can('modulo pqrs')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa fa-globe"></i>
                                <div data-i18n="PQRS">PQRS</div>
                            </a>
                            @endcan
                            <ul class="menu-sub">
                                @can('foro')
                                <li class="menu-item">
                                    <a href="{{ url('foros')}}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-file"></i>
                                        <div data-i18n="PQRS">PQRS</div>
                                    </a>
                                </li>
                                @endcan
                                @can('respuesta foro')
                                <li class="menu-item">
                                    <a href="{{ url('respuesta_foros')}}" class="menu-link">
                                        <i class="menu-icon tf-icons fa fa-check"></i>
                                        <div data-i18n="Respuestas PQRs">Respuestas PQRs</div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="menu-item">
                            @can('modulo emprendimientos')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa-solid fa-handshake"></i>
                                <div data-i18n="Clasificados">Clasificados</div>
                            </a>
                            @endcan
                            <ul class="menu-sub">
                                @can('clasificados')
                                <li class="menu-item">
                                    <a href="{{ url('clasificados')}}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-file"></i>
                                        <div data-i18n="Clasificados">Clasificados</div>
                                    </a>
                                </li>
                                @endcan
                                @can('emprendimientos')
                                <li class="menu-item">
                                    <a href="{{ url('emprendimientos')}}" class="menu-link">
                                        <i class="menu-icon fa-solid fa fa-award"></i>
                                        <div data-i18n="Emprendimientos">Emprendimientos</div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="menu-item">
                            @can('modulo parqueaderos')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa-solid fa-car-side"></i>
                                <div data-i18n="Parqueaderos">Parqueaderos</div>
                            </a>
                            @endcan
                            <ul class="menu-sub">
                                @can('categoria vehiculo')
                                <li class="menu-item">
                                    <a href="{{ url('categoria_vehiculo')}}" class="menu-link">
                                        <i class="menu-icon tf-icons fa fa-car"></i>
                                        <div data-i18n="Categoria Vehiculo">Categoria Vehiculo</div>
                                    </a>
                                </li>
                                @endcan
                                @can('parqueadero visitantes')
                                <li class="menu-item">
                                    <a href="{{ url('parqueadero_visitante')}}" class="menu-link">
                                        <i class="menu-icon tf-icons fa fa-car-side"></i>
                                        <div data-i18n="Parqueadero Visitantes">Parqueadero Visitantes</div>
                                    </a>
                                </li>
                                @endcan
                                @can('tarifas conjunto')
                                <li class="menu-item">
                                    <a href="{{ url('tarifas_conjunto')}}" class="menu-link">
                                        <i class="menu-icon tf-icons fa fa-money-bill"></i>
                                        <div data-i18n="Tarifas Conjunto">Tarifas Conjunto</div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="menu-item">
                            @can('modulo reservas')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa fa-bookmark"></i>
                                <div data-i18n="Reservas">Reservas</div>
                            </a>
                            @endcan
                            <ul class="menu-sub">
                                @can('reserva')
                                <li class="menu-item">
                                    <a href="{{ url('reservas')}}" class="menu-link">
                                        <i class="menu-icon tf-icons fa-solid fa fa-bookmark"></i>
                                        <div data-i18n="Reservas">Reservas</div>
                                    </a>
                                </li>
                                @endcan
                                @can('zona comun')
                                <li class="menu-item">
                                    <a href="{{ url('zonas_comunes')}}" class="menu-link">
                                        <i class="menu-icon tf-icons fa fa-map"></i>
                                        <div data-i18n="Zonas Comunes">Zonas Comunes</div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="menu-item">
                            @can('modulo configuracion')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa fa-cogs"></i>
                                <div data-i18n="Reservas">Configuración</div>
                            </a>
                            @endcan
                            <ul class="menu-sub">
                                @can('role')
                                <li class="menu-item">
                                    <a href="{{ route('roles.index') }}" class="menu-link">
                                        <i class="menu-icon tf-icons fa-solid fa fa-cog"></i>
                                        <div data-i18n="Roles">Roles</div>
                                    </a>
                                </li>
                                @endcan
                                @can('permisos rol')
                                <li class="menu-item">
                                    <a href="{{ url('permissions') }}" class="menu-link">
                                        <i class="menu-icon tf-icons fa-solid fa fa-check-square"></i>
                                        <div data-i18n="Permisos">Permisos</div>
                                    </a>
                                </li>
                                @endcan
                                @can('log sistema')
                                <li class="menu-item">
                                    <a href="{{ url('log_sistema') }}" class="menu-link">
                                        <i class="menu-icon tf-icons fa-solid fa fa-cogs"></i>
                                        <div data-i18n="Log Sistema">Log Sistema</div>
                                    </a>
                                </li>
                                @endcan
                                @can('log usuarios')
                                <li class="menu-item">
                                    <a href="{{ url('log_usuarios')}}" class="menu-link">
                                        <i class="menu-icon fa-solid fa-list"></i>
                                        <div data-i18n="Log Usuarios">Log Usuarios</div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                    </ul>
                </aside>
                <div class="layout-page">    
                    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                        <div class="container-fluid">
                            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                    <i class="bx bx-menu bx-sm"></i>
                                </a>
                            </div>

                            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                                <ul class="navbar-nav flex-row align-items-center ms-auto">
                                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                            <div class="avatar avatar-online">
                                                <img src="{{asset('storage/iconos')}}/{{session('icono') ?  session('icono') : 'icono_empresa.png'}}" alt class="rounded-circle" />
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="pages-account-settings-account.html">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar avatar-online">
                                                                @if( session('icono') )
                                                                    <img src="{{asset('storage/iconos/')}}/{{session('icono')}}" alt class="rounded-circle" />
                                                                @else
                                                                    <img src="../../assets/img/avatars/1.png" alt class="rounded-circle" />
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <span class="fw-semibold d-block lh-1">{{ session('conjunto') ? session('conjunto') : 'Sin Conjunto' }}</span>
                                                            <small>Admin</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider"></div>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="nav-link btn btn-link" style="cursor: pointer;">
                                                        Cerrar sesión
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="navbar-search-wrapper search-input-wrapper d-none">
                                <input
                                        type="text"
                                        class="form-control search-input container-fluid border-0"
                                        placeholder="Search..."
                                        aria-label="Search..."
                                />
                                <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
                            </div>
                        </div>
                    </nav>
                    <div class="content-wrapper">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="card-header">
                                @if (Session::has('flash_error_message'))
                                    <div class="alert alert-danger" role="alert">{{ Session::get('flash_error_message') }}</div>
                                @endif
                                @if (Session::has('flash_success_message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('flash_success_message') }}</div>
                                @endif
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @yield('content')
                        </div>
                        <footer class="content-footer footer bg-footer-theme">
                            <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                                <div class="mb-2 mb-md-0"> © <script>document.write(new Date().getFullYear());</script> by CitoApp
                                </div>
                            </div>
                        </footer>
                        
                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>

            <div class="layout-overlay layout-menu-toggle"></div>

            <div class="drag-target"></div>
        </div>
        <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
        <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
        <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
        <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
        <script src="{{ asset('assets/vendor/libs/hammer/hammer.js')}}"></script>
        <script src="{{ asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
        <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
        <script src="{{ asset('assets/vendor/js/menu.js')}}"></script>
        
        @yield('vendors_js')
        <script src="{{ asset('assets/js/main.js')}}"></script>

        @yield('javascripts')
    </body>
</html>


