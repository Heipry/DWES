<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
header('WWW-Authenticate: Basic Realm="Contenido restringido"');
header('HTTP/1.0 401 Unauthorized');
echo "Usuario no reconocido!";
exit;
}
else{
	//Conectamos bd
	@ $dwes = new mysqli("localhost", "dwes", "abc123.", "dwes");
$error = $dwes->connect_errno;
if ($error == null) {
	// Ejecutamos consulta
	$sql = $dwes->stmt_init();
	$sql->prepare("SELECT usuario FROM usuarios WHERE usuario = ? AND contrasena = md5(?)");
	//$usuario = $_SERVER['PHP_AUTH_USER'];
	//$pass = $_SERVER['PHP_AUTH_PW'];
	$sql->bind_param("ss",$_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW']);
	$sql->execute();
	$resul = $sql->fetch();
//	var_dump($resul);
//	die();
	if ($resul==null) {
		header('WWW-Authenticate: Basic Realm="Contenido restringido"');
		header('HTTP/1.0 401 Unauthorized');
		exit;
	}
	$sql->close();
	$dwes->close();
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "
http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 4 : Desarrollo de aplicaciones web con PHP -->
<!-- Ejemplo: Autentificación HTTP -->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Ejemplo Tema 4: Autentificación HTTP</title>
<link href="dwes.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
echo "Nombre de usuario: ".$_SERVER['PHP_AUTH_USER']."<br />";
echo "Contraseña: ".$_SERVER['PHP_AUTH_PW']."<br />";
header('WWW-Authenticate: Basic Realm="Para salir presione cancelar"');
header('HTTP/1.0 401 Unauthorized');
echo "Usuario no reconocido!";
?>
</body>
</html>