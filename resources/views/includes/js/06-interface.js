$(document).ready(function(){

	// Mover elemento por la pagina
	$(".elemento").draggable();//draggable CON ESTE metodo muevo este elemento

// Redimensionar
	$(".elemento").resizable();//resizable redimensiona o sea agranda y achica el elemento


	// Seleccionar y ordenar elementos
	//$(".lista-seleccionable").selectable();//selectable este metodo cambia de locor cuando haces click a un elemento de la lista
	//$(".lista-seleccionable").sortable();//sortable me permite seleccionar los elementos y arrastrarlos cambiandolos
	$(".lista-seleccionable").sortable({//puedo con una funcion de kalback hacer esto
		update: function(event, ui){
			console.log("ha cambiado la lista");
			
		}



});




// Drop
	$("#elemento-movido").draggable();//draggable va ser el elemento q se puede mover para q pueda poner encima del otro elemento 
	$("#area").droppable({//droppable es para el elemento q no se va a mover donde se suelta el otro elemento
		drop: function(){//drop detecta cuando un elemento se solto ahi
			console.log("Has soltado algo dentro de el area");
		}
	});





// Efectos hay mas en la documntacion
	$("#mostrar").click(function(){
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
	$(document).tooltip();//cuando paso el mouse por un enlace o lo q tenga un title abre un cuadro y muestra lo q dice en el title


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

