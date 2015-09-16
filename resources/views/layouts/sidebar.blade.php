<!-- Side Overlay-->
<aside id="side-overlay">
    <!-- Side Overlay Scroll Container -->
    <div id="side-overlay-scroll">
        <!-- Side Header -->
        <div class="side-header side-content">
            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
            <button class="btn btn-default pull-right" type="button" data-toggle="layout" data-action="side_overlay_close">
                <i class="fa fa-times"></i>
            </button>
            <span class="font-w600 push-10-l">Admin</span>
        </div>
        <!-- END Side Header -->

        <!-- Side Content -->
        <div class="side-content remove-padding-t">
            <!-- Block -->
            <div class="block pull-r-l">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        <li>
                            <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                        </li>
                        <li>
                            <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Block</h3>
                </div>
                <div class="block-content">
                    <p>...</p>
                </div>
            </div>
            <!-- END Block -->
        </div>
        <!-- END Side Content -->
    </div>
    <!-- END Side Overlay Scroll Container -->
</aside>
<!-- END Side Overlay -->

<!-- Sidebar -->
<nav id="sidebar">
    <!-- Sidebar Scroll Container -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
        <div class="sidebar-content">
            <!-- Side Header -->
            <div class="side-header side-content bg-white-op">
                <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times"></i>
                </button>
                <!-- Themes functionality initialized in App() -> uiHandleTheme() -->
                <div class="btn-group pull-right">
                    <button class="btn btn-link text-gray dropdown-toggle" data-toggle="dropdown" type="button">
                        <i class="si si-drop"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right font-s13 sidebar-mini-hide">
                        <li>
                            <a data-toggle="theme" data-theme="default" tabindex="-1" href="javascript:void(0)">
                                <i class="fa fa-circle text-default pull-right"></i> <span class="font-w600">Default</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="theme" data-theme="{{URL('assets/css/themes/amethyst.min.css')}}" tabindex="-1" href="javascript:void(0)">
                                <i class="fa fa-circle text-amethyst pull-right"></i> <span class="font-w600">Amethyst</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="theme" data-theme="{{URL('assets/css/themes/city.min.css')}}" tabindex="-1" href="javascript:void(0)">
                                <i class="fa fa-circle text-city pull-right"></i> <span class="font-w600">City</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="theme" data-theme="{{URL('assets/css/themes/flat.min.css')}}" tabindex="-1" href="javascript:void(0)">
                                <i class="fa fa-circle text-flat pull-right"></i> <span class="font-w600">Flat</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="theme" data-theme="{{URL('assets/css/themes/modern.min.css')}}" tabindex="-1" href="javascript:void(0)">
                                <i class="fa fa-circle text-modern pull-right"></i> <span class="font-w600">Modern</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="theme" data-theme="{{URL('assets/css/themes/smooth.min.css')}}" tabindex="-1" href="javascript:void(0)">
                                <i class="fa fa-circle text-smooth pull-right"></i> <span class="font-w600">Smooth</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <a class="h5 text-white" href="{{Url('/')}}">
                    <i class="fa fa-circle-o-notch text-primary"></i> <span class="h4 font-w600 sidebar-mini-hide">Contapp</span>
                </a>
            </div>
            <!-- END Side Header -->

            <!-- Side Content -->
            <div class="side-content">
                <ul class="nav-main">
                    <li>
                        <a class="active" href="{{Url('/')}}"><i class="si si-speedometer"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                    </li>
                    <li class="nav-main-heading"><span class="sidebar-mini-hide">Administrativo</span></li>
                    <li>
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-grid"></i><span class="sidebar-mini-hide">Productos</span></a>
                        <ul>
                            <li>
                                <a href="{{Url('productos')}}">Productos</a>
                            </li>
                            <li>
                                <a href="{{Url('atributos')}}">Atributos</a>
                            </li>
                            <li>
                                <a href="{{Url('productos/informes')}}">Informes</a>
                            </li>
                            <li>
                                <a href="{{Url('productos/carga_masiva')}}">Carga Masiva</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-users"></i><span class="sidebar-mini-hide">Contactos</span></a>
                        <ul>
                            <li>
                                <a href="{{Url('proveedores')}}">Proveedores</a>
                            </li>
                            <li>
                                <a href="{{Url('clientes')}}">Clientes</a>
                            </li>
                            <li>
                                <a href="{{Url('usuarios')}}">Usuarios</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-heading"><span class="sidebar-mini-hide">Facturación</span></li>
                    <li>
                        <a class="nav-submenu" data-toggle="nav-submenu" href="{{Url('productos')}}"><i class="si si-basket"></i><span class="sidebar-mini-hide">Ventas</span></a>
                        <ul>
                            <li>
                                <a href="{{Url('ventas/pos')}}">POS</a>
                            </li>
                            <li>
                                <a href="{{Url('ventas')}}">Ventas</a>
                            </li>
                            <li>
                                <a href="{{Url('ventas/informes')}}">Informes</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-handbag"></i><span class="sidebar-mini-hide">Compras</span></a>
                        <ul>
                            <li>
                                <a href="{{Url('compras')}}">Comprar</a>
                            </li>
                            <li>
                                <a href="{{Url('compras/informes')}}">Informes</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-wallet"></i><span class="sidebar-mini-hide">Caja</span></a>
                        <ul>
                            <li>
                                <a href="start_backend.html">Link #1</a>
                            </li>
                            <li>
                                <a href="start_backend.html">Link #2</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-heading"><span class="sidebar-mini-hide">Configuraciones</span></li>
                    <li>
                        <a class="nav-submenu" data-toggle="nav-submenu" href="{{Url('productos')}}"><i class="si si-home"></i><span class="sidebar-mini-hide">Tiendas</span></a>
                        <ul>
                            <li>
                                <a href="start_backend.html">Link #1</a>
                            </li>
                            <li>
                                <a href="start_backend.html">Link #2</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-submenu" data-toggle="nav-submenu" href="{{Url('productos')}}"><i class="si si-users"></i><span class="sidebar-mini-hide">Usuarios</span></a>
                        <ul>
                            <li>
                                <a href="start_backend.html">Link #1</a>
                            </li>
                            <li>
                                <a href="start_backend.html">Link #2</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- END Side Content -->
        </div>
        <!-- Sidebar Content -->
    </div>
    <!-- END Sidebar Scroll Container -->
</nav>
<!-- END Sidebar -->