<?php

if(isset($_POST)){

	require_once 'includes/conexion.php';

	$titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;//si existe titulo y escapa titulo o sea sea string lo q guarde a la base de dato si no poner false
	$descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
	$categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
	$usuario = $_SESSION['usuario']['id'];

	// Validación
	$errores = array();

	if(empty($titulo)){
		$errores['titulo'] = 'El titulo no es válido';
	}

	if(empty($descripcion)){
		$errores['descripcion'] = 'La descripción no es válida';
	}

	if(empty($categoria) && !is_numeric($categoria)){
		$errores['categoria'] = 'La categoría no es válida';
	}


	if(count($errores) == 0){
		if(isset($_GET['editar'])){//este get viene de editar-entrada
			$entrada_id = $_GET['editar'];
			$usuario_id = $_SESSION['usuario']['id'];

			$sql = "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion', categoria_id=$categoria ".
					" WHERE id = $entrada_id AND usuario_id = $usuario_id";//edito segun sea el usuario y el id de la entrada

		}else{
			$sql = "INSERT INTO entradas VALUES(null, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
		}
		$guardar = mysqli_query($db, $sql);

		header("Location: index.php");
	}else{

		$_SESSION["errores_entrada"] = $errores;//creo esta sesion para mostrarla en el archivo crear-entradas cuando alla error

		if(isset($_GET['editar'])){
			header("Location: editar-entrada.php?id=".$_GET['editar']);
		}else{
			header("Location: crear-entradas.php");
		}
	}

}
