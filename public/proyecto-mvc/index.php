
<!--esto q hacemos SE LO LLAMA CONTROLADOR FRONTAL ESTO DE MANDAR POR GET-->


<?php
session_start();
/* require('controllers/UsuarioController.php');
require('controllers/notaController.php');*/
///////////////////TENER ACCESO A TODOS LOS OBJETOS DE LOS CONTROLADORES
require_once('app_autoloader.php');//me ahorro de poner tantos include y carga todos los archivos en este caso de la carpeta controllers
require_once('config/db.php');
//////////////////////////
require_once('config/parameters.php');//traigo constantes q tiene la ruta base etc..
require_once('helpers/utils.php');//metodos tipicos q se usan si esta identificado si es admi etc..
require_once('views/layout/header.php');
require_once('views/layout/sidebar.php');



function show_error(){
  $error = new ErrorController();//instanciamos la clase
  $error->index();//mostramos la funcion q muestra un mensaje de error
}

//COMPRUEBO SI ME LLEGA EL CONTROLADOR POR LA URL
if (isset($_GET['controller'])) {
  $nombre_controlador=$_GET['controller'].'Controller';//para no escribir toda la clase en la url solo pongo Usuario
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
  $nombre_controlador = controller_default;//si no llega el controlador pongo esta constante q dice productoController

}else {
  show_error();
  exit();
}


//COMPRUEBO SI EXISTE ESA CLASE
if (class_exists($nombre_controlador)) {//me dice si existe la clase

  $controlador= new $nombre_controlador();//CREO EL OBJETO

//COMPRUEBO SI ME LLEGA LA ACCION Y SI EL METODO EXISTE DENTRO DEL CONTROLADOR SI EXISTE INVOCO A ESE METODO
  if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {//method_exists se fija si existe el metodo q mando por get y esto $controlador porqe se le tiene q poner lo q se instancio
    $action = $_GET['action'];
    $controlador->$action();
  }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    $action_default = action_default;//le cargo la constante action_default q dice index
    $controlador->$action_default();//lama a la accion index
  }else {
    show_error();
  }




}else {
show_error();
}

require_once('views/layout/footer.php');

/*class_exists('nombre_controlador');
//class_exists('Usuario');

//$controlador->mostrarTodos();
//$controlador->crear();


/*if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {//method_exists se fija si existe el metodo q mando por get y esto $controlador porqe se le tiene q poner lo q se instancio
  $action = $_GET['action'];
  $controlador->$action();
}else {
  echo "la pagina no existe";
}*/
