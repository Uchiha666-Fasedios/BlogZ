
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
