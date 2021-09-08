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
      <div class="col-xs-12 col-lg-10 col-lg-offset-1" style="color: red; text-align: center;
    font-size: 40px;
    color: #e67e22;
    font-family: nevis;
    text-transform: uppercase;
    letter-spacing: 4px;
    margin-top: 10px;
    text-shadow: 0px 2px 1px #333333; font-weight: bold;">{{$tema->nombre}}</div>
        </div>
<br><br>
        <div class="row">



            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                @foreach ($articulos as $articulo)  {{-- los articulos me llegan por el metodo show de TheamaController --}}
                <div class="col-xs-12 col-lg-4">
                    <div class="jsNewsCard news__card" modal-id="#{{ $articulo->id }}">
                        <div class="news__image">

                            {{--  <img class="news__img" alt="" src="{{url('http://www.adrianweb.live/storage/imagenesArticulos/'. $articulo->imagenDestacada()) }} ">  --}}
                              <img class="news__img" alt="" src="{{url('http://adrianweb.site/storage/imagenesArticulos/'. $articulo->imagenDestacada()) }} ">
                           {{--  <img class="news__img" alt="" src="{{ url('http://www.adrianweb.live/storage/imagenesArticulos/'.$articulo->images()->first()->nombre) }}">  --}}
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
                                        {{--  <img class="news__img" alt="" src="{{ url('http://www.adrianweb.live/storage/imagenesArticulos/'.$imagen->nombre) }}"> --}}
                                        <img class="news__img" alt="" src="{{ url('http://adrianweb.site/storage/imagenesArticulos/'.$imagen->nombre) }}">
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
{{-- Comentarios --}}
<div class="news__inner">
    <strong>COMENTARIOS : </strong>
{{--este enlace solo aparece a los autenticados--}}  @auth<a href="#" class="nuevo-comentario">Escribir un nuevo comentario</a>
{{--si no esta autenticado le aparece este--}}   @else <a href="{{ route('register') }}">Debes registrarte para escribir comentarios</a>
                         @endauth
    <div id="error-enviar-comentario{{ $articulo->id }}" class="bg-danger" style="display: none; padding: 4px">El comentario no puede quedar vacio</div>
    <div id="success-enviar-comentario{{ $articulo->id }}" class="bg-success" style="display: none; padding: 4px">Comentario añadido con Éxito</div>
    {{--caja del formulario del comentario--}}
    <div id="caja-comentario{{ $articulo->id }}" class="caja-comentario" style="display: none; margin-top: 15px">
        <form method="POST" articulo="{{ $articulo->id }}">
            <label> Caracteres restantes: <span></span></label>{{--esto tambien es parte del contador de caracteres cogido del internet--}}
            <textarea style="width:100%; height:150px" maxlength="500"></textarea>
            <button class="enviar-comentario" type="submit">Enviar</button>
        </form>
    </div>
    {{--cierre de caja --}}
</div>
<div class="loading" id="loading{{ $articulo->id }}">{{--esto es para la imagen gif--}}
    <img width="120px" src="{{asset('imagenes/loading.gif')}}">{{--en principio esta oculto desde la vista layout app pero cuando toco enviar en el formulario la desocultamos--}}
</div>
<div class="news__inner">
    <a href="#" class="comentarios-ver" articulo="{{ $articulo->id }}">Ver Comentarios</a>
</div>
<div class="comentarios-mostrar" id="comentarios{{ $articulo->id }}">
    {{-- Aquí se van a mostrar todos los comentarios del articulo. Lo que está abajo comentado --}}
</div>
{{-- Comentarios --}}

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


{{--------------------------------------------}}

