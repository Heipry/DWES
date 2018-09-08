<?php
require_once("AccesoFotos.class.php");
$bd=new AccesoFotos();
$bd->registro(count($_POST));
foreach($_POST as $indice => $valor){
	$reg=$indice." = ".$valor;
	$bd->registro($reg);
} 
?>