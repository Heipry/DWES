<!doctype html>
<html lang="es">
<head>
<meta charset="utf8" />
<title>Tienda ON-Line</title>
<link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<body>
<header id="cabecera">
	<img src="imagenes/titulo.png" alt="Tienda" />
</header>
<section>
<article id="navegacion">
	<a href="index.php"><img src="imagenes/volver.gif" alt="volver" /></a>
	<div id="carrito">
		<img src="imagenes/basket.png" alt="carrito" class="alinea" />
		<a href="cesta.php">{$numero} productos</a>
	</div>
</article>
<article id="articulo" class="centrar">
<img src="{$afoto->baja}" alt="{$afoto->codigo}" />
<p><span class="grande">Descripción: {$afoto->descripcion}</span></p>
<p><span class="grande">Precio: {$afoto->precio}&euro;</span></p>
<p>
	<form action="anyadir.php" method="post">
	<input type="hidden" name="codigo" value="{$afoto->codigo}" />
	<input type="image" src="imagenes/botoncomprar.png" alt="añadir al carrito" />
	</form>
</p>
</article>
</section>
</body>
</html>