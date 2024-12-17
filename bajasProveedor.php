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
    if (isset($_POST['idProv'])) {
        $sql = "DELETE FROM proveedor WHERE CodigoProveedor = " . $_POST["idProv"] . ";";
        $result = $conn->query($sql);
        echo "Proveedor borrado.";
    }
    ?>
    <!-- Html Aqui!!!!!! -->

    <body>
        <h4>Borrar Proveedor</h4>
        <form method="POST" class="formulario">
            <label for="idEmp" class="label">ID del proveedor a borrar:</label><br>
            <input type="text" class="input" id="idEmp" name="idProv"><br>
            <input type="submit" class="button" value="Borrar proveedor">
        </form>

        <!-- Tabla de proveedores -->
        <table>
            <tr>
                <th>Codigo Proveedor</th>
                <th>Telefono</th>
                <th>Nombre</th>
                <th>Codigo Sucursal</th>
                <th>Tipo Articulo</th>
                <th>Ciudad</th>
                <th>Direccion</th>
            </tr>
            <?php
            $sql = "SELECT * FROM proveedor";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["CodigoProveedor"] . "</td>";
                    echo "<td>" . $row["Telefono"] . "</td>";
                    echo "<td>" . $row["Nombre"] . "</td>";
                    echo "<td>" . $row["CodigoSucursal"] . "</td>";
                    echo "<td>" . $row["TipoArticulo"] . "</td>";
                    echo "<td>" . $row["Ciudad"] . "</td>";
                    echo "<td>" . $row["Direccion"] . "</td>";
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