<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/img-laravel-128x128.png') }}" type="image/x-icon">
    <meta name="description" content="">
    <title>@yield('title','Administración')</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arvo:400,400i,700,700i">

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

    {{-- mio --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">{{--esto es mio no es del curso--}}
    {{-- mio --}}

</head>

<body>
<section class="menu1" id="menu-0" data-rv-view="0">

    <nav style="background-color: green" class="navbar navbar-dropdown navbar-fixed-top">
        <div class="container-fluid">
            <div class="mbr-table">

            <div class="mbr-table-cell">
                   <div class="navbar-brand">
                      <a class="navbar-caption">@yield('rol','Zona Administrador') / {{ $miga }}</a>
                   </div>
            </div>

            	<div class="mbr-table-cell">
                </div>
                <div class="mbr-table-cell">
                    @if(auth()->check())  {{-- si esta autenticado --}}
                    	<p style="color: white; font-weight: bold">Bienvenido {{Auth::user()->name}}</p>
                    @endif
                    <button class="navbar-toggler pull-xs-right" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <span class="hamburger-icon"></span>
                    </button>
                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-xl" id="exCollapsingNavbar">
                      <li class="nav-item">
                          <a class="nav-link link" href="{{url('/')}}" aria-expanded="false">Blog</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link link" href="{{route('temas.index')}}" aria-expanded="false">Temas</a>
                      </li>


                      <li class="nav-item">
                          <a class="nav-link link" href="{{url('/admin/articulos')}}" aria-expanded="false">Artículos</a>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link link" href="{{route('articulos-borrados.index')}}" aria-expanded="false">Artículos Borrados</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link link" href="{{url('/admin/usuarios')}}" aria-expanded="false">Usuarios</a>{{-- esta ruta esta creada de tipo resource o sea de forma automatica con el comando y va al index --}}
                      </li>

                      <li class="nav-item">
                          <a class="nav-link link" href="{{url('admin/correo-masivo')}}" aria-expanded="false">Correo Masivo</a>
                      </li>

                      <li class="nav-item dropdown">
                          <a class="nav-link link dropdown-toggle" data-toggle="dropdown-submenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{ Auth::user()->name }} <span class="caret"></span> {{-- me muestra el nombre --}}
                          </a>

                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                  Cerrar sesión
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                          </div>
                      </li>
                    </ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <span class="close-icon"></span>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

{{-- contenido del index --}}

@yield('content')

{{-- contenido del index --}}

<footer class="mbr-small-footer mbr-section mbr-section-nopadding footer1" id="footer1-7" data-rv-view="35" style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">

    <div style="height:150px" class="container margin-top-40">
    <p class="text-xs-center lead">Desarrollado por <a href="">Adrian Lisciotti (©)</a> 2020.</p>
    </div>
</footer>

<script src="{{ asset('assets/web/assets/jquery/jquery.min.js') }}"></script>
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


<input name="animation" type="hidden">
   <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>
  <input name="cookieData" type="hidden" data-cookie-text="Utilizamos cookies de terceros.">
</body>
</html>
