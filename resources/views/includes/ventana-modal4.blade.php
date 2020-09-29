<div class="modal fade" id="ventanaModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">css</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

      <div  style="color: rgb(252, 122, 96);">SELECTORES</div>

      /*<br>
###### SELECTORES ######<br>
*/<br>


/* selector universal */<br>
*{<br>
font-family: Verdana, Tahoma, Geneva sans-serif;<br>


}<br>


/* selector de etiqueta */<br>
h1{<br>
background: red;<br>
color: white;/*color a la letra*/<br>
padding: 10px;/*para q se separe de los bordes*/<br>

}<br>
a{<br>

  font-size: 18px;/*tamaño de letra*/<br>
  color: green;/*color a la letra*/<br>
  text-decoration: none;/*le quita la linea a los enlaces*/<br>
}<br>

footer a{<br>
color: red;/*color a la letra*/<br>


}<br>

/* selector de id identificador */<br>
#descripcion,<br>
#titulo<br>
{<br>

  border: 5px solid black;<br>
  padding: 15px;/*para q se separe de los bordes*/<br>
}<br>

#titulo{<br>
background: blue;<br>
border: 2px dashed white;<br>
}<br>

/* selector de clase */<br>
.parrafo{<br>
font-style: italic;<br>
/*text-decoration: underline;*/<br>
font-weight: bold;/*el grosor de la letra*/<br>
}<br>

.parrafo1 , .parrafo3{<br>
  background-color: green;<br>
  color: white;/*color a la letra*/<br>
  padding: 10px;<br>
}<br>

.parrafo3 {<br>
  background-color: orange;<br>
  color: black;/*color a la letra*/<br>
}<br>

/* selector de atributo */<br>


#usuario form {<br>

border: 5px solid blue;<br>
margin-top: 15px;<br>
margin-bottom: 15px;/*le da el espacio entre los elementos y el margen*/<br>
padding: 20px;/*para q se separe de los bordes*/<br>
}<br>

#usuario form *{<br>

  display: block;/*cada elemento va a estar en una linea para el solo*/<br>
}<br>


input[type="text"]{<br>
margin-bottom: 15px;/*le da el espacio entre cada elemento*/<br>
padding: 10px;/*el alto de la caja del input*/<br>
width: 300px;/*el ancho del input*/<br>

}<br>

input[type="submit"]{<br>
background: green;/*el color del input*/<br>
color: white;/*el color de la letra*/<br>
padding: 15px;/*el alto de la caja del input*/<br>
font-size: 15px;/*tamaño de letra*/<br>
text-transform: uppercase;/*transforma en mayuscula al texto*/<br>
border: 1px solid black;/*cambia el borde a color negro*/<br>
cursor: pointer;/*cuando pasa el mouse se transforma en una manito*/<br>
}<br>


/*selector hijo*/<br>

#menu > li > a{/* del menu despues de li despues del otro ul a los a*/<br>

  font-size: 18px;<br>
  color: red;/*color a la letra*/<br>
  text-decoration: none;/*le quita la linea a los enlaces*/<br>

}<br>

/*prioridad*/<br>
/* css le da prioridad al ultimo pero si por ejemplo se pone un id css le da prioridad al id premia a lo mas especifico*/<br>
/*pero si le pongo !important vale sobre todo*/<br>
#saludo h1{<br>
  background: brown;<br>
}<br>

h1{<br>
  background: purple !important;<br>
}<br>



<div  style="color: rgb(252, 122, 96);">FUENTES</div>

/*importar una fuente de https://fonts.google.com una vez hayamos descargado el zip lo colocamos en nuestro proyecto y aca<br>
ponemos esto @font-face q es una propiedad de css3*/<br>
@font-face {<br>
font-family: MonserratFuenteCustom;/*colocamos el nombre de la fuente inventado por mi */<br>
src: url(../fonts/Montserrat/Montserrat-Regular.ttf);/*colocamos la direccion donde esta la fuente*/<br>
}<br>
@font-face {<br>
font-family: MansalvaFuenteCustom;/*colocamos el nombre de la fuente inventado por mi */<br>
src: url(../fonts/Mansalva/Mansalva-Regular.ttf);/*colocamos la direccion donde esta la fuente*/<br>
}<br>




