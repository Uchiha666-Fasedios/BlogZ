'use strict'
//express nos va permitir tener un sistema de rutas y hacer peticiones http
// Cargar modulos de node para crear servidor
var express = require('express'); //cargo el modulo para poder tener el objeto y trabajar con el
var bodyParser = require('body-parser'); //cargo el modulo para tener esta libreria para combertir en json lo q me llega por post etc..


// Ejecutar express (http)
var app = express();

// Cargar ficheros rutas
var article_routes = require('./routes/article'); //llamo al archivo q tiene todas las rutas

// Middlewares // middlewares un metodo q se ejecuta antes de ejecutar la accion de un controlador de ejecutar el resultado de la peticion
app.use(bodyParser.urlencoded({ extended: false })); //app.use un objeto de express configuracion necesaria para bodyParser
app.use(bodyParser.json()); //q todo lo q le llege lo convierta a json



// Configurar cabeceras y cors PARA PODER HACER PETICIONES AJAX AL BACKEND SI PROBLEMAS
//DE ESTA MANERA VAMOS A PERMITIR EL ACCESO CRUZADO ENTTRE DOMINIOS Y EVITAR FALLOS A LA HORA DE TRABAJAR CON FRONTEN A LA PARTE DEL BACKEND
//ESTO ES UN middlewares PARA CONfigurarnos las cabezeras 
//siempre se va a ejecutar esto antes de cada peticion
// CORS
app.use((req, res, next) => {
    res.header('Access-Control-Allow-Origin', '*');
    res.header('Access-Control-Allow-Headers', 'Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Allow-Request-Method');
    res.header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
    res.header('Allow', 'GET, POST, OPTIONS, PUT, DELETE');
    next();
});

// Añadir prefijos a rutas / Cargar rutas
app.use('/api', article_routes); //app.use porque es un middlewares ...'/api' para q sea de esta manera http://localhost:3900/api/test puedo hacerlo sin el api y seria http://localhost:3900/test
/*app.get('/probando',(req,res)=>{
    console.log('hola puta');
});*/

// Exportar modulo (fichero actual)
module.exports = app; //exporto app q tiene todo para poder importar e usarlo en otro lado