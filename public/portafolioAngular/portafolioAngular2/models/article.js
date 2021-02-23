'use strict'

var mongoose = require('mongoose');//cargo mongoose
var Schema = mongoose.Schema;//creo esta variable para utilizar esta variable Schema de typo mongoose

var ArticleSchema = Schema({
    title: String,
    content: String,
    date: { type: Date, default: Date.now },//default: Date.now por defecto guarda fecha actual
    image: String
});

module.exports = mongoose.model('Article', ArticleSchema);//Article nombre de modelo y va ser de typo ArticleSchema
// articles --> guarda documentos de este tipo y con estructura dentro de la colección
