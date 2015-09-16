@extends('layouts.master')

@section('title')
    Carga Masiva
@stop

@section('description')
@stop

@section('style')
    {!! HTML::style('assets/js/plugins/dropzonejs/dropzone.min.css')!!}
@stop

@section('breadcrumb')
    <li><a href="{{url('productos')}}">Productos</a></li>
@stop

@section('content')
    <div class="col-sm-6">
        <div class="block">

            <div class="block-content">
                <p class="lead">Carga masiva de productos.</p>

                <div class="nice-copy">
                    <p>Sabemos que una de las cosas que mas toma tiempo es la creación de productos, con este modulo
                        podras realizarlo de la forma más fácil. Además puedes crear de una vez todas tus marcas,
                        categorias e impuestos.</p>

                    <p>Acontinuación te dejamos las plantillas de cada uno.</p>
                </div>
                <div class="content-grid">
                    <div class="row">
                        <div class="col-xs-6 col-sm-3">
                            <a class="block block-link-hover2 text-center"
                               href="{{ url('productos/carga_masiva/download/marcas') }}">
                                <div class="block-content block-content-full bg-amethyst">
                                    <i class="si si-list fa-4x text-white"></i>

                                    <div class="font-w600 text-white-op push-15-t">Marcas</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <a class="block block-link-hover2 text-center"
                               href="{{ url('productos/carga_masiva/download/categorias') }}">
                                <div class="block-content block-content-full bg-city">
                                    <i class="si si-list fa-4x text-white"></i>

                                    <div class="font-w600 text-white-op push-15-t">Categorias</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <a class="block block-link-hover2 text-center"
                               href="{{ url('productos/carga_masiva/download/impuestos') }}">
                                <div class="block-content block-content-full bg-success">
                                    <i class="si si-calculator fa-4x text-white"></i>

                                    <div class="font-w600 text-white-op push-15-t">Impuestos</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <a class="block block-link-hover2 text-center"
                               href="{{ url('productos/carga_masiva/download/productos') }}">
                                <div class="block-content block-content-full bg-primary">
                                    <i class="si si-grid fa-4x text-white"></i>

                                    <div class="font-w600 text-white-op push-15-t">Productos</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="block">
                <div class="block-content block-content-full">
                    {!! Form::open(['action'=>'ProductosController@import','files'=>'true','class'=>'dropzone
                    dz-clickable','id'=>'excel']) !!}
                    <div class="dz-default dz-message"><span>Suelta los archivos aquí para cargarlos</span></div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="block">

            <div class="block-content">
                <p class="lead">Ayuda inicial.</p>

                <div class="nice-copy">
                    <p>Dentro del archivo productos encontrarás <strong>marca_id, categoria_id y impuestos</strong> ahí
                        deberas poner el id al que correspone cada producto, para ello te relacionamos el nombre de cada
                        uno y al lado su ID para que sea mas fácil para ti.</p>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-3">
        <div class="block block-themed">
            <div class="block-header bg-amethyst">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"><i
                                    class="si si-arrow-up"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Marcas</h3>
            </div>
            <div class="block-content">
                <ul class="list-group">
                    @foreach($marcas as $marca)
                        <li class="list-group-item"><span class="badge">{{ $marca->id }}</span>{{ $marca->marca }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="block block-themed">
            <div class="block-header bg-city">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"><i
                                    class="si si-arrow-up"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Categorias</h3>
            </div>
            <div class="block-content">
                <ul class="list-group">
                    @foreach($categorias as $categoria)
                        <li class="list-group-item"><span
                                    class="badge">{{ $categoria->id }}</span>{{ $categoria->categoria }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="block block-themed">
            <div class="block-header bg-success">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"><i
                                    class="si si-arrow-up"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Impuestos</h3>
            </div>
            <div class="block-content">
                <ul class="list-group">
                    @foreach($impuestos as $impuesto)
                        <li class="list-group-item"><span
                                    class="badge">{{ $impuesto->id }}</span>{{ $impuesto->impuesto }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


@stop

@section('scripts')
    {!! HTML::script('assets/js/plugins/dropzonejs/dropzone.min.js')!!}
    <script>
        Dropzone.options.excel = {
            init: function () {
                this.on("success", function (file) {
                    $.notify({
                        title: "<strong>Respuesta:</strong> ",
                        message: 'documento recibido correctamente',
                        icon: 'fa fa-check'}, {
                        type: 'success'
                    });
                });
                this.on("error", function (file) {
                    $.notify({
                        title: "<strong>Respuesta:</strong> ",
                        message: 'Lo siento el archivo no es un excel',
                        icon: 'fa fa-times'},{
                        type: 'danger'
                    });
                });
            }
        };
    </script>
@stop