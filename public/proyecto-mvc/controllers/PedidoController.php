<?php
require_once 'models/pedido.php';

class PedidoController{

	public function hacer(){

		require_once 'views/pedido/hacer.php';
	}

	public function add(){//este metodo es invocado desde la vista views/pedido/hacer.php cuando la cual traigo los datos por post
		if(isset($_SESSION['identity'])){//verifico si me logie
			$usuario_id = $_SESSION['identity']->id;//guardo el id del usuario
			$provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;//si existe el dato  lo guado si no guardo false
			$localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

			$stats = Utils::statsCarrito();//me trae la cantidad de los productos y el total de plata
			$coste = $stats['total'];

			if($provincia && $localidad && $direccion){//si existen estos datos
				// Guardar datos en bd
				$pedido = new Pedido();//instancio Pedido del modelo y seteo con lo llegado del post
				$pedido->setUsuario_id($usuario_id);
				$pedido->setProvincia($provincia);
				$pedido->setLocalidad($localidad);
				$pedido->setDireccion($direccion);
				$pedido->setCoste($coste);

				$save = $pedido->save();//llamo al metodo q esta en el modelo class pedido y guardo en la base de datos todo y pongo estado confirm

				// Guardar linea pedido
				$save_linea = $pedido->save_linea();//llamo al metodo q esta en el modelo class pedido
				//y voy guardando con un foreach todos los productos del carrito a una tabla lineas_pedidos con el mismo numero de pedido



// ACTUALIZA EL STOCK DEL PRODUCTO
				$updates=$pedido->updateStock();

				if($save && $save_linea && $updates){//si se guardo estas dos query
					$_SESSION['pedido'] = "complete";//creo la session
				}else{
					$_SESSION['pedido'] = "failed";
				}

			}else{
				$_SESSION['pedido'] = "failed";
			}

			header("Location:".base_url.'Pedido/confirmado');//voy a pedidoController y llamo al metodo confirmado
		}else{
			// Redigir al index al no estar logeado
			header("Location:".base_url);
		}
	}

	public function confirmado(){
		if(isset($_SESSION['identity'])){//si esta logeado entra
			$identity = $_SESSION['identity'];
			$pedido = new Pedido();// instancio pedido del modelo
			$pedido->setUsuario_id($identity->id);//seteo

			$pedido = $pedido->getOneByUser();//esta funcion esta en la clase pedido del modelo q me retorna el pedido de tal usuario logeado

			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($pedido->id);//el metodo esta en la class Pedido del modelo y de parametro lleva el id del pedido
		}
		require_once 'views/pedido/confirmado.php';//voy a la vista
	}

	public function mis_pedidos(){
		Utils::isIdentity();//COMPRUEBA Q ESTE LOGEADO
		$usuario_id = $_SESSION['identity']->id;
		$pedido = new Pedido();

		// Sacar los pedidos del usuario
		$pedido->setUsuario_id($usuario_id);//seteo el id del usuario con el id del usuario logeado
		$pedidos = $pedido->getAllByUser();//me devuelve todos los pedidos de el usuario logeado

		require_once 'views/pedido/mis_pedidos.php';
	}

	public function detalle(){//la invoco desde la vista views/pedido/mis_pedidos.php y traigo el id del pedido
		Utils::isIdentity();//si esta logeado

		if(isset($_GET['id'])){//viene con el id del pedido
			$id = $_GET['id'];

			// Sacar el pedido
			$pedido = new Pedido();
			$pedido->setId($id);//seteo el id del pedido
			$pedido = $pedido->getOne();// invoco a este metodo que esta en el modelo q me trae el pedido con el id q se seteo

			// Sacar los poductos
			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($id);//llamo a este metodo q me da los productos del pedido

			require_once 'views/pedido/detalle.php';
		}else{
			header('Location:'.base_url.'Pedido/mis_pedidos');
		}
	}

	public function gestion(){
		Utils::isAdmin();//si es administrador
		$gestion = true;

		$pedido = new Pedido();
		$pedidos = $pedido->getAll();//todos los pedidos

		require_once 'views/pedido/mis_pedidos.php';
	}

	public function estado(){//se invoca desde la vista pedido detalle
		Utils::isAdmin();//si es administrador
		if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
			// Recoger datos form
			$id = $_POST['pedido_id'];
			$estado = $_POST['estado'];

			// Upadate del pedido
			$pedido = new Pedido();
			$pedido->setId($id);//seteo lo llegado del post
			$pedido->setEstado($estado);//seteo el nuevo estado llegado del post
			$pedido->edit();//actualiza el estado de la tabla pedidos de ese id seteado

			header("Location:".base_url.'Pedido/detalle&id='.$id);//lo llevo de nuevo a ver el detalle de ese pedido
		}else{
			header("Location:".base_url);
		}
	}


}
