<div class="modal fade" id="ventanaModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">php</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
    
  <div style="color: rgb(252, 122, 96);">
    muestro en pantalla  </div> 
 
 echo 'Hola Mundo con PHP 7';   <br>

 < ?="Bienvenido a PHP"? > <br>

echo "< ul>"<br>
				 ."< li>GTA< /li>"<br>
				 ."< li>Fifa< /li>"<br>
				 ."< li>Mario Bros< /li>"<br>
				 ."</ ul>"; <br>

           echo '< p>Esta es toda'.' - '.'lista de juegos < /p>'; <br>
           <div  style="color: rgb(252, 122, 96);"> variables </div>  

   $variable = "Hola php"; <br>
  $verdadero = true; <br>
  $numero1= 35; <br>
  $numero2= 35.8; <br>
  // Cambiar tipo de dato <br>
	$numero = (int)$_GET['numero']; <br>
<div  style="color: rgb(252, 122, 96);"> constantes </div>

define('nombre', 'Adrian Lisciotti'); <br>
echo '< h1>'.nombre.'< /h1>'; <br>


<div  style="color: rgb(252, 122, 96);"> Operadores </div>

echo 'Suma: '.($numero1+$numero2);<br/>
$numero1++; <br>
++$numero1; <br>


==  igual
=== identico
!=  diferente
<>  diferente
!== no identico
<   menor que
>   mayor que
<= menor o igual que
>= mayor o igual que <br>

&&  AND <div  style="color: rgb(252, 122, 96);">Y</div> <br>
||  OR  <div  style="color: rgb(252, 122, 96);">O</div> <br>
!   NOT <div  style="color: rgb(252, 122, 96);">NO</div> <br>
and, or <br>

<div  style="color: rgb(252, 122, 96);"> Superglobales </div>
echo $_SERVER['SERVER_ADDR']; me saca la direccion ip <br>
echo $_SERVER['SERVER_NAME']; me saca el nombre de dominio <br>
echo $_SERVER['SERVER_SOFTWARE']; <br>
echo $_SERVER['HTTP_USER_AGENT']; <br>
echo $_SERVER['REMOTE_ADDR']; la ip de mi cliente si accedo a su pc <br>


<div  style="color: rgb(252, 122, 96);"> Condicionales </div>

if($dia == 1){ <br>
	echo "lunes"; <br>
}elseif($dia == 2){<br>
	echo "martes";<br>
}else{<br>
	echo "Es finde";<br>
}<br>

// SWITCH <br>
$dia = 1;<br>

switch ($dia){<br>
	case 1:<br>
		echo "lunes";<br>
		break;<br>
	case 2:<br>
		echo "martes";<br>
		break;<br>
	default:<br>
		echo "es fin de semana";<br>
}<br>

// GOTO <br>
goto ejecuta_aqui;//salta el codigo <br>

if($edad_oficial >= $edad1 && $edad_oficial <= $edad2){ <br>
	echo "esta en edad de trabajar";<br>
}else{<br>
	echo "no puede trabajar";<br>
}<br>

ejecuta_aqui: <br>
echo "Me he saltado el condicional"; <br>

<div  style="color: rgb(252, 122, 96);"> Bucles </div>
$numero = 0; <br>

while($numero <= 100){<br>
	echo $numero;<br>
	
	$numero++;<br>
}<br>

$edad = 17; <br>
$contador = 1; <br>

do{<br>
	echo "Tienes acceso al local privado $contador <br/>";
	$contador++;<br>
}while($edad >= 18 && $contador <= 10);<br>


for($i = 0; $i <= 100; $i++){ <br>
	$resultado += $i; <br>
	echo "$resultado"; <br>
} <br>

<div  style="color: rgb(252, 122, 96);"> Funciones </div>
function getNombre($nombre){ <br>
	$texto = "El nombre es: $nombre"; <br>
	return $texto; <br>
} <br>

predefinidas <br>

