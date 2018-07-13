<?php 
$datosCorrectos=true;

//------------------------------------------------------
$numero=0;
$numeroCorrecto="v";
if (isset($_POST['numero'])){
	$numero=strip_tags(trim($_POST['numero']));
}

if (!is_numeric($numero)){
	$numeroCorrecto="f";
	$datosCorrectos=false;
}
//------------------------------------------------------

$clave="";
$claveCorrecta="v";
if (isset($_POST['clave'])){
	$clave=strip_tags(trim($_POST['clave']));
}
if (empty($clave)){
	$claveCorrecta="f";
	$datosCorrectos=false;
}

//------------------------------------------------------

if (isset($_POST['oculto'])){
	$oculto=$_POST['oculto'];
}else {
	$datosCorrectos=false;
}

//-------------------------------------------------------

function comprobar_fecha($fecha){
	if(!isset($fecha)){
		return false;
	}
	$v=explode("/",$fecha);
	if (count($v)!=3){
		return false;
	}
	
	if (!checkdate($v[1],$v[0],$v[2])){
		return false;
	}
	return true;
}
$fecha="";
$fechaCorrecta="v";
if (isset($_POST['fecha'])){
	$fecha=strip_tags(trim($_POST['fecha']));
}
if (!comprobar_fecha($fecha)){
	$fechaCorrecta="f";
	$datosCorrectos=false;
}
//---------------------------------

$checkPrevisto=array("check 1","check 2");

if (!isset($_POST['check'])){
	$check=array("","");
}else{
	$check=$_POST['check'];
	if (!is_array($check)){
		$datosCorrectos=false;
	}else{
		foreach($check as $valor){
			if (!in_array($valor,$checkPrevisto)){
				$datosCorrectos=false;
			}
		}
	}
}

//--------------------------------------
$opcionesElegibles=array("opcion1","opcion2");
if (isset($_POST['opcion'])){
	$opcion=strip_tags(trim($_POST['opcion']));
	if (!in_array($opcion,$opcionesElegibles)){
		$datosCorrectos=false;
	}
}else {
	$opcion="opcion2";
	$datosCorrectos="false";
}
//----------------------------------------

$selectSimpleElegibles=array("Sel simple 1","Sel simple 2","Sel simple 3");
if (isset($_POST['selectSimple'])){
	$selectSimple=$_POST['selectSimple'];
	if (!in_array($selectSimple,$selectSimpleElegibles)){
		$datosCorrectos=false;
	}
}else {
	$selectSimple="";
	$datosCorrectos="false";
}

//-----------------------------------------------------------

$selectMultiplePrevisto=array("Sel mult 1","Sel mult 2","Sel mult 3");

if (!isset($_POST['selectMultiple'])){
	$selectMultiple=array("","","");
}else{
	$selectMultiple=$_POST['selectMultiple'];
	if (!is_array($selectMultiple)){
		$datosCorrectos=false;
	}else{
		foreach($selectMultiple as $valor){
			if (!in_array($valor,$selectMultiplePrevisto)){
				$datosCorrectos=false;
			}
		}
	}
}


if (!$datosCorrectos){
	$http="Location: cliente2.php?";
	$http.="mensaje=".urlencode("Datos incorrectos marcados con asterisco");
	$http.="&numero=".urlencode($numero);
	$http.="&numeroCorrecto=$numeroCorrecto";
	//----
	$http.="&claveCorrecta=$claveCorrecta";
	//----
	$http.="&fecha=".urlencode($fecha);
	$http.="&fechaCorrecta=$fechaCorrecta";
	//-----
	$http.="&check[0]=".urlencode($check[0])."&check[1]=".urlencode($check[1]);
	//----
	$http.="&opcion=".urlencode($opcion);
	//----
	$http.="&selectSimple=".urlencode($selectSimple);
	//----
	$http.="&selectMultiple[]=".urlencode($selectMultiple[0])."&selectMultiple[]=".urlencode($selectMultiple[1])."&selectMultiple[]=".urlencode($selectMultiple[2]);
	//----
	header($http);
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Recepción</title>
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
footer {
	 position: fixed;
    bottom: 0;
    right: 0;
    width: 300px;
    background-color: red;
	font-weight: bold;
	color: white;
	margin: 5px;
	padding: 10px;
}
</style>
</head>
<body>
<header>
Datos recibidos
</header>
<section>
Dato numérico: <?=$numero?><br />
La clave es: <?=$clave?><br />
La fecha es <?=$fecha?><br />
El valor oculto es <?=$oculto?><br />
Las cajas seleccionadas son: 
<?php
	foreach($check as $valor){
		echo " ".$valor;
	}
?>
<br />
La opción seleccionada es <?=$opcion?><br />
La selección simple es: <?=$selectSimple?><br />
La selección Multiple es: 
<?php
	foreach($selectMultiple as $valor){
		echo " ".$valor;
	}
?>
</section>
<footer>
<a href="cliente2.php">Volver</a>
</footer>
</body>
</html>