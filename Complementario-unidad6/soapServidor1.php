<?php
	require_once("aplicacion.php");
	$soap_servidor = new SoapServer("http://127.0.0.1/DWES/Complementario-unidad6/wsdl1.wsdl");
	$soap_servidor->AddFunction("saludar");
	$soap_servidor->handle();
?>