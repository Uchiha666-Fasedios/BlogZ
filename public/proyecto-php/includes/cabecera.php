<?php require_once 'conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8" /><?php //para poder meter tildes etc.. ?>
		<title>Blog de Videojuegos</title>
		<link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
	</head>
	<body>
		<!-- CABECERA -->
		<header id="cabecera">
			<!-- LOGO -->
			<div id="logo">
				<a href="index.php">
					Blog de Videojuegos
				</a>
			</div>

			<!-- MENU -->
			<nav id="menu">
				<ul>
					<li>
						<a href="index.php">Inicio</a>
					</li>
					<?php
						$categorias = conseguirCategorias($db);
						if(!empty($categorias)):
							while($categoria = mysqli_fetch_assoc($categorias))://saco el array asociativo del query q hice
					?>
								<li>
									<a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a><?php //aca muestro el nombre y cuando toco se lleva el id de la categoria?>
								</li>
					<?php
							endwhile;
						endif;
					?>
					<li>
						<a href="index.php">Sobre mí</a>
					</li>
					<li>
						<a href="index.php">Contacto</a>
					</li>
				</ul>
			</nav>

			<div class="clearfix"></div>
		</header>

		<div id="contenedor">
