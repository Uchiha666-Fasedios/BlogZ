<?php
require_once 'models/producto.php';

class CarritoController{

	public function index(){
		if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
			$carrito = $_SESSION['carrito'];
		}else{
			$carrito = array();
		}
		require_once 'views/carrito/index.php';
	}

	public function add(){//cuando toco comprar viene a este controlador y a esta funcion
		if(isset($_GET['id'])){
			$producto_id = $_GET['id'];//GUARDAMOS EL ID DEL PRODUCTO
		}else{
			header('Location:'.base_url);//lo patiamos si no hay id del producto
		}

		if(isset($_SESSION['carrito'])){//si existe esta session es porqe ya se pidio al carrito entonces
			$counter = 0;//creo esta variable
			foreach($_SESSION['carrito'] as $indice => $elemento){//hago un recorrido de la session donde como alias esta el indice q es el 0,1,2etc.. del array y elemento es lo q tiene
				if($elemento['id_producto'] == $producto_id){//si lo q viene del elemento el id_producto coincide con $producto_id q es el q viene por la url es  q estamos hablando q eligio el mismo producto entonces ay q sumar
					$_SESSION['carrito'][$indice]['unidades']++;//le sumo uno a las unidades
					$counter++;//sumo esta variable
				}
			}
		}

		if(!isset($counter) || $counter == 0){//esto se produce si counter no existe y si es igual a cero esto seria si $_SESSION['carrito'] no existe
			// Conseguir producto
			$producto = new Producto();//instancio la clase producto del modelo
			$producto->setId($producto_id);//seteo el id llegado por get para q this->id tenga ese idi q vino por get
			$producto = $producto->getOne();//entonces llamo a esta funcion para tener el producto en la variable(creo el objeto)

			// Añadir al carrito
			if(is_object($producto)){//si existe el objeto
				$_SESSION['carrito'][] = array(//ingreso todo lo que quiera del objeto como una array asociativa a esta session (lo hago asociativo para poder poner unidades 1
					"id_producto" => $producto->id,
					"precio" => $producto->precio,
					"unidades" => 1,
					"producto" => $producto//aca ingreso todo el objeto en este indice llamado producto
				);
			}
		}

		header("Location:".base_url."Carrito/index");
	}

	public function delete(){
		if(isset($_GET['index'])){
			$index = $_GET['index'];
			unset($_SESSION['carrito'][$index]);
		}
		header("Location:".base_url."Carrito/index");
	}

	public function up(){//esta funcion se llama desde vista/carrito/index.php cuando toco el + del producto
		if(isset($_GET['index'])){
			$index = $_GET['index'];//el $_GET['index'] tiene el indice del producto de $_SESSION['carrito']
			$_SESSION['carrito'][$index]['unidades']++;//y aca le digo q en la $_SESSION['carrito'] le sume uno en [$index]['unidades'] la cual [$index] marca la pocicion traida del get
		}
		header("Location:".base_url."Carrito/index");
	}

	public function down(){//esta funcion se llama desde vista/carrito/index.php cuando toco el + del producto
		if(isset($_GET['index'])){
			$index = $_GET['index'];//el $_GET['index'] tiene el indice del producto de $_SESSION['carrito']
			$_SESSION['carrito'][$index]['unidades']--;//y aca le digo q en la $_SESSION['carrito'] le resto uno en [$index]['unidades'] la cual [$index] marca la pocicion traida del get

			if($_SESSION['carrito'][$index]['unidades'] == 0){//al estar tocando el - va ver un punto q qede en 0 las unidades de ese producto si tiene 0 la unidades
				unset($_SESSION['carrito'][$index]);//elimino unicamente de la session q tenga esa posicion [$index]
			}
		}
		header("Location:".base_url."Carrito/index");
	}

	public function delete_all(){
		unset($_SESSION['carrito']);//elimina la session entera
		header("Location:".base_url."Carrito/index");
	}

}
