<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
header('WWW-Authenticate: Basic Realm="Contenido restringido"');
header('HTTP/1.0 401 Unauthorized');
echo "Usuario no reconocido!";
exit;
}
//Abrimos sesion
session_start();
if (!isset($_SESSION['usuario'])){
	//Conectamos bd
	@ $dwes = new mysqli("localhost", "dwes", "abc123.", "dwes");
	$error = $dwes->connect_errno;
	if ($error == null) {
		date_default_timezone_set('Europe/Madrid');
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
		}else{ //Guardamos el usuario en la sesion
			$_SESSION['usuario'] = $_SERVER['PHP_AUTH_USER'];
		}
		$sql->close();
		$dwes->close();
	}
}else{//esta autentificado
	if (isset($_POST['limpiar'])) unset($_SESSION['visita']);
	else $_SESSION['visita'][]= time(); //Array con horas de visita
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
if(isset($_SESSION['visita']) && count($_SESSION['visita'])!=0){ //Usamos visitas de sesion
	date_default_timezone_set('Europe/Madrid');
	foreach ($_SESSION['visita'] as $v) {
		echo "Registro: ". date("d/m/y \a \l\a\s H:i", $v).'<br>';
	}
}else echo "Bienvenido en su primera visita";

?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" id='vaciar' method="post">
	<input type="submit" name="limpiar" value="Limpiar sesion">
</form>
</body>
</html>