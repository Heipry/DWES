<!DOCTYPE html>

    <head>
        
        <!-- Global Metas -->
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="Javier Diaz">
        <meta name="keywords" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Formulario</title>

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS's -->
    </head>
    <body>
        <?php
            /* Validamos formulario reenviandolo a la misma pagina. Si ya se ha enviado
             * hacemos la validacion (de haberla) y mostramos,
             *  si no se ha enviado mostramos el formulario
             */
        $mensaje = 0;
        if (!empty($_POST['name']) && !empty($_POST['name'])){
            echo 'Su nombre: '.$_POST['name'].' y ciclo: '.$_POST['ciclo'].' han sido recogidos';
             $mensaje = 0;
        }else{       
        //Dejamos script sin terminar para usar html    
        ?>
        <!--Cambiamos action por php llamando a la misma página
        Modificamos value y selected para mostrar algo si ya existe la variable-->
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        	<label for="name">Nombre</label>
        	<input type="text" name="name" value="<?php 
                if (isset($_POST['enviar'])){
                if (!empty($_POST['name'])){ echo $_POST['name'];}
                    else {$mensaje=1;}
                } ?>" >
        	<label for="ciclo">Ciclo</label>
        	<select name="ciclo">
        		<option value="DWES"> Desarrollo Web en Entorno Servidor</option>
        		<option value="DWEC"  <?php 
                        if (isset($_POST['enviar'])){
                            if ($_POST['ciclo']=='DWEC')
                                {echo 'selected';}
                     
                        }?>
                            > Desarrollo Web en Entorno Cliente</option>
        	</select>
        	<input type="submit" value="Enviar" name="enviar">
        </form>
        <?php
        // Cerramos script
        }
        if ($mensaje == 1){
            echo 'El nombre no puede estar vacio';
        }
     
        ?>
    </body>
</html>