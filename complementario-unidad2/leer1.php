<doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Respuesta</title>
<style type="text/css" >
header {
	font-family: verdana;
	font-size: 2em;
	font-weight: bold;
	color: white;
	background-color: red;
	padding: 10px;
	margin-bottom: 20px;
}
</style>
</head>
<body>
<header>
Respuesta del servidor
</header>
<section>
<?php 
$dato1="";
$dato2="";
if (isset($_GET['dato1'])){
	$dato1=$_GET['dato1'];
}
if (isset($_GET['dato2'])){
	$dato2=$_GET['dato2'];
}
?>
El valor de dato1 es: <?=$dato1?> y el valor de dato2 es: <?=$dato2?>
</section>
</body>
</html>
