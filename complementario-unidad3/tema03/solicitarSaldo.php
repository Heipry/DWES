<?php
$ccc="";
if (isset($_GET['ccc'])){
	$ccc=strip_tags(trim($_GET['ccc']));
}
$mensaje="";
if (isset($_GET['mensaje'])){
	$mensaje=strip_tags(trim($_GET['mensaje']));
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Solicitar Saldo</title>
<style type="text/css">
header {
		padding: 20px;
		font-size: 2em;
		font-weight: bold;
		background-color: red;
		color: white;
		margin-bottom: 15px;
	}
section {
	width: 450px;
	margin: 0 auto;
}
</style>
</head>
<body>
<header>
Solicitar saldo
</header>
<section>
<p style="color: red"><?=$mensaje?></p>
<form action="calcularSaldo.php" method="post">
	Número de cuenta (ccc): <input type="text" name="ccc" size="24" maxlength="24" value="<?=$ccc?>" /><br /><br />
	<input type="submit" value="Calcular" />
</form>
</section>
</body>
</html>