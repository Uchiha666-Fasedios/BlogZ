<h1>Gestión de productos</h1>

<a href="<?=base_url?>Producto/crear" class="button button-small">
	Crear producto
</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): //esto es para mostrar el mensaje de producto creado?>
	<strong class="alert_green">El producto se ha creado correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>
	<strong class="alert_red">El producto NO se ha creado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); //elimino la session para q cuando recarge la pantalla nuvamente no me haga nada ?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): //esto para mostrar el mensaje si se borro el producto?>
	<strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
	<strong class="alert_red">El producto NO se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); //elimino la session?>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>PRECIO</th>
		<th>STOCK</th>
		<th>ACCIONES</th>
	</tr>
	<?php while($pro = $productos->fetch_object()): //fetch_object convierte el objeto productos en un array de productos?>
		<tr>
			<td><?=$pro->id;?></td>
			<td><?=$pro->nombre;?></td>
			<td><?=$pro->precio;?></td>
			<td><?=$pro->stock;?></td>
			<td>
				<a href="<?=base_url?>Producto/editar&id=<?=$pro->id?>" class="button button-gestion">Editar</a><?php //le pongo & y no ? porque este es el tercer parametro q estoy pasando por get recuerda q producto y edit son parametros en esta ocacion ?>
				<a href="<?=base_url?>Producto/eliminar&id=<?=$pro->id?>" class="button button-gestion button-red">Eliminar</a>
			</td>
		</tr>
	<?php endwhile; ?>
</table>
