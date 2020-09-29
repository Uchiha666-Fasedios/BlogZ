<div class="modal fade" id="ventanaModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">jquery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      
		<meta charset="utf-8">
		<title>Aprendiendo jQuery</title>
	
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

  
    <style>
			#caja{
				width:300px;
				height: 50px;
				border: 5px dashed black;
				background: #ccc;
				text-align: center;
				line-height: 50px;
				color: black;
				font-size:19px;
				font-family: Verdana;
				margin-top: 15px;
			}
		</style>
	

  <!--LE AGREGO UNOS ESTILOS A LAS CLASES-->
  <style>
			.zebra{
				border: 5px dashed black;
			}

			.grande{
				font-size: 30px;
			}

			.margen-superior{
				display:block;
				margin-top:45px;
			}

			.resaltado{
				border-bottom: 2px solid green;
			}
		</style>
  

		<h3>Aprendiendo jQuery con Adrian Lisciotti WEB</h3>

		<ul>
			<li><a href="https://www.google.com" title="Google">Ir a Google</a></li>
			<li><a href="https://www.facebook.com" title="Facebook">Ir a Facebook</a></li>
		</ul>

		<p id="rojo" class="sin_borde">Ejercicios de jQuery</p>
		<p id="amarillo" class="zebra">Practicando con selectores</p>
		<p id="verde" class="sin_borde">Quiero ser un parrafo verde</p>
		<p class="zebra">Soy un parrafo blanco</p>

		


<script>
  



$(document).ready(function(){//$(document) el dolar me dice q voy a trabajar con jquery y (document) es el SELECTOR (hay mas selectores) carga toda la pagina script .ready metodo de jquery es un evento q tiene una funcion de kalbak
console.log('esta todo listo'); 
});



// Selector de ID
var rojo =	$("#rojo").css("background","red") //$("#rojo") selecciono el id  .css("background","red") le cambio los estilos
			  .css("color", "white");

			  console.log(rojo); 

	 $("#amarillo").css("background","yellow")
				  .css("color","green");

	$("#verde").css("background","green")
				  .css("color","white");


// Selectores de clases
	var mi_clase = $('.zebra').css("padding","5px");//le pongo estilos

	$('.sin_borde').click(function(){ //$('.sin_borde') selecciono la clase .click evento click con funcion de kalbak
		console.log("Click dado!!");
		$(this).addClass('zebra'); //$(this) se refiere al elemento q yo le alla echo clik .addClass le agrego la clase en este caso ('zebra')
		// y va tener todas sus propiedades tengo q hacer click claro-_- ojo solo agrega los estylos q puse por defecto en el html
		//los nuevos no  estos no var mi_clase = $('.zebra').css("padding","5px");
	});



	// Selectores de etiqueta
	var parrafos = $('p').css("cursor", "pointer");//le ponemos este estylo q cuando pasemos por ensima sea una manito

	parrafos.click(function(){
		var that = $(this);//$(this) este this se refiere a el elemento en donde se hizo click en este caso es elemento p

		if(!that.hasClass('grande')){//hasClass lo q hace es buscar si tiene la clase en este caso grande entonces si no la tiene entra al if
			that.addClass('grande');//le agrego la clase
		}else{
			that.removeClass('grande');//le quito la clase
		}
	});



	// Selectores de atributo
	$('[title="Google"]').css('background', '#ccc'); //$('[title="Google"]') seleccioname todos los elementos cuyo title se google
	$('[title="Facebook"]').css('background', 'blue');


// Otros
	$('p, a').addClass('margen-superior'); //$('p, a') a todos estos elementos le agrego esta clase .addClass('margen-superior')

	var busqueda = $("#elemento2").parent().parent().find('.resaltado');//parent() va para atras find me busca tal clase ..se usa mas q nada si hay un arbol grande y no la encuentro

	console.log(busqueda);
</script>



<div  style="color: rgb(252, 122, 96);">CODIGO HTML </div> <br>
< !DOCTYPE HTML><br>
< html lang="es"><br>
	< head><br>
		< meta charset="utf-8"><br>
		< title>Aprendiendo jQuery< /title><br>
	< script<br>
  src="https://code.jquery.com/jquery-3.5.1.min.js"<br>
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="<br>
  crossorigin="anonymous">< /script>--><br>
< script type="text/javascript" src="js/jquery-3.5.1.min.js"></>//cargo la libreria de jquery<br>
  < script type="text/javascript" src="js/01-selectores.js"></><br>

  < !--LE AGREGO UNOS ESTILOS A LAS CLASES--><br>
  < style><br>
			.zebra{<br>
				border: 5px dashed black;<br>
			}<br>

			.grande{<br>
				font-size: 30px;<br>
			}<br>

			.margen-superior{<br>
				display:block;<br>
				margin-top:45px;<br>
			}<br>

			.resaltado{<br>
				border-bottom: 2px solid green;<br>
			}<br>
		< /style><br>
  
< /head><br>
	< body><br>
		< h1>Aprendiendo jQuery con Víctor Robles WEB< /h1><br>

		< ul><br>
			< li>< a href="https://www.google.com" title="Google">Ir a Google< /a>< /li><br>
			< li>< a href="https://www.facebook.com" title="Facebook">Ir a Facebook< /a>< /li><br>
		< /ul><br>

		< p id="rojo" class="sin_borde">Ejercicios de jQuery< /p><br>
		< p id="amarillo" class="zebra">Practicando con selectores< /p><br>
		< p id="verde" class="sin_borde">Quiero ser un parrafo verde< /p><br>
		< p class="zebra">Soy un parrafo blanco< /p><br>

		
< div id="caja"><br>
			< p>Hola soy una caja< p><br>
			< ul><br>
				< li>Elemento 1< /li><br>
				< li id="elemento2">Elemento 2< /li><br>
			< /ul><br>
			< span class="resaltado">Soy un span< /span><br>
		< /div><br>

	< /body><br>
< /html><br>

<div  style="color: rgb(252, 122, 96);">CODIGO SCRIPT </div> <br>


