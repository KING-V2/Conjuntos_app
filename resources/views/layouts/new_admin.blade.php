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
        <!-- <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/favicon.ico')}}" /> -->
        <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

        <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet">
        <script src="{{ asset('assets/js/pace.min.js') }}"></script>

        <!--plugins-->
        <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/metismenu/metisMenu.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/metismenu/mm-vertical.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}">
        <!--bootstrap css-->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
        <!--main css-->
        <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/main.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/dark-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/blue-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/semi-dark.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/bordered-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/responsive.css') }}" rel="stylesheet">
        <style>.light-style .menu .app-brand.demo {height: 80px !important;}</style>
    </head>

    <body>
        <header class="top-header">
            <nav class="navbar navbar-expand align-items-center gap-4">
            <div class="btn-toggle">
                <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative">
                <!-- <input class="form-control rounded-5 px-5 search-control d-lg-block d-none" type="text" placeholder="Search"> -->
                <!-- <span class="material-icons-outlined position-absolute d-lg-block d-none ms-3 translate-middle-y start-0 top-50">search</span> -->
                <span class="material-icons-outlined position-absolute me-3 translate-middle-y end-0 top-50 search-close">close</span>
                <div class="search-popup p-3">
                    <div class="card rounded-4 overflow-hidden">
                    <div class="card-header d-lg-none">
                        <div class="position-relative">
                        <input class="form-control rounded-5 px-5 mobile-search-control" type="text" placeholder="Search">
                        <span class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
                        <span class="material-icons-outlined position-absolute me-3 translate-middle-y end-0 top-50 mobile-search-close">close</span>
                        </div>
                    </div>
                    <div class="card-body search-content">
                        <p class="search-title">Recent Searches</p>
                        <div class="d-flex align-items-start flex-wrap gap-2 kewords-wrapper">
                        <a href="javascript:;" class="kewords"><span>Angular Template</span><i
                            class="material-icons-outlined fs-6">search</i></a>
                        <a href="javascript:;" class="kewords"><span>Dashboard</span><i
                            class="material-icons-outlined fs-6">search</i></a>
                        <a href="javascript:;" class="kewords"><span>Admin Template</span><i
                            class="material-icons-outlined fs-6">search</i></a>
                        <a href="javascript:;" class="kewords"><span>Bootstrap 5 Admin</span><i
                            class="material-icons-outlined fs-6">search</i></a>
                        <a href="javascript:;" class="kewords"><span>Html eCommerce</span><i
                            class="material-icons-outlined fs-6">search</i></a>
                        <a href="javascript:;" class="kewords"><span>Sass</span><i
                            class="material-icons-outlined fs-6">search</i></a>
                        <a href="javascript:;" class="kewords"><span>laravel 9</span><i
                            class="material-icons-outlined fs-6">search</i></a>
                        </div>
                        <hr>
                        <p class="search-title">Tutorials</p>
                        <div class="search-list d-flex flex-column gap-2">
                        <div class="search-list-item d-flex align-items-center gap-3">
                            <div class="list-icon">
                            <i class="material-icons-outlined fs-5">play_circle</i>
                            </div>
                            <div class="">
                            <h5 class="mb-0 search-list-title ">Wordpress Tutorials</h5>
                            </div>
                        </div>
                        <div class="search-list-item d-flex align-items-center gap-3">
                            <div class="list-icon">
                            <i class="material-icons-outlined fs-5">shopping_basket</i>
                            </div>
                            <div class="">
                            <h5 class="mb-0 search-list-title">eCommerce Website Tutorials</h5>
                            </div>
                        </div>
        
                        <div class="search-list-item d-flex align-items-center gap-3">
                            <div class="list-icon">
                            <i class="material-icons-outlined fs-5">laptop</i>
                            </div>
                            <div class="">
                            <h5 class="mb-0 search-list-title">Responsive Design</h5>
                            </div>
                        </div>
                        </div>
        
                        <hr>
                        <p class="search-title">Members</p>
        
                        <div class="search-list d-flex flex-column gap-2">
                        <div class="search-list-item d-flex align-items-center gap-3">
                            <div class="memmber-img">
                            <img src="{{ asset('assets/images/avatars/01.png') }}" width="32" height="32" class="rounded-circle" alt="">
                            </div>
                            <div class="">
                            <h5 class="mb-0 search-list-title ">Andrew Stark</h5>
                            </div>
                        </div>
        
                        <div class="search-list-item d-flex align-items-center gap-3">
                            <div class="memmber-img">
                            <img src="{{ asset('assets/images/avatars/02.png') }}" width="32" height="32" class="rounded-circle" alt="">
                            </div>
                            <div class="">
                            <h5 class="mb-0 search-list-title ">Snetro Jhonia</h5>
                            </div>
                        </div>
        
                        <div class="search-list-item d-flex align-items-center gap-3">
                            <div class="memmber-img">
                            <img src="{{ asset('assets/images/avatars/03.png') }}" width="32" height="32" class="rounded-circle" alt="">
                            </div>
                            <div class="">
                            <h5 class="mb-0 search-list-title">Michle Clark</h5>
                            </div>
                        </div>
        
                        </div>
                    </div>
                    <div class="card-footer text-center bg-transparent">
                        <a href="javascript:;" class="btn w-100">See All Search Results</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <ul class="navbar-nav gap-1 nav-right-links align-items-center">
                <li class="nav-item d-lg-none mobile-search-btn">
                <a class="nav-link" href="javascript:;"><i class="material-icons-outlined">search</i></a>
                </li>

                
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" data-bs-auto-close="outside"
                    data-bs-toggle="dropdown" href="javascript:;"><i class="material-icons-outlined">notifications</i>
                    <span class="badge-notify">5</span>
                </a>
                <div class="dropdown-menu dropdown-notify dropdown-menu-end shadow">
                    <div class="px-3 py-1 d-flex align-items-center justify-content-between border-bottom">
                    <h5 class="notiy-title mb-0">Notifications</h5>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle dropdown-toggle-nocaret option" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="material-icons-outlined">
                            more_vert
                        </span>
                        </button>
                        <div class="dropdown-menu dropdown-option dropdown-menu-end shadow">
                        <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                                class="material-icons-outlined fs-6">inventory_2</i>Archive All</a></div>
                        <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                                class="material-icons-outlined fs-6">done_all</i>Mark all as read</a></div>
                        <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                                class="material-icons-outlined fs-6">mic_off</i>Disable Notifications</a></div>
                        <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                                class="material-icons-outlined fs-6">grade</i>What's new ?</a></div>
                        <div>
                            <hr class="dropdown-divider">
                        </div>
                        <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                                class="material-icons-outlined fs-6">leaderboard</i>Reports</a></div>
                        </div>
                    </div>
                    </div>
                    
                    <div class="notify-list"> 
                        
                    <div>
                        <a class="dropdown-item border-bottom py-2" href="javascript:;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="">
                            <img src="{{ asset('assets/images/avatars/01.png') }}" class="rounded-circle" width="45" height="45" alt="">
                            </div>
                            <div class="">
                            <h5 class="notify-title">Congratulations Jhon</h5>
                            <p class="mb-0 notify-desc">Many congtars jhon. You have won the gifts.</p>
                            <p class="mb-0 notify-time">Today</p>
                            </div>
                            <div class="notify-close position-absolute end-0 me-3">
                            <i class="material-icons-outlined fs-6">close</i>
                            </div>
                        </div>
                        </a>
                    </div>
                    </div>
                </div>
                </li>
                <li class="nav-item d-md-flex d-none">
                <a class="nav-link position-relative" data-bs-toggle="offcanvas" href="#offcanvasCart"><i
                    class="material-icons-outlined">shopping_cart</i>
                    <span class="badge-notify">8</span>
                </a>
                </li> 
                
                <li class="nav-item dropdown">
                <a href="javascript:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/images/avatars/01.png') }}" class="rounded-circle p-1 border" width="45" height="45" alt="">
                </a>
                <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
                    <a class="dropdown-item  gap-2 py-2" href="javascript:;">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/avatars/01.png') }}" class="rounded-circle p-1 shadow mb-3" width="90" height="90"
                        alt="">
                        <h5 class="user-name mb-0 fw-bold">Hello, Jhon</h5>
                    </div>
                    </a>
                    <hr class="dropdown-divider">
                    <!-- <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i class="material-icons-outlined">person_outline</i>Profile</a>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i class="material-icons-outlined">local_bar</i>Setting</a>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i class="material-icons-outlined">dashboard</i>Dashboard</a>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i class="material-icons-outlined">account_balance</i>Earning</a>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i class="material-icons-outlined">cloud_download</i>Downloads</a> -->
                    <hr class="dropdown-divider">
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i class="material-icons-outlined">power_settings_new</i>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="cursor: pointer;">
                                Logout
                            </button>
                        </form>    
                    </a>
                </div>
                </li>
            </ul>

            </nav>
        </header>

        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
            <div class="logo-icon">
                <img src="{{asset('storage/logos')}}/{{ session('logo') ? session('logo') : 'logo_empresa.png' }}" class="logo-img" alt="">
            </div>
            <div class="logo-name flex-grow-1">
                <h5 class="mb-0">{{ session('conjunto') }}</h5>
            </div>
            <div class="sidebar-close">
                <span class="material-icons-outlined">close</span>
            </div>
            </div>
            <div class="sidebar-nav">
                <!--navigation-->
                <ul class="metismenu" id="sidenav">
                <li>
                    <a href="{{  url('empleados') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">home</i></div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <!-- <li class="menu-label">Others</li> -->
                <li>
                    @can('modulo administracion')
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">shopping_bag</i></div>
                        <div class="menu-title">Administración</div>
                    </a>
                    @endcan
                    <ul>
                        @can('conjunto')
                        <li>
                            <a href="{{ url('conjuntos')}}"><i class="material-icons-outlined">arrow_right</i>Conjunto</a>
                        </li>
                        @endcan
                        @can('informacion conjunto')
                        <li>
                            <a href="{{ url('informacion_conjunto')}}"><i class="material-icons-outlined">arrow_right</i>Información Conjunto</a>
                        </li>
                        @endcan
                        @can('galeria conjunto')
                        <li>
                            <a href="{{ url('galeria_conjunto')}}"><i class="material-icons-outlined">arrow_right</i>Galería Conjunto</a>
                        </li>
                        @endcan
                        @can('bloques')
                        <li>
                            <a href="{{ url('bloques')}}"><i class="material-icons-outlined">arrow_right</i>Bloques</a>
                        </li>
                        @endcan
                        @can('apartamentos')
                        <li>
                            <a href="{{ url('apartamentos')}}"><i class="material-icons-outlined">arrow_right</i>Apartamentos</a>
                        </li>
                        @endcan
                        @can('usuarios')
                        <li>
                            <a href="{{ url('users')}}"><i class="material-icons-outlined">arrow_right</i>Usuarios</a>
                        </li>
                        @endcan
                        @can('residente')
                        <li>
                            <a href="{{ url('residentes')}}"><i class="material-icons-outlined">arrow_right</i>Residentes</a>
                        </li>
                        @endcan
                        @can('parqueaderos')
                        <li>
                            <a href="{{ url('parqueaderos')}}"><i class="material-icons-outlined">arrow_right</i>Parqueaderos</a>
                        </li>
                        @endcan
                        @can('actividades')
                        <li>
                            <a href="{{ url('actividades')}}"><i class="material-icons-outlined">arrow_right</i>Actividades</a>
                        </li>
                        @endcan
                    </ul>     
                </li>
                <li>
                    @can('modulo empleados')
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">person</i></div>
                        <div class="menu-title">Empleados</div>
                    </a>
                    @endcan
                    <ul>
                        @can('empleado')
                        <li>
                            <a href="{{ url('empleados')}}"><i class="material-icons-outlined">arrow_right</i>Empleados</a>
                        </li>
                        @endcan
                    </ul>     
                </li>
                <li>
                    @can('modulo trasteos')
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">person</i></div>
                        <div class="menu-title">Trasteos</div>
                    </a>
                    @endcan
                    <ul>
                        @can('trasteo')
                        <li>
                            <a href="{{ url('trasteos')}}"><i class="material-icons-outlined">arrow_right</i>Solicitudes Trasteos</a>
                        </li>
                        @endcan
                    </ul>     
                </li>
                <li>
                    @can('modulo correspondencia')
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">person</i></div>
                        <div class="menu-title">correspondencia</div>
                    </a>
                    @endcan
                    <ul>
                        @can('correspondencia')
                        <li>
                            <a href="{{ url('correspondencia')}}"><i class="material-icons-outlined">arrow_right</i>Correspondencia</a>
                        </li>
                        @endcan
                    </ul>     
                </li>
                <li>
                    @can('modulo encuestas')
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">person</i></div>
                        <div class="menu-title">encuestas</div>
                    </a>
                    @endcan
                    <ul>
                        @can('encuestas')
                        <li>
                            <a href="{{ url('encuestas')}}"><i class="material-icons-outlined">arrow_right</i>Encuestas</a>
                        </li>
                        @endcan
                    </ul>     
                </li>
                <li>
                    @can('modulo informacion')
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">person</i></div>
                        <div class="menu-title">informacion</div>
                    </a>
                    @endcan
                    <ul>
                        @can('directorio')
                        <li>
                            <a href="{{ url('directorios')}}"><i class="material-icons-outlined">arrow_right</i>Directorio</a>
                        </li>
                        @endcan
                        @can('circulares')
                        <li>
                            <a href="{{ url('circulares')}}"><i class="material-icons-outlined">arrow_right</i>circulares</a>
                        </li>
                        @endcan
                        @can('manual')
                        <li>
                            <a href="{{ url('manuales')}}"><i class="material-icons-outlined">arrow_right</i>Manual de Convivencia</a>
                        </li>
                        @endcan
                    </ul>     
                </li>
                <li>
                    @can('modulo prqs')
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">person</i></div>
                        <div class="menu-title">prqs</div>
                    </a>
                    @endcan
                    <ul>
                        @can('foro')
                        <li>
                            <a href="{{ url('foros')}}"><i class="material-icons-outlined">arrow_right</i>Pqrs</a>
                        </li>
                        @endcan
                        @can('respuesta foro')
                        <li>
                            <a href="{{ url('respuesta_foros')}}"><i class="material-icons-outlined">arrow_right</i>Respuesta PQRs</a>
                        </li>
                        @endcan
                    </ul>     
                </li>
                <li>
                    @can('modulo emprendimientos')
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">person</i></div>
                        <div class="menu-title">emprendimientos</div>
                    </a>
                    @endcan
                    <ul>
                        @can('clasificados')
                        <li>
                            <a href="{{ url('clasificados')}}"><i class="material-icons-outlined">arrow_right</i>Clasificados</a>
                        </li>
                        @endcan
                        @can('emprendimientos')
                        <li>
                            <a href="{{ url('emprendimientos')}}"><i class="material-icons-outlined">arrow_right</i>Emprendimientos</a>
                        </li>
                        @endcan
                    </ul>     
                </li>
                <li>
                    @can('modulo parqueaderos')
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">person</i></div>
                        <div class="menu-title">parqueaderos</div>
                    </a>
                    @endcan
                    <ul>
                        @can('categoria vehiculo')
                        <li>
                            <a href="{{ url('categoria_vehiculo')}}"><i class="material-icons-outlined">arrow_right</i>Categoria Vehiculos</a>
                        </li>
                        @endcan
                        @can('parqueadero visitantes')
                        <li>
                            <a href="{{ url('parqueadero_visitante')}}"><i class="material-icons-outlined">arrow_right</i>Parqueadero Visitantes</a>
                        </li>
                        @endcan
                        @can('tarifas conjunto')
                        <li>
                            <a href="{{ url('tarifas_conjunto')}}"><i class="material-icons-outlined">arrow_right</i>Tarifas Conjunto</a>
                        </li>
                        @endcan
                    </ul>     
                </li>
                <li>
                    @can('modulo reservas')
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">person</i></div>
                        <div class="menu-title">reservas</div>
                    </a>
                    @endcan
                    <ul>
                        @can('reserva')
                        <li>
                            <a href="{{ url('reservas')}}"><i class="material-icons-outlined">arrow_right</i>Reservas</a>
                        </li>
                        @endcan
                        @can('zona comun')
                        <li>
                            <a href="{{ url('zonas_comunes')}}"><i class="material-icons-outlined">arrow_right</i>Zonas Comunes</a>
                        </li>
                        @endcan
                    </ul>     
                </li>
                <li>
                    @can('modulo configuracion')
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">person</i></div>
                        <div class="menu-title">Configuración</div>
                    </a>
                    @endcan
                    <ul>
                        @can('role')
                        <li>
                            <a href="{{ route('roles.index')}}"><i class="material-icons-outlined">arrow_right</i>Roles</a>
                        </li>
                        @endcan
                        @can('permisos rol')
                        <li>
                            <a href="{{ url('permissions')}}"><i class="material-icons-outlined">arrow_right</i>Permisos</a>
                        </li>
                        @endcan
                        @can('log sistema')
                        <li>
                            <a href="{{ url('log_sistema')}}"><i class="material-icons-outlined">arrow_right</i>Log Sistema</a>
                        </li>
                        @endcan
                        @can('log usuarios')
                        <li>
                            <a href="{{ url('log_usuarios')}}"><i class="material-icons-outlined">arrow_right</i>Log usuarios</a>
                        </li>
                        @endcan
                    </ul>     
                </li>
                <!-- <li>
                    <a href="javascrpt:;">
                    <div class="parent-icon"><i class="material-icons-outlined">description</i>
                    </div>
                    <div class="menu-title">Documentation</div>
                    </a>
                </li>
                <li>
                    <a href="javascrpt:;">
                    <div class="parent-icon"><i class="material-icons-outlined">support</i>
                    </div>
                    <div class="menu-title">Support</div>
                    </a>
                </li> -->
                </ul>
                <!--end navigation-->
            </div>
        </aside>

          <!--start main wrapper-->
  <main class="main-wrapper">
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Analysis</li>
                    </ol>
                </nav>
            </div>
            <!-- <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary">Settings</button>
                    <button type="button" class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div> -->
        </div>
        <!--end breadcrumb-->
     
        <div class="row">
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
    </div>
  </main>
  <!--end main wrapper-->

        
        <!--bootstrap js-->
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

        <!--plugins-->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <!--plugins-->
        <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/plugins/metismenu/metisMenu.min.js') }}"></script>
        <!-- <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script> -->
        <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/peity/jquery.peity.min.js') }}"></script>
        <script>
            // $(".data-attributes span").peity("donut")
        </script>
        @yield('vendors_js')
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <!-- <script src="{{ asset('assets/js/dashboard1.js') }}"></script> -->
        <!-- <script>
            new PerfectScrollbar(".user-list")
        </script> -->
        

        @yield('javascripts')
    </body>
</html>


