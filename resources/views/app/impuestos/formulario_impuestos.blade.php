<!-- Modal marcas -->
<div class="modal fade" id="Modal_Impuestos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        {!! Form::open(['action' => 'ImpuestosController@store','class'=>'form-horizontal js-validation-impuestos','id'=>'form_impuestos']) !!}
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b push-20">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Crear Impuesto</h3>
                </div>
            </div>

            <div class="block-content row">

                    <!--- impuesto Field --->
                    <div class="form-group col-sm-12 ">
                        {!! Form::label('impuesto', 'impuesto:') !!}
                        {!! Form::text('impuesto', null, ['class' => 'form-control','placeholder'=>'Ingrese su impuesto...']) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('valor', 'valor:')!!}
                        <div class="input-group">
                            {!! Form::text('valor', null, ['class' => 'form-control','placeholder'=>'Ingrese su valor...']) !!}
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>

            </div>
            <div class="modal-footer push-20-t">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('guardar', ['class' => 'btn btn-success','id' => 'enviar_impuesto']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