'use strict'<br>
//ESTE EVENTO ES PARA QUE PUEDA PONER EL SCRIP Q CARGA TODO ESTO AL PRINCIPIO DEL BODY<br>
window.addEventListener('load', () =>{<br>



$(document).ready(function(){//$(document) el dolar me dice q voy a trabajar con jquery y (document) es el SELECTOR (hay mas selectores) carga toda la pagina script .ready metodo de jquery es un evento q tiene una funcion de kalbak<br>
console.log('esta todo listo'); <br>
});<br>



// Selector de ID<br>
var rojo =	$("#rojo").css("background","red") //$("#rojo") selecciono el id  .css("background","red") le cambio los estilos<br>
			  .css("color", "white");<br>

			  console.log(rojo); <br>

	 $("#amarillo").css("background","yellow")<br>
				  .css("color","green");<br>

	$("#verde").css("background","green")<br>
				  .css("color","white");<br>


// Selectores de clases<br>
	var mi_clase = $('.zebra').css("padding","5px");//le pongo estilos<br>

	$('.sin_borde').click(function(){ //$('.sin_borde') selecciono la clase .click evento click con funcion de kalbak<br>
		console.log("Click dado!!");<br>
		$(this).addClass('zebra'); //$(this) se refiere al elemento q yo le alla echo clik .addClass le agrego la clase en este caso ('zebra')<br>
		// y va tener todas sus propiedades tengo q hacer click claro-_- ojo solo agrega los estylos q puse por defecto en el html<br>
		//los nuevos no  estos no var mi_clase = $('.zebra').css("padding","5px");<br>
	});<br>



	// Selectores de etiqueta<br>
	var parrafos = $('p').css("cursor", "pointer");//le ponemos este estylo q cuando pasemos por ensima sea una manito<br>

	parrafos.click(function(){<br>
		var that = $(this);//$(this) este this se refiere a el elemento en donde se hizo click en este caso es elemento p<br>

		if(!that.hasClass('grande')){//hasClass lo q hace es buscar si tiene la clase en este caso grande entonces si no la tiene entra al if<br>
			that.addClass('grande');//le agrego la clase<br>
		}else{<br>
			that.removeClass('grande');//le quito la clase<br>
		}<br>
	});<br>



	// Selectores de atributo<br>
	$('[title="Google"]').css('background', '#ccc'); //$('[title="Google"]') seleccioname todos los elementos cuyo title se google<br>
	$('[title="Facebook"]').css('background', 'blue');<br>


// Otros<br>
	$('p, a').addClass('margen-superior'); //$('p, a') a todos estos elementos le agrego esta clase .addClass('margen-superior')<br>

	var busqueda = $("#elemento2").parent().parent().find('.resaltado');//parent() va para atras find me busca tal clase ..se usa mas q nada si hay un arbol grande y no la encuentro<br>

	console.log(busqueda);<br>

//fin de load<br>
});<br>

<br><br>

<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Aprendiendo jQuery</title>

<style>
			#caja2{
				width: 250px;
				height: 250px;
				border: 2px solid black;
				background: yellow;
				transition: 300ms all;
			}

			
			/*#caja:hover{
				background: red;
				cursor:pointer;
			}*/
			

			input{
				padding: 10px;
				width: 300px;
				font-size: 20px;
			}

			#datos2{
				border: 4px dashed black;
				padding: 10px;
				width: 250px;
				height: 50px;
				margin-top: 10px;
				display: none;
			}

/* hago de este div un redondel*/
			#sigueme2{
				width: 25px;
				height: 25px;
				position: absolute;
				display: block;
				background: yellow;
				opacity: 0.5;
				border: 3px solid black;
				border-radius: 999px;
			}

		</style>
	</head>
	<body>
		<h3>Aprendiendo jQuery con Adrian Lisciotti WEB - Eventos</h3>

		<div id="sigueme2"></div>

		<form>
			<input type="text" id="nombre2" />
		</form>
		<div id="datos2"></div>

		<br>

		<div id="caja2">
			Soy una caja
		</div>
    </body>
</html>
<br><br>


<script>
// MouseOver y MouseOut/
	/*var caja = $("#caja");//el id caja

	
	caja.mouseover(function(){//mouseover cuando toco con el mouse
		$(this).css("background","red");//$(this) hace referencia al elemento caja
	});

	caja.mouseout(function(){//cuando dejo de tocar con el mouse mouseout
		$(this).css("background","green");
	});*/
	

//LO MISMO PERO CODIGO MAS OPTIMO
var caja2 = $("#caja2");//el id caja
function cambiaRojo2(){
		$(this).css("background","red");
	}

	function cambiaVerde2(){
		$(this).css("background","green");
	}

	// Hover
	caja2.hover(cambiaRojo2, cambiaVerde2);//this hace referencia al elemento caja hover este evento hace q cuando toco con el mouse me muestra la primer funcion 
	//y cuando dejo de tocar la segunda funcionllamo a las funciones 





// Click, Doble click
//si hago click hace esto
	caja2.click(function(){
		$(this).css("background", "blue")
			   .css("color", "white");
	});
//si hago doble click hace esto
	caja2.dblclick(function(){//
		$(this).css("background", "pink")
			   .css("color", "yellow");
	});



// Focus y blur
	var nombre2 = $("#nombre2");
	var datos2 = $("#datos2");

	nombre2.focus(function(){//cuando me pongo en la caja
		$(this).css("border", "2px solid green");
	});

	nombre2.blur(function(){//para cuando salgo del fucus del input
		$(this).css("border", "1px solid #ccc");

		datos2.text($(this).val()).show();//datos.text un elemento typo text .val() saco el dato del input el value  show muestra el elemento $(this)
	});


// Mousedown y mouseup
	datos2.mousedown(function(){//mousedown cuando se este presionando el raton
		$(this).css("border-color", "gray");
	});

	datos2.mouseup(function(){//mouseup cuando dejo de apretar el raton
		$(this).css("border-color", "black");
	});

// Mousemove
	$(document).mousemove(function(){//evento movimiento del raton
		//$('body').css("cursor","none");//oculto el cursor el raton
		$("#sigueme2").css("left", event.clientX)//event.clientXme dice en que cordenadas estoy de el raton left en este caso el div va a segir horizontalmente
		             .css("top", event.clientY);//top vertical
	});
</script>



<div  style="color: rgb(252, 122, 96);">CODIGO HTML </div> <br>


