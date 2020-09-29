<?php
	if(!isset($_POST['busqueda'])){
		header("Location: index.php");
	}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">

	<h1>Busqueda: <?=$_POST['busqueda']?></h1>

	<?php
		$entradas = conseguirEntradas($db, null, null, $_POST['busqueda']);

		if(!empty($entradas) && mysqli_num_rows($entradas) >= 1)://si es diferente a vacio y ay mas de una
			while($entrada = mysqli_fetch_assoc($entradas))://lo hacemos asociativo
	?>
				<article class="entrada">
					<a href="entrada.php?id=<?=$entrada['id']?>"><?php //me muestra los detalles de la entrada y un abm de la entrada ?>
						<h2><?=$entrada['titulo']?></h2>
						<span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
						<p>
							<?=substr($entrada['descripcion'], 0, 180)."..."?>
						</p>
					</a>
				</article>
	<?php
			endwhile;
		else://si no no ay entradas
	?>
		<div class="alerta">No hay entradas en esta categoría</div>
	<?php endif; ?>
</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>
