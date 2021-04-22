@extends('layouts.appAdmin')

{{-- esto se puede hacer porqe se saco de esto https://www.dropzonejs.com/ cogiendo los cdn de aca https://cdnjs.com/libraries/dropzone --}}
@section('content')
	<div style="margin-top: 150px; margin-bottom: 180px;" class="container">
		<h3>Resolución recomendada: 1920x1080 (HD)</h3>
		<form action="{{ url('admin/slider') }}" class="dropzone" id="my-awesome-dropzone">
		      @csrf
		</form>
		<hr>
		<div id="imagenesv" class="row">
			{{-- Aquí mostramos las imágenes --}}
		</div>
	</div>
@endsection
{{-- estas section se invocan del layouts appAdmin --}}
@section('slider-drop-zone-css') 
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dragula.css') }}">
@endsection

@section('slider-drop-zone-js')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js'></script>{{--este cdn se debe colocar siempre la ultima version--}}
	<script>
	function mostrarImagenes()
	{
		var imagenesMostrar = document.getElementById('imagenesv');//agarramos el div imagenesv
        axios.get('/admin/imagenes-slider',{responseType:'text'}).then(response => {//admin/imagenes-slider/ me lleva al controlador \Controllers\admin\SliderController.php accion imagenesMostrarAxios..responseType:'text' recibo una respuesta de tipo texto (me trae las imagenes del slider metidas en un div con estilos y con el boton de eliminar dicha imagen )
        	imagenesMostrar.innerHTML=response.data;
	    }).catch(error => {
	        console.log(error);
	    });
	}

	function eliminarImagen(id)
	{
		var url='/admin/slider/'+id;//\Controllers\admin\SliderController.php y me lleva al index
        axios.delete(url).then(response =>{ //eliminamos
            //$('#'+id).hide('slow');//efecto de borrado
        	mostrarImagenes();//cuando elimino muetro esta funcion q me muestra las imagenes q hay asi no mostraria la eliminada
        }).catch(error => {
        	alert(error);
        });
	}

	$(document).ready(function() {//se carga desde resources\views\layouts\appAdmin.blade.php cuando toco slider
		mostrarImagenes();//muestro las imagenes apenas cargo cargando el metodo imagenesMostrarAxios
		Dropzone.options.myAwesomeDropzone = {
		    paramName: "file", // Las imágenes se van a usar bajo este nombre de parámetro
		    maxFilesize: 2, // Tamaño máximo en MB
		    success: function (file, response) {// si se han subido al servidor satisfactoriamente
		        mostrarImagenes();//las muestro
		    }
		};
//implemento dragula para mover las imagenes
		dragula([document.getElementById('imagenesv')])//este div engloba a todas las imagenes
		  .on('drop', function (el) {//con solo esta line genero el movimiento de las imagenes
		  //esto es la logica q se agrego
		  	var ultimo=false;
		  	var posicionInicial=el.id;//cojo la pocision el id q se arrastra ..viene de este metodo imagenesMostrarAxios q se invoco cuando se cargo este archivo y trae esto id="'.$imagen->orden.'
		  	var posicionFinal=$('#'+el.id).next().attr('id');//$('#'+el.id).next() cojo la posicion siguiente (REFIRIENDOME HACIA ABAJO DE LA IMAGEN Q ARRASTRE PORQE SE LEE ASI).. .attr('id') de tal id o sea el q arrastre
		  	if(posicionFinal==undefined){//si da undefined (es porqe arrastre la imagen abajo del todo)
		  		posicionFinal=false;//le pongo false
		  		ultimo=true; //si no true.. Cuando idSecundario=0, tomará la última posición.
		  	}
		  	axios.get('/admin/imagenes-ordenar/'+ posicionInicial +'/'+ posicionFinal +'/'+ ultimo,{responseType:'text'}).then(response => {// me lleva a \Controllers\admin\SliderController.php.. responseType y me trae una respuesta de tipo texto 
		  		mostrarImagenes();//refrescamos
				  //las tostadas para el mensajito  fue sacado de https://github.com/CodeSeven/toastr
		  		toastr.info('La imagen se ha cambiado','¡Bien!', {
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                });
		    }).catch(error => {
		        console.log(error);
		    });
		  });
	});
	</script>
@endsection
