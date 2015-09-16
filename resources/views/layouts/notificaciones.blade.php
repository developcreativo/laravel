<script>
    @foreach ($errors->all() as $error)

    $.notify({
                message: '{{ $error }}',
                icon: 'fa fa-times',
                title: '<strong>Error:</strong> '
            }, {
                type: "danger",
                allow_dismiss: true

            });

    @endforeach
    @if (Session::get('mensaje'))
    $.notify({
                message: '{{Session::get('mensaje')}}',
                icon: 'fa fa-check',
                title: '<strong>Respuesta:</strong> '

            }, {
                type: "success",
                allow_dismiss: true

            });

    @endif
    @if (Session::get('status'))
    $.notify({
                message: '{{Session::get('status')}}',
                icon: 'fa fa-check'
            }, {
                type: "success",
                allow_dismiss: true

            });

    @endif
</script>