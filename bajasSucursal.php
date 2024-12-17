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
        if (isset($_POST['idSuc'])) {
            $sql = "DELETE FROM sucursal WHERE CodigoSucursal = " . $_POST["idSuc"] . ";";
            $result = $conn->query($sql);
            echo "Sucursal borrada.";
        }
    ?>
    <!-- Html Aqui!!!!!! -->
    <body>
    <h4>Borrar Articulo</h4>
    <form method="POST">
        <label for="idEmp">ID de la sucursal a borrar:</label><br>
        <input type="text" id="idEmp" name="idSuc"><br>
        <input type="submit" value="Borrar sucursal">
    </form> 
    </body>
</body>
</html>
