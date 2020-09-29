<?php
session_start();

if(isset($_SESSION['usuario'])){
	session_destroy();//borra todas las sessiones
}

header("Location: index.php");
