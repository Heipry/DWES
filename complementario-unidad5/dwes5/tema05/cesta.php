<?php
require_once("Foto.class.php");
require_once("Pantalla.class.php");
require_once( "Carrito.class.php");

session_cache_limiter('nocache, private');
session_start();
if (!isset($_SESSION['variable'])){
	session_destroy();
	unset($_SESSION);
	header("Location: index.php");
	exit;
}

$mensaje="";
if (isset($_GET['mensaje'])){
	$mensaje=strip_tags(trim($_GET['mensaje']));
}
$nif="";
if (isset($_GET['nif'])){
	$nif=strip_tags(trim($_GET['nif']));
}
$nombre="";
if (isset($_GET['nombre'])){
	$nombre=strip_tags(trim($_GET['nombre']));
}
$direccion="";
if (isset($_GET['direccion'])){
	$direccion=strip_tags(trim($_GET['direccion']));
}

$carrito=new Carrito($_SESSION['variable']);

$fotos=$carrito->listarGalletas();


$numero=$carrito->numeroProductos();


$pantalla=new Pantalla("../../pantallas/tema05");

$parametros=array('afotos' => $fotos,
				'numero'=>$carrito->numeroProductos(),
				'mensaje'=>$mensaje,
				'nif'=>$nif,
				'nombre'=>$nombre,
				'direccion'=>$direccion);

$pantalla->mostrar("cesta.tpl",$parametros);

?>