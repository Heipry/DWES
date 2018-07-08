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
        if (!empty($_POST['enviar'])){
            $anyo = (int)substr($_POST['fecha'],0,4);
            $mes = (int)substr($_POST['fecha'],5,2);
            $diames = (int)substr($_POST['fecha'],8,2);
            if (checkdate($mes, $diames, $anyo)){
            $tiempo = mktime('0', '0', '0', $mes, $diames, $anyo);
            $diaSemana = date('N', $tiempo);
            $arrayDia = ['0','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
            $arrayMes = ['0', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio','Agosto',
            'Septiembre','Octubre','Noviembre','Diciembre'];
            $diaEs = $arrayDia[$diaSemana];
            $mesEs = $arrayMes[$mes];
            echo $diaEs.', ',$diames.' de '.$mesEs.' de '.$anyo;
            }else {
                echo 'La fecha es incorrecta';
            }
        }else{
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        	<label for="fecha">Fecha</label>
        	<input type="date" name="fecha">
        	
        	<input type="submit" value="Enviar" name="enviar" >
        </form>
        <?php } ?>
    </body>
</html>
