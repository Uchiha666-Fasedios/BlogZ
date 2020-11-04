$(document).ready(function() {


if ($(".label-notifications-msg").text() == 0) {
      $(".label-notifications-msg").addClass("hidden"); //pongo la etiqeta de ocultar
            } else {
                $(".label-notifications-msg").removeClass("hidden"); //desoculto
            }



    if ($(".label-notifications").text() == 0) { //si esta en cero 
        $(".label-notifications").addClass("hidden"); //oculto con esta etiqeta
    } else { //si hay algo
        $(".label-notifications").removeClass("hidden"); //saco la etiqeta de ocultar
    }



    notifications();
 

    setInterval(function() {
        notifications();
       
    }, 60000); //a cada minuto va a comprobar si tiene notificaciones 



});


function notifications() {


    $.ajax({ //$.ajax metodo para usar ajax {} porqe es un json
        url: URL + '/private_message/notification/get', //le indico la url q voy a enviar q me manda a el metodo countNotifications del controlador notification
        type: 'GET', //el tipo de peticion q voy a hacer
        success: function(response) { //success en el caso de q todo vaya correcto
            $(".label-notifications-msg").html(response); //le meto a esta clase del div la response q trae el numero

            if (response == 0) {
                $(".label-notifications-msg").addClass("hidden"); //pongo la etiqeta de ocultar
            } else {
                $(".label-notifications-msg").removeClass("hidden"); //desoculto
            }

        }
    });


    $.ajax({ //$.ajax metodo para usar ajax {} porqe es un json
        url: URL + '/notifications/get', //le indico la url q voy a enviar q me manda a el metodo countNotifications del controlador notification
        type: 'GET', //el tipo de peticion q voy a hacer
        success: function(response) { //success en el caso de q todo vaya correcto
            $(".label-notifications").html(response); //le meto a esta clase del div la response q trae el numero

            if (response == 0) {
                $(".label-notifications").addClass("hidden"); //pongo la etiqeta de ocultar
            } else {
                $(".label-notifications").removeClass("hidden"); //desoculto
            }

        }
    });


    
    

}

