<?php
	try {
		require_once("Usuario.class.php");
		$soap_cliente = new SoapClient('http://127.0.0.1/DWES/Complementario-unidad6/wsdl3.wsdl');
		$r1=$soap_cliente->saludar("Pepito grillo del campo");
		$r2=$soap_cliente->retornarArray();
		$usu=new Usuario(81, "Alguien", "Calle", "a@b.c");
		$r3=$soap_cliente->objetos($usu);
		echo "$r1 <br>";
		print_r($r2)."<br>";
		echo $r3."<br>";
	} catch (Exception $e) {
		echo "Error ---> ".$e->getMessage();	
	}