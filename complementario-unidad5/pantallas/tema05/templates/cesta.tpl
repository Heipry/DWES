<!doctype html>
<html lang="es">
<head>
<meta charset="utf8" />
<title>Tienda ON-Line</title>
<link rel="stylesheet" type="text/css" href="css/css.css">
<script type="text/javascript">
function muestraMensaje(mensaje){
	if (mensaje!='')
		alert(mensaje);
}
</script>
</head>
<body onload="muestraMensaje('{$mensaje}');">
<header id="cabecera">
	<img src="imagenes/titulo.png" alt="Tienda" />
</header>
<section>
<article id="navegacion">
	<a href="index.php"><img src="imagenes/volver.gif" alt="volver" /></a>
	<div id="carrito">
		<img src="imagenes/basket.png" alt="carrito" class="alinea" />
		<span style="color:blue">{$numero} productos</span>
	</div>
</article>
<article id="articulo" class="centrar">
{if $numero == 0}
	No hay artículos
{else}
	{assign var="totalFactura" value=0}
	<table>
	<caption>Productos en la cesta</caption>
	<tr>
	<th>Imagen</th><th>Precio</th><th></th>
	</tr>
	{foreach from=$afotos item=afoto}
		{assign var="totalFactura" value=$totalFactura + $afoto->precio}
		<tr>
			<td>
				<img src="{$afoto->baja}" alt="{$afoto->codigo}" />
			</td>
			<td>
				{$afoto->precio}&euro;
			</td>
			<td>
				<form action="eliminar.php" method="post">
					<input type="image" src="imagenes/borrar.png" alt="eliminar del carrito" />
					<input type="hidden" name="codigo" value="{$afoto->codigo}" />
				</form>
			</td>
		</tr>
	{/foreach}
	</table>
	<div id="comprar">
		<p>Total Pedido: {$totalFactura}&euro;</p>
		<form action="comprar.php" method="post">

		NIF: <input type="text" name="nif" size="9" maxlength="9" value="{$nif}" />
		<br />
		Nombre: <input type="text" name="nombre" value="{$nombre}" />
		<br />
		Dirección: <input type="text" name="direccion" value="{$direccion}" />
		<br />
		<input type="image" src="imagenes/boton-comprar-ahora.png" alt="comprar" />
		</form>
	</div>
{/if}
</article>
</section>
</body>
</html>