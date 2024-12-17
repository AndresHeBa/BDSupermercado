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
        if (isset($_POST['idVen'])) {
            $sql = "DELETE FROM venta WHERE CodigoVenta = " . $_POST["idVen"] . ";";
            $result = $conn->query($sql);
            echo "Venta borrada.";
        }
    ?>
    <!-- Html Aqui!!!!!! -->
    <body>
    <h4>Borrar Articulo</h4>
    <form method="POST">
        <label for="idEmp">ID de la venta a borrar:</label><br>
        <input type="text" id="idEmp" name="idVen"><br>
        <input type="submit" value="Borrar venta">
    </form> 
    </body>
</body>
</html>
