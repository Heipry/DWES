<?php 
require_once("Foto.class.php");
require_once("AccesoFotos.class.php");
require_once("Pantalla.class.php");
require_once("Carrito.class.php");

session_cache_limiter('nocache, private');
session_start();
if (!isset($_SESSION['variable'])){
	session_destroy();
	unset($_SESSION);
	header("Location: index.php");
	exit;
}
$codigo="";
if (isset($_POST['codigo'])){
	$codigo=trim(strip_tags($_POST['codigo']));
}
if (empty($codigo)){
	session_destroy();
	unset($_SESSION);
	header("Location: index.php");
	exit;
}

$bd=new AccesoFotos();
$foto=$bd->getFoto($codigo);
if (is_null($foto)){
	session_destroy();
	unset($_SESSION);	
	header("Location: index.php");
	exit;
}
$carrito=new Carrito($_SESSION['variable']);
if ($carrito->agregar($foto)){
	header("Location: index.php?mensaje=".urlencode("Producto añadido"));
}else{
	header("Location: index.php?mensaje=".urlencode("El producto ya se encuentra en la cesta"));
}
exit;
?>