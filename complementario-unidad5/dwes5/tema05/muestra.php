<?php
require_once("Foto.class.php");
require_once("AccesoFotos.class.php");
require_once("../../smarty/libs/Smarty.class.php");
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
if (isset($_GET['codigo'])){
	$codigo=trim(strip_tags($_GET['codigo']));
}
if (empty($codigo)){
	session_destroy();
	unset($_SESSION);
	header("Location: index.php");
	exit;
}

//Recuperar la foto que se muestran en la pantalla
$bd=new AccesoFotos();
$foto=$bd->getFoto($codigo);
if (is_null($foto)){
	session_destroy();
	unset($_SESSION);	
	header("Location: index.php");
	exit;
}
//Mostrar pantalla con los datos

$carrito=new Carrito($_SESSION['variable']);

$pantalla=new Pantalla("../../pantallas/tema05");

$parametros=array('afoto' => $foto,'numero'=>$carrito->numeroProductos());

$pantalla->mostrar("muestra.tpl",$parametros);
?>