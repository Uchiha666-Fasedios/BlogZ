'use strict'
//express nos va permitir tener un sistema de rutas y hacer peticiones http
var express = require('express'); //cargo el modulo para poder tener el objeto y trabajar con el
var bodyParser = require('body-parser'); //cargo el modulo para tener esta libreria para combertir en json lo q me llega por post etc..

var app = express();

// cargar archivos rutas
var project_routes = require('./routes/project'); //llamo al archivo q tiene todas las rutas

// middlewares un metodo q se ejecuta antes de ejecutar la accion de un controlador de ejecutar el resultado de la peticion
app.use(bodyParser.urlencoded({ extended: false })); //app.use un objeto de express configuracion necesaria para bodyParser
app.use(bodyParser.json()); //q todo lo q le llege lo convierta a json

// Configurar cabeceras y cors PARA PODER HACER PETICIONES AJAX AL BACKEND SI PROBLEMAS
//DE ESTA MANERA VAMOS A PERMITIR EL ACCESO CRUZADO ENTTRE DOMINIOS Y EVITAR FALLOS A LA HORA DE TRABAJAR CON FRONTEN A LA PARTE DEL BACKEND
//ESTO ES UN middlewares PARA CONfigurarnos las cabezeras 
//siempre se va a ejecutar esto antes de cada peticion
app.use((req, res, next) => {
    res.header('Access-Control-Allow-Origin', '*'); //'*' esto se cambia si esta en produccion este proyecto
    res.header('Access-Control-Allow-Headers', 'Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Allow-Request-Method');
    res.header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
    res.header('Allow', 'GET, POST, OPTIONS, PUT, DELETE');
    next();
});

// rutas
app.use('/', express.static('client', {redirect:false}));
app.use('/api', project_routes); //app.use porque es un middlewares ...'/api' para q sea de esta manera http://localhost:3700/api/test puedo hacerlo sin el api y seria http://localhost:3700/test 
app.get('*', function(req,res, next){
	res.sendFile(path.resolve('client/index.html'));
});
//ejemplo
/*app.get('/', (req, res) => { //el metodo get donde la url si escribo http://localhost:3700 me va mostrar
    res.status(280).send( //req lo q le puedo estar enviando desde el cliente o la peticion q yo haga y res es la response q yo estoy enviando 
        //status(280) q si es una respuesta exitosa send para enviar los datos
        '<h1>pagina de inicio</h1>'

    );
});*/

//ejemplo 
/*app.get('/test', (req, res) => { //el metodo get donde la url si escribo http://localhost:3700/test me va mostrar el json
    console.log(req.body.nombre); //este console es un ejemplo demostrado con postman
    console.log(req.query.web); //este console es un ejemplo demostrado con postman
    res.status(280).send({ //{ la llave significa q es un json req lo q le puedo estar enviando desde el cliente o la peticion q yo haga y res es la response q yo estoy enviando 
        //status(280) q si es una respuesta exitosa send para enviar los datos
        messaje: 'hola mundo desde mi appiNodeJS'

    });
});*/
//ejemplo 
//esto se va a ver en la consola de comando
/*app.post('/test/:id', (req, res) => { //el metodo post donde me va mostrar el json
    console.log(req.body.nombre); //este console es un ejemplo demostrado con postman
    console.log(req.query.web); //este console es un ejemplo demostrado con postman
    console.log(req.params.id); //este console es un ejemplo demostrado con postman
    res.status(280).send({ //{ la llave significa q es un json req lo q le puedo estar enviando desde el cliente o la peticion q yo haga y res es la response q yo estoy enviando 
        //status(280) q si es una respuesta exitosa send para enviar los datos
        messaje: 'hola mundo desde mi appiNodeJS'

    });
});*/


// exportar
module.exports = app; //exporto app q tiene todo para poder importar e usarlo en otro lado