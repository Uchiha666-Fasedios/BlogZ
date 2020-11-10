'use strict'

var express = require('express'); //trabajar con express para poder crear las rutas 
var ProjectController = require('../controllers/project'); //cargo el cotrolador

var router = express.Router(); //cargo este servicio q tiene un monton de metodos para el tema de rutas

var multipart = require('connect-multiparty'); //trabajo con esto 'connect-multiparty' es un paqete q instale igual q express para q me reconozca los archivos las imagenes ..
var multipartMiddleware = multipart({ uploadDir: './uploads' }); //aca llamo a la funcion y le indico donde se van a subir los archivos..uploadDir como propiedad y aca se guardan ./uploads

router.get('/home', ProjectController.home); //router.get una ruta por get /home es la direccion q se pone en la url y ProjectController.home q va a utilizar el objeto con su metodo q se creo en el controlador
router.post('/test', ProjectController.test);
router.post('/save-project', ProjectController.saveProject);
router.get('/project/:id?', ProjectController.getProject); //:id? con el ? le digo q va ser opcional el id 
router.get('/projects', ProjectController.getProjects);
router.put('/project/:id', ProjectController.updateProject); //.put porqe esta http funciona para la actualizacion de recursos
router.delete('/project/:id', ProjectController.deleteProject);
//para mandar la imagen del postman elegir el body y form-data
router.post('/upload-image/:id', multipartMiddleware, ProjectController.uploadImage); //multipartMiddleware esto lo tengo q aplicar aca antes de lamar a la accion esta ProjectController.uploadImage como todo midelware funciona antes q la accion
router.get('/get-image/:image', ProjectController.getImageFile);

module.exports = router; //para poder importarlo con un reqired