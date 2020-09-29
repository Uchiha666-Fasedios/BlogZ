<?php

/**
 *
 */
class Utils
{

public static function deleteSession($name){
if (isset($_SESSION[$name])) {
  $_SESSION[$name] = null;
  unset($_SESSION[$name]);

}

return $name;

}

public static function isAdmin(){
  if(!isset($_SESSION['admin'])){
    header("Location:".base_url);
  }else{
    return true;
  }
}

public static function isIdentity(){
  if(!isset($_SESSION['identity'])){
    header("Location:".base_url);
  }else{
    return true;
  }
}

public static function showCategorias(){
  require_once 'models/categoria.php';
  $categoria = new Categoria();
  $categorias = $categoria->getAll();
  return $categorias;
}


public static function statsCarrito(){
  $stats = array(//crea un array asociativo
    'count' => 0,
    'total' => 0
  );

  if(isset($_SESSION['carrito'])){//si existe la session
    $stats['count'] = count($_SESSION['carrito']);//contamos todos los elementos de la session y lo ingresamos en el array asociativo $stats['count']

    foreach($_SESSION['carrito'] as $producto){//recorremos la session carrito con un foreach y como value usamos $producto
      $stats['total'] += $producto['precio']*$producto['unidades'];//multiplico pricio por unidades y me va sumando el total de todo lo vamos guardando en el array
    }
  }

  return $stats;//retornamos el array
}

public static function showStatus($status){//esta funcion la invoco desde una vista views/pedido/mis_pedidos.php y en $status esta confirm tambien la invoco de views/pedido/detalle.php
  $value = 'Pendiente';

  if($status == 'confirm'){
    $value = 'Pendiente';
  }elseif($status == 'preparation'){
    $value = 'En preparación';
  }elseif($status == 'ready'){
    $value = 'Preparado para enviar';
  }elseif($status = 'sended'){
    $value = 'Enviado';
  }

  return $value;
}



}
