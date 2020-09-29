<?php //ESTO VENDRIA A SER EL HEADER ?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}"></script>{{-- este se utiliza para los likes --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                  abmRed  {{-- config('app.name', 'Laravel') --}}<?php //{{-- config('app.name', 'Laravel') --}} lo comente porque no quiero q tenga ese nombre y le puse LaraFoto ?>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links --><?php //no estoy identificado ?>
                        @guest <?php //@guest CUANDO NO ESTOY IDENTIFICADO LARAVEL PONE ESTO ?>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else <?php // estoy identificado ?>

                           <li class="nav-item">
                             <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                           </li>
                           <li class="nav-item">
                             <a class="nav-link" href="{{ route('user.index') }}">Gente</a>
                           </li>
                           <li class="nav-item">
                             <a class="nav-link" href="{{ route('likes') }}">Favoritas</a>
                           </li>
                           <li class="nav-item">
                             <a class="nav-link" href="{{ route('image.create') }}">Subir imagen</a>
                           </li>


                           <li class="nav-item">
                             <a class="nav-link" href="#">@include('includes.avatar')<?php //aca hago un include del codigo q me muestra la imagen ?></a>
                           </li>

<?php //ESTA ES LA FLECHITA JUNTO CON {{ Auth::user()->name }}  EL NOMBRE DEL USUARIO IDENTIFICADO ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>



                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('profile',['id'=>Auth::user()->id]) }}"><?php //le paso el id del usuario identificado ?>
                                     Mi perfil
                                  </a>
                                  <a class="dropdown-item" href="{{ route('config') }}">
                                     Configuracion
                                  </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}<?php // ESTE BOTON DE CIERRE DE SESSION AUTOHECHO POR LARAVEL ?>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>


                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>




</body>
</html>
