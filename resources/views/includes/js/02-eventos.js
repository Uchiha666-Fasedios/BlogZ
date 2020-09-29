$(document).ready(function(){

	// MouseOver y MouseOut/
	/*var caja = $("#caja");//el id caja

	
	caja.mouseover(function(){//mouseover cuando toco con el mouse
		$(this).css("background","red");//$(this) hace referencia al elemento caja
	});

	caja.mouseout(function(){//cuando dejo de tocar con el mouse mouseout
		$(this).css("background","green");
	});*/
	

//LO MISMO PERO CODIGO MAS OPTIMO
var caja = $("#caja");//el id caja
function cambiaRojo(){
		$(this).css("background","red");
	}

	function cambiaVerde(){
		$(this).css("background","green");
	}

	// Hover
	caja.hover(cambiaRojo, cambiaVerde);//this hace referencia al elemento caja hover este evento hace q cuando toco con el mouse me muestra la primer funcion 
	//y cuando dejo de tocar la segunda funcionllamo a las funciones 





// Click, Doble click
//si hago click hace esto
	caja.click(function(){
		$(this).css("background", "blue")
			   .css("color", "white");
	});
//si hago doble click hace esto
	caja.dblclick(function(){//
		$(this).css("background", "pink")
			   .css("color", "yellow");
	});



// Focus y blur
	var nombre = $("#nombre");
	var datos = $("#datos");

	nombre.focus(function(){//cuando me pongo en la caja
		$(this).css("border", "2px solid green");
	});

	nombre.blur(function(){//para cuando salgo del fucus del input
		$(this).css("border", "1px solid #ccc");

		datos.text($(this).val()).show();//datos.text un elemento typo text .val() saco el dato del input el value  show muestra el elemento $(this)
	});


// Mousedown y mouseup
	datos.mousedown(function(){//mousedown cuando se este presionando el raton
		$(this).css("border-color", "gray");
	});

	datos.mouseup(function(){//mouseup cuando dejo de apretar el raton
		$(this).css("border-color", "black");
	});

// Mousemove
	$(document).mousemove(function(){//evento movimiento del raton
		$('body').css("cursor","none");//oculto el cursor el raton
		$("#sigueme").css("left", event.clientX)//event.clientXme dice en que cordenadas estoy de el raton left en este caso el div va a segir horizontalmente
		             .css("top", event.clientY);//top vertical
	});

});
