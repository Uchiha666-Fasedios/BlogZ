'use strict'

var Project = require('../models/project'); //me traigo el modelo LOS REQIRED LOS PUEDO HACER PORQE SE AGREGO module.exports EN LOS ARCHIVOS de donde los llamo
var fs = require('fs'); //libreria para archivos
var path = require('path'); //modulo de nodejs para cargar rutas fisicas de nuestro sistema de archivo

var controller = {

    home: function(req, res) { //req lo q le puedo estar enviando desde el cliente o la peticion q yo haga y res es la response q yo estoy enviando
        return res.status(200).send({ //status(200) q si es una respuesta exitosa send para enviar los datos
            message: 'Soy la home'
        });
    },

    test: function(req, res) { //res es la response q yo estoy enviando
        return res.status(200).send({
            message: "Soy el metodo o accion test del controlador de project"
        });
    },


    saveProject: function(req, res) {
        var project = new Project(); //instancio el objeto q tiene el modelo

        var params = req.body; //req lo q le puedo estar enviando desde el cliente o la peticion q yo haga req.body lo q llega del body de la peticion 
        project.name = params.name; //guardo lo q viene del body a la propiedad del modelo
        project.description = params.description;
        project.category = params.category;
        project.year = params.year;
        project.langs = params.langs;
        project.image = null;

        project.save((err, projectStored) => { //project.save guarda a la base de datos
            if (err) return res.status(500).send({ message: 'Error al guardar el documento.' }); //res es la response q yo estoy enviando

            if (!projectStored) return res.status(404).send({ message: 'No se ha podido guardar el proyecto.' });
            //return res.status(200).send({
            //project: project,
            //message: 'metodo saveProject'
            //})
            return res.status(200).send({ project: projectStored }); //y esto me retorna el objeto guardado
        });
    },



    getProject: function(req, res) { //req lo q le puedo estar enviando desde el cliente o la peticion q yo haga
        var projectId = req.params.id; //params porqe en la url le pongo :id y .id porqe el parametro se llama id
        //esta condicion es por si no le paso el id por la url
        if (projectId == null) return res.status(404).send({ message: 'El proyecto no existe.' }); //res es la response q yo estoy enviando send para enviar los datos

        Project.findById(projectId, (err, project) => { //findByIdbuscame un objeto cuyo id sea y conlleva dos parametros
            // projectId 1er parametro y (err, project) => segundo parametro q tiene err y project q es el objeto del modelo y una funcion de kalback

            if (err) return res.status(500).send({ message: 'Error al devolver los datos.' }); //res es la response q yo estoy enviando send para enviar los datos

            if (!project) return res.status(404).send({ message: 'El proyecto no existe.' });

            return res.status(200).send({
                project
            });

        });
    },




    getProjects: function(req, res) {
        //find me saca todos los documentos q hay de Project
        //y si le pondria asi Project.find({year:2020})cuando encuentre con 2020
        Project.find({}).sort('-year').exec((err, projects) => { //.sort('-year') los ordeno de mayor a menor .exec cuando ya nos saqe los resultados va dar una funcion de kalback y nos da o un err o projects todos los proyectos una array de objetos


            if (err) return res.status(500).send({ message: 'Error al devolver los datos.' });

            if (!projects) return res.status(404).send({ message: 'No hay projectos que mostrar.' });

            return res.status(200).send({ projects }); //devuelvo una array de todos los proyectos
        });

    },


    updateProject: function(req, res) { //req lo q le puedo estar enviando desde el cliente o la peticion q yo haga
        var projectId = req.params.id; //params porqe en la url le pongo :id y .id porqe el parametro se llama id
        var update = req.body; //recoge todo lo del body 
        //findByIdAndUpdate actualiza el documento atraves del id hay mas metodos mirar documentacion de MongoDB
        Project.findByIdAndUpdate(projectId, update, { new: true }, (err, projectUpdated) => { //{ new: true } con este parametro hace q cuando se actualiza me muestre el nuevo producto si no me muestra el antiguo
            if (err) return res.status(500).send({ message: 'Error al actualizar' });

            if (!projectUpdated) return res.status(404).send({ message: 'No existe el proyecto para actualizar' });

            return res.status(200).send({
                project: projectUpdated
            });
        });

    },


    deleteProject: function(req, res) {
        var projectId = req.params.id;

        Project.findByIdAndRemove(projectId, (err, projectRemoved) => { //findByIdAndRemove elimina
            if (err) return res.status(500).send({ message: 'No se ha podido borrar el proyecto' });

            if (!projectRemoved) return res.status(404).send({ message: "No se puede eliminar ese proyecto." });

            return res.status(200).send({
                project: projectRemoved
            });
        });
    },

    //para mandar la imagen del postman elegir el body y form-data
    uploadImage: function(req, res) {
        var projectId = req.params.id; //id del proyecto donde se va a guardar la imagen
        var fileName = 'Imagen no subida...';

        if (req.files) { //si lo q me llega es un archivo
            var filePath = req.files.image.path; //agarro el path de la imagen q tiene la direccion donde se guardo y la imagen
            var fileSplit = filePath.split('/'); //aca recorta la parte y agarra desde \\ o sea tomo el nombre con la extencion
            var fileName = fileSplit[1]; //fileSplit[1] agarra el nombre del archivo de la imagen
            var extSplit = fileName.split('\.'); //split identifica caracteres o caracteres para usar en la separación de la cadena. 
            var fileExt = extSplit[1]; //agarra la extencion

            if (fileExt == 'png' || fileExt == 'jpg' || fileExt == 'jpeg' || fileExt == 'gif') {

                Project.findByIdAndUpdate(projectId, { image: fileName }, { new: true }, (err, projectUpdated) => { //findByIdAndUpdate actualiza el documento atraves del id //{ new: true } con este parametro hace q cuando se actualiza me muestre el nuevo producto si no me muestra el antiguo
                    if (err) return res.status(500).send({ message: 'La imagen no se ha subido' });

                    if (!projectUpdated) return res.status(404).send({ message: 'El proyecto no existe y no se ha asignado la imagen' });

                    return res.status(200).send({
                        project: projectUpdated // todo bien y retorna el objeto con todos sus valores
                    });
                });

            } else {
                fs.unlink(filePath, (err) => { //fs objeto q tiene la libreria q borra archivo unlink funcion q la borra
                    return res.status(200).send({ message: 'La extensión no es válida' });
                });
            }

        } else {
            return res.status(200).send({
                message: fileName //devuelvo el nombre del archivo
            });
        }

    },







    getImageFile: function(req, res) {
        var file = req.params.image; //params porqe en la url le pongo :image y .image porqe el parametro se llama image
        var path_file = './uploads/' + file; //guardo en la variable esto ./uploads/ concatenando la imagen
        //(exists) si existe
        fs.exists(path_file, (exists) => { //fs objeto q tiene la libreria de archivos exists Comprueba asincrónicamente si la ruta dada existe o no, verificando con el sistema de archivos path_file la ruta dada
            //(exists) si es true 
            if (exists) {
                //res es la response q yo estoy enviando
                return res.sendFile(path.resolve(path_file)); //sendFile existe dentro de express path la libreria q carge arriba y llamo al metodo resolve q me resuelve una ruta y me saca el fichero path_file
            } else {
                return res.status(200).send({ //status(200) q si es una respuesta exitosa send para enviar los datos
                    message: "No existe la imagen..."
                });
            }
        });
    }

};

module.exports = controller; //para poder importarlo con un reqired