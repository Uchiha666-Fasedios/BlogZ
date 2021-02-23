'use strict'

var validator = require('validator'); //libreria de validacion
var fs = require('fs'); //libreria para archivos
var path = require('path'); //modulo de nodejs para cargar rutas fisicas de nuestro sistema de archivo

var Article = require('../models/article'); //traemos el modelo para usarlo en los metodos

var controller = {
    //ARMO Y DEVUELVO EL JSON Q YO QUIERO
    datosCurso: (req, res) => {
        var hola = req.body.hola;

        return res.status(200).send({
            curso: 'Master en Frameworks JS',
            autor: 'Víctor Robles WEB',
            url: 'victorroblesweb.es',
            hola
        });
    },

    test: (req, res) => {
        return res.status(200).send({
            message: 'Soy la acción test de mi controlador de articulos'
        });
    },

    //si salvo y no cree la base de datos se crea sola con el nombre q le puse en el index
    save: (req, res) => {
        // Recoger parametros por post
        var params = req.body; //body los parametros q me llega al body

        // Validar datos (validator)
        try {
            var validate_title = !validator.isEmpty(params.title); //si es diferente a vacio entonces da TRUE
            var validate_content = !validator.isEmpty(params.content); //si es diferente a vacio entonces da TRUE

        } catch (err) { //da false
            return res.status(200).send({
                status: 'error', //cuando da error le ponemos status error
                message: 'Faltan datos por enviar !!!'
            });
        }

        if (validate_title && validate_content) { //si da true

            //Crear el objeto a guardar
            var article = new Article(); //instanciamos el modelo

            // Asignar valores
            article.title = params.title; //lo q me llega como title le guardamos al objeto
            article.content = params.content;

            if (params.image) { //si ay imagen la cargo en el objeto
                article.image = params.image;
            } else { //si no
                article.image = null;
            }

            // Guardar el articulo
            article.save((err, articleStored) => { //.save este metodo salva

                if (err || !articleStored) { //si ay error o la respuesta es false 
                    return res.status(404).send({
                        status: 'error',
                        message: 'El articulo no se ha guardado !!!'
                    });
                }

                // Devolver una respuesta 
                return res.status(200).send({ //respuesta positiva
                    status: 'success', //le pongo a status success
                    article: articleStored //y a article lo q me llego
                });

            });

        } else {
            return res.status(200).send({
                status: 'error',
                message: 'Los datos no son válidos !!!'
            });
        }

    },

    getArticles: (req, res) => {

        var query = Article.find({}); //({}) le podemos poner una condicion cuando tal cosa pase etc.. pero lo dejo vacio porqe quiero todo

        var last = req.params.last; //req es lo q me viene params.last el parametro llamado last
        if (last || last != undefined) { //si da true o diferente a undefined
            query.limit(5); //le ponemos un limite de 5
        }

        // Find
        query.sort('-_id').exec((err, articles) => { //.exec ejecuta una busqueda sobre las coincidencias de una expresión regular en una cadena especifica
            //sort('-_id') ordena los elementos de unarreglo por id
            if (err) {
                return res.status(500).send({
                    status: 'error',
                    message: 'Error al devolver los articulos !!!'
                });
            }

            if (!articles) {
                return res.status(404).send({
                    status: 'error',
                    message: 'No hay articulos para mostrar !!!'
                });
            }
            //respuesta positiva
            return res.status(200).send({
                status: 'success',
                articles
            });

        });
    },

    getArticle: (req, res) => {

        // Recoger el id de la url
        var articleId = req.params.id;

        // Comprobar que existe
        if (!articleId || articleId == null) {
            return res.status(404).send({
                status: 'error',
                message: 'No existe el articulo !!!'
            });
        }

        // Buscar el articulo
        Article.findById(articleId, (err, article) => { //findById busca los datos con id articleId

            if (err || !article) {
                return res.status(404).send({
                    status: 'error',
                    message: 'No existe el articulo !!!'
                });
            }

            // Devolverlo en json
            return res.status(200).send({
                status: 'success',
                article
            });

        });
    },

    update: (req, res) => {
        // Recoger el id del articulo por la url
        var articleId = req.params.id;

        // Recoger los datos que llegan por put
        var params = req.body;

        // Validar datos
        try {
            var validate_title = !validator.isEmpty(params.title); //si son diferentes a vacio da true
            var validate_content = !validator.isEmpty(params.content);
        } catch (err) {
            return res.status(200).send({
                status: 'error',
                message: 'Faltan datos por enviar !!!'
            });
        }

        if (validate_title && validate_content) { //si es true
            // Find and update
            //findByIdAndUpdate actualiza el documento atraves del id hay mas metodos mirar documentacion de MongoDB
            Article.findOneAndUpdate({ _id: articleId }, params, { new: true }, (err, articleUpdated) => { //{ new: true } con este parametro hace q cuando se actualiza me muestre el nuevo producto si no me muestra el antiguo
                //(err, articleUpdated) si da un error o un resultado
                if (err) {
                    return res.status(500).send({
                        status: 'error',
                        message: 'Error al actualizar !!!'
                    });
                }

                if (!articleUpdated) {
                    return res.status(404).send({
                        status: 'error',
                        message: 'No existe el articulo !!!'
                    });
                }

                return res.status(200).send({
                    status: 'success',
                    article: articleUpdated
                });
            });
        } else {
            // Devolver respuesta
            return res.status(200).send({
                status: 'error',
                message: 'La validación no es correcta !!!'
            });
        }

    },

    delete: (req, res) => {
        // Recoger el id de la url
        var articleId = req.params.id;

        // Find and delete
        Article.findOneAndDelete({ _id: articleId }, (err, articleRemoved) => {
            if (err) {
                return res.status(500).send({
                    status: 'error',
                    message: 'Error al borrar !!!'
                });
            }

            if (!articleRemoved) {
                return res.status(404).send({
                    status: 'error',
                    message: 'No se ha borrado el articulo, posiblemente no exista !!!'
                });
            }

            return res.status(200).send({
                status: 'success',
                article: articleRemoved
            });

        });
    },

    upload: (req, res) => {
        // Configurar el modulo connect multiparty router/article.js (hecho)

        // Recoger el fichero de la petición
        var file_name = 'Imagen no subida...';

        if (!req.files) { //files es un archivo si lo q llega no es un archivo
            return res.status(404).send({
                status: 'error',
                message: file_name
            });
        }

        // Conseguir nombre y la extensión del archivo
        var file_path = req.files.file0.path; //file0 es el nombre del campo q puse en la tabla es mas recomendable q poner image ..path es toda la ubicacion desde la carpeta upload
        var file_split = file_path.split('/'); //aca recorta la parte y agarra desde \\ o sea tomo el nombre con la extencion

        // * ADVERTENCIA * EN LINUX O MAC
        // var file_split = file_path.split('/');

        // Nombre del archivo
        var file_name = file_split[2]; //fileSplit[2] agarra el nombre del archivo de la imagen

        // Extensión del fichero
        var extension_split = file_name.split('\.'); //split identifica caracteres o caracteres para usar en la separación de la cadena.
        var file_ext = extension_split[1]; //agarra la extencion

        // Comprobar la extension, solo imagenes, si es valida borrar el fichero
        if (file_ext != 'png' && file_ext != 'jpg' && file_ext != 'jpeg' && file_ext != 'gif') {

            // borrar el archivo subido
            fs.unlink(file_path, (err) => {
                return res.status(200).send({
                    status: 'error',
                    message: 'La extensión de la imagen no es válida !!!'
                });
            });

        } else {
            // Si todo es valido, sacando id de la url
            var articleId = req.params.id;

            if (articleId) {
                // Buscar el articulo, asignarle el nombre de la imagen y actualizarlo
                Article.findOneAndUpdate({ _id: articleId }, { image: file_name }, { new: true }, (err, articleUpdated) => {

                    if (err || !articleUpdated) {
                        return res.status(200).send({
                            status: 'error',
                            message: 'Error al guardar la imagen de articulo !!!'
                        });
                    }

                    return res.status(200).send({
                        status: 'success',
                        article: articleUpdated
                    });
                });
            } else {
                return res.status(200).send({
                    status: 'success',
                    image: file_name
                });
            }

        }
    }, // end upload file

    getImage: (req, res) => {
        var file = req.params.image;
        var path_file = './upload/articles/' + file;

        fs.exists(path_file, (exists) => {
            if (exists) {
                return res.sendFile(path.resolve(path_file)); //sendFile existe dentro de express path la libreria q carge arriba y llamo al metodo resolve q me resuelve una ruta y me saca el fichero path_file
            } else {
                return res.status(404).send({
                    status: 'error',
                    message: 'La imagen no existe !!!'
                });
            }
        });
    },

    search: (req, res) => {
        // Sacar el string a buscar
        var searchString = req.params.search; //lo q me viene de parametro q se llama search lo guardo

        // Find or
        Article.find({ //le meto condiciones para buscar los datos se utiliza el operador $or de mongodb q es o
                "$or": [
                    { "title": { "$regex": searchString, "$options": "i" } }, //si el searchString esta incluido dentro de title
                    { "content": { "$regex": searchString, "$options": "i" } } //o dentro del content
                ]
            })
            .sort([ //q lo ordene por fecha y de manera decsendente 
                ['date', 'descending']
            ])
            .exec((err, articles) => { //.exec q esta enganchado con el short significa q cuando ya nos saqe los resultados va dar una funcion de kalback y nos da o un err o projects todos los proyectos una array de objetos

                if (err) {
                    return res.status(500).send({
                        status: 'error',
                        message: 'Error en la petición !!!'
                    });
                }

                if (!articles || articles.length <= 0) {
                    return res.status(404).send({
                        status: 'error',
                        message: 'No hay articulos que coincidan con tu busqueda !!!'
                    });
                }

                return res.status(200).send({
                    status: 'success',
                    articles
                });

            });
    }

}; // end controller

module.exports = controller;