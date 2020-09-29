<!--BARRA LATERAL-->

<aside id="lateral">


  <div id="carrito" class="block_aside">
    <h3>Mi carrito</h3>
    <ul>
      <?php $stats = Utils::statsCarrito(); //montamos el metodo statico statsCarrito() a la variable el cual me trar el array con el total de productos  y el total de plata?>
      <li><a href="<?=base_url?>Carrito/index">Productos (<?=$stats['count']?>)</a></li>
      <li><a href="<?=base_url?>Carrito/index">Total: <?=$stats['total']?> $</a></li>
      <li><a href="<?=base_url?>Carrito/index">Ver el carrito</a></li>
    </ul>
  </div>


  <div id="login" class="block_aside">
    <?php if(!isset($_SESSION['identity'])): ?><!--si no existe esta session es porqe no se logio entonce muestro esto-->
    <h3>Entrar a la Web</h3>
    <form class="" action="<?=base_url?>Usuario/login" method="post">
      <label for="email">Email</label>
      <input type="email" name="email" value="">
      <label for="password">Password</label>
      <input type="password" name="password" value="">
      <input type="submit" name="" value="Enviar">
    </form>
  <?php else: //si paso por aca es porqe se logio y muestro la session q tiente todo el objeto usuario esntonce muestro el nombre y apellido?>
    <h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
  <?php endif; ?>
    <ul>



      <?php if(isset($_SESSION['admin'])): ?>
        <?php //LLAMO A LOS CONTROLADORES Y A SUS ACCIONES ?>
        <li><a href="<?=base_url?>Categoria/index">Gestionar categorias</a></li>
      <li><a href="<?=base_url?>Producto/gestion">Gestionar Productos</a></li>
      <li><a href="<?=base_url?>Pedido/gestion">Gestionar pedidos</a></li>
    <?php endif; ?>
        <?php if(isset($_SESSION['identity'])): ?>
            <li><a href="<?=base_url?>Pedido/mis_pedidos">Mis pedidos</a></li>
      <li><a href="<?=base_url?>Usuario/logout">Cerrar sesión</a></li>
    <?php else: ?>
      <li><a href="<?=base_url?>Usuario/registro">Registrate aqui</a></li>
    <?php endif; ?>
    </ul>

  </div>

</aside>
<!--CONTENIDO CENTRAL-->
<div id="central">
