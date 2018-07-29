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
   #contenido {background-color:#EEEEEE;height:600px;}
   #pie {background-color:#ddf0a4;color:#ff0000;height:30px;}
   select{
        margin: 10px;
   }
   </style>
</head>
<body>
    <div id="encabezado">
        <h1>Ejercicio: Conjuntos de resultados con PDO</h1>
        <?php 
                $mensaje="";
                $dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'abc123.');
                
        ?>
        <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <select name="productos">
                <?php 
                    $consulta = 'SELECT distinct producto FROM stock';
                    $resul = $dwes->query($consulta);
                    $producto= $resul->fetch();
                    if (isset($_POST['productos'])) {
                    $productoAnt =$_POST['productos'];
                    }else $productoAnt == '';
                    do{
                        $selec = '';
                        if ($productoAnt==$producto[0]) $selec = "selected";
                        echo '<option '.$selec.' value="'.$producto[0].'">'.$producto[0].'</option>';
                        $producto= $resul->fetch();            
                    }while ($producto!=null); 
                
                 ?>             
          </select>
          <button type="submit">Mostrar stock</button> 
        </form>
    </div>
    <div id="contenido">
        <h2>Stock del producto</h2>
    <?php
        if (isset($_POST['productos'])) {
            $producto =  $_POST['productos'];
            $consulta1 = 'SELECT cod, nombre FROM tienda';
            $tiendas = $dwes->query($consulta1);
            $tienda= $tiendas->fetch();
            do{                    
                $consulta2 = "SELECT unidades FROM stock where producto = '".$producto."' and tienda = $tienda[0]";
                $stocks = $dwes->query($consulta2);                
                $stock = $stocks->fetch();
                $stockNum = (is_null($stock[0])) ? 0: $stock[0];
                echo "<p>Stock en tienda $tienda[1] de $producto: $stockNum productos</p>";  
  
                $tienda= $tiendas->fetch();         
            }while ($tienda!=null); 
        }
    ?>
    </div>
    <div id="pie">
        <?php 
            unset($dwes);
            if (isset($mensaje)) {
            echo $mensaje;
        }
        ?>
    </div>
</body>
</html>