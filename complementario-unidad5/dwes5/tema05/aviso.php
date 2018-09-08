<?php
require_once("Pantalla.class.php");


session_cache_limiter('nocache, private');
session_start();
if (!isset($_SESSION['variable'])){
	session_destroy();
	unset($_SESSION);
	header("Location: index.php");
	exit;
}


$pantalla=new Pantalla("../../pantallas/tema05");

$parametros=array();

$pantalla->mostrar("aviso.tpl",$parametros);

?>