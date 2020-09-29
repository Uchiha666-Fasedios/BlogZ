<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
	$entrada_actual = conseguirEntrada($db, $_GET['id']);

	if(!isset($entrada_actual['id'])){//me patea si no ay nada
		header("Location: index.php");
	}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL --><?php //gracias a la query muestro esto ?>
<div id="principal">

	<h1><?=$entrada_actual['titulo']?></h1>

	<a href="categoria.php?id=<?=$entrada_actual['categoria_id']?>">
		<h2><?=$entrada_actual['categoria']?></h2>
	</a>
	<h4><?=$entrada_actual['fecha']?> | <?=$entrada_actual['usuario'] ?></h4>
	<p>
		<?=$entrada_actual['descripcion']?>
	</p>

	<?php if(isset($_SESSION["usuario"]) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): //si estoy logeado y soy yo igual al usuario actual?>
		<br/>
		<a href="editar-entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-verde">Editar entrada</a>
		<a href="borrar-entrada.php?id=<?=$entrada_actual['id']?>" class="boton">Eliminar entrada</a>
	<?php endif; ?>

</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>
