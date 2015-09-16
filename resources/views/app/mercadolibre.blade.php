@extends('layouts.master')

@section('title')Mercadolibre prueba
@stop

@section('description')
@stop

@section('style')
@stop

@section('breadcrumb')
@stop

@section('content')
    <p>Pruebas API Mercaolibre</p>


    <button type="button" class="btn btn-success" onclick="enviar()">Login</button>
    <pre id="prueba"></pre>

@stop

@section('scripts')
    <script>
        function enviar() {
            MELI.init({client_id: 5909368031571237});
            MELI.login(function() {
                $('#prueba').html(MELI.getToken());
                var uri = "/users/70590888/items/search?"+MELI.getToken();
                MELI.get(uri, {}, function(data) {
                    alert(JSON.stringify(data));
                });
                MELI.getLoginStatus(function(data) {
                    alert(JSON.stringify(data));
                });

            });

        }
    </script>
    <script src="http://static.mlstatic.com/org-img/sdk/mercadolibre-1.0.4.js"></script>
@stop