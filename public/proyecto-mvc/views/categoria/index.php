<h1>Gestionar categorias</h1>

<a href="<?=base_url?>Categoria/crear" class="button button-small">
	Crear categoria
</a>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>ACCIONES</th>
	</tr>
	<?php while($cat = $categorias->fetch_object()): ?>
		<tr>
			<td><?=$cat->id;?></td>
			<td><?=$cat->nombre;?></td>
			<td><a href="<?=base_url?>Categoria/editar&id=<?=$cat->id;?>" class="button button-gestion">EDITAR</a></td>
			<td><a href="<?=base_url?>Categoria/eliminar&id=<?=$cat->id;?>" class="button  button-red">ELIMINAR</a></td>
		</tr>
	<?php endwhile; ?>
</table>
