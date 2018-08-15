<?php
inicioSesion();
$usuario="";
$perfil="";
$nombre="";
if (!validado($usuario,$perfil,$nombre)){
	session_destroy();
	unset($_SESSION);
	header("Location: login.php");
	exit;
}
$menu=menu();
?>