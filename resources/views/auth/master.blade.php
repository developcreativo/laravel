<!DOCTYPE html>
<!--[if IE 9]>
<html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-focus"> <!--<![endif]-->
<head>
    @include('layouts.head')
</head>
<body class="auth">
    <div class="content overflow-hidden">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                <div class="text-center">
                    {!! HTML::image('img/logo.png', 'contapp', ['class' => 'logo','width'=>'100']) !!}
                    <h1 class="font-w600 push-10-t push-20" style="color: #eeeeee">Contapp</h1>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="text-center animated fadeInUp">
        <small class="text-muted font-w600"><span class="js-year-copy"></span> &copy; Contapp</small>
    </div>
<!-- END Footer -->
<!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
@include('layouts.scripts')
<!-- Page JS Code -->
@yield('scripts')

@include('layouts.notificaciones')
</body>
</html>