@extends('layouts.master')

@section('title')Configuración
@stop

@section('description')
@stop

@section('style')
    {!! HTML::style('assets/js/dropzone/css/basic.css');!!}
@stop

@section('breadcrumb')
@stop

@section('content')

    <div class="col-sm-12">
        <ul class="nav nav-tabs nav-tabs-justified">
            <li  class="active"><a  href="#setting" data-toggle="tab" aria-expanded="true" >
                    <span class="visible-xs"><i class="fa-home"></i></span> <span class="hidden-xs">Empresa</span> </a>
            </li>
            <li class=""><a href="#user" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                class="fa-user"></i></span>
                    <span class="hidden-xs">Usuarios</span> </a></li>
            <li class=""><a href="#bill" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                class="fa-user"></i></span>
                    <span class="hidden-xs">Facturación</span> </a></li>

        </ul>
        <div class="tab-content">
            <div  class="tab-pane active" id="setting" style="overflow: auto">
                @include('app/configuracion/setting')
            </div>
            <div class="tab-pane" id="user" style="overflow: auto">
                @include('app/configuracion/user'
                )</div>
            <div class="tab-pane" id="bill" style="overflow: auto">hello</div>
        </div>
    </div>

@stop


@section('scripts')
    <script>
        $(document).ready(function () {
            $('#enviar').click(function (e) {
                show_loading_bar(100);
                e.preventDefault();
                var form = $('#form_company');
                var url = form.attr('action');
                var data = form.serialize();
                $.post(url, data, function (response) {
                    hide_loading_bar();
                    toastr.success(response.mensaje);
                }).fail(function (response) {
                    alert(response)
                });
            });
            $('#agregar_usuario').click(function (e) {
                show_loading_bar(100);
                e.preventDefault();
                var form = $('#form_user');
                var url = form.attr('action');
                var data = form.serialize();
                $.post(url, data, function (response) {
                    hide_loading_bar();
                    toastr.success(response.mensaje);
                }).fail(function (response) {
                    alert(response)
                });
            });
        });
    </script>
@stop