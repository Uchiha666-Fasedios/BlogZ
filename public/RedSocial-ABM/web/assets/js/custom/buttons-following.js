function followButtons() {

    $(".btn-follow").unbind('click').click(function() { //unbind para q no se lancen varios clik ..evento click hago click en el boton seguir
        $(this).addClass('hidden'); //al darle click al boton vamos a ocultarlo le ponemos la clase hidden
        $(this).parent().find('.btn-unfollow').removeClass("hidden"); //sacamos la 

        $.ajax({ //$.ajax metodo para usar ajax {} porqe es un json
            url: URL + '/follow', //le indico la url q voy a enviar
            data: { followed: $(this).attr('data-followed') }, //los datos q voy a enviar.. this hace referencia a el boton click
            type: 'POST', //el tipo de peticion q voy a hacer
            success: function(response) { //success en el caso de q todo vaya correcto
                console.log(response);

            }
        });


    });



    $(".btn-unfollow").unbind('click').click(function() { //unbind para q no se lancen varios clik ..evento click hago click en el boton seguir
        $(this).addClass('hidden'); //si la clase es hidden
        $(this).parent().find('.btn-follow').removeClass("hidden");

        $.ajax({ //$.ajax metodo para usar ajax {} porqe es un json
            url: URL + '/unfollow', //le indico la url q voy a enviar
            data: { followed: $(this).attr('data-followed') }, //los datos q voy a enviar.. this hace referencia a el boton click
            type: 'POST', //el tipo de peticion q voy a hacer
            success: function(response) { //success en el caso de q todo vaya correcto
                console.log(response);

            }
        });


    });


}