<?php //app_autoloader()nombre convencional de la funcion
function controllers_autoload($class){ //CON ESTA FUNCION RECARGA TODOS LOS ARCHIVOS en este caso del directorio controllers
	include 'controllers/'.$class . '.php';
}

spl_autoload_register('controllers_autoload');//ESTE METODO HACE LA MAGIA de buscar todas los archivos q indico en la funcion arriba construida
//NO IMPORTA Q AYA NAMESPACE AGARRA DE AHI TAMBIEN LOS ARCHIVOS
