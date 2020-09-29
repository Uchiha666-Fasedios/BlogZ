<h1>Carrito de la compra</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1): //si existe la session y si hay algo?>
<table>
	<tr>
		<th>Imagen</th>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Unidades</th>
		<?php if (isset($_SESSION['admin'])): ?>
		<th>Stock</th>
	<?php endif; ?>
		<th>Eliminar</th>
	</tr>
	<?php
		foreach($carrito as $indice => $elemento):
		$producto = $elemento['producto'];//aca ingresamos el producto entero porque cuando creamos el array este $elemento['producto'] contenia todo el producto
	?>

	<tr>
		<td>
			<?php if ($producto->imagen != null): //muestro la imagen si la hay?>
				<img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito" />
			<?php else: //si no una imagen default?>
				<img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito" />
			<?php endif; ?>
		</td>
		<td>
			<a href="<?= base_url ?>Producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a><?php //muestro el nombre q tiene un enlace para ver el detalle del producto ?>
		</td>
		<td>
			<?=$producto->precio//muestro el precio?>
		</td>
		<td>
			<?=$elemento['unidades']//muestro las unidades?>
			<div class="updown-unidades">
				<?php if ($producto->stock > $elemento['unidades'])://muestro el precio): ?>


				<a href="<?=base_url?>Carrito/up&index=<?=$indice?>" class="button">+</a><?php //el indice seria 0,1,2etc.. estando recorriendo el foreach y ese indice lo voy a usar para incrementar el producto ?>
        <?php endif; ?>
				<a href="<?=base_url?>Carrito/down&index=<?=$indice?>" class="button">-</a>
			</div>
		</td>
		<?php if (isset($_SESSION['admin'])): ?>

		<td>
			<?=$producto->stock//muestro el precio?>
		</td>
		<?php endif; ?>
		<td>
			<a href="<?=base_url?>Carrito/delete&index=<?=$indice?>" class="button button-carrito button-red">Quitar producto</a><?php// va al controlador q me ejecuta esta accion delete q elimina de la session carrito lo q tiene la pocicion $indice?>
		</td>
	</tr>

	<?php endforeach; ?>
</table>
<br/>
<div class="delete-carrito">
	<a href="<?=base_url?>Carrito/delete_all" class="button button-delete button-red">Vaciar carrito</a><?php// va al controlador q me ejecuta esta accion q elimina  la session carrito?>
</div>
<div class="total-carrito">
	<?php $stats = Utils::statsCarrito(); //esta funcion static q me saca el total de plata gastada de los productos y la cantidad?>
	<h3>Precio total: <?=$stats['total']?> $</h3>
	<a href="<?=base_url?>Pedido/hacer" class="button button-pedido">Hacer pedido</a><?php //este me dirige al controlador pedido y metodo hacer la cual me tira una vista views/pedido/hacer.php?>
</div>

<?php else: ?>
	<p>El carrito está vacio, añade algun producto</p>
<?php endif; ?>
