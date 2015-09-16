<!-- Modal pago-->
<div class="modal fade" id="pagos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Medio de Pago</h3>
                </div>
            </div>
            <div class="block-content push-20" style="display: inline-block">
                {{--modulo de tarjetas--}}
                <div class="unidad_pago col-sm-6">

                    <div class="cash col-sm-6 btn btn-default" onclick='Adpago("Visa",2)'>
                        <div class="cash-icon visa"></div>
                        <span>Visa</span></div>
                    <div class="cash col-sm-6 btn btn-default" onclick='Adpago("Mastercard",3)'>
                        <div class="cash-icon master"></div>
                        <span>Master</span></div>
                    <div class="cash col-sm-6 btn btn-default" onclick='Adpago("Amex",4)'>
                        <div class="cash-icon amex"></div>
                        <span>Amex</span></div>
                    <div class="cash col-sm-6 btn btn-default" onclick='Adpago("Diners",5)'>
                        <div class="cash-icon diners"></div>
                        <span>Diners</span></div>
                    <div class="cash col-sm-6 btn btn-default" onclick='Adpago("Efectivo",1)'>
                        <div class="cash-icon efectivo"></div>
                        <span>Efectivo</span></div>
                    <div class="cash col-sm-6 btn btn-default" onclick='Adpago("Crédito",6)'>
                        <div class="cash-icon contra"></div>
                        <span>Crédito</span></div>

                </div>
                {{--modulo de pagos--}}
                <div class="unidad_pago col-sm-6">
                    <div class="cash-logo"></div>
                    <div class="pagos-item push-10 ">
                        <table class="table pagos-table remove-margin-b" id="pagos-item"></table>
                    </div>
                    <div class="totales-pago">
                        <a class="btn btn-danger btn-block totales-pago faltante " disabled>
                            <span>Falta: $</span>
                            <span id="faltante"></span>
                        </a>
                        <a class="btn btn-success btn-block totales-pago push-5 " disabled>
                            <span>TOTAL: $</span>
                            <span id="total-pago"></span>
                        </a>

                        <div id="otros">
                            <!--- cliente_id Field --->
                            {!! Form::hidden('tienda_id', null, ['class' => 'form-control','id'=>'tienda_id']) !!}
                                    <!--- cliente_id Field --->
                            {!! Form::hidden('user_id', Auth::user()->id, ['class' =>
                            'form-control','id'=>'user_id']) !!}
                        </div>
                        {!! Form::submit('PAGAR', ['class' => 'btn btn-primary btn-lg btn-block totales-pago',
                        'id'=>'PAGAR']) !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>