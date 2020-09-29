<!-- BARRA LATERAL -->
<aside id="sidebar">

	<div id="buscador" class="bloque">
		<h3>Buscar</h3>

		<form action="buscar.php" method="POST">
			<input type="text" name="busqueda" />
			<input type="submit" value="Buscar" />
		</form>
	</div>

	<?php if(isset($_SESSION['usuario'])): //si existe $_SESSION['usuario'] es porqe se logeo correctamente y me muestra esto?>
		<div id="usuario-logueado" class="bloque">
			<h3>Bienvenido, <?=$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];?></h3><?php //$_SESSION['usuario']es un array asociativo le muestro el nombre y el apellido ?>
			<!--botones-->
			<a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
			<a href="crear-categoria.php" class="boton">Crear categoria</a>
			<a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
			<a href="cerrar.php" class="boton boton-rojo">Cerrar sesión</a>
		</div>
	<?php endif; ?>

	<?php if(!isset($_SESSION['usuario']))://si no existe esta session no me muetra todo esto /////////?>
	<div id="login" class="bloque">
		<h3>Identificate</h3>

		<?php if(isset($_SESSION['error_login'])): //esta session se crea cuando no se crea la de usuario ?>
			<div class="alerta alerta-error">
				<?=$_SESSION['error_login'];?>
			</div>
		<?php endif; ?>

		<form action="login.php" method="POST">
			<label for="email">Email</label>
			<input type="email" name="email" />

			<label for="password">Contraseña</label>
			<input type="password" name="password" />

			<input type="submit" value="Entrar" />
		</form>
	</div>

	<div id="register" class="bloque">
		<h3>Resgistrate</h3>

		<!-- Mostrar errores -->
		<?php if(isset($_SESSION['completado'])): ?>
			<div class="alerta alerta-exito">
				<?=$_SESSION['completado']?>
			</div>
		<?php elseif(isset($_SESSION['errores']['general'])): ?>
			<div class="alerta alerta-error">
				<?=$_SESSION['errores']['general']?>
			</div>
		<?php endif; ?>

		<form action="registro.php" method="POST">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" />
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?><?php //si existe la session errores mostramos lo q dice con la funcion mostrarerrores ?>

			<label for="apellidos">Apellidos</label>
			<input type="text" name="apellidos" />
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

			<label for="email">Email</label>
			<input type="email" name="email" />
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

			<label for="password">Contraseña</label>
			<input type="password" name="password" />
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

			<input type="submit" name="submit" value="Registrar" />
		</form>
		<?php borrarErrores(); ?>
	</div>
<?php endif;/////////////////// ?>
</aside>