< !DOCTYPE HTML><br>
< html lang="es"><br>
	< head><br>
		 < meta charset="utf-8"><br>
		< title>Aprendiendo jQuery< /title><br>

		< script type="text/javascript" src="js/jquery-3.5.1.min.js">< /script><!--cargo la libreria de jquery--><br>
		< script type="text/javascript" src="js/02-eventos.js">< /script><br>
		< style><br>
			#caja{<br>
				width: 250px;<br>
				height: 250px;<br>
				border: 2px solid black;<br>
				background: yellow;<br>
				transition: 300ms all;<br>
			}<br>

			
			/*#caja:hover{<br>
				background: red;<br>
				cursor:pointer;<br>
			}*/<br>
			

			input{<br>
				padding: 10px;<br>
				width: 300px;<br>
				font-size: 20px;<br>
			}<br>

			#datos{<br>
				border: 4px dashed black;<br>
				padding: 10px;<br>
				width: 250px;<br>
				height: 50px;<br>
				margin-top: 10px;<br>
				display: none;<br>
			}<br>

/* hago de este div un redondel*/<br>
			#sigueme{<br>
				width: 25px;<br>
				height: 25px;<br>
				position: absolute;<br>
				display: block;<br>
				background: yellow;<br>
				opacity: 0.5;<br>
				border: 3px solid black;<br>
				border-radius: 999px;<br>
			}<br>

		< /style><br>
	< /head><br>
	< body><br>
		< h1>Aprendiendo jQuery con Víctor Robles WEB - Eventos< /h1><br>

		< div id="sigueme">< /div><br>

		< form><br>
			< input type="text" id="nombre" /><br>
		< /form><br>
		< div id="datos"></><br>

		< br><br>

		< div id="caja"><br>
			Soy una caja<br>
		< /div><br>



	< /body><br>
< /html><br>


<div  style="color: rgb(252, 122, 96);">CODIGO SCRIPT </div> <br>

$(document).ready(function(){<br>

// MouseOver y MouseOut/<br>
/*var caja = $("#caja");//el id caja<br>


caja.mouseover(function(){//mouseover cuando toco con el mouse<br>
  $(this).css("background","red");//$(this) hace referencia al elemento caja<br>
});<br>

caja.mouseout(function(){//cuando dejo de tocar con el mouse mouseout<br>
  $(this).css("background","green");<br>
});*/<br>


//LO MISMO PERO CODIGO MAS OPTIMO<br>
var caja = $("#caja");//el id caja<br>
function cambiaRojo(){<br>
  $(this).css("background","red");<br>
}<br>

function cambiaVerde(){<br>
  $(this).css("background","green");<br>
}<br>

// Hover<br>
caja.hover(cambiaRojo, cambiaVerde);//this hace referencia al elemento caja hover este evento hace q cuando toco con el mouse me muestra la primer funcion <br>
//y cuando dejo de tocar la segunda funcionllamo a las funciones <br>





// Click, Doble click<br>
//si hago click hace esto<br>
caja.click(function(){<br>
  $(this).css("background", "blue")<br>
       .css("color", "white");<br>
});<br>
//si hago doble click hace esto<br>
caja.dblclick(function(){//<br>
  $(this).css("background", "pink")<br>
       .css("color", "yellow");<br>
});<br>



// Focus y blur<br>
var nombre = $("#nombre");<br>
var datos = $("#datos");<br>

nombre.focus(function(){//cuando me pongo en la caja<br>
  $(this).css("border", "2px solid green");<br>
});<br>

nombre.blur(function(){//para cuando salgo del fucus del input<br>
  $(this).css("border", "1px solid #ccc");<br>

  datos.text($(this).val()).show();//datos.text un elemento typo text .val() saco el dato del input el value  show muestra el elemento $(this)<br>
});<br>


// Mousedown y mouseup<br>
datos.mousedown(function(){//mousedown cuando se este presionando el raton<br>
  $(this).css("border-color", "gray");<br>
});<br>

datos.mouseup(function(){//mouseup cuando dejo de apretar el raton<br>
  $(this).css("border-color", "black");<br>
});<br>

// Mousemove<br>
$(document).mousemove(function(){//evento movimiento del raton<br>
  $('body').css("cursor","none");//oculto el cursor el raton<br>
  $("#sigueme").css("left", event.clientX)//event.clientXme dice en que cordenadas estoy de el raton left en este caso el div va a segir horizontalmente<br>
               .css("top", event.clientY);//top vertical<br>
});<br>

});<br>




		<title>Aprendiendo jQuery</title>

		
	</head>
	<body>
		<h4>Aprendiendo jQuery con Adrian Lisciotti WEB - Más metodos / Textos</h4>

		<h5>Añadir nuevos enlaces</h5>
		<input type="texto" id="add_link" /> <button id="add_button" disabled="disabled">Añadir</button>
		<ul id="menu3">
			<li><a  href="https://google.es"></a></li>
			<li><a href="https://facebook.com"></a></li>
			<li><a href="https://twitter.com"></a></li>
		  <li><a href="https://victorroblesweb.es"></a></li>
		</ul>

	</body>


<script>

$(document).ready(function(){//ready es un evento q tiene una funcion de kalback


reloadLinks();//llamo la funcion para tener los enlaces por defecto q agrege en el html

$('#add_button')//selecciono este id
  .removeAttr('disabled')//removeAttr borro el atributo q en este caso esta en el boton ...disabled es el atributo a borrar
  .click(function(){//en el evento click o sea cuando toco el boton
    $('#menu3').prepend('<li><a href="'+$("#add_link").val()+'"></a></li>');//selecciono el id menu y prepend añade al principio en el menu y con 
    //$("#add_link").val() seleciono el id del input y el value q esta en el input
//PREPEND lo mete al principio APPEND al final BEFORE antes y fuera de la lista 
    $("#add_link").val('');//#add_link selecciono el id del input y .val('') lo pongo en vacio 
    reloadLinks();//llamo la funcion para volver a cargar los enlaces junto con el q agrego con el input
  });

});

function reloadLinks(){
$('#menu3 li a').each(function(index){//$('a') selecciono el elemento 'a' each es un bucle con funcion de kalback y index parametro q tiene el indice en este caso voy a recorrer el elemento a
  var that = $(this);//guardo this en la variable (this se refiere al elemento en cuestion)
  var enlace = that.attr("href");//attr para poder seleccionar el href lo q hay ahi

  that.attr('target','_blank');//attr('target','_blank') le estoy creando un atributo y su valor that. a la etiqueta 'a' q sirve para q cuando le de click al enlace me lo abra en pestaña nueva

  that.text(enlace);//funcion text que es para meter el enlace como texto incrusto el enlace en that q es el elemento a
});
}

</script>

<div  style="color: rgb(252, 122, 96);">CODIGO HTML </div> <br>

