
<script>

    $(function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }



        @foreach($errors->all() as $error )
        toastr.error('{{$error}}');
        @endforeach
        @if (Session::get('mensaje') )
        toastr.success('{{Session::get('mensaje')}}');
        @endif

    });

</script>