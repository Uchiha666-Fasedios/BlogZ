<h1>registrarse</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
	<strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
	<strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>

<form class="" action="<?=base_url?>Usuario/save" method="post"><?php//pongo la constante base_url q es la ruta para llegar y usuario seria usuarioController y save es la accion?>
  <label for="nombre">Nombre</label>
  <input type="text" name="nombre" value="" required>

  <label for="apellidos">Apellidos</label>
  <input type="text" name="apellidos" value="" required>

  <label for="email">Email</label>
  <input type="email" name="email" value="" required>

  <label for="password">Password</label>
  <input type="password" name="password" value="" required>

<input type="submit" name="" value="Registrarse">
</form>