< title>Aprendiendo jQuery< /title><br>

		
	< /head><br>
	< body><br>
		< h4>Aprendiendo jQuery con Adrian Lisciotti WEB - Más metodos / Textos< /h4><br>

		< h5>Añadir nuevos enlaces< /h5><br>
		< input type="texto" id="add_link" /> < button id="add_button" disabled="disabled">Añadir< /button><br>
		< ul id="menu3"><br>
			< li>< a  href="https://google.es">< /a>< /li><br>
			< li>< a href="https://facebook.com">< /a>< /li><br>
			< li>< a href="https://twitter.com">< /a>< /li><br>
		  < li>< a href="https://victorroblesweb.es">< /a>< /li><br>
		< /ul><br>

	</><br>



<div  style="color: rgb(252, 122, 96);">CODIGO SCRIPT </div> <br>

< script> <br>

$(document).ready(function(){//ready es un evento q tiene una funcion de kalback<br>


reloadLinks();//llamo la funcion para tener los enlaces por defecto q agrege en el html<br>

$('#add_button')//selecciono este id<br>
  .removeAttr('disabled')//removeAttr borro el atributo q en este caso esta en el boton ...disabled es el atributo a borrar<br>
  .click(function(){//en el evento click o sea cuando toco el boton<br>
    $('#menu3').prepend('<li><a href="'+$("#add_link").val()+'"></a></li>');//selecciono el id menu y prepend añade al principio en el menu y con<br> 
    //$("#add_link").val() seleciono el id del input y el value q esta en el input<br>
//PREPEND lo mete al principio APPEND al final BEFORE antes y fuera de la lista <br>
    $("#add_link").val('');//#add_link selecciono el id del input y .val('') lo pongo en vacio <br>
    reloadLinks();//llamo la funcion para volver a cargar los enlaces junto con el q agrego con el input<br>
  });<br>

});<br>

function reloadLinks(){<br>
$('#menu3 li a').each(function(index){//$('a') selecciono el elemento 'a' each es un bucle con funcion de kalback y index parametro q tiene el indice en este caso voy a recorrer el elemento a<br>
  var that = $(this);//guardo this en la variable (this se refiere al elemento en cuestion)<br>
  var enlace = that.attr("href");//attr para poder seleccionar el href lo q hay ahi<br>

  that.attr('target','_blank');//attr('target','_blank') le estoy creando un atributo y su valor that. a la etiqueta 'a' q sirve para q cuando le de click al enlace me lo abra en pestaña nueva<br>

  that.text(enlace);//funcion text que es para meter el enlace como texto incrusto el enlace en that q es el elemento a<br>
});<br>
}<br>

< /script><br>




<div  style="color: rgb(252, 122, 96);">EfectoS </div>


<br><br>
	
		<h3>Aprendiendo jQuery con adrianweb.live - Efectos</h3>

		<br><br>
		<button id="mostrar">
			Mostrar
		</button>
		<button id="ocultar">
			Ocultar
		</button>
		

		<button id="todoenuno">
			Abrir
		</button>

		<button id="animar">
			Animame!!
		</button>
    <br><br>
		

    <div id="caja">
			Master en JavaScript
		</div>

<br><br>









<script>
  

$(document).ready(function() {
    var caja = $("#caja");

    $("#mostrar").hide(); //hide este meodo oculta

    $("#mostrar").click(function() { //en el evento click del boton mostrar
        $(this).hide(); //hide oculta el boton
        $("#ocultar").show(); //show muestro ..puedo poner show('fast') q da una velocidad de recogido o show('normal')

        caja.slideDown('slow'); //slideDown va en el boton de mostrar oculta y desoculta la caja con un efecto de arriba abajo 
        //fadeIn('slow')fadeIn este metodo se usa para el boton de mostrar hace un efecto de fundido y 'slow' para q sea un toqe mas lento y agradable
        //fadeOut('slow')fadeOut este metodo Se usa para el boton de ocultar hace un efecto de fundido y 'slow' para q sea un toqe mas lento y agradable
        //fadeTo('slow', 0.8) este en el boton de mostrar juego con la opasidad como q lo deja medio transparente
        //fadeTo('slow', 0.2) este en el boton de ocultar
    });

    $("#ocultar").click(function() { //en el evento click del boton ocultar
        $(this).hide(); //lo escondo al boton
        $("#mostrar").show(); //lo muestro

        caja.slideUp('slow', function() { //slideUp va en el boton de ocultar oculta y desoculta la caja con un efecto de ABAJO ARRIBA
            console.log("Cartel ocultado"); //esto lo pongo en una funcion de kalback para q lo muestre resien despues de ocultar la caja
        });

    });

    $("#todoenuno").click(function() {
        caja.slideToggle('fast'); //slideToggle esta funcion hace aparece y desaparece la caja en este caso es como tener las dos funciones en una
        //tambien esta el Toggle ,fadeToggle q tienen otros efectos
    });

    $("#animar").click(function() { //cuando hago el click en el boton animame
        caja.animate({ //animate este metodo me permite hacer animaciones a nivel de css LAS {} SON PORQE ESTO VA A ESTAR EN UN JSON
                marginLeft: '500px', //le doy un margen a la izquierda entoces la caja se mueve hacia la derecha 
                fontSize: '40px', //le aumenta el tamaño de la letra
                height: '110px' //le doy altura
            }, 'slow') //'slow' para q sea un toqe mas lento y agradable
            .animate({
                borderRadius: '900px', //lo redondeo a la caja
                marginTop: '80px' //le da un margen arriba para q baje la caja
            }, 'slow')
            .animate({
                borderRadius: '0px', //le quito el borde redondeado
                marginLeft: '0px' //y el margen para q regrese
            }, 'slow')
            .animate({
                borderRadius: '100px',
                marginTop: '0px'
            }, 'slow')
            .animate({
                marginLeft: '500px',
                fontSize: '40px',
                height: '110px'
            }, 'slow');
    });

});



</script>


<div  style="color: rgb(252, 122, 96);">CODIGO HTML </div> <br>

< h3>Aprendiendo jQuery con adrianweb.live - Efectos</>

< br>< br>
< button id="mostrar">
  Mostrar
< /button>
< button id="ocultar">
  Ocultar
< /button>


< button id="todoenuno">
  Abrir
< /button>

< button id="animar">
  Animame!!
< /button>
< br>< br>


< div id="caja">
  Master en JavaScript
< /div>

<div  style="color: rgb(252, 122, 96);">CODIGO SCRIPT </div> <br>

< script><br>
  

