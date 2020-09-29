<?php if (isset($gestion)): //esta la genere en el controlador como true en el metodo gestion?>
	<h1>Gestionar pedidos</h1>
<?php else: ?>
	<h1>Mis pedidos</h1>
<?php endif; ?>
<table>
	<tr>
		<th>Nº Pedido</th>
		<th>Coste</th>
		<th>Fecha</th>
		<th>Estado</th>
	</tr>
	<?php
	while ($ped = $pedidos->fetch_object())://$pedidos esta la genere en el controlador en el metodo gestion que tiene todos los pedidos
		//tiro el bucle con los pedidos?>

		<tr>
			<td>
				<a href="<?= base_url ?>Pedido/detalle&id=<?= $ped->id ?>"><?= $ped->id ?></a><?php //este es un enlace que me muestra el id y cuando lo toco me lleva al detalle ?>
			</td>
			<td>
				<?= $ped->coste ?> $
			</td>
			<td>
				<?= $ped->fecha ?>
			</td>
			<td>
				<?=Utils::showStatus($ped->estado) //el estado va a estar confirm y el metodo me retorna un mensaje pendiente al tener estado confirm?>
			</td>
		</tr>

	<?php endwhile; ?>
</table>
