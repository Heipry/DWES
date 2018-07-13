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
            while ($comando = each($_SERVER)){
                echo "<tr><td>$comando[0]</td><td>$comando[1]</td></tr>";
            }
        ?>
            </tbody>
        </table>
    </body>
</html>