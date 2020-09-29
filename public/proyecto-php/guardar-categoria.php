<?php
if(isset($_POST)){
	// Conexión a la base de datos
	require_once 'includes/conexion.php';

	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;//mysqli_real_escape_string para q escape ,q se interprete string antes de poner en la base de datos por si ponen comillas

	// Array de errores
	$errores = array();

	// Validar los datos antes de guardarlos en la base de datos
	// Validar campo nombre
	if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
		$nombre_validado = true;
	}else{
		$nombre_validado = false;
		$errores['nombre'] = "El nombre no es válido";//creo esta session si esta mal
	}

	if(count($errores) == 0){//si es igual a 0 no ay error
		$sql = "INSERT INTO categorias VALUES(NULL, '$nombre');";//el valor del id va ser nullo porqe es auto incrementar
		$guardar = mysqli_query($db, $sql);
	}

}

header("Location: index.php");
