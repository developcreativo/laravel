

<div class="sidebar-menu toggle-others fixed" style="">

    <div class="sidebar-menu-inner ps-container ps-active-y">

        <header class="logo-env">

            <!-- logo -->
            <div class="logo">
                <a href="{!! Url('/')!!}" class="logo-expanded">
                    {!! HTML::image('assets/images/logo@2x.png','logo',['width'=>'80']) !!}
                </a>
                <a href="{!! Url('/')!!}" class="logo-collapsed">
                    {!! HTML::image('assets/images/logo-collapsed@2x.png','logo',['width'=>'40']) !!}
                </a>
            </div>

            <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
            <div class="mobile-menu-toggle visible-xs">
                <a href="#" data-toggle="user-info-menu">
                    <i class="fa-bell-o"></i>
                    <span class="badge badge-success">7</span>
                </a>

                <a href="#" data-toggle="mobile-menu">
                    <i class="fa-bars"></i>
                </a>
            </div>

            <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative
            <div class="settings-icon">
                <a href="#" data-toggle="settings-pane" data-animate="true">
                    <i class="linecons-cog"></i>
                </a>
            </div>-->


        </header>

        <section class="sidebar-user-info">
            <div class="sidebar-user-info-inner">
                <a href="profile/" class="user-profile">
                    {!! HTML::image('img/'.Auth::user()->image,'usuario',['class'=>'img-circle img-corona','width'=>'68','height'=>'62']) !!}
                    <span> <strong>{{str_limit(Auth::user()->name,$limit = 10, $end = '')}}</strong>{{ Auth::user()->role_id}}</span>
                </a>
                <ul class="user-links list-unstyled">
                    <li><a href="profile/" title="Edit profile"> <i
                                    class="linecons-user"></i>
                            Edit profile
                        </a>
                    </li>
                    <li><a href="
                    mailbox-main/" title="Mailbox"> <i
                                    class="linecons-mail"></i>
                            Mailbox
                        </a>
                    </li>
                    <li class="logout-link"><a href="{!! Url('auth/logout')!!}" title="Log out">
                            <i class="fa-power-off"></i> </a>
                    </li>
                </ul>
            </div>
        </section>

        <ul id="main-menu" class="main-menu">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            <li class="has-sub">
                <a href="#">
                    <i class="linecons-cog"></i>
                    <span class="title">Productos</span>
                    <span class="label label-purple pull-right hidden-collapsed">New Items</span>
                </a>
                <ul>
                    <li>
                        {!! html::link('productos','Productos')!!}
                    </li>
                    <li>
                        {!! html::link('marcas','Marcas')!!}
                    </li>
                    <li>
                        {!! html::link('categorias','Categorías')!!}
                    </li>

                </ul>
            </li>
            <li class="has-sub">
                <a href="#">
                    <i class="linecons-desktop"></i>
                    <span class="title">Contabilidad</span>
                </a>
                <ul>
                    <li>
                        {!! html::link('egresos','Egresos')!!}
                    </li>
                    <li>
                        {!! html::link('compras','Compras')!!}
                    </li>

                </ul>
            </li>
            <li class="has-sub">
                <a href="#">
                    <i class="linecons-desktop"></i>
                    <span class="title">Mercadolibre</span>
                </a>
                <ul>
                    <li>
                        {!! html::link('mercadolibre','Prueba')!!}
                    </li>
                </ul>
            </li>
            <li class="has-sub">
                <a href="#">
                    <i class="linecons-note"></i>
                    <span class="title">Ventas</span>
                </a>
                <ul>
                    <li>
                        {!! html::link('ventas/create','POS')!!}
                    </li>
                    <li>
                        {!! html::link('ventas','Ventas')!!}
                    </li>
                    <li>
                        {!! html::link('ventas/remision','Remisiones')!!}
                    </li>
                    <li>
                        {!! html::link('caja','Caja')!!}
                    </li>

                </ul>
            </li>
        </ul>

        <div class="ps-scrollbar-x-rail" style="display: block; width: 300px; left: 0px; bottom: 3px;">
            <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps-scrollbar-y-rail" style="display: inherit; top: 0px; right: 2px;">
            <div class="ps-scrollbar-y" style="top: 0px; height: 481px;"></div>
        </div>
    </div>

</div>