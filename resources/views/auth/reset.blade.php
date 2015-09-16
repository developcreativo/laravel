@extends('auth.master')

@section('content')
    <!-- Register Content -->
    <div class="block block-themed animated fadeIn">
        <div class="block-header bg-success">
            <ul class="block-options">
                <li>
                    <a href="{{ URL::to('auth/login') }}" data-toggle="tooltip" data-placement="left" title="Log In"><i
                                class="si si-login"></i></a>
                </li>
            </ul>
            <h3 class="block-title">Nueva Contraseña</h3>
        </div>
        <div class="block-content block-content-full block-content-narrow">


            <!-- Register Form -->
            <!-- jQuery Validation (.js-validation-register class is initialized in js/pages/base_pages_register.js) -->
            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation-register form-horizontal push-10-t push-10" action="/password/reset" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="form-material form-material-success">
                            <input class="form-control" type="email" id="register-email" name="email"
                                   placeholder="Por favor ingrese su email">
                            <label for="email">Email</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="form-material form-material-success">
                            <input class="form-control" type="password" id="register-password" name="password"
                                   placeholder="Escoge una buena contraseña..">
                            <label for="password">Password</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="form-material form-material-success">
                            <input class="form-control" type="password" id="register-password2"
                                   name="password_confirmation" placeholder="..y confirmala">
                            <label for="password_confirmation">Confirm Password</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <button class="btn btn-block btn-success btn-lg" type="submit"><i class="fa fa-plus pull-right"></i>
                            Regristar
                        </button>
                    </div>
                </div>
            </form>
            <!-- END Register Form -->
        </div>
    </div>
    <!-- END Register Block -->
@stop
@section('scripts')
    {!! HTML::script('assets/js/pages/base_pages_reset.js')!!}
@stop