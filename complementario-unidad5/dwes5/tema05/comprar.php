<?php
require_once("Foto.class.php");
require_once("AccesoFotos.class.php");
require_once("Pantalla.class.php");
require_once("Carrito.class.php");
//
function valida_nif_cif_nie($cif) {
//Copyright ©2005-2011 David Vidal Serra. Bajo licencia GNU GPL.
//Este software viene SIN NINGUN TIPO DE GARANTIA; para saber mas detalles
//puede consultar la licencia en http://www.gnu.org/licenses/gpl.txt(1) //Esto es software libre, y puede ser usado y redistribuirdo de acuerdo //con la condicion de que el autor jamas sera responsable de su uso.
//Returns: 1 = NIF ok, 2 = CIF ok, 3 = NIE ok, -1 = NIF bad, -2 = CIF bad, -3 = NIE bad, 0 = ??? bad
         $cif = strtoupper($cif);          for ($i = 0; $i < 9; $i ++)
         {
                  $num[$i] = substr($cif, $i, 1);
         }
//si no tiene un formato valido devuelve error
         if (!preg_match('/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/', $cif))
         {
                  return 0;
         }
//comprobacion de NIFs estandar
         if (preg_match('/(^[0-9]{8}[A-Z]{1}$)/', $cif))
         {
                  if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 0, 8) % 23, 1))
                  {
                           return 1;
                  }                   else                   {
                           return -1;
                  }
         }
//algoritmo para comprobacion de codigos tipo CIF          $suma = $num[2] + $num[4] + $num[6];          for ($i = 1; $i < 8; $i += 2)
         {
                  $suma += substr((2 * $num[$i]),0,1) + substr((2 * $num[$i]), 1, 1);
         }
         $n = 10 - substr($suma, strlen($suma) - 1, 1);
//comprobacion de NIFs especiales (se calculan como CIFs o como NIFs)          if (preg_match('/^[KLM]{1}/', $cif))
         {
                  if ($num[8] == chr(64 + $n) || $num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 1, 8) % 23, 1))
                  {
                           return 1;
                  }                   else                   {
                           return -1;
                  }
         }
//comprobacion de CIFs
         if (preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $cif))
         {
                  if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1))
                  {
                           return 2;
                  }                   else                   {
                           return -2;
                  }
         }
//comprobacion de NIEs
         if (preg_match('/^[XYZ]{1}/', $cif))
         {
                  if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(array('X','Y','Z'), array('0','1','2'), $cif), 0, 8) % 23, 1))
                  {
                           return 3;
                  }                   else                   {
                           return -3;
                  }
         }
//si todavia no se ha verificado devuelve error          return 0;
}

/*
-------------------------------------
Aquí comienza el código del script
-------------------------------------
*/
session_cache_limiter('nocache, private');
session_start();
if (!isset($_SESSION['variable'])){
	session_destroy();
	unset($_SESSION);
	header("Location: index.php");
	exit;
}	
$datosCorrectos=true;
$nif="";
if (isset($_POST['nif'])){
	$nif=strip_tags(trim($_POST['nif']));
}else{
	$datosCorrectos=false;
}
if (valida_nif_cif_nie($nif)<=0){
	$datosCorrectos=false;
}  

$nombre="";
if (isset($_POST['nombre'])){
	$nombre=strip_tags(trim($_POST['nombre']));
}
if (empty($nombre)){
	$datosCorrectos=false;
}

$direccion="";
if (isset($_POST['direccion'])){
	$direccion=strip_tags(trim($_POST['direccion']));
}
if (empty($direccion)){
	$datosCorrectos=false;
}

if (!$datosCorrectos){
	$mensaje="mensaje=".urlencode("Algún dato no es correcto");
	$mensaje.="&nif=".urlencode($nif);
	$mensaje.="&nombre=".urlencode($nombre);
	$mensaje.="&direccion=".urlencode($direccion);
	header("Location: cesta.php?".$mensaje);
	exit;
}
$carrito=new Carrito($_SESSION['variable']);
$numeroCompra=$carrito->numeroDeCompra();
$fotos=$carrito->listarGalletas();
$numeroProductos=$carrito->numeroProductos();
$volver="nif=".urlencode($nif)."&nombre=".urlencode($nombre)."&direccion=".urlencode($direccion);

$bd=new AccesoFotos();
$bd->crearCompra($numeroCompra,$nif,$nombre,$direccion,$fotos);

$pantalla=new Pantalla("../../pantallas/tema05");

$parametros=array('afotos' => $fotos,
				  'numeroProductos'=>$numeroProductos,
				  'numeroCompra'=>$numeroCompra,
				  'nif'=>$nif,
				  'nombre'=>$nombre,
				  'direccion'=>$direccion,
				  'volver'=>$volver);

$pantalla->mostrar("comprar.tpl",$parametros);

?>