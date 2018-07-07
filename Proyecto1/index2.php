<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include 'autor.inc.php'; //Importamos archivo
        include 'fecha.inc.php';
        /*Podriamos usar include_once para asegurarnos de importarlo una sola vez
         * require para asegurarnos de que ha sido importado y sino parar ejecucion
         * o require_once
         */ 
        echo $autor; //Usamos variable del archivo importado
        echo '<br>';
        $autor = anadirApellido($autor);
        echo $autor;
        echo '<br>';
        $otro = anadirApellido();
        echo $otro;
        echo '<br>';
        anadirOtroApellido($otro);
        echo $otro;
        echo '<br>';
        fechaCastellano();
        echo '<br>';
        // Crear arrays: 2 notaciones
        $modulos2 = array('DWES', 'DWEC', 'DAW', 'DIW', 'EIE');
        $modulos1 =['PROG', 'BBDD', 'LMSGI', 'FOL', 'ED', 'SI'];
        print_r($modulos1); // Muestra el array completo
        echo '<br>';
        print_r($modulos2);
        echo '<br>';
        // Array asociativo
        $modulos2b = array('DWES'=> 'Entorno Servidor',
            'DWEC'=>'Entorno cliente',
            'DAW'=>'Despliegue',
            'DIW'=>'Diseño de interfaces',
            'EIE'=>'Empresa');
        print_r($modulos2b);
        echo '<br>';
        // Array Bidimensional
        $daw = array('Primero'=>$modulos1, 'Segundo'=>$modulos2);
        print($daw['Primero'][0]);
        echo '<br>';
        $modulosSegundo = $modulos2;
        // Añadir valores
        $modulos2[5]='FCT';//Con posicion
        $modulos2[ ]='PROY';//Sin posicion
        print_r($modulos2);
        echo '<br>';
        //String como array de caracteres
        echo $autor[5];
        echo '<br>';
        //Recorrer Array
        foreach ($modulos2 as $asig) {
            echo $asig.' || ';
        }
        echo '<br>';
        foreach ($modulos2b as $codigo => $asig) {
            echo $codigo.' = '.$asig.' || ' ;
        }
        echo '<br>';
        // Recorrer Array con puntero
        while ($modulo = each($modulos2b)) {
            print $modulo[0]. ' es '.$modulo[1].' || ';
        }
        echo '<br>';
        // Eliminar valor de array
        unset($modulos1[2]);
        print_r($modulos1); //Falta el indice 2
        echo '<br>';
        if (is_array($modulos1)){
            $modulos1=array_values($modulos1);
        }
        print_r($modulos1); //Ya no falta el indice 2
        echo count($modulos1).' elementos<br>'; //Pero tiene un elemento menos
        //Busqueda en array
        //Devolviendo true or false
        if (in_array($modulosSegundo,$daw)) echo "En DAW se imparte un segundo curso<br>";
        if (in_array('DAW',$modulos2)) echo "En segundo se imparte despliegues<br>";
        // Devolviendo posicion o false
        if (array_search('DIW',$modulos2)) echo "En segundo se imparte diseño<br>";
        // Buscando la clave
        if (array_key_exists('DWES', $modulos2b)) echo "En segundo se imparte Servidor<br>";

        //Podemos definir la función más tarde
        function anadirApellido($nombre="Jose Luis"){//Parametro por defecto, si hubiera otros sin
                                    //defecto deberían ir siempre antes del de por defecto
            $nombre .= ' Garrido';
            return $nombre;// Return necesario ya que parametro se pasa por valor y
                            // no por referencia
        }
        function anadirOtroApellido (&$nombre){//Parametro por referencia
            $nombre .= ' Gutierrez';
        }
        
        ?>
    </body>
</html>