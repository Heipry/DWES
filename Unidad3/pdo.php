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
        $opcionesPDO = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'abc123.', $opcionesPDO);
        $version = $dwes->getAttribute(PDO::ATTR_SERVER_VERSION);
        $serv = $dwes->getAttribute(PDO::ATTR_SERVER_INFO);
        echo "$serv con $version";
        $dwes->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
        //Consultas de modificación devuelven numero de registros afectados
        $registros = $dwes->exec("UPDATE stock SET unidades = 2 WHERE producto LIKE '%ACERA%' AND unidades =  0");
        echo '<br> Registros modificados: '.$registros;
        //Consultas con devolución
        $resul = $dwes->query("SELECT cod FROM tienda");
        $resultado = $resul->fetchAll();
        
        
        foreach ($resultado as $fila) {
            print '<br>';
            print_r($fila);       
            
        }

        // Consultas preparadas
        $cons = $dwes->prepare('INSERT INTO stock (producto, tienda, unidades) VALUES (:pr, :ti, :uni)');
        $produc = 'ACERAX3950';
        $tien = 2;
        $u = 0;
        $cons->bindParam(":pr", $produc);
        $cons->bindParam(":ti", $tien);
        $cons->bindParam(":uni", $u);
        $salida1=$cons->execute();
        $salida2=$cons->execute(array(":pr"=>"ACERAX3950", ":ti"=>3,":uni"=>0));
        if ($salida1) {
            echo "1 bien";
        } else echo '1 mal';
        if ($salida2) {
            echo "2 bien";
        } else echo '2 mal';
        ?>
    </body>
</html>
