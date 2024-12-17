<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include 'mySQLConnection.php';
        if (isset($_POST['idProv'])) {
            $sql = "DELETE FROM proveedor WHERE CodigoProveedor = " . $_POST["idProv"] . ";";
            $result = $conn->query($sql);
            echo "Proveedor borrado.";
        }
    ?>
        <!-- Html Aqui!!!!!! -->
    <body>
    <h4>Borrar Articulo</h4>
    <form method="POST">
        <label for="idEmp">ID del proveedor a borrar:</label><br>
        <input type="text" id="idEmp" name="idProv"><br>
        <input type="submit" value="Borrar proveedor">
    </form> 
    </body>
</body>
</html>
