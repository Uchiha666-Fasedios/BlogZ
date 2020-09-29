<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tienda de Camisetas</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css"><?php //pongo la constante base_url q es la ruta para llegar  ?>
  </head>
  <body>
    <div class="container">


<!--CABEZERA-->
<header id='header'>
  <div id="logo">
    <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta logo" /><?php //pongo base_url q es la ruta para llegar  ?>
<a href="<?=base_url?>">Tienda de camisetas</a>
  </div>

</header>

<!-- MENU -->
<?php $categorias = Utils::showCategorias(); //traigo todas las categorias?>
<nav id="menu">
  <ul>
    <li>
      <a href="<?=base_url?>">Inicio</a>
    </li>
    <?php while($cat = $categorias->fetch_object()): ?>
      <li>
        <a href="<?=base_url?>Categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a><?php // el id para mostrar los productos de esa categoria?>
      </li>
    <?php endwhile; ?>
  </ul>
</nav>

<div id="content">
