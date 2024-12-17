<?php
// index.php
include 'header.php';
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
    include 'mySQLConnection.php';
    if (isset($_POST['idSuc'])) {
        $sql = "DELETE FROM sucursal WHERE CodigoSucursal = " . $_POST["idSuc"] . ";";
        $result = $conn->query($sql);
        echo "Sucursal borrada.";
    }
    ?>
    <!-- Html Aqui!!!!!! -->

    <body>
        <h4>Borrar Sucursal</h4>
        <form method="POST" class="formulario">
            <label for="idEmp" class="label">ID de la sucursal a borrar:</label><br>
            <input type="text" id="idEmp" class="input" name="idSuc"><br>
            <input type="submit" class="button" value="Borrar sucursal">
        </form>

        <!-- Tabla de sucursales -->
        <table>
            <tr>
                <th>Codigo Sucursal</th>
                <th>Codigo Gerente</th>
                <th>Codigo Proveedor</th>
                <th>Ciudad</th>
                <th>Direccion</th>
                <th>CP</th>
            </tr>
            <?php
            $sql = "SELECT * FROM sucursal";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["CodigoSucursal"] . "</td>";
                    echo "<td>" . $row["CodigoGerente"] . "</td>";
                    echo "<td>" . $row["CodigoProveedor"] . "</td>";
                    echo "<td>" . $row["Ciudad"] . "</td>";
                    echo "<td>" . $row["Direccion"] . "</td>";
                    echo "<td>" . $row["CP"] . "</td>";
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