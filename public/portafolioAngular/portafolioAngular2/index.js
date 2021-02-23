'use strict'
//CUANDO HAGO UN REQUIRE LLAMO A LA CARPETA NODE_MODULES Y LUEGO AL ARCHIVO NOMBRADO SIN EL js
var mongoose = require('mongoose');//cargo este modulo esta libreria
var app = require('./app');//obtengo app q tiene express 
var port = 3900;//el puerto de mi local host 3900

mongoose.set('useFindAndModify', false);//fuerza q todos los metodos antiguos se desactiven
mongoose.Promise = global.Promise;//le digo q voy a usar prmesas 
mongoose.connect('mongodb://localhost:27017/api_rest_blog', { useNewUrlParser: true })//conecto la base de datos api_rest_blog es el nombre de la base de datos useNewUrlParser: true  esto me permite utilizar las nuevas funcionalidades de mongoose
        .then(() => {
            console.log('Conexión a la base de datos correcta !!!');

            // Crear servidor y ponerme a escuchar peticiones HTTP
            app.listen(port, () => {//listen metodo de la libreria express q tiene dos parametro al primero le ponemos el puerto el segundo es una funcion de kalback
                console.log('Servidor corriendo en http://localhost:'+port);
            });

        });