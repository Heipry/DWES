<?php
	try {
		$soap_cliente = new SoapClient('http://127.0.0.1/DWES/Complementario-unidad6/wsdl1.wsdl');
		$r=$soap_cliente->saludar("Pepito grillo del campo");
		echo "$r <br>";
	} catch (Exception $e) {
		echo "Error ---> ".$e->getMessage();	
	}