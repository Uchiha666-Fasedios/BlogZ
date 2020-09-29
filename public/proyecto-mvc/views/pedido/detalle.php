<h1>Detalle del pedido</h1>

<?php if (isset($pedido)): //viene del controlador con todo el pedido?>
		<?php if(isset($_SESSION['admin'])): //si es administrador?>
			<h3>Cambiar estado del pedido</h3>
			<form action="<?=base_url?>Pedido/estado" method="POST">
				<input type="hidden" value="<?=$pedido->id?>" name="pedido_id"/>
				<?php //aca hacemos un menu y depende el estado q tenga aparecera selecionado ese ?>
				<select name="estado">
					<option value="confirm" <?=$pedido->estado == "confirm" ? 'selected' : '';?>>Pendiente</option>
					<option value="preparation" <?=$pedido->estado == "preparation" ? 'selected' : '';?>>En preparación</option>
					<option value="ready" <?=$pedido->estado == "ready" ? 'selected' : '';?>>Preparado para enviar</option>
					<option value="sended" <?=$pedido->estado == "sended" ? 'selected' : '';?>>Enviado</option>
				</select>
				<input type="submit" value="Cambiar estado" /><?php// se puede cambiar el estado ?>
			</form>
			<br/>
		<?php endif; ?>

<h3>Datos del usuario</h3>
Nombre: <?= $pedido->nombre ?>   <br/>
Apellidos: <?= $pedido->apellidos ?>   <br/>

		<h3>Dirección de envio</h3>
		Provincia: <?= $pedido->provincia ?>   <br/>
		Cuidad: <?= $pedido->localidad ?> <br/>
		Direccion: <?= $pedido->direccion ?>   <br/><br/>

		<h3>Datos del pedido:</h3>
		Estado: <?=Utils::showStatus($pedido->estado) //aca con este metodo me muestra segun el estado q tenga?> <br/>
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
			<?php while ($producto = $productos->fetch_object()): //$productos viene del controlador con los productos del pedido y el bucle me tira los productos de tal pedido?>
				<tr>
					<td>
						<?php if ($producto->imagen != null): ?>
							<img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito" />
						<?php else: ?>
							<img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito" />
						<?php endif; ?>
					</td>
					<td>
						<a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a><?php //un enlace en el nombre para ver el producto con mas detalle y poder comprar nuevamente ?>
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
