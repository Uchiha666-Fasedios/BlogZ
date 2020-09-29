'use strict'
//ESTE EVENTO ES PARA QUE PUEDA PONER EL SCRIP Q CARGA TODO ESTO AL PRINCIPIO DEL BODY
window.addEventListener('load', () =>{



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





//fin de load
});