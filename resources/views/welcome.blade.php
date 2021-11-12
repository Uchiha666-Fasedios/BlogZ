{{-- PAGINA PRINCIPAL Q SE INVOCA POR LA RUTA EN WEB.PHP  --}}

@extends('layouts.app')<!--q me traiga de la carpeta layouts el app.blade.php-->




@section('content')

{{-- slaider --}}
<section class="mbr-wowslider-container mbr-section mbr-section__container carousel slide mbr-section-nopadding mbr-wowslider-container--twist mbr-after-navbar" data-ride="carousel" data-keyboard="false" data-wrap="true" data-interval="false" id="wowslider-1" data-rv-view="2" style="background-color: rgb(255, 255, 255);">
    <div class="mbr-wowslider">
        <div class="ws_images">
            <ul>
                @foreach($imagenes->sortBy('orden') as $imagen)
                <li>
                    <img src="{{ url('http://adrianweb.site/storage/imagenesSlider/'.$imagen->nombre) }}">
                </li>
            @endforeach


            {{--     <li>

                    <img src="assets/images/matrix1.jpg" alt="title 1" title="title 1"> text 1
                </li>
                <li>

                    <img src="assets/images/matrix2.jpg" alt="title 2" title="title 2"> text 2
                </li>
                <li>

                    <img src="assets/images/matrix3.jpg" alt="title 3" title="title 3"> text 3
                </li> --}}
            </ul>
        </div>
        {{--  <div class="ws_bullets">
            <div>
                <a href="#" title="">
                    <span><img alt="slide1" src="assets/images/tooltip3.jpg"></span>
                </a><a href="#" title="">
                    <span><img alt="slide1" src="assets/images/tooltip2.jpg"></span>
                </a><a href="#" title="">
                    <span><img alt="slide1" src="assets/images/tooltip1.jpg"></span>
                </a>
            </div>
        </div> --}}
        <div class="ws_shadow"></div>
        <div class="mbr-wowslider-options">
            <div class="params" data-paddingbottom="0" data-anim-type="book" data-theme="twist" data-autoplay="true" data-paddingtop="0" data-fullscreen="true" data-showbullets="true" data-timeout="2" data-duration="2" data-height="576" data-width="1024" data-responsive="2" data-showcaptions="false" data-captionseffect="slide" data-hidecontrols="false"></div>
        </div>
</div>
</section>



