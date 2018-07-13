<?php
	function erroneo($datoCorrecto){
		if ($datoCorrecto=="f"){
			return "*";
		}
		return "";
	}
	
	$mensaje="";
	if (isset($_GET['mensaje'])){
		$mensaje=strip_tags($_GET['mensaje']);
	}
//----------------------------------------------------
	$numero="";
	
	if(isset($_GET['numero'])){
		$numero=strip_tags($_GET['numero']);
	}
	
	$numeroCorrecto="";
	if (isset($_GET['numeroCorrecto'])){
		$numeroCorrecto=strip_tags($_GET['numeroCorrecto']);
	}
	//----------------------------------------------
	$clave="";
	$claveCorrecta="";
	if (isset($_GET['claveCorrecta'])){
		$claveCorrecta=strip_tags($_GET['claveCorrecta']);
	}
	//----------------------------------------------
	
	$fecha="";
	$fechaCorrecta="";
	if (isset($_GET['fechaCorrecta'])){
		$fecha=strip_tags($_GET['fecha']);
		$fechaCorrecta=strip_tags($_GET['fechaCorrecta']);
	}
	
	//-----------------------------------------------
	
	if (isset($_GET['check'])){
		$check=$_GET['check'];	
	}else{
		$check=array("","");
	}
	
	function elegido($valorElegido,$opcionElegible){
		if ($valorElegido==$opcionElegible){
			return 'checked="checked"';
		}
		return "";
	}
//------------------------------------------------------------
if (isset($_GET['opcion'])){
	$opcion=$_GET['opcion'];
}else{
	$opcion="opcion2";
}
	
//------------------------------------------------------------------	
	
	function elegidoSelectSimple($valorElegido,$opcionElegible){
		if ($valorElegido==$opcionElegible){
			return 'selected="selected"';
		}
		return "";
	}
	
if (isset($_GET['selectSimple'])){
	$selectSimple=$_GET['selectSimple'];
}else{
	$selectSimple="";
}
//------------------------------------------------------------------
	if (isset($_GET['selectMultiple'])){
		$selectMultiple=$_GET['selectMultiple'];	
	}else{
		$selectMultiple=array("Sel mult 1","Sel mult 3");
	}
	
	function elegidoSelectMult($valoresElegidos,$opcionElegible){
		if (in_array($opcionElegible,$valoresElegidos)){
			return 'selected="selected"';
		}
		return "";
	}
?>
<!doctype html>
<html lang="es" >
<head>
<meta charset="utf-8" />
<title>cliente 2</title>
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
section {
width: 100%;
}
#cuadro {
	width: 30%;
	margin:0 auto;
	text-align: right;
}
.requisitos {
	color: blue;
	font-size: .8em;
}
.erroneo {
	color: red;
	font-size: 1.5em;
}
#mensaje {
	text-align: center;
}
</style>
</head>
<body>
<header>
Cliente
</header>
<section>
	<div id="mensaje" class="erroneo">
		<?=$mensaje?>
	</div>
	<div id="cuadro">
	<form action="leer2.php" method="post">
		Número: <input type="text" name="numero" maxlength="5" size="5" value="<?=$numero?>" /> <span class="requisitos">numérico</span>
		<span class="erroneo"><?=erroneo($numeroCorrecto)?></span><br />
		<p></p>
		clave: <input type="password" name="clave" /><span class="requisitos" />requerido</span>
		<span class="erroneo"><?=erroneo($claveCorrecta)?></span><br />
		<p></p>
		fecha: <input type="text" maxlength="10" size="10" name="fecha" value="<?=$fecha?>" /><span class="requisitos">dd/mm/yyyy</span>
		<span class="erroneo"><?=erroneo($fechaCorrecta)?></span><br /><br />
		
		<input type="hidden" name="oculto" value="valor oculto" />
		<p></p>
		
		Caja de selección 1: <input type="checkbox" name="check[]" value="check 1" <?=elegido($check[0],"check 1")?> /><br />
		Caja de selección 2: <input type="checkbox" name="check[]" value="check 2" <?=elegido($check[1],"check 2")?> /><br />
		
		<p></p>
		Opción 1: <input type="radio" name="opcion" value="opcion1" <?=elegido($opcion,"opcion1")?> /><br />
		Opción 2: <input type="radio" name="opcion" value="opcion2" <?=elegido($opcion,"opcion2")?> /><br />
		<p></p>
		<select name="selectSimple">
			<option value="Sel simple 1" <?=elegidoSelectSimple($selectSimple,"Sel simple 1")?>>Selección simple 1</option>
			<option value="Sel simple 2" <?=elegidoSelectSimple($selectSimple,"Sel simple 2")?>>Selección simple 2</option>
			<option value="Sel simple 3" <?=elegidoSelectSimple($selectSimple,"Sel simple 3")?>>Selección simple 3</option>
		</select>
		<p></p>
		<select name="selectMultiple[]" multiple="multiple">
			<option value="Sel mult 1" <?=elegidoSelectMult($selectMultiple,"Sel mult 1")?>>Selección multiple 1</option>
			<option value="Sel mult 2" <?=elegidoSelectMult($selectMultiple,"Sel mult 2")?>>Selección multiple 2</option>
			<option value="Sel mult 3" <?=elegidoSelectMult($selectMultiple,"Sel mult 3")?>>Selección multiple 3</option>
		</select>
		<p></p>
		<input type="submit" value="Enviar" />
	</form>
	</div>
</section>
</body>
</html>