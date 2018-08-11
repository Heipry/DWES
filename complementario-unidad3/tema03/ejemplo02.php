<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Ejemplo 02</title>
<style type="text/css">
header {
		padding: 20px;
		font-size: 2em;
		font-weight: bold;
		background-color: red;
		color: white;
		margin-bottom: 15px;
	}
article {
	width: 40%;
	margin: 0 auto;
}
table {
	border-collapse: collapse;
}
tr:nth-child(even){
	background-color: #cacaca;
}
th {
	background-color: green;
	color: white;
}
th, td {
	padding: 5px;
}
.arriba {
	border-top: 1px solid black;
}
</style>
</head>
<body>
<header>
Ejemplo 2
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

$sql="select c.dni,c.nombre,p.ccc from clientes c, posee p where c.dni=p.dni order by 2";
$consulta=mysqli_prepare($canal,$sql);
if (!$consulta){
	echo "Ha ocurrido el error: ".mysqli_errno($canal)." ".mysqli_error($canal)."<br />";
	exit;
}
mysqli_stmt_execute($consulta);
mysqli_stmt_bind_result($consulta,$dni,$nombre,$ccc);
?>
<article>
	<table>
	<tr>
	<th>DNI</th><th>NOMBRE</th><th>CCC</th>
	</tr>
<?php
	$dniAnterior="";
	while(mysqli_stmt_fetch($consulta)){
		echo "<tr>";
		if ($dniAnterior!=$dni){
			echo "<td class='arriba'>$dni</td><td class='arriba'>$nombre</td><td class='arriba'>$ccc</td>";
			$dniAnterior=$dni;
		}else {
			echo "<td></td><td></td><td>$ccc</td>";
		}
		echo "</tr>";
	}
?>
	</table>
</article>
<?php
mysqli_stmt_close($consulta);
mysqli_close($canal);
?>
<section>
</body>
</html>