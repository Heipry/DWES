<?php
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
//----------------------------
function factorial($n){
	if ($n==0){
		return 1;
	}
	return $n*factorial($n-1);
} 
function facto($n){
	$f=1;
	while ($n>0){
		$f*=$n--;
	}
	return $f;
}
//-----------------------
function saludo($nombre="Javier"){
	echo "Hola $nombre <br />";
}
//-----------------------
function pasoVariables1($v){
	if (gettype($v)!='array'){
		return;
	}
	$v[0]=-1;
	array_push($v,"nuevo valor");
}
//-----------------------
function pasoVariables2(&$v){
	if (gettype($v)!='array'){
		return;
	}
	$v[0]=-1;
	array_push($v,"nuevo valor");
}
//-------------------------------
function f($fun, $valor){
	return $fun($valor);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Ejemplo tema2 05</title>
<style type="text/css">
	body {
		background-color: #CEF6D8;
	}
	header {
		height: 75px;
		text-align: center;
		font-size: 2em;
		font-weight: bold;
	}
</style>
</head>
<body>
	<header>
		Ejemplo 05
	</header>
	<section>
	<?php
		
		$parametro="10/08/2016";
		if (comprobar_fecha($parametro)){
			echo " $parametro es una fecha correcta <br />";
		}else {
			echo "$parametro es una fecha incorrecta <br />";
		}
		
		echo "<p> El factorial de 5 es: ".factorial(5)."</p>";
		echo "<p> El factorial de 5 es: ".facto(5)."</p>";
		
		$pedro="Pedro";
		saludo($pedro);
		saludo();
		$vector=array(33,34,35);
		pasoVariables1($vector);
		foreach($vector as $valor){
			echo "$valor<br />";
		}
		echo "<p></p>";
		pasoVariables2($vector);
		foreach($vector as $valor){
			echo "$valor<br />";
		}
		echo "<p></p>";
		
	
		echo f('saludo',"Pedro")."<br />";
		echo f('factorial',6)."<br />";
		
		echo "<p>Errores: </p>";
		
		try {
			$a=5;
			$b=0;
			/*
			if ($b==0){
				throw new Exception('División por cero');
			}
			*/
			$c=$a/$b;
		}catch(Exception $e){
			echo "El error producido es ".$e->getMessage()."<br />";
		}
	
		
	?>
	</section>
</body>
</html>