<!DOCTYPE html>

<html
        lang="en"
        class="light-style layout-navbar-fixed layout-menu-fixed"
        dir="ltr"
        data-theme="theme-default"
        data-assets-path="{{asset('assets')}}/"
        data-path="{{url('/')}}"
        data-template="vertical-menu-template-no-customizer">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>Login</title>
        <link rel="icon" href="{{asset('assets/images/favicon-32x32.png') }}" type="image/png">
        <!-- loader-->
            <link href="{{asset('assets/css/pace.min.css') }}" rel="stylesheet">
            <script src="{{asset('assets/js/pace.min.js')}}"></script>

        <!--plugins-->
        <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/metismenu/metisMenu.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/metismenu/mm-vertical.css')}}">
        <!--bootstrap css-->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
        <!--main css-->
        <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
        <link href="{{asset('sass/main.css')}}" rel="stylesheet">
        <link href="{{asset('sass/dark-theme.css')}}" rel="stylesheet">
        <link href="{{asset('sass/blue-theme.css')}}" rel="stylesheet">
        <link href="{{asset('sass/responsive.css')}}" rel="stylesheet">
    </head>

    <body>
        <!--authentication-->
    <div class="auth-basic-wrapper d-flex align-items-center justify-content-center">
      <div class="container-fluid my-5 my-lg-0">
        <div class="row">
           <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
            <div class="card rounded-4 mb-0 border-top border-4 border-primary border-gradient-1">
              <div class="card-body p-5">
                    <div class="card">
                        @yield('content')
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
                    </div>
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                {{env('APP_NAME')}}
                            </div>
                        </div>
                    </footer>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <!--plugins-->
        <script src="assets/js/jquery.min.js"></script>

        <script>
            $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bi-eye-slash-fill");
                $('#show_hide_password i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                $('#show_hide_password i').addClass("bi-eye-fill");
                }
            });
            });
        </script>

        @yield('javascripts')
    </body>
</html>
