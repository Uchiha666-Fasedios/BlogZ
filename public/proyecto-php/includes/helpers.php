<?php
//un scrip es una pagina de php que no muestra la informacion como esta
//las q muestran son las vistas


function mostrarError($errores, $campo){//le paso el array errores y un campo o sea el nombre del campo del indice q quiero mostrar
	$alerta = '';//esta la dejo vacia
	if(isset($errores[$campo]) && !empty($campo)){//si existe el array con ese campo y no esta vacio
		$alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';//o sea el campo muestra el nombre del indice del array
	}

	return $alerta;
}

function borrarErrores(){
	$borrado = false;

	if(isset($_SESSION['errores'])){
		$_SESSION['errores'] = null;
		$borrado = true;
	}

	if(isset($_SESSION['errores_entrada'])){
		$_SESSION['errores_entrada'] = null;
		$borrado = true;
	}

	if(isset($_SESSION['completado'])){
		$_SESSION['completado'] = null;
		$borrado = true;
	}

	return $borrado;
}

function conseguirCategorias($conexion){//conexion es db q la agarro gracias al include en cabecera
	$sql = "SELECT * FROM categorias ORDER BY id ASC;";//lo ordena de manera ascendente al id
	$categorias = mysqli_query($conexion, $sql);

	$resultado = array();//creo un array
	if($categorias && mysqli_num_rows($categorias) >= 1){//si $categorias es true y contando las filas es = o mayor a 1
		$resultado = $categorias;//la guardamos aca
	}

	return $resultado;
}

function conseguirCategoria($conexion, $id){//conecto y traigo el id de la categoria
	$sql = "SELECT * FROM categorias WHERE id = $id;";
	$categorias = mysqli_query($conexion, $sql);

	$resultado = array();
	if($categorias && mysqli_num_rows($categorias) >= 1){//si ay algo
		$resultado = mysqli_fetch_assoc($categorias);//la pongo como asociativa
	}

	return $resultado;//la muestro
}

function conseguirEntrada($conexion, $id){//traigo el id de la entrada
	$sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS usuario"
		  . " FROM entradas e ".
		   "INNER JOIN categorias c ON e.categoria_id = c.id ".
		   "INNER JOIN usuarios u ON e.usuario_id = u.id ".
		   "WHERE e.id = $id";
	$entrada = mysqli_query($conexion, $sql);

	$resultado = array();
	if($entrada && mysqli_num_rows($entrada) >= 1){//si ay filas
		$resultado = mysqli_fetch_assoc($entrada);//lo hacemos asociativo lo guardo en el array
	}

	return $resultado;
}

function conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null){//la funcion es de un parametro el parametro categoria es el id
	$sql="SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
		 "INNER JOIN categorias c ON e.categoria_id = c.id ";

	if(!empty($categoria)){//si no esta vacio entra
		$sql .= "WHERE e.categoria_id = $categoria ";//con esto $sql .= concateno lo anterior o sea le agrego esto..donde id categoria sea igual al q viene por get
	}

	if(!empty($busqueda)){
		$sql .= "WHERE e.titulo LIKE '%$busqueda%' ";//le agrego esto para encontrar la entrada
	}

	$sql .= "ORDER BY e.id DESC ";

	if($limit){
		// $sql = $sql." LIMIT 4";
		$sql .= "LIMIT 4";//le agrego a la query un limite de 4 entradas
	}

	$entradas = mysqli_query($conexion, $sql);

	$resultado = array();
	if($entradas && mysqli_num_rows($entradas) >= 1){
		$resultado = $entradas;
	}

	return $entradas;//mostramos las entradas
}
