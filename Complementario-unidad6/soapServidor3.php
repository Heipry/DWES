<?php
	require_once("aplicacion3.php");
	$soap_servidor = new SoapServer("http://127.0.0.1/DWES/Complementario-unidad6/wsdl3.wsdl");
	$soap_servidor->AddFunction("saludar");
	$soap_servidor->AddFunction("retornarArray");
	$soap_servidor->AddFunction("objetos");

	$soap_servidor->handle();
?>