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
    if (isset($_POST['idArt'])) {
        $sql = "DELETE FROM articulo WHERE CodigoArticulo = " . $_POST["idArt"] . ";";
        $result = $conn->query($sql);
        echo "Articulo borrado.";
    }

    ?>
    <!-- Html Aqui!!!!!! -->

    <body>
        <h4>Borrar Articulo</h4>
        <form method="POST" class="formulario">
            <label for="idEmp" class="label">ID del articulo a borrar:</label><br>
            <input type="text" id="idEmp" name="idArt" class="input"><br>
            <input type="submit" value="Borrar articulo" class="button">
        </form>

        <!-- Tabla de articulos -->
        <table>
            <tr>
                <th>Codigo Articulo</th>
                <th>Nombre</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Codigo Proveedor</th>
                <th>Tipo Articulo</th>
            </tr>
            <?php
            $sql = "SELECT * FROM articulo";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["CodigoArticulo"] . "</td>";
                    echo "<td>" . $row["Nombre"] . "</td>";
                    echo "<td>" . $row["PrecioCompra"] . "</td>";
                    echo "<td>" . $row["PrecioVenta"] . "</td>";
                    echo "<td>" . $row["CodigoProveedor"] . "</td>";
                    echo "<td>" . $row["TipoArticulo"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "0 resultados";
            }

            $conn->close();
            ?>
        </table>
    </body>
</body>

</html>