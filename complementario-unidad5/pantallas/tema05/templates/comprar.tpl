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
	<a href="cesta.php?{$volver}"><img src="imagenes/volver.gif" alt="volver" /></a>
	<div id="carrito">
		<img src="imagenes/basket.png" alt="carrito" class="alinea" />
		<span style="color:blue">{$numeroProductos} productos</span>
	</div>
</article>
<article id="articulo">
{if $numeroProductos == 0}
	No hay artículos
{else}
	{assign var="totalFactura" value=0}
	<div id="comprar" style="height: 500px; width: 600px; padding-left: 20px;">
		Id. compra: <span class="rojo">{$numeroCompra} </span>(TORMAR NOTA)<br />
		DNI/NIF/NIE: <span class="rojo">{$nif}</span><br />
		Nombre: <span class="rojo">{$nombre}</span><br />
		Dirección: <span class="rojo">{$direccion}</span><br />
		<p>
		{foreach from=$afotos item=afoto}
			{assign var="totalFactura" value=$totalFactura + $afoto->precio}
			<p>{$afoto->descripcion}  precio: {$afoto->precio}</p>
		{/foreach}
		</p>
		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_xclick" />
			<input type="hidden" name="business" value="psanbox-facilitator@v-espino.es" />
			<input type="hidden" name="item_name" value="Prueba de compra" />
			<input type="hidden" name="item_number" value="{$numeroCompra}" />
			<input type="hidden" name="currency_code" value="EUR" />
			<input type="hidden" name="amount" value="{$totalFactura}" />
			<input type="hidden" name="no_shipping" value="1" />
			<input type='hidden' name='lc' value='es' />
			<input type='hidden' name='country' value='ES' />
			<input type="hidden" name="notify_url" value="https://v-espino.com/tema05/ipn.php" />
			<input type="hidden" name="return" value="http://v-espino.com:3302/tema05/exito.php" />
			<input type="hidden" name="cancel_return" value="http://v-espino.com:3302/tema05/fracaso.php" />
			<input type="image" src="imagenes/final.jpg" name="submit" alt="Pagar y finalizar" />
			
		</form>
	</div>
{/if}
</article>
</section>
</body>
</html>