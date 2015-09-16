<!--- Codigo Field --->
<div class="row push-20">
    <div class="col-sm-3">
        <div class="thumbnail">
            <img src="{{url($imagen)}}" width="100%">
        </div>
        <span class="file-input btn btn-block btn-primary btn-file">
                Imagen.. {!! Form::file('imagen',null) !!}
            </span>

    </div>

    <div class="col-sm-9">
        <!-- codigo y nombre del producto -->
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Codigo:</label>
                    {!! Form::hidden('id', null) !!}
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
                    {!! Form::select('marca_id', $marcas, null, ['class' =>
                    'form-control','placeholder'=>'Seleccione', 'id' => 'list_marcas',$block])
                    !!}
                    <div class="input-group-btn">
                        <a class="btn btn-success" data-toggle="modal" data-target="#Modal_Marcas"><i
                                    class="glyphicon glyphicon-plus"></i> </a>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-5">
                <label>Categoria:</label>

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                    {!! Form::select('categoria_id', $categorias, null, ['class' =>
                    'form-control','placeholder'=>'Seleccione','id' => 'list_categorias',$block])
                    !!}
                <span class="input-group-btn">
                    <a class="btn btn-success" data-toggle="modal" data-target="#Modal_Categorias"><i
                                class="glyphicon glyphicon-plus"></i> </a>
                </span>
                </div>
            </div>

        </div>
        <!-- atributos -->
        <!-- boton agregar atributos -->
        <div class="form-group col-sm-12 row">
            <a class="btn btn-primary btn-icon btn-icon-standalone pull-left" onclick="ag_atributo();"
               style="margin-top: 15px">
                <i class="fa fa-plus pull-left"></i>
                <span>Atributo</span>
            </a>
        </div>
        <div class="row col-sm-12" id="atributos" data-url="{{ URL::to('productos/atributos') }}">
            <div class="well" style="width: 100%">
                <!-- agregar atributo mediante javascript -->
                <div id="atributo1" class="row">
                    <div class=" col-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                            {!! Form::select('atributo_1', $atributos, null, ['class' =>
                            'form-control','placeholder'=>'Seleccione', "onchange" => "atributo(this,1);"])
                            !!}
                        </div>
                    </div>
                    <div class="col-sm-8 variables_1">
                        <!--  para editar debe cambiar el null por los atributos seleccionados que estan en el producto-->
                        {!! Form::select('variables_1[]',$lista_variable1, $variable1, ['id' => 'variables_1', 'multiple' =>
                        'multiple', 'class' =>'form-control']) !!}
                    </div>
                </div>
                <div id="atributo2" class="row">
                    <!-- agregar atributo mediante javascript -->
                    <div class=" col-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                            {!! Form::select('atributo_2', $atributos, null, ['class' =>
                            'form-control','placeholder'=>'Seleccione', "onchange" => "atributo(this,2);"])!!}
                        </div>
                    </div>
                    <div class="col-sm-8 variables_2">
                        <!--  para editar debe cambiar el null por los atributos seleccionados que estan en el producto-->
                        {!! Form::select('variables_2[]',$lista_variable2, $variable2, ['id' => 'variables_2', 'multiple' =>
                        'multiple', 'class'=>'form-control']) !!}
                    </div>
                </div>

            </div>

        </div>
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

                    {!! Form::text('rentabilidad',null, ['class' => 'form-control', 'readonly',
                    'id'=>'rentabilidad', $block]) !!}

                    <span class="input-group-addon">%</span>
                </div>
            </div>
            <div class="form-group col-sm-3">
                <label>Impuestos:</label>

                <div class="input-group">
                    {!! Form::select('impuestos', $impuestos, null, ['class' =>
                    'form-control','placeholder'=>'Seleccione',
                    $block])
                    !!}
                    <span class="input-group-addon">%</span>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- description -->
<div class="form-group row">{!! Form::label('Nombre', 'Descripción:',['class' => 'col-sm-2
    text-right']) !!}

    <div class="col-sm-10">{!! Form::textarea('descripcion', null, ['class' =>
        'form-control','rows'=>'3','placeholder'=>'Breve descripcion del producto y sus beneficios',$block]) !!}
    </div>
</div>
<script>
    $('#atributos').hide();
    $('#atributo1').hide();
    $('#atributo2').hide();
    var i = 1;
    function atributo(id, atributo) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var url = $('#atributos').data('url');
        var data = {id: id.value, _token: CSRF_TOKEN};
        $.post(url, data, function (response) {
            $('#variables_' + atributo).empty().append(response.variables);
            $('.variables_' + atributo).show();
        });
    }
    function ag_atributo() {
        $('#atributos').show();
        $('#atributo' + i).show();
        $('#variables_' + i).select2({
            placeholder: 'Variables del atributo',
            allowClear: true,
            dropdownAutoWidth: true,
            tokenSeparators: [",", " "],
            width: '100%'

        }).on('select2-open', function () {
            // Adding Custom Scrollbar
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
        i++
    }
    function renta() {
        venta = $('#venta').val();
        compra = $('#compra').val();
        rentabilidad = ((venta - compra) / venta) * 100
        $('#rentabilidad').val(rentabilidad.toFixed(2))
        console.log(rentabilidad)
    }


</script>

