<!-- Header -->
<header id="header-navbar" class="content-mini content-mini-full">
    <!-- Page Header -->
            <!-- Header Navigation Left -->
            <ul class="nav-header pull-left">
                <li class="hidden-md hidden-lg">
                    <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                    <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
                        <i class="fa fa-navicon"></i>
                    </button>
                </li>
                <li class="hidden-xs hidden-sm">
                    <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                    <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                </li>

            </ul>
            <!-- END Header Navigation Left -->
            <div class="col-xs-4">
                <h1 class="page-heading">@yield('title')</h1>
            </div>
            <div class="col-sm-6 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a class="link-effect" href="{{url('/')}}">Inicio</a></li>
                    @yield('breadcrumb')
                    <li>@yield('title')</li>
                </ol>
            </div>
            <!-- Header Navigation Right -->
            <ul class="nav-header pull-right">
                <li>
                    <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                    <button class="btn btn-default" data-toggle="layout" data-action="side_overlay_toggle" type="button">
                        <i class="fa fa-tasks"></i>
                    </button>
                </li>
            </ul>
            <!-- END Header Navigation Right -->

</header>
<!-- END Header -->