<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
	$categoria_actual = conseguirCategoria($db, $_GET['id']);//desde la cabecera me traigo el idi de la categoria y con la funcion consigo la categoria

	if(!isset($categoria_actual['id'])){// si no existe lo pateo por si pone cualquier id en la url
		header("Location: index.php");
	}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">

	<h1>Entradas de <?=$categoria_actual['nombre']?></h1><?php //como esta como asociativa echa en la funcion la muestro como array ?>

	<?php
		$entradas = conseguirEntradas($db, null, $_GET['id']);

		if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
			while($entrada = mysqli_fetch_assoc($entradas)):
	?>
				<article class="entrada">
					<a href="entrada.php?id=<?=$entrada['id']?>"><?php //esto me lleva a un archivo q muestra el detalle de la entrada la cual voy a poder hacer abm ?>
						<h2><?=$entrada['titulo']?></h2>
						<span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
						<p>
							<?=substr($entrada['descripcion'], 0, 180)."..."?>
						</p>
					</a>
				</article>
	<?php
			endwhile;
		else:
	?>
		<div class="alerta">No hay entradas en esta categoría</div>
	<?php endif; ?>
</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>
