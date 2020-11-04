$(document).ready(function() {

    //ESTO SUPUESTAmente es para el scroll


    var ias = jQuery.ias({

        container: '#timeline .box-content',
        item: '.publication-item',
        pagination: '#timeline .pagination',
        next: '#timeline .pagination .next_link',
        triggerPageThreshold: 5

    });


    ias.extension(new IASTriggerExtension({
        text: 'ver mas publicaciones',
        offset: 3
    }));

    ias.extension(new IASSpinnerExtension({
        src: URL + '/../assets/images/ajax-loader.gif'

    }));

    ias.extension(new IASNoneLeftExtension({
        text: 'No hay mas publicaciones'

    }));







    //esto es cuando cargo la paguina me lanza esta funcion 
    ias.on('ready', function(event) { //ias.on('ready' ESTO ES PROPIO DE ias.on 
        
    buttons();
    });
    //y cuando hago scroll ambien carga esta funcion
    ias.on('rendered', function(event) {
        buttons();
    });


});


function buttons() {
    $('[data-toggle="tooltip"]').tooltip();//con esto habilito tooltip de boostrap para cuando pase por el corazon se ponga un mensaje me gusta

    $('.btn-img').unbind("click").click(function() {
        $(this).parent().find('.pub-image').fadeToggle();//fadeToggle funcion de jquery q hace aparecer y desaparecer algo con efecto 
    });



    $('.btn-delete-pub').unbind("click").click(function() {

        

        var mi_resultado = confirm('¿estas seguro de querer eliminar la publicacion? no se podra recuperar :)'); //me muestra una ventanita de confirmacion donde se puede poner aceptar o cancelar
        console.log(mi_resultado); //si toco aceptar me devuelve true ,cancelar false

      
        if (mi_resultado == true) {
            

            $(this).parent().parent().addClass('hidden'); //se oculta el boton de borrar


            $.ajax({
                url: URL + '/publication/remove/' + $(this).attr("data-id"),
                type: 'GET',
                success: function(response) {
                    console.log(response);

                }
            });
        } else {

        }

        


    });

        //ESTO ES DE bootbox ES UN COMPLEMENTO DE BOOSTRAP PARA USARLO ACA EN JAVASCRIP
        //LO DESCARGE Y LO PEGE EN LA CARPETA js 
        /*bootbox.confirm({
            message: "This is a confirm with custom button text and color! Do you like it?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                console.log('This was logged in the callback: ' + result);
            }
        });*/

       ///hsata aca el 

        //confirmacion
        
        $('.btn-like').unbind("click").click(function() {
$(this).addClass("hidden");
$(this).parent().find('.btn-unlike').removeClass("hidden");
            $.ajax({
            url: URL + '/like/' + $(this).attr("data-id"),
            type: 'GET',
            success: function(response) {
                console.log(response);

            }
        
        });




    });


    $('.btn-unlike').unbind("click").click(function() {
        $(this).addClass("hidden");
        $(this).parent().find('.btn-like').removeClass("hidden");
                    $.ajax({
                    url: URL + '/unlike/' + $(this).attr("data-id"),
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
        
                    }
                
                });
        
        
        
        
            });

}