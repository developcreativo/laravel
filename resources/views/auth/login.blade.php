@extends('auth.master')

@section('content')

    <!-- Login Block -->
    <div class="block block-themed animated fadeIn">
        <div class="block-header bg-primary">
            <ul class="block-options">
                <li>
                    <a href="{{ URL::to('password/email') }}">Olvidaste tu contraseña?</a>
                </li>
                <li>
                    <a href="{{ URL::to('auth/register') }}" data-toggle="tooltip" data-placement="left"
                       title="Crear cuenta"><i class="si si-plus"></i></a>
                </li>
            </ul>
            <h3 class="block-title">Login</h3>
        </div>
        <div class="block-content block-content-full block-content-narrow">
            <!-- Login Title -->

            <!-- END Login Title -->

            <!-- Login Form -->
            <!-- jQuery Validation (.js-validation-login class is initialized in js/pages/base_pages_login.js) -->
            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation-login form-horizontal push-10-t push-10" role="form" method="POST"
                  action="/auth/login">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="form-material form-material-primary floating">
                            <input class="form-control" type="email" id="login-username" name="email">
                            <label for="login-username">Email</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="form-material form-material-primary floating">
                            <input class="form-control" type="password" id="login-password" name="password">
                            <label for="login-password">Contraseña</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="css-input switch switch-sm switch-primary">
                            <input type="checkbox" id="login-remember-me" name="login-remember-me"><span></span>
                            Recordarme?
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <button class="btn btn-block btn-primary btn-lg" type="submit"><i
                                    class="si si-login pull-right"></i> Entrar
                        </button>
                    </div>
                </div>
            </form>
            <!-- END Login Form -->
        </div>
    </div>
    <!-- END Login Block -->
    <!-- END Login Content -->
@stop
@section('scripts')
    {!! HTML::script('assets/js/pages/base_pages_login.js')!!}
@stop