@section('comentarios-js')
	<script>
		function eliminarComentario(comentario_id){
			var url='/comentario-borrar/'+ comentario_id;
            axios.delete(url).then(response =>{ //eliminamos
            	$('#'+comentario_id).addClass("animated zoomOutRight");     // Eliminar con efecto
            	$('#'+comentario_id).fadeOut(1000);	   // Eliminar con efecto
            }).catch(error => {
            	alert(error);
            });
		}

		$(document).ready(function() {//CARGA EL ARCHIVO
			// Hace aparecer la caja del comentario
			$('.nuevo-comentario').click(function(){//HAGO CLICK EN el enlace de la linea 96 por ahi
				$(this).siblings('.caja-comentario').toggle('fast');//siblings para agarrar al hermano con esta clase .caja-comentario (los hermanos son los q estan en el mismo nivel) . togglepara q abra y cierra
			});

			// Mostrar Comentario
			$('.comentarios-ver').click(function(){
				var articulo_id=$(this).attr('articulo');
			    var comentariosMostrar = document.getElementById('comentarios'+articulo_id);
	            axios.get('/comentarios-mostrar/' + articulo_id,{responseType:'text'}).then(response => {
		        	comentariosMostrar.innerHTML = response.data;
			    }).catch(error => {
			        console.log(error);
			    });
			});

			// Enviar comentario
			$('.enviar-comentario').click(function(e){//hace clik en el boton de enviar comentario
		    	e.preventDefault();	// Para que la página no se actualice ya que la acción se realiza dentro de un formulario.
		    	var articulo_id = $(this).parents('form').attr('articulo');//enviar-comentario ese elemento tiene un padre q es form de ahi agarra articulo q es el id
		    	var texto=$(this).siblings('textarea').val();//el elemento tiene un hermano q es textarea(se puede llamar directamente a la etiqeta) tomame el valor
//desocultamos el gif
		    	var loading = document.getElementById('loading'+articulo_id);
		    	loading.style.display='block';
////////////////////
				axios.post('/comentario-aniadir',{responseType:'text',texto,articulo_id}).then(response =>{ // Añadimos el comentario por tal ruta q va por post.. responseType:'text' q va tener una respuesta typo texto
					$('#success-enviar-comentario'+articulo_id).show('slow');//cojo el div con tal id y lo mostramos va ser unico porqe acordate q esta en un bucle ese div
					$('#error-enviar-comentario'+articulo_id).hide('slow');//escondo este div q me muestra q un mensaje de error
					$('#caja-comentario'+articulo_id).hide('slow');//escondo la caja de comentario
                }).catch(error => {
                	$('#error-enviar-comentario'+articulo_id).show('slow');//muestro el div de mensaje de todo mal
                	$('#success-enviar-comentario'+articulo_id).hide('slow');//escondo el div de mensaje de todo bien
                }).then(function() {//ocultamos de nuevo el gif
				    loading.style.display = 'none';
				});

                // Una vez metido el comentario, refrescamos todos los comentarios
                var comentariosMostrar = document.getElementById('comentarios'+articulo_id);//cojemos ese div
                axios.get('/comentarios-mostrar/' + articulo_id,{responseType:'text'}).then(response => {//recogemos los comentarios de la base de datos
		        	comentariosMostrar.innerHTML = response.data;
			    }).catch(error => {
			        console.log(error);
			    });
		    });
		});
		// Contador caracteres cogido de internet
		var inputs = "input[maxlength], textarea[maxlength]";
	    $(document).on('keyup', "[maxlength]", function (e) {
        var este = $(this),
            maxlength = este.attr('maxlength'),
            maxlengthint = parseInt(maxlength),
            textoActual = este.val(),
            currentCharacters = este.val().length;
            remainingCharacters = maxlengthint - currentCharacters,
            espan = este.prev('label').find('span');
            if (document.addEventListener && !window.requestAnimationFrame) {
                if (remainingCharacters <= -1) {
                    remainingCharacters = 0;
                }
            }
            espan.html(remainingCharacters);
        });
	</script>
@endsection



{{-------------------------------------------}}

@include('includes.login-modal')
@endsection

@if($errors->any())
  @section('include-login-modal')
  <script src="{{ asset('js/login-modal.js') }}"></script>
  @endsection
@endif
