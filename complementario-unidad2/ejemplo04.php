<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Ejemplo tema2 04</title>
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
		Ejemplo 04
	</header>
	<section>
	<?php
		$a=4; 
		echo "la variable a es ".gettype($a)." y vale $a <br />";
		$b="Javier";
		echo "la variable b es ".gettype($b)." y vale $b <br />";
		$c="4";
		echo "la variable c es ".gettype($c)." y vale $c <br />";
		$d=4.5;
		echo "la variable d es ".gettype($d)." y vale $d <br />";
		$booleana=true;
		echo "la variable booleana es ".gettype($booleana)." y vale $booleana <br />";
		echo "<p></p>";
		$r=$a+1;
		echo "la variable r es ".gettype($r)." y vale $r <br />";
		$r=$a+$b;
		echo "la variable r es ".gettype($r)." y vale $r <br />";
		$r=$a.$b;
		echo "la variable r es ".gettype($r)." y vale $r <br />";
		$r=$a+$c;
		echo "la variable r es ".gettype($r)." y vale $r <br />";
		$r=$a.$c;
		echo "la variable r es ".gettype($r)." y vale $r <br />";
		$r=$a+$d;
		echo "la variable r es ".gettype($r)." y vale $r <br />";
		$r=$a.$d;
		echo "la variable r es ".gettype($r)." y vale $r <br />";
		$r=$booleana+$a;
		echo "la variable r es ".gettype($r)." y vale $r <br />";
		$r=$booleana.$a;
		echo "la variable r es ".gettype($r)." y vale $r <br />";
		echo "<p>if</p>";
		$a=4;
		$b="4";
		
		if ($a===$b) {
			echo "Coinciden en valor y en tipo<br/>";
		}elseif ($a==$b){
			echo "Coinciden solo en valor pero no en tipo<br />";
		}else {
			echo "No coinciden en valor, pero tipo...<br />";
		}
		
		echo "<p>switch<p>";
		
		$a="4";
		switch($a){
			case 4:
				echo "es el valor numérico 4<br />";
				break;
			case "4":
				echo "es el valor alfanumérico '4'<br />";
				break;
			default:
				echo "No es ninún valor anterior<br />";
		}
		
		echo "<p>while do-while for</p>";
		
		echo "<br/>while<br />";
		
		$i=0;
		while($i<3){
				echo "while: $i<br/>";
				$i++;
		}
		
		echo "<br/>do-while<br />";
		
		$i=0;
		do{
				echo "do-while: $i<br/>";
				$i++;
		}while ($i<3);
		
		echo "<br />for<br />";
	
		for($i=0;$i<3;$i++){
			echo "for: $i<br/>";
		}
		
		echo "<p>Vectores y matrices</p>";
		
		$a=array(33,"17",'pepe',5.4);
		
		echo "<br />el tipo de un vector es ".gettype($a)."<br />";
		
		for($i=0;$i<count($a);$i++){
			echo '$a['.$i.'] es '.$a[$i]."<br />";
		}
		echo "<p></p>";
		$b=array("alfa"=>33,23=>'juan',"ramon"=>13);
		
		foreach($b as $indice=>$valor){
			echo '$b['.$indice.'] es '.$valor."<br />";
		}
		echo "<p></p>";
		$c=["javier"=>"genial","otros"=>"no tanto"];
		
		$c["alumnos"]="campeones";
		
		foreach($c as $valor){
			echo "Valor: $valor <br />";
		}
		echo "<p></p>";
		
		$matriz=[[1,2],[3,4],[5,6]];
		
		for($fila=0;$fila<count($matriz);$fila++){
			for($col=0;$col<count($matriz[$fila]);$col++){
				printf("%2d",$matriz[$fila][$col]);
			}
			echo "<br />";
		}
		
		echo "Comprobar si una variable está definida<br />";
		
		if (isset($matriz)) {
			echo "la variable está definida y es del tipo ".gettype($matriz)."<br />";
		}else{
			echo "la variable no esta definida<br />";
		}
		
		unset($matriz);
		
		if (isset($matriz)) {
			echo "la variable está definida y es del tipo ".gettype($matriz)."<br />";
		}else{
			echo "la variable no esta definida<br />";
		}
	?>
	</section>
</body>
</html>