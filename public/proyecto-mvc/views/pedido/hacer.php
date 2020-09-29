<?php if (isset($_SESSION['identity'])): //verifico si me logie?>
	<h1>Hacer pedido</h1>
	<p>
		<a href="<?= base_url ?>Carrito/index">Ver los productos y el precio del pedido</a><?php //regresa atras al carrito paa ver mi pedido ?>
	</p>
	<br/>

	<h3>Dirección para el envio:</h3>
	<form action="<?=base_url.'Pedido/add'?>" method="POST">
		<label for="provincia">Provincia</label>
		<input type="text" name="provincia" required />

		<label for="ciudad">Ciudad</label>
		<input type="text" name="localidad" required />

		<label for="direccion">Dirección</label>
		<input type="text" name="direccion" required />

		<input type="submit" value="Confirmar pedido" />
	</form>

<?php else: ?>
	<h1>Necesitas estar identificado</h1>
	<p>Necesitas estar logueado en la web para poder realizar tu pedido.</p>
<?php endif; ?>