h1{<br>
  font-family: Arial,Helvetica,sans-serif;<br>
  font-style: italic;/*como quiero q sea la letra italic en curciva en este caso*/<br>
  font-family: 'Mansalva', cursive;/*la fuente es de https://fonts.google.com este es un ejemplo cuando no descargo la fuente el link esta en el head del index para llamarla desde la pagina*/<br>
text-transform: uppercase;/*transforma en mayuscula al texto*/<br>
font-size: 45px;<br>

/*Colores*/<br>
/* ACA LOS PODEMOS ENCONTRAR https://www.w3schools.com/cssref/css_colors.asp*/<br>

/*Colores del sistema*/<br>


color:mediumpurple;<br>
/*color: transparent;/*transparente*/<br>




/*Colores hexadecimales*/<br>

color: #000000;/*negro*/<br>
/*color: #cccccc;/*gris claro*/<br>
/*color: #ffffff;/*blanco*/<br>
/*color: #eeeeee;/*gris clarito*/<br>



/*Colores RGB (la mezcla de 3 colores)*/<br>
/* para generar un color de estos ir a https://www.css3maker.com/css-3-rgba.html<br>
copiar el codigo el primero background-color: rgba(166, 96, 97, 0.6); y sacarle el background- y el ultimo parametro 0.6 y la a */<br>
color: rgb(188, 255, 80);<br>



/*Colores RGBA (la mezcla de 3 colores y poner una opacidad)*/<br>

color: rgba(188, 255, 80, 0.8);<br>




}<br>

h3<br>
{<br>
  font-family: MonserratFuenteCustom, "Comic Sans MS";/*aca ponemos el nombre de la fuente creada con @font-face y si no va agarra "Comic Sans MS"*/<br>
  font-size: 30px;/*tamaño de letra*/<br>
  font-weight: lighter;/*el grosor de la letra*/<br>
  color: olive;<br>
}<br>

p{<br>

font-family: MansalvaFuenteCustom, sans-serif;<br>
font-size: 18px;<br>
font-weight: bold;/*el grosor de la letra*/<br>

}<br>




<div  style="color: rgb(252, 122, 96);">FONDO</div>

body{<br>
  background-color:#ccc;<br>
  background-image: url(../img/fondo1.jpg);<br>
  background-repeat: repeat;/*me repite q es el q esta por defecto<br>
  background-repeat: no-repeat me muestra una vez despues esta<br> 
  background-repeat: repeat-y; es en vertical y x en horizontal*/<br>
  /*background-size: 100%; /*me extiende la imagen al 100 esta sirve mas q nada para<br>
  imagenes grandes por ejemplo buscate una de paisajes en google*/<br>
  background-size: 100% 100%;/*me adapta la imagen a la pantalla */<br>
  color: white;/*texto blanco*/<br>
  background-position: left bottom;/*q me posicione el background a la izqierda y al booton<br>
   o sea a la izqierda y abajo*/<br>
  background-attachment: fixed;/*el texto se mueve pero la imagen no*/<br>
  text-align: justify;/*me pone de forma recta alineada el texto*/<br>
  text-indent: 15px;/*me da una separacion y un salto de linea entre texto y texto */<br>
  word-spacing: 10px;/*me separa entre palabra y palabra*/<br>
  letter-spacing: 5px;/*me separa entre letra y letra*/<br>
}<br>

#caja{<br>

  border: 5px solid black;/*anchura del borde el tipo y el color*/<br>
  padding: 10px;/*para q se separe de los bordes*/<br>
  background-color: rgb(94, 131, 212);/*me pone el fondo de cierto color*/<br>
  color: white;<br>
  font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;<br>
  text-align: center;<br>
  line-height: 20px;/*modifica la altura entre linea y linea */<br>
  text-transform: uppercase;/*transforma en mayuscula al txto*/<br>
  text-decoration: line-through;/*tacha lel texto*/<br>
  text-decoration: underline;/*me subrraya*/<br>
}<br>
/*buscar fondos en el buscador de google pattern background*/<br>

h2{<br>
  color: rgb(13, 13, 59);<br>
  background: white;<br>
  background-image: url(../img/patron3.jpg);<br>
  border: 5px solid red;<br>
  
}<br>


<div  style="color: rgb(252, 122, 96);">CAJAS</div>

* {<br>
    /*asterisco es para toda la pagina*/<br>
    margin: 0px;<br>
    /* margin para q no haya espacios*/<br>
    padding: 0px;<br>
    /*padding para q se separe de los bordes*/<br>
}<br>