var_dump($nombre); <br>
echo date('d-m-Y'); <br>
echo time(); <br>
echo "Raiz cuadrada de 10: ".sqrt(10);<br>
echo "Número aleatorio entre 10 y 40: ".rand(10,40);<br>
echo "Número pi: ".pi();<br>
echo "Redondear: ".round(7.891234, 1);<br>
echo gettype($nombre);<br>
if(is_string($nombre)){<br>
if(!is_float($nombre)){<br>
if(isset($nombre)){<br>
var_dump(trim($frase)); limpia espacios<br>
if(empty(trim($texto))){ si esta vacia<br>

  <div  style="color: rgb(252, 122, 96);"> Include </div>
  include 'includes/cabecera.php'; <br>

  <div  style="color: rgb(252, 122, 96);"> Array </div>
  $cantantes = ['2pac', 'Drake', 'Jennifer Lopez', 'Alfredo']; <br>
  $peliculas = array('Batman', 'Spiderman', 'El señor de los anillos');
$numeros = [1,2,5,8,3,4]; <br>

sort($numeros); // Ordenar<br>
echo sizeof($cantantes); // Contar numero de elementos <br>


// Array asociativo<br>
$personas = array(<br>
	'nombre' => 'Adrian',<br>
	'apellidos' => 'Lisciotti',<br>
	'web' => 'adrianweb.live'<br>
);
<br>
echo $personas['apellidos'];<br>

<div  style="color: rgb(252, 122, 96);"> Recorrer array </div>


for($i = 0; $i < count($peliculas); $i++){<br>
	echo "< li>".$peliculas[$i]."< /li>";<br>
}<br>

foreach ($cantantes as $cantante) {<br>
	echo "< li>".$cantante."< /li>";<br>
}<br>


// Arrays multidimensionales<br>

$contactos = array(<br>
	array(<br>
		'nombre' => 'Antonio',<br>
		'email' => 'antonio@antonio.com'<br>
	),<br>
	array(<br>
		'nombre' => 'Luis',<br>
		'email' => 'luis@luis.com'<br>
	),<br>
	array(<br>
		'nombre' => 'Salvador',<br>
		'email' => 'salva@salva.com'<br>
	)<br>
);<br>

foreach ($contactos as $key => $contacto) {<br>
	var_dump($contacto['nombre']);<br>
} <br>

<div  style="color: rgb(252, 122, 96);">Session </div>
// Iniciar la sesión<br>
session_start();<br>
// Variable de sesión<br>
$_SESSION['variable_persistente'] = "HOLA SOY UNA SESION ACTIVA";<br>

// Cierro la sesión<br>
session_destroy(); <br>

// Cookie básica<br>
setcookie("micookie", "valor de mi galleta");<br>

// Cookie con expiración<br>
setcookie("unyear", "valor de mi cookie de 365 dias", time()+(60*60*24*365));<br>

header('Location:ver_cookies.php');<br>

//boorar cookies <br>
if($_COOKIE['micookie']){<br>
	unset($_COOKIE['micookie']);<br>
	setcookie('micookie','',time()-100);<br>
}<br>

<div  style="color: rgb(252, 122, 96);">Validacion </div>

< ?php
$error = 'faltan_valores'; <br>

if(!empty($_POST['nombre']) && !empty($_POST['apellidos']) && <br>
   !empty($_POST['edad']) && !empty($_POST['email']) && !empty($_POST['pass'])){<br>
	$error = 'ok';<br>

	$nombre = $_POST['nombre'];<br>
	$apellidos = $_POST['apellidos'];<br>
	$edad = (int) $_POST['edad'];<br>
	$email = $_POST['email'];<br>
	$pass = $_POST['pass'];<br>

	
	if(!is_string($nombre) || preg_match("/[0-9]/", $nombre)){<br>
		$error = 'nombre';<br>
	}<br>

	if(!is_string($apellidos) || preg_match("/[0-9]/", $apellidos)){<br>
		$error = 'apellidos';<br>
	}<br>

	if(!is_int($edad) || !filter_var($edad, FILTER_VALIDATE_INT)){//filter_var le digo q me valide la edad como FILTER_VALIDATE_INT entero<br>
		$error = 'edad';<br>
	}<br>

	if(!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){<br>
		$error = 'email';<br>
	}<br>

	if(empty($pass) || strlen($pass)<5){<br>
		$error = 'password';<br>
	}<br>

	
	 

}else{<br>
	$error = 'faltan_valores';<br>
}<br>


if($error != 'ok'){<br>
	header("Location:index.php?error=$error");<br>
}<br>
?><br>

	< /head><br>
	< body><br>
		< ?php if($error == 'ok'): ?><br>
		< h1>Datos validados correctamente</><br>
			< p>< ?=$nombre?></><br>
			< p>< ?=$apellidos?></><br>
			< p>< ?=$edad?></><br>
			< p>< ?=$email?>< /p><br>
		< ?php endif; ?><br>
	< /body><br>
< /html><br>


<div  style="color: rgb(252, 122, 96);">Ficheros </div>

// Abrir archivo
$archivo = fopen("fichero_texto.txt", "f");//fichero_texto el nombre a+ el modo en q voy a abrir <br>
$archivo = fopen("fichero_texto.txt", "a+");//fichero_texto el nombre a+ el modo en q voy a abrir<br>

// Leer contenido<br>
while(!feof($archivo)){//feof recorre todas las lineas del archivo<br>
	$contenido = fgets($archivo);//fgets muestra el archivo<br>
	echo $contenido."< br/>";
}<br>

// Escribir<br>
fwrite($archivo, "***Soy un texto metido desde php***");<br>

// Cerrar archivo<br>
fclose($archivo);<br>

 

// Copiar<br>
//copy('fichero_texto.txt', 'fichero_copiado.txt') or die("Error al copiar");copy es copiar el fichero o sea crea un nuevo fichero con el mismo contenido or die si no pudo me muestre el mensaje de error<br>


// Renombrar<br>
//rename('fichero_copiado.txt', 'archivito_recopiadito.txt');rename le cambia el nombre al fichero<br>

// Eliminar<br>
//unlink('archivito_recopiadito.txt') or die('Error al borrar');//unlink elimina el fichero or die si ay un error muestra el mensaje<br>

//DIRECTORIOS <br>
< ?php<br>
if(!is_dir('mi_carpeta')){//!is_dir si no existe la carpeta<br>
	mkdir('mi_carpeta', 0777) or die('No se puede crear la carpeta');//mkdir crea el directorio mi_carpeta es el nombre 0777 son los permisos or die si falla muestra el mensaje<br>
}else{<br>
	echo "Ya existe la carpeta";<br>
}<br>

// rmdir('mi_carpeta');rmdir borra la carpeta<br>
echo "< hr> < h1>Contenido carpeta< /h1>";<br>
if($gestor = opendir('./mi_carpeta')){//opendir abre la carpeta estoy ingresando la carpeta en la variable<br>
	while(false !== ($archivo = readdir($gestor))){//mientras q false sea distinto a leer (readdir es leer) o sea mientras q haya archivos<br>
		if($archivo != '.' && $archivo != '..'){//si el archivo es distinto a . y a .. lo muestre<br>
			echo $archivo."< br/>";<br>
		}<br>
	}<br>
}<br>



<div  style="color: rgb(252, 122, 96);">Subir imagenes </div>
//EN EL INDEX <br>
		
		< form action="upload.php" method="POST" enctype="multipart/form-data"><br>
			< input type="file" name="archivo" /><br>
			< input type="submit" value="Enviar" /><br>
		</><br>

		Listado de imagenes<br>
		< ?php<br>
			$gestor = opendir('./images');//opendir abro el directorio<br>

			if($gestor)://si es true<br>
				while(($image = readdir($gestor)) !== false)://si mientras leer el archivo es diferente a false significa q hay<br>
					if($image != '.' && $image != '..')://si el archivo es diferente a . y a ..<br>
						echo "< img src='images/$image' width='200px'/>< br/>";//muestro la imagen<br>
					endif;<br>
				endwhile;<br>
			endif;<br>
		?><br>
	< /body><br>


//EN EL UPLOAD.PHP <br>
	
	< ?php<br>

$archivo = $_FILES['archivo'];//ingreso la imagen a la variable<br>
$nombre = $archivo['name'];//nombre de la imagen<br>
$tipo = $archivo['type'];//el tipo de la imagen<br>

if($tipo == "image/jpg" || $tipo == "image/jpeg" || $tipo == "image/png" || $tipo == "image/gif"){//si el tipo es de tal extencion<br>

	if(!is_dir('images')){//si no existe el directorio<br>
		mkdir('images', 0777);//lo creo 0777 todos los permisos posibles<br>
	}<br>

	move_uploaded_file($archivo['tmp_name'], 'images/'.$nombre);//move_uploaded_file coge la imagen q esta en un archivo temporal y muevelo donde quieras. $archivo['tmp_name'] archivo temporal<br>
	//images/ direccion donde lo guardo $nombre es el nombre q quiero q tenga la imagen<br>

	header("Refresh: 5; URL=index.php");//esto me redirige a index despues de 5 segundos<br>
	echo "Imagen subida correctamente";<br>

}else{<br>
	header("Refresh: 5; URL=index.php");//esto me redirige a index despues de 5 segundos<br>
	echo "Sube una imagen con un formato correcto, por favor...";<br>
} <br>



      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>