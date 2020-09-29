<?php
// Iniciar la sesión y la conexión a bd
require_once 'includes/conexion.php';

// Recoger datos del formulario
if(isset($_POST)){

	// Borrar error antiguo
	if(isset($_SESSION['error_login'])){
		session_unset($_SESSION['error_login']);//elimina session para limpiarla
	}

	// Recoger datos del formulario
	$email = trim($_POST['email']);//trim para q no guarde espacios
	$password = $_POST['password'];

	// Consulta para comprobar las credenciales del usuario
	$sql = "SELECT * FROM usuarios WHERE email = '$email'";
	$login = mysqli_query($db, $sql);

	if($login && mysqli_num_rows($login) == 1){ //si login da true y contamos el numero de filas q tiene la consulta login es = a 1
		$usuario = mysqli_fetch_assoc($login);//mysqli_fetch_assoc saca el array asociativo de la consulta o sea del usuario , de ahi voy a necesitar el password

		// Comprobar la contraseña
		$verify = password_verify($password, $usuario['password']);//verifica q sea un sifrado un hash y $usuario es un array asociativo con todo el contenido del usuario esntonces saco el password $usuario['password']
//password_verify tambien compara las passwords
		if($verify){//si da true
			// Utilizar una sesión para guardar los datos del usuario logueado
			$_SESSION['usuario'] = $usuario;//guardo el array asociativo en esta session

		}else{
			// Si algo falla enviar una sesión con el fallo
			$_SESSION['error_login'] = "Login incorrecto!!";
		}
	}else{
		// mensaje de error
		$_SESSION['error_login'] = "Login incorrecto!!";
	}

}

// Redirigir al index.php
header('Location: index.php');
