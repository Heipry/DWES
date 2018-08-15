<?php
include "../../seguridad/tema04/funciones.php";
inicioSesion();
session_destroy();
unset($_SESSION);
header("Location: login.php");
exit;
?>