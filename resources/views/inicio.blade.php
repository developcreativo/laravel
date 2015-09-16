@extends('layouts.master')

 
@section('content')
 <!-- //aca ingresa la informacion angular js-->
     
		<h1>Productos de {!! Auth::user()->name !!}</h1>
<ul>
    @foreach($productos as $producto)
        <li>{!! $producto->producto !!} y es de la marca {!! $producto->marcas->marca !!}</li>
        @endforeach
</ul>



@stop
