<div class="col-sm-4">{!!HTML::image('img/productos/'.$productos->img, 'a picture', array('class' => 'img-thumbnail'))!!}
</div>
<div class="col-sm-3">
    <h3 class="text-center">Agregar sabor</h3>

    <div class="form-group">
        <!---  Field --->
        {!! Form::select('sabor',$sabor ,null,['class' => 'form-control']) !!}
        <!---  Field --->
        {!! Form::hidden('id', null, ['class' => 'form-control']) !!}
    </div>
    <!--- Agregar Field --->
    <div class="form-group">
        {!! Form::submit('Agregar', ['class' => 'btn btn-primary btn-block']) !!}
    </div>

</div>
<div class="col-sm-5 well" style="min-height: 200px">

    <ul class="list-group">
        <li class="list-group-item active">Sabores:</li>
        @foreach($sabores as $sabor)

            <li class="list-group-item">{{ $sabor->nombre }}</li>
        @endforeach
    </ul>
</div>
