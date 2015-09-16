<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        @include('layouts.head')
    </head>
    <body>
    <!-- Page Container -->
    <!--
        Available Classes:

        'enable-cookies'             Remembers active color theme between pages (when set through color theme list)

        'sidebar-l'                  Left Sidebar and right Side Overlay
        'sidebar-r'                  Right Sidebar and left Side Overlay
        'sidebar-mini'               Mini hoverable Sidebar (> 991px)
        'sidebar-o'                  Visible Sidebar by default (> 991px)
        'sidebar-o-xs'               Visible Sidebar by default (< 992px)

        'side-overlay-hover'         Hoverable Side Overlay (> 991px)
        'side-overlay-o'             Visible Side Overlay by default (> 991px)

        'side-scroll'                Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (> 991px)

        'header-navbar-fixed'        Enables fixed header
    -->


    <div id="page-container" class="enable-cookies sidebar-l sidebar-o side-scroll ">
        <!--  aqui se inlcuye el sidebar static xenon -->
        @include('layouts.sidebar')
        <!-- fin del sidebar -->
        @include('layouts.header')
        <div id="loading">
            <i id="loading-image" class="fa fa-3x fa-cog fa-spin">
            </i>
        </div>
        <main id="main-container">
            <!-- Content -->
            <div class="content">
                @yield('content')
            </div>
            <!-- End Content -->
        </main>
        @include('layouts.footer')

    </div>
    @include('layouts.scripts')
    @include('layouts.notificaciones')
    @yield('scripts')
    </body>

</html>

  

   