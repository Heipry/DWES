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
        <form action="procesa.php" method="post">
        	<label for="name">Nombre</label>
        	<input type="text" name="name">
        	<label for="ciclo">Ciclo</label>
        	<select name="ciclo">
        		<option value="DWES"> Desarrollo Web en Entorno Servidor</option>
        		<option value="DWEC"> Desarrollo Web en Entorno Cliente</option>
        	</select>
        	<input type="submit" value="Enviar" >
        </form>
    </body>
</html>