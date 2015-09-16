<!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->

{!! HTML::script('js/all.js')!!}
{!! HTML::script('assets/js/plugins/select2/select2.full.min.js')!!}
<!-- Page JS Plugins + Page JS Code -->
<script>
    jQuery(document).ready(function(){
        $( "#loading" ).fadeOut(100, function(){
            $( "#main-container" ).fadeIn(100);
        });
    });

</script>
