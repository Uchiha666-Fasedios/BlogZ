<?php if(isset($edit) && isset($pro) && is_object($pro)): //si existe la variable $edit (q al llamar a editar en el controlador se creo como true)
	// y existe $pro q tiene el producto y is_object si es un objeto?>
	<h1>Editar producto <?=$pro->nombre?></h1>
	<?php $url_action = base_url."Producto/save&id=".$pro->id; //guardo toda la url en la variable?>

<?php else: ?>
	<h1>Crear nuevo producto</h1>
	<?php $url_action = base_url."Producto/save"; ?>
<?php endif; ?>

<div class="form_container">

	<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data"><?php //aca se va a dirigir a la url con el id si es editar o sin el id para crear ?>
		<label for="nombre">Nombre</label>
		<?php //esta condicion es porque el formulario se usa para crear y para editar ?>
		<input type="text" name="nombre" value="<?=isset($pro) && is_object($pro) ? $pro->nombre : ''; ?>"/><?php //aca le pregunto si existe $pro y si es un objeto q muestre el nombre si no q muestre vacio ?>

		<label for="descripcion">Descripción</label>
		<textarea name="descripcion"><?=isset($pro) && is_object($pro) ? $pro->descripcion : ''; ?></textarea>

		<label for="precio">Precio</label>
		<input type="text" name="precio" value="<?=isset($pro) && is_object($pro) ? $pro->precio : ''; ?>"/>

		<label for="stock">Stock</label>
		<input type="number" name="stock" value="<?=isset($pro) && is_object($pro) ? $pro->stock : ''; ?>"/>

		<label for="categoria">Categoria</label>
		<?php $categorias = Utils::showCategorias(); ?>
		<select name="categoria">
			<?php while ($cat = $categorias->fetch_object()): ?>
				<option value="<?= $cat->id ?>" <?=isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : ''; ?>><?php //selected para q qede selecionado ?>
					<?= $cat->nombre ?>
				</option>
			<?php endwhile; ?>
		</select>

		<label for="imagen">Imagen</label>
		<?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)): //aca para mostrar la imagen si existe y no esta vacia ?>
			<img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" class="thumb"/>
		<?php endif; ?>
		<input type="file" name="imagen" />

		<input type="submit" value="Guardar" />
	</form>
</div>
