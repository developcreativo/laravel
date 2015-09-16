@extends('auth.master')

@section('content')


    <!-- Reminder Block -->
    <div class="block block-themed animated fadeIn">
        <div class="block-header bg-primary">
            <ul class="block-options">
                <li>
                    <a href="{{ URL::to('auth/login') }}" data-toggle="tooltip" data-placement="left" title="Log In"><i
                                class="si si-login"></i></a>
                </li>
            </ul>
            <h3 class="block-title">Recordar contraseña</h3>
        </div>
        <div class="block-content block-content-full block-content-narrow">
            <!-- Reminder Form -->
            <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/base_pages_reminder.js) -->
            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation-reminder form-horizontal push-30-t push-50" action="/password/email"
                  method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="form-material form-material-primary floating">
                            <input class="form-control" type="email" id="reminder-email" name="email"
                                   value="{{ old('email') }}">
                            <label for="email">Email</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <button class="btn btn-block btn-primary btn-lg" type="submit"><i
                                    class="si si-envelope-open pull-right"></i> Enviar
                        </button>
                    </div>
                </div>
            </form>
            <!-- END Reminder Form -->
        </div>
    </div>
    <!-- END Reminder Block -->



@stop
@section('scripts')
    {!! HTML::script('assets/js/pages/base_pages_reminder.js')!!}
@stop