<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Ultimas entradas</h1>

	<?php
		$entradas = conseguirEntradas($db, true);
		if(!empty($entradas)):
			while($entrada = mysqli_fetch_assoc($entradas))://lo hacemos asociativo
	?>
				<article class="entrada">
					<a href="entrada.php?id=<?=$entrada['id']?>"><?php //me lleva a ver el detalle de la entrada y poder hacer abm de ella ?>
						<h2><?=$entrada['titulo']?></h2>
						<span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
						<p>
							<?=substr($entrada['descripcion'], 0, 180)."..."?><?php // substr es una funcion q me limita los caracteres q yo quiera de 0 a 180?>
						</p>
					</a>
				</article>
	<?php
			endwhile;
		endif;
	?>

	<div id="ver-todas">
		<a href="entradas.php">Ver todas las entradas</a>
	</div>
</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>
