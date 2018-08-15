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
if (!controlPagina(__PAGINA__)){
	header("Location: menu.php");
	exit;
}
$menu=menu();
?>