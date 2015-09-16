
@section('style')
    <script>
        $(document).ready(function(){
            window.print();
            window.history.back();
        })
    </script>
@stop

@include('app.egresos.show')
