<?php
define ("__PAGINA__","PAG06");
include "../../seguridad/tema04/funciones.php";
include "../../seguridad/tema04/inicioPagina.php";
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Página 6</title>
<style type="text/css">
body {
	font-family: verdana;
	background-color: #A9A9F5;
}
header {
		padding: 20px;
		font-size: 2em;
		font-weight: bold;
		background-color: red;
		color: white;
		margin-bottom: 15px;
	}
nav {
	width: 200px;
	float: left;
	height: 100%;
}
.menu {
	display: block;
	border: 1px solid black;
	text-decoration: none;
	font-family: verdana;
	font-size: .8em;
	background-color: #cacaca;
	color: white;
	width: 150px;
	padding: 5px;
	text-align:center;
}
.enlaceboton {
	text-decoration:none;
	color: white;
	border: 1px solid black;
	padding:3px;
	background-color: black;
}

#id {
	text-align: right;
	font-size: .3em;
}

#footer {
   position:fixed;
   left:0px;
   bottom:0px;
   height:50px;
   width:100%;
   background:#999;
   font-size: .8em;
   font-weight: bold;
   color: white;
}
</style>
</head>
<body>
<header>
Página 6
<div id="id">Usuario: <?=$nombre?> <a href='cerrar.php' class='enlaceboton'>Cerrar Sesión</a></div>
</header>
<nav>
<?php
foreach($menu as $opcion){
	echo"<a href='".$opcion['url']."' class='menu'>".$opcion['linea']."</a>";
}
?>
</nav>
<footer id="footer"><p><a href="menu.php" class="enlaceboton" >Menú</a></footer>
</body>
</html>
