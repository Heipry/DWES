<?php
header('WWW-Authenticate: Basic Realm="Para salir presione cancelar"');
header('HTTP/1.0 401 Unauthorized');
echo "Usuario no reconocido!";
?>