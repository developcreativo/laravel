<!DOCTYPE html>

<html lang="es">

  <head>

    

    <title> @yield('tittle') </title>



    <!-- Bootstrap -->

      <!-- {{HTML::style('assets/css/bootstrap.min.css')}}

    {{HTML::style('css/jumbotron-narrow.css')}} -->

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
    
    {{HTML::style('assets/css/fonts/linecons/css/linecons.css')}}
    {{HTML::style('assets/css/fonts/fontawesome/css/font-awesome.min.css')}}
    {{HTML::style('assets/css/bootstrap.css')}}

    {{HTML::style('assets/css/xenon-core.css')}}

    {{HTML::style('assets/css/xenon-forms.css')}}

    {{HTML::style('assets/css/xenon-components.css')}}

    {{HTML::style('assets/css/xenon-skins.css')}}

     {{HTML::style('assets/css/custom.css')}}

<!--     {{HTML::style('assets/css/xenon.css')}} -->

    @yield('style')

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script async="" src="//www.google-analytics.com/analytics.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    





  </head>

  <body class="page-body">

   <div class="page-container">

    <!--  aqui se inlcuye el sidebar static xenon -->

    @include('layouts.sidebar')

    <!-- fin del sidebar -->

  <div class="main-content">

      <!--  aqui se inlcuye el header static xenon -->

      @include('layouts.header')

      <!-- fin del header -->
      <div class="page-title">
        
        <div class="title-env">
          <h1 class="title"> @yield('title')</h1>
          <p class="description"> @yield('description')</p>
        </div>
        
          <div class="breadcrumb-env">
          
                <ol class="breadcrumb bc-1">
                  <li>
                    <a href={{url('/')}}><i class="fa-home"></i>Inicio</a>
                  </li>
                  <li class="active">
                    <strong> @yield('title')</strong>
                  </li>
                </ol>
                
        </div>
          
      </div>

      @if (Session::has('mensaje_login'))

      <div class="alert alert-danger" role="alert">

          <button type="button" class="close" data-dismiss="alert">&times;</button>

          <strong>Errores:</strong>

      <span>{{ Session::get('mensaje_login') }}</span>

    </div>

      @endif

      

      @yield('content')



    

      

      <div class="footer">

         <p>&copy mauricio suarez vega</p>

      </div>



   </div>

   </div>

  



    
  @yield('scripts')
    

   {{HTML::script('assets/js/bootstrap.min.js')}}

   {{HTML::script('assets/js/TweenMax.min.js')}}

   {{HTML::script('assets/js/resizeable.js')}}

   {{HTML::script('assets/js/joinable.js')}}

   {{HTML::script('assets/js/xenon-api.js')}}

   {{HTML::script('assets/js/xenon-toggles.js')}}

   {{HTML::script('assets/js/xenon-custom.js')}}

 

   <textarea tabindex="-1" style="position: absolute; top: -999px; left: 0px; right: auto; bottom: auto; border: 0px; padding: 0px; box-sizing: content-box; word-wrap: break-word; overflow: hidden; -webkit-transition: none; transition: none; height: 0px !important; min-height: 0px !important; font-family: Arimo, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; font-style: normal; letter-spacing: 0px; text-transform: none; word-spacing: 0px; text-indent: 0px; line-height: 18.5714302062988px; width: 53px;" class="autosizejs" id="autosizejs"></textarea>





  </body>

</html>

  

   