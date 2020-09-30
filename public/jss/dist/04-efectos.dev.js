"use strict";

$(document).ready(function () {
  var caja = $("#caja");
  $("#mostrar").hide(); //hide este meodo oculta

  $("#mostrar").click(function () {
    //en el evento click del boton mostrar
    $(this).hide(); //hide oculta el boton

    $("#ocultar").show(); //show muestro ..puedo poner show('fast') q da una velocidad de recogido o show('normal')

    caja.slideDown('slow'); //slideDown va en el boton de mostrar oculta y desoculta la caja con un efecto de arriba abajo 
    //fadeIn('slow')fadeIn este metodo se usa para el boton de mostrar hace un efecto de fundido y 'slow' para q sea un toqe mas lento y agradable
    //fadeOut('slow')fadeOut este metodo Se usa para el boton de ocultar hace un efecto de fundido y 'slow' para q sea un toqe mas lento y agradable
    //fadeTo('slow', 0.8) este en el boton de mostrar juego con la opasidad como q lo deja medio transparente
    //fadeTo('slow', 0.2) este en el boton de ocultar
  });
  $("#ocultar").click(function () {
    //en el evento click del boton ocultar
    $(this).hide(); //lo escondo al boton

    $("#mostrar").show(); //lo muestro

    caja.slideUp('slow', function () {
      //slideUp va en el boton de ocultar oculta y desoculta la caja con un efecto de ABAJO ARRIBA
      console.log("Cartel ocultado"); //esto lo pongo en una funcion de kalback para q lo muestre resien despues de ocultar la caja
    });
  });
  $("#todoenuno").click(function () {
    caja.slideToggle('fast'); //slideToggle esta funcion hace aparece y desaparece la caja en este caso es como tener las dos funciones en una
    //tambien esta el Toggle ,fadeToggle q tienen otros efectos
  });
  $("#animar").click(function () {
    //cuando hago el click en el boton animame
    caja.animate({
      //animate este metodo me permite hacer animaciones a nivel de css LAS {} SON PORQE ESTO VA A ESTAR EN UN JSON
      marginLeft: '500px',
      //le doy un margen a la izquierda entoces la caja se mueve hacia la derecha 
      fontSize: '40px',
      //le aumenta el tamaño de la letra
      height: '110px' //le doy altura

    }, 'slow') //'slow' para q sea un toqe mas lento y agradable
    .animate({
      borderRadius: '900px',
      //lo redondeo a la caja
      marginTop: '80px' //le da un margen arriba para q baje la caja

    }, 'slow').animate({
      borderRadius: '0px',
      //le quito el borde redondeado
      marginLeft: '0px' //y el margen para q regrese

    }, 'slow').animate({
      borderRadius: '100px',
      marginTop: '0px'
    }, 'slow').animate({
      marginLeft: '500px',
      fontSize: '40px',
      height: '110px'
    }, 'slow');
  });
});