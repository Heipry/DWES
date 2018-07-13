<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title></title>
    </head>
    <body>
        <table border="1">
            <thead>
                <tr>
                    <th>Variable</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
        <?php
            foreach ($_SERVER as $var => $valor) {
                echo "<tr><td>$var</td><td>$valor</td></tr>";
            }
        ?>
            </tbody>
        </table>
    </body>
</html>


