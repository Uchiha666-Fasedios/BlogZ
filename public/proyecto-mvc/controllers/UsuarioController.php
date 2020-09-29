<?php

require_once 'models/usuario.php';

class UsuarioController
{

public function index(){
  echo "Controlador Usuarios, Accion index";
}

public function registro(){
  require_once 'views/usuario/registro.php';
}

public function save(){
  if(isset($_POST)){

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;//si existe $_POST['nombre'] lo ingresamos en $nombre si no le ingresamos false
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $password = isset($_POST['password']) ? $_POST['password'] : false;

    if($nombre && $apellidos && $email && $password){
      $usuario = new Usuario();
      $usuario->setNombre($nombre);
      $usuario->setApellidos($apellidos);
      $usuario->setEmail($email);
      $usuario->setPassword($password);

      $save = $usuario->save();
      if($save){
        $_SESSION['register'] = "complete";
      }else{
        $_SESSION['register'] = "failed";
      }
    }else{
      $_SESSION['register'] = "failed";
    }
  }else{
    $_SESSION['register'] = "failed";
  }
  header("Location:".base_url.'Usuario/registro');
  }

  public function login(){
		if(isset($_POST)){
			// Identificar al usuario
			// Consulta a la base de datos
			$usuario = new Usuario();
			$usuario->setEmail($_POST['email']);
			$usuario->setPassword($_POST['password']);

			$identity = $usuario->login();//esta funcion devuelve el objeto usuario

			if($identity && is_object($identity)){//si es true y es un objeto
				$_SESSION['identity'] = $identity;//genero una session

				if($identity->rol == 'admin'){//rol es la columna de la base de datos y le digo si es igual a admin entro al if
					$_SESSION['admin'] = true;
				}

			}else{
				$_SESSION['error_login'] = 'Identificación fallida !!';
			}

		}
		header("Location:".base_url);
	}

//cierra session
  public function logout(){
		if(isset($_SESSION['identity'])){
			unset($_SESSION['identity']);//eliminamos la session
		}

		if(isset($_SESSION['admin'])){
			unset($_SESSION['admin']);//eliminamos la session
		}

		header("Location:".base_url);
	}

}
