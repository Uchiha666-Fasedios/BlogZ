'use strict'
//CUANDO HAGO UN REQUIRE LLAMO A LA CARPETA NODE_MODULES Y LUEGO AL ARCHIVO NOMBRADO SIN EL js
var mongoose = require('mongoose'); //cargo este modulo esta libreria
var app = require('./app'); //obtengo app q tiene express 
var port = 3700; //el puerto de mi local host 3700

mongoose.Promise = global.Promise; //le digo q voy a usar prmesas 

mongoose.set('useFindAndModify', false);//fuerza q todos los metodos antiguos se desactiven
mongoose.Promise = global.Promise;//le digo q voy a usar prmesas 
/*, { useNewUrlParser: true, useUnifiedTopology: true }*/


mongoose.connect('mongodb://localhost:27017/portafolio', { useNewUrlParser: true, useUnifiedTopology: true }) //conecto la base de datos portafolio es el nombre de la base de datos
    .then(() => { //El método then() retorna una Promesa . Recibe dos argumentos: funciones callback para los casos de éxito y fallo de Promise .
        console.log("Conexión a la base de datos establecida satisfactoriamente!!...");

        // Creacion del servidor DEBO CONFIGURAR app.js
        app.listen(port, () => { //listen metodo de la libreria express q tiene dos parametro al primero le ponemos el puerto el segundo es una funcion de kalback
            console.log("Servidor corriendo correctamente en la url: localhost:3700");
        });

    })

//si hay un fallo de Promise
.catch(err => console.log(err));