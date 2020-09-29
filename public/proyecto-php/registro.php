<?php
if(isset($_POST)){

	// Conexión a la base de datos
	require_once 'includes/conexion.php';

	// Iniciar sesión
	if(!isset($_SESSION)){//si no hay sessiones
		session_start();
	}

	// Recorger los valores del formulario de registro
	//una forma de abreviar codigo
	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;//si existe el post lo pone en la variable si no pone false en la variable
	$apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;//mysqli_real_escape_string interpreta que todo lo q pase sea como string y no lo interpreta como parte de la consulta de mysql asi se evita intento de hakeo
	$email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;//trim es para q se guarde sin espacios
	$password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

	// Array de errores
	$errores = array();

	// Validar los datos antes de guardarlos en la base de datos
	// Validar campo nombre
	if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
		$nombre_validado = true;
	}else{
		$nombre_validado = false;
		$errores['nombre'] = "El nombre no es válido";
	}

	// Validar apellidos
	if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
		$apellidos_validado = true;
	}else{
		$apellidos_validado = false;
		$errores['apellidos'] = "Los apellidos no son válido";
	}

	// Validar el email
	if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
		$email_validado = true;
	}else{
		$email_validado = false;
		$errores['email'] = "El email no es válido";
	}

	// Validar la contraseña
	if(!empty($password)){
		$password_validado = true;
	}else{
		$password_validado = false;
		$errores['password'] = "La contraseña está vacía";
	}

	$guardar_usuario = false;

	if(count($errores) == 0){
		$guardar_usuario = true;

		// Cifrar la contraseña
		$password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);//la sifra 4 veces antes de guardar en la variable

		// INSERTAR USUARIO EN LA TABLA USUARIOS DE LA BBDD
		$sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";//el id null ,curdate es una funcion de mysql q te da la fecha las comillas es porque sql asepta los string con comillas
		$guardar = mysqli_query($db, $sql);

//		var_dump(mysqli_error($db));
//		die();

		if($guardar){//si guarda esta bien
			$_SESSION['completado'] = "El registro se ha completado con éxito";//creamos esta variable session
		}else{
			$_SESSION['errores']['general'] = "Fallo al guardar el usuario!!";//si no esta sesion con un indice q es general
		}

	}else{
		$_SESSION['errores'] = $errores;
	}
}

header('Location: index.php');
