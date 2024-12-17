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
    if (isset($_POST['idVen'])) {
        $sql = "DELETE FROM venta WHERE CodigoVenta = " . $_POST["idVen"] . ";";
        $result = $conn->query($sql);
        echo "Venta borrada.";
    }
    ?>
    <!-- Html Aqui!!!!!! -->

    <body>
        <h4>Borrar Venta</h4>
        <form method="POST" class="formulario">
            <label for="idVen" class="label">ID de la venta a borrar:</label><br>
            <input type="text" id="idVen" name="idVen" class="input"><br>
            <input type="submit" value="Borrar venta" class="button">
        </form>

        <!-- Tabla de ventas -->
        <table>
            <tr>
                <th>Codigo Venta</th>
                <th>Nombre Vendedor</th>
                <th>Total Venta</th>
                <th>Codigo Sucursal</th>
                <th>Fecha</th>
            </tr>
            <?php
            $sql = "SELECT * FROM venta";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["CodigoVenta"] . "</td>";
                    echo "<td>" . $row["NombreVendedor"] . "</td>";
                    echo "<td>" . $row["TotalVenta"] . "</td>";
                    echo "<td>" . $row["CodigoSucursal"] . "</td>";
                    echo "<td>" . $row["Fecha"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </table>
    </body>
</body>

</html>