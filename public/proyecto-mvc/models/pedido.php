<?php

class Pedido{
	private $id;
	private $usuario_id;
	private $provincia;
	private $localidad;
	private $direccion;
	private $coste;
	private $estado;
	private $fecha;
	private $hora;

	private $db;

	public function __construct() {
		$this->db = Database::connect();
	}

	function getId() {
		return $this->id;
	}

	function getUsuario_id() {
		return $this->usuario_id;
	}

	function getProvincia() {
		return $this->provincia;
	}

	function getLocalidad() {
		return $this->localidad;
	}

	function getDireccion() {
		return $this->direccion;
	}

	function getCoste() {
		return $this->coste;
	}

	function getEstado() {
		return $this->estado;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getHora() {
		return $this->hora;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setUsuario_id($usuario_id) {
		$this->usuario_id = $usuario_id;
	}

	function setProvincia($provincia) {
		$this->provincia = $this->db->real_escape_string($provincia);
	}

	function setLocalidad($localidad) {
		$this->localidad = $this->db->real_escape_string($localidad);
	}

	function setDireccion($direccion) {
		$this->direccion = $this->db->real_escape_string($direccion);
	}

	function setCoste($coste) {
		$this->coste = $coste;
	}

	function setEstado($estado) {
		$this->estado = $estado;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setHora($hora) {
		$this->hora = $hora;
	}

	public function getAll(){
		$productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
		return $productos;
	}


	public function getOne(){
//INNER JOIN hace q pueda usar las tablas relacionadas en este caso pedidos tiene relacion con usuarios atravez del usuario_id en pedidos y el id en usuarios

		//$producto = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
		$producto = $this->db->query("SELECT p.*, lp.nombre,lp.apellidos FROM pedidos p "//p es un alias q voy a qerer todo de pedidos p como alias y lp es el alias de la tabla usuarios q quiero el nombre
		. "INNER JOIN usuarios lp ON p.usuario_id = lp.id "
			." WHERE p.id = {$this->getId()}");
		return $producto->fetch_object();
	}



	public function getOneByUser(){
		$sql = "SELECT p.id, p.coste FROM pedidos p "
				//. "INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
				. "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";

		$pedido = $this->db->query($sql);

		return $pedido->fetch_object();
	}

	public function getAllByUser(){
		$sql = "SELECT p.* FROM pedidos p "
				. "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";//dame todos los pedidos q tengan ese id de usuario

		$pedido = $this->db->query($sql);

		return $pedido;
	}



	public function getProductosByPedido($id){
//		$sql = "SELECT * FROM productos WHERE id IN "
//				. "(SELECT producto_id FROM lineas_pedidos WHERE pedido_id={$id})";

		$sql = "SELECT pr.*, lp.unidades FROM productos pr "
				. "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
				. "WHERE lp.pedido_id={$id}";

		$productos = $this->db->query($sql);

		return $productos;
	}

	public function save(){
		$sql = "INSERT INTO pedidos VALUES(NULL, {$this->getUsuario_id()}, '{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
		$save = $this->db->query($sql);

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function updateStock(){// se invoca desde pedidoController metodo add


		foreach($_SESSION['carrito'] as $indice => $elemento){//recorro la session con un alias llamado $elemento
		//foreach($_SESSION['carrito'] as $elemento){//recorro la session con un alias llamado $elemento
			$producto = $elemento['producto'];//guardo el producto entero en la variable(porqe $_SESSION['carrito'] era un asociativo q se le ingreso al indice producto todo el producto)

$id_producto=$_SESSION['carrito'][$indice]['id_producto'];


$query = $this->db->query("SELECT * FROM productos WHERE id = $id_producto");
$stock=$query->fetch_object()->stock;

$unidades=$_SESSION['carrito'][$indice]['unidades'];

	$stock=$stock-$unidades;
			$update = "UPDATE productos SET stock=$stock ";
			$update .= " WHERE id=$id_producto;";
$save = $this->db->query($update);
	}

	$result = false;
	if($save){
		$result = true;
	}
	return $result;
}

	public function save_linea(){
		$sql = "SELECT LAST_INSERT_ID() as 'pedido';";//LAST_INSERT_ID() me saca el id del ultimo INSERT q se hiso de esa ultima tabla q fue pedidos q se hizo y pedido es un alias
		$query = $this->db->query($sql);
		$pedido_id = $query->fetch_object()->pedido;//ingreso ese id del pedido a la variable y ->pedido es el alias

		foreach($_SESSION['carrito'] as $elemento){//recorro la session con un alias llamado $elemento
			$producto = $elemento['producto'];//guardo el producto entero en la variable(porqe $_SESSION['carrito'] era un asociativo q se le ingreso al indice producto todo el producto)

			$insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id}, {$elemento['unidades']})";//se inserta en lineas_pedidos el id del pedido el id del producto y la cantidad
//y asi hasta terminar el foreach o sea $_SESSION['carrito'] ,en resumen va ingresando todos los productos q tengo en el carrito con el mismo id de pedido
			$save = $this->db->query($insert);

//			var_dump($producto);
//			var_dump($insert);
//			echo $this->db->error;
//			die();
		}

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function edit(){// se invoca desde pedidoController metodo estado
		$sql = "UPDATE pedidos SET estado='{$this->getEstado()}' ";
		$sql .= " WHERE id={$this->getId()};";

		$save = $this->db->query($sql);

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
}