$(document).ready(function() {<br>
    var caja = $("#caja");<br>

    $("#mostrar").hide(); //hide este meodo oculta<br>

    $("#mostrar").click(function() { //en el evento click del boton mostrar<br>
        $(this).hide(); //hide oculta el boton<br>
        $("#ocultar").show(); //show muestro ..puedo poner show('fast') q da una velocidad de recogido o show('normal')<br>

        caja.slideDown('slow'); //slideDown va en el boton de mostrar oculta y desoculta la caja con un efecto de arriba abajo <br>
        //fadeIn('slow')fadeIn este metodo se usa para el boton de mostrar hace un efecto de fundido y 'slow' para q sea un toqe mas lento y agradable<br>
        //fadeOut('slow')fadeOut este metodo Se usa para el boton de ocultar hace un efecto de fundido y 'slow' para q sea un toqe mas lento y agradable<br>
        //fadeTo('slow', 0.8) este en el boton de mostrar juego con la opasidad como q lo deja medio transparente<br>
        //fadeTo('slow', 0.2) este en el boton de ocultar<br>
    });<br>

    $("#ocultar").click(function() { //en el evento click del boton ocultar<br>
        $(this).hide(); //lo escondo al boton<br>
        $("#mostrar").show(); //lo muestro<br>

        caja.slideUp('slow', function() { //slideUp va en el boton de ocultar oculta y desoculta la caja con un efecto de ABAJO ARRIBA<br>
            console.log("Cartel ocultado"); //esto lo pongo en una funcion de kalback para q lo muestre resien despues de ocultar la caja<br>
        });<br>

    });<br>

    $("#todoenuno").click(function() {<br>
        caja.slideToggle('fast'); //slideToggle esta funcion hace aparece y desaparece la caja en este caso es como tener las dos funciones en una<br>
        //tambien esta el Toggle ,fadeToggle q tienen otros efectos<br>
    });

    $("#animar").click(function() { //cuando hago el click en el boton animame<br>
        caja.animate({ //animate este metodo me permite hacer animaciones a nivel de css LAS {} SON PORQE ESTO VA A ESTAR EN UN JSON<br>
                marginLeft: '500px', //le doy un margen a la izquierda entoces la caja se mueve hacia la derecha <br>
                fontSize: '40px', //le aumenta el tamaño de la letra<br>
                height: '110px' //le doy altura<br>
            }, 'slow') //'slow' para q sea un toqe mas lento y agradable<br>
            .animate({<br>
                borderRadius: '900px', //lo redondeo a la caja<br>
                marginTop: '80px' //le da un margen arriba para q baje la caja<br>
            }, 'slow')<br>
            .animate({<br>
                borderRadius: '0px', //le quito el borde redondeado<br>
                marginLeft: '0px' //y el margen para q regrese<br>
            }, 'slow')<br>
            .animate({<br>
                borderRadius: '100px',<br>
                marginTop: '0px'<br>
            }, 'slow')<br>
            .animate({<br>
                marginLeft: '500px',<br>
                fontSize: '40px',<br>
                height: '110px'<br>
            }, 'slow');<br>
    });<br>

});<br>



< /script><br>

<div  style="color: rgb(252, 122, 96);">Ajax </div>

<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Aprendiendo jQuery</title>
    <!--cargo la libreria de jquery-->
    <script type="text/javascript" src="js/05-ajax.js"></script>
    <style>
        #datos5 {
            border: 2px solid green;
            width: 250;
            height: 250;
            overflow: scroll;
        }
    </style>
</head>

<body>
    <h5>Aprendiendo jQuery con adrianweb.live - AJAX</h5>

    <form action="https://reqres.in/api/users" method="POST" id="formulario5"><br>
        Nombre: <input type="text" name="name"/> Web: <input type="text" name="web" /><br>
        <input type="submit" value="Registrar" /><br>
    </form>

    <br/>

    <div id="datos5"></div>

    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <!--cargo la libreria de jquery-->
    <script type="text/javascript" src="js/05-ajax.js"></script>
</body>

</html>



<script>

$(document).ready(function() {

// Load
// $("#datos").load("https://reqres.in/");//load esto es una peticion ajax q hace q se meta toda la pagina en este div...(se mete solo el html)

// Get y Post

	


$.get("https://reqres.in/api/users", { page: 2 }, function(response) { //$.get es una peticion ajax y la pagina viene por get ,{page: 2} asi se ponen los parametros y {} porqe es un json
    //response es el parametro de la funcion kalback en el se guardan los datos del enlace
    response.data.forEach((element, index) => { //response.data. es donde estan los usuarios hago el foreach
        $("#datos5").append("<p>" + element.first_name + " " + element.last_name + "</p>"); //append guardo el nombre y apellido en el div datos
    });
});


//post

$("#formulario5").submit(function(e) { //#formulario selecciono el formulario .submit es el evento y le meto al parametro e el evento ..o sea capturo el evento
    e.preventDefault(); //preventDefault hace q no me redirija a la pagina de action q tiene el formulario

    var usuario = {
        name: $('input[name="name"]').val(), //recojo el input 
        web: $('input[name="web"]').val()
    };


    /*$.post($(this).attr("action"), usuario, function(response){//$.post peticion ajax ..this hace referencia a esto .attr("action") q attr me permite elegir atributos es la accion del formulario o sea el enlace 
      //usuario es el parametro q tiene los datos de la variable usuario donde se colocan en response el parametro del kalback
      console.log(response);
    }).done(function(){//.done Capturar cuando la petición a tenido éxito y ha terminado
      alert("Usuario añadido correctamente");
    });*/

    //ESTA ES LA MEJOR FORMA 

    $.ajax({ //$.ajax metodo para usar ajax {} porqe es un json
        type: 'POST', //el tipo de peticion q voy a hacer
        url: $(this).attr("action"), //le indico la url q voy a enviar
        data: usuario, //los datos q voy a enviar
        beforeSend: function() { //beforeSend este metodo hace q antes de q se envien los datos etc.. haga una accion
            console.log("Enviando usuario...");
        },
        success: function(response) { //success en el caso de q todo vaya correcto
            console.log(response);
            
        },
        error: function() { //error si hay algun error
            console.log("A ocurrido un error");
        },
        timeout: 1000 //los segundos q quiero q tarde
    });

    return false; //para q tampoco me redirija para q no haga la accion por defecto de redirigirme al action cuando clickeo el submit


});

});
</script>


<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

  <div  style="color: rgb(252, 122, 96);">CODIGO DEL HTML </div>
  < !DOCTYPE HTML><br>
