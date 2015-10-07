<div class='block block-themed'>
    <div class="block-content">

        {!! Form::model($producto) !!}
        {{-- formulario de prodcuto sirve para editar y crear --}}
                <!--- Codigo Field --->
        <div class="row push-20">
            <div class="col-sm-3">
                <div class="thumbnail">
                    <img src="{{url($producto->imagen)}}" width="100%">
                </div>

            </div>
            <div class="col-sm-9">
                <!-- codigo y nombre del producto -->
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Codigo:</label>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                {!! Form::text('SKU',null, ['class' => 'form-control','style'=>'text-transform:
                                uppercase;',$block]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label>Nombre del Producto:</label>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-shopping-cart"></i></span>
                                {!! Form::text('producto', null, ['class' => 'form-control','style'=>'text-transform:
                                capitalize;',$block]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- marcas y categorias -->
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>Marca:</label>

                        <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-list" aria-hidden="true"></i>
                </span>
                            {!! Form::text('marca_id', $producto->marcas->marca, ['class'=>'form-control',$block]) !!}

                        </div>
                    </div>
                    <div class="form-group col-sm-5">
                        <label>Categoria:</label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                            {!! Form::text('categoria_id',$producto->categorias->categoria,['class'=>'form-control',$block])!!}
                        </div>
                    </div>

                </div>
                @if($producto->atributo_1 <> 0)
                        <!-- atributos -->
                <div class="row col-sm-12 form-group">

                    <div id="atributo1" class="row">
                        <div class=" col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                                {!! Form::select('atributo_1', $atributos, null, ['class' => 'form-control', $block]) !!}
                            </div>
                        </div>
                        <div class="col-sm-8 variables_1">

                            {!! Form::select('variables_1[]',$variables['lista_variable1'], $variables['variable1'], ['id' => 'variables_1', 'multiple' =>
                            'multiple', 'class' =>'js-select2 form-control']) !!}
                        </div>
                    </div>
                    @if($producto->atributo_2 <> 0)
                        <div id="atributo2" class="row">

                            <div class=" col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                                    {!! Form::select('atributo_2', $atributos, null, ['class' => 'form-control', $block])!!}
                                </div>
                            </div>
                            <div class="col-sm-8 variables_2">
                                <!--  para editar debe cambiar el null por los atributos seleccionados que estan en el producto -->
                                {!! Form::select('variables_2[]',$variables['lista_variable1'], $variables['variable2'], ['id' => 'variables_2', 'multiple' =>
                                'multiple', 'class'=>'js-select2 form-control']) !!}
                            </div>
                        </div>
                    @endif
                </div>
                @endif
                        <!-- precio de venta, compra y rentabilidad -->
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label>Precio de Venta:</label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                            {!! Form::text('venta',null, ['class' => 'form-control','id'=>'venta',
                            "onchange" => "renta();",$block]) !!}


                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Precio de Compra:</label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                            {!! Form::text('compra',null, ['class' => 'form-control','id'=>'compra',
                            "onchange" => "renta();",$block]) !!}

                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Rentabilidad:</label>

                        <div class="input-group">

                            {!! Form::text('rentabilidad',null, ['class' => 'form-control', 'id'=>'rentabilidad', $block]) !!}

                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Impuestos:</label>

                        <div class="input-group">
                            {!! Form::text('impuestos', $producto->impuesto->impuesto, ['class' => 'form-control',$block]) !!}
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- description -->
        <div class="form-group row">{!! Form::label('Nombre', 'Descripción:',['class' => 'col-sm-2 text-right']) !!}

            <div class="col-sm-10">{!! Form::textarea('descripcion', null, ['class' =>'form-control','rows'=>'3',$block]) !!}
            </div>
        </div>
        {!! Form::close() !!}
        <div class="form-group row text-center">
            <a href="{{ $producto->id }}/edit" class="btn btn-minw btn-primary btn-lg" type="button"> Editar</a>
            <button class="btn btn-minw btn-danger btn-lg" data-toggle="modal" data-target="#modal-delete-producto"> Eliminar</button>
        </div>

    </div>
</div>
<!-- modal delete -->
<div class="modal fade" id="modal-delete-producto" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-popout modal-sm">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-danger">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Advertencia</h3>
                </div>
                <div class="block-content">
                    <p>¿Está seguro de querer eliminar este producto? perderá toda la informacion relacionada con el así
                        como sus ventas, reportes y estadisticas</p>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::open(['id'=>'formulario_delete','method'=>'delete','action'=>['ProductosController@destroy',$producto->id ]]) !!}
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-check"></i> Entiendo</button>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
<!-- end modal delete -->
<script>
    $(function () {
        App.initHelper('select2');
    });
    $('.js-select2').attr('disabled', 'disabled');

</script>