<?php

function fechaCastellano() {
    date_default_timezone_set('Europe/Madrid'); //Definir zona
    $dia = date('N'); //Num dia semana
    $mes = date('n'); // Num mes
    $diames = date('j'); 
    $anyo = date('Y');
    $arrayDia = ['0','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
    $arrayMes = ['0', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio','Agosto',
            'Septiembre','Octubre','Noviembre','Diciembre'];
    $diaEs = $arrayDia[$dia];
    $mesEs = $arrayMes[$mes];
    echo $diaEs.', ',$diames.' de '.$mesEs.' de '.$anyo;
}
?>

