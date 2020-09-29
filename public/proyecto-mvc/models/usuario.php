<?php

class Usuario{
	private $id;
	private $nombre;
	private $apellidos;
	private $email;
	private $password;
	private $rol;
	private $imagen;
	private $db;

	public function __construct() {
		$this->db = Database::connect();
	}

	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getApellidos() {
		return $this->apellidos;
	}

	function getEmail() {
		return $this->email;
	}

	function getPassword() {
		return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);//password_hash Crea un hash de contraseña cost - denota el coste del algoritmo que debería usarse.
	}

	function getRol() {
		return $this->rol;
	}

	function getImagen() {
		return $this->imagen;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);//mysqli_real_escape_string para q escape ,q se interprete string antes de poner en la base de datos por si ponen comillas

	}

	function setApellidos($apellidos) {
		$this->apellidos = $this->db->real_escape_string($apellidos);//mysqli_real_escape_string para q escape ,q se interprete string antes de poner en la base de datos por si ponen comillas

	}

	function setEmail($email) {
		$this->email = $this->db->real_escape_string($email);//mysqli_real_escape_string para q escape ,q se interprete string antes de poner en la base de datos por si ponen comillas

	}

	function setPassword($password) {
		$this->password = $password;
	}

	function setRol($rol) {
		$this->rol = $rol;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	public function save(){
		$sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', null);";
		$save = $this->db->query($sql);

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}


	public function login(){
		$result = false;
		$email = $this->email;//en el archivo UsuarioController funcion login ya le ingrese el email por post atraves de setEmail por eso el $this->email ya tiene el q vino por post
		$password = $this->password;

		// Comprobar si existe el usuario
		$sql = "SELECT * FROM usuarios WHERE email = '$email'";
		$login = $this->db->query($sql);


		if($login && $login->num_rows == 1){
			$usuario = $login->fetch_object();//fetch_object Devuelve la fila actual de un conjunto de resultados como un objeto

			// Verificar la contraseña
			$verify = password_verify($password, $usuario->password);//$password este es el q llega del post y el otro es de la base de datos

			if($verify){//al ser true es porqe concordaron los password entonce entro al if
				$result = $usuario;
			}
		}

		return $result;//devuelvo el objeto
	}



	}
