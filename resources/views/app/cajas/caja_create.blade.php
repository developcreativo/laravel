<!-- Modal formulario AGcliente-->
<div class="modal fade" id="AbrirCaja" aria-hidden="true" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open() !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Abrir Caja</h4></div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <!--- Apertura Field --->
                        <div class="form-group">
                            {!! Form::label('apertura', 'Apertura:') !!}
                            {!! Form::text('apertura', null, ['class' => 'form-control','placeholder'=>'$00']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!--- nota Field --->
                        <div class="form-group">
                            {!! Form::label('nota', 'Nota:') !!}
                            {!! Form::textarea('nota', null,
                            ['placeholder'=>'ingrese aqui cualquier dato relevante de la apertura de su caja',
                            'class' => 'form-control','rows'=>'3']) !!}
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <!--- Abrir Field --->

                    {!! Form::submit('Abrir', ['class' => 'btn btn-success']) !!}



            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>