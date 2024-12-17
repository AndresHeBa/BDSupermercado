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
        if (isset($_POST['idEmp'])) {
            $sql = "DELETE FROM empleado WHERE CodigoEmpleado = " . $_POST["idEmp"] . ";";
            $result = $conn->query($sql);
            echo "Empleado borrado.";
        }
    ?>
    <!-- Html Aqui!!!!!! -->
    <body>
    <h4>Borrar Empleado</h4>
    <form method="POST">
        <label for="idEmp">ID del empleado a borrar:</label><br>
        <input type="text" id="idEmp" name="idEmp"><br>
        <input type="submit" value="Borrar empleado">
    </form> 
    </body>
</body>
</html>
