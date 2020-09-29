//todo esto se copio de una pagina se cambiaron pocas cosas
var articulos = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  // `states` is an array of state names defined in "The Basics"
  prefetch: '/buscador-predictivo' 
  
});

$('#buscador-predictivo').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'articulos',
  source: articulos
});






