<?php
$usuario="";
if (!isset($_POST['usuario'])){
	header("Location: login.php");
	exit;
}
$usuario=strip_tags(trim($_POST['usuario']));
$clave="";
if (!isset($_POST['clave'])){
	header("Location: login.php");
	exit;
}
$clave=strip_tags(trim($_POST['clave']));
if (empty($usuario) || strlen($usuario)>20 || empty($clave) || strlen($clave)>20){
	header("Location: login.php?mensaje=".urlencode("Usuario inexistente o clave no reconocida"));
	exit;
}
$canal=@mysqli_connect(IP,USUARIO,CLAVE,BD);
if (!$canal){
	echo "Ha ocurrido el error: ".mysqli_connect_errno()." ".mysqli_connect_error()."<br />";
exit;
}
mysqli_set_charset($canal,"utf8");

$sql="select nombre,perfil from usuarios where usuario=? and clave=?";
$consulta=mysqli_prepare($canal,$sql);
if (!$consulta){
	echo "Ha ocurrido el error: ".mysqli_errno($canal)." ".mysqli_error($canal)."<br />";
exit;	
}
mysqli_stmt_bind_param($consulta,"ss",$uusuario,$cclave);
	
$uusuario=$usuario;
$cclave=sha1($clave);

mysqli_stmt_execute($consulta);
mysqli_stmt_bind_result($consulta, $nnombre,$pperfil);
mysqli_stmt_store_result($consulta);
$n=mysqli_stmt_num_rows($consulta);


if ($n!=1){
	header("Location: login.php?mensaje=".urlencode("Usuario inexistente o clave no reconocida"));
	exit;
}

mysqli_stmt_fetch($consulta);
mysqli_stmt_close($consulta);
unset($consulta);

//Se inicia sesión
session_name("SESION");
session_cache_limiter('private,nocache');
session_start();

//Datos básicos del usuario (secretos)
$_SESSION['validado']=true;
$_SESSION['usuario']=$usuario;
$_SESSION['nombre']=$nnombre;
$_SESSION['perfil']=$pperfil;		


$sql="select codigoPagina from accede where codigoPerfil=?";
$consulta=mysqli_prepare($canal,$sql);
if (!$consulta){
	echo "Ha ocurrido el error: ".mysqli_errno($canal)." ".mysqli_error($canal)."<br />";
exit;	
}
mysqli_stmt_bind_param($consulta,"s",$cperfil);
	
$cperfil=$pperfil;
	
mysqli_stmt_execute($consulta);
mysqli_stmt_bind_result($consulta, $nPagina);
$paginas=array();
while(mysqli_stmt_fetch($consulta)){
	array_push($paginas,$nPagina);
}
$_SESSION['paginas']=$paginas;


mysqli_stmt_close($consulta);
unset($consulta);

$sql="select m.linea, p.url from opcionMenu op, menu m, paginas p where m.codigo=op.codigoMenu and m.codigoPagina=p.codigo and op.codigoPerfil=?";
$consulta=mysqli_prepare($canal,$sql);
if (!$consulta){
	echo "Ha ocurrido el error: ".mysqli_errno($canal)." ".mysqli_error($canal)."<br />";
exit;	
}
mysqli_stmt_bind_param($consulta,"s",$cperfil);
	
$cperfil=$pperfil;
	
mysqli_stmt_execute($consulta);
mysqli_stmt_bind_result($consulta, $linea,$url);
$menu=array();
while(mysqli_stmt_fetch($consulta)){
	$opcion=array();
	$opcion['linea']=$linea;
	$opcion['url']=$url;
	array_push($menu,$opcion);
}
$_SESSION['menu']=$menu;

mysqli_stmt_close($consulta);
unset($consulta);

mysqli_close($canal);
?>