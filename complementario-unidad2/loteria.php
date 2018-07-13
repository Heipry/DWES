<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ejercicio Tema 2</title>
		<!-- Se importa el tipo de letra Lobster desde Google fonts -->
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<!-- Definimos el aspecto de las distintas partes -->
		<style type="text/css">
			header h1 {text-align: center; 
				font-size: 2em; 
				color: #f0f0f0; 
				background-color: #c0c0c0;}

			#formulario {margin-top: 50px; 
				border-style: solid; 
				border-color: red; 
				margin-left: auto; 
				margin-right: auto; 
				padding: 10px; 
				width: 500px;}

			#formu {text-align: center; 
				line-height: 200%}

			.escogidos {border-style: ridge; 
				border-width: 5px; 
				margin-top: 50px; 
				text-align: center; 
				width: 80%; 
				margin-left: auto; 
				margin-right: auto; 
				padding: 50px; 
				font-family: Lobster, serif;
				font-size: 3em;
				} 

		</style>
	</head>
	<body>
		<?php
			// Se comprueba que se ha enviado un número entre 1 y 49 si no es así la variable $numero toma el valor vacío
			if (isset($_POST['numero'])  && is_numeric($_POST['numero']) && $_POST['numero']>=0 && $_POST['numero']<=49)
				$numero=$_POST['numero'];
			else 
				$numero="";

			// Se crea el array para contener los distintos números que el usurio vaya guardando
			// Los valores se guardan en variables input de tipo hidden, cuyos nombre varían de "a0" a "a5"
			$quiniela=array(); //Creación del array

			// El código va recorriendo las variables hidenn transportadas y se introducen en quiniela
			$salir=false;
			$i=0;
			while (!$salir){
				if (isset($_POST["a".$i])){
					$quiniela[$i]=$_POST["a".$i];
					$i++;
				}else
					$salir=true;
			}

			// comprobamos si el nuevo número que introduce el usuario esta en la lista, si no es así, se incluye
			$estaEnLaLista=false;
			if (count($quiniela)<6 && !empty($numero)){
				for($i=0;$i<count($quiniela) && !$estaEnLaLista; $i++)
					if ($quiniela[$i]==$numero)
						$estaEnLaLista=true;
				if (!$estaEnLaLista)
					$quiniela[]=$numero;
			}
		?>
		<header><h1>Números Lotería Primitiva</h1></header>
		<section>
			<div id="formulario">
				<!-- formulario que inserta el nuevo valor del usuario -->
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="formu">
					<label for="numero">Número: </label> <input type="text" id="numero" name="numero" maxlength="2" size="2" /> <br />
					<input type="submit" value="Enviar" /><br />

					<!--
						Cada vez que actualizamos la página creamos valores de tipo input hidden para transportar los valores escogidos por el usuario 
					-->
					<?php
						for ($i=0; $i<count($quiniela); $i++)  					
							print "<input type='hidden' name='a".$i."' value='".$quiniela[$i]."' />";
					?>
				</form>
			</div>
			<!-- Presentación de los valores escogidos por el usuario -->
			<div class="escogidos">
					<?php
						for ($i=0; $i<count($quiniela); $i++)
							if ($i==0)
								print $quiniela[$i];
							else
								print ", ".$quiniela[$i];
					?>
			</div>
		</section>
	</body>
</html>