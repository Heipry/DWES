<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
   <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
   <title>Ejercicio Tema 3</title>
   <link href="dwes.css" rel="stylesheet" type="text/css">
   <style>
   h1 {margin-bottom:0;}
   #encabezado {background-color:#ddf0a4;}
   #contenido {background-color:#EEEEEE;height:300px;}
   #pie {background-color:#ddf0a4;color:#ff0000;height:30px;}
   select{
        margin: 10px;
   }
   </style>
</head>
<body>
    <div id="encabezado">
        <h1>Ejercicio: Conjuntos de resultados en MySQLi</h1>
        <?php 
                $mensaje="";
                $dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'abc123.');
                $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        if (isset($_GET['id'])){
                        
                       // print_r($_GET);
                        
                        $consultaC = $dwes->prepare("UPDATE stock SET unidades = ? WHERE producto = ? AND tienda =  ?");
                       // $consultaC->bind_param('isi', $uni, $prod, $tienda);
                        $uni = $_GET['stock'];
                        if ($uni>0) {
                            $uni=$uni-1;
                        }else{
                            $mensaje .= "No hay stock que restar<br>";
                        }
                        $prod = $_GET['id'];
                        $tienda = $_GET['tienda'];
                        //echo $uni.$tienda.$prod;
                        try {
                            $consultaC->execute(array($uni,$prod,$tienda));
                            $mensaje .= $consultaC->rowCount(). " fila/s cambiada/s.<br>";
                        } catch (PDOException $ex) {
                            $mensaje .="Error ".$ex->getMessage()."<br>";
                        }
                        
                        //printf("%d filas cambiadas.\n", $consultaC->affected_rows);
                        //$consultaC->close();
                        unset($consultaC);
                    }
        ?>
        <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <select name="productos">
                <?php 
                    $consulta = 'SELECT distinct producto FROM stock';
                    try {
                        $resul = $dwes->query($consulta, MYSQLI_USE_RESULT);
                        $producto= $resul->fetch();
                        if (isset($_POST['productos']) || isset($_GET['id'])) {
                        $productoAnt = (isset($_POST['productos'])) ? $_POST['productos'] : $_GET['id'];
                        }else $productoAnt == '';
                        do{
                            $selec = '';
                            if ($productoAnt==$producto[0]) $selec = "selected";
                            echo '<option '.$selec.' value="'.$producto[0].'">'.$producto[0].'</option>';
                            $producto= $resul->fetch();            
                        }while ($producto!=null); 
                    } catch (PDOException $ex) {
                        $mensaje .="Error ".$ex->getMessage()."<br>";
                    }
                    
                
                 ?>             
          </select>
          <button type="submit">Mostrar stock</button> 
        </form>
    </div>
    <div id="contenido">
        <h2>Stock del producto</h2>
    <?php
        if (isset($_POST['productos']) || isset($_GET['id'])) {
            $producto = (isset($_POST['productos'])) ? $_POST['productos'] : $_GET['id'];
            try {
                $consulta1 = 'SELECT cod, nombre FROM tienda';
                $tiendas = $dwes->query($consulta1);
                $tienda= $tiendas->fetch();
                do{                    
                    $consulta2 = "SELECT unidades FROM stock where producto = '".$producto."' and tienda = $tienda[0]";
                    $stocks = $dwes->query($consulta2);                
                    $stock = $stocks->fetch();
                    $stockNum = (is_null($stock[0])) ? 0: $stock[0];
                    echo "<p>Stock en tienda $tienda[1] de $producto: $stockNum productos</p>";  
                  
               
            ?>
            <form id="form_action" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
            <input type="hidden" value="<?php  echo $producto ?>" name='id'>
            <input type="hidden" value="<?php  echo $tienda[0] ?>" name ='tienda'>
            <?php
                        if ($stockNum > 0) {
            ?> 
            <input type="hidden" value="<?php  echo $stockNum ?>" name='stock'>
            <button type="submit">Disminuir stock en 1</button> 
            <?php 
                        }
            ?>
            </form>
            <?php     
                $tienda= $tiendas->fetch();         
            }while ($tienda!=null); 
            } catch (Exception $ex) {
                $mensaje .="Error ".$ex->getMessage()."<br>";
            }
        }
    ?>
    </div>
    <div id="pie">
        <?php 
            unset($dwes);
            if (isset($mensaje)) echo $mensaje;
         ?>
    </div>
</body>
</html>