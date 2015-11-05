<div class="modal fade" id="modal-email" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-popout modal-sm">
        <div class="modal-content">
            {!! Form::open(['method'=>'get','action' => ['ComprasController@mail', $compra->id]]) !!}
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-success">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Enviar Factura</h3>
                </div>
                <div class="block-content">
                    {!!Form::label('email', 'E-Mail:') !!}
                    {!!Form::email('email_address', null, ['class' => 'form-control field','placeholder'=>'email destinatario']) !!}
                </div>
            </div>
            <div class="modal-footer push-20-t">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Close</button>
                {!! Form::submit('Enviar!',['class'=>'btn btn-sm btn-primary'])!!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>