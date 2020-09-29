<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
	$entrada_actual = conseguirEntrada($db, $_GET['id']);

	if(!isset($entrada_actual['id'])){//si no ay nada lo pateo
		header("Location: index.php");
	}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Editar entrada</h1>
	<p>
		Edita tu entrada <?=$entrada_actual['titulo']?>
	</p>
	<br/>
	<form action="guardar-entrada.php?editar=<?=$entrada_actual['id']?>" method="POST">
		<label for="titulo">Titulo:</label>
		<input type="text" name="titulo" value="<?=$entrada_actual['titulo']?>"/>
		<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>

		<label for="descripcion">Descripción:</label>
		<textarea name="descripcion"><?=$entrada_actual['descripcion']?></textarea>
		<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>

		<label for="categoria">Categoría</label>
		<select name="categoria">
			<?php
				$categorias = conseguirCategorias($db);
				if(!empty($categorias)):
				while($categoria = mysqli_fetch_assoc($categorias))://lo hago asociativo porqe en la funcion no se hizo
			?>
			<option value="<?=$categoria['id']?>" <?=($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"' : '' ?>><?php//igualando los id de las categorias pongo el enfoqe en la categoria actual y selected="selected me selecciona el elemento ?>
					<?=$categoria['nombre']?>
				</option>
			<?php
				endwhile;
				endif;
			?>
		</select>
		<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?><?php //me muestra un error si lo ay q viene de guardar-entrada ?>

		<input type="submit" value="Guardar" />
	</form>
	<?php borrarErrores(); ?>
</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>
