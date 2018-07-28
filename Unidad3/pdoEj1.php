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
        // Transacciones
        $dwes2 = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'abc123.');
         $dwes2->beginTransaction();
        //$dwes2->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
          $ok=true;
        for ($i = 1; $i <= 3; $i++) {         
            
            if ($dwes2->exec("UPDATE stock SET unidades=1 WHERE producto='PAPYRE62GB' AND tienda= $i")==0){
                if ($dwes2->exec("INSERT INTO stock (producto, tienda, unidades) VALUES ('PAPYRE62GB',$i,1)")==0){
                    $unidadesViejas=$dwes2->query("SELECT unidades FROM stock WHERE producto='PAPYRE62GB' AND tienda=$i" );
                    $unidadesViejas->bindColumn(1, $nUni);
                    $unidadesViejas->fetch();
                    if ($nUni!=1){
                        $ok=false;
                                            echo $i." no 1----<br>";

                    }
                }                
            }
        }
        
        if ($ok){
            $dwes2->commit();
            echo 'Transaccion finalizada';

        }
        else{
            $dwes2->rollBack();
            echo 'Transaccion no finalizada';
        }
        ?>
    </body>
</html>