body {<br>
    /*para q se separe de los bordes de todo el body*/<br>
    padding: 40px;<br>
}<br>

#cajas {<br>
    /*un ancho maximo de pantalla*/<br>
    max-width: 1035px;<br>
    /*borde tamaño tipo y color*/<br>
    border: 1px solid black;<br>
}<br>

.caja {<br>
    /*se comporta como una caja*/<br>
    display: block;<br>
    /*anchura*/<br>
    width: 250px;<br>
    /*altura*/<br>
    height: 250px;<br>
    background-color: lightblue;<br>
    /*borde tamaño tipo y color*/<br>
    border: 10px solid red;<br>
    /*separa el margen de arriba*/<br>
    margin-top: 15px;<br>
    /*le da el espacio entre los elementos y el margen de la parte de abajo*/<br>
    margin-bottom: 15px;<br>
    /*le da un margen hacia la izquierda*/<br>
    margin-left: 25px;<br>
    /*para q se separe de los bordes un margen interno por todas partes*/<br>
    padding: 20px;<br>
    /*le da un espacio de la parte de abajo de las cajas*/<br>
    padding-bottom: 34px;<br>
    /*FLOTAR LAS CAJAS O SEA MOVERLAS con float q se debe aplicar cuando el display es en block*/<br>
    /*las cajas se moveran a la izquierda*/<br>
    float: left;<br>
    /*las cajas se moveran a la derecha*/<br>
    /*float: right;*/<br>
    /*las cajas se quedan por defecto*/<br>
    /*float: none;*/<br>
}<br>

.caja p {<br>
    /*el grosor de la letra*/<br>
    font-weight: bold;<br>
    /*centra el texto*/<br>
    text-align: center;<br>
    /*tamaño de letra*/<br>
    font-size: 20px;<br>
    /*le estamos dando fuente*/<br>
    font-family: Arial, Helvetica, sans-serif;<br>
    /*modifica la altura entre linea y linea */<br>
    line-height: 250px;<br>
}<br>

.clearfix {<br>
    /*las cajas se quedan por defecto*/<br>
    float: none;<br>
    /*limpia todos los flotados*/<br>
    clear: both;<br>
}<br>


<div  style="color: rgb(252, 122, 96);">PESEUDOCLASES</div>
* {<br>
    font-family: Arial, Helvetica, sans-serif;<br>
}<br>

ul li {<br>
    font-size: 20px;<br>
}<br>


/*pseudoclase me va a poner todo esto en la primera de la lista*/<br>

ul li:first-child {<br>
    /*color de la letra*/<br>
    color: purple;<br>
    /*una fuente mas negrita*/<br>
    font-weight: bold;<br>
}<br>


/*me deja elejir el elemento q quiero poniendo el numero*/<br>

ul li:nth-child(2) {<br>
    /*color de la letra*/<br>
    color: orangered;<br>
    /*una fuente mas negrita*/<br>
    font-weight: bold;<br>
}<br>


/*ultimo elemento*/<br>
<br>
ul li:last-child {<br>
    /*color de la letra*/<br>
    color: gray;<br>
    /*una fuente mas negrita*/<br>
    font-weight: bold;<br>
}<br>

#mi-enlace {<br>
    font-size: 30px;<br>
    color: gray;<br>
}<br>


/*me pone al enlace ese color si no la vicite ala pagina*/<br>

#mi-enlace:link {<br>
    color: red;<br>
}<br>


/*me pone al enlace ese color si ya visite la pagina*/<br>

#mi-enlace:visited {<br>
    color: orangered;<br>
}<br>


/*cuando paso con el raton me lo pone blue*/<br>

#mi-enlace:hover {<br>
    color: blue;<br>
}<br>


/*q mientras presiono el enlace me haga estos cambios*/<br>

#mi-enlace:active {<br>
    color: green;<br>
    /*fuente*/<br>
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;<br>
}<br>

input[type="text"] {<br>
    margin-top: 20px;<br>
    padding: 10px;<br>
}<br>


/*cuando toco en el input me hace estos cambios*/<br>

input[type="text"]:focus {<br>
    border: 4px dashed red;<br>
}<br>

<div  style="color: rgb(252, 122, 96);">ANIMACIONES-TRANSICIONES</div>

