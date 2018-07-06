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
            //$_SERVER
        echo 'programa actual: '.$_SERVER['PHP_SELF'];
        
        ?>
    </body>
</html>
