<?php
$datosCorrectos=true;

$ccc1="";
if (isset($_POST['ccc1'])){
	$ccc1=strip_tags(trim($_POST['ccc1']));
}
if (strlen($ccc1)!=24){
	$datosCorrectos=false;
}

$ccc2="";
if (isset($_POST['ccc2'])){
	$ccc2=strip_tags(trim($_POST['ccc2']));
}
if (strlen($ccc2)!=24){
	$datosCorrectos=false;
}

$cantidad="";
if (isset($_POST['cantidad'])){
	$cantidad=strip_tags(trim($_POST['cantidad']));
}
if (empty($cantidad) || !is_numeric($cantidad) || $cantidad<0){
	$datosCorrectos=false;
}

if (!$datosCorrectos){
	$http="Location: solicitarTransferenciaPDO.php?mensaje=".urlencode("Algún valor no es correcto");
	$http.="&ccc1=".urlencode($ccc1)."&ccc2=".urlencode($ccc2)."&cantidad=".urlencode($cantidad);
	header($http);
	exit;
}
include "../../seguridad/tema03/datosBDPDO.php";

$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
$canal = new PDO(PDO_MYSQL_HOST,PDO_MYSQL_USER,PDO_MYSQL_PASSWORD, $opciones);

if (!$canal){
	die("No se puede crear el canal ");
}

$canal->beginTransaction();

$sql="select cu.ccc, sum(m.cantidad) from cuentas cu, movimientos m where cu.ccc=m.ccc and cu.ccc=:ccc for update";
$consulta=$canal->prepare($sql);
$parametros=array(":ccc"=>$ccc1);
$consulta->execute($parametros);
$consulta->bindColumn(1,$cccOrigen);
$consulta->bindColumn(2,$saldoTotal);
$consulta->fetch();
if (is_null($cccOrigen)){
	$http="Location: solicitarTransferenciaPDO.php?mensaje=".urlencode("Cuenta origen no existente");
	$http.="&ccc1=".urlencode($ccc1)."&ccc2=".urlencode($ccc2)."&cantidad=".urlencode($cantidad);
	header($http);
	exit; 
}
if ($cantidad>$saldoTotal){
	$http="Location: solicitarTransferenciaPDO.php?mensaje=".urlencode("Cantidad superior al saldo");
	$http.="&ccc1=".urlencode($ccc1)."&ccc2=".urlencode($ccc2)."&cantidad=".urlencode($cantidad);
	header($http);
	exit;
}
unset($consulta);
//---- Este código sobraría
$sql="select ccc from cuentas where ccc=:ccc for update";
$consulta=$canal->prepare($sql);
$parametros=array(":ccc"=>$ccc2);
$consulta->execute($parametros);
$consulta->bindColumn(1,$cccDestino);
$consulta->fetch();
if (is_null($cccDestino)){
	$http="Location: solicitarTransferenciaPDO.php?mensaje=".urlencode("Cuenta Destino no existente");
	$http.="&ccc1=".urlencode($ccc1)."&ccc2=".urlencode($ccc2)."&cantidad=".urlencode($cantidad);
	header($http);
	exit;
}



//--------------------
$sql="insert into movimientos (cantidad, fecha, ccc) values (:cantidad,curdate(),:ccc)";
$consulta=$canal->prepare($sql);
$parametros=array(":cantidad"=>$cantidad,":ccc"=>$ccc2);
$consulta->execute($parametros);

if ($consulta->rowCount()==0){
	$canal->rollback();
	$http="Location: solicitarTransferenciaPDO.php?mensaje=".urlencode("Error al ingresar la cantidad en destino");
	$http.="&ccc1=".urlencode($ccc1)."&ccc2=".urlencode($ccc2)."&cantidad=".urlencode($cantidad);
	header($http);
	exit;
}
unset($consulta);


$sql="insert into movimientos (cantidad, fecha, ccc) values (:cantidad,curdate(),:ccc)";
$consulta=$canal->prepare($sql);
$parametros=array(":cantidad"=>-$cantidad,":ccc"=>$ccc1);
$consulta->execute($parametros);

if ($consulta->rowCount()==0){
	$canal->rollback();
	$http="Location: solicitarTransferenciaPDO.php?mensaje=".urlencode("Error al retirar la cantidad en origen");
	$http.="&ccc1=".urlencode($ccc1)."&ccc2=".urlencode($ccc2)."&cantidad=".urlencode($cantidad);
	header($http);
	exit;
}
unset($consulta);

$canal->commit();

?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Solicitar Transferencia Interna</title>
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
form {
	text-align: right;
}
</style>
</head>
<body>
<header>
Transferencia
</header>
<section>
Cuenta Origen: <?=$ccc1?><br /> Cuenta Destino: <?=$ccc2?> <p>Transferencia EFECTUADA: <?=$cantidad?></p>
</section>
</body>
</html>