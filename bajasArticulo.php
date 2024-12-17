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
        if (isset($_POST['idArt'])) {
            $sql = "DELETE FROM articulo WHERE CodigoArticulo = " . $_POST["idArt"] . ";";
            $result = $conn->query($sql);
            echo "Articulo borrado.";
        }
    ?>
    <body>
    <h4>Borrar Articulo</h4>
    <form method="POST">
        <label for="idEmp">ID del articulo a borrar:</label><br>
        <input type="text" id="idEmp" name="idArt"><br>
        <input type="submit" value="Borrar articulo">
    </form> 
    </body>
</body>
</html>
