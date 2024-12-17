<?php
// index.php
include 'header.php';
include 'mySQLConnection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="est/bajas.css">
</head>

<body>
    <?php
    if (isset($_POST['idEmp'])) {
        $sql = "DELETE FROM empleado WHERE CodigoEmpleado = " . $_POST["idEmp"] . ";";
        $result = $conn->query($sql);
        echo "Empleado borrado.";
    }
    ?>
    <!-- Html Aqui!!!!!! -->

    <body>
        <h4>Borrar Empleado</h4>
        <form method="POST" class="formulario">
            <label for="idEmp" class="label">ID del empleado a borrar:</label><br>
            <input type="text" id="idEmp" name="idEmp" class="input"><br>
            <input type="submit" value="Borrar empleado" class="button">
        </form>


        <!-- Tabla de empleados -->
        <table>
            <tr>
                <th>CodigoEmpleado</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Puesto</th>
                <th>Sueldo</th>
                <th>RFC</th>
                <th>CodigoGerente</th>
                <th>CodigoSucursal</th>
            </tr>
            <?php
            $sql = "SELECT * FROM empleado";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["CodigoEmpleado"] . "</td>";
                    echo "<td>" . $row["Nombre"] . "</td>";
                    echo "<td>" . $row["Telefono"] . "</td>";
                    echo "<td>" . $row["Puesto"] . "</td>";
                    echo "<td>" . $row["Sueldo"] . "</td>";
                    echo "<td>" . $row["RFC"] . "</td>";
                    echo "<td>" . $row["CodigoGerente"] . "</td>";
                    echo "<td>" . $row["CodigoSucursal"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>
        </table>
    </body>
</body>

</html>