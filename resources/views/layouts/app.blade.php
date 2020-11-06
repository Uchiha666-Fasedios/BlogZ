<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Site made with Mobirise Website Builder v4.8.1, https://mobirise.com -->

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/img-laravel-128x128.png') }}" type="image/x-icon">
    <meta name="description" content="">
     {{-- <title>@yield('title','BlogLaravel')</title> --}} {{-- por defecto title siempre va tener BlogLaravel eso tambien lo configure en .env --}}

     <title>@yield('title',config('app.name'))</title> {{--variable q nos viene de config/app y alli se comunica con el archivo .env esto se deja mejor asi porqe si en un futuro quiero cambiar el nombre solo tengo q cambiarloen en el archivo .env --}}

  <!-- Fonts -->


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arvo:400,400i,700,700i">

  <link rel="stylesheet" href="{{ asset('assets/bootstrap-material-design-font/css/material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/et-line-font-plugin/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/tether/tether.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/colorm-icons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/socicon/css/socicon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/wowslider-init/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mobirise/css/mbr-additional.css') }}" type="text/css">
    <link rel="stylesheet" href = "{{ asset('assets/wowslider-init/twist/style.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('css/buscador-predictivo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/preloader.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">







    {{-- mio --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">{{--esto es mio no es del curso--}}
    {{-- mio --}}





</head>
<body>

{{--carga imagen cuando esta cargando la pagina--}}
<div id="contenedor" >
        <div id="carga">
        </div>
    </div>
{{------------------------------------}}

  <section class="menu1" id="menu-0" data-rv-view="0">



    <nav class="navbar navbar-dropdown navbar-fixed-top " style= "background: #000000;">



        <div class="container-fluid">






            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        <a href="{{route('welcome')}}" class="navbar-logo"><img src="{{ asset('assets/images/img-laravel-128x128.png') }}" alt="Mobirise"></a>
                        {{--  <a class="navbar-caption text-white" href="https://mobirise.com">BLOGLARAVEL</a> --}}
                        <a class="navbar-caption text-white" href="{{route('welcome')}}">{{ config('app.name') }}</a>{{-- variable q nos viene de config/app y alli se comunica con el archivo .env --}}
                    </div>

                </div>












                      {{-- BUSCADOR --}}

                <div style="margin-top: 13px">

                    <form class="form-inline" action="{{url('/buscador')}}" method="GET">
                        @csrf {{-- siempre a los formularios poner esto --}}
                        <div class="form-group">
                        <input id="buscador-predictivo" type="text" class="form-control" id="exampleInputEmail2" name="busqueda" placeholder="Buscar" autocomplete="off">
                        </div>

                        <button style="margin-top: 8px" type="submit" class="btn btn-primary btn-sm">Buscar</button>


                    </form>
                </div>





                      {{-- FIN DEL BUSCADOR --}}


                <div class="mbr-table-cell">



                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <span class="hamburger-icon"></span>
                    </button>



                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
                    <li class="nav-item">
                    <a class="nav-link link" href="{{route('welcome')}}">INICIO</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link link dropdown-toggle" data-toggle="dropdown-submenu" href="https://mobirise.com/" aria-expanded="false">
                    TEMAS PRINCIPALES</a>
                    <div class="dropdown-menu" >

                    @foreach($temasTodos as $tema) {{-- temasTodos esta viene de app\providers\AppServiceProvaider --}}

                    {{--  <a class="dropdown-item" href="{{url('/tema/'.$tema->id)}}">{{ $tema->nombre }}</a> --}}
                    <a class="dropdown-item" href="{{route('tema.show', $tema)}}">{{ $tema->nombre }}</a> {{-- aca cuando toco me llevo el objeto tema --}}


                    @endforeach

                   {{-- esto esta comentado <div class="dropdown">
                    <a class="dropdown-item dropdown-toggle" data-toggle="dropdown-submenu" href="https://mobirise.com/">Trendy blocks</a>
                    <div class="dropdown-menu dropdown-submenu">
                    <a class="dropdown-item" href="https://mobirise.com/">Image/content slider</a>
                    <a class="dropdown-item" href="https://mobirise.com/">Contact forms</a>


                    </div>
                    </div>
                    --}}

                    </div>
                    </li>

                     <li class="nav-item">
                    <a class="nav-link link" href="{{route('sobremi')}}">Sobre mi</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link link" href="{{route('contacto')}}">Contacto</a>
                    </li>

                    @guest {{-- esto me dice si es invitado --}}
                            <li class="nav-item">
                                <a class="nav-link link" href="#" data-toggle="modal" data-target="#loginModal">{{ __('Login') }}</a><!--se utiliza __ para no tener q hacer las traducciones y lo hace laravel automaticamente-->
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else{{-- si no es q esta autenticado --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>  {{-- me muestra el nombre --}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                   {{-- @if(auth()->user()->es_admin) --}} {{-- si esta autenticado y es administrador es_admin esto es el middleware que cree --}}
                                           {{-- <a class="dropdown-item" href="{{ url('/admin/temas') }}">Zona Administrador</a>
                                        @endif  --}}

                                        @if(auth()->user()->hasRole('administrador'))
                                        <a class="dropdown-item" href="{{ url('/admin/temas') }}">Zona Administrador</a>
                                    @endif

                                          @if(auth()->user()->hasRole('moderador'))
                                            <a class="dropdown-item" href="{{ url('moderador/articulos') }}">Zona Moderador</a>
                                        @endif

                                    <a class="dropdown-item" href="{{ url('/home') }}">Zona Privada</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                    </ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <span class="close-icon"></span>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>



<br><br><br>






@yield('content')






<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer2-5" data-rv-view="33" style="background-color: #000000; padding-top: 1.75rem; padding-bottom: 1.75rem;">

    <div class="container">
        <p class="text-xs-center lead">Desarrollado por <a href="">Adrian Lisciotti (©)</a> 2020.</p>
    </div>
</footer>

<script src="{{ asset('assets/web/assets/jquery/jquery.min.js') }}"></script>

{{--nuevo (para la ventana3 de jquery)--}}
<link rel="stylesheet" href="{{ asset('jss/jquery-ui/jquery-ui.min.css') }}" /><!--estylos css de ui va antes de los metodos-->
<link rel="stylesheet" href="{{ asset('jss/jquery-ui/jquery-ui.structure.min.css') }}" /><!--estylos css de ui va antes de los metodos-->
<link rel="stylesheet" href="{{ asset('jss/jquery-ui/jquery-ui.theme.min.css') }}" /><!--estylos css de ui va antes de los metodos-->
<script type="text/javascript" src="{{ asset('jss/jquery-ui/jquery-ui.min.js') }}"></script><!--cargo los metodos de JQUERY UI-->
{{--fin nuevo--}}



  <script src="{{ asset('assets/tether/tether.min.js') }}"></script>
  <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/viewport-checker/jquery.viewportchecker.js') }}"></script>
  <script src="{{ asset('assets/smooth-scroll/smooth-scroll.js') }}"></script>
  <script src="{{ asset('assets/cookies-alert-plugin/cookies-alert-core.js') }}"></script>
  <script src="{{ asset('assets/cookies-alert-plugin/cookies-alert-script.js') }}"></script>
  <script src="{{ asset('assets/dropdown/js/script.min.js') }}"></script>
  <script src="{{ asset('assets/touch-swipe/jquery.touch-swipe.min.js') }}"></script>
  <script src="{{ asset('assets/wowslider-plugin/wowslider.js') }}"></script>
  <script src="{{ asset('assets/theme/js/script.js') }}"></script>
  <script src="{{ asset('assets/wowslider-effect/effects.js') }}"></script>
  <script src="{{ asset('assets/wowslider-init/script.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.2.1/typeahead.bundle.min.js"></script>libreria para q se desplege en elbuscador dicha caja de busqeda--}}
<script src="{{ asset('js/buscador-predictivo.js') }}"></script>
<script src="{{ asset('js/preloader.js') }}"></script>{{--para q ande la imagen de la carga--}}








  {{-- mio --}}
  <script src="{{ asset('js/app.js') }}"></script>
 {{-- mio --}}


 



 @yield('comprobar-alias-js')  {{--esto solo lo utiliza la vista del registro .lo incluimos aqui porqe esto necesita del script q esta arriba --}}
 @yield('include-login-modal') {{-- estoy invocando a la section de welcome.blade.php --}}

  <input name="animation" type="hidden">
   <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>
  <input name="cookieData" type="hidden" data-cookie-text="Utilizamos cookies de terceros.">





  </body>
</html>
