
$(document).ready(function(){//ready es un evento q tiene una funcion de kalback


	reloadLinks();//llamo la funcion para tener los enlaces por defecto q agrege en el html

	$('#add_button')//selecciono este id
		.removeAttr('disabled')//removeAttr borro el atributo q en este caso esta en el boton ...disabled es el atributo a borrar
		.click(function(){//en el evento click o sea cuando toco el boton
			$('#menu').prepend('<li><a href="'+$("#add_link").val()+'"></a></li>');//selecciono el id menu y prepend añade al principio en el menu y con 
			//$("#add_link").val() seleciono el id del input y el value q esta en el input
//PREPEND lo mete al principio APPEND al final BEFORE antes y fuera de la lista 
			$("#add_link").val('');//#add_link selecciono el id del input y .val('') lo pongo en vacio 
			reloadLinks();//llamo la funcion para volver a cargar los enlaces junto con el q agrego con el input
		});

});

function reloadLinks(){
	$('a').each(function(index){//$('a') selecciono el elemento 'a' each es un bucle con funcion de kalback y index parametro q tiene el indice en este caso voy a recorrer el elemento a
		var that = $(this);//guardo this en la variable (this se refiere al elemento en cuestion)
		var enlace = that.attr("href");//attr para poder seleccionar el href lo q hay ahi

		that.attr('target','_blank');//attr('target','_blank') le estoy creando un atributo y su valor that. a la etiqueta 'a' q sirve para q cuando le de click al enlace me lo abra en pestaña nueva

		that.text(enlace);//funcion text que es para meter el enlace como texto incrusto el enlace en that q es el elemento a
	});
}


