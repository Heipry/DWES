<?php
require_once("Usuario.class.php");
function saludar($nombre){ return "Hola ".$nombre; }
function retornarArray(){
	return array("dato 1","dato 2","dato 3");
}
function objetos($usuario){
	return $usuario->id;
}
?>