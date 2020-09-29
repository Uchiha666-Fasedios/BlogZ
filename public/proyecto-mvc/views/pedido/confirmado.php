<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): //si se hizo un pedido en pedidoController la function add?>
	<h1>Tu pedido se ha confirmado</h1>
	<p>
		Tu pedido ha sido guardado con exito, una vez que realices la transferencia
		bancaria a la cuenta 7382947289239ADD con el coste del pedido, será procesado y enviado.
	</p>
	<br/>
	<?php if (isset($pedido)): //esta variable fue hecha en pedidoController function confirmado() q es una instancia de la class Pedido del modelo q se habian invocado una funcion q me trae el coste y el id?>
		<h3>Datos del pedido:</h3>

		Número de pedido: <?= $pedido->id ?>   <br/>
		Total a pagar: <?= $pedido->coste ?> $ <br/>
		Productos:

		<table>
			<tr>
				<th>Imagen</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Unidades</th>
			</tr>
			<?php while ($producto = $productos->fetch_object()): //$productos esta variable fue hecha en pedidoController este bucle me tira todos los productos q alla pedido este usuario?>
				<tr>
					<td>
						<?php if ($producto->imagen != null): ?>
							<img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito" />
						<?php else: ?>
							<img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito" />
						<?php endif; ?>
					</td>
					<td>
						<a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
					</td>
					<td>
						<?= $producto->precio ?>
					</td>
					<td>
						<?= $producto->unidades ?>
					</td>
				</tr>
			<?php endwhile; ?>
		</table>

	<?php endif; ?>

<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
	<h1>Tu pedido NO ha podido procesarse</h1>
<?php endif; ?>
