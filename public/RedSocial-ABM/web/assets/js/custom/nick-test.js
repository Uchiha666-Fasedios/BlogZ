$(document).ready(function() { //$(document) el dolar me dice q voy a trabajar con jquery y (document) es el SELECTOR (hay mas selectores) carga toda la pagina script .ready metodo de jquery es un evento q tiene una funcion de kalbak


    $(".nick-input").blur(function() { //(".nick-input") clase q tiene el input cuando estoy ahi y .blur salgo cuando salgo del fucus del input
        var nick = this.value;

        $.ajax({ //$.ajax metodo para usar ajax {} porqe es un json
            url: URL + '/nick-test', //le indico la url q voy a enviar
            data: { nick: nick }, //los datos q voy a enviar
            type: 'POST', //el tipo de peticion q voy a hacer
            success: function(response) { //success en el caso de q todo vaya correcto
                if (response == "used") {
                    $(".nick-input").css("border", "1px solid red");
                } else {
                    $(".nick-input").css("border", "1px solid green");
                }
            }
        });


    });


});