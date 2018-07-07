<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // Cadenas con <<<
        $b = 'Esta es';
        $a = <<<TEXTO
                $b una página para pruebas<br>
TEXTO;
        $c = <<<'TEXTO'
                $b una página para pruebas<br>
TEXTO;
       //Funciones
        print $a.$c.'<br>';
        print gettype($c).'<br>';
        echo is_int($a).' enteras<br>';
        echo is_string($a).' cadenas<br>';
        settype($a, 'integer');
        echo is_int($a).' enteras<br>';
        echo 'Ahora $a es un ' . gettype($a). " y vale $a <br>";
        echo empty($d). " vacias";
        $d = "";
        echo empty($d)." vacias<br>";
        //formato fecha
        date_default_timezone_set('Europe/Madrid'); //Definir zona
        echo date('l,d-m-y').'<br>'; //Formatear fecha (sin parametros=actual)
        $array = getdate(); //Conseguir fecha actual
        foreach ($array as $cadena) {
            echo $cadena. ' || ';
        }
        echo '<br>';
        //Variables superglobales
        //
        $datos = $_SERVER;
        echo 'programa actual: '.$datos['PHP_SELF'].'<br>';
        echo 'IP actual: '.$datos['SERVER_ADDR'].'<br>';
        echo 'Direectorio: '.$datos['PHP_SELF'].'<br>';
        echo 'Nombre servidor: '.$datos['SERVER_NAME'].'<br>';
        echo 'IP Usuario: '.$datos['REMOTE_ADDR'];
        echo '<br>GET: ';// Usar Proyecto1/index.php?v1=hola
        foreach ($_GET as $param) {
            echo $param. ' || ';
        }
        $array = getdate();
        if ($array[0]%2==0) {goto salto;}
        elseif ($datos['REMOTE_ADDR']=='127.0.0.1') {
            echo '<h3>Estás aquí</h3>';
        }else echo '<h3>No estás aquí<h3>';
        echo '<h3>Segundos impares</h3>';
        salto:
            echo ('fin '.$array[0].'<br>');
    switch (count($_GET)) {
    case 0:
        echo 'La página venia limpia';

                    break;

    default:
        echo 'La página traía parametros: ';
        break;
    }
    // Bucles
    $cuenta = 0;
    while ($cuenta <= 5) {
        echo $cuenta.'<br>';
        $cuenta++;            
    }
    do {
    echo 'Esto se ejecuta al menos una vez<br>';
} while ($cuenta<5);
    for ($i = 0; $i <= 10; $i++) {
        if ($i==3) {   //Si es 3 saltamos al siguiente         
            continue;            
        }
        echo $i.'<br>';
        if ($i==5) { //Si es 5 salimos
            break;
        }
    }
        ?>
    </body>
</html>
