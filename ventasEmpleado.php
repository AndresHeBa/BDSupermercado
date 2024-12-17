<html>
    <body>
        <h4>Buscar Ventas de Vendedor</h4>
        <form method="POST">
            <label for="vendedor">Nombre del Vendedor</label><br>
            <input type="text" id="vendedor" name="vendedor"><br>
            <input type="submit" value="Mostrar Ventas">
        </form> 
    </body>
</html>

<?php 
include 'mySQLConnection.php';

if (isset($_POST['vendedor'])) {
    $sql = "CALL ventasVendedor('" . $_POST["vendedor"] . "')";
    $conn->query($sql);
    $sql = "SELECT * 
            FROM ventas_vendedor;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<thead><tr><th>Vendedor</th><th>Total de la Venta</th><th>Sucursal</th><th>Fecha</th></tr></thead><tbody>";

        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . ($row["NombreVendedor"] ?? '') . "</td>";
            echo "<td>" . ($row["TotalVenta"] ?? '') . "</td>";
            echo "<td>" . ($row["CodigoSucursal"]) . "</td>";
            echo "<td>" . ($row["Fecha"]) . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>No hay resultados.</p>";
    }
}
$conn->close();
?>