<section class="mbr-section mbr-section-hero news" id="news1-7" data-rv-view="14" style="background-color: rgb(255, 255, 255); padding-top: 150px; padding-bottom: 150px;">
    @foreach($temasDestacados as $temaDestacado){{-- esta viene de app/http/controllers/welcomeController.php --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                    @foreach($temaDestacado->articles->sortByDesc('id')->take(3) as $articulo) {{-- sortByDesc ESTO ES ORDENAR DE MANERA DESCENDENTE CON LARAVEL.. take(3) me trae los 3 primeros..y como se ordeno descendentenmente me trae los ultimos creados --}}
                        <div class="col-xs-12 col-lg-4">
                            <div class="jsNewsCard news__card" modal-id="#{{ $articulo->id }}">
                                <div class="news__image">

                                    <img class="news__img" alt="" src="{{ url('http://adrianweb.site/storage/imagenesArticulos/'.$articulo->imagenDestacada()) }}">
                                </div>
                                <div class="news__inner">
                                    <h5 class="mbr-section-title display-6">{{ $articulo->titulo }}</h5>
                                    <p class="mbr-section-text lead">{{ $articulo->contenido }}</p>
                                    <div class="news__date">
                                        <span class="cm-icon cm-icon-clock"></span>
                                        <p>{{ $articulo->created_at->toDayDateTimeString() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @foreach($temaDestacado->articles->sortByDesc('id')->take(3) as $articulo)  {{-- sortByDesc ESTO ES ORDENAR DE MANERA DESCENDENTE CON LARAVEL.. take(3) me trae los 3 primeros..y como se ordeno descendentenmente me trae los ultimos creados --}}
            <div data-app-prevent-settings="" class="modal fade" tabindex="-1" data-keyboard="true" data-interval="false" id="{{ $articulo->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="news__card" href="#{{ $articulo->id }}">
                                @if($articulo->images->first())
                                    <div class="news__image">
                                        @foreach($articulo->images as $imagen)
                                            <img class="news__img" alt="" src="{{  url('http://adrianweb.site/storage/imagenesArticulos/'.$imagen->nombre) }}">
                                        @endforeach
                                    </div>
                                @endif
                                <div class="news__inner">
                                    <h5 class="mbr-section-title display-6">{{ $articulo->titulo }}</h5>
                                    <p class="mbr-section-text lead">{!! $articulo->contenido !!}</p>{{-- sem pone asi {!! $articulo->contenido !!} para romper la seguridad de laravel --}}
                                    <div class="news__date">
                                        <span class="cm-icon cm-icon-clock"></span>
                                        <p>{{ $articulo->created_at }}</p>
                                    </div>

                                    <a class="close" href="#" role="button" data-dismiss="modal">
                                        <span aria-hidden="true">×</span>
                                        <span class="sr-only">Cerrar</span>
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
    @endforeach
</section>

<section class="mbr-section mbr-section-hero features16" id="features16-2" data-rv-view="27" style="background-color: #000000; padding-top: 80px; padding-bottom: 80px;">



    <div class="mbr-table-cell">

        <div class="container-fluid">
            <div class="row">

                <div class="mbr-cards-col col-xs-12 col-lg-5">
                    <div class="container">
                        <div class="card cart-block">

                            <div class="col-xs-6 padding-left-0 padding-right-0">
                                {{-- <div class="card-img iconbox"><a href="https://mobirise.com" class="cm-icon cm-icon-cloud mbr-iconfont mbr-iconfont-features16" style="color: rgb(252, 122, 96); text-shadow: rgba(0, 0, 0, 0.298039) 0px 0px 20px, rgba(0, 0, 0, 0.0980392) -10px 10px 7px;"></a></div> --}}
                                <div class="card-img iconbox"><a href="#" data-toggle="modal" data-target="#ventanaModal1"><img src="assets/images/php.jpg" alt="php"></a></div>
                            </div>
                            <div class="col-xs-6 padding-left-0 padding-right-0">
                                <div class="text-xs-left">
                                    <h5 class="mbr-section-subtitle lead">Php se utiliza para el backend mas del 70% de la web esta hecho con el </h5>
                                    <p class="mbr-section-text lead"> El lenguaje PHP se encuentra instalado en más de 20 millones de sitios web y en un millón de servidores. Pudes verlo de un pantallazo.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mbr-cards-col col-xs-12 col-lg-5 col-lg-offset-1">
                    <div class="container">
                        <div class="card cart-block">

                            <div class="col-xs-6 padding-left-0 padding-right-0">
                               {{-- <div class="card-img iconbox"><a href="https://mobirise.com" class="cm-icon cm-icon-note mbr-iconfont mbr-iconfont-features16" style="color: rgb(252, 122, 96); text-shadow: rgba(0, 0, 0, 0.298039) 0px 0px 20px, rgba(0, 0, 0, 0.0980392) -10px 10px 7px;"></a></div> --}}
                               <div class="card-img iconbox"><a href="#" data-toggle="modal" data-target="#ventanaModal2"><img src="assets/images/mysql.jpg" alt="php"></a></div>
                            </div>
                            <div class="col-xs-6 padding-left-0 padding-right-0">
                                <div class="text-xs-left">
                                    <h5 class="mbr-section-subtitle lead">Mysql te dejo la mayoria y las mas importantes consultas que tiene</h5>
                                    <p class="mbr-section-text lead">MYSQL sirve para almacenar y administrar datos en bases de datos relacionales que cuenta con tablas, vistas, procedimientos almacenados, funciones, etc</p>
                                </div>
                            </div>

                        </div>
                  </div>
                </div>

                <div class="col-xs-12 col-lg-8 col-lg-offset-2 text-xs-center">

                    <h1 class="mbr-section-title display-3">Developer</h1>

                </div>

                <div class="mbr-cards-col col-xs-12 col-lg-5">
                    <div class="container">
                        <div class="card cart-block">

                            <div class="col-xs-6 padding-left-0 padding-right-0">
                            <div class="card-img iconbox"><a href="#" data-toggle="modal" data-target="#ventanaModal3"><img src="assets/images/jquery.jpg" alt="php"></a></div>
                            </div>
                            <div class="col-xs-6 padding-left-0 padding-right-0">
                                <div class="text-xs-left">
                                    <h5 class="mbr-section-subtitle lead">Puedes darle increibles efectos a tus plantillas con el poder de Jquery</h5>
                                    <p class="mbr-section-text lead">Jquery te puede facilitar muchas cosas.Aca te dejo una muestra de su increible funcionalidad</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mbr-cards-col col-xs-12 col-lg-5 col-lg-offset-1">
                    <div class="container">
                        <div class="card cart-block">

                            <div class="col-xs-6 padding-left-0 padding-right-0">
                            <div class="card-img iconbox"><a href="#" data-toggle="modal" data-target="#ventanaModal4"><img src="assets/images/css2.jpg" alt="php"></a></div>
                            </div>
                            <div class="col-xs-6 padding-left-0 padding-right-0">
                                <div class="text-xs-left">
                                    <h5 class="mbr-section-subtitle lead">Hoja de estilos en cascada</h5>
                                    <p class="mbr-section-text lead">para poder darle estylo a tu web aca puedes mirar comandos fundamentales.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</section>

<section class="mbr-section accordion" id="accordion1-3" data-rv-view="30" style="background-color: rgb(255, 255, 255); padding-top: 100px; padding-bottom: 100px;">


        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-lg-8 col-lg-offset-2">
                    <div class="section-head text-center space30">
                        <h2 style="   text-shadow: 5px 5px 5px #000; word-spacing: 10px;">DENTRO DE POCO</h2>

                    </div>
                    <br><br>
                    <div class="clearfix"></div>
                    <div id="accordion1-3-init" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
                      <div class="accordion-group">
                        <div class="panel panel-default" style="display: block;">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <span class="signSpan pseudoMinus"></span>
                                <h4 class="panel-title display-6"><a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion1-3-init" data-core="" href="#collapseOneaccordion1-3" aria-expanded="false" aria-controls="collapseOne"><span class="sign"></span>Que otros proyectos se esperan?</a></h4>
                            </div>
                            <div id="collapseOneaccordion1-3" class="panel-collapse noScroll collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body lead"><p>Pronto se crearan mas api-rest-full.. Una tienda online con Angular-Laravel.Tambien se va a crear un proyecto de cursos online</p></div>
                            </div>
                        </div>
                        <div class="panel panel-default" style="display: block;">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <span class="signSpan pseudoPlus"></span>
                                <h4 class="panel-title display-6"><a role="button" class="" data-toggle="collapse" data-parent="#accordion1-3-init" data-core="" href="#collapseTwoaccordion1-3" aria-expanded="true" aria-controls="collapseTwo">Va a haber videos?</a></h4>
                            </div>
                            <div id="collapseTwoaccordion1-3" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body lead"><p>Muy pronto los aportes seran detallados en videos junto con algunos proyectos explicando el codigo paso a paso.  </p></div>
                            </div>
                        </div>
                        <div class="panel panel-default" style="display: block;">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <span class="signSpan pseudoPlus"></span>
                                <h4 class="panel-title display-6"><a role="button" class="" data-toggle="collapse" data-parent="#accordion1-3-init" data-core="" href="#collapseThreeaccordion1-3" aria-expanded="true" aria-controls="collapseThree">Hardware Recomendaciones: </a></h4>
                            </div>
                            <div id="collapseThreeaccordion1-3" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body lead"><p>¿Merece la pena comprar un SSD?:<br>* La respuesta es simple, un si rotundo. Las velocidades de escritura y lectura superan con creces a las de un disco duro mecánico, mejora el rendimiento del sistema en general de una forma impresionante.<br></p></div>
                            </div>
                        </div>



                      </div>
                    </div>
                </div>
            </div>
        </div>




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

@include('includes.login-modal') {{-- incluimos el archivo de boostrap del login --}}
@include('includes.ventana-modal1') {{-- incluimos el archivo de boostrap de la ventanita --}}
@include('includes.ventana-modal2') {{-- incluimos el archivo de boostrap de la ventanita --}}
@include('includes.ventana-modal3') {{-- incluimos el archivo de boostrap de la ventanita --}}
@include('includes.ventana-modal4') {{-- incluimos el archivo de boostrap de la ventanita --}}

@if($errors->any()) {{-- si hay un error --}}
  @section('include-login-modal') {{-- hace referencia al @yield q invoco en app.blade.php para q este codigo se ejecute ahi--}}
  <script src="{{ asset('js/login-modal.js') }}"></script>{{-- { asset esto hace q vaya a la carpeta public .. y esto js/login-modal.js hace q valla a carpeta js archivo login-modal.js --}}
  @endsection
@endif

@endsection