#boton {<br>
    /*para q se comorte como bloke o sea se comporta como una caja*/<br>
    display: block;<br>
    padding: 20px;<br>
    background-color: green;<br>
    color: white;<br>
    width: 200px;<br>
    text-align: center;<br>
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;<br>
    font-weight: bold;<br>
    text-decoration: none;<br>
    border: 2px solid rgb(2, 70, 2);<br>
    /*LA TRANSICION HACE Q TARDE 3 SEGUNDOS EN HACER LOS CAMBIOS <br>
    all significa a todo el elemento*/<br>
    /*transition: all 3s;*/<br>
    /*TAMBIEN MILISEGUNDOS SERIA MAS RAPIDO*/<br>
    transition: all 500ms;<br>
    /*aca solo los cambios al borde*/<br>
    transition: border 500ms;<br>
    /*aca cambian las propiedades cuando yo quiera por separado*/<br>
    transition: border 500ms, background 3s, border-radius 1s;<br>
}<br>

#boton:hover {<br>
    border-radius: 15px;<br>
    background: orangered;<br>
    border: 5px solid red;<br>
}<br>

#caja {<br>
    margin-top: 25px;<br>
    width: 250px;<br>
    height: 250px;<br>
    background: lightseagreen;<br>
    color: white;<br>
    border: 5px solid black;<br>
    font-size: 20px;<br>
    text-align: center;<br>
    /*lo aline en vertical*/<br>
    line-height: 200px;<br>
    /*aplico la animacion*/<br>
    animation-name: desplazamiento;<br>
    /*el tiempo de la animacion*/<br>
    animation-duration: 10s;<br>
    /*si la quiero hacer infinita o no*/<br>
    animation-iteration-count: infinite;<br>
    /*hay muchos pero en este caso q vaya a la misma velocidad*/<br>
    animation-timing-function: linear;<br>
}<br><br>


/*PARA HACER UNA ANIMACION PRIMERO DEFINO LOS @keyframes*/<br>


/*MANERA CORTA*/<br>


/*1 le pongo nombre desplazamiento */<br>


/*2 le pongo como empieza y como termina con form y to*/<br>


/*<br>
@keyframes desplazamiento// {<br>
    from //{<br>
        margin-left: 0px;<br>
    }<br>
    to {<br>
        margin-left: 1200px;<br>
    }<br>
}<br>
*/<br>


/*MANERA COMPLETA*/<br>


/*lo desplazo lado a lado a la caja*/<br>

@keyframes desplazamiento {<br>
    0% {<br>
        margin-left: 0px;<br>
    }<br>
    50% {<br>
        margin-left: 1090px;<br>
    }<br>
    100% {<br>
        margin-left: 0px;<br>
    }<br>
}
<br>

/*aca la hago rotar*/<br>

@keyframes desplazamiento {<br>
    0% {<br>
        margin-left: 0px;<br>
        transform: rotate(0deg);<br>
    }<br>
    50% {<br>
        margin-left: 1090px;<br>
        transform: rotate(370deg);<br>
    }<br>
    100% {<br>
        margin-left: 0px;<br>
        transform: rotate(0deg);<br>
    }<br>
}<br>


/*la hago rotar y se va convirtiendo en pelota*/<br>

@keyframes desplazamiento {<br>
    0% {<br>
        margin-left: 0px;<br>
        transform: rotate(0deg);<br>
    }<br>
    50% {<br>
        margin-left: 1090px;<br>
        transform: rotate(370deg);<br>
        border-radius: 999px;<br>
    }<br>
    100% {<br>
        margin-left: 0px;<br>
        transform: rotate(0deg);<br>
    }<br>
}<br>


/*la hago rotar y se va convirtiendo en pelota y cambia de color y cambia el borde*/<br>

@keyframes desplazamiento {<br>
    0% {<br>
        margin-left: 0px;<br>
        transform: rotate(0deg);<br>
    }<br>
    50% {<br>
        margin-left: 1090px;<br>
        transform: rotate(370deg);<br>
        border-radius: 999px;<br>
    }<br>
    75% {<br>
        background: red;<br>
    }<br>
    77% {<br>
        border: 10px dashed blue;<br>
    }<br>
    100% {<br>
        margin-left: 0px;<br>
        transform: rotate(0deg);<br>
    }<br>
}<br>

<div  style="color: rgb(252, 122, 96);">RESPONSIVE</div>
@media(max-width: 880px) {<br>

}<br>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>