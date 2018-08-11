<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Ejemplo 01</title>
<style type="text/css">
header {
		padding: 20px;
		font-size: 2em;
		font-weight: bold;
		background-color: red;
		color: white;
		margin-bottom: 15px;
	}
</style>
</head>
<body>
<header>
Ejemplo 1
</header>
<section>
<?php
include "../../seguridad/tema03/datosBD.php";
$canal=@mysqli_connect(IP,USUARIO,CLAVE,BD);
if (!$canal){
	echo "Ha ocurrido el error: ".mysqli_connect_errno()." ".mysqli_connect_error()."<br />";
	exit;
}
mysqli_set_charset($canal,"utf8");
echo"<p>Conexión establecida</p>";
mysqli_close($canal);
?>
<section>
</body>
</html>