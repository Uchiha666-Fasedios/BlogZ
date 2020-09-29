<h1>Editar categoria</h1>
	<?php $url_action = base_url."Categoria/save&id=".$pro->id; //guardo toda la url en la variable?>


	<form action="<?=$url_action?>" method="POST">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" required/>

	<input type="submit" value="Editar" />
</form>
