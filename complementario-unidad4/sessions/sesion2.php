<?php
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
	width: 60%;
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
Sesión 2
</header>
<section>
<article>
<?php
echo"El nombre de la sesión es: ".session_name()." y su valor: ".session_id()."<br />";
?>
</article>
</section>
<footer id="footer">
<a href="sesion1.php" class="enlaceboton">Sesión 1</a>
</footer>
</body>
</html>