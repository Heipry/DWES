<?php
$ccc="";
if (isset($_POST['ccc'])){
	$ccc=strip_tags(trim($_POST['ccc']));
}
if (empty($ccc)){
	header("Location: solicitarSaldo.php?mensaje=".urlencode("Se necesita un número de cuenta"));
	exit;
}

include "../../seguridad/tema03/datosBD.php";
$canal=@mysqli_connect(IP,USUARIO,CLAVE,BD);
if (!$canal){
	echo "Ha ocurrido el error: ".mysqli_connect_errno()." ".mysqli_connect_error()."<br />";
	exit;
}
mysqli_set_charset($canal,"utf8");

$sql="select cl.dni, cl.nombre, cu.fechaalta , sum(m.cantidad) from clientes cl, cuentas cu, posee p, movimientos m where cu.ccc=p.ccc and p.dni=cl.dni and m.ccc=cu.ccc and cu.ccc=?";
$consulta=mysqli_prepare($canal,$sql);
if (!$consulta){
	echo "Ha ocurrido el error: ".mysqli_errno($canal)." ".mysqli_error($canal)."<br />";
	exit;
}
mysqli_stmt_bind_param($consulta,"s",$cuentacorr);


$cuentacorr=$ccc;

mysqli_stmt_execute($consulta);
mysqli_stmt_bind_result($consulta,$dni,$nombre,$fechaAlta,$cantidad);


?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Solicitar Saldo</title>
<style type="text/css">
header {
		padding: 20px;
		font-size: 2em;
		font-weight: bold;
		background-color: red;
		color: white;
		margin-bottom: 15px;
	}
section {
	width: 450px;
	margin: 0 auto;
}
table {
	border-collapse: collapse;
}
td,th {
	border: solid 1px black;
	padding: 5px;
}
caption {
	background-color: green;
	color: white;
	text-align: center;
	font-size: 1.5em;
	font-weight: bold;
}
footer {
	position: fixed;
	bottom: 0px;
	width: 100%;
	height: 50px;
	background-color: red;
}
footer a {
	color: white;
}
</style>
</head>
<body>
<header>
Solicitar saldo
</header>
<section>
<article>
	<table>
	<caption>Titulares de la cuenta: <?=$ccc?></caption>
	<tr>
	<th>DNI</th><th>NOMBRE</th><th>Fecha de alta</th>
	</tr>
<?php 
while (mysqli_stmt_fetch($consulta)){
	echo "<tr><td>$dni</td><td>$nombre</td><td>$fechaAlta</td></tr>";
}
mysqli_stmt_close($consulta);
mysqli_close($canal); 
?>
</table>
</article>
<article>
<p>
Saldo: <span style="background-color: green; padding: 5px; color: white;"><?=$cantidad?></span>
</p>
</article>
</section>
<footer>
<a href="solicitarSaldo.php">Volver</a>
</footer>
</body>
</html>