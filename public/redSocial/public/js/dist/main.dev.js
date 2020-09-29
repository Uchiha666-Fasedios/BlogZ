"use strict";

var url = 'http://localhost/blogLaravel/redsocial/public/';
window.addEventListener("load", function () {
  //window.addEventListener("load" cuando carga la pagina
  $('.btn-like').css('cursor', 'pointer');
  $('.btn-dislike').css('cursor', 'pointer'); // Botón de like

  function like() {
    $('.btn-like').unbind('click').click(function () {
      /*'.btn-like' la clase q esta en la vista entonces con el evento click(function..  unbind borra los eventos antiguos para q no salte like dislike varias veces yo solo quiero ua y otra y asi */
      console.log('like');
      $(this).addClass('btn-dislike').removeClass('btn-like');
      /*this selecciona al objeto q le hice click addClass le agrego la clase btn-dislike y le saco la clase btn-like */

      $(this).attr('src', url + '/img/heart-red.png');
      /*attr le cambio la etiqeta src por url + '/img/heart-red.png' le estoy poniendo el corazoncito rojo*/
      //con esto guardo en la base de datos porqe .. url: 'http://localhost/blogLaravel/redsocial/public/like/' + $(this).data('id'),
      //esa url invoca a la ruta Route::get('/like/{image_id}', 'LikeController@like')->name('like.save'); q es la q guarda

      $.ajax({
        /*creo el objeto json */
        url: 'http://localhost/blogLaravel/redsocial/public/like/' + $(this).data('id'),
        //el atributo id q toma desde la vista.. en realidad se llama data-id pero puedo cogerlo asi con data q es una funcion de javascrip q espera un id
        type: 'GET',
        //le digo q va ser por get
        success: function success(response) {
          if (response.like) {
            /*like es el nombre del objeto json q me creo  porqe la funcion se llama like*/
            console.log('Has dado like a la publicacion');
          } else {
            console.log('Error al dar like');
          }
        }
      });
      dislike();
      /*despues de darle a like ejecuto dislike para q el dom recuerde el dislike porqe
                  cuando le doy a like hace la funcion like y qeda eso recordando en el dom,
                   porqe cambio la clase y la otra no la cambio lo hace en la otra funcion  y qiero q qla otra clase tambien cambie  */
    });
  }

  like(); // Botón de dislike

  function dislike() {
    $('.btn-dislike').unbind('click').click(function () {
      console.log('dislike');
      $(this).addClass('btn-like').removeClass('btn-dislike');
      $(this).attr('src', url + '/img/heart-black.png');
      $.ajax({
        url: url + '/dislike/' + $(this).data('id'),
        type: 'GET',
        success: function success(response) {
          if (response.like) {
            console.log('Has dado dislike a la publicacion');
          } else {
            console.log('Error al dar dislike');
          }
        }
      });
      like();
    });
  }

  dislike(); // BUSCADOR

  $('#buscador').submit(function (e) {
    $(this).attr('action', url + '/gente/' + $('#buscador #search').val());
  });
});