< html lang="es"><br>

< head><br>
    < meta charset="utf-8"><br>
    < title>Aprendiendo jQuery< /title><br>
    <!--cargo la libreria de jquery-->
    < script type="text/javascript" src="js/05-ajax.js">< /script><br>
    < style><br>
        #datos5 {<br>
            border: 2px solid green;<br>
            width: 100px;<br>
            height: 100px;<br>
            overflow: scroll;<br>
        }<br>
    < /style><br>
</ head><br>

< body><br>
    < h5>Aprendiendo jQuery con adrianweb.live - AJAX< /h5><br>

    < form action="https://reqres.in/api/users" method="POST" id="formulario5"><br>
        Nombre: < input type="text" name="name" /> Web: < input type="text" name="web" /><br>
        < input type="submit" value="Registrar" />< br><br>
    < /form><br>

    < br/><br>

    < div id="datos5">< /div><br>

    < script type="text/javascript" src="js/jquery-3.5.1.min.js">< /script><br>
    <!--cargo la libreria de jquery--><br>
    < script type="text/javascript" src="js/05-ajax.js">< /script><br>
< /body><br>

< /html><br>
  <div  style="color: rgb(252, 122, 96);">CODIGO DEL SCRIPT </div>

  < script><br>

$(document).ready(function() { <br>

// Load<br>
// $("#datos").load("https://reqres.in/");//load esto es una peticion ajax q hace q se meta toda la pagina en este div...(se mete solo el html)<br>

// Get y Post<br>

	


$.get("https://reqres.in/api/users", { page: 2 }, function(response) { //$.get es una peticion ajax y la pagina viene por get ,{page: 2} asi se ponen los parametros y {} porqe es un json<br>
    //response es el parametro de la funcion kalback en el se guardan los datos del enlace<br>
    response.data.forEach((element, index) => { //response.data. es donde estan los usuarios hago el foreach<br>
        $("#datos5").append("<p>" + element.first_name + " " + element.last_name + "</p>"); //append guardo el nombre y apellido en el div datos<br>
    });<br>
});<br>


//post<br>

$("#formulario5").submit(function(e) { //#formulario selecciono el formulario .submit es el evento y le meto al parametro e el evento ..o sea capturo el evento<br>
    e.preventDefault(); //preventDefault hace q no me redirija a la pagina de action q tiene el formulario<br>

    var usuario = {<br>
        name: $('input[name="name"]').val(), //recojo el input <br>
        web: $('input[name="web"]').val()<br>
    };<br>


    /*$.post($(this).attr("action"), usuario, function(response){//$.post peticion ajax ..this hace referencia a esto .attr("action") q attr me permite elegir atributos es la accion del formulario o sea el enlace <br>
      //usuario es el parametro q tiene los datos de la variable usuario donde se colocan en response el parametro del kalback<br>
      console.log(response);<br>
    }).done(function(){//.done Capturar cuando la petición a tenido éxito y ha terminado<br>
      alert("Usuario añadido correctamente");<br>
    });*/<br>

    //ESTA ES LA MEJOR FORMA <br>

    $.ajax({ //$.ajax metodo para usar ajax {} porqe es un json<br>
        type: 'POST', //el tipo de peticion q voy a hacer<br>
        url: $(this).attr("action"), //le indico la url q voy a enviar<br>
        data: usuario, //los datos q voy a enviar<br>
        beforeSend: function() { //beforeSend este metodo hace q antes de q se envien los datos etc.. haga una accion<br>
            console.log("Enviando usuario...");<br>
        },<br>
        success: function(response) { //success en el caso de q todo vaya correcto<br>
            console.log(response);<br>
            
        },<br>
        error: function() { //error si hay algun error<br>
            console.log("A ocurrido un error");<br>
        },<br>
        timeout: 1000 //los segundos q quiero q tarde<br>
    });<br>

    return false; //para q tampoco me redirija para q no haga la accion por defecto de redirigirme al action cuando clickeo el submit<br>


});<br>

});<br>
< /script><br>





  <!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Aprendiendo jQuery-ui</title>

		
		

		

		
		<style>
			.elemento6{
				width: 300px;
				height: 200px;
				border: 4px solid black;
				background: lightblue;
				margin: 20px;
				float:left;
			}

.lista-seleccionable li{
				width: 80%;
				padding: 20px;
				border: 1px solid #ccc;
				list-style: none;/*le quita los puntitos q vienen por defecto*/
				cursor:pointer;
			}

			ul .ui-selecting {background: black;}/*esto es propio de la libreria ui para q cambie el color los elementos de la lista*/
			ul .ui-selected {background: #ccc;}

			#elemento-movido6{
				width: 100px;
				height: 100px;
				border: 4px solid red;
			}

			#area{
				width: 300px;
				height: 300px;
				border: 4px solid green;
			}

			.elemento6{	
				background: pink;
				float: none;
				display: none;
			}

		

		</style>
	<body>
		<h5>Aprendiendo jQuery - adrianweb.live - jQuery UI</h5>

		<hr/>
		<h3>Tooltip</h3>

	
		
		<a href="#" class="too" title="Acceder a la seccion de mis datos de esta web">Mis datos</a>
		<a href="#" class="too" title="Logueate en esta web">Identificarse</a>
		<a href="#" class="too" title="Ver todos mis amigos">Amigos</a>
		

		<hr/>

		<h3>Cuadros de dialogo</h3>
		<button id="lanzar-popup">Lanzame</button>
		<div id="popup" title="¿Estas seguro?" style="display:none"><!--display:none para q no se muestre q este oculto-->
			<p>
				Si continuas en el curso aprenderas mucho de javascript inevitablemente
			</p>
		</div>


		<hr/>


		<h3>Calendario</h3>
		<input type="text" id="calendario" />


		<hr/>

		<h3>Pestañas</h3>
		<div id="pestanas">
			<ul>
				<li><a href="#tabs-1">Pestaña 1</a></li><!--#tabs-1 este nombre hace referencia a los div de abajo-->
				<li><a href="#tabs-2">Pestaña 2</a></li>
				<li><a href="#tabs-3">Pestaña 3</a></li>
			</ul>
			<div id="tabs-1">
				Hola soy la primera pestaña
			</div>
			<div id="tabs-2">
				Hola soy la segunda pestaña
			</div>
			<div id="tabs-3">
				Hola soy la TERCERA pestaña
			</div>
		</div>

		<hr/>

		<button id="mostrar6">Mostrar</button>


