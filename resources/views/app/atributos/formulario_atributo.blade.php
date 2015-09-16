<!-- Modal atributos -->
<div class="modal fade" id="Modal_Atributos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document" style="min-width: 30%">
        {!! Form::open(['action' => 'AtributoController@store','class'=>'form-horizontal','id'=>'form_atributo'])
        !!}
        <div class="modal-content">

            <div class="block block-themed block-transparent remove-margin-b push-20">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Crear Atributo</h3>
                </div>
            </div>

            <div class="block-content">

                        <!--- categoria Field --->
                        {!! Form::text('atributo', null, ['class' => 'form-control push-20','placeholder'=>'nombre...']) !!}


                        <!--- atributos_sub Field --->
                        {!! Form::text('atributos_sub', 'ejemplo', ['class' => ' js-tags-input form-control push-20']) !!}

            </div>
            <div class="modal-footer push-20-t">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('guardar', ['class' => 'btn btn-success','id' => 'enviar_atributo',
                'data-dismiss'=>'modal']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script>
    $(function () {
        App.initHelper('tags-inputs');
    });
</script>