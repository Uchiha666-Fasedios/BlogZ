<?php
if(isset($_POST)){

	// Conexión a la base de datos
	require_once 'includes/conexion.php';

	// Recorger los valores del formulario de actulizacion
	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;//mysqli_real_escape_string convierte todo a string a ponga comillas asi no se hakea
	$apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
	$email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;//trim elimina espacios

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

	$guardar_usuario = false;

	if(count($errores) == 0){//cuenta q no alla errores y entra a actualizar
		$usuario = $_SESSION['usuario'];//el usuario logeado
		$guardar_usuario = true;

		// COMPROBAR SI EL EMAIL YA EXISTE
		$sql = "SELECT id, email FROM usuarios WHERE email = '$email'";//seleciona de usuario donde email sea igual al email ingresado para actualizar si ay algo qeremos poner un email existente estaria mal
		$isset_email = mysqli_query($db, $sql);
		$isset_user = mysqli_fetch_assoc($isset_email);//lo hacemos asociativo lo de la query

		if($isset_user['id'] == $usuario['id'] || empty($isset_user)){//si el id del usuario coincide con el nuevo o sea actualizaria a el mismo q contiene ese email o si $isset_user esta vacio actualizamos
			// ACTULIZAR USUARIO EN LA TABLA USUARIOS DE LA BBDD

			$sql = "UPDATE usuarios SET ".
				   "nombre = '$nombre', ".
				   "apellidos = '$apellidos', ".
				   "email = '$email' ".
				   "WHERE id = ".$usuario['id'];
			$guardar = mysqli_query($db, $sql);


			if($guardar){
				$_SESSION['usuario']['nombre'] = $nombre;//creamos estas sessiones
				$_SESSION['usuario']['apellidos'] = $apellidos;
				$_SESSION['usuario']['email'] = $email;

				$_SESSION['completado'] = "Tus datos se han actualizado con éxito";
			}else{
				$_SESSION['errores']['general'] = "Fallo al guardar el actulizar tus datos!!";
			}
		}else{
			$_SESSION['errores']['general'] = "El usuario ya existe!!";
		}

	}else{
		$_SESSION['errores'] = $errores;
	}
}

header('Location: mis-datos.php');
