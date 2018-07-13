
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title></title>
    </head>
    <body>
        <h1> ¿Que dia es? </h1>
        <?php
        // Mostrar fecha en castellano: Lunes, 13 de abril de 2018
        date_default_timezone_set('Europe/Madrid'); //Definir zona
        $dia = date('N'); //Num dia semana
        $mes = date('n'); // Num mes
        $diames = date('j'); 
        $anyo = date('Y');
        switch ($dia) {
            case 1:
                $diaEs = 'Lunes';
                break;
            case 2:
                $diaEs = 'Martes';
                break;
            case 3:
                $diaEs = 'Miercoles';
                break;
            case 4:
                $diaEs = 'Jueves';
                break;
            case 5:
                $diaEs = 'Viernes';
                break;
            case 6:
                $diaEs = 'Sabado';
                break;
            default:
                $diaEs = 'Domingo';
                break;
        }
        $arrayMes = ['0', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio','Agosto',
            'Septiembre','Octubre','Noviembre','Diciembre'];
        $mesEs = $arrayMes[$mes];
        echo $diaEs.', ',$diames.' de '.$mesEs.' de '.$anyo;
        ?>
    </body>
</html>



