<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Mis datos</h1>

	<?php if(isset($_SESSION['completado'])): //esta session se crea en el archivo actualizar-usuario q dice Tus datos se han actualizado con éxito?>
		<div class="alerta alerta-exito">
			<?=$_SESSION['completado']?>
		</div>
	<?php elseif(isset($_SESSION['errores']['general'])): ?>
		<div class="alerta alerta-error">
			<?=$_SESSION['errores']['general'] //esta tambien se crea en actualizar-usuario si ay un error al actualizar?>
		</div>
	<?php endif; ?>

	<form action="actualizar-usuario.php" method="POST">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" value="<?=$_SESSION['usuario']['nombre']; ?>"/><?php //al logearme se creo esta session q  le habia pasado un array asociativo q tiene al usuario en si ?>
		<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; //$_SESSION['errores'] se crea en actualizar errores y te muestra el error con la funcion?>

		<label for="apellidos">Apellidos</label>
		<input type="text" name="apellidos" value="<?=$_SESSION['usuario']['apellidos']; ?>"/>
		<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

		<label for="email">Email</label>
		<input type="email" name="email" value="<?=$_SESSION['usuario']['email']; ?>"/>
		<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

		<input type="submit" name="submit" value="Actualizar" />
	</form>
	<?php borrarErrores(); //borra las sessiones?>

</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>