<div class="caja-efectos elemento6">
		</div>

		<div id="elemento-movido6"></div>
		<br>
		<div id="area">
		</div>


		<ul class="lista-seleccionable">
			<li>GTA 5</li>
			<li>Need For Speed</li>
			<li>Crash Bandicoot</li>
			<li>Super Mario</li>
			<li>Galaxian</li>
		</ul>

		<div class="elemento6">
			Hola, soy un elemento de la web 1
		</div>

		<div class="elemento6">
			Hola, soy un elemento de la web 2
		</div>

		<div class="elemento6">
			Hola, soy un elemento de la web 3
		</div>
	</body>
</html>

<script>

$(document).ready(function(){

// Mover elemento por la pagina
$(".elemento6").draggable();//draggable CON ESTE metodo muevo este elemento

// Redimensionar
$(".elemento6").resizable();//resizable redimensiona o sea agranda y achica el elemento


// Seleccionar y ordenar elementos
//$(".lista-seleccionable").selectable();//selectable este metodo cambia de locor cuando haces click a un elemento de la lista
//$(".lista-seleccionable").sortable();//sortable me permite seleccionar los elementos y arrastrarlos cambiandolos
$(".lista-seleccionable").sortable({//puedo con una funcion de kalback hacer esto
	update: function(event, ui){
		console.log("ha cambiado la lista");
		
	}



});




// Drop
$("#elemento-movido6").draggable();//draggable va ser el elemento q se puede mover para q pueda poner encima del otro elemento 
$("#area").droppable({//droppable es para el elemento q no se va a mover donde se suelta el otro elemento
	drop: function(){//drop detecta cuando un elemento se solto ahi
		console.log("Has soltado algo dentro de el area");
	}
});





// Efectos hay mas en la documntacion
$("#mostrar6").click(function(){
	//$(".caja-efectos").toggle("fade");//toggle metodo para lanzar efectos ("fade") el tipo de efecto como q aparece rapido
	//$(".caja-efectos").toggle("fadeToggle");//aparece mas suave  
	//$(".caja-efectos").toggle("explode");//es como q se desrma y se arma
	//$(".caja-efectos").effect("explode");//como q se desarma
	//$(".caja-efectos").toggle("blind");//sale y se guarda por debajo
	//$(".caja-efectos").toggle("slide");//como q sale del costado izquierdo 
	//$(".caja-efectos").toggle("drop");//como q sale por el costado de derecha a izquierda
	//$(".caja-efectos").toggle("fold");
	//$(".caja-efectos").toggle("puff");
	//$(".caja-efectos").toggle("scale");//se va abriendo
	//$(".caja-efectos").toggle("shake");//mueve lo hace temblar
	$(".caja-efectos").toggle("shake", 4000);//4000 velocidad puedo ponerle slow de velocidad y otras velocidades y con numero como lo esta 
	
});



// Tooltip por internet hay mas
//$(document).tooltip();//cuando paso el mouse por un enlace o lo q tenga un title abre un cuadro y muestra lo q dice en el title
$(".too").tooltip();

// Dialog
$("#lanzar-popup").click(function(){//cuando toco el boton lanza el evento click con tal funcion de kalback
	$("#popup").dialog();//dialog este metodo me tira una ventana con lo q dice tal div y saca el display none para q se vea
})



// Datepicker por internet ay mas
$("#calendario").datepicker();//este metodo me muestra un calendario


// Tabs
$("#pestanas").tabs();//al tener en el html los li y sus href con determinados nombres de una lista tabs este metodo me muestra un cuadro 
//q me muestra los li q cuando lo toco me muestra 
//contenido de un div con id del mismo nombre




});






// Redimensionar
/*$(".elemento").resizable();

// Seleccionar y ordenar elementos
//$(".lista-seleccionable").selectable();
$(".lista-seleccionable").sortable({
	update: function(event, ui){
		console.log("ha cambiado la lista");
	}
});

// Drop
$("#elemento-movido").draggable();
$("#area").droppable({
	drop: function(){
		console.log("Has soltado algo dentro de el area");
	}
});

// Efectos
$("#mostrar").click(function(){
	$(".caja-efectos").toggle("shake", 4000);
});

// Tooltip
$(document).tooltip();

// Dialog
$("#lanzar-popup").click(function(){
	$("#popup").dialog();
})

// Datepicker
$("#calendario").datepicker();

// Tabs
$("#pestanas").tabs();*/

</script>

<div  style="color: rgb(252, 122, 96);">CODIGO DEL HTML </div>
< !DOCTYPE HTML><br>
< html lang="es"><br>
	< head><br>
		< meta charset="utf-8"><br>
		< title>Aprendiendo jQuery-ui< /title><br>

		
		

		

		
		< style><br>
			.elemento6{<br>
				width: 300px;<br>
				height: 200px;<br>
				border: 4px solid black;<br>
				background: lightblue;<br>
				margin: 20px;<br>
				float:left;<br>
			}<br>

.lista-seleccionable li{<br>
				width: 80%;<br>
				padding: 20px;<br>
				border: 1px solid #ccc;<br>
				list-style: none;/*le quita los puntitos q vienen por defecto*/<br>
				cursor:pointer;<br>
			}<br>

			ul .ui-selecting {background: black;}/*esto es propio de la libreria ui para q cambie el color los elementos de la lista*/<br>
			ul .ui-selected {background: #ccc;}<br>

			#elemento-movido6{<br>
				width: 100px;<br>
				height: 100px;<br>
				border: 4px solid red;<br>
			}<br>

			#area{<br>
				width: 300px;<br>
				height: 300px;<br>
				border: 4px solid green;<br>
			}<br>

			.elemento6{	<br>
				background: pink;<br>
				float: none;<br>
				display: none;<br>
			}<br>

		

		< /style><br>
	< body><br>
		< h5>Aprendiendo jQuery - adrianweb.live - jQuery UI< /h5><br>

		< hr/><br>
		< h3>Tooltip< /h3><br>

	
		
		< a href="#" class="too" title="Acceder a la seccion de mis datos de esta web">Mis datos< /a><br>
		< a href="#" class="too" title="Logueate en esta web">Identificarse< /a><br>
		< a href="#" class="too" title="Ver todos mis amigos">Amigos< /a><br>
		

		< hr/><br>

		< h3>Cuadros de dialogo< /h3><br>
		< button id="lanzar-popup">Lanzame< /button><br>
		< div id="popup" title="¿Estas seguro?" style="display:none"><!--display:none para q no se muestre q este oculto--><br>
			< p><br>
				Si continuas en el curso aprenderas mucho de javascript inevitablemente<br>
			< /p><br>
		< /div><br>


		< hr/><br>


		< h3>Calendario< /h3><br>
		< input type="text" id="calendario" /><br>


		< hr/><br>

		< h3>Pestañas< /h3><br>
		< div id="pestanas"><br>
			< ul><br>
				< li>< a href="#tabs-1">Pestaña 1< /a>< /li><!--#tabs-1 este nombre hace referencia a los div de abajo--><br>
				< li>< a href="#tabs-2">Pestaña 2< /a>< /li><br>
				< li>< a href="#tabs-3">Pestaña 3< /a>< /li><br>
			< /ul><br>
			< div id="tabs-1"><br>
				Hola soy la primera pestaña<br>
			< /div><br>
			< div id="tabs-2"><br>
				Hola soy la segunda pestaña<br>
			< /div><br>
			< div id="tabs-3"><br>
				Hola soy la TERCERA pestaña<br>
			< /div><br>
		< /div><br>

		< hr/><br>

		< button id="mostrar6">Mostrar< /button><br>


