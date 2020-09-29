"use strict";

$(document).ready(function () {
  // Load
  // $("#datos").load("https://reqres.in/");//load esto es una peticion ajax q hace q se meta toda la pagina en este div...(se mete solo el html)
  // Get y Post
  $.get("https://reqres.in/api/users", {
    page: 2
  }, function (response) {
    //$.get es una peticion ajax y la pagina viene por get ,{page: 2} asi se ponen los parametros y {} porqe es un json
    //response es el parametro de la funcion kalback en el se guardan los datos del enlace
    response.data.forEach(function (element, index) {
      //response.data. es donde estan los usuarios hago el foreach
      $("#datos").append("<p>" + element.first_name + " " + element.last_name + "</p>"); //append guardo el nombre y apellido en el div datos
    });
  }); //post

  $("#formulario").submit(function (e) {
    //#formulario selecciono el formulario .submit es el evento y le meto al parametro e el evento ..o sea capturo el evento
    e.preventDefault(); //preventDefault hace q no me redirija a la pagina de action q tiene el formulario

    var usuario = {
      name: $('input[name="name"]').val(),
      //recojo el input 
      web: $('input[name="web"]').val()
    };
    /*$.post($(this).attr("action"), usuario, function(response){//$.post peticion ajax ..this hace referencia a esto .attr("action") q attr me permite elegir atributos es la accion del formulario o sea el enlace 
    	//usuario es el parametro q tiene los datos de la variable usuario donde se colocan en response el parametro del kalback
    	console.log(response);
    }).done(function(){//.done Capturar cuando la petición a tenido éxito y ha terminado
    	alert("Usuario añadido correctamente");
    });*/
    //ESTA ES LA MEJOR FORMA 

    $.ajax({
      //$.ajax metodo para usar ajax {} porqe es un json
      type: 'POST',
      //el tipo de peticion q voy a hacer
      url: $(this).attr("action"),
      //le indico la url q voy a enviar
      data: usuario,
      //los datos q voy a enviar
      beforeSend: function beforeSend() {
        //beforeSend este metodo hace q antes de q se envien los datos etc.. haga una accion
        console.log("Enviando usuario...");
      },
      success: function success(response) {
        //success en el caso de q todo vaya correcto
        console.log(response);
      },
      error: function error() {
        //error si hay algun error
        console.log("A ocurrido un error");
      },
      timeout: 1000 //los segundos q quiero q tarde

    });
    return false; //para q tampoco me redirija para q no haga la accion por defecto de redirigirme al action cuando clickeo el submit
  });
});