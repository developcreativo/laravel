<div class="col-sm-12 bg-gray-lighter push-20">

    <div class="col-sm-4 col-sm-offset-4 push-20-t">
        <div class="block  block-themed">
            <div class="block-header bg-primary">
                <h3 class="block-title">Ingreso</h3>
            </div>
            <div class="block-content">

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            {!! Form::number('valor', null, ['class' => 'form-control','id'=>'valor','placeholder'=>'Ingrese su valor']) !!}
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                </div>
                <!--- concepto Field --->
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Concepto:</label>
                        {!! Form::textarea('concepto', null, ['class' => 'form-control','id'=>'concepto', 'placeholder'=>'Ingrese su concepto','rows'=>3]) !!}

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <a href="!#" class="btn btn-lg btn-block btn-success" onclick="abrir_pagos()">Pagar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
