<?php
session_name("MiSesion");
session_start();
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Sesiones</title>
<style type="text/css">
body {
	font-family: verdana;
}
header {
		padding: 20px;
		font-size: 2em;
		font-weight: bold;
		background-color: red;
		color: white;
		margin-bottom: 15px;
	}
article {
	width: 70%;
	margin: 0 auto;
}

.enlaceboton {
	text-decoration:none;
	color: white;
	border: 1px solid black;
	padding:5px;
	background-color: black;
}

#footer {
   position:fixed;
   left:0px;
   bottom:0px;
   height:30px;
   width:100%;
   background:#999;
   font-size: .8em;
   font-weight: bold;
   color: white;
}
.nada {
	font-size: .5em;
}
</style>
</head>
<body>
<header>
Sesión 3
</header>
<section>
<article>
<?php
echo"El nombre de la sesión es: ".session_name()." y su valor: ".session_id()."<br />";
$_SESSION['variable1']="valor 1";
$_SESSION['variable2']="valor 2";
?>
</article>
</section>
<footer id="footer">
<a href="sesion4.php" class="enlaceboton">Sesión 4</a>
</footer>
</body>
</html>