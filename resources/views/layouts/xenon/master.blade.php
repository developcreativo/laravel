<!DOCTYPE html>

<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> @yield('tittle')</title>

    @include('layouts.styles')

    @yield('style')

</head>

<body class="page-body">
@include('errors.toastr')


<div class="page-container">

    <!--  aqui se inlcuye el sidebar static xenon -->

    @include('layouts.sidebar')

    <!-- fin del sidebar -->

    <div class="main-content">

        <!--  aqui se inlcuye el header static xenon -->

        @include('layouts.header')

        <!-- fin del header
        <div class="page-title">

            <div class="title-env">
                <h1 class="title"> @yield('title')</h1>

                <p class="description"> @yield('description')</p>
            </div>

            <div class="breadcrumb-env">
                <ol class="breadcrumb bc-1">
                    <li>
                        <a href={{url('/')}}><i class="fa-home"></i>Inicio</a>
                    </li>
                    @yield('breadcrumb')
                    <li class="active">
                        <strong> @yield('title')</strong>
                    </li>
                </ol>
            </div>

        </div>-->

        @if (Session::has('mensaje_login'))

            <div class="alert alert-danger" role="alert">

                <button type="button" class="close" data-dismiss="alert">&times;</button>

                <strong>Errores:</strong>

                <span>{{ Session::get('mensaje_login') }}</span>

            </div>

        @endif
        <div class="container-fluid">
            @yield('content')
        </div>

        <div class="footer hidden-print col-sm-12">

            <p>&copy mauricio suarez vega</p>

        </div>
        <div class="page-loading-overlay">
            <div class="loader-2"></div>
        </div>

    </div>

</div>




@include('layouts.scripts')
@yield('scripts')

<textarea tabindex="-1"
          style="position: absolute; top: -999px; left: 0px; right: auto; bottom: auto; border: 0px; padding: 0px; box-sizing: content-box; word-wrap: break-word; overflow: hidden; -webkit-transition: none; transition: none; height: 0px !important; min-height: 0px !important; font-family: Arimo, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; font-style: normal; letter-spacing: 0px; text-transform: none; word-spacing: 0px; text-indent: 0px; line-height: 18.5714302062988px; width: 53px;"
          class="autosizejs" id="autosizejs"></textarea>


</body>

</html>

  

   