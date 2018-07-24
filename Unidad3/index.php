<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Unidad 3 DWES</title>
    </head>
    <body>
        <?php   
        include 'caja.inc.php';
        // Clases
        $micaja = new Caja;
        $micaja->introduce('platano');
        $micaja->muestra_contenido();
        //mysqli
        $dwes = new mysqli('localhost', 'dwes', 'abc123.', 'dwes');
        // @ ignora errores
        $error = $dwes->connect_errno;
        $errorMensaje = $dwes->connect_error;
        if ($error!=0) {
            echo $error. " | ". $dwes->connect_error;
        }  else {
            echo '<h3>Conexión establecida</h3>';
            //cambio base datos
            $dwes->select_db('proyecto1');
            $consulta = $dwes->real_query('CREATE TABLE prueba2 (
                                        cod VARCHAR( 6 ) NOT NULL)');
            if ($consulta) {
                echo 'tabla creada';
                $dwes->query('DROP TABLE prueba2');
                echo '<br>tabla borrada';
            }  else {
                
                echo 'Hubo un error';
            }
            $dwes->select_db('dwes');
            // Definimos una variable para comprobar la ejecución de las consultas
            $todo_bien = true;
            // Iniciamos la transacción
            $dwes->autocommit(false);
            $sql = 'UPDATE stock SET unidades=1 WHERE producto="3DSNG" AND tienda=1';
            if ($dwes->query($sql) != true) {
                $todo_bien = false;
                echo 'Error en update';
            }
            $sql = 'INSERT INTO `stock` (`producto`, `tienda`, `unidades`) VALUES ("3DSNG", 3,1)';
            if ($dwes->query($sql) != true) {
                $todo_bien = false;
                echo 'Error en insert';
            }
            // Si todo fue bien, confirmamos los cambios
            // y en caso contrario los deshacemos
            if ($todo_bien == true) {
                $dwes->commit();
                print "<p>Los cambios se han realizado correctamente.</p>";
            } else {
                $dwes->rollback();
                print "<p>No se han podido realizar los cambios.</p>";
            }
            $consulta = $dwes->real_query('UPDATE stock SET unidades = 1 WHERE '
                    . 'producto = "3DSNG" AND tienda =1');
            $consulta2 = 'SELECT producto, unidades FROM stock';
            $resul = $dwes->query($consulta2, MYSQLI_STORE_RESULT);
            $stock = $resul->fetch_array();
            do{
                
                echo '<br>'.$stock[0];
                echo ' : '.$stock[1];  
                $stock = $resul->fetch_array();              
            }while ($stock!=null);  

            // consultas preparadas (para ejecutar más de una vez)
            $cons = $dwes->stmt_init();
            $i =2;
            echo "<br>Tienda $i :";

            $cons->prepare("SELECT nombre FROM tienda where cod = ? ");
            $cons->bind_param('i', $i);
            $cons->execute();            
            $cons->bind_result($ntienda);
            $cons->fetch();
            echo '<br>'.$ntienda;
            $i =1;
            echo "<br>Tienda $i :";
            $cons->bind_param('i', $i);
            $cons->execute();            
            $cons->bind_result($ntienda);
            $cons->fetch();
            echo '<br>'.$ntienda;
            $cons->close();



            $dwes->close();            
        }
        echo '<p>Pagina index</p>';
        ?>
    </body>
</html>
