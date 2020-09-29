<?php

require_once 'models/producto.php';
class ProductoController
{

  public function index(){
		$producto = new Producto();
		$productos = $producto->getRandom(6);//aca llamo al metodo q esta en la clase producto del modelo
    //q me tira un orden aleatorio de los productos con un limite de 6 productos

		// renderizar vista
		require_once 'views/producto/destacados.php';
	}

  public function ver(){
    if(isset($_GET['id'])){
      $id = $_GET['id'];

      $producto = new Producto();
      $producto->setId($id);//seteo el id

      $product = $producto->getOne();//me trae el producto con tal id seteado

    }
    require_once 'views/producto/ver.php';
  }

public function gestion(){
  Utils::isAdmin();

  $producto = new Producto();
  $productos = $producto->getAll();

  require_once 'views/producto/gestion.php';
}


public function crear(){
  Utils::isAdmin();
  require_once 'views/producto/crear.php';
}

public function save(){//este metodo se usa para salvar y para editar
  Utils::isAdmin();//si es administrador
  if(isset($_POST)){
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;//si existe pones el post si no false
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
    $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
    $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
    // $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;

    if($nombre && $descripcion && $precio && $stock && $categoria){
      $producto = new Producto();//instancio producto del modelo
      $producto->setNombre($nombre);//con los set le paso la variable
      $producto->setDescripcion($descripcion);
      $producto->setPrecio($precio);
      $producto->setStock($stock);
      $producto->setCategoria_id($categoria);

      // Guardar la imagen
      if(isset($_FILES['imagen'])){
        $file = $_FILES['imagen'];
        $filename = $file['name'];
        $mimetype = $file['type'];

        if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){

          if(!is_dir('uploads/images')){//si no existe este directorio
            mkdir('uploads/images', 0777, true);//lo creo al directorio y true se le pone cuando estoy creando directorios recursivos o sea uno tras de otro ../..
          }

          $producto->setImagen($filename);//con los set le paso la variable le seteo el nombre de la imagen q llego por post
          move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
          //move_uploaded_file mueve el $file['tmp_name'] q es el nombre temporal de la imagen a uploads/images/ y concateno $filename q es el nombre de la imagen
        }
      }

      if(isset($_GET['id'])){//si existe este id
        $id = $_GET['id'];//lo guardamos
        $producto->setId($id);//setea el id q llego por get en la clase producto del modelo

        $save = $producto->edit();//aca llamamos al metodo q esta en la clase producto del modelo donde va a hacer el UPDATE
      }else{//si no es porqe voy a crear el producto
        $save = $producto->save();//uso el save de la carpeta modelo clase producto y guardo los datos
      }

      if($save){//si se guardo en la qury
        $_SESSION['producto'] = "complete";//creo esta session
      }else{//si no
        $_SESSION['producto'] = "failed";//creo esta session
      }
    }else{
      $_SESSION['producto'] = "failed";
    }
  }else{
    $_SESSION['producto'] = "failed";
  }
  header('Location:'.base_url.'Producto/gestion');
}

public function editar(){
  Utils::isAdmin();//me fijo q sea administrador
  if(isset($_GET['id'])){//si llega el id por get
    $id = $_GET['id'];//se guarda el la variable
    $edit = true;//se cre una variable

    $producto = new Producto();//instanciamos para llamar a la clase producto del modelo
    $producto->setId($id);//seteamos el id con el id q llego del get

    $pro = $producto->getOne();//ya contamos con el id seteado entonces llamando a este metodo traemos el producto con ese id

    require_once 'views/producto/crear.php';

  }else{
    header('Location:'.base_url.'Producto/gestion');
  }
}

public function eliminar(){
  Utils::isAdmin();//me fijo q sea administrador

  if(isset($_GET['id'])){// si me llega el id
    $id = $_GET['id'];
    $producto = new Producto();//instancio para llamar a la classe producto del modelo
    $producto->setId($id);//le seteo el id q me llego por get

    $delete = $producto->delete();//tiro la funcion de classe producto del modelo
    if($delete){//si se ejecuta la sentencia
      $_SESSION['delete'] = 'complete';//creo la session
    }else{
      $_SESSION['delete'] = 'failed';
    }
  }else{
    $_SESSION['delete'] = 'failed';
  }

  header('Location:'.base_url.'Producto/gestion');
}

}
