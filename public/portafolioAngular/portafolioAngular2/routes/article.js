'use strict'
//express nos va permitir tener un sistema de rutas y hacer peticiones http
var express = require('express'); //cargo el modulo para poder tener el objeto y trabajar con el
var ArticleController = require('../controllers/article'); //cargo etsto q tiene todos los metodos de salvar etc..

var router = express.Router();

//para las imagenes
var multipart = require('connect-multiparty');
var md_upload = multipart({ uploadDir: './upload/articles' }); //uploadDir como propiedad upload/articles carpeta donde se guardan las fotos

// Rutas de prueba
router.post('/datos-curso', ArticleController.datosCurso);
router.get('/test-de-controlador', ArticleController.test);

// Rutas útiles
router.post('/save', ArticleController.save);
router.get('/articles/:last?', ArticleController.getArticles); //?q sea opcional
router.get('/article/:id', ArticleController.getArticle);
router.put('/article/:id', ArticleController.update); //.put se usa para actualizar
router.delete('/article/:id', ArticleController.delete);
router.post('/upload-image/:id?', md_upload, ArticleController.upload); //md_upload midelware 
router.get('/get-image/:image', ArticleController.getImage);
router.get('/search/:search', ArticleController.search);

module.exports = router;