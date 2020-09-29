$(document).ready(function() { /*$(document) q voy a trabajar con jqury */


    //PAGINA DONDE ESTA EL SLIDER https://bxslider.com/

    // Slider se copio de la pagina
    if (window.location.href.indexOf('index') > -1) { //si estoy en el index el -1 significa no encontrado .. indexOf busca una palabra en este caso index
        $('.galeria').bxSlider({
            /*tipo de animacion*/
            mode: 'fade',
            captions: false,
            /*tamaño de la foto*/
            slideWidth: 1200,

            responsive: true,
            /*le pongo los puntos del slider */
            pager: true
        });
    }


    /*PAGINA DE LIBRERIA PLUYING PARA TENER EL OBJETO MOMENT() Y METODOS DE USO PARA DATE https://cdnjs.com/libraries/moment.js/*/
    // Posts
    if (window.location.href.indexOf('index') > -1) { //si estoy en el index el -1 significa no encontrado
        var posts = [{
                title: 'Prueba de titulo 1',
                date: 'Publicado el dia ' + moment().date() + " de " + moment().format("MMMM") + " del " + moment().format("YYYY"),
                content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet malesuada erat, ac ullamcorper justo. Fusce sapien nibh, tempor fermentum mauris ac, tincidunt maximus diam. Quisque bibendum sed dui sit amet euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse quam sem, scelerisque sit amet libero nec, congue blandit dolor. Aliquam a vehicula mi. Morbi id convallis dolor. Nulla eu libero nec nulla fermentum viverra quis at magna. Quisque rutrum augue nulla, bibendum viverra sapien viverra vel. Quisque malesuada ultrices felis eu porttitor.'
            },
            {
                title: 'Prueba de titulo 2',
                date: 'Publicado el dia ' + moment().date() + " de " + moment().format("MMMM") + " del " + moment().format("YYYY"),
                content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet malesuada erat, ac ullamcorper justo. Fusce sapien nibh, tempor fermentum mauris ac, tincidunt maximus diam. Quisque bibendum sed dui sit amet euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse quam sem, scelerisque sit amet libero nec, congue blandit dolor. Aliquam a vehicula mi. Morbi id convallis dolor. Nulla eu libero nec nulla fermentum viverra quis at magna. Quisque rutrum augue nulla, bibendum viverra sapien viverra vel. Quisque malesuada ultrices felis eu porttitor.'
            },
            {
                title: 'Prueba de titulo 3',
                date: 'Publicado el dia ' + moment().date() + " de " + moment().format("MMMM") + " del " + moment().format("YYYY"),
                content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet malesuada erat, ac ullamcorper justo. Fusce sapien nibh, tempor fermentum mauris ac, tincidunt maximus diam. Quisque bibendum sed dui sit amet euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse quam sem, scelerisque sit amet libero nec, congue blandit dolor. Aliquam a vehicula mi. Morbi id convallis dolor. Nulla eu libero nec nulla fermentum viverra quis at magna. Quisque rutrum augue nulla, bibendum viverra sapien viverra vel. Quisque malesuada ultrices felis eu porttitor.'
            },
            {
                title: 'Prueba de titulo 4',
                date: 'Publicado el dia ' + moment().date() + " de " + moment().format("MMMM") + " del " + moment().format("YYYY"),
                content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet malesuada erat, ac ullamcorper justo. Fusce sapien nibh, tempor fermentum mauris ac, tincidunt maximus diam. Quisque bibendum sed dui sit amet euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse quam sem, scelerisque sit amet libero nec, congue blandit dolor. Aliquam a vehicula mi. Morbi id convallis dolor. Nulla eu libero nec nulla fermentum viverra quis at magna. Quisque rutrum augue nulla, bibendum viverra sapien viverra vel. Quisque malesuada ultrices felis eu porttitor.'
            },
            {
                title: 'Prueba de titulo 5',
                date: 'Publicado el dia ' + moment().date() + " de " + moment().format("MMMM") + " del " + moment().format("YYYY"),
                content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet malesuada erat, ac ullamcorper justo. Fusce sapien nibh, tempor fermentum mauris ac, tincidunt maximus diam. Quisque bibendum sed dui sit amet euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse quam sem, scelerisque sit amet libero nec, congue blandit dolor. Aliquam a vehicula mi. Morbi id convallis dolor. Nulla eu libero nec nulla fermentum viverra quis at magna. Quisque rutrum augue nulla, bibendum viverra sapien viverra vel. Quisque malesuada ultrices felis eu porttitor.'
            },
            {
                title: 'Prueba de titulo 6',
                date: 'Publicado el dia ' + moment().date() + " de " + moment().format("MMMM") + " del " + moment().format("YYYY"),
                content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet malesuada erat, ac ullamcorper justo. Fusce sapien nibh, tempor fermentum mauris ac, tincidunt maximus diam. Quisque bibendum sed dui sit amet euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse quam sem, scelerisque sit amet libero nec, congue blandit dolor. Aliquam a vehicula mi. Morbi id convallis dolor. Nulla eu libero nec nulla fermentum viverra quis at magna. Quisque rutrum augue nulla, bibendum viverra sapien viverra vel. Quisque malesuada ultrices felis eu porttitor.'
            },


        ];


        /*al tener las fechas y todo en un vector vamos a recorrerlo e ir incrustando  */
        posts.forEach((item, index) => { /*recorro posts ...item es es el value y el index es el indice */
            /*en la variable post se va incrustando las etiquetas atributos todo 
             ${item.title} item es el value q viene del foreach y title es lo q tiene el vector posts q esta incrustado en el item */
            var post = `
            <article class="post">
                <h2>${item.title}</h2>
                <span class="date">${item.date}</span>
                <p>
                    ${item.content}
                </p>
                <a href="#" class="button-more">Leer más</a>
            </article>
        `;

            $("#posts").append(post); /*append es para meter.. va metiendo al final */
            /* #posts este id esta el div y con el .apeend colocamos post
                   y se van poniendo varios articles*/
        });

    }
    // Selector de tema
    var theme = $("#theme");
    var ultimo = localStorage.getItem('tema'); //creo session
    console.log(ultimo);

    if (ultimo == 'blue') {
        theme.attr("href", "css/blue.css");
    } else if (ultimo == 'red') {
        theme.attr("href", "css/red.css");
    } else {
        theme.attr("href", "css/green.css");
    }

    $("#to-green").click(function() {
        //.attr me permite elegir atributos
        theme.attr("href", "css/green.css");
        localStorage.setItem('tema', 'green'); //creo la session

    });

    $("#to-red").click(function() {
        theme.attr("href", "css/red.css");
        localStorage.setItem('tema', 'red'); //creo la session
    });

    $("#to-blue").click(function() {
        theme.attr("href", "css/blue.css");
        localStorage.setItem('tema', 'blue'); //creo la session
    });


    // Scroll arriba de la web
    $('.subir').click(function(e) { /*cuando se hace click capturo el evento con el parametro e */
        e.preventDefault(); /*evito lo q esta por defecto q cuando toco el enlase me lleva a tal pagina con esto lo evito */

        $('html, body').animate({ /*una animacion sobre html y body de la pagina */
            scrollTop: 0 //esta propiedad hace q suba hacia el pixel 0 el principio
        }, 500); //y este es el tiempo la velocidad cuanto menos le ponga mas rapido va

        return false;
    });


    // Login falso

    $("#login form").submit(function() {
        var form_name = $("#form_name").val(); //recogemos el value del input

        localStorage.setItem("form_name", form_name); //creamos session

    });

    var form_name = localStorage.getItem("form_name"); //guardamos la session q tiene el nombre en la variable

    if (form_name != null && form_name != "undefined") { //si tiene algo entro
        var about_parrafo = $("#about p"); //selecciono este div con el parrafo y lo guardo en la variable

        about_parrafo.html("<br><strong>Bienvenido, " + form_name + "</strong> "); //le agrego todo esto al div
        about_parrafo.append("<a href='#' id='logout'>Cerrar sesión</a>"); //creo el cerrar session con id logout

        $("#login").hide(); //ocultamos el div

        $("#logout").click(function() { //si le doy click a cerrar session 
            localStorage.clear(); //borramos las sessiones
            location.reload(); //me redirige al index
        });

    }




    // Acordeon

    if (window.location.href.indexOf('about') > -1) { //cuando estoy en la pagina about
        $("#acordeon").accordion(); //tiro la propiedad de jquery ui el acordeon
    }




    // Reloj
    if (window.location.href.indexOf('reloj') > -1) { //cuando estoy en la pagina reloj
        //setInterval ejecuta una funcion de kalbak en un determinado tiempo en un bucle infinito
        setInterval(function() {
            var reloj = moment().format("hh:mm:ss"); //utilizamos moment de jquery ui
            $('#reloj').html(reloj); //le meto la variable al div
        }, 1000); //seria 1 segundo


    }


    // Validación
    if (window.location.href.indexOf('contact') > -1) { //CUANDO ESTOY EN LA PAGINA CONTACT

        $("form input[name='date']").datepicker({
            dateFormat: 'dd-mm-yy' /*le cambi el formato */
        });

        /*esto es propio del pluying */
        $.validate({ //este metodo es del pluying es el q hace la validacion 
            /*español */
            lang: 'es',
            /*para q me muestre los errores arriba cuando toco el boton submit*/
            errorMessagePosition: 'top',

            scrollToTopOnError: true /*para q me muestre los errores arriba */
        });

    }


});