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


<?php


require '../app/phpsdkmaster/MercadoLivre/meli.php';

$meli = new Meli('5909368031571237', 'tqOqeQIli8gvYOHZ2BIgSjCx7Bp0xU9z');
//$meli = new Meli('5909368031571237', 'tqOqeQIli8gvYOHZ2BIgSjCx7Bp0xU9z', $_SESSION['access_token'], $_SESSION['refresh_token']);
// Create our Application instance (replace this with your appId and secret).


if($_GET['code']):
    $oAuth = $meli->authorize($_GET['code'], 'http://miproteina.contapp.com.co/login');
    $_SESSION['access_token'] = $oAuth['body']->access_token;
else:
    echo 'Login with MercadoLibre';
endif;

$item = $meli->get("/users/70590888/items/search", array('access_token' => $_SESSION['access_token']));

?>
<pre>hola creo que estoy logeado y tengo <?php print_r($item) ?></pre>
@stop