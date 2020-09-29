<h1>Algunos de nuestros productos</h1>

<?php while($product = $productos->fetch_object()): //esta vista viene de productoController con un require y $productos tiene los 6 productos?>
	<div class="product">
		<a href="<?=base_url?>Producto/ver&id=<?=$product->id?>"><?php //ago un enlace para ver el detalle del producto ?>
			<?php if($product->imagen != null): ?>
				<img src="<?=base_url?>uploads/images/<?=$product->imagen?>" />
			<?php else: ?>
				<img src="<?=base_url?>assets/img/camiseta.png" /><?php //imagen por default por si no hay ?>
			<?php endif; ?>
			<h2><?=$product->nombre?></h2>
		</a>
		<p><?=$product->precio?></p>
		<a href="<?=base_url?>Carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
	</div>
<?php endwhile; ?>
