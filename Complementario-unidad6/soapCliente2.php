<?php
	try {
		$soap_cliente = new SoapClient('http://127.0.0.1/DWES/Complementario-unidad6/wsdl2.wsdl');
		$r1=$soap_cliente->saludar("Pepito grillo del campo");
		$r2=$soap_cliente->retornarArray();
		echo "$r1 <br>";
		print_r($r2);
	} catch (Exception $e) {
		echo "Error ---> ".$e->getMessage();	
	}