< div class="caja-efectos elemento6"><br>
		< /div><br>

		< div id="elemento-movido6">< /div><br>
		< br><br>
		< div id="area"><br>
		< /div><br>


		< ul class="lista-seleccionable"><br>
			< li>GTA 5< /li><br>
		    < li>Need For Speed< /li><br>
			< li>Crash Bandicoot< /li><br>
			< li>Super Mario< /li><br>
			< li>Galaxian< /li><br>
		< /ul><br>

		< div class="elemento6"><br>
			Hola, soy un elemento de la web 1<br>
		< /div><br>

		< div class="elemento6"><br>
			Hola, soy un elemento de la web 2<br>
		< /div><br>

		< div class="elemento6"><br>
			Hola, soy un elemento de la web 3<br>
		< /div><br>
	< /body><br>
< /html><br>

<div  style="color: rgb(252, 122, 96);">CODIGO DEL SCRIPT </div>

< script><br>

$(document).ready(function(){<br>

// Mover elemento por la pagina<br>
$(".elemento6").draggable();//draggable CON ESTE metodo muevo este elemento<br>

// Redimensionar<br>
$(".elemento6").resizable();//resizable redimensiona o sea agranda y achica el elemento<br>


// Seleccionar y ordenar elementos<br>
//$(".lista-seleccionable").selectable();//selectable este metodo cambia de locor cuando haces click a un elemento de la lista<br>
//$(".lista-seleccionable").sortable();//sortable me permite seleccionar los elementos y arrastrarlos cambiandolos<br>
$(".lista-seleccionable").sortable({//puedo con una funcion de kalback hacer esto<br>
	update: function(event, ui){<br>
		console.log("ha cambiado la lista");<br>
		
	}<br>



});<br>




// Drop<br>
$("#elemento-movido6").draggable();//draggable va ser el elemento q se puede mover para q pueda poner encima del otro elemento <br>
$("#area").droppable({//droppable es para el elemento q no se va a mover donde se suelta el otro elemento<br>
	drop: function(){//drop detecta cuando un elemento se solto ahi<br>
		console.log("Has soltado algo dentro de el area");<br>
	}<br>
});<br>





// Efectos hay mas en la documntacion<br>
$("#mostrar6").click(function(){<br>
	//$(".caja-efectos").toggle("fade");//toggle metodo para lanzar efectos ("fade") el tipo de efecto como q aparece rapido<br>
	//$(".caja-efectos").toggle("fadeToggle");//aparece mas suave  <br>
	//$(".caja-efectos").toggle("explode");//es como q se desrma y se arma<br>
	//$(".caja-efectos").effect("explode");//como q se desarma<br>
	//$(".caja-efectos").toggle("blind");//sale y se guarda por debajo<br>
	//$(".caja-efectos").toggle("slide");//como q sale del costado izquierdo <br>
	//$(".caja-efectos").toggle("drop");//como q sale por el costado de derecha a izquierda<br>
	//$(".caja-efectos").toggle("fold");<br>
	//$(".caja-efectos").toggle("puff");<br>
	//$(".caja-efectos").toggle("scale");//se va abriendo<br>
	//$(".caja-efectos").toggle("shake");//mueve lo hace temblar<br>
	$(".caja-efectos").toggle("shake", 4000);//4000 velocidad puedo ponerle slow de velocidad y otras velocidades y con numero como lo esta <br>
	
});<br>



// Tooltip por internet hay mas<br>
//$(document).tooltip();//cuando paso el mouse por un enlace o lo q tenga un title abre un cuadro y muestra lo q dice en el title
$(".too").tooltip();<br>

// Dialog<br>
$("#lanzar-popup").click(function(){//cuando toco el boton lanza el evento click con tal funcion de kalback<br>
	$("#popup").dialog();//dialog este metodo me tira una ventana con lo q dice tal div y saca el display none para q se vea<br>
})<br>



// Datepicker por internet ay mas<br>
$("#calendario").datepicker();//este metodo me muestra un calendario<br>

<br>
// Tabs<br>
$("#pestanas").tabs();//al tener en el html los li y sus href con determinados nombres de una lista tabs este metodo me muestra un cuadro <br>
//q me muestra los li q cuando lo toco me muestra <br>
//contenido de un div con id del mismo nombre<br>




});<br>






// Redimensionar<br>
/*$(".elemento").resizable();<br>

// Seleccionar y ordenar elementos<br>
//$(".lista-seleccionable").selectable();<br>
$(".lista-seleccionable").sortable({<br>
	update: function(event, ui){<br>
		console.log("ha cambiado la lista");<br>
	}<br>
});<br>

// Drop<br>
$("#elemento-movido").draggable();<br>
$("#area").droppable({<br>
	drop: function(){<br>
		console.log("Has soltado algo dentro de el area");<br>
	}<br>
});<br>

// Efectos<br>
$("#mostrar").click(function(){<br>
	$(".caja-efectos").toggle("shake", 4000);<br>
});<br>

// Tooltip<br>
$(document).tooltip();<br>

// Dialog<br>
$("#lanzar-popup").click(function(){<br>
	$("#popup").dialog();<br>
})<br>

// Datepicker<br>
$("#calendario").datepicker();<br>

// Tabs<br>
$("#pestanas").tabs();*/<br>

< /script><br>



</div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>