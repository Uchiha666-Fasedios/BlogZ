@extends('layouts.app') {{-- heredo todo lo de y me trae todo la q hay y q se este invocando al tocar el esa vista layouts/app.blade.php --}}

{{-- @section se utiliza para modificar el @yield 'title' es el nombre q se le puso al @yield--}}
@section('title') {{$tema->nombre}} {{--al tocar en la vista de app.blade.php invoqe a la ruta q va al controlador ThemaController
    y la funcion q me trae las variables con los nombres de los temas ACA le pongo de titulo el nombre del tema q me llega --}}
@endsection

@section('content')

<section class="mbr-section mbr-section-hero news" id="news1-7" data-rv-view="14" style="background-color: rgb(255, 255, 255); padding-top: 180px; padding-bottom: 130px;">
    @if($usuarioAutenticado && !$usuarioBloqueado && $usuarioVerificado){{-- usuarioVerificado si se verifico el email --}}


    <div class="container-fluid">

        <div class="row">
      <div class="col-xs-12 col-lg-10 col-lg-offset-1">{{$tema->nombre}}</div>
        </div>

        <div class="row">



            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                @foreach ($articulos as $articulo)  {{-- los articulos me llegan por el metodo show de TheamaController --}}
                <div class="col-xs-12 col-lg-4">
                    <div class="jsNewsCard news__card" modal-id="#{{ $articulo->id }}">
                        <div class="news__image">

                            {{--  <img class="news__img" alt="" src="{{url('assets/imagenesArticulos/'. $articulo->imagenDestacada()) }} ">  --}}
                              <img class="news__img" alt="" src="{{asset('storage/imagenesArticulos/'. $articulo->imagenDestacada()) }} ">
                           {{--  <img class="news__img" alt="" src="{{ Storage::url('imagenesArticulos/'.$articulo->images()->first()->nombre) }}">  --}}
                        </div>
                        <div class="news__inner">
                            <h5 class="mbr-section-title display-6">{{ $articulo->titulo }}.</h5>
                            <p class="mbr-section-text lead">{{ $articulo->contenido }}</p>
                            <div class="news__date">
                                <span class="cm-icon cm-icon-clock"></span>
                                {{-- <p>{{ $articulo->created_at->format('d-m-Y') }}</p> --}} {{-- format('d-m-Y H:i:s') nos dice la hora --}}
                               {{-- <p>{{ $articulo->created_at->diffForHumans() }}</p> --}} {{-- me dice hace un mes hace 3 dias y asi --}}
                                <p>{{ $articulo->created_at->toDayDateTimeString() }}</p>
                            </div>

                        </div>
                    </div>
                </div>

                @endforeach

            </div>

        </div>
{{-- PAGINADOR --}}
        <div class="row">
            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                {{ $articulos->links() }}
            </div>
        </div>

    </div>


    @foreach ($articulos as $articulo)
    <div data-app-prevent-settings="" class="modal fade" tabindex="-1" data-keyboard="true" data-interval="false" id="{{ $articulo->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="news__card" href="#{{ $articulo->id }}">
                           {{--  @if($articulo->images()->first())  si hay imagen first busca la primera q tine ese articulo entro metodo images() viene del modelo Article gracias al omr--}}
                              @if($articulo->images->first()) {{-- lo mismo pero gasto menos recursos por no poner ()..metodo images viene del modelo Article gracias al omr--}}
                               <div class="news__image">
                                    @foreach($articulo->images as $imagen)  {{-- metodo images viene del modelo Article gracias al omr --}}
                                        {{--  <img class="news__img" alt="" src="{{ url('assets/imagenesArticulos/'.$imagen->nombre) }}"> --}}
                                        <img class="news__img" alt="" src="{{ asset('storage/imagenesArticulos/'.$imagen->nombre) }}">
                                    @endforeach
                                </div>
                               @endif

                            <div class="news__inner">
                                <h5 class="mbr-section-title display-6">{{ $articulo->titulo }}.</h5>
                                <p class="mbr-section-text lead">{!! $articulo->contenido !!}</p>{{-- si no me muestra este contenido poner {!! $articulo->contenido !!} para romper la seguridad de laravel --}}
                                <div class="news__date">
                                    <span class="cm-icon cm-icon-clock"></span>
                                    <p>{{ $articulo->created_at->format('d-m-Y') }}</p>
                                </div>

                                <a class="close" href="#" role="button" data-dismiss="modal">
                                    <span aria-hidden="true">×</span>
                                    <span class="sr-only">Close</span>
                                </a>

                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>

        @endforeach


        @elseif(!$usuarioAutenticado)
	    <div style="width: 500px;margin: 20px auto 50px auto;">
	        <div class="alert alert-danger" role="alert">
	          <h4 class="alert-heading">Para, Por favor!</h4>
	          <p>Para acceder a este contenido debes suscribirte primero y luego iniciar sesión</p>
	          <hr>
	          <p class="mb-0"><a href="{{url('/register')}}">Suscribirse</a></p>
	        </div>
        </div>

        @elseif($usuarioBloqueado)
        <div style="width: 500px;margin: 20px auto 50px auto;">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Para, Por favor!</h4>
                <p>Has sido bloqueado</p>
            </div>
        </div>

        @endif

</section>

@include('includes.login-modal')
@endsection

@if($errors->any())
  @section('include-login-modal')
  <script src="{{ asset('js/login-modal.js') }}"></script>
  @endsection
@endif
