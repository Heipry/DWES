<?php
define ("CAMINO","../../tmp/");
require_once("Carrito.class.php");

session_cache_limiter('nocache, private');
session_start();
if (!isset($_SESSION['variable'])){
	session_destroy();
	unset($_SESSION);
	header("Location: index.php");
	exit;	
}	
$carrito=new Carrito($_SESSION['variable']);
$fichero=$carrito->numeroDeCompra();
$fotos=$carrito->listarGalletas();
/*
-----Comprobación en la tabla de ventas 
*/



$fichero=CAMINO.$fichero;

$zip = new ZipArchive();
 
$zip->open($fichero,ZIPARCHIVE::CREATE);
foreach($fotos as $foto){
	$zip->addFile($foto->alta);
}
$zip->close();
header("Content-disposition: attachment; filename=fotos.zip");
header("Content-type: application/zip, application/octet-stream");
readfile($fichero);
?>
