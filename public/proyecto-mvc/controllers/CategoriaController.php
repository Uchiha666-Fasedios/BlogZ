<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';



class CategoriaController
{

  public function index(){
    Utils::isAdmin();
    $categoria = new Categoria();
    $categorias = $categoria->getAll();

    require_once 'views/categoria/index.php';
  }

  public function ver(){
    if(isset($_GET['id'])){
      $id = $_GET['id'];

      // Conseguir categoria
      $categoria = new Categoria();
      $categoria->setId($id);//stea el id q llego por get
      $categoria = $categoria->getOne();//retorna todo de categorias q tenga q ver con ese id seteado

      // Conseguir productos;
      $producto = new Producto();
      $producto->setCategoria_id($id);//stea el id q llego por get
      $productos = $producto->getAllCategory();//este metodo me trae todos los productos de la categoria con ese id seteado
    }

    require_once 'views/categoria/ver.php';
  }



  public function crear(){
    Utils::isAdmin();
    require_once 'views/categoria/crear.php';
  }

  public function editar(){
   
    Utils::isAdmin();//me fijo q sea administrador
  if(isset($_GET['id'])){//si llega el id por get
    $id = $_GET['id'];//se guarda el la variable
    $edit = true;//se cre una variable

    $categoria = new Categoria();//instanciamos para llamar a la clase producto del modelo
    $categoria->setId($id);//seteamos el id con el id q llego del get

    $pro = $categoria->getOne();//ya contamos con el id seteado entonces llamando a este metodo traemos el producto con ese id
    require_once 'views/categoria/editar.php';
    //require_once 'views/categoria/crear.php';

  }else{
    header('Location:'.base_url.'Categoria/index');
  }
  }

  public function save(){
    
    Utils::isAdmin();
    if(isset($_POST)){
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;//si existe pones el post si no false
      if($nombre){
      // Guardar la categoria en bd
      $categoria = new Categoria();
      $categoria->setNombre($_POST['nombre']);
      

      if(isset($_GET['id'])){//si existe este id
        $id = $_GET['id'];//lo guardamos
       
        $categoria->setId($id);//setea el id q llego por get en la clase producto del modelo

        $save = $categoria->edi();//aca llamamos al metodo q esta en la clase producto del modelo donde va a hacer el UPDATE
      }else{//si no es porqe voy a crear el producto
        $save = $categoria->save();//uso el save de la carpeta modelo clase producto y guardo los datos
      }
    }
      //$save = $categoria->save();
  }
    header("Location:".base_url."Categoria/index");
  }


  public function eliminar(){
    Utils::isAdmin();//me fijo q sea administrador
  
    if(isset($_GET['id'])){// si me llega el id
      $id = $_GET['id'];
      $categoria = new Categoria();//instancio para llamar a la classe Categoria del modelo
      $categoria->setId($id);//le seteo el id q me llego por get
  
      $delete = $categoria->delete();//tiro la funcion de classe Categoria del modelo
      if($delete){//si se ejecuta la sentencia
        $_SESSION['delete2'] = 'complete';//creo la session
      }else{
        $_SESSION['delete2'] = 'failed';
      }
    }else{
      $_SESSION['delete2'] = 'failed';
    }
  
    header('Location:'.base_url.'Categoria/index');
  }


}
